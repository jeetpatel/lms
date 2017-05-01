<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Roles
            <small>Control Panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Data tables</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-warning">
                <div class="box-header">
                  <h3 class="box-title">Listing Roles</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-bordered table-hover" id="roles">
        <thead>
          <tr>
            <th>#</th>
            <th><?php echo lang('roles_column_role'); ?></th>
            <th><?php echo lang('roles_column_users'); ?></th>
            <th><?php echo lang('roles_permission'); ?></th>
            <th>
            </th>
          </tr>
        </thead>
        <tbody>
          <?php foreach( $roles as $role ) : ?>
            <tr>
              <td><?php echo $role['id']; ?></td>
              <td>
                <?php echo $role['name']; ?>
                <?php if( $role['is_disabled'] ): ?>
                  <span class="label label-important"><?php echo lang('roles_banned'); ?></span>
                <?php endif; ?>
              </td>
              <td>
                <?php if( $role['user_count'] > 0 ) : ?>
                  <span class="badge"><?php echo $role['user_count'] ?></span>
                  <?php //echo anchor('auth/account/manage_users/filter/role/'.$role['id'], $role['user_count'], 'class="badge badge-info"'); ?>
                <?php else : ?>
                  <span class="badge">0</span>
                <?php endif; ?>
              </td>
              <td>
                <?php if( count($role['perm_list']) == 0 ) : ?>
                  <span class="label">No Permissions</span>
                <?php else : ?>
                  
                    <?php foreach( $role['perm_list'] as $itm ) : ?>
                      <?php echo anchor('auth/account/manage_permissions/save/'.$itm['id'], $itm['key'], 'title="'.$itm['title'].'"').", "; ?>
                    <?php endforeach; ?>
                  
                <?php endif; ?>
              </td>
              <td>
                
                  <?php echo anchor('auth/account/manage_roles/save/'.$role['id'], lang('website_update'), 'class="btn btn-info btn-sm"'); ?>
                
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>


                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

