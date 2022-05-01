<?php
/* 
Inhalt von menu_bearbeiten.php:
- Adressübersicht der einzelnen Elemente MIT UPDATE-Button und DELETE-Button
- Delete wird den User vorher mit einem Alert benachrichtigen
*/
session_start();

// Diese Seite ist nur im EINGELOGGTEN ZUSTAND sichtbar!
if (!isset($_SESSION['useruid'])) {
	header("location: logreg.php");
	exit();
}

// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';

$adressId = $_SESSION['userid'];
// echo $userId;

/* ERWEITERTES BEARBEITEFILE (Mit der Tabelle für Update und Delete) */
require('prefs/credentials.php');
require('class/menu.class.php');

/* DESIFINZIERUNGSMASSNAHME von INPUTFELDERN */
function desinfizierung($str)
{ // ($str) = Briefkasten, den wir mit einer auszuführenden Variable benennen
	$newStr = filter_var($str, FILTER_SANITIZE_STRING); // Statt wie zuvor ($_POST['nachname']); nach dem filter_var erwähnen wir eine zuvor definierte Variable $str, die für alles gilt und der desinfizierer FILTER_SANITIZE_STRING
	$trimmedStr = trim($newStr); // trim = Nimmt die Leerschläge vorne und hinten weg
	return $trimmedStr; // Aufrufende Funktion zurückführen. 
}


$myInstance = new Menu($host, $user, $passwd, $dbname);
if (isset($_POST['go'])) {

	// 1) Wert holen
	$idValue = strip_tags(desinfizierung($_POST['go']));
	// 2) Delete Methode 
	$myInstance->deleteMethod($idValue);
}
// 3) Nach dem Delete folgt das obligatorische Lesen (read)
$recordArray = $myInstance->readMethod($adressId); // $recordArray nutzen wir für den Loop:
?>


<!---------- Header + Navigation ---------------------------------------------------------------------------------------->
<?php
include('includes/html/header.html.php');
?>
<!-----x---- Header + Navigation ----x----------------------------------------------------------------------------------->

<div class="emptyspace">
	<div class="image-container">
		<img src="images/menu-bearbeiten-logo.jpg" alt="Menu Logo" height="140px">
	</div>
</div>
<div class="erklaerungsbereich">
	<a href="menu.php">Adresse eintragen</a>
	<a href="menu_bearbeiten.php">Adressen bearbeiten</a>
</div>
<?php
// print_r($recordArray);
?>

<div class="flex-box">
	<div class="grid-tabelle bearbeiten">
		<div class="title">
			<h1>Adressliste</h1>
		</div>
		<!-- Tabelle einbauen -->
		<form action="menu_bearbeiten.php" method="post">
			<table class="table">
				<thead>
					<tr>
						<th>ID</th>
						<th>Vorname / Nachname</th>
						<th>Strasse</th>
						<th>PLZ / Ort</th>
						<th>Bemerkung</th>
						<th>Adresse Anpassen</th>
						<th>Adresse Löschen</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($recordArray as $row) : ?>
						<tr>
							<td data-label="ID"><?= $row['ID'] ?></td>
							<td data-label="Vorname / Nachname"><?= $row['vorname'] ?> <?= $row['nachname'] ?></td>
							<td data-label="Strasse"><?= $row['strasse'] ?></td>
							<td data-label="PLZ / Ort"><?= $row['plz'] ?> <?= $row['ort'] ?></td>
							<td data-label="Bemerkung"><?= $row['bemerkungen'] ?></td>
							<td data-label="Anpassen"><a href="menu_update.php?id=<?= $row['ID'] ?>"><button class="updater" type="button">Anpassen</button></a></td>
							<td data-label="Löschen"><button type="submit" name="go" class="deleter" data-confirm="<?= $row['vorname'] ?> <?= $row['nachname'] ?>" value="<?= $row['ID'] ?>">Löschen</button></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</form>
	</div>
</div>

<script>
	// Javascript: Gebe Confirm-Fenster mit Hinweis aus
	// 1) DOM-Manipulation: Dadurch herausfinden, welche Buttons die Klasse Deleter haben = Nur unsere Deletebuttons somit (Siehe class="deleter")
	let deleteButtons = document.querySelectorAll('.deleter');

	// 2) Jeder Button erhält ein Eventlistener
	for (let i = 0; i < deleteButtons.length; i++) {
		deleteButtons[i].addEventListener('click', function(event) {
			// 3) confirm = Ein Modales Alertfenster, das aufploppt
			// Falls ok-klicken
			let go = confirm('Möchten Sie die Adresse von ' + this.getAttribute('data-confirm') + ' wirklich löschen?\nDieser Vorgang ist unwiderruflich!'); //get-attribute aus dataconfirm des deleterbuttons Zeile 43
			// Falls abbrechen-klicken
			if (go == false) {
				event.preventDefault();
			}
		});
	}
</script>

<!---------- footer ----------------------------------------------------------------------------------------------------->
<?php
include('includes/html/footer.html.php');
?>
<!-----x---- footer ----x------------------------------------------------------------------------------------------------>