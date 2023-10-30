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

if (!empty($_POST['ressource'])) {
    if ($_POST['ressource'] == "films"){
        $table = "film";
    } else if ($_POST['ressource'] == "acteurs" || $_POST['ressource'] == "réalisateurs"){
        $table = "personne";
    }
    if (!empty($_POST['nom'])) {
        getRessourceByNom($table, $_POST['nom'], $pdo);
    } else {
        getListRessource($table, $pdo);
    }
}

function getListRessource($Table, $pdo) {
    $stmt = $pdo->prepare("SELECT * FROM ". $Table ."");
    $stmt->execute();
    $films = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $films;
}

function getRessourceByNom($table, $Nom, $pdo) {
    $stmt = $pdo->prepare("SELECT * FROM ". $table ."WHERE nom = '". $Nom ."'");
    $stmt->execute();
    $films = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $films;
}

$films = getFilms($pdo);
$retour["resultat"]["film"] = $films;
echo json_encode($retour);

?>
