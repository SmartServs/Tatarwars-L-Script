<!DOCTYPE html
<?
  function TimeAgo($diff_in_unix){
  if ($diff_in_unix > 3600){
  $diff .= intval($diff_in_unix/3600); 
  $diff_in_unix = $diff_in_unix%3600;
  }else{ $diff .= '00'; }
  if($diff_in_unix > 60 AND $diff_in_unix < 3600){
  $diff .= ":".intval($diff_in_unix / 60);
  $diff_in_unix = $diff_in_unix%60;
  }else{ $diff .= ':00'; }
  if ($diff_in_unix < 60 AND $diff_in_unix > 0){
  $diff .= ":".$diff_in_unix;
  }
  return $diff;
  }
$x = 0;
require_once( "core-f/config-f/s1.php" );
$link = mysql_connect($AppConfig['db']['host'], $AppConfig['db']['user'], $AppConfig['db']['password']) or die(mysql_error());
mysql_select_db($AppConfig['db']['database'], $link) or die(mysql_error());

$result = mysql_query("SELECT * FROM p_queue WHERE id = 1 and proc_type= 24", $link) or die(mysql_error());
// Fetch row as associative array
$row = mysql_fetch_assoc($result);
// Access data in row
$end_date = $row["end_date"];

$fetch = mysql_query("SELECT * FROM p_queue WHERE id = 3 and proc_type= 57", $link) or die(mysql_error());
// Fetch row as associative array
$fetchs = mysql_fetch_assoc($fetch);

$redseahost = $AppConfig['system']['server_days'];
// Subtract 10 days from the end date
$subtracted_date = date('Y-m-d H:i:s', strtotime("-$redseahost days", strtotime($end_date)));
$subtracted_date4 = date('Y-m-d H:i:s', strtotime("-3 hours", strtotime($subtracted_date)));

// calculate the difference in seconds between the subtracted date and now
$diff_in_seconds = strtotime($subtracted_date4) - time();


// if the difference is negative, get the absolute value
$diff_in_seconds = abs($diff_in_seconds);

// calculate the remaining days, hours, minutes and seconds
$remaining_days = floor($diff_in_seconds / 86400);
$remaining_hours = floor(($diff_in_seconds % 86400) / 3600);

// format the remaining time as a string
$remaining_time = sprintf('%02d:%02d', $remaining_days, $remaining_hours);

$q = mysql_query ("SELECT * FROM g_summary");
$sessionTimeoutInSeconds = 9000 * 60;
$g = mysql_query ("SELECT COUNT(*) FROM p_players WHERE TIME_TO_SEC(TIMEDIFF(NOW(), last_login_date)) <= ".$sessionTimeoutInSeconds."");
$g = mysql_fetch_row ($g);
$r = mysql_fetch_assoc ($q);
$online1 = floor((TimeAgo(time() - strtotime(date($AppConfig['system']['server_start'] )))/24));
$online_before1 = floor((TimeAgo(strtotime($AppConfig['system']['server_start']) - time())/24));
$players_count1 = $r["players_count"];
$active_players_count1 = $r['active_players_count'];
$online_players_count1 = $g[0];    
$x +=1;
?>
<html lang='ar' dir="rtl">
<head>


    <meta name="viewport" content="width=device-width"/>
<meta charSet="utf-8"/>
<meta name="application-name" content="حرب التتار"/>
<meta name="apple-mobile-web-app-capable" content="yes"/>
<meta name="apple-mobile-web-app-status-bar-style" content="default"/>
<meta name="apple-mobile-web-app-title" content="حرب التتار -  لعبة المتصفّح الإستراتيجيّة على الإنترنت"/>
<meta name="description" content="حرب التتار هى لعبة مجانية لا تحتاج الى تحميل ,لعبة حرب في عالم مليء باللاعبين الحقيقين الذين يبدأون جميعهم كزعماء لقرى صغيرة."/>
<meta name="format-detection" content="telephone=no"/>
<meta name="mobile-web-app-capable" content="yes"/>
<meta name="msapplication-config" content="/icon/browserconfig.xml"/>
<meta name="msapplication-TileColor" content="white"/>
<meta name="msapplication-tap-highlight" content="no"/>
<meta name="theme-color" content="white"/>
<link rel="shortcut icon" href="assets/favicon.ico?1"/>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no, viewport-fit=cover"/>
<meta name="next-head-count" content="4"/>
<link href="assets/default/lang/ar/lang.css?17237362" rel="stylesheet" type="text/css"/>
<link href="assets/default/lang/ar/Qs.css?17237363" rel="stylesheet" type="text/css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mootools/1.6.0/mootools-core.min.js"></script>
<script src="assets/Jq.js?_qtr" type="text/javascript"></script>
<script src="assets/core.js" type="text/javascript"></script>
<script src="assets/new.js" type="text/javascript"></script>
<script src="assets/script.js" type="text/javascript"></script>
<title>حرب التتار</title>
    <style>
      div#content {
          padding-top: 1px !important;
      }

      .wrapper {
          top: unset !important;
      }

      @media screen and (max-width:768px) {
          div#footer {
              display: none !important;
          }
      }

      :root {
          --Hdr: url(../../img/vip/new/103.jpg?i=1720309698);
      }
    </style>
    <meta name='keywords' content='قاهر التتار,قاهر التتار,حرب الاغريق,حرب المغول,ترافيان,جي وار,ترافيان سريع,tatarzx,tatar war'>
  </head>   
  <body class="v35 webkit">
    <style>
      option,
      input[type=radio],
      input[type=checkbox],
      input[type=tel],
      input[type=email],
      input[type=password],
      input[type=text] {
        height: 20px !important;
        font-size: 17px;
      }

      input[type=radio],
      input[type=checkbox] {
        width: 20px !important;
      }

      option,
      select {
        height: 26px !important;
        font-size: 17px;
        max-width: 140px;
      }

      div#content,
      body.mod1 div#content,
      body.mod2 div#content,
      body.mod3 div#content {
        height: auto !important;
        height: 550px;
        min-height: 550px;
      }

      .InBar.xPh {
        top: 110px;
        left: 0;
      }

      .diC {
        display: table;
        margin: 0 auto;
      }

      .InBar {
        width: 480px;
        height: 30px;
        top: 80px;
        left: 120px;
      }

      .InBar a:first-child {
        color: #a20327;
      }

      .InBar a {
        font-size: 14px;
        margin: 0 12px;
        color: #333;
        height: 16px;
        border-radius: 10px;
        border: 1px solid transparent;
        text-shadow: 1px 1px 1px #fff;
        padding: 3px 8px;
        top: 5px;
        left: 10px;
      }

      *[onclick] {
        cursor: pointer;
        font-size: 13px;
        font-weight: 900 !important;
        color: #82d000;
      }

      .InBar a:hover {
        border: 1px solid #e6e6e6;
      }

      c#EyePwd_Eye {
        color: silver;
        font-weight: 200 !important;
        right: -20px;
        position: relative;
      }

      .NoSelect {
        -webkit-touch-callout: none;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }
    </style>
    <link href="assets/indx/css/main_ar.css?_qssstr33" rel="stylesheet" type="text/css" />
    <script type="text/javascript">
      function hl_bt(on) {
        element = document.getElementById("image_button");
        if (on) {
          element.style.display = "block";
        } else {
          element.style.display = "none";
        }
      }
    </script>
    <div class="wrapper">
      <img src="assets/x.gif" id="msfilter" alt="" />
      <div id="dynamic_header"></div>
      <div id="header">
        <div id="mtop" style="top: 10px;right: 44%;">
          <span class="InBar xPh diC NoSelect">
            <a onclick="ShowSe(2)" href="index.php"> الرئيسية </a>
            <a id="dummy_button" onclick="$('#login_layer').show();" href="#"> الدخول </a>
            <a id="dummy_button" onclick="$('#signup_layer').show();" href="#"> التسجيل </a>
            <a onclick="ShowSe(2)" href="manual.php"> دليل اللعبة </a>
          </span>
          <div class="clear"></div>
        </div>
      </div>
      <div id="mid">
        <div id="side_navi">
          <a id="logo" href="#">
            <img src="assets/x.gif">
          </a>
          <p>
            <a href="index.php">الصفحة الرئيسية</a>
          <a href="manual.php">دليل اللعبة</a>
          </p>
          <p>
            <a href="#" style="font-weight: normal!important;" onclick="$('#login_layer').show();">تسجيل دخول</a>
            <a href="#" style="color:red;font-weight: normal!important;" onclick="$('#signup_layer').show();">تسجيل</a>
          </p>
          <p>
             <a href="login?terms">قوانين اللعبة</a>
           
          </p>
          <p></p>
        </div>
        <div id="sn" style="width: 40%; height: 30%; top: 150px; display:none;">
          <a id="logo" href="#">
            <img src="assets/x.gif">
          </a>
          <p>
            <a href="index.php">الصفحة الرئيسية</a>
            <a href="manual.php">دليل اللعبة</a>
          </p>
          <p>
            <a href="#" style="font-weight: normal!important;" onclick="$('#login_layer').show();">تسجيل دخول</a>
            <a href="#" style="color:red;font-weight: normal!important;" onclick="$('#signup_layer').show();">تسجيل</a>
          </p>
          <p>
            <a href="login?terms">قوانين اللعبة</a>
         
          </p>
        </div>
         <span class="navi-drawer">«</span>
        <div id="content" class="login" style="min-height: 550px;">

          <h1 style='font-size: 1.7rem;'>مرحباً بكم في حرب التتار</h1>
          <div class="info">
            <div>هي لعبة حروب في العالم القديم بين اللاعبين الحقيقين الذين يبدأون جميعهم كزعماء لقرى صغيرة. <br>
              <!--<a href="/?tut=1">» إلئ دورة تدريبية</a>-->
            </div>
            <div class="Stat">
              <bdi>اللاعبين : <b class="Val"><?php echo $players_count1; ?></b>
              </bdi>
              <bdi>الموجودين : <b class="Val"><?php echo $online_players_count1; ?></b>
              </bdi>
              <bdi> السيرفرات : <b class="Val">1</b>
              </bdi>
            </div>
          </div>
          <div class="Ban">
            <a onclick="$('#login_layer').show();">الدخول</a>
            <a onclick="$('#signup_layer').show();">التسجيل</a>
          </div>
          <div class="Ti">
            <div>
              <div class="Sub">عن اللعبة</div>
            </div>
            <div>
              <div class="Sub">لقطات</div>
            </div>
          </div>
          <div style="padding-top:5px;display: flex;justify-content: space-around;align-items: center;">
            <div style="width:50%;">
              <div>● ستبدأ كرئيس قرية صغيرة. <br>● ستطور المباني والحقول والجيش. <br>● ستحارب مع أو ضد لاعبين حقيقين. <br>
              </div>
            </div>
            <div style="width:50%;">
              <div style="text-align: center;display: flex;justify-content: space-around;flex-wrap: wrap;">
                <img style="width: 100px;height: 50px;border: 1px dashed silver;margin-top:5px;cursor: pointer;" src="assets/images/v1.png">
                <img style="width: 100px;height: 50px;border: 1px dashed silver;margin-top:5px;cursor: pointer;" src="assets/images/v2.jpg?i">
                <img style="width: 100px;height: 50px;border: 1px dashed silver;margin-top:5px;cursor: pointer;" src="assets/images/v3.png">
                <img style="width: 100px;height: 50px;border: 1px dashed silver;margin-top:5px;cursor: pointer;" src="assets/images/v4.jpg?i">
              </div>
            </div>
          </div>
        </div>
       
        <div id="si" style="width: 50%; top: 150px; display:none;">
          <div class="news">
            <font color="#78C310" size="3">حرب التتار</font>
            <br />
            <font size="2">
              <br /> نحن هنا كي نتنافس في عالم حرب التتار  ونتعارف علي بعض فأرنا مهاراتك في القتال والتخطيط . <br />
              <br />
              <span style="color: #de0000;font-size: small;">نافس علي بناء المعجزة في أرض التتار وكن بطل السيرفر </span>
              <br />
              <br /> مع فائق الإحترام
            </font>
          </div>
        </div>
        <div id="side_info">
          <div class="news">
            <font color="#78C310" size="3">حرب التتار</font>
            <br />
            <font size="2">
              <br /> نحن هنا كي نتنافس في عالم حرب التتار  ونتعارف علي بعض فأرنا مهاراتك في القتال والتخطيط . <br />
              <br />
              <span style="color: #de0000;font-size: small;">نافس علي بناء المعجزة في أرض التتار وكن بطل السيرفر </span>
              <br />
              <br /> مع فائق الإحترام
            </font>
        </div>
        <div class="clear"></div>
      </div>
  </body>
  <script type="text/javascript">
    RL();
    init();
    EyePwd();
  </script>
<script type="text/javascript">
function XblackShadow() {
    $('#sn').css('display', 'none');
    $('#si').css('display', 'none');
    $('.blackShadow').hide();
}

jQuery(document).ready(function ($) {
    $('.side-drawer').click(function () {
        var si = $('#si');
        var sn = $('#sn');
        var blackShadow = $('.blackShadow');

        if (si.css('display') === 'none') {
            blackShadow.show();
            si.css('display', 'block');
            sn.css('display', 'none');
        } else {
            blackShadow.hide();
            si.css('display', 'none');
        }
    });
});

function lackShadow() {
    $('#si').css('display', 'none');
    $('#sn').css('display', 'none');
    $('.lackShadow').hide();
}

jQuery(document).ready(function ($) {
    $('.navi-drawer').click(function () {
        var si = $('#si');
        var sn = $('#sn');
        var lackShadow = $('.lackShadow');

        if (sn.css('display') === 'none') {
            lackShadow.show();
            sn.css('display', 'block');
            si.css('display', 'none');
        } else {
            lackShadow.hide();
            sn.css('display', 'none');
        }
    });
});
</script>
  <script type="text/javascript">
    var d3l = 678;
    d4l = 59;
  </script>
</html><div id="login_layer" class="overlay">
<div class="mask closer"></div>
<div id="login_list" class="overlay_content">
<h2>اختار السيرفر</h2>
<a class="closer No" onclick="$('#login_layer').hide()">
<img class="dynamic_img" src="assets/x.gif"></a>
<ul class="world_list">
<li class="w_big c3" style="background-image: url('assets/images/welten/en1_big.jpg?i=2');">
    <a href="login">
<img alt="World" class="w_button" src="assets/x.gif"/></a>
<span class="Inf">
<div class="label_players c0">
<bdi>اللاعبين: <b><?php echo $players_count1; ?></b></bdi></div>
<div class="label_online c0">
<bdi>المتواجدون: <b><?php echo $online_players_count1; ?></b></bdi></div>
</div>
<div class="online c0">
</div>
</span>
</li>




</ul>
<div class="footer">
</div>
</div>
</div>
<div id="signup_layer" class="overlay">
<div class="mask closer">
</div>
<div id="signup_list" class="overlay_content">
<h2>اختار السيرفر</h2>
<a class="closer No" onclick="$('#signup_layer').hide()">
<img class="dynamic_img" src="assets/x.gif"></a>
<ul class="world_list">
<li class="w_big c3" style="background-image: url('assets/images/welten/en1_big.jpg?i=2'); filter: grayscale(0%);">
     
<a href="register">
<img alt="World" class="w_button" src="assets/x.gif"/></a>
<span class="Inf">
<div class="label_players c0">
<bdi>اللاعبين: <b><?php echo $players_count1; ?></b></bdi></div>
<div class="label_online c0">
<bdi>المتواجدون: <b><?php echo $online_players_count1; ?></b></bdi></div>
</div>
<div class="online c0">
</div>
</span>
</li>




</ul>
<div class="footer">
</div>
</div>
</div>
<div id="Screen" class="overlay">
<div class="mask closer"></div>
<div id="signup_list" class="overlay_content">
<h2 id="caption"></h2>
<a class="closer No">
<img alt="" class="dynamic_img" src="assets/x.gif"></a>
<img class="Screen-content" id="img01">
</div>
</div>
<style>
#login_layer .overlay_content, #signup_layer .overlay_content , #Screen .overlay_content {
	width: 384px;
	border:1px solid black;
	margin-right: -193px;
	margin-top: 150px;
	background: white;
    box-shadow: 0 0 0 #000;
}
</style>