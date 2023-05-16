<?php
$uid= $_POST['uid'] ?? '';
$utype= $_POST['utype'] ?? '';
$password= $_POST['password'] ?? '';
$pet= $_POST['pet'] ?? '';


// Validate user input
if (empty($uid) || empty($utype) || empty($password) || empty($pet)) {
    // Handle validation error
    echo "<div class='error'>Please fill all the fields</div>";
}
else{
	

//database connection
$servername = "localhost";
$username = "root";
$db_password = "";
$dbname = "petuser_data";

$conn = new mysqli($servername, $username, $db_password, $dbname);


if($conn->connect_error){
    die('connection failed : '.$conn->connect_error);
} else {
    $stmt = $conn->prepare("INSERT INTO signup(uid, utype, password, pet) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $uid, $utype, $password, $pet);
    $stmt->execute();
    
    $stmt->close();
    $conn->close();
	// Handle successful submission
        echo "Data submitted successfully";
}
}

?>

<html>
      
     <head>
     <title>Signup to petcare</title>
	 <style type="text/css">
      body {
               background-image: url('funny-dogs-cats-isolated-white_488220-897.jpg');
               background-repeat: no-repeat;
				background-attachment: fixed;  
				background-size: cover;font-family: Arial, sans-serif;
               background-size: cover;
               margin: 0;
               padding: 0;
          }
		 .container {
  max-width: 960px;
  margin: 0 auto;
  padding: 40px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}
		  h3{
			   max-width: 960px;
               margin: 0 auto;
               padding: 50px;
		  }
		  .error {
  color: red;
  font-size: 24px;
  margin-bottom: 20px;
  text-align: center;
}
		  
		  </style>
	 
</head>

     <body >
          <div class="container">
     <form action = "signup.php"  method ="post">
	 
	 
     <P><h3>Welcome to petCare</h3></p>
	 
	 <label for="uid">User id:</label><br>
     <input type="text" id="uid" name="uid"><br><br>
	 
       <label for="utype">User type:</label><br>
       <input type="text" id="utype" name="utype"><br><br>
	   
	   <label for="password">password:</label><br>
       <input type="password" id="password" name="password"><br><br>
	   
	   
	   <label for="pet">Pet type:</label><br>
       <input type="text" id="pet" name="pet"><br><br>
	   
       <input type="submit" value="Submit">
    
          
		  
		  
          </form>
          <h4>OR</h4>
          <form action = "abc.php"  method ="get">
               <input type="Submit" value="Log in";>

      </div>
</body>
</html>