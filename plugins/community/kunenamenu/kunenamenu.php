<?php
/**
 * @version		$Id$
 * KunenaMenu Plugin for JomSocial
 * @package plg_jomsocial_kunenamenu
 * @copyright	Copyright (C) 2009 - 2010 Kunena Team. All rights reserved.
 * @license		GNU General Public License <http://www.gnu.org/copyleft/gpl.html>
 * @link		http://www.kunena.com
 */

defined ( '_JEXEC' ) or die ();

$path = JPATH_ROOT . '/components/com_community/libraries/core.php';
if (! is_file ( $path ))
	return;
require_once $path;

class plgCommunityKunenaMenu extends CApplications {
	var $name = "My Kunena Menu";
	var $_name = 'kunenamenu';

	function plgCommunityKunenaMenu(& $subject, $config) {
		//Load Language file.
		JPlugin::loadLanguage ( 'plg_community_kunenamenu', JPATH_ADMINISTRATOR );

		parent::__construct ( $subject, $config );
	}

	protected static function kunenaInstalled() {
		// Kunena detection and version check
		$minKunenaVersion = '1.7';
		if (! class_exists ( 'Kunena' ) || version_compare(Kunena::version(), $minKunenaVersion, '<')) {
			return false;
		}
		return true;
	}

	function onSystemStart() {
		if (! self::kunenaInstalled ()) return;

		//initialize the toolbar object
		$toolbar = CFactory::getToolbar ();

		// Kunena online check
		if (! Kunena::enabled ()) {
			$toolbar->addGroup ( 'KUNENAMENU', JText::_ ( 'PLG_COMMUNITY_KUNENAMENU_KUNENA_OFFLINE' ), JRoute::_ ( 'index.php?option=com_kunena' ) );
			return;
		}
		//adding new 'tab' 'Forum Settings' to JomSocial toolbar
		$toolbar->addGroup ( 'KUNENAMENU', JText::_ ( 'PLG_COMMUNITY_KUNENANENU_FORUM' ), 'index.php?option=com_kunena&func=myprofile&Itemid='.KunenaRoute::getItemid('index.php?option=com_kunena&func=myprofile') );
		if ( $this->params->get('sh_editprofile', 1) ) $toolbar->addItem ( 'KUNENAMENU', 'KUNENAMENU_EDITPROFILE', JText::_ ( 'PLG_COMMUNITY_KUNENAMENU_EDITPROFILE' ),'index.php?option=com_kunena&func=myprofile&do=edit&Itemid='.KunenaRoute::getItemid('index.php?option=com_kunena&func=myprofile&do=edit') );
		if ( $this->params->get('sh_myprofile', 1) ) $toolbar->addItem ( 'KUNENAMENU', 'KUNENAMENU_PROFILE', JText::_ ( 'PLG_COMMUNITY_KUNENAMENU_PROFILE' ), 'index.php?option=com_kunena&func=myprofile&Itemid='.KunenaRoute::getItemid('index.php?option=com_kunena&func=myprofile') );
		if ( $this->params->get('sh_myposts', 1) ) $toolbar->addItem ( 'KUNENAMENU', 'KUNENAMENU_POSTS', JText::_ ( 'PLG_COMMUNITY_KUNENAMENU_POSTS' ), 'index.php?option=com_kunena&func=latest&do=userposts&Itemid='.KunenaRoute::getItemid('index.php?option=com_kunena&func=latest&do=userposts') );
		if ( $this->params->get('sh_mysubscriptions', 1) ) $toolbar->addItem ( 'KUNENAMENU', 'KUNENAMENU_SUBSCRIBES', JText::_ ( 'PLG_COMMUNITY_KUNENAMENU_SUBSCRIBTIONS' ), 'index.php?option=com_kunena&func=latest&do=subscriptions&Itemid='.KunenaRoute::getItemid('index.php?option=com_kunena&func=latest&do=subscriptions') );
		if ( $this->params->get('sh_myfavorites', 1) ) $toolbar->addItem ( 'KUNENAMENU', 'KUNENAMENU_FAVORITES', JText::_ ( 'PLG_COMMUNITY_KUNENAMENU_FAVORITES' ), 'index.php?option=com_kunena&func=latest&do=favorites&Itemid='.KunenaRoute::getItemid('index.php?option=com_kunena&func=latest&do=favorites') );

	}
}