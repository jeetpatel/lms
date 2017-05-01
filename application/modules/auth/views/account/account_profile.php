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
                  <h3 class="box-title"><?php echo lang('profile_page_name'); ?></h3>
                </div><!-- /.box-header -->
                
              
                <div class="box-body">
                		<div class="row">
	
        <div class="col-md-offset-3 col-md-6">

			<?php if (isset($profile_info))
		{
			?>
            <div class="alert alert-success fade in">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
				<?php echo $profile_info; ?>
            </div>
			<?php } ?>

            <!-- <div class="well"><?php echo lang('profile_instructions'); ?></div> -->

			<?php echo form_open_multipart(uri_string(), 'class="form-horizontal"'); ?>
			<?php echo form_fieldset(); ?>
			<div class="row">
				<div class="col-md-4 control-group <?php echo (form_error('profile_username')) ? 'error' : ''; ?>">
                <label class="control-label" for="profile_username"><?php echo lang('profile_username'); ?></label>

                <div class="controls">
					<?php echo form_input(array('name' => 'profile_username', 'class'=>'form-control input-sm', 'id' => 'profile_username', 'value' => set_value('profile_username') ? set_value('profile_username') : (isset($account->username) ? $account->username : ''), 'maxlength' => '24')); ?>
					<?php if (form_error('profile_username') || isset($profile_username_error))
				{
					?>
                    <span class="help-inline">
					<?php
						echo form_error('profile_username');
						echo isset($profile_username_error) ? $profile_username_error : '';
						?>
					</span>
					<?php } ?>
                </div>
            </div>
			</div>
            

            <div class="control-group <?php echo (form_error('profile_username')) ? 'error' : ''; ?>">
                <label class="control-label" for="profile_picture"><?php echo lang('profile_picture'); ?></label>

                <div class="controls">
                <p>
					<?php if (isset($account_details->picture) && strlen(trim($account_details->picture)) > 0) : ?>
					<?php echo showPhoto($account_details->picture); ?> &nbsp;
					<?php echo anchor('auth/account/account_profile/delete', '<i class="icon-trash"></i> '.lang('profile_delete_picture'), 'class="btn"'); ?>
					<?php else : ?>
						
						<div class="accountPicSelect clearfix">
							<div class="pull-left">
								<!-- <input type="radio" name="pic_selection" value="custom" checked="true" /> -->
								<?php echo showPhoto(); ?>&nbsp;&nbsp;
							</div>
							<div class="pull-left">
								<p><?php echo lang('profile_custom_upload_picture'); ?><br>
									<?php echo form_upload(array('name' => 'account_picture_upload', 'id' => 'account_picture_upload')); ?><br>
									<small>(<?php echo lang('profile_picture_guidelines'); ?>)</small>
								</p>
							</div>
						</div>

						<!-- <div class="accountPicSelect clearfix">
							<div class="pull-left">
								<input type="radio" name="pic_selection" value="gravatar" />
								<?php //echo showPhoto( $gravatar ); ?>
							</div>
							<div class="pull-left">
								<p>
									<small><a href="http://gravatar.com/" target="_blank">Gravatar</a></small>
								</p>
							</div>
						</div> -->
					
					<?php endif; ?>
                    </p>
					<?php if ( ! isset($account_details->picture)) : ?>
					<?php endif; ?>

					<?php if (isset($profile_picture_error))
				{
					?>
                    <span class="help-inline">
					<?php echo $profile_picture_error; ?>
					</span>
					<?php } ?>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary"><?php echo lang('profile_save'); ?></button>
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


