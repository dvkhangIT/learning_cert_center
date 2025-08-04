<?php
function setAcive(array $route)
{
  if (is_array($route)) {
    foreach ($route as $r) {
      if (request()->routeIs($r)) {
        return 'mm-active';
      }
    }
  }
}
