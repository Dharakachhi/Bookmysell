
<!DOCTYPE html>

<!-- 

Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.7

Version: 4.7

Author: KeenThemes

Website: http://www.keenthemes.com/

Contact: support@keenthemes.com

Follow: www.twitter.com/keenthemes

Dribbble: www.dribbble.com/keenthemes

Like: www.facebook.com/keenthemes

Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes

Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes

License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.

-->

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->

<!--[if !IE]><!-->

<html lang="en">

    <!--<![endif]-->

    <!-- BEGIN HEAD -->



    <head>

        <meta charset="utf-8" />

        <title>BookMySell</title>

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta content="width=device-width, initial-scale=1" name="viewport" />

        <meta content="#1 selling multi-purpose bootstrap admin theme sold in themeforest marketplace packed with angularjs, material design, rtl support with over thausands of templates and ui elements and plugins to power any type of web applications including saas and admin dashboards. Preview page of Theme #1 for statistics, charts, recent events and reports"

            name="description" />

        <meta content="" name="author" />

        <!-- BEGIN GLOBAL MANDATORY STYLES -->

        <!-- <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" /> -->

        <link href="<?= base_url()?>/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

        <link href="<?= base_url()?>/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />

        <link href="<?= base_url()?>/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

        <link href="<?= base_url()?>/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />

        <!-- END GLOBAL MANDATORY STYLES -->

         

        <!-- BEGIN PAGE LEVEL PLUGINS -->

        <link href="<?= base_url()?>/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />

        <link href="<?= base_url()?>/assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />

        <link href="<?= base_url()?>/assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />

        <link href="<?= base_url()?>/assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" />

        <!-- END PAGE LEVEL PLUGINS -->

        <!-- BEGIN THEME GLOBAL STYLES -->

        <link href="<?= base_url()?>/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />

        <link href="<?= base_url()?>/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />

        <!-- END THEME GLOBAL STYLES -->

        <!-- BEGIN THEME LAYOUT STYLES -->

        <link href="<?= base_url()?>/assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />

        <link href="<?= base_url()?>/assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />

        <link href="<?= base_url()?>/assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />

        <link href="<?= base_url()?>/assets/pages/css/custom.css" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/pages/css/jquery.signaturepad.css">

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.dataTables.min.css">

        <script src="<?= base_url()?>/assets/global/plugins/jquery.min.js" type="text/javascript"></script>



        <!-- END THEME LAYOUT STYLES -->

        <!-- <link rel="shortcut icon" href="favicon.ico" />  -->

        <style type="text/css">         

         /*.se-pre-con {position: fixed;left: 0px;top: 0px;width: 100%;height: 100%;z-index: 9999;background: url(<?php echo base_url(); ?>assets/images/xXYX1tf.gif) center no-repeat #010101b3;}

         .pre-loader {position: fixed;left: 0px;top: 0px;width: 100%;height: 100%;z-index: 9999;background: url(<?php echo base_url(); ?>assets/images/logo.jpg) center no-repeat #fff;}*/         

         #result{position: absolute;top: 88px;width: 30%;right: 0px;height: auto;z-index: 105;text-align: center;font-weight: normal;padding-top: 20px;padding-bottom: 20px;font-size: 14px;font-weight: bold;color: white;background-color: #7fd07ff2;}

         #result_message{position: fixed;top: 88px;width: 30%;right: 0px;height: auto;z-index: 105;text-align: center;font-weight: normal;padding-top: 20px;padding-bottom: 20px;font-size: 14px;font-weight: bold;color: white;background-color: #7fd07ff2;}

         #result_error{position: absolute;top: 88px;width: 30%;right: 0px;height: auto;z-index: 105;text-align: center;font-weight: normal;padding-top: 20px;padding-bottom: 20px;font-size: 14px;font-weight: bold;color: white;background-color: #d9534f;}

         #result_error_message{position: fixed;top: 88px;width: 30%;right: 0px;height: auto;z-index: 105;text-align: center;font-weight: normal;padding-top: 20px;padding-bottom: 20px;font-size: 14px;font-weight: bold;color: white;background-color: #d9534f;}

      </style>



       <input type="hidden" name="hiddenurl" id="hiddenURL" value="<?= base_url() ?>">

    </head>

    <!-- END HEAD -->



    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">

            <div class="ajax-loader" style="display: none;"></div>


        <div class="page-wrapper">

            <input type="hidden" name="baseurl" id="baseurl" value="<?= base_url(); ?>">

            <!-- BEGIN HEADER -->

            <div class="page-header navbar navbar-fixed-top">

                <!-- BEGIN HEADER INNER -->

                <div class="page-header-inner ">

                    <!-- BEGIN LOGO -->

                    <div class="page-logo">

                        <a href="<?= base_url();?>" class="disaable">
                             <h1 class="long-shadow">CONGREGATION AHAVAS DOVID</h1>
                        </a> 
                            <!-- <img src="<?= base_url()?>/assets/layouts/layout/img/logo.png" alt="logo" class="logo-default" /> </a> -->

                        <div class="menu-toggler sidebar-toggler">

                            <span></span>

                        </div>

                    </div>

                    <!-- END LOGO -->

                    <!-- BEGIN RESPONSIVE MENU TOGGLER -->

                    <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">

                        <span></span>

                    </a>

                    <!-- END RESPONSIVE MENU TOGGLER -->

                    <!-- BEGIN TOP NAVIGATION MENU -->

                    <div class="top-menu">

                        <ul class="nav navbar-nav pull-right">

                            <!-- BEGIN NOTIFICATION DROPDOWN -->

                            <!-- DOC: Apply "dropdown-dark" class after "dropdown-extended" to change the dropdown styte -->

                            <!-- DOC: Apply "dropdown-hoverable" class after below "dropdown" and remove data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to enable hover dropdown mode -->

                            <!-- DOC: Remove "dropdown-hoverable" and add data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to the below A element with dropdown-toggle class -->

                           <!--  -->

                            <!-- END NOTIFICATION DROPDOWN -->

                            <!-- BEGIN INBOX DROPDOWN -->

                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->

                            

                            <!-- END INBOX DROPDOWN -->

                            <!-- BEGIN TODO DROPDOWN -->

                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->

                        

                            <!-- END TODO DROPDOWN -->

                            <!-- BEGIN USER LOGIN DROPDOWN -->

                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->

                            <li class="dropdown dropdown-user">

                                <a href="javascript:;" class="dropdown-toggle disaable" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">

                                    <img alt="" class="img-circle" src="<?= base_url()?>/assets/layouts/layout/img/avatar3_small.jpg" />

                                    <span class="username username-hide-on-mobile"> <?= $this->session->userdata('name'); ?> </span>

                                    <i class="fa fa-angle-down"></i>

                                </a>

                                <ul class="dropdown-menu dropdown-menu-default">

                                    <!-- <li>

                                        <a href="page_user_profile_1.html">

                                            <i class="icon-user"></i> My Profile </a>

                                    </li> -->

                                   

                                    <li>

                                        <a href="<?= base_url('logout'); ?>">

                                            <i class="icon-key"></i> Log Out </a>

                                    </li>

                                </ul>

                            </li>

                            

                            <!-- END QUICK SIDEBAR TOGGLER -->

                        </ul>

                    </div>

                    <!-- END TOP NAVIGATION MENU -->

                </div>

                <!-- END HEADER INNER -->

            </div>

            <!-- END HEADER -->