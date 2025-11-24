# Band Names Generator

## Table des matières
- [Objectif du projet](#objectif-du-projet)
- [Technologies utilisées](#technologies-utilisées)
- [Structure du projet](#structure-du-projet)
- [Description des services Docker](#description-des-services-docker)
  - [Base de données MySQL](#base-de-données-mysql)
  - [Application Web PHP](#application-web-php)
  - [Adminer](#adminer)
- [Fichier .env](#fichier-env)
- [Instructions de lancement](#instructions-de-lancement)
- [Accès aux services](#accès-aux-services)
  - [Application Web PHP (site)](#application-web-php-site)
  - [Adminer (interface SQL)](#adminer-interface-sql)
- [Construction de l'image en production](#construction-de-limage-en-production)
- [Conclusion](#conclusion)

## Objectif du projet

Ce projet propose une application web permettant :
- de tester la connexion à une base MySQL,
- de générer automatiquement 10 noms de groupes aléatoires sous la forme : `The {adjective} {noun}`,
- les adjectifs et noms proviennent d’une base MySQL initialisée avec `db/init.sql`.

## Technologies utilisées

- PHP 8 + Apache
- MySQL 8
- Adminer
- Docker Compose

## Structure du projet

.
├─ compose.yaml
├─ .env
├─ README.md
├─ web/
│ ├─ Dockerfile
│ └─ index.php
└─ db/
└─ init.sql

## Description des services Docker

- Image : `mysql:8.0`
- Initialisation automatique via `db/init.sq`
- Stockage des données dans un volume Docker `db_data`
- Aucun port exposé vers l’hôte (sécurité renforcée)

## Application Web PHP

- Basée sur l'image php:8.2-apache
- Communication avec MySQL via PDO
- Fonctionnalités principales :
   - test de connexion MySQL
   - génération de 10 noms de groupes
- Accessible à l'adresse :
  http://localhost:8085

## Application Web PHP

- Interface web SQL légère
- Connéctée automatiquement au service MySQL
- Accessible à l'adresse :
  http://localhost:8086

## Fichier .env

Ce fichier contient des variables sensibles et **ne doit jamais être versionné dans Git.**

Exemple :
```
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
```

## Instructions de lancement

1. Vérifier que Docker fonctionne

- Docker Desktop doit être actif
- Sous WSL2, l’intégration doit être activée

2. Créer le fichier .env
```
nano .env
```
Y coller le contenu d'exemple ci-dessus.
Enregistrer : CTRL+O, Entrée, puis CTRL+X.

3. Lancer les services
```
docker compose up --build
```
L’application sera prête lorsque MySQL, Apache et Adminer seront démarrés.

## Accès aux services

**Application Web PHP (site)**

http://localhost:8085

Fonctionnalités :

- Test de connexion à MySQL
- Génération de 10 noms de groupes aléatoires
  (ex. The Golden Wolves, The Silent Rockets, The Broken Biscuits)

## Adminer (interface SQL)

http://localhost:8086

Paramètres de connexion :

| Champ  |  Valeur |
| ------------- | ------------- |
| Serveur  | db  |
| Utilisateur  | banduser  |
| Mot de passe  | Bandpass  |
| Base  | bandnames  |

Tables disponibles :

- `adjectives`
- `nouns`

## Construction de l'image en production
```
docker build -t bandnamesgenerator-php:1.0.0 ./web
```
Cette image peut ensuite être poussée vers un registre Docker ou utilisée sur un serveur.

## Conclusion

Ce projet permet de :
- déployer une application PHP simple avec Docker,
- initialiser automatiquement une base MySQL,
- orchestrer plusieurs services avec Docker Compose,
- travailler proprement avec un fichier `.env` externalisé,
- générer une image Docker prête pour la production.
