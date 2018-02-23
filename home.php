<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <SCRIPT src="http://code.jquery.com/jquery-2.1.1.js"></SCRIPT>
        <style>
            table,th,td {
                border: 1px solid black;
                padding: 10px;
            }
            th{
                background-color: #051f1f;
                color:white;
                text-align: center;
            }
            td{

    background-color: aliceblue;
            }
            .button{
                background-color: limegreen;
                border-radius: 10px;
                padding: 30px;
            }
            h2{
                padding-left: 15px;

            }
            body{
                background: url(bg.jpeg);
    background-repeat: no-repeat;
    background-size: 100%;
            }
        </style>
    </head>
    <body>

    <div class="container">
        <h2>Resume List</h2>
        <div class="col-sm-6">
    <?php
        include "database.php";
            $sql = "SELECT id,name,email,phone FROM user ";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
	             echo "<table><tr><th>Name</th><th>Phone</th><th>Email</th><th>Resume</th></tr>";
	                   while ($row = $result->fetch_assoc()) {
		         echo "<tr><td>" . $row["name"] . "</td><td>" . $row["phone"] . "</td><td> " . $row["email"] . "</td>";
		              $id = $row[id];
		              echo "<td><a href=view.php?id=" . $id . ">Open resume</td></tr>";
	               }
	             echo "</table>";
                    }
                    else {
        	               echo "0 results";
                        }
                    ?>
    </div>
        <div class="col-sm-6">
	       <form action="register.php">
	        <input type="submit" class="button" value="Create Resume" name="submit">
	       </form>
    </div>
    </div>
    </body>
    </html>
