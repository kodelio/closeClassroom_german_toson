# CloseClassroom
Application pédagogique en PHP réalisée lors du DUT Informatique en alternance

## Demo
Lien vers la demo : http://laurent-toson.fr/closeClassroom_german_toson/
- Login : demo
- Mot de passe : demo

## Objectifs

L’application web sera une plateforme pédagogique numérique destiné à la diffusion d’enseignements.

## Périmètre
L’application web sera accessible sur un réseau local et ne demande pas de visibilité sur internet. Il existe trois types 
d’utilisateurs

- Etudiant : Accès en lecture sur les enseignements de sa formation.
- Professeur : Accès en lecture et écriture sur ses enseignements.
- Administrateur : Accès totale.

## Fonctionnalités : 
L’application web contient une zone «Etudiant», «Enseignant» et «Administration».
La page d’accueil de l’application web correspond à une page d’authentification.
Le formulaire d’authentification contiendra:
- Un champ «Nom d’utilisateur»
- Un champ «Mot de passe»
- Une case à cocher «Se souvenir de moi»
- Un lien vers une page d’inscription s’il n’est pas inscrit.

Le formulaire d’inscription contiendra :
- Un champ «Nom d’utilisateur»
- Un champ «Mot de passe»
- Un champ «Formation»
(Liste déroulante avec valeur fixe)

Deux étudiants ne peuvent pas avoir le même nom d’utilisateur.
Une fois connecté, un étudiant pourra accéder à la liste des cours associée à sa formation. 
Cette liste pourra être trié et filtré par module.

Une formation peut contenir plusieurs modules, un module peut contenir plusieurs cours. Un cours ne peut pas être dans plusieurs modules. Un module peut être dans plusieurs formations.
Un enseignant peut accéder à la zone étudiant et ainsi visualiser les cours et modules de ses formations.
Un enseignant peut accéder à la zone enseignant et créer ou modifier un cours.

Un cours se définit par :
- Un titre
- Une description
- Un module
- Un fichier attaché
- Une date

Un administrateur peut modifier n’importe quel cours dans la zone enseignant.

Dans la zone Administration, un administrateur peut :
- Ajouter de nouvelles formations
- Ajouter de nouveaux modules
- Ajouter un enseignant
- Visualiser tous les utilisateurs (nom d’utilisateur, type d’utilisateur)

Le formulaire d’ajout d’un enseignant contiendra :
- Un champ «Nom d’utilisateur»
- Un champ «Mot de passe»
- La liste des formations avec une case à choser pour chaque formation.


## Contraintes techniques :
- L’application web sera créé avec les technologies HTML5/CSS3/PHP/MySQL.
- L’application web implémentera une architecture objet.
- L’application web implémentera les design pattern MVC, Singleton, DAO au minimum.
- L’application web suivra les tendances «Web 2.0» en terme d’ergonomie.
 

## Fonctionnalités supplémentaires
- Editeur WYSIWYG pour les cours (https://github.com/bootstrap-wysiwyg/bootstrap3-wysiwyg)
- Edition et suppression des utilisateurs, cours, modules et formation

## Screenshots
Screenshots de l'application : http://laurent-toson.fr/closeClassroom_german_toson/screenshots/


## Crédits
- Développée par Arnaud German & Laurent Toson
- Thème : Bootswatch Paper (http://bootswatch.com/paper/)
