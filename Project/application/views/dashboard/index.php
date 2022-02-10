<div class="page-content-wrapper" data-bind="dashboard-active-page-link">
    <div class="page-content">
        <div id="result_message" style="display: none;"></div>
        <div id="result_error_message" style="display: none;"></div>
        <?php if ($this->session->flashdata('message')) {?>
        <div id="result" style="display: none;"></div>
        <?php } else if ($this->session->flashdata('error')) {?>
        <div id="result_error" style="display: none;"></div>
        <?php } else {}?>
        <h1 class="page-title"> Stay tunned We are comming soon <?=$this->session->userdata('name'); ?> </h1>
        <div class="clearfix"></div>
</div>
</div>
<!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->
<!-- BEGIN QUICK SIDEBAR -->
</div>
<!-- END CONTAINER -- >