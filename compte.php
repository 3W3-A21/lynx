<?php
    $page = 'compte';
    include('inclusions/entete.php');
?>
    <section class="principale">
    <?php if(!isset($_SESSION['util'])) {  ?>
        <div class="formulairesUtilisateurs">
            <!-- Formulaire de connexion -->
            <form class="frm-connexion" action="compte.php" method="post">
                <fieldset>
                    <legend><?= $frmLegende; ?></legend>
                    <input type="text" name="courriel" placeholder="<?= $frmCourrielPH; ?>">
                    <input type="password" name="mdp" placeholder="<?= $frmMdpPH; ?>">
                    <input type="submit" value="<?= $frmBoutonConnecter; ?>">
                    
                </fieldset>
                <div class="actions-compte">
                    <a href="#"><?= $lienMdpOublie; ?></a>
                    <a href="#"><?= $lienNouveauCompte; ?></a>
                </div>
            </form>
            <!-- Formulaire de nouveau compte -->
            <form class="frm-nouveau" action="compte.php" method="post">
                <fieldset>
                    <legend>Créer un nouveau compte</legend>
                    <input type="text" name="prenom" placeholder="Prénom">
                    <input type="text" name="nom" placeholder="Nom">
                    <input type="text" name="courriel" placeholder="<?= $frmCourrielPH; ?>">
                    <input type="password" name="mdp" placeholder="<?= $frmMdpPH; ?>">
                    <input type="submit" value="Créer mon compte">
                </fieldset>
                <div class="actions-compte">
                    <a href="#">Me connecter</a>
                </div>
            </form>
            <!-- Formulaire de réinitialisation du MdP -->
            <form class="frm-mdp" action="compte.php" method="post">
                <fieldset>
                    <legend>Réinitialiser mon mot de passe</legend>
                    <input type="text" name="courriel" placeholder="<?= $frmCourrielPH; ?>">
                    <input type="submit" value="Soumettre">
                </fieldset>
                <div class="actions-compte">
                    <a href="#">Me connecter</a>
                    <a href="#"><?= $lienNouveauCompte; ?></a>
                </div>
            </form>
        </div>
        <?php if(isset($erreurConnexion)) : ?>
            <div class="erreur-cnx">Erreur de connexion : réessayez!</div>
        <?php endif; ?>
    <?php } else { ?>
        <h2>Mes investissements</h2>
    <?php } ?>
    </section>
<?php
    include('inclusions/pied2page.php')
?>