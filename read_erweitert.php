<?php
// Adresseingaben und Adressliste sowie GOOGLE MAPS API Zugang
session_start();

// Diese Seite ist nur im EINGELOGGTEN ZUSTAND sichtbar!
if (!isset($_SESSION['useruid'])) {
  header("location: logreg.php");
  exit();
}

/* ERWEITERTES LESEFILE (Mit der Tabelle für Update und Delete) */
require('prefs/credentials.php');
require('class/menu.class.php');
$myInstance = new SimpleCRUD($host,$user,$passwd,$dbname);
if (isset($_POST['go'])) {
	// Hier müssten unbedingt Sicherheitsvorkehrungen getroffen werden...
	$idValue = $_POST['go']; // 1) Wert holen
	$myInstance -> deleteMethod($idValue); // 2) Delete Methode 
}

$recordArray = $myInstance -> readMethod();
?>


<!---------- Header + Navigation ---------------------------------------------------------------------------------------->
<?php
include('includes/html/header.html.php');
?>
<!-----x---- Header + Navigation ----x----------------------------------------------------------------------------------->

<hr>
	<p class="explanation">
		<a href="menu.php"><strong>C</strong>reate</a> | 
		<a href="read_erweitert.php" style="text-decoration: underline;">Read erweitert</a>
	</p>
	<hr>
<?php
// print_r($recordArray);
?>
	
	<form action="read_erweitert.php" method="post">
	<table class="explanation bordered">
	<?php foreach ($recordArray as $row): ?>
		<tr>
			<td><?=$row['vorname']?></td>
			<td><?=$row['nachname']?></td>
			<td><?=$row['email']?></td>
			<!-- GET-parameter = Klick zum Update erhält die URL die ID, um exakt diesen Beitrag bearbeiten zu können -->
			<!-- UPDATE BUTTON (link) -->
			<td><a href="update.php?id=<?=$row['ID']?>"><strong>U</strong>pdate</a></td>
			<!-- DELETE BUTTON -->
			<td><button type="submit" name="go" class="deleter" data-confirm="<?=$row['vorname']?> <?=$row['nachname']?>" value="<?=$row['ID']?>"><strong>D</strong>elete</button></td>
		
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
      		var go = confirm('Willst du ' + this.getAttribute('data-confirm') + ' wirklich löschen?\nDieser Vorgang ist unwiderruflich!'); //get-attribute aus dataconfirm des deleterbuttons Zeile 43
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
