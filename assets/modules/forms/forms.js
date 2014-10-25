function getPageData(url){
	//Get JSON data for patient details page
	return  $.getJSON( url ,function( resp ) {
			    $.each( resp, function( column , elements ) {
		    	var text = "<option value=''>--Select--</option>";
		    	$.each( elements, function( key , value ) {
		    		text += "<option value='" + value.id +"'>" + value.Name + "</option>";    	
		        });
		        //Append html elements to DOM
		        $( "#"+column ).html( text );
		    });
		});
}