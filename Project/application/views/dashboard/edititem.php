<div class="row">

    <div class="col-lg-12 ">

        <form action="" role="form" id="edit_item_form" method="post" enctype="multipart/form-data" >

            <div class="portlet box green">

                <div class="portlet-title">

                    <div class="caption">

                    Items </div>

                </div>

                <div class="portlet-body">

                    <div>

                        <div class="row" id="to_focuse">
                            <div class="form-group col-md-4">
                                <label>Location Type</label>
                                <select class="form-control" id="edit_item_location_type" name="location_type">
                                   <option value="PM" <?php echo ($items->item_location_type == 'PM')?'selected':''?> >Primary Home</option>
                                   <option value="VH" <?php echo ($items->item_location_type == 'VH')?'selected':''?> >Vaction Home</option>
                                   <option value="OFC" <?php echo ($items->item_location_type == 'OFC')?'selected':''?>>Office</option>
                                   <option value="OTHER" <?php echo ($items->item_location_type == 'OTHER')?'selected':''?>>Other</option>
                                </select>
                                <!-- <input type="text" name="address" id="edit_item_address" value="<?= $items->item_category; ?>" class="form-control"> -->
                            </div>
                            <div class="form-group col-md-4">
                                <label>Address</label>
                                <input type="text" name="address" id="edit_item_address" value="<?= $items->item_category; ?>" class="form-control">
                            </div>
                            <div class="form-group col-md-4">

                                <label>Item Name</label>
                                <select class="form-control" name="edit_item_select" id="edit_item_select_popup">
                                    <option value="">Select item</option>
                                    <!-- <option value="<?php echo ($items->item_name == 'Entire-Location')?'selected':''?>">Entire Location </option> -->
                                    <option value=""<?php echo ($items->item_name == 'Barley')?'selected':''?> >Barley</option>
                                    <option value="Beer" <?php echo ($items->item_name == 'Beer')?'selected':''?> >Beer</option>
                                    <option value="Cake-Mix" <?php echo ($items->item_name == 'Cake')?'selected':''?> >Cake Mix</option>
                                    <option value="Cereal" <?php echo ($items->item_name == 'Cereal')?'selected':''?> >Cereal</option>
                                    <option value="Cosmetics" <?php echo ($items->item_name == 'Cosmetics')?'selected':''?> >Cosmetics</option>
                                    <option value="Flour" <?php echo ($items->item_name == 'Flour')?'selected':''?> >Flour</option>
                                    <option value="Ketchup" <?php echo ($items->item_name == 'Ketchup')?'selected':''?> >Ketchup</option>
                                    <option value="Mayonnaise" <?php echo ($items->item_name == 'Mayonnaise')?'selected':''?> >Mayonnaise</option>
                                    <option value="Medicine" <?php echo ($items->item_name == 'Medicine')?'selected':''?> >Medicine</option>
                                    <option value="Mustard" <?php echo ($items->item_name == 'Mustard')?'selected':''?> >Mustard</option>
                                    <option value="Oatmeal" <?php echo ($items->item_name == 'Oatmeal')?'selected':''?> >Oatmeal</option>
                                    <!-- <option value="Office" <?php echo ($items->item_name == 'Office')?'selected':''?> >Office</option>
                                    <option value="Other-Home" <?php echo ($items->item_name == 'Other-Home')?'selected':''?> >Other Home</option> -->
                                    <option value="Pasta" <?php echo ($items->item_name == 'Pasta')?'selected':''?> >Pasta</option>
                                    <option value="Play-Dough" <?php echo ($items->item_name == 'Play-Dough')?'selected':''?> >Play Dough</option>
                                    <option value="Salad" <?php echo ($items->item_name == 'Salad')?'selected':''?> >Salad</option>
                                    <option value="Sauces" <?php echo ($items->item_name == 'Sauces')?'selected':''?> >Sauces</option>
                                    <option value="Soup-Mixes" <?php echo ($items->item_name == 'Soup-Mixes')?'selected':''?> >Soup Mixes</option>
                                    <option value="Vinegar" <?php echo ($items->item_name == 'Vinegar')?'selected':''?> >Vinegar</option>
                                    <option value="Vitamins" <?php echo ($items->item_name == 'Vitamins')?'selected':''?> >Vitamins</option>
                                    <option value="Whiskey" <?php echo ($items->item_name == 'Whiskey')?'selected':''?> >Whiskey</option>
                                    <option value="Yeast" <?php echo ($items->item_name == 'Yeast')?'selected':''?> >Yeast</option>
                                    <option value="Other" <?php echo ($items->item_type == 'Other')?'selected':''?> >Other</option>
                                </select>
                                <?php if($items->item_type == 'Other') { ?>
                                    <input type="text" name="edit_item_name" value="<?= $items->item_name ?>" id="edit_item_name_popup" class="form-control" style="margin-top: 10px;">
                                <?php } else { ?>
                                    <input type="text" name="edit_item_name" value="" id="edit_item_name_popup" class="form-control" style="margin-top: 10px; display: none;">
                                <?php  } ?>
                            </div>

                        </div>

                        <div class="form-group  col-md-4">

                            <label>Item Price</label>

                            <div class="input-group">

                                <span class="input-group-addon">

                                    <i class="fa fa-usd"></i>

                                </span>

                                <input type="number" require min="1" value="<?= $items->item_price ?>" name="edit_item_price" id="edit_item_price" class="form-control ">

                            </div>

                        </div>

                        <div class="form-group col-md-4">

                            <label>Item Quantity</label>

                            <input type="number" require min="1" name="edit_item_quantity"  value="<?= $items->item_quantity ?>" id="edit_item_quantity" class="form-control">

                        </div>

                    </div>

                    <div class="row">

                           <!--   <div class="form-group col-md-8">

                                <label>Location Description</label>

                                <textarea require minlength="6" name="edit_item_description" id="edit_item_description" rows="5" cols="50" class="form-control"><?php echo $items->item_description ?></textarea>

                                <input type="hidden" name="table_row_att" id="table_row_att" value="0">

                            </div>
                        -->
                        <div class="form-group col-md-4">

                            <label>Item location</label>

                            <input type="text" require name="edit_item_location"  value="<?= $items->item_location ?>" id="edit_item_location" class="form-control">

                        </div>

                    </div>

                    <div class="row">

                        <div class="form-group col-md-3">

                            <label>Add Images</label>

                            <input type="file"  name="product_gallery_image1[]"  accept="image/*"  id="gallery-photo-add1"  class="form-control" multiple>

                            <span class="error" id="img_err1"></span>

                        </div>

                        <?php if(count($imgs)>0) :?>

                            <?php $i=0; foreach ($imgs as $key => $img): ?>

                            <div class="gallery">

                                <div class="single">

                                    <input type="button" class="removeImage12" value="x" class="btn-rmv1" data-imageid="<?php echo $img['img_id']; ?>" data-imagename = "<?= $img['img_name']?>" data-newimage_id = "<?php echo  $newimage_id[$i] ?>"/>

                                    <img class="prev" src="<?= base_url().'upload/Product/'.$img['img_name'] ?>"  style="height:70px; width:70px;" alt="No Image">
                                </div>
                                <?php $i++; endforeach; ?>
                            </div>

                        <?php endif; ?>

                        <div class="image_gellery_show1 gallery1 d-inline col-md-9" id="gallrey1">

                        </div>

                    </div>

                </div>



                <div class="row">

                    <div class="form-group col-md-12">

                        <div class="form-group  col-md-4">

                            <input type="button" id="edit_submit" name="edit_submit" value="Submit " class="btn btn-info edit_copy">

                        </div>

                    </div>

                </div>

            </div>

            <div>

               <input type="hidden" name="user_id" value="<?= $this->session->userdata('id'); ?>">

               <input type="hidden" name="row_id"  value="<?=$rowid; ?>" id="copy_orderitem_id">

               <input type="hidden" name="item_id" id="item_id" value="<?= $items->item_id?>">

               <input type="hidden" name="copyitem_id" id="copyitem_id" value="<?= @$copyitem_id; ?>">

           </div>
       </form>
   </div>

</div>

<script src="<?=base_url()?>assets/pages/scripts/edititem.js"></script>

<script>
    // $(document).delegate('.removeImage1', 'click', function() {

    // if (confirm("Are you sure you want to delete ?")) {

    // var hiddenurl = $('#hiddenURL').val();

    // var imgid =  $(this).data("imageid");

    // var imgname = $(this).data("imagename");

    // var thisdata  =$(this);

    // $.ajax({

    //     url: hiddenurl + 'dashboard_controller/deleteimage',

    //     type: 'POST',

    //     data: {

    //         imgid: imgid,

    //         imgname: imgname

    //     },

    // success: function(response){

    //     if (response.success != "") {

    //         thisdata.parent('div').remove();

    //         $("#result_message").fadeIn("slow").html("Image Deleted Successfully");

    //             setTimeout(function() {

    //         $("#result_message").fadeOut("slow");

    //         }, 5000);

    //     }else{

    //         $("#result_error").fadeIn("slow").html("Something went wrong..");

    //         setTimeout(function() {

    //         $("#result_error").fadeOut("slow");

    //     }, 5000);

    // }

    // }

    // });

    // }

    // });
</script>