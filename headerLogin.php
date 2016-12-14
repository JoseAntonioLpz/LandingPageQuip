<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles.css">
<meta charset="UTF-8">
<title>Developer Software</title>
</head>

<body>
    <div class="content_div">
        <section class="inicio">
            <header>
                <div class="logo"></div>
                <div class="textoLogo">Software Development</div>
                <div class="login">
					<?php 
						if(isset($_SESSION["user"])){
							$username = $_SESSION["user"];
					?>
						Hola <?php echo $username;?>
						<a href="logout.php" onmouseout="this.style.opacity=1;this.filters.alpha.opacity='100';" 
                         onmouseover="this.style.opacity=0.6;this.filters.alpha.opacity='20';">&nbspLog out</a>
					<?php
						}else{
					?>
						<a href="login.php" onmouseout="this.style.opacity=1;this.filters.alpha.opacity='100';" 
                         onmouseover="this.style.opacity=0.6;this.filters.alpha.opacity='20';">Log in</a>
					<?php
						}
					?>
                </div>
                <nav>
                    <a href="index.php#inicio" onmouseout="this.style.opacity=1;this.filters.alpha.opacity='100';" 
                         onmouseover="this.style.opacity=0.6;this.filters.alpha.opacity='20';">Inicio
                         </a>
                    <a href="index.php#quip" onmouseout="this.style.opacity=1;this.filters.alpha.opacity='100';" 
                         onmouseover="this.style.opacity=0.6;this.filters.alpha.opacity='20';">&nbspQuip</a>
                    <a href="index.php#productos" onmouseout="this.style.opacity=1;this.filters.alpha.opacity='100';" 
                         onmouseover="this.style.opacity=0.6;this.filters.alpha.opacity='20';">&nbspProductos</a>
                    <a href="index.php#equipo" onmouseout="this.style.opacity=1;this.filters.alpha.opacity='100';" 
                         onmouseover="this.style.opacity=0.6;this.filters.alpha.opacity='20';">&nbspEquipo</a>
                    
                </nav>
            </header>