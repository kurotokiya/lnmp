<?php

	/* 'User manager for PureFTPd' is made by M.Mastenbroek 2002 - 2005
	 *  For more info look at http://machiel.generaal.net
	 *  Version 2.1
	 */

	error_reporting(E_ERROR);

	session_start();

	require ('config.php');
	require ('language/index.php');

	$link = mysql_connect("$DBHost", "$DBLogin", "$DBPassword");

	if(!$link)
		die("<br>Error: MySql server not found.<br><br>MySql error : ".mysql_error());

	if (!@mysql_select_db("$DBDatabase"))
		die("<br>Error: Database 'ftpusers' doesn't exist.<br><br>MySql error : ".mysql_error());

	$table_admin  = "SELECT * FROM admin ORDER BY Username ASC";

	$query_admin  = mysql_query($table_admin);

	if (!$query_admin)
		die("<br>Error: Table 'admin' from database 'ftpusers' doesn't exist.<br><br>MySql error : ".mysql_error());

	$length_users = mysql_num_rows($query_admin);
	if ($length_users == 0)
		die ("<br>Error: Table 'admin' from database 'ftpusers' is empty, can't continue.");

	if ($_POST['Submit'])
	{

		$LoginName = addslashes($_POST['LoginName']);
		$LoginPassword = addslashes($_POST['LoginPassword']);

		$Query = mysql_query("SELECT * FROM admin WHERE Username = '$LoginName' AND Password = '".md5($LoginPassword)."'");
		$Results = mysql_num_rows($Query);

		if ($Results == '1')
		{
			$_SESSION['Login'] = 1;
			session_register("Login");
			header("location: $_SERVER[PHP_SELF]");
		}
	}


	echo ("<html>\n");
	echo ("<head>\n");
	echo ("<title>".$Translate[30]." (".$Translate[0]." - ".$Translate[1].")</title>\n");
	echo ("<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$CharSet\">\n");
	echo ("<meta name=\"description\" content=\"The ‘User manager for PureFTPd’ is a software project from Machiel Mastenbroek,");
	echo (" more information about this free software could be found on my website: http://machiel.generaal.net/index.php?subject=user_manager_pureftpd \">\n");

	echo ("<link rel=\"stylesheet\" href=\"$StyleSheet\" type=\"text/css\" />\n");
	echo ("</head>\n");

?>

<body bgcolor="#FFFFFF" text="#000000" marginwidth="0" marginheight="0">
<div align="center">
	<br>
	<br>
	<br>


		<?php


		echo ("<form method=\"post\" action=\"$_SERVER[PHP_SELF]\">\n");
		echo ("<input type=\"hidden\" name=\"Submit\" value=\"1\">\n");
			if ($Results != '1' && isset($_POST['Submit']))
			{
					echo("<font color=\"#FF0000\">".$Translate[20]."</font>\n<br>\n<br>\n");
			}
		?>


		<table class="login_user_border" border="0"  cellpadding="1" cellspacing="0">
			<tr>
				<td>
					<table class="login_user" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td height="0"></td>
						</tr>
						<tr>
							<td>
								<table border="0" cellpadding="0" cellspacing="0" width="250">
									<tr>
										<td width="15"><img src="<?=$LocationImages?>/left_top.gif" width="15" height="15"></td>
										<td width="28" valign="bottom"><img src="<?=$LocationImages?>/login.gif" width="28" height="11"></td>
										<td width="192" background="<?=$LocationImages?>/top.gif"></td>
										<td width="15"><img src="<?=$LocationImages?>/right_top.gif" width="15" height="15"></td>
									</tr>
									<tr>
										<td width="15" background="<?=$LocationImages?>/left.gif">&nbsp;</td>
										<td colspan="2">
											<table border="0" width="100%">
												<tr>
													<td height="7"></td>
													<td></td>
													<td></td>
												</tr>
												<tr>
													<td width="40" align="center"> <img src="<?=$LocationImages?>/user.gif" width="16" height="24"></td>
													<td><?=$Translate[32]?><br>
														<select name="LoginName">
														<?php
															$iCounter = 0;
															while ($iCounter < $length_users)
															{
																$name = mysql_result($query_admin,$iCounter,"Username");
																if ($_POST["LoginName"] == $name)
																	echo ("<option selected=\"selected\">$name</option>\n");
																else
																	echo ("<option>$name</option>\n");
																$iCounter++;
															}
														?>
														</select>
													</td>
													<td width="17">&nbsp;</td>
												</tr>
												<tr>
													<td height="10"></td>
													<td></td>
													<td></td>
												</tr>
												<tr>
													<td width="40" align="center"> <img src="<?=$LocationImages?>/key.gif" width="28" height="32"></td>
													<td><?=$Translate[41]?><br>
														<input type="password" name="LoginPassword" size="20">
													</td>
													<td width="17"><font size="1">&nbsp;</font></td>
												</tr>
											</table>
										</td>
										<td width="15" background="<?=$LocationImages?>/right.gif">&nbsp;</td>
									</tr>
									<tr>
										<td width="15" ><img src="<?=$LocationImages?>/left_bottom.gif" width="15" height="15"></td>
										<td colspan="2" background="<?=$LocationImages?>/top.gif"></td>
										<td width="15" ><img src="<?=$LocationImages?>/right_bottom.gif" width="15" height="15"></td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td>
								<table border="0" width="100%" >
									<tr>
										<td align="right">
											<input type="submit" class="login_button" name="submit" value="Login">&nbsp;
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</form>
</div>
</body>
</html>

<?php
	mysql_close($link);
?>