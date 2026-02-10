<?php

/**
 * Bloc Intro Presta
 */

$fields = get_fields();

// Variables ACF
$titre = $fields['titre'] ?? '';
$contenu = $fields['contenu'] ?? '';
$bouton_texte = $fields['bouton_texte'] ?? '';
$bouton_lien = $fields['bouton_lien'] ?? '';

// Image mise en avant du post
$featured_image = get_the_post_thumbnail_url(get_the_ID(), 'large');

// Classes du bloc
$block_class = 'intro-presta';
if (!empty($block['className'])) {
    $block_class .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $block_class .= ' align' . $block['align'];
}
?>

<section class="<?php echo esc_attr($block_class); ?>">
    <?php if ($featured_image): ?>
        <div class="intro-presta__image" style="background-image: url('<?php echo esc_url($featured_image); ?>');"></div>
    <?php endif; ?>

    <div class="intro-presta__content">
        <?php if ($titre): ?>
            <h2 class="intro-presta__title"><?php echo esc_html($titre); ?></h2>
        <?php endif; ?>

        <?php if ($contenu): ?>
            <div class="intro-presta__text"><?php echo wp_kses_post($contenu); ?></div>
        <?php endif; ?>

        <?php if ($bouton_texte && $bouton_lien): ?>
            <a href="<?php echo esc_url($bouton_lien); ?>" class="intro-presta__btn btn"><?php echo esc_html($bouton_texte); ?></a>
        <?php endif; ?>
    </div>
</section>
