<div class="wrapper">
  <header class="main-header">
    <!-- Logo -->
    <a href="admin" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">LAB</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><small>
        <?php if($this->config->item('site_name') != "") 
          echo $this->config->item('site_name'); 
        else 
          echo SITENAME; ?>
          </small> </span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li><a href="<?php echo LOGOUT; ?>"><i class="fa fa-sign-out"></i>&nbsp;&nbsp;<b>LOGOUT</b></a></li>
          <!-- Control Sidebar Toggle Button -->
          <!-- <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li> -->
        </ul>
      </div>
    </nav>
  </header>
  <?php $this->load->view('admin/common/sidebar'); ?>