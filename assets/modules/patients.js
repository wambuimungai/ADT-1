function getPatientData(url){
	//Get JSON data for patient details page
	$.getJSON( url ,function( resp ) {
	    $.each( resp , function( index , value ) {
	        //Append JSON elements to DOM
	        $( "#"+index ).val( value );
	    });
	});
}