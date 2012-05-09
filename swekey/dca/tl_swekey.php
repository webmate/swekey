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
 * Swekey configuration
 */
$GLOBALS['TL_DCA']['tl_swekey'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'File',
		'closed'                      => true
	),

	// Palettes
	'palettes' => array
	(
		'default'                     => '{swekey_legend},swekey_forceLogin,swekey_showDebugInfo,swekey_useTls,swekey_logoUrl;'
	),

	// Fields
	'fields' => array
	(
		'swekey_forceLogin' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_swekey']['swekey_forceLogin'],
			'inputType'               => 'checkbox',
			'eval'                    => array('tl_class'=>'w50 m12')
		),
		'swekey_showDebugInfo' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_swekey']['swekey_showDebugInfo'],
			'inputType'               => 'checkbox',
			'eval'                    => array('tl_class'=>'w50 m12')
		),
		'swekey_useTls' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_swekey']['swekey_useTls'],
			'inputType'               => 'checkbox',
			'eval'                    => array('tl_class'=>'w50 m12')
		),
		'swekey_logoUrl' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_swekey']['swekey_logoUrl'],
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'url', 'decodeEntities'=>true, 'maxlength'=>255, 'tl_class'=>'w50 wizard'),
			'wizard' => array
			(
				array('tl_swekey', 'pagePicker')
			)
		)
	)
);

class tl_swekey extends Backend
{
	/**
	 * Initialize the object
	 */
	 public function __construct()
	 {
	 	parent::__construct();
	 }


	/**
	 * Return the link picker wizard
	 * @param DataContainer
	 * @return string
	 */
	public function pagePicker(DataContainer $dc)
	{
		return ' ' . $this->generateImage('pickpage.gif', $GLOBALS['TL_LANG']['MSC']['pagepicker'], 'style="vertical-align:top;cursor:pointer" onclick="Backend.pickPage(\'ctrl_' . $dc->inputName . '\')"');
	}
}
