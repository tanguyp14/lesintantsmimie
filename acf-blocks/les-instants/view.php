<?php

/**
 * Bloc Les Instants
 */

$fields = get_fields();

// Variables ACF
$titre = $fields['titre'] ?? 'Les Instants Mimie';
$description = $fields['description'] ?? '';
$titre_cta = $fields['titre_cta'] ?? '';
$description_cta = $fields['description_cta'] ?? '';
$bouton_texte = $fields['bouton_texte'] ?? '';
$bouton_lien = $fields['bouton_lien'] ?? '';
$svg_decoratifs = $fields['svg_decoratifs'] ?? [];

// Classes du bloc
$block_class = 'les-instants';
if (!empty($block['className'])) {
    $block_class .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $block_class .= ' align' . $block['align'];
}

// Recuperer les instants
$instants = get_posts([
    'post_type' => 'instant',
    'posts_per_page' => 5,
    'orderby' => 'menu_order',
    'order' => 'ASC',
]);

// Mapping des icones par defaut selon le titre
$icon_mapping = [
    'amour' => 'icon-marriage',
    'celebration' => 'icon-confetti',
    'evasion' => 'icon-booking',
    'festif' => 'icon-birthday',
];
?>

<section class="<?php echo esc_attr($block_class); ?>">
    <!-- SVG decoratifs -->
    <?php if ($svg_decoratifs): ?>
        <?php foreach ($svg_decoratifs as $index => $svg_item):
            $svg = $svg_item['svg'] ?? null;
            if ($svg):
                $svg_path = get_attached_file($svg['ID']);
                $svg_content = '';
                if ($svg_path && file_exists($svg_path)) {
                    $svg_content = file_get_contents($svg_path);
                }
        ?>
            <div class="les-instants__svg les-instants__svg--<?php echo $index + 1; ?>">
                <?php echo $svg_content; ?>
            </div>
        <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>

    <!-- Header -->
    <div class="les-instants__header">
        <?php if ($titre): ?>
            <h2 class="les-instants__title"><?php echo esc_html($titre); ?></h2>
        <?php endif; ?>
        <?php if ($description): ?>
            <div class="les-instants__description"><?php echo wp_kses_post($description); ?></div>
        <?php endif; ?>
    </div>

    <!-- Cards Grid -->
    <?php if ($instants): ?>
        <div class="les-instants__grid">
            <?php foreach ($instants as $index => $instant):
                $instant_id = $instant->ID;
                $instant_title = get_the_title($instant_id);
                $instant_desc = get_field('description_courte', $instant_id);
                $instant_icon = get_field('icon', $instant_id);
                $instant_link = get_permalink($instant_id);
                $instant_image = get_the_post_thumbnail_url($instant_id, 'large');
                $instant_tags = get_the_terms($instant_id, 'post_tag');

                // Recuperer le SVG inline
                $icon_svg = '';
                if ($instant_icon) {
                    // SVG depuis ACF
                    $icon_path = get_attached_file($instant_icon['ID']);
                    if ($icon_path && pathinfo($icon_path, PATHINFO_EXTENSION) === 'svg' && file_exists($icon_path)) {
                        $icon_svg = file_get_contents($icon_path);
                    } elseif ($instant_icon['url']) {
                        // Fallback img pour les non-SVG
                        $icon_svg = '<img src="' . esc_url($instant_icon['url']) . '" alt="">';
                    }
                } else {
                    // Chercher dans le mapping par defaut
                    foreach ($icon_mapping as $key => $icon_name) {
                        if (stripos($instant_title, $key) !== false) {
                            $icon_path = get_template_directory() . '/src/img/icons/' . $icon_name . '.svg';
                            if (file_exists($icon_path)) {
                                $icon_svg = file_get_contents($icon_path);
                            }
                            break;
                        }
                    }
                }
            ?>
                <article class="les-instants__card" <?php if ($instant_image): ?>style="background-image: url('<?php echo esc_url($instant_image); ?>');" <?php endif; ?>>
                    <div class="les-instants__card-content">
                        <?php if ($instant_tags): ?>
                            <div class="les-instants__tags">
                                <?php foreach ($instant_tags as $tag): ?>
                                    <span class="les-instants__tag"><?php echo esc_html($tag->name); ?></span>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($icon_svg): ?>
                            <div class="les-instants__icon">
                                <?php echo $icon_svg; ?>
                            </div>
                        <?php endif; ?>
                        <div class="les-instants__card-text">
                            <h3 class="les-instants__card-title"><?php echo esc_html($instant_title); ?></h3>
                            <?php if ($instant_desc): ?>
                                <p class="les-instants__card-desc"><?php echo esc_html($instant_desc); ?></p>
                            <?php endif; ?>
                            <a href="<?php echo esc_url($instant_link); ?>" class="les-instants__card-link"><span>En savoir plus</span></a>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
             <!-- CTA Section -->
    <?php if ($titre_cta || $description_cta): ?>
        <div class="les-instants__cta">
            <?php if ($titre_cta): ?>
                <h3 class="les-instants__cta-title"><?php echo esc_html($titre_cta); ?></h3>
            <?php endif; ?>
            <?php if ($description_cta): ?>
                <div class="les-instants__cta-desc"><?php echo wp_kses_post($description_cta); ?></div>
            <?php endif; ?>
            <?php if ($bouton_texte && $bouton_lien): ?>
                <a href="<?php echo esc_url($bouton_lien); ?>" class="les-instants__cta-btn btn"><?php echo esc_html($bouton_texte); ?></a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
        </div>
    <?php endif; ?>

   
</section>