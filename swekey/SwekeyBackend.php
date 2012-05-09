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

class SwekeyBackend extends Backend
{
	/**
	 * Initialize the object
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}


	/**
	 * Hooked by the loadLanguageFile hook to check whether a user has been correctly authenticated
	 * @return void
	 */
	public function checkAuth()
	{
		// unset the hook so it's never called twice
		unset($GLOBALS['TL_HOOKS']['loadLanguageFile']['swekey_checkAuth']);
		
		// this has to be done for every time we call this hook
		if ($this->Environment->script == 'contao/index.php' && $this->Input->get('noSwekey'))
		{
			$this->addErrorMessage($GLOBALS['TL_LANG']['ERR']['swekeyAuthMandatory']);
		}
		
		// we only need to check if the swekey is active if the user is correctly logged in
		// cannot check for the BE_USER_AUTH cookie or BE_USER_LOGGED_IN here as this is only defined in the front end (for whatever reason)
		if (!((int) BackendUser::getInstance()->id > 0))
		{
			return;
		}
		
		// if the swekey is required and the key is not authenticated we redirect
		if ($this->requiresSwekeyAuth())
		{
			// ok, we need a swekey authentication. Then we have to check if the user has already an ID attached. If not, we redirect him to the controller
			if (!$this->User->swekey_id)
			{
				$this->redirect('system/modules/swekey/SwekeyController.php');
			}

			// otherwise we check for a valid swekey id
			$objIntegration = new ContaoSwekeyIntegration(new SwekeyBackendLoginConfig());
			if (!$objIntegration->IsSwekeyAuthenticated($this->User->swekey_id))
			{
				$this->redirect('contao/index.php?noSwekey=1');
			}
			return;
		}
	}
	

	/**
	 * Checks whether a swekey authentication is mandatory based on general settings and user group settings
	 * @return boolean
	 */
	 private function requiresSwekeyAuth()
	 {
	 	// first of all if the swekey global settings is disabled, no auth is required
	 	if (!$GLOBALS['TL_CONFIG']['swekey_forceLogin'])
		{
			return false;
		}
		
		// then we check for user specific settings
		switch ($this->User->swekey_forceLogin)
		{
			case 'global':
				return $GLOBALS['TL_CONFIG']['swekey_forceLogin'];
				break;
			case 'yes':
				return true;
				break;
			case 'no':
				return false;
				break;
			
			// the last option is "group" and for group settings we go on
		}
		
		// otherwise it's a user and we check the userspecific groups
		$time = time();
		$strForceLogin = 'global';
		
		// Overwrite user permissions if only group permissions shall be inherited
		foreach ((array) $this->User->groups as $id)
		{
			$objGroup = $this->Database->prepare("SELECT swekey_forceLogin FROM tl_user_group WHERE id=? AND disable!=1 AND (start='' OR start<$time) AND (stop='' OR stop>$time)")
									   ->limit(1)
									   ->execute($id);

			if ($objGroup->numRows > 0)
			{
				$strForceLogin = $objGroup->swekey_forceLogin;
			}
		}

		switch ($strForceLogin)
		{
			case 'global':
				return $GLOBALS['TL_CONFIG']['swekey_forceLogin'];
				break;
			case 'yes':
				return true;
				break;
			case 'no':
				return false;
				break;
			default:
				return $GLOBALS['TL_CONFIG']['swekey_forceLogin'];
		}
	 }


	/**
	 * Hooked by the outputBackendTemplate hook to add the script integration on every page
	 * @param string buffer
	 * @param string template
	 * @return string buffer
	 */
	public function outputBackend($strBuffer, $strTemplate)
	{
		if ($strTemplate === 'be_login' || $strTemplate === 'be_main')
		{
			// the integration only needs to be done if we want to force swekey authentication
			if (!$this->requiresSwekeyAuth())
			{
				return $strBuffer;
			}

			$objIntegration = new ContaoSwekeyIntegration(new SwekeyBackendLoginConfig());
			return str_replace('</body>', $objIntegration->GetIntegrationScript() . '</body>', $strBuffer);
		}
	}
}
