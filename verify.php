<?php
$access_token = 'acI+Y9TOweOJVl+uPFFxr9sIOzN2A2khMx+Sz4OkSZqWCea1XDJ6fjjPh+9FihUi+VdsRSSXUqvjRsAB4C61QrCPFS09k2k0s2R9JH8vi1P5dkwP4Xrx/zkJ/EvRWCaK3OaV1gwrtkesqiYqEUmf4wdB04t89/1O/w1cDnyilFU=';


$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
