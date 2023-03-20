$(document).ready(function () {
    $('tbody').empty();
    $("form").submit(function (event) {
      $('tbody').empty();
  
      var formData = {
        title: $("#title").val(),
        rating: $("#rating").val(),
      };
  // using ajax to load data
      $.ajax({
        
        type: "POST",
        url: "insert.php",
        data: formData,
        dataType: "json",
        encode: true,
        success: function (response) {
          // Clear previous table rows
          $("#mytable tbody").empty();
  
          var len = response.length;
          for(var i=0; i<len; i++){
              var id = response[i].id;
              var title = response[i].Title;
              var rating = response[i].rating;
              var tr_str = "<tr>" +
                  "<td>" + id + "</td>" +
                  "<td>" + title + "</td>" +
                  "<td>" + rating + "</td>" +
                  '<td><button class="deleteBtn" style="background-color: rgb(209, 71, 47); color: white;" data-id="' + id + '">Delete</button></td>' +
                  "</tr>";
              $("#mytable tbody").append(tr_str);
              $('#title').val('');
              $('#rating').val('');
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
      }
      });
  
      event.preventDefault();
    });
  });

// what will happen if user click on arrows to sort
  $(document).ready(function () {

    $('.up').on('click', function () {
      sortTable(1, true)
    })
    $('.down').on('click', function () {
      sortTable(1, false)
    })
  
    $('.uprating').on('click', function () {
      sortTable(2, true)
    })
    $('.downrating').on('click', function () {
      sortTable(2, false)
    })

  // function that will be called to do actual sorting
  
    function sortTable (n, asc) {
      var table, rows, switching, i, x, y, shouldSwitch, dir, cmp
      table = document.getElementById('mytable')
      switching = true
      dir = asc ? 1 : -1
      while (switching) {
        switching = false
        rows = table.rows
        for (i = 1; i < rows.length - 1; i++) {
          shouldSwitch = false
          x = rows[i].getElementsByTagName('TD')[n]
          y = rows[i + 1].getElementsByTagName('TD')[n]
          if (n === 2) {
            if (dir*Number(x.innerHTML) < dir*Number(y.innerHTML)) {
              shouldSwitch = true
              break
            }
          } else {
            cmp = x.innerHTML
              .toLowerCase()
              .localeCompare(y.innerHTML.toLowerCase())
            if (dir * cmp > 0) {
              shouldSwitch = true
              break
            }
          }
        }
        if (shouldSwitch) {
          rows[i].parentNode.insertBefore(rows[i + 1], rows[i])
          switching = true
        }
      }
    }
  })