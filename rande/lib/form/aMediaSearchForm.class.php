<?php

class aMediaSearchForm extends sfForm
{
  public function configure()
  {
    $this->setWidget('search', new sfWidgetFormInputText(array(), array('id' => 'a-media-search', 'class' => 'a-search-field')));
    $this->widgetSchema->getFormFormatter()->setTranslationCatalogue('apostrophe');
    
  }
}
