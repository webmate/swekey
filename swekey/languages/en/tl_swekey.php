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
 * Fields
 */
$GLOBALS['TL_LANG']['tl_swekey']['swekey_forceLogin']		= array('Force swekey login', 'Activate this checkbox if the swekey should be mandatory for loggin in.');
$GLOBALS['TL_LANG']['tl_swekey']['swekey_showDebugInfo']	= array('Show debug information', 'Activate this checkbox to display debug information.');
$GLOBALS['TL_LANG']['tl_swekey']['swekey_useTls']			= array('Use TLS for requests to the swekey servers', 'Activate this checkbox to communicate over https with the swekey servers (recommended)');
$GLOBALS['TL_LANG']['tl_swekey']['swekey_logoUrl']			= array('Swekey logo url', 'Enter an url or choose a page to which a user gets redirected when clicking on the swekey logo.');

/**
 * Legend
 */
$GLOBALS['TL_LANG']['tl_swekey']['swekey_legend']		= 'Swekey settings';

/**
 * References
 */
$GLOBALS['TL_LANG']['tl_swekey']['edit']				= 'Edit the swekey configuration';
