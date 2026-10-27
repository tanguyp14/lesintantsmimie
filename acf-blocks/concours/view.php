<?php

/**
 * Bloc Concours
 * Réutilise la mise en page et les styles du bloc Formulaire de Contact (acf-contact-form-style)
 *
 * @var array $block Les données du bloc
 * @var string $content Le contenu du bloc
 * @var bool $is_preview Mode preview dans l'éditeur
 * @var int $post_id L'ID du post
 */

$fields = get_fields();

// Variables ACF
$surtitre = $fields['surtitre'] ?? 'Forum Périnatalité & Petite Enfance';
$titre = $fields['titre'] ?? 'Tentez de gagner une urne personnalisée';
$infos_evenement = $fields['infos_evenement'] ?? '';
$description_lot = $fields['description_lot'] ?? '';
$image_lot = $fields['image_lot'] ?? null;
$cf7_form_id = $fields['formulaire_cf7'] ?? '';
$reglement = $fields['reglement'] ?? null;
$background_pattern = $fields['background_pattern'] ?? null;

// Classes du bloc
$block_class = 'contact-form concours';
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

<section id="participer" class="<?php echo esc_attr($block_class); ?>" <?php if ($bg_style): ?>style="<?php echo esc_attr($bg_style); ?>"<?php endif; ?>>
    <div class="contact-form__container">

        <!-- Lot à gagner -->
        <?php if ($image_lot): ?>
            <div class="contact-form__image-wrapper concours__image-wrapper">
                <span class="concours__badge">À gagner</span>
                <img src="<?php echo esc_url($image_lot['url']); ?>" alt="<?php echo esc_attr($image_lot['alt'] ?: 'Urne personnalisée à gagner'); ?>" class="contact-form__image">
            </div>
        <?php endif; ?>

        <!-- Formulaire de participation -->
        <div class="contact-form__content">
            <?php if ($surtitre): ?>
                <p class="concours__surtitre"><?php echo esc_html($surtitre); ?></p>
            <?php endif; ?>

            <?php if ($titre): ?>
                <h2 class="contact-form__title"><?php echo esc_html($titre); ?></h2>
            <?php endif; ?>

            <?php if ($infos_evenement): ?>
                <p class="concours__evenement"><?php echo esc_html($infos_evenement); ?></p>
            <?php endif; ?>

            <?php if ($description_lot): ?>
                <div class="concours__description"><?php echo wp_kses_post($description_lot); ?></div>
            <?php endif; ?>

            <?php if ($cf7_form_id): ?>
                <div class="contact-form__form">
                    <?php echo do_shortcode('[contact-form-7 id="' . esc_attr($cf7_form_id) . '"]'); ?>
                </div>
            <?php else: ?>
                <p class="contact-form__notice">Merci de choisir un formulaire Contact Form 7 dans les paramètres du bloc.</p>
            <?php endif; ?>

            <?php if ($reglement): ?>
                <details class="concours__reglement">
                    <summary>Règlement du jeu-concours</summary>
                    <div class="concours__reglement-texte"><?php echo wp_kses_post($reglement); ?></div>
                </details>
            <?php endif; ?>
        </div>

    </div>
</section>
