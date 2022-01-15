<?php
// PHP code to extract IP 

    function getVisIpAddr() {
        $clientip;
      if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
          $clientip = $_SERVER['HTTP_CLIENT_IP'];
      }
      else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
          $clientip = $_SERVER['HTTP_X_FORWARDED_FOR'];
      }
      else {
          $clientip = $_SERVER['REMOTE_ADDR'];
      }
    $ipdat = @json_decode(file_get_contents(
      "http://ip-api.com/json/" . $clientip));
  //echo $clientip.'<br>';  
  //echo 'Country Name: ' . $ipdat->geoplugin_countryName . "<br>";
  		//echo  $ipdat->geoplugin_currencyCode . "<br>";
      //return $ipdat->geoplugin_currencyCode;
      //return $ipdat->countryCode;
      return 'NG'; 
  
  }
//   function old_rate(){
      
// $req_url = 'https://api.exchangerate.host/latest?base=USD&symbols=NGN';
// $response_json = file_get_contents($req_url);
// if(false !== $response_json) {
//     try {
//         $response = json_decode($response_json);
//         if($response->success === true) {
//             //print_r($response);
//           	//echo $response->success; 
//           	return $response->rates->NGN;
//         }
//     } catch(Exception $e) {
//         // Handle JSON parse error...
//     }
// }
//   }
function get_rate(){

$url = "https://api.binance.com/api/v3/ticker/price?symbol=USDTNGN";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// $headers = array(
//    "Accept: application/json",
// );
// curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
//for debug only!
// curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
// curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
curl_close($curl);
$newres = json_decode($resp);
return 473.28;
// return $newres->price;
}
