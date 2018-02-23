<!DOCTYPE html>
<html>
<head>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css.css">
</head>
<body>
<div class="header">
 	
 <h1> 
 	<?php
	include "database.php";
	session_start();

$sql = "SELECT * FROM user ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	?>
    <img src="images/<?php echo $row['Upload']; ?>" style='height:100px'><br>
    <?php
} else {
	echo "0 results <br>";}

	$sql = "SELECT name FROM user ORDER BY id DESC LIMIT 1";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
    // output data of each row
    $row = $result->fetch_assoc();
    echo $row["name"];
		}
	else {
    echo "0 results";}
	?>
	</h1>
  	<h3> 
  	<?php
		$sql1 = "SELECT designation FROM user ORDER BY id DESC LIMIT 1";
		$result = $conn->query($sql1);
			if ($result->num_rows > 0) {
    				$row = $result->fetch_assoc();
    				echo $row["designation"];
			}
			 else {
    				echo "0 results";
					}
				?>
	</h3>
	<a href="home.php" style="color: white;">Logout</a>
	</div>

<div class="col-3">
	<div class="personal">
			<h4><i class="fa fa-user"></i>  Personal Details:</h4> 
				<p><i class="fa fa-home"></i>
	<?php
			$sql1 = "SELECT address FROM user ORDER BY id DESC	LIMIT 1";
					$result = $conn->query($sql1);
				if ($result->num_rows > 0) {
    		    	$row = $result->fetch_assoc();
    				echo $row["address"];
					}
					 else {
    					echo "0 results";
						}
					?></p>

	<i class="fa fa-phone-square">+91  
		<?php
			$sql1 = "SELECT phone FROM user ORDER BY id DESC LIMIT 1";
				$result = $conn->query($sql1);
				if ($result->num_rows > 0) {
    				$row = $result->fetch_assoc();
    				echo $row["phone"];
					}
					 else {
    					echo "0 results";
						}
					?></i>
	
						<br>
						<br>
	
	<i class="fa fa-envelope">
		<?php
			$sql1 = "SELECT email FROM user ORDER BY id DESC LIMIT 1";
						$result = $conn->query($sql1);
						if ($result->num_rows > 0) {
    						$row = $result->fetch_assoc();
   							 echo $row["email"];
							}
							 else {
    						echo "0 results";
							}
						?></i>
	
					<br>
					<br>
					<br>
					</div>
					<br>	
					<br>
 	
	<div class="personal">
	<h4><i class="fa fa-globe"></i>  Languages Known:</h4>
	               
 		<?php
 			$id=$_SESSION['id'];
			$sql4 = " SELECT languages FROM languages,user where languages.user_id=user.id and languages.user_id= $id";
				$result1 = $conn->query($sql4);
					if ($result1->num_rows > 0) {
    	    			while ($row = $result1->fetch_assoc()) {
    	    				echo "<li>".$row["languages"] . "</li>";
    						}
 						}
 				else {
    					echo "0 results";
					}

		?>


		</div>
		<br>
		<br>
	
	<div class="personal">
		<h4><i class="fa fa-star"></i> Hobbies:</h4>
        
        <?php
 			$id=$_SESSION['id'];
				$sql3 = " SELECT hobbies FROM hobbies,user where hobbies.user_id=user.id and hobbies.user_id= $id";
					$result1 = $conn->query($sql3);
						if ($result1->num_rows > 0) {
							 while ($row = $result1->fetch_assoc()){
    	    					echo "<li>".$row["hobbies"] . "</li>";
    							}
 							}
 				else {
    					echo "0 results";
					}

			?>

	</div>
 	</div>

	<div class="col-9" style="
    height: 600px;">
		<h4>Objective</h4>	
			<p>
				<?php
					$sql1 = "SELECT objective FROM user ORDER BY id DESC LIMIT 1";
						$result = $conn->query($sql1);
							if ($result->num_rows > 0) {
  								    $row = $result->fetch_assoc();
    						echo $row["objective"];
						}
						 else {
  							  echo "0 results";
						}
				?>		
			</p>

		<h4> <i class="fa fa-graduation-cap"></i> Education</h4>
			<table id="customers">
  			<tr>
    		<th>Qualification</th>
   			<th>University</th>
    		<th>Percentage</th>
  			</tr>
  			<tr>
    	<td>
    		<?php
					$sql1 = "SELECT qualification FROM user ORDER BY id DESC LIMIT 1";
						$result = $conn->query($sql1);
							if ($result->num_rows > 0) {	
   								 $row = $result->fetch_assoc();
    								echo $row["qualification"];
							}
							else {
    							echo "0 results";
							}
						?></td>
    			<td><?php
						$sql1 = "SELECT university FROM user ORDER BY id DESC LIMIT 1";
							$result = $conn->query($sql1);
								if ($result->num_rows > 0) {
						    		$row = $result->fetch_assoc();
    									echo $row["university"];
											}
								else {
    									echo "0 results";	
									}
							?></td>
    	<td>
    		<?php
					$sql1 = "SELECT percentage FROM user ORDER BY id DESC LIMIT 1";
						$result = $conn->query($sql1);
							if ($result->num_rows > 0) {
	    							$row = $result->fetch_assoc();
    									echo $row["percentage"];
											}
								else {
    									echo "0 results";
										}
							?>
							</td>
  							</tr> 
							</table>

	<h4><i class="fa fa-asterisk"></i>   Skills</h4>
	<?php
 		$id=$_SESSION['id'];
			$sql3 = " SELECT skills FROM skills,user where skills.user_id=user.id and skills.user_id= $id";
				$result1 = $conn->query($sql3);
					if ($result1->num_rows > 0) {
       					while ($row = $result1->fetch_assoc()) {
    	    				echo "<li>".$row["skills"] . "</li>";
    					}
 						}
 						else {
    							echo "0 results";
						}
					?>
	
	<h4><i class="fa fa-align-justify"></i>Declaration</h4>	
	<p>
		<?php
			$sql1 = "SELECT declaration FROM user ORDER BY id DESC LIMIT 1";
				$result = $conn->query($sql1);
					if ($result->num_rows > 0) {
        				$row = $result->fetch_assoc();
    					echo $row["declaration"];
				}
				else {
    					echo "0 results";
					}
				?>
				</p>
	</div>
	</div>
	</body>
	</html>
