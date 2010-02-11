<?php
/*
Global Tools
This will be the top bar across the site when logged in.

It will contain global admin buttons like Users, Page Settings, and the Breadcrumb.

These are mostly links to independent modules. 
*/
?>

<div id="a-global-toolbar">
  <?php // All logged in users, including guests with no admin abilities, need access to the ?>
  <?php // logout button. But if you have no legitimate admin roles, you shouldn't see the ?>
  <?php // apostrophe or the global buttons ?>

  <?php $buttons = aTools::getGlobalButtons() ?>
  <?php $page = aTools::getCurrentPage() ?>
  <?php $pageEdit = $page && $page->userHasPrivilege('edit') ?>
  <?php $cmsAdmin = $sf_user->hasCredential('cms_admin') ?>

  <?php if ($cmsAdmin || count($buttons) || $pageEdit): ?>

  	<?php // The Apostrophe ?>
  	<div class="a-global-toolbar-apostrophe">
  		<?php echo link_to('Apostrophe Now','/', array('id' => 'the-apostrophe')) ?>
  		<ul class="a-global-toolbar-buttons a-controls">
	
				<?php if ($page): ?>
					<li><a href="#" class="a-btn icon a-page-small" onclick="return false;" id="a-this-page-toggle">This Page</a></li>
				<?php endif ?>
  			<?php $buttons = aTools::getGlobalButtons() ?>
  			<?php foreach ($buttons as $button): ?>
  			  <?php if ($button->getTargetEnginePage()): ?>
  			    <?php aRouteTools::pushTargetEnginePage($button->getTargetEnginePage()) ?>
  			  <?php endif ?>
  			  <li><?php echo link_to($button->getLabel(), $button->getLink(), array('class' => 'a-btn icon ' . $button->getCssClass())) ?></li>
  			<?php endforeach ?>
				<?php if (0): ?><li><?php echo jq_link_to_function('Cancel','',array('class' => 'a-btn icon a-cancel event-default', )) ?></li><?php endif ?>
  		</ul>
  	</div>


  	<div class="a-global-toolbar-user-settings a-personal-settings-container">
			<div id="a-personal-settings"></div>
    </div>

	<?php endif ?>

		<?php // Login / Logout ?>
		<div class="a-global-toolbar-login a-login">
			<?php include_partial("a/login") ?>
		</div>
		
		<?php // Administrative breadcrumb ?>
  	<?php if ($page && (!$page->admin) && $cmsAdmin && $pageEdit): ?>
		<div class="a-global-toolbar-this-page" id="a-global-toolbar-this-page">
  		<?php include_component('a', 'breadcrumb') # Breadcrumb Navigation ?>
  		<div id="a-page-settings"></div>
		</div>
  	<?php endif ?>
  	
</div>

<?php if (aTools::getCurrentPage()): ?>
	<?php include_partial('a/historyBrowser', array('page' => $page)) ?>
<?php endif ?>

<div class="a-page-overlay"></div>


<script type="text/javascript">
	$(document).ready(function() {
		var thisPageStatus = 0;
		var thisPage = $('#a-this-page-toggle')
		$('#a-global-toolbar-this-page').hide();
		thisPage.click(function(){
			thisPage.toggleClass('open');
			$('#a-breadcrumb').addClass('show');
			$('#a-global-toolbar-this-page').slideToggle();
			thisPageStatus = (thisPageStatus == 1 ? 0 : 1);
			if (!thisPageStatus)
			{
				$('.a-page-overlay').hide();				
			}
		})
		<?php if ($page->getSlug() == '/'): ?>
		$('#a-breadcrumb').addClass('home-page');
		<?php endif ?>
	});
</script>
