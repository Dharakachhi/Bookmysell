<?php

    $getdata = $this->session->userdata('copy_orderitem_id');

    $orderitem = $this->session->userdata('copy_ordermaster_id');

    $getimage = $this->session->userdata('newimage_id');
    // echo "<pre>";
    // print_r ($items);
    // echo "</pre>";exit;
 ?>
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

                                                <?php foreach ($items as $item_id => $itm_value) { ?>

                                                    <?php foreach ($itm_value as $as => $com_value) {
                                                      $i = 0;
                                                        if($as == "PM") { 
                                                            $loc = "Primary Home"; 
                                                          } elseif($as == "VH"){
                                                            $loc = "Vacation Home";
                                                          } elseif($as == "OFC" ) { 
                                                            $loc = "Office"; 
                                                           } elseif($as == "OTHER" ) { 
                                                            $loc = 'Other';
                                                          } else { $loc = ''; }  

                                                          if($com_value[$i]['disable-location'] == 1) { ?>

                                                             <tr id="temp_<?= $as ?>" class="old_location" data-address="<?= $item_id ?>" data-loc="<?= $as ?>">
                                                            <td class="panel-heading" colspan="7"><b><?= $loc; ?>&nbsp;&nbsp;  <?= $item_id; ?></b>
                                                              <div class="format"><span class="remove_attribute_place" id="<?= $com_value[$i]['item_id'] ?>"><i class="fa fa-minus-circle"></i></span><span class="locatiob_edit_tr" data-id="<?= $com_value[$i]['item_id'] ?>"><i class="fa fa-pencil" aria-hidden="true"></i></span></div>
                                                            </td>
                                                        </tr>

                                                          <?php } else { ?>
                                                             <tr id="temp_<?= $as ?>" class="old_location" data-address="<?= $item_id ?>" data-loc="<?= $as ?>">
                                                            <td class="panel-heading" colspan="7"><b><?= $loc; ?>&nbsp;&nbsp;  <?= $item_id; ?></b>
                                                            </td>
                                                        </tr>
                                                          <?php } ?>
                                                          
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

                                                        <?php $temp_id= 0; foreach ($loc['image'] as $img): ?>
                                                             <a class="imageLink" href="<?= base_url().'upload/Product/'.$img['img_name'] ?>?raw=<?= $temp_id ?>" >
                                                             <img class="" src="<?= base_url().'upload/Product/'.$img['img_name'] ?>?raw=<?= $temp_id ?>" width="80px" height="80px">
                                                            </a>

                                                                <!-- <img class="prev" src="<?= base_url().'upload/Product/'.$img['img_name'] ?>"  style="height:70px; width:70px;" alt="No Image"> -->

                                                         <?php  $temp_id++;  endforeach; ?>

                                                            </div>

                                                    </td>

                                                     <td  width="" style="text-align:center">

                                                        <div class="form-group form-md-line-input form-md-floating-label"><?=$loc['item_location'] ?></div>

                                                    </td>

                                                  <!--   <td  width="" style="text-align:center">

                                                        <div class="form-group form-md-line-input form-md-floating-label" style="padding: 0px; border: 0px "><textarea readonly rows="5" cols="35"><?= wordwrap($item['item_description'],40,"\n",true); ?></textarea></div>

                                                    </td> -->

                                                    <td style="text-align:center" data-newitem_id="<?php echo $getdata[$key]; ?>">

                                                        <span class="remove_attribute" id="<?=$loc['item_id'] ?>" >

                                                            <i class="fa fa-minus-circle"></i>

                                                        </span>

                                                        <span class="edit_attribute_of_copy" data-id="<?=$loc['item_id'] ?>"  data-newitem_id="<?php echo $getdata[$key]; ?>" data-newimage_id="">

                                                            <i class="fa fa-pencil" aria-hidden="true"></i>

                                                        </span>

                                                    </td>

                                                </tr>
                                                    <?php }   } $i++; }  } ?> <?php //exit; ?>
                                            </tbody>

                                        </table>