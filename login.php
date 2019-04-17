<?php

include "db.php";

session_start();

if(isset($_POST["userLogin"])){
		$regno=mysqli_real_escape_string($con,$_POST["userRegno"]);
		$password= md5($_POST["userPassword"]);
		$sql = "SELECT * FROM students WHERE register_no ='$regno' AND pass_word ='$password'";
        $run_query = mysqli_query($con,$sql);		
		$count = mysqli_num_rows($run_query);
		if($count == 1){
			$row = mysqli_fetch_array($run_query);
			$_SESSION["sid"] = $row["s_id"];
			$_SESSION["reg"] = $row["register_no"];
		
	    }
    }
    
	
?>	