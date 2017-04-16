<?php

/**
 * @package Arraky
 * @copyright 2017 Jiří Svěcený
 * @author Jiří Svěcený <sitole20@gmail.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License 2.0
 */

/**
 * @param  string $Component [Jméno komponentu]
 * @return boolen            [Úspěšnost nalezení komponentu]
 */
function components($Component)
{
	$File = ROOT . "/Content/Theme/Pages/Components/" . $Component . ".php";

	if (file_exists($File))
	{
		include $File;
		return true;
	}
	else
	{
		actionlog(0, "Nepodařilo se načíst komponent ($Component)");
		return false;
	}
}
