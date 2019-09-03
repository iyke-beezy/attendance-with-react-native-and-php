var url = "http://192.168.8.105/simple-qr-code-scanner/backend/php/applogin.php?member=012934";
var spliturl = url.split("/");
member = spliturl[spliturl.length - 1].split("=")
console.log(member[member.length - 1])

