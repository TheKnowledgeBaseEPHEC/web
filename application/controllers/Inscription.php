<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Inscription extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Inscription_model', 'inscription');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helpers('common');
        $this->load->library('Recaptcha');
        $this->load->database();

    }

    public function index()
    {
        if (!empty($this->session->userdata('logged_in'))) {
            $this->session->set_flashdata('validation_errors', $this->lang->line('already_logged_in'));
        }
        $data['title'] = 'Inscription';

        $data['recaptcha_html'] = $this->recaptcha->render();

        $this->load->view('header');
        $this->load->view("inscription", $data);
        $this->load->view('footer');
    }

    /* Vérifie qu'un mot de passe ait bien majuscules, minuscules, numéro */
    public function password_strength($str)
    {
        $this->form_validation->set_message('password_strength', $this->lang->line('password_strength'));
        if (preg_match('/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,}/', $str)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /* Inscription d'un nouveau membre */
    public function registration()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nom', 'Nom de famille', 'trim|required|min_length[2]');
        $this->form_validation->set_rules('prenom', 'Prenom', 'trim|required|min_length[2]');
        $this->form_validation->set_rules('email', 'Votre Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('confirmEmail', "La confirmation de votre email", 'trim|required|valid_email|matches[email]');
        $this->form_validation->set_rules('password', 'Mot de passe', 'trim|required|min_length[4]|max_length[64]|callback_password_strength');
        $this->form_validation->set_rules('confirmPassword', 'Confirmation de votre mot de passe', 'trim|required|matches[password]');

        $user = (object)array(
            'nom' => $this->input->post('nom'),
            'prenom' => $this->input->post('prenom'),
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password')
        );

        $recaptcha = $this->input->post('g-recaptcha-response');
        $recaptcha_response = $this->recaptcha->verifyResponse($recaptcha);

        if ($this->form_validation->run() === FALSE) {
            /*
             *  Mettre les erreurs dans une variable flash (vidée au refresh) et revient en arrière.
             *  Evite de devoir remplir tous les champs à nouveau.
             */
            $this->session->set_flashdata('validation_errors', $this->form_validation->get_error_array());
            go_back();
        } else {
            if (!$recaptcha_response['success']) {
                $this->session->set_flashdata('validation_errors', $this->lang->line('recaptcha_invalid'));
                go_back();
                die();
            }
            $user->slug = $this->inscription->gen_slug($user);

            /* Vérifie si le slug/email existent pas déjà */
            if (!$this->inscription->check_mail($user)) {
                $this->inscription->check_and_update_slug($user);

                /* Addition de l'utilisateur et de la clé d'activation en BDD */
                $user->id = $this->inscription->add_user($user);
                $user->activation_key = $this->inscription->create_activation_key($user);

                /* Envoi du mail d'activation */
                if (!$this->sendmail($user)) {
                    $this->session->set_flashdata('validation_errors', $this->lang->line('failed_to_send_activation_email'));
                    go_back();
                }

                $this->load->view('header');
                $this->load->view("thanks_user");
                $this->load->view('footer');
            } else {
                $this->session->set_flashdata('validation_errors', $this->lang->line('email_exists'));
                go_back();
            }
        }
    }

    /* Envoi de l'email d'activation */
    public function sendmail($user)
    {
        if (empty($user)) {
            die();
        }

        /* Si on veut envoyer un mail pour les utilisateurs mobiles */
        if (!is_object($user)) {
            $this->load->model('Profil_model');
            $this->load->model('Inscription_model');
            $this->load->helper('email');
            $slug = $user;
            $udata = (object)$this->Profil_model->getUserData($slug);
            if ($udata != null) {
                $user = (object)array(
                    'nom' => $udata->Nom,
                    'prenom' => $udata->Prenom,
                    'email' => $udata->AdresseMail,
                    'id' => $udata->idUser
                );
                $user->activation_key = $this->Inscription_model->create_activation_key($user);
            }
        }

        date_default_timezone_set('Europe/Brussels');

        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'theknowledgebase2015',
            'smtp_pass' => 'aoien2i3n()_AAAarstoien%BX',
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");

        $data['user'] = $user;
        $email_msg = $this->load->view('register_email', $data, TRUE);
        $subject = $this->lang->line('register_email_subject');

        $this->email->from('theknowledgebase2015@gmail.com', 'theknowledgebase.be');
        $this->email->to($user->email);
        $this->email->subject($subject);
        $this->email->message($email_msg);

        if (!$this->email->send()) {
            $this->email->print_debugger();
        }
        return true;
    }

    /* Vérification de la clé et activation de l'utilisateur */
    public function verify($activation_id = null)
    {
        if (!empty($activation_id)) {
            $result = $this->db->select('User_idUser, expiration')
                ->where('cle', $activation_id)
                ->where('expiration <=', 'DATE_ADD(NOW(),INTERVAL 1 WEEK )')
                ->get('Activation')
                ->row();
            if (empty($result)) {
                // XXX gérer clés expirées
                $this->verification_failure($this->lang->line('activation_key_not_found'));
            } else {
                $this->db->where('cle', $activation_id)->delete('Activation');
                $this->db->set('DateActivation', 'now()', FALSE);
                $this->db->where('idUser', $result->User_idUser)
                    ->update('User', array('Actif' => 1, 'status' => 'user'));
                if ($this->db->affected_rows()) {
                    $this->verification_success();
                } else {
                    $this->verification_failure($this->lang->line('failed_to_activate_user'));
                }
            }
        }
    }

    public function verification_success()
    {
        $this->load->view('header');
        $this->load->view('register_success');
        $this->load->view('footer');
    }

    public function verification_failure($message)
    {
        $data['message'] = $message;

        $this->load->view('header');
        $this->load->view('errors/not_found', $data);
        $this->load->view('footer');
    }

    public function csv()
    {
        $this->load->view('header');
        if (empty($this->session->userdata('user_id'))) {
            $data['message'] = 'Vous devez être identifié pour uploader un csv.';
            $this->load->view('errors/not_found', $data);
        } else if ($this->session->userdata('user_status') !== "admin") {
            $data['message'] = 'Vous devez être admin pour uploader un csv.';
            $this->load->view('errors/not_found', $data);
        } else {
            if (!empty($this->input->post('csv_submit'))) {
                $file = $this->upload_csv();
                $this->load_users_from_csv($file);
            } else {
                $this->load->view('csv');
            }
        }

        $this->load->view('footer');
    }

    public function load_users_from_csv($file)
    {
        $row = 1;
        $users = array();
        if (($handle = fopen($file, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $row++;
                $users[$data[0]] = array(
                    'slug' => $data[0],
                    'Prenom' => $data[1],
                    'Nom' => $data[2],
                    'AdresseMail' => $data[3],
                    'Password' => hash('sha512', $data[4])
                );
            }
            fclose($handle);

            $viewdata['users'] = $users;
            $viewdata['nbusers'] = $row;
            $this->load->view('csv', $viewdata);
        }
    }

    public function upload_csv()
    {
        $content_dir = './uploads/';
        $config['upload_path'] = $content_dir;
        $config['allowed_types'] = "csv";
        $config['max_size'] = "2048000";
        $config['overwrite'] = true;
        $config['file_name'] = 'upload_' . time();

        $this->load->library('upload', $config);

        /*if (!$this->upload->do_upload()) {
            $this->session->set_flashdata('upload_error', $this->upload->display_errors());
            return false;
        } else {*/
        $this->upload->do_upload();
        $file_info = $this->upload->data();
        $csvfilepath = "uploads/" . $file_info['file_name'];
        return $csvfilepath;
    }
}