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
$GLOBALS['TL_LANG']['ERR']['swekeyAuthMandatory'] = 'Für eine korrekte Anmeldung ist der Swekey Pflicht.';

/**
 * Swekey
 */
$GLOBALS['TL_LANG']['swekey']['failedToAttachUser']			= 'Der Swekey konnte nicht dem Benutzer zugewiesen werden.';
$GLOBALS['TL_LANG']['swekey']['translate_logo_gray']		= 'Kein Swekey verbunden.';
$GLOBALS['TL_LANG']['swekey']['translate_logo_orange']		= 'Authentifizieren...';
$GLOBALS['TL_LANG']['swekey']['translate_logo_red']			= 'Authentifizierung fehlgeschlagen.';
$GLOBALS['TL_LANG']['swekey']['translate_logo_green']		= 'Swekey verbunden und authentifiziert.';
$GLOBALS['TL_LANG']['swekey']['translate_logo_green']		= 'Swekey verbunden und validiert.';
$GLOBALS['TL_LANG']['swekey']['translate_attach_ask']		= 'Ein Swekey wurde gefunden. Möchten Sie diesen mit Ihrem Benutzerkonto verknüpfen?';
$GLOBALS['TL_LANG']['swekey']['translate_attach_success']	= 'Der verbundene Swekey ist jetzt mit Ihrem Benutzerkonto verknüpft.';
$GLOBALS['TL_LANG']['swekey']['attach_failed']				= 'Der Swekey konnte nicht mit dem Benutzerkonto verknüpft werden.';

/**
 * Controller
 */
$GLOBALS['TL_LANG']['swekey']['controller_headline']		= 'Swekey Controller';
$GLOBALS['TL_LANG']['swekey']['controller_message']			= 'Für ein korrektes Login ist ein Swekey erforderlich. Bitte verbinden Sie diesen jetzt mit Ihrem Computer oder <a href="%s">gehen Sie zurück auf die Login-Seite</a>.';
