<?php if ($log_threshold == 0) : ?>
	<div class="notification attention">
		<p><?php echo lang('log_not_enabled'); ?></p>
	</div>
<?php endif; ?>

<?php echo form_open(site_url(SITE_AREA .'/developer/logs/enable'), 'class="constrained"'); ?>

	<fieldset>
		<legend>Settings</legend>

		<div class="clearfix">
			<label for="log_threshold"><?php echo lang('log_the_following'); ?></label>
			<div class="input">
				<select name="log_threshold" style="width: auto; max-width: none;">
					<option value="0" <?php echo ($log_threshold == 0) ? 'selected="selected"' : ''; ?>><?php echo lang('log_what_0'); ?></option>
					<option value="1" <?php echo ($log_threshold == 1) ? 'selected="selected"' : ''; ?>><?php echo lang('log_what_1'); ?></option>
					<option value="2" <?php echo ($log_threshold == 2) ? 'selected="selected"' : ''; ?>><?php echo lang('log_what_2'); ?></option>
					<option value="3" <?php echo ($log_threshold == 3) ? 'selected="selected"' : ''; ?>><?php echo lang('log_what_3'); ?></option>
					<option value="4" <?php echo ($log_threshold == 4) ? 'selected="selected"' : ''; ?>><?php echo lang('log_what_4'); ?></option>
				</select>

				<span class="help-inline"><?php echo lang('log_what_note'); ?></span>
			</div>
		</div>

	</fieldset>

	<div class="notification information">
		<p><?php echo lang('log_big_file_note'); ?></p>
	</div>

	<div class="actions">
		<input type="submit" name="submit" class="btn primary" value="<?php echo lang('log_save_button'); ?>" />
	</div>

<?php echo form_close(); ?>
