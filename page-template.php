
<?php

/**
Template Name: Custom Page Template
 */
get_header();
if ( have_posts() ) :
	while ( have_posts() ) : the_post(); ?>
	  <article>
		<h2 class="border-bottom mb-4 "><?php the_title() ?></h2>
		
		<div class="epr-post post-sub-header">
			<?php the_content(); ?>
		</div>
	  </article>
	  <?php endwhile;
  else :
	  echo '<p>There are no pages!</p>';
  endif;
get_footer();
?>
