<?php 
	Assets::add_js(array(
			'jquery-ui-1.8.13.min.js',
			'jwerty.js',
			'plugins.js'
		), 
		'external',
		true
	);
	if (isset($shortcut_data) && is_array($shortcut_data['shortcut_keys'])) {
		Assets::add_js($this->load->view('ui/shortcut_keys', $shortcut_data, true), 'inline');
	}
?>
<?php echo theme_view('_header'); ?>

<div class="main">
	<div class="container">
		<?php echo Template::message(); ?>	

		<?php echo Template::yield(); ?>
	</div>
</div>
	
<?php echo theme_view('_footer'); ?>
