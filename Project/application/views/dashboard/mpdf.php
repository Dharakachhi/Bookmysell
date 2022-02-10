   <style type="text/css">
    
    ::selection {
        background-color: #E13300;
        color: white;
    }

    ::-moz-selection {
        background-color: #E13300;
        color: white;
    }
    .border { border-bottom: 1px solid #333;  }
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
        /*margin: 2px;*/
        border: 1px solid #D0D0D0;
        box-shadow: 0 0 4px #D0D0D0;
    }

    div.c {
        text-align: right;
        font-size: 13px;
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
  font-size: 12px;
  /*width:185px;*/

}
th{

  background-color: #f0f0f0;


}
@page {  
    header: html_otherpageheader;
    footer: html_otherpagesfooter;
}

@page :first {    
    header: html_firstpageheader;
    footer: html_firstpagefooter;
}
 .page { width: 100%; height: 100%; }

 /* .wrapper-page {

    page-break-after: always;

}*/

/*.wrapper-page > *:last-child {
    page-break-after: always;
}*/

/*.wrapper-page:last-child {

    page-break-after: always;

}*/
    </style>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Invoice</title>
</head>
<body>
  <htmlpageheader name="firstpageheader" style="display:none">
    <div style="text-align:center" style="display: none"> first page header</div>
</htmlpageheader>

<htmlpagefooter name="firstpagefooter" style="display:none">
    <div style="text-align:center">first page footer</div>
</htmlpagefooter>

<htmlpageheader name="otherpageheader" style="display:none">
    <div style="text-align:center"> all page Header</div>
</htmlpageheader>

<htmlpagefooter name="otherpagesfooter" style="display:none">
    <div style="text-align:center">all page footer </div>
</htmlpagefooter>
      <div class="wrapper-page" style="page-break-after: always;">
        <div id="container " style="padding: 10px;">
            <div class="c">
                <p style="font-family:dejavusans;">  <b><?= ucfirst($order[0]['request_title']) ?> </b>מודה אני הח"מ  </p>
                <p style="font-family:hebrew;"> <b><?=ucfirst($order[0]['location']) ?></b>  הדר בבית \ בדירה \ בחדר, המסומן במספר: </p>
                <p style="font-family:hebrew;">  (אשר אני מוכר במכירה גמורה מעכשיו בלי שום תנאי לא"י (הנקוב בשמו בשטר כללי <span>כל הדברים חמוצים ומיני חמץ ושאור ותערובות חמץ וחמץ נוקשה וכדומה ופירורי חמץ שנמצאים ברשותי</span> </p>
                <p style="font-family:hebrew;">(See attached document for itemized list of where chometz stored) הנ"ל ומפורטים כדלהלן דהיינו:</p>
                <p style="font-family:hebrew;">  נמכר מעכשיו לפי מקח השוה להערל הקונה החמץ, וגם כל מיני חמץ גמור או חמץ נוקשה בעין או תערובות חמץ או דבר שיש בו חשש חמץ הנמצאים ברשותי הנ"ל שלא נפרטו כאן, הכל אני מוכר במכירה גמורה להא"י הנ"ל לפי מקח השוה בשוק, וגם אם יש חפץ שנדבק בדופני הכלים כגון: כלי לישה, ואפי', וכאו"ש, וסכו"ם וכדומה, וגם פירורי חמץ וחמץ הנדבק בספרים ובכ"מ שהוא אני מוכר להא"י הנ"ל לפי מקח השוה בשוק, וכן כלים שעניני של חמץ אוכלין ומשקאות מונחים ועומדים שם הם בשאלה אצלו, ומה שלא נפרטו (ששכחתי) איזה מין חמץ או ת"ח או חמ"נ או פיר"ח בכל מקום שהוא בבעלותי וברשותי הכל במכירה גמורה, ושכירת וקנין מקום הנ"ל להא"י הקונה החמץ במחיר  <b class="border">1 $</b> ואגב קנין שכירת המקום הנ"ל יהי' קנוי לו כל החמץ שמונח שם ביתר שאת וביתר עז, כל זה נעשה בכל יפוי כח עפ"י דתורה"ק ובנמוסי המדינה הנהוגים בענין שאין בו אסמכתא ולא כטופסי דשטרא. </p>

                <!-- <p style="font-family:hebrew;">  דתורה"ק ובנמוסי המדינה הנהוגים בענין שאין בו אסמכתא ולא כטופסי דשטרא. </p> -->
               <!--  <p style="font-family:hebrew;"> <b><?= date("M d Y")  ?></b>  דשטרא. </p>
                <p style="font-family:hebrew;"> באעה"ה  </p> -->
                <?php //echo $order[0]['signature_contact'];exit; ?>
                 <?php if($order[0]['signature_contact'] != '') { ?>
                  <p style="font-family:hebrew;"><b><?= date("M")  ?>___<?php  date("Y") ?><?= date("M d Y")  ?></b>   בבבאעה"ח יום ____ לחודש ניסן תשפ"א לפ"ק   </p>
                <?php } else {  ?> 
                   <p style="font-family:hebrew;"><b><?= date("M")  ?>___<?php  date("Y") ?></b>   בבבאעה"ח יום ____ לחודש ניסן תשפ"א לפ"ק  </p>
                <?php }?>
            </div>
                <!-- <p>sign: <img src="<?= 'upload/signatures/'.$order[0]['signature_contact']; ?>" width="200px" style="border-bottom: 2px solid #333; margin-bottom: 15px;"></p> -->
        </div>
    </div>
        <div class="wrapper-page" style="page-break-after: avoid;">
            <div class="row">
                <table width="100%">
                    <thead>
                      <tr>
                        <th colspan="4" width="90%" align="left"><p class=""> &nbsp;<?= $order[0]['request_title']; ?></p> </th>
                        <th colspan="1" align="left"><p class="">&nbsp; <?= date("M d Y") ?></p></th>
                      </tr>
                      <tr>
                        <th colspan="4" width="90%" align="left">
                          &nbsp; <?= $order[0]['location'] ?>
                        </th>
                        <th colspan="1" align="left">
                           &nbsp;<span class="break"><?= '('.substr($order[0]['phone'], 0, 3).') '.substr($order[0]['phone'], 3, 3).'-'.substr($order[0]['phone'],6); ?></span>
                        </th>
                      </tr>
                    </thead>
                    <thead>
                      <tr class="thead">
                            <th>Item</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Location</th>
                            <th>Image</th>
                        </tr>
                    </thead>

                    <tbody width="100%">
                      <?php $total=0; foreach ($items as $item_id => $itm_value) {
                          // echo "<pre>";
                          // print_r ($itm_value);
                          // echo "</pre>";
                              foreach ($itm_value as $as => $com_value) {
                                 if($as == "PM") {
                                    $loc = "Primary Home";
                                  } elseif($as == "VH"){
                                    $loc = "Vacation Home";
                                  } elseif($as == "OFC" ) {
                                    $loc = "Office";
                                   } elseif($as == "OTHER" ) {
                                    $loc = 'Other';
                                  } else {
                                    $loc = '';
                                  }  ?>
                                <tr>
                                  <th width="20%" colspan="2" align="left"><?= $loc ?></th>
                                  <th width="20%" colspan="3" align="left"><?= $item_id; ?></th>
                              </tr>
                                <?php foreach ($com_value as $key => $loc) {
                                  // echo "<pre>";
                                  // print_r ($loc);
                                  // echo "</pre>";exit;
                                   if($loc['disable-location'] == 1) { ?>
                                       <tr>
                                          <td width="" style="text-align:center" colspan="5">
                                            <p>Entire Location and all chometz on premises</p>
                                          </td>
                                        </tr>
                                   <?php } else { ?>
                          <tr>
                            <td width="20%"><?=$loc['item_name'];  ?></td>
                            <td width="10%"><?=$loc['item_quantity'];  ?></td>
                            <td width="20%"><?php echo  $loc['item_price'] ?></td>
                            <td width="20%"><?=$loc['item_location'];  ?></td>
                            <td width="30%">
                                <div class="column">
                                   <?php foreach ($loc['image'] as $img){ ?>
                                  <img class="gallery" src="<?= 'upload/Product/'.$img['img_name'] ?>"  style="height:70px; width:70px; padding: 5px; margin-top: 5px;">
                                <?php } $total = $total += $loc['item_price'];?>
                                </div>
                            </td>
                        </tr>
                         <?php }   } } }?>
                    </tbody>
                     <tfoot>
                        <tr>
                          <th colspan="2">Grand Total</th>
                          <td colspan="3"><b><?php echo  $total; ?></b></td>
                        </tr>
                    </tfoot>
                </table>

            </div>
                 <?php if($order[0]['signature_contact'] != '') { ?>
                   <!-- <p>sign: <img src="<?= 'upload/signatures/'.$order[0]['signature_contact']; ?>" width="200px" style="border-bottom: 2px solid #333; margin-bottom: 15px;"></p> -->
              <?php } ?>
        </div>
</body>

</html>