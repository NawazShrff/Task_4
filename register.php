<!DOCTYPE html>
<html lang="en">
<head>
  <title>Resume Generator</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="regis.css">
</head>
<?php 

include "database.php";
session_start();
$nameErr =$designationErr =$dobErr =$addressErr=$phoneErr= $emailErr  =$objectiveErr=$declarationErr="";
$name =$designation=$dob=$address=$phone=$email=$objective=$declaration= "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

      $valid=true;
     
      if (empty($_POST["name"])) {
                $nameErr = "First Name is required";
                $valid=false;
                } 
          else {
                $name = test_input($_POST["name"]);
                if(!preg_match("/^[a-zA-Z ]*$/ ",  $name)) {
                $nameErr = "First Name is  Invalid";
                $valid=false;
                }
              }

      if (empty($_POST["designation"])) {
                $designationErr = "Enter your designation";
                $valid=false;
                }
          else {
                $designation = test_input($_POST["designation"]);
                if(!preg_match("/^[a-zA-Z ]*$/  ",  $designation)) {
                $designationErr = "only alphabets allowed..";
                $valid=false;
                }
              }

      if (empty($_POST["dob"])) {
                $dobErr = "Enter your date of Birth";
                $valid=false;
                }
          else {
                $dob = test_input($_POST["dob"]);
                 }

      if (empty($_POST["address"])) {
                $addressErr = "Address is required";
                $valid=false;
                }
           else {
                $address = test_input($_POST["address"]);
                }


      if (empty($_POST["phone"])) {
                $phoneErr = "Mobile Number is required";
                $valid=false;
                 } 
          else {
                $phone = test_input($_POST["phone"]);
                if (!preg_match('/^[0-9]*$/', $phone)) {
                $phoneErr = "invalid Mobile Number"; 
                $valid=false;
                }
              }


      if (empty($_POST["email"])) {
                $emailErr = "Email is required";
                $valid=false;
                }
           else {
                $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format"; 
                $valid=false;  
            }
          }

      if (empty($_POST["objective"])) {
                $objectiveErr = "Required";
                $valid=false;
                }
         else {
                $objective = test_input($_POST["objective"]);
              }


      if (empty($_POST["declaration"])) {
                $declarationErr = "Required";
                $valid=false;
                }
         else {
                $declaration = test_input($_POST["declaration"]);
              }

      if (empty($_POST["qualification"])) {
                $qualificationErr = "Required";
                $valid=false;
                }
         else {
                $qualification = test_input($_POST["qualification"]);
               }
  

   if ($valid) {

            $university =$_POST["university"];
            $percentage =$_POST["percentage"];
            $skills=$_POST['skill'];
            $languages=$_POST['language'];
            $hobbies=$_POST['hobby'];
            $file = $_FILES['Upload']['name'];

            $new_filename = '';

    if ($file != '') {
      
      $allowedExts = array("gif", "jpeg", "jpg", "png");
      foreach ($allowedExts as $item) {
        $flag = 0;
        if (preg_match("/$item$/", $_FILES['Upload']['name'])) {
          $pos = strrpos($file, '.');
          if ($pos === false) {
            $ext = "";
          }

          $ext = substr($file, $pos);
          $dt = date("d-m-Y"); 
          $new_filename = $name . "" . $dt . "" . $file;
          $uploaddir = 'images/';
          $uploadfile = $uploaddir . $new_filename;
          if (move_uploaded_file($_FILES['Upload']['tmp_name'], $uploadfile)) {
            $flag2 = 2;
          } else {
            $flag = 1;
          }

        } else {
          $flag = 2;
        }

      }
      if ($flag2 == 2) {
        echo "File is valid, and was successfully uploaded.";
      } else if ($flag == 1) {
        echo "File Uploading Failed!.";
      } else if ($flag == 2) {
        echo "File Uploading Failed!.\nInvalid file format!.";
      }

    }



    
          $sql = "INSERT INTO user(name,designation,dob,address,phone,email,Upload,objective,qualification,university,percentage,declaration)
                  VALUES ('$name ','$designation','$dob','$address','$phone','$email','$new_filename','$objective','$qualification','$university','$percentage','$declaration')";

        
           

      if ($conn->query($sql) === TRUE) {

          
      $id = mysqli_insert_id($conn);
            $_SESSION['id'] = $id;
      
          $columns = implode(", ",array_keys($hobbies));
          $escaped_values = array_map('mysql_real_escape_string', array_values($hobbies));
          $values  = implode(", ", $escaped_values);
          $count = count($hobbies);
          for ($i = 0;$i<$count;$i++)
           {
            
              $sql3 = "INSERT INTO hobbies (hobbies,user_id) VALUES ('$hobbies[$i]','$id')";
              $conn->query($sql3);
          }

          $columns = implode(", ",array_keys($skills));
          $escaped_values = array_map('mysql_real_escape_string', array_values($skills));
          $values  = implode(", ", $escaped_values);
          $count = count($skills);
          for ($i = 0;$i<$count;$i++)
           {
            
              $sql3 = "INSERT INTO skills (skills,user_id) VALUES ('$skills[$i]','$id')";
              $conn->query($sql3);
          }


          $columns = implode(", ",array_keys($languages));
          $escaped_values = array_map('mysql_real_escape_string', array_values($languages));
          $values  = implode(", ", $escaped_values);
          $count = count($languages);
          for ($i = 0;$i<$count;$i++)
           {
            
              $sql4 = "INSERT INTO languages (languages,user_id) VALUES ('$languages[$i]','$id')";
              $conn->query($sql4);
          }
            echo "New record created successfully";
            header('Location:http://localhost/task-php/res.php');
                  } 
          else {
                echo "Error: " . $sql . "<br>" . $conn->error;
                  }

          $conn->close();

              }
             
            }
      
      function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
          }
      ?>

<body>
<div class="container">
<h2 style="text-align:center;">Registration form</h2>
  <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
            <label class="control-label col-sm-2" for="name">Name:</label>
                  <div class="col-sm-10">
                      <input type="text" class="form-control" id="name" placeholder="Enter Name.." name="name">
                            <?php if ($nameErr) { ?><span class="error">* <?php echo $nameErr;?></span> <?php } ?>

                  </div>
                  </div>
    

    <div class="form-group">
            <label class="control-label col-sm-2" for="designation">Designation:</label>
                  <div class="col-sm-10">
                      <input type="text" class="form-control" id="designation" placeholder="Enter designation" name="designation">
                            <?php if ($designationErr) { ?><span class="error">* <?php echo $designationErr;?></span> <?php } ?>
                </div>
                </div>
    

    <div class="form-group">
           <label class="control-label col-sm-2" for="dob">Date Of Birth:</label>
                  <div class="col-sm-10">
                      <input type="text" class="form-control" id="dob" placeholder="[DD-MM-YY]" name="dob">
                            <?php if ($dobErr) { ?><span class="error">* <?php echo $dobErr;?></span> <?php } ?>

                </div>
                </div>
    

    <div class="form-group">
          <label class="control-label col-sm-2" for="address">Address:</label>
                  <div class="col-sm-10">
                      <input type="text" class="form-control" id="address" placeholder="Enter address" name="address">
                            <?php if ($addressErr) { ?><span class="error">* <?php echo $addressErr;?></span> <?php } ?>
                  </div>
                  </div>
    

    <div class="form-group">
          <label class="control-label col-sm-2" for="phone">Phone No:</label>
                  <div class="col-sm-10">
                      <input type="text" class="form-control" id="phone" placeholder="Enter phone number" name="phone">
                            <?php if ($phoneErr) { ?><span class="error">* <?php echo $phoneErr;?></span> <?php } ?>
                  </div>
                  </div>
    

    <div class="form-group">
          <label class="control-label col-sm-2" for="email">Email:</label>
                  <div class="col-sm-10">
                      <input type="text" class="form-control" id="email" placeholder="Enter email" name="email">
                            <?php if ($emailErr) { ?><span class="error">* <?php echo $emailErr;?></span> <?php } ?>
                  </div>
                  </div>
    
  <div class="form-group">
    
          <label class="control-label col-sm-2" for="Upload">Select Image:</label>
          <div class="col-sm-10">
          <input type="file" name="Upload" id="Upload">
        </div>
      </div>
      
    <div class="form-group">
          <label class="control-label col-sm-2" for="objective">Objective:</label>
                  <div class="col-sm-10">
                      <textarea class="form-control" rows="4" id="objective" placeholder="Enter objective" name="objective"></textarea>
                            <?php if ($objectiveErr) { ?><span class="error">* <?php echo $objectiveErr;?></span> <?php } ?>
                  </div>
                  </div>
    

    <div class="form-group" id="border">
      <h3>Education Details:-</h3>
          <label class="control-label col-sm-2" for="qualification">Qualification:</label>
                  <div class="col-sm-10">
                      <input type="text" class="form-control" id="qualification" placeholder="Enter qualification" name="qualification">
                            <?php if ($qualificationErr) { ?><span class="error">* <?php echo $qualificationErr;?></span> <?php } ?>
                  </div>
      
          <label class="control-label col-sm-2" for="university">University:</label>
                  <div class="col-sm-10">
                      <input type="text" class="form-control" id="university" placeholder="Enter university" name="university">
                  </div>
          
          <label class="control-label col-sm-2" for="percentage">Percentage:</label>
                  <div class="col-sm-10">
                      <input type="text" class="form-control" id="percentage" placeholder="Enter percentage" name="percentage">
                  </div>
                  </div>
    

    <div class="form-group">
          <label class="control-label col-sm-2" for="languages">Language:</label>
                  <div class="col-sm-10">
     

            <DIV id="product2">
                  <DIV class="float-left"><input type="text" name="language[]"  />
                  <input type="button" name="add_item2" value="+" onClick="addMore2();" />
                  <input type="button" name="del_item2" value="-" onClick="deleteRow2();" />
           
            </DIV>
            </div>
      </DIV>
      </div>
    
    <div class="form-group">
          <label class="control-label col-sm-2" for="hobbies">Hobbies:</label>
            <div class="col-sm-10">
                  <DIV id="product">
                  <DIV class="float-left"><input type="text" name="hobby[]"  />
                  <input type="button" name="add_item" value="+" onClick="addMore();" />
                  <input type="button" name="del_item" value="-" onClick="deleteRow();" />
            </DIV>
            </div>
            </DIV>
            </div>

    <div class="form-group">
          <label class="control-label col-sm-2" for="skills">Skills:</label>
                <div class="col-sm-10">          
        
            <DIV id="product1">
            <DIV class="float-left"><input type="text" name="skill[]"  />
                  <input type="button" name="add_item1" value="+" onClick="addMore1();" />
                  <input type="button" name="del_item1" value="-" onClick="deleteRow1();" />
           
            </DIV>
            </div>
            </DIV>
            </div>
    

    <div class="form-group">
          <label class="control-label col-sm-2" for="declaration">Declaration:</label>
                  <div class="col-sm-10">
                      <textarea class="form-control" rows="4" id="declaration" placeholder="Enter declaration" name="declaration"></textarea>
                            <?php if ($declarationErr) { ?><span class="error">* <?php echo $declarationErr;?></span> <?php } ?>
                  </div>
                  </div>
    <div class="form-group">        
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default" id="buttn">Submit</button>
        </div>
        </div>
        </form>
        </div>
        </body>


  <SCRIPT>
    function addMore() {
        $("<DIV>").load("input.php", function() {
        $("#product").append($(this).html());
              }); 
                   }
    function deleteRow() {
        $('DIV.product-item').each(function(index, item){
        jQuery(':checkbox', this).each(function () {
            if ($(this).is(':checked')) {
              $(item).remove();
                  }
                });
               });
             }  
  </SCRIPT>

  <SCRIPT>
    function addMore1() {
        $("<DIV>").load("input2.php", function() {
        $("#product1").append($(this).html());
          }); 
        } 
    function deleteRow1() {
        $('DIV.product1-item1').each(function(index, item1){
        jQuery(':checkbox', this).each(function () {
            if ($(this).is(':checked')) {
              $(item1).remove();
                }
              });
            });
          }  
  </SCRIPT>


  <SCRIPT>  
    function addMore2() {
        $("<DIV>").load("input3.php", function() {
        $("#product2").append($(this).html());
           }); 
         }
    function deleteRow2() {
        $('DIV.product2-item2').each(function(index, item2){
        jQuery(':checkbox', this).each(function () {
              if ($(this).is(':checked')) {
              $(item2).remove();
                }
              });
            });
          }  
  </SCRIPT>
  
  </html>
