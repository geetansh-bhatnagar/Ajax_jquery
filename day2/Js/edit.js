$(document).ready(function () {
    // var post_name = sessionStorage.getItem("post_name");
    // var user_id = sessionStorage.getItem("user_id");
    // var post_description = sessionStorage.getItem("post_description");
    // console.log(user_id);
    // $('#user_id').val(user_id);
    // $('#post_name').val(post_name);
    // $('#post_description').val(post_description);
    $("form").submit(function (event) {
        var id = sessionStorage.getItem("id");

        var formData = {
            id:id,
            user_id: $('#user_id').val(),
            post_name: $('#post_name').val(),
            post_description: $('#post_description').val(),
        }

        $.ajax({
           
            url: "php/edit.php",
            type: "POST",
            data: formData,
            dataType: "JSON",
            encode: true,
            success: function (response) {
                if (response[0]['message']) {
                    alert(response[0]['message']);
                    window.location.href = 'modified.html';

                }
            }
            // error: function (xhr, status, error) {
            //     alert("failed" + xhr + status + error);
            // }

        });

        event.preventDefault();
    });
});