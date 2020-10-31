<?php
session_start();
include "config.php";
$message = "";
if (isset($_POST['submit'])) {

	$email = isset($_POST['email']) ? $_POST['email'] : '';
	$password = isset($_POST['password']) ? $_POST['password'] : '';

	$sql = "SELECT * from user WHERE email='$email' AND pass='$password'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {

		$row = $result->fetch_assoc();
		$_SESSION['user'] = $row['name'];
		$_SESSION['email'] = $row['email'];
		$_SESSION['answer'] = array();
		if ($row['role'] == 'admin') {
			header('Location: admin/admin.php');
		} else if ($row['role'] == 'user') {
			header('Location: users/showtest.php');
		}
	} else {
		$message = "Invalid Username or Password";
	}

	$conn->close();
}
?>
<?php include("header.php"); ?>
<div id="wrapper">
	<div id="message"><?php echo $message; ?></div>

	<div id="login-form">
		<h2>Login</h2>
		<form action="" method="POST">
			<p>
				<label for="email">Email: <input type="text" name="email" placeholder="Enter Email" required></label>
			</p>
			<p>
				<label for="password">Password: <input type="password" name="password" placeholder="Enter Password" required></label>
			</p>
			<p>
				<input type="submit" name="submit" value="Submit" id="submit">
			</p>
		</form>
		<span>Don't have account?<a id="signup" href="register.php">SignUp Here</a>
	</div>

</div>
<?php include("footer.php"); ?>