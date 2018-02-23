<!DOCTYPE html>
 <html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="css.css">
        <meta charset="utf-8">
        <title>Resume</title>
        <script>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        </script>
        
    </head>
    <style >
        

table{
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
    box-shadow:0px 5px 100px #170d0d;
        }

table td,table th {
    border: 1px solid #060606;
    padding: 3px;
    }

table tr:nth-child(even){background-color: #f2f2f2;}

table tr:hover {background-color: #ddd;}

table th {
    padding-top: 3px;
    padding-bottom: 3px;
    text-align: center;
    background-color: #051f1f;
    color: white;
      }  
    

    </style>
    <body>
        <div class="header">
         <h1>   <?php
    include "database.php";
    $id = $_GET['id'];

$sql = "SELECT * FROM user ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    ?>
    <img src="images/<?php echo $row['Upload']; ?>" style='height:100px'><br>
    <?php
} else {
    echo "0 results <br>";}


    $sql = "SELECT name FROM user where id=$id";
    $result = $conn->query($sql);   
            if ($result->num_rows > 0) {
                	$row = $result->fetch_assoc();
	                   echo $row["name"];
                } else {
	                   echo "0 results";}
            ?></h1>
             <br>
            
    <h3><i class="fa fa-briefcase z ">
        <?php
                $sql1 = "SELECT designation FROM user where id=$id";
                    $result = $conn->query($sql1);
                        if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                echo $row["designation"];
                            } 
                        else {
                                echo "0 results";
                                }
            ?></i></h3>
            <br>
                <a href="home.php" style="color: white;">Logout</a>
</div>
        <br>

<div class="col-3">
    <div class="personal">
            <h4><i class="fa fa-user"></i>  Personal Details:</h4> 

    <i class="fa fa-phone z">
        <?php
                $sql1 = "SELECT phone FROM user where id=$id";
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

    <i class="fa fa-calendar z">
        <?php
                $sql1 = "SELECT dob FROM user where id=$id";
                    $result = $conn->query($sql1);
                        if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                echo $row["dob"];
                                } 
                            else {
                                echo "0 results";
                                }
            ?></i>
            <br>
            <br>
    <i class="fa fa-envelope-square">
        <?php
                $sql1 = "SELECT email FROM user where id=$id";
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
    <i class="fa fa-home z">
        <?php
                $sql1 = "SELECT address FROM user where id=$id";
                    $result = $conn->query($sql1);
                        if ($result->num_rows > 0) {
	                           $row = $result->fetch_assoc();
	                           echo $row["address"];
                            }
                     else {
	                           echo "0 results";
                            }
            ?></i>
        </div>
            <br>
            <br>
            <br>
            <br>
            <div class="personal">
    <h3><i class="fa fa-globe z">Languages Known</i></h3>

        <?php
            $sql4 = " SELECT languages
                FROM languages,user where languages.user_id=user.id and languages.user_id= $id";
                    $result = $conn->query($sql4);
                        if ($result->num_rows > 0) {
    	                   while ($row = $result->fetch_assoc()) {
		                      echo "<li>".$row["languages"] . "</li>";
	                               }
                                }
                         else {
	                           echo "0 results";
                            }
            ?>
            <br>
            <br>
        </div>
        <br>
        <br>
        <div class="personal">
    <h3><i class="fa fa-star z">   Hobbies:</i></h3>
        <?php
                $sql3 = " SELECT hobbies
                    FROM hobbies,user where hobbies.user_id=user.id and hobbies.user_id= $id";
                        $result = $conn->query($sql3);
                            if ($result->num_rows > 0) {
	                           while ($row = $result->fetch_assoc()) {
		                          echo "<li>".$row["hobbies"] . "</li>";
	                           }
                            }
                     else {
	                           echo "0 results";
                        }
            ?>
        </div>
        </div>
        <div class="col-9 ">
        <h3><i class="fa fa-star "></i>  Objective</h3>
        <p>
        <?php
            $sql1 = "SELECT objective FROM user where id=$id";
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
            
            <h3><i class="fa fa-graduation-cap "></i> Education</h3>
            
            <p>
            <?php
                    $sql = "SELECT qualification,university,percentage FROM user where id=$id";
                        $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
	                   echo "<table><tr><th>Qualification</th><th>University</th><th>Percentage</th></tr>";
	                       while ($row = $result->fetch_assoc()) {
		               echo "<tr><td>" . $row["qualification"] . "</td><td> " . $row["university"] . "</td><td>" . $row["percentage"] . "</td></tr>";
	                       }
	           echo "</table>";
                    }
             else {
	               echo "0 results";
                    }
            ?></p>
                
            <h3><i class="fa fa-laptop "></i> Skills</h3>
            <?php
                $sql6 = " SELECT skills
                FROM skills,user where skills.user_id=user.id and skills.user_id= $id";
                    $result = $conn->query($sql6);
                        if ($result->num_rows > 0) {
        	               while ($row = $result->fetch_assoc()) {
		                      echo "<li>".$row["skills"] . "</li>";
	                           }
                            }
                     else {
	                       echo "0 results";
                        }
            ?>


            <h3><i class="fa fa-align-justify"></i>  Declaration</h3>
        <p>
        <?php
            $sql1 = "SELECT declaration FROM user where id=$id";
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
    </body>
        <?php
         $conn->close();
                ?>
    </body>
    </html>
