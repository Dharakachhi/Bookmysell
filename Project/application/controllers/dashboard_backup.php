<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Dashboard_Controller extends Auth_Controller {

  public function __construct()

  {

    parent::__construct();

    $this->is_admin = $this->session->userdata('is_admin');

    $this->load->library('form_validation');

  }





  public function index()

  {

    $this->load->view('dashboard/header');

    $this->load->view('dashboard/sidebar');

    $this->load->view('dashboard/index');

    $this->load->view('dashboard/footer');

  }





  // Item Methdod





  /**

   * This method insert the item

   * @return json returns the json status for inseted item

   */

  public function insertitem()

  {
    // echo "<pre>";
    // print_r($_FILES['product_gallery_image']['name']);exit;
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


    $result = $this->Common_model->insert($data,'order_item');
    // echo $this->db->last_query();exit;
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
     $item_id = $result;

  // echo $this->db->last_query();exit;





    if (!empty($result)) {




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
  $itemrow = $this->gettrdata($item_id);
  $html = '<tr id="temp_'.$data['item_location_type'].'" class="old_location" data-loc="'.$data['item_location_type'].'" data-address="'.$address_slug.'"><td class="panel-heading" colspan="7"><span class="locaton_type"><b>Location:  '.$loc.'</b>&nbsp;&nbsp;</span><span class="category"><b>Address:  '.$data['item_category'].'</b></span></td></tr>';
  $checkbox_html = '<tr><td colspan="6" data-ent="entire-location">Entire Location and all chometz on premises</td><input type="hidden" name="item_ids[]" value="'.$item_id.'"/></tr>';
  $success = "Item Inserted Successfully";
}

else{

  $sql = $this->Common_model->delete($item_id,'item_id','order_item');

  $error = $img_error;

}

echo json_encode(array('success'=>$success,'error'=>$error,'item_id'=>$item_id,'body'=>$itemrow,'head'=>$html,'checkbox'=>$checkbox_html/*,'item'=>$item*/));



}


public function insert_disable_location(){
  $data = array();
    $data['disable-location'] = "1";
    $data['item_category'] = $this->input->post('item_address');
    $data['item_location_type'] = $this->input->post('item_location_type');
    $slug = trim($data['item_category']);
    $address_slug = preg_replace('/\s+/', '-', $slug);
    $data['created_by'] = $this->session->userdata('id');
    $result = $this->Common_model->insert($data,'order_item');
    $item_id = $result;
    // echo $this->db->last_query();
    // echo $result;exit;OTHER
    if($data['item_location_type'] == "PM") {
      $loc = "Primary Home";
    } elseif($data['item_location_type'] == "VH"){
      $loc = "Vacation Home";
    } elseif($data['item_location_type'] == "OFC" ) {
      $loc = "Office";
    } elseif($data['item_location_type'] == "OTHER" ) {
      $loc = 'Other';
    } else{
       $loc = '';
    }
    if($result) {
      $success = "Add Successfully";
      $html = '<tr id="temp_'.$data['item_location_type'].'" class="old_location" data-loc="'.$data['item_location_type'].'" data-address="'.$address_slug.'"><td class="panel-heading" colspan="7"><span class="locaton_type"><b>Location:  '.$loc.'</b>&nbsp;&nbsp;</span><span class="category"><b>Address:  '.$data['item_category'].'</b></span></td></tr>';
      $checkbox_html = '<tr><td colspan="6" data-ent="entire-location">Entire Location and all chometz on premises</td><input type="hidden" name="item_ids[]" value="'.$item_id.'"/></tr>';
    }else {
      $error = "Something went wrong";
    }

      echo json_encode(array('success'=>$success,'error'=>$error,'item_id'=>$item_id,'head'=>$html,'checkbox'=>$checkbox_html/*,'item'=>$item*/));
}


public function additem()

  {

    // echo "hgf";exit;

    $data['item_name'] = $this->input->post('item_name');

    $data['item_price'] = $this->input->post('item_price');

    $data['item_quantity'] = $this->input->post('item_quantity');

    $data['item_description'] = $this->input->post('item_description');

    $data['item_location'] = $this->input->post('item_location');

    $data['created_by'] = $this->input->post('user_id');



    $result = $this->Common_model->insert($data,'order_item');





    if (!empty($result)) {



     $item_id = $result;

     $img_ids = array();
     $error_conter = 0;



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

  $success = "Item Inserted Successfully";

}

else{

  $sql = $this->Common_model->delete($item_id,'item_id','order_item');

  $error = $img_error;

}

echo json_encode(array('success'=>$success,'error'=>$error,'item_id'=>$item_id/*,'item'=>$item*/));



}



  /**

   * delete item

   *

   * @return  json  status

   */

  public function deleteitem()

  {

   $success=$error='';

   $item_id = $this->input->post('item_id');



   $imgs = $this->Common_model->getResultArray(array('product_id'=>$item_id),'img_name','orderitem_image');



   foreach ($imgs as $img) {

    unlink('upload/Product/'.$img['img_name']);

  }





  $deleted_item  =  $this->Common_model->delete($item_id,'item_id','order_item');

  $deleted_img = $this->Common_model->delete($item_id,'product_id','orderitem_image');



  if (!empty($deleted_item) && !empty($deleted_img)) {

    $success = "Item Deleted Successfully";

  }

  else

  {

    $error = "Something Went wrong";

  }

  echo json_encode(array('success'=>$success,'error'=>$error));

}



  /**

   * edit item

   *

   * @return  view  table row

   */

  public function edititem()

  {
    // echo "fdsf";exit;

   $success=$error='';

   $rowid =  $this->input->post('table_row');

   $item_id = $this->input->post('item_id');

// echo $item_id;exit;
   // $copyitem_id = $this->input->post('copyitem_id');

   // $newimage_id = $this->input->post('newimage_id');

   $imgs = $this->Common_model->getResultArray(array('product_id'=>$item_id),'img_id,img_name','orderitem_image');

   $item = $this->Common_model->getDatabyId($item_id,'order_item','item_id');



   $data['imgs'] = $imgs;

   $data['items']=$item;

   $data['rowid'] = $rowid;

   // $data['copyitem_id'] = $copyitem_id;

   // $data['newimage_id'] = $newimage_id;

   // echo "<pre>";
   // print_r ($data);
   // echo "</pre>";exit;

   echo $this->load->view('dashboard/edititem', $data, true);



 }



 public function edit_newitem()

  {

   $success=$error='';

   $rowid =  $this->input->post('table_row');

   // $item_id = $this->input->post('item_id');

   $copyitem_id = $this->input->post('copyitem_id');

   $newimage_id = $this->input->post('newimage_id');

   $imgs = $this->Common_model->getResultArray(array('product_id'=>$copyitem_id),'img_id,img_name','orderitem_image');

   $item = $this->Common_model->getDatabyId($copyitem_id,'order_item','item_id');

/*echo $this->db->last_query();

echo "<pre>";

print_r ($item);

echo "</pre>";exit;*/

   $data['imgs'] = $imgs;

   $data['items']=$item;

   $data['rowid'] = $rowid;

   $data['copyitem_id'] = $copyitem_id;

   $data['newimage_id'] = $newimage_id;

// echo "<pre>";

// print_r ($data);

// echo "</pre>";exit;

   echo $this->load->view('dashboard/edit_newitem', $data, true);



 }



  /**

   * get particulat item from database

   *

   * @param   id  $id  get id to fetch

   *

   * @return  view       table row

   */

  public function getitem($id,$rowid)

  {
    // echo $id."<br>";
    // echo $rowid."row";exit;
    $data = array();

    if ($id) {

      $itemids = $this->Common_model->getResultArray(array('item_id'=>$id),'*','order_item');
      // echo "<pre>";
      // print_r($itemids);exit;
      foreach ($itemids as $item) {

        $data[$item['item_id']]['item_detail']=$item;

        $data[$item['item_id']]['image_array'] = $this->Common_model->getRowArray(array('product_id'=>$item['item_id']), '*', 'orderitem_image');

      }



      $final_data['items'] = $data;

      $final_data['rowid'] = $rowid;

      $final_data['itemids'] = $rowid;

      $final_data['new_itemids'] = $rowid;
      // echo "<pre>";
      // print_r ($final_data);
      // echo "</pre>";exit;
      $output =  $this->load->view('dashboard/item_insert_table', $final_data, true);
      // echo "<pre>";
      // print_r ($output);
      // echo "</pre>";exit;
      return $output ;

    }



  }



  // // copy above getitem

  public function getnewitem($id,$rowid)

  {

    $data = array();

    if ($id) {

      $itemids = $this->Common_model->getResultArray(array('item_id'=>$id),'*','order_item');

      foreach ($itemids as $item) {

        $data[$item['item_id']]['item_detail']=$item;

        $data[$item['item_id']]['image_array'] = $this->Common_model->getRowArray(array('product_id'=>$item['item_id']), '*', 'orderitem_image');

      }



      $final_data['items'] = $data;

      $final_data['rowid'] = $rowid;

      $final_data['itemids'] = $rowid;

      $final_data['new_itemids'] = $rowid;

      $output = $this->load->view('dashboard/new_item_insert_table', $final_data, true);

      return $output ;

    }



  }


  public function gettrdata($id)

  {
    // echo $id."<br>";
    $data = array();

    if ($id) {

      $itemids = $this->Common_model->getResultArray(array('item_id'=>$id),'*','order_item');
      // echo "<pre>";
      // print_r($itemids);exit;
      foreach ($itemids as $item) {

        $data[$item['item_id']]['item_detail']=$item;

        $data[$item['item_id']]['image_array'] = $this->Common_model->getRowArray(array('product_id'=>$item['item_id']), '*', 'orderitem_image');

      }



      $final_data['items'] = $data;

      $final_data['rowid'] = $rowid;

      $final_data['itemids'] = $rowid;

      $final_data['new_itemids'] = $rowid;
      // echo "<pre>";
      // print_r ($final_data);
      // echo "</pre>";exit;
      $output =  $this->load->view('dashboard/tbody', $final_data, true);
      $string = preg_replace('/\>\s+\</m', '><', $output);

      // echo "<pre>";
      // print_r($string);exit;
      return $string ;

    }



  }

  /* public function gettrhead($location,$address)

  {
    // echo $id."<br>";
    $data = array();

    if ($id) {
      $data['location'] = $location;
      $data['address'] = $address;

      $itemids = $this->Common_model->getResultArray(array('item_id'=>$id),'*','order_item');
      // echo $this->db->last_query();exit;
      $final_data['items'] = $data;
      echo "<pre>";
      print_r ($data);
      echo "</pre>";exit;
      $output =  $this->load->view('dashboard/thead', $data, true);
      $string = preg_replace('/\>\s+\</m', '><', $output);
      // echo "<pre>";
      // print_r($string);exit;
      return $string ;

    }



  }
*/
  public function updateitem()

    {

        $success=$error='';

        $error_conter = 0;

        $img_error ='';
        $slug = $this->input->post('address');
        if($slug != '') { $slug = createSlug($slug); }
         if($this->input->post('edit_item_select') == 'Other') {
          // echo "A";exit;
          $data['item_name'] = $this->input->post('edit_item_name');
          $data['item_type'] = $this->input->post('edit_item_select');

        } else {
          // echo "dsfd";exit;
           $data['item_name'] = $this->input->post('edit_item_select');
           $data['item_type'] = 'NULL';
        }
        // $data['item_name'] = $this->input->post('edit_item_name');
        $data['item_category'] = $this->input->post('address');
        $data['item_location_type'] = $this->input->post('location_type');
        $data['item_price'] = $this->input->post('edit_item_price');
        $slug = trim($data['item_category']);
        $address_slug = preg_replace('/\s+/', '-', $slug);

        $data['item_quantity'] = $this->input->post('edit_item_quantity');

        $data['item_description'] = $this->input->post('edit_item_description');

        $data['item_location'] = $this->input->post('edit_item_location');

        $location = $this->input->post('edit_item_location');
         $address = $this->input->post('address');
        $location_type = $this->input->post('location_type');
        $edit_item_id = $this->input->post('item_id');

        $rowid = $this->input->post('row_id');

        $copyitem_id = $this->input->post('copyitem_id');
        // echo $edit_item_id;exit;
        // echo $rowid;exit();

        if(!empty($copyitem_id)) {

          $result = $this->Common_model->update($copyitem_id,$data,'order_item','item_id');

        } else {

          $result = $this->Common_model->update($edit_item_id,$data,'order_item','item_id');
        }

        if (!empty($result)) {

          // $item_id = $edit_item_id;

          $img_ids = array();

          if(!empty($_FILES['product_gallery_image1']['name'])){

           for($i=0; $i<count($_FILES['product_gallery_image1']['name']); $i++){

             if (!empty($_FILES['product_gallery_image1']['name'][$i])) {

                       //print_r($_FILES['product_gallery_image']['name'][$i]); exit();

               $_FILES['file']['name'] = $_FILES['product_gallery_image1']['name'][$i];

               $_FILES['file']['type'] = $_FILES['product_gallery_image1']['type'][$i];

               $_FILES['file']['tmp_name'] = $_FILES['product_gallery_image1']['tmp_name'][$i];

               $_FILES['file']['error'] = $_FILES['product_gallery_image1']['error'][$i];

               $_FILES['file']['size'] = $_FILES['product_gallery_image1']['size'][$i];

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

                  if(!empty($copyitem_id)) {

                    $data1['product_id']=$copyitem_id;

                    array_push($img_ids,$this->Common_model->insert($data1,'orderitem_image'));

                  } else {

                    $data1['product_id']=$edit_item_id;

                    array_push($img_ids,$this->Common_model->insert($data1,'orderitem_image'));

                  }

                 // array_push($img_ids,$this->Common_model->insert($data1,'orderitem_image'));

               }

             }

           }

         }

       }

       else

       {

        $error = "Item Not Updated";

      }

      if ($error_conter==0 )  {

       $success = "Item Updated Successfully";

     }else{

      $error = $img_error;

    }


     if(!empty($copyitem_id)) {
      // echo "copyitem_id";exit;
      $itemids = $this->Common_model->getResultArray(array('item_id'=>$copyitem_id),'*','order_item');
        // $itemrow = $this->getitem($copyitem_id,$rowid);
       $itemrow = $this->gettrdata($copyitem_id);
       $html = '<tr id="temp_'.$data['item_location_type'].'" class="old_location" data-loc="'.$data['item_location_type'].'" data-address="'.$address_slug.'"><td class="panel-heading" colspan="7"><span class="locaton_type"><b>Location:  '.$data['item_location_type'].'</b>&nbsp;&nbsp;</span><span class="category"><b>Address:  '.$address_slug.'</b></span></td></tr>';
        echo json_encode(array('success'=>$success,'error'=>$error,'item'=>$copyitem_id ,'location'=>$location_type ,'address'=>$address ,'slug'=>$slug,'rowid'=>$rowid,'updated_data'=>$itemids[0],'body'=>$itemrow,'head'=>$html,'remove_tr'=>true));

     } else {
      // echo "sdfsf";exit;
        $itemids = $this->Common_model->getResultArray(array('item_id'=>$edit_item_id),'*','order_item');
      // $itemrow = $this->getitem($edit_item_id,$rowid);
         $itemrow = $this->gettrdata($edit_item_id);
       $html = '<tr id="temp_'.$data['item_location_type'].'" class="old_location" data-loc="'.$data['item_location_type'].'" data-address="'.$address_slug.'"><td class="panel-heading" colspan="7"><span class="locaton_type"><b>Location:  '.$data['item_location_type'].'</b>&nbsp;&nbsp;</span><span class="category"><b>Address:  '.$address_slug.'</b></span></td></tr>';
      echo json_encode(array('success'=>$success,'error'=>$error,'item'=>$edit_item_id ,'location'=>$location_type,'address'=>$address ,'rowid'=>$rowid,'updated_data'=>$itemids[0],'body'=>$itemrow,'head'=>$html,'remove_tr'=>true));

     }

     // unset($this->session->unset_userdata('copy_orderitem_id'));

    // $itemrow = $this->getitem($edit_item_id,$rowid);



    // echo json_encode(array('success'=>$success,'error'=>$error,'item'=>$edit_item_id ,'rowid'=>$rowid,'tablerow'=>$itemrow));

  }



 // Order Method Stated From here

 //



// Copy aboce method

  public function update_newitem()

  {

        $success=$error='';

        $error_conter = 0;

        $img_error ='';
         if($this->input->post('edit_item_select') == 'Other') {
          // echo "A";exit;
          $data['item_name'] = $this->input->post('edit_item_name');
          $data['item_type'] = $this->input->post('edit_item_select');

        } else {
          // echo "dsfd";exit;
           $data['item_name'] = $this->input->post('edit_item_select');
           $data['item_type'] = 'NULL';
        }

        // $data['item_name'] = $this->input->post('edit_item_name');

        $data['item_price'] = $this->input->post('edit_item_price');

        $data['item_quantity'] = $this->input->post('edit_item_quantity');

        $data['item_description'] = $this->input->post('edit_item_description');

        $data['item_location'] = $this->input->post('edit_item_location');

        $rowid = $this->input->post('row_id');
         $data['item_category'] = $this->input->post('address');
        $data['item_location_type'] = $this->input->post('location_type');
        $copyitem_id = $this->input->post('copyitem_id');

        $order_id = $this->Common_model->getResultArray(array('item_id'=>$copyitem_id),'order_id','order_item');

          $result = $this->Common_model->update($copyitem_id,$data,'order_item','item_id');



        if (!empty($result)) {



          // die($edit_item_id);

          // $item_id = $edit_item_id;

          $img_ids = array();



          if(!empty($_FILES['product_gallery_image1']['name'])){

           for($i=0; $i<count($_FILES['product_gallery_image1']['name']); $i++){

             if (!empty($_FILES['product_gallery_image1']['name'][$i])) {

                       //print_r($_FILES['product_gallery_image']['name'][$i]); exit();

               $_FILES['file']['name'] = $_FILES['product_gallery_image1']['name'][$i];

               $_FILES['file']['type'] = $_FILES['product_gallery_image1']['type'][$i];

               $_FILES['file']['tmp_name'] = $_FILES['product_gallery_image1']['tmp_name'][$i];

               $_FILES['file']['error'] = $_FILES['product_gallery_image1']['error'][$i];

               $_FILES['file']['size'] = $_FILES['product_gallery_image1']['size'][$i];

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

                    $data1['product_id']=$copyitem_id;

                    array_push($img_ids,$this->Common_model->insert($data1,'orderitem_image'));

                 // array_push($img_ids,$this->Common_model->insert($data1,'orderitem_image'));

               }

             }

           }

         }



       }

       else

       {

        $error = "Item Not Updated";

      }

      if ($error_conter==0 )  {

       $success = "Item Updated Successfully";

     }else{

      $error = $img_error;

    }

        $itemrow = $this->getnewitem($copyitem_id,$rowid);

        echo json_encode(array('success'=>$success,'error'=>$error,'item'=>$copyitem_id ,'order_id'=>$order_id[0]['order_id'] ,'rowid'=>$rowid,'tablerow'=>$itemrow));

     // unset($this->session->unset_userdata('copy_orderitem_id'));

    // $itemrow = $this->getitem($edit_item_id,$rowid);



    // echo json_encode(array('success'=>$success,'error'=>$error,'item'=>$edit_item_id ,'rowid'=>$rowid,'tablerow'=>$itemrow));

  }



 /**

  * insert order

  *

  * @return  redirect  reditect to dashboard with status

  */

   public function insertorder()

   {
    $this->load->library('form_validation');

    $this->form_validation->set_rules('requesttitle',"Request Title", 'required|min_length[5]');

    $this->form_validation->set_rules('location',"Address", 'required');

    // $this->form_validation->set_rules('output',"Signature", 'required');

    // $this->form_validation->set_rules('item_name',"Item Name", 'required');

    // $this->form_validation->set_rules('item_price',"Item Price", 'required|numeric');

    // $this->form_validation->set_rules('item_quantity',"Item Quantity", 'required|numeric');

    // $this->form_validation->set_rules('item_description',"Item Description", 'required|min_length[6]');

    $this->form_validation->set_rules('phone',"Phone Number", 'required|min_length[10]');
    if($this->input->post('location') == 'yes') {

      $this->form_validation->set_rules('contact_chk',"Contact Checkbox", 'required');

      $this->form_validation->set_rules('attrny_chk',"Attrony Checkbox", 'required');
    }


    // $this->form_validation->set_rules('contact_output',"Contact Document", 'required');

    // $this->form_validation->set_rules('attrny_output',"Attorny Document", 'required');

    // $this->form_validation->set_rules('output',"Document", 'required');

      if ($this->form_validation->run() == FALSE)

      {
    // echo "dfdsf";exit;

        $error = [];

        $this->error['errors'] = $this->form_validation->error_array();

        $this->load->view('dashboard/header');

        $this->load->view('dashboard/sidebar');

        $this->load->view('dashboard/placeorder',$this->error);

        $this->load->view('dashboard/footer');

      } else {

    // echo "dasdsadsdsadsad";exit;
      $data['created_by'] = $this->session->userdata('id');

      $data['request_title'] = $this->input->post('requesttitle');

      $data['location']=$this->input->post('location');
      $data['phone']=$this->input->post('phone');

      $sigdata = $this->input->post('output');



      $contact_output = $this->input->post('contact_output');

      $data['contact_chk'] = $this->input->post('contact_chk');



      $data['attrny_chk'] = $this->input->post('attrny_chk');

      $attrny_output = $this->input->post('attrny_output');



      $itemids = $this->input->post('item_ids');
      // echo "<pre>";
      // print_r ($itemids);
      // echo "</pre>";exit;

      // echo "<pre>";

      // print_r ($itemids);

      // echo "</pre>";exit;

      // $id = uniqid();

      // $data['signature'] = $id .'.jpeg';

      // CUSTOM::sigJsonToImage($sigdata,FILE_PATH."upload/signatures/".$id.".jpeg");


      $con_id = uniqid();

      $data['signature_contact'] = $con_id .'.jpeg';

      CUSTOM::sigJsonToImage($contact_output,FCPATH."upload/signatures/".$con_id.".jpeg");

      // echo $con_id;exit;

      $attr_id = uniqid();

      $data['signature_attorney'] = $attr_id .'.jpeg';

      CUSTOM::sigJsonToImage($attrny_output,FILE_PATH."upload/signatures/".$attr_id.".jpeg");



      $order_id = $this->Common_model->insert($data,'order_master');



      if ($order_id) {

        try {

          $data = array("order_id"=>$order_id);

          $result = $this->Common_model->update_in($itemids,$data,'order_item','item_id');





          $this->session->set_flashdata("message","Please arrange a time with the Ruv to complete the sale. </br> Thank you");

          redirect('vieworder');

        } catch (Exception $e) {

          $error = $e->getMessage();

          $this->session->set_flashdata("error",$error);

          redirect('vieworder');

        }

      }

      else

      {

        $this->session->set_flashdata("error","Error In Creation Of Order.");

        redirect('vieworder');

      }

    }

  }



    /**

     * view order

     *

     * @return  view load orderlist view

     */

    public function vieworder()

    {

      $this->load->view('dashboard/header');

      $this->load->view('dashboard/sidebar');

       $data['year'] = $this->Common_model->getyear();
      $this->load->view('dashboard/orderlist',$data);

      $this->load->view('dashboard/footer');

    }



  /**

   * place or create order

   *

   * @return  view  redirect place oreder page

   */

  public function placeorder()

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
    $userid = $this->session->userdata('id');
    $user = $this->Common_model->getDatabyId($userid,'registration','id');
    $data['contract'] = $user->contract;


    $this->load->view('dashboard/header');

    $this->load->view('dashboard/sidebar');

    $this->load->view('dashboard/placeorder',$data);

    $this->load->view('dashboard/footer');

  }



  /**

   * load oreder

   *

   * @return  datatable  datatable of all order

   */

  public function loadorder()

  {

    $this->load->helper('ssp');

    $user_id = $this->session->userdata('id');

    $columns = array();

    $table = 'order_master';

    $primaryKey = 'ord_id';



    $where= "";

    $joinQuery='';



    $columns[0] = array('db' => 'ord_id', 'dt' => 0, 'field' => 'id');
    $columns[1] = array('db' => 'request_title', 'dt' => 1, 'field' => 'request_title');
    $columns[2] = array('db' => 'location', 'dt' => 2, 'field' => 'location');
    // $columns[2] = array('db' => 'signature', 'dt' => 2, 'field' => 'signature');
    $columns[3] = array('db' => 'ord_id', 'dt' =>3, 'field' => 'ord_id' ,'formatter' => function ($d, $row) {
      $data_count = $this->Common_model->getResultArray(array("order_id"=>$row[0]),"item_id","order_item");
      return count($data_count);
    });

    $columns[4] = array('db' => 'status', 'dt' => 4, 'field' => 'status','formatter'=>function($d,$row){
      if ($this->is_admin==1) {

       $action = '<select class="form-control status" name="status" id="order_status_'.$row[3].'" >';
       if($d == 0){
        $action.="<option value=0 selected>New</option>";
      }
      else{
        $action.="<option value=0>New</option>";
      }

      if($d ==1){
        $action.="<option value=1 selected>Pending</option>";
      }
      else{
        $action.="<option value=1>Pending</option>";
      }
      if($d == 2){
        $action.="<option value=2 selected>Done</option>";
      }
      else{
        $action.="<option value=2>Done</option>";
      }
      if($d == 3){
        $action.="<option value=3 selected>Rejected</option></select>";
      }
      else{
        $action.="<option value=3>Rejected</option></select>";
      }
      return $action;
    }
    else
    {
      if($d == 0){
        return "New";
      }
      elseif($d ==1){
        return "Pending";
      }
      elseif($d == 2){
        return "Done";
      }
      elseif($d == 3){
        return "Rejected";
      }
    }
  });

    // $columns[5] = array('db' => 'status', 'dt' =>5, 'field' => 'ord_id' ,'formatter' => function ($d, $row) {
    //   $data_count = "<span class='label label-success'>Success Label</span>";
    //   return $data_count;
    // });

    $columns[5] = array('db' => 'ord_id', 'dt' =>5, 'field' => 'ord_id' ,'formatter' => function ($d, $row) {
      $base_64 = base64_encode($row[5]);
      $url_param = rtrim($base_64, '=');
      $style = ($row[4] == 0) ? "display:initial" : "display:none" ;
      $action = '<a  class="btn btn-danger delete_order" href="'.base_url('/Dashboard_Controller/deleteorder/'.$row[5]).'" title="Delete Order"><i class="
fa fa-trash"></i></a><a  class="btn btn-info copy_order" href="'.base_url('/Dashboard_Controller/copyorder/'.$url_param).'" title="Copy Order" ><i class="fa fa-paste" data-id="'.$row[5].'"></i></a><a  class="btn btn-primary " target="_blank" href="'.base_url('/Dashboard_Controller/printorder/'.$row[5]).'" title="Print Order" ><i class="fa fa-print" data-id="'.$row[5].'"></i></a><a target="_blank" class="btn btn-success" href="'.base_url('viewfullorder/'.$row[5]).'" title="View Order"><i class="fa fa-eye"></i></a><a target="_blank" class="btn btn-success" href="'.base_url('edit/'.$row[5]).'" title="Edit Order" style="'.$style.'"><i class="fa fa-pencil"></i></a>';

      return $action;
    });



     $chk_sts = 0;
    if($this->is_admin!=1){
      $chk_sts = 1;

      $where .="created_by = ".$user_id;

    }
    // echo $where;exit;
    // echo $_GET['order_status'];exit;
    if (isset($_GET['order_status'])) {
        if($_GET['order_status'] != -1){
            if($chk_sts != 1) {
                $where .= "status = "."'".$_GET['order_status']."'";
            } else {
                $where .= "AND status = ".$_GET['order_status'];
            }
          }
        }

         if(isset($_GET['order_year'])) {
           if($_GET['order_status'] != -1){
            $where .= "year(created_date) = "."'".$_GET['order_year']."'";
           }
        }
        // echo $where;exit;

    echo json_encode(

      SSP::simple($_GET, $table, $primaryKey, $columns, $joinQuery, $where, $searchFilter)

    );



  }



  /**

   * delete order

   *

   * @param   id  $id  get id to delete the order

   *

   * @return  view    redirect to vieworder with staus

   */

  public function deleteorder($id)

  {

    if($id)

    {

      $itemids = $this->Common_model->getResultArray(array('order_id'=>$id),'item_id','order_item');



      foreach ($itemids as $item) {



       $item_id = $item['item_id'];

       $deleted_item  =  $this->Common_model->delete($item_id,'item_id','order_item');

       $imgs = $this->Common_model->getResultArray(array('product_id'=>$item_id),'img_name','orderitem_image');

       foreach ($imgs as $img) {

         unlink('upload/Product/'.$img['img_name']);

       }

       $deleted_img = $this->Common_model->delete($item_id,'product_id','orderitem_image');

     }



     $deleted_order = $this->Common_model->delete($id,'ord_id','order_master');



     if($deleted_item && $deleted_img && $deleted_order)

     {

       $this->session->set_flashdata("message","Order Deleted Successfully.");

       redirect('vieworder');

     }

     else

     {

       $this->session->set_flashdata("error","Unable to Delete Order.");

       redirect('vieworder');

     }



   }

 }


public function delete_copyorder($id)  {

    if($id)  {

      $itemids = $this->Common_model->getResultArray(array('order_id'=>$id),'item_id','order_item');



      foreach ($itemids as $item) {



       $item_id = $item['item_id'];

       $deleted_item  =  $this->Common_model->delete($item_id,'item_id','order_item');

       $imgs = $this->Common_model->getResultArray(array('product_id'=>$item_id),'img_name','orderitem_image');

       foreach ($imgs as $img) {

         unlink('upload/Product/'.$img['img_name']);

       }

       $deleted_img = $this->Common_model->delete($item_id,'product_id','orderitem_image');

     }



     $deleted_order = $this->Common_model->delete($id,'ord_id','order_master');



     if($deleted_item && $deleted_img && $deleted_order)

     {

       $this->session->set_flashdata("message","Copy Order Cancelled.");

       redirect('vieworder');

     }

     else

     {

       $this->session->set_flashdata("error","Unable to Delete Order.");

       redirect('vieworder');

     }



   }

 }


  /**

   * view full order

   *

   * @param   id  $id  get order id to fetch full information

   *

   * @return  view       redirect to vieworder page with order data

   */

  public function viewfullorder($id)

  {

   $address = $this->Common_model->item_address($id);
     $small = array();
     $explode =  array();
     $i =0;
     $small['order'] = $this->Common_model->getResultArray(array('ord_id'=>$id),'*','order_master');
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
        $item_detail = $this->Common_model->wherein_item_location($value['address'],$value['location_type'],$id);
    // echo $this->db->last_query();exit;
        $image_data= array();
          foreach ($item_detail as $key => $val) {
              $item_image = $this->Common_model->wherein_img($val['item_id']);
              $val['image'] = $item_image;
              $image_data[] = $val;
          }
        $small['items'][$value['address']][$value['location_type']] = $image_data;
     }
     $userid = $this->session->userdata('id');
    $user = $this->Common_model->getDatabyId($userid,'registration','id');
    $small['contract'] = $user->contract;
   /* echo "<pre>";
    print_r ($small);
    echo "</pre>";exit;*/
    // 1081 East 29th Street Brooklyn NY 11210
    // $final_data['order'] = $order[0];

    // $final_data['items']  = $data;

    // $final_data['item_image']  = $item_image;



    $this->load->view('dashboard/header');

    $this->load->view('dashboard/sidebar');

    $this->load->view('dashboard/vieworder',$small);

    $this->load->view('dashboard/footer');





  }



// Other methods



/**

 * update status

 *

 * @return  json  return status of order status update

 */

  public function updatestatus()

  {





    $success = $error = "";



    $orderid = $this->input->post('order_id');

    $status = $this->input->post('status');



    $orderid = str_replace("order_status_", "",$orderid);



    if ($orderid!="" && $status!="") {

      $data['status']=$this->input->post('status');



      $result = $this->Common_model->update($orderid,$data,'order_master','ord_id');



      if ($result) {

        $success = "Status Change Successfully";

      }

      else

      {

        $error ="Something Went Wrong";

      }

    }



    echo json_encode(array('success'=>$success,'error'=>$error));

  }



  public function deleteimage()

  {

    $success = $error = "";

    try {

      $img_id = $this->input->post('imgid');

      $newimage_id = $this->input->post('newimage_id');

      $img_name = $this->input->post('imgname');

      if( !empty($newimage_id)) {



      $deleted_img = $this->Common_model->delete($newimage_id,'img_id','orderitem_image');

    } else  {

         $deleted_img = $this->Common_model->delete($img_id,'img_id','orderitem_image');

    }

      unlink('upload/Product/'.$img_name);

      $success =  "Image Deleted Successfully";



    } catch (Exception $e) {

      $error = $e->getMessage();

    }

    echo json_encode(array('success'=>$success,'error'=>$error));

  }



  public function copyorder($id)

  {

    $base_64 = $id . str_repeat('=', strlen($id) % 4);

    $id = base64_decode($base_64);

    // $order = $this->Common_model->getResultArray(array('ord_id'=>$id),'*','order_master');

    $order_data = $this->Common_model->getResultArray(array('ord_id'=>$id),'*','order_master');

    $order_items = $this->Common_model->getResultArray(array('order_id'=>$id),'*','order_item');



  /* ORDER MASTER*/

    $new_order = array();

    $new_order['request_title'] = $order_data[0]['request_title'];

    $new_order['location'] = $order_data[0]['location'];

    $new_order['phone'] = $order_data[0]['phone'];

    $new_order['status'] = '0';

    $new_order['created_by'] = $this->session->userdata('id');

    $result = $this->Common_model->insert($new_order,'order_master');

  /* ORDER MASTER*/



  /* ORDER ITEMS AND ORDER IMAGES*/



    $cid = array();

    $image_id = array();

    foreach ($order_items as $key => $value) {

      $copy['order_id'] = $result;

      $copy['item_name'] = $value['item_name'];

      $copy['item_description'] = $value['item_description'];

      $copy['item_location'] = $value['item_location'];

      $copy['item_price'] = $value['item_price'];

      $copy['item_quantity'] = $value['item_quantity'];

      $copy['created_by'] = $value['created_by'];

      $copy['item_category'] = $value['item_category'];
     $copy['item_location_type'] = $value['item_location_type'];
    // exit;

      $result_item = $this->Common_model->insert($copy,'order_item');

      array_push($cid, $result_item);

      $imgs = $this->Common_model->getResultArray(array('product_id'=>$value['item_id']),'*','orderitem_image');

     foreach ($imgs as $k => $copy_img) {

      $fileExt = pathinfo($copy_img['img_name'], PATHINFO_EXTENSION);

      // $img_newname = $k.$copy_img['img_name'].".".$fileExt;

      $img_newname = rand().$copy_img['img_name'];
      // echo FCPATH;exit;
      $exist_path = FCPATH."upload/Product/".$copy_img['img_name'];
      $new_path = FCPATH."upload/Product/".$img_newname;
      copy($exist_path,$new_path);
      $duplicate_image['img_name'] = $img_newname;

      $duplicate_image['product_id'] = $result_item;

      $result_image = $this->Common_model->insert($duplicate_image,'orderitem_image');

      array_push($image_id, $result_image);

     }

    }

    // exit;

    /* ORDER ITEMS AND ORDER IMAGES*/

      $this->session->set_userdata('copy_orderitem_id',$cid);

      $this->session->set_userdata('newimage_id',$image_id);

      $this->session->set_userdata('copy_ordermaster_id',$result);

      redirect('duplicate_order/'.$id,'refresh');

  }



  public function duplicate_order($id)

  {

    // $base_64 = $id . str_repeat('=', strlen($id) % 4);

    // $id = base64_decode($base_64);

    // $order = $this->Common_model->getResultArray(array('ord_id'=>$id),'*','order_master');
$address = $this->Common_model->item_address($id);
     $small = array();
     $explode =  array();
     $i =0;
     $small['order'] = $this->Common_model->getResultArray(array('ord_id'=>$id),'*','order_master');
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
        $item_detail = $this->Common_model->wherein_item_location($value['address'],$value['location_type'],$id);
        $image_data= array();
          foreach ($item_detail as $key => $val) {
              $item_image = $this->Common_model->wherein_img($val['item_id']);
              $val['image'] = $item_image;
              $image_data[] = $val;
          }
        $small['items'][$value['address']][$value['location_type']] = $image_data;
     }

    $userid = $this->session->userdata('id');
    $user = $this->Common_model->getDatabyId($userid,'registration','id');
    $small['contract'] = $user->contract;

    // $small['order'] = $order[0];

    $this->load->view('dashboard/header');

    $this->load->view('dashboard/sidebar');

    $this->load->view('dashboard/copyorder',$small);

    $this->load->view('dashboard/footer');





  }





   public function updateordermaster($copy_id)

   {

    $userid = $this->session->userdata('id');
    $user = $this->Common_model->getDatabyId($userid,'registration','id');
     $this->load->library('form_validation');

    $this->form_validation->set_rules('requesttitle',"Request Title", 'required|min_length[5]');
    $this->form_validation->set_rules('location',"Location", 'required');

    if($user->contract == 'yes') {

      $this->form_validation->set_rules('contact_chk',"Contact Checkbox", 'required');
      $this->form_validation->set_rules('attrny_chk',"Attrony Checkbox", 'required');

    }

    // $this->form_validation->set_rules('contact_output',"Contact Document", 'required');

    // $this->form_validation->set_rules('attrny_output',"Attorny Document", 'required');

    // $this->form_validation->set_rules('output',"Document", 'required');

      if ($this->form_validation->run() == FALSE)

      {
        $address = $this->Common_model->item_address($copy_id);
     $small = array();
     $explode =  array();
     $i =0;
     $small['order'] = $this->Common_model->getResultArray(array('ord_id'=>$copy_id),'*','order_master');
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
        $item_detail = $this->Common_model->wherein_item_location($value['address'],$value['location_type'],$copy_id);
        $image_data= array();
          foreach ($item_detail as $key => $val) {
              $item_image = $this->Common_model->wherein_img($val['item_id']);
              $val['image'] = $item_image;
              $image_data[] = $val;
          }
        $small['items'][$value['address']][$value['location_type']] = $image_data;
     }


        $small['errors'] = $this->form_validation->error_array();

        $this->load->view('dashboard/header');

        $this->load->view('dashboard/sidebar');

        $this->load->view('dashboard/copyorder',$small);

        $this->load->view('dashboard/footer');

      } else {

      $data['created_by'] = $this->session->userdata('id');

      $data['request_title'] = $this->input->post('requesttitle');

      $data['location']=$this->input->post('location');

      // $sigdata = $this->input->post('output');



      $contact_output = $this->input->post('contact_output');

      $data['contact_chk'] = $this->input->post('contact_chk');



      $data['attrny_chk'] = $this->input->post('attrny_chk');

      // $attrny_output = $this->input->post('attrny_output');

      // $itemids = $this->input->post('item_ids');

     /* $id = uniqid();

      $data['signature'] = $id .'.jpeg';

      CUSTOM::sigJsonToImage($sigdata,FILE_PATH."upload/signatures/".$id.".jpeg");*/



      $con_id = uniqid();

      $data['signature_contact'] = $con_id .'.jpeg';

      CUSTOM::sigJsonToImage($contact_output,FCPATH."upload/signatures/".$con_id.".jpeg");



      // $attr_id = uniqid();

      // $data['signature_attorney'] = $attr_id .'.jpeg';

      // CUSTOM::sigJsonToImage($attrny_output,FILE_PATH."upload/signatures/".$attr_id.".jpeg");



      $result = $this->Common_model->update($copy_id,$data,'order_master','ord_id');



      if ($result) {

          $this->session->set_flashdata("message","Order Created Successfully.");

          redirect('vieworder');

        }

      else

      {

        $this->session->set_flashdata("error","Error In Creation Of Order.");

        redirect('vieworder');

      }

    }

  }

  public function update_edit_order($id){

     $this->load->library('form_validation');

    $this->form_validation->set_rules('requesttitle',"Request Title", 'required|min_length[5]');

    $this->form_validation->set_rules('location',"Location", 'required');

    $this->form_validation->set_rules('contact_chk',"Contact Checkbox", 'required');

    $this->form_validation->set_rules('attrny_chk',"Attrony Checkbox", 'required');

    // $this->form_validation->set_rules('contact_output',"Contact Document", 'required');

    // $this->form_validation->set_rules('attrny_output',"Attorny Document", 'required');

    // $this->form_validation->set_rules('output',"Document", 'required');

      if ($this->form_validation->run() == FALSE)

      {
        $address = $this->Common_model->item_address($id);
     $small = array();
     $explode =  array();
     $i =0;
     $small['order'] = $this->Common_model->getResultArray(array('ord_id'=>$id),'*','order_master');
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
        $item_detail = $this->Common_model->wherein_item_location($value['address'],$value['location_type'],$id);
        $image_data= array();
          foreach ($item_detail as $key => $val) {
              $item_image = $this->Common_model->wherein_img($val['item_id']);
              $val['image'] = $item_image;
              $image_data[] = $val;
          }
        $small['items'][$value['address']][$value['location_type']] = $image_data;
     }
       $small['errors'] = $this->form_validation->error_array();

        $this->load->view('dashboard/header');

        $this->load->view('dashboard/sidebar');

        $this->load->view('dashboard/edit_order',$small);

        $this->load->view('dashboard/footer');

      } else {

      $data['created_by'] = $this->session->userdata('id');

      $data['request_title'] = $this->input->post('requesttitle');

      $data['location']=$this->input->post('location');

      $sigdata = $this->input->post('output');



      $contact_output = $this->input->post('contact_output');

      $data['contact_chk'] = $this->input->post('contact_chk');



      $data['attrny_chk'] = $this->input->post('attrny_chk');

      $attrny_output = $this->input->post('attrny_output');

      // $itemids = $this->input->post('item_ids');

     /* $id = uniqid();

      $data['signature'] = $id .'.jpeg';

      CUSTOM::sigJsonToImage($sigdata,FILE_PATH."upload/signatures/".$id.".jpeg");*/



      $con_id = uniqid();

      $data['signature_contact'] = $con_id .'.jpeg';

      CUSTOM::sigJsonToImage($contact_output,FCPATH."upload/signatures/".$con_id.".jpeg");



      // $attr_id = uniqid();

      // $data['signature_attorney'] = $attr_id .'.jpeg';

      // CUSTOM::sigJsonToImage($attrny_output,FILE_PATH."upload/signatures/".$attr_id.".jpeg");

      $result = $this->Common_model->update($id,$data,'order_master','ord_id');

      if ($result) {

          $this->session->set_flashdata("message","Order Created Successfully.");

          redirect('vieworder');

        }
      else
      {

        $this->session->set_flashdata("error","Error In Creation Of Order.");

        redirect('vieworder');

      }

    }
  }


  public function printorder($id) {

    $address = $this->Common_model->item_address($id);
     $small = array();
     $price = array();
     $small['order'] = $this->Common_model->getResultArray(array('ord_id'=>$id),'*','order_master');
     $order = $this->Common_model->getResultArray(array('ord_id'=>$id),'*','order_master');
     $explode =  array();
     $i =0;
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
        $item_detail = $this->Common_model->wherein_item_location($value['address'],$value['location_type'],$id);
        $image_data= array();
          foreach ($item_detail as $key => $val) {
              array_push($price, $val['item_price']);
              $item_image = $this->Common_model->wherein_img($val['item_id']);
              $val['image'] = $item_image;
              $image_data[] = $val;
          }
        $small['items'][$value['address']][$value['location_type']] = $image_data;
     }
     $small['price'] = $price;
     $mpdf = new \Mpdf\Mpdf([
          'mode' => 'utf-8',
          'format' => [190, 236],
          'orientation' => 'p'
      ]);
     $stylesheet = file_get_contents('https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css');
        $html = $this->load->view('dashboard/mpdf',$small,true);
        // echo $html; exit;
        $mpdf->SetHTMLFooter('<p>sign:<img src="upload/signatures/'.$order[0]['signature_contact'].'" width="200px" style="border-bottom: 2px solid #333;"></p>');
        // $mpdf->SetHTMLFooter('<img src="upload/signatures/'.$order[0]['signature_contact'].'">');
        $mpdf->WriteHTML($html);
        $mpdf->Output(); // opens in browser
    // $this->load->library('pdf');

    // $html = $this->load->view('dashboard/invoice.php', $data, true);
    // $this->pdf->createPDF($html, 'pdf', false, 'A4', 'portrait',array ("Attachment" => false));

  }

  public function powerofattony() {
    $data = [];
    $order = $this->Common_model->getsign();
    $data['order'] = array_column($order, "signature_contact");
    $this->load->library('pdf');
    $html = $this->load->view('dashboard/powerofattony.php', $data, true);
    $this->pdf->createPDF($html, 'Power-of-attony'.strtotime('now'), false, 'A4', 'portrait');
   }

   public function userlisting() {
    $data = [];
    $data['user'] = $this->Common_model->getAllDatabyId('registration','is_admin','0');
    $this->load->view('dashboard/header');
    $this->load->view('dashboard/sidebar');
    $this->load->view('dashboard/userlist',$data);
    $this->load->view('dashboard/footer');
  }

   public function update_user_contract() {
     $data = [];
     $data['contract'] = $this->input->post('contract_val');
     $userid = $this->input->post('userid');
     if($data != '' && $userid != '') {
        $result = $this->Common_model->update($userid,$data,'registration','id');
        // echo $this->db->last_query();exit;
     }
     if($result) {
        $success = "User Updated Successfully";
        echo json_encode(array('success'=>$success,'error'=>$error,'userid'=>$userid ,'Contract Status'=>$data['contract']));
     }else {
        $error = "User not Updated";
        echo json_encode(array('success'=>$success,'error'=>$error,'userid'=>$userid ,'Contract Status'=>$data['contract']));
     }

  }


  public function editorder($id) {
    $address = $this->Common_model->item_address($id);
     $small = array();
     $explode =  array();
     $i =0;
     $small['order'] = $this->Common_model->getResultArray(array('ord_id'=>$id),'*','order_master');
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
        $item_detail = $this->Common_model->wherein_item_location($value['address'],$value['location_type'],$id);
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
    $this->load->view('dashboard/header');
    $this->load->view('dashboard/sidebar');
    $this->load->view('dashboard/edit_order',$small);
    $this->load->view('dashboard/footer');
  }

// old dompdf function
 /* public function printorder($id) {


    $data['item'] = $this->Common_model->getResultArray(array('order_id'=>$id),'*','order_item');

    $data['order'] = $this->Common_model->getResultArray(array('ord_id'=>$id),'*','order_master');

    $data['location'] = $this->Common_model->distinct($id);

    foreach ($data['item'] as $key => $value) {

      // echo $value['item_id'];

       // $data['img'][] = $this->Common_model->getResultArray(array('product_id'=>$value['item_id']),'*','orderitem_image');

       $img[$value['item_name']] = $this->Common_model->getResultArray(array('product_id'=>$value['item_id']),'*','orderitem_image');

    }


     $data['img'] = $img;


    $this->load->library('pdf');

    $html = $this->load->view('dashboard/invoice.php', $data, true);
    $this->pdf->createPDF($html, 'pdf', false, 'A4', 'portrait',array ("Attachment" => false));

  }*/

}





/* End of file Dashboard_Controller.php */

/* Location: ./application/controllers/Dashboard_Controller.php */