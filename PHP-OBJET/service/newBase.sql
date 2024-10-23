-----------------Creation de la table Categorie
CREATE TABLE categorie (
    id SERIAL PRIMARY KEY,
    prefixe VARCHAR (10),
    libelle VARCHAR (255), 
    numeroinitial INTEGER DEFAULT 1
);

-----------------Insertion dans la table Categorie
INSERT INTO categorie (prefixe, libelle) VALUES 
('BA', 'Boisson alcool'),
('BB', 'Boisson biere'),
('BC', 'Boisson champagne'),
('BJ', 'Boisson jus'),
('BV', 'Boisson vin'),
('EG', 'Electromenager'),
('EL', 'Electricité'),
('XA', 'Alimentation');

-----------------Creation de la table Produit
CREATE TABLE produit (
    id SERIAL PRIMARY KEY,
    numproduit VARCHAR (10) NOT NULL,
    designation VARCHAR (255) NOT NULL,
    prixunitaire DECIMAL (10, 2),
    prixrevient DECIMAL (10, 2);
);

-----------------Insertion de la colonne categorie_id à la table produit
ALTER TABLE produit ADD categorie_id INTEGER;
ALTER TABLE produit ADD FOREIGN KEY (categorie_id) REFERENCES categorie(id);
UPDATE produit SET categorie_id=(SELECT id FROM categorie WHERE LEFT(produit.numproduit,2)=TRIM(categorie.prefixe));

-------------------Rajout de colonne format dans la table categorie 
ALTER TABLE categorie ADD format VARCHAR (20);





-----------------Creation de la table Role
CREATE TABLE role (
    id SERIAL PRIMARY KEY,
    code VARCHAR (20) NOT NULL,
    libelle VARCHAR (255) NOT NULL);
-----------------Insertion de données dans la table role
INSERT INTO role (code, libelle) VALUES
('ROLE_ADMIN', 'Administrateur base de données'),
('ROLE_INFORMATIQUE', 'Service informatique'),
('ROLE_COMPTA', 'Comptabilité'),
('ROLE_ASSISTANT', 'Assistant de dirrection'),
('ROLE_APPRO', 'Service approvisionement'),
('ROLE_VENTE', 'Service vente'),
('ROLE_USER', 'Visiteur');

-----------------Creation de la table User
CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    username VARCHAR (100) UNIQUE NOT NULL,
    password VARCHAR (255) NOT NULL,
    roles JSON);


-----------------Insertion de données dans la table user
CREATE EXTENSION pgcrypto;

INSERT INTO users (username, password, roles) VALUES
('marie', crypt('1234', gen_salt('bf')), '["ROLE_VENTE", "ROLE_USER"]'),
('paul', crypt('1234', gen_salt('bf')), '["ROLE_APPRO", "ROLE_USER"]'),
('roger', crypt('1234', gen_salt('bf')), '["ROLE_ASSISTANT", "ROLE_APPRO", "ROLE_USER"]');


-----------------Creation de la table Menu
CREATE TABLE menu (
    id SERIAL PRIMARY KEY,
    parent_id INTEGER,
    libelle VARCHAR(255),
    url VARCHAR(255),
    role VARCHAR(100),
    icone VARCHAR(255),
    FOREIGN KEY(parent_id) REFERENCES menu(id));

    -----------------Insertion de données dans la table menu
    INSERT INTO menu(libelle, url, role, icone) VALUES 
    ('Accueil', 'index.php', 'ROLE_USER', 'fa fa-home'),
    ('Produit', 'index.php?url=produit', 'ROLE_APPRO', ''),
    ('Tiers', 'index.php?url=tiers', 'ROLE_APPRO', ''),
    ('Vente', 'index.php?url=vente', 'ROLE_VENTE', ''),
    ('Appro', 'index.php?url=appro', 'ROLE_APPRO', ''),
    ('Mouvement', '', 'ROLE_INFORMATIQUE', ''),
    ('Parametre', '', 'ROLE_ADMIN', '');

     id | parent_id |  libelle  |          url          |       role        |   icone    
----+-----------+-----------+-----------------------+-------------------+------------
  1 |           | Accueil   | index.php             | ROLE_USER         | fa fa-home
  2 |           | Produit   | index.php?url=produit | ROLE_APPRO        | 
  3 |           | Tiers     | index.php?url=tiers   | ROLE_APPRO        | 
  4 |           | Vente     | index.php?url=vente   | ROLE_VENTE        | 
  5 |           | Appro     | index.php?url=appro   | ROLE_APPRO        | 
  6 |           | Mouvement |                       | ROLE_INFORMATIQUE | 
  7 |           | Parametre |                       | ROLE_ADMIN        | 
    -----------------Insertion de données dans la table menu (sous-menus)
    INSERT INTO menu(parent_id, libelle, url, role, icone) VALUES
    (6, 'Vente', 'index.php?url=vente', 'ROLE_INFORMATIQUE', ''),
    (6, 'Appro', 'index.php?url=appro', 'ROLE_INFORMATIQUE', ''),
    (6, 'Interne', 'index.php?url=interne', 'ROLE_INFORMATIQUE', ''),
    (6, 'Demarque', 'index.php?url=demarque', 'ROLE_INFORMATIQUE', ''),

    (7, 'Role', 'index.php?url=role', 'ROLE_ADMIN', ''),
    (7, 'User', 'index.php?url=security', 'ROLE_ADMIN', ''),
    (7, 'Categorie', 'index.php?url=categorie', 'ROLE_ADMIN', ''),
    (7, 'Type Tiers', 'index.php?url=typeTiers', 'ROLE_ADMIN', ''),
    (7, 'Type Mouvement', 'index.php?url=typeMouvement', 'ROLE_ADMIN', '');

    UPDATE menu SET icone = 'fas fas fa-gear' WHERE id = 7;