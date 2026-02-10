<?php

/**
 * Bloc Accroche
 *
 * @var array $block Les données du bloc
 * @var string $content Le contenu du bloc
 * @var bool $is_preview Mode preview dans l'éditeur
 * @var int $post_id L'ID du post
 */

$fields = get_fields();

// Variables ACF
$phrase = $fields['phrase'] ?? 'Une parenthèse précieuse pour célébrer les instants qui comptent vraiment !';
$svg = $fields['svg'] ?? null;

// Classes du bloc
$block_class = 'accroche';
if (!empty($block['className'])) {
    $block_class .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $block_class .= ' align' . $block['align'];
}

// Récupérer le contenu SVG inline
$svg_content = '';
if ($svg) {
    $svg_path = get_attached_file($svg['ID']);
    if ($svg_path && pathinfo($svg_path, PATHINFO_EXTENSION) === 'svg' && file_exists($svg_path)) {
        $svg_content = file_get_contents($svg_path);
    }
}
?>

<section class="<?php echo esc_attr($block_class); ?>">
    <?php if ($svg_content): ?>
        <div class="accroche__svg">
            <?php echo $svg_content; ?>
        </div>
    <?php endif; ?>

    <?php if ($phrase): ?>
        <p class="accroche__phrase"><?php echo nl2br(esc_html($phrase)); ?></p>
    <?php endif; ?>
</section>
