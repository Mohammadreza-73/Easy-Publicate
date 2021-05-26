<?php

use Samoon\App\Helpers\Config;

require_once realpath("../../../vendor/autoload.php");

$params = http_build_query([
    'issn' => Config::get('scopus', 'issn')
]);
$url = 'https://api.elsevier.com/content/serial/title?' . $params;

$options = [
    CURLOPT_URL            => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_CONNECTTIMEOUT => false,
    CURLOPT_TIMEOUT        => false,
    CURLOPT_USERAGENT      => 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)',
    CURLOPT_HTTPHEADER     => ['X-ELS-APIKey: ' . Config::get('scopus', 'api_key')]
];

$ch = curl_init();
curl_setopt_array($ch, $options);
$res = curl_exec($ch);
curl_close($ch);

echo $res;