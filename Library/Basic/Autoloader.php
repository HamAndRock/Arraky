<?php

/**
 * @package Arraky
 * @copyright 2017 Jiří Svěcený
 * @author Jiří Svěcený <sitole20@gmail.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License 2.0
 */

/**
 * @param  string $Library     [Knihovna se souborem]
 * @param  string $Destination [Přesné místo umístění souboru]
 * @return boolen              [Existence funkce či třídy v destinaci]
 */
function autoloader($Library, $Destination)
{
	$File = ROOT . "/Core/Libraries/" . $Library . "/" . $Destination . ".php";
	
	if (file_exists($File))
	{
		require_once $File;
		return true;
	}
	else
	{
		throw new \RuntimeException('File "' . $Destination . '" does not exist.');
	}
}
