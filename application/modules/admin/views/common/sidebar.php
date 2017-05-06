<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <?php  if($this->session->userdata('user_image') != ""): ?>
            <img src="assets/images/user/<?php echo $this->session->userdata('user_image') ?>  " class="img-circle" alt="User Image">
        <?php else: ?>
            <img src="assets/images/dummy.jpg" class="img-circle" alt="User Image">
        <?php endif; ?>
        
      </div>
      <div class="pull-left info">
        <p><?php echo $this->session->userdata('username'); ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>

      <li class="<?php if($this->uri->uri_string() == ADMIN) echo "active"; ?>"><a href="admin"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
      
      <?php if($this->authorization->is_permitted('manage_appointments')): ?>
      <li class="<?php if($this->uri->uri_string() == ADDAPPOINTMENT) echo "active"; ?>"><a href="<?php echo ADDAPPOINTMENT; ?>"><i class="fa fa-plus"></i> <span>New Appointment</span></a></li>
      <li class="<?php if($this->uri->uri_string() == ALLAPPOINTMENTS) echo "active"; ?>"><a href="<?php echo ALLAPPOINTMENTS; ?>"><i class="fa fa-files-o"></i><span>All Appointments</span></a></li>
      <li class="<?php if($this->uri->uri_string() == TODAYAPPOINTMENTS) echo "active"; ?>"><a href="<?php echo TODAYAPPOINTMENTS; ?>"><i class="fa fa-calendar"></i><span>Today Appointments</span> </a></li>
      <li class="<?php if($this->uri->uri_string() == GETAPPOINTMENTSBYDATE) echo "active"; ?>"><a href="<?php echo GETAPPOINTMENTSBYDATE; ?>"><i class="fa fa-calendar-check-o"></i><span>Appointments by date</span> </a></li>
      <?php endif; ?>

      
      <?php if($this->authorization->is_permitted('manage_tests')): ?>
      <li class="treeview <?php if($this->uri->uri_string() == ALLTESTS || $this->uri->uri_string() == ADDTEST) echo "active"; ?>">
        <a href="#">
          <i class="fa fa-flask"></i> <span>Laboratory Tests</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="<?php if($this->uri->uri_string() == ALLTESTS) echo "active"; ?>"><a href="<?php echo ALLTESTS; ?>"><i class="fa fa-circle-o"></i>List Tests</a></li>
          <li class="<?php if($this->uri->uri_string() == ADDTEST) echo "active"; ?>"><a href="<?php echo ADDTEST; ?>"><i class="fa fa-circle-o"></i>Add Test</a></li>
        </ul>
      </li>
      <?php endif; ?>

      
      <?php if($this->authorization->is_permitted('manage_doctors')): ?>
      <li class="treeview <?php if($this->uri->uri_string() == ALLDOCTORS || $this->uri->uri_string() == ADDDOCTOR) echo "active"; ?>">
        <a href="#">
          <i class="fa fa-user-md"></i> <span>Doctors</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="<?php if($this->uri->uri_string() == ALLDOCTORS) echo "active"; ?>"><a href="<?php echo ALLDOCTORS; ?>"><i class="fa fa-circle-o"></i>List Doctors</a></li>
          <li class="<?php if($this->uri->uri_string() == ADDDOCTOR) echo "active"; ?>"><a href="<?php echo ADDDOCTOR; ?>"><i class="fa fa-circle-o"></i>Add Doctor</a></li>
        </ul>
      </li>      
      <li class="<?php if($this->uri->uri_string() == COMMISSION) echo "active"; ?>"><a href="<?php echo COMMISSION; ?>"><i class="fa fa-plus"></i> <span>Commission</span></a></li>
      <?php endif; ?>

      

      <li class="treeview <?php if($this->uri->uri_string() == ACCOUNT_PROFILE || $this->uri->uri_string() == ACCOUNT_SETTINGS || $this->uri->uri_string() == ACCOUNT_PASSWORD) echo "active"; ?>">
        <a href="#">
          <i class="fa fa-user"></i> <span>Accout Info</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="<?php if($this->uri->uri_string() == ACCOUNT_PROFILE) echo "active"; ?>"><a href="<?php  echo ACCOUNT_PROFILE; ?>"><i class="fa fa-circle-o"></i> Manage Profile</a></li>
          <li class="<?php if($this->uri->uri_string() == ACCOUNT_SETTINGS) echo "active"; ?>"><a href="<?php  echo ACCOUNT_SETTINGS; ?>"><i class="fa fa-circle-o"></i> Account</a></li>
          <li class="<?php if($this->uri->uri_string() == ACCOUNT_PASSWORD) echo "active"; ?>"><a href="<?php  echo ACCOUNT_PASSWORD; ?>"><i class="fa fa-circle-o"></i> Password</a></li>
        </ul>
      </li>

      <?php if($this->authorization->is_permitted('manage_users') || $this->authorization->is_admin()): ?>
      <li class="treeview <?php if($this->uri->uri_string() == MANAGE_USERS || $this->uri->uri_string() == ADD_USER) echo "active"; ?>">
        <a href="#">
          <i class="fa fa-users"></i> <span>Users</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="<?php if($this->uri->uri_string() == MANAGE_USERS) echo "active"; ?>"><a href="<?php  echo MANAGE_USERS; ?>"><i class="fa fa-circle-o"></i> All Users</a></li>
          <li class="<?php if($this->uri->uri_string() == ADD_USER) echo "active"; ?>"><a href="<?php  echo ADD_USER; ?>"><i class="fa fa-circle-o"></i> Add User</a></li>
        </ul>
      </li>
    <?php endif; ?>


      <?php if($this->authorization->is_permitted('manage_roles') || $this->authorization->is_admin()): ?>
      <li class="<?php if($this->uri->uri_string() == MANAGE_ROLES) echo "active"; ?>"><a href="<?php  echo MANAGE_ROLES; ?>"><i class="fa fa-edit"></i> <span>Roles</span></a></li>
      <?php endif; ?>

      <?php if($this->authorization->is_permitted('manage_permissions') || $this->authorization->is_admin()): ?>
      <li class="<?php if($this->uri->uri_string() == MANAGE_PERMISSIONS) echo "active"; ?>"><a href="<?php  echo MANAGE_PERMISSIONS; ?>"><i class="fa fa-check"></i> <span>Permissions</span></a></li>
      <?php endif; ?>

       <?php if($this->authorization->is_permitted('manage_tests')): ?>
      <li class="<?php if($this->uri->uri_string() == SITESETTINGS) echo "active"; ?>"><a href="<?php echo SITESETTINGS; ?>">
      <i class="fa fa fa-desktop"></i> <span>Site Settings</span></a></li>
      <?php endif; ?>

      <?php if($this->authorization->is_permitted('manage_emailsettings')): ?>
      <li class="<?php if($this->uri->uri_string() == EMAILSETTINGS) echo "active"; ?>"><a href="<?php echo EMAILSETTINGS; ?>"><i class="fa fa-envelope"></i>  <span>Email Settings</span> </a></li>
      <?php endif; ?>

      <?php if($this->authorization->is_permitted('reports')): ?>
      <li class="<?php if($this->uri->uri_string() == REPORTS) echo "active"; ?>"><a href="<?php echo REPORTS; ?>"><i class="fa fa-bar-chart"></i> <span>Reports</span></a></li>
      <?php endif; ?>

    </ul>


  </section>
  <!-- /.sidebar -->
</aside>