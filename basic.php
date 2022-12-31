<?php

    // define PDO - tell about the database file
    $pdo = new PDO('sqlite:movies.db');

    // write sql
    $statement = $pdo->query("SELECT * FROM movies");

    // run the sql
    $movies = $statement->fetchAll(PDO::FETCH_ASSOC);


    // show it on the screen
    // print_r($movies);
    foreach($movies as $row => $movie) {
        echo "<li>" . $movie['MovieTitle'] . "</li>";
    }