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

  <form action="" method="POST">
  <ul class="collapsible" data-collapsible="accordion">
  <li>
    <div class="collapsible-header">
      <i class="material-icons">lock</i>
      Big Commerce Info:
      <span class="badge"></span></div>
    <div class="collapsible-body"><p>
    <div class="row">
        <div class="input-field col s6">
            <input value="" id="client_id" type="text" class="validate" name="client_id" required>
                <label class="active" for="client_id">client id</label>
                 </div>
            </div>

            <div class="row">
        <div class="input-field col s6">
            <input value="" id="api_key" type="text" class="validate"   name="api_key" required>
                <label class="active" for="api_key">api key</label>
                 </div>
            </div>
            
            <div class="row">
        <div class="input-field col s6">
            <input value="" id="store_url" type="text" class="validate" name="store_url" required>
                <label class="active" for="store_url">store url</label>
                 </div>
            </div>

            <div class="row">
        <div class="input-field col s6">
            <input value="" id="store_id" type="text" class="validate"  name="store_id" required>
                <label class="active" for="store_id">store id</label>
                 </div>
            </div>
  
 
    
                    <p class="center-align"></p>
                    <p class="center-align">
            <button class="button button1" type="submit" name="submit">create connection</button>
         </p>
</form>
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
      <script>
 
            $(document).ready(function() {
            $('select').material_select();

            $('.timepicker').pickatime({
              default: 'now', // Set default time: 'now', '1:30AM', '16:30'
              fromnow: 0,       // set default time to * milliseconds from now (using with default = 'now')
              twelvehour: false, // Use AM/PM or 24-hour format
              donetext: 'OK', // text for done-button
              cleartext: 'Clear', // text for clear-button
              canceltext: 'Cancel', // Text for cancel-button
              autoclose: false, // automatic close timepicker
              ampmclickable: true, // make AM PM clickable
              aftershow: function(){} //Function for after opening timepicker
                   });
     
                 });
        
    </script>
    </body>
  </html>
<?php
//Written by Ibrahim Pasha - 11/22/2017 
//---------------------------------------------GET CREDS FROM USER---------------------------------------
$store_id  = isset($_POST['store_id'])  ? $_POST['store_id']  : '';
$store_url = isset($_POST['store_url']) ? $_POST['store_url'] : '';
$client_id = isset($_POST['client_id']) ? $_POST['client_id'] : '';
$api_key   = isset($_POST['api_key'])   ? $_POST['api_key']   : '';
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
sleep(2);
$name = '';
groove_getProducts($ch, $name);
$json5 = groove_getProducts($ch, $name);
$data_set_5 = json_decode($json5,JSON_PRETTY_PRINT);
$set_date = "2017/11/22";
$set_time = date("h:i");
if ($set_time == date("h:i")) {
	sleep(1);
    $json5 = $GLOBALS['json5'];
    $array = json_decode($json5, JSON_PRETTY_PRINT);
    $fp = fopen('data.csv', 'w');
		$header = false;
		foreach ($array["data"] as $row)
		{
				$id                        = $row['id'];
				$title           	       = $row['name'];
				$meta_description          = $row['meta_description'];
				$availability              = $row['availability'];
				$condition                 = $row['condition'];
				$price           	       = $row['price'];
				$link                      = $row['layout_file'];
				$image_link                = $row['layout_file'];
				$brand                     = $row['brand_id'];
				$layout_file               = $row['layout_file'];
				$age_group                 = $row['search_keywords'];
				$color                     = $row['search_keywords'];
				$gender                    = $row['search_keywords'];
				$item_group_id             = $row['search_keywords'];
				$google_product_category   = $row['search_keywords'];
				$material                  = $row['search_keywords'];
				$pattern                   = $row['search_keywords'];
				$product_type              = $row['search_keywords'];
				$sale_price                = $row['sale_price'];
				$sale_price_effective_date = $row['date_created'];
				$shipping                  = $row['is_free_shipping'];
				$shipping_weight 		   = $row['weight'];
				$custom_label_0 		   = $row['search_keywords'];
				$custom_label_1  		   = $row['search_keywords'];
				$custom_label_2 		   = $row['search_keywords'];
				$custom_label_3  		   = $row['search_keywords'];
				$custom_label_4  		   = $row['search_keywords'];
	
				$contents = array("id"=>"$id","title"=>$title,"meta_description"=>$meta_description
				,"availability"=>$availability,"condition"=>$condition,"price"=>$price
				,"link"=>$layout_file,"image_link"=>$layout_file,"brand"=>$brand,"brand"=>$brand
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
?>