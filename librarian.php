<?php

    $error = "";

    if(array_key_exists("submit",$_POST)) {

        include("data.php");

        if(!$_POST['email']) {
            $error .= "An username is required<br>";
        }
        if(!$_POST['password']) {
            $error .= "A password is required<br>";
        }
        if($error != "") {
            $error = "<p>There was error(s) in your form:</p>".$error;
        }
        else {

            if($_POST['signup']==1) {

                $query = "SELECT id FROM `librarian_login_details` where username = '".mysqli_real_escape_string($link,$_POST['email'])."'LIMIT 1";
  
                $result = mysqli_query($link,$query);

                if(mysqli_num_rows($result)>0) {
                    $error = "Email already taken";
                }
                else {
                    $query = "INSERT into `librarian_login_details` (`username`,`password`) values ('".mysqli_real_escape_string($link,$_POST['email'])."','".mysqli_real_escape_string($link,$_POST['password'])."')";
                    if(!mysqli_query($link,$query)) {
                        $error = "<p>Could not sign you up</p>";
                    }
                    else {
                        header("Location: librarianloggedinpage.php");
                    }
                }
            }
            else {
                $query = "SELECT * FROM `librarian_login_details` WHERE username = '".mysqli_real_escape_string($link, $_POST['email'])."'";
                
                $result = mysqli_query($link, $query);
            
                $row = mysqli_fetch_array($result);
            
                if (isset($row)) {
                    
                    $hashedPassword = $_POST['password'];
                    
                    if ($hashedPassword == $row['password']) {
                        
                        header("Location: librarianloggedinpage.php?nn=".urlencode($_POST['email'])."");
                            
                    } else {
                        
                        $error = "That username/password combination could not be found.";
                        
                    }
                    
                } else {
                    
                    $error = "That username/password combination could not be found.";
                    
                }
            }
        }
    }

    // echo $error;
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Librarian Login</title>
    <link rel="stylesheet" type="text/css" href="styles/librarian_login.css">
  </head>
  <body>
      <!-- <div style="background-image:url('bg.png');"> -->
      <div>
          <a href="home.php"><img src="home_button.png" alt="img" style="width:150px;height:60px;"></a>        
      </div>       
        <div id="aaa"  style="color:red;text-align:center;">
            <?php echo $error; ?>
        </div>
        <div class="container">
            <img src="ll.png" alt="Avatar" style="width:300px;height:200px;"> <br> <br>
        <form method="post" >
            <p>Log In using your username and password</p>
            <fieldset class="form-group">
                <input class="form-control"  name="email" placeholder="LoginId">
            </fieldset>

            <fieldset class="form-group">
                <input class="form-control" type="password" name="password" placeholder="password">
            </fieldset>

            <fieldset class="form-group">
                <input class="btn btn-primary" type="submit" name="submit" value="log in">
            </fieldset>
        </form>
          </div>
          
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
    <script>
    $(document).ready(function() {
        function disableBack() { window.history.forward() }
        window.onload = disableBack();
        window.onpageshow = function(evt) { if (evt.persisted) disableBack() }
    });
    </script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>