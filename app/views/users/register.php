<?php
	require APP_ROOT . '/views/inc/head.php';
?>

<div class="navbar">
	<?php
		require APP_ROOT . '/views/inc/nav.php';
	?>
</div>

<div class="container-login">
	<div class="wrapper-login">
		<h2>Register</h2>
		
		<form
			id="register-form"
			method="POST"
			action="<?php echo URL_ROOT; ?>/users/register"
		>
			<input type="text" placeholder="Username *" name="username">
			<span class="invalidFeedback">
                <?php echo $data['usernameError']; ?>
            </span>

            <input type="text" placeholder="Nom *" name="nom">
            <span class="invalidFeedback">
                <?php echo $data['nomError']; ?>
            </span>

            <input type="text" placeholder="Prénom *" name="prenom">
            <span class="invalidFeedback">
                <?php echo $data['prenomError']; ?>
            </span>

            <input type="text" placeholder="Adresse *" name="adresse">
            <span class="invalidFeedback">
                <?php echo $data['adresseError']; ?>
            </span>

            <input type="text" placeholder="Code Postal *" name="code_postal">
            <span class="invalidFeedback">
                <?php echo $data['code_postalError']; ?>
            </span>
			
			<input type="email" placeholder="Email *" name="email">
			<span class="invalidFeedback">
                <?php echo $data['emailError']; ?>
            </span>
			
			<input type="password" placeholder="Password *" name="password">
			<span class="invalidFeedback">
                <?php echo $data['passwordError']; ?>
            </span>
			
			<input type="password" placeholder="Confirm Password *" name="confirmPassword">
			<span class="invalidFeedback">
                <?php echo $data['confirmPasswordError']; ?>
            </span>
			
			<button id="submit" type="submit" value="submit">Submit</button>
			
			<p class="options">Not registered yet? <a href="<?php echo URL_ROOT; ?>/users/register">Create an account!</a></p>
		</form>
	</div>
</div>
