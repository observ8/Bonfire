<?php if (validation_errors()) : ?>
<div class="notification error">
	<?php echo validation_errors(); ?>
</div>
<?php endif; ?>

<?php echo form_open($this->uri->uri_string(), 'class="constrained ajax-form"'); ?>

	<div class="clearfix <?php echo form_has_error('role_name') ? 'error' : ''; ?>">
		<label for="role_name"><?php echo lang('role_name'); ?></label>
		<div class="input">
			<input type="text" name="role_name" class="medium" value="<?php echo isset($role) ? $role->role_name : '' ?>" />
			<span class="help-inline"><?php echo form_error('role_name'); ?></span>
		</div>
	</div>

	<div class="clearfix <?php echo form_has_error('description') ? 'error' : ''; ?>" style="vertical-align: top">
		<label for="description"><?php echo lang('bf_description'); ?></label>
		<div class="input">
			<textarea name="description" rows="3"><?php echo isset($role) ? $role->description : '' ?></textarea>
			<p class="help-inline"><?php echo form_error('description') ? form_error('description') : lang('role_max_desc_length'); ?></p>
		</div>
	</div>

	<div class="clearfix <?php echo form_has_error('login_destination') ? 'error' : ''; ?>">
		<label for="login_destination"><?php echo lang('role_login_destination'); ?>?</label>
		<div class="input">
			<input type="text" name="login_destination" class="medium" value="<?php echo isset($role) ? $role->login_destination : '' ?>"  />
			<span class="help-inline"><?php echo form_error('login_destination') ? form_error('login_destination') : lang('role_destination_note'); ?></span>
		</div>
	</div>

	<div class="clearfix <?php echo form_has_error('default') ? 'error' : ''; ?>">
		<label for="default"><?php echo lang('role_default_role'); ?>?</label>
		<div class="input">
			<input type="checkbox" name="default" value="1" <?php echo isset($role) && $role->default == 1 ? 'checked="checked"' : '' ?> />
			<span class="help-inline"><?php echo lang('role_default_note'); ?></span>
		</div>
	</div>

	<div class="clearfix">
		<label for="can_delete"><?php echo lang('role_can_delete_role'); ?>?</label>
		<div class="input">
			<div class="inputs-list">
				<label>
					<input type="radio" name="can_delete" value="1" <?php echo isset($role) && $role->can_delete == 1 ? 'checked="checked"' : '' ?> /> Yes
				</label>
				<label>
					<input type="radio" name="can_delete" value="0" <?php echo isset($role) && $role->can_delete == 0 ? 'checked="checked"' : '' ?> /> No
				</label>
				<span class="help-inline" style="display: inline"><?php echo lang('role_can_delete_note'); ?></span>
			</div>
		</div>
	</div>

	<!-- Permissions -->
	<?php if (has_permission('Permissions.Settings.Manage')) : ?>
	<fieldset>
		<legend><?php echo lang('role_permissions'); ?></legend>

		<div class="input">
			<p><?php echo lang('role_permissions_check_note'); ?></p>

			<?php echo modules::run('roles/settings/matrix'); ?>
		</div>

	</fieldset>
	<?php endif; ?>

	<div class="actions">
		<input type="submit" name="submit" class="btn primary" value="<?php echo lang('role_save_role'); ?>" /> <?php echo lang('bf_or').' '.anchor(SITE_AREA .'/settings/roles', lang('bf_action_cancel')); ?>
	</div>

	<br/>

	<?php if (isset($role) && $role->can_delete && has_permission('Bonfire.Roles.Delete')) : ?>
	<div class="box delete rounded">
		<h3><?php echo lang('role_delete_role'); ?></h3>

		<p><?php echo lang('role_delete_note'); ?></p>

		<a class="btn danger" href="<?php echo site_url(SITE_AREA .'/settings/roles/delete/'. $role->role_id); ?>" onclick="return confirm('Are you sure you want to delete this role?')"><?php echo lang('role_delete_role'); ?></a>
	</div>
	<?php endif; ?>
<?php echo form_close(); ?>
