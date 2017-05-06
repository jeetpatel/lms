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

        <div class="row mb10">
            <div class="col-md-7">
                <?php //echo anchor(site_url('admin/appointments/create'),'Create', 'class="btn btn-primary"'); ?>
                <a href="javascript:void(0);" class="btn btn-primary">Appointments : <b><?php echo $total_rows ?></b></a>
                <a href="javascript:void(0);" class="btn btn-primary">Amount : <b><?php echo $day_details['total_amount'] . ' ' . $this->config->item('site_currency') ?></b></a>
                <a href="javascript:void(0);" class="btn btn-primary">Pending Amount : <b><?php echo $day_details['pending_amount'] . ' ' . $this->config->item('site_currency') ?></b></a>
                <a href="javascript:void(0);" class="btn btn-primary">Received Amount : <b><?php echo $day_details['received_amount'] . ' ' . $this->config->item('site_currency') ?></b></a>
            </div>
            <div class="col-md-5">
                <div class="pull-right">
                    <a href="javascript:void(0);" class="btn btn-info">Pending : <b><?php echo $day_details['pending_appointments'] ?></b></a>
                    <a href="javascript:void(0);" class="btn btn-warning">Inprogress : <b><?php echo $day_details['inprogress_appointments'] ?></b></a>
                    <a href="javascript:void(0);" class="btn btn-success">Generated : <b><?php echo $day_details['generated_appointments'] ?></b></a>
                    <a href="javascript:void(0);" class="btn btn-danger">Cancelled : <b><?php echo $day_details['cancelled_appointments'] ?></b></a>
                </div>
            </div>
        </div>


        <div class="row">
            <div style="margin-top: 8px;" id="message_wrapper" class="col-md-offset-3 col-md-6">

            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning">
                    <div class="box-header">
                        <h3 class="box-title">Today</h3>
                        <div class="box-tools">
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
                            </tr><?php
                            if (count($appointments_data) > 0):
                              foreach ($appointments_data as $appointments) {
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
                                            echo '<span class="label label-info">' . humanize($appointments->appointment_status) . '</span>';
                                            break;
                                          case "inprogress":
                                            echo '<span class="label label-warning">' . humanize($appointments->appointment_status) . '</span>';
                                            break;
                                          case 'generated':
                                            echo '<span class="label label-success">' . humanize($appointments->appointment_status) . '</span>';
                                            break;
                                          case 'cancelled':
                                            echo '<span class="label label-danger">' . humanize($appointments->appointment_status) . '</span>';
                                            break;
                                        }
                                        ?></td>
                                    <td>
                                        <?php
                                        switch ($appointments->payment_status) {
                                          case 'paid':
                                            echo '<span class="label label-success">' . humanize($appointments->payment_status) . '</span>';
                                            break;
                                          case "unpaid":
                                            echo '<span class="label label-danger">' . humanize($appointments->payment_status) . '</span>';
                                            break;
                                        }
                                        ?>  
                                    </td>
                                    <td width="300px">
                                        <a href="" rel="async" ajaxify="admin/appointments/read/<?php echo $appointments->id ?>">View</a>
                                        <?php
                                        echo ' | ';
                                        echo anchor(site_url('admin/appointments/update/' . $appointments->id), 'Update');
                                        echo ' | ';
                                        ?>
                                        <a href="admin/appointments/uploadReportsForm" class="uploadReportsForm" data-refno="<?php echo $appointments->reference_no; ?>">Upload Reports</a>
                                        |
                                        <a href="javascript:void(0)" onclick="openPopup('<?php echo site_url('admin/appointments/generate/' . $appointments->id);?>','Print Invoice')"><i class="fa fa-print" aria-hidden="true"></i></a>                                        
                                        <span>
                                            <?php
                                            if (!empty($appointments->report_doc) && !empty($appointments->email_id)) {
                                              echo ' | ';
                                              echo '<a href="admin/appointments/sendMail" class="sendmail" data-refno="' . $appointments->reference_no . '">Send Mail</a>';
                                            }
                                            ?>    
                                        </span>
                                    </td>
                                </tr>
                              <?php } else: ?>
                              <tr>
                                  <td colspan=8 class="text-center"> <h4>Make your First Appointment.</h4></td>
                              </tr>
                            <?php endif; ?>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?php echo anchor(site_url('admin/appointments/create'), 'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-6 text-right" id="appointments_pagination">
                <?php echo $pagination ?>
            </div>
        </div>
    </section>
</div>