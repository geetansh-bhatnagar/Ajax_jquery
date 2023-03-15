$(document).ready(function(){
            
    $("button").click(function(){
        $.ajax({
        url: "2.php",
        success: function(result){
            $("#sorted_keywords").html(result);
        }
    });
       
    });
});