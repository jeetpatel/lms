
    <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            
            
          <?php if($this->authorization->is_permitted('manage_appointments')): ?>
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?php echo $appointments_count ?></h3>
                  <p>APPOINTMENTS</p>
                </div>
                <div class="icon">
                  <i class="fa fa-files-o"></i>
                </div>
                <a href="admin/appointments" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
          <?php endif; ?>


            <?php if($this->authorization->is_permitted('manage_tests')): ?>
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?php echo $tests_count ?></h3>
                  <p>TESTS</p>
                </div>
                <div class="icon">
                  <i class="fa fa-flask"></i>
                </div>
                <a href="admin/tests" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
          <?php endif; ?>


          <?php if($this->authorization->is_permitted('manage_doctors')): ?>
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3><?php echo $doctors_count ?></h3>
                  <p>DOCTORS</p>
                </div>
                <div class="icon">
                  <i class="fa fa-user-md"></i>
                </div>
                <a href="admin/doctors" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
          <?php endif; ?>

            <?php if($this->authorization->is_permitted('manage_users')): ?>
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3><?php echo $staff_count ?></h3>
                  <p>STAFF</p>
                </div>
                <div class="icon">
                  <i class="fa fa-users"></i>
                </div>
                <a href="auth/account/manage_users" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
          <?php endif; ?>

          </div><!-- /.row -->

          <!-- Small boxes (Stat box) -->
          <div class="row">
              

               <?php if($this->authorization->is_permitted('manage_appointments')): ?>
              <a href="admin/appointments/create">
                <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h4 class="text-center">NEW APPOINTMENT</h4>
                    
                </div>
                
                <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
              </div>
            </div><!-- ./col -->
              </a> 
            <?php endif; ?>
            

            <?php if($this->authorization->is_permitted('manage_tests')): ?>
            <a href="admin/tests/create">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h4 class="text-center">ADD TEST</h4>
                </div>
               
                <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
              </div>
            </div><!-- ./col -->
            </a>
          <?php endif; ?>

            <?php if($this->authorization->is_permitted('manage_doctors')): ?>
            <a href="admin/doctors/create">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h4 class="text-center">ADD DOCTOR</h4>
                </div>
                <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
              </div>
            </div><!-- ./col -->
            </a>
          <?php endif; ?>

           <?php if($this->authorization->is_permitted('manage_users')): ?>
            <a href="auth/account/manage_users/save">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h4 class="text-center">ADD STAFF</h4>
                </div>
                <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
              </div>
            </div><!-- ./col -->
            </a>
          <?php endif; ?>
            
          </div><!-- /.row -->


          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <section class="col-lg-6 connectedSortable">
             
              <!-- quick email widget -->
              <div class="box box-info">
                <div class="box-header">
                  <i class="fa fa-envelope"></i>
                  <h3 class="box-title">Quick Email</h3>
                  <!-- tools box -->
                  <div class="pull-right box-tools">
                    <button class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                  </div><!-- /. tools -->
                </div>
                <div class="box-body">
                  
                  <div id="mes">
                    
                  </div>

                  <?php echo form_open('admin/sendMail', array('name' => 'email_form')); ?>
                    
                    <div class="form-group">
                      <input type="email" class="form-control" required name="emailto" placeholder="Email to:">
                    </div>
                    
                    <div class="form-group">
                      <input type="text" class="form-control"  required name="subject" placeholder="Subject">
                    </div>
                    
                    <div>
                      <textarea class="textarea" required placeholder="Message" name="message" style="width: 100%; height: 145px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                    </div>

                  

                </div>
                <div class="box-footer clearfix">
                  <button class="pull-right btn btn-default" id="sendEmail">Send <i class="fa fa-arrow-circle-right"></i></button>
                </div>

                </form>
              </div>

            </section><!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-6 connectedSortable">
               
               <?php if($this->authorization->is_permitted('reports')): ?>   
               <!-- DONUT CHART -->
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Appointments Overview</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body chart-responsive">
                  <div class="chart" id="sales-chart" style="height: 300px; position: relative;"></div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              <?php endif; ?>

            </section><!-- right col -->
          </div><!-- /.row (main row) -->
            

            


        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->