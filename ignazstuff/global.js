function get_obj_request() 
{
  try{var rq = new XMLHttpRequest();}
  catch (e)
  {
    var classnames = ['MSXML2.XMLHTTP', 'Microsoft.XMLHTTP'];
    for(var i in classnames)
    try{rq = new ActiveXObject(classnames[i]); break; } 
    catch (e) 
    {alert("Fehler bei der Erzeugung des Request-Objektes");}
  }
  if(rq)return rq; 
  else return false; 
}

// Sendet Werte an den Server, zwecks Speicherung
function get_save(obj) 
{
  var typ = obj.name;
  var value = obj.value; 
  var request = get_obj_request();

  obj.style.border="2px solid transparent"; 

  request.open("post", "../function/get_save.php", true);
  request.onreadystatechange = function() 
  {
    if(request.readyState == 4) 
	{ 
	  var txt = request.responseText; 
	  if(txt != "false")
	  {
		//alert('Daten gespeichert!'+"\n"+txt);
	  }
	  else
	  {
	    // Fehlermeldung
	  }
    }
  }
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');  
  request.send("typ="+typ+"&value="+value);
}

function set_focus(obj)
{
  obj.style.border = "2px solid red"; 
}