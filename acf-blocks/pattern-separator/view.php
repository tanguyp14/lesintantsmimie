<?php

/**
 * Bloc Separateur Pattern
 *
 * @var array $block Les donnees du bloc
 * @var string $content Le contenu du bloc
 * @var bool $is_preview Mode preview dans l'editeur
 * @var int $post_id L'ID du post
 */

$fields = get_fields();

// Variables ACF
$image = $fields['image'] ?? '';
$hauteur = $fields['hauteur'] ?? 100;
$espacement = $fields['espacement'] ?? 0;

// Classes du bloc
$block_class = 'pattern-separator';
if (!empty($block['className'])) {
    $block_class .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $block_class .= ' align' . $block['align'];
}

// ID unique pour les styles inline
$block_id = 'pattern-separator-' . $block['id'];

// Recuperer l'URL et les dimensions de l'image
$image_url = $image ? $image['url'] : '';
$image_width = $image ? ($image['width'] ?? 0) : 0;
$image_height = $image ? ($image['height'] ?? 0) : 0;

// Calculer la largeur du pattern avec l'espacement
// On garde le ratio de l'image en fonction de la hauteur du bloc
$pattern_width = 'auto';
if ($image_width && $image_height && $hauteur) {
    $ratio = $image_width / $image_height;
    $calculated_width = round($hauteur * $ratio);
    $pattern_width = ($calculated_width + $espacement) . 'px';
}
?>

<?php if ($image_url): ?>
<div id="<?php echo esc_attr($block_id); ?>" class="<?php echo esc_attr($block_class); ?>" style="
    --pattern-height: <?php echo esc_attr($hauteur); ?>px;
    --pattern-width: <?php echo esc_attr($pattern_width); ?>;
    --pattern-image: url('<?php echo esc_url($image_url); ?>');
"></div>
<?php elseif ($is_preview): ?>
<div class="<?php echo esc_attr($block_class); ?> pattern-separator--empty">
    <p>Selectionnez une image pour le pattern</p>
</div>
<?php endif; ?>
