<div id="sub-nav" class="button-group">
	<a href="<?php echo site_url(SITE_AREA .'/developer/logs') ?>" <?php echo $this->uri->segment(4) != 'settings' ? 'class="current"' : '' ?> ><?php echo lang('log_logs'); ?></a>
	<a href="<?php echo site_url(SITE_AREA .'/developer/logs/settings') ?>" <?php echo $this->uri->segment(4) == 'settings' ? 'class="current"' : '' ?> ><?php echo lang('log_settings'); ?></a>
</div>
