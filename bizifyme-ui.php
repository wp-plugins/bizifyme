<SCRIPT type="text/javascript">
function bizifyme_help()
{
	document.getElementById('help-link').style.display = "none";
	document.getElementById('help-text').style.display = "inline";
}

function bizifyme_warning()
{
	document.getElementById('device-mobile').style.textDecoration = 'none';
	document.getElementById('device-desktop').style.textDecoration = 'none';
	
	if(document.getElementById('history').checked == true)
	{
		if(confirm('<?php _e('Are you sure you want to import all previously uploaded objects? If you have uploaded many objects to your Bizify.me account this can result in a large number of new blog posts.', 'bizifyme'); ?>'))
		{
			document.getElementById('device-mobile').style.textDecoration = 'line-through';
			document.getElementById('device-desktop').style.textDecoration = 'line-through';
			return true;
		}
		
		return false;
	}
}
</SCRIPT>

<div class="wrap">

<div id="icon-options-general" class="icon32"><br /></div>
<h2>Bizify.me</h2>

<form method="post">

<h3><?php _e('Automatically import objects from your Bizify.me account to your WordPress blog every 15 minutes.', 'bizifyme'); ?></h3>

<?php wp_nonce_field('settings_page','bizifyme_nonce'); ?>

<table class="form-table"><tr valign="top"><th scope="row"><?php _e('Auto import objects', 'bizifyme'); ?></th><td>

	<fieldset>
	<legend class="screen-reader-text"><?php _e('Auto import objects', 'bizifyme'); ?></legend>
	<label><input type="radio" name="selection" value="date" <?php echo($options['settings']['selection'] != 'none' ? 'checked="checked"' : ''); ?> /> <?php _e('Yes', 'bizifyme'); ?></label>
	<br />
	<label><input type="radio" name="selection" value="none" <?php echo($options['settings']['selection'] == 'none' || $options['settings']['selection'] == '' ? 'checked="checked"' : ''); ?> /> <?php _e('No', 'bizifyme'); ?></label>
	</fieldset>
	
</td></tr><tr valign="top"><th scope="row"><?php _e('Uploaded from what devices', 'bizifyme'); ?></th><td>

	<fieldset>
	<legend class="screen-reader-text"><?php _e('Uploaded from what devices', 'bizifyme'); ?></legend>
	<label id="device-mobile"><input type="radio" name="device" value="mobile" <?php echo($options['settings']['device'] == 'mobile' || $options['settings']['device'] == '' ? 'checked="checked"' : ''); ?> /> <?php _e('Only from my Android / iPhone / iPad', 'bizifyme'); ?></label>
	<br />
	<label id="device-desktop"><input type="radio" name="device" value="desktop,mobile" <?php echo($options['settings']['device'] == 'desktop,mobile' ? 'checked="checked"' : ''); ?> /> <?php _e('My computer and my Android / iPhone / iPad', 'bizifyme'); ?></label>
	</fieldset>
	
	</td></tr><tr valign="top"><th scope="row"></th><td>
	
	<fieldset>
	<legend class="screen-reader-text"><?php _e('Import all previously uploaded objects', 'bizifyme'); ?></legend>
	<label><input type="checkbox" id="history" name="history" onClick="return bizifyme_warning();" <?php echo($options['settings']['selection'] == 'complete' ? 'checked="checked"' : ''); ?> /> <?php _e('Import all previously uploaded objects', 'bizifyme'); ?></label>
	</fieldset>
	
</td></tr><tr valign="top"><th scope="row"><?php _e('Bizify.me account ID', 'bizifyme'); ?></th><td>

	<input name="bizifyme_id" type="text" type="number" maxlength="10" class="c2c-short_text" value="<?php echo $options['settings']['bizifyme_id']; ?>" /><BR />
	<DIV style="display: inline; font-size: 90%;" id="help-link"><A HREF="#" onClick="bizifyme_help();"><?php _e('What is my account-ID?', 'bizifyme'); ?></A></DIV>
	<DIV style="display: none; font-size: 90%;" id="help-text"><?php _e('You can find your account ID by <A HREF="https://bizify.me/login/" TARGET="_blank">login in to your Bizify.me account</A> and then go to <EM>Settings</EM> and click on <EM>Automatic publishing</EM>.', 'bizifyme') ?></DIV>

</td></tr><tr valign="top"><th scope="row"><?php _e('Post status', 'bizifyme'); ?></th><td>

	<select name="post_status">
		<?php
		$statuses = get_post_statuses();
		
		foreach($statuses as $status=>$status_value)
		{
			?>
				<option value="<?php echo $status; ?>" <?php if($options['settings']['post_status'] == $status || ($options['settings']['post_status'] == '' && $status == 'publish')) : echo('selected="selected"'); endif; ?>><?php echo($status_value);?></option>
			<?php
		}
		?>
	</select>

</td></tr><tr valign="top"><th scope="row"><?php _e('Category', 'bizifyme'); ?></th><td>

	<?php 
		$args = array(
			'hide_empty' => 0,
			'id' => 'post_category',
			'name' => 'post_category',
			'selected' => $options['settings']['post_category']
		);
		wp_dropdown_categories($args);
	?>

</td></tr><tr valign="top"><th scope="row"><?php _e('Author', 'bizifyme'); ?></th><td>

	<?php 
		$args = array(
			'id' => 'post_author',
			'name' => 'post_author',
			'who' => 'authors',
			'selected' => $options['settings']['post_author']
		);
		wp_dropdown_users($args);
	?>

</td></tr><tr valign="top"><th scope="row"><?php _e('Allow comments', 'bizifyme'); ?></th><td>
	
	<fieldset>
	<legend class="screen-reader-text"><?php _e('Allow comments', 'bizifyme'); ?></legend>
	<label><input type="radio" name="comment_status" value="open" <?php echo($options['settings']['comment_status'] == 'open' || $options['settings']['comment_status'] == '' ? 'checked="checked"' : ''); ?> /> <?php _e('Yes', 'bizifyme'); ?></label>
	<br />
	<label><input type="radio" name="comment_status" value="closed" <?php echo($options['settings']['comment_status'] == 'closed' ? 'checked="checked"' : ''); ?> /> <?php _e('No', 'bizifyme'); ?></label>
	</fieldset>
	
</td></tr><tr valign="top"><th scope="row"><?php _e('Allow trackbacks and pingbacks', 'bizifyme'); ?></th><td>
	
	<fieldset>
	<legend class="screen-reader-text"><?php _e('Allow trackbacks and pingbacks', 'bizifyme'); ?></legend>
	<label><input type="radio" name="ping_status" value="open" <?php echo($options['settings']['ping_status'] == 'open' || $options['settings']['ping_status'] == '' ? 'checked="checked"' : ''); ?> /> <?php _e('Yes', 'bizifyme'); ?></label>
	<br />
	<label><input type="radio" name="ping_status" value="closed" <?php echo($options['settings']['ping_status'] == 'closed' ? 'checked="checked"' : ''); ?> /> <?php _e('No', 'bizifyme'); ?></label>
	</fieldset>
	
</td></tr><tr valign="top"><th scope="row" colspan="2">
<p class="submit">
<input type="submit" name="submit" class="button button-primary" value="<?php _e('Save Changes', 'bizifyme'); ?>" />
</p>

</th></tr></table>

</form>

<?php
if(strlen($options['settings']['latest_import']) > 0)
{
	echo('<span style="color: transparent;">Latest import: ' . $options['settings']['latest_import']) . '(UTC)</span>';
}
?>

</div>