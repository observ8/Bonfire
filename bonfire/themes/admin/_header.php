<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <title><?php echo isset($toolbar_title) ? $toolbar_title .' : ' : ''; ?> <?php echo config_item('site.title') ?></title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <?php echo Assets::css(null, 'screen', true); ?>
    
    <script src="<?php echo base_url() .'assets/js/head.min.js' ?>"></script>
	<script>
	head.feature("placeholder", function() {
		var inputElem = document.createElement('input');
		return new Boolean('placeholder' in inputElem);
	});
	</script>
</head>
<body class="desktop">

	<noscript>
		<p>Javascript is required to use Bonfire's admin.</p>
	</noscript>

	<div class="topbar" id="topbar" data-dropdown="dropdown">
		<div class="topbar-inner">
			<div class="container">
				<h1 class="branding"><?php e(config_item('site.title')); ?></h1>
			
				<?php if(isset($shortcut_data) && is_array($shortcut_data['shortcuts']) && is_array($shortcut_data['shortcut_keys']) && count($shortcut_data['shortcut_keys'])):?><img src="<?php echo Template::theme_url('images/keyboard-icon.png') ?>" id="shortkeys_show" title="Keyboard Shortcuts" alt="Keyboard Shortcuts"/><?php endif;?>
				<ul class="nav secondary-nav">
					<li class="dropdown">
						<a href="<?php echo site_url(SITE_AREA .'/settings/users/edit/'. $this->auth->user_id()) ?>" id="tb_email" class="dropdown-toggle" title="<?php echo lang('bf_user_settings') ?>">
							<?php echo config_item('auth.use_usernames') ? (config_item('auth.use_own_names') ? $this->auth->user_name() : $this->auth->username()) : $this->auth->email() ?>
						</a>
						
						<ul class="dropdown-menu">
							<li>
								<a href="<?php echo site_url('logout'); ?>">Logout</a>
							</li>
						</ul>
					</li>
				</ul>
				<?php echo Contexts::render_menu('both'); ?>
			</div><!-- /container -->
			<div style="clearfix"></div>
		</div><!-- /topbar-inner -->
		
	</div><!-- /topbar -->
	
	<div id="nav-bar">
		<div class="container">
			<?php if (isset($toolbar_title)) : ?>
				<h1><?php echo $toolbar_title ?></h1>
			<?php endif; ?>
		
			<?php Template::block('sub_nav', ''); ?>
		</div>
	</div>