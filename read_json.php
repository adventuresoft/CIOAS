<?php
$json = file_get_contents('dt_output.json');
$json = mb_convert_encoding($json, 'UTF-8', 'UTF-16LE');
echo substr($json, 0, 800);
