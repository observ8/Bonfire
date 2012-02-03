<?php if ($log_threshold == 0) : ?>
	<div class="notification attention">
		<p><?php e(lang('log_not_enabled')); ?></p>
	</div>
<?php endif; ?>

<p class="intro"><?php e(lang('log_intro'))  ?></p>

<?php if (isset($logs) && is_array($logs) && count($logs) && count($logs) > 1) : ?>

	<?php echo form_open(); ?>

	<table class="zebra-striped">
		<thead>
			<tr>
				<th class="column-check"><input class="check-all" type="checkbox" /></th>
				<th><?php e(lang('log_date')) ?></th>
				<th><?php e(lang('log_file')) ?></th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="3">
					<?php echo lang('bf_with_selected'); ?>:
					<input type="submit" name="submit" class="btn" value="<?php echo lang('bf_action_delete') ?>" />
				</td>
			</tr>
		</tfoot>
		<tbody>
		<?php foreach ($logs as $log) :?>
			<?php if ($log != 'index.html') : ?>
			<tr>
				<td class="column-check">
					<input type="checkbox" value="<?php e($log) ?>" name="checked[]" />
				</td>
				<td>
					<a href="<?php e(site_url(SITE_AREA .'/developer/logs/view/'. $log)) ?>">
						<b><?php e(date('F j, Y', strtotime(str_replace('.php', '', str_replace('log-', '', $log)))) ); ?></b></td>
					</a>
				<td><?php e($log) ?></td>
			</tr>
			<?php endif; ?>
		<?php endforeach; ?>
		</tbody>
	</table>

	</form>

	<?php echo $this->pagination->create_links(); ?>

	<!-- Purge? -->
	<div class="box delete rounded">
		<?php echo lang('log_delete_note'); ?>

		<a class="btn danger" href="<?php echo site_url(SITE_AREA .'/developer/logs/purge/'); ?>" onclick="return confirm('Are you sure you want to delete all log files?')"><?php echo lang('log_delete_button'); ?></a>
	</div>
<?php else : ?>

	<div class="notification information">
		<p><?php echo lang('log_no_logs'); ?></p>
	</div>
<?php endif; ?>



