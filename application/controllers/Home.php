<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$this->load->view('templates/header');
		$this->load->view('home');
        $this->load->view('templates/footer');
	}

	public function data() {
        $this->load->database();
        $this->load->model('Home_model', 'home');
        $data = $this->home->get_data();

        header('Content-Type: application/json');
        print json_encode($data, JSON_PRETTY_PRINT);
	}
}
