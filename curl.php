<?php


$data = json_encode( file_get_contents('https://pydolarvenezuela-api.vercel.app/api/v1/dollar/page?page=bcv'), true );

echo $data
//print_r($data);




?>