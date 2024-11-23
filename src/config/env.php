<?php
$env_filename = __DIR__ . "/../.env";
if (file_exists($env_filename)) {
  $env = file_get_contents($env_filename);
  $lines = explode("\n", $env);
  foreach ($lines as $line) {
    preg_match("/([^#]+)\=(.*)/", $line, $matches);
    if (isset($matches[2])) {
      putenv(trim($line));
    }
  }
}