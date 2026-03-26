<?php

// Get the path without the query string.
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
switch ($path) {

  case '/':
    echo 'Hello World';
    break;

  case '/redirect':
    header('Location: /destination');
    http_response_code(302);
    break;

  case '/destination':
    echo 'Final';
    break;

  case '/bye':
    echo bye_world();
    break;

  case '/json':
    echo "{$_SERVER['CONTENT_TYPE']}: ". file_get_contents('php://input');
    break;

  case '/query':
    echo "v1: {$_GET['v1']}; v2: {$_GET['v2']}; v3: {$_POST['v3']}";
    break;

  default:
    http_response_code(404);
    break;
}

function bye_world() {
  return "Bye World";
}
