<?php
/**
 * @param array $data
 */
function pr(mixed $data){
    echo '<div class="uk-alert-danger" uk-alert style="z-index: 1000;background-color:coral;color:black;">';
        echo '<pre>';
            print_r($data);
            echo '<a class="uk-alert-close" uk-close></a>';
        echo '</pre>';
    echo '</div>';
}

function dump($data){
    echo '<pre style="z-index: 1000;background-color:coral;color:black;width:100%;padding-left:240px;text-align:left;">';
       var_dump($data);
    echo '</pre>';
}
/**
 * prints data to the browser
 * @param string $data
 * @return string
 */
function show( string $data): string
{
    return htmlspecialchars($data);
}

/**
 * @param object $object
 * @return mixed
 */
function objectToArray(object $object): array
{
    foreach ($object as $obj) {
        return json_decode(json_encode($obj), true);
    }
}

function getUrlParam($url = null): array
{
    $url = ($url) ? $url : $_SERVER['REQUEST_URI'];
    $params = [];
    if ($url != '') {
        $queryString = parse_url($url ,  PHP_URL_QUERY);
        parse_str($queryString, $params);
    }
    return $params;
}
