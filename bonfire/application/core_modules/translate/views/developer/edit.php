<style>
form .input { margin-left: 50%; }
form .input input { width: 95%; }
form label { width: 48%; }
form .actions { padding-left: 50%; }
</style>

<p><b><?php echo lang('tr_language') .': '. ucfirst($trans_lang) ?></b></p>

<?php if (isset($orig) && is_array($orig) && count($orig)) : ?>

	<?php echo form_open(current_url() .'?lang='. htmlentities($trans_lang) .'&file='. $lang_file); ?>
		<input type="hidden" name="trans_lang" value="<?php e($trans_lang) ?>" />
	
		<?php foreach ($orig as $key => $val) : ?>
		<div class="clearfix">
			<label><?php e($val) ?></label>
			<div class="input">
				<input type="text" name="lang[<?php echo $key ?>]" value="<?php echo isset($new[$key]) ? $new[$key] : $val ?>" />
			</div>
		</div>
		<?php endforeach; ?>
		
		<div class="actions">
			<input type="submit" name="submit" class="btn primary" value="<?php e(lang('bf_action_save')) ?>" /> <?php e(lang('bf_or')) ?> 
			<a href="<?php echo site_url(SITE_AREA .'/developer/translate?lang='. $trans_lang); ?>">
				<?php e(lang('bf_action_cancel')); ?>
			</a>
		</div>
	</form>

<?php else : ?>

<?php endif; ?>
