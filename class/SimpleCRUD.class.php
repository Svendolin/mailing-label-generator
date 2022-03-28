<?php
// Die Klasse erbt von der Superklasse PDO
class SimpleCRUD extends PDO {
	
	// Konstruktormethode: Stelle die Verbindung zur DB her
    public function __construct($host, $user, $passwd, $dbname) {
    	$dsn = 'mysql:host=' . $host . ';dbname=' . $dbname .';charset=utf8';
    	
        // Array für Optionen für PDO anlegen
        $options = array(
        	// Wir wollen in der Testphase wissen, ob es Fehler gibt.
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            // Mit dieser Option werden die Resultate in Form von assoziativen Arrays retour kommen.
            // In den meisten Fällen ist das der effizienteste Weg, die Resultate in HTML auszugeben ...
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );
        try {
        	// Konstruktor der PDO-Klasse (Superklasse) aufrufen
			parent::__construct($dsn, $user, $passwd, $options);
		}
		catch (PDOException $e) {
			die("Verbindung zur Datenbank fehlgeschlagen: ".$e->getMessage());
		}
	}
}