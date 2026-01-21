<?php
/**
 * Template for 404 page
 */

get_header();
?>

<div class="content-wrapper container">
    <h1 class="has-text-align-center has-text-color has-huge-font-size"><strong>Page introuvable</strong></h1>
    <p>La page que vous souhaitiez consulter n'existe plus ou a été déplacée.<br>Consultez le menu de navigation ou <a href="<?php echo site_url('/'); ?>">visitez la page d'accueil</a> pour poursuivre votre navigation.</p>
</div>

<?php
get_footer();