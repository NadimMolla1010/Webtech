<?php
$uid = $_POST['uid'] ?? '';
$password = $_POST['password'] ?? '';

// database connection
$servername = "localhost";
$username = "root";
$db_password = "";
$dbname = "petuser_data";

$conn = new mysqli($servername, $username, $db_password, $dbname);

if($conn->connect_error){
    die('Connection failed : '.$conn->connect_error);
} else {
    $stmt = $conn->prepare("SELECT * FROM signup WHERE uid = ?");
    $stmt->bind_param("s", $uid);
    $stmt->execute();
    
    $result = $stmt->get_result();
    
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        if($row['password'] == $password){
            // login successful, redirect to dashboard page
            header("Location: dashboard.php");
            exit;
        } else {
            $error_message = "Invalid password";
        }
    } else {
        $error_message = "User ID not found";
    }
    
    $stmt->close();
    $conn->close();
}
?>

<html>
    <head>
        <title>Login to Petcare</title>
        <style>
            body {
                background-color: #F0F0F0;
            }
            
            .container {
                background-color: #FFFFFF;
                border: 1px solid #DDDDDD;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0,0,0,0.1);
                margin: auto;
                margin-top: 100px;
                max-width: 500px;
                padding: 20px;
                text-align: center;
            }
            
            input[type=text], input[type=password] {
                border: 1px solid #CCCCCC;
                border-radius: 5px;
                box-sizing: border-box;
                font-size: 16px;
                margin-bottom: 20px;
                padding: 10px;
                width: 100%;
            }
            
            input[type=submit] {
                background-color: #4CAF50;
                border: none;
                border-radius: 5px;
                color: #FFFFFF;
                cursor: pointer;
                font-size: 16px;
                margin-top: 20px;
                padding: 10px;
                width: 100%;
            }
            
            input[type=submit]:hover {
                background-color: #3e8e41;
            }
            
            .error-message {
                color: #FF0000;
                margin-bottom: 20px;
            }
        </style>
    </head>
    
    <body>
        <div class="container">
            <h2>Login to Petcare</h2>
            
            <?php if(isset($error_message)) { ?>
                <div class="error-message"><?php echo $error_message; ?></div>
            <?php } ?>
            
            <form action="togo.php" method="post">
                <label for="uid">User ID:</label>
                <input type="text" id="uid" name="uid" required>
                
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                
                <input type="submit" value="Login">
            </form>
        </div>
    </body>
</html>