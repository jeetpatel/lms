   <div class="content-wrapper">
      <section class="content">
        <div class="row">
          
          <div class="col-md-6">
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
                  <div class="chart" id="appointments-chart" style="height: 300px; position: relative;"></div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->      
          </div>


          <div class="col-md-6">
              <!-- DONUT CHART -->
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Transactions Overview</h3> &nbsp;&nbsp;&nbsp; <b>Currency</b> :  <?php echo $this->config->item('site_currency'); ?>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body chart-responsive">
                  <div class="chart" id="finance-chart" style="height: 300px; position: relative;"></div>


                </div><!-- /.box-body -->
              </div><!-- /.box -->      
          </div>


        </div>   
  
      
    </section>
   </div>

  
                  
             