<div id="sub-nav" class="button-group">
	<a href="<?php echo site_url(SITE_AREA .'/reports/activities') ?>" <?php echo $this->uri->segment(4) == '' ? 'class="current"' : '' ?> ><?php echo lang('activity_home'); ?></a>
	<a href="<?php echo site_url(SITE_AREA .'/reports/activities/activity_user') ?>" <?php echo $this->uri->segment(4) == 'activity_user' ? 'class="current"' : '' ?> ><?php echo lang('activity_user'); ?></a>
	<a href="<?php echo site_url(SITE_AREA .'/reports/activities/activity_module') ?>" <?php echo $this->uri->segment(4) == 'activity_module' ? 'class="current"' : '' ?> ><?php echo lang('activity_modules') ?></a>
	<a href="<?php echo site_url(SITE_AREA .'/reports/activities/activity_date') ?>" <?php echo $this->uri->segment(4) == 'activity_date' ? 'class="current"' : '' ?> ><?php echo lang('activity_date') ?></a>
</div>
