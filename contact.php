<?php
if (isset ($_POST['name'])) {
	$errors = array();
	if( trim($_POST['name']) == '' ){
		$errors[] = 'Введите Имя';
	}
	if( trim($_POST['email']) == '' ){
		$errors[] = 'Введите Email';
	}
	if( trim($_POST['phone']) == '' ){
		$errors[] = 'Введите телефон';
	}
	if( trim($_POST['textarea']) == '' ){
		$errors[] = 'Введите тематику';
	}	
	/*if(!$_FILES['file']['name']){
		$errors[] = 'Вложите свою фотографию';
	}*/
	if( empty($errors)){
		$_POST['name'] = htmlspecialchars($_POST['name']);
		$_POST['email'] = htmlspecialchars($_POST['email']);
		$_POST['phone'] = htmlspecialchars($_POST['phone']);
		$_POST['textarea'] = htmlspecialchars($_POST['textarea']);
		$to = "alexansavch@ukr.net"; // поменять на свой электронный адрес
		$from = $_POST['email'];
		$subject = "Заполнена форма контактов с ".$_SERVER['HTTP_REFERER'];
		$message = "Имя: ".$_POST['name']."\nEmail: ".$from."\nТелефон: ".$_POST['phone']."\nТематика: ".$_POST['textarea'];
		$boundary = md5(date('r', time()));
		$filesize = '';
		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "From: " . $from . "\r\n";
		$headers .= "Reply-To: " . $from . "\r\n";
		$headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";
  $message="
Content-Type: multipart/mixed; boundary=\"$boundary\"

--$boundary
Content-Type: text/plain; charset=\"utf-8\"
Content-Transfer-Encoding: 7bit

$message";
  for($i=0;$i<count($_FILES['fileFF']['name']);$i++) {
     if(is_uploaded_file($_FILES['fileFF']['tmp_name'][$i])) {
         $attachment = chunk_split(base64_encode(file_get_contents($_FILES['fileFF']['tmp_name'][$i])));
         $filename = $_FILES['fileFF']['name'][$i];
         $filetype = $_FILES['fileFF']['type'][$i];
         @$filesize += $_FILES['fileFF']['size'][$i];
         $message.="

--$boundary
Content-Type: \"$filetype\"; name=\"$filename\"
Content-Transfer-Encoding: base64
Content-Disposition: attachment; filename=\"$filename\"

$attachment";
     }
   }
   $message.="
--$boundary--";

		if ($filesize < 10000000) { // проверка на общий размер всех файлов. Многие почтовые сервисы не принимают вложения больше 10 МБ
			mail($to, $subject, $message, $headers);
			echo '<div style="margin-left: 15%; padding: 0.1%; font-size: 15px; color: green; font-weight: bold; position: relative; left: 30%; top: 56.5%;" id="success_form">'.$_POST['name'].', Ваше сообщение получено, спасибо!</div>';
		} else {
			echo '<div style="color: red; font-size: 120%; position: relative; top: 50%; left: 70%; width: 20%;">Извините, письмо не отправлено. Размер всех файлов превышает 10 МБ.</div>';
		}
	
	}
	else {
		echo '<div style="margin-left: 15%; padding: 0.1%; font-size: 15px; color: red; font-weight: bold; position: fixed; left: 30%; top: 56.5%;" id="error_form">Ошибка:'. array_shift($errors).'</div>';
	}
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>СВЯЗЬ</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.1/css/materialize.min.css">

  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">

  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Cormorant+Garamond" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/contact.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
 <script src="js/contact.js"></script>
 <script>document.documentElement.className = 'js';</script>
</head>
<body class="demo-3 loading">

  <div id="preloader">
    <canvas id="scene"></canvas>
  </div>

  <header> 
    <nav>
      <div class="nav-wrapper">
        <a href="index.html" class="brand-logo left">ARA SPACE</a>
        <h1>СВЯЗЬ</h1>
      </div>
    </nav>
  </header>
  <main>
   <div class="container">
    <div class="row">
      <div class="col s12 m12 l6">
        <div class="card block1">
          <ul class="collapsible" data-collapsible="accordion">
            <li class="first">
              <div class="collapsible-header first"><i class="fa fa-mobile fa-3x" aria-hidden="true"></i>Телефоны</div>
              <div class="collapsible-body"><span><a href="tel:+380662101784"> +38(066)21 017 84 </a></span><br/>
                <span><a href="tel:+380991998944"> +38(099)19 989 44 </a></span>
              </div>
            </li>
            <li >
              <div class="collapsible-header"><i class="material-icons">place</i>Viber</div>
              <div class="collapsible-body"><span><a href="viber://chat?number=+380991998944">+38(099)19 989 44</a></span>
                <br/>
                <span><a href="viber://chat?number=+380662101784">+38(066)21 017 84</a></span>
              </div>
            </li>
            <li>
              <div class="collapsible-header"><i class="fa fa-skype" aria-hidden="true"></i>Skype</div>
              <div class="collapsible-body"><span>ara_space_com</span></div>
            </li>
            <li>
              <div class="collapsible-header"><i class="material-icons">email</i>Email</div>
              <div class="collapsible-body"><span><a href="mailto:info@ara-space.com">info@ara-space.com</a></span></div>
            </li>
            <li>
              <div class="collapsible-header"><i class="fa fa-facebook-official" aria-hidden="true"></i>Facebook</div>
              <div class="collapsible-body"><span><a href="https://facebook.com/araspacecom">Наша страница в социальной сети </a></span></div>
            </li>
            <li class="last">
              <div class="collapsible-header last"><i class="material-icons">place</i>Адрес</div>
              <div class="collapsible-body last_body"><span><adress></i>Украина г. Киев ул.Гетьмана, 27</adress></span></div>
            </li>
          </ul>
        </div>
      </div>
      <div class="col s12 m12 l6"><div class="card"><div class="map">
        <script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyAnsRVbwOMC0nnnnTG5507ssi4_G5pLE7g&v=3.exp'></script><div style='overflow:hidden;height:330px; border-radius: 15px;'><div id='gmap_canvas' style='height:330px; border-radius: 15px;'></div><div><small><a href="http://embedgooglemaps.com">embedgooglemaps.com</a></small></div><div><small><a href="http://buyproxies.io/">buy proxy</a></small></div><style>#gmap_canvas img{max-width:none!important;background:none!important}</style></div><script type='text/javascript'>function init_map(){var myOptions = {zoom:15,center:new google.maps.LatLng(50.43935399999999,30.44704999999999),mapTypeId: google.maps.MapTypeId.ROADMAP};map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(50.43935399999999,30.44704999999999)});infowindow = new google.maps.InfoWindow({content:'<strong>Веб-студия <br><b>Ara-space</b></strong><br>Гетьмана 27<br>'});google.maps.event.addListener(marker, 'click', function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);</script>
      </div>
    </div>
  </div>
  
 <div class="col s12 m12 l12"><div class="card">
    <form action="contact.php" method="post" enctype="multipart/form-data" class="form-horizontal">
      <fieldset>


        <!-- Prepended text-->
        <div class="form-group">

          <div class="input-field col s12">
            <!--span class="input-group-addon">Ваше имя</span-->
            <input id="prependedtext" name="name" class="form-control" placeholder="Ваше имя" type="text" required="" value="<?php echo @$_POST['name']; ?>">
          </div>


        </div>

        <!-- Prepended text-->
        <div class="form-group">


          <div class="input-field col s6">
            <!--span class="input-group-addon">Ваш телефон</span-->
            <input id="prependedtext" name="phone" class="form-control" placeholder="Ваш телефон" type="text" required="" value="<?php echo @$_POST['phone']; ?>">
          </div>
          <div class="input-field col s6">
            <input id="email" type="email" name="email" class="form-control" placeholder="Email" value="<?php echo @$_POST['email']; ?>">

          </div>
        </div>


        <!-- Textarea -->
        <div class="input-field col s12">


          <input type="text" class="materialize-textarea" id="textarea" rows="10" name="textarea" placeholder="Ваша тематика" value="<?php echo @$_POST['textarea']; ?>">

        </div>

        <div class="form-group ">

          <input type="submit" id="singlebutton " style="margin-left: 50%" name="singlebutton" class="btn btn-success ">
        </div>


      </fieldset>
    </form>       </div>
  </div>
</div>
</div>
</main>
<footer class="page-footer">
  <div class="container">
    <div class="row">
      <div class="col l6 s12 ">
        <h5 class="white-text">Планета Марс</h5>
        <p class="grey-text text-lighten-4"> планета земной группы с разреженной атмосферой (давление у поверхности в 160 раз меньше земного). Особенностями поверхностного рельефа Марса можно считать ударные кратеры наподобие лунных, а также вулканы, долины, пустыни и полярные ледниковые шапки наподобие земных</p>
      </div>
      <div class="col l4 offset-l2 s12">
        <h5 class="white-text">Ссылки</h5>
        <ul>
         <li><a class="grey-text text-lighten-3" href="index.html">Главная</a></li>
         <li><a class="grey-text text-lighten-3" href="about.html">О нас</a></li>
         <li><a class="grey-text text-lighten-3" href="project.html">Наши проекты</a></li>
         <li><a class="grey-text text-lighten-3" href="contact.html">Контакты</a></li>
       </ul>
     </div>
   </div>
 </div>
 <div class="footer-copyright #866349">
  <div class="container">
    © 2017 Ara Space Разработка комерческих решений для вас и вашего бизнесса
  </div>
</div>
</footer>
<script>
  jQuery(document).ready(function($) {
    $(window).load(function() {
      setTimeout(function() {
        $('#preloader').fadeOut('slow', function() {});
      }, 4000);
    });
  });
</script>
<!--<script src="js/vendors/three.min.js"></script>-->
<script src="js/vendors/TweenMax.min.js"></script>
<script src="js/demo3.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>
</body>
</html>
