<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
    <link rel = "stylesheet" href="style_mng.css">
</head>
<body>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js "></script>
  <script>
    $(document).ready(function(){

      $('#list_authors').click(function(){
        $.ajax({
          type: 'POST',
          contentType: "application/json",
          url: 'api/author/read.php',

        }).done(function(response){
          // alert("working");
          data = $.parseJSON(response);
          var tblRow ='';

          $.each(data, function(i, item) {
            tblRow += "<tr><td><input type='checkbox' id='mycheckox' value='"+item.authorid+"'></td>";
            tblRow += "<td>" + item.authorname + "</td></tr>";
          });
          alert(tblRow);
          $('#authorList').empty();
          $('#authorList').html(tblRow);

        }).fail(function(){
          alert("failed to read author list");
        });

        return false;
      });


      $('#insert_author').click(function(){
        // add author
        $.ajax({
             type: 'POST',
             contentType: "application/json",
             url: 'api/author/create.php',
             data : JSON.stringify({
               authorname : $('#authorname').val()
             })
         }).done(function(data){
             if(data){
               // login success
               alert("author inserted");
               //$('#msg').text(data);

               data = $.parseJSON(data);
               var tblRow ='';
               $.each(data, function(i, item) {
                 tblRow += "<tr><td><input type='checkbox' id='mycheckox' value='"+item.authorid+"'></td>";
                 tblRow += "<td>" + item.authorname + "</td></tr>";
               });
               $('#authorList').empty();
               $('#authorList').html(tblRow);
             }

           }).fail(function() {
             alert( "failed.");
         });
         // to prevent refreshing the whole page page
         return false;

      });

      $('#delete_author').click(function(){
        // delete author
        var id = [];
        $("#mycheckox:checked").each(function() {
          id.push({
            id : $(this).val()
          });

        });
        if(id.length <=0) { alert("Please select rows."); } else { WRN_PROFILE_DELETE = "Are you sure you want to delete "+(id.length>1?"these":"this")+" row?";
        var checked = confirm(WRN_PROFILE_DELETE);
        if(checked == true) {
          //var selected_values = id.join(",");
          //alert(selected_values);
          $.ajax({
            type: "POST",
            url: "api/author/delete.php",
            cache: false,
            data: JSON.stringify(id)

          }).done(function(data){
            alert("success to delete");
            data = $.parseJSON(data);
            var tblRow ='';
            $.each(data, function(i, item) {
              tblRow += "<tr><td><input type='checkbox' id='mycheckox' value='"+item.authorid+"'></td>";
              tblRow += "<td>" + item.authorname + "</td></tr>";
            });
            $('#authorList').empty();
            $('#authorList').html(tblRow);

          }).fail(function(){
            alert("failed to delete..");
          });
        }}
        return false;
      });


    });

  </script>
  <div>
    <h1><strong>Manage Authors</strong></h1>


      <label>name</lable> <input type="text" id="authorname">
      <input type="submit" id = "insert_author" value="INSERT">
      <br/><br/>
      <input type="submit" id = "list_authors" value="LIST">
      <table id ="authorList"border='1' width='250px'>
      </table>
      <input type="submit" id = "delete_author" value="DELETE">



    <div id="msg"></div>
  <div>

</body>
</html>
