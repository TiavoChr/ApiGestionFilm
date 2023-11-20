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


// Méthode GET pour récupérer un acteur par son ID
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['type']) && isset($_GET['id'])) {
    $type = $_GET['type'];
    $id = $_GET['id'];

    if ($type === 'acteur' || $type === 'realisateur' || $type === 'film') {
        $result = getEntityById($pdo, $type, $id);
        echo json_encode($result);
    } else {
        http_response_code(400);
        echo json_encode(array("message" => "Type invalide"));
    }
}

// Méthode GET pour récupérer une collection d'acteurs, de réalisateurs ou de films
elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['type'])) {
    $type = $_GET['type'];

    if ($type === 'acteurs' || $type === 'realisateurs' || $type === 'films') {
        $result = getEntityCollection($type, $pdo);
        echo json_encode($result);
    } else {
        http_response_code(400);
        echo json_encode(array("message" => "Type invalide"));
    }
}

// Méthode POST pour créer un acteur, un réalisateur ou un film
elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['type'])) {
    $type = $_GET['type'];
    $data = json_decode(file_get_contents("php://input"), true);

    if ($type === 'acteur' || $type === 'realisateur' || $type === 'film') {
        $result = createEntity($type, $data, $pdo);
        echo json_encode($result);
    } else {
        http_response_code(400);
        echo json_encode(array("message" => "Type invalide"));
    }
}

// Méthode PUT pour modifier un acteur, un réalisateur ou un film
elseif ($_SERVER['REQUEST_METHOD'] === 'PUT' && isset($_GET['type']) && isset($_GET['id'])) {
    $type = $_GET['type'];
    $id = $_GET['id'];
    $data = json_decode(file_get_contents("php://input"), true);

    if ($type === 'acteur' || $type === 'realisateur' || $type === 'film') {
        $result = updateEntity($type, $id, $data, $pdo);
        echo json_encode($result);
    } else {
        http_response_code(400);
        echo json_encode(array("message" => "Type invalide"));
    }
}

// Méthode DELETE pour supprimer un acteur, un réalisateur ou un film
elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_GET['type']) && isset($_GET['id'])) {
    $type = $_GET['type'];
    $id = $_GET['id'];

    if ($type === 'acteur' || $type === 'realisateur' || $type === 'film') {
        $result = deleteEntity($type, $id, $pdo);
        echo json_encode($result);
    } else {
        http_response_code(400);
        echo json_encode(array("message" => "Type invalide"));
    }
}

// Fonction pour récupérer une entité par son ID
function getEntityById($pdo, $type, $id) {

    $query = "SELECT * FROM personne WHERE personne_id = :id";

    if ($type === 'acteur') {
        $query = "SELECT DISTINCT * FROM personne ";
        $query .= " JOIN acteur_film ON (personne.personne_id = acteur_film.acteur_id) ";
        $query .= " WHERE personne_id = :id AND acteur_film.acteur_id IS NOT NULL ";
    } elseif ($type === 'realisateur') {
        $query = "SELECT DISTINCT * FROM personne ";
        $query .= " JOIN film ON (personne.personne_id = film.realisateur_id) ";
        $query .= " WHERE personne_id = :id AND film.realisateur_id IS NOT NULL ";
    } elseif ($type === 'film') {
        $query = "SELECT * FROM film WHERE film_id = :id";
    }

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Fonction pour supprimer une entité
function deleteEntity($type, $id, $pdo) {

    $query = "DELETE FROM personne WHERE personne_id = :id";

    if ($type === 'film') {
        $query = "DELETE FROM film WHERE film_id = :id";
    } elseif ($type === 'acteur_film') {
        $query = "DELETE FROM acteur_film WHERE acteur_film_id = :id";
    }

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id);

    try {
        $stmt->execute();
        return array("message" => "$type supprimé avec succès");
    } catch (PDOException $e) {
        return array("message" => "Erreur lors de la suppression de $type : " . $e->getMessage());
    }
}

// Fonction pour créer une entité
function createEntity($type, $data, $pdo) {

    $query = "INSERT INTO personne (nom, prenom, date_de_naissance, code) VALUES (:nom, :prenom, :dateNaissance, :code)";

    if ($type === 'acteur') {
        $query = "INSERT INTO personne (nom, prenom, date_de_naissance, code, acteur_code) VALUES (:nom, :prenom, :dateNaissance, :code)";
    } elseif ($type === 'realisateur') {
        $query = "INSERT INTO personne (nom, prenom, date_de_naissance, code, realisateur_code) VALUES (:nom, :prenom, :dateNaissance, :code)";
    } elseif ($type === 'film') {
        $query = "INSERT INTO film (nom, description, date_de_parution, realisateur_id) VALUES (:nom, :description, :dateParution, :realisateurId)";
    } elseif ($type === 'acteur_film') {
        $query = "INSERT INTO acteur_film (acteur_id, film_id) VALUES (:acteurId, :filmId)";
    }

    $stmt = $pdo->prepare($query);

    if ($type === 'acteur') {
        $stmt->bindParam(':nom', $data['nom']);
        $stmt->bindParam(':prenom', $data['prenom']);
        $stmt->bindParam(':dateNaissance', $data['date_de_naissance']);
        $stmt->bindParam(':code', $data['code']);
    } elseif ($type === 'realisateur') {
        $stmt->bindParam(':nom', $data['nom']);
        $stmt->bindParam(':prenom', $data['prenom']);
        $stmt->bindParam(':dateNaissance', $data['date_de_naissance']);
        $stmt->bindParam(':code', $data['code']);
    } elseif ($type === 'film') {
        $stmt->bindParam(':nom', $data['nom']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':dateParution', $data['date_de_parution']);
        $stmt->bindParam(':realisateurId', $data['realisateur_id']);
    } elseif ($type === 'acteur_film') {
        $stmt->bindParam(':acteurId', $data['acteur_id']);
        $stmt->bindParam(':filmId', $data['film_id']);
    }

    try {
        $stmt->execute();
        return array("message" => "$type créé avec succès");
    } catch (PDOException $e) {
        return array("message" => "Erreur lors de la création de $type : " . $e->getMessage());
    }
}

// Fonction pour récupérer une collection d'entités
function getEntityCollection($type , $pdo) {

    $query = "SELECT * FROM personne";

    if ($type === 'acteurs') {
        $query = "SELECT * FROM personne ";
        $query .= " JOIN acteur_film ON (personne.personne_id = acteur_film.acteur_id) ";
        $query .= " WHERE acteur_film.acteur_id IS NOT NULL ";
    } elseif ($type === 'realisateurs') {
        $query = "SELECT * FROM personne WHERE realisateur_code IS NOT NULL";
        $query .= " JOIN film ON (personne.personne_id = film.realisateur_id) ";
        $query .= " WHERE film.realisateur_id IS NOT NULL ";
    } elseif ($type === 'films') {
        $query = "SELECT * FROM film";
    }

    $stmt = $pdo->prepare($query);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fonction pour mettre à jour une entité
function updateEntity($type, $id, $data, $pdo) {

    $query = "UPDATE personne SET nom = :nom, prenom = :prenom, date_de_naissance = :dateNaissance, code = :code WHERE personne_id = :id";

    if ($type === 'acteur') {
        $query = "UPDATE personne SET nom = :nom, prenom = :prenom, date_de_naissance = :dateNaissance, code = :code WHERE personne_id = :id";
    } elseif ($type === 'realisateur') {
        $query = "UPDATE personne SET nom = :nom, prenom = :prenom, date_de_naissance = :dateNaissance, code = :code WHERE personne_id = :id";
    } elseif ($type === 'film') {
        $query = "UPDATE film SET nom = :nom, description = :description, date_de_parution = :dateParution, realisateur_id = :realisateurId WHERE film_id = :id";
    }

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':nom', $data['nom']);

    if ($type === 'acteur') {
        $stmt->bindParam(':prenom', $data['prenom']);
        $stmt->bindParam(':dateNaissance', $data['date_de_naissance']);
        $stmt->bindParam(':code', $data['code']);
    } elseif ($type === 'realisateur') {
        $stmt->bindParam(':prenom', $data['prenom']);
        $stmt->bindParam(':dateNaissance', $data['date_de_naissance']);
        $stmt->bindParam(':code', $data['code']);
    } elseif ($type === 'film') {
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':dateParution', $data['date_de_parution']);
        $stmt->bindParam(':realisateurId', $data['realisateur_id']);
    }

    try {
        $stmt->execute();
        return array("message" => "$type mis à jour avec succès");
    } catch (PDOException $e) {
        return array("message" => "Erreur lors de la mise à jour de $type : " . $e->getMessage());
    }
}
?>
