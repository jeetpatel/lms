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
                          <h3 class="box-title"> <?php echo $button ?> Doctor</h3>
                        </div><!-- /.box-header -->
                        
                      
                        <div class="box-body">
                            

                            <?php echo form_open($action, $attributes); ?>
                            <div class="row">

                                <div class="col-md-3">
                                    <i class="fa fa-user-md fa-5x" style="margin-top:180px;margin-left:120px;"></i>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="varchar">Surname <span class="text-danger">*</span> <?php echo form_error('surname') ?></label>
                                    <input type="text" class="form-control" name="surname" id="surname" placeholder="Surname" value="<?php echo $surname; ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="varchar">Name <span class="text-danger">*</span> <?php echo form_error('name') ?></label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo $name; ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="varchar">Medical Licence No <?php echo form_error('medical_licence_no') ?></label>
                                    <input type="text" class="form-control" name="medical_licence_no" id="medical_licence_no" placeholder="Medical Licence No" value="<?php echo $medical_licence_no; ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="varchar">Specialization <span class="text-danger">*</span> <?php echo form_error('specialization') ?></label>
                                    <?php echo form_dropdown('specialization', $this->config->item('specialization_opts'), $specialization, 'id="specialization" class="form-control"'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="varchar">Phone <?php echo form_error('phone') ?></label>
                                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone" value="<?php echo $phone; ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="varchar">Commission (%) <?php echo form_error('commission') ?></label>
                                    <input type="number" class="form-control" max="100" name="commission" id="commission" placeholder="Commission (%)" value="<?php echo $commission; ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="enum">Status <span class="text-danger">*</span> <?php echo form_error('status') ?></label>
                                    <?php echo form_dropdown('status', $this->config->item('status_opts'), $status, 'id="status" class="form-control"'); ?>
                                </div>
                                <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
                                <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                                <a href="<?php echo site_url('admin/doctors') ?>" class="btn btn-default">Cancel</a>

                                </div>
                            </div>
                                
                            </form>
                        </div><!-- /.box-body -->
        
                        <div class="box-footer">
        
                        </div><!-- /.box-footer -->
                       
                      </div><!-- /.box -->
                        
                    
                </section>
        
        </div>