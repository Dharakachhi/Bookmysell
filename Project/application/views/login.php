<style type="text/css">
    .long-shadow {
    text-transform: uppercase;
    font-family : unset;
    font-weight: 500;
    background: linear-gradient(90deg, rgba(255,255,255,1) 50%, rgba(255,63,63,1) 51%, rgba(109,214,239,1) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    font-size: 23px;
}
</style>
<!DOCTYPE html>

<!--[if !IE]><!-->

<html lang="en">

    <!--<![endif]-->

    <!-- BEGIN HEAD -->

    <head>

        <meta charset="utf-8" />

        <title>BookMySell</title>

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta content="width=device-width, initial-scale=1" name="viewport" />

        <meta content="#1 selling multi-purpose bootstrap admin theme sold in themeforest marketplace packed with angularjs, material design, rtl support with over thausands of templates and ui elements and plugins to power any type of web applications including saas and admin dashboards. Preview page of Theme #1 for "

        name="description" />

        <meta content="" name="author" />

        <!-- BEGIN GLOBAL MANDATORY STYLES -->

        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />

        <link href="<?= base_url()?>/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

        <link href="<?= base_url()?>/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />

        <link href="<?= base_url()?>/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

        <link href="<?= base_url()?>/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />

        <link href="<?= base_url()?>/assets/pages/css/custom.css" rel="stylesheet" type="text/css" />



         <!-- END GLOBAL MANDATORY STYLES -->

        <!-- BEGIN PAGE LEVEL PLUGINS -->

        <link href="<?= base_url()?>/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

        <link href="<?= base_url()?>/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />

        <!-- END PAGE LEVEL PLUGINS -->

        <!-- BEGIN THEME GLOBAL STYLES -->

        <link href="<?= base_url()?>/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />

        <link href="<?= base_url()?>/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />

        <!-- END THEME GLOBAL STYLES -->

        <!-- BEGIN PAGE LEVEL STYLES -->

        <link href="<?= base_url()?>/assets/pages/css/login.min.css" rel="stylesheet" type="text/css" />

        <!-- <script src="<?= base_url()?>/assets/global/plugins/jquery.min.js" type="text/javascript"></script> -->

        <!-- END PAGE LEVEL STYLES -->

        <!-- BEGIN THEME LAYOUT STYLES -->

        <!-- END THEME LAYOUT STYLES -->

        <link rel="shortcut icon" href="favicon.ico" /> </head>

        <!-- END HEAD -->

        <input type="hidden" name="hiddenurl" id="hiddenURL" value="<?= base_url() ?>">

         <style type="text/css">         

         /*.se-pre-con {position: fixed;left: 0px;top: 0px;width: 100%;height: 100%;z-index: 9999;background: url(<?php echo base_url(); ?>assets/images/xXYX1tf.gif) center no-repeat #010101b3;}

         .pre-loader {position: fixed;left: 0px;top: 0px;width: 100%;height: 100%;z-index: 9999;background: url(<?php echo base_url(); ?>assets/images/logo.jpg) center no-repeat #fff;}*/         

         #result{position: absolute;top: 88px;width: 30%;right: 0px;height: auto;z-index: 105;text-align: center;font-weight: normal;padding-top: 20px;padding-bottom: 20px;font-size: 14px;font-weight: bold;color: white;background-color: #7fd07ff2;}

         #result_message{position: fixed;top: 88px;width: 30%;right: 0px;height: auto;z-index: 105;text-align: center;font-weight: normal;padding-top: 20px;padding-bottom: 20px;font-size: 14px;font-weight: bold;color: white;background-color: #7fd07ff2;}

         #result_error{position: absolute;top: 88px;width: 30%;right: 0px;height: auto;z-index: 105;text-align: center;font-weight: normal;padding-top: 20px;padding-bottom: 20px;font-size: 14px;font-weight: bold;color: white;background-color: #d9534f;}

         #result_error_message{position: fixed;top: 88px;width: 30%;right: 0px;height: auto;z-index: 105;text-align: center;font-weight: normal;padding-top: 20px;padding-bottom: 20px;font-size: 14px;font-weight: bold;color: white;background-color: #d9534f;}

      </style>

        <body class=" login">

<!-- BEGIN LOGO -->

<div class="logo">


 <h1 class="long-shadow">CONGREGATION AHAVAS DOVID</h1>
    <!-- <img src="<?= base_url()?>/assets/pages/img/logo-big.png" alt="" />  -->

</div>

<?php if($this->session->flashdata('message')){ ?>

<div id="result" class="alert alert-info" style="display: none;"></div>

<?php } else if($this->session->flashdata('error')){ ?>

<div id="result_error" class="alert alert-danger" style="display: none;"></div>

<?php } else{} ?>

<div class="content">

    <!-- BEGIN LOGIN FORM -->

    <form class="" id="loginform" action="<?=base_url('login/user'); ?>" method="POST" >

        <h3 class="form-title font-green">Sign In</h3>

        <div class="alert alert-danger display-hide">

            <button class="close" data-close="alert"></button>

            <span> Enter any username and password. </span>

        </div>

        <div class="form-group">

            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->

            <label class="control-label visible-ie8 visible-ie9">Email</label>

            <input class="form-control form-control-solid placeholder-no-fix" type="email" autocomplete="off" placeholder="Email" name="email" /> 

            <?php if(isset($errors['email'])): ?>

            <label class="text-danger"><?=$errors['email']; ?></label>

        <?php endif; ?></div>

            <div class="form-group">

                <label class="control-label visible-ie8 visible-ie9">Password</label>

                <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" /> 

              <?php if(isset($errors['password'])): ?>

            <label class="text-danger"><?=$errors['password']; ?></label>

        <?php endif; ?></div>

                <div class="form-actions">

                    <button type="submit" class="btn green uppercase golin">Login</button>

                    

                    <a href="<?= base_url('forgetpassword'); ?>" id="forget-password" class="forget-password">Forgot Password?</a>

                </div>

                <div class="create-account">

                    <p>

                        <a href="<?=base_url('register')?>" id="register-btn" class="uppercase">Create an account</a>

                    </p>

                </div>

            </form>

</div>

<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script> -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script> -->
<script src="<?= base_url()?>/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>

<script src="<?= base_url()?>/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script> 



 <script src="<?php echo base_url(); ?>assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>assets/global/scripts/app.min.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>



 <!-- BEGIN DATATABLE PLUGINS -->

<script src="<?php echo base_url(); ?>assets/global/scripts/datatable.js" type="text/javascript"></script>

<!-- END DATATABLE PLUGINS -->

<script src="<?= base_url()?>/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>

<!-- BEGIN PAGE LEVEL SCRIPTS -->

<script src="<?php echo base_url(); ?>assets/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>

<!-- END PAGE LEVEL SCRIPTS -->



 <script src="<?=base_url()?>assets/pages/scripts/flashcanvas.js"></script>

<script src="<?php echo base_url() ?>assets/pages/scripts/json2.min.js" type="text/javascript"></script>

<script src="<?php echo base_url() ?>assets/pages/scripts/jquery.signaturepad.js" type="text/javascript"></script>

<script src="<?=base_url()?>assets/pages/scripts/custom.js"></script>

<script src="<?=base_url()?>assets/pages/scripts/validations.js"></script>



<?php if($this->session->flashdata('message')){ ?>

    <script type="text/javascript">

        $("#result").fadeIn("slow").append("<?php echo $this->session->flashdata('message'); ?>");

        setTimeout(function() {

            $("#result").fadeOut("slow");

        }, 4000);

    </script>

<?php } else { ?>

    <script type="text/javascript">

        $("#result_error").fadeIn("slow").append("<?php echo $this->session->flashdata('error'); ?>");

        setTimeout(function() {

            $("#result_error").fadeOut("slow");

        }, 7000);

    </script>

<?php } ?>