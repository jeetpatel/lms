     <div class="content-wrapper">
            
             <section class="content-header">
              <h1>
                Doctors
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
                      <h3 class="box-title">Doctor Info</h3>
                    </div><!-- /.box-header -->
                    
                  
                    <div class="box-body">

                    <div class="row">
        <div class="col-md-offset-3 col-md-6">
          <table class="table">
                            <tr><td>Surname</td><td><?php echo humanize($surname); ?></td></tr>
                            <tr><td>Name</td><td><?php echo humanize($name); ?></td></tr>
                            <tr><td>Medical Licence No</td><td><?php echo $medical_licence_no; ?></td></tr>
                            <tr><td>Specialization</td><td><?php echo humanize($specialization); ?></td></tr>
                            <tr><td>Phone</td><td><?php echo $phone; ?></td></tr>
                            <tr><td>Status</td><td><?php echo humanize($status); ?></td></tr>
                            
                        </table>

                        <a href="<?php echo site_url('admin/doctors') ?>" class="btn btn-default">Cancel</a>
        </div>
        </div>
                        
                    </div><!-- /.box-body -->
    
                    <div class="box-footer">
    
                    </div><!-- /.box-footer -->
                   
                  </div><!-- /.box -->
                    
                
            </section>
    
    </div
