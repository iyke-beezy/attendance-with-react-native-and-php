/*<?php 
var url = "http://192.168.8.105/simple-qr-code-scanner/backend/php/applogin.php?member=012934";
var spliturl = url.split("/");
member = spliturl[spliturl.length - 1].split("=")
console.log(member[member.length - 1])

$fname = "hello";
$lname = "World";

$name = array(
    'fname' => $fname,
    'lname' => $lname
);

var_dump($name);*/

const fetch = require("node-fetch");
var lastScannedUrl = {}

function formEncode(obj) {
    var str = [];
    for(var p in obj)
    str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
    return str.join("&");
}
var qrcode = "011566"
const member = {
    qrcodeno: qrcode
}

fetch('http://192.168.43.93/react-native/simple-qr-code-scanner/backend/php/qrcodes.php', {
        method : 'POST',
        headers: { "Content-type": "application/x-www-form-urlencoded"},
        body: formEncode(member)
    })
    .then((response)=> response.json())
        .then((responseJson) => {
           lastScannedUrl = responseJson;  
          console.log(lastScannedUrl['fname']+ " " + lastScannedUrl['oname'] + " " + lastScannedUrl['lname'])
        })
        .catch((error) => {
            console.error(error)
        })
      
