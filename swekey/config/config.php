<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2011 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  certo web & design GmbH 2012 
 * @author     Yanick Witschi <yanick.witschi@certo-net.ch> 
 * @package    swekey 
 * @license    LGPL 
 * @filesource
 */


/**
 * Back end modules
 */
$GLOBALS['BE_MOD']['system']['swekey'] = array
(
	'tables'    => array('tl_swekey'),
	'icon'      => 'system/modules/swekey/html/swekey.png'
);


/**
 * Hooks
 */
$strFileName = basename($_SERVER['SCRIPT_FILENAME']);
$blnIsBEInstall = $strFileName == 'main.php'  && $_SERVER['QUERY_STRING'] == 'do=repository_manager&update=database';

if(TL_MODE == 'BE' && !$blnIsBEInstall && $strFileName != 'SwekeyController.php' && $strFileName != 'install.php')
{
	$GLOBALS['TL_HOOKS']['loadLanguageFile']['swekey_checkAuth']	= array('SwekeyBackend', 'checkAuth');
	$GLOBALS['TL_HOOKS']['outputBackendTemplate'][]					= array('SwekeyBackend', 'outputBackend');
}


/**
 * Swekey default config
 */
$GLOBALS['TL_CONFIG']['swekey_useTls'] = true;
