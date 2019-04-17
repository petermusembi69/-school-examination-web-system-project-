<?php
session_start();
include "db.php";

if(isset($_POST["unit_assignment"])){
    $u_code= $_POST['codeCode'];
    $u_name = $_POST['codeName'];
    $group = $_POST['codeGroup1'];
    $lec_reg = $_POST['codeLec'];
if(empty($u_code) || empty($u_name) || empty($group) || 
empty($lec_reg))
{
    echo "
        <div class='alert alert-danger'>
             <a href ='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>FILL ALL FIELDS</b>
        </div>
        ";
}else{
$sql="SELECT g_id FROM groups WHERE group_name='$group'";
$run_query=mysqli_query($con,$sql);   
if($row=mysqli_fetch_array($run_query)){
    $g_id=$row["g_id"];
$sqll="SELECT * FROM units WHERE g_id='$g_id' AND lecregister_no='$lec_reg'";
$sql_query=mysqli_query($con,$sqll);   
if(mysqli_num_rows($sql_query)==0){

$sql="INSERT INTO `units` (`u_id`, `g_id`, `unit_code`, `unit_name`, `group_name`, `lecregister_no`)
VALUES(NULL, '$g_id','$u_code', '$u_name', '$group', '$lec_reg')";
$run_query=mysqli_query($con,$sql);
    if($run_query){
        echo "
        <div class='alert alert-success'>
             <a href ='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>INPUT SUCCESSFULLY ADDED</b>
        </div>
        ";
    } 
   }
   else{
    echo "
    <div class='alert alert-danger'>
         <a href ='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>LECTURER CAN ONLY BE ASSIGNED ONE UNIT PER GROUP</b>
    </div>
    ";
   }
}}}
if(isset($_POST["get_units"])){
    $sql="SELECT * FROM `units`";
    $run_query=mysqli_query($con,$sql);
    while($row=mysqli_fetch_array($run_query)){
    $u_id=$row["u_id"];
    $u_cod= $row["unit_code"];
    $u_nam = $row["unit_name"];
    $grou1 = $row["group_name"];
    $lec_re = $row["lecregister_no"];
    echo"  
    <div class='container-fluid'>
    <div class='row'> 
        <div class='col-md-3'>
        <div class='btn-group'>
          <a href='#' remove_id='$u_id' class='btn btn-danger remove'><span class='fa-fa-trash'></span></a>
        </div>
        </div>
        <div class='col-md-2'><input type='text' class='form-control' value='$u_cod'></div>
        <div class='col-md-3'><input type='text' class='form-control' value='$u_nam'></div>
        <div class='col-md-2'>
           <input type='text' class='form-control' value='$grou1'>
        </div> 
        <div class='col-md-2'><input type='text' class='form-control' value='$lec_re'></div> 			             
        </div>
    </div>
    </div>
    <p><br/></p>

    ";
    }
}

    if(isset($_POST["removeFromDepartment"])){
		$pid = $_POST["removeId"];
		$sql ="DELETE FROM `units` WHERE u_id ='$pid'";
		$run_query = mysqli_query($con,$sql);
		if($run_query){
			echo "
			<div class='alert alert-danger'>
                 <a href ='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Unit has been Removed Successfully...!</b>
            </div>
			";
        }	
    }
		if(isset($_POST["displayForm"])){
            $academic_yr = $_POST["checkYr"];
            $sem = $_POST["checkSem"];
            $lecreg=$_SESSION["lecregister_no"]; 
            $sql ="SELECT * FROM `groups`
            INNER JOIN units ON
            groups.g_id=units.g_id
            INNER JOIN students ON
            units.g_id=students.g_id
            Where
            units.lecregister_no='$lecreg' AND groups.semester='$sem'
            AND groups.academic_year='$academic_yr'";
          
            $run_query = mysqli_query($con,$sql);
            $sqll="SELECT * FROM `units` WHERE `lecregister_no`='$lecreg'";
            $query=mysqli_query($con,$sqll);
            $count=mysqli_num_rows($run_query);
            if($count>1){
            
            echo "

            <div class='container-fluid'>
			 <div class='row'>
              <div class='col-md-1'>
              </div>
       		       	 <div class='col-md-10'>
	                 <div class='card'>
			             <div class='card-header' style='text-align:center;'><b><span >RESULTS ASSIGNMENT</span></b>
                 		 </div>
			             <div class='card-body'>
                   <div class='container_fluid'>
			             <div class='row'>
                             <div class='col-md-3 card-header'><b>REGISTRATION NUMBER</b></div>
			                 <div class='col-md-2 card-header'><b>ASSIGN1</b></div>
			                 <div class='col-md-2 card-header'><b>ASSIGN2</b></div>
			                 <div class='col-md-1 card-header'><b>CAT1</b></div>
			                 <div class='col-md-1 card-header'><b>CAT2</b></div>
			                 <div class='col-md-1 card-header'><b>exam</b></div>
			                 <div class='col-md-1 card-header'><b>Aggre</b></div>
			                 <div class='col-md-1 card-header'><b>insert</b></div>
				         </div>
				         </div>
			             ";
                          $datas="";
                          $k=0;
                          $l=0;
                         while($row=mysqli_fetch_array($run_query)){
                            $k++;
                            $s_id=$row["s_id"];
                            $regi=$row["register_no"];
                            $group=$row["group_name"];
                            $unit=$row["unit_name"];
                            $u_id=$row['u_id'];
                       if($k==1){
                          $datas.="$regi";

                       }     
                       else{
                           $datas.=",$regi";
                       }
                                        
                 $value=explode(',',$datas);      
                    

                       echo"
                         <div class='container_fluid'>
                            <div class='row'>
                                <div class='col-md-3'><input type='text' class='form-control' pid='$s_id' value='$value[$l]' disabled></div>
                                <div class='col-md-2'><input type='text' class='form-control' pid='$s_id' id='assign1-$s_id' value=''></div>
                                <div class='col-md-2'><input type='text' class='form-control' pid='$s_id' id='assign2-$s_id'value=''></div>
                                <div class='col-md-1'><input type='text' class='form-control' pid='$s_id' id='cat1-$s_id' value=''></div>
                                <div class='col-md-1'><input type='text' class='form-control' pid='$s_id' id='cat2-$s_id' value=''></div>
                                <div class='col-md-1'><input type='text' class='form-control exam' pid='$s_id' id='exam-$s_id' value=''></div>
                                <div class='col-md-1'><input type='text' class='form-control' pid='$s_id' id='aggr-$s_id' value=''></div>
                                <div class='col-md-1'>
                                <div class='btn-group'>
                                    <a href='#' update_id='$u_id' s_id='$s_id' class='btn btn-danger update'><span class='fa-fa-okay'></span></a>
                                </div>
                            </div>
                         </div>
                                
                   
                 ";
                 $l++;}
                  echo"
                  </div>
                  </div>
                         <div class='card-footer'>
                         <div><span><p>$group</p></span></div>
                         <div><span><p>$unit</p></span></div>                         
                         </div>
                      </div>
                    <div class='col-md-1'></div>
                    </div>   
                    </div>
                    </div>
                  
                    ";
                    }else{
                        echo"
                        <div class='row'>
                         <div class='col-md-2'></div>
                         <div class='col-md-8'>
                          <div class='alert alert-danger'>
                               <a href ='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>No units assigned during this semester...!</b>
                          </div>
                          </div>
                        <div class='col-md-2'>
                       </div>
                        ";
                    }   
                    }
                
    if(isset($_POST["updateResults"])){
        $pid = $_POST["updateId"];
        $sid=$_POST["reg"];
		$assign1 = $_POST["assign1"];
		$assign2 = $_POST["assign2"];
		$cat1 = $_POST["cat1"];
		$cat2 = $_POST["cat2"];
		$exam = $_POST["exam"];
        $aggr = $_POST["aggr"];
        $sqll="SELECT register_no from students where s_id='$sid'";
        $query = mysqli_query($con,$sqll);
        $count=mysqli_num_rows($query);
        if($count>0){
            while($row = mysqli_fetch_array($query)){
            $regi=$row["register_no"];
        $sqli="SELECT * from unitresults where register_no='$regi' AND u_id='$pid'";
        $sql_query = mysqli_query($con,$sqli);
        $counter=mysqli_num_rows($sql_query);
        if($counter==0){
        $sql ="INSERT INTO `unitresults` (`ur_id`, `u_id`, `register_no`, `assignment1`, `assignment2`, `cat1`, `cat2`, `exam`,`aggre`) 
        VALUES (NULL, '$pid', '$regi', '$assign1', '$assign2', '$cat1', '$cat2', '$exam','$aggr')";
		$run_query = mysqli_query($con,$sql);
		if($run_query){
            
			echo "
			<div class='alert alert-success'>
                 <a href ='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Results has been updated Successfully...!</b>
            </div>
			";
        }
    }else{
	echo "
			<div class='alert alert-danger'>
                 <a href ='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Action denied, results already exists...!</b>
            </div>
			";
   }
}
    }
    
    }
    if(isset($_POST["search"])){
        $keyword=$_POST["keyword"];
        $sql="SELECT * from students
            INNER JOIN unitresults  ON
            students.register_no=unitresults.register_no
            INNER JOIN units ON
            unitresults.u_id=units.u_id
            where students.register_no='$keyword'";
		$run_query = mysqli_query($con,$sql);
        $count=mysqli_num_rows($run_query);
        if($count>0){
            echo"
            <div class='container-fluid'>
            <div class='row'>
             <div class='col-md-1'>
             </div>
                          <div class='col-md-10'>
                    <div class='card'>
                        <div class='card-header' style='text-align:center;'><b><span >RESULTS ASSIGNMENT</span></b>
                         </div>
                        <div class='card-body'>
                  <div class='container_fluid'>
                        <div class='row'>
                            <div class='col-md-3 card-header'><b>UNIT NAME</b></div>
                            <div class='col-md-3 card-header'><b>UNIT CODE</b></div>
                            <div class='col-md-3 card-header'><b>AGGREGATE</b></div>
                            <div class='col-md-3 card-header'><b>GRADE</b></div>
                        </div>
                        </div>
            ";
            $i=0;
            $l=0;
            $datas="";
            $total=0;

        while($row=mysqli_fetch_array($run_query)){
            $i++;
            $l++;
            $uid=$row["u_id"];
            $uname=$row["unit_name"];
            $ucode=$row["unit_code"];
            $fname=$row["first_name"];
            $lname=$row["last_name"];
            $aggre=$row["aggre"];
            $reg=$row["register_no"];
            if($aggre>=70&&$aggre<=100){
                $grade='A';
            }
            else if($aggre>=60&&$aggre<=69){
                $grade='B';
            }
            else if($aggre>=50&&$aggre<=59){
                $grade='C';
            }
            else if($aggre>=40&&$aggre<=49){
                $grade='D';
            }
            else{
                $grade='E';
            }
            if($i==1){
                $datas.="$grade";
            }else{
                $datas.="$grade";
            }
           
             echo"
                         <div class='container_fluid'>
                            <div class='row'>
                                <div class='col-md-3'><input type='text' class='form-control'  value='$ucode' disabled></div>
                                <div class='col-md-3'><input type='text' class='form-control' value='$uname' disabled></div>
                                <div class='col-md-3'><input type='text' class='form-control' value='$aggre' disabled></div>
                                <div class='col-md-3'><input type='text' class='form-control' value='$grade' disabled></div>
                            </div>
                   
                            </div>
             
             ";
        $i++;
        if($l==1){
            $total+=$aggre;
        }else{
            $total+=$aggre;
        }
        $l++;}
        $total=ceil($total/($l/2));
        if($total>=70&&$total<=100){
            $fgrade='A';
        }
        else if($total>=60&&$total<=69){
            $fgrade='B';
        }
        else if($total>=50&&$total<=59){
            $fgrade='C';
        }
        else if($total>=40&&$total<=49){
            $fgrade='D';
        }
        else{
            $fgrade='E';
        }

        echo"<div class='container_fluid'>
               <div class='row'>
                 <div class='col-md-3'></div>
                 <div class='col-md-3'></div>
                 <div class='col-md-3'>
                 <div>
                 <span><b><p>Total $total </p></b></span></div>
                 </div>
                 <div class='col-md-3'> <div>
                 <span><b><p>Grade $fgrade </p></b></span></div>
                 </div>
";

        $pass = "/^[A-D]+$/";
        if(preg_match($pass,$datas)){
            $verdict='pass';
        }else{
            $verdict='fail';
        }
        echo"
        </div>
        </div>
               <div class='card-footer'>
               <div><span><p>Verdict $verdict </p></span></div>
               <div><span><p>$reg</p></span></div>
               <div><span><p>$fname  $lname</p></span></div>                         
               </div>
            </div>
          <div class='col-md-1'></div>
          </div>   
          </div>
          </div>
        
          ";
        }
        else{
            echo"
            <div class='alert alert-danger'>
                 <a href ='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Results are not yet available...!</b>
            </div>
            ";
        }    
    }
    if(isset($_POST["results"])){
        $sid=$_SESSION["sid"];
        $sql="SELECT * from students
            INNER JOIN unitresults  ON
            students.register_no=unitresults.register_no
            INNER JOIN units ON
            unitresults.u_id=units.u_id
            where students.s_id='$sid'";
		$run_query = mysqli_query($con,$sql);
        $count=mysqli_num_rows($run_query);
        if($count>0){
           echo"
            <div class='container-fluid'>
            <div class='row'>
             <div class='col-md-1'>
             </div>
                          <div class='col-md-10'>
                    <div class='card'>
                        <div class='card-header' style='text-align:center;'><b><span >RESULTS ASSIGNMENT</span></b>
                         </div>
                        <div class='card-body'>
                  <div class='container_fluid'>
                        <div class='row'>
                            <div class='col-md-3 card-header'><b>UNIT NAME</b></div>
                            <div class='col-md-3 card-header'><b>UNIT CODE</b></div>
                            <div class='col-md-3 card-header'><b>AGGREGATE</b></div>
                            <div class='col-md-3 card-header'><b>GRADE</b></div>
                        </div>
                        </div>
            ";
            $i=0;
            $l=0;
            $datas="";
            $total=0;

        while($row=mysqli_fetch_array($run_query)){
            $i++;
            $l++;
            $uid=$row["u_id"];
            $uname=$row["unit_name"];
            $ucode=$row["unit_code"];
            $fname=$row["first_name"];
            $lname=$row["last_name"];
            $aggre=$row["aggre"];
            $reg=$row["register_no"];
            if($aggre>=70&&$aggre<=100){
                $grade='A';
            }
            else if($aggre>=60&&$aggre<=69){
                $grade='B';
            }
            else if($aggre>=50&&$aggre<=59){
                $grade='C';
            }
            else if($aggre>=40&&$aggre<=49){
                $grade='D';
            }
            else{
                $grade='E';
            }
            if($i==1){
                $datas.="$grade";
            }else{
                $datas.="$grade";
            }
            if($l==1){
                $total+=$aggre;
            }else{
                $total+=$aggre;
            }
             echo"
                         <div class='container_fluid'>
                            <div class='row'>
                                <div class='col-md-3'><input type='text' class='form-control'  value='$ucode' disabled></div>
                                <div class='col-md-3'><input type='text' class='form-control' value='$uname' disabled></div>
                                <div class='col-md-3'><input type='text' class='form-control' value='$aggre' disabled></div>
                                <div class='col-md-3'><input type='text' class='form-control' value='$grade' disabled></div>
                            </div>
                   
                            </div>
             
             ";
        $i++;
        $l++;}
        $total=ceil($total/($l/2));
        if($total>=70&&$total<=100){
            $fgrade='A';
        }
        else if($total>=60&&$total<=69){
            $fgrade='B';
        }
        else if($total>=50&&$total<=59){
            $fgrade='C';
        }
        else if($total>=40&&$total<=49){
            $fgrade='D';
        }
        else{
            $fgrade='E';
        }

        echo"<div class='container_fluid'>
               <div class='row'>
                 <div class='col-md-3'></div>
                 <div class='col-md-3'></div>
                 <div class='col-md-3'>
                 <div>
                 <span><b><p>Total $total </p></b></span></div>
                 </div>
                 <div class='col-md-3'> <div>
                 <span><b><p>Grade $fgrade </p></b></span></div>
                 </div>
";

        $pass = "/^[A-D]+$/";
        if(!preg_match($pass,$datas)){
            $verdict='Fail';
        }else{
            $verdict='PASS';
        }
        echo"
        </div>
        </div>
               <div class='card-footer'>
               <div><span><p>Verdict $verdict </p></span></div>
               <div><span><p>$reg</p></span></div>
               <div><span><p>$fname  $lname</p></span></div>                         
               </div>
            </div>
          <div class='col-md-1'></div>
          </div>   
          </div>
          </div>
        
          ";
        }
        else{
            echo"
            <div class='alert alert-danger'>
                 <a href ='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Results are not yet available...!</b>
            </div>
            ";
        }    
    }
?>