<!-- BEGIN FOOTER -->

<div class="page-footer">

    <div class="page-footer-inner"> 2021 &copy; All Rights Rreserved.

    </div>

    <div class="scroll-to-top">

        <i class="icon-arrow-up"></i>

    </div>

</div>

<!-- END FOOTER -->

</div>

<!-- BEGIN QUICK NAV -->

<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

<!-- <script src="<?php echo base_url(); ?>assets/global/plugins/js.cookie.min.js" type="text/javascript"></script> -->

<script src="<?php echo base_url(); ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>assets/global/scripts/app.min.js" type="text/javascript"></script>



<script src="<?php echo base_url(); ?>assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>

<!-- BEGIN DATATABLE PLUGINS -->

<script src="<?php echo base_url(); ?>assets/global/scripts/datatable.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>assets/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>

<!-- <script src="<?php echo base_url();?>assets/global/plugins/jquery-ui/jquery-ui.min.js"></script> -->

<script src="<?= base_url()?>/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>

<script src="<?= base_url()?>/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>

<script src="<?=base_url()?>assets/pages/scripts/flashcanvas.js"></script>

<script src="<?php echo base_url() ?>assets/pages/scripts/json2.min.js" type="text/javascript"></script>

<script src="<?php echo base_url() ?>assets/pages/scripts/jquery.signaturepad.js" type="text/javascript"></script>

<script src="<?=base_url()?>assets/pages/scripts/custom.js?v=2"></script>

<script src="<?=base_url()?>assets/pages/scripts/validations.js"></script>

<script src="<?=base_url()?>assets/pages/scripts/edititem.js"></script>

<!-- END THEME LAYOUT SCRIPTS -->

<script type="text/javascript">

	$(function(){

	var bind_data =  $('.page-content-wrapper').data().bind;

$('#'+bind_data).addClass('active');

});

	

</script>

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

</body>

</html>