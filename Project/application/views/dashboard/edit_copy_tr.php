 <!-- /.modal -->
 <div class="portlet box green">

     <div class="portlet-title">
         <div class="caption">Items </div>
     </div>

     <div class="portlet-body">
         <div class="row">

             <div class="col-lg-12 ">

                 <form action="" role="form" id="edit_tr_row_copy" method="post" enctype="multipart/form-data">
                     <div class="row">
                         <div class="col-md-12">
                             <div class="form-group col-md-6">
                                 <label>Item location</label>
                                  <select class="form-control" id="location" name="loc">
                                   <option value="PM" <?php echo ($location[0]['item_location_type'] == 'PM')?'selected':''?> >Primary Home</option>
                                   <option value="VH" <?php echo ($location[0]['item_location_type'] == 'VH')?'selected':''?> >Vaction Home</option>
                                   <option value="OFC" <?php echo ($location[0]['item_location_type'] == 'OFC')?'selected':''?>>Office</option>
                                   <option value="OTHER" <?php echo ($location[0]['item_location_type'] == 'OTHER')?'selected':''?>>Other</option>
                                </select>
                                 <!-- <input type="text" class="form-control" value="<?= $location[0]['item_location_type'] ?>" name="loc" id="location"> -->
                             </div>
                             <div class=" form-group col-md-6">
                                 <label>Item Address</label>
                                 <input type="text" class="form-control" value="<?= $location[0]['item_category'] ?>"
                                     name="address" id="address">
                                     <input type="hidden" value="<?= $location[0]['item_id']?>" name="item_id">
                                     <input type="hidden" value="<?= $location[0]['order_id']?>" name="order_id">
                             </div>
                         </div>
                     </div>
                     <button type="button" id="update_copytr_value" name="update" class="btn green update_copytr_value"
                         style="margin-top:12px;">Update</button>
                 </form>
             </div>
         </div>
     </div>
 </div>
 <!-- /.modal -->
 <script src="<?=base_url()?>assets/pages/scripts/edititem.js"></script>