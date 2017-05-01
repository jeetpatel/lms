
<div class="login-box">
      <div class="login-logo">
        <a href=""><?php if($this->config->item('site_name') != "") echo $this->config->item('site_name'); else echo SITENAME; ?></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <?php echo form_open(uri_string().($this->input->get('continue') ? '/?continue='.urlencode($this->input->get('continue')) : '')); ?>
            
            <?php if (isset($sign_in_error)) : ?>
                    <div class="form_error"><?php echo $sign_in_error; ?></div>
            <?php endif; ?>

            <?php if (form_error('sign_in_username_email') || isset($sign_in_username_email_error)) :?>
                <span class="help-inline">
                <?php echo form_error('sign_in_username_email'); ?>
                <?php if (isset($sign_in_username_email_error)) : ?>
                    <span class="field_error"><?php echo $sign_in_username_email_error; ?></span>
                <?php endif; ?>
                </span>
            <?php endif; ?>
          <div class="form-group has-feedback">
           <?php echo form_input(array('class'=>'form-control input-sm', 'name' => 'sign_in_username_email', 'id' => 'sign_in_username_email', 'placeholder' => 'Username / Email', 'value' => set_value('sign_in_username_email'))); ?>
            <!-- <input type="email" class="form-control" placeholder="Username / Email"> -->
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          
                        
            
       
        <?php if (form_error('sign_in_password')) : ?>
            <span class="help-inline"><?php echo form_error('sign_in_password'); ?></span>
        <?php endif; ?>

        <?php if (isset($recaptcha)) : ?>
            <?php echo $recaptcha; ?>
            <?php if (isset($sign_in_recaptcha_error)) : ?>
                <span class="field_error"><?php echo $sign_in_recaptcha_error; ?></span>
            <?php endif; ?>
        <?php endif; ?>
          <div class="form-group has-feedback">
            <?php echo form_password(array('class'=>'form-control input-sm','name' => 'sign_in_password', 'placeholder' => 'Password', 'id' => 'sign_in_password', 'value' => set_value('sign_in_password'))); ?>
            <!-- <input type="password" class="form-control" placeholder="Password"> -->
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
               <!--  <input class="roc roc-checkbox-3" type="checkbox" name='sign_in_remember'
                    id='sign_in_remember'  value='checked' checked= <?php echo $this->input->post('sign_in_remember'); ?>
                    > Remember Me
                </label> -->
              </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
          </div>
        <?php echo form_close(); ?>

       <!--  <div class="social-auth-links text-center">
          <p>- OR -</p>
          <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using Facebook</a>
          <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using Google+</a>
        </div> -->

        <a href="<?php echo FORGOTPASSWORD; ?>">I forgot my password</a><br>
        <a href="<?php echo SIGNUP; ?>" class="text-center">Register a new membership</a>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->