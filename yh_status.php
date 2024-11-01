<?php
error_reporting(0);
/*
Plugin Name: Yahoo! Status Checker
Plugin URI: http://techya.wordpress.com/yahoo-status-checker/
Description: Yahoo! Status Checker by Techya.Check any yahoo id to see if he is online or not.Once you activated plugin,go to widget & drag the Yahoo Status widget on your sidebar.
Author: Techya
Version: 1.0
Author URI: http://techya.wordpress.com/
*/
function yh_status() 
{
if (isset($_POST['yh_submit']))
{
$yid = $_POST['yid'];
$yid=explode("@",$yid);
$status = file_get_contents("http://mail.opi.yahoo.com/online?u=$yid[0]&m=a&t=1");
if ( $status === false )
{
   echo "<font color='red'>Connection failed?</font><br>";
}
elseif ($status == 00)
{
echo "<font color='red'>Offline?</font><br>";
}
elseif ($status == 01)
{
echo "<font color='green'>Online!</font></br>";
}
else
{
echo "There is some issue.<br>";
}
}
  echo "<br><form action='' method='post'>
<input type='text' name='yid' placeholder='Yahoo ID'>
<input type='submit' name='yh_submit' value='Check Status'>
</form><br>";
}
 
function yh_status_init()
{
  register_sidebar_widget(__('Yahoo! Status Checker'), 'yh_status');     
}

function yh_footer() {
	$yh_footer = "<p align='center'>Yahoo! Status Checker by <a href='http://techya.wordpress.com/' target='_blank'>Techya</a></p>";
	echo $yh_footer;
}
add_action("plugins_loaded", "yh_status_init");
add_action("wp_footer",yh_footer);
?>