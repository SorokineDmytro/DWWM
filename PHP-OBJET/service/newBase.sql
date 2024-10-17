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