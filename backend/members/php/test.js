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
obtainqrcode = (url) => {
    var spliturl = url.split("/");
    var  member = spliturl[spliturl.length - 1].split("=")
    return member[member.length - 1]
  }
function formEncode(obj) {
    var str = [];
    for(var p in obj)
    str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
    return str.join("&");
}
var url = "https://www.ptbci.com/members?member=011566"
var qrcode = obtainqrcode(url);
const member = {
    qrcodeno: qrcode
}

// async function
async function fetchAsync (url, member) {
    // await response of fetch call
    let response = await fetch(url, {
        method : 'POST',
        headers: { "Content-type": "application/x-www-form-urlencoded"},
        body: formEncode(member)
    });
    // only proceed once promise is resolved
    let data = await response.json();
    // only proceed once second promise is resolved
    return data;
  }
var url = 'https://slitcorp.com/attendance/qrcodes.php'
  fetchAsync(url, member)
    .then(data => console.log(data))
    .catch(reason => console.log(reason.message))
/*const fetchAsyncA = async () => 
	await (await fetch('https://slitcorp.com/attendance/qrcodes.php', {
        method : 'POST',
        headers: { "Content-type": "application/x-www-form-urlencoded"},
        body: formEncode(member)
    })).json()
    .then((response)=> response.json())
        .then((responseJson) => {
           lastScannedUrl = responseJson;  
          console.log(lastScannedUrl['fname']+ " " + lastScannedUrl['oname'] + " " + lastScannedUrl['lname'])
        })
        .catch((error) => {
            console.error(error)
        })
      
*/