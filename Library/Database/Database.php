<?php

/**
 * @package Arraky
 * @copyright 2017 Jiří Svěcený
 * @author Jiří Svěcený <sitole20@gmail.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License 2.0
 */

class Database
{
	/**
	 * @param array  $Connect [Přihlašovací údaje uložené v poli]
	 * @param string $Charset [Vstupní a výstupní kodování databáze]
	 */
	public function __construct($Connect, $Charset = "utf8")
	{
		$this->Host     = $Connect["Host"];
		$this->Name     = $Connect["Name"];
		$this->Password = $Connect["Password"];
		$this->Database = $Connect["Database"];
		$this->Charset  = $Charset;

		@$this->Connect = New mysqli($this->Host, $this->Name, $this->Password, $this->Database);
	}

	/**
	 * @return boolean [Funkční připojení aplikace k databázovému serveru]
	 */
	public function control($Output = true)
	{
		if ($this->Connect->connect_errno)
		{
			$Error  = ($this->Connect->connect_errno);
			$Errors = array(
							"2002"    => "Neplatná adresa vzdáleného serveru",
							"1044"    => "Neplatné jméno databáze",
							"1045"    => "Nesprávné přihlašovací jméno či heslo",
							"1046"    => "Nebyla vybrána databáze",
							"1049"    => "Neznámá databáze",
							"Undefie" => "Nespecifikovaná chyba"
						);

			/**
			 * Hledání konkrétní chyby připojení databáze
			 */
			if (isset($Errors[$Error]))
			{
				$Notification = $Errors[$Error];
			}
			else
			{
				$Notification = $Errors["Undefie"];
			}

			actionlog("0", "Chyba spojení s (" . $this->Host . ") z důvodu (" . $Notification . ")");

			/**
			 * Možnost okamžitě ukončit další načítání systému v případě neúspěšného spojení
			 */
			if ($Output == true)
			{
				exit;
			}
		}
		
		return ($this->Connect->connect_errno ? false : true);
	}

	/**
	 * @param  string $Column [Sloupeček jehož obsah si přejeme znát]
	 * @param  string $Query  [Předem ošetřený dotaz do databáze]
	 * @return string         [Vrací požadovaný sloupeček]
	 */
	public function result($Column, $Query)
	{
		$this->Connect->set_charset($this->Charset);

		$Result = $this->Connect
		               ->query($Query . " limit 1");

		return $Result->fetch_array(MYSQLI_ASSOC)[$Column];
		$this->Connect->close();
	}

	/**
	 * @param  string  $Query [Předem ošetřený SQL dotaz]
	 * @return integer        [Počet výsledků odeslaného dotazu]
	 */
	public function results($Query)
	{
		return $this->Connect
			    ->query($Query)
			    ->num_rows;

		$this->Connect->close();
	}
}
