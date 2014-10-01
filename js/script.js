$( document ).ready(function() {
	$( "#register" ).submit(function( event ) {
	    var empty = $('#register').find("input").filter(function() {
	        return this.value === "";
	    });
	    if(empty.length) {
	    	alert('All fields must be filled');
	  		event.preventDefault();  
	  		return;
	    }
	    if($('input[name=real-password]').val() != $('input[name=confirm-password]').val()) {
	    	alert('Passwords must mach');
	    	event.preventDefault();
	    	return;
	    }
	});
});
