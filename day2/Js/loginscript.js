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
          if (response[0]['success']) {
            window.location.href = 'veiw.html'
          } else {
            alert(response[0]['message'])
          }},
        error: function(xhr, status, error) {
          console.log("Error:", error);
        }
      });
      event.preventDefault();
    });
  });
  