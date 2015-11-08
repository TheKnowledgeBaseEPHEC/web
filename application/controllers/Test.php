<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Test extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();


    }

    public function index()
    {


        $data = array(
            'title' => 'My Title',
            'heading' => 'My Heading',
            'message' => 'My Message'
        );

        $this->load->view('test', $data);
    }
}