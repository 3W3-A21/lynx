<?php
    $page = 'compte';
    include('inclusions/entete.php');
?>
    <section class="principale">
    <?php if(!isset($_SESSION['util'])) {  ?>
        <form action="compte.php" method="post">
            <fieldset>
                <legend><?= $frmLegende; ?></legend>
                <input type="text" name="courriel" placeholder="<?= $frmCourrielPH; ?>">
                <input type="password" name="mdp" id="mdp" placeholder="<?= $frmMdpPH; ?>">
                <input type="submit" value="<?= $frmBoutonConnecter; ?>">
                <?php if(isset($erreurConnexion)) : ?>
                    <div class="erreur-cnx">Erreur de connexion : réessayez!</div>
                <?php endif; ?>
            </fieldset>
            <div class="actions-compte">
                <a href="#"><?= $lienMdpOublie; ?></a>
                <a href="#"><?= $lienNouveauCompte; ?></a>
            </div>
        </form>
    <?php } else { ?>
        <h2>Mes investissements</h2>
    <?php } ?>
    </section>
<?php
    include('inclusions/pied2page.php')
?>