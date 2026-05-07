DROP DATABASE IF EXISTS regime;
CREATE DATABASE regime;
USE regime;

CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    pseudo VARCHAR(255) NOT NULL,
    genre VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    isGold BOOLEAN NOT NULL DEFAULT FALSE
);

CREATE TABLE categorieObjectif(
    id INT PRIMARY KEY AUTO_INCREMENT,
    label VARCHAR(255) NOT NULL
);

CREATE TABLE regimes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    objectif_id INT,
    pourcentageViande FLOAT NOT NULL,
    pourcentageVolaille FLOAT NOT NULL,
    pourcentagePoisson FLOAT NOT NULL,
    prixParJour FLOAT NOT NULL,
    variationPoids FLOAT NOT NULL,
    FOREIGN KEY (objectif_id) REFERENCES categorieObjectif(id)
);

CREATE TABLE activitePhisique (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    idObjectif INT,
    durationMinutes INT NOT NULL,
    caloriesBrulees FLOAT NOT NULL,
    FOREIGN KEY (idObjectif) REFERENCES categorieObjectif(id)
);

CREATE TABLE infoSante (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    poids FLOAT NOT NULL,
    taille FLOAT NOT NULL,
    idObjectif INT,
    dateEnregistrement DATE NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (idObjectif) REFERENCES categorieObjectif(id)
);

CREATE TABLE porteMonnaie (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    solde FLOAT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE codes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    codeValeur VARCHAR(255) NOT NULL,
    montant FLOAT NOT NULL,
    isUsed BOOLEAN NOT NULL DEFAULT FALSE
);

CREATE TABLE tokens (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    token VARCHAR(255) NOT NULL,
    expiration DATETIME NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE achatRegime (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    regime_id INT,
    prixPaye FLOAT NOT NULL,
    dateAchat DATE NOT NULL,
    dateDebut DATE NOT NULL,
    dateFin DATE NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (regime_id) REFERENCES regimes(id)
);