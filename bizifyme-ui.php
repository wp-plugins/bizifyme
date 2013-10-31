<SCRIPT type="text/javascript">
function bizifyme_help()
{
	document.getElementById('bizifyme-help-link').style.display = "none";
	document.getElementById('bizifyme-help-text').style.display = "inline";
}
</SCRIPT>

<div class="wrap">

<div id="icon-options-general" class="icon32"><br /></div>
<h2><?php _e('Bizify.me settings'); ?></h2>

<form method="post" id="">

<h3><?php _e('Auto import objects', 'bizifyme'); ?></h3>
<p><?php _e('Automatically import objects from your Bizify.me account to your WordPress blog every 15 minutes.', 'bizifyme'); ?></p>

<?php wp_nonce_field('settings_page','bizifyme_nonce'); ?>

<table class="form-table"><tr valign="top"><th scope="row"><?php _e('Selection of objects', 'bizifyme'); ?></th><td>

	<label><input type="radio" id="selection" name="selection" value="date" <?php echo($options['settings']['selection'] == 'date' ? 'checked="checked"' : ''); ?> /> <?php _e('Import only new objects', 'bizifyme'); ?></label>
	<br />
	<label><input type="radio" id="selection" name="selection" value="complete" onClick="return confirm('<?php _e('Are you sure you want to import all available objects? This can result in a large number of blog posts if you have many objects saved in your Bizify.me account.', 'bizifyme'); ?>');" <?php echo($options['settings']['selection'] == 'complete' ? 'checked="checked"' : ''); ?> /> <?php _e('Import all available objects', 'bizifyme'); ?></label>
	<br />
	<label><input type="radio" id="selection" name="selection" value="none" <?php echo($options['settings']['selection'] == 'none' || $options['settings']['selection'] == '' ? 'checked="checked"' : ''); ?> /> <?php _e('Disable automatic import', 'bizifyme'); ?></label>


</td></tr><tr valign="top"><th scope="row"><?php _e('Bizify.me account ID', 'bizifyme'); ?></th><td>

	<input name="bizifyme_id" id="bizifyme_id" type="text" type="number" maxlength="10" class="c2c-short_text" value="<?php echo $options['settings']['bizifyme_id']; ?>" /><BR />
	<DIV style="display: inline; font-size: 90%;" id="bizifyme-help-link"><A HREF="#" onClick="bizifyme_help();"><?php _e('What is my account-ID?', 'bizifyme'); ?></A></DIV>
	<DIV style="display: none; font-size: 90%;" id="bizifyme-help-text"><?php _e('You can find your account ID by <A HREF="https://bizify.me/login/" TARGET="_blank">login in to your Bizify.me account</A> and then go to <EM>Settings</EM> and click on <EM>Automatic publishing</EM>.', 'bizifyme') ?></DIV>
	
</td></tr><tr valign="top"><th scope="row"><?php _e('Post status', 'bizifyme'); ?></th><td>

	<select name="post_status" id="post_status">
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
	
	<label><input type="radio" id="comment_status" name="comment_status" value="open" <?php echo($options['settings']['comment_status'] == 'open' || $options['settings']['comment_status'] == '' ? 'checked="checked"' : ''); ?> /> <?php _e('Yes', 'bizifyme'); ?></label>
	<br />
	<label><input type="radio" id="comment_status" name="comment_status" value="closed" <?php echo($options['settings']['comment_status'] == 'closed' ? 'checked="checked"' : ''); ?> /> <?php _e('No', 'bizifyme'); ?></label>

</td></tr><tr valign="top"><th scope="row"><?php _e('Allow trackbacks and pingbacks', 'bizifyme'); ?></th><td>
	
	<label><input type="radio" id="ping_status" name="ping_status" value="open" <?php echo($options['settings']['ping_status'] == 'open' || $options['settings']['ping_status'] == '' ? 'checked="checked"' : ''); ?> /> <?php _e('Yes', 'bizifyme'); ?></label>
	<br />
	<label><input type="radio" id="ping_status" name="ping_status" value="closed" <?php echo($options['settings']['ping_status'] == 'closed' ? 'checked="checked"' : ''); ?> /> <?php _e('No', 'bizifyme'); ?></label>
	
	
</td></tr><tr valign="top"><th scope="row" colspan="2">
<p class="submit">
<input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e('Save Changes', 'bizifyme'); ?>" />
</p>
</th></tr></table>

</form>
</div>