CREATE DATABASE fpdf;
USE fpdf;

CREATE TABLE semestres (
    id INT PRIMARY KEY AUTO_INCREMENT,
    semestre VARCHAR(50)
);

CREATE TABLE notes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    idSemestre INT,
    UE VARCHAR(50),
    intitulé VARCHAR(50),
    credit INT,
    note DECIMAL(2.2),
    resultat VARCHAR(50),
    FOREIGN KEY (idSemestre) REFERENCES semestres(id)
);

CREATE TABLE etudiant (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(50),
    prenom VARCHAR(50),
    date_naissance DATE,
    lieu_naissance VARCHAR(50),
    numero VARCHAR(50),
    niveau VARCHAR(100)
);

INSERT INTO semestres (semestre) VALUES 
('Semestre 1'), 
('Semestre 2');

INSERT INTO notes (idSemestre, UE, intitulé, credit, note, resultat) VALUES 
(1, 'INF401', "Base de données d'entreprises", 6, 11, 'P'),
(1, 'INF402', "Structure de données avancé", 3, 11, 'P'),
(1, 'INF403', "Programmation web avancé", 6, 12, 'AB'),
(1, 'INF404', "Interface graphique client lourd", 3, 8, ''),
(1, 'INF405', "Design pattern", 6, 10, 'P'),
(1, 'INF406', "Programmation distribué et web service", 3, 11.5, 'P'),
(1, 'INF407', "Recherche operationnelle", 3, 8, ''),

(2, 'INF408', "Programmation par contrainte", 4, 13, 'AB'),
(2, 'INF409', "Codage de l'information", 3, 12.5, 'AB'),
(2, 'INF410', "Architecture multi-tiers", 4, 10.5, 'P'),
(2, 'INF411', "Programmation mobile", 6, 10, 'P'),
(2, 'INF412', "Traitement de signal", 4, 6, ''),
(2, 'INF413', "ERP et systeme d'information", 3, 10, 'P'),
(2, 'INF414', "Projet Informatique", 6, 14, 'B');

INSERT INTO etudiant (nom, prenom, date_naissance, lieu_naissance, numero, niveau) VALUES 
('RAMANANDRAIBE', 'Harena Sarobidy', '2006-12-07', 'Manakara', 'ETU004293', 'M1-Informatique');