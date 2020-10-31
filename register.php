<?php
include "config.php";
$errors = array();
$message = "";
if (isset($_POST['submit'])) {

	$username = isset($_POST['username']) ? $_POST['username'] : '';
	$password = isset($_POST['password']) ? $_POST['password'] : '';
	$password2 = isset($_POST['password2']) ? $_POST['password2'] : '';
	$email = isset($_POST['email']) ? $_POST['email'] : '';
	$gender = isset($_POST['gender']) ? $_POST['gender'] : '';
	$age = isset($_POST['age']) ? $_POST['age'] : '';
	$mob = isset($_POST['mob']) ? $_POST['mob'] : '';
	$role = "user";

	if ($password != $password2) {
		$errors[] = array('input' => 'password', 'msg' => 'Password does not match.');
	}

	if (sizeof($errors) == 0) {
		$sql = "SELECT * from user WHERE username='$username' OR email='$email'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			$errors[] = array('input' => 'result', 'msg' => 'Username or Email already exist');
		}
	}

	if (sizeof($errors) == 0) {
		$sql = "INSERT INTO user (name, pass,email, gender,age, mob, role) VALUES('$username','$password','$email','$gender',$age,$mob,'$role')";
		if ($conn->query($sql) === true) {

			header('Location:index.php');
		} else {
			$errors[] = array('input' => 'form', 'msg' => $conn->error);
		}
		$conn->close();
	}
}
?>
<?php include("header.php"); ?>
<div id="wrapper">
	<div id="message"><?php echo $message; ?></div>
	<div id="errors">
		<?php if (sizeof($errors) > 0) : ?>
			<ul>
				<?php foreach ($errors as $key) : ?>
					<li><?php echo $key['msg'] ?></li>
				<?php endforeach ?>
			</ul>
		<?php endif ?>
	</div>
	<div id="signup-form">
		<h2>Sign Up</h2>
		<form action="register.php" method="POST">
			<p>
				<label for="username">Name: <input type="text" name="username" required></label>
			</p>
			<p>
				<label for="email">Email: <input type="email" name="email" required></label>
			</p>

			<p>
				<label for="gender">Gender:

					<input type="radio" id="male" name="gender" value="male"> <label for="male">Male</label>

					<input type="radio" id="female" name="gender" value="female"> <label for="female">Female</label>

					<input type="radio" id="other" name="gender" value="other"><label for="other">Other</label>

				</label>
			</p>
			<p>
				<label for="age">Age: <input type="number" name="age" required></label>
			</p>
			<p>
				<label for="mob">Mobile No: <input type="number" name="mob"></label>
			</p>
			<p>
				<label for="password">Password: <input type="password" name="password" required></label>
			</p>
			<p>
				<label for="password2">Re-Password: <input type="password" name="password2" required></label>
			</p>

			<p>
				<input type="submit" name="submit" value="Submit" id="submit">
			</p>
		</form>
		<span>Already have account?</span> <a id="login" href="index.php">Login Here</a>
	</div>
</div>
<?php include("footer.php"); ?>