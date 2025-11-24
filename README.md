📑 Table des matières

🎯 Objectif du projet

🛠️ Technologies utilisées

📂 Structure du projet

🐳 Description des services Docker

🔒 Fichier env

▶️ Instructions de lancement

🌐 Accès aux services

🏗️ Construction de l’image de production

🧾 Conclusion

🎯 Objectif du projet

Cette application web permet :

de tester la connexion MySQL ;

de générer 10 noms de groupes aléatoires du type :
The {adjective} {noun} ;

les données proviennent d’une base MySQL initialisée via init.sql.

🛠️ Technologies utilisées

PHP 8 + Apache

MySQL 8

Adminer

Docker Compose

📂 Structure du projet
.
├─ compose.yaml
├─ .env
├─ README.md
├─ web/
│  ├─ Dockerfile
│  └─ index.php
└─ db/
   └─ init.sql

🐳 Description des services Docker
1️⃣ Base de données MySQL

Image : mysql:8.0

Initialisation automatique via db/init.sql

Contient au minimum 10 adjectifs et 10 noms

Stockage dans un volume db_data

Port non exposé → plus sécurisé

2️⃣ Application Web PHP

Basée sur php:8.2-apache

Communique avec MySQL via PDO

Propose deux actions :

✔️ Tester la connexion MySQL

🎲 Générer 10 noms de groupes

Accessible :
👉 http://localhost:8085

3️⃣ Adminer

Interface SQL légère

Connectée automatiquement à MySQL

Accessible :
👉 http://localhost:8086

🔒 Fichier .env

⚠️ Ne jamais versionner ce fichier !
Il contient des mots de passe et informations sensibles.

Exemple :

MYSQL_ROOT_PASSWORD=rootpassword
MYSQL_DATABASE=bandnames
MYSQL_USER=banduser
MYSQL_PASSWORD=bandpass

WEB_PORT=80
DB_HOST=db
DB_PORT=3306
DB_NAME=bandnames
DB_USER=banduser
DB_PASSWORD=bandpass

▶️ Instructions de lancement
1. Vérifier que Docker fonctionne

Docker Desktop activé

Sous WSL2 : intégration activée

2. Créer le fichier .env
nano .env


Coller :

MYSQL_ROOT_PASSWORD=rootpassword
MYSQL_DATABASE=bandnames
MYSQL_USER=banduser
MYSQL_PASSWORD=bandpass

WEB_PORT=80
DB_HOST=db
DB_PORT=3306
DB_NAME=bandnames
DB_USER=banduser
DB_PASSWORD=bandpass

3. Lancer les services
docker compose up --build

🌐 Accès aux services
💻 Application Web PHP

👉 http://localhost:8085

Fonctionnalités :

« Tester la connexion MySQL »

« Générer 10 noms de groupes »

Exemples générés :

The Golden Wolves

The Silent Rockets

The Broken Biscuits

🗄️ Adminer

👉 http://localhost:8086

Champ	Valeur
Serveur	db
Utilisateur	banduser
Mot de passe	bandpass
Base	bandnames

Tables visibles : adjectives, nouns

🏗️ Construction de l’image de production
docker build -t bandnamesgenerator-php:1.0.0 ./web


Vous pouvez ensuite pousser l’image sur un registre Docker.

🧾 Conclusion

Ce projet permet de :

comprendre l’orchestration Docker Compose

manipuler une base MySQL initialisée automatiquement

développer une mini-app PHP

générer une image de production

travailler proprement avec un fichier .env

Tout est conforme aux attentes pédagogiques du projet.
