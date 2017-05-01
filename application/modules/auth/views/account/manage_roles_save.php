 <div class="content-wrapper">
        
         <section class="content-header">
          <h1>
            Roles
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
                  <h3 class="box-title"><?php echo lang("roles_{$action}_page_name"); ?></h3>
                </div><!-- /.box-header -->
                
              
                <div class="box-body">

      <?php echo form_open(uri_string(), 'class="form-horizontal"'); ?>
      

      <div class="row">
        <div class="col-md-6">
            <div class="control-group <?php echo (form_error('role_name') || isset($role_name_error)) ? 'error' : ''; ?>">
          <label class="control-label" for="role_name"><?php echo lang('roles_name'); ?></label>

          <div class="controls">
            <?php if( $is_system ) : ?>
              <?php echo form_hidden('role_name', set_value('role_name') ? set_value('role_name') : (isset($role->name) ? $role->name : '')); ?>

              <span class="input uneditable-input"><?php echo $role->name; ?></span><span class="help-block"><?php echo lang('roles_system_name'); ?></span>
            <?php else : ?>
              <?php echo form_input(array('class'=>'form-control input-sm','name' => 'role_name', 'id' => 'role_name', 'value' => set_value('role_name') ? set_value('role_name') : (isset($role->name) ? $role->name : ''), 'maxlength' => 80)); ?>

              <?php if (form_error('role_name') || isset($role_name_error)) : ?>
                <span class="help-inline">
                <?php
                  echo form_error('role_name');
                  echo isset($role_name_error) ? $role_name_error : '';
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
          <div class="control-group <?php echo form_error('role_description') ? 'error' : ''; ?>">
          <label class="control-label" for="role_description"><?php echo lang('roles_description'); ?></label>

          <div class="controls">
            <?php echo form_textarea(array('class'=>'form-control input-sm','name' => 'role_description', 'id' => 'role_description', 'value' => set_value('role_description') ? set_value('role_description') : (isset($role->description) ? $role->description : ''), 'maxlength' => 160, 'rows'=>'4')); ?>

            <?php if (form_error('role_description') || isset($role_name_error)) : ?>
              <span class="help-inline">
              <?php
                echo form_error('role_description');
              ?>
              </span>
            <?php endif; ?>
          </div>
      </div>
        </div>
      </div>

      
      <div class="row">
        <div class="col-md-12">
          
          <div>
            <label class="control-label" for="settings_lastname"><?php echo lang('roles_permission'); ?></label>
          </div>
          
          <?php foreach( $permissions as $perm ) : ?>
              <?php
                $check_it = FALSE;

                if( isset($role_permissions) )
                {
                  foreach( $role_permissions as $rperm )
                  {
                    if( $rperm->id == $perm->id )
                    {
                      $check_it = TRUE; break;
                    }
                  }
                }
              ?>
              
              <div class="col-md-3">
                  <label class="checkbox">
                <input class="roc roc-checkbox-3" type="checkbox" 
                name="role_permission_<?php echo $perm->id; ?>" valut="apply" 
                <?php if($check_it) echo "checked"; ?>
                >
                <span class="lbl"> <?php echo $perm->key; ?></span>
                </label>    
              </div>
            <?php endforeach; ?>
            
        </div>

            
          
      </div>
      
      
      <div class="row">
        <div class="col-md-12 mt20">
          
        <?php echo form_submit('manage_role_submit', lang('settings_save'), 'class="btn btn-primary btn-sm"'); ?>
        <?php echo anchor('auth/account/manage_roles', lang('website_cancel'), 'class="btn btn-warning btn-sm"'); ?>
        <?php if( $this->authorization->is_permitted('delete_roles') && $action == 'update' && ! $is_system ): ?>
          <span><?php echo lang('admin_or');?></span>
          <?php if( isset($role->suspendedon) ): ?>
            <?php echo form_submit('manage_role_unban', lang('roles_unban'), 'class="btn btn-danger btn-sm"'); ?>
          <?php else: ?>
            <?php echo form_submit('manage_role_ban', lang('roles_ban'), 'class="btn btn-danger btn-sm"'); ?>
          <?php endif; ?>
        <?php endif; ?>
      
        </div>
        
      </div>
      

      <?php echo form_close(); ?>

                </div><!-- /.box-body -->

                <div class="box-footer">

                </div><!-- /.box-footer -->
               
              </div><!-- /.box -->
        
      
        </section>

</div>




