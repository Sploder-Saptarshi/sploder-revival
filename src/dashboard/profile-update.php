<?php
session_start();
// Get the form data
$username = $_SESSION['username'];
$description = $_POST["description"];
$hobbies = $_POST["hobbies"];
$favoriteSports = $_POST["favoriteSports"];
$favoriteGames = $_POST["favoriteGames"];
$favoriteMovies = $_POST["favoriteMovies"];
$favoriteBands = $_POST["favoriteBands"];
$whomIRespect = $_POST["whomIRespect"];

// Connect to the PostgreSQL database
include('../database/connect.php');
$db = connectToDatabase();

// Prepare the SQL statement
//Insert the form data into the user_info table if already exists update the data
$sql = "INSERT INTO user_info (username, description, hobbies, sports, games, movies, bands, respect) 
        VALUES (:username, :description, :hobbies, :sports, :games, :movies, :bands, :respect)
        ON CONFLICT (username) DO UPDATE SET description = :description, hobbies = :hobbies, sports = :sports, games = :games, movies = :movies, bands = :bands, respect = :respect";
$statement = $db->prepare($sql);
// Execute the SQL statement with the form data
$statement->execute(
    [
        ':username' => $username,
        ':description' => $description,
        ':hobbies' => $hobbies,
        ':sports' => $favoriteSports,
        ':games' => $favoriteGames,
        ':movies' => $favoriteMovies,
        ':bands' => $favoriteBands,
        ':respect' => $whomIRespect
    ]
);
header('Location: profile-edit.php');