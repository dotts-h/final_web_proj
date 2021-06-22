<?php
if (isset($error)) :
	echo '<div class="errors">' . $error . '</div>';
endif;
?>

<form method="post" action="">
	<label for="email">Email</label>
	<input type="text" id="email" name="email">

	<label for="password">Password</label>
	<input type="password" name="password" id="password">

	<input type="submit" name="login" value="Log in">
</form>

<p>Don't have an account? <a href="/author/register">Click here to register an account</a></p>