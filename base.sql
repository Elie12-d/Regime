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
    quantite INT,
    prixPaye FLOAT NOT NULL,
    dateAchat DATE NOT NULL,
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

CREATE TABLE imcImage(
    id INT PRIMARY KEY AUTO_INCREMENT,
    imcCategory_id INT,
    imageH VARCHAR(255) NOT NULL,
    imageF VARCHAR(255) NOT NULL,
    FOREIGN KEY (imcCategory_id) REFERENCES imcCategories(id)
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

INSERT INTO regimes (nom, description, categorieObjectif_id, pourcentageViande, pourcentageVolaille, pourcentagePoisson, prixParJour, variationPoids) VALUES
('Méditerranéen léger', 'Riche en légumes, poissons maigres et huile d''olive. Idéal pour une perte de poids progressive.', 1, 15.0, 10.0, 25.0, 42500, -0.30),
('Protéiné minceur', 'Apport élevé en protéines pour préserver la masse musculaire pendant la perte de poids.', 1, 30.0, 20.0, 25.0, 60000, -0.50),
('Détox express', 'Repas légers et hypocaloriques avec beaucoup de légumes verts et poissons blancs.', 1, 10.0, 10.0, 20.0, 47500, -0.40),
('Équilibré stable', 'Repas variés et équilibrés pour maintenir son poids de forme sans frustration.', 2, 20.0, 20.0, 20.0, 50000, 0.00),
('Pescatarien doux', 'Sans viande rouge, riche en poissons et œufs. Maintien du poids et bien-être.', 2, 0.0, 15.0, 35.0, 57500, 0.00),
('Omnivore modéré', 'Toutes les protéines en quantités mesurées pour rester stable.', 2, 25.0, 15.0, 20.0, 45000, 0.05),
('Prise de masse', 'Riche en viandes et volailles, pour un gain musculaire et pondéral contrôlé.', 3, 35.0, 30.0, 15.0, 70000, 0.60),
('Hyperprotéiné sec', 'Très riche en protéines maigres pour prendre du muscle sec sans trop de gras.', 3, 25.0, 35.0, 25.0, 77500, 0.50),
('Gainer clean', 'Apport calorique élevé mais propre, avec glucides complexes et bonnes protéines.', 3, 30.0, 25.0, 20.0, 65000, 0.70),
('Omnivore renforcé', 'Mix complet pour prendre du poids de façon équilibrée et durable.', 3, 28.0, 28.0, 18.0, 62500, 0.55);

INSERT INTO porteMonnaie (user_id, solde) VALUES
(1, 150000.00),   -- elie01 (isGold = TRUE)
(2, 75000.00),    -- sarah_dev (isGold = FALSE)
(3, 45000.00),    -- mickael (isGold = FALSE)
(4, 200000.00),   -- rina22 (isGold = TRUE)
(5, 30000.00);    -- joel_pro (isGold = FALSE)

INSERT INTO imcImage (imcCategory_id, imageH, imageF) VALUES
(1, 'H tres maigre.jpg', 'F tres maigre.jpg'),
(2, 'H maigre.jpg', 'F maigre.jpg'),
(3, 'H en forme.jpg', 'F en forme.jpg'),
(4, 'H surpoids.jpg', 'F surpoids.jpg'),
(5, 'H gros.jpg', 'F gros.jpg'),
(6, 'H tres gros.jpg', 'F tres gros.jpg');
