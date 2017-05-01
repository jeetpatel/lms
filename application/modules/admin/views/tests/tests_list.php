             <div class="content-wrapper">
         

            <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Tests
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>
        

        <!-- Main content -->
        <section class="content">
             
        <div class="row" style="margin-bottom: 10px">
            
            
            <?php if($this->session->flashdata('message') <> ''): ?>
            <div class="col-md-offset-3 col-md-6 text-center">
                <div style="margin-top: 8px" id="message">
                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Info</strong> <?php echo $this->session->flashdata('message') <> '' ? $this->session->flashdata('message') : ''; ?>
                </div>
                    
                </div>
            </div>
            <?php endif; ?>
            
        

        </div>


        <div class="row">
            
            <div class="col-xs-12">
              
              <div class="box box-warning">
                
                <div class="box-header">
                  <h3 class="box-title">List</h3>
                  <div class="box-tools">
                        <form action="<?php echo site_url('admin/tests'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('admin/tests'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
                  </div>
                </div><!-- /.box-header -->
                

                <div class="box-body table-responsive no-padding">
                 <table class="table table-hover" style="margin-bottom: 10px">
             <tr>
                <th>No</th>
        <th>Test Name</th>
        <th width="600px;">Test Description</th>
        <th>Test Price (<?php echo $this->config->item('site_currency'); ?>) </th>
        <th>Status</th>
        <th>Action</th>
            </tr><?php if(count($tests_data) > 0):
            foreach ($tests_data as $tests)
            {
                ?>
                <tr>
            <td width="80px"><?php echo ++$start ?></td>
            <td><?php echo humanize($tests->test_name) ?></td>
            <td><?php echo $tests->test_description ?></td>
            <td><?php echo $tests->test_price ?></td>
            <td><?php echo humanize($tests->status) ?></td>
            <td width="200px">
                <?php 
                echo anchor(site_url('admin/tests/update/'.$tests->id),'Update'); 
                ?>
            </td>
        </tr>
              <?php } else: ?>

        <tr>
            <td colspan=8 class="text-center"> <h4>Add a Test.</h4></td>
        </tr>
    <?php   endif; ?>
        </table>


                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>


        <div class="row">
            <div class="col-md-6">
                <?php echo anchor(site_url('admin/tests/create'),'Create', 'class="btn btn-primary"'); ?>
                <a href="javascript:void(0);" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
        </div>
            <div class="col-md-6 text-right" id="appointments_pagination">
                <?php echo $pagination ?>
            </div>
        </div>

        
        </section>
            
     </div>