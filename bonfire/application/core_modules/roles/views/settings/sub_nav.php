<div id="sub-nav" class="button-group">
	<a href="<?php echo site_url(SITE_AREA .'/settings/roles') ?>" <?php echo $this->uri->segment(4) == '' ? 'class="current"' : '' ?> ><?php echo lang('role_roles'); ?></a>
	<a href="<?php echo site_url(SITE_AREA .'/settings/roles/create') ?>" <?php echo $this->uri->segment(4) == 'create' ? 'class="current"' : '' ?> ><?php echo lang('role_new_role'); ?></a>
	<a href="<?php echo site_url(SITE_AREA .'/settings/roles/permission_matrix') ?>" <?php echo $this->uri->segment(4) == 'permission_matrix' ? 'class="current"' : '' ?> ><?php echo lang('matrix_header'); ?></a>
</div>
