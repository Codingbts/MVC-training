<?php

function getPosts() {
	// We connect to the database.
	try {
    	$database = new PDO('mysql:host=localhost;dbname=MVC;charset=utf8', 'root', 'Fc.barcelone10');
	} catch(Exception $e) {
    	die('Erreur : '.$e->getMessage());
	}

	// We retrieve the 5 last blog posts.
	$statement = $database->query(
    	"SELECT id, titre, contenu, DATE_FORMAT(date_creation, '%d/%m/%Y à %Hh%imin%ss') AS date_creation_fr FROM billets ORDER BY date_creation DESC LIMIT 0, 5"
	);
	$posts = [];
	while (($row = $statement->fetch())) {
    	$post = [
        	'title' => $row['titre'],
        	'frenchCreationDate' => $row['date_creation_fr'],
        	'content' => $row['contenu'],
    	];

    	$posts[] = $post;
	}

	return $posts;
}

?>