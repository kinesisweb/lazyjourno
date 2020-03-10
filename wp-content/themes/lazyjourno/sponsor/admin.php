<div>
	<h2 style="text-align:center;">Set <?php echo bloginfo('name'); ?> Sponsor Details</h2>
<?php settings_errors(); ?>
	<form action="options.php" method="post">
	<?php settings_fields('lazyjourno-sponsor-settings-group'); ?>
	<?php do_settings_sections('sitesponsor'); ?>
	<?php submit_button() ?>
	</form>
</div>