<?php
// Session
session_start();
?>

<!---------- Header + Navigation ---------------------------------------------------------------------------------------->
<?php
include('includes/html/header.html.php');
?>
<!-----x---- Header + Navigation ----x----------------------------------------------------------------------------------->

<main>
	<div class="emptyspace">
		<div class="image-container">
			<img src="images/index-logo.jpg" alt="Menu Logo" height="140px">
		</div>
	</div>


	<div class="erklaerungsbereich index">
		<div class="title">
			<p><i class="fa-solid fa-money-check"></i>&nbsp;&nbsp;Wählen Sie Ihr Lieblings-Ettikettendesign aus unzähligen Motiven für Ihren nächsten Paketversand.</p>
			<p><i class="fa-solid fa-address-book"></i>&nbsp;&nbsp;Führen Sie Ihr eigenes digitales Adressbuch indem Sie sich hier kostenlos registrieren.</p>
			<p><i class="fa-solid fa-file-circle-check"></i>&nbsp;&nbsp;Unsere Ettiketten sind bei allen schweizer Poststellen anerkannt und zugelassen.</p>
		</div>
	</div>


	<section class="swiperstuff">
		<div class="swiper mySwiper">
			<div class="swiper-wrapper">
				<!-- FOLIE 1 - 13 -->

				<!-- INCLUDE zu unseren 13 Folien des Sliders -->
				<?php
				include('includes/html/ettiketten.html.php');
				?>
				
			</div>
			<div class="swiper-button-next"></div>
			<div class="swiper-button-prev"></div>
			<div class="swiper-pagination"></div>
		</div>
	</section>

	<!-- Inhalt für den PDF-TEIL TODO: Spätere Anpassungen machen -->
	<section class="underConstruction">
		<img src="images/supercute.jpg" alt="supercutekitten">
		<h2>I'm purrently under construction for later. Sorry :3</h2>
	</section>

	
	<!-- Inhalt für den mobilen Bereich unter 600px Breite -->
	<div class="content mobile">
		<div class="forMobileAlert">
			<div class="title">
				<h1>Wichtige Information</h1>
			</div>
			<br>
			<h2>Geschätzte Kundinnen und Kunden:</h2>
			<div class="begleittext">
				<p>Die Anwendung des Ettikators steht für mobile Geräte
					nicht zur Verfügung! Sie können sich dennoch anmelden
					und Adressen speichern. Nutzen Sie die Desktop Ansicht
					auf Ihrem Computer, um Etiketten ausfüllen und ausdrucken
					zu können!
				</p>
				<br>
				<h3>Besten Dank!</h3>
			</div>
		</div>
	</div>

</main>



<!---------- footer ----------------------------------------------------------------------------------------------------->
<?php
include('includes/html/footer.html.php');
?>
<!-----x---- footer ----x------------------------------------------------------------------------------------------------>