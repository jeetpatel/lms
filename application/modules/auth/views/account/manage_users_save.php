 <div class="content-wrapper">
        
         <section class="content-header">
          <h1>
            Pages
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>
        
        <!-- Main content -->
        <section class="content">
      
        <div class="box box-warning">
                
                <div class="box-header with-border">
                  <h3 class="box-title"><?php echo lang("users_{$action}_page_name"); ?></h3>
                </div><!-- /.box-header -->
                
              
                <div class="box-body">
                     <div class="row">

    <div class="col-md-12">

      <div class="well">
        <?php echo lang("users_{$action}_description"); ?>
      </div>
      

      <div class="row">
        <div class="col-md-offset-3 col-md-6">
           <?php echo form_open(uri_string(), 'class="form-horizontal"'); ?>

      <div class="control-group <?php echo (form_error('users_username') || isset($users_username_error)) ? 'error' : ''; ?>">
          <label class="control-label" for="users_username"><?php echo lang('profile_username'); ?></label>

          <div class="controls">
            <?php echo form_input(array('class'=>'form-control input-sm','name' => 'users_username', 'id' => 'users_username', 'value' => set_value('users_username') ? set_value('users_username') : (isset($update_account->username) ? $update_account->username : ''), 'maxlength' => 160)); ?>

            <?php if (form_error('users_username') || isset($users_username_error)) : ?>
              <span class="help-inline">
              <?php
                echo form_error('users_username');
                echo isset($users_username_error) ? $users_username_error : '';
              ?>
              </span>
            <?php endif; ?>
          </div>
      </div>

      <div class="control-group <?php echo (form_error('users_email') || isset($users_email_error)) ? 'error' : ''; ?>">
          <label class="control-label" for="users_email"><?php echo lang('settings_email'); ?></label>

          <div class="controls">
            <?php echo form_input(array('class'=>'form-control input-sm','name' => 'users_email', 'id' => 'users_email', 'value' => set_value('users_email') ? set_value('users_email') : (isset($update_account->email) ? $update_account->email : ''), 'maxlength' => 160)); ?>

            <?php if (form_error('users_email') || isset($users_email_error)) : ?>
              <span class="help-inline">
              <?php
                echo form_error('users_email');
                echo isset($users_email_error) ? $users_email_error : '';
              ?>
              </span>
            <?php endif; ?>
          </div>
      </div>

      <div class="control-group <?php echo (form_error('users_fullname')) ? 'error' : ''; ?>">
        <label class="control-label" for="users_fullname"><?php echo lang('settings_fullname'); ?></label>

        <div class="controls">
          <?php echo form_input(array('class'=>'form-control input-sm','name' => 'users_fullname', 'id' => 'users_fullname', 'value' => set_value('users_fullname') ? set_value('users_fullname') : (isset($update_account_details->fullname) ? $update_account_details->fullname : ''), 'maxlength' => 160)); ?>

          <?php if (form_error('users_fullname')) : ?>
            <span class="help-inline">
              <?php echo form_error('users_fullname'); ?>
            </span>
          <?php endif; ?>
        </div>
      </div>


         <div class="row">
            <div class="col-md-6">
              <div class="control-group <?php echo (form_error('users_firstname')) ? 'error' : ''; ?>">
          <label class="control-label" for="users_firstname"><?php echo lang('settings_firstname'); ?></label>

          <div class="controls">
          <?php echo form_input(array('class'=>'form-control input-sm','name' => 'users_firstname', 'id' => 'users_firstname', 'value' => set_value('users_firstname') ? set_value('users_firstname') : (isset($update_account_details->firstname) ? $update_account_details->firstname : ''), 'maxlength' => 80)); ?>
          <?php if (form_error('users_firstname')) : ?>
              <span class="help-inline">
                <?php echo form_error('users_firstname'); ?>
                </span>
          <?php endif; ?>
          </div>
      </div>
            </div>

            <div class="col-md-6">
              <div class="control-group <?php echo (form_error('users_lastname')) ? 'error' : ''; ?>">
          <label class="control-label" for="users_lastname"><?php echo lang('settings_lastname'); ?></label>

          <div class="controls">
          <?php echo form_input(array('class'=>'form-control input-sm','name' => 'users_lastname', 'id' => 'users_lastname', 'value' => set_value('users_lastname') ? set_value('users_lastname') : (isset($update_account_details->lastname) ? $update_account_details->lastname : ''), 'maxlength' => 80)); ?>
          <?php if (form_error('users_lastname')) : ?>
              <span class="help-inline">
                <?php echo form_error('users_lastname'); ?>
              </span>
          <?php endif; ?>
          </div>
      </div>
            </div>
          </div>
          

      <div class="control-group <?php echo (form_error('users_new_password')) ? 'error' : ''; ?>">
        <label class="control-label" for="users_new_password"><?php echo lang('password_new_password'); ?></label>

        <div class="controls">
          <?php echo form_password(array('class'=>'form-control input-sm','name' => 'users_new_password', 'id' => 'users_new_password', 'value' => set_value('users_new_password'), 'autocomplete' => 'off')); ?>

          <?php if (form_error('users_new_password')) : ?>
            <span class="help-inline">
              <?php echo form_error('users_new_password'); ?>
            </span>
          <?php endif; ?>
        </div>
      </div>

      <div class="control-group <?php echo (form_error('users_retype_new_password')) ? 'error' : ''; ?>">
        <label class="control-label" for="users_retype_new_password"><?php echo lang('password_retype_new_password'); ?></label>

        <div class="controls">
          <?php echo form_password(array('class'=>'form-control input-sm','name' => 'users_retype_new_password', 'id' => 'users_retype_new_password', 'value' => set_value('users_retype_new_password'), 'autocomplete' => 'off')); ?>
          
          <?php if (form_error('users_retype_new_password')) : ?>
            <span class="help-inline">
              <?php echo form_error('users_retype_new_password'); ?>
            </span>
          <?php endif; ?>
        </div>
      </div>

         <div class="control-group">
          <label class="control-label" for="users_roles"><?php echo lang('users_roles'); ?></label>

          <div class="controls">
              <?php foreach($roles as $role) : ?>
                <?php 
                $check_it = FALSE;
                
                if( isset($update_account_roles) ) 
                {
                  foreach($update_account_roles as $acrole) 
                  {
                    if($role->id == $acrole->id)
                    {
                      $check_it = TRUE; break;
                    }
                  }
                }
                ?>

                <label class="checkbox">
                <input class="roc roc-checkbox-3" type="checkbox" 
                name="account_role_<?php echo $role->id; ?>" valut="apply" 
                <?php if($check_it) echo "checked"; ?>
                >
                <span class="lbl"> <?php echo $role->name ?></span>
                </label>
              <?php endforeach; ?>
          </div>
      </div>


         <div class="form-actions mt10">
        <?php echo form_submit('manage_user_submit', lang('settings_save'), 'class="btn btn-primary btn-sm"'); ?>
        <?php echo anchor('auth/account/manage_users', lang('website_cancel'), 'class="btn btn-warning btn-sm"'); ?>
        
          <span><?php echo lang('admin_or');?></span>


          <?php if(isset($update_account->suspendedon) ): ?>
            <?php echo form_submit('manage_user_unban', lang('users_unban'), 'class="btn btn-danger btn-sm"'); ?>
          <?php else: ?>
            <?php echo form_submit('manage_user_ban', lang('users_ban'), 'class="btn btn-danger btn-sm"'); ?>
          <?php endif; ?>
        
      </div>  




        </div>

      </div>
     
     

     

      <?php echo form_close(); ?>

    </div>
  </div>
                </div><!-- /.box-body -->

                <div class="box-footer">

                </div><!-- /.box-footer -->
               
              </div><!-- /.box -->
        
      
        </section>

</div>


 