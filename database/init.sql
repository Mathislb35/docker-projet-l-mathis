CREATE DATABASE IF NOT EXISTS bandnames
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE bandnames;

CREATE TABLE IF NOT EXISTS adjectives (
    id INT AUTO_INCREMENT PRIMARY KEY,
    label VARCHAR(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS nouns (
    id INT AUTO_INCREMENT PRIMARY KEY,
    label VARCHAR(50) NOT NULL
);

INSERT INTO adjectives (label) VALUES
('Last'),
('Midnight'),
('Golden'),
('Electric'),
('Silent'),
('Wild'),
('Lonely'),
('Broken'),
('Crystal'),
('Burning');

INSERT INTO nouns (label) VALUES
('Biscuits'),
('Llamas'),
('Wolves'),
('Dreams'),
('Stars'),
('Pirates'),
('Echoes'),
('Rockets'),
('Giants'),
('Drifters');
