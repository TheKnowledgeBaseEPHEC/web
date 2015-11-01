<?php
class Thanks_user extends CI_Controller{

public function index(){
$this->load->view('templates/header');
$this->load->view("thanks_user");
$this->load->view('templates/footer');
}
}