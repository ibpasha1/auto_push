
<?php

// Read JSON file
$json = file_get_contents('fubar.json');

//Decode JSON
$json_data = json_decode($json,true);

//Traverse array and get the data for students aged less than 20
foreach ($json_data as $key1 => $value1) {
	if($json_data[$key1]["id"] < 20){
		print_r($json_data[$key1]);
		}
}
?>



