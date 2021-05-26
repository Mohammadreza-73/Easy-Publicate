<?php

use Samoon\App\Helpers\Curl;

// include "./vendor/autoload.php";

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