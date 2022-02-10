<?php

    /*echo "<pre>";

    print_r($order);

    print_r ($items);

    echo "</pre>";

    exit;*/

 ?>
<head>
<link rel="stylesheet" type="text/css" href="<?= base_url()?>/assets/pages/css/lightbox.css">
  <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
</head>

<div class="page-content-wrapper" data-bind="vieworder-active-page-link">

    <div class="page-content">

         <div id="result_message" style="display: none;"></div>

        <?php if ($this->session->flashdata('message')) {?>

        <div id="result" style="display: none;"></div>

        <?php } else if ($this->session->flashdata('error')) {?>

        <div id="result_error" style="display: none;"></div>

        <?php } else {}?>

        <h1 class="page-title"> This is Your Order  <?=$this->session->userdata('name'); ?> </h1> <a style="float: right;" href="<?= base_url('vieworder') ?>" class="btn btn-success"> <i class="fa fa-arrow-left"></i> Back</a>

        <div class="clearfix"></div>

        <div class="row">

            <div class="col-lg-12 ">

                <form action="<?= base_url('') ?>" id="" method="post" enctype="multipart/form-data" >



                    <div class="row">

                        <div class="form-group col-md-4">

                        <label>Full Name </label>

                        <input type="text" name="requesttitle" id="request_title" class="form-control" value="<?= $order[0]['request_title']?>" disabled>

                    </div>


                     <div class="form-group col-md-4">

                        <label>Phone </label>

                        <input type="text" name="phone" id="phone" class="form-control" value="<?= $order[0]['phone']?>" disabled>

                    </div>

                    <div class="form-group col-md-4">

                        <label>Location </label>

                        <input type="text" name="location"  id="request_location" class="form-control" value="<?= $order[0]['location'] ?>"  disabled>

                    </div>

                    </div>

                    <div class="portlet box green">

                        <div class="portlet-title">

                            <div class="caption">

                            Items </div>

                        </div>

                        <div class="portlet-body">

                            <div>

                                <div class="row">

                                    <div class="col-md-12" style="margin-top: 10px;">

                                        <table class="table table-striped table-bordered display-attribute">

                                            <thead>

                                                <tr>

                                                    <!-- <th style="text-align: center;background-color: #eee;">No</th> -->

                                                    <th style="text-align: center;background-color: #eee;">Item Name</th>

                                                    <th style="text-align: center;background-color: #eee;">Item Price</th>

                                                    <th style="text-align: center;background-color: #eee;">Item Quantity</th>

                                                    <th style="text-align: center;background-color: #eee;">Item gallery</th>

                                                    <th style="text-align: center;background-color: #eee;">Location</th>

                                                    <!-- <th style="text-align: center;background-color: #eee;">Location Description</th> -->

                                                </tr>

                                            </thead>

                                            <tbody class="attribute_data">

                                                <?php $temp_id=0; foreach ($items as $item_id => $itm_value) { ?>

                                                    <?php foreach ($itm_value as $as => $com_value) { 
                                                         if($as == "PM") { 
                                                            $loc = "Primary Home"; 
                                                          } elseif($as == "VH"){
                                                            $loc = "Vacation Home";
                                                          } elseif($as == "OFC" ) { 
                                                            $loc = "Office"; 
                                                         } elseif($as == "OTHER" ) { 
                                                            $loc = 'other';
                                                          } else {
                                                            $loc = '';
                                                          }   ?>

                                                    <tr id="temp_<?= $as; ?>">

                                                        <td class="panel-heading" colspan="7"><b>Location: &nbsp;<?= $item_id ?>&nbsp;&nbsp;Address: <?= $loc; ?></b></td>

                                                    </tr>

                                                 <?php  foreach ($com_value as $key => $loc) { 
                                                        if($loc['disable-location'] == 1) { ?>
                                                             <tr>
                                                                <td width="" style="text-align:center" colspan="6">
                                                                  <p>Entire Location and all chometz on premises</p>
                                                                </td>
                                                            </tr>
                                                         <?php } else { ?>
                                                    <tr>

                                                    <td width="" style="text-align:center">

                                                        <div class="form-group form-md-line-input form-md-floating-label"><?=$loc['item_name']  ?></div>

                                                    </td>

                                                    <td  width="" style="text-align:center">

                                                        <div class="form-group form-md-line-input form-md-floating-label"><?=

                                                         "$ ". number_format($loc['item_price'],2); ?></div>

                                                    </td>

                                                    <td  width="" style="text-align:center">

                                                        <div class="form-group form-md-line-input form-md-floating-label"><?=$loc['item_quantity'] ?></div>

                                                    </td>

                                                    <td  width="" style="text-align:center">
                                                        <div class="imageContainer clearfix single">
                                                        <?php foreach ($loc['image'] as $img): ?>
                                                             <a class="imageLink" href="<?= base_url().'upload/Product/'.$img['img_name'] ?>?raw=<?= $temp_id ?>" >
                                                             <img class="" src="<?= base_url().'upload/Product/'.$img['img_name'] ?>?raw=<?= $temp_id ?>" width="80px" height="80px">
                                                            </a>
                                                          <!--   <div class="single">

                                                                <img class="prev" src="<?= base_url().'upload/Product/'.$img['img_name'] ?>"  style="height:70px; width:70px;" alt="No Image">

                                                            </div>
 -->
                                                        <?php endforeach; ?>
                                                    </div>
                                                    </td>

                                                     <td width="" style="text-align:center">

                                                        <div class="form-group form-md-line-input form-md-floating-label"><?=$loc['item_location']  ?></div>

                                                    </td>

                                                   <!--  <td  width="" style="text-align:center">

                                                        <div class="form-group form-md-line-input form-md-floating-label" style="padding: 0px; border: 0px "><textarea readonly rows="5" cols="35"><?= wordwrap($item['item_description'],40,"\n",true); ?></textarea></div>

                                                    </td> -->

                                                </tr>

                                               <?php } $temp_id++; } } } ?>

                                            </tbody>

                                        </table>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
                      <?php if($this->session->userdata('is_admin') == 1 || $contract == 'yes') {
                      if($order[0]['contact_chk'] == 1 && $order[0]['signature_contact'] != '') { ?>

                    <div class="portlet box col-md-6">

                        <div class="body-border">

                            <h4>Contract Aggrement</h4>

                        </div>

                            <div class="row">

                                <div class="col-6">

                                    <div class="col-md-12">

                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>

                                    </div>

                                    <div class="col-md-12">

                                        <div class="form-check">

                                            <input class="form-check-input" type="checkbox" id="defaultCheck1" name="contact_chk" value="1" <?php  if($order['contact_chk'] == 1) { echo "checked='checked'";} ?>>

                                            <label class="form-check-label" for="defaultCheck1">

                                            Check to accept and sigin below

                                            </label>

                                        </div>

                                    </div>

                                    <div class="col-md-12">

                                        <h5>Signature</h5>

                                         <div class="col-md-6" style="border:1px solid #36c6d3; width: auto;">

                                         <img src="<?= base_url().'upload/signatures/'.$order['signature_contact'] ?>" height="100" width="400" alt="No Image"style="padding: 10px;">

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                          <div class="portlet box col-md-6">

                        <div class="body-border">

                            <h4>Power of Attorney Aggrement</h4>

                        </div>

                            <div class="row">

                                <div class="col-md-12">

                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>

                                    </div>

                                <div class="col-md-12">

                                    <div class="form-check">

                                        <input class="form-check-input" type="checkbox" id="defaultCheck2" name="attrny_chk" value="1" <?php  if($order['attrny_chk'] == 1) { echo "checked='checked'";} ?> >

                                        <label class="form-check-label" for="defaultCheck2">

                                       Check to accept and sigin below

                                        </label>

                                    </div>

                                </div>

                                <div class="col-md-12">

                                    <h5>Signature</h5>

                                     <div class="col-md-6" style="border:1px solid #36c6d3; width: auto;">

                                    <img src="<?= base_url().'upload/signatures/'.$order['signature_attorney'] ?>" height="100" width="400" alt="No Image"style="padding: 10px;">

                                    </div>

                                </div>

                            </div>

                        </div>
                    <?php } } ?>
                       <!--  <div class="col-6">

                    <div class="form-group col-12">

                        <h5>Signature</h5>

                        <div class="col-md-6" style="border:1px solid #36c6d3; width: auto;">

                        <img src="<?= base_url().'upload/signatures/'.$order['signature'] ?>" height="100" width="400" alt="No Image"style="padding: 10px;">

                        </div>

                    </div>

                </div> -->

            <input type="hidden" name="user_id" value="<?= $this->session->userdata('id'); ?>">

        </form>

    </div>

</div>

</div>

<!-- END CONTENT BODY -->

</div>

<!-- END CONTENT -->

<!-- BEGIN QUICK SIDEBAR -->

</div>
<div class="overlayContainer">

    <div class="imageBox">
      <div class="relativeContainer">
        <img class="largeImage" src="" alt="">
        <p class="imageCaption"></p>
      </div>  <!-- /relativeContainer -->
    </div>  <!-- /imageBox -->

  </div>  <!-- overlayContainer -->
<!-- END CONTAINER -- >



<!-- </section>  /galleryWrapper -->
<script type="text/javascript">
    (function() {

  let overlay = document.querySelector('.overlayContainer'),
      largeImage = document.querySelector('.largeImage');

  const hideOverlay = () => {
    overlay.removeEventListener('click', hideOverlay, false);
    overlay.classList.remove('opacity');

    setTimeout(function() {
      largeImage.removeAttribute('src');
      largeImage.removeAttribute('alt');
      overlay.classList.remove('display');
    }, 400);
  }

  function lightbox(event) {
    const caption = document.querySelector('.imageCaption');
    let href, alt;

    event.preventDefault();
    href = this.getAttribute('href');
    alt = this.children[0].getAttribute('alt');

    largeImage.setAttribute('src', href);
    largeImage.setAttribute('alt', alt);
    caption.innerHTML = alt;
    overlay.classList.add('display');

    setTimeout(function() { overlay.classList.add('opacity'); }, 25);
    setTimeout(function() { overlay.addEventListener('click', hideOverlay, false); }, 400);
  }

  /***Event Listener***/
  const runCode = () => {
    const image = document.querySelectorAll('.imageLink');
    if ( image ) {
      for ( var i = 0; i < image.length; i++ ) {
        image[i].addEventListener('click', lightbox, false);
      }
    }
  }

  runCode();

})();

</script>