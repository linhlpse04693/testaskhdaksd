<?php 

function getUri() : string
{
  $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
  $uri = explode('/', $uri);
  $uri = implode('/', $uri);
  
  return $uri;
}
