<?php

/**
 * Bloc Prestations
 */

$fields = get_fields();

// Variables ACF
$titre = $fields['titre'] ?? '';
$sous_titre = $fields['sous_titre'] ?? '';
$cards = $fields['cards'] ?? [];
$cta_svg = $fields['cta_svg'] ?? null;
$cta_titre = $fields['cta_titre'] ?? '';
$cta_bouton_texte = $fields['cta_bouton_texte'] ?? '';
$cta_bouton_lien = $fields['cta_bouton_lien'] ?? '';

// Récupérer le SVG CTA
$cta_svg_content = '';
if ($cta_svg) {
    $svg_path = get_attached_file($cta_svg['ID']);
    if ($svg_path && file_exists($svg_path)) {
        $cta_svg_content = file_get_contents($svg_path);
    }
}

// Classes du bloc
$block_class = 'presta';
if (!empty($block['className'])) {
    $block_class .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $block_class .= ' align' . $block['align'];
}
?>

<section class="<?php echo esc_attr($block_class); ?>">
    <div class="presta__header">
        <?php if ($titre): ?>
            <h2 class="presta__title"><?php echo esc_html($titre); ?></h2>
        <?php endif; ?>

        <?php if ($sous_titre): ?>
            <div class="presta__subtitle"><?php echo wp_kses_post($sous_titre); ?></div>
        <?php endif; ?>
    </div>

    <div class="presta__grid">
        <?php if ($cards): ?>
            <?php foreach ($cards as $card):
                $card_icon = $card['icon'] ?? null;
                $card_titre = $card['titre'] ?? '';
                $card_texte = $card['texte'] ?? '';

                // Récupérer l'icône
                $icon_content = '';
                if ($card_icon) {
                    $icon_path = get_attached_file($card_icon['ID']);
                    if ($icon_path && pathinfo($icon_path, PATHINFO_EXTENSION) === 'svg' && file_exists($icon_path)) {
                        $icon_content = file_get_contents($icon_path);
                    } elseif ($card_icon['url']) {
                        $icon_content = '<img src="' . esc_url($card_icon['url']) . '" alt="">';
                    }
                }
            ?>
                <div class="presta__card">
                    <?php if ($icon_content): ?>
                        <div class="presta__card-icon">
                            <?php echo $icon_content; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($card_titre): ?>
                        <h3 class="presta__card-title"><?php echo esc_html($card_titre); ?></h3>
                    <?php endif; ?>

                    <?php if ($card_texte): ?>
                        <p class="presta__card-text"><?php echo esc_html($card_texte); ?></p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <!-- Card CTA toujours en dernier -->
        <div class="presta__card presta__card--cta">
            <?php if ($cta_svg_content): ?>
                <div class="presta__cta-svg">
                    <?php echo $cta_svg_content; ?>
                </div>
            <?php endif; ?>

            <?php if ($cta_titre): ?>
                <h3 class="presta__card-title"><?php echo esc_html($cta_titre); ?></h3>
            <?php endif; ?>

            <?php if ($cta_bouton_texte && $cta_bouton_lien): ?>
                <a href="<?php echo esc_url($cta_bouton_lien); ?>" class="btn btn--small"><?php echo esc_html($cta_bouton_texte); ?></a>
            <?php endif; ?>
        </div>
    </div>
</section>
