<?php

/**
 * Bloc Formulaire de Contact
 *
 * @var array $block Les données du bloc
 * @var string $content Le contenu du bloc
 * @var bool $is_preview Mode preview dans l'éditeur
 * @var int $post_id L'ID du post
 */

$fields = get_fields();

// Variables ACF
$titre = $fields['titre'] ?? 'On en discute ?';
$sous_titre = $fields['sous_titre'] ?? 'Discutons plus amplement de votre projet.';
$image = $fields['image'] ?? null;
$cf7_form_id = $fields['formulaire_cf7'] ?? '';
$background_pattern = $fields['background_pattern'] ?? null;

// Classes du bloc
$block_class = 'contact-form';
if (!empty($block['className'])) {
    $block_class .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $block_class .= ' align' . $block['align'];
}

// Style pour le background pattern
$bg_style = '';
if ($background_pattern) {
    $bg_style = 'background-image: url(' . esc_url($background_pattern['url']) . ');';
}
?>

<section id="contact" class="<?php echo esc_attr($block_class); ?>" <?php if ($bg_style): ?>style="<?php echo esc_attr($bg_style); ?>"<?php endif; ?>>
    <div class="contact-form__container">

        <!-- Image -->
        <div class="contact-form__image-wrapper">
            <?php if ($image): ?>
                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt'] ?: 'Image de contact'); ?>" class="contact-form__image">
            <?php else: ?>
                <img src="<?php echo esc_url(get_template_directory_uri() . '/acf-blocks/contact-form/assets/img/contact-image.png'); ?>" alt="Image de contact" class="contact-form__image">
            <?php endif; ?>
        </div>

        <!-- Formulaire -->
        <div class="contact-form__content">
            <?php if ($titre): ?>
                <h2 class="contact-form__title"><?php echo esc_html($titre); ?></h2>
            <?php endif; ?>

            <?php if ($sous_titre): ?>
                <p class="contact-form__subtitle"><?php echo esc_html($sous_titre); ?></p>
            <?php endif; ?>

            <?php if ($cf7_form_id): ?>
                <div class="contact-form__form">
                    <?php echo do_shortcode('[contact-form-7 id="' . esc_attr($cf7_form_id) . '"]'); ?>
                </div>
            <?php else: ?>
                <p class="contact-form__notice">Merci de choisir un formulaire Contact Form 7 dans les paramètres du bloc.</p>
            <?php endif; ?>
        </div>

    </div>
</section>
