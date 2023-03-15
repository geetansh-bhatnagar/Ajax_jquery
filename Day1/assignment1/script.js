
$(document).ready(function(){
   
    $("#submit").click(function(){
        var abc = document.getElementById("text").value;
            $.ajax({
            url: "1.php",
            type: "POST",
            dataType:'text',
            data: {text: abc},
            success: function(result){
                $("p").empty();
              $("p").text(result);
              $('#text').value('');
            }
        });
    });
});
