     <div class="content-wrapper">
            
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
                
                  <div class="box box-warning">
                    
                    <div class="box-header with-border">
                      <h3 class="box-title">Tests Read</h3>
                    </div><!-- /.box-header -->
                    
                  
                    <div class="box-body">

                    <div class="row">
                      <div class="col-md-offset-3 col-md-6">
                          <table class="table">
                            <tr><td>Test Name</td><td><?php echo humanize($test_name); ?></td></tr>
                            <tr><td>Test Description</td><td><?php echo $test_description; ?></td></tr>
                            <tr><td>Test Price</td><td><?php echo $test_price; ?></td></tr>
                            <tr><td>Status</td><td><?php echo humanize($status); ?></td></tr>
                            
                        </table>
                        <a href="<?php echo site_url('admin/tests') ?>" class="btn btn-default">Cancel</a>
                      </div>

                    </div>
                         
                    </div><!-- /.box-body -->
    
                    <div class="box-footer">
    
                    </div><!-- /.box-footer -->
                   
                  </div><!-- /.box -->
                    
                
            </section>
    
    </div>