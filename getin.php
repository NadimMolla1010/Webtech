<?php
//database connection
$servername = "localhost";
$username = "root";
$db_password = "";
$dbname = "petuser_data";

$conn = new mysqli($servername, $username, $db_password, $dbname);

if ($conn->connect_error) {
    die('connection failed : ' . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uid = $_POST['uid'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM signup WHERE uid = ? AND password = ?");
    $stmt->bind_param("ss", $uid, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // user has signed in successfully
        header("Location: admin.php");
        exit;
    } else {
        // invalid user ID or password
        $error_message = "Invalid user ID or password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Sign In to Petcare</title>
	<style type="text/css">
	body {
               background-image: url('32058.jpg');
               background-repeat: no-repeat;
				background-attachment: fixed;  
				background-size: cover;font-family: Arial, sans-serif;
               background-size: cover;
			    background-blend-mode: lighten;
               margin: 0;
               padding: 0;
          }
		.container {
			margin: auto;
			width: 50%;
			border: 3px solid green;
			padding: 10px;
		}
		label {
		display: block;
		margin-bottom: 10px;
	}
	input[type="text"], input[type="password"] {
		width: 95%;
		padding: 5px;
		margin-bottom: 10px;
		background-color: transparent; /* make background color transparent */
		border: none; /* remove border */
		border-bottom: 1px solid #ccc; /* add border bottom for styling */
	}
	input[type="submit"] {
		background-color: green;
		color: white;
		border: none;
		padding: 15px;
		cursor: pointer;
	}
	input[type="submit"]:hover {
		background-color: black;
		color: white;
	}
		
	</style>
</head>
<body>
	<div class="container">
		<h2>Sign In to Petcare</h2>
		<form method="POST">
			<?php if (isset($error_message)) { ?>
				<p style="color: red;"><?php echo $error_message; ?></p>
			<?php } ?>
			<label for="uid">User ID:</label>
			<input type="text" id="uid" name="uid" required>
			<label for="password">Password:</label>
			<input type="password" id="password" name="password" required>
			<input type="submit" value="Sign In">
		</form>
	</div>
</body>
</html>
