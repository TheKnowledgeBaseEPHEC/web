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
        $this->load->database();

    }

    public function index()
    {
        if (!empty($this->session->userdata('user_data'))) {
            redirect(base_url());
        } else {
            $data['title'] = 'Inscription';
            $this->load->view('templates/header');
            $this->load->view("inscription", $data);
            $this->load->view('templates/footer');
        }
    }

    /*public function thank()
    {
        $data['title']= 'Thank';
        $this->load->view('templates/header');
        $this->load->view('thanks_user', $data);
        $this->load->view('templates/footer');
    }*/

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

    public function registration()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nom', 'Nom de famille', 'trim|required|min_length[2]');
        $this->form_validation->set_rules('prenom', 'Prenom', 'trim|required|min_length[2]');
        $this->form_validation->set_rules('email', 'Votre Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('confirmEmail', "La confirmation de votre email", 'trim|required|valid_email|matches[email]');
        $this->form_validation->set_rules('password', 'Mot de passe', 'trim|required|min_length[4]|max_length[64]|callback_password_strength');
        $this->form_validation->set_rules('confirmPassword', 'Confirmation de votre mot de passe', 'trim|required|matches[password]');

        $nom = $this->input->post('nom');
        $prenom = $this->input->post('prenom');
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        if ($this->form_validation->run() === FALSE) {
            /*
             *  Mettre les erreurs dans une variable flash (vidée au refresh) et revient en arrière.
             *  Evite de devoir remplir tous les champs à nouveau.
             */
            $this->session->set_flashdata('validation_errors', $this->form_validation->get_error_array());
            go_back();
        } else {
            $slug = $this->inscription->gen_slug($nom, $prenom);

            /* Vérifie si le slug/email existent pas déjà */
            if (!$this->inscription->check_mail($email)) {
                $this->inscription->check_and_update_slug($slug);
                $this->inscription->add_user($nom, $prenom, $email, $password, $slug);
                $this->load->view('templates/header');
                $this->load->view("thanks_user");
                $this->load->view('templates/footer');
            } else {
                $this->session->set_flashdata('validation_errors', $this->lang->line('email_exists'));
                go_back();
            }
        }
    }

    public function sendmail()
    {
        $verificationCode = random_string('alnum', 20);
        $email = $this->session->userdata('email');

        $email_msg = "Cher utilisateur,<p-->veuillez cliquer sur le lien ci-dessous pour confirmer votre inscription<p></p>";
        $email_msg .= "http://yourdomain/user/verify/" . $verificationCode;
        $email_msg .= "<p>Thanks,\nTheknowledgebase Support Team</p>";
        $subject = "Email Verification";
        $this->load->library('email');
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
        $this->email->initialize($config);
        $this->email->from('admin@theknowledgebase.be', 'Support Team');
        $this->email->to($email);
        $this->email->subject($subject);
        $this->email->message($email_msg);
        $this->email->send();

        // Insert user record

    }

    function verify($verificationText = NULL)
    {
        $this->load->model('user_model');
        $noOfRecords = $this->user_model->verifyEmailAddress($verificationText);
        if ($noOfRecords > 0) {
            $this->session->set_flashdata('success', "Email Verified Successfully! Please login below.");
            redirect('user/login');
        } else {
            $this->session->set_flashdata('success', "Sorry! Unable to verify your email. Please try again.");
            redirect('user/login');
        }
    }
}

?>