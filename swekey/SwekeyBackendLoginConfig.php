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


class SwekeyBackendLoginConfig extends Controller implements SwekeyConfigInterface
{
	/**
	 * Show debugging information
	 * @return boolean
	 */
	public function showDebugInfo()
	{
		return (bool) $GLOBALS['TL_CONFIG']['swekey_showDebugInfo'];
	}


	/**
	 * Put the name of you user name text input of your login form here.
	 * This is used to auto-fill the username when a swekey is plugged
	 * You can use multiple names
	 * @return array
	 */
	public function getInputNames()
	{
		return array('username');
	}


	/**
	 * Return true if the user is logged in
	 * @return boolean
	 */
	public function userIsLoggedIn()
	{
		// cannot check for the BE_USER_AUTH cookie or BE_USER_LOGGED_IN here as this is only defined in the front end (for whatever reason)
		return ((int) BackendUser::getInstance()->id > 0);
	}


	/**
	 * Set this member to true if your login window contains more than one username/password form
	 * @return boolean
	 */
	public function hasMultipleLogos()
	{
		return false;
	}	


	/**
	 * Set this to true if the login form is created dynamically using javascript after the page was loaded
	 * @return boolean
	 */
	public function hasDynamicLoginForm()
	{
		return false;
	}


	/**
	 * Set this to true if you want to request the swekey servers using https
	 * @return boolean
	 */
	public function useTlsForServers()
	{
		return (bool) $GLOBALS['TL_CONFIG']['swekey_useTls'];
	}


	/**
	 * If the logged user has a swekey associated with his account fill this value with the id of that swekey.
	 * @return string 32 character swekey id
	 */
	public function getSwekeyId()
	{
		return BackendUser::getInstance()->swekey_id;
	}


	/**
	 * Return the name of the user from a given swekey id 
	 * This is used to auto-fill the username when a swekey is plugged
	 * @param string 32 character swekey id
	 * @return string The user name
	 */
	public function getUserNameFromSwekeyId($strSwekeyId)
	{
		return Database::getInstance()->prepare('SELECT username FROM tl_user WHERE swekey_id=?')->limit(1)->executeUncached($strSwekeyId)->username;
	}


	/**
	 * Set the swekey_id of the current user
	 * @param string 32 character swekey id
	 * @return null|string Return null in case of success or a string in case of an error
	 */
	public function attachSwekeyToCurrentUser($strSwekeyId)
	{
		try
		{
			Database::getInstance()->prepare('UPDATE tl_user SET swekey_id=? WHERE id=?')->execute($strSwekeyId, BackendUser::getInstance()->id);
			return null;
		}
		catch (Exception $e)
		{
			$this->log('Failed to attach the swekey to the current user: ' . $e->getMessage(), __METHOD__, TL_ERROR);
			return $GLOBALS['TL_LANG']['swekey']['failedToAttachUser'];
		}
	}


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
	public function translate($strKey)
	{
		return specialchars($GLOBALS['TL_LANG']['swekey']['translate_' . $strKey]);
	}


	/**
	 * Add your own javascript files
	 * @param string Mandatory javascript includes
	 * @return string
	 */
	public function getJavascriptIncludes($strBuffer)
	{
		return $strBuffer;
	}


	/**
	 * This method allows you to extend the configuration array.
	 * There are a lot of configurations you can do for which you better check the swekey_integration.php file
	 * @param array The config array (preconfigured with a few settings e.g. the server urls depending on useTlsForServers() etc.)
	 * @return array The modified config array
	 */
	public function getConfig($arrConfig)
	{
		$arrConfig['loginname_width_offset']	= 18;
		$arrConfig['logo_url']					= $this->convertRelativeUrls($this->replaceInsertTags($GLOBALS['TL_CONFIG']['swekey_logoUrl']));
		return $arrConfig;
	}


	/**
	 * This method gets called when a swekey is unplugged
	 */
	public function logout()
	{
		$this->redirect('contao/index.php');
	}
}