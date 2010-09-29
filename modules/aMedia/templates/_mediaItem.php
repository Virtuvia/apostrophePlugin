<?php
  // Compatible with sf_escaping_strategy: true
  $mediaItem = isset($mediaItem) ? $sf_data->getRaw('mediaItem') : null;
?>
<?php use_helper('a') ?>
<?php $type = $mediaItem->getType() ?>
<?php $id = $mediaItem->getId() ?>
<?php $domId = 'a-media-thumb-link-' . $id ?>
<?php $serviceUrl = $mediaItem->getServiceUrl() ?>
<?php $slug = $mediaItem->getSlug() ?>
<?php $format = $mediaItem->getFormat() ?>
<?php $width = $mediaItem->getWidth() ?>
<?php $height = $mediaItem->getHeight() ?>
<?php $embeddable = $mediaItem->getEmbeddable() ?>
<?php (isset($layout['showSuccess'])) ? $displayWidth = 720 : $displayWidth = 340 ?>

<?php if (aMediaTools::isSelecting()): ?>
	<?php if (aMediaTools::isMultiple() || ($type === 'image')): ?>
  	<?php // This was more complex before the a.js refactoring ?>
    <?php $linkAttributes = 'href= "#select-image"' ?>
  <?php else: ?>
    <?php // Non-image single select. The multiple add action is a bit of a misnomer here ?>
    <?php // and redirects to aMedia/selected after adding the media item ?>
    <?php $linkAttributes = 'href = "' . url_for("aMedia/multipleAdd?id=$id") . '"' ?>
  <?php endif ?>
<?php else: ?>
  <?php $linkAttributes = 'href = "' . url_for("aMedia/show?" . http_build_query(array("slug" => $slug))) . '"' ?>
<?php endif ?>

<div id="a-media-item-<?php echo $mediaItem->getId() ?>" class="a-ui a-media-item <?php echo ($i%$layout['columns'] == 0)? 'first':'' ?> <?php echo ($i%$layout['columns'] < $layout['columns'] - 1)? '' : 'last' ?> a-format-<?php echo $format ?> a-type-<?php echo $type ?><?php echo ($embeddable) ? ' a-embedded-item':'' ?>">

	<?php if (!isset($layout['showSuccess'])): ?>
	<div class="a-media-item-thumbnail">
	  <a <?php echo $linkAttributes ?> class="a-media-thumb-link" id="<?php echo $domId ?>">

			<?php // Embeddable Media (Videos) ?>
	    <?php if ($embeddable): ?><span class="a-media-play-btn"></span><?php endif ?>

			<?php // PDFs with an image preview ?>
	    <?php if ($width && ($type == 'pdf')): ?><span class="a-media-pdf-btn"></span><?php endif ?>

			<?php // Audio Files ?>
      <?php if ($type == 'audio'): ?>
  			<?php $playerOptions = array('width' => $displayWidth, 'download' => true, 'player' => 'lite') ?>
  			<?php include_partial('aAudioSlot/'.$playerOptions['player'].'Player', array('item' => $mediaItem, 'uniqueID' => $mediaItem->getId(), 'options' => $playerOptions)) ?>			
  		<?php else: ?>
			<?php // Images or anything else with an image thumbnail ?>	
  			<?php if ($width): ?>
 	      	<img src="<?php echo url_for($mediaItem->getScaledUrl(aMediaTools::getOption('gallery_constraints'))) ?>" />						
  	    <?php else: ?>
			<?php // Files (Word Docs, Powerpoints, Spreadsheets) ?>	
  	      <?php // We can't render this format on this server but we need a placeholder thumbnail ?>
  				<span class="a-media-type <?php echo $format ?>" ><b><?php echo $format ?></b></span>
  	    <?php endif ?>			
  		<?php endif ?>
	  </a>
	</div>
	<?php endif ?>
	
	<?php if ($embeddable): ?>
	<div class="a-media-item-embed<?php echo (!isset($layout['showSuccess']))? ' a-hidden':'' ?>">
		<?php // Until we can get real dimensions from an embed ?>
		<?php // Let's just make a 4:3 aspect object ?>
		<?php echo $mediaItem->getEmbedCode($displayWidth, false, 'c', $format, false) ?>
	</div>
	<?php endif ?>

	<div class="a-media-item-information">
		<ul>
			<?php if(isset($layout['fields']['title'])): ?>
				<li class="a-media-item-title <?php if (!$width): ?>no-thumbnail<?php endif ?>">
					<h3>
						<div class="a-media-item-controls">
							<?php include_partial('aMedia/editLinks', array('mediaItem' => $mediaItem, 'layout' => $layout)) ?>
						</div>							
						<a <?php echo $linkAttributes ?> class="a-media-item-title-link"><?php echo htmlspecialchars($mediaItem->getTitle()) ?></a>
					</h3>
				</li>
			<?php endif ?>
		
			<?php // John: you could use $mediaItem->format to choose an icon here. Make sure ?>
			<?php // you have a default icon if it's not on your list of awesome icons ?>
			<?php if(isset($layout['fields']['description'])): ?>
				<li class="a-media-item-description"><?php echo $mediaItem->getDescription() ?></li>
			<?php endif ?>

			<?php if(isset($layout['fields']['link'])): ?>
				<?php if ($mediaItem->getDownloadable()): ?>
				  <li class="a-media-item-link a-media-item-meta a-form-row">
						<?php echo __('<span>Permalink:</span> %urlfield%', array('%urlfield%' => 
						'<input type="text" class="a-select-on-focus" id="a-media-item-link-value-' . $id . '" name="a-media-item-link-value" value="' . url_for("aMediaBackend/original?".http_build_query(array("slug" => $mediaItem->getSlug(),"format" => $mediaItem->getFormat())), true) . '" />'), 'apostrophe') ?>
					</li>
				<?php endif ?>
			<?php endif ?>			
			
			<?php if(isset($layout['fields']['created_at'])): ?>
				<li class="a-media-item-created-at a-media-item-meta"><?php echo __('<span>Uploaded:</span> %date%', array('%date%' => aDate::pretty($mediaItem->getCreatedAt())), 'apostrophe') ?></li>
			<?php endif ?>

			<?php if(isset($layout['fields']['dimensions'])): ?>
			  <?php if ($width): ?>
			    <li class="a-media-item-dimensions a-media-item-meta"><?php echo __('<span>Original Dimensions:</span> %width%x%height%', array('%width%' => $width, '%height%' => $height), 'apostrophe') ?></li>
			  <?php endif ?>
			<?php endif ?>

			<?php if(isset($layout['fields']['credit'])): ?>
				<?php if ($mediaItem->getCredit()): ?>
					<li class="a-media-item-credit a-media-item-meta"><?php echo __('<span>Credit:</span> %credit%', array('%credit%' => htmlspecialchars($mediaItem->getCredit())), 'apostrophe') ?></li>					
				<?php endif ?>
			<?php endif ?>

			<?php if ($layout['name'] != "four-up"): ?>
				<li class="a-media-item-spacer a-media-item-meta">&nbsp;</li>
			<?php endif ?>

			<?php if(isset($layout['fields']['categories'])): ?>
				<?php if (count($mediaItem->getCategories())): ?>
					<li class="a-media-item-categories a-media-item-meta"><?php echo __('<span>Categories:</span> %categories%', array('%categories%' => get_partial('aMedia/showCategories', array('categories' => $mediaItem->getCategories()))), 'apostrophe') ?></li>					
				<?php endif ?>
			<?php endif ?>

			<?php if(isset($layout['fields']['tags'])): ?>
				<?php if (count($mediaItem->getTags())): ?>
					<li class="a-media-item-tags a-media-item-meta"><?php echo __('<span>Tags:</span> %tags%', array('%tags%' => get_partial('aMedia/showTags', array('tags' => $mediaItem->getTags()))), 'apostrophe') ?></li>					
				<?php endif ?>
			<?php endif ?>
			
			<?php if(isset($layout['fields']['view_is_secure'])): ?>
					<li class="a-media-item-permissions a-media-item-meta">
						<?php if ($mediaItem->getViewIsSecure()): ?>			
						  <?php // i18n the type name, then insert it as a placeholder in an i18n'd phrase. Avoids having to i18n a dozen separate phrases ?>			
							<span class="a-media-item-permissions-icon private"></span><?php echo a_('This %type% is private.', array('%type%' => a_($mediaItem->type))) ?>
						<?php else: ?>
							<?php if (0): ?>
								<span class="a-media-item-permissions-icon public"></span><?php echo a_('This %type% can be viewed by everyone.', array('%type%' => a_($mediaItem->type))) ?>								
							<?php endif ?>
						<?php endif ?>
					</li>					
			<?php endif ?>
			
			<?php //this li for the replace and download links can be a partial so it can be used in the edit view. ?>
			<?php if(isset($layout['fields']['downloadable'])): ?>
				<?php if ($mediaItem->getType() !== 'video'): ?>
					<li class="a-media-item-download a-media-item-meta">	
		      	<div class="a-media-item-download-link">  
							<?php echo link_to(__("%buttonspan%Download Original", array('%buttonspan%' => '<span class="icon"></span>'), 'apostrophe'),	"aMediaBackend/original?" .http_build_query(array("slug" => $mediaItem->getSlug(), "format" => $mediaItem->getFormat())), array("class"=>"a-btn icon a-download lite alt")) ?>
						</div>	
					</li>
				<?php endif ?>
			<?php endif ?>	
				
		</ul>
	</div>
</div>

<?php a_js_call('apostrophe.setObjectId(?, ?)', $domId, $id) ?>