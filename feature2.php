<?php

include_once(__DIR__ . '/classes/User.php');
include_once(__DIR__ . '/classes/Db.php');

$block = "";
$disable = "";
// $force = "";

if (!empty($_POST)) {

	$user = new User();
	$email = $_POST['email'];
	$password = $_POST['password'];


	if (!empty($email) && !empty($password)) {
		if ($user->canLogin($email, $password) != true) {
			if (isset($_COOKIE['login-form'])) {
				if ($_COOKIE['login-form'] < 3) {
					$attempts = $_COOKIE['login-form'] + 1;
					setcookie('login-form', $attempts, time() + 60); // cookie 60 seconden met aantal pogingen
					sleep(1);
				} else {
					$block = 'Te veel foute invoerpogingen, gelieve 1minuut te wachten.';
					$disable = 'disabled';
				}
			} else {
				setcookie('login-form', 1, time() + 60); // cookie 60 seconden met waarde 1
			}
		}
		if ($user->canLogin($email, $password)) {
			if($user->isActivateAccount($email)){
				//$user->setEmail($email);
				//$user->setPassword($password);
				session_start();

				$_SESSION['user'] = $email;
				$user->setEmail($_SESSION['user']);
				$databaseId = $user->getDatabaseId();
				$user->setId($databaseId['id']);

				$getAllUser = $user->getAll();
				$games = $getAllUser['games'];
				$films = $getAllUser['films'];
				$location = $getAllUser['location'];
				$music = $getAllUser['music'];
				$books = $getAllUser['books'];
				var_dump($books);

				if (is_null($games) && is_null($books) && is_null($music) && is_null($location) && is_null($films)) {
					header("Location: feature4.php");
				} else {
					header("Location: sortBuddy.php");
				}
			} else{
				$error = "Your account has not been activated yet";
			}
		} else {
			$error = "Email and password don't match";
		}
	} else {
		$error = "Email and password don't match";
	}
} else {

	$error = "Email and password are required";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/login.css">
	<title>Document</title>
</head>

<body class="container-fluid bg-secondary">
	<fieldset class="fs" <?php echo $disable ?>>
	<img src="img/Logo.png" alt="weareimd" class="col-lg-6 col-md-6 d-none d-md-block" id="login-img">
		<div class="row">
			
			<form class="col-lg-6 col-md-6" id="login-form" action="" method="post">
				<h2 form__title>Sign up</h2>
				<?php if (isset($error)) : ?>
					<p>
						<?php echo $error; ?>
					</p>
				<?php endif; ?>
				<label for="email">Email</label>
				<input class="form-control" type="text" id="email" name="email">
				<label for="password">Password</label>
				<input class="form-control" type="password" id="password" name="password">
				<h5><?php echo $block ?></h5>
				<input class="buttton" type="submit" $disable value="Log in">
				<a href="register.php" class="mt-3 mb-3 btn btn-primary" type="submit" value="Log in">Register</a>


		</div>
	</fieldset>
</body>

</html>