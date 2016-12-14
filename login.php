<?php
	ob_start();
    require_once('headerLogin.php');
?>
<div id="content_div" class="content_div">
	<form action=<?php echo $_SERVER['PHP_SELF']; ?> method="post" enctype="multipart/form-data">
        <br><br>
		<center><h2>Login</h2>
		<div id="div_center" class="login_div">
			<p>Usuario</p>
			<input type = "text" name = "username" value = "<?php if(isset($_POST['username'])) echo $_POST['username']?>"/>
			<p>Contraseña</p>
			<input type = "password" name = "password" value = "<?php if(isset($_POST['password'])) echo $_POST['password']?>"/>
			<p><input type="submit" value="Connect" name="submit"/> <a href="register.php" class="signin" style="color:#009688;">&nbsp&nbspSign in</a></p>
		</div></center>
	</form>
</div>
<?php
	require_once('footer.php');
	require_once('connectvars.php');
	
	if(isset($_POST['submit'])){
		$cbd = mysqli_connect(SERVER, USER, PASS, DB);
		if($cbd){
			$username = mysqli_real_escape_string($cbd, trim($_POST['username']));
			$password = md5(mysqli_real_escape_string($cbd, trim($_POST['password'])));
			
			if(is_valid($username) && is_valid($password) && check_user_password($cbd, USER_TABLE, $username, $password)){
				$_SESSION["user"] = $username;
				$_SESSION["password"] = $password;
				
				mysqli_close($cbd);
				header('location:index.php');
				exit();
			}else{
				echo '<div class="errores_formulario">';
				if(!is_valid($username)){
					echo "<p>Usuario vacío</p>";
				}
				if(!is_valid($password)){
					echo "<p>Contraseña vacía</p>";
				}
				if(!check_user_password($cbd, USER_TABLE, $username, $password)){
					echo "<p>Usuario o contraseña incorrecta</p>";
				}
				echo '</div>';
			}	
		}
	}
	
	function is_valid ( $var ) {
		return !$var == "";
	}
	
	function check_user_password($cbd, $table, $username, $password){
		$query = mysqli_query($cbd, "select * from $table where login = '$username' and pass_crypted = '$password'");
		return mysqli_fetch_array($query);
	}
?>