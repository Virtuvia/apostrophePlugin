<?php
  // Compatible with sf_escaping_strategy: true
  $form = isset($form) ? $sf_data->getRaw('form') : null;
?>

<?php use_helper('a') ?>

<a href="#add-page" class="a-btn icon a-add a-create-page" id="a-create-page-button" onclick="return false;"><span class="icon"></span><?php echo __("Add Page", null, 'apostrophe') ?></a>

<form method="POST" action="<?php echo url_for('a/create') ?>" id="a-create-page-form" class="a-ui a-options a-page-form a-create-page-form dropshadow">

	<div class="a-form-row a-hidden"><?php echo $form->renderHiddenFields() ?></div>
	<div class="a-form-row a-hidden"><?php echo $form['parent']->render(array('id' => 'a-create-page-parent', )) ?></div>

	<?php echo $form->renderGlobalErrors() ?>	

	<div class="a-options-section">	
		<div class="a-form-row a-page-title">
			<div class="a-form-field">
				<?php echo $form['title']->render(array('id' => 'a-create-page-title',  'class' => 'a-page-title-field')) ?>
			</div>
			<?php echo $form['title']->renderError() ?>
		</div>
	</div>
	
 	<hr/>

	<div class="a-options-section">	
		<div class="a-form-row a-page-type">
			<?php echo $form['engine']->renderLabel(__('Page Type', array(), 'apostrophe')) ?>
			<div class="a-form-field">
				<?php echo $form['engine']->render(array('id' => 'a-create-page-type', )) ?>
			</div>
			<?php echo $form['engine']->renderError() ?>
		</div>
		
		<div class="a-form-row a-page-template">
			<?php echo $form['template']->renderLabel(__('Page Template', array(), 'apostrophe')) ?>
			<div class="a-form-field">
				<?php echo $form['template']->render(array('id' => 'a-create-page-template', )) ?>
			</div>
			<?php echo $form['template']->renderError() ?>
		</div>
	</div>	

	<hr/>	

	<div class="a-options-section">
		<ul class="a-ui a-controls">
	  	<li><input type="submit" class="a-btn a-submit" value="<?php echo __('Create Page', null, 'apostrophe') ?>" /></li>
	  	<li><a href="#cancel" onclick="return false;" class="a-btn icon a-cancel a-options-cancel" title="<?php echo __('Cancel', null, 'apostrophe') ?>"><?php echo __("Cancel", null, 'apostrophe') ?></a></li>
		</ul>
	</div>
	
</form>

<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {

		var aPageTypeSelect = $('#a-create-page-type');
		var aPageTemplateSelect = $('.a-form-row.a-page-template');

		if (aPageTypeSelect.attr('selectedIndex')) 
		{
			aPageTemplateSelect.hide();
		}
		else
		{
			aPageTemplateSelect.show();				
		};			

		aPageTypeSelect.change(function(){
			if (aPageTypeSelect.attr("selectedIndex")) 
			{
				aPageTemplateSelect.hide();
			}
			else
			{
				aPageTemplateSelect.show();				
			};			
		});

		aInputSelfLabel('#a-create-page-title', <?php echo json_encode(__('Page Title', null, 'apostrophe')) ?>);

		$('#a-create-page-button').click(function(){
			$('#a-create-page-title').focus();
		});		
	});
</script>

<?php a_js_call('apostrophe.menuToggle(?)', array('button' => '#a-create-page-button', 'classname' => '', 'overlay' => true)) ?>
