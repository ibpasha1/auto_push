<?php
ini_set('max_execution_time', 300);
//Written by Ibrahim Pasha - 11/22/2017 
//---------------------------------------------GET CREDS FROM USER---------NO LONGER USED
$store_id  = isset($_POST['store_id'])  ? $_POST['store_id']  : '';
$store_url = isset($_POST['store_url']) ? $_POST['store_url'] : '';
$client_id = isset($_POST['client_id']) ? $_POST['client_id'] : '';
$api_key   = isset($_POST['api_key'])   ? $_POST['api_key']   : '';

$store_url = 'https://api.bigcommerce.com/stores/ucycv5vmkf/v3/';
$client_id = '3el5giojff6f0d9gn4fnnp1lhi03sfr';
$api_key   = '2lxhch78sg9orr7ke3a94dj6tylsmt8';


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
    $storeClientID = $GLOBALS['client_id'];
	return $storeClientID ?: '';
}

function groove_getStoreAccessToken()
{
    $storeApiKey = $GLOBALS['api_key'];
	return $storeApiKey ?: '';
}

function groove_getProduct(&$ch, $productid) 
{
	$api_url = groove_trail_slash(groove_getStoreUrl()) . '/catalog/products?id='.$productid;
	$ch = curl_init();
	return runcurl($ch, $api_url);
}

function groove_getOrder(&$ch, $orderid)
{
	$api_url = groove_trail_slash(groove_getStoreUrl()) . '/orders/'.$orderid.'/transactions';
	$ch = curl_init();
	return runcurl($ch, $api_url);
}


function groove_getProducts(&$ch, $x) 
{
	//$x = $GLOBALS['x'];
	$api_url = groove_trail_slash(groove_getStoreUrl()) . '/catalog/products/?include=images&page='.$x.'&limit=250';// LETS TAKE A LOOK
	//$api_url = groove_trail_slash(groove_getStoreUrl()) . '/catalog/products?page='.$page_num.'/?include=images';// LETS TAKE A LOOK
	$ch = curl_init();
	return runcurl($ch, $api_url);
}

function groove_getProductImage(&$ch, $productid) 
{
	//$api_url = groove_trail_slash(groove_getStoreUrl()) . '/catalog/products/'.$productid.'/images?limit={10000000}';
	//$api_url = groove_trail_slash(groove_getStoreUrl()) . '/catalog/products/?include=images';// LETS TAKE A LOOK
	$api_url = groove_trail_slash(groove_getStoreUrl()) . '/brands?=';
	$ch = curl_init();
	return runcurl($ch, $api_url);
}


function groove_getBrand(&$ch, $productid) 
{
	//$api_url = groove_trail_slash(groove_getStoreUrl()) . '/catalog/products/'.$productid.'/images?limit={10000000}';
	//$api_url = groove_trail_slash(groove_getStoreUrl()) . '/catalog/products/?include=images';// LETS TAKE A LOOK
	$api_url = groove_trail_slash(groove_getStoreUrl()) . '/catalog/brands';
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

function runcurl(&$ch, $api_url = '') {
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

$name       = '';
$productid  = '';
//$value = 1;
$page_value = '';
$y = 0;
// Brand call
groove_getBrand($ch, $productid);
$brand_name = groove_getBrand($ch, $productid);
$data_set_6 = json_decode($brand_name,JSON_PRETTY_PRINT);
//$fp = fopen('brand.json', 'w');
//fwrite($fp, json_encode($data_set_6, JSON_PRETTY_PRINT));
//fclose($fp);

$page = 6;

$product_list_1 = groove_getProducts($ch, $y); // the array is built
for ($x = 1; $x <= $page; $x++) 
{
	$product_list_2 = groove_getProducts($ch, $x); // the array is built
	$v[] = json_decode($product_list_2, true);
	$json_merge = json_encode($v);
} 
$v[] = json_decode($product_list_1, true);

//$total_list = array_merge($stack_1, $product_list);
$total_list = $json_merge;
//----------------------------------------------------------------------------
$data_set_5 = json_decode($total_list,JSON_PRETTY_PRINT);
//4504
//----------------------------------------------------------------------------
//$fp = fopen('test.json', 'w');
//fwrite($fp, json_encode($data_set_5, JSON_PRETTY_PRINT));
//fclose($fp);
//----------------------------------------------------------------------------
//----------------------------------------------------------------------------
$array = json_decode($total_list, JSON_PRETTY_PRINT);
$fp = fopen('data.csv',  'w');
	$header = false;
		
	foreach ($array as $row) 
	{
		foreach ($row["data"] as $row2) 
		{
			
			foreach ($row2["images"] as $second_row) 
			{
				$image_link    = $second_row['url_standard'];
			}

					foreach ($array[0]["meta"] as $third_row) 
					{
						$page_value          = $third_row['total_pages'];
						//$page_value          = $GLOBALS['page_value'];
						$total_products      = $third_row['total'];
						$per_page			 = $third_row['per_page'];
					}


				$id                        = $row2['id'];
				$title           	       = $row2['name'];
				$description               = $row2['description'];
				$availability              = $row2['availability'];
				$condition                 = $row2['condition'];
				$price           	       = $row2['price'];
				$link                      = $row2['custom_url']['url'];
				//$image_link                = $row['images']['url_standard'];
				$brand                     = $row2['brand_id'];
				$layout_file               = $row2['layout_file'];
				$age_group                 = $row2['search_keywords'];
				$color                     = $row2['search_keywords'];
				$gender                    = $row2['search_keywords'];
				$item_group_id             = $row2['search_keywords'];
				$google_product_category   = $row2['search_keywords'];
				$material                  = $row2['search_keywords'];
				$pattern                   = $row2['search_keywords'];
				$product_type              = $row2['search_keywords'];
				$sale_price                = $row2['sale_price'];
				$sale_price_effective_date = $row2['date_created'];
				$shipping                  = $row2['is_free_shipping'];
				$shipping_weight 		   = $row2['weight'];
				$custom_label_0 		   = $row2['search_keywords'];
				$custom_label_1  		   = $row2['search_keywords'];
				$custom_label_2 		   = $row2['search_keywords'];
				$custom_label_3  		   = $row2['search_keywords'];
				$custom_label_4  		   = $row2['search_keywords'];

				//-----------filters out the html in description-----------------------//

				$flitered_des = strip_tags($description);
				if($availability == 'disabled') {
					$note = 'out of stock';
				} else if ($availability == 'available') {
					$note = 'in stock';
				}

				if($brand == '0') {
					$brand_name = 'Unknown';
				} else if ($brand == '1') {
					$brand_name = 'Legacy';
				} else if ($brand == '2') {
					$brand_name = 'Steam Freak';
				} else if ($brand == '3') {
					$brand_name = 'Brewcraft';
				} else if ($brand == '4') {
					$brand_name = 'Brewers Best';
				} else if ($brand == '5') {
					$brand_name = 'Muntons';
				} else if ($brand == '6') {
					$brand_name = 'Briess';
				} 
				$web_url = 'eckraus.com';
				$mod_link = $web_url . $link;
	
				$contents = array("id"=>"$id","title"=>$title,"description"=>$flitered_des
				,"availability"=>$note,"condition"=>$condition,"price"=>$price
				,"link"=>$mod_link,"image_link"=>$image_link,"brand"=>$brand,"brand"=>$brand_name
				,"additional_image_link"=>$layout_file, "age_group"=>$age_group, "color"=>$color
				,"gender"=>$gender , "item_group_id"=>$item_group_id
				,"google_product_category"=>$google_product_category,  "material"=>$material
				,"pattern"=>$pattern, "product_type"=>$product_type, "sale_price"=>$sale_price, "sale_price_effective_date"=>$sale_price_effective_date
				,"shipping"=>$shipping, "shipping_weight"=>$shipping_weight, "custom_label_0"=>$custom_label_0, "custom_label_1"=>$custom_label_1
				,"custom_label_2"=>$custom_label_2, "custom_label_3"=>$custom_label_3, "custom_label_4"=>$custom_label_4 );
		
				 if (empty($header)) {

				 $header = array("id"=>"id", "title"=>"title", "description"=>"description",
				 "availability"=>"availability", "condition"=>"condition", "price"=>"price",
				 "link"=>"link", "image_link"=>"image_link", "brand"=>"brand", 
				 "additional_image_link"=>"additional_image_link", "age_group"=>"age_group", 
				 "color"=>"color", "gender"=>"gender", "item_group_id"=>"item_group_id", 
				 "google_product_category"=>"google_product_category", "material"=>"material", 
				 "pattern"=>"pattern", "product_type"=>"product_type", "sale_price"=>"sale_price",
				 "sale_price_effective_date"=>"sale_price_effective_date","shipping"=>"shipping" ,
				 "shipping_weight"=>"shipping_weight" ,"custom_label_0"=>"custom_label_0","custom_label_1"=>"custom_label_1",
				 "custom_label_2"=>"custom_label_2","custom_label_3"=>"custom_label_3","custom_label_4"=>"custom_label_4","Content-Encoding: UTF-8","Content-type: text/csv; charset=UTF-8");
				//$header = array_keys($row);
				fputcsv($fp, $header);
				$header = array_flip($header);
			}
			fputcsv($fp, array_merge($header, $contents));	
	}
}
		echo "Total Pages    = ------------------:" . $page_value;
		echo "</br>";
		echo "Total Products = ------------------:" . $total_products;
		echo "</br>";
		echo "Per Page Value = ------------------:" . $per_page;
		echo "</br>";
		//echo "Test ID        = ------------------:" . $new_id;
		fclose($fp);
		return;
?>