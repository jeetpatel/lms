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
        <h3 class="box-title"><?php echo lang('permissions_page_name'); ?></h3>
      </div><!-- /.box-header -->


      <div class="box-body">

        <div class="row">

          <div class="col-md-12">

            <div class="well">
              <?php echo lang('permissions_page_description'); ?>
            </div>

            <table class="table table-condensed table-bordered table-hover" id="permissions_list">
              <thead>
                <tr>
                  <th>#</th>
                  <th><?php echo lang('permissions_column_permission'); ?></th>
                  <th><?php echo lang('permissions_description'); ?></th>
                  <th><?php echo lang('permissions_column_inroles'); ?></th>
                  <th>
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php foreach( $permissions as $perm ) : ?>
                  <tr>
                    <td><?php echo $perm['id']; ?></td>
                    <td>
                      <?php echo $perm['key']; ?>
                      <?php if( $perm['is_disabled'] ): ?>
                        <span class="label label-important"><?php echo lang('permissions_banned'); ?></span>
                      <?php endif; ?>
                    </td>
                    <td><?php echo $perm['description']; ?></td>
                    <td>
                      <?php if( count($perm['role_list']) == 0 ) : ?>
                        <span class="label">None</span>
                      <?php else : ?>
                        <ul class="inline">
                          <?php foreach( $perm['role_list'] as $itm ) : ?>
                            <li class="ml15"><?php echo anchor('auth/account/manage_roles/save/'.$itm['id'], $itm['name'], 'title="'.$itm['title'].'"'); ?></li>
                          <?php endforeach; ?>
                        </ul>
                      <?php endif; ?>
                    </td>
                    <td>
                    <?php echo anchor('auth/account/manage_permissions/save/'.$perm['id'], lang('website_update'), 'class="btn btn-info btn-sm"'); ?>
                      
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>

          </div>

        </div>
      </div><!-- /.box-body -->

      <div class="box-footer">

      </div><!-- /.box-footer -->

    </div><!-- /.box -->


  </section>

</div>

