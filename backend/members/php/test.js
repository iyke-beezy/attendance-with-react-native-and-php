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
var scannedurl = "https://www.ptbci.com/members?member=901446"

// async function
async function fetchAsync (url) {
    var scannedurl = "https://www.ptbci.com/members?member=901446"
var qrcode = obtainqrcode(scannedurl);
var attendance = {
    146866:"12:13"
}
//var obj = {"1":5,"2":7,"3":0,"4":0,"5":0,"6":0,"7":0,"8":0,"9":0,"10":0,"11":0,"12":0}
var result = Object.keys(attendance).map(function(key) {
  return [Number(key), attendance[key]];
});

console.log(attendance);
const member = {
    qrcode: [146866,771546,901446]
}
var time = ["12:13","11:16","13:15"]
console.log(member)
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
  fetchAsync(url)
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
      

var date = new Date()
var now = date.getTime()
date.setHours(date.getHours()+3)
var future = date.getTime()
var deadline = new Date("dec 31, 2019 15:37:25").getTime()
console.log(date.getTime())
console.log(now)
console.log(deadline)*/