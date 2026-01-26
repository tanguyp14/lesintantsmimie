<?php
/**
 * Footer template
 */

// Récupérer les options ACF
$structure = get_field('structure', 'option');
$footer_options = get_field('footer', 'option');

// Infos de contact
$denomination = $structure['denomination'] ?? 'Les Instants Mimie';
$telephone = $structure['numero_de_telephone'] ?? '';
$email = $structure['e-mail'] ?? '';

// Réseaux sociaux
$social_networks = [
    'facebook' => $structure['facebook'] ?? '',
    'instagram' => $structure['instagram'] ?? '',
    'tiktok' => $structure['tiktok'] ?? '',
];

// SVG décoratifs
$svg_1 = $footer_options['svg_1'] ?? '';
$svg_2 = $footer_options['svg_2'] ?? '';
$svg_3 = $footer_options['svg_3'] ?? '';
?>
        <a href="#masthead" class="back-top">Haut de page</a>
    </main><!-- /#main-content -->

<footer class="footer" role="contentinfo">
    <!-- SVG décoratifs -->
    <?php if ($svg_1): ?>
        <div class="footer__svg footer__svg--1">
            <img src="<?php echo esc_url($svg_1['url']); ?>" alt="">
        </div>
    <?php endif; ?>

    <?php if ($svg_2): ?>
        <div class="footer__svg footer__svg--2">
            <img src="<?php echo esc_url($svg_2['url']); ?>" alt="">
        </div>
    <?php endif; ?>

    <?php if ($svg_3): ?>
        <div class="footer__svg footer__svg--3">
            <img src="<?php echo esc_url($svg_3['url']); ?>" alt="">
        </div>
    <?php endif; ?>

    <div class="footer__container">
        <!-- Infos contact -->
        <div class="footer__info">
            <h3 class="footer__title"><?php echo esc_html($denomination); ?></h3>
            <?php if ($telephone): ?>
                <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $telephone)); ?>" class="footer__link">
                    <?php echo esc_html($telephone); ?>
                </a>
            <?php endif; ?>
            <?php if ($email): ?>
                <a href="mailto:<?php echo esc_attr($email); ?>" class="footer__link">
                    <?php echo esc_html($email); ?>
                </a>
            <?php endif; ?>
        </div>

        <!-- Séparateur -->
        <div class="footer__separator"></div>

        <!-- Menu -->
        <nav class="footer__nav">
           <?php
           // Filtre temporaire pour supprimer les classes parasites
           $remove_menu_classes = function($classes) { return []; };
           $remove_menu_id = function($id) { return ''; };

           add_filter('nav_menu_css_class', $remove_menu_classes, 100);
           add_filter('nav_menu_item_id', $remove_menu_id, 100);

           wp_nav_menu([
               'theme_location' => 'primary',
               'container' => false,
               'menu_class' => 'footer__menu',
               'depth' => 1,
           ]);

           remove_filter('nav_menu_css_class', $remove_menu_classes, 100);
           remove_filter('nav_menu_item_id', $remove_menu_id, 100);
           ?>
        </nav>

        <!-- Réseaux sociaux -->
        <div class="footer__social">
            <p class="footer__social-text">Suivez mes prestations sur les réseaux</p>
            <div class="footer__social-icons">
                <?php foreach ($social_networks as $network => $url): ?>
                    <?php if ($url): ?>
                        <?php $icon_svg = TYLT_get_social_icon($network); ?>
                        <?php if ($icon_svg): ?>
                            <a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo ucfirst($network); ?>" class="footer__social-icon">
                                <?php echo $icon_svg; ?>
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Copyright -->
    <div class="footer__bottom">
        <p>copyright <?php echo esc_html(strtolower($denomination)); ?> - Conception site : <a href="https://tylt.fr" target="_blank" rel="noopener">tylt</a> - <a href="<?php echo esc_url(get_privacy_policy_url()); ?>">Mentions légales et rgpd</a></p>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
