<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}

require_once(get_template_directory() . "/cron/digest.php");
$settings = DigestSettings::loadSettings();
$days = array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
?>

<div class="wrap">
	<h2>Weekly Digest Settings</h2>
	<p class="description"  style="margin-bottom:1em;">
		<?php echo __( 'Use this to setup weekly digest settings for your users. Timing is set in your hosting provider\'s admin panel, which is currently every Friday at 5pm.'); ?>
	</p>
	<form name="lj_digest_form" method="post" action="<?php echo get_template_directory_uri() . "/cron/digest.php" ?>">
		<table class="form-table">
			<tr>
				<th>
					<label for="active">Send Weekly Digest:</label>
				</th>
				<td>
					<select name="active">
						<option value="1"<?php if ($settings['active']) {echo " selected='selected'";} ?>>Yes</option>
						<option value="0"<?php if (!$settings['active']) {echo " selected='selected'";} ?>>No</option>
					</select>
				</td>
			</tr>
			<tr>
				<th>
					<label for="time">Time to Send:</label>
				</th>
				<td>
					<select name="time">
				<?php 
					for ($i = 0; $i < 24; $i++) {
						echo "<option value='" . $i . "'";
						if ($i == $settings['time']) {
							echo " selected='selected'";
						}
						$time = ($i < 10) ? "0" . $i . ":00" : $i . ":00";
						echo ">" . $time . "</option>";
					}
				?>
					</select>
				</td>
			</tr>
			<tr>
				<th>
					<label for="day">Day to Send:</label>
				</th>
				<td>
					<select name="day">
					<?php 
						for ($i = 0; $i < count($days); $i++) {
							echo "<option value='" . $i . "'";
							if ($settings['day'] == $i) {
								echo " selected='selected'";
							}
							echo ">" . $days[$i] . "</option>";
						}
					?>
					</select>
				</td>
			</tr>
			<tr>
				<th>
					<label for="articles">Maximum Number of Articles: </label>
				</th>
				<td>
					<input type="number" name="articles" min="1" max="20" value="<?php echo $settings['articles'] ?>">
				</td>
			</tr>
			<tr>
				<th>
					<label for="passphrase">Pass-phrase:</label>
				</th>
				<td>
					<input name="passphrase" type="text" value="<?php echo $settings['passphrase'] ?>"> <em>(Do not change this without consulting your sysadmin)</em>
				</td>
			</tr>
			<tr>
				<th>
					<label for="introduction">Digest Introduction:</label>
				</th>
				<td>
					<textarea name="introduction" style="width:50%;height:200px;"><?php echo $settings['introduction'] ?></textarea>
				</td>
			</tr>
		</table>
	<div style="margin-top:1rem;">
			<button type="submit" class="button-primary">Save Settings</button>
		</div>
	<input type="hidden" name="action" value="savesettings">
	</form>
	<?php
	if ($_GET['save'] == "success") :
		?>
		<div class="notice notice-success is-dismissible">
					<p><strong>
						Settings Saved.					</strong></p>
				<button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>
				<?php
	endif; ?>
</div>
