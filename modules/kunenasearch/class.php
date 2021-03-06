<?php
/**
 * Kunena Search Module
 * @package Kunena.mod_kunenasearch
 *
 * @copyright (C) 2008 - 2013 Kunena Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link http://www.kunena.org
 **/
defined ( '_JEXEC' ) or die ();

class modKunenaSearch {
	static protected $cssadded = false;

	protected $params = null;

	public function __construct($module, $params) {
		$this->document = JFactory::getDocument ();
		$this->params = $params;
	}

	public function display() {
		// Load CSS only once
		if (self::$cssadded == false) {
			$this->document->addStyleSheet ( JURI::root (true) . '/modules/mod_kunenasearch/tmpl/css/kunenasearch.css' );
			self::$cssadded = true;
		}

		$this->ksearch_button			= $this->params->get('ksearch_button', '');
		$this->ksearch_button_pos		= $this->params->get('ksearch_button_pos', 'right');
		$this->ksearch_button_txt		= $this->params->get('ksearch_button_txt', JText::_('Search'));
		$this->ksearch_width			= intval($this->params->get('ksearch_width', 20));
		$this->ksearch_maxlength		= $this->ksearch_width > 20 ? $this->ksearch_width : 20;
		$this->ksearch_txt				= $this->params->get('ksearch_txt', JText::_('Search...'));
		$this->ksearch_moduleclass_sfx	= $this->params->get('moduleclass_sfx', '');
		$this->url						= KunenaRoute::_('index.php?option=com_kunena');

		require(JModuleHelper::getLayoutPath('mod_kunenasearch'));
	}
}
