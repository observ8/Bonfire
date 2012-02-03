<h3><span style="font-weight: normal">Viewing:</span> <?php echo $log_file_pretty; ?></h3>

<?php if (!isset($log_content) || empty($log_content)) : ?>
<div class="notification attention">
	<p><?php echo lang('log_not_found'); ?></p>
</div>
<?php else : ?>

	<p>View &nbsp;&nbsp;
		<select id="filter">
			<option value="all"><?php echo lang('log_show_all_entries'); ?></option>
			<option value="error"><?php echo lang('log_show_errors'); ?></option>
		</select>
	</p>

	<div id="log">
		<?php foreach ($log_content as $row) : ?>
		<?php
			$class = '';

			if (strpos($row, 'ERROR') !== false)
			{
				$class="error";
			} else
			if (strpos($row, 'DEBUG') !== false)
			{
				$class="attention";
			}
		?>
		<div style="border-bottom: 1px solid #999; padding: 5px 18px; color: #222;" <?php echo 'class="'. $class .'"' ?>>
			<?php echo $row; ?>
		</div>
		<?php endforeach; ?>
	</div>

	<?php if (has_permission('Bonfire.Logs.Manage')) : ?>
		<br/>

		<!-- Purge? -->
		<div class="box delete rounded">
			<?php echo sprintf(lang('log_delete1_note'),$log_file_pretty); ?>

			<a class="btn danger" href="<?php echo site_url(SITE_AREA .'/developer/logs/purge/'.$log_file); ?>" onclick="return confirm('Are you sure you want to delete this log file?')"><?php echo lang('log_delete1_button'); ?></a>
		</div>
	<?php endif; ?>

<?php endif; ?>
