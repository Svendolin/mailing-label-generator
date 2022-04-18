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

<div class="content">
	<div class="emptyspace">
		<img src="" alt="">
	</div>
	<div class="erklaerungsbereich">
		<a href="menu.php">Adresse eintragen</a>
		<a href="menu_bearbeiten.php">Adressen bearbeiten</a>
	</div>

	<div class="grid-container">
		<div class="grid-form">
			<form action="menu.php" method="post">
				<div class="title">
					<h1>Adresseingabe</h1>
				</div>
				<div class="user-details">
					<div class="input-box">
						<label for="vorname">Vorname:</label>
						<input type="text" id="vorname" name="vorname" placeholder="Max" value="<?= $vornameValue ?>" required>
					</div>

					<div class="input-box">
						<label for="nachname">Nachname:</label>
						<input type="text" id="nachname" name="nachname" placeholder="Mustermann" value="<?= $nachnameValue ?>" required>
					</div>

					<div class="input-box">
						<label for="strasse">Strasse:</label>
						<input type="text" id="strasse" name="strasse" placeholder="Musterstrasse 12" value="<?= $strasseValue ?>" required>
					</div>

					<div class="input-box">
						<label for="plz">Postleitzahl:</label>
						<input type="text" pattern="[0-9]{4}" id="plz" name="plz" placeholder="1212" value="<?= $plzValue ?>" required>
					</div>

					<div class="input-box">
						<label for="ort">Ort:</label>
						<input type="text" id="ort" name="ort" placeholder="Musterdorf" value="<?= $ortValue ?>" required>
					</div>

					<div class="input-box">
						<label for="bemerkungen">Bemerkungen:</label>
						<textarea id="bemerkungen" name="bemerkungen" cols="50" rows="6" placeholder="Wichtige Adresse!"><?= $bemerkungenValue ?></textarea>
					</div>
				</div>
				<div class="button-container">
					<button class="btn adresse" type="submit" name="go">Adresse speichern</button>
				</div>
			</form>
		</div>

		<!-- FORM-EINTRÄGE (Adressen) Aktueller Datensatz wird optisch-->
		<div class="grid-tabelle">
			<div class="title">
				<h1>Adressliste</h1>
			</div>
			<?php foreach ($recordArray as $row) : ?>
				<p class="explanation">
					<?= $row['vorname'] ?> <?= $row['nachname'] ?> (ID: <?= $row['ID'] ?>)<br>
					<?= $row['strasse'] ?> <?= $row['plz'] ?> <?= $row['ort'] ?><br>
					<!-- Ort: <=$row['ort']?><br> -->
				</p>
				<p class="explanation"><?= nl2br($row['bemerkungen']) ?></p> <!-- New line to break = nl2br = Neuer Zeilenumbruch darstellen -->

			<?php endforeach; ?>
		</div>
	</div>

	<div class="emptyspace-two"></div>

	<div class="grid-map-container">
		<div class="grid-map">
			<div class="title">
				<h1>Kartenübersicht</h1>
			</div>
			<div id="map"></div>
		</div>

		<div class="grid-geolocation">
			<div class="title">
				<h1>Ort lokalisieren</h1>
			</div>
			<form action="" id="location-form">
				<div class="local-box">
					<input type="text" id="location-input" class="form-control" placeholder="Nach was möchtest du suchen?"><br>
					<button type="submit" class="btn adresse" id="">Suchen</button>
				</div>
			</form>
			<div id="formatted-address"></div> <!-- Formatierte Adresse -->
			<div id="address-components"></div> <!-- Zugehörige Adresskomponenten (Infos) bei der Suche -->
			<div id="geometry"></div> <!-- Latitude und Longitude-Angabe -->
		</div>
	</div>







	<!---------- footer ----------------------------------------------------------------------------------------------------->
	<?php
	include('includes/html/footer.html.php');
	?>
	<!-----x---- footer ----x------------------------------------------------------------------------------------------------>