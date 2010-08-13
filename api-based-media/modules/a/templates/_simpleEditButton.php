<?php if (!isset($controlsSlot)): ?>
  <?php $controlsSlot = true ?>
<?php endif ?>
<?php if ($controlsSlot): ?>
<?php slot("a-slot-controls-$name-$permid") ?>
<?php endif ?>
	<li class="a-controls-item edit">
  <?php echo jq_link_to_function(isset($label) ? $label : "edit", "", 
				array(
					'id' => 'a-slot-edit-'.$name.'-'.$permid, 
					'class' => isset($class) ? $class : 'a-btn icon a-edit', 
					'title' => isset($title) ? $title : 'Edit', 
	)) ?>
	<script type="text/javascript">
	$(document).ready(function(){
		var editBtn = $('#a-slot-edit-<?php echo $name ?>-<?php echo $permid ?>');
		var editSlot = $('#a-slot-<?php echo $name ?>-<?php echo $permid ?>');
		editBtn.click(function(event){
			$(this).parent().addClass('editing-now');
			$(editSlot).children('.a-slot-content').children('.a-slot-content-container').hide(); // Hide content
			$(editSlot).children('.a-slot-content').children('.a-slot-content-container').hide(); // Hide content
			$(editSlot).children('.a-slot-content').children('.a-slot-form').fadeIn();							// Show form
			$(editSlot).children('.a-controls-item variant').hide();
			aUI($(this).parents('.a-slot').attr('id'));
			return false;
		});
	})
	</script>
	</li>
<?php if ($controlsSlot): ?>
<?php end_slot() ?>
<?php endif ?>
  