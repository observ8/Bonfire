<p class="intro"><?php e(lang('role_intro')) ?></p>

<?php if (isset($role_counts) && is_array($role_counts) && count($role_counts)) : ?>

	<table class="zebra-striped">
		<thead>
			<tr>
				<th style="width: 10em"><?php echo lang('role_account_type'); ?></th>
				<th><?php echo lang('role_description') ?></th>
				<th class="text-center" style="width: 5em"># <?php echo lang('bf_users'); ?></th>
				<th class="text-center" style="width: 5em">% <?php echo lang('bf_users'); ?></th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($roles as $role) : ?>
			<tr>
				<td><?php echo anchor(SITE_AREA .'/settings/roles/edit/'. $role->role_id, $role->role_name, 'class="ajaxify"') ?></td>
				<td><?php e($role->description) ?></td>
				<td class="text-center"><?php
						$count = 0;
						foreach ($role_counts as $r)
						{
							if ($role->role_name == $r->role_name)
							{
								$count = $r->count;
							}
						}

						echo $count;
					?>
				</td>
				<td class="text-center"><?php echo $count && $total_users ? number_format(($count / $total_users) * 100, 2) .'%' : '--'; ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>

<?php endif; ?>
