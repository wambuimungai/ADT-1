<style>
	.content{
		padding:10em 1% 5% 1%;
	}
	.dispensing-field input, .dispensing-field select{
		width: 100%;
		height:1.9em;
		border-radius:0px;
	}
	.dispensing-field table{
		margin:0px;
	}
	 
</style>


<div class="container-fluid content">
	<div class="row-fluid">
		<a href="<?php echo base_url() . 'patient_management ' ?>">Patient Listing </a> <i class=" icon-chevron-right"></i><a href="<?php echo base_url() . 'patient_management/viewDetails/' . @$result['id'] ?>"><?php echo strtoupper(@$result['first_name'] . ' ' . @$result['other_name'] . ' ' . @$result['last_name']) ?></a> <i class=" icon-chevron-right"></i><strong>Dispensing details</strong>
        <hr size="1">
	</div>
	<form>	
		<div class="row-fluid">
			<div class="span6">
				<legend>
	                Dispensing Information 
	            </legend>
	            <div class="row-fluid ">
	            	<div class="span6 dispensing-field">
	            		<div class="control-group">
		            		<label><span class='astericks'>*</span> Select Dispensing Point</label>
			    		 	<select name="ccc_store_id" id="ccc_store_id" class="validate[required] ">
			    		 		<option value="">Select One</option>
			    		 	</select>
			    		</div>
	            	</div>
	            </div>
	            <div class="row-fluid">
	            	<div class="span6 dispensing-field">
	            		<div class="control-group">
		            		<label>Patient Number CCC</label>
	    		 			<input type="text" readonly="" id="patient" name="patient" class="validate[required] "/>
			    		</div>
	            	</div>
	            	<div class="span6 dispensing-field">
	            		<div class="control-group">
		            		<label>Patient Name</label>
	                        <input type="text" readonly="" id="patient_details" name="patient_details" class=""  />
			    		</div>
	            	</div>
	            </div>
	            <div class="row-fluid">
	            	<div class="span6 dispensing-field">
	            		<div class="control-group">
		            		<label><span class='astericks'>*</span>Dispensing Date</label>
	                        <input type="text"name="dispensing_date" id="dispensing_date" class="validate[required] ">
			    		</div>
	            	</div>
	            	<div class="span6 dispensing-field">
	            		<div class="control-group">
		            		<label><span class='astericks'>*</span>Purpose of Visit</label>
	                        <select  type="text"name="purpose" id="purpose" class="validate[required] " >
	                        	<option value="">--Select One--</option>
	                        </select>   
			    		</div>
	            	</div>
	            </div>
	            <div class="row-fluid">
	            	<div class="span6 dispensing-field">
	            		<div class="control-group">
		            		<label>Current Height(cm)</label>
	                        <input  type="text"name="height" id="height" class="validate[required]">
			    		</div>
	            	</div>
	            	<div class="span6 dispensing-field">
	            		<div class="control-group">
		            		<label><span class='astericks'>*</span>Current Weight(kg)</label>
	                        <input  type="text"name="weight" id="weight" class="validate[required]" >
			    		</div>
	            	</div>
	            </div>
	            <div class="row-fluid">
	            	<div class="span6 dispensing-field">
	            		<div class="control-group">
		            		<label><span class='astericks'>*</span>Days to Next Appointment</label>
	                        <input  type="text" name="days_to_next" id="days_to_next" class="validate[required]">
			    		</div>
	            	</div>
	            	<div class="span6 dispensing-field">
	            		<div class="control-group">
		            		<label><span class='astericks'>*</span>Date of Next Appointment</label>
	                        <input  type="text" name="next_appointment_date" id="next_appointment_date" class="validate[required]" >
			    		</div>
	            	</div>
	            </div>
	            <div class="row-fluid">
	            	<div class="span10 dispensing-field">
	            		<span id="scheduled_patients" style="display:none;background:#9CF;padding:5px;"></span>
	            	</div>
	            </div>
	            <div class="row-fluid">
	            	<div class="span6 dispensing-field">
	            		<div class="control-group">
		            		<label id="scheduled_patients" class="message information close" style="display:none"></label><label>Last Regimen Dispensed</label>
	                        <input type="text"name="last_regimen_disp" value="none" id="last_regimen_disp" readonly="">
	                        <input type="hidden" name="last_regimen" value="0" id="last_regimen" value="0">
			    		</div>
	            	</div>
	            	<div class="span6 dispensing-field">
	            		<div class="control-group">
		            		<label><span class='astericks'>*</span>Current Regimen</label>
	                       <select type="text"name="current_regimen" id="current_regimen"  class="validate[required]" style='width:100%;' >
	                                <option value="">-Select One--</option>
	                       </select>
			    		</div>
	            	</div>
	            </div>
	             <div class="row-fluid">
	            	<div class="span6 dispensing-field">
	            		<div class="control-group" style="display:none" id="regimen_change_reason_container">
		            		<label><span class='astericks'>*</span>Regimen Change Reason</label>
	                        <select type="text"name="regimen_change_reason" id="regimen_change_reason" >
	                            <option value="">--Select One--</option>
	                        </select>
	                           
			    		</div>
	            	</div>
	            </div>
	            <div class="row-fluid">
	            	<div class="span6 dispensing-field">
	            		<div class="control-group">
		            		<label>Appointment Adherence (%)</label>
	                        <input type="text" name="adherence" id="adherence"/>
			    		</div>
	            	</div>
	            	<div class="span6 dispensing-field">
	            		<div class="control-group">
		            	<label> Poor/Fair Adherence Reasons </label>
	                    <select type="text"name="non_adherence_reasons" id="non_adherence_reasons"  style='width:100%;'>
	                        <option value="">-Select One--</option>
	                    </select>
			    		</div>
	            	</div>
	            </div>
			</div>
			
			
			<div class="span5">
				<legend>
	                Previous Patient Information
	            </legend>
	            <div class="row-fluid">
	            	<div class="span6 dispensing-field">
	            		<div class="control-group">
		            		<label> Appointment Date</label>
	                        <input readonly="" id="last_appointment_date" name="last_appointment_date"/>
			    		</div>
	            	</div>
	            	<div class="span6 dispensing-field">
	            		<div class="control-group">
		            		<label>Previous Visit Date</label>
	                        <input readonly="" id="last_visit_date" name="last_visit_date"/>
	                        <input type="hidden" id="last_visit"/>
			    		</div>
	            	</div>
	            </div>
	            <div class="row-fluid">
	            	<div class="span12 dispensing-field">
	            		<div class="control-group">
	            			<label>Previously Dispensed Drugs</label>
		            		<table class="data-table prev_dispense" id="last_visit_data" style="float:left;width:100%;">
	                            <thead><th style="width: 70%">Drug Dispensed</th><th>Quantity Dispensed</th></thead>
	                            <tbody></tbody>
	                        </table>
	                    </div>
	            	</div>
	            </div>
			</div>
		</div>
		<div class="row-fluid">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Drug</th>
                        <th>Unit</th>
                        <th >Batch No.&nbsp;</th>
                        <th>Expiry&nbsp;Date</th>
                        <th>Dose</th>
                        <th><b>Expected</b><br/>Pill Count</th>
                        <th><b>Actual</b><br/> Pill Count</th>
                        <th>Duration</th>
                        <th>Qty. disp</th>
                        <th>Stock on Hand</th>
                        <th>Brand Name</th>
                        <th>Indication</th>
                        <th>Comment</th>
                        <th>Missed Pills</th>
                        <th style="">Action</th>
					</tr>
				</thead>
			</table>
		</div>
	</form>
		
</div>