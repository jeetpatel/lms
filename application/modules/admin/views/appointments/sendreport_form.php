<?php echo form_open_multipart($action,$attributes); ?>
	<div id="mes">
		
	</div>

	<div id="send_mail_mes">
		
	</div>

	<div class="form-group">
		<label class="" for="">Appointment Ref No :</label> <?php echo $ref_no; ?>
	</div>
	
	<div class="form-group">
		<label class="" for="">Report :</label> <small>Multiple files can be selected at a time to upload.</small>
		<input type="file" name="report[]" multiple id="report" class="" value="" required="required" pattern="" title="">
		Allowed Types : <span class="text-success">pdf</span>
	</div>
	
	<?php if(!empty($details->email_id)): ?>
		<div class="checkbox">
			<label>
				<input type="checkbox" name="send_mail" value="1">Send Mail
			</label>
		</div>
	<?php endif; ?>

	<input type="hidden" name="ref_no" id="input" class="form-control" value="<?php echo $ref_no; ?>">

	<button type="submit" class="btn btn-primary mt10">Upload Reports</button>
</form>

<div class="well mt10">
	<ul>
		<li>Appointment status will change to generated on uploading the report.</li>
		<li>Appointment having mail address only have option to send reports to mail.</li>
	</ul>
	
		   
</div>
