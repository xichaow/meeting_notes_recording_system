<!DOCTYPE html>
<meta charset="utf-8">
<title>Web Speech API Demo</title>
<style>
  * {
    font-family: Verdana, Arial, sans-serif;
  }
  a:link {
    color:#000;
    text-decoration: none;
  }
  a:visited {
    color:#000;
  }
  a:hover {
    color:#33F;
  }
  .button {
    background: -webkit-linear-gradient(top,#008dfd 0,#0370ea 100%);
    border: 1px solid #076bd2;
    border-radius: 3px;
    color: #fff;
    display: none;
    font-size: 13px;
    font-weight: bold;
    line-height: 1.3;
    padding: 8px 25px;
    text-align: center;
    text-shadow: 1px 1px 1px #076bd2;
    letter-spacing: normal;
  }
  .center {
    padding: 10px;
    text-align: center;
  }
  .final {
    color: black;
    padding-right: 3px; 
  }
  .interim {
    color: gray;
  }
  .info {
    font-size: 14px;
    text-align: center;
    color: #777;
    display: none;
  }
  .right {
    float: right;
  }
  .sidebyside {
    display: inline-block;
    width: 45%;
    min-height: 40px;
    text-align: left;
    vertical-align: top;
  }
  #headline {
    font-size: 40px;
    font-weight: 300;
  }
  #info {
    font-size: 20px;
    text-align: center;
    color: #777;
    visibility: hidden;
  }
  #results {
    font-size: 14px;
    font-weight: bold;
    border: 1px solid #ddd;
    padding: 15px;
    text-align: left;
    min-height: 150px;
  }
  #start_button {
    border: 0;
    background-color:transparent;
    padding: 0;
  }
</style>








<h1 class="center" id="headline"> Meeting Notes Recording System</h1>
<div id="info">
  <p id="info_start">Click on the microphone icon and begin speaking.</p>
  <p id="info_speak_now">Speak now.</p>
  <p id="info_no_speech">No speech was detected. You may need to adjust your
    <a href="//support.google.com/chrome/bin/answer.py?hl=en&amp;answer=1407892">
      microphone settings</a>.</p>
  <p id="info_no_microphone" style="display:none">
    No microphone was found. Ensure that a microphone is installed and that
    <a href="//support.google.com/chrome/bin/answer.py?hl=en&amp;answer=1407892">
    microphone settings</a> are configured correctly.</p>
  <p id="info_allow">Click the "Allow" button above to enable your microphone.</p>
  <p id="info_denied">Permission to use microphone was denied.</p>
  <p id="info_blocked">Permission to use microphone is blocked. To change,
    go to chrome://settings/contentExceptions#media-stream</p>
  <p id="info_upgrade">Web Speech API is not supported by this browser.
     Upgrade to <a href="//www.google.com/chrome">Chrome</a>
     version 25 or later.</p>
</div>
<div class="right">
  <button id="start_button" onclick="startButton(event)">
    <img id="start_img" src="mic.gif" alt="Start"></button>
</div>
<div id="results">
  <span id="final_span" class="final"></span>
  <span id="interim_span" class="interim"></span>
  <p>
</div>
<div class="center">
  <div class="sidebyside">
    <p id="demo" style="display:none"></p>
  </div>
  <p>
  <div id="div_language" style="display:none">
    <select id="select_language" onchange="updateCountry()"></select>
    &nbsp;&nbsp;
    <select id="select_dialect"></select>
  </div>
</div>
<body>
<div id="googleMap" style="width:500px;height:380px;left:450px;top: -65px;"></div>
</body>
<body>
    <div id="map-canvas" style="width:500px;height:380px;left:450px;margin-top: -450px;"></div>
</body>






<!--geolocation script-->
<script src="http://maps.googleapis.com/maps/api/js"></script>

<script>
var x = document.getElementById("demo");
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);

    } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}

function showPosition(position) {
    x.innerHTML = "Latitude: " + position.coords.latitude + 
    "<br>Longitude: " + position.coords.longitude;  

  var myCenter = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);


  var mapProp = {center:myCenter,
    zoom:17,
    mapTypeId:google.maps.MapTypeId.ROADMAP
    };

  var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
  var marker=new google.maps.Marker({
    position:myCenter,
  });

marker.setMap(map);
}

google.maps.event.addDomListener(window, 'load', initialize);
</script>







<!-- Original script-->
<script>
var langs =
[['Afrikaans',       ['af-ZA']],
 ['Bahasa Indonesia',['id-ID']],
 ['Bahasa Melayu',   ['ms-MY']],
 ['Català',          ['ca-ES']],
 ['Čeština',         ['cs-CZ']],
 ['Deutsch',         ['de-DE']],
 ['English',         ['en-AU', 'Australia'],
                     ['en-CA', 'Canada'],
                     ['en-IN', 'India'],
                     ['en-NZ', 'New Zealand'],
                     ['en-ZA', 'South Africa'],
                     ['en-GB', 'United Kingdom'],
                     ['en-US', 'United States']],
 ['Español',         ['es-AR', 'Argentina'],
                     ['es-BO', 'Bolivia'],
                     ['es-CL', 'Chile'],
                     ['es-CO', 'Colombia'],
                     ['es-CR', 'Costa Rica'],
                     ['es-EC', 'Ecuador'],
                     ['es-SV', 'El Salvador'],
                     ['es-ES', 'España'],
                     ['es-US', 'Estados Unidos'],
                     ['es-GT', 'Guatemala'],
                     ['es-HN', 'Honduras'],
                     ['es-MX', 'México'],
                     ['es-NI', 'Nicaragua'],
                     ['es-PA', 'Panamá'],
                     ['es-PY', 'Paraguay'],
                     ['es-PE', 'Perú'],
                     ['es-PR', 'Puerto Rico'],
                     ['es-DO', 'República Dominicana'],
                     ['es-UY', 'Uruguay'],
                     ['es-VE', 'Venezuela']],
 ['Euskara',         ['eu-ES']],
 ['Français',        ['fr-FR']],
 ['Galego',          ['gl-ES']],
 ['Hrvatski',        ['hr_HR']],
 ['IsiZulu',         ['zu-ZA']],
 ['Íslenska',        ['is-IS']],
 ['Italiano',        ['it-IT', 'Italia'],
                     ['it-CH', 'Svizzera']],
 ['Magyar',          ['hu-HU']],
 ['Nederlands',      ['nl-NL']],
 ['Norsk bokmål',    ['nb-NO']],
 ['Polski',          ['pl-PL']],
 ['Português',       ['pt-BR', 'Brasil'],
                     ['pt-PT', 'Portugal']],
 ['Română',          ['ro-RO']],
 ['Slovenčina',      ['sk-SK']],
 ['Suomi',           ['fi-FI']],
 ['Svenska',         ['sv-SE']],
 ['Türkçe',          ['tr-TR']],
 ['български',       ['bg-BG']],
 ['Pусский',         ['ru-RU']],
 ['Српски',          ['sr-RS']],
 ['한국어',            ['ko-KR']],
 ['中文',             ['cmn-Hans-CN', '普通话 (中国大陆)'],
                     ['cmn-Hans-HK', '普通话 (香港)'],
                     ['cmn-Hant-TW', '中文 (台灣)'],
                     ['yue-Hant-HK', '粵語 (香港)']],
 ['日本語',           ['ja-JP']],
 ['Lingua latīna',   ['la']]];
for (var i = 0; i < langs.length; i++) {
  select_language.options[i] = new Option(langs[i][0], i);
}
select_language.selectedIndex = 6;
updateCountry();
select_dialect.selectedIndex = 6;
showInfo('info_start');
function updateCountry() {
  for (var i = select_dialect.options.length - 1; i >= 0; i--) {
    select_dialect.remove(i);
  }
  var list = langs[select_language.selectedIndex];
  for (var i = 1; i < list.length; i++) {
    select_dialect.options.add(new Option(list[i][1], list[i][0]));
  }
  select_dialect.style.visibility = list[1].length == 1 ? 'hidden' : 'visible';
}

var create_email = false;
var final_transcript = '';
var recognizing = false;
var ignore_onend;
var start_timestamp;
var speakingStatus;





if (!('webkitSpeechRecognition' in window)) {
  upgrade();
} 
else {
	  start_button.style.display = 'inline-block';
	  var recognition = new webkitSpeechRecognition();

	  recognition.continuous = true;
	  recognition.interimResults = true;
	  recognition.onstart = function() {
	    recognizing = true;
	    showInfo('info_speak_now');
	    start_img.src = 'mic-animate.gif';
		
	  };
	  
    recognition.onerror = function(event) {
	    if (event.error == 'no-speech') {
	      start_img.src = 'mic.gif';
	      showInfo('info_no_speech');
	      ignore_onend = true;
	    }
	    if (event.error == 'audio-capture') {
	      start_img.src = 'mic.gif';
	      showInfo('info_no_microphone');
	      ignore_onend = true;
	    }
	    if (event.error == 'not-allowed') {
	      if (event.timeStamp - start_timestamp < 100) {
	        showInfo('info_blocked');
	      } else {
	        showInfo('info_denied');
	      }
	      ignore_onend = true;
	    }
	  };
	  
    recognition.onend = function() {
	    recognizing = false;
	    if (ignore_onend) {
	      return;
	    }
	    start_img.src = 'mic.gif';
	    if (!final_transcript) {
	      showInfo('info_start');
	      return;
	    }
	    showInfo('');
	    if (window.getSelection) {
	      window.getSelection().removeAllRanges();
	      var range = document.createRange();
	      range.selectNode(document.getElementById('final_span'));
	      window.getSelection().addRange(range);
	    }
	    if (create_email) {
	      create_email = false;
	      createEmail();
	    }
	  };
	  
    recognition.onresult = function(event) {
	    var interim_transcript = '';
	    for (var i = event.resultIndex; i < event.results.length; ++i) {
	      if (event.results[i].isFinal) {
	        final_transcript = event.results[i][0].transcript;

			texttospeech(final_transcript);

			speakingStatus = "stopped";
			
	      } else {
	        interim_transcript = event.results[i][0].transcript;
	      }
	    }
	    final_transcript = capitalize(final_transcript);
	    final_span.innerHTML = linebreak(final_transcript);
	    interim_span.innerHTML = linebreak(interim_transcript);
	    if (final_transcript || interim_transcript) {
	      showButtons('inline-block');
	    }
	  };
}


function upgrade() {
  start_button.style.visibility = 'hidden';
  showInfo('info_upgrade');
}
var two_line = /\n\n/g;
var one_line = /\n/g;
function linebreak(s) {
  return s.replace(two_line, '<p></p>').replace(one_line, '<br>');
}
var first_char = /\S/;
function capitalize(s) {
  return s.replace(first_char, function(m) { return m.toUpperCase(); });
}
function createEmail() {
  var n = final_transcript.indexOf('\n');
  if (n < 0 || n >= 80) {
    n = 40 + final_transcript.substring(40).indexOf(' ');
  }
  var subject = encodeURI(final_transcript.substring(0, n));
  var body = encodeURI(final_transcript.substring(n + 1));
  window.location.href = 'mailto:?subject=' + subject + '&body=' + body;
}
function copyButton() {
  if (recognizing) {
    recognizing = false;
    recognition.stop();
  }
  copy_button.style.display = 'none';
  copy_info.style.display = 'inline-block';
  showInfo('');
}
function emailButton() {
  if (recognizing) {
    create_email = true;
    recognizing = false;
    recognition.stop();
  } else {
    createEmail();
  }
  email_button.style.display = 'none';
  email_info.style.display = 'inline-block';
  showInfo('');
}
function startButton(event) {

	speakingStatus = "stopped";
  if (recognizing) {
    recognition.stop();
    return;
  }
  final_transcript = '';
  recognition.lang = select_dialect.value;
  recognition.start();
  ignore_onend = false;
  final_span.innerHTML = '';
  interim_span.innerHTML = '';
  start_img.src = 'mic-slash.gif';
  showInfo('info_allow');
  showButtons('none');
  start_timestamp = event.timeStamp;
}
function showInfo(s) {
  if (s) {
    for (var child = info.firstChild; child; child = child.nextSibling) {
      if (child.style) {
        child.style.display = child.id == s ? 'inline' : 'none';
      }
    }
    info.style.visibility = 'visible';
  } else {
    info.style.visibility = 'hidden';
  }
}
var current_style;
function showButtons(style) {
  if (style == current_style) {
    return;
  }
  current_style = style;
  copy_button.style.display = style;
  email_button.style.display = style;
  copy_info.style.display = 'none';
  email_info.style.display = 'none';
}

//Function for post tag to identify keywords recording.
var dialogpp;
var sentiment_result;
var aText_extra;
var aText_tree;
aText_extra=0;
aText_tree=0;
function getrecord(dialog)
        {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("GET","405_syntax.php?y1="+dialog,false);
            xmlhttp.send(null);
            dialogpp=xmlhttp.responseText;
        }
// function for sentiment analysis
function getsentiment(dialog)
        {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("GET","senti_php/examples/demo1.php?y1="+dialog,false);
            xmlhttp.send(null);
            sentiment_result=xmlhttp.responseText;
        }
// function for main conversation
function texttospeech(dialog){
    voices = window.speechSynthesis.getVoices();
    console.log('Get voices ' + voices.length.toString());
    for(var i = 0; i < voices.length; i++ ) {
         console.log("Voice " + i.toString() + ' ' + voices[i].name);
       }
     
	   var aText ="Sorry, Larry. I don't get what you said";
     getsentiment(dialog);
     if(aText_extra==1){
         if(sentiment_result=="pos"){
           aText="Thanks for the meeting. I will send those meeting notes";
           aText_extra=0;
         }
         else{
           aText="Could you please provide more feedbacks. Thanks.";
           aText_extra=0;
         }
       }
     if(aText_tree==1){
       if(dialog=="yes"){
         aText="This meeting will be difficult. You should fully prepare for it.";
         aText_tree=0;
       }
       else{
         aText="will you meet a new customer?";
         aText_tree=2;
       }
      } 
     else if(aText_tree==2){
       if(dialog=="yes"){
         aText="This meeting will be difficult. You should fully prepare for it.";
         aText_tree=0;
       }
       else{
         aText="it will be an easy meeting.";
         aText_tree=0;
       }
      }
     else{
         getrecord(dialog);
         if(dialogpp=="recording"){
          aText="What is the customer name you want to make recording for?"
         }
         else{
        	   if(dialog=="hello")
        	   {
        	   		aText="Hello Larry";
               }
        	   else if(dialog=="how are you")
        	   {
        			aText="Good Thanks, how about you?";
          	 	}
          	 else if(dialog=="how about this meeting")
          		{
          			aText="is this meeting an urgent request from customer?";
                aText_tree = 1;
          		}
          	 else if(dialog=="goodbye")
          		{
          			aText="See you later";
          		}
              else if(dialog=="record")
              {
                aText="Can you advice customer name?";
              }
              else if(dialog.indexOf('location')!=-1){
                aText="let me show your location";
                getLocation();
              }
              else if(dialog.indexOf('finish')!=-1){
                aText="What do you think of this meeting?";
                aText_extra = 1;
              }
              else if(dialog.indexOf('park')!=-1||dialog.indexOf('parking')!=-1){
                aText="let me show you nearby parking";
                showparking();
              }
          }
	     }
	 	var u1 = new SpeechSynthesisUtterance(aText);
       	u1.lang = 'en-US';
       	u1.pitch = 1;
       	u1.rate = 1;
       	u1.voiceURI = 'native';
       	u1.volume = 1;
		
		
		//if the computer is responding, the system stops recognising speech.
		u1.onstart = function(){

			recognition.stop();
			reset();
		}
		//if the computer finishes responding, the system restarts recognising speech.
		u1.onend = function(event) {
			recognition.start();
			recognizing = true;
		 }
		
       	speechSynthesis.speak(u1);
       	console.log("Voice " + u1.voice.name);
     
}
</script>


<!-- Place_api to get nearby parking informaiton-->
<!DOCTYPE html>
<html>
  <head>
    <title>Place searches</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      html, body, #map-canvas {
        height: 100%;
        margin: 0px;
        padding: 0px
      }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
    <script>
var map;
var infowindow;

        function showparking() {
          var city = new google.maps.LatLng(-42.882391,147.328591);

          map = new google.maps.Map(document.getElementById('map-canvas'), {
            center: city,
            zoom: 15
          });

          var request = {
            location: city,
            radius: 1000,
            types: ['parking']
          };
         infowindow = new google.maps.InfoWindow();
          var service = new google.maps.places.PlacesService(map);
          service.nearbySearch(request, callback);
        }

        function callback(results, status) {
          if (status == google.maps.places.PlacesServiceStatus.OK) {
            for (var i = 0; i < results.length; i++) {
            createMarker(results[i]);
            }
          }
        }

        function createMarker(place) {
          var placeLoc = place.geometry.location;
          var marker = new google.maps.Marker({
            map: map,
            position: place.geometry.location
          });

          google.maps.event.addListener(marker, 'click', function() {
            infowindow.setContent(place.name);
            infowindow.open(map, this);
          });
        }


        google.maps.event.addDomListener(window, 'load', initialize);

    </script>
  </head>
</html>