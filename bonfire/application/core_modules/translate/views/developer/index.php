<style>
	form { margin: 0; }
</style>
<div class="well">
	
	<?php echo form_open(); ?>
		<?php e(lang('tr_current_lang')); ?>
		
		<select name="trans_lang" id="trans_lang">
		<?php foreach ($languages as $lang) :?>
			<option value="<?php echo $lang ?>" <?php echo isset($trans_lang) && $trans_lang == $lang ? 'selected="selected"' : '' ?>><?php echo ucfirst($lang) ?></option>
		<?php endforeach; ?>
			<option value="other"><?php e(lang('tr_other')); ?></option>
		</select>
		
		<input type="text" name="new_lang" id="new_lang" style="display: none" value="" />
	
		<input type="submit" name="select_lang" class="btn small" value="<?php e(lang('tr_select_lang')); ?>" />
	</form>
</div>

<!-- Core -->
<table class="zebra-striped">
	<thead>
		<tr>
			<th><?php echo lang('tr_core'); ?></th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($lang_files as $file) :?>
		<tr>
			<td>
				<a href="<?php echo site_url(SITE_AREA .'/developer/translate/edit?lang='. $trans_lang .'&file='. $file) ?>">
					<?php e($file); ?>
				</a>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>


<!-- Modules -->
<table class="zebra-striped">
	<thead>
		<tr>
			<th><?php e(lang('tr_modules')); ?></th>
		</tr>
	</thead>
	<tbody>
	<?php if (isset($modules) && is_array($modules) && count($modules)) : ?>
	<?php foreach ($modules as $file) :?>
		<tr>
			<td>
				<a href="<?php echo site_url(SITE_AREA .'/developer/translate/edit?lang='. $trans_lang .'&file='. $file) ?>">
					<?php e($file); ?>
				</a>
			</td>
		</tr>
	<?php endforeach; ?>
	<?php else : ?>
		<tr>
			<td><?php echo lang('tr_no_modules'); ?></td>
		</tr>
	<?php endif; ?>
	</tbody>
</table>

<pre><?php //print_r($lang_files); ?></pre>