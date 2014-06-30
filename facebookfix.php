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

		$unsupported = false;
		
		if (isset($_SERVER['HTTP_USER_AGENT']))
		{
		/* Facebook User Agent
		 * facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)
		 * LinkedIn User Agent
		 * LinkedInBot/1.0 (compatible; Mozilla/5.0; Jakarta Commons-HttpClient/3.1 +http://www.linkedin.com)
		 */
			$pattern = strtolower('/facebookexternalhit|LinkedInBot/x');

			if (preg_match($pattern, strtolower($_SERVER['HTTP_USER_AGENT'])))
			{
				$unsupported = true;

			}
		}

		if (($app->get('gzip') == 1) && $unsupported)
		{
			$app->set('gzip', 0);
		}
	}
}
