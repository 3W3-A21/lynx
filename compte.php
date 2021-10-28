<?php
    // Demander à PHP de gérer la session d'utilisation
    session_start();

    // Vérifier s'il y a un paramètre d'URL dans la requête
    if(isset($_GET['action']) && $_GET['action'] == 'lo') {
        // Détruire la variable de session 'util'
        unset($_SESSION['util']);
    }

    // 2) Si le formulaire est soumit
    if(isset($_POST['courriel'])) {
        // 3) Récupérer la saisie de l'utilisateur
        $courriel = $_POST['courriel'];
        $mdp = $_POST['mdp'];

        // 4) Lire l'info sur TOUS les utilisateurs dans le fichier JSON
        $utilsTexte = file_get_contents('data/utilisateurs.json');
        $utilsTab = json_decode($utilsTexte, true);
        //print_r($utilsTab);

        // 5) Tester s'il y a un utilisateur ayant l'adresse de courriel donnée 
        // et si les mots de passe coincident
        if(isset($utilsTab[$courriel]) 
                && $utilsTab[$courriel]['mdp'] == hash('sha512', $mdp)) {
            // Tester si cet utilisateur a donné le bon mot de passe
            // Conserver cette information dans la session d'utilisateur
            $_SESSION['util'] = $courriel;
        }
        else {
            //echo "Échec de la connexion";
            $erreurConnexion = true;
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="images/lynx-64.png">
    <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:300,700|Roboto:700,400' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/styles.css">
    <title>Mon compte | Lynx</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Mon compte Lynx permet la gestion des avoirs et obligations, incluants les espèces, les comptes d'investissements, les avoirs immobiliers, et les cryptomonnaies.">
</head>
<body>
    <header>
        <div class="logo">
            <a href="index.php" title="Page d'accueil"><img src="images/lynx-64.png" alt="Lynx" class="logo"></a>
            <h1 class="logo">Lynx</h1>
        </div>
        <nav>
            <a href="compte.php" class="actif">Mon compte
                <?php if(isset($_SESSION['util'])):  ?>
                    <i><?= $_SESSION['util']; ?></i>
                    <a href="compte.php?action=lo">Déconnexion</a>
                <?php endif; ?>
            </a>
        </nav>
    </header>
    <section class="principale">
        <?php if(!isset($_SESSION['util'])) {  ?>    
            <form action="compte.php" method="post">
                <fieldset>
                    <legend>Connexion à Lynx</legend>
                    <input type="text" name="courriel" placeholder="Adresse courriel">
                    <input type="password" name="mdp" id="mdp" placeholder="Mot de passe">
                    <input type="submit" value="Se connecter">
                    <?php if(isset($erreurConnexion)) : ?>
                    <div class="erreur-cnx">Erreur de connexion : réessayez!</div>
                    <?php endif; ?>
                </fieldset>
                <div class="actions-compte">
                    <a href="#">Mot de passe oublié ?</a>
                    <a href="#">Nouveau compte</a>
                </div>
            </form>
        <?php } else { ?>
            <h2>Mes investissements</h2>
        <?php } ?>
    </section>
    <footer>
        <div class="da">&copy;2021 Lynx. Tous droits réservés.</div>
        <nav class="navigation-secondaire">
            <a href="#" title="À venir">Politique de confidentialité</a>
            <a href="#" title="À venir">Conditions d'utilisation</a>
            <a href="" title="" class="actif">FR</a>
            <a href="" title="" class="">EN</a>
        </nav>
    </footer>
</body>
</html>