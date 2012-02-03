<?php if (validation_errors()) : ?>
<div class="notification error">
	<?php echo validation_errors(); ?>
</div>
<?php endif; ?>

<p class="small"><?php echo lang('bf_required_note'); ?></p>

<?php if (isset($user) && $user->role_name == 'Banned') : ?>
<div class="notification attention">
	<p><?php echo lang('us_banned_admin_note'); ?></p>
</div>
<?php endif; ?>

<?php echo form_open($this->uri->uri_string(), 'class="constrained ajax-form"'); ?>

	<?php
		// Email
		echo form_email(
			array(
				'name'	=> 'email',
				'value'		=> isset($user) ? $user->email : set_value('email'),
				'required'	=> 'required',
			),
			null,
			lang('bf_email')
		);
		
		// Username
		if ( $this->settings_lib->item('auth.login_type') !== 'email' OR $this->settings_lib->item('auth.use_usernames'))
		{
			echo form_input(
				array(
					'name'	=> 'username',
					'value'		=> isset($user) ? $user->username : set_value('username'),
					'required'	=> 'required',
				),
				null,
				lang('bf_username')
			);
		}
	?>

	<br />
	
	<?php
		// Password
		echo form_password(
			array(
				'name'	=> 'password',
				'id'	=> 'password',
				'value'	=> ''
			),
			null,
			lang('bf_password')
		);
		
		// Pass Confirm
		echo form_password(
			array(
				'name'	=> 'pass_confirm',
				'id'	=> 'pass_confirm',
				'value'	=> ''
			),
			null,
			lang('bf_password_confirm')
		);
	?>
	
	<?php if (has_permission('Bonfire.Roles.Manage')) :?>
	<fieldset>
		<legend><?php echo lang('us_role'); ?></legend>
		
		<div>
			<label for="role_id"><?php echo lang('us_role'); ?></label>
			<select name="role_id">
			<?php if (isset($roles) && is_array($roles) && count($roles)) : ?>
				<?php foreach ($roles as $role) : ?>
					<?php if (has_permission('Permissions.'. ucfirst($role->role_name) .'.Manage')) : ?>
				<option value="<?php echo $role->role_id ?>" <?php echo isset($user) && $user->role_id == $role->role_id ? 'selected="selected"' : '' ?> <?php echo !isset($user) && $role->default == 1 ? 'selected="selected"' : ''; ?>>
					<?php echo ucfirst($role->role_name) ?>
				</option>
					<?php endif; ?>
				<?php endforeach; ?>
			<?php endif; ?>
			</select>
		</div>
	</fieldset>
	<?php endif; ?>
	
	<fieldset>
		<legend>Custom</legend>
	
		<?php echo Meta::render_fields('user', $this->auth->user_id()); ?>
	</fieldset>
	
	<div class="submits">
		<input type="submit" name="submit" value="<?php echo lang('bf_action_save') ?> " /> <?php echo lang('bf_or') ?> <?php echo anchor(SITE_AREA .'/settings/users', lang('bf_action_cancel')); ?>
	</div>

	<?php if (isset($user) && has_permission('Permissions.'. ucfirst($user->role_name).'.Manage') && $user->id != $this->auth->user_id()) : ?>
	<div class="box delete rounded">
		<a class="button" id="delete-me" href="<?php echo site_url(SITE_AREA .'/settings/users/delete/'. $user->id); ?>" onclick="return confirm('<?php echo lang('us_delete_account_confirm'); ?>')"><?php echo lang('us_delete_account'); ?></a>
		
		<?php echo lang('us_delete_account_note'); ?>
	</div>
	<?php endif; ?>

<?php echo form_close(); ?>