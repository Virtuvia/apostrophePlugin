<?php
  // Compatible with sf_escaping_strategy: true
  $name = isset($name) ? $sf_data->getRaw('name') : null;
?>
<?php use_helper('jQuery') ?>
<?php include_component('a', 'area', 
  array('name' => $name, 'refresh' => true, 'preview' => false))?>
