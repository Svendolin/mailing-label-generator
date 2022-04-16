<?php
/* 
Inhalt von menu.php:
- (Adressübersicht) Formular zur Adresseingabe
- Adressübersicht der Einträge
*/


// TODO: Adresseingaben und Adressliste sowie GOOGLE MAPS API Zugang
session_start();

// Diese Seite ist nur im EINGELOGGTEN ZUSTAND sichtbar!
// (Wenn der User NICHT eingeloggt ist: schmeisse ihn raus!)
if (!isset($_SESSION['useruid'])) {
	header("location: logreg.php");
	exit();
}



// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';

$adressId = $_SESSION['userid']; // FIXME: auch hier, warum userid und nicht adressid?
// echo $userId;

/* LESEFILE = READ */
require('prefs/credentials.php');
require('class/menu.class.php');
// Subklasse Menu ins Objekt $myInstance zwischenspeichern
$myInstance = new Menu($host, $user, $passwd, $dbname);
// Instanzierung des Bauplans mit Lesemethode readMethod()
$recordArray = $myInstance->readMethod($adressId); // TODO: Neu: $userId definiert in menu.class.php als Foreign Key


/* DESIFINZIERUNGSMASSNAHME von INPUTFELDERN */
// Mehr zum Thema Sicherheit: https://werner-zenk.de/tipps/php_mit_sicherheit.php
// Strip_tags werden vor Ort angewendet = HTML-Tags herausfiltern
function desinfizierung($str)
{ // ($str) = Briefkasten, den wir mit einer auszuführenden Variable benennen
	// PHP-Filter wird eingesetzt
	$newStr = filter_var($str, FILTER_SANITIZE_STRING); // Statt wie zuvor ($_POST['nachname']); nach dem filter_var erwähnen wir eine zuvor definierte Variable $str, die für alles gilt und der desinfizierer FILTER_SANITIZE_STRING
	$trimmedStr = trim($newStr); // trim = Nimmt die Leerschläge vorne und hinten weg
	return $trimmedStr; // Aufrufende Funktion zurückführen. 
}

?>

<!---------- Header + Navigation ---------------------------------------------------------------------------------------->
<?php
include('includes/html/header.html.php');
?>
<!-----x---- Header + Navigation ----x----------------------------------------------------------------------------------->


<?php

// Prüfen, ob der Submit-Button geklickt wurde:
if (isset($_POST['go'])) {

	$idValue = $_SESSION['userid']; // FIXME: Warum hier userid und nicht adressid z.B
	$vornameValue = strip_tags(desinfizierung($_POST['vorname']));
	$nachnameValue = strip_tags(desinfizierung($_POST['nachname']));
	$strasseValue = strip_tags(desinfizierung($_POST['strasse']));
	$plzValue = strip_tags(desinfizierung($_POST['plz']));
	$ortValue = strip_tags(desinfizierung($_POST['ort']));
	$bemerkungenValue = strip_tags(desinfizierung($_POST['bemerkungen']));


	// Methode aufrufen, createMethod(sowie die passenden Variablen aus $query)
	$lastID = $myInstance->createMethod($idValue, $vornameValue, $nachnameValue, $strasseValue, $plzValue, $ortValue, $bemerkungenValue);

	// TODO: Errorhandling
	echo '<div class="feedback_positiv">';
	echo 'Der Datensatz wurde aufgenommen. Die ID des eingefügten Datensatzes ist ' . $lastID;
	echo '</div>';
} else {
	// nein, setzte die Variablen leer, damit beim ersten Affenschwanz-Durchgang kein Fehler generiert wird
	$idValue = "";
	$vornameValue = "";
	$nachnameValue = "";
	$strasseValue = "";
	$plzValue = "";
	$ortValue = "";
	$bemerkungenValue = "";
}
?>

<hr>
<p class="explanation">
	<a href="menu.php">Adresse eintragen</a> |
	<a href="menu_bearbeiten.php">Adressen bearbeiten</a>
</p>
<hr>

<form action="menu.php" method="post">
	<div>
		<label for="vorname">Vorname:</label><br>
		<input type="text" id="vorname" name="vorname" value="<?= $vornameValue ?>">
	</div>
	<div>
		<label for="nachname">Nachname:</label><br>
		<input type="text" id="nachname" name="nachname" value="<?= $nachnameValue ?>">
	</div>
	<br>

	<div>
		<label for="strasse">Strasse:</label><br>
		<input type="text" id="strasse" name="strasse" value="<?= $strasseValue ?>">
	</div>
	<br>

	<div>
		<label for="plz">Postleitzahl:</label><br>
		<input type="text" pattern="[0-9]{4}" id="plz" name="plz" value="<?= $plzValue ?>">
	</div>
	<div>
		<label for="ort">Ort:</label><br>
		<input type="text" id="ort" name="ort" value="<?= $ortValue ?>">
	</div>
	<br>

	<div>
		<label for="bemerkungen">Bemerkungen:</label><br>
		<textarea id="bemerkungen" name="bemerkungen" cols="50" rows="6"><?= $bemerkungenValue ?></textarea>
	</div>
	<button type="submit" name="go">Datensatz speichern</button>
</form>

<!-- FORM-EINTRÄGE (Adressen) Aktueller Datensatz wird optisch-->
<?php foreach ($recordArray as $row) : ?>
	<p class="explanation">
		<?= $row['vorname'] ?> <?= $row['nachname'] ?> (ID: <?= $row['ID'] ?>)<br>
		<?= $row['strasse'] ?> <?= $row['plz'] ?> <?= $row['ort'] ?><br>
		<!-- Ort: <=$row['ort']?><br> -->
	</p>
	<p class="explanation"><?= nl2br($row['bemerkungen']) ?></p> <!-- New line to break = nl2br = Neuer Zeilenumbruch darstellen -->
	<hr>
<?php endforeach; ?>

<section class="gmaps">
	<p>My Google Map:</p>
	<div id="map"></div>

	<div class="map-container">
		<h2 id="text-center">Enter Location</h2>
		<form action="" id="location-form">
			<input type="text" id="location-input" class="form-control"><br>
			<button type="submit" class="btn btn-primary" id="">Submit</button>
		</form>
		<div id="formatted-address"></div> <!-- Formatierte Adresse -->
		<div id="address-components"></div> <!-- Zugehörige Adresskomponenten (Infos) bei der Suche -->
		<div id="geometry"></div> <!-- Latitude und Longitude-Angabe -->
	</div>

</section>


<!---------- footer ----------------------------------------------------------------------------------------------------->
<?php
include('includes/html/footer.html.php');
?>
<!-----x---- footer ----x------------------------------------------------------------------------------------------------>