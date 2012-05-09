<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

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
 * Table tl_user_group
 */
$objUser = BackendUser::getInstance();

// register onload callback
$GLOBALS['TL_DCA']['tl_user']['config']['onload_callback'][] = array('tl_user_swekey', 'onload');

foreach ($GLOBALS['TL_DCA']['tl_user']['palettes'] as $strPaletteKey => $strPalette)
{
	if ($strPaletteKey == '__selector__')
		continue;
	
	// only show the forceLogin field to admins
	if ($objUser->isAdmin)
	{
		$GLOBALS['TL_DCA']['tl_user']['palettes'][$strPaletteKey] .= ';{swekey_legend},swekey_forceLogin,swekey_id;';
	}
	else
	{
		$GLOBALS['TL_DCA']['tl_user']['palettes'][$strPaletteKey] .= ';{swekey_legend},swekey_id;';
	}
}

$GLOBALS['TL_DCA']['tl_user']['fields']['swekey_forceLogin'] =  array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_user']['swekey_forceLogin'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'reference'				  => &$GLOBALS['TL_LANG']['tl_user']['swekey_forceLogin'],
	'eval'                    => array('tl_class'=>'w50')
);

$GLOBALS['TL_DCA']['tl_user']['fields']['swekey_id'] =  array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_user']['swekey_id'],
	'exclude'                 => true,
	'inputType'               => 'text',
	'eval'                    => array('tl_class'=>'w50', 'maxlength'=>32)
);

// Disable the swekey_id field for non-admins
if (!$objUser->isAdmin)
{
	$GLOBALS['TL_DCA']['tl_user']['fields']['swekey_id']['eval']['disabled'] = true;
	$GLOBALS['TL_DCA']['tl_user']['fields']['swekey_id']['eval']['style'] = 'background-color:#F3F3F3;';
}

class tl_user_swekey extends Backend
{
	/**
	 * Initialize the object
	 */
	public function __construct()
	{
		parent::__construct();
	}
	 
	 
	/**
	 * Onload callback to set the opitons based on the user type
	 */
	public function onload(DataContainer $dc)
	{
		$objUser = $this->Database->prepare('SELECT * FROM tl_user WHERE id=?')->execute($dc->id);
		
		if ($objUser->admin)
		{
			$GLOBALS['TL_DCA']['tl_user']['fields']['swekey_forceLogin']['options'] = array('global', 'yes', 'no');
		}
		else
		{
			$GLOBALS['TL_DCA']['tl_user']['fields']['swekey_forceLogin']['options'] = array('global', 'group', 'yes', 'no');
		}
		
	  }
}
