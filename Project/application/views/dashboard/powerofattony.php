<!DOCTYPE html>
<html>
<style type="text/css">
  .page { width: 100%; height: 100%; }
  /*.wrapper-page {
    page-break-after: always;
}*/
.wrapper-page:last-child {
    page-break-after: avoid;
}
  body{
  /*background-color:#333;*/
  font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
  color:#333;
  text-align:left;
  font-size:18px;
  margin:0;
}
.container{
  margin:0 auto;
  margin-top:35px;
  padding:40px;
  /*width:50px;*/
  height:auto;
  background-color:#fff;
}
caption{
  font-size:28px;
  margin-bottom:15px;
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
h4, p{
  margin:0px;
}
.page {
  padding: 50px 80px;
  margin: 50px;
  background: white;
  box-shadow: 2px 2px 2px rgba(0,0,0,0.6);
  max-width: 800px;
  min-width: 500px;
}
 div.c {
        text-align: right;
    }
</style>
<head>
  <title>Invoice</title>
</head>
<body>
  <div class="wrapper-page">
  	<?php

  		// echo "<pre>";
  		// print_r($im2);exit;
  	?>
  	<!-- <img src="upload/signatures/60537bb6c2c27.jpeg" width="300px" style="float:right;" > -->
    <!-- <h2 style="text-align: center">Power of Attorny</h2>                       -->
    <img src="upload/power-of-atrony.jpg" width="100%" height="auto">
     <!-- <table>
      <?php foreach ($order as $value) { ?>
       <tr>
         <td>
         <?php if(file_exists("upload/signatures/".$value)){ ?>
          <img src="upload/signatures/<?= $value ?>" width="500px" style="float:right;" >
       <?php } ?>
         </td>
       </tr>
     <?php } ?>
     </table> -->
     <div class="c">
      <?php foreach ($order as $value) {
        if(file_exists("upload/signatures/".$value)){ ?>
         <p> <img src="upload/signatures/<?= $value ?>" width="300px" style=""></p>
        <?php } } ?>
        </div>
  </div>
</body>
</html>