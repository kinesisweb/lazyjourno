<?php GLOBAL $post_index; ?>

<div class="row loop-article-container">
    <?php if ( has_post_thumbnail() && $post_index > 0) { ?>
      <div class="col-sm-4 loop-thumbnail" style="background-image: url(<?php echo get_the_post_thumbnail_url( get_the_id(),'large' ); ?>)">
        
      </div>
      <div class="col-sm-8">
    <?php } 
    else {
      echo '<div class="col-12">'; 
    } ?>
    <div class="row article-container">
        <div class="col-12 article-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
        <div class="col-12"><?php the_excerpt(); ?></div>
        <div class="col-12"><span><a href="<?php the_permalink(); ?>" class="article-permalink">Read the full article</a></span></div>
     </div>
  </div>
</div>
<div class="row">
  <div class="col-12 comments-container">
    <div class="row">
  <div class="col-12 col-sm-6 text-left"><span>Posted <?php the_time( get_option( 'date_format') . " – " . get_option( 'time_format') ); ?></span></div>
  <div class="col-12 col-sm-6 text-right">
    <?php
    if (get_comments_number()) {
    ?>
    <span><a href="<?php comments_link(); ?>">
  <?php
  printf( _nx( 'One Comment', '%1$s Comments', get_comments_number(), 'comments title', 'textdomain' ), number_format_i18n(             get_comments_number() ) ); ?>
  </a></span>
  <?php } 
  else { ?>
    <span><a href="<?php comments_link(); ?>" class="comments-link">Leave a Comment</a></span>

 <?php }?>
  </div>
</div>
</div>
</div>
