<div id="sub-nav" class="button-group">
	<a href="<?php echo site_url(SITE_AREA .'/developer/database') ?>" <?php echo $this->uri->segment(4) == '' && $this->uri->segment(3) != 'migrations' ? 'class="current"' : '' ?> ><?php echo lang('db_maintenance'); ?></a>
	<a href="<?php echo site_url(SITE_AREA .'/developer/database/backups') ?>" <?php echo $this->uri->segment(4) == 'backups' ? 'class="current"' : '' ?> ><?php echo lang('db_backups'); ?></a>
	<a href="<?php echo site_url(SITE_AREA .'/developer/migrations') ?>" <?php echo $this->uri->segment(3) == 'migrations' ? 'class="current"' : '' ?> ><?php echo lang('db_migrations'); ?></a>
</div>
