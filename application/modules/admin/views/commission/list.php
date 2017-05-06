<div class="content-wrapper">


    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Commission
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

            <?php if ($this->session->flashdata('message') <> ''): ?>
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
                            <form action="<?php echo site_url('admin/commission'); ?>" class="form-inline" method="get">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                                    <span class="input-group-btn">
                                        <?php
                                        if ($q <> '') {
                                          ?>
                                          <a href="<?php echo site_url('admin/commission'); ?>" class="btn btn-default">Reset</a>
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
                                <th>ID</th>
                                <th>Doctor Name</th>
                                <th>Doctor ID</th>
                                <th>Total Amount</th>
                                <th>Percent(%)</th>
                                <th>Commission</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr><?php
                                        if (count($result_data) > 0):
                                          foreach ($result_data as $result) {
                                            ?>
                                <tr>
                                    <td width="80px"><?php echo ++$start ?></td>
                                    <td><?php echo humanize($result->surname); ?> <?php echo humanize($result->name); ?></td>
                                    <td><?php echo $result->doctor_id; ?></td>
                                    <td><?php echo $result->total_amount; ?></td>
                                    <td><?php echo $result->comm_percent; ?></td>
                                    <td><?php echo $result->comm_amount; ?></td>
                                    <td><?php echo $result->created_at; ?></td>                                   
                                    <td>
                                        <a href="" rel="async" ajaxify="admin/appointments/read/<?php echo $result->appointment_id;?>" data-title="Appointment Info">Appointment</a>
                                    </td>
                                </tr>
                              <?php } else: ?>
                            <?php endif; ?>
                        </table>


                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>


        <div class="row">
            <div class="col-md-6">
                <a href="javascript:void(0);" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
            </div>
            <div class="col-md-6 text-right" id="appointments_pagination">
                <?php echo $pagination ?>
            </div>
        </div>


    </section>

</div>