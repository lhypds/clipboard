if(/AppleWebKit.*Mobile/i.test(navigator.userAgent) || (/MIDP|SymbianOS|NOKIA|SAMSUNG|LG|NEC|TCL|Alcatel|BIRD|DBTEL|Dopod|PHILIPS|HAIER|LENOVO|MOT-|Nokia|SonyEricsson|SIE-|Amoi|ZTE/.test(navigator.userAgent)))
{
	if(window.location.href.indexOf("?mobile")<0)
	{ 
		try
		{
			if(/Android|webOS|iPhone|iPod|BlackBerry/i.test(navigator.userAgent))
			{ 
				setActiveStyleSheet("mobile.css");
			}
			else if(/iPad/i.test(navigator.userAgent))
			{ 
				setActiveStyleSheet("mobile-pad.css");
			}
			else
			{
				setActiveStyleSheet("style.css");
			} 
		}
		catch(e){}
	} 
}
else
{ 
	setActiveStyleSheet("style.css");
}
function setActiveStyleSheet(filename)
{
	document.write("<link href="+filename+" rel=stylesheet>");
}