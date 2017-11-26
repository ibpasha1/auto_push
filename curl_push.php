<!DOCTYPE html>
  <html>
    <head>
    <title>Groove Auto Push</title>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
      <link rel="stylesheet" type="text/css" href="style.css">

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
    <body style="background-color:#34495e;">
<body>
<nav>
    <div class="nav-wrapper">
      <ul id="nav-mobile" class="left hide-on-med-and-down">
        <li><a href="">Groove Auto Push</a></li>
      </ul>
    </div>
  </nav>
  <div class="row">
        <div class="col s12 m6">
          <div class="card blue-grey darken-1">
            <div class="card-content white-text">
              <span class="card-title">JSON to CSV CONNECTION COMPLETE</span>
              <div class="progress">
                <div class="determinate" style="width: 100%"></div>
                </div>
            </div>
            
            
            <div class="card-action">
            <a href="index.php">back</a>
            </div>
          </div>
        </div>
      </div>

    </body>
  </html>
<?php
include 'db.php';
//Written by Ibrahim Pasha - 11/22/2017 

//---------------------------------------------GET CREDS FROM USER---------------------------------------

$store_id   = $mysqli->escape_string($_POST['store_id']);
$store_url  = $mysqli->escape_string($_POST['store_url']);
$client_id  = $mysqli->escape_string($_POST['client_id']);
$api_key    = $mysqli->escape_string($_POST['api_key']);
$username   = $mysqli->escape_string($_POST['username']);
$password   = $mysqli->escape_string($_POST['password']);
$time       = $mysqli->escape_string($_POST['time']);


//---------------------------------------------GET PRODUCT INFO FROM API-----------------------------------

function groove_trail_slash($string) 
{
	return rtrim($string, '/');
}

function groove_getStoreUrl()                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     
{
  //$storeid = 'd18iepu0cs';
  $storeid = $GLOBALS['store_id'];
  //$storeUrl = 'https://api.bigcommerce.com/stores/'.$storeid.'/v3/';
  $storeUrl = $GLOBALS['store_url'];

	//$storeUrl = 'https://api.bigcommerce.com/stores/d18iepu0cs/v3/catalog/products';
	return $storeUrl ?: '';
}

function groove_getClientID()        
{
  //$storeClientID = 'c7tgdh3xfzfowow03xq0bx1i6c26v4s';
  $storeClientID = $GLOBALS['client_id'];
	return $storeClientID ?: '';
}

function groove_getStoreAccessToken()
{
  //$storeApiKey   = '9rkjj8o7dzkznbs7kzdymdq8pydzcc9';
  $storeApiKey = $GLOBALS['api_key'];
	return $storeApiKey ?: '';
}

function groove_getProduct(&$ch, $productid) 
{
	//$productSKU = '104';
	$api_url = groove_trail_slash(groove_getStoreUrl()) . '/catalog/products?id='.$productid;
	$ch = curl_init();
	return runcurl($ch, $api_url);
}

function groove_getOrder(&$ch, $orderid)
{
	//$productSKU = '104';
	//$api_url = groove_trail_slash(groove_getStoreUrl()) . '/orders/order?id='.$orderid;
	$api_url = groove_trail_slash(groove_getStoreUrl()) . '/orders/'.$orderid.'/transactions';
	//$api_url = groove_trail_slash(groove_getStoreUrl()) . '/orders/'.$orderid.'/transactions';
	//https://api.bigcommerce.com/stores/{{store_id}}/v3/orders/{order_id}/transactions', headers=headers)
	$ch = curl_init();
	return runcurl($ch, $api_url);
}
//https://api.bigcommerce.com/stores/{{store_id}}/v3/catalog/products/{product_id}/images/{image_id}', headers=headers)

function groove_getProducts(&$ch, $name) 
{
	//$productSKU = '104';
	$api_url = groove_trail_slash(groove_getStoreUrl()) . '/catalog/products';
	$ch = curl_init();
	return runcurl($ch, $api_url);
}

function groove_getProductImage(&$ch, $productid) 
{
	$api_url = groove_trail_slash(groove_getStoreUrl()) . '/catalog/products/'.$productid.'/images';
	$ch = curl_init();
	return runcurl($ch, $api_url);
}


function groove_getDeleteProductImage(&$ch, $productid, $imageid) 
{
	$api_url = groove_trail_slash(groove_getStoreUrl()) . '/DELETE/catalog/products/'.$productid.'/images/'.$imageid;
	$ch = curl_init();
	return runcurl($ch, $api_url);
}

function groove_DeleteProduct(&$ch, $productid) 
{
	$api_url = groove_trail_slash(groove_getStoreUrl()) . '/DELETE/catalog/products/'.$productid;
	$ch = curl_init();
	return runcurl($ch, $api_url);
}

function groove_UpdateProduct(&$ch, $productid) 
{
	$api_url = groove_trail_slash(groove_getStoreUrl()) . '/PUT/catalog/products/'.$productid;
	$ch = curl_init();
	return runcurl($ch, $api_url);
}
   
//$response = '';
function runcurl(&$ch, $api_url = '') 
{
	
	if($api_url == '') {
		return groove_convertToArray(array());
	}

	curl_setopt( $ch, CURLOPT_URL, $api_url );
	curl_setopt( $ch, CURLOPT_HTTPHEADER, array ('X-Auth-Client: '.groove_getClientID(), 'X-Auth-Token: '.groove_getStoreAccessToken(), 'Accept: application/json') );
	curl_setopt( $ch, CURLOPT_VERBOSE, 0 );
	curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'GET');
	curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0 );
	curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0 );

	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );

	$response = curl_exec($ch);

	return $response;
}


//--------------------------------------------------------READ JSON FILE AND PUT DATA INTO MYSQL-------------------------------------------------------------
$name = '';
groove_getProducts($ch, $name);
$json5 = groove_getProducts($ch, $name);
$data_set_5 = json_decode($json5,JSON_PRETTY_PRINT);
$fp = fopen('fubar.json', 'w');
fwrite($fp, json_encode($data_set_5, JSON_PRETTY_PRINT));
fclose($fp);


//-------------------------------------READ FROM MYSQL AND EXPORT TABLE TO A CSV FILE--------------------UPlOAD CSV FILE TO SERVER USING WEBDAV------------------------------------------------------------



$time = $GLOBALS['time'];
$set_date = "2017/11/22";
$set_time = "02:34";
////echo date("Y/m/d");
////echo "</br>";
//echo date("h:i");
///echo "</br>";
if ($set_time == date("h:i"))
{
    //echo "True";
    //-------------------------------------------------------------------------
    function jsonToCSV($jfilename, $cfilename)
	{
		if (($json = file_get_contents($jfilename)) == false)
			die('Error reading json file...');
		$array = json_decode($json, true);
		$fp = fopen($cfilename, 'w');
		$header = false;
		foreach ($array["data"] as $row)
		{
			//echo $row['id'];
			//echo "</br>";
			//echo $row['name'];
			//echo "</br>";
			//echo $row['sku'];
	
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
	//echo  $csv_filename;


    //-------------------------------------------------------------------------
} else {
   // echo "False";
}
//--------------------------------------------------------------------------------------------------------------------------------------------------------------
?>
