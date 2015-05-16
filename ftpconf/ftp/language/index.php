<?

	/* 'User manager for PureFTPd' is made by M.Mastenbroek 2002 - 2005
	 *  For more info look at http://machiel.generaal.net
	 *  Version 2.1
	 *
	 *
	 *  I can only speak my natural language (Dutch) and a little bit English, so if people
	 *  use my script and have the time, knowledge and the spitted to add a language
	 *  feel yourself free. I think the syntax speaks for itself. If you added a language or you have
	 *  questions about it, you can contact me at machiel.mastenbroek@gmail.com, if
	 *  that doesn’t work check my website how to contact me.
	 */

	$LFile = strtolower($LANG).".php";

	if (!file_exists("language/".$LFile)) // If the language doesn't exist we use the 'default' language english
	{
		// echo ("File '$LFile' doesn't exist ! <br>\n");
		$LFile = "english.php";
	}

	require("language/".$LFile); // Read the language file

?>