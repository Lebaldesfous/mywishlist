[PHP]: https://www.php.net/docs.php
[SUJET]: https://github.com/Lebaldesfous/mywishlist/blob/main/sujet.pdf

# Projet mywishlist

## 0. Présentation du projet

Le projet **mywishlist** est un projet scolaire réalisé durant le mobule de Programmation Web côté serveur. Dans le cadre de notre formation de deuxième année de DUT Informatique, nous sommes amenés, par groupe de 4, à coder, en PHP, le projet mywishlist.

Ce projet doit être écrit dans le langage [PHP], un langage de programmation web côté serveur très vastement utilisé aujourd'hui. Grâce à ce langage, nous allons ensemble dans ce projet, implémenter des fonctionnalités proposés sur le [sujet][SUJET].

## 1. Organisation du dépôt

Nous avons structuré notre dépôt, de façon à ne pas être désorganisés.

* Répertoire principal
    * <img src="https://cdn1.iconfinder.com/data/icons/folders-41/24/folder_directory_open-512.png" alt="dossier " width="18"/> modules : répertoire contenant les modules Javascript externes.
    * <img src="https://cdn1.iconfinder.com/data/icons/folders-41/24/folder_directory_open-512.png" alt="dossier " width="18"/> src : répertoire de code, où se trouve la grande partie du code PHP
        * <img src="https://cdn1.iconfinder.com/data/icons/folders-41/24/folder_directory_open-512.png" alt="dossier " width="18"/> conf : répertoire contenant les fichiers de configuration
        * <img src="https://cdn1.iconfinder.com/data/icons/folders-41/24/folder_directory_open-512.png" alt="dossier " width="18"/> controls : contient l'intégralité des contrôleurs
        * <img src="https://cdn1.iconfinder.com/data/icons/folders-41/24/folder_directory_open-512.png" alt="dossier " width="18"/> models : contient les modèles, le coeur de l'application
        * <img src="https://cdn1.iconfinder.com/data/icons/folders-41/24/folder_directory_open-512.png" alt="dossier " width="18"/> vue : contient toutes les différentes vues de l'application
    * <img src="https://cdn1.iconfinder.com/data/icons/folders-41/24/folder_directory_open-512.png" alt="dossier " width="18"/> web : répertoire contenant les fichiers statiques
        * <img src="https://cdn1.iconfinder.com/data/icons/folders-41/24/folder_directory_open-512.png" alt="dossier " width="18"/> img : Répertoire contenant les images
    - <img src="https://i.pinimg.com/originals/7f/d2/e4/7fd2e46b2da9819e667fb75caf475cf7.png" alt="fichier " width="18"/> .gitignore : fichier contenant les données (répertoires ou fichiers) qui ne doivent pas être suivis par git
    - <img src="https://i.pinimg.com/originals/7f/d2/e4/7fd2e46b2da9819e667fb75caf475cf7.png" alt="fichier " width="18"/> .htaccess : fichier de configuration d'Apache pour effectuer correctement les redirections
    - <img src="https://i.pinimg.com/originals/7f/d2/e4/7fd2e46b2da9819e667fb75caf475cf7.png" alt="fichier " width="18"/> composer.json : fichier d'installation des dépendances PHP nécessaires au projet
    - <img src="https://i.pinimg.com/originals/7f/d2/e4/7fd2e46b2da9819e667fb75caf475cf7.png" alt="fichier " width="18"/> index.php : Fichier principal, qui met en place et initialise l'application PHP
    - <img src="https://i.pinimg.com/originals/7f/d2/e4/7fd2e46b2da9819e667fb75caf475cf7.png" alt="fichier " width="18"/> README.md : Le fichier que vous lisez actuellement, faisant office de **Carnet de Bord** de l'équipe
    - <img src="https://i.pinimg.com/originals/7f/d2/e4/7fd2e46b2da9819e667fb75caf475cf7.png" alt="fichier " width="18"/> sujet.pdf : le sujet que nous suivons


## 2. Lancer le projet en local

### 2.1. Dépendances requises

Pour lancer le projet, vous aurez besoin de
- [PHP >= 7][https://www.php.net/downloads.php]
- [Composer][https://getcomposer.org/download/]
- [XAMPP][https://www.apachefriends.org/fr/download.html] ou autre logiciel analogue comme MAMP ou WAMP, qui fournit une base de données MySQL et un interpréteur de PHP côté serveur

### 2.2. Mise en place

Pour mettre en place le projet, veuillez suivre **attentivement** les étapes ci-dessous
1. Se placer dans le répertoire `src`
2. Lancer la commande `composer install`.
   1. Attendez quelques secondes
   2. Aucun message d'erreur ne devrait apparaître
   3. Un répertoire `vendor` devrait s'être créé à l'intérieur du répertoire `src`
3. Localisez le fichier `src/conf/conf.ini.example`
   1. Copiez le en une nouvelle version `conf.ini` dans le même répertoire (`cp src/conf.conf.ini.example src/conf/conf.ini` sous Linux)
   2. Remplissez les informations de connexion à votre base de données MySQL
4. Localisez votre dossier contenant votre installation de XAMPP
   1. Sous **Linux** :
      1. Placez vous dans le dossier `/opt/lampp/htdocs` (si vous n'avez pas les permissions nécessaires, passez en superutilisateur avec `sudo su`)
      2. Créez un lien symbolique entre votre dossier contenant l'application, et `/opt/lampp/htdocs` : `ln -s lienVersVotreDossierContenantLApplication ./mywishlist
5. Créez votre votre base de données MySQL avec le contenu du fichier `src/conf/DATABASE.sql`.
6. Lancer XAMPP
7. Rendez-vous sur [cet URL][http://localhost/mywishlist].
8. Créez votre liste de souhaits !