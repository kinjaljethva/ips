<?php

include("./lib/xmlrpc.inc");


$function_name = "wp.uploadFile";

$url = "http://localhost/projects/wordpress/xmlrpc.php";

$client = new xmlrpc_client($url);

$filename = 'SIP943899.jpg';
$path = '/img/' . $filename;

$filedata = file_get_contents($path, true);

$encoded = base64_encode($filedata);

$client->return_type = "phpvals";

//$params = array('name' => $filename, 'type' => 'image/jpg', 'bits' => $encoded);
//$res = $client->send($function_name,0, 'admin', 'admin@123', $params);
//
//echo "<pre>";
//print_r($res);
//echo "</pre>";
//die();
$client->debug = true;

$message = new xmlrpcmsg(
        $function_name, array(
    new xmlrpcval(0, "int"),
    new xmlrpcval("admin", "string"),
    new xmlrpcval("admin@123", "string"),
     array(       
    new xmlrpcval($filename, "string"),
    new xmlrpcval('image/jpeg', "string"),
    new xmlrpcval($encoded, "string"),
        )
            ),'struct'
);

echo "<pre>";
print_r($message);
echo "</pre>";
die();
//
$resp = $client->send($message);

if ($resp->faultCode())
    echo 'KO. Error: ' . $resp->faultString();
else
    echo 8888;
