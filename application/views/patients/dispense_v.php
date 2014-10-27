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
		            		<label id="scheduled_patients" class="message information " style="display:none; background-color: black;"></label><label>Last Regimen Dispensed</label>
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
		
		/* -------------------------- Dispensing date, date picker settings and checks -------------------------*/
		//Attach date picker for date of dispensing
		$("#dispensing_date").datepicker({
			yearRange: "-120:+0",
			maxDate: "0D",
			dateFormat: $.datepicker.ATOM,
			changeMonth: true,
			changeYear: true
		});
		$("#dispensing_date").datepicker();
		$("#dispensing_date").datepicker("setDate", new Date());
		//function for changing dispensing date that checks if it matches last visit date
		$(document).on("change","#dispensing_date", function() {
			var dispensing_date = $(this).val();
			var last_visit_date = $("#last_visit").val();
			checkIfDispensed(last_visit_date,dispensing_date);//Check if already dispensed
			
			//calculate adherence
			getAdherenceRate();
			if(typeof appointment_date !=="undefined"){
				var diffDays = checkDaysLate(appointment_date);
				$("#days_count").attr("value", diffDays);
			}
		});
		
		//Add datepicker for the next appointment date
		$("#next_appointment_date").datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: $.datepicker.ATOM,
			onSelect: function(dateText, inst) {
				var base_date = new Date();
				var today = new Date(base_date.getFullYear(), base_date.getMonth(), base_date.getDate());
				var today_timestamp = today.getTime();
				var one_day = 1000 * 60 * 60 * 24;
				var appointment_timestamp = $("#next_appointment_date").datepicker("getDate").getTime();
				var difference = appointment_timestamp - today_timestamp;
				var days_difference = difference / one_day;
				$("#days_to_next").attr("value", days_difference);
				retrieveAppointedPatients();
			}
		});
		// -------------------------- Dispensing date, date picker settings and checks end--------------------------
		
		
		is_pregnant = '';//Check if patient is pregnant
		has_tb = '';//Check if patient has tb
		alert_qty_check = true;//Variable for qty error check
		
		//When pressing return/enter, tabulate
		$('form input,select,readonly').keydown(function(e) {
			if (e.keyCode == 13) {
				var inputs = $(this).parents("form").eq(0).find(":input");
				if (inputs[inputs.index(this) + 1] != null) {
					inputs[inputs.index(this) + 1].focus();
				}
				e.preventDefault();
				return false;
			}
		});
		
		//If facility has more than one dispensing point, use the selected dispensing point.
		if ($("#ccc_store_id ").is(":visible")) {
			stock_type = $("#ccc_store_id ").val();
			stock_type_text = $("#ccc_store_id option:selected").text();
		}
		else {//If only dispensing point, use main pharmacy as the dispensing point
			stock_type = "2";
			stock_type_text = 'main pharmacy';
		}
		
		// ----------------------------- Printing labels ----------------------------------------
		
		$("#selectall").attr("checked", false);
		//function for select all
		$("#selectall").on('click', function() {
			var status = $(this).is(":checked");
			if (status == true) {
				//check all
				$(".label_checker").attr("checked", true);
				$(".label_checker").val(1);
			} else {
				//uncheck all
				$(".label_checker").attr("checked", false);
				$(".label_checker").val(0);
			}
		});
		
		//drug label modal settings
		$("#open_print_label").dialog({
			width: '1000',
			modal: true,
			height: '600',
			autoOpen: false,
			show: 'fold',
			buttons: {
				"Print": function() {
					$("#print_frm").submit(); //Submit  the FORM
				},
				Cancel: function() {
					$(this).dialog("close");
				}
			}
		});
		//print frm submit event
		$("#print_frm").on('submit', function(e) {
			var postData = $('form#print_frm').serialize();
			var formURL = $(this).attr("action");
			$.ajax({
				url: formURL,
				type: "POST",
				data: postData,
				success: function(data, textStatus, jqXHR)
				{
				  //data: return data from server
				  if (data == 0) {
					bootbox.alert("<h4>Notice!</h4>\n\<center>You have not selected any drug label to print!</center>");
				  } else {
					window.open(data);
					$("#open_print_label").dialog("close");
				  }
				}
			   });
			//STOP default action
			e.preventDefault(); 
		});

		//print drug labels functions
		$('#print_btn').on('click', function() {
			$("#open_print_label").dialog("open");
			$("#selectall").attr("checked", false);
			var label_str = '<table id="tbl_printer" class="table table-condensed table-hover"><tbody>';

			var _class = '';
			$("#tbl-dispensing-drugs > tbody > tr").each(function(i, v) {
				if ((i + 1) % 2 == 0) {
					_class = 'even';
				} else {
					_class = 'odd';
				}
				var row = $(v);
				var drug_id = row.closest("tr").find(".drug").val();
				if (drug_id != null) {
					var drug_name = row.closest("tr").find(".drug option[value='" + drug_id + "']").text();
					var drug_unit = row.closest("tr").find(".unit").val();
					var expiry_date = row.closest("tr").find(".expiry").val();
					var val = row.closest("tr").find('#doselist').val();
					var dose_value = row.closest("tr").find('.dose option').filter(function() {
						return this.value == val;
					}).data('dose_val');
					var dose_frequency = row.closest("tr").find('.dose option').filter(function() {
						return this.value == val;
					}).data('dose_freq');
					var duration = row.find(".duration").val();
					var qty = row.find(".qty_disp ").val();
					var dose_hours = (24 / (dose_value * dose_frequency));
					var patient_name = $('#patient_details').val();

					//get instructions
					var base_url = "<?php echo base_url(); ?>";
					var link = base_url + "dispensement_management/getInstructions/" + drug_id;
					$.ajax({
						url: link,
						async: false,
						type: 'POST',
						success: function(data) {
							var s = data;
							s = s.replace(/(^\s*)|(\s*$)/gi, "");
							s = s.replace(/[ ]{2,}/gi, " ");
							drug_instructions = s.replace(/\n /, "\n");
							//append data
							label_str += '<tr class="' + _class + '">\
											<td class="span1 ">\
											<label class="checkbox inline">\
											<input type="checkbox" name="print_check[' + i + ']" class="label_checker" value="0"/>\
											</label>\
											</td>\
											<td class="span10">\
											<div class="row-fluid">\
											  <div class="span9">\
											   <label class="inline">\
											   Drugname:\
											   <input type="text" name="print_drug_name[]" class="span9 label_drug" value="' + drug_name + '" required readonly/>\
											   </label>\
											  </div>\
											  <div class="span3">\
											  <label class="inline">\
											   Qty:\
											  <input type="number" name="print_qty[]" class="span3 label_qty" value="' + qty + '" required readonly/>\
											  </label>\
											  </div>\
											</div>\
											<div class="row-fluid">\
											 <div class="span12">\
											  <label class="inline">\
											  Tablets/Capsules:\
											  <input type="number" name="print_dose_value[]" class="span1 label_dose_value" value="' + dose_value + '" required/> to be taken\
											  <input type="number" name="print_dose_frequency[]" class="span1 label_dose_frequency" value="' + dose_frequency + '" required/> times a day after every\
											  <input type="number" name="print_dose_hours[]" class="span1 label_hours" value="' + dose_hours + '" required/> hours\
											  </label>\
											 </div>\
											</div>\
											<div class="row-fluid">\
											 <div class="span12">\
											  <label class="inline">\
											  Before/After Meals:\
											  <textarea name="print_drug_info[]"  row="5" class="span8 label_info">' + drug_instructions + '</textarea>\
											  </label>\
											  </div>\
											</div>\
											<div class="row-fluid">\
											 <div class="span4">\
												<label class="inline">\
												 Name: <input type="text" name="print_patient_name" class="span9 label_patient" value="' + patient_name + '" required readonly/>\
												</label>\
											 </div>\
											 <div class="span4">\
											  <label class="inline">\
												Pharmacy: <input type="text" name="print_pharmacy[]" class="span8 label_patient" value="Pharmacy"/>\
											   </label>\
											 </div>\
											 <div class="span4">\
												<label class="inline">\
												Date: <input type="text" name="print_date" class="span6 label_date" value="<?php echo date('d/m/Y'); ?>" readonly/>\
												</label>\
											   </div>\
											</div>\
											<div class="row-fluid">\
											  <div class="span12">\
												  <label style="text-align:center;">Keep all medicines in a cold dry place out of reach of children.</label>\
											   </div>\
											 </div>\
											 <div class="row-fluid">\
											  <div class="span6">\
												<label class="inline">\
												Facility Name:<input type="text" name="print_facility_name" class="span8 label_facility" value="<?php echo $this->session->userdata("facility_name"); ?>" readonly/>\
												</label>\
											  </div>\
											  <div class="span6">\
												<label class="inline">\
												Facility Phone:<input type="text" name="print_facility_phone" class="span4 label_contact" value="<?php echo $this->session->userdata("facility_phone"); ?>" readonly/>\
												</label>\
											  </div>\
											 </div>\
											</td>\
											<td class="span1">\
											<label class="inline">\
											No. of Labels\
											<input name="print_count[]" class="span1" style="height: 2em;" type="number" value="1">\
											</label>\
											</td>\
											</tr>';
						}
					});
				} else {
					$("#open_print_label").dialog("close");
				}
			});
			//remove all
			$('.label_selectall').nextAll().remove();
			//insertafter
			label_str += '</tbody></table></div>';
			$(label_str).insertAfter(".label_selectall");

			//function to select individual
			$(".label_checker").on('click', function() {
				cb = $(this);
				cb.val(cb.prop('checked'));
			});
		});
		// ----------------------------- Printing labels end----------------------------------------
		
		
		
		
		//------------------------------ Validation ------------------------------------------------
		$("input,select").on('change', function(i, v) {
			var value = $(this).val();
			var id = this.id;
			if (value != '') {
				if (id == "days_to_next") {
					$('#next_appointment_date').validationEngine('hide');
				} else if (id == "next_appointment_date") {
					$('#days_to_next').validationEngine('hide');
				}
				$('#' + id).validationEngine('hide');
			}
		});
		//------------------------------ Validation end---------------------------------------------
		
		
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
				is_pregnant	= data.Pregnant;
				has_tb		= data.Tb;
				var age = data.age;
				var patient_ccc = data.Patient_Number_CCC;
				//CHeck if patient is pregnant
				checkIfPregnant(is_pregnant,patient_ccc);
				//Check if still has tb
				checkIfHasTb(has_tb,patient_ccc);
				//Load regimens
				loadRegimens(age);
				loadOtherDetails(patient_ccc);
			})
			request.fail(function(jqXHR, textStatus) {
                bootbox.alert("<h4>Patient Details Alert</h4>\n\<hr/>\n\<center>Could not retrieve patient details : </center>" + textStatus);
            });
	});
	
	//-------------------------------- CHANGE EVENT --------------------------------------
	//store type change event
	$("#ccc_store_id").change(function() {
		if($(this).val()!=''){
			$("#ccc_store_id").css('border','none');
		}else{
			$("#ccc_store_id").css('border','solid 3px red');
		}
		stock_type = $("#ccc_store_id ").val();
		stock_type_text = $("#ccc_store_id option:selected").text();
		$("#stock_type_text").val(stock_type_text);
		$("#current_regimen").trigger("change");
		reinitialize();
		storeSession($(this).val());
	});
	
	//Add listener to check purpose
	$("#purpose").change(function() {
		//reset drug tables
		resetRoutineDrugs();
		var regimen = $("#current_regimen option:selected").attr("value");
		var last_regimen = $("#last_regimen").attr("value");
		purpose_visit = $("#purpose :selected").text().toLowerCase();
		//If purpose of visit is not switch regimen, current regimen is last regimen
		if (purpose_visit === 'switch regimen' ||  purpose_visit === '--select one--') {
			$("#current_regimen").val("0");
		} else {
			$("#current_regimen").val(last_regimen);
			//Populate drugs by triggering change event
			$("#current_regimen").trigger("change");
			$("#purpose_refill_text").val('');
			
			//If purpose is Start ART, check if patient has WHO stage
			if(purpose_visit === 'start art'){
				$("#current_regimen").val("0");
				$("#purpose_refill_text").val(purpose_visit);
				var _url = "<?php echo base_url() . 'patient_management/getWhoStage'; ?>";
				//Get drugs
				var request = $.ajax({
					url: _url,
					type: 'post',
					data: {"patient_ccc": patient_ccc},
					dataType: "json"
				});
				request.done(function(data) {
					if(data.patient_who==0){//If no WHO Stage, prompt to enter it
							var length_who = data.who_stage.length;
							length_who = length_who-1;
							var select_who ="<select id='who_stage' name='who_stage'>";  
							$.each(data.who_stage,function(i,v){
								select_who+="<option value='"+data.who_stage[i]['id']+"'>"+data.who_stage[i]['name']+"</option>";
								if(length_who==i){
									select_who+='</select>';
									bootbox.confirm("<h4>WHO Stage </h4>\n\<hr/><center>Patient does not have a WHO Stage, Please select one "+select_who+"</center>","Cancel", "Save",
									function(res){
										if(res===true){//If answer is no, update pregnancy status
											var who_selected = $('#who_stage').val();
											//Check if the current regimen is OI Medicine and if not, hide the indication field
											var _url = "<?php echo base_url() . 'patient_management/updateWhoStage'; ?>";
											//Get drugs
											var request = $.ajax({
												url: _url,
												type: 'post',
												data: {"patient_ccc": patient_ccc,"who_stage": who_selected},
												dataType: "json"
											});
										}
									});
								}
							});
							
					}
				});
				request.fail(function(jqXHR, textStatus) {
					bootbox.alert("<h4>Who Error </h4>\n\<hr/>\n\<center>Could not retrieve Who information : </center>" + textStatus);
				});
			}else{
				//Check is dispensing point was selected
				
			}
		}

		//adherence rate
		getAdherenceRate();
	});
	//-------------------------------- CHANGE EVENT END ----------------------------------
	
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
					appointment_date = patient_appointment[0].Appointment;
					$("#last_appointment_date").val(appointment_date);//Latest appointment date
					
					//------------------------------- PREVIOUS VISIT DATA
					var link ="<?php echo base_url();?>dispensement_management/getPreviouslyDispensedDrugs";
					var request = $.ajax({
			                        url: link,
			                        type: 'post',
			                        data: {"patient_ccc": patient_ccc},
			                        dataType: "json"
			                    });
			                    
						request.done(function(msg){
							$(msg).each(function(i,v){//Load last visit data
								if(i==0){//Previous dispense details
									previous_dispensing_date = v.dispensing_date;
									$("#last_visit_date").val(previous_dispensing_date);
									$("#last_visit").val(previous_dispensing_date);
									$("#last_regimen_disp").val(v.regimen_code+" | " +v.regimen_desc);
									$("#last_regimen").val(v.regimen_id);
									checkIfDispensed(previous_dispensing_date,$("#dispensing_date").val());
								}
								$("#last_visit_data tbody").append("<tr><td>"+v.drug+"</td><td>"+v.quantity+"</td></tr>");
							});
						});
						request.fail(function(jqXHR, textStatus) {
			                bootbox.alert("<h4>Previous Dispensing Details Alert</h4>\n\<hr/>\n\<center>Could not retrieve previously dispensed details : </center>" + textStatus);
			            });
					
					
				}else if(patient_appointment.length==1){
					appointment_date = patient_appointment[0].Appointment;
					$("#last_appointment_date").val(appointment_date);
				}
				
				if(typeof appointment_date !=="undefined"){
					var diffDays = checkDaysLate(appointment_date);
					$("#days_count").attr("value", diffDays);
				}
				
			});
			request.fail(function(jqXHR, textStatus) {
                bootbox.alert("<h4>Regimens Details Alert</h4>\n\<hr/>\n\<center>Could not retrieve regimens details : </center>" + textStatus);
            });
	}
	
	function checkIfPregnant(pregnancy_status,patient_ccc){
		if(pregnancy_status=='1'){
			bootbox.confirm("<h4>Pregnancy confirmation</h4>\n\<hr/><center>Is patient still pregnant?</center>","No", "Yes",
			function(res){
				if(res===false){//If answer is no, update pregnancy status
					//Check if the current regimen is OI Medicine and if not, hide the indication field
					var _url = "<?php echo base_url() . 'patient_management/updatePregnancyStatus'; ?>";
					//Get drugs
					var request = $.ajax({
						url: _url,
						type: 'post',
						data: {"patient_ccc": patient_ccc},
						dataType: "json"
					});
				}
			});
		}
	}
	
	function checkIfHasTb(tb_status,patient_ccc){
		if(tb_status=='1'){
			bootbox.confirm("<h4>Pregnancy confirmation</h4>\n\<hr/><center>Is patient still pregnant?</center>","No", "Yes",
			function(res){
				if(res===false){
					bootbox.confirm("<h4>TB confirmation</h4>\n\<hr/><center>Is patient still having TB?</center>","No", "Yes",
                    function(res){
                        if(res===false){//If answer is no, update tbstatus
                            var _url = "<?php echo base_url() . 'patient_management/update_tb_status'; ?>";
                            //Get drugs
                            var request = $.ajax({
                                url: _url,
                                type: 'post',
                                data: {"patient_ccc": patient_ccc},
                                dataType: "json"
                            });
                        }
                    });
				}
			});
		}
	}
	
	function checkIfDispensed(last_visit_date,dispensing_date){//check if patient has already been dispensed drugs for current dispensing date
		if (last_visit_date) {
			//check if dispensing date is equal to last visit date
			if (last_visit_date == dispensing_date) {
				//if equal ask for alert
				bootbox.alert("<h4>Notice!</h4>\n\<center>You have dispensed drugs to this patient!</center>");
			}
		}
	}
	
	//function reset routine drugs
	function resetRoutineDrugs(){
	  //remove all table tr's except first one
	  $("#tbl-dispensing-drugs tbody").find('tr').slice(1).remove();
	  var row = $('#tbl-dispensing-drugs tr:last');
	  //default options
	  row.find(".unit").val("");
	  row.find(".batch option").remove();
	  row.find(".expiry").val("");
	  row.find(".dose option").remove();
	  row.find(".dose").val("");
	  row.find(".pill_count").val("");
	  row.find(".duration").val("");
	  row.find(".qty_disp").val("");
	  row.find(".soh").val("");
	  row.find(".indication option").remove();
	  routine_check=0;
	  hideFirstRemove();
	}
	
	function hideFirstRemove(){
	  $("#drugs_table tbody > tr:first").find(".remove").hide();
	}
	
	function checkDaysLate(appointment_date){//Check how many days the patient is late
		var dispensing_date = $.datepicker.parseDate('yy-mm-dd',$("#dispensing_date").val());
		var appointment_date = $.datepicker.parseDate('yy-mm-dd',appointment_date);
		var timeDiff = dispensing_date.getTime() - appointment_date.getTime();
		var diffDays = Math.floor(timeDiff / (1000 * 3600 * 24));
		return diffDays;
	}
	//function to calculate adherence rate(%)
	function getAdherenceRate(){
		$("#adherence").attr("value", " ");
		$("#adherence").removeAttr("readonly");

		var purpose_of_visit = $("#purpose option:selected").val();
		var day_percentage = 0;

		if(purpose_of_visit.toLowerCase().indexOf("routine") == -1 || purpose_of_visit.toLowerCase().indexOf("pmtct") == -1) {
			if(typeof previous_dispensing_date !=="undefined" && appointment_date!=="undefined"){
				var dispensing_date = $.datepicker.parseDate('yy-mm-dd', $("#dispensing_date").val());//Current dispensing date
				var prev_visit_date = $.datepicker.parseDate('yy-mm-dd', previous_dispensing_date);//Previous dispensing date
				appoint_date = $.datepicker.parseDate('yy-mm-dd', appointment_date);
				
				var days_to_next_appointment = Math.floor((prev_visit_date.getTime() - appoint_date.getTime()) / (1000 * 3600 * 24));
				var days_missed_appointment = Math.floor((appoint_date.getTime() - dispensing_date.getTime()) / (1000 * 3600 * 24));
								 
				//Formula
				day_percentage = ((days_to_next_appointment - days_missed_appointment) / days_to_next_appointment) * 100;
				day_percentage = day_percentage.toFixed(2) + "%";
				
				$("#adherence").attr("value", day_percentage);
				$("#adherence").attr("readonly", "readonly");
			}
		}
	}
	
	function retrieveAppointedPatients() {
		$("#scheduled_patients").html("");
		$('#scheduled_patients').hide();
		//Function to Check Patient Number exists
		var base_url = "<?php echo base_url(); ?>";
		var appointment = $("#next_appointment_date").val();
		var link = base_url + "patient_management/getAppointments/" + appointment;
		$.ajax({
			url: link,
			type: 'POST',
			dataType: 'json',
			success: function(data) {
				var all_appointments_link = "<a class='link' target='_blank' href='<?php echo base_url() . 'report_management/getScheduledPatients/'; ?>" + appointment + "/" + appointment + "' style='font-weight:bold;color:red;'>View appointments</a>";
				var html = "Patients Scheduled on Date: <b>" + data[0].total_appointments + "</b> Patients" + all_appointments_link;
				var new_date = new Date(appointment);
				var formatted_date_day = new_date.getDay();
				var days_of_week = ["Sunday", "Monday", "Tuseday", "Wednesday", "Thursday", "Friday", "Saturday"];
				if (formatted_date_day == 6 || formatted_date_day == 0) {
					bootbox.alert("<h4>Weekend Alert</h4>\n\<hr/><center>It will be on " + days_of_week[formatted_date_day] + " During the Weekend </center>");
					if (parseInt(data[0].total_appointments) > parseInt(data[0].weekend_max)) {
						bootbox.alert("<h4>Excess Appointments</h4>\n\<hr/><center>Maximum Appointments for Weekend Reached</center>");
					}
				} else {
					if (parseInt(data[0].total_appointments) > parseInt(data[0].weekday_max)) {
						bootbox.alert("<h4>Excess Appointments</h4>\n\<hr/><center>Maximum Appointments for Weekday Reached</center>");
					}

				}

				$("#scheduled_patients").append(html);
				$('#scheduled_patients').show();
			}
		});
	}
	
	function reinitialize() {
		alert_qty_check =true;
		$(".unit").val('');
		$(".batch option").remove();
		$(".expiry").val('');
		$(".dose").val('');
		$(".dose option").remove();
		$("#doselist").val('');
		$(".pill_count ").val('');
		$(".next_pill_count ").val('');
		$(".duration").val('');
		$(".qty_disp ").val('');
		$(".soh").val('');
		$(".brand option").remove();
		$(".indication option").remove();
		$(".comment ").val('');
		$(".missed_pills ").val('');
		$(".qty_disp").css("background-color", "white");
		$(".qty_disp").removeClass("input_error");

	}
	
	function storeSession(ccc_id){
		var url = "<?php echo base_url().'dispensement_management/save_session'; ?>"
		$.post(url,{'session_name':'ccc_store_id','session_value':ccc_id});
	}
</script>