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
 * The SwekeyConfigInterface provides an interface for different configurations
 * Your config must implement this interface to pass it on to the ContaoSwekeyIntegration
 * in the dependency injection manner.
 *
 * @author Yanick Witschi <yanick.witschi@certo-net.ch>
 */
interface SwekeyConfigInterface
{
	/**
	 * Show debugging information
	 * @return boolean
	 */
	function showDebugInfo();

	/**
	 * Put the name of you user name text input of your login form here.
	 * This is used to auto-fill the username when a swekey is plugged
	 * You can use multiple names
	 * @return array
	 */
	function getInputNames();
	
	/**
	 * Return true if the user is logged in
	 * @return boolean
	 */
	function userIsLoggedIn();
	
	/**
	 * Set this member to true if your login window contains more than one username/password form
	 * @return boolean
	 */
	function hasMultipleLogos();

	/**
	 * Set this to true if the login form is created dynamically using javascript after the page was loaded
	 * @return boolean
	 */
	function hasDynamicLoginForm();

	/**
	 * Set this to true if you want to request the swekey servers using https
	 * @return boolean
	 */
	function useTlsForServers();

	/**
	 * If the logged user has a swekey associated with his account fill this value with the id of that swekey.
	 * @return string 32 character swekey id
	 */
	function getSwekeyId();

	/**
	 * Return the name of the user from a given swekey id 
	 * This is used to auto-fill the username when a swekey is plugged
	 * @param string 32 character swekey id
	 * @return string The user name
	 */
	function getUserNameFromSwekeyId($strSwekeyId);

	/**
	 * Set the swekey_id of the current user
	 * @param string 32 character swekey id
	 * @return null|string Return null in case of success or a string in case of an error
	 */
	function attachSwekeyToCurrentUser($strSwekeyId);


	/**
	 * This method gives you a chance to localize the strings
	 * You should return '' if you don' t have a value (English will then be used)
	 *
	 * id             : value
	 * -------------- : ---------
	 *'logo_gray'     : 'No swekey plugged'
	 *'logo_orange'   : 'Authenticating...'
	 *'logo_red'      : 'Swekey authentication failed'
	 *'logo_green'    : 'Swekey plugged and authentified'
	 *'logo_green'    : 'Swekey plugged and validated'
	 *'attach_ask'	  : "A swekey authentication key has been detected.\nDo you want to associate it with your account ?"
	 *'attach_success': "The plugged swekey is now attached to your account"
	 *'attach_failed' : "Failed to attach the plugged swekey to your account"
	 *
	 * @param string The key to associate the right translation
	 * @return string The translation
	 */
	function translate($strKey);
	
	/**
	 * Add your own javascript files
	 * @param string Mandatory javascript includes
	 * @return string
	 */
	function getJavascriptIncludes($strBuffer);

	/**
	 * This method allows you to extend the configuration array.
	 * There are a lot of configurations you can do for which you better check the swekey_integration.php file
	 * @param array The config array (preconfigured with a few settings e.g. the server urls depending on useTlsForServers() etc.)
	 * @return array The modified config array
	 */
	function getConfig($arrConfig);

	/**
	 * This method gets called when a swekey is unplugged
	 */
	function logout();
}