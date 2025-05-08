function googleTranslateElementInit() {
   new google.translate.TranslateElement({pageLanguage: 'id'}, 'google_translate_element');
}
function triggerHtmlEvent(element, eventName) {
   var event;
   if (document.createEvent) {
     event = document.createEvent('HTMLEvents');
     event.initEvent(eventName, true, true);
     element.dispatchEvent(event);
   } else {
     event = document.createEventObject();
     event.eventType = eventName;
     element.fireEvent('on' + event.eventType, event);
   }
}
function resetLang() {
  var iframe = document.getElementsByClassName('hidden-bar-wrapper')[0];
  if(!iframe) return;

  var innerDoc = iframe.contentDocument || iframe.contentWindow.document;
  var restore_el = innerDoc.getElementsByTagName("button");

  for(var i = 0; i < restore_el.length; i++){
    if(restore_el[i].id.indexOf("restore") >= 0) {
      restore_el[i].click();
      var close_el = innerDoc.getElementsByClassName("goog-close-link");
      close_el[0].click();
      return;
    }
  }
}
function readCookie(name) {
    var c = document.cookie.split('; '),
    cookies = {}, i, C;

    for (i = c.length - 1; i >= 0; i--) {
        C = c[i].split('=');
        cookies[C[0]] = C[1];
     }

     return cookies[name];
}

$(document).ready(function(){
	$(".lang-select").click(function(){
    	var theLang = $(this).attr('data-lang'); 
		if(theLang=="id") resetLang();
		else {
	 		var gObj = $(".goog-te-combo");
     		var db = gObj.get(0);
     		gObj.val(theLang);
     		triggerHtmlEvent(db,"change");
		}
		$(".lang-select img").css("opacity","0.4");
		$(this).find("img").css("opacity","1");
	});

	var lang = readCookie('googtrans');
	if(""+lang!="undefined") {
		$(".lang-select").each(function() {
			if(lang.indexOf($(this).attr('data-lang'))>=0) {
				$(".lang-select img").css("opacity","0.4");
				$(this).find("img").css("opacity","1");
			}
		});
	}

});
