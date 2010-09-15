<?php
  // Compatible with sf_escaping_strategy: true
  $first = isset($first) ? $sf_data->getRaw('first') : null;
  $form = isset($form) ? $sf_data->getRaw('form') : null;
?>
<?php use_helper('I18N') ?>
<?php $previewable = aValidatorFilePersistent::previewAvailable($form['file']->getValue()) ?>
<?php $errors = $form['file']->hasError() ?>

<div class="a-form-row newfile <?php echo(($first || $previewable || $errors) ? "" : "initially-inactive") ?>">
	<?php echo $form['file']->renderError() ?>
	<?php echo $form['file']->render() ?>
	<?php // If you tamper with this, the next form will be missing a default radio button choice ?>
	<?php // This ought to work but the value winds up empty ?>
  <?php echo $form['view_is_secure']->render() ?>
</div>