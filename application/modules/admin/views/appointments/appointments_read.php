	    		<table class="table">
	    		<tr><td>Test</td><td><?php echo getTestName($test); ?></td></tr>
	    		<tr><td>Sub Test</td><td><?php echo $subtest_name; ?></td></tr>
			    <tr><td>Reference No</td><td><?php echo $reference_no; ?></td></tr>
			    <tr><td>Name</td><td><?php echo humanize($name); ?></td></tr>
			    <tr><td>Age</td><td><?php echo $age; ?></td></tr>
			    <tr><td>Gender</td><td><?php echo humanize($sex); ?></td></tr>
			    <tr><td>Phone</td><td><?php echo $phone; ?></td></tr>
			    <tr><td>Email Id</td><td><?php echo $email_id; ?></td></tr>
			    <tr><td>Test Price</td><td><?php echo $test_price." ".$this->config->item('site_currency'); ?></td></tr>
			    <tr><td>Discount</td><td><?php echo $discount; ?> Rs</td></tr>
			    <tr><td>Total Price</td><td><?php echo $total_price; ?></td></tr>
			    <tr><td>Sample Collection Time</td><td><?php echo $sample_collection_time; ?></td></tr>
			    <tr><td>Appointment Date</td><td><?php echo $appointment_date; ?></td></tr>
          <tr>
              <td>Doctor Ref By</td>
              <td>Dr. <?php                
               if ($doctor_id=='-1')
               {
                 echo 'Others';
               } else {
                  $doctor = getDoctor($doctor_id);
                  if (isset($doctor->surname))
                  {
                    echo humanize($doctor->surname.' '.$doctor->name);
                  }
               }
               ?>
              </td>
          </tr>
			    <tr><td>Appointment Status</td><td><?php echo humanize($appointment_status); ?></td></tr>
			    <tr><td>Report Doc</td><td><?php $reports = explode(',',$report_doc); 
			    foreach ($reports as $key => $value) {
			    	echo "<a target='_blank' href='assets/reports/$reference_no/$value'>$value</a></br>";
			    }
			    ?></td></tr>
			    <tr><td>Staff Name</td><td><?php echo getUserName($user_id); ?></td></tr>
			    </table>		