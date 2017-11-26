<?php
function jsonToCSV($jfilename, $cfilename)
{
    if (($json = file_get_contents($jfilename)) == false)
        die('Error reading json file...');
    $array = json_decode($json, true);
    $fp = fopen($cfilename, 'w');
    $header = false;
    foreach ($array["data"] as $row)
    {
        echo $row['id'];
        echo "</br>";
        echo $row['name'];
        echo "</br>";
        echo $row['sku'];

        $id              = $row['id'];
        $title           = $row['name'];
        $description     = $row['description'];
        $availability    = $row['availability'];
        $condition       = $row['condition'];
        $price           = $row['price'];
        $link            = $row['layout_file'];
        $image_link      = $row['layout_file'];
        $brand           = $row['brand_id'];
        $layout_file     = $row['layout_file'];
        $age_group       = $row['search_keywords'];
        $color           = $row['search_keywords'];
        $gender          = $row['search_keywords'];
        $item_group_id   = $row['search_keywords'];
        $google_product_category = $row['search_keywords'];
        $material        = $row['search_keywords'];
        $pattern         = $row['search_keywords'];
        $product_type    = $row['search_keywords'];
        $sale_price      = $row['sale_price'];
        $sale_price_effective_date = $row['date_created'];
        $shipping        = $row['is_free_shipping'];
        $shipping_weight = $row['weight'];
        $custom_label_0  = $row['search_keywords'];
        $custom_label_1  = $row['search_keywords'];
        $custom_label_2  = $row['search_keywords'];
        $custom_label_3  = $row['search_keywords'];
        $custom_label_4  = $row['search_keywords'];

        //$sku  = $row['sku'];


        $contents = array("id"=>"$id","title"=>$title,"description"=>$description
        ,"availability"=>$availability,"condition"=>$condition,"price"=>$price
        ,"link"=>$layout_file,"image_link"=>$layout_file,"brand"=>$brand,"brand"=>$brand
        ,"additional_image_link"=>$layout_file, "age_group"=>$age_group, "color"=>$color
        ,"gender"=>$gender , "item_group_id"=>$item_group_id
        ,"google_product_category"=>$google_product_category,  "material"=>$material
        ,"pattern"=>$pattern, "product_type"=>$product_type, "sale_price"=>$sale_price, "sale_price_effective_date"=>$sale_price_effective_date
        , "shipping"=>$shipping, "shipping_weight"=>$shipping_weight, "custom_label_0"=>$custom_label_0, "custom_label_1"=>$custom_label_1, "custom_label_2"=>$custom_label_2, "custom_label_3"=>$custom_label_3, "custom_label_4"=>$custom_label_4 );
        //echo $row['id'];
        //echo $row['name']; 
        if (empty($header))
        {
            //search_keywords == idk what to put in its place.....
            $header = array("id"=>"id", "title"=>"title", "description"=>"description",
             "availability"=>"availability", "condition"=>"condition", "price"=>"price",
             "link"=>"link", "image_link"=>"image_link", "brand"=>"brand", 
             "additional_image_link"=>"additional_image_link", "age_group"=>"age_group", 
             "color"=>"color", "gender"=>"gender", "item_group_id"=>"item_group_id", 
             "google_product_category"=>"google_product_category", "material"=>"material", 
             "pattern"=>"pattern", "product_type"=>"product_type", "sale_price"=>"sale_price",
             "sale_price_effective_date"=>"sale_price_effective_date","shipping"=>"shipping" ,
             "shipping_weight"=>"shipping_weight" ,"custom_label_0"=>"custom_label_0","custom_label_1"=>"custom_label_1",
             "custom_label_2"=>"custom_label_2","custom_label_3"=>"custom_label_3","custom_label_4"=>"custom_label_4");
            //$header = array_keys($row);
            fputcsv($fp, $header);
            $header = array_flip($header);
        }
        fputcsv($fp, array_merge($header, $contents));
    }
    fclose($fp);
    return;
}

$json_filename = 'fubar.json';
$csv_filename  = 'voo.csv';

jsonToCSV($json_filename, $csv_filename);
echo  $csv_filename;
?>
