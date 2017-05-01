
 <div class="content-wrapper">
        
         <section class="content-header">
          <h1>
            Sitesettings
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
                  <h3 class="box-title">Sitesettings</h3>
                </div><!-- /.box-header -->
                
              
                <div class="box-body">
                <div class="row">
                  <div class="col-md-offset-3 col-md-6">
                    <?php echo form_open($action, $attributes); ?>
                        
                        <?php if($this->session->flashdata('message') != ""): ?>
                            <div class="alert alert-info">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>info!</strong> <?php echo $this->session->flashdata('message'); ?>
                            </div>
                        <?php endif; ?>

                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="varchar">Site Name <span class="text-danger">*</span> <?php echo form_error('site_name') ?></label>
                              <input type="text" class="form-control" name="site_name" id="site_name" placeholder="Site Name" value="<?php echo $site_name; ?>" />
                            </div>    
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="varchar">Phone <?php echo form_error('site_phone') ?></label>
                              <input type="text" class="form-control" name="site_phone" id="site_phone" placeholder="Phone" value="<?php echo $site_phone; ?>" />
                            </div>
                          </div>
                        </div>


                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="varchar">Email <?php echo form_error('site_email') ?></label>
                              <input type="text" class="form-control" name="site_email" id="site_email" placeholder="Email" value="<?php echo $site_email; ?>" />
                            </div>    
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="varchar">Address <?php echo form_error('site_address') ?></label>
                              <input type="text" class="form-control" name="site_address" id="site_address" placeholder="Address" value="<?php echo $site_address; ?>" />
                            </div>
                          </div>
                        </div>


                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="varchar">City <?php echo form_error('site_city') ?></label>
                              <input type="text" class="form-control" name="site_city" id="site_city" placeholder="City" value="<?php echo $site_city; ?>" />
                            </div>    
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="varchar">State <?php echo form_error('site_state') ?></label>
                              <input type="text" class="form-control" name="site_state" id="site_state" placeholder="State" value="<?php echo $site_state; ?>" />
                            </div>
                          </div>
                        </div>
                        

                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="varchar">Country <?php echo form_error('site_country') ?></label>
                              <input type="text" class="form-control" name="site_country" id="site_country" placeholder="Country" value="<?php echo $site_country; ?>" />
                            </div>    
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="varchar">Pincode <?php echo form_error('site_pincode') ?></label>
                              <input type="text" class="form-control" name="site_pincode" id="site_pincode" placeholder="Pincode" value="<?php echo $site_pincode; ?>" />
                            </div>
                          </div>
                        </div>


                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="varchar">Currency <span class="text-danger">*</span> <?php echo form_error('site_currency') ?></label>
                              <input type="text" class="form-control" name="site_currency" id="site_currency" placeholder="Currency" value="<?php echo $site_currency; ?>" />
                            </div>    
                          </div>
                          <div class="col-md-6">
                          </div>
                        </div>
                        
                        
                        <input type="hidden" name="id" id="rec" value="<?php echo $id; ?>" /> 
                        <button type="submit" class="btn btn-primary">Update</button> 

                    </form>
                  </div>

                </div>
                
                </div><!-- /.box-body -->

                <div class="box-footer">

                </div><!-- /.box-footer -->
               
              </div><!-- /.box -->
                
            
        </section>

</div>