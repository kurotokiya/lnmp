<?php

	/* 'User manager for PureFTPd' is made by M.Mastenbroek 2002 - 2005
	 *  For more info look at http://machiel.generaal.net
	 *  Version 2.1
	 */

	error_reporting(E_ERROR);

	session_start();

	require ('config.php');
	require ('includes/files.php');
	require ('language/index.php');

	if ($_SESSION['Login'] != '1')
	{
		// header("location: index.php");
		include ("includes/login.php");
	}else
	{

		$link = mysql_connect("$DBHost", "$DBLogin", "$DBPassword");

		if(!$link)
			die("<br>Error: MySql server not found.<br><br>MySql error : ".mysql_error());


		if (!@mysql_select_db("$DBDatabase"))
			die("<br>Error: Database 'ftpusers' doesn't exist.<br><br>MySql error : ".mysql_error());


		$table_users  = "SELECT * FROM users ORDER BY User ASC";
		$query_users  = mysql_query($table_users);

		if (!$query_users)
			die("<br>Error: Table 'users' from database 'ftpusers' doesn't exist.<br><br>MySql error : ".mysql_error());

		$length_users = mysql_numrows($query_users);

		// Function: compare_array ();
		// Returns the position of '$word' in the array '$array'
		// if '$word' does not exist the function returns '-1'

		function compare_array($word,$array)
		{
			$iCounter = 0;
			while ($iCounter < count($array))
			{
				if($word == $array[$iCounter])
				{
					return $iCounter;
					break;
				}
				$iCounter++;
			}
			return -1;
		}

		// Creates a help balloon with some information.
		function help($help_text)
		{
			global $LocationImages;
			echo ("<img class=help src=\"$LocationImages/info.gif\" height=\"18\" width=\"16\"");
			echo (" onmouseover=\"return escape('$help_text')\" hspace=\"1\" align=\"middle\" border=\"0\">");

//			echo ("<img class=help src=\"$LocationImages/info.gif\" height=\"18\" width=\"16\"");
//			echo (" title=\"$help_text\" hspace=\"1\" align=\"middle\" border=\"0\">");
		}


		// Read the userfile for example '/etc/passwd'
		// todo check security settings of php
		$filename = $UsersFile;
		$fh = fopen($filename,"r");

		$iNrofunixusers = 0;

		while (!feof ($fh))
		{
			$line = fgets($fh,4096);
			$data = explode(":",$line);

			$user = trim($data[0]);
			$user_id = trim($data[2]);


			if ($user[0] != '#' &&
					strlen($user) != 0 &&
					strlen($user_id) != 0)
			{
				if(compare_array($user,$BlacklistUsers) == -1) // no hit
				{
					$unix_users[$iNrofunixusers] [0] = $user;
					$unix_users[$iNrofunixusers] [1] = $user_id;
					$iNrofunixusers++;
				}
			}
		}
		fclose($fh);

		// Read the groupfle for example '/etc/groups'
		$filename = $GroupFile;
		$fh = fopen($filename,"r");
		$iNrofunixgroups = 0;

		while (!feof ($fh))
		{

			$line = fgets($fh,4096);
			$data = explode(":",$line);

			$group = trim($data[0]);
			$group_id = trim($data[2]);

			if ($group[0] != '#' &&
					strlen($group) != 0 &&
					strlen($group_id) != 0)
			{
				if(compare_array($group,$BlacklistGroups) == -1) // no hit
				{
					$unix_groups[$iNrofunixgroups] [0] = $group;
					$unix_groups[$iNrofunixgroups] [1] = $group_id;
					$iNrofunixgroups++;
				}
			}
		}
		fclose($fh);

		// New user
		if($_GET['new'] == 1 || empty($_POST['username_box']))
			$new = 1;

		$data_saved=1;

		// Save button is pressed
		if(isset($_POST['save']))
		{

			$empty_password = 0;
			$vallid_password = 1;

			// check if password if filled
			if (strlen($_POST['password_box']) == 0 || ($_POST['password_box'] == "empty"))
				$empty_password = 1;

			// check for vallid password
			if ($_POST['confirm_password_box'] != $_POST['password_box'])
				$vallid_password = 0;

			$iExistUser=0;
			$iCounter=0;

			// Find out of user exist
			while ($iCounter < $length_users)
			{
				$message_nr = mysql_result($query_users,$iCounter,"User");
				if ($message_nr == $_POST['username_box'])
				{
					$iExistUser=1;
					break;
				}
				$iCounter++;
			}


			if ($iExistUser == 1)
			{

				//  update current ftp account
				if ($vallid_password == 0)
				{
					echo ("<script language=\"JavaScript\" type=\"text/javascript\">\n");
					echo ("<!--\n\n");
					echo ("  alert(\"".$Translate[21]."\");\n\n");
					echo ("-->\n");
					echo ("</script>\n");
				}else
				{
					if ($empty_password == 1) // update without password
					{

						echo ("<script language=\"JavaScript\" type=\"text/javascript\">\n");
						echo ("<!--\n\n");
						echo ("  alert(\"".$Translate[22]."\");\n\n");
						echo ("-->\n");
						echo ("</script>\n");





						if(!mysql_query("UPDATE users SET Uid='".$_POST['uid_box']."',
																							Gid='".$_POST['gid_box']."',
																							Dir='".$_POST['dir_box']."',
																							QuotaFiles='".$_POST['quotafiles_box']."',
																							QuotaSize='".$_POST['quotasize_box']."',
																							ULBandwidth='".$_POST['ulbandwidth_box']."',
																							DLBandwidth='".$_POST['dlbandwidth_box']."',
																							ULRatio='".$_POST['ulratio_box']."',
																							DLRatio='".$_POST['dlratio_box']."',
																							Status='".$_POST['status_box']."',
																							Ipaddress='".$_POST['ipaddress_box']."',
																							Comment='".$_POST['comment_box']."'
																							WHERE User='".$_POST['username_box']."'",$link))
						{
							echo ("<br>Error: Not a valid UPDATE query.<br>");
							echo ("<br>MySql error : ".mysql_error());


						}
					}else
					{
						if(!mysql_query("UPDATE users SET Password='".md5($_POST['password_box'])."',
																					Uid='".$_POST['uid_box']."',
																					Gid='".$_POST['gid_box']."',
																					Dir='".$_POST['dir_box']."',
																					QuotaFiles='".$_POST['quotafiles_box']."',
																					QuotaSize='".$_POST['quotasize_box']."',
																					ULBandwidth='".$_POST['ulbandwidth_box']."',
																					DLBandwidth='".$_POST['dlbandwidth_box']."',
																					ULRatio='".$_POST['ulratio_box']."',
																					DLRatio='".$_POST['dlratio_box']."',
																					Status='".$_POST['status_box']."',
																					Ipaddress='".$_POST['ipaddress_box']."',
																					Comment='".$_POST['comment_box']."'
																					WHERE User='".$_POST['username_box']."'",$link))
						{
							echo ("<br>Error: Not a valid UPDATE query.<br>");
							echo ("<br>MySql error : ".mysql_error());

						}else
						{
							echo ("<script language=\"JavaScript\" type=\"text/javascript\">\n");
							echo ("<!--\n\n");
							echo ("  alert(\"".$Translate[23]."\");\n\n");
							echo ("-->\n");
							echo ("</script>\n");
						}
					}
				}
			}else // New user
			{

				// Create new User
				if ($vallid_password == 0 || $empty_password == 1)
				{
					echo ("<script language=\"JavaScript\" type=\"text/javascript\">\n");
					echo ("<!--\n\n");
					echo ("  alert(\"".$Translate[21]."\");\n\n");
					echo ("-->\n");
					echo ("</script>\n");
					$data_saved = 0;
				}else
				{
					if(!mysql_query("INSERT INTO users (User,Password,Uid,Gid,Dir,QuotaFiles,QuotaSize,ULBandwidth,DLBandwidth,ULRatio,dLRatio,Status,Ipaddress,Comment)
																							VALUES ('".$_POST['username_box']."',
																							'".md5($_POST['password_box'])."',
																							'".$_POST['uid_box']."',
																							'".$_POST['gid_box']."',
																							'".$_POST['dir_box']."',
																							'".$_POST['quotafiles_box']."',
																							'".$_POST['quotasize_box']."',
																							'".$_POST['ulbandwidth_box']."',
																							'".$_POST['dlbandwidth_box']."',
																							'".$_POST['ulratio_box']."',
																							'".$_POST['dlratio_box']."',
																							'".$_POST['status_box']."',
																							'".$_POST['ipaddress_box']."',
																							'".$_POST['comment_box']."')",$link))
					{
							echo ("<br>Error: Not a valid INSERT query.<br>");
							echo ("<br>MySql error : ".mysql_error());
					}
				}
			}
			// reload the database users
			$table_users  = "SELECT * FROM users ORDER BY User ASC";
			$query_users  = mysql_query($table_users);
			$length_users = mysql_numrows($query_users);
		}

		// If the delete button is pressed
		if(isset($_GET['delete']) && isset($_GET['username_box']))
		{
			if(!mysql_query("DELETE FROM users WHERE User='".$_GET['username_box']."'",$link))
			{
				echo ("<br>Error: Not a valid DELETE query.<br>");
				echo ("<br>MySql error : ".mysql_error());
			}else
			{
				$table_users  = "SELECT * FROM users ORDER BY User ASC";
				$query_users  = mysql_query($table_users);
				$length_users = mysql_numrows($query_users);
			}
			// same effect when the 'new user' button is pressed
			$new=1;
		}


		// Lock or unlock button is pressed
		if(isset($_GET['lock']) && isset($_GET['username_box']))
		{
			if(!mysql_query("UPDATE users SET Status='".$_GET['lock']."' WHERE User='".$_GET['username_box']."'",$link))
			{
				echo ("<br>Error: Not a valid UPDATE query.<br>");
				echo ("<br>MySql error : ".mysql_error());
			}else
			{
				$table_users  = "SELECT * FROM users ORDER BY User ASC";
				$query_users  = mysql_query($table_users);
				// $length_users = mysql_numrows($query_users);
			}
			// $new=1;
			$_GET['id'] = $_GET['username_box'];
		}


		echo ("<html>\n");
		echo ("<head>\n");
		echo ("<title>".$Translate[0]." (".$Translate[1].")</title>\n");
		echo ("<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$CharSet\">\n");
		echo ("<meta name=\"description\" content=\"The ‘User manager for PureFTPd’ is a software project from Machiel Mastenbroek,");
		echo (" more information about this free software could be found on my website: http://machiel.generaal.net/index.php?subject=user_manager_pureftpd \">\n");
		echo ("<link rel=\"stylesheet\" href=\"$StyleSheet\" type=\"text/css\" />\n");
		echo ("</head>\n");
		echo ("<body bgcolor=\"#FFFFFF\" text=\"#000000\" link=\"#000000\" onLoad=\"loadScroll()\" onUnload=\"saveScroll()\">\n");

		echo ("<script language=\"JavaScript\" type=\"text/javascript\">\n");
		echo ("<!--\n\n");
		echo ("  function danger_popup(user,urlv)\n");
		echo ("  {\n");
		// echo ("    alert('danger_popup');\n");
		echo ("    var user_input = confirm('".$Translate[24]." \"'+user+'\" ".$Translate[25]."');\n");
		echo ("    if (user_input == true)\n");
		echo ("    {\n");
		echo ("      location =  urlv;\n");
		echo ("    }\n");
		echo ("  }\n\n");

		// Some values for the saveScroll function
		echo ("	var db = (document.body) ? 1 : 0;\n");
		echo (" var scroll = (window.scrollTo) ? 1 : 0;\n");

		// Function setCookie
		echo (" function setCookie(name, value, expires, path, domain, secure) {\n");
		echo ("   var curCookie = name + \"=\" + escape(value) +\n");
		echo ("     ((expires) ? \"; expires=\" + expires.toGMTString() : \"\") +\n");
		echo ("     ((path) ? \"; path=\" + path : \"\") +\n");
		echo ("     ((domain) ? \"; domain=\" + domain : \"\") +\n");
		echo ("     ((secure) ? \"; secure\" : \"\");\n");
		echo ("   document.cookie = curCookie;\n");
		echo (" }\n");

		// Function getCookie
		echo (" function getCookie(name) {\n");
		echo ("   var dc = document.cookie;\n");
 		echo ("  var prefix = name + \"=\";\n");
 		echo ("  var begin = dc.indexOf(\"; \" + prefix);\n");
 		echo ("  if (begin == -1) {\n");
		echo ("     begin = dc.indexOf(prefix);\n");
 		echo ("    if (begin != 0) return null;\n");
 		echo ("  } else {\n");
 		echo ("    begin += 2;\n");
		echo ("   }\n");
		echo ("   var end = document.cookie.indexOf(\";\", begin);\n");
		echo ("   if (end == -1) end = dc.length;\n");
		echo ("   return unescape(dc.substring(begin + prefix.length, end));\n");
		echo (" }\n");

		// Function saveScroll
		echo ("  function saveScroll() {\n");
		echo ("    if (!scroll) return;\n");
		echo ("    var now = new Date();\n");
		echo ("    now.setTime(now.getTime() + 365 * 24 * 60 * 60 * 1000);\n");
		echo ("    var x = (db) ? document.body.scrollLeft : pageXOffset;\n");
		echo ("    var y = (db) ? document.body.scrollTop : pageYOffset;\n");
		echo ("    if (y == 0 && x == 0) return;\n");
		echo ("    setCookie(\"xy\", x + \"_\" + y, now);\n");
		// echo ("    confirm('saveScroll x = '+x+' y = '+y);\n");
		echo ("  }\n\n");

		// Function loadScroll
		echo ("  function loadScroll() {\n");
		echo ("    if (!scroll) return;\n");
		echo ("    var xy = getCookie(\"xy\");\n");
		echo ("    if (!xy) return;\n");
		echo ("    var ar = xy.split(\"_\");\n");
		echo ("    if (ar.length == 2) scrollTo(parseInt(ar[0]), parseInt(ar[1]));\n");
		echo ("  }\n");

		echo ("-->\n");
		echo ("</script>\n");

		echo ("<form action=\"$_SERVER[PHP_SELF]\" method=\"post\" name=\"newuserform\">\n");
		echo ("<div align=\"center\">\n");


		echo ("<table class=\"select_user\" border=\"0\" cellpadding=\"1\" cellspacing=\"1\" width=\"850\">\n");
		echo ("<tr bgcolor=\"#FFFFFF\">\n");
		echo ("<td>\n");

		echo ("<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"850\">\n");
		echo ("<tr>\n");
		echo ("<td>\n");
		echo ("<font size=\"+1\">&nbsp;".$Translate[0]."</font>\n");
		echo ("</td>\n");
		echo ("<td align=\"right\">");
		echo ("<a href=\"$_SERVER[PHP_SELF]?new=1\">");
		echo ("<img hspace=\"1\" src=\"$LocationImages/new_ftpuser.gif\" width=\"16\" height=\"21\" align=\"middle\" border=\"0\">");
		echo ("<font style=\"vertical-align:middle\">&nbsp;".$Translate[31]."&nbsp;</font></a>");
		echo ("</td>\n");
		echo ("</tr>\n");
		echo ("</table>\n");
		echo ("</td>\n");
		echo ("</tr>\n");

		echo ("<tr bgcolor=\"#FFFFFF\">\n");
		echo ("<td>\n");
		echo ("<table width=\"850\" border=\"0\">\n");

		echo ("<tr class=\"column_name_select_user\">\n");
		echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\">".$Translate[32]."</td>");
		echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\">".$Translate[33]."</td>");
		echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\">".$Translate[34]."</td>");
		echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\">".$Translate[35]."</td>");

		echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\">".$Translate[36]."</td>");
		echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\">".$Translate[37]."</td>");
		//echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\">".$Translate[38]."</td>");
		echo ("<td width=\"\" align=\"left\" style=\"padding-left: 2px;\">".$Translate[39]."</td>");

		echo ("</tr>\n");

		$iCounter = 0;

		while ($iCounter < $length_users)
		{

			$user         = mysql_result($query_users,$iCounter,"User");
			//$password     = mysql_result($query_users,$iCounter,"Password");
			$uid          = mysql_result($query_users,$iCounter,"Uid");
			$gid          = mysql_result($query_users,$iCounter,"Gid");
			$dir          = mysql_result($query_users,$iCounter,"Dir");
			$ulbandwidth  = mysql_result($query_users,$iCounter,"ULBandwidth");
			$dlbandwidth  = mysql_result($query_users,$iCounter,"DLBandwidth");
			$ipaddress    = mysql_result($query_users,$iCounter,"Ipaddress");
			$status       = mysql_result($query_users,$iCounter,"Status");

			if ($status == 1)
				echo ("<tr class=\"select_user\">\n");
			else
				echo ("<tr class=\"select_locked_user\">\n");


			echo ("<td align=\"left\" width=\"140\">");

			echo ("<a href=\"$_SERVER[PHP_SELF]?id=$user\" title=\"".$Translate[60]."\">");

			// Lock or unlock account
			if ($status == 1)
					echo ("<img src=\"$LocationImages/ftpuser.gif\" width=\"16\" height=\"18\" border=\"0\" style=\"margin:0px 0px 4px ; vertical-align:middle\">");
			else
					echo ("<img src=\"$LocationImages/ftpuser_gray.gif\" width=\"16\" height=\"18\" border=\"0\" style=\"margin:0px 0px 4px ; vertical-align:middle\">");

			echo ("<input class=\"name\" value=\"$user\" name=\"textfield\" type=\"text\">");


			echo ("</a></td>\n");

			echo ("<td align=\"left\" style=\"padding-left: 3px;\">".$uid."</td>\n");
			echo ("<td align=\"left\" style=\"padding-left: 3px;\">".$gid."</td>\n");

			echo ("<td title=\"".$dir."\">");
				echo ("<input class=\"directory_location\" value=\"".$dir."\" name=\"textfield\" type=\"text\">");

			echo ("</td>");
			echo ("<td align=\"left\" style=\"padding-left: 3px;\">".$ulbandwidth."</td>\n");
			echo ("<td align=\"left\" style=\"padding-left: 3px;\">".$dlbandwidth."</td>\n");
			// echo ("<td align=\"left\" style=\"padding-left: 2px;\">".$ipaddress."</td>\n");
			echo ("<td align=\"center\" width=\"100\">");

			/* Edit ftp account */
			echo ("<a href=\"$_SERVER[PHP_SELF]?id=$user\">");
			if ($status == 1)
				echo ("<img src=\"$LocationImages/edit.gif\"  width=\"16\" height=\"18\" border=\"0\" ");
			else
				echo ("<img src=\"$LocationImages/edit_gray.gif\"  width=\"16\" height=\"18\" border=\"0\" ");
			echo ("title=\"".$Translate[60]."\" ");
			echo ("alt=\"".$Translate[60]."\"></a>&nbsp;&nbsp;");

			/* Delete ftp account */
			echo ("<a href=\"$_SERVER[PHP_SELF]\" onClick=\"danger_popup('$user',this.href+'?delete=1&username_box=$user');return false;\">");
			if ($status == 1)
				echo ("<img src=\"$LocationImages/delete.gif\" width=\"15\" height=\"16\" border=\"0\" ");
			else
				echo ("<img src=\"$LocationImages/delete_gray.gif\" width=\"15\" height=\"16\" border=\"0\" ");
			echo ("title=\"".$Translate[61]."\" ");
			echo ("alt=\"".$Translate[61]."\"></a>&nbsp;&nbsp;");

			/* Lock or unlock account */
			if ($status == 1)
			{
				echo ("<a href=\"$_SERVER[PHP_SELF]?lock=0&username_box=$user\" >");
				echo ("<img src=\"$LocationImages/lock_open.gif\" width=\"14\" height=\"18\" border=\"0\" ");
				echo ("title=\"".$Translate[62]."\" ");
				echo ("alt=\"".$Translate[62]."\"></a>&nbsp;&nbsp;");
			}else
			{
				echo ("<a href=\"$_SERVER[PHP_SELF]?lock=1&username_box=$user\" >");
				echo ("<img src=\"$LocationImages/lock_closed.gif\" width=\"14\" height=\"17\" border=\"0\" ");
				echo ("title=\"".$Translate[63]."\" ");
				echo ("alt=\"".$Translate[63]."\"></a>&nbsp;&nbsp;");
			}

			/* Open ftp account */
			if ($status == 1)
			{
				echo ("<a href=\"ftp://$user@".$FTPAddress."\" target=\"_blank\">");
				echo ("<img src=\"$LocationImages/connect.gif\" width=\"16\" height=\"18\" border=\"0\" ");
				echo ("title=\"".$Translate[64]."\" ");
				echo ("alt=\"".$Translate[64]."\"></a>");
			}else
			{
				echo ("<img src=\"$LocationImages/connect_gray.gif\" width=\"16\" height=\"18\" border=\"0\" ");
				echo ("alt=\"".$Translate[64]."\" >");
			}

			echo ("</td>\n");
			echo ("</tr>\n");
			$iCounter++;
		}

		echo ("</table>\n");
		echo ("</td>\n");
		echo ("</tr>\n");
		echo ("</table>\n");

		$password         = "empty";
		$confirm_password = "empty";

		if(!empty($_GET['id']))
		{
			$iCounter=0;
			while ($iCounter < $length_users)
			{

				$userid = mysql_result($query_users,$iCounter,"User");
				if ($userid == $_GET['id'])
				{
					$user         = $userid;
					// $password     = mysql_result($query_users,$iCounter,"Password");
					$uid          = mysql_result($query_users,$iCounter,"Uid");
					$gid          = mysql_result($query_users,$iCounter,"Gid");
					$dir          = mysql_result($query_users,$iCounter,"Dir");
					$status       = mysql_result($query_users,$iCounter,"Status");
					$quotafiles   = mysql_result($query_users,$iCounter,"QuotaFiles");
					$quotasize    = mysql_result($query_users,$iCounter,"QuotaSize");
					$ulbandwidth  = mysql_result($query_users,$iCounter,"ULBandwidth");
					$dlbandwidth  = mysql_result($query_users,$iCounter,"DLBandwidth");
					$dlratio      = mysql_result($query_users,$iCounter,"DLRatio");
					$ulratio      = mysql_result($query_users,$iCounter,"ULRatio");
					$ipaddress    = mysql_result($query_users,$iCounter,"Ipaddress");
					$comment      = mysql_result($query_users,$iCounter,"Comment");
					break;
				}
				$iCounter++;
			}
		}else if(empty($new)) // $new != 1
		{

			$user             = $_POST['username_box'];
			//$password       = "empty";
			$password         = $_POST['password_box'];
			$confirm_password = $_POST['confirm_password_box'];
			$uid              = $_POST['uid_box'];
			$gid              = $_POST['gid_box'];
			$dir              = $_POST['dir_box'];
			$status           = $_POST['status_box'];
			$quotafiles       = $_POST['quotafiles_box'];
			$quotasize        = $_POST['quotasize_box'];
			$ulbandwidth      = $_POST['ulbandwidth_box'];
			$dlbandwidth      = $_POST['dlbandwidth_box'];
			$dlratio          = $_POST['dlratio_box'];
			$ulratio          = $_POST['ulratio_box'];
			$ipaddress        = $_POST['ipaddress_box'];
			$comment          = $_POST['comment_box'];

		}else
		{
			$user             = $Translate[10];
			$password         = "";
			$confirm_password = "";
			$uid              = $DEFUserID;
			$gid              = $DEFGroupID;
			$dir              = "/";
			$status           = "1";
			$quotafiles       = "100";
			$quotasize        = "100";
			$ulbandwidth      = "80";
			$dlbandwidth      = "5";
			$dlratio          = "0";
			$ulratio          = "0";
			$ipaddress        = "*";
			$comment          = "";
		}



		$small_erea = 150;
		$large_erea = 275;
		$middle_erea = 570;


		echo ("<br><br>");
		echo ("<table class=\"edit_user\" width=\"850\">\n");


		echo ("<tr class=\"edit_user\">\n");
		echo ("<td class=\"border_ltb\" width=\"$small_erea\">".$Translate[32]."</td>\n");
		echo ("<td class=\"border_lrtb\" width=\"$middle_erea\">\n&nbsp;");
		echo ("<input type=\"text\" name=\"username_box\" size=\"10\" maxlength=\"16\" value=\"$user\">\n");
		echo ("</td>\n");

		echo ("<td class=\"border_rtb\">");

		/*
		echo ("&nbsp; ".$Translate[40]."  <input type=\"checkbox\" name=\"status_box\" value=\"1\" ");
		if ($status == "1")
			echo ("checked");
		echo (">&nbsp;&nbsp;");
		help($Translate[90]);
		*/

		echo ("<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n");
		echo ("<tr>");
		echo ("<td>");

		echo ("&nbsp;".$Translate[40]);
		echo ("</td>\n<td>\n");
		echo ("<input type=\"checkbox\" name=\"status_box\" value=\"1\" ");
		if ($status == "1")
			echo ("checked");
		echo (">&nbsp;&nbsp;");

		echo ("</td>");
		echo ("<td valign=\"bottom\">");
		help($Translate[90]);

		echo ("</td>");
		echo ("</tr>");
		echo ("</table>\n");


		echo ("</td>\n");
		echo ("</tr>\n");



		echo ("<tr class=\"edit_user\">\n");
		echo ("<td class=\"border_ltb\" width=\"$small_erea\">".$Translate[41]."</td>\n");
		echo ("<td class=\"border_lrtb\" colspan=\"2\">\n&nbsp;");
		echo ("<input type=\"password\" name=\"password_box\" size=\"20\" maxlength=\"64\" value=\"$password\">\n");
		echo ("</td>\n");
		echo ("</tr>\n");

		echo ("<tr class=\"edit_user\">\n");
		echo ("<td class=\"border_ltb\" width=\"$small_erea\">".$Translate[42]."</td>\n");
		echo ("<td class=\"border_lrtb\" colspan=\"2\">\n&nbsp;");
		echo ("<input type=\"password\" name=\"confirm_password_box\" size=\"20\" maxlength=\"64\" value=\"$confirm_password\">\n");
		echo ("</td>\n");
		echo ("</tr>\n");

		echo ("<tr class=\"edit_user\">\n");
		echo ("<td class=\"border_ltb\" width=\"$small_erea\">".$Translate[33]."</td>\n");
		echo ("<td class=\"border_lrtb\" colspan=\"2\">\n&nbsp;");


		echo ("<select name=\"select_user\" onchange='document.newuserform.uid_box.value=this.value;' style='width: 100px;'>");
		echo ("<option value=\"\">select user</option>");
		$iCounter = 0;
		$iFound_uid = 0;
		while ($iCounter < $iNrofunixusers)
		{
			echo ("<option value=\"".$unix_users[$iCounter][1]."\"");
			if ($uid == $unix_users[$iCounter][1])
			{
				echo (" selected=\"selected\"");
			//	$select_user_old = $unix_users[$iCounter][1];
				$iFound_uid = 1;
			}
			echo (">".$unix_users[$iCounter][0]."</option>");
			$iCounter++;
		}

		echo ("</select>\n");
		echo ("<img src=\"$LocationImages/arrow_right.gif\" height=\"10\" width=\"10\"");
		echo (" hspace=\"1\" align=\"middle\" border=\"0\"> ");

		echo ("<input type=\"text\" name=\"uid_box\" size=\"11\" maxlength=\"11\" value=\"$uid\">\n");
		help($Translate[91]);
		echo ("</td>\n");
		echo ("</tr>\n");

		echo ("<tr class=\"edit_user\">\n");
		echo ("<td class=\"border_ltb\" width=\"$small_erea\">".$Translate[34]."</td>\n");
		echo ("<td class=\"border_lrtb\" colspan=\"2\">\n&nbsp;");

		echo ("<select name=\"select_group\" onchange='document.newuserform.gid_box.value=this.value;' style='width: 100px;'>");
		echo ("<option value=\"\">select group</option>");
		$iCounter = 0;

		$iFound_gid = 0;
		while ($iCounter < $iNrofunixgroups)
		{
			echo ("<option value=\"".$unix_groups[$iCounter][1]."\"");
			if ($gid == $unix_groups[$iCounter][1])
			{
				echo (" selected=\"selected\"");
				// $select_group_old = $unix_groups[$iCounter][1];
				$iFound_gid = 1;
			}
			echo (">".$unix_groups[$iCounter][0]."</option>");
			$iCounter++;
		}

		echo ("</select>\n");

		echo ("<img src=\"$LocationImages/arrow_right.gif\" height=\"10\" width=\"10\"");
		echo (" hspace=\"1\" align=\"middle\" border=\"0\"> ");

		echo ("<input type=\"text\" name=\"gid_box\" size=\"11\" maxlength=\"11\" value=\"$gid\">\n");
		help($Translate[92]);
		echo ("</td>\n");
		echo ("</tr>\n");

		echo ("<tr class=\"edit_user\">\n");
		echo ("<td class=\"border_ltb\" width=\"$small_erea\">".$Translate[35]."</td>\n");
		echo ("<td class=\"border_ltb\" width=\"$middle_erea\">\n&nbsp;");


//		echo ("<input type=\"text\" name=\"dir_box\" size=\"40\" maxlength=\"128\" value=\"$dir\">\n");


		echo ("<input type=\"hidden\" name=\"dir_box\"  value=\"$dir\">\n");

		if (substr($dir, -1) == "/") // last char is '/'
			$dir_string = substr($dir, 0, -1); // remove last char
		else
			$dir_string = $dir;


		foreach(explode("/",$dir_string) as $element)
		{
			if(empty($element)) // first element
			{
				$dir_url = "/";
				echo ("<a href=\"#\" onclick=\"with (document.forms[0]) { dir_box.value='$dir_url'; submit();}\">");
				echo ("/");
				echo ("</a>");
			}else
			{
				$dir_url = "$dir_url$element/";
				echo ("<a href=\"#\" onclick=\"with (document.forms[0]) { dir_box.value='$dir_url'; submit();}\">");
				echo ($element);
				echo ("</a>");
				echo ("/");
			}
		}
		echo ("</td>\n");



		echo ("<td class=\"border_rtb\" align=\"right\">");

		if (isset($_POST['dirbrowser_box'])) // get new value
			$_SESSION['dirbrowser'] = $_POST['dirbrowser_box'];

		if(!isset($_SESSION['dirbrowser'])) //  set default value
			$_SESSION['dirbrowser'] = "0";


		echo ("<input type=\"hidden\" name=\"dirbrowser_box\" value=\"".$_SESSION['dirbrowser']."\">\n");


		if ($_SESSION['dirbrowser'] == 0)
		{
			echo ("<a href=\"#\" onclick=\"with (document.forms[0]) { dirbrowser_box.value='1'; submit();}\">");
			echo ("<img src=\"$LocationImages/arrow_up.gif\" class=\"icon\"");
			echo ("title=\"".$Translate[65]."\" ");
			echo ("alt=\"".$Translate[65]."\"></a>");

		}else
		{
			echo ("<a href=\"#\" onclick=\"with (document.forms[0]) { dirbrowser_box.value='0'; submit();}\">");
			echo ("<img src=\"$LocationImages/arrow_down.gif\" class=\"icon\" ");
			echo ("title=\"".$Translate[66]."\" ");
			echo ("alt=\"".$Translate[66]."\"></a>");

		}

		echo ("</td>");
		echo ("</tr>\n");




		if($_SESSION['dirbrowser'] == 1)
		{
		echo ("<tr class=\"edit_user\">\n");

		echo ("<td class=\"border_ltb\"width=\"$small_erea\">&nbsp;</td>\n");
		echo ("<td class=\"border_lrtb\" colspan=\"2\" bgcolor=\"#FFFFFF\">\n");




		echo ("<div id=\"dirbrowser_layer\" style=\"position:relative; width:100%; height:300; z-index:1; left: 0px; top: 0px; overflow: auto\">\n");

		if (isset($_POST['sort_box'])) // get last value
			$sort	= $_POST['sort_box'];


		if(!isset($sort)) //  set default value
			$sort = "name";


			echo ("<input type=\"hidden\" name=\"sort_box\" value=\"$sort\">\n");
			echo ("<table width=\"100%\" class=\"header\">\n");

			echo ("<tr>\n");
			echo ("<td class=\"header-left\">\n");


			// todo class head doenst exist?

			// echo ("<a href=\"".$_SERVER[PHP_SELF]."?sort=name\" class=\"head\">Name</a>\n");
			echo ("<a href=\"#\" onclick=\"with (document.forms[0]) { sort_box.value='name'; submit();}\" class=\"head\">".$Translate[80]."</a>\n");
			echo ("</td>\n");
			echo ("<td class=\"header-right\">\n");
			// echo ("<a href=\"".$_SERVER[PHP_SELF]."?sort=size\" class=\"head\">Size</a>\n");
			echo ("<a href=\"#\" onclick=\"with (document.forms[0]) { sort_box.value='size'; submit();}\" class=\"head\">".$Translate[81]."</a>\n");
			echo ("</td>\n");
			echo ("<td class=\"header-left\">\n");
			// echo ("<a href=\"".$_SERVER[PHP_SELF]."?sort=type\" class=\"head\">Type</a>\n");
			echo ("<a href=\"#\" onclick=\"with (document.forms[0]) { sort_box.value='type'; submit();}\" class=\"head\">".$Translate[82]."</a>\n");
			echo ("</td>\n");
			echo ("<td class=\"header-left\">\n");
			// echo ("<a href=\"".$_SERVER[PHP_SELF]."?sort=modify\" class=\"head\">Changed</a>\n");
			echo ("<a href=\"#\" onclick=\"with (document.forms[0]) { sort_box.value='modify'; submit();}\" class=\"head\">".$Translate[83]."</a>\n");
			echo ("</td>\n");
			echo ("<td class=\"header-left\">\n");
			// echo ("<a href=\"".$_SERVER[PHP_SELF]."?sort=owner\" class=\"head\">Owner</a>\n");
			echo ("<a href=\"#\" onclick=\"with (document.forms[0]) { sort_box.value='owner'; submit();}\" class=\"head\">".$Translate[84]."</a>\n");
			echo ("</td>\n");
			echo ("<td class=\"header-left\">\n");
			// echo ("<a href=\"".$_SERVER[PHP_SELF]."?sort=group\" class=\"head\">Group</a>\n");
			echo ("<a href=\"#\" onclick=\"with (document.forms[0]) { sort_box.value='group'; submit();}\" class=\"head\">".$Translate[85]."</a>\n");
			echo ("</td>\n");
			echo ("<td class=\"last-header\">\n");
			// echo ("<a href=\"".$_SERVER[PHP_SELF]."?sort=permission\" class=\"head\">Attributes</a>\n");
			echo ("<a href=\"#\" onclick=\"with (document.forms[0]) { sort_box.value='permission'; submit();}\" class=\"head\">".$Translate[86]."</a>\n");
			echo ("</td>\n");
			echo ("</tr>\n");

			$DirectoryListing = new directorylist ($dir);




			if (strlen($DirectoryListing->error) != 0)
			{
					echo ("<script language=\"JavaScript\" type=\"text/javascript\">\n");
					echo ("<!--\n\n");
					echo ("  alert(\"".$Translate[26]."\");\n\n");
					echo ("-->\n");
					echo ("</script>\n");
			}

			$DirectoryListing->order($sort,"ASC");


			for ($iElement=0;$iElement < $DirectoryListing->nrof_elements();$iElement++)
			{
				$File = $DirectoryListing->directory_element($iElement);

				if ($File->Type() != 'DIRECTORYREFRESH')
				{

					echo ("<tr bgcolor=\"#FFFFFF\">\n");
					echo ("<td class=\"left\" style=\"vertical-align:bottom\" title=\"".$File->Name()."\">");
					if ($File->Type() == 'DIRECTORY' ||
							$File->Type() == 'DIRECTORYUP')
					{

						echo ("<a href=\"#\" onclick=\"with (document.forms[0]) { dir_box.value='".$File->Path()."';saveScroll(); submit();}\">");
						echo ("<img style=\"margin:0px 0px 2px ; vertical-align:middle\" src=\"$LocationImages/icons/".$File->Icon()."\" class=\"icon\" >");
						echo ("<input style=\"width:170px; margin:0px 3px\" class=\"description\" value=\"".$File->Name()."\" name=\"textfield\" type=\"text\">");
						echo ("</a>");

					}else if ($File->Type() == 'FILE'){

						echo ("<img style=\"margin:0px 0px 2px ; vertical-align:middle\" src=\"$LocationImages/icons/".$File->Icon()."\" class=\"icon\" >");
						echo ("<input style=\"width:170px; margin:0px 3px\" class=\"description\" value=\"".$File->Name()."\" name=\"textfield\" type=\"text\">");
					}

					echo ("</td>\n");

					if ($File->Type() == 'DIRECTORY' ||
					    $File->Type() == 'DIRECTORYUP')
					{
						echo ("<td class=\"left\">");
						echo ("&nbsp;");
						echo ("</td>\n");
					}else
					{
						echo ("<td class=\"left\" title=\"".$File->Size(0)."\">");
						echo ("<input  style=\"width:50px; text-align: right;\" class=\"description\" value=\"".$File->Size(1)."\" name=\"textfield\" type=\"text\">");
						echo ("</td>\n");
					}

					if($File->Description() != "") // not empty
					{

						echo ("<td class=\"left\" title=\"".$File->Description()."\">");
						echo ("<input  style=\"width:110px;\" class=\"description\" value=\"".$File->Description()."\" name=\"textfield\" type=\"text\">");
						echo ("</td>\n");
					}
					else
						echo("<td class=\"left\">&nbsp;</td>\n");

					echo ("<td class=\"left\">");
					echo ("<input  style=\"width:80px;\" class=\"description\" value=\"".$File->Modify(2)."\" name=\"textfield\" type=\"text\">");
					echo ("</td>\n");

					echo ("<td class=\"left\" title=\"".$File->Owner()."\">");
					echo ("<input  style=\"width:55px;\" class=\"description\" value=\"".$File->Owner()."\" name=\"textfield\" type=\"text\">");
					echo ("</td>\n");

					echo ("<td class=\"left\" title=\"".$File->Group()."\">");
					echo ("<input  style=\"width:55px;\" class=\"description\" value=\"".$File->Group()."\" name=\"textfield\" type=\"text\">");
					echo ("</td>\n");

					echo ("<td class=\"left\">");
					echo ("<input  style=\"width:70px;\" class=\"description\" value=\"".$File->Permission(1)."\" name=\"textfield\" type=\"text\">");
					echo ("</td>\n");

					echo("</tr>\n");
				}
			}
			echo ("</table>\n");
		echo ("</div>");
		echo ("</td>\n");
		echo ("</tr>\n");

		}
		echo ("</table>\n");




		echo ("<table width=\"850\" class=\"edit_user\">\n");

		echo ("<tr class=\"edit_user\">\n");
			echo ("<td class=\"border_l\" width=\"$small_erea\">".$Translate[36]."</td>\n");
			echo ("<td class=\"border_lr\" width=\"$large_erea\">\n&nbsp;");
				echo ("<input type=\"text\" name=\"ulbandwidth_box\" size=\"10\" maxlength=\"10\" value=\"$ulbandwidth\">\n");
				help($Translate[93]);
			echo ("</td>\n");

		if ($EnableQuota == 1)
		{
			echo ("<td class=\"border_lr\" width=\"$small_erea\">".$Translate[43]."</td>\n");
			echo ("<td class=\"border_r\">\n&nbsp;");
			echo ("<input type=\"text\" name=\"quotafiles_box\" size=\"10\" maxlength=\"10\" value=\"$quotafiles\">\n");
				help($Translate[95]);
			echo ("</td>\n");
		}
		else
		{
			echo ("<td>");
			echo ("<input type=\"hidden\" name=\"quotafiles_box\" value=\"$quotafiles\">\n");
			echo("</td>\n<td class=\"border_r\">&nbsp;</td>\n");
		}


		echo ("</tr>\n");

		echo ("<tr class=\"edit_user\">\n");
			echo ("<td class=\"border_ltb\" width=\"$small_erea\">".$Translate[37]."</td>\n");
			echo ("<td class=\"border_lrtb\" width=\"$large_erea\">\n&nbsp;");
				echo ("<input type=\"text\" name=\"dlbandwidth_box\" size=\"10\" maxlength=\"10\" value=\"$dlbandwidth\">\n");
				help($Translate[94]);
			echo ("</td>\n");

		if ($EnableQuota == 1)
		{
			echo ("<td class=\"border_lrtb\" width=\"$small_erea\">".$Translate[44]."</td>\n");
			echo ("<td class=\"border_rtb\">\n&nbsp;");
				echo ("<input type=\"text\" name=\"quotasize_box\" size=\"10\" maxlength=\"10\" value=\"$quotasize\">\n");
				help($Translate[96]);
			echo ("</td>\n");
		}
		else
		{
			echo ("<td>");
			echo ("<input type=\"hidden\" name=\"quotasize_box\" value=\"$quotasize\">\n");
			echo("</td>\n<td class=\"border_r\">&nbsp;</td>\n");
		}


		echo ("</tr>\n");



		if ($EnableRatio == 1)
		{
				echo ("<tr class=\"edit_user\">\n");
					echo ("<td class=\"border_ltb\" width=\"$small_erea\">".$Translate[45]."</td>\n");
					echo ("<td class=\"border_lrtb\" width=\"$large_erea\">\n&nbsp;");
						echo ("<input type=\"text\" name=\"ulratio_box\" size=\"2\" maxlength=\"3\" value=\"$ulratio\">");
						echo (" : ");
						echo ("<input type=\"text\" name=\"dlratio_box\" size=\"2\" maxlength=\"3\" value=\"$dlratio\">");
						help($Translate[97]);
					echo ("</td>\n");
					echo ("<td class=\"border_r\" colspan=\"2\">\n&nbsp;</td>");
				echo ("</tr>\n");


		}else
		{

			echo ("<input type=\"hidden\" name=\"ulratio_box\" value=\"$ulratio\">");
			echo ("<input type=\"hidden\" name=\"dlratio_box\" value=\"$dlratio\">");
		}
		echo ("<tr class=\"edit_user\">\n");
			echo ("<td class=\"border_ltb\" width=\"$small_erea\">".$Translate[38]."</td>\n");
			echo ("<td class=\"border_lrtb\" width=\"$large_erea\">\n&nbsp;");
				echo ("<input type=\"text\" name=\"ipaddress_box\" size=\"20\" maxlength=\"20\" value=\"$ipaddress\">\n");
				help($Translate[98]);
			echo ("</td>\n");

			echo ("<td class=\"border_r\" colspan=\"2\">\n&nbsp;</td>");
		echo ("</tr>\n");


		echo ("<tr class=\"edit_user\">\n");
		echo ("<td class=\"border_ltb\" valign=\"top\" width=\"$small_erea\">".$Translate[46]."</td>\n");
		echo ("<td class=\"border_lrtb\" width=\"$large_erea\">\n");
			echo ("<table width=\"100%\"><tr><td>");
			echo ("<textarea name=\"comment_box\" cols=\"30\" rows=\"3\" wrap=\"virtual\">".$comment."</textarea>");
			echo ("</td></tr></table>");
		echo ("</td>\n");
		echo ("<td class=\"border_r\" colspan=\"2\">\n&nbsp;</td>");
		echo ("</tr>\n");

		echo ("<tr class=\"edit_user\" align=\"right\">\n");
		echo ("<td class=\"border_lrtb\" height=\"30\" colspan=\"4\">\n");
		echo ("<input name=\"save\" type=\"submit\" value=\"".$Translate[67]."\">&nbsp;\n");
		echo ("</td>\n");
		echo ("</tr>\n");


		echo ("</table>\n");
		echo ("</div>\n");
		echo ("</form>\n");
		// echo ("<script language=\"JavaScript\" type=\"text/javascript\" src=\"includes/wz_tooltip.php\"></script>\n");

		echo ("<script language=\"JavaScript\" type=\"text/javascript\">\n");
		echo ("<!--\n\n");
		require ('includes/wz_tooltip.php');
		echo ("-->\n");
		echo ("</script>\n");

		echo ("</body>\n");
		echo ("</html>\n");

		mysql_close($link);
	}
?>


