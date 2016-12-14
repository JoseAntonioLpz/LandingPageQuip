<?php
	ob_start();
	require_once('headerLogin.php');
?>
<div id="content_div" class="content_div_register">
    <center><div class="register">
        <form action=<?php echo $_SERVER['PHP_SELF']; ?> method="post" enctype="multipart/form-data">
            <center><h2>Subscríbete</h2>
                Usuario
                <input type = "text" name = "username" maxlength = "10" value = "<?php if(isset($_POST['username'])) echo $_POST['username']?>"/>
                <br><br>Contraseña
                <input type = "password" name = "password" maxlength = "10" value = "<?php if(isset($_POST['password'])) echo $_POST['password']?>"/>
                <br><br>Confirma la contraseña
                <input type = "password" name = "pass_confirm" maxlength = "10" value = "<?php if(isset($_POST['pass_confirm'])) echo $_POST['pass_confirm']?>"/>
                <br><br>Nombre
                <input type = "text" name = "first_name" maxlength = "20" value = "<?php if(isset($_POST['first_name'])) echo $_POST['first_name']?>"/>
                <br><br>Apellidos
                <input type = "text" name = "last_name" maxlength = "20" value = "<?php if(isset($_POST['last_name'])) echo $_POST['last_name']?>"/>
                <br><br>Sexo&nbsp&nbsp
                <select name = "gender">
                  <option value="man">Hombre</option>
                  <option value="woman">Mujer</option>
                </select>
                <br><br>Teléfono
                <input type = "tel" name = "phone" value = "<?php if(isset($_POST['phone'])) echo $_POST['phone']?>"/>
                <br><br>E-mail
                <input type = "email" name = "email" value = "<?php if(isset($_POST['email'])) echo $_POST['email']?>"/>
                <p><input type="submit" value="Registrarse" name="submit"/></p></center>
        </form>
    </div></center>
</div>
<?php
	require_once('footer.php');
	require_once('connectvars.php');
	
	if(isset($_POST['submit'])){
		$cbd = mysqli_connect(SERVER, USER, PASS, DB);
		if($cbd){
			$username = mysqli_real_escape_string($cbd, trim($_POST['username']));
			$password = mysqli_real_escape_string($cbd, trim($_POST['password']));
			$pass_confirm = mysqli_real_escape_string($cbd, trim($_POST['pass_confirm']));
			$first_name = mysqli_real_escape_string($cbd, trim($_POST['first_name']));
			$last_name = mysqli_real_escape_string($cbd, trim($_POST['last_name']));
			$gender = mysqli_real_escape_string($cbd, trim($_POST['gender']));
			$phone = mysqli_real_escape_string($cbd, trim($_POST['phone']));
			$email = mysqli_real_escape_string($cbd, trim($_POST['email']));
			$user_table = USER_TABLE;
			
			if(is_valid($username) && !user_exist($cbd, $username, USER_TABLE) && pass_is_valid($password, $pass_confirm) && is_valid($first_name) && is_valid($email)){
				$password = md5($password);
				$query = "insert into $user_table (employee, datec, login, pass_crypted, gender, firstname, lastname, user_mobile, email, admin)
				values(0, NOW(), '$username', '$password', '$gender', '$first_name', '$last_name', $phone, '$email', 0)";
				if(mysqli_query($cbd, $query)){
					echo "<h2>Usuario registrado</h2>";
					header('location:index.php');
					exit();
				}else{
					echo "Error Code: ". mysqli_errno($cbd)."</br>";
					echo "Error Log: ". mysqli_error($cbd)."</br>";
				}
				mysqli_close($cbd);
			}else{
				echo '<div class="errores_formulario">';
				if(!is_valid($username)){
					echo "<p>Usuario vacío</p>";
				}
				if(user_exist($cbd, $username, USER_TABLE)){
					echo "<p>Este nombre de usuario no está disponible</p>";
				}
				if(!pass_is_valid($password, $pass_confirm)){
					echo "<p>Contraseña incorrecta</p>";
				}
				if(!is_valid($first_name)){
					echo "<p>Nombre vacío</p>";
				}
				if(!is_valid($email)){
					echo "<p>e-mail vacío</p>";
				}
				echo '</div>';
			}	
		}
	}
	
	function is_valid ($var) {
		return !$var == "";
	}
	
	function pass_is_valid($pass1, $pass2){
		return is_valid($pass1) && is_valid($pass2) && $pass1 == $pass2;
	}
	
	function user_exist($cbd, $username, $table){
		$query = mysqli_query($cbd, "select * from $table where login = '$username'");
		return mysqli_fetch_array($query);
	}
?>