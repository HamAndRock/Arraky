<?php

/**
 * @package Arraky
 * @copyright 2017 Jiří Svěcený
 * @author Jiří Svěcený <sitole20@gmail.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License 2.0
 */

/**
 * @param  string  $Library     [Knihovna se souborem]
 * @param  string  $Destination [Umístění souboru v knihovně]
 * @return boolean              [Úspěšné načtení knihovny]
 */
function autoloader($Library, $Destination)
{
	$File = ROOT . "/Core/Libraries/" . $Library . "/" . $Destination;
	
	if (file_exists($File))
	{
		require_once $File;
	}

	return (file_exists($File) ? True : False);
}
