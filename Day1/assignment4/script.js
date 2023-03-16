$(document).ready(function (e) {
	$("#imageForm").on('submit',(function(e) {
		e.preventDefault();
		$.ajax({
        	url: "upload.php",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    processData:false,
			success: function(response)
            {   
				
              $("#img").attr("src",response);

			},
            error: function(xhr, status, error) {
				// alert("Error in image: " + error)
                console.log("An error occurred: " + error);
            }

	   });
	}));
});