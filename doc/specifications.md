# Projet F1

## V1

Full Symfo

## V2

Front : React/VueJs/?

Back : Symfony/ApiPlateform / Pyhon + Django

DB => MySQL

API => Ergast API/?

## MVP

Inscription (mail/pseudo/mot de passe)

    Avatar

    Pronostic week-end :
      *Qualif => Pôle
      *Course => 10 premier + meilleur tour

    Résultat du week-end + championnat

    Résultat des pronostics individuelle et global

## Page d’accueil

Description, bouton connexion/inscription

    Une fois connecté page de l’utilisateur, avec score et pronostic à faire/en cours

    Une page Résultat championnat

    Une page Résultat pronostic global

## Pronostic

### Calcul des points

    *Pôle : 10 points
    *Course :
      *Vainqueur : 20 points
      *Meilleur tour : 10 points
      *Pilote placé : 10 points
      *1 place d’écart : 5 points
      *2 place d’écart : 2 points
    *Bonus :
      *Podium : 30 points
      *Hat trick: 30 points
      *10 dans le désordre : 50 points
      *10 dans l’ordre : 100 points

## DB

User => email pseudo mdp
Prono => user_id pole meilleur_tour 1 2 3 4 5 6 7 8 9 10
