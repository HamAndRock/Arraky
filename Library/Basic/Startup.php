<?php

/**
 * @package Arraky
 * @copyright 2017 Jiří Svěcený
 * @author Jiří Svěcený <sitole20@gmail.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License 2.0
 */

class Startup
{
	/**
	 * @param boolean $Value   [Nastavení debugovacího modu]
	 * @param string  $Address [IP adresa u které je povolený debugovací mod]
	 */
	public function debugging($Value = false, $Address = "")
	{
		if (($Value == true) AND ($Address == $_SERVER["REMOTE_ADDR"]))
		{
			error_reporting(E_ALL);
			define("Arraky_Debugger", true);
		}
		else
		{
			error_reporting(0);
			define("Arraky_Debugger", false);
		}
	}

	/**
	 * @param string $TimeZone [Časové pásmo, hlavní město]
	 */
	public function timezone($TimeZone)
	{
		date_default_timezone_set($TimeZone); // http://php.net/manual/en/function.date-default-timezone-set.php
		define("Arraky_TimeZone", $TimeZone);
	}

	public function session()
	{
		session_start();
		define("Arraky_Session", true);
	}
}
