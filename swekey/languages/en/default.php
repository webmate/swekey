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
  * Errors
  */
$GLOBALS['TL_LANG']['ERR']['swekeyAuthMandatory']			= 'For full authentication a swekey is mandatory.';

/**
 * Swekey
 */
$GLOBALS['TL_LANG']['swekey']['failedToAttachUser']			= 'The swekey could not be attached to the user.';
$GLOBALS['TL_LANG']['swekey']['translate_logo_gray']		= 'No swekey connected.';
$GLOBALS['TL_LANG']['swekey']['translate_logo_orange']		= 'Authenticate...';
$GLOBALS['TL_LANG']['swekey']['translate_logo_red']			= 'Authentication failed.';
$GLOBALS['TL_LANG']['swekey']['translate_logo_green']		= 'Swekey connected and authenticated.';
$GLOBALS['TL_LANG']['swekey']['translate_logo_green']		= 'Swekey connected and validated.';
$GLOBALS['TL_LANG']['swekey']['translate_attach_ask']		= 'A swekey has been detected. Do you want to attach it to your account?';
$GLOBALS['TL_LANG']['swekey']['translate_attach_success']	= 'The swekey is now attached to your account.';
$GLOBALS['TL_LANG']['swekey']['attach_failed']				= 'The swekey could not be attached to the user.';

/**
 * Controller
 */
$GLOBALS['TL_LANG']['swekey']['controller_headline']		= 'Swekey Controller';
$GLOBALS['TL_LANG']['swekey']['controller_message']			= 'For a successful login, a swekey is mandatory. Please connect it to your computer now or <a href="%s">go back to the login page</a>.';