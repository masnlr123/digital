<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "haroon";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$list = array(
	'task',
	'timer',
	'saved_creative_reports',
	'media',
	'analytics',
	'creative_reports',
	'activities',
	'activity_types',
	'ad_campaigns',
	'attendances',
	'campaigns',
	'creative_images',
	'creatives',
	'lead_audits',
	'leads_agr',
	'leads_hg',
	'leads_hyd',
	'leads_jr',
	'leads_bp',
	'leads_os',
	'leads_siruseri',
	'leads_tsai',
	'leads_vib',
	'leads_bpc',
	'milestone',
	'projects',
	'sources',
	'sub_tasks',
	'users',
	'utm',
);
?>
<?php
print_r($list);
?>
<form action="" method="post">
	<input type="text" name="strg">
	<input type="submit" name="test" value="test...">
</form>
<?php
if(isset($_POST['test'])){
	$sql = "DROP TABLE ".$_POST['strg'];
	if ($conn->query($sql) === TRUE) {
	  echo "Record deleted successfully";
	} else{
	  echo "Error deleting record: " . $conn->error;
	}
}
$conn->close();
?>