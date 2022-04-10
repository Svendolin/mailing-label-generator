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

/* ERWEITERTES BEARBEITEFILE (Mit der Tabelle für Update und Delete) */
require('prefs/credentials.php');
require('class/menu.class.php');

/* DESIFINZIERUNGSMASSNAHME von INPUTFELDERN */
function desinfizierung($str) { // ($str) = Briefkasten, den wir mit einer auszuführenden Variable benennen
	$newStr = filter_var($str, FILTER_SANITIZE_STRING); // Statt wie zuvor ($_POST['nachname']); nach dem filter_var erwähnen wir eine zuvor definierte Variable $str, die für alles gilt und der desinfizierer FILTER_SANITIZE_STRING
	$trimmedStr = trim($newStr); // trim = Nimmt die Leerschläge vorne und hinten weg
	return $trimmedStr; // Aufrufende Funktion zurückführen. 
}


$myInstance = new Menu ($host,$user,$passwd,$dbname);
if (isset($_POST['go'])) {
	
	// 1) Wert holen
	$idValue = strip_tags(desinfizierung($_POST['go']));
	// 2) Delete Methode 
	$myInstance -> deleteMethod($idValue); 
}
// 3) Nach dem Delete folgt das obligatorische Lesen (read)
$recordArray = $myInstance -> readMethod(); // $recordArray nutzen wir für den Loop:
?>


<!---------- Header + Navigation ---------------------------------------------------------------------------------------->
<?php
include('includes/html/header.html.php');
?>
<!-----x---- Header + Navigation ----x----------------------------------------------------------------------------------->

<hr>
	<p class="explanation">
		<a href="menu.php">Adresse eintragen</a> | 
		<a href="menu_bearbeiten.php" style="text-decoration: underline;">Adressen bearbeiten</a>
	</p>
	<hr>
<?php
// print_r($recordArray);
?>
	
	<form action="menu_bearbeiten.php" method="post"> <!-- Da wir die "Action mit PHP" im selben File ausführen, kann action="" leergelassen werden -->
	<table class="explanation bordered">
	<?php foreach ($recordArray as $row): ?>
		<tr>
			<td><?=$row['vorname']?></td>
			<td><?=$row['nachname']?></td>
			<td><?=$row['strasse']?></td>
			<td><?=$row['plz']?></td>
			<td><?=$row['ort']?></td>

			<!-- UPDATE BUTTON (link) -->
			<td><button type="button"><a href="menu_update.php?id=<?=$row['ID']?>">Update</a></button><td>
			<!-- DELETE BUTTON -->
			<td><button type="submit" name="go" class="deleter" data-confirm="<?=$row['vorname']?> <?=$row['nachname']?>" value="<?=$row['ID']?>">Delete</button></td>
		</tr>
	<?php endforeach; ?>
	</table>
	</form>
	<script>
	// Javascript: Gebe Confirm-Fenster mit Hinweis aus
	// 1) DOM-Manipulation: Dadurch herausfinden, welche Buttons die Klasse Deleter haben = Nur unsere Deletebuttons somit (Siehe class="deleter")
	var deleteButtons = document.querySelectorAll('.deleter');

	// 2) Jeder Button erhält ein Eventlistener
	for (var i = 0; i < deleteButtons.length; i++) {
		deleteButtons[i].addEventListener('click', function(event) {
					// 3) confirm = Ein Modales Alertfenster, das aufploppt
					// Falls ok-klicken
      		var go = confirm('Möchten Sie die Adresse von ' + this.getAttribute('data-confirm') + ' wirklich löschen?\nDieser Vorgang ist unwiderruflich!'); //get-attribute aus dataconfirm des deleterbuttons Zeile 43
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
