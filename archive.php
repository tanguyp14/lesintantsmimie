<?php get_header(); ?>
<div class="entry-content">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<a href=" <?php the_permalink() ?>"><?php the_title(); ?></a>

	<?php the_content(); ?>
	 <?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>