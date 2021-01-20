[PHP]: https://www.php.net/docs.php
[SUJET]: https://github.com/Lebaldesfous/mywishlist/blob/main/sujet.pdf
[SITE]: https://mywishlist.jeufore-api.fr

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
    * <img src="https://cdn1.iconfinder.com/data/icons/folders-41/24/folder_directory_open-512.png" alt="dossier " width="18"/> styles : répertoire contenant les styles CSS additionnels
    - <img src="https://i.pinimg.com/originals/7f/d2/e4/7fd2e46b2da9819e667fb75caf475cf7.png" alt="fichier " width="18"/> .gitignore : fichier contenant les données (répertoires ou fichiers) qui ne doivent pas être suivis par git
    - <img src="https://i.pinimg.com/originals/7f/d2/e4/7fd2e46b2da9819e667fb75caf475cf7.png" alt="fichier " width="18"/> .htaccess : fichier de configuration d'Apache pour effectuer correctement les redirections
    - <img src="https://i.pinimg.com/originals/7f/d2/e4/7fd2e46b2da9819e667fb75caf475cf7.png" alt="fichier " width="18"/> composer.json : fichier d'installation des dépendances PHP nécessaires au projet
    - <img src="https://i.pinimg.com/originals/7f/d2/e4/7fd2e46b2da9819e667fb75caf475cf7.png" alt="fichier " width="18"/> index.php : Fichier principal, qui met en place et initialise l'application PHP
    - <img src="https://i.pinimg.com/originals/7f/d2/e4/7fd2e46b2da9819e667fb75caf475cf7.png" alt="fichier " width="18"/> README.md : Le fichier que vous lisez actuellement, faisant office de **Carnet de Bord** de l'équipe
    - <img src="https://i.pinimg.com/originals/7f/d2/e4/7fd2e46b2da9819e667fb75caf475cf7.png" alt="fichier " width="18"/> sujet.pdf : le sujet que nous suivons


## 2. Lancer le projet en local

### 2.1. Dépendances requises

Pour lancer le projet, vous aurez besoin de
- [PHP >= 7](https://www.php.net/downloads.php)
- [Composer](https://getcomposer.org/download/)
- [XAMPP](https://www.apachefriends.org/fr/download.html) ou autre logiciel analogue comme MAMP ou WAMP, qui fournit une base de données MySQL et un interpréteur de PHP côté serveur

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
      2. Créez un lien symbolique entre votre dossier contenant l'application, et `/opt/lampp/htdocs` : `ln -s lienVersVotreDossierContenantLApplication ./mywishlist`.
5. Créez votre votre base de données MySQL avec le contenu du fichier `src/conf/DATABASE.sql`.
6. Lancer XAMPP
7. Rendez-vous sur [cet URL](http://localhost/mywishlist).
8. Créez votre liste de souhaits !


## 3. Fonctionnalités implémentées

### 3.1 Participant

1. [x] Afficher une liste de souhaits
2. [x] Afficher un item d'une liste
3. [x] Réserver un item
4. [x] Ajouter un message avec sa réservation
5. [x] Ajouter un message sur une liste

### 3.2 Créateur

6. [x] Créer une liste
7. [x] Modifier les informations générales d'une de ses listes
8. [x] Ajouter des items
9. [x] Modifier un item
10. [x] Supprimer un item
11. [x] Rajouter une image à un item
12. [x] Modifier une image d'un item
13. [ ] Supprimer une image d'un item
14. [x] Partager une liste
15. [x] Consulter les réservations d'une de ses listes avant échéance
16. [x] Consulter les réservations et messages d'une de ses listes après échéance

### 3.3 Extensions

17. [x] Créer un compte
18. [x] S'authentifier
19. [x] Modifier son compte
20. [ ] Rendre une liste publique
21. [ ] Afficher les listes de souhaites publiques
22. [ ] Créer une cagnotte
23. [ ] Participer à une cagnotte
24. [ ] Uploader une image
25. [ ] Créer un compte participant
26. [ ] Afficher la liste des créateurs
27. [ ] Supprimer son compte
28. [ ] Joindre des listes à son compte


## 4. Déploiement

Le site a été déployé, et il est disponible à [cette adresse][SITE].

## 5. Ce qui a été fait

### 5.1. Théo CHAPELLE

- Extension 17
- Extension 18
- Extension 19
- Ajout du menu
- Ajout du squelette CSS des pages
- Implémentation Javascript pour un menu responsive
- Création d'une classe utilitaire pour gérer la génération efficace des pages

### 5.2. Matis CHASTIN

- Fonctionnalité 1 affichage liste
- Fonctionnalité 2 affinage de l'affichage item
- Corrections de bugs
- Ajout du css pour diverses pages
- Fonctionnalité 20

### 5.3. Guillaume HUET
- Fonctionnalité 6 Créer une liste
- Fonctionnalité 7 Modifier les informations générales d'une de ses listes
- Fonctionnalité 8 Ajouter des items
- Fonctionnalité 9 Modifier un item
- Fonctionnalité 10 Supprimer un item
- Création des vues 
### 5.4. Darius KIAÏE

- Fonctionnalité 3 pour la réservation d'un item
- Fonctionnalité 11 pour l'ajout d'une image à un item
- Fonctionnalité 12 pour la modification d'une image d'un item
- Supprimer liste
