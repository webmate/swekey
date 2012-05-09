<?php

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2012 Leo Feyer
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
 * @copyright  Leo Feyer 2005-2012
 * @author     Leo Feyer <http://www.contao.org>
 * @package    Backend
 * @license    LGPL
 * @filesource
 */


/**
 * Initialize the system
 */
define('TL_MODE', 'BE');
require_once('../../initialize.php');


/**
 * Class SwekeyController
 *
 * Controller to attach a swekey to a user
 * @copyright  Yanick Witschi 2012
 * @author     Yanick Witschi <yanick.witschi@certo-net.ch>
 * @package    swekey
 */
class SwekeyController extends Backend
{

	/**
	 * Initialize the controller
	 * 
	 * 1. Import the user
	 * 2. Call the parent constructor
	 * 3. Authenticate the user
	 * 4. Load the language files
	 * DO NOT CHANGE THIS ORDER!
	 */
	public function __construct()
	{
		$this->import('BackendUser', 'User');
		parent::__construct();

		$this->User->authenticate();

		$this->loadLanguageFile('default');
	}

	
	/**
	 * Run the controller
	 */
	public function run()
	{
		$this->Template = new BackendTemplate('be_swekey_controller');

		$this->Template->theme = $this->getTheme();
		$this->Template->messages = $this->getMessages();
		$this->Template->base = $this->Environment->base;
		$this->Template->language = $GLOBALS['TL_LANGUAGE'];
		$this->Template->title = $GLOBALS['TL_CONFIG']['websiteTitle'];
		$this->Template->charset = $GLOBALS['TL_CONFIG']['characterSet'];

		$this->Template->headline = $GLOBALS['TL_LANG']['swekey']['controller_headline'];
		$this->Template->message = sprintf($GLOBALS['TL_LANG']['swekey']['controller_message'], $this->Environment->base . 'contao/index.php');

		$objIntegration = new ContaoSwekeyIntegration(new SwekeyBackendLoginConfig());
		$this->Template->swekeyIntegration = $objIntegration->GetIntegrationScript();
		$this->Template->output();
	}
}

$objSwekey = new SwekeyController();
$objSwekey->run();
