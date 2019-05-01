<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title></title>
  <link rel="stylesheet" href="css/style_mng.css">
</head>
  <body>
    <div>
      <h1><strong>List All Customers</strong></h1>

      <table id = "listallbooks" border='1' width='250px'>
        <tr><th>Customer Name</th>
        </tr>

      </table>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js "></script>
        <script>
          $(document).ready(function(){

            $.ajax({
              type: 'POST',
              contentType: "application/json",
              url: 'api/user/read.php'
            }).done(function(response){
              // alert("working");
              var data = JSON.parse(response);

              var tr ='';
              $.each(data, function(i,item){
                tr += '<tr><td>'+item.username+'</td></tr>';
              });


             $('#listallbooks').append(tr);


            }).fail(function(){
              alert("no user");
            });



            return false;
        });
        </script>
    <div>
  </body>
</html>
