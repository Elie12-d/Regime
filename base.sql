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
    categorieObjectif_id INT,
    pourcentageViande FLOAT NOT NULL,
    pourcentageVolaille FLOAT NOT NULL,
    pourcentagePoisson FLOAT NOT NULL,
    prixParJour FLOAT NOT NULL,
    variationPoids FLOAT NOT NULL,
    FOREIGN KEY (categorieObjectif_id) REFERENCES categorieObjectif(id)
);

CREATE TABLE activitePhisique (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    categorieObjectif_id INT,
    durationMinutes INT NOT NULL,
    caloriesBrulees FLOAT NOT NULL,
    FOREIGN KEY (categorieObjectif_id) REFERENCES categorieObjectif(id)
);

CREATE TABLE infoSante (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    poids FLOAT NOT NULL,
    taille FLOAT NOT NULL,
    categorieObjectif_id INT,
    dateEnregistrement DATE NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (categorieObjectif_id) REFERENCES categorieObjectif(id)
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

CREATE TABLE imcCategories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    minImc FLOAT NOT NULL,
    maxImc FLOAT NOT NULL,
    label VARCHAR(20) NOT NULL,
    description TEXT NOT NULL
);

INSERT INTO imcCategories (minImc, maxImc, label, description) VALUES
(0, 16.5, 'Très mince', 'Votre santé mérite toute votre attention. Prendre soin de vous en douceur, avec une alimentation riche et équilibrée, vous aidera à gagner en énergie et bien-être.'),
(16.5, 18.5, 'Mince', 'Vous êtes naturellement élancé(e). Veillez à bien manger à votre faim pour rester dynamique et en pleine forme.'),
(18.5, 25, 'En forme', 'Félicitations ! Vous avez un poids équilibré. Continuez à bouger et à manger varié pour garder cette belle vitalité.'),
(25, 30, 'Surpoids', 'Un petit rééquilibrage peut vous apporter plus de légèreté et d''énergie au quotidien. Chaque petit pas compte, vous pouvez y arriver !'),
(30, 35, 'Gros', 'Votre corps vous envoie un signal. Avec de petites habitudes positives et du soutien, vous pouvez améliorer votre santé et votre confort.'),
(35, 100, 'Très gros', 'Vous méritez de vous sentir bien. Un accompagnement médical et des changements progressifs peuvent transformer votre vie, étape par étape.');


INSERT INTO users (pseudo, genre, email, password, isGold) VALUES
('elie01', 'Homme', 'elie01@gmail.com', 'pass123', TRUE),
('sarah_dev', 'Femme', 'sarah.dev@gmail.com', 'azerty456', FALSE),
('mickael', 'Homme', 'mickael@yahoo.com', 'mick789', FALSE),
('rina22', 'Femme', 'rina22@hotmail.com', 'rina2026', TRUE),
('joel_pro', 'Homme', 'joelpro@gmail.com', 'joelpass', FALSE);

INSERT INTO categorieObjectif (label) VALUES
('Perte de poids'),
('Maintien du poids'),
('Prise de masse');

INSERT INTO infoSante (user_id, poids, taille, categorieObjectif_id, dateEnregistrement) VALUES
(1, 48.0, 1.75, 1, '2024-01-15'),  -- IMC ≈ 15.7 → Très mince
(2, 56.0, 1.72, 2, '2024-01-20'),  -- IMC ≈ 18.9 → En forme
(3, 78.0, 1.68, 3, '2024-02-01'),  -- IMC ≈ 27.7 → Surpoids
(4, 95.0, 1.70, 2, '2024-02-10'),  -- IMC ≈ 32.9 → Gros
(5, 120.0, 1.65, 1, '2024-02-15'); -- IMC ≈ 44.1 → Très gros