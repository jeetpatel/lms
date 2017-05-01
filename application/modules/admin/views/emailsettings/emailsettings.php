         <div class="content-wrapper">
                
                 <section class="content-header">
                  <h1>
                    Pages
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
                        
                        <div class="box-header with-border text-center">
                          <h3 class="box-title"> Email Settings</h3>
                        </div><!-- /.box-header -->
                        
                      
                        <div class="box-body">
                           
                            <div class="row">

                                <div class="col-md-offset-4 col-md-4">
                                    
                                    <?php if($this->session->flashdata('message') != ""): ?>
                                    <div class="alert alert-info">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <strong>info!</strong> <?php echo $this->session->flashdata('message'); ?>
                                    </div>
                                    <?php endif; ?>

                                    <?php echo form_open($action, $attributes); ?>
                                        <div class="form-group">
                                            <label for="">Protocol <span class="text-danger">*</span> <?php echo form_error('protocol') ?></label>
                                            <?php echo form_dropdown('protocol', array('smtp' => 'smtp', 'sendmail' => 'sendmail'), $protocol,'class="form-control" id="protocol" '); ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Mail Path <span class="text-danger">*</span> <?php echo form_error('path_to_send_mail') ?></label>
                                            <?php echo form_dropdown('path_to_send_mail', array('/usr/sbin/smtp' => '/usr/sbin/smtp', '/usr/sbin/sendmail' => '/usr/sbin/sendmail'), $path_to_send_mail,'class="form-control" id="path_to_send_mail" '); ?>
                                        </div>


                                        <div class="form-group">
                                            <label for="">Host <span class="text-danger">*</span> <?php echo form_error('host') ?></label>
                                            <input type="text" class="form-control" id="host"  name="host" value="<?php echo $host ?>" placeholder="Host">
                                        </div>

                                        <div class="form-group">
                                            <label for="">Email <span class="text-danger">*</span>  <?php echo form_error('email') ?></label>
                                            <input type="text" class="form-control" id="email" name="email" value="<?php echo $email ?>" placeholder="Email">
                                        </div>


                                        <div class="form-group">
                                            <label for="">Password <?php echo form_error('password') ?></label>
                                            <input type="password" class="form-control"  name="password" id="password" value="<?php echo $password ?>" placeholder="Password">
                                        </div>


                                        <div class="form-group">
                                            <label for="">Port <span class="text-danger">*</span>   <?php echo form_error('port') ?></label>
                                            <input type="text" class="form-control" name="port" id="port"  value="<?php echo $port ?>" placeholder="Port">
                                        </div>  
                                    
                                         <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
                                    
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                                
                        </div><!-- /.box-body -->
        
                        <div class="box-footer">
        
                        </div><!-- /.box-footer -->
                       
                      </div><!-- /.box -->
                        
                    
                </section>
        
        </div>