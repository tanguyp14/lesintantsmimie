<?php
/**
 * Bloc Multi Flower
 *
 * @var array $block Les données du bloc
 * @var string $content Le contenu du bloc
 * @var bool $is_preview Mode preview dans l'éditeur
 * @var int $post_id L'ID du post
 */

$fields = get_fields();
extract($fields);

// Variables ACF
$fleur_1 = $fields['fleur_1'] ?? '';
$fleur_2 = $fields['fleur_2'] ?? '';
$fleur_3 = $fields['fleur_3'] ?? '';
$fleur_4 = $fields['fleur_4'] ?? '';

// Classes du bloc
$block_class = 'multi-flower';
if (!empty($block['className'])) {
    $block_class .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $block_class .= ' align' . $block['align'];
}
?>

<section class="<?php echo esc_attr($block_class); ?>">
    <div class="multi-flower__container">

        <?php if ($fleur_1): ?>
            <div class="multi-flower__item multi-flower__item--1">
                <img src="<?php echo esc_url($fleur_1['url']); ?>" alt="<?php echo esc_attr($fleur_1['alt'] ?: 'Fleur 1'); ?>">
            </div>
        <?php endif; ?>

        <?php if ($fleur_2): ?>
            <div class="multi-flower__item multi-flower__item--2">
                <img src="<?php echo esc_url($fleur_2['url']); ?>" alt="<?php echo esc_attr($fleur_2['alt'] ?: 'Fleur 2'); ?>">
            </div>
        <?php endif; ?>

        <?php if ($fleur_3): ?>
            <div class="multi-flower__item multi-flower__item--3">
                <img src="<?php echo esc_url($fleur_3['url']); ?>" alt="<?php echo esc_attr($fleur_3['alt'] ?: 'Fleur 3'); ?>">
            </div>
        <?php endif; ?>

        <?php if ($fleur_4): ?>
            <div class="multi-flower__item multi-flower__item--4">
                <img src="<?php echo esc_url($fleur_4['url']); ?>" alt="<?php echo esc_attr($fleur_4['alt'] ?: 'Fleur 4'); ?>">
            </div>
        <?php endif; ?>

    </div>
</section>
