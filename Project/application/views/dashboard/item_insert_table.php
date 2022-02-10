<?php if(!empty($items)) {
    $i=1; foreach ($items as $item) { ?>
        <tr id="<?=$item['item_detail']['item_id']?>" class="<?php echo createSlug($item['item_detail']['item_category']); ?>">
            <td width="" style="text-align:center">
                <div class="form-group form-md-line-input form-md-floating-label"><?=$item['item_detail']['item_name']  ?><input type="hidden" name="item_ids[]" value="<?=$item['item_detail']['item_id']  ?>"/></div>
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
            <td  width="" style="text-align:center" id="get_loc">
                <div id="getlocation" class="form-group form-md-line-input form-md-floating-label"><?=$item['item_detail']['item_location'] ?></div>
            </td>
            <td style="text-align:center"><span class="remove_attribute" id="<?=$item['item_detail']['item_id'] ?>"><i class="fa fa-minus-circle"></i></span><span class="edit_attribute" data-id="<?=$item['item_detail']['item_id'] ?>" ><i class="fa fa-pencil" aria-hidden="true"></i></span></td>
        </tr>
    <?php  $i++ ; } ?>
<?php } ?>