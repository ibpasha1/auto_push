<?php
//$time = $GLOBALS['time'];
header("refresh: 1;");
$set_date = "2017/11/22";
$set_time = "02:51";
echo date("Y/m/d");
echo "</br>";
echo date("h:i");
echo "</br>";
if ($set_time == date("h:i"))
{
    echo "True";
    //-------------------------------------------------------------------------
    function jsonToCSV($jfilename, $cfilename)
    {
        if (($json = file_get_contents($jfilename)) == false)
            die('Error reading json file...');
        $array = json_decode($json, true);
        $fp = fopen($cfilename, 'w');
        $header = false;
        foreach ($array['data'] as $row)
        {
        echo $row['id'];
            if (empty($header))
            {
                $header = array_keys($row);
                fputcsv($fp, $header);
                $header = array_flip($header);
            }
            fputcsv($fp, array_merge($header, $row));
        }
        fclose($fp);
        return;
    }
    
    $json_filename = 'fubar.json';
    $csv_filename  = 'data.csv';
    
    jsonToCSV($json_filename, $csv_filename);
    echo  $csv_filename;


    //-------------------------------------------------------------------------
} else {
    echo "False";
}

?>