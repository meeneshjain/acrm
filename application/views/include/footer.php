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
			<div class="m-stack__item m-stack__item--right m-stack__item--middle m-stack__item--first">
				<ul class="m-footer__nav m-nav m-nav--inline m--pull-right">
					<li class="m-nav__item">
						<a href="#" class="m-nav__link">
							<span class="m-nav__link-text">
								About
							</span>
						</a>
					</li>
					<li class="m-nav__item">
						<a href="#"  class="m-nav__link">
							<span class="m-nav__link-text">
								Privacy
							</span>
						</a>
					</li>
					<li class="m-nav__item">
						<a href="#" class="m-nav__link">
							<span class="m-nav__link-text">
								T&C
							</span>
						</a>
					</li>
					<li class="m-nav__item">
						<a href="#" class="m-nav__link">
							<span class="m-nav__link-text">
								Purchase
							</span>
						</a>
					</li>
					<li class="m-nav__item m-nav__item">
						<a href="#" class="m-nav__link" data-toggle="m-tooltip" title="Support Center" data-placement="left">
							<i class="m-nav__link-icon flaticon-info m--icon-font-size-lg3"></i>
						</a>
					</li>
				</ul>
			</div>
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
<script src="<?php echo base_url('assets/vendors/base/vendors.bundle.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/demo/default/base/scripts.bundle.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/demo/default/custom/form-parsley/parsley.js'); ?>"></script>
<script src="<?php echo base_url('assets/demo/default/custom/components/base/bootstrap-notify.js'); ?>"></script>
<script src="<?php echo base_url('assets/vendors/custom/datatables/datatables.bundle.js'); ?>"></script>
<script src="<?php echo base_url('assets/demo/default/custom/custom.js'); ?>"></script>
<script src="<?php echo base_url('assets/app/js/dashboard.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/demo/default/custom/sidebar_activities.js'); ?>" type="text/javascript"></script>

<?php  if(isset($load_js) && $load_js!=""){
	foreach(load_required_js($load_js) as $js_files){ ?>
	<script src="<?php echo base_url('assets/demo/default/custom/'.$js_files); ?>"></script>
	<?php  } } ?>
</body>

</html>
<script>


$(document).ready(function() {
	

});



</script>