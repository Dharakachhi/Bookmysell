<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Home_model extends CI_Model {



	public function check_duplicate_email($user_email, $id=''){

    if($id != ''){

      $sql = "SELECT id FROM registration WHERE email='$user_email' AND id != '$id'";

    } else{

      $sql = "SELECT id FROM registration WHERE email='$user_email'";

    }

      $query = $this->db->query($sql);

      if ($query->num_rows($query) > 0) {

          return 'false';

      } else {

          return 'true';

      }

    } 



    public function insert_user($data)

    {

    	 $this->db->insert('registration', $data);
      return $this->db->insert_id();

    }



    public function login_check($email, $password){

		$this->db->select('*');

		$this->db->from('registration');

		$this->db->where('email', $email);

		$this->db->where('password', $password);

		$data = $this->db->get();

		return $data->row();

	}

	public function getforgot($email){

		$sql = "SELECT id,email FROM registration WHERE email = '".trim($email)."'";

		$query = $this->db->query($sql);

		return $query->row_array();

	}



	public function reset_password($id, $password){

    	$this->db->set('password', $password);

        $this->db->where('id', $id);

        return $this->db->update('registration');

    }



}



/* End of file Home_model.php */

/* Location: ./application/models/Home_model.php */