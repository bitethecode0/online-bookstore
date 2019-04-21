<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title></title>
  <link rel="stylesheet" href="css/style_mng.css">
</head>
  <body>
    <div>
      <h1><strong>Manage Books</strong></h1>
      <form id ="bookForm">
        <label>ISBN</lable> <input type="text" id="ISBN"><br/>
          <label>title</lable> <input type="text" id="title"><br/>
            <label>subjects</label>
            <select multiple="multiple" size="5" id="subjects">
              <option>AJAX</option>
              <option>HTML & CSS</option>
              <option>security & privacy</option>
              <option>Android &IOS</option>
              <option>LAMP</option>
              <option>STEM, and</option>
              <option>Database</option>
              <option>Mobile Computing</option>
              <option>World Wide Web</option>
            </select><br/>

            <label>authors</label>
            <select multiple="multiple" id ="authorlist">
               <option value="0">- Select -</option>
            </select>

            <br/><br/><br/><br/><br/>
            <!-- <label>authors</label> <input type="text" id="authors"><br/> -->
            <label>price</label> <input type="text" id="price">

            <input type="submit" name ="submit" value="INSERT">
            <br/><br/>
        </form>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js "></script>
        <script>
          $(document).ready(function(){

            // author list
            $.ajax({
              type: 'POST',
              contentType: "application/json",
              url: 'api/author/read.php'
            }).done(function(data){
              alert("succeed to read author list");
              data = $.parseJSON(data);
              $.each(data, function(i, item) {
                $('#authorlist').append("<option value ='"+item.authorid+"'>"+item.authorname+"</option>");
              });
            }).fail(function(){
              alert("failed to read author list from the system");
            });

            // when the 'bookform' is submitted
            $('#bookForm').on('submit', function(){

              var subjects = [];
              $.each($("#subjects option:selected"), function(){
                subject : subjects.push($(this).val());
              });

              var authors = [];
              $.each($("#authorlist option:selected"), function(){
                authors : authors.push($(this).val());
              });

              var work1 =   $.ajax({
                  type: 'POST',
                  contentType: "application/json",
                  url: 'api/book/create.php',
                  data : JSON.stringify({
                    isbn : $('#ISBN').val(),
                    title : $('#title').val(),
                    price : $('#price').val()

                  })
                });

              var work2 = $.ajax({
                type: 'POST',
                contentType: "application/json",
                url: 'api/bookcategory/create.php',
                data : JSON.stringify({
                  isbn : $('#ISBN').val(),
                  subjects
                })
              });

              var work3 = $.ajax({
                type: 'POST',
                contentType: "application/json",
                url: 'api/writtenby/create.php',
                data : JSON.stringify({
                  isbn : $('#ISBN').val(),
                  authors
                })
              });

              $.when(work1).then(work2,work3).then(alert("inserted."));

              return false;
          });
        });
        </script>
    <div>
  </body>
</html>
