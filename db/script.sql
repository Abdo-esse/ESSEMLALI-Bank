CREATE TABLE roles (
    id SERIAL PRIMARY KEY,
    titre VARCHAR(100) NOT NULL
);

CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    mot_de_passe TEXT NOT NULL,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    date_modification TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    date_suppression TIMESTAMP NULL,
    is_active BOOLEAN DEFAULT TRUE
);

CREATE TABLE role_user (
    user_id INT NOT NULL,
    role_id INT NOT NULL,
    PRIMARY KEY (user_id, role_id),
    CONSTRAINT fk_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    CONSTRAINT fk_role FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE
);


CREATE TABLE clients (
    id SERIAL PRIMARY KEY,
    sexe VARCHAR(10) NOT NULL, 
    telephone VARCHAR(20) UNIQUE NOT NULL,
    carte_national VARCHAR(250) UNIQUE NOT NULL,
    address TEXT NOT NULL,
    user_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE comptes (
    id SERIAL PRIMARY KEY,
    numeroCompte VARCHAR(30) UNIQUE NOT NULL,
    solde DECIMAL(15,2) NOT NULL DEFAULT 0.00 CHECK (solde >= 0), 
    dateCreation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    estActif BOOLEAN DEFAULT TRUE
);

CREATE TABLE historique (
    id SERIAL PRIMARY KEY,
    id_donneur INTEGER,
    id_beneficiaire INTEGER DEFAULT NULL,
    type_operation VARCHAR(10),
    montant DECIMAL(15,2) NOT NULL CHECK (montant >= 0), 
    description TEXT,
    dateEffectue TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_donneur) REFERENCES comptes(id) ON DELETE CASCADE,
    FOREIGN KEY (id_beneficiaire) REFERENCES comptes(id) ON DELETE CASCADE
);

CREATE INDEX idx_numeroCompte ON comptes(numeroCompte);
