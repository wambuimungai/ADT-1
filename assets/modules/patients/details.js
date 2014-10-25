$(function(){
    //Get data from hidden element in form
	var base_url = $("#hidden_data").data("baseurl");
	var patient_id = $("#hidden_data").data("patient");
    
    //Define resources for requests
	var page_url = base_url + "patient_management/load_form/patient_details";
	var patient_url = base_url + "patient_management/load_patient/" + patient_id ;
	var visits_url = base_url + "patient_management/load_visits/" + patient_id;
	var summary_url = base_url + "patient_management/load_summary/" + patient_id;

	//Load Page Data(form.js) then load Patient Data(details.js) after that sanitize form (details.js)
    getPageData(page_url).always( function(){
	    getPatientData(patient_url).always( function(){
            sanitizeForm();
	    });
	});

	//Setup Dispensing History Datatable
	createTable("#dispensing_history",visits_url,true);

	//Show Patient Summary
	$("#patient_info").on('click',function() {
		$("#patient_details").dialog("open");
		//Get Summary 
		getSummaryData(summary_url);
	});

	//Summary Details
	$("#patient_details").dialog({
        width : 1200,
        modal : true,
        height: 600,
        autoOpen : false,
        show: 'fold'
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

function createTable(div,url,serverside){
	$(div).dataTable({
			"bJQueryUI" : true,
			"sPaginationType" : "full_numbers",
			"bStateSave" : true,
			"sDom" : '<"H"T<"clear">lfr>t<"F"ip>',
			"bProcessing" : true,
			"bServerSide" : serverside,
			"bAutoWidth" : false,
			"bDeferRender" : true,
			"bInfo" : true,
			"sAjaxSource": url
		});
}


function sanitizeForm(){
   //Remove none selected options
   $("select option:not(:selected)").remove();
   //Disable Elements
   $("input[type='text'],select,textarea").attr("disabled", 'disabled');
}

function getSummaryData(url){
	//Request the data
	$.get( url ,function( resp ) {
	    
	});
}