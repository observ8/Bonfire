<div id="sub-nav" class="button-group">
	<a href="<?php echo site_url(SITE_AREA .'/settings/permissions') ?>" <?php echo $this->uri->segment(4) == '' ? 'class="current"' : '' ?> ><?php echo lang('bf_action_list'); ?></a>
	<a href="<?php echo site_url(SITE_AREA .'/settings/permissions/create') ?>" <?php echo $this->uri->segment(4) == 'create' ? 'class="current"' : '' ?> ><?php echo lang('bf_action_create'); ?></a>
	<a href="<?php echo site_url(SITE_AREA .'/settings/roles/permission_matrix') ?>" ><?php echo lang('permissions_matrix'); ?></a>
</div>
