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


$v1 = $store_id;
$v2 = $store_url;
$v3 = $client_id;
$v4 = $api_key;
$cred = array($v1, $v2, $v3, $v4);
$data = var_export($cred, true);
$var1 = "<?php\n\n\$v1 = $data;\n\n?>";
file_put_contents('cred.php', $var1);


include 'cred.php';

if ($store_id == '' && $store_id == '' && $client_id == '' && $api_key == '' ) 
{

}
// I need to add globals to this 
$v1[0] = $GLOBALS['store_id'];
$v1[1] = $GLOBALS['store_url'];
$v1[2] = $GLOBALS['client_id'];
$v1[3] = $GLOBALS['api_key'];
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

function groove_getProducts(&$ch, $name) 
{
	$api_url = groove_trail_slash(groove_getStoreUrl()) . '/catalog/products/?include=images';// LETS TAKE A LOOK
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
session_start();
sleep(2);
$name      = '';
$productid  = '';

// Brand call
groove_getBrand($ch, $productid);
$brand_name = groove_getBrand($ch, $productid);
$data_set_6 = json_decode($brand_name,JSON_PRETTY_PRINT);
$fp = fopen('brand.json', 'w');
fwrite($fp, json_encode($data_set_6, JSON_PRETTY_PRINT));
fclose($fp);
//

//Product information & image information
groove_getProducts($ch, $name);
$json5 = groove_getProducts($ch, $name); // general product information

$data_set_5 = json_decode($json5,JSON_PRETTY_PRINT);
$fp = fopen('test.json', 'w');
fwrite($fp, json_encode($data_set_5, JSON_PRETTY_PRINT));
fclose($fp);
//


	$array = json_decode($json5, JSON_PRETTY_PRINT);
    $fp = fopen('data.csv',  'w');
		$header = false;
		

		foreach ($array["data"] as $row)
		{

			foreach ($row["images"] as $second_row) {
				$image_link                = $second_row['url_standard'];
			}
				$id                        = $row['id'];
				$title           	       = $row['name'];
				$meta_description          = $row['meta_description'];
				$availability              = $row['availability'];
				$condition                 = $row['condition'];
				$price           	       = $row['price'];
				$link                      = $row['custom_url']['url'];
				//$image_link                = $row['images']['url_standard'];
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

				//function will read how many pages the store has and lopp through the page numbers to
				//list all possible products


				$web_url = 'eckraus.com';
				$mod_link = $web_url . $link;

	
				$contents = array("id"=>"$id","title"=>$title,"meta_description"=>$meta_description
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
		fclose($fp);
		return;
	
?>