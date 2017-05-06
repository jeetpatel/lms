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

                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="varchar">Test Name <span class="text-danger">*</span>  <?php echo form_error('test_name') ?></label>
                            <input type="text" class="form-control" name="test_name" id="test_name" placeholder="Test Name" value="<?php echo $test_name; ?>" />
                        </div>
                        <div class="form-group">
                            <label for="test_description">Test Description <span class="text-danger">*</span> <?php echo form_error('test_description') ?></label>
                            <textarea class="form-control" rows="3" name="test_description" id="test_description" placeholder="Test Description"><?php echo $test_description; ?></textarea>
                        </div>
                        <div class="form-group">

                            <div class="input_fields_wrap">
                                <button class="add_field_button btn btn-info">Add More</button>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>SubTest Name</label><br>
                                        <?php echo form_error('subtest_name[]') ?>
                                    </div>
                                    <div class="col-md-4">
                                        <label>SubTest Price</label> <br>
                                      <?php echo form_error('subtest_price[]') ?>
                                    </div>
                                </div>
                                <?php if (count($subtest)>0) { 
                                  $subTestCount = 0;
   foreach ($subtest as $sTest) {
    ?>
  <div class="row subtest_row">
      <div class="col-md-6">
          <div class="form-group">
              <input type="text" value="<?php echo $sTest->subtest_name; ?>" placeholder="Sub Test Name" class="form-control" maxlength="50" name="subtest_name[]" required="true">
          </div>        
      </div>
      <div class="col-md-4">
          <div class="form-group">
              <input type="number" value="<?php echo $sTest->price; ?>" placeholder="Sub Test Price" class="form-control" maxlength="6" max="500000" name="subtest_price[]" required="true">
          </div>        
      </div>
      <div class="col-md-2">
          <div class="form-group">
              <input type="text" name="subTestID[]" value="<?php echo $sTest->id; ?>"/>
              <?php if ($subTestCount>0) { ?>
              <a href="javascript:void(0)" class="remove_field">Remove</a>
              <?php } $subTestCount++;?>
          </div>        
      </div>
  </div>
   <?php } } else { ?>
                                <div class="row subtest_row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" placeholder="Sub Test Name" class="form-control" maxlength="50" name="subtest_name[]" required="true">
                                        </div>        
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="number" placeholder="Sub Test Price" class="form-control" maxlength="6" max="500000" name="subtest_price[]" required="true">
                                        </div>        
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                        </div>        
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
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





