<!DOCTYPE html>
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title>Reset Password</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="#1 selling multi-purpose bootstrap admin theme sold in themeforest marketplace packed with angularjs, material design, rtl support with over thausands of templates and ui elements and plugins to power any type of web applications including saas and admin dashboards. Preview page of Theme #1 for "
            name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?php echo base_url(); ?>assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="<?php echo base_url(); ?>assets/pages/css/login-4.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> 
        <style type="text/css">
            #result_error{position: absolute;top: 88px;width: 23%;right: 0px;height: auto;z-index: 105;text-align: center;font-weight: normal;padding-top: 20px;padding-bottom: 20px;font-size: 14px;font-weight: bold;color: white;background-color: #d9534f;}
        </style>
    </head>
    <!-- END HEAD -->

    <body class=" login">
        <!-- BEGIN LOGO -->
        <div class="logo">
            <!-- <a href="index.html">
                <img src="<?php echo base_url(); ?>assets/pages/img/logo-big.png" alt="" /> </a> -->
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        
              
                    <?php if ($this->session->flashdata('message')): ?>
                        <div id="result" style="display: none;"></div>
                    <?php endif;?>
                    <?php if ($this->session->flashdata('error')): ?>
                        <div id="result_error" style="display: none;"></div>
                    <?php endif;?>
        <div class="content">
            <!-- BEGIN LOGIN FORM -->
            
            <!-- END LOGIN FORM -->
            <!-- BEGIN FORGOT PASSWORD FORM -->
            <form class="login-form" action="<?php echo base_url('reset-password') ?>" id="reset_pwd_form" method="post">
                <h3>Reset Password</h3>
                <p> Enter your New Password for reset Password. </p>
                <div class="form-group">
                    <div class="input-icon">
                        <i class="fa fa-envelope"></i>
                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                        <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="New password" required="" name="password" /> </div>
                </div>
                <div class="form-actions">
                   <!--  <button type="button" id="back-btn" class="btn red btn-outline">Back </button> -->
                    <button type="submit" class="btn green pull-right"> Submit </button><br>
                </div>
            </form>
            <!-- END FORGOT PASSWORD FORM -->
        </div>
        
        <script src="<?php echo base_url(); ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        
        <script src="<?php echo base_url(); ?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
       
        <script src="<?php echo base_url(); ?>assets/global/scripts/app.min.js" type="text/javascript"></script>
    
        <script src="<?=base_url()?>assets/pages/scripts/custom.js"></script>

        <?php if ($this->session->flashdata('error')): ?>
            <script type="text/javascript">
                $("#result_error").fadeIn("slow").append("<?php echo $this->session->flashdata('error'); ?>");
                setTimeout(function() {
                    $("#result_error").fadeOut("slow");
                }, 5000);
            </script>
        <?php endif;?>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
    </body>

</html>