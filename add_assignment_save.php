<?php
include('session.php');
// require("opener_db.php");
require 'dbcon.php';
$name=$_POST['name'];
$filedesc=$_POST['desc'];
$get_id  = $_GET['id'];

$input_name = basename($_FILES['uploaded_file']['name']);
echo $input_name ;
if ($input_name == ""){
				$id=$_POST['selector[]'];
				$N = count($id);
				for($i=0; $i < $N; $i++)
				{	
				$name_notification  = 'Add Assignment file name'." ".'<b>'.$name.'</b>';

						mysqli_query($conn,"INSERT INTO assignment (fdesc,fdatein,teacher_id,class_id,fname) VALUES ('$filedesc',NOW(),'$session_id','$id[$i]','$name')")or die(mysqli_error());
						mysqli_query($conn,"insert into notification (teacher_class_id,notification,date_of_notification,link) value('$get_id','$name_notification',NOW(),'assignment_student.php')")or die(mysqli_error());                
				 }
?>            
			<script>
				window.location = 'add_assignment.php<?php echo '?id='.$get_id;  ?>';
			</script>
<?php
}else{
	//upload random name/number *famous code/////////////
			$rd2 = mt_rand(1000, 9999) . "_File";
			$filename = basename($_FILES['uploaded_file']['name']);
			$ext = substr($filename, strrpos($filename, '.') + 1);/ 
		$newname = "admin/uploads/" . $rd2 . "_" . $filename;
		$name_notification  = 'Add Assignment file name'." ".'<b>'.$name.'</b>';
            (move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $newname));
				$id=$_POST['selector[]'];
				$N = count($id);
				for($i=0; $i < $N; $i++)
				{				
               $quy = "INSERT INTO assignment (fdesc,floc,fdatein,teacher_id,fname,class_id) VALUES ('$filedesc','$newname',NOW(),'$session_id','$name','$id[$i]')";
				$query = mysqli_query($conn,"insert into notification (teacher_class_id,notification,date_of_notification,link) value('$id[$i]','$name_notification',NOW(),'assignment_student.php')")or die(mysqli_error()); 
				//$result = @mysql_query($qry);
                $result2 = $conn->query($quy);
                if ($result2) {
                    $errmsg_arr[] = 'record was saved in the database and the file was uploaded';
                    $errflag = true;
                    if ($errflag) {
                        $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
                        session_write_close();
                        ?>

                     <script>
window.location = 'add_assignment.php<?php echo '?id='.$get_id;  ?>';
					</script>
                        <?php

                        exit();
                    }
                }
              }


mysqli_close();
?>