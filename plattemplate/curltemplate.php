<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_POSTFIELDS, $xmls);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_USERPWD, "admin@internal" . ":" . "oVirtEngine");
curl_setopt($ch, CURLOPT_HTTPHEADER, Ovirt::postheader());

$result = curl_exec($ch);
if (curl_errno($ch)) {
    return 'Error:' . curl_error($ch);
}
curl_close ($ch);

?>