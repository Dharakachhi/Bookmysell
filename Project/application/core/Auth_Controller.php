<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_Controller extends CI_Controller {

    function __construct()
    {

        parent::__construct();
        // if(maintenance == 1){
        //     redirect('maintenance');
        // }
        if (!$this->session->userdata('id')){

            redirect('login');

        }
     //    if($this->config->item('maintenance_mode') == TRUE) {
     //        $this->load->view('front/maintenance');
     //    	die();
    	// }

    }

}



