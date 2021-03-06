</div>
<!-- end:: Body -->
<!-- begin::Footer -->
<footer class="m-grid__item		m-footer ">
	<div class="m-container m-container--fluid m-container--full-height m-page__container">
		<div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
			<div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last">
				<span class="m-footer__copyright">
					<?php echo date('Y'); ?> &copy;  <a href="<?php echo COMPANY_URL; ?>" class="m-link">
						<?php  echo POWERED_BY_FULL ?>
					</a>
				</span>
			</div>
			<!-- <div class="m-stack__item m-stack__item--right m-stack__item--middle m-stack__item--first">
				<ul class="m-footer__nav m-nav m-nav--inline m--pull-right">
					<li class="m-nav__item">
						<a href="#" class="m-nav__link">
							<span class="m-nav__link-text">
								Enquiry Form
							</span>
						</a>
					</li>
					<li class="m-nav__item m-nav__item">
						<a href="#" class="m-nav__link" data-toggle="m-tooltip" title="Support Center" data-placement="left">
							<i class="m-nav__link-icon flaticon-info m--icon-font-size-lg3"></i>
						</a>
					</li>
				</ul>
			</div> -->
		</div>
	</div>
</footer>
<!-- end::Footer -->
</div>
<!-- end:: Page -->
<!-- begin::Quick Sidebar -->
<?php $this->load->view('include/sidebar.php'); ?>


<!-- END  -->


<!-- end::Quick Sidebar -->		    
	    <!-- begin::Scroll Top -->
<div id="m_scroll_top" class="m-scroll-top">
	<i class="la la-arrow-up"></i>
</div>
<!--begin::Base Styles -->

<link href="<?php echo base_url('assets/vendors/base/vendors.bundle.css'); ?>?q=<?php echo time();?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/demo/default/custom/form-parsley/parsley.css'); ?>?q=<?php echo time();?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('/assets/demo/default/custom/uploadifive/uploadifive.css'); ?>?q=<?php echo time();?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/demo/default/custom/custom.css'); ?>?q=<?php echo time();?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/demo/default/custom/no-padding.css'); ?>?q=<?php echo time();?>" rel="stylesheet" type="text/css" />

<?php $uri = $this->uri->segment(2);
	if($uri == "dashboard" || $uri == "index" || $uri == ""){ ?>
	<!-- <script src="//www.google.com/jsapi" type="text/javascript"></script> -->
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<!-- <script src="https://code.highcharts.com/modules/exporting.js"></script>
	<script src="https://code.highcharts.com/modules/export-data.js"></script> -->
<?php } ?>

<!--end::Base Styles -->
<script src="<?php echo base_url('assets/vendors/base/vendors.bundle.js') ?>?q=<?php echo time();?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/demo/default/base/scripts.bundle.js') ?>?q=<?php echo time();?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/demo/default/custom/form-parsley/parsley.js'); ?>?q=<?php echo time();?>"></script>
<script src="<?php echo base_url('assets/demo/default/custom/components/base/bootstrap-notify.js'); ?>?q=<?php echo time();?>"></script>

<script src="<?php echo base_url('assets/demo/default/custom/uploadifive/uploadifive.min.js'); ?>?q=<?php echo time();?>" type="text/javascript"></script>

<script src="<?php echo base_url('assets/demo/default/custom/sidebar_activities.js'); ?>?q=<?php echo time();?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/demo/default/custom/custom.js'); ?>"></script>

<!-- datatable CDN -start --> 
<script src="<?php echo base_url('assets/demo/default/custom/jquery.mousewheel.min.js'); ?>" type="text/javascript"></script>

<link href="<?php echo base_url('assets/vendors/custom/datatables/cdn/jquery.dataTables.min.css'); ?>?q=<?php echo time();?>" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url('assets/vendors/custom/datatables/cdn/jquery.dataTables.min.js'); ?>?q=<?php echo time();?>"></script>
<script src="<?php echo base_url('assets/vendors/custom/datatables/cdn/datatable.fnReloadAjax.js'); ?>?q=<?php echo time();?>"></script>
<!-- datatable CDN -end --> 
<script src="<?php echo base_url('assets/node_modules/socket.io-client/dist/socket.io.js'); ?>"></script>

<?php include('node.php');?>

<?php if(isset($view_needed_js) && $view_needed_js!=""){ ?>
	<?php if($view_needed_js == "setting"){ ?>
	<script src="<?php echo base_url('assets/demo/default/custom/crud/forms/widgets/summernote.js'); ?>?q=<?php echo time();?>" type="text/javascript"></script>
	<?php } ?>
	
<?php } ?>

<?php  if(isset($load_js) && $load_js!=""){
	foreach(load_required_js($load_js) as $js_files){ ?>
	<script src="<?php echo base_url('assets/demo/default/custom/'.$js_files); ?>?q=<?php echo time();?>"></script>
	<?php  } } ?>
</body>

</html>
