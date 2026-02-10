<?php

/**
 * Bloc Trois Points
 */

$fields = get_fields();

// Variables ACF
$titre = $fields['titre'] ?? '';
$sous_titre = $fields['sous_titre'] ?? '';
$cards = $fields['cards'] ?? [];

// Classes du bloc
$block_class = 'trois-points';
if (!empty($block['className'])) {
    $block_class .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $block_class .= ' align' . $block['align'];
}
?>

<section class="<?php echo esc_attr($block_class); ?>">
    <div class="trois-points__header">
        <?php if ($titre): ?>
            <h2 class="trois-points__title"><?php echo esc_html($titre); ?></h2>
        <?php endif; ?>

        <?php if ($sous_titre): ?>
            <p class="trois-points__subtitle"><?php echo esc_html($sous_titre); ?></p>
        <?php endif; ?>
    </div>

    <?php if ($cards): ?>
        <div class="trois-points__grid">
            <?php foreach ($cards as $index => $card):
                $card_svg = $card['svg'] ?? null;
                $card_icon = $card['icon'] ?? null;
                $card_titre = $card['titre'] ?? '';
                $card_texte = $card['texte'] ?? '';
                $card_bouton_texte = $card['bouton_texte'] ?? '';
                $card_bouton_lien = $card['bouton_lien'] ?? '';

                // Récupérer le SVG décoratif
                $svg_content = '';
                if ($card_svg) {
                    $svg_path = get_attached_file($card_svg['ID']);
                    if ($svg_path && file_exists($svg_path)) {
                        $svg_content = file_get_contents($svg_path);
                    }
                }

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
                <div class="trois-points__card">
                    <?php if ($svg_content): ?>
                        <div class="trois-points__card-svg">
                            <?php echo $svg_content; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($icon_content): ?>
                        <div class="trois-points__card-icon">
                            <?php echo $icon_content; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($card_titre): ?>
                        <h3 class="trois-points__card-title"><?php echo esc_html($card_titre); ?></h3>
                    <?php endif; ?>

                    <?php if ($card_texte): ?>
                        <div class="trois-points__card-text"><?php echo wp_kses_post($card_texte); ?></div>
                    <?php endif; ?>

                    <?php if ($card_bouton_texte && $card_bouton_lien): ?>
                        <a href="<?php echo esc_url($card_bouton_lien); ?>" class="btn"><?php echo esc_html($card_bouton_texte); ?></a>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>
