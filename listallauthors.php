<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title></title>
  <link rel="stylesheet" href="css/style_mng.css">
</head>
  <body>
    <div>
      <h1><strong>List All Authors</strong></h1>

      <table id = "listallauthors" border='1' width='150px'>
        <tr><th>Author Name</th>
      </table>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js "></script>
        <script>
          $(document).ready(function(){

            $.ajax({
              type: 'POST',
              contentType: "application/json",
              url: 'api/author/read.php'
            }).done(function(response){
              // alert("working");
              var data = JSON.parse(response);
              var tr ='';
              $.each(data, function(i,item){
                //alert("isbn?" +item.isbn +", title ?"+item.title+", price?"+item.price);
                tr += '<tr><td>'+item.authorname+'</td>';
                tr += '</tr>';
              });

             $('#listallauthors').append(tr);

            }).fail(function(){
              alert("fail to read all books..");
            });



            return false;
        });
        </script>
    <div>
  </body>
</html>
