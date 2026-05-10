<?php
    session_start();
    // header("Content-Type: application/json");

    function dbconnect() {
        // Informations de connexion MySQL
        $host = "localhost";
        $user = "root";
        $pass = "";
        $dbname = "fpdf";

        // Connexion à la base de données
        $conn = new mysqli($host, $user, $pass, $dbname);

        // Vérifie la connexion
        if ($conn->connect_error) {
            die(json_encode(["error" => "Échec de connexion : " . $conn->connect_error]));
        }
        return $conn;
    }

    function fermerConnexion($conn) {
        $conn->close();
    }
?>