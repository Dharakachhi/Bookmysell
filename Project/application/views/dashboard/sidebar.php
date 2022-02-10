         <!-- BEGIN HEADER & CONTENT DIVIDER -->

            <div class="clearfix"> </div>

            <!-- END HEADER & CONTENT DIVIDER -->

            <!-- BEGIN CONTAINER -->

            <div class="page-container">

                <!-- BEGIN SIDEBAR -->

                <div class="page-sidebar-wrapper">

                    <!-- BEGIN SIDEBAR -->

                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->

                    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->

                    <div class="page-sidebar navbar-collapse collapse">

                        <!-- BEGIN SIDEBAR MENU -->

                        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->

                        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->

                        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->

                        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->

                        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->

                        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                        <div class="disaable">
                        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">

                            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->

                            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->

                            <li class="sidebar-toggler-wrapper hide">

                                <div class="sidebar-toggler">

                                    <span></span>

                                </div>

                            </li>

                            <!-- END SIDEBAR TOGGLER BUTTON -->

                            <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->

                            <?php

                                 $url = $this->uri->segment(1);



                                 ?>

                          <!--   <li class="nav-item start  " id="dashboard-active-page-link">

                                <a href="<?= base_url('dashboard')?>" class="nav-link ">

                                    <i class="icon-home"></i>

                                    <span class="title">Dashboard</span>

                                    <span class="selected"></span>

                                </a>

                            </li>
 -->
                             <li class="nav-item start " id="vieworder-active-page-link">

                                <a href="<?= base_url('vieworder')?>" class="nav-link ">

                                    <i class="icon-user"></i>

                                    <span class="title">Order List</span>

                                    <span class="selected"></span>

                                </a>

                            </li>

                            <li class="nav-item start" id="placeorder-active-page-link">

                                <a href="<?= base_url('placeorder')?>" class="nav-link ">

                                    <i class=" icon-pencil"></i>

                                    <span class="title">Mechiras Chometz</span>

                                    <span class="selected"></span>

                                </a>

                            </li>
                            <?php  if($this->session->userdata('is_admin') != 0){ ?>

                             <li class="nav-item start" id="placeorder-active-page-link">

                                <a href="<?= base_url('userlisting')?>" class="nav-link ">

                                    <i class=" icon-user"></i>

                                    <span class="title">Userlisting</span>

                                    <span class="selected"></span>

                                </a>

                            </li>

                        <?php } ?>

                        </ul>
                    </div>
                        <!-- END SIDEBAR MENU -->

                        <!-- END SIDEBAR MENU -->

                    </div>

                    <!-- END SIDEBAR -->

                </div>

                <!-- END SIDEBAR -->