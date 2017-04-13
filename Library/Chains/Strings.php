<?php

/**
 * @package Arraky
 * @copyright 2017 Jiří Svěcený
 * @author Jiří Svěcený <sitole20@gmail.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License 2.0
 */

function protection($String, $HTML_Charakters = true, $MySQL_Charakters = true)
{
	global $Database;

	if ($HTML_Charakters == true)
	{
		$String = htmlspecialchars($String);
	}
	
	if ($MySQL_Charakters == true)
	{
		$Mysqli = New mysqli($Database["Host"], $Database['Name'], $Database['Password'], $Database['Database']);
		$String = mysqli_real_escape_string($Mysqli, $String);
	}
	
	return $String;
}
