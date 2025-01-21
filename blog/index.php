<?php
// Connexion à la base de données
try {
   $database = new PDO('mysql:host=localhost;dbname=MVC;charset=utf8', 'root', 'Fc.barcelone10');
} catch (Exception $e) {
   die('Erreur : ' . $e->getMessage());
}

// On récupère les 5 derniers billets
$statement = $database->query("SELECT id, titre, contenu, DATE_FORMAT(date_creation, '%d/%m/%Y à %Hh%imin%ss') AS date_creation_fr FROM billets ORDER BY date_creation DESC LIMIT 0, 5");

if (!$statement) {
   die('Erreur de requête SQL : ' . print_r($database->errorInfo(), true));
}

$posts = [];

while ($row = $statement->fetch()) {
   $post = [
      'title' => $row['titre'],
      'content' => $row['contenu'],
      'frenchCreationDate' => $row['date_creation_fr'],
   ];

   $posts[] = $post;
}

require('templates/homepage.php');

?>
