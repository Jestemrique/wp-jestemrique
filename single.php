<?php

get_header();

if ( have_posts() ) :
	while ( have_posts() ) : the_post(); ?>
		
		<article class="post">
			<h2  class="border-bottom"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
			
			<div class="mb-4">
			<i class="bi bi-calendar3">  </i><?php the_time( 'd/m/Y' ); ?>  
			</div>

			<div class="post-sub-header epr-post">
			  <?php the_content() ?>
			</div>
			<hr class="w-50 d-none d-md-block mb-1">
			<div class="text-wrap mb-3">
			<span class="d-none d-sm-none  d-md-inline-block mb-5">
				<?php
					$categories = get_the_category();
					$comma      = ', ';
					$output     = '';
					if ( $categories ) {
					foreach ( $categories as $category ) {
						$output .= ' <a href="' . get_category_link( $category->term_id ) . '">' . $category->cat_name . '</a>' . $comma;
					}
					echo trim( $output, $comma );
					} 
				?>
            </span>
			</div>

		</article>
	
	<?php endwhile;

else :
	echo '<p>There are no posts!</p>';

endif;

get_footer();

?>