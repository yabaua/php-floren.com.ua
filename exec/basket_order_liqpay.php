<?
$public_key='i74969477618';
$private_key='Ef2XMSHcaXgQgisqfMmfWvPjk5JXpWrd7eDg4IMK';

// $order_id = "003"; //$_POST['order_id']; ============ DECLARETED UPPER
$order_id_txt='Замовлення №' . $order_id;

$json_stringPrivat = array(
					"public_key"	=>	$public_key,
					"version"		=>	"3",
					"action"		=>	"pay",
					"amount"		=>	$bsk_ttl,
					"currency"		=>	"UAH",
					"description"	=>	$order_id_txt,
					"order_id"		=>	$order_id,
					"result_url"	=>	"https://floren.com.ua/ua/order/",
					/*
					"rro_info"		=>	array(	
					  "items" => [
					     
					     array(	"amount"		=>	1,
					       "price"		=>	$bsk_ttl,
					       "cost"		=>	$bsk_ttl,
					       "id"		=>	13697521
					     )
					  ],
					  "delivery_emails"		=>	["liqpay@floren.com.ua"]
					)
					*/
				);

$dataStringPrivat = json_encode($json_stringPrivat, JSON_UNESCAPED_UNICODE);

$data=base64_encode($dataStringPrivat);
$sign_string	=	$private_key.$data.$private_key;
$signature=base64_encode(sha1($sign_string, true));
header("location:https://www.liqpay.ua/api/3/checkout?data=".$data."&signature=".$signature);
?>