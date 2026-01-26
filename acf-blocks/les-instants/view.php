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
    'posts_per_page' => 4,
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
    <div class="les-instants__svg les-instants__svg--1"></div>
    <div class="les-instants__svg les-instants__svg--2"></div>
    <div class="les-instants__svg les-instants__svg--3"></div>
    <div class="les-instants__svg les-instants__svg--4"></div>

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
            $instant_page = get_field('page', $instant_id);
            $instant_image = get_the_post_thumbnail_url($instant_id, 'large');
            $instant_tags = get_the_terms($instant_id, 'post_tag');

            // Determiner l'icone par defaut si pas definie
            $icon_src = '';
            if ($instant_icon) {
                $icon_src = $instant_icon['url'];
            } else {
                // Chercher dans le mapping
                foreach ($icon_mapping as $key => $icon_name) {
                    if (stripos($instant_title, $key) !== false) {
                        $icon_path = get_template_directory() . '/src/img/icons/' . $icon_name . '.svg';
                        if (file_exists($icon_path)) {
                            $icon_src = get_template_directory_uri() . '/src/img/icons/' . $icon_name . '.svg';
                        }
                        break;
                    }
                }
            }
        ?>
        <article class="les-instants__card" <?php if ($instant_image): ?>style="background-image: url('<?php echo esc_url($instant_image); ?>');"<?php endif; ?>>
            <?php if ($instant_tags): ?>
            <div class="les-instants__tags">
                <?php foreach ($instant_tags as $tag): ?>
                    <span class="les-instants__tag"><?php echo esc_html($tag->name); ?></span>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <?php if ($icon_src): ?>
            <div class="les-instants__icon">
                <img src="<?php echo esc_url($icon_src); ?>" alt="">
            </div>
            <?php endif; ?>

            <div class="les-instants__card-content">
                <div class="les-instants__card-text">
                    <h3 class="les-instants__card-title"><?php echo esc_html($instant_title); ?></h3>
                    <?php if ($instant_desc): ?>
                        <p class="les-instants__card-desc"><?php echo esc_html($instant_desc); ?></p>
                    <?php endif; ?>
                    <?php if ($instant_page): ?>
                        <a href="<?php echo esc_url($instant_page); ?>" class="les-instants__card-link">En savoir plus</a>
                    <?php endif; ?>
                </div>
            </div>
        </article>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

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
</section>
