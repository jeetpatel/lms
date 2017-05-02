<div class="content-wrapper">
         

            <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Appointments
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
            
            <div style="margin-top: 8px;" id="message_wrapper" class="col-md-offset-3 col-md-6">
                    
            </div>

        </div>

      


        <div class="row">
            
            <div class="col-xs-12">
              
              <div class="box box-warning">
                
                <div class="box-header">
                  <h3 class="box-title">List</h3>
                  <div class="box-tools">
                    <form action="<?php echo site_url('admin/appointments'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search Here..." name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('admin/appointments'); ?>" class="btn btn-default">Reset</a>
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
        <th>App No</th>
        <th>Name</th>
        <th>Gender</th>
        <th>Phone</th>
        <th>Test</th>
        <th>Date</th>
        <th>Status</th>
        <th>Payment</th>
        <th>Action</th>
            </tr><?php if(count($appointments_data) > 0):
            foreach ($appointments_data as $appointments)
            {
                ?>
                <tr id="<?php echo $appointments->reference_no ?>">
            <td><?php echo $appointments->reference_no ?></td>
            <td><b><?php echo humanize($appointments->name) ?></b></td>
            <td><?php echo humanize($appointments->sex) ?></td>
            <td><?php echo $appointments->phone ?></td>
            <td><?php echo getTestName($appointments->test) ?></td>
            <td><?php echo $appointments->appointment_date ?></td>
            <td><?php 
            switch ($appointments->appointment_status) {
                case 'pending':
                        echo '<span class="label label-info">'.humanize($appointments->appointment_status).'</span>';
                    break;
                case "inprogress":
                        echo '<span class="label label-warning">'.humanize($appointments->appointment_status).'</span>';
                    break;
                case 'generated':
                      echo '<span class="label label-success">'.humanize($appointments->appointment_status).'</span>';
//                    echo '<span class="label label-success" id="appoint-generate-List">'. anchor(site_url('admin/appointments/generate/'.$appointments->id),humanize($appointments->appointment_status)).'</span>';
                    break;
                case 'cancelled':
                        echo '<span class="label label-danger">'.humanize($appointments->appointment_status).'</span>';
                    break;
            }
             ?></td>
             <td>
               <?php 
            switch ($appointments->payment_status) {
                case 'paid':
                        echo '<span class="label label-success">'.humanize($appointments->payment_status).'</span>';
                    break;
                case "unpaid":
                        echo '<span class="label label-danger">'.humanize($appointments->payment_status).'</span>';
                    break;
            }
             ?>  
             </td>
            <td width="300px">

                <a href="" rel="async" ajaxify="admin/appointments/read/<?php  echo $appointments->id?>">View</a>
                <?php 
                echo ' | '; 
                echo anchor(site_url('admin/appointments/update/'.$appointments->id),'Update'); 
                echo ' | ';
                ?>
                <a href="admin/appointments/uploadReportsForm" class="uploadReportsForm" data-refno="<?php echo $appointments->reference_no; ?>">Upload Reports</a>
				<?php 
				echo ' | ';
				echo anchor(site_url('admin/appointments/generate/'.$appointments->id),'<i class="fa fa-print" aria-hidden="true"></i>',false,1);
				?>
                <span>
                    <?php 
                        if(!empty($appointments->report_doc) && !empty($appointments->email_id)){
                            echo ' | ';
                            echo '<a href="admin/appointments/sendMail" class="sendmail" data-refno="'.$appointments->reference_no.'">Send Mail</a>';
                        }
                    ?>    
                </span>
                
            
            </td>
        </tr>
        
        <?php } else: ?>

        <tr>
            <td colspan=8 class="text-center"> <h4>Make your Fisrt Appointment.</h4></td>
        </tr>
    <?php   endif; ?>
        </table>


                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>


        <div class="row">
            <div class="col-md-6">
                <?php echo anchor(site_url('admin/appointments/create'),'Create', 'class="btn btn-primary"'); ?>
                <a href="javascript:void(0);" class="btn btn-primary">Total Appointments : <?php echo $total_rows ?></a>
                <?php echo anchor(site_url('admin/appointments/excel'), 'Excel', 'class="btn btn-primary"'); ?>
            </div>
            
            <div class="col-md-6 text-right" id="appointments_pagination">
                <?php echo $pagination ?>
            </div>

        </div>

        
          <div class="row">
            
            <div class="col-md-12" style="margin-top:10px;">
                <div class="well">
                 <span class="text-danger">NOTE : Appointments can be searched based on App no, Name, Phone, Date, Status.</span>    
                </div>
            </div>

        </div>

        </section>
            
     </div>
