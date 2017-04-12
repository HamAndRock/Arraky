<?php

/**
 * @package Arraky
 * @copyright 2017 Jiří Svěcený
 * @author Jiří Svěcený <sitole20@gmail.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License 2.0
 */

/**
 * @param integer $Code    [Kod události]
 * @param string  $Message [Jednoduchá a struční zpráva]
 */
function actionlog($Code, $Message)
{
	$File    = ROOT . "/Core/Archiv/Log/" . date("Y-m-d") . ".txt";
	$Message = date("d/m/Y i:H:s") . " [$Code] $Message\n";
	$Write   = fopen($File, "a");
	
	fwrite($Write, $Message);
	fclose($Write);
}
