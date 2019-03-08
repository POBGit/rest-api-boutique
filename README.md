# REST API - Boutique en ligne
Dans le cadre du cours de projets de fin d'études, j'ai créé une boutique en ligne avec le framework **Vue.Js** ainsi qu'une **REST API en PHP et MySQL** pour communiquer avec celle-ci. Le tout a été réalisé en moins de 7 semaines. Dans les deux cas, je ne connaissais pas le framework Vue.Js ainsi qu'une REST API.

Si vous voulez utiliser cette API pour quelconque raison, voici son fonctionnement.

## 1) Créer la base de données MySQL
Le fichier _bdd-boutique.sql_ contient le script qui créera votre base de données. Il suffit de l'insérer dans PhpMyAdmin, ou autre logiciel similaire.

## 2) Configurer l'API
Dans le dossier _config_ se trouve la classe _Database_. C'est grâce à cette classe que l'API réussi à communiquer avec la base de données.

Les modifications à apporter à ce fichier:
~~~~
private $sHote = "localhost"; // Adresse IP du serveur MySQL
private $sNomBDD = "boutique"; // Nom de la base de données
private $sUsername = "root"; // Nom d'utilisateur du serveur MySQL
private $sMotDePasse = ""; // Mot de passe de l'utilisateur`
~~~~

## 3) Voilà, tout est prêt!
Ce n'est pas plus compliquer que ça! Tout est prêt à être utilisé.


## Effectuer des requêtes
L'API retourne du JSON peut importe si la requête contient une erreur.

Pour effectuer une requête, voici le structure:
`http(s):// URL_OU_API_EST_HEBERGEE / DOSSIER_MENANT_VERS_API / LA_TABLE_DÉSIRÉE / TYPE_DE_REQUÊTE.php`

Note : Le nom des classes est le même que celle des tables de la base de données.

Exemple :
`http://localhost:8080/boutique/api/produits/rechercherTous.php`

### Les types de requêtes
1) **RechercherTous** - Recherche toutes les entrées de la table
2) **RechercherUn** - Recherche un élément de la table en particulier
3) **Ajouter** - Ajouter un élément dans la table
4) **Modifier** - Modifier un élément dans la table
5) **Supprimer** - Supprimer un élément dans la table
6) **RechercherTousPar...** - Rechercher certain éléments en fonction de critères spéficiques (Applicable seulement aux classes Produit, ImgProduit et contenuPanier)

### Les paramètres

 #### RechercherTous
 Aucun paramètre
 
 #### RechercherUn
 | Méthode | Clé                   | Valeur |
 | ------- | --------------------- | ------ |
 | GET     | id [Nom de la classe] | int    |
 
 Exemple : 
 `http://localhost:8080/boutique/api/produits/rechercherUn.php?idProduit=1`

#### Ajouter
  Toutes les valeurs doivent être passées en méthode POST à l'aide d'un formulaire HTML ou d'une requête AJAX.

 | Méthode  | Clé                     | Valeur |
 | -------- | ----------------------- | ------ |
 | POST     | Propriétés de la classe |        |
 
 #### Modifier
   Toutes les valeurs doivent être passées en méthode POST à l'aide d'un formulaire HTML ou d'une requête AJAX.
 
  | Méthode  | Clé                     | Valeur |
  | -------- | ----------------------- | ------ |
  | POST     | Propriétés de la classe |        |
  
 #### Supprimer
 | Méthode | Clé                   | Valeur |
 | ------- | --------------------- | ------ |
 | GET     | id [Nom de la classe] | int    |
 
 Exemple : 
  `http://localhost:8080/boutique/api/produits/supprimer.php?idProduit=1`
 
  #### RechercherTousPar...
  | Méthode | Clé                   | Valeur |
  | ------- | --------------------- | ------ |
  | GET     | iNo [Nom] | int    |
  
  Exemple : 
   `http://localhost:8080/boutique/api/produits/rechercherTousParPanier.php?iNoPanier=1`


## Classes
Voici les listes des classes disponibles.

  ### Adresse
  La classe adresse contient l'adresse de l'utilisateur, l'adresse de facturation d'une commande ainsi que l'adresse d'expédition d'une commande

  #### Paramètres
  * `idAdresse // id de l'adresse`
  * `sRue // Numéro civique et nom de la rue`
  * `sVille // Ville`
  * `sPays // Pays`
  * `sProvince // Province`
  * `sCodePostal // Code postal`
  
  #### Requêtes disponibles
  1) Ajouter
  2) Modifier
  3) Supprimer
  4) RechercherTous
  5) RechercherUn
  
  
  ### Catégorie
  La classe catégorie contient les catégories de produits à afficher sur le site

  #### Paramètres
  * `idCategorie // id de la catégorie `
  * `sNomCategorie // Nom de la catégorie `
  * `sUrlImg // Nom du fichier de l'image représentant la catégorie `
  
  #### Requêtes disponibles
  4) RechercherTous
  5) RechercherUn
  
  
  ### Commande
  La classe commande contient les commandes effectuées par un utilisateur
  
   #### Paramètres
   * `idCommande // id de la commande `
   * `sNumeroCommande // Numéro de la commande `
   * `iNoUtilisateur // l'id de l'utilisateur `
   * `fFraisLivraison // Frais de livraison `
   * `fTPS // Taxes provincial (1.05) `
   * `fTVQ // Taxes provincial (1.0974) `
   * `sEtatCommande // État de la commande `
   * `sTrackingNumCommande // Tracking de la commande par la compagnie de livraison `
   * `iNoAdresseFacturation // Adresse de facturation `
   * `iNoAdresseExpedition// Adresse d'expédition `
    
   #### Requêtes disponibles
   1) Ajouter
   2) Modifier
   4) RechercherTous
   5) RechercherUn


  ### ContenuCommande
   La classe ContenuCommande contient les produits ajoutés à une commande par un utilisateur
    
   #### Paramètres
   * `idContenuCommande // Id du contenu de la commande `
   * `iQteProduitCommande // Quantité de produit `
   * `fPrixCommande // Prix final du produit `
   * `iNoCommande // Id de la commande `
   * `iNoProduit // Id du produit `
      
   #### Requêtes disponibles
   1) Ajouter
   2) Modifier
   2) Supprimer
   4) RechercherTous
   5) RechercherUn
   
   
  ### ContenuPanier
  La classe ContenuPanier contient les produits ajoutés à un panier par un utilisateur
    
   #### Paramètres
   * `idContenuPanier // Id du contenu du panier `
   * `iQteProduit // Quantité de produit `
   * `iNoProduit // Id du produit `
   * `iNoPanier // Id du panier `
      
   #### Requêtes disponibles
   1) Ajouter
   2) Modifier
   2) Supprimer
   4) RechercherTous
   5) RechercherUn
   5) RechercherTousParPanier


  ### ImgProduit
  La classe ImgProduit contient les images de produit
      
   #### Paramètres
   * `idImgProduit // Id de l'image du produit `
   * `sUrlImg // Nom du fichier de l'image `
   * `iNoProduit // Id du produit `
       
   #### Requêtes disponibles
   4) RechercherTous
   5) RechercherUn
   5) RechercherTousParProduit


  ### Panier
  La classe Panier contient les paniers temporaires d'un utilisateur anonyme
      
   #### Paramètres
   * `idPanier // Id du panier `
   * `sNumPanier // Numéro unique du panier `
   * `sDateModification // Date de modification du panier `
       
   #### Requêtes disponibles
   1) Ajouter
   1) Modifier
   1) Supprimer
   4) RechercherTous
   5) RechercherUn


  ### Produit
  La classe Produit contient les produits en vente dans la boutique
      
   #### Paramètres
   * `idProduit // Id du produit `
   * `sSKUProduit // SKU du produit `
   * `sNomProduit // Nom du produit `
   * `sMarque // Marque du produit `
   * `fPrixProduit // Prix du produit sans taxes`
   * `fPrixSolde //  Prix du produit en solde sans taxes`
   * `sDescCourteProduit // Description courte du produit `
   * `sDescLongProduit // Description longue du produit `
   * `sCouleur // Couleurs disponibles (JSON) `
   * `sCapacite // Capacités disponibles (JSON) `
   * `iNoCategorie // Id de la catégorie du produit `
   * `sDateAjout // Date d'ajout du produit `
   * `bAfficherProduit // Afficher le produit dans la boutique? `
       
   #### Requêtes disponibles
   1) Ajouter
   1) Modifier
   1) Supprimer
   4) RechercherTous
   5) RechercherUn
   5) RechercherTousParCateg

  ### Utilisateur
  La classe Utilisateur contient les utilisateurs inscrit pour faire des achats dans la boutique
      
   #### Paramètres
   * `idUtilisateur // Id de l'utilisateur `
   * `sCourriel // Courriel de l'utilisateur `
   * `sMotDePasse // Mot de passe de l'utilisateur `
   * `sNumTelephone // Numéro de téléphone de l'utilisateur `
   * `sPrenomUtilisateur // Prénom de l'utilisateur `
   * `sNomUtilisateur // Nom de famille de l'utilisateur `
   * `sDateInscription // Date d'inscription de l'utilisateur `
   * `iNoAdresse // ID de l'adresse de l'utilisateur `
       
   #### Requêtes disponibles
   1) Ajouter
   1) Modifier
   1) Supprimer
   4) RechercherTous
   5) RechercherUn
