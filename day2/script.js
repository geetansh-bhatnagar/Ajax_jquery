$(document).ready(function() {
    $('#form').submit(function(event) {

        var formData = {
            fname: $('#fname').val(),
            lname: $('#lname').val(),
            email: $('#email').val(),
            password: $('#password').val()
        };

        $.ajax({
            type: 'POST',
            url: 'signin.php',
            data: formData,
            dataType: 'json',
            encode: true,
            success: function(response) {
                if(response[0] ['success']){
                    window.location.href = "login.html";
                }
                else{
                    alert(response[0] ['message'])
                }
            },
            error: function(xhr, status, error) {
                console.log("Error:", error);
            }
        });
        event.preventDefault();
    });
});


$(document).ready(function() {
   
    
    
    $('#myform').submit(function(event) {
        
        var formData = {
            user_id: $('#user_id').val(),
            post_name: $('#post_name').val(),
            post_description: $('#post_description').val(),
        };

        $.ajax({
            type: 'POST',
            url: 'view-connection.php',
            data: formData,
            dataType: 'json',
            encode: true,
            success: function(response) {
                // Clear previous table rows
              
                $("#mytable tbody").empty();
                // window.location.href = "view.html";
               
                var len = response.length
                for (var i = 0; i < len; i++) {
                var id = response[i].id
                var user_id = response[i].user_id
                var post_name = response[i].post_name
                var post_description = response[i].post_description
                var tr_str =
                    '<tr>' +
                    '<td>' + id + '</td>' +
                    '<td>' + user_id + '</td>' +
                    '<td>' + post_name +  '</td>' +
                    '<td>' +  post_description +  '</td>' +
                    '<td><button class="deleteBtn" style="background-color: rgb(209, 71, 47); color: white;" data-id="' + id + '">Delete</button></td>' +
                    '<td><button class="EditBtn" style="background-color: rgb(209, 71, 47); color: white;" data-id="' + id + '">Edit</button></td>' +
                    '</tr>'
                    $('#mytable tbody').append(tr_str)
                    $('#post_name').val(' ')
                    $('#user_id').val(' ')
                    $('#post_description').val(' ')
                    
                }
                $(".deleteBtn").on("click", function () {
                    var id = $(this).data("id");
                    var row = $(this).closest("tr");
                    $.ajax({
                        
                        type: "POST",
                        url: "delete.php",
                        data: { id: id },
                        success: function () {
                          
                            row.remove();
                        }
                    });
                });
                $(".EditBtn").on("click", function () {
                    var id = $(this).data("id");
                    sessionStorage.setItem('id', id );
                    window.location.href = 'edit.html';
                });

                    },
            error: function(xhr, status, error) {
                console.log("Error:", error);
            }


        });
        
        event.preventDefault();
    });
    
});