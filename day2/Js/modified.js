$(document).ready(function() {
    $.ajax({
      type: "GET",
      url: "php/modified.php", 
      dataType: "json",
      success: function(response) {
        $("#mytable tbody").empty();
       
       
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
            '<td><button class="deleteBtn" style="background-color: rgb(209, 71, 47); color: white; cursor:pointer" data-id="' + id + '">Delete</button></td>' +
            '<td><button class="EditBtn" style="background-color: rgb(209, 71, 47); color: white; cursor:pointer" data-id="' + id + '">Edit</button></td>' + '</tr>'
            $('#mytable tbody').append(tr_str);
      }
      $(".deleteBtn").on("click", function () {
        var id = $(this).data("id");
        var row = $(this).closest("tr");
        $.ajax({
            
            type: "POST",
            url: "php/delete.php",
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

    }, error: function(xhr, status, error) {
        console.log("Error:", error);
    }

    });
  });
  