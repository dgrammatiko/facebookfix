<?php
/**
 * @copyright	Copyright (c) 2014 XS_NRG. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

jimport('joomla.plugin.plugin');

/**
 * system - facebook fix Plugin
 *
 * @package		Joomla.Plugin
 * @subpakage	XS_NRG.facebookfix
 */
class plgsystemfacebookfix extends JPlugin {

	/**
	 * Constructor.
	 *
	 * @param 	$subject
	 * @param	array $config
	 */
	function __construct(&$subject, $config = array()) {
		parent::__construct($subject, $config);
	}
	
	function onAfterRoute()
	{

		$app = JFactory::getApplication();

		if ( $app->isAdmin() )
		{
			return;
		}

		$isfbcrawl = 0;
		
		if (isset($_SERVER['HTTP_USER_AGENT']))
		{
			$pattern = array(
				'/^facebookexternalhit/',	// Facebook User Agent :: facebookexternalhit/1.1
				'/^LinkedInBot/',		// LinkedIn User Agent :: LinkedInBot/1.0
				);
			if (in_array($_SERVER['HTTP_USER_AGENT'], $pattern))
			{
				$isfbcrawl = 1;
			}
		}

		if (((int)$app->get('gzip') === 1) && ($isfbcrawl === 1))
		{
			$app->set('gzip', 0);
		}
	}
}
