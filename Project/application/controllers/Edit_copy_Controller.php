<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit_copy_Controller extends Auth_Controller {

	public function __construct()

	{

	    parent::__construct();

	    $this->is_admin = $this->session->userdata('is_admin');

	    $this->load->library('form_validation');

   }

	public function edit_copy_order_insert()
	{
		   $success=$error='';

		    $error_conter = 0;

		    $img_error ='';
		    if($this->input->post('item_name') != '') {
		      $data['item_name'] = $this->input->post('item_name');
		      $data['item_type'] = $this->input->post('item_select');
		    } else {
		       $data['item_name'] = $this->input->post('item_select');
		    }
		    // $data['item_name'] = $this->input->post('item_name');
		    $data['item_price'] = $this->input->post('item_price');
		    $data['item_category'] = $this->input->post('item_category');
		    $data['item_location_type'] = $this->input->post('item_location_type');
		    $slug = trim($data['item_category']);
		    $address_slug = preg_replace('/\s+/', '-', $slug);
		    $data['item_quantity'] = $this->input->post('item_quantity');

		    $data['item_description'] = $this->input->post('item_description');

		    $data['item_location'] = $this->input->post('item_location');

		    $data['created_by'] = $this->input->post('user_id');
		    $data['disable-location'] = $this->input->post('item_enitre_chk');
		    $data['order_id'] = $this->input->post('mian_order_id');

		    $result = $this->Common_model->insert($data,'order_item');
		    // check address and location is exists to this order or not
		    // $check_query = $this->Common_model->check_address_location_exists($data['order_id'],$data['item_location_type'],$data['item_category']);
		    // echo $check_query;
		    // echo $this->db->last_query();exit;
		    // if($check_query > 0 ){
		    	// $error_already = "Address and location is alrady in use";
		    // }else {
		    // }
		    $item_id = $result;
		    if($data['item_location_type'] == "PM") {
		      $loc = "Primary Home";
		    } elseif($data['item_location_type'] == "VH"){
		      $loc = "Vacation Home";
		    } elseif($data['item_location_type'] == "OFC" ) {
		      $loc = "Office";
		    } elseif($data['item_location_type'] == "OTHER" ) {
		      $loc = 'Other';
		    } else {
		    	$loc = '';
		    }
		  // echo $this->db->last_query();exit;

		    if (!empty($result)) {

		     $item_id = $result;

		     $img_ids = array();

		     if(!empty($_FILES['product_gallery_image']['name'])){

		      // for($i=0; isset($_FILES['product_gallery_image']['name'][$i]); $i++;) {

		      for($i = 0; isset($_FILES['product_gallery_image']['name'][$i]); $i++) {

		      // for($i=0; $i<count($_FILES['product_gallery_image']['name']); $i++){

		        if (!empty($_FILES['product_gallery_image']['name'][$i])) {

		            //print_r($_FILES['product_gallery_image']['name'][$i]); exit();

		          $_FILES['file']['name'] = $_FILES['product_gallery_image']['name'][$i];

		          $_FILES['file']['type'] = $_FILES['product_gallery_image']['type'][$i];

		          $_FILES['file']['tmp_name'] = $_FILES['product_gallery_image']['tmp_name'][$i];

		          $_FILES['file']['error'] = $_FILES['product_gallery_image']['error'][$i];

		          $_FILES['file']['size'] = $_FILES['product_gallery_image']['size'][$i];

		          $config['upload_path'] = './upload/Product/';

		          $config['allowed_types'] = 'gif|jpg|png|jpeg';

		          $config['max_size'] = 4096;

		          $config['max_width'] = 2000;

		          $config['max_height'] = 2000;

		          $config['encrypt_name'] = TRUE;



		          $this->upload->initialize($config);



		          if (!$this->upload->do_upload('file')) {

		            $img_error = $this->upload->display_errors();

		            $error_conter++;

		          }

		          else{

		            $post_image = $this->upload->data();

		            $data1['img_name'] = $post_image['file_name'];

		            $data1['product_id']=$item_id;

		            array_push($img_ids,$this->Common_model->insert($data1,'orderitem_image'));

		          }

		        }

		      }

		    }



		  }

		  else

		  {

		   $error = "Item Not Inserted";

		 }



		 if ($error_conter==0 )  {

		      // $item = $this->getitem($result);

		      // echo $item;

		      // die();
		  // $itemrow = $this->gettrdata($item_id);
		  // $html = '<tr id="temp_'.$data['item_location_type'].'" class="old_location" data-loc="'.$data['item_location_type'].'" data-address="'.$address_slug.'"><td class="panel-heading" colspan="7"><span class="locaton_type"><b>Location:  '.$loc.'</b>&nbsp;&nbsp;</span><span class="category"><b>Address:  '.$data['item_category'].'</b></span></td></tr>';
		  // $checkbox_html = '<tr><td colspan="6" data-ent="entire-location">Enitre Location</td><input type="hidden" name="item_ids[]" value="'.$item_id.'"/></tr>';
		  $success = "Item Inserted Successfully";
		}

		else{

		  $sql = $this->Common_model->delete($item_id,'item_id','order_item');

		  $error = $img_error;

		}

		// refresh div data
		 $address = $this->Common_model->item_address($data['order_id']);
	     $small = array();
	     $explode =  array();
	     $i =0;
	     $small['order'] = $this->Common_model->getResultArray(array('ord_id'=>$data['order_id']),'*','order_master');
	     foreach ($address as $key => $value) {
	        $avav  = explode(',', $value['location_type']);
	        foreach ($avav as $key => $value_avav) {
	          $explode[$i]['address'] = $value['address'];
	          $explode[$i]['location_type'] = $value_avav;
	         $i++;
	        }
	    }
	    $small['addressandlocation'] = $explode;

	     foreach ($explode as $key => $value) {
	        $item_detail = $this->Common_model->wherein_item_location($value['address'],$value['location_type'],$data['order_id']);
	        $image_data= array();
	          foreach ($item_detail as $key => $val) {
	              $item_image = $this->Common_model->wherein_img($val['item_id']);
	              $val['image'] = $item_image;
	              $image_data[] = $val;
	          }
	        $small['items'][$value['address']][$value['location_type']] = $image_data;
	     }
	     // echo "<pre>";
	     // print_r ($small);
	     // echo "</pre>";exit;

	   echo $this->load->view('dashboard/edit_order_html',$small,TRUE);
		// echo json_encode(array('success'=>$success,'error'=>$error,'item_id'=>$item_id,"new_data"=>$small/*,'item'=>$item*/));


			}


	public function edit_insert_disable_location(){
	 	$data = array();
	    $data['disable-location'] = "1";
	    $data['order_id'] = $this->input->post('main_order_id');
	    $data['item_category'] = $this->input->post('item_address');
	    $data['item_location_type'] = $this->input->post('item_location_type');
	    $slug = trim($data['item_category']);
	    $address_slug = preg_replace('/\s+/', '-', $slug);
	    $data['created_by'] = $this->session->userdata('id');
	    $check_query = $this->Common_model->check_address_location_exists($data['order_id'],$data['item_location_type'],$data['item_category']);

	    if($check_query > 0 ){
	    	$error_already = "Address and location is alrady in use";
	    }else {
		    $result = $this->Common_model->insert($data,'order_item');
		    // echo $this->db->last_query();exit;
	    	$item_id = $result;
		}
	    // echo $data['order_id'];exit;
	    // echo $result;exit;
	    if($data['item_location_type'] == "PM") {
	      $loc = "Primary Home";
	    } elseif($data['item_location_type'] == "VH"){
	      $loc = "Vacation Home";
	    } elseif($data['item_location_type'] == "OFC" ) {
	      $loc = "Office";
	    } elseif($data['item_location_type'] == "OTHER" ) {
	    	$loc = "Other";
	    } else {
	      $loc = '';
	    }
	    if($result) {
	      $success = "Add Successfully";
	     // $html = '<tr id="temp_'.$data['item_location_type'].'" class="old_location" data-loc="'.$data['item_location_type'].'" data-address="'.$address_slug.'"><td class="panel-heading" colspan="7"><span class="locaton_type"><b>Location:  '.$loc.'</b>&nbsp;&nbsp;</span><span class="category"><b>Address:  '.$data['item_category'].'</b></span></td></tr>';
	      //$checkbox_html = '<tr><td colspan="6" data-ent="entire-location">Enitre Location</td><input type="hidden" name="item_ids[]" value="'.$item_id.'"/></tr>';
	    }else {
	      $error = "Something went wrong";
	    }
	    	// refresh div data
		 $address = $this->Common_model->item_address($data['order_id']);
	     $small = array();
	     $explode =  array();
	     $i =0;
	     $small['order'] = $this->Common_model->getResultArray(array('ord_id'=>$data['order_id']),'*','order_master');
	     foreach ($address as $key => $value) {
	        $avav  = explode(',', $value['location_type']);
	        foreach ($avav as $key => $value_avav) {
	          $explode[$i]['address'] = $value['address'];
	          $explode[$i]['location_type'] = $value_avav;
	         $i++;
	        }
	    }
	    $small['addressandlocation'] = $explode;

	     foreach ($explode as $key => $value) {
	        $item_detail = $this->Common_model->wherein_item_location($value['address'],$value['location_type'],$data['order_id']);
	        $image_data= array();
	          foreach ($item_detail as $key => $val) {
	              $item_image = $this->Common_model->wherein_img($val['item_id']);
	              $val['image'] = $item_image;
	              $image_data[] = $val;
	          }
	        $small['items'][$value['address']][$value['location_type']] = $image_data;
	     }
	     // echo "<pre>";
	     // print_r ($small);
	     // echo "</pre>";exit;

	   echo $this->load->view('dashboard/edit_order_html',$small,TRUE);
	      // echo json_encode(array('success'=>$success,'error'=>$error,'item_id'=>$item_id,'already'=>$error_already/*,'item'=>$item*/));
	}

	public function edit_tr()

	  {
	    $data = array();
	    $success=$error='';
	    $item_id = $this->input->post('item_id');
	    $item_details = $this->Common_model->getResultArray(array('item_id'=>$item_id),'order_id,item_id,item_category,item_location_type','order_item');
	    $data['location'] = $item_details;

	   echo $this->load->view('dashboard/edit_copy_tr', $data, true);
	 }



	 public function update_tr(){
	 	// echo "<pre>";
	 	// print_r ($_POST);
	 	// echo "</pre>";exit;
	  $data = [];
	  $data['item_category'] = $this->input->post('address');
	  $data['item_location_type'] = $this->input->post('loc');
	  $item_id = $this->input->post('item_id');
	  $order_id = $this->input->post('order_id');
	   if($data['item_location_type'] == "PM") {
	      $loc = "Primary Home";
	    } elseif($data['item_location_type'] == "VH"){
	      $loc = "Vacation Home";
	    } elseif($data['item_location_type'] == "OFC" ) {
	      $loc = "Office";
	    } elseif($data['item_location_type'] == "OTHER" ) {
	       $loc = "Other";
	    } else {
	      $loc = '';
	    }
	     $slug = trim($data['item_category']);
	    $address_slug = preg_replace('/\s+/', '-', $slug);
	  $result = $this->Common_model->update($item_id,$data,'order_item','item_id');
	  // echo $this->db->last_query();exit;
	 	
    // refresh div data
     $address = $this->Common_model->item_address($order_id);
       $small = array();
       $explode =  array();
       $i =0;
       $small['order'] = $this->Common_model->getResultArray(array('ord_id'=>$order_id),'*','order_master');
       foreach ($address as $key => $value) {
          $avav  = explode(',', $value['location_type']);
          foreach ($avav as $key => $value_avav) {
            $explode[$i]['address'] = $value['address'];
            $explode[$i]['location_type'] = $value_avav;
           $i++;
          }
      }
      $small['addressandlocation'] = $explode;

       foreach ($explode as $key => $value) {
          $item_detail = $this->Common_model->wherein_item_location($value['address'],$value['location_type'],$order_id);
          $image_data= array();
            foreach ($item_detail as $key => $val) {
                $item_image = $this->Common_model->wherein_img($val['item_id']);
                $val['image'] = $item_image;
                $image_data[] = $val;
            }
          $small['items'][$value['address']][$value['location_type']] = $image_data;
       }

        // $itemrow = $this->getnewitem($copyitem_id,$rowid);
	       if($result){
	         echo $this->load->view('dashboard/edit_order_html',$small,TRUE);
     	}
  	}
}

/* End of file Edit_copy_Controller.php */
/* Location: .//C/Users/Admin/AppData/Local/Temp/fz3temp-3/Edit_copy_Controller.php */