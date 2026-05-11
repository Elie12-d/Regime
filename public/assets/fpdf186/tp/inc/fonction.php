<?php
    include("connexion.php");


    function getDataSemestre()
    {
        $sql = "SELECT * FROM semestres";
        $requet = dbconnect()->query($sql);

        $data = [];
        while ($resultat = $requet->fetch_assoc()) {
            $data [] = [
                'id' => $resultat['id'],
                'semestre' => $resultat['semestre']
            ];
        }

        return $data;
        fermerConnexion(dbconnect());
    }

    function getDataNote()
    {
        $sql = "SELECT * FROM notes";
        $requet = dbconnect()->query($sql);

        $data = [];
        while ($resultat = $requet->fetch_assoc()) {
            $data [] = [
                'id' => $resultat['id'],
                'idSemestre' => $resultat['idSemestre'],
                'UE' => $resultat['UE'],
                'intitulé' => $resultat['intitulé'],
                'credit' => $resultat['credit'],
                'note' => $resultat['note'],
                'resultat' => $resultat['resultat']
            ];
        }

        return $data;
        fermerConnexion(dbconnect());
    }

    function getDataEtudiant()
    {
        $sql = "SELECT * FROM etudiant";
        $requet = dbconnect()->query($sql);

        $data = [];
        while ($resultat = $requet->fetch_assoc()) {
            $data [] = [
                'id' => $resultat['id'],
                'nom' => $resultat['nom'],
                'prenom' => $resultat['prenom'],
                'date_naissance' => $resultat['date_naissance'],
                'lieu_naissance' => $resultat['lieu_naissance'],
                'numero' => $resultat['numero'],
                'niveau' => $resultat['niveau']
            ];
        }

        return $data;
        fermerConnexion(dbconnect());
    }
?>