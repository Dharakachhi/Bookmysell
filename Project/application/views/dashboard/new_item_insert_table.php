

	<?php if(!empty($items)):?>
		<?php $j = 0; $i=1; foreach ($items as $item) : 
        // echo "<pre>";
        // print_r ($item);
        // echo "</pre>";exit;
        ?>
			<tr id="<?=$item['item_detail']['item_id']?>">
                <!-- <td width="" style="text-align:center">
                    <div class="form-group form-md-line-input form-md-floating-label"><?=$rowid;  ?></div>
                </td> -->
                <td width="" style="text-align:center">
                    <div class="form-group form-md-line-input form-md-floating-label"><?=$item['item_detail']['item_name']  ?></div>
                </td>
                <td  width="" style="text-align:center">
                    <div class="form-group form-md-line-input form-md-floating-label"><?=
                     "$ ". number_format($item['item_detail']['item_price'],2); ?></div>
                </td>
                <td  width="" style="text-align:center">
                    <div class="form-group form-md-line-input form-md-floating-label"><?=$item['item_detail']['item_quantity'] ?></div>
                </td>
                <td  width="" style="text-align:center">
                    <?php foreach ($item['image_array'] as $img): ?>    
                        <div class="single">
                            <img class="prev" src="<?= base_url().'upload/Product/'.$img['img_name'] ?>"  style="height:70px; width:70px;" alt="No Image">
                        </div>
                    <?php endforeach; ?>    
                </td>
                 <td  width="" style="text-align:center">
                    <div class="form-group form-md-line-input form-md-floating-label"><?=$item['item_detail']['item_location'] ?></div>
                </td>
                <td  width="" style="text-align:center">
                <div class="form-group form-md-line-input form-md-floating-label">
                    <textarea readonly rows="5" cols="35"><?php echo wordwrap($item['item_detail']['item_description'], 40, "\n", true); ?></textarea>
                </div>
                </td>
                <td style="text-align:center">
                    <span class="remove_attribute" id="<?=$item['item_detail']['item_id'] ?>">
                        <i class="fa fa-minus-circle"></i>
                    </span>

                    <span class="edit_attribute_of_copy" data-id="<?=$i ?>" data-newitem_id="<?php echo $item['item_detail']['item_id']; ?>" data-newimage_id="<?php echo $item['image_array'][$j]['img_id'] ?>">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                    </span>
                </td>
            </tr>
		<?php  $i++ ; endforeach  ?>
	<?php endif; ?>

	<?php if(!empty($items)):?>
		<?php $j = 0; $i=1; foreach ($items as $item) : 
        // echo "<pre>";
        // print_r ($item);
        // echo "</pre>";exit;
        ?>
			<tr id="<?=$item['item_detail']['item_id']?>">
                <!-- <td width="" style="text-align:center">
                    <div class="form-group form-md-line-input form-md-floating-label"><?=$rowid;  ?></div>
                </td> -->
                <td width="" style="text-align:center">
                    <div class="form-group form-md-line-input form-md-floating-label"><?=$item['item_detail']['item_name']  ?></div>
                </td>
                <td  width="" style="text-align:center">
                    <div class="form-group form-md-line-input form-md-floating-label"><?=
                     "$ ". number_format($item['item_detail']['item_price'],2); ?></div>
                </td>
                <td  width="" style="text-align:center">
                    <div class="form-group form-md-line-input form-md-floating-label"><?=$item['item_detail']['item_quantity'] ?></div>
                </td>
                <td  width="" style="text-align:center">
                    <?php foreach ($item['image_array'] as $img): ?>    
                        <div class="single">
                            <img class="prev" src="<?= base_url().'upload/Product/'.$img['img_name'] ?>"  style="height:70px; width:70px;" alt="No Image">
                        </div>
                    <?php endforeach; ?>    
                </td>

                 <td  width="" style="text-align:center">
                    <div class="form-group form-md-line-input form-md-floating-label"><?=$item['item_detail']['item_location'] ?></div>
                </td>

                <td  width="" style="text-align:center">
                <div class="form-group form-md-line-input form-md-floating-label">
                    <textarea readonly rows="5" cols="35"><?php echo wordwrap($item['item_detail']['item_description'], 40, "\n", true); ?></textarea>
                </div>
                </td>
                <td style="text-align:center">
                    <span class="remove_attribute" id="<?=$item['item_detail']['item_id'] ?>">
                        <i class="fa fa-minus-circle"></i>
                    </span>

                    <span class="edit_attribute_of_copy" data-id="<?=$i ?>" data-newitem_id="<?php echo $item['item_detail']['item_id']; ?>" data-newimage_id="<?php echo $item['image_array'][$j]['img_id'] ?>">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                    </span>
                </td>
            </tr>
		<?php  $i++ ; endforeach  ?>
	<?php endif; ?>


