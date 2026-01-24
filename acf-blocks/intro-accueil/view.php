<?php
/**
 * Bloc Intro Accueil
 *
 * @var array $block Les données du bloc
 * @var string $content Le contenu du bloc
 * @var bool $is_preview Mode preview dans l'éditeur
 * @var int $post_id L'ID du post
 */

$fields = get_fields();
extract($fields);

// Variables ACF
$background_image = $fields['background_image'] ?? '';
$logo = $fields['logo'] ?? '';
$titre = $fields['titre'] ?? '';
$sous_titre = $fields['sous_titre'] ?? '';

// Classes du bloc
$block_class = 'intro-accueil';
if (!empty($block['className'])) {
    $block_class .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $block_class .= ' align' . $block['align'];
}
?>

<section class="<?php echo esc_attr($block_class); ?>" <?php if ($background_image): ?>style="background-image: url('<?php echo esc_url($background_image['url']); ?>');"<?php endif; ?>>
    <div class="intro-accueil__overlay">
        <div class="intro-accueil__container">

            <?php if ($logo): ?>
                <div class="intro-accueil__logo">
                    <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt'] ?: 'Logo'); ?>">
                </div>
            <?php endif; ?>

            <?php if ($titre): ?>
                <h1 class="intro-accueil__titre"><?php echo esc_html($titre); ?></h1>
            <?php endif; ?>

            <?php if ($sous_titre): ?>
                <p class="intro-accueil__sous-titre"><?php echo esc_html($sous_titre); ?></p>
            <?php endif; ?>

        </div>
    </div>
</section>
