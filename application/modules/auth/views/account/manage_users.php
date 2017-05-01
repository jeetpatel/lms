 <div class="content-wrapper">
        
         <section class="content-header">
          <h1>
            Users
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
                  <h3 class="box-title"><?php echo lang('users_page_name'); ?></h3>
                </div><!-- /.box-header -->
                
              
                <div class="box-body">
                  <div class="row">

    <div class="col-md-12">

      <div class="well">
        <?php echo lang('users_description'); ?>
      </div>

      <?php if( count($all_accounts) > 0 ) : ?>
        <table class="table table-condensed table-bordered table-hover" id="users_list">
          <thead>
            <tr>
              <th>#</th>
              <th><?php echo lang('users_username'); ?></th>
              <th><?php echo lang('settings_email'); ?></th>
              <th><?php echo lang('settings_firstname'); ?></th>
              <th><?php echo lang('settings_lastname'); ?></th>
              <th>
                
                  <?php echo anchor('auth/account/manage_users/save',lang('website_create'),'class="btn btn-primary btn-sm"'); ?>
                
              </th>
            </tr>
          </thead>
          <tbody>

            <?php foreach( $all_accounts as $acc ) : ?>
              <tr>
                <td><?php echo $acc['id']; ?></td>
                <td>
                  <?php echo $acc['username']; ?>
                  <?php if( $acc['is_banned'] ): ?>
                    <span class="label label-important"><?php echo lang('users_banned'); ?></span>
                  <?php elseif( $acc['is_admin'] ): ?>
                    <span class="label label-info"><?php echo lang('users_admin'); ?></span>
                  <?php endif; ?>
                </td>
                <td><?php echo $acc['email']; ?></td>
                <td><?php echo $acc['firstname']; ?></td>
                <td><?php echo $acc['lastname']; ?></td>
                <td>
                    <?php echo anchor('auth/account/manage_users/save/'.$acc['id'],lang('website_update'),'class="btn btn-info btn-sm"'); ?>
                </td>
              </tr>
            <?php endforeach; ?>

          </tbody>
        </table>
      <?php endif; ?>
    </div>
  </div>
                </div><!-- /.box-body -->

                <div class="box-footer">

                </div><!-- /.box-footer -->
               
              </div><!-- /.box -->
        
      
        </section>

</div>

    
  