<?php
// Adresseingaben und Adressliste sowie GOOGLE MAPS API Zugang
session_start();

// Diese Seite ist nur im EINGELOGGTEN ZUSTAND sichtbar!
if (!isset($_SESSION['useruid'])) {
  header("location: logreg.php");
  exit();
}

/* LESEFILE = READ */
require('prefs/credentials.php');
require('class/menu.class.php');
// Instanz der Subklasse
$myInstance = new SimpleCRUD($host,$user,$passwd,$dbname);
// INstanz 
$recordArray = $myInstance -> readMethod();

?>

<!---------- Header + Navigation ---------------------------------------------------------------------------------------->
<?php
include('includes/html/header.html.php');
?>
<!-----x---- Header + Navigation ----x----------------------------------------------------------------------------------->

	<hr>
	<p class="explanation">
		<a href="menu.php" style="text-decoration: underline;"><strong>C</strong>reate</a> | 
		<a href="read_erweitert.php">Read erweitert</a>
	</p>
	<hr>
<?php
// Checke, ob der Submit-Button geklickt wurde
if (isset($_POST['go'])) {
	// ja
	// Hier müssten unbedingt Sicherheitsvorkehrungen getroffen werden...
	$vornameValue = $_POST['vorname'];
	$nachnameValue = $_POST['nachname'];
	$emailAdresseValue = $_POST['emailAdresse'];
	// $ortValue = $_POST['ort'];
	$bemerkungenValue = $_POST['bemerkungen'];
	// HIDDEN-ID Wert des hidden input feldes, um die jeweilige ID zu ermitteln
	$idValue = $_POST['id']; 
	
	$myInstance -> updateMethod($idValue, $vornameValue,$nachnameValue,$emailAdresseValue,$bemerkungenValue);
	
	echo "<div class=\"feedback_positiv\">";
	echo "Der Datensatz wurde gesichert.";
	echo "</div>\n";
	echo "</body>";
	echo "</html>";
	// Ausgabe beenden
	exit();
}
else {
	// nein
	// Die ID kommt beim ersten Affenschwanz-Durchgang von read_erweitert.php als GET-Var
	if (!isset($_GET['id'])) {
		die("Weiss nicht, welchen User ich bearbeiten soll");
	}
	// Sicherheitsmassname
	$cleanID = filter_var(htmlspecialchars($_GET['id'])); // WARUM? Siehe hier: (#)
	
	// Fülle die Variablen mit dem Resultat von der DB-Query
	$recordArray = $myInstance -> getSingleRecord($cleanID); // Method aus der Superklasse
	
	$vornameValue = $recordArray['vorname'];
	$nachnameValue = $recordArray['nachname'];
	$emailAdresseValue = $recordArray['email'];
	// $ortValue = $recordArray['ort'];
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

	<form action="update.php" method="post">
		<div>
			<label for="vorname">Vorname:</label><br>
			<input type="text" id="vorname" name="vorname" value="<?=$vornameValue?>">
		</div>
		<br>
		<div>
			<label for="nachname">Nachname:</label><br>
			<input type="text" id="nachname" name="nachname" value="<?=$nachnameValue?>">
		</div>
		<br>
		<div>
			<label for="emailAdresse">E-Mail-Adresse:</label><br>
			<input type="email" id="emailAdresse" name="emailAdresse" value="<?=$emailAdresseValue?>">
		</div>
		<br>
		<div>
		<!-- <div>
			<label for="ort">Ort:</label><br>
			<input type="text" id="ort" name="ort" value="<=$ortValue?>">
		</div>
		<br> -->
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
