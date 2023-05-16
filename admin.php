<!DOCTYPE html>
<html>
<head>
	<title>Display Data</title>
	<style>
		table {
			border-collapse: collapse;
			width: 100%;
		}
		th, td {
			text-align: left;
			padding: 8px;
			border: 1px solid black;
		}
		tr:nth-child(even) {
			background-color: #f2f2f2;
		}
	</style>
</head>
<body>
	<?php
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "petuser_data";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);

		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		// Execute the query and get the result only when the button is clicked
		if (isset($_POST['submit'])) {
			$sql = "SELECT id, uid, utype, password, pet FROM signup";
			$result = $conn->query($sql);
		}
	?>

	<!-- Button to display the data -->
	<form method="post">
		<input type="submit" name="submit" value="Display Data">
	</form>

	<!-- Display the data in a table -->
	<?php if (isset($_POST['submit']) && $result->num_rows > 0): ?>
		<table>
			<thead>
				<tr>
					<th>ID</th>
					<th>User ID</th>
					<th>User Type</th>
					<th>Password</th>
					 <th>Pet Type</th>
				</tr>
			</thead>
			<tbody>
				<?php while ($row = $result->fetch_assoc()): ?>
					<tr>
						<td><?php echo $row['id']; ?></td>
						<td><?php echo $row['uid']; ?></td>
						<td><?php echo $row['utype']; ?></td>
						<td><?php echo $row['password']; ?></td>
						<td><?php echo $row['pet']; ?></td>
					</tr>
				<?php endwhile; ?>
			</tbody>
		</table>
	<?php endif; ?>

	<?php
		// Close the database connection
		$conn->close();
	?>
</body>
</html>
