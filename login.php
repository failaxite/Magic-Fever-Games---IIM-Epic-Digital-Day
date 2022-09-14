<?php 
ob_start();
include('header.php');
include_once("db_connect.php");
session_start();
if(isset($_SESSION['user_id'])!="") {
	header("Location: index.php");
}
if (isset($_POST['login'])) {
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	$result = mysqli_query($conn, "SELECT * FROM users WHERE email = '" . $email. "' and pass = '" . md5($password). "'");
	if ($row = mysqli_fetch_array($result)) {
		$_SESSION['user_id'] = $row['uid'];
		$_SESSION['user_name'] = $row['user'];		
		header("Location: index.php");
	} else {
		$error_message = "Incorrect Email or Password!!!";
	}
}
?>
<title>MagicFeverGames - Se Connecter</title>
<script type="text/javascript" src="script/ajax.js"></script>
<?php include('../container.php');?>

<div class="container">
	<h2>Magic Fever Games</h2>		
	<div class="row">
		<div class="col-md-4 col-md-offset-4 well">
			<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="loginform">
				<fieldset>
					<legend>Se Connecter</legend>						
					<div class="form-group">
						<label for="name">Email</label>
						<input type="text" name="email" placeholder="Votre Email" required class="form-control" />
					</div>	
					<div class="form-group">
						<label for="name">Mot De Passe</label>
						<input type="password" name="password" placeholder="Votre Mot De Passe" required class="form-control" />
					</div>	
					<div class="form-group">
						<input type="submit" name="login" value="Connexion" class="btn btn-primary" />
					</div>
				</fieldset>
			</form>
			<span class="text-danger"><?php if (isset($error_message)) { echo $error_message; } ?></span>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 col-md-offset-4 text-center">	
		Nouveau? <a href="register.php">S'inscrire</a>
		</div>
	</div>
		
</div>
<?php include('footer.php');?> 