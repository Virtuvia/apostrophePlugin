<?php
  // Compatible with sf_escaping_strategy: true
  $form = isset($form) ? $sf_data->getRaw('form') : null;
  $item = isset($item) ? $sf_data->getRaw('item') : null;
?>
<?php use_helper('I18N', 'jQuery', 'a') ?>

<?php include_partial('aMedia/edit', array('item' => $item, 'form' => $form, 'withPreview' => false)) ?>