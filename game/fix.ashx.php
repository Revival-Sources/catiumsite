<?php 
$uname = $_GET['name'] ?? "Guest ".rand(1000, 9999);
$settings = (object)[
	"username" => $uname,
	"uid" => $_GET['id'] ?? rand(1000, 9999),
	"ip" => $_GET['ip'] ?? "nil",
	"port" => $_GET['port'] ?? "nil",
];
header("content-type: text/plain; X-Robots-Tag: noindex;charset=UTF-8"); 
ob_start();?>
local e= Instance.new('ScreenGui', game.StarterGui)
Instance.new('TextLabel', e)
<?php
$data = "\r\n" . ob_get_clean();
$key = file_get_contents($_SERVER['DOCUMENT_ROOT']."/keys/PrivateKey.pem");
openssl_sign($data, $sig, $key, OPENSSL_ALGO_SHA1);
echo "%" . base64_encode($sig) . "%" . $data;
?>