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
		    {  console.log(response);
              $("#img").attr("src",response);
			}	        
	   });
	}));
});