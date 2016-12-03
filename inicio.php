<script type="text/javascript" src="_js/jquery-1.7.2.js"></script>
     <script type="text/javascript">
	 
		velocidad = 4000;

		var capas_images = ["images/OGA1IP0.png", "images/redestouch.jpg", "images/orde.jpg"];
		imagen_actual = 0;

		function cortina(){
			var objeto =document.getElementById("imagen_cambiante");
			objeto.src = capas_images[imagen_actual];
			setTimeout("cortina()",velocidad)
			imagen_actual = (imagen_actual+1)%3;
		}

		window.onload = function()
		{
			cortina();
		}    
    </script>
    <div class="slider">
        <a name="inicio"></a>
        <section id="imgRandom">
            <img id="imagen_cambiante"/>				
        </section>
    </div>
    <div class="leyenda">
    </div>
    <div class="textoSliderTitulo">
        <h1 class="TituloSlider">Software Development</h1>
    </div>
    <div class="textoSliderCuerpo">
        <h4 class="TextoSlider">El futuro está en tus manos</h4>
    </div>
</section>