<!--Custom CSS files-->
<link href="<?php echo base_url().'assets/modules/patients/details.css'; ?>" type="text/css" rel="stylesheet"/>

<!--art card form-->
<div class="container full-content" style="background:#9CF">
    <input type="hidden" id="hidden_data" data-baseurl="<?php echo base_url(); ?>" data-patient="<?php echo $patient_id; ?>">
	<!--breadcrumb & instructions row-->
    <div class="row-fluid">
	    <div class="span12">
		    <ul class="breadcrumb">
			  <li><a href="<?php echo base_url().'patient_management'; ?>">Patients</a> <span class="divider">/</span></li>
			  <li class="active">ART Card</li>
			</ul>
			<div class="alert alert-info">
			    <button type="button" class="close" data-dismiss="alert">&times;</button>
				<h4>Mandatory!</h4>
				(Fields Marked with <b><span class='astericks'>*</span></b> Asterisks are required)
			</div>
	    </div>
	</div>
	<!--demographics row-->
	<div class="row-fluid">
		<!--demographics column-->
	    <div class="span4">
		    <fieldset>
				<legend>
					<h3>Patient Information &amp; Demographics</h3>
				</legend>
				<div class="row-fluid">
				    <div class="span6">
				    	<label>Medical Record No.</label>
						<input class="span8" type="text" name="medical_record_number" id="medical_record_number">
				    </div>
				    <div class="span6">
				    	<label><span class='astericks'>*</span>Patient Number CCC</label>
						<input type="text" class="span8" name="patient_number_ccc" id="patient_number_ccc" class="validate[required]">
				    </div>
				</div>
				<div class="row-fluid">
				    <div class="span12">
				    	<label><span class='astericks'>*</span>Last Name</label>
					    <input type="text" class="span8" name="last_name" id="last_name" class="validate[required]">
				    </div>
				</div>
				<div class="row-fluid">
					<div class="span6">
						<label><span class='astericks'>*</span>First Name</label>
						<input type="text" class="span8" name="first_name" id="first_name" class="validate[required]">
					</div>
					<div class="span6">
						<label>Other Name</label>
						<input type="text" class="span8" name="other_name" id="other_name">
					</div>
			    </div>
				<div class="row-fluid">
					<div class="span6">
						<label><span class='astericks'>*</span>Date of Birth</label>
						<input type="text" class="span8" name="dob" id="dob" class="validate[required]">
					</div>
					<div class="span6">
						<label> Place of Birth </label>
						<select name="pob" id="pob" class="span8">
							
						</select>
					</div>
				</div>
				<div class="row-fluid parent">
					<label>Match to parent/guardian in ccc?</label>
					<input type="text" class="span8" name="parent" id="parent">
				</div>
				<div class="row-fluid">
					<div class="span6">
						<label><span class='astericks'>*</span>Gender</label>
						<select name="gender" id="gender" class="span8" class="validate[required]">
						</select>
					</div>
					<div class="span6 pregnant">
						<label id="pregnant_container"> Pregnant?</label>
						<select name="pregnant" id="pregnant" class="span8">
							<option value="0">No</option><option value="1">Yes</option>
						</select>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6">
						<label >Start Age(Years)</label>
						<input type="text" class="span8" id="start_age" disabled="disabled"/>
					</div>
					<div class="span6">
						<label >Current Age(Years)</label>
						<input type="text" class="span8" id="age" disabled="disabled"/>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6">
						<label >Start Weight (KG)</label>
						<input type="text" class="span8" name="start_weight" id="start_weight">
					</div>
					<div class="span6">
						<label>Current Weight (KG) </label>
						<input type="text" class="span8" name="weight" id="weight">
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6">
						<label> Start Height (CM)</label>
						<input type="text" class="span8" name="start_height" id="start_height">
					</div>
					<div class="span6">
						<label> Current Height (CM)</label>
						<input  type="text" class="span8" name="current_height" id="height">
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6">
						<label> Start Body Surface Area (MSQ)</label>
						<input type="text" class="span8" name="start_bsa" id="start_bsa">
					</div>
					<div class="span6">
						<label> Current Body Surface Area (MSQ)</label>
						<input type="text" class="span8" name="sa" id="sa">
					</div>
				</div>
			    <div class="row-fluid">
					<div class="span6">
					    <label> Patient's Phone Contact(s)</label>
					    <input  type="text" class="span8"  name="phone" id="phone">
				    </div>
					<div class="span6">
						<label> Receive SMS Reminders</label>
						<label class="radio inline">
						    <input type="radio" name="sms_consent" id="sms_yes" value="1"> Yes
						</label>
						<label class="radio inline">
						    <input type="radio" name="sms_consent" id="sms_no" value="0"> No
						</label>
					</div>
		        </div>
				<div class="row-fluid">
					<label> Patient's Physical Contact(s)</label>
					<textarea name="physical" id="physical" class="span8"></textarea>
				</div>
				<div class="row-fluid">
					<label> Patient's Alternate Contact(s)</label>
					<textarea name="alternate" id="alternate" class="span8"></textarea>
				</div>
				<div class="row-fluid">
					<label>Does Patient belong to any support group?</label>
					<label class="checkbox inline span8">
						<input type="checkbox" name="support_group_box" id="support_group_box" value="0"> If Yes,List Them
					</label>
					<textarea class="list_area span8" name="support_group" id="support_group"></textarea>
				</div>
	     	</fieldset>
	    </div>
	    <!--program history column-->
	    <div class="span4">
	    	<fieldset>
				<legend>
					<h3>Program History</h3>
				</legend>
				<div class="row-fluid partner_status">
					<label>Partner Status</label>
					<select name="partner_status" id="partner_status" class="span8">
						<option value="0" selected="selected">No Partner</option>
						<option value="1">Concordant</option>
						<option value="2">Discordant</option>
					</select>
				</div>
				<div class="row-fluid disclosure">
					<div class="span6">
						<label>Disclosure</label>
						<label class="radio inline">
						    <input type="radio" name="disclosure" id="disclosure_yes" value="1"> Yes
						</label>
						<label class="radio inline">
						    <input type="radio" name="disclosure" id="disclosure_no" value="0"> No
						</label>
					</div>
				</div>
				<div class="row-fluid secondary_spouse">
					<label>Match to spouse in this ccc?</label>
					<input type="text" name="secondary_spouse" id="secondary_spouse" class="span8">
				</div>
				<div class="row-fluid">
					<label>Family Planning Method</label>
					<select name="fplan" id="fplan" multiple="multiple" class="span8">			
					</select>
				</div>
				<div class="row-fluid">
					<label>Does Patient have other Chronic illnesses</label>
					<select name="other_illnesses" id="other_illnesses" multiple="multiple" class="span8">				
					</select>
				</div>
				<div class="row-fluid">
					<label class="checkbox inline span8">
						<input type="checkbox" name="other_chronic_box" id="other_chronic_box" value="0"> If other illnesses,List Them
					</label>
					<textarea class="span8" name="other_chronic" id="other_chronic"></textarea>
				</div>
				<div class="row-fluid">
					<label>List Other Drugs Patient is Taking</label>
					<label class="checkbox inline span8">
						<input type="checkbox" name="other_drugs_box" id="other_drugs_box" value="0"> If other drugs,List Them
					</label>
					<textarea class="span8" name="other_drugs" id="other_drugs"></textarea>
				</div>
				<div class="row-fluid">
					<label>Does Patient have any Drugs Allergies/ADR</label>
					<select name="drug_allergies" id="drug_allergies" multiple="multiple" class="span8">			
					</select>
				</div>
				<div class="row-fluid">
					<label>List Any Other Drug Allergies</label>
					<label class="checkbox inline span8">
						<input type="checkbox" name="other_drugs_box" id="other_drugs_box" value="0"> If other allergies,List Them
					</label>
					<textarea class="span8" name="adr" id="adr"></textarea>
				</div>
				<div class="row-fluid">
					<div class="span4">
						<label>Does Patient Smoke?</label>
						<select name="smoke" id="smoke" class="span12">
							<option value="0" selected="selected">No</option>
							<option value="1">Yes</option>
						</select>
					</div>
					<div class="span4">
						<label>Does Patient Drink Alcohol?</label>
						<select name="alcohol" id="alcohol" class="span12">
							<option value="0" selected="selected">No</option>
							<option value="1">Yes</option>
						</select>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span4">
						<label> Patient tested for TB?</label>
						<select name="tb_test" id="tb_test" class="span12">
							<option value="0">No</option>
							<option value="1">Yes</option>
						</select>
					</div>
					<div class="span4">
						<label> Does Patient Have TB?</label>
						<select name="tb" id="tb" class="span12">
							<option value="0" selected="selected">No</option>
							<option value="1">Yes</option>
						</select>
				    </div>
				</div>
				<div class="row-fluid tb_category_phase">
					<div class="span4">
						<label>TB Category</label>
						<select name="tb_category" id="tb_category" class="tb_category span12">
							<option value="0" selected="selected">--Select--</option>
							<option value="1">Category 1</option>
							<option value="2">Category 2</option>
						</select>
					</div>
					<div class="span4">
						<label>TB Phase</label>
						<select name="tbphase" id="tbphase" class="tbphase span12">
							<option value="0" selected="selected">--Select--</option>
							<option value="1">Intensive</option>
							<option value="2">Continuation</option>
							<option value="3">Completed</option>
						</select>
					</div>
				</div>
				<div class="row-fluid tb_period">
					<div class="span4">
						<label>Start of Phase</label>
						<input type="text" name="startphase" id="startphase" class="span12">
					</div>
					<div class="span4">
						<label>End of Phase</label>
						<input type="text" name="endphase" id="endphase" class="span12">
					</div>
				</div>
				<div class="row-fluid">
					<div class="span4">
						<label> Date of Next Appointment</label>
						<input type="text" name="nextappointment" id="nextappointment"  class="span12 red">
					</div>
					<div class="span4">
						<label> Days to Next Appointment</label>
						<input  type="text"name="days_to_next" id="days_to_next" class="span12 red">
					</div>								
				</div>
	     	</fieldset>
	    </div>
	    <!--patient information column-->
	    <div class="span4">
	    	<fieldset>
				<legend>
					<h3>Patient Information</h3>
				</legend>
				<div class="row-fluid">
					<label><span class='astericks'>*</span>Date Enrolled</label>
					<input type="text" name="date_enrolled" id="date_enrolled" class="validate[required] span8">
				</div>
				<div class="row-fluid">
					<label><span class='astericks'>*</span>Current Status</label>
					<select name="current_status" id="current_status" class="validate[required] red span8">
					</select>
				</div>
				<div class="row-fluid status_change_date">
					<label><span class='astericks'>*</span>Date of Status Change</label>
					<input type="text" name="status_change_date" id="status_change_date" class="validate[required] span8">
				</div>
				<div class="row-fluid">
					<label><span class='astericks'>*</span>Source of Patient</label>
					<select name="source" id="source" class="validate[required] span8">
					</select>
				</div>
				<div class="row-fluid transfer_from">
					<label> Transfer From</label>
					<select name="transfer_from" id="transfer_from" class="span8">
						<option value="">--Select--</option>
						<?php
						foreach ($facilities as $facility) {
							echo "<option value='" . $facility['id'] . "'>" . $facility['Name'] . "</option>";
						}
						?>
					</select>
				</div>
				<div class="row-fluid">
					<label><span class='astericks'>*</span>Type of Service</label>
					<select name="service" id="service" class="validate[required] span8">
					</select> 
				</div>
				<div class="row-fluid pep_reason">
					<label>PEP Reason</label>
					<select name="pep_reason" id="pep_reason" class="span8">
					</select>
			    </div>
				<div class="row-fluid start_regimen">
					<label><span class='astericks'>*</span>Start Regimen</label>
					<select name="start_regimen" id="start_regimen" class="validate[required] span8">
					</select>
				</div>
				<div class="row-fluid start_regimen_date">
					<label>Start Regimen Date</label>
					<input type="text" name="start_regimen_date" id="start_regimen_date" class="span8">
				</div>
				<div class="row-fluid">
					<label class="red">Current Regimen</label>
					<select name="current_regimen" id="current_regimen" class="validate[required] red span8">
					</select>
				</div>
				<div class="row-fluid who_stage">
					<label>WHO Stage</label>
					<select name="who_stage" id="who_stage" class="span8">				
					</select>
				</div>
				<div class="row-fluid drug_prophylaxis">
					<label>Drug Prophylaxis</label>
					<select name="drug_prophylaxis" id="drug_prophylaxis" multiple="multiple" class="span8">			
					</select>
				</div>
				<div class="row-fluid isoniazid">
					<div class="row-fluid">
						<div class="span4">
							<label>Isoniazid Start Date</label>
							<input type="text" name="isoniazid_start_date" id="isoniazid_start_date" class="span12 red">
						</div>
						<div class="span4">
							<label>Isoniazid End Date</label>
							<input type="text" name="isoniazid_end_date" id="isoniazid_end_date" class="span12 red">
					    </div>	
					</div>							
				</div>
	     	</fieldset>
	    </div>
	</div>
	<!--buttons row-->
	<div class="row-fluid">
	    <div class="span12">
	     	<div class="btn-group pull-right">
	     	    <button class="btn btn-inverse" id="patient_info"><strong>Patient Info Report</strong></button>
			    <a class="btn btn-inverse" href="<?php echo base_url().'patient_management/edit/'.$patient_id; ?>"><strong>Edit Patient Record</strong></a>
			    <a class="btn btn-inverse" href="<?php echo base_url().'dispensement_management/dispense/'.$patient_id; ?>"><strong>Dispense to Patient</strong></a>
			</div>
	    </div>
	</div>
	<!--history row-->
	<div class="row-fluid">
	    <div class="span12">
	    	<fieldset>
				<legend>
					<h3>Dispensing History</h3>
				</legend>
				<!--history table-->
				<div class="table-responsive">
					<table  id="dispensing_history" class="table table-bordered table-hover table-condensed">
					    <thead>
					     	<tr>
								<th>Date</th>
								<th>Purpose of Visit</th>
								<th>Dose</th>
								<th>Duration</th>
								<th>Action</th>
								<th>Drug</th>
								<th>Qty</th>
								<th>Weight</th>
								<th>Current Regimen</th>
								<th>BatchNo</th>
								<th>Pill Count</th>
								<th>Adherence</th>
								<th>Operator</th>
								<th>Reasons For Change</th>
							</tr>
					    </thead>
					    <tbody>
					    </tbody>
					    <tfoot>
					     	<tr>
								<th>Date</th>
								<th>Purpose of Visit</th>
								<th>Dose</th>
								<th>Duration</th>
								<th>Action</th>
								<th>Drug</th>
								<th>Qty</th>
								<th>Weight</th>
								<th>Current Regimen</th>
								<th>BatchNo</th>
								<th>Pill Count</th>
								<th>Adherence</th>
								<th>Operator</th>
								<th>Reasons For Change</th>
							</tr>
					    </tfoot>
					</table>
				</div>
			</fieldset>
	    </div>
	</div>
	<!--modals row-->
	<div id="patient_details" title="Patient Summary">
	    <div class="accordion" id="summary_accordion">
	    	<!--patient info summary-->
			<div class="accordion-group">
			    <div class="accordion-heading">
			      <a class="accordion-toggle" data-toggle="collapse" data-parent="#summary_accordion" href="#patient_information_summary">
			        <strong>1.Demographics Summary</strong>
			      </a>
			    </div>
			    <div id="patient_information_summary" class="accordion-body collapse in">
			      <div class="accordion-inner">
			        ........
			      </div>
			    </div>
			</div>
			<!--pill count summary-->
			<div class="accordion-group">
			    <div class="accordion-heading">
			      <a class="accordion-toggle" data-toggle="collapse" data-parent="#summary_accordion" href="#pill_count_summary">
			        <strong>2.Pill Count Summary</strong>
			      </a>
			    </div>
			    <div id="pill_count_summary" class="accordion-body collapse in">
			      <div class="accordion-inner">
			        ........
			      </div>
			    </div>
			</div>
	    	<!--regimen change summary-->
			<div class="accordion-group">
			    <div class="accordion-heading">
			      <a class="accordion-toggle" data-toggle="collapse" data-parent="#summary_accordion" href="#regimen_change_summary">
			        <strong>3.Regimen Change Summary</strong>
			      </a>
			    </div>
			    <div id="regimen_change_summary" class="accordion-body collapse in">
			      <div class="accordion-inner">
			        ...........
			      </div>
			    </div>
			</div>
			<!--appointment summary-->
			<div class="accordion-group">
			    <div class="accordion-heading">
			      <a class="accordion-toggle" data-toggle="collapse" data-parent="#summary_accordion" href="#appointment_summary">
			        <strong>4.Appointment Summary</strong>
			      </a>
			    </div>
			    <div id="appointment_summary" class="accordion-body collapse">
			      <div class="accordion-inner">
			        ...........
			      </div>
			    </div>
			</div>
			<!--viral load summary-->
			<div class="accordion-group">
			    <div class="accordion-heading">
			      <a class="accordion-toggle" data-toggle="collapse" data-parent="#summary_accordion" href="#viral_load_summary">
			        <strong>5.Viral Load Summary</strong>
			      </a>
			    </div>
			    <div id="viral_load_summary" class="accordion-body collapse">
			      <div class="accordion-inner">
			        ...........
			      </div>
			    </div>
			</div>
			<!--adherence summary-->
			<div class="accordion-group">
			    <div class="accordion-heading">
			      <a class="accordion-toggle" data-toggle="collapse" data-parent="#summary_accordion" href="#adherence_summary">
			        <strong>6.Adherence Summary</strong>
			      </a>
			    </div>
			    <div id="adherence_summary" class="accordion-body collapse">
			      <div class="accordion-inner">
			        .........
			      </div>
			    </div>
			</div>
		</div>  
	</div>
</div>

<!-- custom scripts-->
<script src="<?php echo base_url();?>assets/modules/forms/forms.js"></script>
<script src="<?php echo base_url();?>assets/modules/patients/details.js"></script>

