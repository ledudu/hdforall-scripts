#!/usr/local/bin/Resource/www/cgi-bin/php
<?php echo "<?xml version='1.0' encoding='UTF8' ?>";
error_reporting(0);
$host = "http://127.0.0.1/cgi-bin";
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start);
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini;
	return substr($string,$ini,$len);
}
?>
<rss version="2.0">
<onEnter>
  startitem = "middle";
  setRefreshTime(1);
  storagePath = getStoragePath("tmp");
  storagePath_stream = storagePath + "stream.dat";
</onEnter>

<onRefresh>
  setRefreshTime(-1);
  itemCount = getPageInfo("itemCount");
</onRefresh>
<mediaDisplay name="threePartsView"
	sideLeftWidthPC="0"
	sideRightWidthPC="0"

	headerImageWidthPC="0"
	selectMenuOnRight="no"
	autoSelectMenu="no"
	autoSelectItem="no"
	itemImageHeightPC="0"
	itemImageWidthPC="0"
	itemXPC="8"
	itemYPC="25"
	itemWidthPC="20"
	itemHeightPC="8"
	capXPC="8"
	capYPC="25"
	capWidthPC="20"
	capHeightPC="64"
	itemBackgroundColor="0:0:0"
	itemPerPage="8"
  itemGap="0"
	bottomYPC="90"
	backgroundColor="0:0:0"
	showHeader="no"
	showDefaultInfo="no"
	imageFocus=""
	sliding="no"
	idleImageXPC="5" idleImageYPC="5" idleImageWidthPC="8" idleImageHeightPC="10"
>

  	<text align="center" offsetXPC="0" offsetYPC="0" widthPC="100" heightPC="20" fontSize="30" backgroundColor="10:105:150" foregroundColor="100:200:255">
		  <script>getPageInfo("pageTitle");</script>
		</text>
  	<text align="left" offsetXPC="6" offsetYPC="15" widthPC="70" heightPC="4" fontSize="16" backgroundColor="10:105:150" foregroundColor="100:200:255">
    1=modifica aspect, dreapta pentru program...
		</text>
  	<text redraw="yes" offsetXPC="85" offsetYPC="12" widthPC="10" heightPC="6" fontSize="20" backgroundColor="10:105:150" foregroundColor="60:160:205">
		  <script>sprintf("%s / ", focus-(-1))+itemCount;</script>
		</text>
		<text align="left" redraw="yes"
          lines="20" fontSize=15
		      offsetXPC=30 offsetYPC=25 widthPC=70 heightPC=75
		      backgroundColor=0:0:0 foregroundColor=200:200:200>
              <script>print(annotation); annotation;</script>
		</text>
        <idleImage>image/POPUP_LOADING_01.png</idleImage>
        <idleImage>image/POPUP_LOADING_02.png</idleImage>
        <idleImage>image/POPUP_LOADING_03.png</idleImage>
        <idleImage>image/POPUP_LOADING_04.png</idleImage>
        <idleImage>image/POPUP_LOADING_05.png</idleImage>
        <idleImage>image/POPUP_LOADING_06.png</idleImage>
        <idleImage>image/POPUP_LOADING_07.png</idleImage>
        <idleImage>image/POPUP_LOADING_08.png</idleImage>

		<itemDisplay>
			<text align="left" lines="1" offsetXPC=0 offsetYPC=0 widthPC=100 heightPC=100>
				<script>
					idx = getQueryItemIndex();
					focus = getFocusItemIndex();
					if(focus==idx)
					{
					  adn = getItemInfo(idx, "adn");
					}
					getItemInfo(idx, "title");
				</script>
				<fontSize>
  				<script>
  					idx = getQueryItemIndex();
  					focus = getFocusItemIndex();
  			    if(focus==idx) "14"; else "14";
  				</script>
				</fontSize>
			  <backgroundColor>
  				<script>
  					idx = getQueryItemIndex();
  					focus = getFocusItemIndex();
  			    if(focus==idx) "10:80:120"; else "-1:-1:-1";
  				</script>
			  </backgroundColor>
			  <foregroundColor>
  				<script>
  					idx = getQueryItemIndex();
  					focus = getFocusItemIndex();
  			    if(focus==idx) "255:255:255"; else "140:140:140";
  				</script>
			  </foregroundColor>
			</text>

		</itemDisplay>

<onUserInput>
<script>
ret = "false";
userInput = currentUserInput();

if (userInput == "pagedown" || userInput == "pageup")
{
  idx = Integer(getFocusItemIndex());
  if (userInput == "pagedown")
  {
    idx -= -8;
    if(idx &gt;= itemCount)
      idx = itemCount-1;
  }
  else
  {
    idx -= 8;
    if(idx &lt; 0)
      idx = 0;
  }

  print("new idx: "+idx);
  setFocusItemIndex(idx);
	setItemFocus(0);
  "true";
}
else if(userInput == "right" || userInput == "R")
{
showIdle();
idx = Integer(getFocusItemIndex());
url_canal = "http://127.0.0.1/cgi-bin/scripts/tv/php/dolce_prog.php?file=" + getItemInfo(idx,"id");
annotation = getURL(url_canal);
cancelIdle();
redrawDisplay();
ret = "true";
}
else
{
annotation = " ";
ret = "false";
}
redrawDisplay();
ret;
</script>
</onUserInput>

	</mediaDisplay>

	<item_template>
		<mediaDisplay  name="threePartsView" idleImageXPC="5" idleImageYPC="5" idleImageWidthPC="8" idleImageHeightPC="10">
        <idleImage>image/POPUP_LOADING_01.png</idleImage>
        <idleImage>image/POPUP_LOADING_02.png</idleImage>
        <idleImage>image/POPUP_LOADING_03.png</idleImage>
        <idleImage>image/POPUP_LOADING_04.png</idleImage>
        <idleImage>image/POPUP_LOADING_05.png</idleImage>
        <idleImage>image/POPUP_LOADING_06.png</idleImage>
        <idleImage>image/POPUP_LOADING_07.png</idleImage>
        <idleImage>image/POPUP_LOADING_08.png</idleImage>
		</mediaDisplay>
	</item_template>
<channel>
  <title>TV Romania</title>
<?php
function print_a($title,$l) {
    $host = "http://127.0.0.1/cgi-bin";
    $link = $host.'/scripts/tv/php/aplay_link.php?file='.urlencode($l);
	echo'
	<item>
	<title>'.$title.'</title>
    <onClick>
    <script>
    showIdle();
    url="'.$link.'";
    movie=getUrl(url);
    cancelIdle();
    if (movie == "" || movie == " " || movie == null)
    {
    playItemUrl(-1,1);
    }
    else
    {
    storagePath = getStoragePath("tmp");
    storagePath_stream = storagePath + "stream.dat";
    streamArray = null;
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, video/x-flv);
    streamArray = pushBackStringArray(streamArray, "'.str_replace('"',"'",$title).'");
    streamArray = pushBackStringArray(streamArray, "1");
    writeStringToFile(storagePath_stream, streamArray);
    doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer_tv1.rss");
    }
    </script>
    </onClick>
    <location>'.$title.'</location>
    <annotation>'.$title.'</annotation>
    <mediaDisplay name="threePartsView"/>
	</item>
	';
}
function print_t($title,$l) {
    $host = "http://127.0.0.1/cgi-bin";
    $link = $host.'/scripts/tv/php/telekom_link.php?file='.urlencode($l);
	echo'
	<item>
	<title>'.$title.'</title>
    <onClick>
    <script>
    showIdle();
    url="'.$link.'";
    movie=getUrl(url);
    cancelIdle();
    if (movie == "" || movie == " " || movie == null)
    {
    playItemUrl(-1,1);
    }
    else
    {
    storagePath = getStoragePath("tmp");
    storagePath_stream = storagePath + "stream.dat";
    streamArray = null;
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, video/x-flv);
    streamArray = pushBackStringArray(streamArray, "'.str_replace('"',"'",$title).'");
    streamArray = pushBackStringArray(streamArray, "1");
    writeStringToFile(storagePath_stream, streamArray);
    doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer_tv1.rss");
    }
    </script>
    </onClick>
    <location>'.$title.'</location>
    <annotation>'.$title.'</annotation>
    <mediaDisplay name="threePartsView"/>
	</item>
	';
}
function print_pro($title,$l) {
    $host = "http://127.0.0.1/cgi-bin";
    $link = $host.'/scripts/tv/php/protvmd_link.php?file='.urlencode($l);
	echo'
	<item>
	<title>'.$title.'</title>
    <onClick>
    <script>
    showIdle();
    url="'.$link.'";
    movie=getUrl(url);
    cancelIdle();
    if (movie == "" || movie == " " || movie == null)
    {
    playItemUrl(-1,1);
    }
    else
    {
    storagePath = getStoragePath("tmp");
    storagePath_stream = storagePath + "stream.dat";
    streamArray = null;
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, video/x-flv);
    streamArray = pushBackStringArray(streamArray, "'.str_replace('"',"'",$title).'");
    streamArray = pushBackStringArray(streamArray, "1");
    writeStringToFile(storagePath_stream, streamArray);
    doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer_tv1.rss");
    }
    </script>
    </onClick>
    <location>'.$title.'</location>
    <annotation>'.$title.'</annotation>
    <mediaDisplay name="threePartsView"/>
	</item>
	';
}
function print_c($title,$l) {
    $host = "http://127.0.0.1/cgi-bin";
    $link = $host.'/scripts/util/m3u8.php?file='.urlencode($l);
	echo'
	<item>
	<title>'.$title.'</title>
    <onClick>
    <script>
    showIdle();
    movie="'.$link.'";
    cancelIdle();
    storagePath = getStoragePath("tmp");
    storagePath_stream = storagePath + "stream.dat";
    streamArray = null;
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, video/x-flv);
    streamArray = pushBackStringArray(streamArray, "'.str_replace('"',"'",$title).'");
    streamArray = pushBackStringArray(streamArray, "1");
    writeStringToFile(storagePath_stream, streamArray);
    doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer_tv1.rss");
    </script>
    </onClick>
    <location>'.$title.'</location>
    <annotation>'.$title.'</annotation>
    <mediaDisplay name="threePartsView"/>
	</item>
	';
}
function print_tvr($title,$l) {
    $host = "http://127.0.0.1/cgi-bin";
    $link = $host.'/scripts/util/m3u8.php?file='.urlencode($l);
	echo'
	<item>
	<title>'.$title.'</title>
    <onClick>
    <script>
    showIdle();
    movie="'.$link.'";
    cancelIdle();
    storagePath = getStoragePath("tmp");
    storagePath_stream = storagePath + "stream.dat";
    streamArray = null;
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, video/x-flv);
    streamArray = pushBackStringArray(streamArray, "'.str_replace('"',"'",$title).'");
    streamArray = pushBackStringArray(streamArray, "1");
    writeStringToFile(storagePath_stream, streamArray);
    doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer_tv1.rss");
    </script>
    </onClick>
    <location>'.$title.'</location>
    <annotation>'.$title.'</annotation>
    <mediaDisplay name="threePartsView"/>
	</item>
	';
}
function print_ch($title,$link,$id) {
if (!preg_match("/(<\/?)(\w+)([^>]*>)/e",$title) && !preg_match("/\.xxx|\.htm/",$link)) {
  echo '
     <item>
     <title>'.$title.'</title>
     <onClick>
     <script>
     showIdle();
     movie="'.$link.'";
     cancelIdle();
    streamArray = null;
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, video/mp4);
    streamArray = pushBackStringArray(streamArray, "'.$title.'");
    streamArray = pushBackStringArray(streamArray, "1");
    writeStringToFile(storagePath_stream, streamArray);
    doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer_tv1.rss");
     </script>
     </onClick>
     <id>'.$id.'</id>
     </item>
     ';
}
}
function print_ch1($title,$link,$id) {
//if (!preg_match("/(<\/?)(\w+)([^>]*>)/e",$title) && !preg_match("/\.xxx|\.htm/",$link)) {
  echo '
     <item>
     <title>'.$title.'</title>
     <onClick>
     <script>
     showIdle();
     url="'.$link.'";
     movie=getUrl(url);
     cancelIdle();
    streamArray = null;
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, video/mp4);
    streamArray = pushBackStringArray(streamArray, "'.$title.'");
    streamArray = pushBackStringArray(streamArray, "1");
    writeStringToFile(storagePath_stream, streamArray);
    doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer_tv1.rss");
     </script>
     </onClick>
     <id>'.$id.'</id>
     </item>
     ';
//}
}
$a["Antena 1"]="10017";
$a["Antena 2"]="10119";
$a["Antena 3"]="10055";
$a["B1 Tv"]="10022";
$a["BBC News"]="10100";
$a["Bloomberg"]="10195";
$a["CNN"]="10115";
$a["CT24"]="";
$a["Cartoon Network"]="10053";
$a["Credo TV"]="10223";
$a["Discovery"]="10020";
$a["Diva"]="10027";
$a["DocQ Klub"]="";
$a["ERT World"]="";
$a["Etno TV"]="10037";
$a["Euforia Lifestyle"]="10063";
$a["Euro TV"]="";
$a["Euronews"]="10113";
$a["Fashion TV"]="10078";
$a["Fishing&Hunting"]="";
$a["GSP TV"]="10155";
$a["Jurnal TV"]="";
$a["Karma TV"]="";
$a["Kiss TV"]="10008";
$a["Megamax"]="10268";
$a["Minimax"]="10023";
$a["Money Channel"]="";
$a["Money Ro"]="10076";
$a["Mooz Dance"]="10275";
$a["Music 1 Channel"]="10158";
$a["Muz TV"]="";
$a["Mynele TV"]="10206";
$a["N24 Plus"]="10048";
$a["NBT"]="";
$a["NHK World"]="";
$a["Nasul TV"]="10256";
$a["National TV"]="";
$a["OTV"]="";
$a["Prima TV"]="10005";
$a["Publika TV"]="";
$a["RTV"]="10245";
$a["Realitatea TV"]="10019";
$a["Ru TV"]="";
$a["TV Sud Est"]="10250";
$a["TV5 Europe"]="";
$a["TV5 Monde"]="";
$a["TVR 1"]="10001";
$a["TVR 2"]="10002";
$a["Taraf TV"]="10101";
$a["Transilvania L!VE"]="10217";
$a["PRO TV"]="100007";
$a["PRO CINEMA"]="10036";
$a["ACASA"]="10004";
$a["Kanal D"]="10097";
$a["Animal Planet"]="10021";
$a["Sport.ro"]="10032";
$a["Disney Channel"]="10018";
$a["CBS Reality"]="10050";
$a["FILM"]="";
$a["RTL Plus"]="";
$a["LOOK TV"]="10252";
$a["FilmBox"]="10236";
$a["FilmBox HD"]="10239";
/*
$l="http://tastez.ro/tv.php?query=norma-telecom";
   $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL, $l);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_REFERER, $l);
   $h = curl_exec($ch);
   curl_close($ch);
$videos = explode('div class="line"', $h);

unset($videos[0]);
$videos = array_values($videos);

foreach($videos as $video) {
  $t0=explode('href="',$video);
  $t1=explode('"',$t0[1]);
  $link=$t1[0];
  $title=str_between($video,"<b>","</b>");
  if (strpos($link,"rtmp") !== false)
    $link="http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,,".$link;
  if (strpos($link,"mms") !== false || strpos($link,".m3u") !== false)
    $link="http://127.0.0.1/cgi-bin/translate?stream,,".$link;
  if (strpos($link,"m3u8") === false && $link)
  print_ch($title,$link,$a[$title]);
}
*/
/*
$l="http://tastez.ro/tv.php?query=altele";

   $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL, $l);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_REFERER, $l);
   $h = curl_exec($ch);
   curl_close($ch);
$videos = explode('div class="line"', $h);

unset($videos[0]);
$videos = array_values($videos);

foreach($videos as $video) {
  $t0=explode('href="',$video);
  $t1=explode('"',$t0[1]);
  $link=$t1[0];
  $title=str_between($video,"<b>","</b>");
  if (strpos($link,"rtmp") !== false)
    $link="http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,,".$link;
  if (strpos($link,"mms") !== false || strpos($link,".m3u") !== false)
    $link="http://127.0.0.1/cgi-bin/translate?stream,,".$link;
  if (strpos($link,"m3u8") === false && $link)
  print_ch($title,$link,$a[$title]);
}
*/
/*
$l="http://tastez.ro/tv.php?query=regional";
   $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL, $l);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
   curl_setopt($ch, CURLOPT_REFERER, $l);
   $h = curl_exec($ch);
   curl_close($ch);
$videos = explode('div class="line"', $h);

unset($videos[0]);
$videos = array_values($videos);

foreach($videos as $video) {
  $t0=explode('href="',$video);
  $t1=explode('"',$t0[1]);
  $link=$t1[0];
  $title=str_between($video,"<b>","</b>");
  if (strpos($link,"rtmp") !== false)
    $link="http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,,".$link;
  if (strpos($link,"mms") !== false || strpos($link,".m3u") !== false)
    $link="http://127.0.0.1/cgi-bin/translate?stream,,".$link;
  if (strpos($link,"m3u8") === false && $link)
  print_ch($title,$link,$a[$title]);
}
*/
//print_ch("Test (wget)", "http://127.0.0.1/cgi-bin/scripts/w.cgi",$a["Test"]);
//print_ch("Test (php)", "http://127.0.0.1/cgi-bin/scripts/spyce.php?file=55.m3u8",$a["Test"]);
print_c("ProTV","http://stream1.protv.ro/news/stream:1.stream/playlist.m3u8");
print_c("ProTV Chisinau","http://hls.protv.md/hls/protv.m3u8");
print_c("DIGI24","http://82.76.40.81:80/digi24edge/digi24hdhqhls/index.m3u8");
print_c("10 TV","http://cachero.privesc.eu/10tv/myStream/playlist.m3u8");
print_c("Iasi TV Life","http://webmobile.xdev.ro:81/tv24/playlist.m3u8");
print_c("10 TV","http://cdnworld.magictvbox.eu/10TV_HD/index.m3u8?token=token");
print_ch("TVR Moldova", "http://37.233.27.53:8883");
print_c("TVR Moldova","http://cdnworld.magictvbox.eu/TVR/index.m3u8?token=token");
//print_c("Look TV","http://xtream.swiftiptv.com:6500/live/q0z01FyoIg/YlNLLYkecl/13407.m3u8");
//print_pro("DIGI24","http://82.76.40.81:80/digi24edge/digi24hdhqhls/index.m3u8");
print_ch("Moldova 1", "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,,rtmp://212.0.209.209:1935/live/MoldovaUnu1",$a["Moldova 1"]);
print_ch("Moldova 2", "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,,rtmp://live.trm.md:1935/live/mp4:MoldovaDoi2",$a["Moldova 2"]);
print_ch("10TV", "http://127.0.0.1/cgi-bin/scripts/util/translate.cgi?stream,,rtmp://ro.privesc.eu/10tv/myStream",$a["10TV"]);
print_ch("InfoPescar","http://127.0.0.1/cgi-bin/scripts/util/m3u8yt.php?file=".urlencode("https://www.youtube.com/watch?v=CHjvl5ncZFc"));
print_ch("Prahova TV", "http://127.0.0.1/cgi-bin/translate?stream,Rtmp-options:-W%20http://www.prahovatv.ro/player/player.swf%20-T%206c69766568642e747620657374652063656c206d616920746172652121%20http://www.infopescar.tv/yyy/player.swf%20-p%20http://www.prahovatv.ro/,rtmp://89.45.186.26:1935/live/prahovatv",$a["Prahova TV"]);
print_ch("Jurnal TV", "http://flux.jtv.md/jtv-540p.flv",$a["Jurnal TV"]);
print_ch("TvM", "http://tvm.ambra.ro",$a["TvM"]);
print_c("TV8","http://cdnworld.magictvbox.eu/TV7/index.m3u8?token=token");
print_c("TVR1","http://main.web.xn--8oux7cpmf3du51f21q.xn--3ds443g:25461/live/1BHM5-W/53286/1.m3u8");
print_c("TVR HD","http://main.web.xn--8oux7cpmf3du51f21q.xn--3ds443g:25461/live/1BHM5-W/53286/190.m3u8");

//print_pro("B1","http://dgf.icx.ro/digiedge2/b1tvehq/index.m3u8?is=29&src=digi-online.ro&t=00000000000000000000000000000000");

/*
$f="http://mxcore.forithost.com/alltvn.m3u";
$m3uFile = file($f);
foreach($m3uFile as $key => $line) {
  if(strtoupper(substr($line, 0, 7)) === "#EXTINF") {
   $t1=explode(",",$line);
   $title=trim($t1[1]);
   //$title1=$title;
   $link = trim($m3uFile[$key + 1]);
   $arr[]=array($title, $link);

}
}
asort($arr);
foreach ($arr as $key => $val) {
  $link="http://127.0.0.1/cgi-bin/scripts/spyce.php?file=".$arr[$key][1];
  $title1=$arr[$key][0];
  print_ch1($title1,$link);
}
*/
/*
$f="http://mxcore.forithost.com/aplay.m3u";
$m3uFile = file($f);
foreach($m3uFile as $key => $line) {
  if(strtoupper(substr($line, 0, 7)) === "#EXTINF") {
   $t1=explode(",",$line);
   $title=trim($t1[1]);
   //$title1=$title;
   $link = trim($m3uFile[$key + 1]);
   print_a($title,$link);
   $l="http://127.0.0.1/cgi-bin/scripts/tv/php/aplay1_link.php?file=".urlencode($link);
   print_ch1($title." (HQ)",$l);
}
}
*/
/*
$f="http://hd4all.ml/d/voyo.m3u";
$html = file_get_contents("http://hd4all.ml/d/vtok.php");
$id_t = str_between($html,'##','##' );
   $id_t =str_replace("\/","/",$id_t);
   $l1="".urldecode($id_t)."";
   $token = base64_decode($l1);
$m3uFile = file($f);
foreach($m3uFile as $key => $line) {
  if(strtoupper(substr($line, 0, 7)) === "#EXTINF") {
   $t1=explode(",",$line);
   $title=trim($t1[1]);
   //$title1=$title;
   $link = trim($m3uFile[$key + 1])."?".$token;
   print_c($title,$link);
}
}
*/
/*
$f="/usr/local/etc/dvdplayer/Telekom.m3u";
//$f="D:\EasyPHP\data\localweb\scripts1\digi.m3u";
if (file_exists($f)) {
$m3uFile = file($f);
foreach($m3uFile as $key => $line) {
  if(strtoupper(substr($line, 0, 7)) === "#EXTINF") {
   $t1=explode(",",$line);
   $title=trim($t1[1]);
   //$title1=$title;
   $link = trim($m3uFile[$key + 1]);
   print_t($title,$link);
}
}
}

$f="/usr/local/etc/dvdplayer/digi.m3u";
//$f="D:\EasyPHP\data\localweb\scripts1\digi.m3u";
if (file_exists($f)) {
$m3uFile = file($f);
foreach($m3uFile as $key => $line) {
  if(strtoupper(substr($line, 0, 7)) === "#EXTINF") {
   $t1=explode(",",$line);
   $title=trim($t1[1]);
   //$title1=$title;
   $link = trim($m3uFile[$key + 1]);
   print_c($title,$link);
}
}
}
*/


?>
<item>
	<title>Antena 1</title>
    <onClick>
    <script>
    showIdle();
    url="http://127.0.0.1/cgi-bin/scripts/tv/php/aplay_link.php?file=https%3A%2F%2Fivm.antenaplay.ro%2Flive%2Fa1%2Fplaylist.m3u8";
    movie=getUrl(url);
    cancelIdle();
    if (movie == "" || movie == " " || movie == null)
    {
    playItemUrl(-1,1);
    }
    else
    {
    storagePath = getStoragePath("tmp");
    storagePath_stream = storagePath + "stream.dat";
    streamArray = null;
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, video/x-flv);
    streamArray = pushBackStringArray(streamArray, "Antena 1");
    streamArray = pushBackStringArray(streamArray, "1");
    writeStringToFile(storagePath_stream, streamArray);
    doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer_tv1.rss");
    }
    </script>
    </onClick>
    <location>Antena 1</location>
    <annotation>Antena 1</annotation>
    <mediaDisplay name="threePartsView"/>
	</item>

     <item>
     <title>Antena 1 (HQ)</title>
     <onClick>
     <script>
     showIdle();
     url="http://127.0.0.1/cgi-bin/scripts/tv/php/aplay1_link.php?file=https%3A%2F%2Fivm.antenaplay.ro%2Flive%2Fa1%2Fplaylist.m3u8";
     movie=getUrl(url);
     cancelIdle();
    streamArray = null;
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, video/mp4);
    streamArray = pushBackStringArray(streamArray, "Antena 1 (HQ)");
    streamArray = pushBackStringArray(streamArray, "1");
    writeStringToFile(storagePath_stream, streamArray);
    doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer_tv1.rss");
     </script>
     </onClick>
     <id></id>
     </item>

	<item>
	<title>Antena Stars</title>
    <onClick>
    <script>
    showIdle();
    url="http://127.0.0.1/cgi-bin/scripts/tv/php/aplay_link.php?file=https%3A%2F%2Fivm.antenaplay.ro%2Flive%2Fastars%2Fplaylist.m3u8";
    movie=getUrl(url);
    cancelIdle();
    if (movie == "" || movie == " " || movie == null)
    {
    playItemUrl(-1,1);
    }
    else
    {
    storagePath = getStoragePath("tmp");
    storagePath_stream = storagePath + "stream.dat";
    streamArray = null;
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, video/x-flv);
    streamArray = pushBackStringArray(streamArray, "Antena Stars");
    streamArray = pushBackStringArray(streamArray, "1");
    writeStringToFile(storagePath_stream, streamArray);
    doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer_tv1.rss");
    }
    </script>
    </onClick>
    <location>Antena Stars</location>
    <annotation>Antena Stars</annotation>
    <mediaDisplay name="threePartsView"/>
	</item>

     <item>
     <title>Antena Stars (HQ)</title>
     <onClick>
     <script>
     showIdle();
     url="http://127.0.0.1/cgi-bin/scripts/tv/php/aplay1_link.php?file=https%3A%2F%2Fivm.antenaplay.ro%2Flive%2Fastars%2Fplaylist.m3u8";
     movie=getUrl(url);
     cancelIdle();
    streamArray = null;
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, video/mp4);
    streamArray = pushBackStringArray(streamArray, "Antena Stars (HQ)");
    streamArray = pushBackStringArray(streamArray, "1");
    writeStringToFile(storagePath_stream, streamArray);
    doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer_tv1.rss");
     </script>
     </onClick>
     <id></id>
     </item>

	<item>
	<title>Antena 3</title>
    <onClick>
    <script>
    showIdle();
    url="http://127.0.0.1/cgi-bin/scripts/tv/php/aplay_link.php?file=https%3A%2F%2Fivm.antenaplay.ro%2Flive%2Fa3%2Fplaylist.m3u8";
    movie=getUrl(url);
    cancelIdle();
    if (movie == "" || movie == " " || movie == null)
    {
    playItemUrl(-1,1);
    }
    else
    {
    storagePath = getStoragePath("tmp");
    storagePath_stream = storagePath + "stream.dat";
    streamArray = null;
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, video/x-flv);
    streamArray = pushBackStringArray(streamArray, "Antena 3");
    streamArray = pushBackStringArray(streamArray, "1");
    writeStringToFile(storagePath_stream, streamArray);
    doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer_tv1.rss");
    }
    </script>
    </onClick>
    <location>Antena 3</location>
    <annotation>Antena 3</annotation>
    <mediaDisplay name="threePartsView"/>
	</item>

     <item>
     <title>Antena 3 (HQ)</title>
     <onClick>
     <script>
     showIdle();
     url="http://127.0.0.1/cgi-bin/scripts/tv/php/aplay1_link.php?file=https%3A%2F%2Fivm.antenaplay.ro%2Flive%2Fa3%2Fplaylist.m3u8";
     movie=getUrl(url);
     cancelIdle();
    streamArray = null;
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, video/mp4);
    streamArray = pushBackStringArray(streamArray, "Antena 3 (HQ)");
    streamArray = pushBackStringArray(streamArray, "1");
    writeStringToFile(storagePath_stream, streamArray);
    doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer_tv1.rss");
     </script>
     </onClick>
     <id></id>
     </item>

	<item>
	<title>Happy Channel</title>
    <onClick>
    <script>
    showIdle();
    url="http://127.0.0.1/cgi-bin/scripts/tv/php/aplay_link.php?file=https%3A%2F%2Fivm.antenaplay.ro%2Flive%2Fhappy%2Fplaylist.m3u8";
    movie=getUrl(url);
    cancelIdle();
    if (movie == "" || movie == " " || movie == null)
    {
    playItemUrl(-1,1);
    }
    else
    {
    storagePath = getStoragePath("tmp");
    storagePath_stream = storagePath + "stream.dat";
    streamArray = null;
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, video/x-flv);
    streamArray = pushBackStringArray(streamArray, "Happy Channel");
    streamArray = pushBackStringArray(streamArray, "1");
    writeStringToFile(storagePath_stream, streamArray);
    doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer_tv1.rss");
    }
    </script>
    </onClick>
    <location>Happy Channel</location>
    <annotation>Happy Channel</annotation>
    <mediaDisplay name="threePartsView"/>
	</item>

     <item>
     <title>Happy Channel (HQ)</title>
     <onClick>
     <script>
     showIdle();
     url="http://127.0.0.1/cgi-bin/scripts/tv/php/aplay1_link.php?file=https%3A%2F%2Fivm.antenaplay.ro%2Flive%2Fhappy%2Fplaylist.m3u8";
     movie=getUrl(url);
     cancelIdle();
    streamArray = null;
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, video/mp4);
    streamArray = pushBackStringArray(streamArray, "Happy Channel (HQ)");
    streamArray = pushBackStringArray(streamArray, "1");
    writeStringToFile(storagePath_stream, streamArray);
    doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer_tv1.rss");
     </script>
     </onClick>
     <id></id>
     </item>

	<item>
	<title>ZU TV</title>
    <onClick>
    <script>
    showIdle();
    url="http://127.0.0.1/cgi-bin/scripts/tv/php/aplay_link.php?file=https%3A%2F%2Fivm.antenaplay.ro%2Flive%2Fzu%2Fplaylist.m3u8";
    movie=getUrl(url);
    cancelIdle();
    if (movie == "" || movie == " " || movie == null)
    {
    playItemUrl(-1,1);
    }
    else
    {
    storagePath = getStoragePath("tmp");
    storagePath_stream = storagePath + "stream.dat";
    streamArray = null;
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, video/x-flv);
    streamArray = pushBackStringArray(streamArray, "ZU TV");
    streamArray = pushBackStringArray(streamArray, "1");
    writeStringToFile(storagePath_stream, streamArray);
    doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer_tv1.rss");
    }
    </script>
    </onClick>
    <location>ZU TV</location>
    <annotation>ZU TV</annotation>
    <mediaDisplay name="threePartsView"/>
	</item>

     <item>
     <title>ZU TV (HQ)</title>
     <onClick>
     <script>
     showIdle();
     url="http://127.0.0.1/cgi-bin/scripts/tv/php/aplay1_link.php?file=https%3A%2F%2Fivm.antenaplay.ro%2Flive%2Fzu%2Fplaylist.m3u8";
     movie=getUrl(url);
     cancelIdle();
    streamArray = null;
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, video/mp4);
    streamArray = pushBackStringArray(streamArray, "ZU TV (HQ)");
    streamArray = pushBackStringArray(streamArray, "1");
    writeStringToFile(storagePath_stream, streamArray);
    doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer_tv1.rss");
     </script>
     </onClick>
     <id></id>
     </item>

	<item>
	<title>Disney Channel</title>
    <onClick>
    <script>
    showIdle();
    url="http://127.0.0.1/cgi-bin/scripts/tv/php/aplay_link.php?file=https%3A%2F%2Fivm.antenaplay.ro%2Flive%2Fdisney%2Fplaylist.m3u8";
    movie=getUrl(url);
    cancelIdle();
    if (movie == "" || movie == " " || movie == null)
    {
    playItemUrl(-1,1);
    }
    else
    {
    storagePath = getStoragePath("tmp");
    storagePath_stream = storagePath + "stream.dat";
    streamArray = null;
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, video/x-flv);
    streamArray = pushBackStringArray(streamArray, "Disney Channel");
    streamArray = pushBackStringArray(streamArray, "1");
    writeStringToFile(storagePath_stream, streamArray);
    doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer_tv1.rss");
    }
    </script>
    </onClick>
    <location>Disney Channel</location>
    <annotation>Disney Channel</annotation>
    <mediaDisplay name="threePartsView"/>
	</item>

     <item>
     <title>Disney Channel (HQ)</title>
     <onClick>
     <script>
     showIdle();
     url="http://127.0.0.1/cgi-bin/scripts/tv/php/aplay1_link.php?file=https%3A%2F%2Fivm.antenaplay.ro%2Flive%2Fdisney%2Fplaylist.m3u8";
     movie=getUrl(url);
     cancelIdle();
    streamArray = null;
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, video/mp4);
    streamArray = pushBackStringArray(streamArray, "Disney Channel (HQ)");
    streamArray = pushBackStringArray(streamArray, "1");
    writeStringToFile(storagePath_stream, streamArray);
    doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer_tv1.rss");
     </script>
     </onClick>
     <id></id>
     </item>

	<item>
	<title>Disney Junior</title>
    <onClick>
    <script>
    showIdle();
    url="http://127.0.0.1/cgi-bin/scripts/tv/php/aplay_link.php?file=https%3A%2F%2Fivm.antenaplay.ro%2Flive%2Fdisneyj%2Fplaylist.m3u8";
    movie=getUrl(url);
    cancelIdle();
    if (movie == "" || movie == " " || movie == null)
    {
    playItemUrl(-1,1);
    }
    else
    {
    storagePath = getStoragePath("tmp");
    storagePath_stream = storagePath + "stream.dat";
    streamArray = null;
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, video/x-flv);
    streamArray = pushBackStringArray(streamArray, "Disney Junior");
    streamArray = pushBackStringArray(streamArray, "1");
    writeStringToFile(storagePath_stream, streamArray);
    doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer_tv1.rss");
    }
    </script>
    </onClick>
    <location>Disney Junior</location>
    <annotation>Disney Junior</annotation>
    <mediaDisplay name="threePartsView"/>
	</item>

     <item>
     <title>Disney Junior (HQ)</title>
     <onClick>
     <script>
     showIdle();
     url="http://127.0.0.1/cgi-bin/scripts/tv/php/aplay1_link.php?file=https%3A%2F%2Fivm.antenaplay.ro%2Flive%2Fdisneyj%2Fplaylist.m3u8";
     movie=getUrl(url);
     cancelIdle();
    streamArray = null;
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, video/mp4);
    streamArray = pushBackStringArray(streamArray, "Disney Junior (HQ)");
    streamArray = pushBackStringArray(streamArray, "1");
    writeStringToFile(storagePath_stream, streamArray);
    doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer_tv1.rss");
     </script>
     </onClick>
     <id></id>
     </item>

	<item>
	<title>Antena International</title>
    <onClick>
    <script>
    showIdle();
    url="http://127.0.0.1/cgi-bin/scripts/tv/php/aplay_link.php?file=https%3A%2F%2Fivm.antenaplay.ro%2Flive%2Fai%2Fplaylist.m3u8";
    movie=getUrl(url);
    cancelIdle();
    if (movie == "" || movie == " " || movie == null)
    {
    playItemUrl(-1,1);
    }
    else
    {
    storagePath = getStoragePath("tmp");
    storagePath_stream = storagePath + "stream.dat";
    streamArray = null;
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, video/x-flv);
    streamArray = pushBackStringArray(streamArray, "Antena International");
    streamArray = pushBackStringArray(streamArray, "1");
    writeStringToFile(storagePath_stream, streamArray);
    doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer_tv1.rss");
    }
    </script>
    </onClick>
    <location>Antena International</location>
    <annotation>Antena International</annotation>
    <mediaDisplay name="threePartsView"/>
	</item>

     <item>
     <title>Antena International (HQ)</title>
     <onClick>
     <script>
     showIdle();
     url="http://127.0.0.1/cgi-bin/scripts/tv/php/aplay1_link.php?file=https%3A%2F%2Fivm.antenaplay.ro%2Flive%2Fai%2Fplaylist.m3u8";
     movie=getUrl(url);
     cancelIdle();
    streamArray = null;
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, video/mp4);
    streamArray = pushBackStringArray(streamArray, "Antena International (HQ)");
    streamArray = pushBackStringArray(streamArray, "1");
    writeStringToFile(storagePath_stream, streamArray);
    doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer_tv1.rss");
     </script>
     </onClick>
     <id></id>
     </item>

	<item>
	<title>Antena Monden</title>
    <onClick>
    <script>
    showIdle();
    url="http://127.0.0.1/cgi-bin/scripts/tv/php/aplay_link.php?file=https%3A%2F%2Fstream1.antenaplay.ro%2Flive%2Fsmil%3AAntenaMonden.smil%2Fplaylist.m3u8";
    movie=getUrl(url);
    cancelIdle();
    if (movie == "" || movie == " " || movie == null)
    {
    playItemUrl(-1,1);
    }
    else
    {
    storagePath = getStoragePath("tmp");
    storagePath_stream = storagePath + "stream.dat";
    streamArray = null;
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, video/x-flv);
    streamArray = pushBackStringArray(streamArray, "Antena Monden");
    streamArray = pushBackStringArray(streamArray, "1");
    writeStringToFile(storagePath_stream, streamArray);
    doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer_tv1.rss");
    }
    </script>
    </onClick>
    <location>Antena Monden</location>
    <annotation>Antena Monden</annotation>
    <mediaDisplay name="threePartsView"/>
	</item>

     <item>
     <title>Antena Monden (HQ)</title>
     <onClick>
     <script>
     showIdle();
     url="http://127.0.0.1/cgi-bin/scripts/tv/php/aplay1_link.php?file=https%3A%2F%2Fstream1.antenaplay.ro%2Flive%2Fsmil%3AAntenaMonden.smil%2Fplaylist.m3u8";
     movie=getUrl(url);
     cancelIdle();
    streamArray = null;
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, video/mp4);
    streamArray = pushBackStringArray(streamArray, "Antena Monden (HQ)");
    streamArray = pushBackStringArray(streamArray, "1");
    writeStringToFile(storagePath_stream, streamArray);
    doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer_tv1.rss");
     </script>
     </onClick>
     <id></id>
     </item>

	<item>
	<title>Comedy Play</title>
    <onClick>
    <script>
    showIdle();
    url="http://127.0.0.1/cgi-bin/scripts/tv/php/aplay_link.php?file=https%3A%2F%2Fstream1.antenaplay.ro%2Flive%2Fsmil%3AComedyPlay.smil%2Fplaylist.m3u8";
    movie=getUrl(url);
    cancelIdle();
    if (movie == "" || movie == " " || movie == null)
    {
    playItemUrl(-1,1);
    }
    else
    {
    storagePath = getStoragePath("tmp");
    storagePath_stream = storagePath + "stream.dat";
    streamArray = null;
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, video/x-flv);
    streamArray = pushBackStringArray(streamArray, "Comedy Play");
    streamArray = pushBackStringArray(streamArray, "1");
    writeStringToFile(storagePath_stream, streamArray);
    doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer_tv1.rss");
    }
    </script>
    </onClick>
    <location>Comedy Play</location>
    <annotation>Comedy Play</annotation>
    <mediaDisplay name="threePartsView"/>
	</item>

     <item>
     <title>Comedy Play (HQ)</title>
     <onClick>
     <script>
     showIdle();
     url="http://127.0.0.1/cgi-bin/scripts/tv/php/aplay1_link.php?file=https%3A%2F%2Fstream1.antenaplay.ro%2Flive%2Fsmil%3AComedyPlay.smil%2Fplaylist.m3u8";
     movie=getUrl(url);
     cancelIdle();
    streamArray = null;
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, video/mp4);
    streamArray = pushBackStringArray(streamArray, "Comedy Play (HQ)");
    streamArray = pushBackStringArray(streamArray, "1");
    writeStringToFile(storagePath_stream, streamArray);
    doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer_tv1.rss");
     </script>
     </onClick>
     <id></id>
     </item>

	<item>
	<title>Cook Play</title>
    <onClick>
    <script>
    showIdle();
    url="http://127.0.0.1/cgi-bin/scripts/tv/php/aplay_link.php?file=https%3A%2F%2Fstream1.antenaplay.ro%2Flive%2Fsmil%3ACookPlay.smil%2Fplaylist.m3u8";
    movie=getUrl(url);
    cancelIdle();
    if (movie == "" || movie == " " || movie == null)
    {
    playItemUrl(-1,1);
    }
    else
    {
    storagePath = getStoragePath("tmp");
    storagePath_stream = storagePath + "stream.dat";
    streamArray = null;
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, video/x-flv);
    streamArray = pushBackStringArray(streamArray, "Cook Play");
    streamArray = pushBackStringArray(streamArray, "1");
    writeStringToFile(storagePath_stream, streamArray);
    doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer_tv1.rss");
    }
    </script>
    </onClick>
    <location>Cook Play</location>
    <annotation>Cook Play</annotation>
    <mediaDisplay name="threePartsView"/>
	</item>

     <item>
     <title>Cook Play (HQ)</title>
     <onClick>
     <script>
     showIdle();
     url="http://127.0.0.1/cgi-bin/scripts/tv/php/aplay1_link.php?file=https%3A%2F%2Fstream1.antenaplay.ro%2Flive%2Fsmil%3ACookPlay.smil%2Fplaylist.m3u8";
     movie=getUrl(url);
     cancelIdle();
    streamArray = null;
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, "");
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, movie);
    streamArray = pushBackStringArray(streamArray, video/mp4);
    streamArray = pushBackStringArray(streamArray, "Cook Play (HQ)");
    streamArray = pushBackStringArray(streamArray, "1");
    writeStringToFile(storagePath_stream, streamArray);
    doModalRss("rss_file:///usr/local/etc/www/cgi-bin/scripts/util/videoRenderer_tv1.rss");
     </script>
     </onClick>
     <id></id>
     </item>


</channel>
</rss>
