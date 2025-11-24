# Table des matières

- [Objectif du projet](#objectif-du-projet)
- [Structure du projet](#structure-du-projet)
- [Description des services Docker](#description-des-services-docker)
  - [1 Base de données MySQL](#base-de-données-mysql)
  - [2 Application Web PHP](#application-web-php)
  - [3 Adminer](#adminer)
- [Fichier env](#fichier-env)
- [Instructions pour lancer le projet](#instructions-pour-lancer-le-projet)
- [Accès aux services](#accès-aux-services)
  - [1 Application web PHP](#application-web-php-1)
  - [2 Adminer](#adminer-1)
- [Construire l’image en production](#construire-image-en-production)
- [Conclusion](#conclusion)

# Objectif du projet

Ce projet propose une application web permettant :

de tester la connexion à une base MySQL,

de générer automatiquement 10 noms de groupes aléatoires sous la forme :
The {adjective} {noun},

les adjectifs et noms proviennent d’une base MySQL initialisée avec init.sql.

Technologies utilisées

PHP 8 + Apache

MySQL 8

Adminer

Docker Compose

# Structure du projet
. <br>
├─ compose.yaml <br>
├─ .env <br>
├─ README.md <br>
├─ web/ <br>
│  ├─ Dockerfile <br>
│  └─ index.php <br>
└─ db/ <br>
   └─ init.sql

# Description des services Docker
## Base de données MySQL

Basée sur l’image officielle mysql:8.0

Initialise automatiquement les tables et données via db/init.sql

Contient au minimum 10 adjectifs et 10 noms

Stockée dans un volume db_data

N’expose aucun port vers l’hôte (plus sécurisé)

## Application Web PHP

Construite à partir du Dockerfile dans web/

Utilise php:8.2-apache

Communique avec MySQL via PDO

Page web offrant :

un bouton pour tester la connexion MySQL

un bouton pour générer 10 noms aléatoires

Accessible via :
 http://localhost:8085

## Adminer

Interface web SQL légère

Serveur configuré automatiquement sur db

Accessible via :
 http://localhost:8086

# Fichier env

Ce fichier contient les paramètres du projet :

NE JAMAIS versionner ce fichier dans Git !
Il contient des mots de passe et des variables sensibles.

Exemple :
<pre>
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
</pre>

# Instructions pour lancer le projet

Ces instructions fonctionnent en copier-coller sans modification.

 Vérifier que Docker fonctionne

Docker Desktop doit être lancé.
Sous WSL2, l’intégration WSL doit être activée.

 Créer un fichier .env
<pre>nano .env</pre>

Y coller :
<pre>
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
</pre>

Enregistrer avec :
CTRL+O → Entrée → CTRL+X

 Lancer les services
docker compose up --build

Lorsque MySQL, Apache et Adminer sont lancés, l'application est prête.

# Accès aux services

Après le lancement :
Ouvre ton navigateur.

## Application web PHP

 http://localhost:8085

Ce que tu dois voir :

Une page avec deux boutons :

Tester la connexion à la base
➝ Affiche : "Communication avec la base de données établie"

Générer 10 noms de groupe
➝ Affiche des noms comme :

The Golden Wolves

The Silent Rockets

The Broken Biscuits

## Adminer

http://localhost:8086

Connexion :

Serveur : db

Utilisateur : banduser

Mot de passe : bandpass

Base : bandnames

Ce que tu dois voir :

Table adjectives

Table nouns

Chacune avec 10 valeurs

# Construire image en production
docker build -t bandnamesgenerator-php:1.0.0 ./web


Cette image peut être poussée vers un registre ou utilisée en production.

# Conclusion

Ce projet permet de :

gérer une base MySQL initialisée automatiquement

développer une application PHP simple

créer une image Docker personnalisée

orchestrer trois services via Docker Compose

utiliser un fichier .env propre et externalisé

Tout est conforme aux attentes du sujet.
