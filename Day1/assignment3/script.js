
            $(document).ready(function () {
                $(".table").hide();
                $("#submit").click(function () {
                    event.preventDefault();
                    $.ajax({
                        url: "connection.php",
                        type: "POST",
                        data: $('#myform').serialize(),
                        // dataType: 'text',
                        // data: { fname: 'fname', last_name: 'last_name', address: 'address', position: 'position', department: 'department' },
                        success: function (response) {
                            $(".table").show();
                            $('tbody').empty();
                            $('#mytable tbody').append(response)
                            $('#fname').val('');
                            $('#last_name').val('');
                            $('#address').val('');
                            $('#position').val('');
                            $('#department').val('');
                        }
                    });

                });
            });
    
