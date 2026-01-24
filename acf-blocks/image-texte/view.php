<?php

/**
 * Bloc Image - Texte
 *
 * @var array $block Les données du bloc
 * @var string $content Le contenu du bloc
 * @var bool $is_preview Mode preview dans l'éditeur
 * @var int $post_id L'ID du post
 */

$fields = get_fields();

// Variables ACF
$image = $fields['image'] ?? '';
$svg_devant_1 = $fields['svg_devant_1'] ?? '';
$svg_devant_2 = $fields['svg_devant_2'] ?? '';
$svg_derriere_1 = $fields['svg_derriere_1'] ?? '';
$texte = $fields['texte'] ?? '';
$bouton_texte = $fields['bouton_texte'] ?? '';
$bouton_lien = $fields['bouton_lien'] ?? '';
$position_image = $fields['position_image'] ?? 'gauche'; // gauche ou droite

// Classes du bloc
$block_class = 'image-texte';
if (!empty($block['className'])) {
    $block_class .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $block_class .= ' align' . $block['align'];
}
$block_class .= ' image-texte--' . $position_image;
?>

<section class="<?php echo esc_attr($block_class); ?>">
    <div class="image-texte__container">

        <div class="image-texte__image-wrapper">
            <?php if ($image): ?>
                <div class="image-texte__image">
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt'] ?: ''); ?>">
                </div>
            <?php endif; ?>

            <?php if ($svg_derriere_1): ?>
                <div class="image-texte__svg image-texte__svg--derriere-1">
                    <img src="<?php echo esc_url($svg_derriere_1['url']); ?>" alt="">
                </div>
            <?php endif; ?>

            <?php if ($svg_devant_1): ?>
                <div class="image-texte__svg image-texte__svg--devant-1">
                    <img src="<?php echo esc_url($svg_devant_1['url']); ?>" alt="">
                </div>
            <?php endif; ?>

            <?php if ($svg_devant_2): ?>
                <div class="image-texte__svg image-texte__svg--devant-2">
                    <img src="<?php echo esc_url($svg_devant_2['url']); ?>" alt="">
                </div>
            <?php endif; ?>
        </div>

        <div class="image-texte__content">
            <?php if ($texte): ?>
                <div class="image-texte__texte">
                    <?php echo wp_kses_post($texte); ?>
                </div>
            <?php endif; ?>

            <?php if ($bouton_texte && $bouton_lien): ?>
                <div class="image-texte__bouton">
                    <a href="<?php echo esc_url($bouton_lien); ?>" class="btn">
                        <?php echo esc_html($bouton_texte); ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>

    </div>
</section>