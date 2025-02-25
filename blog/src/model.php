<?php

function getPosts():array {
	// We connect to the database.
	try {
    	$database = new PDO('mysql:host=localhost;dbname=MVC;charset=utf8', 'root', 'Fc.barcelone10');
	} catch(Exception $e) {
    	die('Erreur : '.$e->getMessage());
	}

	// We retrieve the 5 last blog posts.
	$statement = $database->query(
    	"SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date FROM billets ORDER BY creation_date DESC LIMIT 0, 5"
	);
	$posts = [];
	while (($row = $statement->fetch())) {
    	$post = [
        	'title' => $row['title'],
        	'french_creation_date' => $row['french_creation_date'],
        	'content' => $row['content'],
    	];

    	$posts[] = $post;
	}

	return $posts;
}
