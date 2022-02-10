<?php

    $getdata = $this->session->userdata('copy_orderitem_id');

    $orderitem = $this->session->userdata('copy_ordermaster_id');

    $getimage = $this->session->userdata('newimage_id');
 ?>
<link rel="stylesheet" type="text/css" href="<?= base_url()?>/assets/pages/css/lightbox.css">
<div class="page-content-wrapper" data-bind="vieworder-active-page-link">

    <div class="page-content">

         <div id="result_message" style="display: none;"></div>

        <?php if ($this->session->flashdata('message')) {?>

        <div id="result" style="display: none;"></div>

        <?php } else if ($this->session->flashdata('error')) {?>

        <div id="result_error_message" style="display: none;"></div>

        <?php } else {} //echo "<pre>"; print_r($result);exit;?>

        <h1 class="page-title"> This is Your Order  <?=$this->session->userdata('name'); ?> </h1> <a style="float: right;" href="<?= base_url('vieworder') ?>" class="btn btn-success"> <i class="fa fa-arrow-left"></i> Back</a>

        <div class="clearfix"></div>

        <div class="row">

            <div class="col-lg-12 ">

                <form action="<?= base_url('update_edit_order/'.$order[0]['ord_id']) ?>" id="new_order_form" method="post" enctype="multipart/form-data" >
                    <div class="row">

                        <div class="form-group col-md-4">

                        <label>Full Name </label>
                         <input type="hidden" name="contract_sts" id="contract_sts" value="<?= $contract ?>">
                         <input type="hidden" name="mian_order_id" id="main_order_id" value="<?= $order[0]['ord_id'] ?>">
                        <input type="text" name="requesttitle" id="request_title" class="form-control" value="<?= $order[0]['request_title']?>">

                         <?php if(isset($errors['requesttitle'])): ?>

                            <label class="text-danger"><?=$errors['requesttitle']; ?></label>

                        <?php endif; ?>

                    </div>

                     <div class="form-group col-md-4">

                        <label>Phone </label>

                        <input type="text" name="phone" id="phone" class="form-control" value="<?= $order[0]['phone']?>">

                         <?php if(isset($errors['phone'])): ?>

                            <label class="text-danger"><?=$errors['phone']; ?></label>

                        <?php endif; ?>

                    </div>

                    <div class="form-group col-md-4">

                        <label>Address </label>

                        <input type="text" name="location"  id="request_location" class="form-control" value="<?= $order[0]['location']; ?>" >

                         <?php if(isset($errors['location'])): ?>

                            <label class="text-danger"><?=$errors['location']; ?></label>

                        <?php endif; ?>

                    </div>

                    </div>
					<div>

                        <div class="portlet-body">
                            <div class="col-md-12">
                                <div class="row" style="border: 1px solid #333;padding: 20px;margin-bottom: 20px">
                                    <div class="form-group col-md-2">
                                        <label>Location Type</label>
                                        <select class="form-control item_location_type" name="item_location_type"
                                            id="item_location_type">
                                            <option value="default">Select</option>
                                            <option value="PM">Primary Home</option>
                                            <option value="VH">Vaction Home</option>
                                            <option value="OFC">Office</option>
                                            <option value="OTHER">Other</option>
                                        </select>
                                         <p class="error" id="error_item_location" style="display: none;">Plase Enter Location</p>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Address</label>
                                        <input type="text" name="item_category" class="form-control item_address"
                                            id="item_cat">
                                         <p class="error" id="error_item_address" style="display: none;">Plase Enter Address</p>
                                    </div>
                                    <div class="form-group col-md-2" style="margin-top: 20px;">
                                            <!-- <button class="btn btn-success  ent-loc" name="item_enitre_chk" id="entire_chk">Entire Location</button type="button"> -->
                                                <a href="javascript:void(0)" id="edit_entire_chk" class="btn btn-success ent-loc">Entire Location</a>
                                         <!-- <div class="button-group-pills text-center" data-toggle="buttons"> -->
                                            <!-- <label class="btn btn-default active"> -->
                                           <!--  <label class="form-check-label" for="entire"> Entire Location</label>
                                            <input class="form-check-input ent-loc btn-btn-primary" type="checkbox" id="entire" name="item_enitre_chk"
                                                value="1">
                                            <label class="text-danger"><?=$errors['attrny_chk']; ?></label> -->
                                        <!-- </div> -->
                                    </div>
                                </div>
                            </div>

                            <div>

                                <div class="row" id="to_focuse">

                                    <div class="col-md-12">

                                        <div class="form-group col-md-2">

                                            <label>Item Name<span class="required">*</span></label>
                                            <input type="hidden" name="contract_sts" id="contract_sts"
                                                value="<?= $contract ?>">
                                            <select class="form-control" name="item_select" id="item_select">
                                                <option value="">Select item</option>
                                                <!-- <option value="Entire-Location">Entire Location </option> -->
                                                <option value="Barley">Barley</option>
                                                <option value="Beer">Beer</option>
                                                <option value="Cake-Mix">Cake Mix</option>
                                                <option value="Cereal">Cereal</option>
                                                <option value="Cosmetics">Cosmetics</option>
                                                <option value="Flour">Flour</option>
                                                <option value="Ketchup">Ketchup</option>
                                                <option value="Mayonnaise">Mayonnaise</option>
                                                <option value="Medicine">Medicine</option>
                                                <option value="Mustard">Mustard</option>
                                                <option value="Oatmeal">Oatmeal</option>
                                                <!-- <option value="Office">Office</option> -->
                                                <!-- <option value="Other-Home">Other Home</option> -->
                                                <option value="Pasta">Pasta</option>
                                                <option value="Play-Dough">Play Dough</option>
                                                <option value="Salad">Salad</option>
                                                <option value="Sauces">Sauces</option>
                                                <option value="Soup-Mixes">Soup Mixes</option>
                                                <option value="Vinegar">Vinegar</option>
                                                <option value="Vitamins">Vitamins</option>
                                                <option value="Whiskey">Whiskey</option>
                                                <option value="Yeast">Yeast</option>
                                                <option value="Other">Other</option>
                                            </select>

                                            <input type="text" name="item_name" id="item_name" class="form-control"
                                                style="display: none;margin-top: 10px;">
                                                 <!-- <p class="error" id="error_item_name" style="display: none;">Plase Enter Item Name</p> -->
                                            <?php if(isset($errors['item_name'])): ?>

                                            <label class="text-danger" id="error_item_name"><?=$errors['item_name']; ?></label>

                                            <?php endif; ?>
                                            <p class="error" id="error_item_name" style="display: none;">Plase Enter
                                                Item Name</p>

                                        </div>

                                        <div class="form-group  col-md-2">

                                            <label>Item Price<span class="required">*</span></label>

                                            <div class="input-group">

                                                <span class="input-group-addon">

                                                    <i class="fa fa-usd"></i>

                                                </span>

                                                <input type="number" name="item_price" id="item_price"
                                                    class="form-control ">

                                                <?php if(isset($errors['item_price'])): ?>

                                                <label class="text-danger"><?=$errors['item_price']; ?></label>

                                                <?php endif; ?>
                                                <p class="error" id="error_item_price" style="display: none;">Plase
                                                    Enter Item Price</p>

                                            </div>

                                        </div>

                                        <div class="form-group col-md-2">

                                            <label>Item Quantity<span class="required">*</span></label>

                                            <input type="number" name="item_quantity" id="item_quantity"
                                                class="form-control">

                                            <?php if(isset($errors['item_quantity'])): ?>

                                            <label class="text-danger"><?=$errors['item_quantity']; ?></label>

                                            <?php endif; ?>
                                            <p class="error" id="error_item_qty" style="display: none;">Plase Enter Item
                                                Quantity</p>

                                        </div>

                                        <!-- <div class="form-group  col-md-4 col-lg-6"> -->

                                        <div class="form-group col-md-2">


                                            <label>Location<span class="required" style="color: red;">*</span></label>

                                            <input type="text" name="item_location" class="form-control"
                                                id="item_location">

                                            <input type="hidden" name="table_row_att" id="table_row_att" value="0">

                                            <?php if(isset($errors['item_description'])): ?>

                                            <label class="text-danger"><?=$errors['item_description']; ?></label>

                                            <?php endif; ?>
                                            <p class="error" id="error_location" style="display: none;">Plase Enter
                                                Item Location</p>


                                        </div>

                                        <div class="form-group col-md-3">

                                            <label>Add Images</label>


                                            <input type="file" name="product_gallery_image[]" accept="image/*"
                                                id="gallery-photo-add" class="form-control" multiple>

                                            <div class="image_gellery_show gallery d-inline col-md-3" id="gallrey">
                                            </div>

                                        </div>
                                        <div class="form-group col-md-1">

                                            <button type="button" name="additems" id="add_items_edit"
                                                class="btn btn-success add_items_edit item-button"
                                                style="margin-top: 20px;margin-left: -21px;"><i class="fa fa-plus"></i> Add Items</button>

                                            <span class="alert alert-error error" id="error" role="alert"></span>

                                        </div>
                                    </div>

                                </div>
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

                                                  <!--   <th style="text-align: center;background-color: #eee;">No</th> -->

                                                    <th style="text-align: center;background-color: #eee;">Item Name</th>

                                                    <th style="text-align: center;background-color: #eee;">Item Price</th>

                                                    <th style="text-align: center;background-color: #eee;">Item Quantity</th>

                                                    <th style="text-align: center;background-color: #eee;">Item gallery</th>

                                                    <th style="text-align: center;background-color: #eee;">Location</th>

                                                    <!-- <th style="text-align: center;background-color: #eee;">Location Description</th> -->

                                                     <th style="text-align: center;background-color: #eee;">Action</th>

                                                </tr>

                                            </thead>

                                            <tbody class="attribute_data" id="tablee">

                                                <?php $i=0; foreach ($items as $item_id => $itm_value) { ?>

                                                    <?php foreach ($itm_value as $as => $com_value) { 
                                                        if($as == "PM") { 
                                                            $loc = "Primary Home"; 
                                                          } elseif($as == "VH"){
                                                            $loc = "Vacation Home";
                                                          } elseif($as == "OFC" ) { 
                                                            $loc = "Office"; 
                                                           } elseif($as == "OTHER" ) { 
                                                            $loc = 'Other';
                                                          } else { $loc = ''; }  ?>
                                                        
                                                        <tr id="temp_<?= $item['item_detail']['item_location'] ?>" class="old_location" data-address="<?= $item_id ?>" data-loc="<?= $as ?>">
                                                            <td class="panel-heading" colspan="7"><b><?= $loc; ?>&nbsp;&nbsp;  <?= $item_id; ?></b></td>
                                                        </tr>
                                                            <?php  foreach ($com_value as $key => $loc) {

                                                                 if($loc['disable-location'] == 1) { ?>
                                                             <tr>
                                                                <td width="" style="text-align:center" colspan="6">
                                                                  <p>Entire Location and all chometz on premises</p>
                                                                </td>
                                                            </tr>

                                                         <?php } else { ?>
                                                             
                                                                <tr id="trid_<?= $loc['item_id']?>">

                                                   <!--  <td>

                                                        <div class="form-group form-md-line-input form-md-floating-label">

                                                            <?=$i ?>

                                                        </div>

                                                    </td> -->

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

                                                                <!-- <img class="prev" src="<?= base_url().'upload/Product/'.$img['img_name'] ?>"  style="height:70px; width:70px;" alt="No Image"> -->

                                                         <?php endforeach; ?>

                                                            </div>

                                                    </td>

                                                     <td  width="" style="text-align:center">

                                                        <div class="form-group form-md-line-input form-md-floating-label"><?=$loc['item_location'] ?></div>

                                                    </td>

                                                  <!--   <td  width="" style="text-align:center">

                                                        <div class="form-group form-md-line-input form-md-floating-label" style="padding: 0px; border: 0px "><textarea readonly rows="5" cols="35"><?= wordwrap($item['item_description'],40,"\n",true); ?></textarea></div>

                                                    </td> -->

                                                    <td style="text-align:center" data-newitem_id="<?=$loc['item_id'] ?>">

                                                        <span class="remove_attribute" id="<?=$loc['item_id'] ?>" >

                                                            <i class="fa fa-minus-circle"></i>

                                                        </span>

                                                        <span class="edit_attribute_of_copy" data-id="<?=$loc['item_id'] ?>"  data-newitem_id="<?php echo $getdata[$temp_id]; ?>" data-newimage_id="<?php echo $getimage[$temp_id] ?>">

                                                            <i class="fa fa-pencil" aria-hidden="true"></i>

                                                        </span>

                                                    </td>

                                                </tr>
                                                    <?php }   } }  $i++;   } ?> <?php //exit; ?>
                                            </tbody>

                                        </table>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

                        <div class="modal-dialog" role="document">

                            <div class="modal-content">

                                <div class="modal-header">

                                    <h5 class="modal-title" id="exampleModalLabel">Edit Item</h5>

                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                    <span aria-hidden="true"></span>

                                    </button>

                                </div>

                                <div class="modal-body">



                                </div>

                                <div class="modal-footer">

                                    <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>



                                </div>

                            </div>

                        </div>

                    </div>

                   <!--  <div class="form-group col-md-12">

                        <div class="col-md-6" style="border:1px solid #36c6d3; width: auto;">



                        <img src="<?= base_url().'upload/signatures/'.$order['signature'] ?>" height="100" width="400" alt="No Image"style="padding: 10px;">

                        </div>

                    </div> -->

                    <?php if($this->session->userdata('is_admin') == 1 || $contract == 'yes') { ?>
                    <div class="portlet box">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="body-border">

                                        <h4>Contract Aggrement</h4>

                                    </div>

                                    <div class="row">

                                        <div class="col-6">

                                            <div class="col-md-12">

                                                <p style="text-align: right;" class="herbre-size"><b><span
                                                            id="invoice_order"></span></b>&nbsp;&nbsp;&nbsp;<?php echo hebrevc('מודה אני הח"מ

                                          :הדר בבית \ בדירה \ בחדר, המסומן במספר

                                          (אשר אני מוכר במכירה גמורה מעכשיו בלי שום תנאי לא"י (הנקוב בשמו בשטר כללי

                                          כל הדברים חמוצים ומיני חמץ ושאור ותערובות חמץ וחמץ נוקשה וכדומה ופירורי חמץ שנמצאים ברשותי

                                          (See attached document for itemized list of where chometz stored) הנ"ל ומפורטים כדלהלן דהיינו:
                                           ') ?>

                                                    נמכר מעכשיו לפי מקח השוה להערל הקונה החמץ, וגם כל מיני חמץ גמור או
                                                    חמץ נוקשה בעין או תערובות חמץ או דבר שיש בו חשש חמץ הנמצאים ברשותי
                                                    הנ"ל שלא נפרטו כאן, הכל אני מוכר במכירה גמורה להא"י הנ"ל לפי מקח
                                                    השוה בשוק, וגם אם יש חפץ שנדבק בדופני הכלים כגון: כלי לישה, ואפי',
                                                    וכאו"ש, וסכו"ם וכדומה, וגם פירורי חמץ וחמץ הנדבק בספרים ובכ"מ שהוא
                                                    אני מוכר להא"י הנ"ל לפי מקח השוה בשוק, וכן כלים שעניני של חמץ אוכלין
                                                    ומשקאות מונחים ועומדים שם הם בשאלה אצלו, ומה שלא נפרטו (ששכחתי) איזה
                                                    מין חמץ או ת"ח או חמ"נ או פיר"ח בכל מקום שהוא בבעלותי וברשותי הכל
                                                    במכירה גמורה, ושכירת וקנין מקום הנ"ל להא"י הקונה החמץ במחיר ___$
                                                    ואגב קנין שכירת המקום הנ"ל יהי' קנוי לו כל החמץ שמונח שם ביתר שאת
                                                    וביתר עז, כל זה נעשה בכל יפוי כח עפ"י דתורה"ק ובנמוסי המדינה הנהוגים
                                                    בענין שאין בו אסמכתא ולא כטופסי דשטרא. <br>
                                                    דתורה"ק ובנמוסי המדינה הנהוגים בענין שאין בו אסמכתא ולא כטופסי
                                                    דשטרא.
                                                </p>

                                                <p style="text-align: right;" class="herbre-size">
                                                    <?php echo hebrevc(' באעה"ח   יום ____ לחודש ניסן תשפ"א לפ"ק   ')?>

                                                    <!--  <p style="text-align: right"><?php echo hebrevc('  עפ"י דתורה"ק ובנמוסי המדינה הנהוגים בענין שאין בו אסמכתא ולא כטופסי  ') ?>
                                            <b><?= date("M d Y")  ?></b> <?php echo hebrevc(' דשטרא. ')?>
                                        <?php echo hebrevc('באעה"ה  ')?>
                                        <?php echo hebrevc(' באעה"ח לחודש ניסן תשפ"א לפ"ק  ')?> -->
                                                </p>
                                                <!-- <p style="text-align: right"> <b><?= date("M d Y")  ?></b> <?php echo hebrevc(' דשטרא. ')?> </p> -->
                                                <!-- <p style="text-align: right"> <?php echo hebrevc('באעה"ה  ')?></p> -->
                                                <!-- <p style="text-align: right"> <?php echo hebrevc(' באעה"ח לחודש ניסן תשפ"א לפ"ק  ')?></p> -->

                                            </div>

                                            <!--  <div class="col-md-12">

                                        <div class="form-check">

                                            <input class="form-check-input" type="checkbox" id="defaultCheck1" name="contact_chk" value="1">

                                             <?php if(isset($errors['contact_chk'])): ?>


                                                <label class="text-danger"><?=$errors['contact_chk']; ?></label>
                                            <?php endif; ?>

                                            <label class="form-check-label" for="defaultCheck1">
                                            Check to accept and sigin below

                                            </label>
                                        </div>
                                         <div class="col-md-12">


                                        </div>
                                    </div> -->



                                        </div>

                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="body-border">

                                        <h4>Power of Attorney Aggrement</h4>

                                    </div>

                                    <div class="row">

                                        <div class="col-md-12">

                                             <img src="<?= base_url().'upload/power-of-atrony.jpg'?>" width="100%" height="auto">

                                        </div>

                                        <!--  <div class="col-md-12">

                                    <div class="form-check attrny-checkbox" style="padding-left: 10px;">

                                        <input class="form-check-input" type="checkbox" id="defaultCheck2" name="attrny_chk" value="1">

                                         <?php if(isset($errors['attrny_chk'])): ?>

                                                <label class="text-danger"><?=$errors['attrny_chk']; ?></label>

                                            <?php endif; ?>

                                        <label class="form-check-label" for="defaultCheck2">

                                       Check to accept and sigin below

                                        </label>

                                    </div>

                                </div> -->
                                        <!--  <div class="col-md-12">

                                        <div class="sigPad" id="smoothed_contact" style="width:404px;">

                                        <h5>Signature<span class="required" style="color: red;">*</span></h5>

                                        <ul class="sigNav">

                                            <li class="clearButton"><a href="#clear">Clear</a></li>

                                        </ul>

                                            <div class="sig sigWrapper" style="height:auto;">

                                                <div class="typed"></div>

                                                <canvas class="pad" id="contact_can"  width="400" height="100"></canvas>

                                                <input type="hidden" name="contact_output" class="output">

                                            </div>

                                        </div>

                                    </div> -->

                                        <!-- <div class="col-md-12">

                                    <div class="sigPad" id="smoothed_attrony" style="width:404px;">

                                    <h5>Signature<span class="required" style="color: red;">*</span></h5>

                                    <ul class="sigNav">

                                        <li class="clearButton"><a href="#clear">Clear</a></li>

                                    </ul>

                                        <div class="sig sigWrapper" style="height:auto;">

                                            <div class="typed"></div>

                                            <canvas class="pad" id="smoothed_attrony" width="400" height="100"></canvas>

                                            <input type="hidden" name="attrny_output" class="output">

                                        </div>

                                    </div>

                                </div>  -->

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="defaultCheck1" name="contact_chk"
                                    value="1"  <?php  if($order[0]['contact_chk'] == 1) { echo "checked='checked'";} ?>>

                                <?php if(isset($errors['contact_chk'])): ?>


                                <label class="text-danger"><?=$errors['contact_chk']; ?></label>
                                <?php endif; ?>

                                <label class="form-check-label" for="defaultCheck1">
                                    Check to accept and sigin below

                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check attrny-checkbox" style="padding-left: 10px;">

                                <input class="form-check-input" type="checkbox" id="defaultCheck2" name="attrny_chk"
                                    value="1"  <?php  if($order[0]['attrny_chk'] == 1) { echo "checked='checked'";} ?>>

                                <?php if(isset($errors['attrny_chk'])): ?>

                                <label class="text-danger"><?=$errors['attrny_chk']; ?></label>

                                <?php endif; ?>

                                <label class="form-check-label" for="defaultCheck2">

                                    Check to accept and sigin below

                                </label>

                            </div>

                            <div class="col-md-12">

                                <div class="sigPad" id="smoothed_contact" style="width:404px;">

                                    <h5>Signature<span class="required" style="color: red;">*</span></h5>

                                    <ul class="sigNav">

                                        <li class="clearButton"><a href="#clear">Clear</a></li>

                                    </ul>

                                    <div class="sig sigWrapper" style="height:auto;">

                                        <div class="typed"></div>

                                        <canvas class="pad" id="contact_can" width="400" height="100"></canvas>

                                        <input type="hidden" name="contact_output" class="output">
                                          <img src="<?= base_url().'upload/signatures/'.$order[0]['signature_contact'] ?>" height="100" width="400" alt="No Image"style="padding: 10px;">

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
<?php } ?>

                    <!--  <div class="form-group ">

                        <div class="sigPad" id="smoothed" style="width:404px;">

                            <h4>Signature</h4>

                            <ul class="sigNav">

                                <li class="clearButton"><a href="#clear">Clear</a></li>

                            </ul>

                            <div class="sig sigWrapper" style="height:auto;">

                                <div class="typed"></div>

                                <canvas class="pad" id="main_can" width="400" height="100"></canvas>

                                <input type="hidden" name="output" class="output">

                            </div>

                        </div>

                    </div>

                     -->

                     <input type="submit" name="submit" value="submit" class="btn btn-info">

                    <input type="reset" id="place_order_reset_btn" name="Reset" value="Reset" class="btn btn-danger">

            <input type="hidden" name="user_id" value="<?= $this->session->userdata('id'); ?>">

           <!--  <input type="hidden" name="copy_id" value="<?= $this->session->userdata('copy_orderitem_id') ?>"> -->

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
<script type="text/javascript" src="<?= base_url()?>assets/pages/scripts/copy_edit.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

