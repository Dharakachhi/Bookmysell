   <style type="text/css">
    ::selection {
        background-color: #E13300;
        color: white;
    }

    ::-moz-selection {
        background-color: #E13300;
        color: white;
    }

    body {
        background-color: #fff;
        margin: 40px;
        font: hebrew;
        ;
        color: #4F5155;
    }

    a {
        color: #003399;
        background-color: transparent;
        font-weight: normal;
    }

    h1 {
        color: #444;
        background-color: transparent;
        border-bottom: 1px solid #D0D0D0;
        font-size: 19px;
        font-weight: normal;
        margin: 0 0 14px 0;
        padding: 14px 15px 10px 15px;
    }

    code {
        font-family: Consolas, Monaco, Courier New, Courier, monospace;
        font-size: 12px;
        background-color: #f9f9f9;
        border: 1px solid #D0D0D0;
        color: #002166;
        display: block;
        margin: 14px 0 14px 0;
        padding: 12px 10px 12px 10px;
    }

    #body {
        margin: 0 15px 0 15px;
    }

    p.footer {
        text-align: right;
        font-size: 11px;
        border-top: 1px solid #D0D0D0;
        line-height: 32px;
        padding: 0 10px 0 10px;
        margin: 20px 0 0 0;
    }

    #container {
        margin: 10px;
        border: 1px solid #D0D0D0;
        box-shadow: 0 0 8px #D0D0D0;
    }

    div.c {
        text-align: right;
    }
    table{

  border:1px solid #333;

  border-collapse:collapse;

  margin:0 auto;

    width:100%;

  /*width:30%;*/

}

td, tr, th{

  padding:12px;

  border:1px solid #333;

  /*width:185px;*/

}

th{

  background-color: #f0f0f0;


}
 .page { width: 100%; height: 100%; }

  .wrapper-page {

    page-break-after: always;

}

/*.wrapper-page:last-child {

    page-break-after: avoid;

}*/
    </style>
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Invoice</title>
</head>

<body>
      <div class="wrapper-page">
        <div id="container " style="padding: 10px;">
            <div class="c">
                <p style="font-family:dejavusans;">  <b><?= ucfirst($order[0]['request_title']) ?> </b>מודה אני הח"מ  </p>
                <p style="font-family:hebrew;"> <b><?=ucfirst($order[0]['location']) ?></b>  הדר בבית \ בדירה \ בחדר, המסומן במספר: </p>
                <p style="font-family:hebrew;">  (אשר אני מוכר במכירה גמורה מעכשיו בלי שום תנאי לא"י (הנקוב בשמו בשטר כללי <span>כל הדברים חמוצים ומיני חמץ ושאור ותערובות חמץ וחמץ נוקשה וכדומה ופירורי חמץ שנמצאים ברשותי</span> </p>
                <p style="font-family:hebrew;">(See attached document for itemized list of where chometz stored) הנ"ל ומפורטים כדלהלן דהיינו:</p>
                <p style="font-family:hebrew;">  נמכר מעכשיו לפי מקח השוה להערל הקונה החמץ, וגם כל מיני חמץ גמור או חמץ נוקשה בעין או תערובות חמץ או דבר שיש בו חשש חמץ הנמצאים ברשותי הנ"ל שלא נפרטו כאן, הכל אני מוכר במכירה גמורה להא"י הנ"ל לפי מקח השוה בשוק, וגם אם יש חפץ שנדבק בדופני הכלים כגון: כלי לישה, ואפי', וכאו"ש, וסכו"ם וכדומה, וגם פירורי חמץ וחמץ הנדבק בספרים ובכ"מ שהוא אני מוכר להא"י הנ"ל לפי מקח השוה בשוק, וכן כלים שעניני של חמץ אוכלין ומשקאות מונחים ועומדים שם הם בשאלה אצלו, ומה שלא נפרטו (ששכחתי) איזה מין חמץ או ת"ח או חמ"נ או פיר"ח בכל מקום שהוא בבעלותי וברשותי הכל במכירה גמורה, ושכירת וקנין מקום הנ"ל להא"י הקונה החמץ במחיר ___$ ואגב קנין שכירת המקום הנ"ל יהי' קנוי לו כל החמץ שמונח שם ביתר שאת וביתר עז, כל זה נעשה בכל יפוי כח עפ"י דתורה"ק ובנמוסי המדינה הנהוגים בענין שאין בו אסמכתא ולא כטופסי דשטרא. </p>
                <p style="font-family:hebrew;">  דתורה"ק ובנמוסי המדינה הנהוגים בענין שאין בו אסמכתא ולא כטופסי דשטרא. </p>
               <!--  <p style="font-family:hebrew;"> <b><?= date("M d Y")  ?></b>  דשטרא. </p>
                <p style="font-family:hebrew;"> באעה"ה  </p> -->
                <p style="font-family:hebrew;">   באעה"ח לחודש ניסן תשפ"א לפ"ק</p>
            </div>
                <p>sign: <img src="<?= 'upload/signatures/'.$order[0]['signature_contact']; ?>" width="200px" style="border-bottom: 2px solid #333; margin-bottom: 15px;"></p>
        </div>
    </div>
<div class="wrapper-page">

  <table width="100%" style="margin-bottom: 20%">

    <caption>

     Order Items

    </caption>

    <thead>

      <tr>

        <th colspan="4" width="90%"><p class="text-left">Name: &nbsp;<?= $order[0]['request_title']; ?></p> </th>

        <!-- <th colspan="2"><p class="text-left">Phone: &nbsp;<?= $order[0]['phone']; ?></p></th> -->

        <th colspan="1"><p class="text-left">Date:&nbsp; <?= date("M d Y") ?></p></th>


      </tr>

      <tr>
        <!-- <th colspan="4" width="90%"><p class="text-left">Address: &nbsp;<?= $order[0]['location']; ?></p> </th> -->
        <th colspan="4" width="90%">

          <p style="text-align: center !important;">Address:&nbsp; <?= $order[0]['location'] ?></p>

        </th>
        <th colspan="1"><p class="text-left">Phone: &nbsp;<span class="break"><?= '('.substr($order[0]['phone'], 0, 3).') '.substr($order[0]['phone'], 3, 3).'-'.substr($order[0]['phone'],6); ?></span></p></th>
      </tr>

       <!--  <td colspan="3">

          <h4>Customer:John Smith<br></h4>

        </td> -->

     <!--  </tr>

       <tr>

        <th colspan="3"><p class="text-left">City: &nbsp;<?= $order[0]['request_title']; ?></p> </th>

        <th colspan="2">State : <p class="text-left"><?= $order[0]['location'] ?></p></th>

        <th colspan="1">Zipcode : <p class="text-left"><?= date("d M Y") ?></p></th>

      </tr> -->

    </thead>

    <tbody>

      <tr>

        <th width="20%">Item</th>

        <th width="5%">Quantity</th>

        <th width="15%">Price</th>

        <!-- <th width="10%">Desc</th> -->

        <th width="20%">Location</th>

        <th width="30%">Image</th>


      </tr>

      <?php  $total = 0; foreach ($item as $key => $value) { ?>

        <tr>

          <td width="20%"><?= $value['item_name']?></td>

          <td width="5%"><?= $value['item_quantity']?></td>

          <td width="15%"><?php setlocale(LC_MONETARY, 'en_US.UTF-8'); echo  money_format('%.2n', $value['item_price']) . "\n"; ?></td>

          <!-- <td width="10%"><?= $value['item_description']?></td> -->

          <td width="20%"><?= $value['item_location']; ?></td>

          <td width="30%">

            <div class="column">

            <?php foreach ($img[$value['item_name']] as $ke => $val) { ?>

                  <img class="gallery" src="<?= 'upload/Product/'.$val['img_name'] ?>"  style="height:70px; width:70px; padding: 5px; margin-top: 5px;">

              <?php  } $total = $total += $value['item_price']?>

              </div>

          </td>


         </tr>

      <?php }?>

    </tbody>

    <tfoot>

      <tr>

        <th colspan="2">Grand Total</th>

        <td colspan="3"><b><?php setlocale(LC_MONETARY, 'en_US.UTF-8'); echo  money_format('%.2n', $total) . "\n"; ?></b></td>

      </tr>

    </tfoot>

  </table>

   <?php if($order[0]['signature_contact'] != '') { ?>

      <table id="sing" style=" border: 0px solid #CCC; border-collapse: collapse;">

        <tbody>

          <tr class="border">

            <!-- <td style=" border: none;"><img src="<?= 'upload/signatures/'.$order[0]['signature_attorney']; ?>" width="500px"><hr><h4>Attorney Signature</h4></td> -->

            <td style=" border: none;"><img src="<?= 'upload/signatures/'.$order[0]['signature_contact']; ?>" width="200px" style="border-bottom: 2px solid #333; margin-bottom: 15px;"> <!-- <hr width="10%;" style="float: left;"> --><h4>Contact Signature</h4></td>

          </tr>

        </tbody>

     </table>
    <?php } ?>
</div>




<!-- new -->

            <div class="row">
                <table width="100%">
                    <tr>
                        <th colspan="4" class="header">INVOICE</th>
                    </tr>
                    <thead>
                      <tr class="thead">
                            <th>Item</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Image</th>
                        </tr>
                    </thead>
                    <thead>
                        <tr>
                            <th width="20%" colspan="2">Address: ABC1</th>
                            <th width="20%" colspan="2">Category: TEST1</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>
                                DATA1
                            </td>
                            <td>
                              DATA2
                            </td>
                            <td>
                                Data3
                            </td>
                            <td >
                               Data4
                            </td>
                        </tr>

                        <tr>
                            <td>ABC1</td>
                            <td>ABC1</td>
                            <td>ABC1</td>
                            <td>ABC1</td>
                        </tr>
                    </tbody>
                </table>
            </div>







</body>

</html>



<?php

// controller method
public function printorder($id) {


// new

    // $img = array();

    $data['item'] = $this->Common_model->getResultArray(array('order_id'=>$id),'*','order_item');

    $data['order'] = $this->Common_model->getResultArray(array('ord_id'=>$id),'*','order_master');

    $data['location'] = $this->Common_model->distinct($id);

    foreach ($data['item'] as $key => $value) {

      // echo $value['item_id'];

       // $data['img'][] = $this->Common_model->getResultArray(array('product_id'=>$value['item_id']),'*','orderitem_image');

       $img[$value['item_name']] = $this->Common_model->getResultArray(array('product_id'=>$value['item_id']),'*','orderitem_image');

    }


     $data['img'] = $img;

     $mpdf = new \Mpdf\Mpdf([
          'mode' => 'utf-8',
          'format' => [190, 236],
          'orientation' => 'L'
      ]);
        $html = $this->load->view('dashboard/mpdf',$data,true);
        $mpdf->WriteHTML($html);
        $mpdf->Output(); // opens in browser
    // $this->load->library('pdf');

    // $html = $this->load->view('dashboard/invoice.php', $data, true);
    // $this->pdf->createPDF($html, 'pdf', false, 'A4', 'portrait',array ("Attachment" => false));

  }


?>