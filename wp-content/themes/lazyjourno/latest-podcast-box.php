<?php
$cat = get_cat_ID('podcast');
$args = array(
			'numberposts' => 5,
			'category' => $cat
		);
$latest_podcasts = get_posts( $args );
include_once('logic/podcast.php');
foreach ($latest_podcasts as $podcast) {
	$media = get_first_embed_media( $podcast->ID );
	$title = get_the_title( $podcast->ID );
	$subtitle = "";
	if (strpos($title,":")) {
		$titleArray = explode(":",$title);
		$title = array_shift($titleArray);;
		$subtitle = implode(":",$titleArray);
		lazyconsole($subtitle);
	}
	$postdate = get_the_date( $podcast->ID );
	$permalink = get_the_permalink( $podcast->ID );
	if ($media) {
		renderBox($media,$title,$subtitle,$postdate,$permalink);
		break;
	}
}


function renderBox($media,$title,$subtitle,$postdate,$permalink) {?>
	<div class="col-12" id="podcast-sidebar">
		<h4>Latest Podcast</h4>
		<img src="<?php echo get_template_directory_uri() . '/img/podcast-logo.png' ?>">
		<div class="latest-podcast-description"><a class="dark-link" href="<?php echo $permalink ?>"><h5><?php echo $title ?></h5><?php if($subtitle) {echo "<h6>" . $subtitle . "</h6>";} ?></a></div>
		<?php echo $media; ?>
	</div>
<?php
}