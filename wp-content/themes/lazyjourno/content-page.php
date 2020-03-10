<div class="blog-post mt-3">
	<div class="row">
		<div class="col">
  			<h2 class="blog-post-title"><?php the_title(); ?></h2>
  		</div>
  	</div>
	<?php 
		if ( has_post_thumbnail() ) { ?>
	<div class="row article-featured-image">
		<div class="col">
			<?php the_post_thumbnail( 'large', array('class' => 'img-fluid attachment large size-large') );
		} 

		if ( has_post_thumbnail() && $caption = get_post( get_post_thumbnail_id() )->post_excerpt ) : ?>
	 	<span class="article-caption"><?php echo $caption; ?></span>
	 	<?php endif;

	 if ( has_post_thumbnail() ) : ?>
	 </div>
	</div>
<?php endif; ?>
<div class="article-content">
  <?php the_content(); ?>
</div>
</div><!-- /.blog-post -->


