 <div class="content-wrapper">
        
         <section class="content-header">
          <h1>
            Account
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
                  <h3 class="box-title"><?php echo lang('password_page_name'); ?></h3>
                </div><!-- /.box-header -->
                
              
                <div class="box-body">
                    <div class="row">
        
        <div class="col-md-12">

            <?php if ($this->session->flashdata('password_info')) : ?>
            <div class="alert alert-success fade in">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?php echo $this->session->flashdata('password_info'); ?>
            </div>
            <?php endif; ?>

            <div class="well">
                <?php echo lang('password_safe_guard_your_account'); ?>
            </div>
            
             <br>
            <?php echo form_open(uri_string(), 'class="form-horizontal"'); ?>
            <?php echo form_fieldset(); ?>
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                
                <div class="control-group <?php echo (form_error('password_new_password')) ? 'error' : ''; ?>">
                <label class="control-label" for="password_new_password"><?php echo lang('password_new_password'); ?></label>

                <div class="controls">
                    <?php echo form_password(array('class'=>'form-control input-sm','name' => 'password_new_password', 'id' => 'password_new_password', 'value' => set_value('password_new_password'), 'autocomplete' => 'off')); ?>
                    
                    <?php if (form_error('password_new_password')){?>
                    <span class="help-inline">
                    <?php echo form_error('password_new_password'); ?>
                    </span>
                    <?php } ?>
                </div>
                </div>

            <div class="control-group <?php echo (form_error('password_retype_new_password')) ? 'error' : ''; ?>">
                <label class="control-label" for="password_retype_new_password"><?php echo lang('password_retype_new_password'); ?></label>

                <div class="controls">
                    <?php echo form_password(array('class'=>'form-control input-sm','name' => 'password_retype_new_password', 'id' => 'password_retype_new_password', 'value' => set_value('password_retype_new_password'), 'autocomplete' => 'off')); ?>
                    <?php if (form_error('password_retype_new_password'))
                {
                    ?>
                    <span class="help-inline">
                    <?php echo form_error('password_retype_new_password'); ?>
                    </span>
                    <?php } ?>
                </div>
            </div>

                 <div class="form-actions mt10">
                    <input type="submit" class="btn btn-primary" value="<?php echo lang('password_change_my_password'); ?>">
                </div>

                </div>
            </div>
            
        
           

            <?php echo form_fieldset_close(); ?>
            <?php echo form_close(); ?>

        </div>

    </div>
                </div><!-- /.box-body -->

                <div class="box-footer">

                </div><!-- /.box-footer -->
               
              </div><!-- /.box -->
                
            
        </section>

</div>


    