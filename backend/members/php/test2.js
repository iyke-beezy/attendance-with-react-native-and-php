
const fetch = require("node-fetch");
var url = 'https://slitcorp.com/attendance/qrcodes.php'
var attendance = {
    146866:"12:13"
}
var time = ["12:13","11:16","13:15"]
fetch('https://slitcorp.com/attendance/qrcodes.php', {
    method: "POST", // *GET, POST, PUT, DELETE, etc.
        mode: "no-cors", // no-cors, cors, *same-origin
        cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
        credentials: "same-origin", // include, *same-origin, omit
        headers: {
            "Content-Type": "application/json"
        },
        redirect: "follow", // manual, *follow, error
        referrer: "no-referrer", // no-referrer, *client
        body: time // body data type must match "Content-Type" header
    }).then((response) => response.json()) // parses response to console
    .then((responseJson => console.log(responseJson)))
    .catch((error) => {
        console.error(error)
    })