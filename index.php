<?php

use Samoon\App\Helpers\Curl;
use Samoon\App\Helpers\CurlUtil;

include "./vendor/autoload.php";

// $data = [
//     'query' => 'AU-ID("35560470000")'
// ];

// // $url = 'https://api.elsevier.com/content/serial/title';
// $url = 'https://api.elsevier.com/content/search/scopus';
// $apiKey = '6a0c3117c305fed4822dfec123bfd37f';

// $curl = new Curl();
// $curl->setOpt(CURLOPT_TIMEOUT, false);
// $curl->setOpt(CURLOPT_CONNECTTIMEOUT, false);
// $curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);
// $curl->setOpt(CURLOPT_CUSTOMREQUEST, 'GET');

// $curl->setUserAgent('Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)');

// $curl->setHeader('X-ELS-APIKey', $apiKey);

// $curl->setUrl($url);
// // $curl->exec();
// $curl->get($url, $data);

// echo json_encode($curl->response, JSON_PRETTY_PRINT);

$params = http_build_query([
    'query' => 'AU-ID("35560470000")'
]);
$url = 'https://api.elsevier.com/content/search/scopus?' . $params;

$options = [
    CURLOPT_URL            => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_CONNECTTIMEOUT => false,
    CURLOPT_TIMEOUT        => false,
    CURLOPT_USERAGENT      => 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)',
    CURLOPT_HTTPHEADER     => ['X-ELS-APIKey: 6a0c3117c305fed4822dfec123bfd37f']
];

$ch = curl_init();
curl_setopt_array($ch, $options);
$res = curl_exec($ch);
curl_close($ch);

echo $res;