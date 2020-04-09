<?php
 $link = mysqli_connect("localhost","root","","library_management_system");
    $namee = "";
    $passs = "";
    $update = false;
    $id= 0;
    $result1 = mysqli_query($link,"SELECT * FROM `librarian_login_details`");
    $numofrows = mysqli_num_rows($result1);
 if(mysqli_connect_error()) {
     die("Database Connection Error");
 }
 else {
     if (isset($_POST['save'])) {
         $user1 = mysqli_real_escape_string($link,$_POST['user1']);
         $pass1 = mysqli_real_escape_string($link,$_POST['pass1']);
        if($numofrows>=2) {
            echo '<script type="text/javascript">';
            echo ' alert("Cant add more than 2 librarians")';
            echo '</script>';
        }
        else {
         $query = "INSERT into `librarian_login_details` (`username`,`password`) values ('$user1','$pass1')";
         if(!mysqli_query($link,$query)) {
            echo "err";
        }
        }
     }
     if(isset($_GET['delete'])) {
         $id=$_GET['delete'];
         $query = "DELETE from `librarian_login_details` where id=$id";
         if(!mysqli_query($link,$query)) {
            echo "err";
        }
        else {
            header("Location: adminloggedinpage.php");
        }
     }
     if(isset($_GET['edit'])) {
        $id=$_GET['edit'];
        $update = true;
        $query = "SELECT * from `librarian_login_details` where id=$id";
        $result = mysqli_query($link,$query);
        if(!mysqli_query($link,$query)) {
           echo "err";
       }
       else {
           $row = $result ->fetch_array();
           $namee = $row['username'];
           $passs = $row['password'];
       }
     }
     if(isset($_POST['update'])) {
         $id = $_POST['id'];
         $user1 = mysqli_real_escape_string($link,$_POST['user1']);
         $pass1 = mysqli_real_escape_string($link,$_POST['pass1']);
         $query = "UPDATE `librarian_login_details` SET username='$user1', password='$pass1' WHERE id=$id";
         if(!mysqli_query($link,$query)) {
            echo "err";
        }
        else {
            header("Location: adminloggedinpage.php");
        }
     }
     
 }
?>