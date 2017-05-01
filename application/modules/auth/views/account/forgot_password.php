
<div class="login-box">
      <div class="login-logo">
        <a href=""><?php if($this->config->item('site_name') != "") echo $this->config->item('site_name'); else echo SITENAME; ?></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg"><?php echo lang('forgot_password_page_name'); ?></p>
        <?php echo form_open(uri_string(), 'class="form-horizontal"'); ?>
            
            <?php if (isset($sign_in_error)) : ?>
                    <div class="form_error"><?php echo $sign_in_error; ?></div>
            <?php endif; ?>

          <?php if (form_error('forgot_password_username_email') || isset($forgot_password_username_email_error))
		  {
			?>
            <span class="help-inline">
			<?php
				echo form_error('forgot_password_username_email');
				echo isset($forgot_password_username_email_error) ? $forgot_password_username_email_error : '';
				?>
			</span>
			<?php } ?>
          <div class="form-group has-feedback">
           <?php
					$value = set_value('forgot_password_username_email') ? set_value('forgot_password_username_email') : (isset($account) ? $account->username : '');
					$value = str_replace(array('\'', '"'), ' ', $value);
					echo form_input(array(
					'class' => 'form-control input-sm',
					'name' => 'forgot_password_username_email',
					'id' => 'forgot_password_username_email',
					'value' => $value,
					'maxlength' => '80',
					'placeholder' => 'Username / Email'
				)); ?>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          
          
          <div class="row">
            <div class="col-xs-12">
              
              <?php if (isset($recaptcha)) : ?>
			<?php echo $recaptcha; ?>
			<?php if (isset($forgot_password_recaptcha_error)) : ?>
                <span class="field_error"><?php echo $forgot_password_recaptcha_error; ?></span>
				<?php endif; ?>
			<?php endif; ?>

				<?php echo form_button(array(
				'type' => 'submit',
				'class' => 'btn btn-primary btn-block btn-flat',
				'content' => lang('forgot_password_send_instructions')
			)); ?>

            </div><!-- /.col -->
          </div>
        <?php echo form_close(); ?>
		<p><?php echo lang('forgot_password_instructions'); ?></p>
        <a href="<?php echo base_url(SIGNIN); ?>" class="text-center">I already have a membership</a> <br/>
        <a href="<?php echo base_url(SIGNUP); ?>" class="text-center">Register a new membership</a>
		
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->