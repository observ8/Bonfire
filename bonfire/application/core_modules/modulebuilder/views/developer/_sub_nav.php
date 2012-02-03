<div id="sub-nav" class="button-group">
	<a href="<?php echo site_url(SITE_AREA .'/developer/modulebuilder') ?>" <?php echo $this->uri->segment(4) == '' ? 'class="current"' : '' ?> ><?php echo lang('bf_action_list'); ?></a>
	<a href="<?php echo site_url(SITE_AREA .'/developer/modulebuilder/create') ?>" <?php echo $this->uri->segment(4) == 'create' ? 'class="current"' : '' ?> ><?php echo lang('mb_new_module'); ?></a>
</div>