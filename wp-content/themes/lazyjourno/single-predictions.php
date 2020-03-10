<?php
global $post;
get_header();
?>

<div class="row single-article-container">
	<div class="col-12 single-article-body no-gutters">
		<div class="col-lg-8 col-md-10 col-sm-12 mx-auto single-article-content">
			<?php 
			if ( have_posts() ) : while ( have_posts() ) : the_post();
				get_template_part( 'content-single', get_post_format() );
			 ?>
		</div>
	<?php get_template_part( 'moment-of-truth' ); ?>
	</div>
	<?php
	if ( class_exists( 'Jetpack_RelatedPosts' ) ) {
	echo do_shortcode( '[jetpack-related-posts]' );
	}
	?>
	<div class="col-sm-12">
		<?php
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;
		endwhile;
	endif; 
	?>
	</div> <!-- /.col -->
</div> <!-- /.row -->
<?php get_footer(); ?>