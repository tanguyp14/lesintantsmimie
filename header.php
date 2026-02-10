<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Pixelea
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text visually-hidden" href="#main-content"><?php esc_html_e('Aller au contenu', 'TYLT'); ?></a>

		<div class="hidden" hiddden>
			<?php get_template_part( 'dist/img/sprite.svg' ); ?>
		</div>
		
		<?php
	// Récupérer les réseaux sociaux depuis les options ACF (dans le groupe "structure")
	$structure = get_field('structure', 'option');
	$social_networks = [
		'facebook' => $structure['facebook'] ?? '',
		'instagram' => $structure['instagram'] ?? '',
		'tiktok' => $structure['tiktok'] ?? '',
		'linkedin' => $structure['linkedin'] ?? '',
		'twitter' => $structure['twitter'] ?? '',
		'pinterest' => $structure['pinterest'] ?? '',
		'threads' => $structure['threads'] ?? '',
		'twitch' => $structure['twitch'] ?? '',
		'youtube' => $structure['youtube'] ?? '',
	];
	$is_front_page = is_front_page();
	?>

	<header id="masthead" class="header <?php echo $is_front_page ? 'header--home' : 'header--scrolled'; ?>" role="banner">
		<div class="header__container">

			<div class="header__logo">
				<?php the_custom_logo(); ?>
			</div>

			<div class="header__nav">
				<?php get_template_part( 'template-parts/navigation/primary' ); ?>
			</div>

			<div class="header__social">
				<?php
				// DEBUG - À supprimer après vérification
				echo '<!-- DEBUG Social Networks: ';
				foreach ($social_networks as $network => $url) {
					echo $network . ' URL: ' . ($url ? $url : 'EMPTY') . ' | ';
					$icon_svg = TYLT_get_social_icon($network);
					echo 'SVG: ' . ($icon_svg ? 'FOUND' : 'NOT FOUND') . ' || ';
				}
				echo ' -->';

				foreach ($social_networks as $network => $url): ?>
					<?php if ($url): ?>
						<?php $icon_svg = TYLT_get_social_icon($network); ?>
						<?php if ($icon_svg): ?>
							<a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo ucfirst($network); ?>" class="header__social-icon header__social-icon--<?php echo esc_attr($network); ?>">
								<?php echo $icon_svg; ?>
							</a>
						<?php endif; ?>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>

		</div>
	</header><!-- #masthead -->

		<main id="main-content" role="main">