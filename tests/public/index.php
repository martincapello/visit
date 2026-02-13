<?php

switch ($_SERVER['REQUEST_URI']) {

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

  default:
    http_response_code(404);
    break;
}
