<div class="well shallow-well">
	<?php render_filter_first_letter(lang('us_filter_first_letter')); ?>
</div>

<ul class="tabs" >
	<li <?php echo $filter=='' ? 'class="active"' : ''; ?>><a href="<?php echo $current_url; ?>">All Users</a></li>
	<li <?php echo $filter=='banned' ? 'class="active"' : ''; ?>><a href="<?php echo $current_url .'?filter=banned'; ?>">Banned</a></li>
	<li <?php echo $filter=='deleted' ? 'class="active"' : ''; ?>><a href="<?php echo $current_url .'?filter=deleted'; ?>">Deleted</a></li>
	<li <?php echo $filter=='role' ? 'class="active"' : ''; ?> class="dropdown" data-dropdown="dropdown">
		<a href="#" class="drodown-toggle">By Role <?php echo isset($filter_role) ? ": $filter_role" : ''; ?></a>
		<ul class="dropdown-menu">
		<?php foreach ($roles as $role) : ?>
			<li>
				<a href="<?php echo site_url(SITE_AREA .'/settings/users?filter=role&role_id='. $role->role_id) ?>">
					<?php echo $role->role_name; ?>
				</a>
			</li>
		<?php endforeach; ?>
		</ul>
	</li>
</ul>

<?php echo $this->dataset->table_open(); ?>

<?php if (isset($results) && is_array($results) && count($results)) : ?>
	<?php foreach ($results as $user) : ?>
	<tr>
		<td>
			<input type="checkbox" name="checked[]" value="<?php echo $user->id ?>" />
		</td>
		<td><?php echo $user->id ?></td>
		<td>
			<a href="<?php echo site_url(SITE_AREA .'/settings/users/edit/'. $user->id); ?>"><?php echo $user->username; ?></a>
			<?php if ($user->banned) echo '<span class="label warning">Banned</span>'; ?>
		</td>
		<td><?php echo $user->display_name ?></td>
		<td>
			<a href="mailto://<?php echo $user->email ?>"><?php echo $user->email ?></a>
		</td>
		<td>
			<?php 
				if ($user->last_login != '0000-00-00 00:00:00')
				{
					echo date('M j, y g:i A', strtotime($user->last_login));
				}
				else
				{
					echo '---';
				}
			?>
		</td>
	</tr>
	<?php endforeach; ?>
<?php else: ?>
	<tr>
		<td colspan="6">No users found that match your selection.</td>
	</tr>
<?php endif; ?>

<?php echo $this->dataset->table_close(); ?>