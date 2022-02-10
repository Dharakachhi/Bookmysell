<link rel="stylesheet" type="text/css" href="<?= base_url('/assets/pages/css/switch.css')?>">
<div id="result_message" style="display: none;"></div>
        <div id="result_error_message" style="display: none;"></div>
        <?php if ($this->session->flashdata('message')) {?>
        <div id="result" style="display: none;"></div>
        <?php } else if ($this->session->flashdata('error')) {?>
        <div id="result_error" style="display: none;"></div>
        <?php } else {}?>
                <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
                        <!-- BEGIN PAGE HEADER-->
                        <!-- BEGIN THEME PANEL -->
                        <h1 class="page-title"> User List </h1>
                        <!-- END PAGE TITLE-->
                        <!-- END PAGE HEADER-->
                        <div class="row">
                            <div class="col-md-12">
                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                <div class="portlet light portlet-fit bordered">
                                    <div class="portlet-body">
                                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                                            <thead>
                                                <tr>
                                                    <th> Name </th>
                                                    <th> Email </th>
                                                    <th> Phone </th>
                                                    <th> Contract Action </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i=1; foreach ($user as $key => $value) { 
                                                    ?>
                                                    
                                                    <tr>
                                                        <td> <?= $value->name ?></td>
                                                        <td> <?= $value->email ?></td>
                                                        <td> <?= $value->phone ?> </td>
                                                        <td class="center">
                                                            <div class="switch-field">
                                                                <input type="radio" id="radio-<?= $key ?>" class="contract_req" data-userid="<?= $value->id ?>" name="switch-<?= $key ?>" value="yes" <?php echo ($value->contract=='yes')?'checked':'' ?>/>
                                                                <label for="radio-<?= $key ?>">Yes</label>
                                                                <input type="radio" id="radio-<?= substr($value->created_date, -7);; ?>" class="contract_req" data-userid="<?= $value->id ?>" name="switch-<?= $key ?>" value="no" <?php echo ($value->contract=='no' || $value->contract == '')?'checked':'' ?>/>
                                                                <label for="radio-<?= substr($value->created_date, -7);; ?>">No</label>
                                                                
                                                            </div>
                                                            <div>
                                                                
                                                            </div> 
                                                        </td>
                                                    </tr>
                                                <?php $i++; } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- END EXAMPLE TABLE PORTLET-->
                            </div>
                        </div>
                    </div>
                    <!-- END CONTENT BODY -->
                </div>
                <!-- END CONTENT -->
                <!-- BEGIN QUICK SIDEBAR -->
            </div>
            <!-- END CONTAINER -->
        </div>
       
        <script src="<?php echo base_url(); ?>assets/pages/scripts/table-datatables-editable.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
    