<?php

/**
 * @package Arraky
 * @copyright 2017 Jiří Svěcený
 * @author Jiří Svěcený <sitole20@gmail.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License 2.0
 */

function autoloader($Library, $Destination)
{
	$File = ROOT . "/Core/Libraries/" . $Library . "/" . $Destination;
	
	if (file_exists($File))
	{
		require_once $File;
		return true;
	}
	else
	{
		return false;
	}
}
