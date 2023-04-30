<?php
	//include 'error_display.php';
	function connect()
	{
		// Connects to the Database 
		mysql_connect("127.0.0.1", "cs6324spring23", "8mwni8URcsr08bCxx", false, 65536) or die(mysql_error());
		mysql_select_db("cs6324spring23") or die(mysql_error());
	}
?>
