<style>
	.content{
		padding:10em 1% 5% 1%;
		background-color: #FFA8E7;
	}
	.dispensing-field input, .dispensing-field select,#tbl-dispensing-drugs input, #tbl-dispensing-drugs select{
		width: 100%;
		height:1.9em;
		border-radius:0px;
	}
	.dispensing-field table{
		margin:0px;
	}
	
	.dispensing-field label{
		margin:0px;
		line-height: 18px;
		font-size:12px;
	}
	.dispensing-field .control-group{
		margin-bottom:5px;
	}
	#tbl-dispensing-drugs{
		margin-top:3px;
	}
	#tbl-dispensing-drugs,#last_visit_data,#last_visit_data th,#last_visit_data td, #tbl-dispensing-drugs tr, #tbl-dispensing-drugs td, #tbl-dispensing-drugs th{
		border-radius: 0px;
	}
	#tbl-dispensing-drugs tr, #tbl-dispensing-drugs td, #tbl-dispensing-drugs th{
		padding:2px;
	} 
	#submit_section{
		text-align:right;
	}
</style>


<div class="container-fluid content">
	<div class="row-fluid">
		<a href="<?php echo base_url() . 'patient_management ' ?>">Patient Listing </a> <i class=" icon-chevron-right"></i><a id="patient_names" href="<?php echo base_url() . 'patient_management/viewDetails/' . @$patient_id ?>"><?php echo strtoupper(@$result['name']); ?></a> <i class=" icon-chevron-right"></i><strong>Dispensing details</strong>
        <hr size="1">
	</div>
	<form name="fmDispensing">
		<textarea name="sql" id="sql" style="display:none;"></textarea>
        <input type="hidden" id="hidden_stock" name="hidden_stock"/>
        <input type="hidden" id="days_count" name="days_count"/>
        <input type="hidden" id="stock_type_text" name="stock_type_text" value="main pharmacy" />
        <input type="hidden" id="purpose_refill_text" name="purpose_refill_text" value="" />
        <input type="hidden" id="patient_source" name="patient_source" value="<?php echo @$result['patient_source']; ?>" />
		<div class="row-fluid">
			<div class="span6">
				<legend>
	                Dispensing Information 
	            </legend>
	            <div class="row-fluid ">
	            	<div class="span6 dispensing-field">
	            		<div class="control-group">
		            		<?php
		                    $ccc_stores = $this->session->userdata('ccc_store');
		                    $count_ccc = count($ccc_stores);
		                    $selected = '';
		                    if ($count_ccc > 0) {//In case on has more than one dispensing point
		                        echo "<label><span class='astericks'>*</span>Select dispensing point</label>
		                                <select name='ccc_store_id' id='ccc_store_id' class='validate[required]'>
		                                	<option value=''>Select One</option>";
		                        //Check if facility has more than one dispensing point
		                        foreach ($ccc_stores as $value) {
		                            $name = $value['Name'];
		                            if ($this -> session -> userdata('ccc_store_id')) {
		                             	$ccc_storeid = $this -> session -> userdata('ccc_store_id');
		                                if ($value['id'] === $ccc_storeid) {
		                                    $selected = "selected";
		                                } else {
		                                    $selected = "";
		                                }
		                            } 
		                            echo "<option value='" . $value['id'] . "' " . $selected . ">" . $name . "</option>";
		                        }
		                        echo "</select>";
		                    }
		
		                    //$this->session->set_userdata('ccc_store',$name);
		                    ?>
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
	                        	<?php
                                foreach ($purposes as $purpose) {
                                    echo "<option value='" . $purpose['id'] . "'>" . $purpose['Name'] . "</option>";
                                }
                                ?>
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
	            	<!--
            		<div class="span10 dispensing-field">
	            		<span id="scheduled_patients" style="display:none;background:#9CF;"></span>
	            	</div> -->
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
	            	<!--<div class="span6 dispensing-field">
	            		<div class="control-group" style="display:none" id="regimen_change_reason_container">
		            		<label><span class='astericks'>*</span>Regimen Change Reason</label>
	                        <select type="text"name="regimen_change_reason" id="regimen_change_reason" >
	                            <option value="">--Select One--</option>
	                        </select>
	                           
			    		</div>
	            	</div> -->
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
	                        <input type="text" readonly="" id="last_appointment_date" name="last_appointment_date"/>
			    		</div>
	            	</div>
	            	<div class="span6 dispensing-field">
	            		<div class="control-group">
		            		<label>Previous Visit Date</label>
	                        <input type="text" readonly="" id="last_visit_date" name="last_visit_date"/>
	                        <input type="hidden" id="last_visit"/>
			    		</div>
	            	</div>
	            </div>
	            <div class="row-fluid">
	            	<div class="span12 dispensing-field">
	            		<div class="control-group">
	            			<label>Previously Dispensed Drugs</label>
		            		<table class="table table-bordered prev_dispense" id="last_visit_data" style="float:left;width:100%;">
	                            <thead><th style="width: 70%">Drug Dispensed</th><th>Qty Dispensed</th></thead>
	                            <tbody></tbody>
	                        </table>
	                    </div>
	            	</div>
	            </div>
			</div>
		</div>
		<div class="row-fluid">
			<legend>
                Drug Details 
            </legend>
			<table class="table table-bordered" id="tbl-dispensing-drugs">
				<thead>
					<tr>
						<th style="width:18%">Drug</th>
                        <th style="width:10%">Unit</th>
                        <th style="width:10%">Batch No.&nbsp;</th>
                        <th style="width:9%">Expiry&nbsp;Date</th>
                        <th>Dose</th>
                        <th><b>Expected</b><br/>Pill Count</th>
                        <th><b>Actual</b><br/> Pill Count</th>
                        <th>Duration</th>
                        <th style="width:5%">Qty. disp</th>
                        <th style="width:8%">Stock on Hand</th>
                        <th>Brand Name</th>
                        <th>Indication</th>
                        <th>Comment</th>
                        <th>Missed Pills</th>
                        <th style="">Action</th>
					</tr>
				</thead>
				<tbody>
                    <tr drug_row="0">
                        <td><select name="drug[]" class="drug input-large span3"></select></td>
                        <td>
                            <input type="text" name="unit[]" class="unit input-small" style="" readonly="" />
                            <input type="hidden" name="comment[]" class="comment input-small" style="" readonly="" />
                        </td>
                        <td><select name="batch[]" class="batch input-small next_pill span2"></select></td>
                        <td>
                            <input type="text" name="expiry[]" name="expiry" class="expiry input-small" id="expiry_date" readonly="" size="15"/>
                        </td>
                        <td class="dose_col">
                            <input  name="dose[]" list="dose" id="doselist" class="input-small next_pill dose icondose">
                            <datalist id="dose" class="dose"><select name="dose1[]" class="dose"></select></datalist>
                        </td>
                        <td>
                            <input type="text" name="pill_count[]" class="pill_count input-small" readonly="readonly" />
                        </td>
                        <td>
                            <input type="text" name="next_pill_count[]" class="next_pill_count input-small"qty  />
                        </td>
                        <td>
                            <input type="text" name="duration[]" class="duration input-small" />
                        </td>
                        <td>
                            <input type="text" name="qty_disp[]" class="qty_disp input-small next_pill validate[requireds]"  id="qty_disp"/>
                        <td>
                            <input type="text" name="soh[]" class="soh input-small" readonly="readonly"/>
                        </td>
                        </td>
                        <td><select name="brand[]" class="brand input-small"></select></td>

                        <td>
                            <select name="indication[]" class="indication input-small " style="">
                                <option value="0">None</option>
                            </select></td>
                        <td>
                            <input type="text" name="comment[]" class="comment input-small" />
                        </td>
                        <td>
                            <input type="text" name="missed_pills[]" class="missed_pills input-small" />
                        </td>
                        <td>
                            <a class="add btn-small">Add</a>|<a style="display: none" class="remove btn-small">Remove</a>
                        </td>
                    </tr>
                </tbody>
			</table>
		</div>
		<div class="row-fluid" id="submit_section">
			<div class="span12">
				<input type="reset" class="btn btn-danger button_size" id="reset" value="Reset Fields" />
                    <input type="button" class="btn button_size" id="print_btn" value="Print Labels" />
                    <input type="submit" form="dispense_form" id="btn_submit " class="btn actual button_size" id="submit"  value="Dispense Drugs"/>
			</div>
		</div>
	</form>
		
</div>

<script type="text/javascript">
	$(document).ready(function(){
		var link ="<?php echo base_url();?>patient_management/get_patient_details";
		var patient_id = "<?php echo $patient_id;?>";
		var request = $.ajax({
                        url: link,
                        type: 'post',
                        data: {"patient_id": patient_id},
                        dataType: "json"
                    });
                    
			request.done(function(data){
				$("#patient").val(data.Patient_Number_CCC);
				$("#patient_details").val(data.names);
				$("#height").val(data.Height);
				$("#weight").val(data.Weight);
				$("#patient_names").text(data.names);
				var age = data.age;
				var patient_ccc = data.Patient_Number_CCC;
				//Load regimens
				loadRegimens(age);
				loadOtherDetails(patient_ccc);
			})
			request.fail(function(jqXHR, textStatus) {
                bootbox.alert("<h4>Patient Details Alert</h4>\n\<hr/>\n\<center>Could not retrieve patient details : </center>" + textStatus);
            });
	});
	
	function loadRegimens(age){
		var link ="<?php echo base_url();?>regimen_management/getFilteredRegiments";
		var request = $.ajax({
                        url: link,
                        type: 'post',
                        data: {"age": age},
                        dataType: "json"
                    });
                    
			request.done(function(data){
				//Remove appended options to reinitialize dropdown
				$('#current_regimen option')
			    .filter(function() {
			        return this.value || $.trim(this.value).length != 0;
			    }).remove();
			   
				$(data).each(function(i,v){
					$("#current_regimen").append("<option value='"+v.id+"'>"+v.Regimen_Code+" | "+v.Regimen_Desc+"</option>");
				});
			});
			request.fail(function(jqXHR, textStatus) {
                bootbox.alert("<h4>Regimens Details Alert</h4>\n\<hr/>\n\<center>Could not retrieve regimens details : </center>" + textStatus);
            });
	}
	
	function loadOtherDetails(patient_ccc){
		//Load Non adherence reasons, regimen change reasons previously dispensed drugs
		var link ="<?php echo base_url();?>dispensement_management/get_other_dispensing_details";
		var request = $.ajax({
                        url: link,
                        type: 'post',
                        data: {"patient_ccc": patient_ccc},
                        dataType: "json"
                    });
                    
			request.done(function(data){
				var non_adherence_reasons = data.non_adherence_reasons;
				var regimen_change_reason = data.regimen_changes;
				var patient_appointment	  = data.patient_appointment;
				//Remove appended options to reinitialize dropdown
				$('#non_adherence_reasons option')
			    .filter(function() {
			        return this.value || $.trim(this.value).length != 0;
			    }).remove();
			   
				$(non_adherence_reasons).each(function(i,v){
					$("#non_adherence_reasons").append("<option value='"+v.id+"'>"+v.Name+"</option>");
				});
				//Load regimen change reasons
				$('#regimen_change_reason option')
			    .filter(function() {
			        return this.value || $.trim(this.value).length != 0;
			    }).remove();
			   
				$(regimen_change_reason).each(function(i,v){
					$("#regimen_change_reason").append("<option value='"+v.id+"'>"+v.Name+"</option>");
				});
				
				//Appointment date, If patient presiously visited,load previous appointment date
				if(patient_appointment.length==2){
					var previous_date = patient_appointment[1].Appointment;
					$("#last_appointment_date").val(patient_appointment[0].Appointment);
					$("#last_visit_date").val(patient_appointment[1].Appointment);
					$("#last_visit").val(previous_date);
					
					//Load previously dispensed drugs
					var link ="<?php echo base_url();?>dispensement_management/getPreviouslyDispensedDrugs";
					var request = $.ajax({
			                        url: link,
			                        type: 'post',
			                        data: {"patient_ccc": patient_ccc,"last_dispensed_date":previous_date},
			                        dataType: "json"
			                    });
			                    
						request.done(function(msg){
							$(msg).each(function(i,v){
								$("#last_visit_data tbody").append("<tr><td>"+v.drug+"</td><td>"+v.quantity+"</td></tr>");
							});
						});
						request.fail(function(jqXHR, textStatus) {
			                bootbox.alert("<h4>Previous Dispensing Details Alert</h4>\n\<hr/>\n\<center>Could not retrieve previously dispensed details : </center>" + textStatus);
			            });
				
				}else if(patient_appointment.length==1){
					$("#last_appointment_date").val(patient_appointment[0].Appointment);
				}
				
				
				
			});
			request.fail(function(jqXHR, textStatus) {
                bootbox.alert("<h4>Regimens Details Alert</h4>\n\<hr/>\n\<center>Could not retrieve regimens details : </center>" + textStatus);
            });
	}
</script>