<?php
declare(strict_types=1);

namespace src\Helpers;

class HttpClient
{
    /**
     * @param $url
     * @param array $data
     * @return bool|string
     */
     public function post($url, array $data): bool|string
     {
         $handler = curl_init();
         curl_setopt($handler, CURLOPT_URL, $url);
         curl_setopt($handler, CURLOPT_POST, $data);
         curl_setopt($handler, CURLOPT_POSTFIELDS, http_build_query($data));
         $response = curl_exec($handler);
         $statusCode = curl_getinfo($handler, CURLINFO_RESPONSE_CODE);
         curl_close($handler);
         return json_encode(['statusCode' => $statusCode, 'content' => $response]);
     }

    /**
     * @param string $url
     * @return bool|string
     */
     public function get(string $url): bool|string
     {
         $handler = curl_init();
         curl_setopt($handler, CURLOPT_URL, $url);
         curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
         $response = curl_exec($handler);
         $statusCode = curl_getinfo($handler, CURLINFO_RESPONSE_CODE);
         curl_close($handler);
         return json_encode(['statusCode' => $statusCode, 'content' => $response]);
     }


}