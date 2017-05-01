 <div class="content-wrapper">
        
         <section class="content-header">
          <h1>
            Permissions
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
                  <h3 class="box-title"><?php echo lang("permissions_{$action}_page_name"); ?></h3>
                </div><!-- /.box-header -->
                
              
                <div class="box-body">
                    <div class="row">

    <div class="col-md-12">

      <?php echo form_open(uri_string(), 'class="form-horizontal"'); ?>
      
      <div class="row">
        <div class="col-md-6">
             <div class="control-group <?php echo (form_error('permission_key') || isset($permission_key_error)) ? 'error' : ''; ?>">
          <label class="control-label" for="permission_key"><?php echo lang('permissions_key'); ?></label>

          <div class="controls">
            <?php if( $is_system ) : ?>
              <?php echo form_hidden('permission_key', set_value('permission_key') ? set_value('permission_key') : (isset($permission->key) ? $permission->key : '')); ?>

              <span class="input uneditable-input"><?php echo $permission->key; ?></span><span class="help-block"><?php echo lang('permissions_system_name'); ?></span>
            <?php else : ?>
              <?php echo form_input(array('class'=>'form-control input-sm','name' => 'permission_key', 'id' => 'permission_key', 'value' => set_value('permission_key') ? set_value('permission_key') : (isset($permission->key) ? $permission->key : ''), 'maxlength' => 80)); ?>

              <?php if (form_error('permission_key') || isset($permission_key_error)) : ?>
                <span class="help-inline">
                <?php
                  echo form_error('permission_key');
                  echo isset($permission_key_error) ? $permission_key_error : '';
                ?>
                </span>
              <?php endif; ?>
            <?php endif; ?>
          </div>
      </div>
        </div>
      </div>
     
      
      <div class="row">
          <div class="col-md-6">
              <div class="control-group <?php echo form_error('permission_description') ? 'error' : ''; ?>">
          <label class="control-label" for="permission_description"><?php echo lang('permissions_description'); ?></label>

          <div class="controls">
            <?php echo form_textarea(array('class'=>'form-control input-sm','name' => 'permission_description', 'id' => 'permission_description', 'value' => set_value('permission_description') ? set_value('permission_description') : (isset($permission->description) ? $permission->description : ''), 'maxlength' => 160, 'rows'=>'4')); ?>

            <?php if (form_error('permission_description') || isset($permission_name_error)) : ?>
              <span class="help-inline">
              <?php
                echo form_error('permission_description');
              ?>
              </span>
            <?php endif; ?>
          </div>
      </div>
          </div>        
      </div>
      

      <div class="control-group">
          <label class="control-label" for="settings_lastname"><?php echo lang('permissions_role'); ?></label>

          <div class="controls">
            <?php foreach( $roles as $role ) : ?>
              <?php
                $check_it = FALSE;

                if( isset($role_permissions) )
                {
                  foreach( $role_permissions as $rperm )
                  {
                    if( $rperm->id == $role->id )
                    {
                      $check_it = TRUE; break;
                    }
                  }
                }
              ?>

              <label class="checkbox">
                <input class="roc roc-checkbox-3" type="checkbox" 
                name="role_permission_<?php echo $role->id; ?>" valut="apply" 
                <?php if($check_it) echo "checked"; ?>
                >
                <span class="lbl"> <?php echo $role->name; ?></span>
              </label>

            <?php endforeach; ?>
          </div>
      </div>
      

      <div class="form-actions mt15">
        <?php echo form_submit('manage_permission_submit', lang('settings_save'), 'class="btn btn-primary btn-sm"'); ?>
        <?php echo anchor('auth/account/manage_permissions', lang('website_cancel'), 'class="btn btn-warning btn-sm"'); ?>

        <?php if( $this->authorization->is_permitted('delete_permissions') && $action == 'update' && ! $is_system ): ?>
          <span><?php echo lang('admin_or');?></span>
          <?php if( isset($permission->suspendedon) ): ?>
            <?php echo form_submit('manage_permission_unban', lang('permissions_unban'), 'class="btn btn-danger btn-sm"'); ?>
          <?php else: ?>
            <?php echo form_submit('manage_permission_ban', lang('permissions_ban'), 'class="btn btn-danger btn-sm"'); ?>
          <?php endif; ?>
        <?php endif; ?>
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


  
