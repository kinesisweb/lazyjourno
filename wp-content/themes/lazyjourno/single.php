<?php get_header(); ?>
<div class="row single-article-container">
<?php 
	if ( have_posts() ) : while ( have_posts() ) : the_post();
?>
	<div class="col-12 single-article-body no-gutters">
		<div class="col-lg-8 col-md-10 col-sm-12 mx-auto single-article-content">
		<?php
			get_template_part( 'content-single', get_post_format() );
		?>
		</div>
	</div>
	<?php
		if ( comments_open() || get_comments_number() ) :
	?>
	<div class="col-12 comments-outer-container">
	<?php
		comments_template();
	?>
	</div>
	<?php
		endif;
		endwhile; endif; 
	?>
</div> <!-- /.row -->
<?php get_footer(); ?>