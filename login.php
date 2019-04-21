<html>
   <head>
      <title>Login Page</title>
      <link rel="stylesheet" href="css/styles.css">
    </head>

   <body bgcolor = "#FFFFFF">
      <div align = "center">
         <div style = "width:350px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>
            <div style = "margin:30px">
               <form id='userForm'>
                  <label>UserName  :</label><input type = "text" id = "username" class = "box"/><br /><br />
                  <label>Password  :</label><input type = "password" id = "password" class = "box" />
                  <input type = "submit" value = "LOGIN "/><br />
                  <a href= "register.php">create new account</a>
               </form>

            </div>
         </div>
      </div>

      <div id='response'></div>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js "></script>
      <script>
        $(document).ready(function(){

          $('#userForm').on('submit', function(){
            $.ajax({
                 type: 'POST',
                 contentType: "application/json",
                 url: 'api/user/login.php',
                 data : JSON.stringify({
                   username : $('#username').val()
                 })
             }).done(function(data){
                 if(data){
                   // login success
                   //alert("login success");
                   location.replace("main.php");
                 }

             }).fail(function() {
                 alert( "login failed.");
             });
             // to prevent refreshing the whole page page
             return false;

          });
        });

      </script>
   </body>
</html>
