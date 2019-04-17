<?php

include "db.php";

session_start();

if(isset($_POST["codLogin"])){
    $email=mysqli_real_escape_string($con,$_POST["codEmail"]);
    $password= md5($_POST["codPassword"]);
    $sql = "SELECT * FROM lecturers WHERE email ='$email' AND pass_word ='$password' AND l_id='7'";
    $run_query = mysqli_query($con,$sql);		
    $count = mysqli_num_rows($run_query);
    if($count == 1){
        $row = mysqli_fetch_array($run_query);
        $_SESSION["cid"] = $row["l_id"];
        $_SESSION["fname"] = $row["first_name"];
        $_SESSION["lname"] = $row["last_name"];
    
    }
}

?>