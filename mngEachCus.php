<?php
  $userid = $_GET['userid'];

?>

<head>
  <title></title>
  <link rel="stylesheet" href="css/style_mng.css">
</head>
  <body>
    <div>
      <h1><strong>List All Books</strong></h1>

      <table id = "each_cus" border='1' width='250px'>
        <tr><th>title</th>
        <th>quantity</th>
        </tr>
      </table>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js "></script>
        <script>
          $(document).ready(function(){

            $.ajax({
              type: 'POST',
              contentType: "application/json",
              url: 'api/order/read.php'
            }).done(function(response){

              data = $.parseJSON(response);

              var tblRow ='';
              $.each(data, function(i, item) {
                tblRow += "<tr>"+item.title+"</td>";
                tblRow += "<td>"+item.quantity + "</td></tr>";
              });


             $('#each_cus').html(tr);

            }).fail(function(){
              alert("fail to read all books..");
            });



            return false;
        });
        </script>
    <div>
  </body>
</html>
