<?php
  // Compatible with sf_escaping_strategy: true
  $categories = isset($categories) ? $sf_data->getRaw('categories') : null;
?>
<?php use_helper('I18N') ?>
  
<?php $links = array() ?>
  <?php foreach ($categories as $category): ?>
  <?php $links[] = link_to($category, "aMedia/index?" . http_build_query(array("category" => $category->name))) ?>
<?php endforeach ?>
<?php echo implode(__(", ", null, 'apostrophe'), $links) ?>