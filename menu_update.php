<?php
/* 
Inhalt von menu_update.php:
- User gelangt hierhin, wenn er bei menu-bearbeiten.php auf UPDATE geklickt hat
- Praktisch gleicher Aufbau wie menu.php (NEU: ID Definition des jeweiligen Eintrages)
- Verstecktes Input Element type="hidden" wird benötigt
*/
session_start();

// Diese Seite ist nur im EINGELOGGTEN ZUSTAND sichtbar!
if (!isset($_SESSION['useruid'])) {
  header("location: logreg.php");
  exit();
}

/* Session des jeweiligen Users anhand des Foreign Keys */
$adressId = $_SESSION['userid'];

/* UPDATEFILE */
require('prefs/credentials.php');
require('class/menu.class.php');
// Subklasse Menu ins Objekt $myInstance zwischenspeichern
$myInstance = new Menu ($host,$user,$passwd,$dbname);
// Instanzierung des Bauplans mit Lesemethode readMethod()
$recordArray = $myInstance -> readMethod($adressId);

/* DESIFINZIERUNGSMASSNAHME von INPUTFELDERN */
// Mehr zum Thema Sicherheit: https://werner-zenk.de/tipps/php_mit_sicherheit.php
// Strip_tags werden vor Ort angewendet = HTML-Tags herausfiltern
function desinfizierung($str) { // ($str) = Briefkasten, den wir mit einer auszuführenden Variable benennen
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

	<hr>
	<p class="explanation">
		<a href="menu.php" style="text-decoration: underline;">Adresse eintragen</a> | 
		<a href="menu_bearbeiten.php">Adressen bearbeiten</a>
	</p>
	<hr>
<?php
// Prüfen, ob der Submit-Button geklickt wurde:
if (isset($_POST['go'])) {
	
	$vornameValue = strip_tags(desinfizierung($_POST['vorname']));
  $nachnameValue = strip_tags(desinfizierung($_POST['nachname']));
  $strasseValue = strip_tags(desinfizierung($_POST['strasse']));
  $plzValue = strip_tags(desinfizierung($_POST['plz']));
  $ortValue = strip_tags(desinfizierung($_POST['ort']));
  $bemerkungenValue = strip_tags(desinfizierung($_POST['bemerkungen']));
	// 1) HIDDEN-ID Wert des hidden input feldes, um die jeweilige ID zu ermitteln
	$idValue = $_POST['id']; // Aus dem <input type="hidden"
	
	// 2) Instanzierung der Update-Methode:
	$myInstance -> updateMethod($idValue, $vornameValue,$nachnameValue,$strasseValue,$plzValue,$ortValue,$bemerkungenValue);
	
	echo "<div class=\"feedback_positiv\">";
	echo "Der Datensatz wurde gesichert.";
	echo "</div>\n";
	echo "</body>";
	echo "</html>";
	// Ausgabe beenden
	exit();
}
else {
	// Die ID kommt beim ersten Affenschwanz-Durchgang von read_erweitert.php als GET-Var
	if (!isset($_GET['id'])) {
		die("System kann User nicht finden!");
	}
	/* 
	Sicherheitsmassname mit htmlspecialchars(). Warum?
		- desinfizierung() optimal, allerdings wird darin FILTER_SANITIZE_STRING verwendet
		- Funktion gegeben, allerdings empfiehlt Inteliphense die Benutzung von htmlspecialchars()
	*/
	// GET-Parameter unbedingt schützen, da die ID in der URL angezeigt wird:
	$cleanID = filter_var(htmlspecialchars($_GET['id'])); 
	
	// Fülle die Variablen mit dem Resultat von der DB-Query
	$recordArray = $myInstance -> getSingleRecord($cleanID); // Methode aus der Menu-Klasse
	
	$vornameValue = $recordArray['vorname'];
	$nachnameValue = $recordArray['nachname'];
	$strasseValue = $recordArray['strasse'];
	$plzValue = $recordArray['plz'];
	$ortValue = $recordArray['ort'];
	$bemerkungenValue = $recordArray['bemerkungen'];
	// HIDDEN-ID Wert des hidden input feldes, um die jeweilige ID zu ermitteln
	$idValue = $cleanID;
}
?>

<?php 

// (#)

//strip_tags(); - Erste safetyform, um zu verhindern, dass man solchen Code einsetzen kann in Inputfelder:
$str = "<a href='test'>Test</a>";

echo strip_tags($str);

// Nur Zeichen, die von HTML "besetzt sind"
htmlspecialchars($str, ENT_QUOTES);

// Wirklich alle Entities:
htmlentities($str);

?>

	<form action="menu_update.php" method="post"> <!-- Da wir die "Action mit PHP" im selben File ausführen, kann action="" leergelassen werden -->
	<div>
			<label for="vorname">Vorname:</label><br>
			<input type="text" id="vorname" name="vorname" value="<?=$vornameValue?>">
    </div>
    <div>
      <label for="nachname">Nachname:</label><br>
			<input type="text" id="nachname" name="nachname" value="<?=$nachnameValue?>">
		</div>
		<br>

		<div>
			<label for="strasse">Strasse:</label><br>
			<input type="text" id="strasse" name="strasse" value="<?=$strasseValue?>">
		</div>
		<br>

		<div>
      <label for="plz">Postleitzahl:</label><br>
			<input type="text" pattern="[0-9]{4}" id="plz" name="plz" value="<?=$plzValue?>">
    </div>
    <div>
			<label for="ort">Ort:</label><br>
			<input type="text" id="ort" name="ort" value="<?=$ortValue?>">
		</div>
		<br>

		<div>
			<label for="bemerkungen">Bemerkungen:</label><br>
			<textarea id="bemerkungen" name="bemerkungen" cols="50" rows="6"><?=$bemerkungenValue?></textarea>
		</div>
		
		<input type="hidden" name="id" value="<?=$idValue?>"> <!-- VERSTECKTES FORMULARELEMENT -->
		<button type="submit" name="go">Datensatz speichern</button>
	</form>
	
<!---------- footer ----------------------------------------------------------------------------------------------------->
<?php
include('includes/html/footer.html.php');
?>
<!-----x---- footer ----x------------------------------------------------------------------------------------------------>
