#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
header('Content-type: video/mp4');
//header('Content-type: application/vnd.apple.mpegURL');
$cookie="/tmp/filmbox.dat";
exec ("rm -f /tmp/filmbox.dat");
error_reporting(0);
set_time_limit(0);
$l = urldecode($_GET["file"]);
$ua="Mozilla/5.0 (iPhone; CPU iPhone OS 5_0_1 like Mac OS X)";
//$l="https://5845e42425cc9.streamlock.net/live/rictv/playlist.m3u8";
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start);
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini;
	return substr($string,$ini,$len);
}
function getSiteHost($siteLink) {
		// parse url and get different components
		$siteParts = parse_url($siteLink);
		$port=$siteParts['port'];
		if (!$port || $port==80)
          $port="";
        else
          $port=":".$port;
		// extract full host components and return host
		return $siteParts['scheme'].'://'.$siteParts['host'].$port;
}
$base1=str_replace(strrchr($l, "/"),"/",$l);
$base2=getSiteHost($l);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $l);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
curl_setopt($ch, CURLOPT_USERAGENT, $ua);
//curl_setopt($ch, CURLOPT_HEADER,1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
$h = curl_exec($ch);
curl_close($ch);
//echo $h."\n";
//die();
if (preg_match("/\.m3u8/",$h)) { // get secondary playlist)
$a1=explode("\n",$h);
for ($k=0;$k<count($a1);$k++) {
  if ($a1[$k][0] !="#" && $a1[$k]) $pl[]=trim($a1[$k]);
}
if ($pl[0][0] == "/")
  $base=$base2;
elseif (preg_match("/http(s)?:/",$pl[0]))
  $base="";
else
  $base=$base1;
//print_r ($pl);
// Rezolution
if (count($pl) > 1) {
  //if (preg_match_all("/RESOLUTION\=(\d+)/i",$h))
    preg_match_all("/RESOLUTION\=(\d+)/i",$h,$m);
  //else
   // preg_match_all("/BANDWIDTH\=(\d+)/i",$h,$m);
  $max_res=max($m[1]);
  //echo $max_res."\n";
  $arr_max=array_keys($m[1], $max_res);
  $key_max=$arr_max[0];
  //$key_max=1;
  //echo $key_max;
  $l=$base.$pl[$key_max];
} else {
  $l=$base.$pl[0];
}
} // end secondary playlist
//echo $l;
//echo $l;
//die();
$base1=str_replace(strrchr($l, "/"),"/",$l);
$base2=getSiteHost($l);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $l);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
curl_setopt($ch, CURLOPT_USERAGENT, $ua);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
$h = curl_exec($ch);
curl_close($ch);
$base3="";
$x=explode("?",$l);
if ($x[1]) $base3="?".$x[1]; // antena play
$base3="";
$a1=explode("\n",$h);
for ($k=0;$k<count($a1);$k++) {
  if ($a1[$k][0] !="#" && $a1[$k]) $ts[]=trim($a1[$k]);
}
if ($ts[0][0] == "/")
  $base=$base2;
elseif (preg_match("/http(s)?:/",$ts[0]))
  $base="";
else
  $base=$base1;
// $l playlist with ts segments
// $base base url for ts
//echo $l;
//die();
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $l);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
curl_setopt($ch, CURLOPT_USERAGENT, $ua);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
$link = curl_init();
curl_setopt($link, CURLOPT_USERAGENT, $ua);
curl_setopt($link, CURLOPT_HEADER, false);
curl_setopt($link, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
$l_ts=array();
$ts=array();
while (true) {
  $h = curl_exec($ch);
  //echo $h;
  if (!preg_match("/#EXTINF/i",$h)) break;
  $a1=explode("\n",$h);
  $l_ts=$ts;
  $ts=array();
  for ($k=0;$k<count($a1);$k++) {
      if ($a1[$k][0] !="#" && $a1[$k]) $ts[]=trim($a1[$k]);
  }
  $c=count($ts);
  for ($n=0;$n<$c;$n++) {
    if (!in_array($ts[$n], $l_ts)) {
      //echo $base.$ts[$n].$base3."<BR>";
      curl_setopt($link, CURLOPT_URL, $base.$ts[$n].$base3);
      curl_exec($link);
    }
  }
  //break;
}
curl_close($ch);
curl_close($link);
?>
