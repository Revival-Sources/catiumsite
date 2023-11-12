<?php 
$uname = $_GET['name'] ?? "Guest ".rand(1000, 9999);
$appearance = "http://catium.xyz/asset/CharacterFetch.ashx?placeId=1818";
if($_GET['id']) { 
	$appearance = "http://catium.xyz/asset/CharacterFetch.ashx?userId=".$settings->id."&placeId=1818";
} else { 
	$appearance = "http://catium.xyz/asset/CharacterFetch.ashx?placeId=1818";
}
$settings = (object)[
	"name" => $uname,
	"id" => $_GET['id'] ?? rand(1000, 9999),
	"ip" => $_GET['ip'],
	"port" => $_GET['port'] ?? "53640"
];
header("content-type: text/plain; X-Robots-Tag: noindex;charset=UTF-8"); 
ob_start();?>
{
	"ClientPort":0,
	"MachineAddress":"<?=$settings->ip?>",
	"ServerPort":<?=$settings->port?>,
	"PingUrl":"",
	"PingInterval":120,
	"UserName":"<?=$uname?>",
	"SeleniumTestMode":false,
	"UserId":<?=$settings->id?>,
	"SuperSafeChat":false,
	"CharacterAppearance":"<?=$appearance?>",
	"ClientTicket":"",
	"PlaceId":1818,
	"MeasurementUrl":"",
	"WaitingForCharacterGuid":"",
	"BaseUrl":"http://www.catium.xyz/",
	"ChatStyle":"ClassicAndBubble",
	"VendorId":0,
	"ScreenShotInfo":"",
	"VideoInfo":"",
	"CreatorId":-1,
	"CreatorTypeEnum":"User",
	"MembershipType":"None",
	"AccountAge":3300,
	"CookieStoreFirstTimePlayKey":"rbx_evt_ftp",
	"CookieStoreFiveMinutePlayKey":"rbx_evt_fmp",
	"CookieStoreEnabled":true,
	"IsRobloxPlace":false,
	"GenerateTeleportJoin":false,
	"IsUnknownOrUnder13":false,
	"SessionId":"39412c34-2f9b-436f-b19d-b8db90c2e186|00000000-0000-0000-0000-000000000000|0|190.23.103.228|8|2021-03-03T17:04:47+01:00|0|null|null",
	"DataCenterId":0,
	"UniverseId":1818,
	"BrowserTrackerId":0,
	"UsePortraitMode":false,
	"FollowUserId":0,
	"characterAppearanceId":<?=$settings->id?>
}
<?php
$data = "\r\n" . ob_get_clean();
$key = file_get_contents($_SERVER['DOCUMENT_ROOT']."/keys/PrivateKey.pem");
openssl_sign($data, $sig, $key, OPENSSL_ALGO_SHA1);
echo "--rbxsig%" . base64_encode($sig) . "%" . $data;
?>