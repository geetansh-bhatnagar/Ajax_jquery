$(document).ready(function() {
    $('.login').submit(function(event) { // changed selector to #login
  
      var formloginData = {
        email: $('#email').val(),
        password: $('#password').val()
      };
  
      $.ajax({
        type: 'POST',
        url: 'php/login.php',
        data: formloginData,
        dataType: 'json',
        encode: true,
        success: function(response) {
          console.log(response);
          if (response[0].success == true) {
            window.location.href = "veiw.html";
            $('#username').val('');
            $('#password').val('');
          }
          else if(response[0].success == false){
            alert('You are not a registered user!!!');
            window.location.href = 'index.html';
        } 
        },
        error: function(xhr, status, error) {
          console.log("Error:", error);
        }
      });
      event.preventDefault();
    });
  });
  