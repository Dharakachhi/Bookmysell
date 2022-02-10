<?php
   foreach ($items as $key => $value) { 
   	 $randm = mt_rand();
   	?>
<tr id="trid_<?php echo  $value['item_detail']['item_id'] ?>">
	<td width="" style="text-align:center">
	<input type="hidden" name="item_ids[]" value="<?= $value['item_detail']['item_id'] ?>"/>
		<div class="form-group form-md-line-input form-md-floating-label">
			<p class="itm-name"><?= $value['item_detail']['item_name'] ?></p>
			<input type="hidden" class="form-control item_name" name="item_name1[]" id="item_name_" value=""  />
		</div>
	</td>
	<td  width="" style="text-align:center" class="itm-price">
		<?php echo  $value['item_detail']['item_price'] ; ?>
		<?php //setlocale(LC_MONETARY, 'en_US.UTF-8'); echo  money_format('%.2n', $value['item_detail']['item_price']) . "\n"; ?>
		<!-- <div class="form-group form-md-line-input form-md-floating-label">
			<p class="itm-price"><?= $value['item_detail']['item_price'] ?></p>
			<input type="hidden" class="form-control atribute_value" name="item_price1[]" id="item_price_" value="" readonly/>
		</div> -->
	</td>
	<td  width="" style="text-align:center">
		<div class="form-group form-md-line-input form-md-floating-label">
			<p class="itm-qty"><?= $value['item_detail']['item_quantity'] ?></p>
			<input type="hidden" class="form-control atribute_value" name="item_quantity1[]" id="item_quantity_" value="" readonly/>
		</div>
	</td>
		<td  width="" style="text-align:center">
		  <div class="imageContainer clearfix single">
	<?php foreach ($value['image_array'] as $ig => $img) { ?>
        	<img class="" src="<?= base_url().'upload/Product/'.$img['img_name'] ?>?raw=<?=  $randm; ?>" width="80px" height="80px">
	<?php }?>
		 </div>
		</td>
	<td  width="" style="text-align:center">
		<div id="get_location" class="form-group form-md-line-input form-md-floating-label">
			<p class="itm-location"><?= $value['item_detail']['item_location'] ?></p>
			<input type="hidden" class="form-control atribute_value" name="item_location1[]" id="item_location_" value="" readonly/>
		</div>
	</td>
	<td style="text-align:center">
		<span class="remove_attribute_place" id="<?= $value['item_detail']['item_id'] ?>"><i class="fa fa-minus-circle"></i></span><span class="edit_attribute" data-id="<?= $value['item_detail']['item_id'] ?>"><i class="fa fa-pencil" aria-hidden="true"></i>
		</span>
	</td>
</tr>
<?php } ?>