$(document).ready(function() {
    $('.login').submit(function(event) { // changed selector to #login
  
      var formloginData = {
        email: $('#email').val(),
        password: $('#password').val()
      };
  
      $.ajax({
        type: 'POST',
        url: 'login.php',
        data: formloginData,
        dataType: 'json',
        encode: true,
        success: function(response) {
          if (response) {
            window.location.href = "veiw.html";
            $('#username').val('');
            $('#password').val('');
          }
        },
        error: function(xhr, status, error) {
          console.log("Error:", error);
        }
      });
      event.preventDefault();
    });
  });
  