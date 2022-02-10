<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Home_Controller extends CI_Controller {



  // public function __construct()

  // {
  //   echo "dfsfs";exit;

  //   parent::__construct();

  // }



	public function index()

	{
    // echo "sdfdsf";
    // echo "<pre>";
    // print_r ($_SESSION);
    // echo "</pre>";exit;

		if ($this->session->userdata('name')) {

			redirect('dashboard');

		}

		// $this->load->view('login_header');

		$this->load->view('login');

		// $this->load->view('login_footer');



	}



	public function register()

	{



		$this->load->helper('captcha');

        $config = array(

           	'img_url' => base_url() . 'upload/image_for_captcha/',

            'img_path' => 'upload/image_for_captcha/',

            'word_length' => 6,

            'img_width'     => '120',

			'img_height'    => 30,

            'font_size' => 14,

            'colors'        => array(

               	'background'     => array(0, 0, 0),

               	'border'         => array(0, 0, 0),

               	'text'           => array(255, 255, 255),

               	'grid'           => array(0, 0, 0)

            )

        );

        $captcha = create_captcha($config);



        $this->session->unset_userdata('captcha_word');

        $this->session->set_userdata('captcha_word', $captcha['word']);

        $data['captchaimage'] = $captcha['image'];



		$this->load->view('login_header');

		$this->load->view('registration',$data);

		$this->load->view('login_footer');

	}



	public function check_duplicate_email()

	{

		$user_email = $this->input->post('email');

		$result = $this->Home_model->check_duplicate_email($user_email);

		echo $result; exit;

	}



		public function refresh_captcha(){

		$this->load->helper('captcha');

        $config = array(

            'img_url' => base_url() . 'upload/image_for_captcha/',

            'img_path' => 'upload/image_for_captcha/',

            'word_length' => 6,

            'img_width'     => '120',

	       	'img_height'    => 30,

            'font_size' => 14,

            'colors'        => array(

               'background'     => array(0, 0, 0),

               'border'         => array(0, 0, 0),

               'text'           => array(255, 255, 255),

               'grid'           => array(0, 0, 0)

            )

        );

        $captcha = create_captcha($config);

        $this->session->unset_userdata('captcha_word');

        $this->session->set_userdata('captcha_word', $captcha['word']);

        $captcha_word = $captcha['word'];

        $captchaimage = $captcha['image'];

        echo json_encode(array('captchaimage'=>$captchaimage, 'captcha_word'=>$captcha_word));

        exit();

  	}



	public function register_user()

	{

     $this->load->library('form_validation');
      $this->form_validation->set_rules('name',"Name", 'required');
      $this->form_validation->set_rules('email',"Email", 'required|valid_email|is_unique[registration.email]');
      $this->form_validation->set_rules('password',"Password", 'required');
      $this->form_validation->set_rules('phone',"Phone", 'required');
      $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');

     if ($this->form_validation->run() == FALSE)

      {

        $error = [];

        $this->error['errors'] = $this->form_validation->error_array();

        $this->load->view('login_header');

        $this->load->view('registration',$this->error);

       $this->load->view('login_footer');

      } else {

		  $data['name'] =  $this->input->post('name');

	    $data['email'] =  $this->input->post('email');

	    $data['phone'] =  $this->input->post('phone');

	    $data['password'] = md5($this->input->post('password'));

	    $data['is_admin'] = 0;



	    $result = $this->Home_model->insert_user($data);
      $result_check = $this->Home_model->login_check($data['email'], $data['password']);
        $is_admin = $result_check->is_admin;

         if ($is_admin) {

            $this->session->set_userdata('is_admin',1);
            $redrect = "vieworder";
        }

        else

        {

            $this->session->set_userdata('is_admin',0);
            $redrect = "placeorder";

        }
        // echo $redrect;exit;

            $array = array(

          'id' => $result_check->id,

          'name' => $result_check->name

        );

        $this->session->set_userdata($array);
	    if ($result) {

	    	$this->session->set_flashdata("message","Register Successfully.");

        redirect($redrect);

	    } else{

				$this->session->set_flashdata("error","Something went to wrong.");

				redirect($redrect);

			}

    }

	}



	public function login_check()

	{
    // echo "login_check";exit;
      $this->load->library('form_validation');

      $this->form_validation->set_rules('email',"Email", 'required|valid_email');

      // $this->form_validation->set_rules('email',"Email", 'required|valid_email|is_unique[registration.email]');

      $this->form_validation->set_rules('password',"Password", 'required');

     if ($this->form_validation->run() == FALSE)

      {


        $error = [];

        $this->error['errors'] = $this->form_validation->error_array();

        $this->load->view('login',$this->error);

      }else {
        // echo "string";exit;

		$email = $this->input->post('email');

		$password = md5($this->input->post('password'));



        $result = $this->Home_model->login_check($email, $password);



        if ($result) {



        $is_admin = $result->is_admin;



        if ($is_admin) {

            $this->session->set_userdata('is_admin',1);
            $redrect = "vieworder";
        }

        else

        {

            $this->session->set_userdata('is_admin',0);
            $redrect = "placeorder";

        }

       	$array = array(

       		'id' => $result->id,

       		'name' => $result->name

       	);

       	$this->session->set_userdata($array);

        redirect($redrect);



        }

        else

        {

        	$this->session->set_flashdata('error', 'Your Email Or Password Does Not Match');

            redirect('login');

        }

      }

	}



  public function sendotp()

  {

    $success=$error='';

    $email = $this->input->post('email');

    // $data = $this->Common_model->getResult(array('id'=>$user_id),'email','registration');



    // $email  = $data[0]->email;





    if (!empty($email))

    {

        $otp = rand(1000,9999);

        $array = array(

          'otp' => $otp

        );





        $this->session->set_userdata( $array );

          $to=$email;

          $subject="OTP";

          $messageBody ="<h2>OTP for Order Confirmation..</h2><br>

            <h1>".$otp."</h1>";



            $mail=simpleMail($to,$subject,$messageBody);

            if($mail == "1"){

              $success = "Email Send Successfully";

            }else{

              $error  = "Can Not send Email";

            }

    }

    else

    {

      $error = "Email Not Found";

    }

     echo json_encode(array('success'=>$success,'error'=>$error,'otp'=>$otp));

  }





	public function logout()

	{

		session_destroy();

		redirect('login');

	}



	public  function forgetpass()

	{

		$this->load->view('login_header');

		$this->load->view('forgot');

		$this->load->view('login_footer');

	}



	public function reset($id) {

        $decrypted_id = base64_decode($id);

        $arr = explode("_", $decrypted_id, 2);

        $user_id = $arr[0];

        if ($user_id) {

	        $data['user_id'] = $arr[0];

            $this->load->view('login_header');

			$this->load->view('reset',$data);

            $this->load->view('login_footer');

        }

        else

        {

        	$this->session->set_flashdata('error', 'Email Not Found');

        	redirect('register');

        }

	}



	public function reset_password(){



		$id = $this->input->post('user_id');

		$password = md5($this->input->post('password'));



		$result = $this->Home_model->reset_password($id, $password);

		if ($result) {

			$this->session->set_flashdata('message', "Password reset Successfully");

			redirect(base_url());

		} else{

			$this->session->set_flashdata('error', "Something wents to wrong");

			redirect(base_url());

		}

	}



	public function forgot_password()

	{



		$forgotData=$this->Home_model->getforgot($this->input->post('email'));



		$this->load->helper('mailhelper');

		 if(!empty($forgotData)){

        	$key="_MY_SECRET_STUFF_STRING";

			$id = $forgotData['id'];

			$link = base64_encode($id.$key);

			$link = str_replace('=', '', $link);

			$resetlink = base_url('reset/'.$link);





            /*$encrypt= rand();

            $password = md5($encrypt);

            $user_id=base64_encode($forgotData['user_id']);*/



            //$where_clause = array('email' => $forgotData['email']);

            //$pwrurl = bsase_url()."reset/q=".$password."/a=".$user_id;

            $to=$forgotData['email'];

            $subject="Reset Password";

            $messageBody=resetpwdBody($resetlink);



            // echo($to);

            // echo($subject);

            // echo($messageBody);

            // exit();

            $mail=simpleMail($to,$subject,$messageBody);

            if($mail == "1"){

                $this->session->set_flashdata('message', 'Success! Your password send to your e-mail address.');

                redirect('forgetpassword');

            }else{

                $this->session->set_flashdata('error', 'Error! Unable to send mail.');

                redirect('forgetpassword');

            }

        }else{

            $this->session->set_flashdata('error', 'Account not found please contact administrator!');

         	redirect('forgetpassword');

        }

	}



}



/* End of file Home_Controller.php */

/* Location: ./application/controllers/Home_Controller.php */