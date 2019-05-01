<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title></title>
  <link rel="stylesheet" href="css/style_mng.css">
</head>
  <body>
    <div>
      <h1><strong>List All Customers</strong></h1>

      <table id = "customer_list" border='1' width='250px'>
        <tr><th>customer id</th>
        <th>customer name</th>
        <th>total</th>
        </tr>
      </table>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js "></script>
        <script>
          $(document).ready(function(){


            $.ajax({
              type: 'POST',
              contentType: "application/json",
              url: 'api/order/read_customers.php'
            }).done(function(response){

              data = $.parseJSON(response);
              alert(data);

              var tblRow ='';
              $.each(data, function(i, item) {
                tblRow += "<tr>"+item.userid+"</td>";
                tblRow += "<td>"+item.username + "</td>";
                tblRow += '<td><a href=myaccount.php?userid='+(item.userid)+'>'+item.total_price+'</a></td></tr>';
              });

             $('#customer_list').html(tblRow);

            }).fail(function(){
              alert("fail to read all books..");
            });

            return false;
        });
        </script>
    <div>
  </body>
</html>
