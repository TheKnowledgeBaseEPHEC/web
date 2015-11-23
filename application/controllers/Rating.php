<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rating extends CI_Controller {

    public function index()
    {
        $this->load->view('header');
        $this->load->view('rating_do');
        $this->load->view('footer');
    }

    public function data() {
        $this->load->database();
        $this->load->model('Home_model', 'home');
        $data = $this->home->get_data();

        header('Content-Type: application/json');
        print json_encode($data, JSON_PRETTY_PRINT);
    }

    public function add_rating(){
        $this->load->model('rating_model');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helpers('common');
        $this->load->database();

        $this->load->view('header');
        if ($this->session->userdata('logged_in')) {
            $data = array(
                'userId' => $this->session->userdata('user_id'),
            );
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            $this->form_validation->set_rules('userRatingId', 'userRatingId', 'required');
            $this->form_validation->set_rules('userRatedId', 'userRatedId', 'required');
            $this->form_validation->set_rules('idSeance', 'idSeance', 'required');
            $this->form_validation->set_rules('date', 'date', 'required');
            $this->form_validation->set_rules('status', 'status', 'required');
            $this->form_validation->set_rules('comment', 'comment', 'required');
            $this->form_validation->set_rules('rating', 'rating', 'required');
            if ($this->form_validation->run() == FALSE) {
                //$data['ecole_data'] = $this->fac->get_fac();
                $this->load->helper('form');
                $this->load->view('rating_do', $data);
            } else {
                $data = array(
                    'userRatingId' => $this->input->post('userRatingId'),
                    'userRatedId' => $this->input->post('userRatedId'),
                    'idSeance' => $this->input->post('idSeance'),
                    'date' => $this->input->post('date'),
                    'status' => $this->input->post('status'),
                    'comment' => $this->input->post('comment'),
                    'rating' => $this->input->post('rating'),
                );
                $this->rating_model->add_rating($data);
                $this->load->view('rating_added');
                $this->output->set_header('refresh:10; ../payment');
            }
        } else {
            $this->load->view('login');
        }

        $this->load->view('footer');
    }
}
