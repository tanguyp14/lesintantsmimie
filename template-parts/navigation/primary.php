<?php
/**
 * Primary menu template part
 */

// Récupérer les réseaux sociaux depuis les options ACF
$structure = get_field('structure', 'option');
$social_networks = [
	'facebook' => $structure['facebook'] ?? '',
	'instagram' => $structure['instagram'] ?? '',
	'tiktok' => $structure['tiktok'] ?? '',
	'linkedin' => $structure['linkedin'] ?? '',
	'twitter' => $structure['twitter'] ?? '',
	'pinterest' => $structure['pinterest'] ?? '',
	'threads' => $structure['threads'] ?? '',
	'twitch' => $structure['twitch'] ?? '',
	'youtube' => $structure['youtube'] ?? '',
];
?>

<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary', 'TYLT' ); ?>">
    <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><p><?php esc_html_e( 'Menu', 'TYLT' ); ?></p><span></span></button>

    <div class="main-navigation__container">
        <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'primary_menu',
                    'menu_id'        => 'primary-menu',
                )
            );
        ?>

        <div class="main-navigation__footer">
            <div class="main-navigation__logo">
                <?php the_custom_logo(); ?>
            </div>

            <div class="main-navigation__social">
                <?php foreach ($social_networks as $network => $url): ?>
                    <?php if ($url): ?>
                        <?php $icon_svg = TYLT_get_social_icon($network); ?>
                        <?php if ($icon_svg): ?>
                            <a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo ucfirst($network); ?>" class="main-navigation__social-icon main-navigation__social-icon--<?php echo esc_attr($network); ?>">
                                <?php echo $icon_svg; ?>
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</nav><!-- #site-navigation -->