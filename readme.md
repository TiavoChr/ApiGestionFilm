# API REST pour la gestion de liste de films

Cette API REST en PHP permet la gestion d'une liste de films avec des entités telles que les acteurs, réalisateurs, et films. Elle utilise une base de données MySQL pour stocker les informations.

## Configuration

1. **Configuration de la base de données**

   - Assurez-vous d'avoir un serveur MySQL en cours d'exécution.
   - Créez une base de données nommée `apirestfilm`.
   - Utilisez le script SQL fourni dans le fichier `apirestfilm.sql` pour créer les tables nécessaires.

2. **Configuration du serveur PHP**

   - Placez le dossier ApiGestionFilm de l'API dans le répertoire de votre serveur web.
   - Modifiez les paramètres de connexion à la base de données dans le fichier `index.php`.

## Utilisation de l'API

L'API prend en charge les opérations CRUD (Create, Read, Update, Delete) pour les entités suivantes : acteurs, réalisateurs, films et relations acteur_film.

### Récupérer une entité par son ID

- **Endpoint** : `/index.php?type=<entite>&id=<id>`
- **Méthode HTTP** : GET
- **Exemple** : `/index.php?type=acteur&id=1`

### Récupérer une collection d'entités

- **Endpoint** : `/index.php?type=<collection>`
- **Méthode HTTP** : GET
- **Exemple** : `/index.php?type=acteurs`

### Créer une entité

- **Endpoint** : `/index.php?type=<entite>`
- **Méthode HTTP** : POST
- **Données** : JSON dans le corps de la requête
- **Exemple** : `/index.php?type=acteur`


{
  "nom": "Doe",
  "prenom": "John",
  "date_de_naissance": "1990-01-01",
  "code": "JD001",
  "acteur_code": "AC001",
  "films": [1, 2]
}

# Mettre à jour une entité

Endpoint : /index.php?type=<entite>&id=<id>
Méthode HTTP : PUT
Données : JSON dans le corps de la requête
Exemple : /index.php?type=acteur&id=1
json
Copy code
{
  "nom": "Doe",
  "prenom": "John",
  "date_de_naissance": "1990-01-01",
  "code": "JD001",
  "acteur_code": "AC001",
  "films": [1, 2, 3]
}


# Supprimer une entité
Endpoint : /index.php?type=<entite>&id=<id>
Méthode HTTP : DELETE
Exemple : /index.php?type=acteur&id=1
Exemples de Réponses
Toutes les réponses sont renvoyées au format JSON.

json
Copy code
{
  "Sucess": true,
  "message": "Connexion à la base de données réussie"
}
json
Copy code
{
  "Sucess": false,
  "message": "Erreur lors de la connexion à la base de données"
}
json
Copy code
{
  "message": "Acteur créé avec succès"
}
json
Copy code
{
  "message": "Acteur mis à jour avec succès"
}
json
Copy code
{
  "message": "Acteur supprimé avec succès"
}