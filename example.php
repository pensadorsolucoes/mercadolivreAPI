<?php
error_reporting(1);
error_reporting(E_ALL);
ini_set('display_errors', 1);
use mercadolivreAPI\MercadoLivre as mercadoLivre;
require('vendor/autoload.php');
//======================================================================
// Oauth
//======================================================================
$ml = new mercadoLivre(array(
	'redirect_uri' => '{app uri}',
	'client_id' => '{client_id}',
	'response_type'=>'token'
));
$url = $ml->getLoginUrl();
//======================================================================
// Post new Deal
//======================================================================
$token='APP_USR-6476276740985133-070206-89f159519e3436748cfeefd89a181d39__B_L__-149982995';
$ml = new mercadoLivre($token);
$params = array(
	'category'=>'MLB118852',
	'marker'=>'Hyundai',
	'model'=>'HB20S',
	'fuel_type'=>'372591',
	'year'=>2016,
	'color'=>'prata',
	'doors'=>2,
	'title'=>'Primeiro anúncio',
	'buying_mode'=>'classified',
	'price'=>32000,
	'available_quantity'=>'1',
	'listing_type_id'=>'free',
	'condition'=>'not_specified',
	'id_city'=>'TUxR29p4m5pYQ',
	'id_state'=> 'BR-GO',
	'km'=> 25000,
	
	'pictures'=>[
		'https://blueprint-cdn.searchoptics.com.br/60240f87af6f398961710bebdea69a79/hb20s-mdp/hb20s_comfortPlus_branco.png',
		'http://dealers.rewebmkt.com/images/20160623125809-HB20-S.png',
		'https://caoa.com.br/uploads/product_gallery/2016/05/12/1463023491-0000s-0004-interior-refinado.jpg',
		'https://4.bp.blogspot.com/-MDTkQy0G_N0/WCm7_BtDYxI/AAAAAAACfDQ/m3hIDKPrMzs-072PHuQ5tmHVuCmZZeJEACLcB/s1600/HB20S%2BLimited%2BConcept_1.jpg',
		'http://4.bp.blogspot.com/-ywajauwIV2g/VlMoW3b6TtI/AAAAAAACQig/xxTZX40A2Og/s1600/Hyundai-HB20S-2016%2B%25284%2529.jpg',
		'http://primeiramarcha.com.br/wp-content/uploads/2015/09/Hyundai-HB20-2016-6.jpg'
	],
  	'attributes'=>[
  		'HAS_AIR_CONDITIONING', 
  		'HAS_SIDE_IMPACT_AIRBAG', 
  		'HAS_ONBOARD_COMPUTER', 
  		'HAS_LIGHT_SENSOR', 
  		'HAS_ELECTRIC_MIRRORS'
  	],
  	'description'=> 'This is the real estate property description.'
);
$item = $ml->postDeal($params);
//======================================================================
// Put Deal
//======================================================================
	
// just attributes you want update
$ml = new mercadoLivre($token);
$params['id_deal'] = 'MLB36169';
$params['atributtes'] = array(
	'category'=>'MLB118852',
	'marker'=>'Hyundai',
	'model'=>'HB20S',
	'fuel_type'=>'372591',
	'year'=>2016,
	'color'=>'prata',
	'doors'=>2,
	'title'=>'Primeiro anúncio',
	'buying_mode'=>'classified',
	'price'=>32000,
	'available_quantity'=>'1',
	'listing_type_id'=>'free',
	'condition'=>'not_specified',
	'id_city'=>'TUxR29p4m5pYQ',
	'id_state'=> 'BR-GO',
	'km'=> 25000,
	
	'pictures'=>[
		'https://blueprint-cdn.searchoptics.com.br/60240f87af6f398961710bebdea69a79/hb20s-mdp/hb20s_comfortPlus_branco.png',
		'http://dealers.rewebmkt.com/images/20160623125809-HB20-S.png',
		'https://caoa.com.br/uploads/product_gallery/2016/05/12/1463023491-0000s-0004-interior-refinado.jpg',
		'https://4.bp.blogspot.com/-MDTkQy0G_N0/WCm7_BtDYxI/AAAAAAACfDQ/m3hIDKPrMzs-072PHuQ5tmHVuCmZZeJEACLcB/s1600/HB20S%2BLimited%2BConcept_1.jpg',
		'http://4.bp.blogspot.com/-ywajauwIV2g/VlMoW3b6TtI/AAAAAAACQig/xxTZX40A2Og/s1600/Hyundai-HB20S-2016%2B%25284%2529.jpg',
		'http://primeiramarcha.com.br/wp-content/uploads/2015/09/Hyundai-HB20-2016-6.jpg'
	],
  	'attributes'=>[
  		'HAS_AIR_CONDITIONING', 
  		'HAS_SIDE_IMPACT_AIRBAG', 
  		'HAS_ONBOARD_COMPUTER', 
  		'HAS_LIGHT_SENSOR', 
  		'HAS_ELECTRIC_MIRRORS'
  	],
  	'description'=> 'This is the real estate property description.'
);
$item = $ml->putDeal($params);
//======================================================================
// Get Brand
//======================================================================
$item = $ml->getBrand();
var_dump($item);
//======================================================================
// GET model Category
//======================================================================
$params['id_category']='MLB5782';
$item = $ml->getModelAndCategory($params);
//======================================================================
// GET Attributes
//======================================================================
$item = $ml->getAttributes($params);