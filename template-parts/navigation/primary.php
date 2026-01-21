<?php
/**
 * Primary menu template part
 */
?>

<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary', 'TYLT' ); ?>">
    <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><p><?php esc_html_e( 'Menu', 'TYLT' ); ?></p><span></span></button>
    <?php
        wp_nav_menu(
            array(
                'theme_location' => 'primary_menu',
                'menu_id'        => 'primary-menu',
            )
        );
    ?>
</nav><!-- #site-navigation -->