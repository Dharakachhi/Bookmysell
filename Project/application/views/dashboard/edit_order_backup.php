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

        <div id="result_error" style="display: none;"></div>

        <?php } else {} //echo "<pre>"; print_r($result);exit;?>

        <h1 class="page-title"> This is Your Order  <?=$this->session->userdata('name'); ?> </h1> <a style="float: right;" href="<?= base_url('vieworder') ?>" class="btn btn-success"> <i class="fa fa-arrow-left"></i> Back</a>

        <div class="clearfix"></div>

        <div class="row">

            <div class="col-lg-12 ">

                <form action="<?= base_url('updateordermaster/'.$orderitem) ?>" id="new_order_form" method="post" enctype="multipart/form-data" >



                    <div class="row">

                        <div class="form-group col-md-4">

                        <label>Full Name </label>
                         <input type="hidden" name="contract_sts" id="contract_sts" value="<?= $contract ?>">
                        <input type="text" name="requesttitle" id="request_title" class="form-control" value="<?= $order['request_title']?>">

                         <?php if(isset($errors['requesttitle'])): ?>

                            <label class="text-danger"><?=$errors['requesttitle']; ?></label>

                        <?php endif; ?>

                    </div>

                     <div class="form-group col-md-4">

                        <label>Phone </label>

                        <input type="text" name="phone" id="phone" class="form-control" value="<?= $order['phone']?>">

                         <?php if(isset($errors['phone'])): ?>

                            <label class="text-danger"><?=$errors['phone']; ?></label>

                        <?php endif; ?>

                    </div>

                    <div class="form-group col-md-4">

                        <label>Address </label>

                        <input type="text" name="location"  id="request_location" class="form-control" value="<?= $order['location']; ?>" >

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

                                            <tbody class="attribute_data">
                                               

                                                <?php

                                                $temp_id = 0;
                                                    echo "<pre>";
                                                    print_r ($location);
                                                    echo "</pre>";exit;

                                                foreach ($location as $key => $value) {


                                                 ?>

                                                    <tr id="temp_<?= $item['item_detail']['item_location'] ?>">

                                                    <td class="panel-heading" colspan="7"><b>Location : &nbsp;<?= $key ?></b></td>

                                                </tr>

                                                <?php $j = 0; foreach ($value as $items => $item) {

                                                ?>

                                                  <tr id="<?php echo $j ?>">

                                                   <!--  <td>

                                                        <div class="form-group form-md-line-input form-md-floating-label">

                                                            <?=$i ?>

                                                        </div>

                                                    </td> -->

                                                    <td width="" style="text-align:center">

                                                        <div class="form-group form-md-line-input form-md-floating-label"><?=$item['item_name']  ?></div>

                                                    </td>

                                                    <td  width="" style="text-align:center">

                                                        <div class="form-group form-md-line-input form-md-floating-label"><?=

                                                         "$ ". number_format($item['item_price'],2); ?></div>

                                                    </td>

                                                    <td  width="" style="text-align:center">

                                                        <div class="form-group form-md-line-input form-md-floating-label"><?=$item['item_quantity'] ?></div>

                                                    </td>

                                                    <td  width="" style="text-align:center">

                                                            <div class="imageContainer clearfix single">

                                                        <?php foreach ($item_image[$temp_id] as $img):



                                                            ?>
                                                             <a class="imageLink" href="<?= base_url().'upload/Product/'.$img['img_name'] ?>?raw=<?= $temp_id ?>" >
                                                             <img class="" src="<?= base_url().'upload/Product/'.$img['img_name'] ?>?raw=<?= $temp_id ?>" width="80px" height="80px">
                                                            </a>

                                                                <!-- <img class="prev" src="<?= base_url().'upload/Product/'.$img['img_name'] ?>"  style="height:70px; width:70px;" alt="No Image"> -->

                                                        <?php endforeach; ?>

                                                            </div>

                                                    </td>

                                                     <td  width="" style="text-align:center">

                                                        <div class="form-group form-md-line-input form-md-floating-label"><?=$item['item_location'] ?></div>

                                                    </td>

                                                  <!--   <td  width="" style="text-align:center">

                                                        <div class="form-group form-md-line-input form-md-floating-label" style="padding: 0px; border: 0px "><textarea readonly rows="5" cols="35"><?= wordwrap($item['item_description'],40,"\n",true); ?></textarea></div>

                                                    </td> -->

                                                    <td style="text-align:center" data-newitem_id="<?= $getdata[$temp_id]; ?>">

                                                        <span class="remove_attribute" id="<?=$getdata[$temp_id] ?>" >

                                                            <i class="fa fa-minus-circle"></i>

                                                        </span>

                                                        <span class="edit_attribute_of_copy" data-id="<?=$item['item_id'] ?>"  data-newitem_id="<?php echo $getdata[$temp_id]; ?>" data-newimage_id="<?php echo $getimage[$temp_id] ?>">

                                                            <i class="fa fa-pencil" aria-hidden="true"></i>

                                                        </span>

                                                    </td>

                                                </tr>

                                                <?php  $temp_id++; $j++;}  } //exit;//}  ?>


                                            <?php  //$j ++; $i++; endforeach; ?>

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

                    <div class="portlet box col-md-6">

                        <div class="body-border">

                            <h4>Contract Aggrement</h4>

                        </div>

                            <div class="row">

                                <div class="col-6">

                                    <div class="col-md-12">

                                        <p>מודה אני הח"מ
        <b><?= $order[0]['request_title'] ?></b><br><br>
      הדר בבית \ בדירה \ בחדר, המסומן במספר: <b><?= $order[0]['location'] ?></b><br><br>

      אשאני מוכר במכירה מלאה מעכשיו ללא כל תנאי לישראל (קרא בתגובה כללית)<br>
          כל הדברים חמוצים וסוגי חמץ ואור ותערובות של חמץ וחמץ נוקשה וכדומה ופירורי חמץ שנמצאים ברשותי
      <br><br>(See attached document for itemized list of where chometz stored) :u7 1 DUD

      <br>נמכר מעכשיו לפי מקח השוה להערל הקונה החמץ, וגם כל מיני המץ גמור או המץ נוקשה בעין או תערובות המץ או דבר שיש בו חשש חמץ הנמצאים ברשותי הנ"ל שלא נפרשו כאן, הכל אני מוכר במכירה גמורה להא"י הנ"ל לפי מקח השוה בשוק, וגם אם יש חפץ שנדבק בדופני הכלים כגון: כלי לישה, ואפי', וכאו"ש, וסכו"ם וכדומה, וגם פירורי המץ וחמץ הנדבק בספרים ובכ"ס שהוא אני מוכר להא"י הנ"ל לפי מקה השוה בשוק, וכן כלים שעניני של המץ אוכלין ומשקאות מונחים ועומדים שם הם בשאלה אצלו, ומה שלא נפרטו (ששכחתי) איזה מין המץ או ת"ח או המ"ב או פיר"ה בכל מקום שהוא בבעלותי וברשותי הכל במכירה גמורה, ושכירת וקנין מקום הנ"ל להא"י הקונה החמץ במחיר S ואגב קבין שכירת המקום הנ"ל יהי' קנוי לו כל ההמץ שמינח שם ביתר שאת וביתר עז, כל זה נעשה בכל יפוי כח

      עפ"י דתורה"ק ובנמוסי המדינה הנהוגים בענין שאין בו אסמכתא ולא כטופסי דשטרא. <br><br>

      באעה"ה <br><br>

      לחודש ניסן תשפ"א לפ"ק
      <br><br>
      </p>

                                    </div>

                                    <div class="col-md-12">

                                        <div class="form-check">

                                            <input class="form-check-input" type="checkbox" id="defaultCheck1" name="contact_chk" value="1">

                                             <?php if(isset($errors['contact_chk'])): ?>

                                                <label class="text-danger"><?=$errors['contact_chk']; ?></label>

                                            <?php endif; ?>

                                            <label class="form-check-label" for="defaultCheck1">

                                            Check to accept and sigin below

                                            </label>

                                        </div>

                                    </div>

                                    <div class="col-md-12">

                                        <div class="sigPad" id="smoothed_contact" style="width:404px;">

                                        <h5>Signature</h5>

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

                        </div>

                          <div class="portlet box col-md-6">

                        <div class="body-border">

                            <h4>Power of Attorney Aggrement</h4>

                        </div>

                            <div class="row">

                                <div class="col-md-12">

                                   <img src="upload/power-of-atrony.png" width="100%" height="auto">

                                    </div>

                                <div class="col-md-12">

                                    <div class="form-check">

                                        <input class="form-check-input" type="checkbox" id="defaultCheck2" name="attrny_chk" value="1">

                                         <?php if(isset($errors['attrny_chk'])): ?>

                                                <label class="text-danger"><?=$errors['attrny_chk']; ?></label>

                                            <?php endif; ?>

                                        <label class="form-check-label" for="defaultCheck2">

                                       Check to accept and sigin below

                                        </label>

                                    </div>

                                </div>

                                <div class="col-md-12">

                                    <div class="sigPad" id="smoothed_attrony" style="width:404px;">

                                    <h5>Signature</h5>

                                    <ul class="sigNav">

                                        <li class="clearButton"><a href="#clear">Clear</a></li>

                                    </ul>

                                        <div class="sig sigWrapper" style="height:auto;">

                                            <div class="typed"></div>

                                            <canvas class="pad" id="attrony_can" width="400" height="100"></canvas>

                                            <input type="hidden" name="attrny_output" class="output">

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

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
