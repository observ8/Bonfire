	<footer>
		<div class="container">
			<p>Page rendered in {elapsed_time} seconds. {memory_usage} memory used.<br/>
			Built with <a href="http://cibonfire.com" target="_blank">Bonfire</a></p>
		</div>
	</footer>

	<div id="shortkeys_dialog" title="Shortcut Keys" style="display: none">
		<p>
			<?php echo lang('bf_keyboard_shortcuts') ?>
			<?php if (isset($shortcut_data) && is_array($shortcut_data['shortcut_keys'])): ?>
			<ul>
			<?php foreach($shortcut_data['shortcut_keys'] as $key => $data): ?>
				<li><span><?php echo $data?></span> : <?php echo $shortcut_data['shortcuts'][$key]['description']; ?></li>
			<?php endforeach; ?>
			</ul>
			<?php endif;?>
		</p>
	</div>

	<div id="debug"><!-- Stores the Profiler Results --></div>
	<script src="<?php echo base_url('assets/js/jquery-1.7.1.min.js') ?>"></script>
	<?php echo Assets::js(); ?>
</body>
</html>