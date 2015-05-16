<?php

	/* 'User manager for PureFTPd' is made by M.Mastenbroek 2002 - 2005
	 *  For more info look at http://machiel.generaal.net
	 *  Version 2.1
	 */


	// If this file doesn't has a php extension this is done for security reasons.


	$ConfigVersion = "Version 2.1";


	if (isset($_GET['image']))
	{
		$name = $_GET['image'];
		unset($img);
		$img=array(
			'bluebar.gif'=>
			'R0lGODlhAQAZAMQAAAAAAP///6LB7ZK26JW46Ze66Zq86py965+/7KXE7ajG7piy1qvI767K8LDM'.
			'8cDW9MPY9cba9sve99Hi+cjd9s3g+M/h+NPk+dXm+tfn+9no+f///wAAAAAAAAAAAAAAACH5BAEA'.
			'ABsALAAAAAABABkAAAUVoJZh12RVEhVBj9MwSiIgh1EQwxICADs=',
			'yellowbar.gif'=>
			'R0lGODlhAgAZAMQAAAAAAP////ndkfnelPrglvrhmfjYifjZi/jbj/fRf/jUgvjVhvO7UPTAV/fM'.
			'dvfPfPKxQPKzRPO2SPO4TPS9VO+jK/CmL/CoMvGqNfGsOfGuPP///wAAAAAAAAAAAAAAACH5BAEA'.
			'ABsALAAAAAACABkAAAUqYFEQxDAIAoIch2Esi6IkyfM4TtNQFMNME4kkEoFANJpMBoO5XCyWSiUE'.
			'ADs=',
			'dot.gif'=>
			'R0lGODlhCQALAMQfAJu129bk+aG84s3e9uvz/trm+myJs8TZ9azE536cxuHs+8HW9LXO8d/r+3iU'.
			'u7bN742o0NLi+I+s15+75crc95St03WPtoWiy8jb9YWcvubw/Zasy7fP8bGxsXp6ev///yH5BAEA'.
			'AB8ALAAAAAAJAAsAAAU54CeOZDl2Xqp6KEFoSjFwKVxEGCekTUAtDAEkJQMiAJdU5PBATCSJ1OFY'.
			'gSQsKcQm47AYDKyVqhMCADs=',
			'background.jpg'=>
			'/9j/4AAQSkZJRgABAgAAZABkAAD/7AARRHVja3kAAQAEAAAAPAAA/+4ADkFkb2JlAGTAAAAAAf/b'.
			'AEMABgQEBAUEBgUFBgkGBQYJCwgGBggLDAoKCwoKDBAMDAwMDAwQDA4PEA8ODBMTFBQTExwbGxsc'.
			'Hx8fHx8fHx8fH//bAEMBBwcHDQwNGBAQGBoVERUaHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8f'.
			'Hx8fHx8fHx8fHx8fHx8fHx8fHx8fH//AABEIAPgBkAMBEQACEQEDEQH/xAAfAAABBQEBAQEBAQAA'.
			'AAAAAAAAAQIDBAUGBwgJCgv/xAC1EAACAQMDAgQDBQUEBAAAAX0BAgMABBEFEiExQQYTUWEHInEU'.
			'MoGRoQgjQrHBFVLR8CQzYnKCCQoWFxgZGiUmJygpKjQ1Njc4OTpDREVGR0hJSlNUVVZXWFlaY2Rl'.
			'ZmdoaWpzdHV2d3h5eoOEhYaHiImKkpOUlZaXmJmaoqOkpaanqKmqsrO0tba3uLm6wsPExcbHyMnK'.
			'0tPU1dbX2Nna4eLj5OXm5+jp6vHy8/T19vf4+fr/xAAfAQADAQEBAQEBAQEBAAAAAAAAAQIDBAUG'.
			'BwgJCgv/xAC1EQACAQIEBAMEBwUEBAABAncAAQIDEQQFITEGEkFRB2FxEyIygQgUQpGhscEJIzNS'.
			'8BVictEKFiQ04SXxFxgZGiYnKCkqNTY3ODk6Q0RFRkdISUpTVFVWV1hZWmNkZWZnaGlqc3R1dnd4'.
			'eXqCg4SFhoeIiYqSk5SVlpeYmZqio6Slpqeoqaqys7S1tre4ubrCw8TFxsfIycrS09TV1tfY2dri'.
			'4+Tl5ufo6ery8/T19vf4+fr/2gAMAwEAAhEDEQA/APqmgBKACmAlABQAUCEoAKBCUwCgBKAExTAT'.
			'FACYoEFMBKACgQmKAExTASgBMUCExTAKAEoASmITFACUxBQAmKAExTASgQUAJigBMUwExQITFMAo'.
			'ASgBKYgoASgApgJQIKAEoASmAUAJQAUAFMDoK4DrCgAoASmAUCEoGFAhKACgBMUxBQAlACEUwDFA'.
			'CYoEJTASgAoATFAhMUwEoAMUAJimITFACUAFMQhFACGgBKYhMUAIRTASgAoEJQAEUwExQISmAlAC'.
			'YoASmAUCEoAKAEpgFAhKACmAlACUAFAHQVwnWFABQAUAJQAUwEoAKACgQlABTEJQAlABigBMUwEx'.
			'QISmAUAJQAUCEpgJQAmKAExTEJigBKACmITFACYoATFMQlABigBKYCUCCgBMUwExQAlMQlABigBM'.
			'UwEoEFACUAFMBKBCUAFMBKACgDfrhOsKACgAoAKACgBKYBQISgYUCEoAKAEpiCgBKAExTASgAxQI'.
			'SmAlABQISgBMUwEoAQimITFABQAlABTEJigBMUxCYoATFACYpgJQAUCEoAQimAmKBCUwCgBKAEpg'.
			'FAhKACmAmKBBQAlACUwN+uE6woAKACgAoAKACgBKACmISgYUCEoAKACmISgBKADFACUwExQISmAl'.
			'ABQAhFAhKYBQAlACYpiEoASgApiExQAmKAEpiEoATFMBKACgQlABTATFAhMUwEoATFABTASgQUAJ'.
			'QAUwEoEJQBvVxHWFABQAUAFABQAUAFACUAFMQlAwoAKBCUAFMQlACUAFACUwExQAlAgpgJQAUCEp'.
			'gJQAmKAEIpiExQAlABQAmKYhCKAExTEFACYoASmAlAgoATFMBMUAJigQlMAoATFMBKBBQAlABTAS'.
			'gRu1xHWFABQAUAFABQAUAFABQAUAJTAKBCUDCgQlABQAlMQUAJQAlMAoASgQlMBKACgQmKAEpgJQ'.
			'AYoAQimITFACUAGKYhMUAJigBKYhMUAJimAlABQISgBCKYCGgQYpgJQAlACUwCgQlABQBuVxnUFA'.
			'BQAUAFABQAUAFABQAUAFACUwCgQlAwoAKBCUAFMQlACUAGKAEpgJigQlABTASgBKBCYpgFACYoAS'.
			'mIQigBKACmITFACYoATFMQlACEUwEoAKBBQAmKYCYoEJimAlACGgApgJQIKANuuM6goAKACgAoAK'.
			'ACgAoAKACgAoAKAEoAKYCUAFABQISgAoEJimAUAJQAmKYCYoAKBCUwEoAKBCYoASmAmKAExTATFA'.
			'hKACgBMUxCEUAJimIMUAJigBKYCUCCgBMUAJimAlAhMUwCgBKAEpiNuuM6goAKACgAoAKACgAoAK'.
			'ACgAoAKACgAoASmAUCEoGFAhKACgBKYgoASgBKYBQAmKBCUwEoAKAEoEJTASgAxQAmKYhMUAJQAU'.
			'xCYoATFACYpiEoATFMBMUAFAhKAEpgGKBCUwEoATFAG1XIdIUAFABQAUAFABQAUAFABQAUAFABQA'.
			'UAFACUAFMQlAwoASgQUAFMQlACUAFACUwEoEJTAKAEoATFAgpgJQAmKAEIpiEoASgApiExQAmKAE'.
			'piCgBMUAJimAlAgoAQimAlAhMUwEoA2a5DpCgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgBKYB'.
			'QISgYUCEoAKAEpiCgBKAExTATFABQISmAlABQITFACUwEoASgBDTEJQAUwCgQhFACYpiEoATFACU'.
			'wEoEFACUAIRTATFAjYrlOkKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgBKYBQISgYUAJQIK'.
			'ACmISgBKACgBMUwEoEJTASgAoATFAhKYBQAmKAExTEJigBKACmIQ0AJigBKYhMUAJimAlABQISgA'.
			'xTA1q5ToCgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKAEoAKYCUAFABQISgAoEJTASgAoA'.
			'TFMBKAEoEFMBKADFAhMUwEoAQigBMUxCYoASgAoEJTATFACYpiCgBMUAJTASgQUAatcx0BQAUAFA'.
			'BQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAlABTEFACUDCgQlABQAlMQUAJQAlMAoAbigQUwE'.
			'oAKBCYoASmAlABigBpFMQUAJQAYpiEIoATFMBKBCYoATFMBKANWuY3CgAoAKACgAoAKACgAoAKAC'.
			'gAoAKACgAoAKACgAoAKACgAoAKAEoAKYhKBhQAlAgoAKYhKAEoAKAEpgJigQmKACmAlACYoEJTAK'.
			'AExQAmKYhMUAJQAUxCYoATFACUxCYoAQigDUrnNwoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAo'.
			'AKACgAoAKACgAoASgApgJQAUAFAhKACmISgBKADFACUwEoASgQUwEoAKBCYoASmAmKAExTATFAhK'.
			'ACgBMUxCEUAIRTEGKANKuc3CgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAo'.
			'AKAEpgFAhKBhQISgAoASmIKAEoASmAYoATFAhKYCUAFACUCExTAKAExQAmKYhKAEoAKYhMUAJigD'.
			'RrA2CgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgBKACmISgAoGJQI'.
			'KACmISgBKACgBMUwExQISgApgJQAmKBCYpgFACUAJTEJigBKACmIQigDQrA2CgAoAKACgAoAKACg'.
			'AoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoASgApiCgBKBhQISgApgJQIKAEoASmAmK'.
			'AEoEFMBKACgQhFACUwEoAQimAmKBBQAlAF+sTUKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKAC'.
			'gAoAKACgAoAKACgAoAKACgAoAKAEpgFAhKBhQISgAoASmIKAEoASgApgJigQlMBKACgBKBCYpgFA'.
			'CYoATFMQmKAL1YmoUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFA'.
			'BQAUAFACUAFMQlAwoEFACUAFAhKYCUAFACYpgJigBMUCCmAlABQITFMBKAExQAmKYi7WJqFABQAU'.
			'AFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFACUxBQAlAwo'.
			'EJQAUAJTEFACUAJTASgAxQISmAlABQITFACUwEoAuVkaBQAUAFABQAUAFABQAUAFABQAUAFABQAU'.
			'AFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAJQAUxCUDCgBKBBQAUxCUAJQAYoASmAlAh'.
			'KYCUAFACUCEpgW6yNAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoA'.
			'KACgAoAKACgAoAKACgBKACmISgYUAFAhKACmITFACUAFACUwEoASgQUwEoAKBFmszQKACgAoAKAC'.
			'gAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgBKYBQ'.
			'ISgYUCEoAKAEpiCgBKAExTAMUAJigQlMBKALNZlhQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQ'.
			'AUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFACUAFMQlAwoASgQUAFMQlACUAGKAEp'.
			'gJigQmKALFQWFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAF'.
			'ABQAUAFABQAUAFABQAUAFACUAFMQUAJQMKBCUAFMQlACUAFACYpgJQInqCwoAKACgAoAKACgAoAK'.
			'ACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgBKY'.
			'BQAlABQISgAoASmIKAEoATFMCaoKCgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAK'.
			'ACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgBKACmISgYUAFAhKACmISgBKAJakoKAC'.
			'gAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKA'.
			'CgAoAKACgAoAKACgBKACmAUAJQAUCEoAKAEpiP/Z'
		);


		header("Content-type: image/gif");
		header("Cache-control: public");
		// /*
		header("Expires: ".date("r",mktime(0,0,0,1,1,2030)));
		header("Cache-control: max-age=".(60*60*24*7));
		header("Last-Modified: ".date("r",filemtime(__FILE__)));
		// */
		die (base64_decode($img[$name]));
	}

	session_start();

	if ($_SESSION['Step'] != '1' &&
		$_SESSION['Step'] != '2' &&
		$_SESSION['Step'] != '3' &&
		$_SESSION['Step'] != '4' &&
		$_SESSION['Step'] != '5' &&
		$_SESSION['Step'] != '6' &&
		$_SESSION['Step'] != '7')
		$_SESSION['Step'] = '1';

	if ($_POST['step'] == "Step 7")
		$_SESSION['Step'] = '7';

	if ($_POST['step'] == "Step 6")
		$_SESSION['Step'] = '6';

	if ($_POST['step'] == "Step 5")
		$_SESSION['Step'] = '5';

	if ($_POST['step'] == "Step 4")
		$_SESSION['Step'] = '4';

	if ($_POST['step'] == "Step 3")
		$_SESSION['Step'] = '3';

	if ($_POST['step'] == "Step 2")
		$_SESSION['Step'] = '2';


	if ($_POST['step'] == "Step 1")
		$_SESSION['Step'] = '1';

	if ($_POST['step'] == "Continue")
		$_SESSION['Step3'] = 'exist';



	if ($_GET['exist_database'] == "1")
	{
		$_SESSION['Step'] = '3';
		$_SESSION['Step3'] = 'exist';
	}

	if ($_GET['new_database'] == "1")
	{
		$_SESSION['Step'] = '3';
		$_SESSION['Step3'] = 'new';
	}


	if (isset($_POST['upgrade']))
	{
		$_SESSION['Step3'] = 'update';
	}




	if ($_SESSION['Step'] == '4')
	{


		if(isset($_POST['save']))
		{

			// echo ("Save<br>\n");
			$filecontent = "";



			$filename = "config.php";

			$filecontent .= "<?php\n";
			$filecontent .= "  /* 'User manager for PureFTPd' is made by M.Mastenbroek 2002 - 2005\n";
			$filecontent .= "   *  For more info look at http://machiel.generaal.net\n";
			$filecontent .= "   *  $ConfigVersion\n";
			$filecontent .= "   */\n\n";
			$filecontent .= "  \$LANG = \"".$_POST['language']."\";                  // See the directory language for the available languages.\n\n";
			$filecontent .= "  \$LocationImages =  \"".$_POST['image_location']."\";        // Location of images\n\n";
			$filecontent .= "  \$DBHost = \"".$_SESSION['LocalValue_DBHost']."\";              // Ip-address of MySQL server\n";
			$filecontent .= "                                      // (Don’t change this if you are using the default database)\n\n";
			$filecontent .= "  \$DBLogin = \"".$_SESSION['LocalValue_DBLogin']."\";                   // Username of MySQL user\n\n";
			$filecontent .= "  \$DBPassword = \"".$_SESSION['LocalValue_DBPassword']."\";          // Password of MySQL user\n\n";
			$filecontent .= "  \$DBDatabase = \"".$_SESSION['LocalValue_DBDatabase']."\";           // Name of database\n\n";
			$filecontent .= "  \$FTPAddress = \"".$_POST['ftp_address']."\";   // Domain name or ip-address of your ftp server\n\n";
			$filecontent .= "  \$DEFUserID = \"".$_POST['default_user_id']."\"; // nobody     // Default user id of virtual ftp user.\n\n";
			$filecontent .= "  \$DEFGroupID = \"".$_POST['default_group_id']."\";   // guest      // Default group is of virtual ftp user.\n\n";
			$filecontent .= "  \$UsersFile = \"".$_POST['location_passwd']."\";        // The unix user file\n\n";
			$filecontent .= "  \$GroupFile = \"".$_POST['location_groupfile']."\";         // The unix group file\n\n";
			$filecontent .= "  \$StyleSheet = \"".$_POST['stylesheet']."\"; // The location of the style sheet\n\n";


			if ($_POST['quota_support'] == true)
				$quota_support = 1;
			else
				$quota_support = 0;

			if ($_POST['ratio_support'] == true)
				$ratio_support = 1;
			else
				$ratio_support = 0;

			$filecontent .= "  \$EnableQuota = $quota_support;                  // Enable virtual quota's (0=Off 1=On)\n\n";

			$filecontent .= "  \$EnableRatio = $ratio_support;                  // Enable ratio (0=Off 1=On)\n";
			$filecontent .= "                                     // The pureftpd server has to be compiled with ratio support.\n\n";

			$filecontent .= "  /* This list of users will NOT appear in the dropdown menu. */\n";
			$filecontent .= "  \$BlacklistUsers = array ('adm','bin','bind','daemon','gopher','halt','kmem','lp',\n";
			$filecontent .= "                           'mailnull','man','named','nfsnobody','nscd','operator',\n";
			$filecontent .= "                           'pop','root','rpc','rpcuser','rpm','shutdown','smmsp',\n";
			$filecontent .= "                           'sshd','sync','toor','tty','uucp','vcsa','xfs');\n\n";

			$filecontent .= "  /* This list of groups will NOT appear in the dropdown menu. */\n";
			$filecontent .= "  \$BlacklistGroups = array ('adm','bin','bind','daemon','dialer','dip','disk','floppy','gopher','kmem',\n";
			$filecontent .= "                           'lock','lp','mailnull','man','named','mem','network','news',\n";
			$filecontent .= "                           'nscd','ntp','operator','pcap','root','rpc','rpcuser','rpm','slocate','smmsp',\n";
			$filecontent .= "                           'sshd','staff','sys','tty','utmp','uucp','vcsa','wheel','xfs');\n\n";
			$filecontent .= "?>";


			// echo ("$filecontent");

			$fh = fopen($filename,"w");
			fwrite($fh, $filecontent);
			fclose($fh);

		}

	}


	if($_SESSION['Step'] != '1')
	{

		if(!include('config.php'))
			die("<br>Error: couldn't open file <b>config.php</b><br>\n");

		if (strlen($_SESSION['LocalValue_DBHost']) == 0)
			$_SESSION['LocalValue_DBHost'] = $DBHost;

		if (strlen($_SESSION['LocalValue_DBLogin']) == 0)
			$_SESSION['LocalValue_DBLogin'] = $DBLogin;

		if (strlen($_SESSION['LocalValue_DBPassword']) == 0)
			$_SESSION['LocalValue_DBPassword'] = $DBPassword;

		if (strlen($_SESSION['LocalValue_DBDatabase']) == 0)
			$_SESSION['LocalValue_DBDatabase'] = $DBDatabase;

	}




	if($_SESSION['Step'] == '3')
	{

		if (strlen($_SESSION['Admin_DBHost']) == 0)
			$_SESSION['Admin_DBHost'] = "localhost";

		if (strlen($_SESSION['Admin_DBLogin']) == 0)
			$_SESSION['Admin_DBLogin'] = "root";

		if (strlen($_SESSION['Admin_DBPassword']) == 0)
			$_SESSION['Admin_DBPassword'] = "";


		if (isset($_POST['AdminHostname']))
			$_SESSION['Admin_DBHost'] = $_POST['AdminHostname'];

		if (isset($_POST['AdminLogin']))
			$_SESSION['Admin_DBLogin'] = $_POST['AdminLogin'];

		if (isset($_POST['AdminPassword']))
			$_SESSION['Admin_DBPassword'] = $_POST['AdminPassword'];

	}

	if($_SESSION['Step'] == '3' ||
	   $_SESSION['Step'] == '4')
	{

		if (isset($_POST['Hostname']))
			$_SESSION['LocalValue_DBHost'] = $_POST['Hostname'];

		if (isset($_POST['Login']))
			$_SESSION['LocalValue_DBLogin'] = $_POST['Login'];

		if (isset($_POST['Password']))
			$_SESSION['LocalValue_DBPassword'] = $_POST['Password'];

		if (isset($_POST['Database']))
			$_SESSION['LocalValue_DBDatabase'] = $_POST['Database'];

	}

	if($_SESSION['Step'] == '5')
	{


		$link = mysql_connect("$DBHost", "$DBLogin", "$DBPassword");
		if(!$link)
			die("<br>Error: MySql server not found.<br><br>MySql error : ".mysql_error());

		if (!@mysql_select_db("$DBDatabase"))
			die("<br>Error: Database 'ftpusers' doesn't exist.<br><br>MySql error : ".mysql_error());

		$table_users  = "SELECT * FROM admin ORDER BY Username ASC";
		$query_users  = mysql_query($table_users);
		if (!$query_users)
			die("<br>Error: Table 'admin' from database 'ftpusers' doesn't exist.<br><br>MySql error : ".mysql_error());





		if (isset($_POST["admin_change"]) &&
			isset($_POST["admin_password"]) &&
			$_POST["admin_password"] != "aaaaaa")
		{
			if(!mysql_query("UPDATE admin SET Password='".md5($_POST['admin_password'])."' WHERE Username='Administrator'",$link))
				echo ("Failed to change the Administrator password<br>".mysql_error()."<br>\n");
			else
				echo ("The 'Administrator' password has been changed!<br>\n");
		}


		//echo ("\$_POST[\"admin_id\"] = ".$_POST["admin_id"]."<br>\n");

		if (isset($_POST["admin_id"]) &&
			isset($_POST["admin_id"]) != "0")
		{


			$admin_id = $_POST["admin_id"];

			$user = "admin2_".$admin_id."_name";
			$user = $_POST["$user"];


			$password = "admin2_".$admin_id."_password";
			$password = $_POST["$password"];


			if (isset($_POST["admin2_change"]))
			{

				if ($password == "aaaaaa") // Change only username
				{
					if(!mysql_query("UPDATE admin SET Username='$user' WHERE Username='$admin_id'",$link))
						echo ("Failed to change the username '$user'<br>".mysql_error()."<br>\n");
					else
						echo ("The username '$user' has been changed!<br>\n");

				}else // Change username and password.
				{
					if(!mysql_query("UPDATE admin SET Username='$user',Password='".md5($password)."' WHERE Username='$admin_id'",$link))
						echo ("Failed to change the username and password of '$user'<br>".mysql_error()."<br>\n");
					else
						echo ("The username and password of the user '$user' has been changed!<br>\n");

				}

			}else if (isset($_POST["admin2_delete"]))
			{

				if(!mysql_query("DELETE FROM admin WHERE Username='$admin_id'",$link))
					echo ("Failed to remove the user $admin_id<br>".mysql_error()."<br>\n");
				else
					echo ("Delete user $admin_id<br>\n");
			}

		}

		if (isset($_POST["admin3"]) &&
			isset($_POST["admin3_password"]) &&
			isset($_POST["admin3_add"]))
		{
			$user = $_POST["admin3"];
			$password = $_POST["admin3_password"];

			if ($user != "" && $password != "")
			{
				if(!mysql_query("INSERT INTO admin (Username,Password) VALUES ('$user','".md5($_POST['admin3_password'])."')",$link))
					echo ("Failed to add user $user!<br>".mysql_error()."<br>\n");
			}
		}

	}

	echo ("<html>\n");
	echo ("<head>\n");
	echo ("<title>Installation Wizard for the 'User manager for PureFTPd'</title>\n");
	echo ("<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$CharSet\">\n");
	echo ("<meta name=\"description\" content=\"The ‘User manager for PureFTPd’ is a software project from Machiel Mastenbroek,");
	echo (" more information about this free software could be found on my website: http://machiel.generaal.net/index.php?subject=user_manager_pureftpd \">\n");

	echo ("<style type=\"text/css\">\n");
	echo ("A {\n");
	echo ("  TEXT-DECORATION: underline;\n");
	echo ("  COLOR: #821517; TEXT-DECORATION: none;\n");
	echo ("}\n");
	echo ("A:hover {\n");
	echo ("  TEXT-DECORATION: underline\n");
	echo ("  COLOR: #821517; TEXT-DECORATION: underline\n");
	echo ("}\n");



	echo ("</style>\n");
	echo ("</head>\n");


	echo ("<body style=\"COLOR: #000000; FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif; BACKGROUND-COLOR: #ffffff; TEXT-ALIGN: center\">\n");



	error_reporting(E_ERROR);



	echo ("<form action=\"$_SERVER[PHP_SELF]\" method=\"post\" name=\"configuration\">\n");

	echo ("<table style=\"BORDER-RIGHT: #003399 1px solid; BORDER-TOP: #003399 1px solid; BACKGROUND: url(".$_SERVER[PHP_SELF]."?image=background.jpg) ");
	echo ("#fff no-repeat right top; MARGIN: 0px auto; BORDER-LEFT: #003399 1px solid; WIDTH: 740px; TEXT-ALIGN: left ");
	echo ("border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n");
	echo ("<tr style=\"BACKGROUND: url(".$_SERVER[PHP_SELF]."?image=yellowbar.gif) #fff repeat-x 50% top\">\n");
	echo ("<td>\n");
	echo ("&nbsp;<img src=\"".$_SERVER[PHP_SELF]."?image=dot.gif\" style=\"margin-top: 1px;\">&nbsp;Configuration 'User manager for PureFTPd'\n");
	echo ("</td>\n");
	echo ("<td align=\"right\">\n");
	echo ("<span style=\"FONT-WEIGHT: bold; FONT-SIZE: 12px\">Step [".$_SESSION['Step']." - 7]&nbsp;</span>\n");
	echo ("</td>\n");
	echo ("</tr>\n");
	echo ("<tr style=\"BACKGROUND: url(".$_SERVER[PHP_SELF]."?image=bluebar.gif) #fff repeat-x 50% top\">\n");
	echo ("<td colspan=\"2\" style=\"BORDER-TOP: #003399 1px solid; BORDER-BOTTOM: #003399 1px solid;\" align=\"right\">&nbsp;</td>\n");
	echo ("</tr>\n");
	echo ("<tr align=\"left\" valign=\"top\">\n");
	echo ("<td colspan=\"2\">\n");
	echo ("<table width=\"100%\" border=\"0\" cellpadding=\"0\">\n");

	$errors = 0;

	if ($_SESSION['Step'] == '1')
	{

		echo ("<tr>\n");
		echo ("<td width=\"60%\">&nbsp;</td>\n");
		echo ("<td width=\"30%\">&nbsp;</td>\n");
		echo ("<td width=\"10%\">&nbsp;</td>\n");
		echo ("</tr>\n");


		echo ("<tr>\n");
		echo ("<td colspan=\"3\">This configuration script has carried out a few checks to see if everything is ready to start the configuration.</td>\n");
		echo ("</tr>\n");

		echo ("<tr><td colspan=\"3\">&nbsp;</td></tr>\n");


		echo ("<tr>\n");
		echo ("<td>Checking if config.php exists</td>\n");
		if(!file_exists("config.php")) {
			echo ("<td><font color=\"red\">Failed!</font></td>\n");
			$errors += 1;
		} else {
			echo ("<td><font color=\"green\">OK!</font></td>\n");
		}
		echo ("<td>&nbsp;</td>\n");
		echo ("</tr>\n");

		echo ("<tr>\n");
		echo ("<td>Checking if config.php is writable</td>\n");
		if(!is_writable("config.php")) {
			echo ("<td><font color=\"red\">Failed!</font></td>\n");
			$errors += 1;
		} else {
			echo ("<td><font color=\"green\">OK!</font></td>\n");
		}
		echo ("<td>&nbsp;</td>\n");
		echo ("</tr>\n");


		echo ("<tr>\n");
		echo ("<td>Checking if PHP Extension MYSQL is enabled</td>\n");
		if (!extension_loaded('mysql')) {
			echo ("<td><font color=\"red\">Failed!</font></td>\n");
			$errors += 1;
		} else {
			echo ("<td><font color=\"green\">OK!</font></td>\n");
		}
		echo ("<td>&nbsp;</td>\n");
		echo ("</tr>\n");

		echo ("<tr>\n");
		echo ("<td>Checking if PHP Extension PCRE is enabled</td>\n");
		if (!extension_loaded('pcre')) {
			echo ("<td><font color=\"red\">Failed!</font></td>\n");
			$errors += 1;
		} else {
			echo ("<td><font color=\"green\">OK!</font></td>\n");
		}
		echo ("<td>&nbsp;</td>\n");
		echo ("</tr>\n");

		echo ("<tr>\n");
		echo ("<td>Checking if PHP Extension POSIX is enabled</td>\n");
		if (!extension_loaded('posix')) {
			echo ("<td><font color=\"red\">Failed!</font></td>\n");
			$errors += 1;
		} else {
			echo ("<td><font color=\"green\">OK!</font></td>\n");
		}
		echo ("<td>&nbsp;</td>\n");
		echo ("</tr>\n");

		echo ("<tr>\n");
		echo ("<td>Checking if PHP Extension SESSION is enabled</td>\n");
		if (!extension_loaded('session')) {
			echo ("<td><font color=\"red\">Failed!</font></td>\n");
			$errors += 1;
		} else {
			echo ("<td><font color=\"green\">OK!</font></td>\n");
		}
		echo ("<td>&nbsp;</td>\n");
		echo ("</tr>\n");

		echo ("<tr><td colspan=\"3\">&nbsp;</td></tr>\n");

		if ($errors != 0)
		{
			echo ("<tr>\n");
			echo ("<td colspan=\"3\">Unfortunately, The configuration cannot continue at the moment, due to the above error(s). Please correct the error(s), and try again.</td>\n");
			echo ("</tr>\n");
		}else
		{
			echo ("<tr>\n");
			echo ("<td colspan=\"2\">&nbsp;</td><td align=\"right\"><input type=\"submit\" name=\"step\" value=\"Step 2\"></td>\n");
			echo ("</tr>\n");
		}
	}else if ($_SESSION['Step'] == '2')
	{
			echo ("<tr>\n");
			echo ("<td width=\"60%\">&nbsp;</td>\n");
			echo ("<td width=\"30%\">&nbsp;</td>\n");
			echo ("<td width=\"10%\">&nbsp;</td>\n");
			echo ("</tr>\n");

			echo ("<tr>\n");
			echo ("<td colspan=\"3\">Please choose your configuration type:.</td>\n");
			echo ("</tr>\n");

			echo ("<tr><td colspan=\"3\">&nbsp;</td></tr>\n");

			echo ("<tr>\n");
			echo ("<td><a href=\"".$_SERVER[PHP_SELF]."?new_database=1\">");
			echo ("New installation,<br>create a new database.</a></td>\n");
			//echo ("<td><input type=\"button\" name=\"new_database\" value=\"New Database\" ></td>\n");
			echo ("<td>&nbsp;</td>\n");
			echo ("<td>&nbsp;</td>\n");
			echo ("</tr>\n");
			echo ("<tr><td colspan=\"3\">&nbsp;</td></tr>\n");
			echo ("<tr>\n");
			echo ("<td><a href=\"".$_SERVER[PHP_SELF]."?exist_database=1\">");
			echo ("Exist installation,<br>upgrade or continue with current database.</a></td>\n");
			// echo ("<td><input type=\"button\" name=\"step\" value=\"Step 3\" ></td>\n");
			echo ("<td>&nbsp;</td>\n");
			echo ("<td>&nbsp;</td>\n");
			echo ("</tr>\n");

			echo ("<tr><td colspan=\"3\">&nbsp;</td></tr>\n");

			echo ("<tr>\n");
			echo ("<td><input type=\"submit\" name=\"step\" value=\"Step 1\"></td><td >&nbsp;</td>\n");
			// echo ("<td align=\"right\"><input type=\"submit\" name=\"step\" value=\"Step 3\"></td>");
			echo ("<td>&nbsp;</td>");
			echo ("</tr>\n");

	}
	else if ($_SESSION['Step'] == '3')
	{
		echo ("<tr>\n");
		echo ("<td width=\"60%\">&nbsp;</td>\n");
		echo ("<td width=\"30%\">&nbsp;</td>\n");
		echo ("<td width=\"10%\">&nbsp;</td>\n");
		echo ("</tr>\n");


		if ($_SESSION['Step3'] == 'exist')
		{
			echo ("<tr>\n");
			echo ("<td colspan=\"3\">Settings MySQL database.</td>\n");
			echo ("</tr>\n");

			echo ("<tr><td colspan=\"3\">&nbsp;</td></tr>\n");




			echo ("<tr>\n");
			echo ("<td>Hostname</td>\n");
			echo ("<td><input type=\"text\" name=\"Hostname\" value=\"".$_SESSION['LocalValue_DBHost']."\" size=\"25\" maxlength=\"25\"></td>\n");
			echo ("<td><input type=\"button\" value=\"default\" onclick='document.configuration.Hostname.value=\"127.0.0.1\";'></td>\n");
			echo ("</tr>\n");

			echo ("<tr>\n");
			echo ("<td>Login</td>\n");
			echo ("<td><input type=\"text\" name=\"Login\" value=\"".$_SESSION['LocalValue_DBLogin']."\" size=\"25\" maxlength=\"25\"></td>\n");
			echo ("<td><input type=\"button\" value=\"default\" onclick='document.configuration.Login.value=\"ftp\";'></td>\n");
			echo ("</tr>\n");

			echo ("<tr>\n");
			echo ("<td>Password</td>\n");
			echo ("<td><input type=\"text\" name=\"Password\" value=\"".$_SESSION['LocalValue_DBPassword']."\" size=\"25\" maxlength=\"25\"></td>\n");
			echo ("<td><input type=\"button\" value=\"default\" onclick='document.configuration.Password.value=\"tmppasswd\";'></td>\n");
			echo ("</tr>\n");

			echo ("<tr>\n");
			echo ("<td>Database</td>\n");
			echo ("<td><input type=\"text\" name=\"Database\" value=\"".$_SESSION['LocalValue_DBDatabase']."\" size=\"25\" maxlength=\"25\"></td>\n");
			echo ("<td><input type=\"button\" value=\"default\" onclick='document.configuration.Database.value=\"ftpusers\";'></td>\n");
			echo ("</tr>\n");



			echo ("<tr><td colspan=\"3\">&nbsp;</td></tr>\n");

			echo ("<tr>\n");
			echo ("<td>Checking connection to MySQL server ".$_SESSION['LocalValue_DBHost']."</td>\n");
				$link = mysql_connect($_SESSION['LocalValue_DBHost'], $_SESSION['LocalValue_DBLogin'], $_SESSION['LocalValue_DBPassword']);
				if(!$link)
				{
					echo ("<td><font color=\"red\">Failed!</font></td>\n");
					$error += 1;
				}
				else
				{
					echo ("<td><font color=\"green\">OK!</font></td>\n");
				}
			//echo ("</td\n");
			echo ("<td>&nbsp;</td>\n");

			echo ("</tr>\n");
			echo ("<tr>\n");
			echo ("<td>Checking connection to '".$_SESSION['LocalValue_DBDatabase']."' database</td>\n");
				if (!@mysql_select_db($_SESSION['LocalValue_DBDatabase']))
				{
					echo ("<td><font color=\"red\">Failed!</font></td>\n");
					$error += 1;
				}
				else
				{
					echo ("<td><font color=\"green\">OK!</font></td>\n");
				}
			//echo ("</td>\n");
			echo ("<td>&nbsp;</td>\n");
			echo ("</tr>\n");





			echo ("<tr>\n");
			echo ("<td>Opening table 'admin'</td>\n");
				$table_admin  = "SELECT * FROM admin ORDER BY Username ASC";
				$query_admin  = mysql_query($table_admin);
				if (!$query_admin)
				{
					echo ("<td><font color=\"red\">Failed!</font></td>\n");
					$error += 1;
				}
				else
				{
					echo ("<td><font color=\"green\">OK!</font></td>\n");
				}
			//echo ("</td>\n");
			echo ("<td>&nbsp;</td>\n");
			echo ("</tr>\n");

			echo ("<tr>\n");
			echo ("<td>Opening table 'users'</td>\n");
				$table_users  = "SELECT * FROM users ORDER BY User ASC";
				$query_users  = mysql_query($table_users);
				if (!$query_users)
				{
					echo ("<td><font color=\"red\">Failed!</font></td>\n");
					$error += 1;
				}
				else
				{
					echo ("<td><font color=\"green\">OK!</font></td>\n");
				}
			//echo ("</td>\n");
			echo ("<td>&nbsp;</td>\n");
			echo ("</tr>\n");

			echo ("<tr>\n");
			echo ("<td>Table 'users' up-to-date</td>\n");
				$table_users  = "SELECT User, Password, Uid, Gid, Dir, QuotaFiles, QuotaSize, ULBandwidth, DLBandwidth, Status, Ipaddress, Comment FROM users ORDER BY User ASC";
				$query_users  = mysql_query($table_users);
				if (!$query_users)
				{
					echo ("<td><font color=\"red\">Failed!</font></td>\n");
					$error += 1;
					$up_to_date = 0;
				}
				else
				{
					echo ("<td><font color=\"green\">OK!</font></td>\n");
					$up_to_date = 1;
				}

				echo ("<td>&nbsp;</td>\n");

			echo ("</tr>\n");

			if ($error == 1 && $up_to_date == 0)
			{
				echo ("<tr><td colspan=\"3\">&nbsp;</td></tr>\n");

				echo ("<tr>\n");
				echo ("<td>Your current database is out of date,<br>therefore you must first upgrade your database.</td>\n");
				echo ("<td><input type=\"submit\" name=\"upgrade\" value=\"upgrade\"></td>\n");
				echo ("<td>&nbsp;</td>\n");
				echo ("</tr>\n");
			}



			echo ("<tr><td colspan=\"3\">&nbsp;</td></tr>\n");
			echo ("<tr>\n");
			echo ("<td><input type=\"submit\" name=\"step\" value=\"Step 2\"></td>");
			echo ("<td><input type=\"submit\" name=\"tryagain\" value=\"Refresh\"></td>");
			if ($error == 0)
				echo ("<td align=\"right\"><input type=\"submit\" name=\"step\" value=\"Step 4\"></td>");
			else
				echo ("<td>&nbsp;</td>");
			echo ("</tr>\n");

		}else if($_SESSION['Step3'] == 'update')
		{


			echo ("<tr>\n");
			echo ("<td colspan=\"3\">Before the upgrade of the current database we need ");
			echo ("a MySQL user with enough privileges to change the table structure.");
			echo ("The attributes username and password will only be used for this goal and will <b>not</b> ");
			echo ("be saved or stored after this php session.</td>\n");
			echo ("</tr>\n");


			echo ("<tr><td colspan=\"3\">&nbsp;</td></tr>\n");

			echo ("<tr>\n");
			echo ("<td>Hostname</td>\n");
			echo ("<td><input type=\"text\" name=\"AdminHostname\" value=\"".$_SESSION['Admin_DBHost']."\" size=\"25\" maxlength=\"25\"></td>\n");
			echo ("<td><input type=\"button\" value=\"default\" onclick='document.configuration.AdminHostname.value=\"localhost\";'></td>\n");
			echo ("</tr>\n");

			echo ("<tr>\n");
			echo ("<td>Username</td>\n");
			echo ("<td><input type=\"text\" name=\"AdminLogin\" value=\"".$_SESSION['Admin_DBLogin']."\" size=\"25\" maxlength=\"25\"></td>\n");
			echo ("<td><input type=\"button\" value=\"default\" onclick='document.configuration.AdminLogin.value=\"root\";'></td>\n");
			echo ("</tr>\n");

			echo ("<tr>\n");
			echo ("<td>Password</td>\n");
			echo ("<td><input type=\"password\" name=\"AdminPassword\" value=\"".$_SESSION['Admin_DBPassword']."\" size=\"25\" maxlength=\"25\"></td>\n");
			echo ("<td><input type=\"button\" value=\"default\" onclick='document.configuration.AdminPassword.value=\"\";'></td>\n");
			echo ("</tr>\n");

			echo ("<tr><td colspan=\"3\">&nbsp;</td></tr>\n");

			echo ("<tr>\n");
			echo ("<td>Checking connection to MySQL server </td>\n");
				$adminlink = mysql_connect($_SESSION['Admin_DBHost'], $_SESSION['Admin_DBLogin'], $_SESSION['Admin_DBPassword']);
				if(!$adminlink)
				{
					echo ("<td><font color=\"red\">Failed!</font></td>\n");
					$error += 1;
				}
				else
				{
					echo ("<td><font color=\"green\">OK!</font></td>\n");
				}
			//echo ("</td\n");

			if ($error == 0)
				echo ("<td>&nbsp;</td>\n");
			else
				echo ("<td><input type=\"submit\" name=\"connect\" value=\"Try again\"></td>\n");

			echo ("</tr>\n");

			if ($error == 0)
			{
				echo ("<tr>\n");
				echo ("<td>Update database</td>\n");


				//$errormsg = mysql_query("INSERT INTO mysql.user (Host, User, Password, Select_priv, Insert_priv, Update_priv, Delete_priv, Create_priv, Drop_priv, Reload_priv, Shutdown_priv, Process_priv, File_priv, Grant_priv, References_priv, Index_priv, Alter_priv) VALUES('127.0.0.1','ftp',PASSWORD('tmppasswd'),'Y','Y','Y','Y','N','N','N','N','N','N','N','N','N','N');", $adminlink);
				//$errormsg += mysql_query("FLUSH PRIVILEGES;", $adminlink);

				$errormsg = "";
				$errormsg += mysql_query("ALTER TABLE ftpusers.users ADD Status enum('0','1') NOT NULL default '1';", $adminlink);
				//echo (mysql_error()."<br>\n");
				$errormsg += mysql_query("ALTER TABLE ftpusers.users ADD Ipaddress varchar(15) NOT NULL default '*';", $adminlink);
				//echo (mysql_error()."<br>\n");
				$errormsg += mysql_query("ALTER TABLE ftpusers.users ADD Comment tinytext;", $adminlink);
				//echo (mysql_error()."<br>\n");
				$errormsg += mysql_query("ALTER TABLE ftpusers.users ADD UNIQUE KEY User (User);", $adminlink);
				//echo (mysql_error()."<br>\n");

				// @mysql_select_db("");
				$table_users  = "SELECT User, Password, Uid, Gid, Dir, QuotaFiles, QuotaSize, ULBandwidth, DLBandwidth, Status, Ipaddress, Comment FROM ftpusers.users ORDER BY User ASC;";
				$query_users  = mysql_query($table_users);
				if (!$query_users)
				{
					echo ("<td><font color=\"red\">Failed!</font></td>\n");
					$up_to_date = 0;
				}
				else
				{
					echo ("<td><font color=\"green\">OK!</font></td>\n");
					$up_to_date = 1;
				}



				//echo ("<td><font color=\"green\">OK! $errormsg</font></td>\n");

				if($up_to_date == 0)
					echo ("<td><input type=\"submit\" name=\"connect\" value=\"Try again\"></td>\n");
				else
					echo ("<td>&nbsp</td>\n");

				echo ("</tr>\n");
				echo ("<tr><td colspan=\"3\">&nbsp;</td></tr>\n");
				echo ("<tr><td colspan=\"3\"><input type=\"submit\" name=\"ff\" value=\"Refresh\"></td></tr>\n");

				echo ("<tr>\n");
				echo ("<td><input type=\"submit\" name=\"step\" value=\"Step 2\"></td><td >&nbsp;</td>\n");
				if ($up_to_date == 1)
					echo ("<td align=\"right\"><input type=\"submit\" name=\"step\" value=\"Continue\"></td>");
				else
					echo ("<td>&nbsp;</td>");
				echo ("</tr>\n");
			}

		}else // $_SESSION['Step3'] == 'new'
		{

			echo ("<tr>\n");
			echo ("<td colspan=\"3\">Before the installation of the new database we need ");
			echo ("a MySQL user with enough privileges to create a new user, a database, and 2 tables. ");
			echo ("The attributes username and password will only be used for this goal and will <b>not</b> ");
			echo ("be saved or stored after this php session.</td>\n");
			echo ("</tr>\n");

			echo ("<tr><td colspan=\"3\">&nbsp;</td></tr>\n");

			echo ("<tr>\n");
			echo ("<td>Hostname</td>\n");
			echo ("<td><input type=\"text\" name=\"AdminHostname\" value=\"".$_SESSION['Admin_DBHost']."\" size=\"25\" maxlength=\"25\"></td>\n");
			echo ("<td><input type=\"button\" value=\"default\" onclick='document.configuration.AdminHostname.value=\"localhost\";'></td>\n");
			echo ("</tr>\n");

			echo ("<tr>\n");
			echo ("<td>Username</td>\n");
			echo ("<td><input type=\"text\" name=\"AdminLogin\" value=\"".$_SESSION['Admin_DBLogin']."\" size=\"25\" maxlength=\"25\"></td>\n");
			echo ("<td><input type=\"button\" value=\"default\" onclick='document.configuration.AdminLogin.value=\"root\";'></td>\n");
			echo ("</tr>\n");

			echo ("<tr>\n");
			echo ("<td>Password</td>\n");
			echo ("<td><input type=\"password\" name=\"AdminPassword\" value=\"".$_SESSION['Admin_DBPassword']."\" size=\"25\" maxlength=\"25\"></td>\n");
			echo ("<td><input type=\"button\" value=\"default\" onclick='document.configuration.AdminPassword.value=\"\";'></td>\n");
			echo ("</tr>\n");

			echo ("<tr><td colspan=\"3\">&nbsp;</td></tr>\n");

			echo ("<tr>\n");
			echo ("<td>Checking connection to MySQL server </td>\n");
				$adminlink = mysql_connect($_SESSION['Admin_DBHost'], $_SESSION['Admin_DBLogin'], $_SESSION['Admin_DBPassword']);
				if(!$adminlink)
				{
					echo ("<td><font color=\"red\">Failed!</font></td>\n");
					$error += 1;
				}
				else
				{
					echo ("<td><font color=\"green\">OK!</font></td>\n");
				}
			//echo ("</td\n");

			if ($error == 0)
				echo ("<td>&nbsp;</td>\n");
			else
				echo ("<td><input type=\"submit\" name=\"connect\" value=\"Connect\"></td>\n");

			echo ("</tr>\n");

			if ($error == 0)
			{
				$error_new_database = 0;

				echo ("<tr>\n");
				echo ("<td>Create user FTP</td>\n");
				$errormsg = mysql_query("INSERT INTO mysql.user (Host, User, Password, Select_priv, Insert_priv, Update_priv, Delete_priv, Create_priv, Drop_priv, Reload_priv, Shutdown_priv, Process_priv, File_priv, Grant_priv, References_priv, Index_priv, Alter_priv) VALUES('127.0.0.1','ftp',PASSWORD('tmppasswd'),'Y','Y','Y','Y','N','N','N','N','N','N','N','N','N','N');", $adminlink);
				$errormsg += mysql_query("FLUSH PRIVILEGES;", $adminlink);

				$query_users  = mysql_query("SELECT User FROM mysql.user WHERE User='ftp' AND Host='127.0.0.1';");
				if (!$query_users)
				{
					echo ("<td><font color=\"red\">Failed!</font></td>\n");
					$error_new_database += 1;
				}
				else
					echo ("<td><font color=\"green\">OK!</font></td>\n");

				echo ("<td>&nbsp</td>\n");
				echo ("</tr>\n");

				echo ("<tr>\n");
				echo ("<td>Create database ftpusers</td>\n");
				$errormsg = mysql_query("CREATE DATABASE ftpusers;", $adminlink);
				$errormsg += mysql_query("USE ftpusers;", $adminlink);


				if (!@mysql_select_db('ftpusers'))
				{
					$error_new_database += 1;
					echo ("<td><font color=\"red\">Failed!</font></td>\n");
				}
				else
					echo ("<td><font color=\"green\">OK!</font></td>\n");

				echo ("<td>&nbsp</td>\n");
				echo ("</tr>\n");

				echo ("<tr>\n");
				echo ("<td>Create table admin</td>\n");
				$errormsg = mysql_query("CREATE TABLE admin (Username varchar(35) NOT NULL default '',Password char(32) binary NOT NULL default '',PRIMARY KEY  (Username)) TYPE=MyISAM;", $adminlink);
				$errormsg += mysql_query("INSERT INTO admin VALUES ('Administrator',MD5('tmppasswd'));", $adminlink);
				$query_admin  = mysql_query("SELECT * FROM admin ORDER BY Username ASC");
				if (!$query_admin)
				{
					$error_new_database += 1;
					echo ("<td><font color=\"red\">Failed!</font></td>\n");
				}
				else
				{
					echo ("<td><font color=\"green\">OK!</font></td>\n");
				}
				echo ("<td>&nbsp</td>\n");
				echo ("</tr>\n");

				echo ("<tr>\n");
				echo ("<td>Create table users</td>\n");


				$errormsg = mysql_query("CREATE TABLE `users` (`User` varchar(16) NOT NULL default '',`Password` varchar(32) binary NOT NULL default '',PRIMARY KEY  (`User`), UNIQUE KEY `User` (`User`)) TYPE=MyISAM;", $adminlink);
				// $errormsg += mysql_query("INSERT INTO admin VALUES ('Administrator',MD5('tmppasswd'));", $adminlink);
				// $errormsg += mysql_query("ALTER TABLE ftpusers.users ADD Status enum('0','1') NOT NULL default '1';", $admin_link);
				$errormsg += mysql_query("ALTER TABLE ftpusers.users ADD `Uid` int(11) NOT NULL default '14';", $adminlink);
				$errormsg += mysql_query("ALTER TABLE ftpusers.users ADD `Gid` int(11) NOT NULL default '5';", $adminlink);
				$errormsg += mysql_query("ALTER TABLE ftpusers.users ADD `Dir` varchar(128) NOT NULL default '';", $adminlink);
				$errormsg += mysql_query("ALTER TABLE ftpusers.users ADD `QuotaFiles` int(10) NOT NULL default '500';", $adminlink);
				$errormsg += mysql_query("ALTER TABLE ftpusers.users ADD `QuotaSize` int(10) NOT NULL default '30';", $adminlink);
				$errormsg += mysql_query("ALTER TABLE ftpusers.users ADD `ULBandwidth` int(10) NOT NULL default '80';", $adminlink);
				$errormsg += mysql_query("ALTER TABLE ftpusers.users ADD `DLBandwidth` int(10) NOT NULL default '80';", $adminlink);
				$errormsg += mysql_query("ALTER TABLE ftpusers.users ADD `Ipaddress` varchar(15) NOT NULL default '*';", $adminlink);
				$errormsg += mysql_query("ALTER TABLE ftpusers.users ADD `Comment` tinytext;", $adminlink);
				$errormsg += mysql_query("ALTER TABLE ftpusers.users ADD `Status` enum('0','1') NOT NULL default '1';", $adminlink);
				$errormsg += mysql_query("ALTER TABLE ftpusers.users ADD `ULRatio` smallint(5) NOT NULL default '1';", $adminlink);
				$errormsg += mysql_query("ALTER TABLE ftpusers.users ADD `DLRatio` smallint(5) NOT NULL default '1';", $adminlink);
				$errormsg += mysql_query("INSERT INTO ftpusers.users VALUES ('ftpuser_1',MD5('tmppasswd'),65534, 31, '/usr', 100, 50, 75, 75, '*', 'Ftp user (for example)', '1', 0, 0);", $adminlink);

				$query_users  = mysql_query("SELECT * FROM users ORDER BY User ASC");
				if (!$query_users)
				{
					$error_new_database += 1;
					echo ("<td><font color=\"red\">Failed!</font></td>\n");

				}
				else
				{
					echo ("<td><font color=\"green\">OK!</font></td>\n");
				}

				echo ("<td>&nbsp</td>\n");
				echo ("</tr>\n");

		}
			echo ("<tr><td colspan=\"3\">&nbsp;</td></tr>\n");
			//echo ("<tr><td colspan=\"3\"><input type=\"submit\" name=\"none\" value=\"Try again\"></td></tr>\n");

			echo ("<tr>\n");
			echo ("<td><input type=\"submit\" name=\"step\" value=\"Step 2\"></td><td >&nbsp;</td>\n");
			if ($error_new_database == 0)
				echo ("<td align=\"right\"><input type=\"submit\" name=\"step\" value=\"Continue\"></td>");
			else
				echo ("<td align=\"right\"><input type=\"submit\" name=\"none\" value=\"Try again\"></td>");
			echo ("</tr>\n");


		}

	}else if ($_SESSION['Step'] == '4')
	{

		echo ("<tr>\n");
		echo ("<td width=\"60%\">&nbsp;</td>\n");
		echo ("<td width=\"30%\">&nbsp;</td>\n");
		echo ("<td width=\"10%\">&nbsp;</td>\n");
		echo ("</tr>\n");


		echo ("<tr>\n");
		echo ("<td colspan=\"3\">Here you can change the configuration of the ‘User manager for PureFTPd’.<br>");
		echo ("This attributes will be stored in the <b>config.php</b> file.</td>\n");
		echo ("</tr>\n");

		echo ("<tr><td colspan=\"3\">&nbsp;</td></tr>\n");

		echo ("<tr>\n");
		echo ("<td>Hostname</td>\n");
		echo ("<td><input type=\"text\" name=\"Hostname\" value=\"".$_SESSION['LocalValue_DBHost']."\" size=\"25\" maxlength=\"25\"></td>\n");
		echo ("<td><input type=\"button\" value=\"default\" onclick='document.configuration.Hostname.value=\"127.0.0.1\";'></td>\n");
		echo ("</tr>\n");

		echo ("<tr>\n");
		echo ("<td>Login</td>\n");
		echo ("<td><input type=\"text\" name=\"Login\" value=\"".$_SESSION['LocalValue_DBLogin']."\" size=\"25\" maxlength=\"25\"></td>\n");
		echo ("<td><input type=\"button\" value=\"default\" onclick='document.configuration.Login.value=\"ftp\";'></td>\n");
		echo ("</tr>\n");

		echo ("<tr>\n");
		echo ("<td>Password</td>\n");
		echo ("<td><input type=\"text\" name=\"Password\" value=\"".$_SESSION['LocalValue_DBPassword']."\" size=\"25\" maxlength=\"25\"></td>\n");
		echo ("<td><input type=\"button\" value=\"default\" onclick='document.configuration.Password.value=\"tmppasswd\";'></td>\n");
		echo ("</tr>\n");

		echo ("<tr>\n");
		echo ("<td>Database</td>\n");
		echo ("<td><input type=\"text\" name=\"Database\" value=\"".$_SESSION['LocalValue_DBDatabase']."\" size=\"25\" maxlength=\"25\"></td>\n");
		echo ("<td><input type=\"button\" value=\"default\" onclick='document.configuration.Database.value=\"ftpusers\";'></td>\n");
		echo ("</tr>\n");

		echo ("<tr><td colspan=\"3\">&nbsp;</td></tr>\n");

		echo ("<tr>\n");
		echo ("<td>Language</td>\n");
		echo ("<td>");
		echo ("<select name=\"language\">\n");
		$Directory = "language";
		if(($Dir = @dir($Directory)) == false)
			echo ("<font color='blue'>Warning:</font> Can't open directory $Directory<br>\n");


		while ($Filename = $Dir->read()) {

			if ($Filename[strlen($Filename) - 4] == '.' &&
				$Filename[strlen($Filename) - 3] == 'p' &&
				$Filename[strlen($Filename) - 2] == 'h' &&
				$Filename[strlen($Filename) - 1] == 'p' &&
				$Filename != "index.php")
			{
				// $Filename[strlen($Filename) - 4] = _;
				$Filename = substr($Filename,0,-4); // remove '.php'
				$Filename = ucfirst($Filename); // Upper case first charakter
				if ($LANG == $Filename)
					echo ("<option value=\"$Filename\" selected=\"selected\">$Filename</option>\n");
				else
					echo ("<option value=\"$Filename\">$Filename</option>\n");
			}
		}
		echo ("</select>\n");
		echo ("</td>\n");
		echo ("<td><input type=\"button\" value=\"default\" onclick='document.configuration.language.value=\"English\";'></td>\n");
		echo ("</tr>\n");


		echo ("<tr>\n");
		echo ("<td>FTP Address</td>\n");
		echo ("<td><input type=\"text\" name=\"ftp_address\" value=\"$FTPAddress\" size=\"25\" maxlength=\"25\"></td>\n");
		echo ("<td><input type=\"button\" value=\"default\" onclick='document.configuration.ftp_address.value=\"myipaddress.com:21\";'></td>\n");
		echo ("</tr>\n");


		echo ("<tr>\n");
		echo ("<td>Image location</td>\n");
		echo ("<td><input type=\"text\" name=\"image_location\" value=\"$LocationImages\" size=\"25\" maxlength=\"25\"></td>\n");
		echo ("<td><input type=\"button\" value=\"default\" onclick='document.configuration.image_location.value=\"images\";'></td>\n");
		echo ("</tr>\n");

		echo ("<tr>\n");
		echo ("<td>Default user ID</td>\n");
		echo ("<td><input type=\"text\" name=\"default_user_id\" value=\"$DEFUserID\" size=\"5\" maxlength=\"7\"></td>\n");
		echo ("<td><input type=\"button\" value=\"default\" onclick='document.configuration.default_user_id.value=\"65534\";'></td>\n");
		echo ("</tr>\n");

		echo ("<tr>\n");
		echo ("<td>Default group ID</td>\n");
		echo ("<td><input type=\"text\" name=\"default_group_id\" value=\"$DEFGroupID\" size=\"5\" maxlength=\"7\"></td>\n");
		echo ("<td><input type=\"button\" value=\"default\" onclick='document.configuration.default_group_id.value=\"31\";'></td>\n");
		echo ("</tr>\n");

		echo ("<tr>\n");
		echo ("<td>Location of passwd file</td>\n");
		echo ("<td><input type=\"text\" name=\"location_passwd\" value=\"$UsersFile\" size=\"25\" maxlength=\"25\"></td>\n");
		echo ("<td><input type=\"button\" value=\"default\" onclick='document.configuration.location_passwd.value=\"/etc/passwd\";'></td>\n");
		echo ("</tr>\n");

		echo ("<tr>\n");
		echo ("<td>Location of group file</td>\n");
		echo ("<td><input type=\"text\" name=\"location_groupfile\" value=\"$GroupFile\" size=\"25\" maxlength=\"25\"></td>\n");
		echo ("<td><input type=\"button\" value=\"default\" onclick='document.configuration.location_groupfile.value=\"/etc/group\";'></td>\n");
		echo ("</tr>\n");


		echo ("<tr>\n");
		echo ("<td>StyleSheet</td>\n");
		echo ("<td>");
		echo ("<select name=\"stylesheet\">\n");
		$Directory = "style";
		if(($Dir = @dir($Directory)) == false)
			echo ("<font color='blue'>Warning:</font> Can't open directory $Directory<br>\n");


		while ($Filename = $Dir->read()) {

			if ($Filename[strlen($Filename) - 4] == '.' &&
				$Filename[strlen($Filename) - 3] == 'p' &&
				$Filename[strlen($Filename) - 2] == 'h' &&
				$Filename[strlen($Filename) - 1] == 'p' &&
				$Filename != "index.php")
			{
				// $Filename[strlen($Filename) - 4] = _;
				$Label = substr($Filename,0,-4); // remove '.php'
				$Label = ucfirst($Label); // Upper case first charakter
				$Filename = "style/$Filename";

				if ($StyleSheet == $Filename)
					echo ("<option value=\"$Filename\" selected=\"selected\">$Label</option>\n");
				else
					echo ("<option value=\"$Filename\">$Label</option>\n");
			}
		}
		echo ("</select>\n");
		echo ("</td>\n");
		echo ("<td><input type=\"button\" value=\"default\" onclick='document.configuration.stylesheet.value=\"style/default.css.php\";'></td>\n");
		echo ("</tr>\n");

		echo ("<tr>\n");
		echo ("<td>Quota support</td>\n");
		if ($EnableQuota == 0)
			echo ("<td><input type=\"checkbox\" name=\"quota_support\" value=\"checkbox\"></td>\n");
		else
			echo ("<td><input type=\"checkbox\" name=\"quota_support\" value=\"checkbox\" checked></td>\n");
		echo ("<td><input type=\"button\" value=\"default\" onclick='document.configuration.quota_support.checked=false;'></td>\n");
		echo ("</tr>\n");

		echo ("<tr>\n");
		echo ("<td>Ratio support</td>\n");
		if ($EnableRatio == 0)
			echo ("<td><input type=\"checkbox\" name=\"ratio_support\" value=\"checkbox\"></td>\n");
		else
			echo ("<td><input type=\"checkbox\" name=\"ratio_support\" value=\"checkbox\" checked></td>\n");
		echo ("<td><input type=\"button\" value=\"default\" onclick='document.configuration.ratio_support.checked=false;'></td>\n");
		echo ("</tr>\n");

		echo ("<tr><td colspan=\"3\">&nbsp;</td></tr>\n");

		echo ("<tr>\n");
		echo ("<td>Save this configuration in config.php</td>");
		echo ("<td><input type=\"submit\" name=\"save\" value=\"Save\"></td>");
		echo ("<td>&nbsp;</td>");
		echo ("</tr>\n");

		echo ("<tr><td colspan=\"3\">&nbsp;</td></tr>\n");

		echo ("<tr>\n");
		echo ("<td><input type=\"submit\" name=\"step\" value=\"Step 3\"></td>\n");
		echo ("<td>&nbsp</td>\n");
		echo ("<td align=\"right\"><input type=\"submit\" name=\"step\" value=\"Step 5\"></td>");
		echo ("</tr>\n");


	}else if ($_SESSION['Step'] == '5')
	{
		echo ("<tr>\n");
		echo ("<td width=\"35%\">&nbsp;</td>\n");
		echo ("<td width=\"35%\">&nbsp;</td>\n");
		echo ("<td width=\"30%\">&nbsp;</td>\n");
		echo ("</tr>\n");


		// echo ("<tr><td colspan=\"3\">&nbsp;</td></tr>\n");
		echo ("<tr>\n");
		echo ("<td colspan=\"3\">For security reasons a user must first has been authorized \n");
		echo ("before he can start creating FTP accounts with the &acute;User \n");
		echo ("manager for PureFTPd&acute;. <br> Therefore a user must select a username and \n");
		echo ("fill in a valid password. \n");
		echo ("<p>Here you can make or change, at least one, username and password \n");
		echo ("for the &acute;User manager for PureFTPd&acute; authorization. There is only \n");
		// echo ("one security level, you are authorized or not, so when you creating \n");
		echo ("one security level, so when you creating \n");
		echo ("more than one user there is no differences, except the password, \n");
		echo ("between them.</p>\n");
		echo ("</td>\n");
		echo ("</tr>\n");
		echo ("<tr><td colspan=\"3\">&nbsp;</td></tr>\n");
		// echo ("<tr><td colspan=\"2\">Username: ");
		echo ("<tr><td>Username: ");
		echo ("<input type=\"text\" name=\"admin\" value=\"Administrator\">\n");
		echo ("<script>\n");
		echo ("document.configuration.admin.disabled=\"true\";\n");
		echo ("</script>\n");
		echo ("</td><td> Password:");
		// echo (" Password:");
		echo ("<input type=\"password\" name=\"admin_password\" value=\"aaaaaa\">\n");
        echo ("</td><td align=\"left\">");
        echo ("<input type=\"submit\" name=\"admin_change\" value=\"Change\">");
		echo ("</td></tr>\n");

		$link = mysql_connect("$DBHost", "$DBLogin", "$DBPassword");
		if(!$link)
			die("<br>Error: MySql server not found.<br><br>MySql error : ".mysql_error());

		if (!@mysql_select_db("$DBDatabase"))
			die("<br>Error: Database 'ftpusers' doesn't exist.<br><br>MySql error : ".mysql_error());

		$table_users  = "SELECT * FROM admin ORDER BY Username ASC";
		$query_users  = mysql_query($table_users);
		if (!$query_users)
			die("<br>Error: Table 'admin' from database 'ftpusers' doesn't exist.<br><br>MySql error : ".mysql_error());

		$length_users = mysql_num_rows($query_users);
		//if ($length_users == 0)
		//	die ("<br>Error: Table 'admin' from database 'ftpusers' is empty, can't continue.");

		// $iCounter=1 = Skip first user 'Administrator'




		// echo ("<input type=\"text\" name=\"admin_id\" value=\"0\">");
		echo ("<input type=\"hidden\" name=\"admin_id\" value=\"ff\">");

		for ($iCounter=1;$iCounter<$length_users;$iCounter++)
		{
			$user     = mysql_result($query_users,$iCounter,"Username");
			// echo ("user = $user<br>\n");

			if ($user != "Administrator")
			{
				//echo ("<tr><td colspan=\"3\">&nbsp;</td></tr>\n");
				echo ("<tr><td>Username: ");
				echo ("<input type=\"text\" name=\"admin2_".$user."_name\" value=\"$user\">\n");
				echo ("</td><td> Password:");
				// echo (" Password:");
				echo ("<input type=\"password\" name=\"admin2_".$user."_password\" value=\"aaaaaa\">\n");
			    echo ("</td><td align=\"left\">");
			    echo ("<input type=\"submit\" onclick='document.configuration.admin_id.value=\"$user\";' name=\"admin2_change\" value=\"Change\"> &nbsp;");
			    echo ("<input type=\"submit\" onclick='document.configuration.admin_id.value=\"$user\";' name=\"admin2_delete\" value=\"Delete\"> &nbsp;");
				echo ("</td></tr>\n");
			}
		}

		echo ("<tr><td>Username: ");
		echo ("<input type=\"text\" name=\"admin3\" value=\"\">\n");
		echo ("</td><td> Password:");
		// echo (" Password:");
		echo ("<input type=\"password\" name=\"admin3_password\" value=\"\">\n");
		echo ("</td><td align=\"left\">");
		echo ("<input type=\"submit\" name=\"admin3_add\" value=\"Add\">");
		echo ("</td></tr>\n");
		echo ("<tr><td colspan=\"3\">&nbsp;</td></tr>\n");

		echo ("<tr>\n");
		echo ("<td><input type=\"submit\" name=\"step\" value=\"Step 4\"></td>\n");
		echo ("<td>&nbsp</td>\n");
		echo ("<td align=\"right\"><input type=\"submit\" name=\"step\" value=\"Step 6\"></td>");
		echo ("</tr>\n");
	}else if ($_SESSION['Step'] == '6')
	{
		echo ("<tr>\n");
		echo ("<td width=\"10%\">&nbsp;</td>\n");
		echo ("<td width=\"40%\">&nbsp;</td>\n");
		echo ("<td width=\"40%\">&nbsp;</td>\n");
		echo ("</tr>\n");


		echo ("<tr>\n");
		echo ("<td colspan=\"3\">\n");
		echo ("<p>The configuration of the 'User manager for PureFTPd' is completed.\n");
		echo ("Before you can use this user manager in conjunction with the FTP\n");
		echo ("server you must configure PureFTPd. For this goal you have to\n");
		echo ("change two configuration files of PureFTPd.</p>\n");
		echo ("<p>The first one is <b>pure-ftpd.conf</b>, this file contains the\n");
		echo ("main configuration of the FTP server for example: Maximum number\n");
		echo ("of clients or the location of the LOG files.</p>\n");
		echo ("<p>The second one called <b>pureftpd-mysql.conf</b> tells the PureFTPd\n");
		echo ("server how to handle the database. </p>\n");
		echo ("<p>The location of both files is depending on your operation system,\n");
		echo ("for FreeBSD for example this is '/usr/local/etc/'. When you can't \n");
		echo ("find those files you probably still have to copy the two example \n");
		echo ("files of PureFTPd called: <b>pure-ftpd.conf.sample</b> and <b>pureftpd-mysql.conf.sample</b>.\n");
		echo ("In this step we will tell you how configure those two files so\n");
		echo ("that the PureFTPd server and this user manager can work together\n");
		echo ("with the same database.<br>\n");
		echo ("</p>\n");
		echo ("</td></tr>\n");

		echo ("<tr><td colspan=\"3\">&nbsp;</td></tr>\n");
		echo ("<tr><td colspan=\"3\">Step A)</td></tr>\n");
		echo ("<tr><td>&nbsp;</td>");
		echo ("<td colspan=\"2\">\n");
		echo ("Edit the configuration file <b>pure-ftpd.conf</b>\n");
		echo ("and make sure that following line with the attribute 'MySQLConfigFile'\n");
		echo ("is enabled and points to the right location.\n");
		echo ("<pre># MySQL configuration file (see README.MySQL)\n");
		echo ("MySQLConfigFile /usr/local/etc/pureftpd-mysql.conf</pre>");
		echo ("</td></tr>");

		echo ("<tr><td colspan=\"3\">Step B)</td></tr>\n");
		echo ("<tr><td>&nbsp;</td>");
		echo ("<td colspan=\"2\">\n");
		echo ("The entire content for the file <b>pureftpd-mysql.conf</b> \n");
		echo ("you can find below, just copy and past the content to a new pureftpd-mysql.conf\n");
		echo ("file. The red color text marks the changes that are made based on\n");
		echo ("the values you choused in step 4 of this configuration process.<br><br>\n");
		echo ("</td></tr>");

		echo ("<tr><td>&nbsp;</td>");
		echo ("<td colspan=\"2\" bgcolor=\"#CCCCCC\">\n");

		echo ("<pre>\n");

		echo ("############################################################################\n");
		echo ("#                                                                          #\n");
		echo ("# PureFTPd MySQL configuration file.                                       #\n");
		echo ("# Generated by the installation wizard for the 'User manager for PureFTPd' #\n");
		echo ("# See http://machiel.generaal.net for more info                            #\n");
		echo ("# or read the README.MySQL for explanations of the syntax.                 #\n");
		echo ("#                                                                          #\n");
		echo ("############################################################################\n");
		echo ("\n");
		echo ("# Optional : MySQL server name or IP. Don't define this for unix sockets.\n");
		echo ("\n");
		echo ("MYSQLServer     <font color=\"red\">$DBHost</font>\n");
		echo ("\n");

		echo ("# Optional : MySQL port. Don't define this if a local unix socket is used.\n");
		echo ("\n");
		echo ("# MYSQLPort       3306\n");
		echo ("\n");
		echo ("\n");
		echo ("# Optional : define the location of mysql.sock if the server runs on this host.\n");
		echo ("\n");
		echo ("MYSQLSocket     /tmp/mysql.sock\n");
		echo ("\n");
		echo ("\n");
		echo ("# Mandatory : user to bind the server as.\n");
		echo ("\n");
		echo ("MYSQLUser      <font color=\"red\">$DBLogin</font>\n");
		echo ("\n");
		echo ("\n");
		echo ("# Mandatory : user password. You must have a password.\n");
		echo ("\n");
		echo ("MYSQLPassword   <font color=\"red\">$DBPassword</font>\n");
		echo ("\n");
		echo ("\n");
		echo ("# Mandatory : database to open.\n");
		echo ("\n");
		echo ("MYSQLDatabase  <font color=\"red\">$DBDatabase</font>\n");
		echo ("\n");
		echo ("\n");
		echo ("# Mandatory : how passwords are stored\n");
		echo ("# Valid values are : \"cleartext\", \"crypt\", \"md5\" and \"password\"\n");
		echo ("# (\"password\" = MySQL password() function)\n");
		echo ("# You can also use \"any\" to try \"crypt\", \"md5\" *and* \"password\"\n");
		echo ("\n");
		echo ("MYSQLCrypt      <font color=\"red\">md5</font>\n");
		echo ("\n");
		echo ("\n");
		echo ("# In the following directives, parts of the strings are replaced at\n");
		echo ("# run-time before performing queries :\n");
		echo ("#\n");
		echo ("# \L is replaced by the login of the user trying to authenticate.\n");
		echo ("# \I is replaced by the IP address the user connected to.\n");
		echo ("# \P is replaced by the port number the user connected to.\n");
		echo ("# \R is replaced by the IP address the user connected from.\n");
		echo ("# \D is replaced by the remote IP address, as a long decimal number.\n");
		echo ("#\n");
		echo ("# Very complex queries can be performed using these substitution strings,\n");
		echo ("# especially for virtual hosting.\n");
		echo ("\n");
		echo ("\n");
		echo ("# Query to execute in order to fetch the password\n");
		echo ("\n");
		echo ("<font color=\"red\">MYSQLGetPW      SELECT Password FROM users WHERE User=\"\\L\" AND Status=\"1\" AND (Ipaddress = \"*\" OR Ipaddress LIKE \"\\R\")</font>\n");
		echo ("\n");
		echo ("\n");
		echo ("# Query to execute in order to fetch the system user name or uid\n");
		echo ("\n");
		echo ("<font color=\"red\">MYSQLGetUID     SELECT Uid FROM users WHERE User=\"\\L\" AND Status=\"1\" AND (Ipaddress = \"*\" OR Ipaddress LIKE \"\\R\")</font>\n");
		echo ("\n");
		echo ("\n");
		echo ("# Optional : default UID - if set this overrides MYSQLGetUID\n");
		echo ("\n");
		echo ("#MYSQLDefaultUID 1000\n");
		echo ("\n");
		echo ("\n");
		echo ("# Query to execute in order to fetch the system user group or gid\n");
		echo ("\n");
		echo ("<font color=\"red\">MYSQLGetGID     SELECT Gid FROM users WHERE User=\"\\L\" AND Status=\"1\" AND (Ipaddress = \"*\" OR Ipaddress LIKE \"\\R\")</font>\n");
		echo ("\n");
		echo ("# Optional : default GID - if set this overrides MYSQLGetGID\n");
		echo ("\n");
		echo ("#MYSQLDefaultGID 1000\n");
		echo ("\n");
		echo ("\n");
		echo ("# Query to execute in order to fetch the home directory\n");
		echo ("\n");
		echo ("<font color=\"red\">MYSQLGetDir     SELECT Dir FROM users WHERE User=\"\\L\" AND Status=\"1\" AND (Ipaddress = \"*\" OR Ipaddress LIKE \"\\R\")</font>\n");
		echo ("\n");
		echo ("# Optional : query to get the maximal number of files\n");
		echo ("# Pure-FTPd must have been compiled with virtual quotas support.\n");
		echo ("\n");

		if ($EnableQuota == 1)
			echo ("<font color=\"red\">MySQLGetQTAFS  SELECT QuotaFiles FROM users WHERE User=\"\\L\" AND Status=\"1\" AND (Ipaddress = \"*\" OR Ipaddress LIKE \"\\R\")</font>\n");
		else
			echo ("# MySQLGetQTAFS  SELECT QuotaFiles FROM users WHERE User=\"\\L\"\n");

		echo ("\n");
		echo ("# Optional : query to get the maximal disk usage (virtual quotas)\n");
		echo ("# The number should be in Megabytes.\n");
		echo ("# Pure-FTPd must have been compiled with virtual quotas support.\n");
		echo ("\n");

		if ($EnableQuota == 1)
			echo ("<font color=\"red\">MySQLGetQTASZ  SELECT QuotaSize FROM users WHERE User=\"\\L\" AND Status=\"1\" AND (Ipaddress = \"*\" OR Ipaddress LIKE \"\\R\")</font>\n");
		else
			echo ("# MySQLGetQTASZ  SELECT QuotaSize FROM users WHERE User=\"\\L\"\n");

		echo ("\n");
		echo ("\n");
		echo ("# Optional : ratios. The server has to be compiled with ratio support.\n");
		echo ("\n");
		if ($EnableRatio == 1)
		{
			echo ("<font color=\"red\">MySQLGetRatioUL SELECT ULRatio FROM users WHERE User=\"\\L\" AND Status=\"1\" AND (Ipaddress = \"*\" OR Ipaddress LIKE \"\\R\")</font>\n");
			echo ("<font color=\"red\">MySQLGetRatioDL SELECT DLRatio FROM users WHERE User=\"\\L\" AND Status=\"1\" AND (Ipaddress = \"*\" OR Ipaddress LIKE \"\\R\")</font>\n");
		}else
		{
			echo ("# MySQLGetRatioUL SELECT ULRatio FROM users WHERE User=\"\\L\"\n");
			echo ("# MySQLGetRatioDL SELECT DLRatio FROM users WHERE User=\"\\L\"\n");
		}
		echo ("\n");
		echo ("\n");
		echo ("# Optional : bandwidth throttling.\n");
		echo ("# The server has to be compiled with throttling support.\n");
		echo ("# Values are in KB/s .\n");
		echo ("\n");
		// echo ("# MySQLGetBandwidthUL SELECT ULBandwidth FROM users WHERE User=\"\\L\"\n");
		// echo ("# MySQLGetBandwidthDL SELECT DLBandwidth FROM users WHERE User=\"\\L\"\n");
		echo ("<font color=\"red\">MySQLGetBandwidthUL SELECT ULBandwidth FROM users WHERE User=\"\\L\" AND Status=\"1\" AND (Ipaddress = \"*\" OR Ipaddress LIKE \"\\R\")</font>\n");
		echo ("<font color=\"red\">MySQLGetBandwidthDL SELECT DLBandwidth FROM users WHERE User=\"\\L\" AND Status=\"1\" AND (Ipaddress = \"*\" OR Ipaddress LIKE \"\\R\")</font>\n");
		echo ("\n");
		echo ("# Enable ~ expansion. NEVER ENABLE THIS BLINDLY UNLESS :\n");
		echo ("# 1) You know what you are doing.\n");
		echo ("# 2) Real and virtual users match.\n");
		echo ("\n");
		echo ("# MySQLForceTildeExpansion 1\n");
		echo ("\n");
		echo ("\n");
		echo ("# If you upgraded your tables to transactionnal tables (Gemini,\n");
		echo ("# BerkeleyDB, Innobase...), you can enable SQL transactions to\n");
		echo ("# avoid races. Leave this commented if you are using the\n");
		echo ("# traditionnal MyIsam databases or old (< 3.23.x) MySQL versions.\n");
		echo ("\n");
		echo ("# MySQLTransactions On\n");
		echo ("</pre>");
		echo ("</td></tr>");


		echo ("<tr><td colspan=\"3\">Step C)</td></tr>\n");
		echo ("<tr><td>&nbsp;</td>");
		echo ("<td colspan=\"2\">\n");
		echo ("Start or restart your FTP server to activate those changes.\n");
		echo ("</td></tr>");



		echo ("<tr><td colspan=\"3\">&nbsp;</td></tr>\n");
		echo ("<tr>\n");
		echo ("<td><input type=\"submit\" name=\"step\" value=\"Step 5\"></td>\n");
		echo ("<td>&nbsp</td>\n");
		echo ("<td align=\"right\"><input type=\"submit\" name=\"step\" value=\"Step 7\"></td>");
		echo ("</tr>\n");
	}else if ($_SESSION['Step'] == '7')
	{
		echo ("<tr>\n");
		echo ("<td width=\"60%\">&nbsp;</td>\n");
		echo ("<td width=\"30%\">&nbsp;</td>\n");
		echo ("<td width=\"10%\">&nbsp;</td>\n");
		echo ("</tr>\n");


		echo ("<tr><td colspan=\"3\">&nbsp;</td></tr>\n");
		echo ("<tr><td colspan=\"3\" align=\"center\">Congratulations, the\n");
		echo ("configuration of the 'User manager for PureFTPd' is finished.\n");
		echo ("<br><br>\n");
		echo ("Because this configuration doesn't need any authorization anyone\n");
		echo ("could use it without any permission. Therefore it's better that\n");
		echo ("you store this file on a save location, another good solution\n");
		echo ("is to rename the extension from php to txt.\n");
		echo ("<br><br>\n");
		echo ("</td></tr>\n");


		echo ("<tr>\n");
		echo ("<td><input type=\"submit\" name=\"step\" value=\"Step 6\"></td>\n");
		echo ("<td>&nbsp</td>\n");
		echo ("<td>&nbsp</td>\n");
		echo ("</tr>\n");
	}



	echo ("</table>\n");
	echo ("</td>\n");
	echo ("</tr>\n");
	echo ("<tr style=\"BACKGROUND: url(".$_SERVER[PHP_SELF]."?image=bluebar.gif) #fff repeat-x 50% top\">\n");
	echo ("<td colspan=\"2\" style=\"BORDER-TOP: #003399 1px solid; BORDER-BOTTOM: #003399 1px solid;\">&nbsp;</td>\n");
	echo ("</tr>\n");
	echo ("</table>\n");

	echo ("</form>\n");
	echo ("</body>\n");
	echo ("</html>\n");

?>
