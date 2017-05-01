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
                    
                    <div class="box-header with-border text-center">
                      <h3 class="box-title"> <?php echo $button ?> Test</h3>
                    </div><!-- /.box-header -->
                    
                  
                    <div class="box-body">
                            <?php echo form_open($action, $attributes); ?>

                            <div class="row">

                                <div class="col-md-3">
                                    <i class="fa fa-flask fa-5x" style="margin-top:140px;margin-left:120px;"></i>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="varchar">Test Name <span class="text-danger">*</span>  <?php echo form_error('test_name') ?></label>
                                    <input type="text" class="form-control" name="test_name" id="test_name" placeholder="Test Name" value="<?php echo $test_name; ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="test_description">Test Description <span class="text-danger">*</span> <?php echo form_error('test_description') ?></label>
                                    <textarea class="form-control" rows="3" name="test_description" id="test_description" placeholder="Test Description"><?php echo $test_description; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="decimal">Test Price (<?php echo $this->config->item('site_currency'); ?>) <span class="text-danger">*</span> <?php echo form_error('test_price') ?></label>
                                    <input type="text" class="form-control" name="test_price" id="test_price" placeholder="Test Price" value="<?php echo $test_price; ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="enum">Status <span class="text-danger">*</span> <?php echo form_error('status') ?></label>
                                    <?php echo form_dropdown('status', $this->config->item('status_opts'), $status, 'id="status" class="form-control"'); ?>
                                    
                                </div>
                                <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
                                <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                                <a href="<?php echo site_url('admin/tests') ?>" class="btn btn-default">Cancel</a>
                                </div>
                            </div>
                            
                        </form>
                    </div><!-- /.box-body -->
    
                    <div class="box-footer">
    
                    </div><!-- /.box-footer -->
                   
                  </div><!-- /.box -->
                    
                
            </section>
    
    </div>
    
    


        
