/**
 * Created by Ulukut on 22.11.2016.
 */
var adserver_unit;

function httpGetAsync(theUrl, callback)
{
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function() {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
            callback(xmlHttp.responseText);
    };
    xmlHttp.open("GET", theUrl, true); // true for asynchronous
    xmlHttp.send(null);
}
function callBanner(contentunit)
{
    adserver_unit = document.getElementById(contentunit);
    var root_url = "http://localhost/adserver/";
    url = root_url + "banner.php?contentUnit=" + contentunit + "&x1=" + adserver_unit.getAttribute("min-x") + "&y1=" + adserver_unit.getAttribute("min-y") + "&x2=" + adserver_unit.getAttribute("max-x") + "&y2=" + adserver_unit.getAttribute("max-y");
    httpGetAsync(url,showBanner);
}
function showBanner(response)
{
    adserver_unit.innerHTML = response;
}
