	<?php echo form_open(SITE_AREA .'/developer/database/backup'); ?>

		<?php if (isset($tables) && is_array($tables) && count($tables) > 0) : ?>
			<?php foreach ($tables as $table) : ?>
				<input type="hidden" name="tables[]" value="<?php echo $table ?>" />
			<?php endforeach; ?>
		<?php endif; ?>

		<div class="notification information">
			<p><?php echo lang('db_backup_warning'); ?></p>
		</div>

		<div class="clearfix">
			<label for="file_name"><?php echo lang('db_filename'); ?></label>
			<div class="input">
				<input type="text" name="file_name" value="<?php echo $file ?>" />
			</div>
		</div>

		<br/>

		<div class="clearfix">
			<label for="drop_tables"><?php echo lang('db_drop_question') ?></label>
			<div class="input">
				<select name="drop_tables">
					<option><?php echo lang('bf_no'); ?></option>
					<option><?php echo lang('bf_yes'); ?></option>
				</select>
			</div>
		</div>

		<div class="clearfix">
			<label for="add_inserts"><?php echo lang('db_insert_question'); ?></label>
			<div class="input">
				<select name="add_inserts">
					<option><?php echo lang('bf_no'); ?></option>
					<option selected="selected"><?php echo lang('bf_yes'); ?></option>
				</select>
			</div>
		</div>

		<div class="clearfix">
			<label for="file_type"><?php echo lang('db_compress_question'); ?></label>
			<div class="input">
				<select name="file_type">
					<option value="txt"><?php echo lang('bf_none'); ?></option>
					<option><?php echo lang('db_gzip'); ?></option>
					<option><?php echo lang('db_zip'); ?></option>
				</select>
			</div>
		</div>

		<br />

		<p class="small"><?php echo lang('db_restore_note'); ?></p>

		<div style="padding: 20px" class="small">
			<p><strong><?php echo lang('db_backup') .' '. lang('db_tables'); ?>: &nbsp;&nbsp;</strong>
				<?php foreach ($tables as $table) : ?>
					<?php echo $table . '&nbsp;&nbsp;&nbsp;&nbsp;'; ?>
				<?php endforeach; ?>
			</p>
		</div>

		<div class="actions">
			<button type="submit" name="submit" class="btn primary" ><?php echo lang('db_backup'); ?></button> <?php echo lang('bf_or'); ?>
			<a href="<?php echo site_url(SITE_AREA .'/developer/database') ?>"><?php echo lang('bf_action_cancel'); ?></a>
		</div>

	<?php echo form_close(); ?>
