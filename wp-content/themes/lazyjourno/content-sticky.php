<div class="col-sm-4">
  <a href="<?php the_permalink(); ?>" class="block-link">
  <div class="stickied-post-container" style="background-image: url(<?php echo get_the_post_thumbnail_url(get_the_ID(),'large'); ?>);">
    <div class="caption-container"><div class="stickied-post-caption">
        <?php the_title(); ?>
    </div></div>
  </div>
</a>
</div>