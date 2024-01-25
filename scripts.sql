-- CREATION DE LA BDD
CREATE TABLE Personne(
   id_personne INT AUTO_INCREMENT,
   nom VARCHAR(50),
   prenom VARCHAR(50),
   date_naissance DATE,
   PRIMARY KEY(id_personne)
);

CREATE TABLE Genre(
   id_genre INT AUTO_INCREMENT,
   libelle VARCHAR(50),
   PRIMARY KEY(id_genre)
);

CREATE TABLE Realisateur(
   id_real INT AUTO_INCREMENT,
   id_personne INT NOT NULL,
   PRIMARY KEY(id_real),
   UNIQUE(id_personne),
   FOREIGN KEY(id_personne) REFERENCES Personne(id_personne)
);

CREATE TABLE Acteur(
   id_acteur INT AUTO_INCREMENT,
   id_personne INT NOT NULL,
   PRIMARY KEY(id_acteur),
   UNIQUE(id_personne),
   FOREIGN KEY(id_personne) REFERENCES Personne(id_personne)
);

CREATE TABLE Role(
   id_role INT AUTO_INCREMENT,
   role VARCHAR(50),
   PRIMARY KEY(id_role)
);

CREATE TABLE Film(
   id_film INT AUTO_INCREMENT,
   titre VARCHAR(255),
   date_sortie_france DATE,
   duree INT,
   resume TEXT,
   note INT,
   affiche VARCHAR(255),
   id_real INT NOT NULL,
   PRIMARY KEY(id_film),
   FOREIGN KEY(id_real) REFERENCES Realisateur(id_real)
);

CREATE TABLE categorise(
   id_film INT,
   id_genre INT,
   PRIMARY KEY(id_film, id_genre),
   FOREIGN KEY(id_film) REFERENCES Film(id_film),
   FOREIGN KEY(id_genre) REFERENCES Genre(id_genre)
);

CREATE TABLE casting(
   id_film INT,
   id_acteur INT,
   id_role INT,
   PRIMARY KEY(id_film, id_acteur, id_role),
   FOREIGN KEY(id_film) REFERENCES Film(id_film),
   FOREIGN KEY(id_acteur) REFERENCES Acteur(id_acteur),
   FOREIGN KEY(id_role) REFERENCES Role(id_role)
);



-- REMPLISSAGE DE MA BDD
-- Ajout de personnes
INSERT INTO Personne (nom, prenom, date_naissance) VALUES
('Smith', 'John', '1990-05-15'),
('Johnson', 'Emily', '1988-08-22'),
('Williams', 'Michael', '1975-02-10'),
('Jones', 'Jessica', '1995-11-30'),
('Davis', 'Daniel', '1980-07-05');

-- Ajout de genres
INSERT INTO Genre (libelle) VALUES
('Action'),
('Comédie'),
('Drame'),
('Science-fiction'),
('Thriller');

-- Ajout de réalisateurs
INSERT INTO Realisateur (id_personne) VALUES
(1), -- Utilisez un ID de personne existant
(2),
(3),
(4),
(5);

-- Ajout d'acteurs
INSERT INTO Acteur (id_personne) VALUES
(2),
(3),
(4),
(5),
(1);

-- Ajout de rôles
INSERT INTO Role (role) VALUES
('Héros'),
('Méchant'),
('Second rôle'),
('Protagoniste'),
('Antagoniste');

-- Ajout de films
INSERT INTO Film (titre, date_sortie_france, duree, resume, note, affiche, id_real) VALUES
('L''Aventure Extrême', '2022-06-18', 120, 'Un film d''action palpitant.', 8, 'affiche1.jpg', 1),
('Les Rires Inarrêtables', '2021-09-30', 95, 'Une comédie hilarante.', 7, 'affiche2.jpg', 2),
('Les Larmes du Passé', '2023-03-08', 150, 'Un drame poignant.', 9, 'affiche3.jpg', 3),
('La Quête Spatiale', '2024-02-20', 135, 'Un film de science-fiction captivant.', 9, 'affiche4.jpg', 4),
('Le Mystère Obscur', '2023-11-12', 110, 'Un thriller mystérieux.', 7, 'affiche5.jpg', 5);

-- Liaison des films avec des genres
INSERT INTO categorise (id_film, id_genre) VALUES
(1, 1), -- L''Aventure Extrême est un film d''action
(2, 2), -- Les Rires Inarrêtables est une comédie
(3, 3), -- Les Larmes du Passé est un drame
(4, 4), -- La Quête Spatiale est de la science-fiction
(5, 5); -- Le Mystère Obscur est un thriller

-- Attribution des rôles aux acteurs dans les films
INSERT INTO casting (id_film, id_acteur, id_role) VALUES
(1, 2, 1),
(2, 3, 2),
(3, 4, 3),
(4, 5, 4),
(5, 1, 5);



-- A. Informations d’un film (id_film) : titre, année, durée (au format HH:MM) et réalisateur