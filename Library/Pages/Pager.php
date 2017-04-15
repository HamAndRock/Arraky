<?php

/**
 * @package Arraky
 * @copyright 2017 Jiří Svěcený
 * @author Jiří Svěcený <sitole20@gmail.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License 2.0
 */

class Pager
{
	/**
	 * @param array $Database [Přístupové údaje k databázovému serveru, kde se nachází list stránek]
	 */
	public function __construct($Database)
	{
		$this->Database = $Database;
		$this->Charset  = "utf-8";
	}

	/**
	 * @return boolen [Úspěšnost hledání stránky v databázi]
	 */
	public function detection()
	{
		if (!isset($_GET["Page"]) OR empty($_GET["Page"]))
		{
			$Connect       = New Database($this->Database);
			$this->Address = $Connect->result("Address", "SELECT * FROM Arraky_Sites WHERE Main = 1 AND Access = 1");

			return false;
		}
		else
		{
			$Address = protection($_GET["Page"]);
			$Connect = New Database($this->Database);
			$Query   = "SELECT Address, Access FROM Arraky_Sites WHERE Address = '" . $Address . "' AND Access = 1";

			/**
			 * Kontroluje zda se podařilo najít v databázi tuto stránku
			 */
			if ($Connect->results($Query) > 0)
			{
				$this->Address = $Address;
				return true;
			}
			else
			{
				actionlog(0, "Aplikace požádána o načtení neexistující stránky ($Address)");

				$this->Address = "Error";
				return false;
			}
		}
	}

	/**
	 * @return string [Vrácí úplnou interní adresu souboru obsahující stránku]
	 */
	public function writeContent()
	{
		$Folder = ROOT . "/Content/Theme/Pages/Sites/";
		$Query  = "SELECT Access, Address, File FROM Arraky_Sites WHERE Address = '" . $this->Address . "' AND Access = 1";

		$Connect    = New Database($this->Database);
		$this->File = $Folder . $Connect->result("File", $Query) . ".php";

		/**
		 * Kontrola existence souboru v systému
		 */
		if (file_exists($this->File)) {
			return $this->File;
		}
		else
		{
			/**
			 * Načítá statický soubor, který není nutné zapisovat do databáze, protože je všudypřítomný
			 */
			return $Folder . "Error.php";
		}
	}
}
