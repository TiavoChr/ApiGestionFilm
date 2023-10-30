<?php
header("Content-type: application/json");
$servername = "localhost";
$username = "root";
$password = "";
$database = "apirestfilm";

$retour = array();
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $retour["Sucess"] = true;
    $retour["message"] = "Connexion à la base de données réussie";
} catch (PDOException $e) {
    $retour["Sucess"] = false;
    $retour["message"] = "Connexion à la base de données échoué";
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Fonction pour récupérer tous les films
function getFilms($pdo) {
    $stmt = $pdo->prepare("SELECT * FROM film");
    $stmt->execute();
    $films = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $films;
}

// Fonction pour créer un film
function createFilm($pdo, $data) {
    $stmt = $pdo->prepare("INSERT INTO films (nom, description, date_de_parution) VALUES (?, ?, ?)");
    $success = $stmt->execute([$data['nom'], $data['description'], $data['date_de_parution']]);
    return $success;
}

$films = getFilms($pdo);
$retour["resultat"]["film"] = $films;
echo json_encode($retour);

?>
