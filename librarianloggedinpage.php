
<?php
$nn = $_GET['nn'];
    $error = "";
    $unamego = "kunal132k";
    include("data.php");
    //print_r($_POST);
    if(array_key_exists("save",$_POST)) {
        if(!$_POST['bookid']) {
            $error .= "An bookid is required<br>";
        }
        if(!$_POST['bookn']) {
            $error .= "A book name is required<br>";
        }
        if(!$_POST['authorn']) {
            $error .= "A author name is required<br>";
        }
        if(!$_POST['location']) {
            $error .= "A location is required<br>";
        }
        if(!$_POST['quantity']) {
            $error .= "A quantity is required<br>";
        }
        if($error != "") {
            $error = "<p>There was error(s) in your form:</p>".$error;
        }
        else {
            $query = "SELECT id FROM `books_record` where bookid = '".mysqli_real_escape_string($link,$_POST['bookid'])."'LIMIT 1";
  
            $result = mysqli_query($link,$query);

            if(mysqli_num_rows($result)>0) {
                $error = "BookId already taken";
            }
            else {
                $query = "INSERT into `books_record` (`bookid`,`name`,`author`,`quantity`,`location`) values ('".mysqli_real_escape_string($link,$_POST['bookid'])."','".mysqli_real_escape_string($link,$_POST['bookn'])."','".mysqli_real_escape_string($link,$_POST['authorn'])."','".mysqli_real_escape_string($link,$_POST['quantity'])."','".mysqli_real_escape_string($link,$_POST['location'])."')";
                if(!mysqli_query($link,$query)) {
                    $error = "<p>Could not add this book</p>";
                }
                else {
                    echo '<script type="text/javascript">';
                    echo ' alert("successfully added")';  
                    echo '</script>';
                }
            }
        }
    }
    $update=false;
    $a="";
    $b="";
    $c="";
    $d="";
    $e="";
    if(isset($_GET['delete1'])) {
        $id=$_GET['delete1'];
        echo $nn;
        $query = "DELETE from `books_record` where id=$id";
        if(!mysqli_query($link,$query)) {
           echo "err";
       }
       else {
        header("Location: librarianloggedinpage.php?nn=$nn");
       }
    }
    if(isset($_GET['edit1'])) {
        $id=$_GET['edit1'];
        $update = true;
        $query = "SELECT * from `books_record` where id=$id";
        $result = mysqli_query($link,$query);
        if(!mysqli_query($link,$query)) {
           echo "err";
       }
       else {
           $row = $result ->fetch_array();
           $a = $row['bookid'];
           $b = $row['name'];
           $c = $row['author'];
           $d = $row['quantity'];
           $e = $row['location'];
       }
     }
     if(isset($_POST['update1'])) {
        
        $id = $_POST['id'];
        $x = mysqli_real_escape_string($link,$_POST['bookid']);
        $xx = mysqli_real_escape_string($link,$_POST['bookn']);
        $xxx = mysqli_real_escape_string($link,$_POST['authorn']);
        $xxxx = mysqli_real_escape_string($link,$_POST['quantity']);
        $xxxxx = mysqli_real_escape_string($link,$_POST['location']);
        // echo "$xxxxx";
        $query = "UPDATE `books_record` SET bookid='$x', name='$xx', author='$xxx' , quantity=$xxxx , location='$xxxxx' WHERE id=$id";
        if(!mysqli_query($link,$query)) {
           echo "errors";
       }
       else {
           header("Location: librarianloggedinpage.php?nn=$nn");
       }
    }
?>
<?php
    $erro = "";
    include("data.php");
    if(array_key_exists("done3",$_POST)) {
        if(!$_POST['bid3']) {
            $erro .= "An bookid is required<br>"; 
        }
        if(!$_POST['usname3']) {
            $erro .= "A user name is required<br>";
        }
        if(!$_POST['date3']) {
            $erro .= "A date is required<br>";
        }
        if($erro != "") {
            $erro = "<p>There was error(s) in your form:</p>".$erro;
           
        }
        else {
            $idgo = mysqli_real_escape_string($link,$_POST['bid3']);
            $unamego= mysqli_real_escape_string($link,$_POST['usname3']);
            $query = "SELECT * FROM `books_record` WHERE bookid='$idgo'";
            $result = mysqli_query($link,$query);
            $row = $result ->fetch_array();
            $go = $row['quantity'];
            $query2 = "SELECT * FROM `student_login_details` WHERE username='$unamego'";
            $result2 = mysqli_query($link,$query2);
            if(mysqli_num_rows($result)==0) {
                $erro .= "BookID does not Exist<br>";
            }
            else if(mysqli_num_rows($result2)==0) {
                $erro .= "UserName does not Exist";
            }
            else {
                        $query = "SELECT fine FROM `transaction` where usname='$unamego'";
                        $result = mysqli_query($link,$query);
                        $gg = 0;
                        while($row = $result ->fetch_array()) {
                          $gg = $gg + $row['fine'];                          
                        }
                        //echo $gg;
                if($go==0) {
                    $erro = "No more books left";
                }
                else {
                  if($gg>0) {
                    $erro = "Clear the dues first";
                  }
                  else {
                    $query = "INSERT into `transaction` (`bid`,`usname`,`idate`) values ('".mysqli_real_escape_string($link,$_POST['bid3'])."','".mysqli_real_escape_string($link,$_POST['usname3'])."','".mysqli_real_escape_string($link,$_POST['date3'])."')";
                    if(!mysqli_query($link,$query)) {
                        $erro = "<p>cant issue this book</p>";
                    }
                    else {
                        $query = "UPDATE `books_record` SET quantity=$go-1 WHERE bookid='$idgo'";
                        if(!mysqli_query($link,$query)) {
                            
                        }
                    }
                  }
                }
            }
        }
    }
    if(array_key_exists("done4",$_POST)) {
        if(!$_POST['bid4']) {
            $erro .= "An bookid is required<br>"; 
        }
        if(!$_POST['usname4']) {
            $erro .= "A user name is required<br>";
        }
        if(!$_POST['date4']) {
            $erro .= "A date is required<br>";
        }
        if($erro != "") {
            $erro = "<p>There was error(s) in your form:</p>".$erro;
           
        }
        else {
            $idgo = mysqli_real_escape_string($link,$_POST['bid4']);
            $unamego= mysqli_real_escape_string($link,$_POST['usname4']);
            $datego= mysqli_real_escape_string($link,$_POST['date4']);
            $query = "SELECT * FROM `transaction` where bid='$idgo' AND usname='$unamego' AND dated = 0";
            $result = mysqli_query($link,$query);
            $row = $result ->fetch_array();
            $go = $row['idate'];
            if(mysqli_num_rows($result)==0) {
                $erro .= "This combination does not Exist<br>";
            }
            else {
                if($go>$datego)
                {
                    $erro .= "Wrong Date!!!!<br>";
                }
                else {
                    $query = "UPDATE `transaction` SET rdate='$datego' WHERE bid='$idgo' AND usname='$unamego'";
                    if(!mysqli_query($link,$query)) {
                        echo "err";
                    }
                    else {
                      $query = "UPDATE `transaction` SET dated=DATEDIFF( rdate, idate) WHERE bid='$idgo' AND usname='$unamego'";
                      if(!mysqli_query($link,$query)) {
                        echo "err";
                      }
                      else {
                        $query = "SELECT dated FROM `transaction` where bid='$idgo' AND usname='$unamego'";
                        $result = mysqli_query($link,$query);
                        $row = $result ->fetch_array();
                        $goo = $row['dated'];
                        if($goo>15) {
                          $gxx = $goo - 15;
                          $gxx = $gxx * 5;
                          $query = "UPDATE `transaction` SET fine='$gxx' WHERE bid='$idgo' AND usname='$unamego'";
                          if(!mysqli_query($link,$query)) {
                            echo "err";
                          }
                        }
                      }
                    }
                }
            }
        }
    }
    if(array_key_exists("done5",$_POST)) {
      if(!$_POST['usname5']) {
          $erro .= "A user name is required<br>";
      }
      if($erro != "") {
        $erro = "<p>There was error(s) in your form:</p>".$erro;        
      }
      else { 
        $unamego= mysqli_real_escape_string($link,$_POST['usname5']);
        $query = "SELECT * FROM `transaction` where usname='$unamego'";
            $result = mysqli_query($link,$query);
            $row = $result ->fetch_array();
            if(mysqli_num_rows($result)==0) {
                $erro .= "No transaction available for this username<br>";
            }
            else {
              $query = "SELECT * FROM `transaction` where usname='$unamego'";
              $result = mysqli_query($link,$query);
        }
      }
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Librarian LoggedIn page</title>
    <style type="text/css">
        body{
            background-color:whitesmoke;
            font-size: 30px;
    }
    .contact{
        
        height: 400px;
    }
    .col-md-3{
        background: #ff9b00;
        padding: 4%;
        border-top-left-radius: 0.5rem;
        border-bottom-left-radius: 0.5rem;
    }
    .contact-info{
        margin-top:10%;
    }
    .contact-info img{
        margin-bottom: 15%;
    }
    .contact-info h2{
        margin-bottom: 10%;
    }
    .col-md-9{
        background: #fff;
        padding: 3%;
        border-top-right-radius: 0.5rem;
        border-bottom-right-radius: 0.5rem;
    }
    .contact-form label{
        font-weight:600;
    }
    .contact-form button{
        background: #25274d;
        color: #fff;
        font-weight: 600;
        width: 25%;
    }
    .contact-form button:focus{
        box-shadow:none;
    }
    .aaa {
        margin-top: 10px;
    }
    </style>
  </head>
  <body style="background-color:whitesmoke;">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script>
        var v= window.location.href;
        // alert(v);
    </script>
    <h1 style="color:#F89C0E;text-align:center; font-size: 70px;">Welcome <?php echo $nn ?></h1>
    <hr>
<?php
        include("data.php");
        $result = mysqli_query($link,"SELECT * FROM `books_record`");
    ?>
    <div id="aaa"  style="color:red;text-align:center;">
    
    <?php echo $erro; ?>
</div>
<h3 style="text-align:center;">Transaction Records</h3>
<div class="container qwer" style="margin-top:5px;">
<?php
$query = "SELECT * FROM `transaction` where usname='$unamego'";
$result = mysqli_query($link,$query);
?>
        <table class="table table-striped table-sm table-border">
            <thead>
                <tr>
                    <th>BookId</th>
                    <th>UserName</th>
                    <th>IssueDate</th>
                    <th>SubmitDate</th>
                    <th>Fine</th>
                </tr>
            </thead>
            <?php 
                while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo  $row['bid'] ?></td>
                    <td><?php echo  $row['usname'] ?></td>
                    <td><?php echo  $row['idate'] ?></td>
                    <td><?php echo  $row['rdate'] ?></td>
                    <td><?php echo  $row['fine'] ?></td>               
                </tr>
                <?php endwhile; ?>
        </table>
</div>    
<hr style="width:90%;">
<h3 style="text-align:center;">Book Records</h3>   
<div class="container" style="margin-top:5px;">
<?php
$query = "SELECT * FROM `books_record`";
$result = mysqli_query($link,$query);
?>
        <table class="table table-striped table-sm table-border">
            <thead>
                <tr>
                    <th>BookId</th>
                    <th>BookName</th>
                    <th>AuthorName</th>
                    <th>Quantity</th>
                    <th>Location</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <?php 
                while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo  $row['bookid'] ?></td>
                    <td><?php echo  $row['name'] ?></td>
                    <td><?php echo  $row['author'] ?></td>
                    <td><?php echo  $row['quantity'] ?></td>
                    <td><?php echo  $row['location'] ?></td>
                    <td>
                        <a href="librarianloggedinpage.php?nn=<?php echo $nn ?>&edit1=<?php echo $row['id']; ?>" class="btn btn-info" style="height:30px;">Edit</a>
                        <a href="librarianloggedinpage.php?nn=<?php echo $nn ?>&delete1=<?php echo $row['id']; ?>" class="btn btn-danger" style="height:30px;;">Delete</a>
                    </td>                    
                </tr>
                <?php endwhile; ?>
        </table>
    </div>
    <hr style="width:90%;">
<!-- Modal1 -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Issue a book!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form method="post" id="issueform">
            <div class="form-group">
                  <label class="control-label col-sm-2">Book_ID:</label>
                  <div class="col-sm-10">          
                    <input type="text" class="form-control" placeholder="Enter Book's ID" name="bid3">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2">Student_Username:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Enter Students UserName" name="usname3">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2">Date</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" placeholder="Enter Date" name="date3" value="<?php echo date('Y-m-d'); ?>" >
                  </div>
                </div> 
           
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button class="btn btn-primary" type="submit" value="1" id="ccc" name="done3">Done</button>
        </form>
      </div>
    </div>
  </div>
</div> 
<!-- Modal2 -->
<div class="modal fade" id="exampleModalLong2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle2" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle2">Submit a book!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" id="submitform">
            <div class="form-group">
                  <label class="control-label col-sm-2">Book_ID:</label>
                  <div class="col-sm-10">          
                    <input type="text" class="form-control" placeholder="Enter Book's ID" name="bid4">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2">Student_Username:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Enter Students UserName" name="usname4">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2">Date</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" placeholder="Enter Date" name="date4" value="<?php echo date('Y-m-d'); ?>" >
                  </div>
                </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button class="btn btn-primary" type="submit" value="1" id="cccc" name="done4">Done</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal3 -->
<div class="modal fade" id="exampleModalLong3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle3" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle3">View a students transaction</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form method="post" id="tranform">
        <div class="form-group">
                  <label class="control-label col-sm-2">Student_Username:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Enter Students UserName" name="usname5">
                  </div>
                </div>         
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button class="btn btn-primary" type="submit" value="1" id="qwerty"  name="done5">Done</button>
        </form>
      </div>
    </div>
  </div>
</div> 

<div class="container contact">
<div id="aaa"  style="color:red;text-align:center;">
    <?php echo $error; ?>
</div>
<form method="post" id="bookform">
    <div class="row">
        <div class="col-md-3">
            <div class="contact-info">
                <h2>Add a Book</h2>
                <a href="" class="btn btn-info col-sm-offset-2 col-sm-10 " style="margin-top:50px;" data-toggle="modal" data-target="#exampleModalLong">Issue</a>
                <a href="" class="btn btn-success col-sm-offset-2 col-sm-10 " style="margin-top:20px;" data-toggle="modal" data-target="#exampleModalLong2">Submit</a>
                <a href="" class="btn btn-secondary col-sm-offset-2 col-sm-10 " style="margin-top:20px;" data-toggle="modal" data-target="#exampleModalLong3" id="asd">View transaction</a>
                <a href="librarian.php" class="btn btn-danger col-sm-offset-2 col-sm-10 " style="margin-top:120px;">Logout</a>
            </div>
        </div>
        
        <div class="col-md-9">
            <div class="contact-form">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="form-group">
                  <label class="control-label col-sm-2">BookId</label>
                  <div class="col-sm-10">          
                    <input type="text" class="form-control" placeholder="Enter BookId" name="bookid" value="<?php echo $a; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2">Book Name:</label>
                  <div class="col-sm-10">          
                    <input type="text" class="form-control" placeholder="Enter Book's Name" name="bookn" value="<?php echo $b; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2">Author Name:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Enter Author's Name" name="authorn" value="<?php echo $c; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2">Location</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Enter Location" name="location" value="<?php echo $e; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2">Quantity</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" placeholder="Enter Quantity" name="quantity" value="<?php echo $d; ?>">
                  </div>
                </div>
                <div class="form-group">        
                  <div class="col-sm-offset-2 col-sm-10 aaa">
                    <?php if ($update == true): ?> 
                    <button type="submit" value="1" id="cc" name="update1" class="btn btn-info">Update</button>
                    <?php else: ?> 
                        <button type="submit" value="1" id="cc" name="save" class="btn btn-success">Add</button>
                    <?php endif; ?> 
                  </div>
                </div>
            </div>
        </div>
        
    </div>
    </form>
</div>
</body>
</html>