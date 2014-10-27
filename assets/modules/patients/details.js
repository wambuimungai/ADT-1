$(function(){
    //Get data from hidden element in form
	var base_url = $("#hidden_data").data("baseurl");
	var patient_id = $("#hidden_data").data("patient");
	var patient_status = $("#hidden_data").data("status");
	var relations_msg = $("#hidden_data").data("message");

	//Disable these Buttons
	$("#dispense_btn").bind('click', false);
	$("#dispense_btn").attr("disabled", "disabled");
	$("#patient_info").attr("disabled", "disabled");
	$("#viral_load").attr("disabled", "disabled");
    
    //Display Relations Message
	if(relations_msg !='')
	{
		bootbox.alert("<h4>Dependant/Spouse Message </h4>\n\<hr/><span>"+relations_msg+"</span>");
	}
	//Check Patient Status
    if(patient_status != "active") {
        bootbox.alert("<h4>Status Not Active</h4>\n\<hr/><center>Cannot Dispense to Patient</center>");
        $("#dispense_btn").bind('click', false);
	    $("#dispense_btn").attr("disabled", "disabled");
	}else{
		$("#dispense_btn").unbind('click', false);
		$("#dispense_btn").attr("disabled", false);
	}
    
    //Define resources for requests
	var page_url = base_url + "patient_management/load_form/patient_details";
	var patient_url = base_url + "patient_management/load_patient/" + patient_id ;
	var visits_url = base_url + "patient_management/get_visits/" + patient_id;
	var summary_url = base_url + "patient_management/load_summary/" + patient_id;
	var spinner_url = base_url + "assets/images/loading_spin.gif";

	//Show Page Spinner
	/*
	$.blockUI({ 
		message: '<h3><img width="30" height="30" src="'+spinner_url+'" /> Loading...</h3>'
	}); 
    */

	//Load Page Data(form.js) then load Patient Data(details.js) after that sanitize form (details.js)
    getPageData(page_url).always( function(){
	    getPatientData(patient_url).always( function(){
            sanitizeForm();
	    });
	});

	//Setup Dispensing History Datatable
	createTable("#dispensing_history",visits_url);

	//Patient Info Modal
	$("#patient_details").dialog({
        width : 1200,
        modal : true,
        height: 600,
        autoOpen : false,
        show: 'fold'
    });

    //Viral Load Modal
	$("#viral_load_details").dialog({
        width: 700,
        modal: true,
        height: 400,
        autoOpen: false,
        show: 'fold'
    });

    //Open Viral Load Modal
    $("#viral_load").on('click', function() {
		getViralLoad();
		$("#viral_load_details").dialog("open");
	});

    //Show Patient Summary
	$("#patient_info").on('click',function() {
		//Load Spinner
		var spinner ='<center><img style="width:30px;" src="'+spinner_url+'"></center>';
		$(".spinner_loader").html(spinner);

		//Open Modal
		$("#patient_details").dialog("open");

		$("#details_patient_number_ccc").text($("#patient_number_ccc").val());
		$("#details_first_name").text($("#first_name").val());
		$("#details_last_name").text($("#last_name").val());
		$("#details_gender").text($("#gender").text());
		$("#details_current_age").text($("#age").val());
		$("#details_date_enrolled").text($("#date_enrolled").val());
		$("#details_current_status").text($("#current_status").text());

		getDispensing();
		getRegimenChange();
		getAppointmentHistory();
		get_viral_result($("#patient_number_ccc").val());
	});

});

function getPatientData(url){
	var checkbox = ["sms_consent", "disclosure"];
	var multiselect = ["fplan","other_illnesses","drug_allergies","drug_prophylaxis"];

	//Get JSON data for patient details page
	return  $.getJSON( url ,function( resp ) {
			    $.each( resp , function( index , value ) {
			        //Append JSON elements to DOM
			        if(jQuery.inArray(index,checkbox) == 1){
					    //Select checkbox
                        addToCheckbox(value);
			        }else if(jQuery.inArray(index,multiselect) == 1){
						//MultiSelectBox
                        addToMultiSelect( index , value);
			        }else{
			            $( "#"+index ).val( value );
			        }
			    });
			});
}

function addToCheckbox(div){		
    $("#"+div).attr("checked", "true");	
}

function addToMultiSelect(div,data){
	var values = data.split(",");
	$("#"+div).val(values);	
}

function createTable(div,url){
	$(div).dataTable({
		"bProcessing": true,
        "sAjaxSource": url,
        "bJQueryUI" : true,
		"sPaginationType" : "full_numbers",
		"bStateSave" : true,
		"sDom" : '<"H"T<"clear">lfr>t<"F"ip>',
		"bAutoWidth" : false,
		"bDeferRender" : true,
		"bInfo" : true
		});
}


function sanitizeForm(){
    //Remove none selected options
    $("select option:not(:selected)").remove();
    //Disable Elements
    $("input[type='text'],select,textarea").attr("disabled", 'disabled');

	//Close Spinner
	//$.unblockUI({});

	//Enable these Buttons
	$("#patient_info").attr("disabled", false);
	$("#viral_load").attr("disabled", false);

}

function getViralLoad(){
 	var patient_no = $("#patient_number_ccc").val();
 	var link = base_url +"assets/viral_load.json";

 	$.getJSON( link ,function( data ){
        var table='';
        if(data.length !=0){
        	patient_no = patient_no.toString().trim();
	        viral_data = data[patient_no]; 
            $.each(viral_data,function(i,v){
                table+='<tr><td>'+v.date_tested+'</td><td>'+v.result+'</td></tr>';
            });
        }
        $("#viral_load_data tbody").empty();
    	$("#viral_load_data tbody").append(table);
 	});

}

function get_viral_result(ccc_no){
	ccc_no = ccc_no.toString().trim();
	data_source=base_url+"assets/viral_load.json";
	$("#viral_load_date").text('N/A');
	$("#viral_load_result").text('N/A');
	$.get(data_source,function(data){
		if(data.length !=0){
			data_length=data[ccc_no].length; 
			if(data_length >0){
				$.each(data[ccc_no],function(key,val) {
				    if(key==(data_length-1)){  
				    	$("#viral_load_date").text(val.date_tested);
			            $("#viral_load_result").text(val.result);   
			        }      
			    });	
			}
		}
	});
}
 
function getDispensing(){
 	var patient_no = $("#patient_number_ccc").val();
 	patient_no = patient_no.toString().trim();
 	var link = base_url+"patient_management/getSixMonthsDispensing/"+patient_no;
	$.ajax({
	    url: link,
	    type: 'POST',
	    success: function(data) {	
	    	$("#patient_pill_count>tbody").empty();
	    	$("#patient_pill_count").append(data);
	    }
	});
 }
 
function getRegimenChange(){
 	var patient_no=$("#patient_number_ccc").val();
 	patient_no = patient_no.toString().trim();
 	var link=base_url+"patient_management/getRegimenChange/"+patient_no;
	$.ajax({
	    url: link,
	    type: 'POST',
	    success: function(data) {	
	    	$("#patient_regimen_history>tbody").empty();
	    	$("#patient_regimen_history").append(data);	
	    }
	});
}
             
function getAppointmentHistory(){
 	var patient_no=$("#patient_number_ccc").val();
 	patient_no = patient_no.toString().trim();
 	var link=base_url+"patient_management/getAppointmentHistory/"+patient_no;
	$.ajax({
	    url: link,
	    type: 'POST',
	    success: function(data) {	
	    	$("#patient_appointment_history>tbody").empty();
	    	$("#patient_appointment_history").append(data);
	    	
	    }
	});
}