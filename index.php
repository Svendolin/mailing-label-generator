<?php
// TODO: require_once für alles Notwendige

// TODO: Session
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