<?php
$data = array("callback" => "https://apoorva.com", "clientid" => "LfmvNs1g14p0C7AR3IKyfoCxO6i2zKAJ", "clientsecret" => "S6meLXlUY00YVML3");
$data_string = json_encode($data);
$ch = curl_init('https://m1g1mqu433.execute-api.us-east-1.amazonaws.com/prod/HMAC-Gen-For-Apigee-Lambda-Sample');                                                                      
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('x-api-key: pxovgQymYq7ezElYiHDpeaXM4x98DbqaMacpEIG2'));
$result = curl_exec($ch);
?>