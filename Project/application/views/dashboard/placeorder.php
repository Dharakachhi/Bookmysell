<?php

    // echo validation_errors();exit;

    // print_r($product_edit);exit;

    ?>
<style type="text/css">
.item-button {
    text-align: center;
    margin-top: 20px;
    padding: 5px;
    font-size: 12px;
}

@media screen and (min-width: 600px) {
    .herbre-size {
        font-size: 14px;
    }
}

@media screen and (max-width: 1366px) {
    .herbre-size {
        font-size: 12px;
    }
}

.border_price {
    border-bottom: 1px solid #333;
}

/*.herbre-size { font-size: 12px; }*/

/* .attrny-checkbox{
            margin-top: 90px;
        }*/
</style>

<div class="page-content-wrapper" data-bind="placeorder-active-page-link">

    <div class="page-content">


        <div id="result_message" style="display: none;"></div>

        <div id="result_error_message" style="display: none;"></div>

        <?php if ($this->session->flashdata('message')) {?>

        <div id="result" style="display: none;"></div>

        <?php } else if ($this->session->flashdata('error')) {?>

        <div id="result_error" style="display: none;"></div>

        <?php } else {}?>

        <h1 class="page-title"> Mechiras Chometz </h1>

        <div class="clearfix"></div>

        <div class="row">

            <div class="col-lg-12">

                <form action="<?=base_url('insertorder')?>" id="add_item_detail_form" method="post"
                    enctype="multipart/form-data">

                    <div class="row">

                        <div class="form-group col-md-4">

                            <label>Full Name <span class="required">*</span></label>

                            <input type="text" name="requesttitle" id="request_title" class="form-control"
                                value="<?= $this->session->userdata('name'); ?>">

                            <?php if(isset($errors['requesttitle'])): ?>

                            <label class="text-danger"><?=$errors['requesttitle']; ?></label>

                            <?php endif; ?>

                        </div>
                        <div class="form-group col-md-4">

                            <label>Phone </label>

                            <input type="text" name="phone" id="phone" class="form-control">

                            <?php if(isset($errors['phone'])): ?>

                            <label class="text-danger"><?=$errors['phone']; ?></label>

                            <?php endif; ?>

                        </div>


                        <input type="hidden" id="old_val">

                        <div class="form-group col-md-4">

                            <label>Address <span class="required">*</span></label>

                            <input type="text" name="location" id="request_location" class="form-control">

                            <?php if(isset($errors['location'])): ?>

                            <label class="text-danger"><?=$errors['location']; ?></label>

                            <?php endif; ?>

                        </div>

                    </div>

                    <div class="portlet box green">

                        <div class="portlet-title">

                            <div class="caption">

                                Items </div>



                        </div>
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
                                        <p class="error" id="error_item_location" style="display: none;">Plase Enter
                                            Location</p>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Address</label>
                                        <input type="text" name="item_category" class="form-control item_address"
                                            id="item_cat">
                                        <p class="error" id="error_item_address" style="display: none;">Plase Enter
                                            Address</p>
                                    </div>
                                    <div class="form-group col-md-2" style="margin-top: 20px;">
                                        <!-- <button class="btn btn-success  ent-loc" name="item_enitre_chk" id="entire_chk">Entire Location</button type="button"> -->
                                        <a href="javascript:void(0)" id="entire_chk"
                                            class="btn btn-success ent-loc">Entire Location</a>
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

                                            <?php if(isset($errors['item_name'])): ?>

                                            <label class="text-danger"><?=$errors['item_name']; ?></label>

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

                                            <button type="button" name="additems" id="add_items"
                                                class="btn btn-success add_attribute item-button"
                                                style="margin-top: 20px"><i class="fa fa-plus"></i> Add Items</button>

                                            <span class="alert alert-error error" id="error" role="alert"></span>

                                        </div>

                                        <!--  <div class="form-group  col-md-4 col-lg-6">

                                            <label>Add Images</label>

                                            <input type="file"  name="product_gallery_image[]"  accept="image/*"  id="gallery-photo-add"  class="btn-1" multiple>

                                            <span class="error" id="img_err"></span>

                                        </div>

                                        <div class="image_gellery_show gallery d-inline col-md-9" id="gallrey">

                                        </div> -->

                                    </div>

                                </div>
                                <!--
                                <div class="row">

                                     <div class="col-md-12">

                                    <div class="col-md-6">

                                        <div class=" ">

                                            <label>Location Description<span class="required" style="color: red;">*</span></label>

                                            <textarea name="item_description" id="item_description" rows="5" cols="50" class="form-control"></textarea>

                                            <input type="hidden" name="table_row_att" id="table_row_att" value="0">

                                             <?php if(isset($errors['item_description'])): ?>

                                                <label class="text-danger"><?=$errors['item_description']; ?></label>

                                            <?php endif; ?>
                                             <p class="error" id="error_item_desc" style="display: none;">Plase Enter Item Description</p>
                                              <p class="error" id="error_item_all" style="display: none;">Plase Enter All fields</p>
                                        </div>

                                    </div>

                                      <div class="col-md-6 col-lg-6">

                                            <label>Add Images</label>


                                            <input type="file"  name="product_gallery_image[]"  accept="image/*"  id="gallery-photo-add"  class="form-control" multiple >



                                        </div>

                                        <div class="image_gellery_show gallery d-inline col-md-3" id="gallrey">

                                        </div>

                                    </div>

                                </div>

                                    <div class="form-group col-md-12">

                                        <button type="button" name="additems" id="add_items" class="btn btn-success add_attribute" style="margin-top: 20px"><i class="fa fa-plus"></i> Add  Items</button>

                                        <span class="alert alert-error error" id="error" role="alert"></span>

                                    </div> -->

                            </div>

                            <div class="row">

                                <div class="col-md-12" style="margin-top: 10px;">



                                    <table class="table table-striped table-bordered display-attribute"
                                        id="edit_item_tablee" style="width:100%; display: none;">

                                        <thead>

                                            <tr>

                                                <!-- <th style="text-align: center;background-color: #eee;">No</th> -->

                                                <th style="text-align: center;background-color: #eee;">Item Name</th>

                                                <th style="text-align: center;background-color: #eee;">Item Price</th>

                                                <th style="text-align: center;background-color: #eee;">Item Quantity
                                                </th>

                                                <th style="text-align: center;background-color: #eee;">Item gallery</th>

                                                <th style="text-align: center;background-color: #eee;">Location</th>

                                                <!-- <th  style="text-align: center;background-color: #eee;">Location Description</th> -->

                                                <th style="text-align: center;background-color: #eee;">Action</th>

                                            </tr>

                                        </thead>

                                        <tbody class="attribute_data">

                                            <!--  <div class="panel-heading">Regular OLD Table

                                                <div class="panel-body panel-regular-table">





                                    </div>

                                </div> -->

                                        </tbody>

                                    </table>

                                </div>

                            </div>
                        </div>

                    </div>

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
                                                    במכירה גמורה, ושכירת וקנין מקום הנ"ל להא"י הקונה החמץ במחיר <b><span
                                                            class="border_price">1 $</span></b>
                                                    ואגב קנין שכירת המקום הנ"ל יהי' קנוי לו כל החמץ שמונח שם ביתר שאת
                                                    וביתר עז, כל זה נעשה בכל יפוי כח עפ"י דתורה"ק ובנמוסי המדינה הנהוגים
                                                    בענין שאין בו אסמכתא ולא כטופסי דשטרא.
                                                </p>

                                                <p style="text-align: right;" class="herbre-size">
                                                    <?php echo hebrevc(' בבאעה"ח   יום ____ לחודש ניסן תשפ"א לפ"ק  ')?>

                                                    <!--  <p style="text-align: right"><?php  hebrevc('  עפ"י דתורה"ק ובנמוסי המדינה הנהוגים בענין שאין בו אסמכתא ולא כטופסי  ') ?>
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

                                            <img src="upload/power-of-atrony.jpg" width="100%" height="auto">

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
                                    value="1">

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
                                    value="1">

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

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <!-- <div class="row">
                     <div class="portlet box col-md-6">


                        </div>

                          <div class="portlet box col-md-6">



                        </div>
                        </div> -->
                    <div class="col-md-12">

                        <!--  <div class="form-group ">

                        <div class="sigPad" id="main" style="width:404px;">

                             <h5>Signature<span class="required" style="color: red;">*</span></h5>

                            <ul class="sigNav">

                                <li class="clearButton"><a href="#clear">Clear</a></li>

                            </ul>

                            <div class="sig sigWrapper" style="height:auto;">

                                <div class="typed"></div>

                                <canvas class="pad" id="main_can" width="400" height="100"></canvas>

                                <input type="hidden" name="output" class="output">

                            </div>

                        </div>

                    </div> -->



                        <input type="hidden" name="user_id" value="<?=$this->session->userdata('id');?>">

                        <input type="hidden" name="item_count" id="">

                        <input type="submit" name="submit" value="submit" class="btn btn-info">

                        <input type="reset" id="place_order_reset_btn" name="Reset" value="Reset"
                            class="btn btn-danger cancel">



                    </div>

            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">

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

            <!--  </div>

            </div> -->
            <!-- /.modal -->
            <div class="modal fade" id="small" tabindex="-1" role="small" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">Edit</h4>
                        </div>
                        <div class="modal-body small_edit"> </div>
                        <div class="modal-footer">
                            <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
            </form>

        </div>

    </div>

</div>

<!-- END CONTENT BODY -->

</div>

<!-- END CONTENT -->

<!-- BEGIN QUICK SIDEBAR -->

</div>
<script type="text/javascript">
$("#request_title").keyup(function() {
    var title = $(this).val();
    $("#invoice_order").text(title);
});
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- END CONTAINER -- >