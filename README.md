# Projet mywishlist

## 0. Présentation du projet

Le projet **mywishlist** est un projet scolaire réalisé durant le mobule de Programmation Web côté serveur. Dans le cadre de notre formation de deuxième année de DUT Informatique, nous sommes amenés, par groupe de 4, à coder, en PHP, le projet mywishlist.

Ce projet doit être écrit dans le langage [PHP](https://www.php.net/docs.php), un langage de programmation web côté serveur très vastement utilisé aujourd'hui. Grâce à ce langage, nous allons ensemble dans ce projet, implémenter des fonctionnalités proposés sur le [sujet](https://github.com/Lebaldesfous/mywishlist/blob/main/sujet.pdf).

## 1. Organisation du dépôt

Nous avons structuré notre dépôt, de façon à ne pas être désorganisés.

* Répertoire principal
    * modules : répertoire contenant les modules Javascript externes.
    * src : répertoire de code, où se trouve la grande partie du code PHP
        * conf : répertoire contenant les fichiers de configuration
        * controls : contient l'intégralité des contrôleurs
        * models : contient les modèles, le coeur de l'application
        * vue : contient toutes les différentes vues de l'application
    * web : répertoire contenant les fichiers statiques
        * img : Répertoire contenant les images
    - .gitignore : fichier contenant les données (répertoires ou fichiers) qui ne doivent pas être suivis par git
    - .htaccess : fichier de configuration d'Apache pour effectuer correctement les redirections
    - composer.json : fichier d'installation des dépendances PHP nécessaires au projet
    - index.php : Fichier principal, qui met en place et initialise l'application PHP
    - README.md : Le fichier que vous lisez actuellement, faisant office de **Carnet de Bord** de l'équipe
    - sujet.pdf : le sujet que nous suivons