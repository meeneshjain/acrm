
		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-3" id="m_login" style="background-image: url(<?php // echo base_url('assets/app/media/img//bg/bg-2.jpg'); ?>);">
				<div class="m-grid__item m-grid__item--fluid	m-login__wrapper">
					<div class="m-login__container">
						<div class="m-login__logo">
							<a href="#">
								<img src="<?php echo base_url(COMPANY_LOGO); ?>">
							</a> 
							
						</div>
						<div class="m-login__signin">
							<div class="m-login__head">
								<h2 class="m-login__title">
								<?php echo $page_title; ?>
								</h2>
							</div>
							<form class="m-login__form m-form" action="<?php echo $form_url; ?>" data-parsley-validate>
								<div class="form-group m-form__group">
									<input class="form-control m-input" required  type="text" placeholder="Email"  id="username" name="email" autocomplete="true">
								</div>
								<div class="form-group m-form__group">
									<input class="form-control m-input m-login__form-input--last" required type="password" placeholder="Password"  id="password" name="password">
								</div>
								<div class="row m-login__form-sub">
									<div class="col m--align-left m-login__form-left">
										<label class="m-checkbox  m-checkbox--light">
											<input type="checkbox" name="remember">
											Remember me
											<span></span>
										</label>
									</div>
									<div class="col m--align-right m-login__form-right">
										<a href="javascript:;" id="m_login_forget_password" class="m-link">
											Forget Password ?
										</a>
									</div>
								</div>
								<div class="m-login__form-action">
									<button id="m_login_signin_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn">
										Sign In
									</button>
								</div>
							</form>
						</div>
						<!-- <div class="m-login__signup">
							<div class="m-login__head">
								<h3 class="m-login__title">
									Sign Up
								</h3>
								<div class="m-login__desc">
									Enter your details to create your account:
								</div>
							</div>
							<form class="m-login__form m-form" action="">
								<div class="form-group m-form__group">
									<input class="form-control m-input" type="text" placeholder="Fullname" name="fullname">
								</div>
								<div class="form-group m-form__group">
									<input class="form-control m-input" type="text" placeholder="Email" name="email" autocomplete="off">
								</div>
								<div class="form-group m-form__group">
									<input class="form-control m-input" type="password" placeholder="Password" name="password">
								</div>
								<div class="form-group m-form__group">
									<input class="form-control m-input m-login__form-input--last" type="password" placeholder="Confirm Password" name="rpassword">
								</div>
								<div class="row form-group m-form__group m-login__form-sub">
									<div class="col m--align-left">
										<label class="m-checkbox m-checkbox--light">
											<input type="checkbox" name="agree">
											I Agree the
											<a href="#" class="m-link m-link--focus">
												terms and conditions
											</a>
											.
											<span></span>
										</label>
										<span class="m-form__help"></span>
									</div>
								</div>
								<div class="m-login__form-action">
									<button id="m_login_signup_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn">
										Sign Up
									</button>
									&nbsp;&nbsp;
									<button id="m_login_signup_cancel" class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom m-login__btn">
										Cancel
									</button>
								</div>
							</form>
						</div> -->
						<div class="m-login__forget-password">
							<div class="m-login__head">
								<h3 class="m-login__title">
									Forgotten Password ?
								</h3>
								<div class="m-login__desc">
									Enter your email to reset your password:
								</div>
							</div>
							<form class="m-login__form m-form" action="">
								<div class="form-group m-form__group">
									<input class="form-control m-input" type="text" placeholder="Email" name="email" id="m_email" autocomplete="off">
								</div>
								<div class="m-login__form-action">
									<button id="m_login_forget_password_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">
										Request
									</button>
									&nbsp;&nbsp;
									<button id="m_login_forget_password_cancel" class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom  m-login__btn">
										Cancel
									</button>
								</div>
							</form>
						</div>
					<!-- 	<div class="m-login__account">
							<span class="m-login__account-msg">
								Don't have an account yet ?
							</span>
							&nbsp;&nbsp;
							<a href="javascript:;" id="m_login_signup" class="m-link m-link--light m-login__account-link">
								Sign Up
							</a>
						</div> -->
					</div>
				</div>
			</div>
		</div>
		
	<script>

	$(document).ready(function() {
   
    $(".m-form").on('submit',function(event) {
      event.preventDefault();
      if($(this).parsley().validate()) {
        show_loading(".m-login__btn", "Loading")
        $this = $(this);
        $.ajax({
          url: $this.attr("action"),
          type: 'POST',
          dataType : "JSON",
          data : {
            username: $("#username").val(),
            password: $("#password").val()
          },
          success: function(response){
            console.log(response);
            hide_loading(".m-login__btn", "Sign In");
            if(response.status != "success"){
			  notify_alert('danger', 'Wrong username and password. Please try again', "Error")
            } else {
			<?php  $get_data = $this->input->get();
				if(isset($get_data['return_url']) && $get_data['return_url']!== "") { ?>
				base_url = base_url + '<?php echo $get_data['return_url']; ?>';
			<?php } else { ?>
				<?php $dashboard = $user_type. '/dashboard'; ?>
				
				base_url = base_url + '<?php echo $dashboard; ?>';
				<?php } ?>
				window.location.href = base_url;
            }
          }, 
          error : function(response){
            console.log(response);
            hide_loading(".m-login__btn", "Sign In");
			notify_alert('danger', 'There was some error, Please try again.', "Error")
          }
        })
      }
    });
    
  });
	</script>