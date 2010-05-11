/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


var XMLHttpRequestObject = false;
if (window.XMLHttpRequest){
    XMLHttpRequestObject = new XMLHttpRequest ();
}	else{
    try{
        XMLHttpRequestObject=new ActiveXObject("Microsoft.XMLHTTP");
    }catch (e){
        try{
            XMLHttpRequestObject=new ActiveXObject("msxml2.XMLHTTP");
        }catch (e)
        {
            alert("Your browser does not support AJAX!");
        }
    }
}

function getData(dataSource, divID)
{

    if(XMLHttpRequestObject) {
        var obj = document.getElementById(divID);
        XMLHttpRequestObject.open("GET", dataSource, true);
        XMLHttpRequestObject.onreadystatechange = function()
        {
            if (XMLHttpRequestObject.readyState == 4 &&
                XMLHttpRequestObject.status == 200) {
                obj.innerHTML = XMLHttpRequestObject.responseText;
            }
        }
        XMLHttpRequestObject.send(null);
    }
}

