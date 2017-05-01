 <div class="register-box">
      <div class="register-logo">
        <a href=""><?php if($this->config->item('site_name') != "") echo $this->config->item('site_name'); else echo SITENAME; ?></a>
      </div>
	
      <div class="register-box-body">
        
		<?php if (! ($this->config->item("sign_up_enabled"))): ?>
			<div class="col-md-12">
				<div class="alert">
					<strong><?php echo lang('sign_up_notice'); ?> </strong> <?php echo lang('sign_up_registration_disabled'); ?>
				</div>
			</div>
		<?php endif;?>
		
		<?php if ($this->config->item("sign_up_enabled")): ?>

        <p class="login-box-msg">Register a new membership</p>
        
       <?php echo form_open(uri_string(), 'class="form-horizontal"'); ?>
          
          <?php if (form_error('sign_up_username') || isset($sign_up_username_error)) : ?>
			<span class="help-inline">
			<?php echo form_error('sign_up_username'); ?>
			<?php if (isset($sign_up_username_error)) : ?>
				<span class="field_error"><?php echo $sign_up_username_error; ?></span>
			<?php endif; ?>
			</span>
		  <?php endif; ?>
          <div class="form-group has-feedback">
            <?php echo form_input(array('name' => 'sign_up_username', 'id' => 'sign_up_username', 'class'=>'form-control', 'placeholder'=>'Username', 'value' => set_value('sign_up_username'), 'maxlength' => '24')); ?>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          

          <?php if (form_error('sign_up_email') || isset($sign_up_email_error)) : ?>
			<span class="help-inline">
			<?php echo form_error('sign_up_email'); ?>
			<?php if (isset($sign_up_email_error)) : ?>
				<span class="field_error"><?php echo $sign_up_email_error; ?></span>
			<?php endif; ?>
			</span>
		  <?php endif; ?>
          <div class="form-group has-feedback">
            <?php echo form_input(array('name' => 'sign_up_email', 'id' => 'sign_up_email', 'class'=>'form-control', 'placeholder'=>'Email', 'value' => set_value('sign_up_email'), 'maxlength' => '160')); ?>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>

          <?php if (form_error('sign_up_password')) : ?>
			<span class="help-inline">
			<?php echo form_error('sign_up_password'); ?>
			</span>
		  <?php endif; ?>
          <div class="form-group has-feedback">
            <?php echo form_password(array('name' => 'sign_up_password', 'id' => 'sign_up_password', 'class'=>'form-control', 'placeholder'=>'Password','value' => set_value('sign_up_password'))); ?>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
			
		  <?php if (form_error('sign_up_confirm_password')) : ?>
			<span class="help-inline">
			<?php echo form_error('sign_up_confirm_password'); ?>
			</span>
		  <?php endif; ?>
          <div class="form-group has-feedback">
          <?php echo form_password(array('name' => 'sign_up_confirm_password', 'id' => 'sign_up_confirm_password', 'class'=>'form-control', 'placeholder'=>'Retype Password','value' => set_value('sign_up_confirm_password'))); ?>
            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
          </div>


          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> I agree to the <a href="#">terms</a>
                </label>
              </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
            </div><!-- /.col -->
          </div>
        <?php echo form_close(); ?>

        <div class="social-auth-links text-center">
          <p>- OR -</p>
          <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using Facebook</a>
          <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign up using Google+</a>
        </div>
		
		<?php endif; ?>

        <a href="<?php echo base_url(SIGNIN); ?>" class="text-center">I already have a membership</a>
      </div><!-- /.form-box -->
    </div><!-- /.register-box -->