<?php 

$set_date = "2017/11/22";
$set_time = "02:34";
echo date("Y/m/d");
echo "</br>";
echo date("h:i");
echo "</br>";
if ($set_time == date("h:i"))
{
    echo "True";
} else {
    echo "False";
}




?>