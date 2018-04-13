<?php set_time_limit(0); ini_set('max_execution_time', '0'); ?>
<?php function generate_uuid4() { return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x', rand(0, 0xffff), rand(0, 0xffff), rand(0, 0xffff), rand(0, 0x0fff) | 0x4000, rand(0, 0x3fff) | 0x8000, rand(0, 0xffff), rand(0, 0xffff), rand(0, 0xffff)); } ?>
<?php
if(version_compare(PHP_VERSION, '5.6.0') >= 0) {
	$fileMailer = dirname(__FILE__).DIRECTORY_SEPARATOR."PHPMailer7.php";
	$link = "https://raw.githubusercontent.com/killserver/cardinal/trunk/core/class/PHPMailer7.php";
} else {
	$fileMailer = dirname(__FILE__).DIRECTORY_SEPARATOR."PHPMailer5.php";
	$link = "https://raw.githubusercontent.com/killserver/cardinal/trunk/core/class/PHPMailer5.php";
}
if(!file_exists($fileMailer)) {
	file_put_contents($fileMailer, file_get_contents($link));
}
include_once($fileMailer);
function nmail() {
	$server = (class_exists("HTTP", false) && method_exists("HTTP", "getServer") ? HTTP::getServer("HTTP_HOST") : (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : getenv("HTTP_HOST")));
	$get = func_get_args();
	$mail = new PHPMailer(true);
	if(sizeof($get)==0) {
		return $mail;
	} else if(sizeof($get)==1) {
		$for = $get[0];
		$body = "Test message for you. This message generated automatic in Cardinal Engine".(defined("VERSION") ? " in version ".VERSION : "");
		$head = "Message for you. In site: ".$server;
	} else if(sizeof($get)==2) {
		$for = $get[0];
		$body = $get[1];
		$head = "Message for you. In site: ".$server;
	} else if(sizeof($get)==3) {
		$for = $get[0];
		$body = $get[1];
		$head = $get[2];
	} else if(sizeof($get)==4) {
		$for = $get[0];
		$body = $get[1];
		$head = $get[2];
		$from = $get[3];
	} else {
		throw new Exception("This operation is not permission", 1);
		die();
	}
	$mail->CharSet = (class_exists("config") && method_exists("config", "Select") && config::Select("charset") ? config::Select("charset") : "UTF-8");
	$mail->ContentType = 'text/html';
	$mail->Priority = 1;
	if(!isset($from)) {
		$mail->From = "info@".$server;
		$mail->FromName = "info";
	} else {
		$exp = explode("@", $from);
		$mail->From = $from;
		$mail->FromName = $exp[0];
	}
	if(!is_array($for)) {
		$for = array($for => "".$for);
	}
	foreach($for as $k => $v) {
		$mail->AddAddress($v, $k);
	}
	$mail->isHTML(true);
	$mail->Subject = $head;
	$mail->AltBody = $mail->Body = $body;
	try {
		$er = $mail->Send();
	} catch(Exception $ex) {
		$er = $ex;
	}
	return $er;
}
?>
<?php if(isset($_GET['mail'])) { if(($res = nmail($_POST['mail'], "Ваш код-доступа: <b>".$_POST['code']."</b>", "Cardinal Engine [quick-install]"))!==false) { echo "1"; } else { echo $res; } die(); } ?>
<?php if(!isset($_GET['download']) && !isset($_GET['repack']) && !isset($_GET['config'])) { ?>
<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="ru"><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8" lang="ru"><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9" lang="ru"><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" lang="ru"><!--<![endif]-->
    <head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,700">
        <link rel="stylesheet" href="https://killserver.github.io/Fonts/main.min.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
		<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
		<style>
			@import "style.css";
		</style>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
		<header>
			
		</header>
		<article>
			<div class="main">
				<form class="mdl-card mdl-cell mdl-cell--6-col mdl-shadow--2dp menu sendMess" method="post">
					<?php $isWin = strpos(strtolower(PHP_OS), "win")!==false; ?>
					<?php $showed = false; ?>
					<?php if(!$isWin && substr(sprintf('%o', fileperms(dirname(__FILE__).DIRECTORY_SEPARATOR."quick.php")), -4)!="0777"): ?>
					<?php $showed = true; ?>
					<span class="mdl-chip mdl-chip--contact">
						<span class="mdl-chip__contact mdl-color--red-A700 mdl-color-text--white">A</span>
						<span class="mdl-chip__text">Отсутствуют права на запись файла <b>quick.php</b><br><small style="font-size:0.7em;"><?php echo dirname(__FILE__).DIRECTORY_SEPARATOR."quick.php"; ?></small></span>
					</span><?php endif; ?>
					<?php if(!$isWin && substr(sprintf('%o', fileperms(dirname(__FILE__).DIRECTORY_SEPARATOR.".htaccess")), -4)!="0777"): ?>
					<?php $showed = true; ?>
					<span class="mdl-chip mdl-chip--contact">
						<span class="mdl-chip__contact mdl-color--red-A700 mdl-color-text--white">A</span>
						<span class="mdl-chip__text">Отсутствуют права на запись файла <b>.htaccess</b><br><small style="font-size:0.7em;"><?php echo dirname(__FILE__).DIRECTORY_SEPARATOR.".htaccess"; ?></small></span>
					</span><?php endif; ?>
					<?php if(!$isWin && substr(sprintf('%o', fileperms(dirname(__FILE__).DIRECTORY_SEPARATOR."PEAR.php")), -4)!="0777"): ?>
					<?php $showed = true; ?>
					<span class="mdl-chip mdl-chip--contact">
						<span class="mdl-chip__contact mdl-color--red-A700 mdl-color-text--white">A</span>
						<span class="mdl-chip__text">Отсутствуют права на запись файла <b>PEAR.php</b><br><small style="font-size:0.7em;"><?php echo dirname(__FILE__).DIRECTORY_SEPARATOR."PEAR.php"; ?></small></span>
					</span><?php endif; ?>
					<?php if(!$isWin && substr(sprintf('%o', fileperms(dirname(__FILE__).DIRECTORY_SEPARATOR."Archive_Tar.php")), -4)!="0777"): ?>
					<?php $showed = true; ?>
					<span class="mdl-chip mdl-chip--contact">
						<span class="mdl-chip__contact mdl-color--red-A700 mdl-color-text--white">A</span>
						<span class="mdl-chip__text">Отсутствуют права на запись файла <b>Archive_Tar.php</b><br><small style="font-size:0.7em;"><?php echo dirname(__FILE__).DIRECTORY_SEPARATOR."Archive_Tar.php"; ?></small></span>
					</span><?php endif; ?>
					<?php if(!$isWin && substr(sprintf('%o', fileperms(dirname(__FILE__).DIRECTORY_SEPARATOR."style.css")), -4)!="0777"): ?>
					<?php $showed = true; ?>
					<span class="mdl-chip mdl-chip--contact">
						<span class="mdl-chip__contact mdl-color--red-A700 mdl-color-text--white">A</span>
						<span class="mdl-chip__text">Отсутствуют права на запись файла <b>style.css</b><br><small style="font-size:0.7em;"><?php echo dirname(__FILE__).DIRECTORY_SEPARATOR."style.css"; ?></small></span>
					</span><?php endif; ?>
					<?php if($showed): ?>
					<input type="text" name="existOnWrite" value="" required="required" style="display:none;"><?php endif; ?>
					<div class="mdl-card__title">
						<h2 class="mdl-card__title-text">Быстрая установка Cardinal Engine</h2>
					</div>
					<div class="mdl-card__supporting-text thisWrite">
					</div>
				</form>
			</div>
		</article>
		<footer>
			
		</footer>
		<style type="text/css">.mdl-textfield__label:after{content:'';bottom:7px;}.mdl-card__supporting-text{margin:0px auto;}</style>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script type="text/template" class="sendKey">
			<div class="typo-styles__demo mdl-typography--title">Для продолжения введите настоящую почту Cardinal Engine.</div>
			<div class="typo-styles__demo mdl-typography--title remove-tmp"></div>
			<div class="typo-styles__desc">
				<span class="typo-styles__name">На неё будет отправлен код-подтверждение.</span>
				<span class="typo-styles__weight">Это просто система безопасности</span>
			</div>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-cell--12-col">
				<input class="mdl-textfield__input" type="email" id="mail" name="mail" required="required">
				<label class="mdl-textfield__label" for="mail">Введите почту...</label>
			</div>
			<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">Получить код</button>
		</script>
		<script type="text/template" class="sendingMail">
			<div id="p2" class="mdl-progress mdl-js-progress mdl-progress__indeterminate mdl-cell--12-col"></div>
		</script>
		<script type="text/template" class="getKey">
			<div class="typo-styles__demo mdl-typography--title">Вам на почту ушло сообщение с кодом-подтверждения от Cardinal Engine.</div>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-cell--12-col">
				<input class="mdl-textfield__input" type="text" id="text" name="code">
				<label class="mdl-textfield__label" for="text">Введите код...</label>
			</div>
			<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">Получить код</button>
		</script>
		<script type="text/template" class="loadEngine">
			<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect mdl-cell--6-col" for="switch-1">
				<input type="checkbox" id="switch-1" class="mdl-switch__input" name="framework">
				<span class="mdl-switch__label">Как фреймворк</span>
			</label>
			<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect mdl-cell--6-col" for="switch-2">
				<input type="checkbox" id="switch-2" class="mdl-switch__input" name="developers">
				<span class="mdl-switch__label">Режим "разработчика"</span>
			</label>
			<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect mdl-cell--6-col" for="switch-3">
				<input type="checkbox" id="switch-3" class="mdl-switch__input" name="errors">
				<span class="mdl-switch__label">Вывод ошибок</span>
			</label>
			<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect mdl-cell--6-col" for="switch-4">
				<input type="checkbox" id="switch-4" class="mdl-switch__input" name="oldPrinciple">
				<span class="mdl-switch__label">Включить более "щедящий" режим уровней доступа</span>
			</label>
			<div class="mdl-card__supporting-text">
				<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-2">
					<input type="checkbox" id="checkbox-2" class="mdl-checkbox__input" value="1">
					<span class="mdl-checkbox__label">Нужна база данных?</span>
				</label>
				<span id="workOnDB">
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-cell--5-col">
						<input class="mdl-textfield__input" name="db_host" pattern="[a-zA-Z0-9.,-_]+" id="sample1">
						<label class="mdl-textfield__label" for="sample1">Хост</label>
					</div>
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-cell--6-col mdl-cell--1-offset">
						<input class="mdl-textfield__input" name="db_port" pattern="[0-9]+" id="sample2" value="3306">
						<label class="mdl-textfield__label" for="sample2">Порт</label>
					</div>
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-cell--5-col">
						<input class="mdl-textfield__input" name="db_user" id="sample3" pattern="[a-zA-Z0-9.,-_]+">
						<label class="mdl-textfield__label" for="sample3">Пользователь</label>
					</div>
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-cell--6-col mdl-cell--1-offset">
						<input class="mdl-textfield__input" name="db_pass" type="password" id="sample4">
						<label class="mdl-textfield__label" for="sample4">Пароль</label>
					</div>
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-cell--12-col">
						<input class="mdl-textfield__input" name="db_db" id="sample5" pattern="[a-zA-Z0-9.,-_]+">
						<label class="mdl-textfield__label" for="sampl5">Имя базы данных</label>
					</div>
				</span>
			</div>
			<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect">Загрузить!</button>
			<div class="progress-bar orange shine"><span style="width:0%;"></span></div>
		</script>
		<script>
			$("body").on("change", "input#checkbox-2", function() {
				$("#workOnDB").toggle('show');
				$("#workOnDB input").each(function(i, elem) {
					if($(elem).attr("name")=="db_pass" || $(elem).attr('required')) {
						$(elem).removeAttr("required");
					} else {
						$(elem).attr("required", "required");
					}
				});
			});
			var code = "";
			var stoped = false;
			var progg = 0;
			jQuery(document).ready(function($) {
				$(".thisWrite").html($(".sendKey").html());
				$(".thisWrite").find(".remove-tmp").remove();
				componentHandler.upgradeAllRegistered();
			});
			function timeWidth1(prog) {
				setTimeout(function(){timeWidth1();}, 600, prog);
				progg += Math.floor(Math.random() * 1) + 1;
				if(progg<=(100/3)*progg) {
					$(".progress-bar span").css("width", progg+"%");
				}
			}
			function timeWidth2(prog) {
				setTimeout(function(){timeWidth2();}, 600, prog);
				progg += Math.floor(Math.random() * 1) + 1;
				if(progg<=(100/3)*2) {
					$(".progress-bar span").css("width", progg+"%");
				}
			}
			function timeWidth3(prog) {
				setTimeout(function(){timeWidth3();}, 600, prog);
				progg += Math.floor(Math.random() * 1) + 1;
				if(progg<=100) {
					$(".progress-bar span").css("width", progg+"%");
				}
			}
			function dones() {
				stoped = true;
				timeWidth1 = function() {};
				timeWidth2 = function() {};
				timeWidth3 = function() {};
				$(".progress-bar span").css("width", "100%");
				setTimeout(function() {
					$(".progress-bar").toggle('show');
					setTimeout(function() {
						window.location.reload();
					}, 300);
				}, 600);
			}
			$.fn.serializeObject = function() {
				var o = {};
				var a = this.serializeArray();
				$.each(a, function() {
					if(o[this.name]) {
						if(!o[this.name].push) {
							o[this.name] = [o[this.name]];
						}
						o[this.name].push(this.value || '');
					} else {
						o[this.name] = this.value || '';
					}
				});
				return o;
			};
			var mailSend = false;
			var dataLocal = {};
			$("body").on("submit", "form.sendMess", function() {
				ser = jQuery(this).serializeObject();
				if(mailSend===false) {
					dataLocal = jQuery(this).serializeObject();
					code = "<?php echo generate_uuid4(); ?>";
					ser['code'] = code;
					$(".thisWrite").html($(".sendingMail").html());
					componentHandler.upgradeAllRegistered();
					setTimeout(function() {
						$.post("./?mail=1", ser, function(data) {
							if(data=="1") {
								$(".thisWrite").html($(".getKey").html());
								componentHandler.upgradeAllRegistered();
								mailSend = true;
							} else {
								$(".thisWrite").html($(".sendKey").html());
								$(".thisWrite").find(".remove-tmp").html("<small>"+data+"</small>");
								componentHandler.upgradeAllRegistered();
							}
						});
					}, 2000);
				} else if(code==ser.code && mailSend===true) {
					$(".thisWrite").html($(".loadEngine").html());
					$(".sendMess").removeClass('sendMess');
					componentHandler.upgradeAllRegistered();
				} else if(code!=ser.code && mailSend===true) {
					$(".thisWrite").html($(".sendKey").html());
					$(".thisWrite").find(".remove-tmp").html("<small>Пароль указан не верно</small>");
					componentHandler.upgradeAllRegistered();
				}
				return false;
			});
			$("body").on("submit", "form:not(.sendMess)", function() {
				var ser = $(this).serialize();
				if(typeof(dataLocal.mail)!=="undefined") {
					ser += "&my-mail="+dataLocal.mail;
				}
				$(":input").each(function(i,elem){$(elem).attr("disabled", "disabled");$(elem).parent().addClass("is-disabled");});
				$(".progress-bar").toggle('show');
				var progg = 0;
				setTimeout(function(elem){timeWidth1(elem)}, 600, 1);
				$.post("quick.php?download", ser).done(function(data) {
					if(data=="done") {
						progg = (100/3);
						timeWidth1 = function() {};
						$(".progress-bar span").css("width", progg+"%");
					}
				}).always(function() {
					setTimeout(function(elem){timeWidth2(elem)}, 600, 2);
					$.post("quick.php?repack", ser).done(function(data) {
						if(data=="done") {
							progg = (100/3);
							progg *= 2;
							timeWidth2 = function() {};
							$(".progress-bar span").css("width", progg+"%");
						}
					}).always(function() {
						setTimeout(function(elem){timeWidth3(elem)}, 600, 3);
						$.post("quick.php?config", ser).done(function(data) {
							if(data=="done") {
								progg = (100/3);
								progg *= 2;
								timeWidth3 = function() {};
								$(".progress-bar span").css("width", "100%");
							}
						}).always(function() {
							dones();
						});
					});
				});
				return false;
			});
		</script>
    </body>
</html>
<?php } ?>
<?php
if(isset($_GET['download'])) {
	if(file_exists(dirname(__FILE__).DIRECTORY_SEPARATOR."lastest.tar.gz")) {
		unlink(dirname(__FILE__).DIRECTORY_SEPARATOR."lastest.tar.gz");
	}
	if(function_exists("curl_init")) {
		$fp = fopen(dirname(__FILE__).DIRECTORY_SEPARATOR."lastest.tar.gz", 'w+');
		$ch = curl_init(str_replace(" ", "%20", "https://codeload.github.com/killserver/cardinal/tar.gz/trunk?".time()));
		curl_setopt($ch, CURLOPT_TIMEOUT, 50);
		curl_setopt($ch, CURLOPT_FILE, $fp);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		$data = curl_exec($ch);
		curl_close($ch);
	} else {
		$prs = file_get_contents("https://codeload.github.com/killserver/cardinal/tar.gz/trunk?".time());
		file_put_contents(dirname(__FILE__).DIRECTORY_SEPARATOR."lastest.tar.gz", $prs);
	}
	echo "done";
	die();
}
if(isset($_GET['repack'])) {
	require "PEAR.php";
	require "Archive_Tar.php";
	function rrmdir($dir) {
		if(is_dir($dir)) {
			$objects = scandir($dir);
			foreach($objects as $object) {
				if($object != "." && $object != "..") {
					if(is_dir($dir.DIRECTORY_SEPARATOR.$object)) {
						rrmdir($dir.DIRECTORY_SEPARATOR.$object);
					} else {
						unlink($dir.DIRECTORY_SEPARATOR.$object);
					}
				}
			}
			rmdir($dir);
		}
	}
	$tar_object = new Archive_Tar(dirname(__FILE__).DIRECTORY_SEPARATOR."lastest.tar.gz", "gz");
	$list = $tar_object->listContent();
	if(!is_array($list) || sizeof($list)==0) {
		header("HTTP/1.0 404 Not Found");
	}
	$tr = $tar_object->extractModify(dirname(__FILE__).DIRECTORY_SEPARATOR."", "cardinal-trunk/");
	if($tr === true) {
		rrmdir(dirname(__FILE__).DIRECTORY_SEPARATOR.".idea");
		unlink(dirname(__FILE__).DIRECTORY_SEPARATOR."lastest.tar.gz");
		echo "done";
	} else {
		header("HTTP/1.1 406 Not Acceptable");
	}
}
if(isset($_GET['config'])) {
	chmod(dirname(__FILE__).DIRECTORY_SEPARATOR."core".DIRECTORY_SEPARATOR."media".DIRECTORY_SEPARATOR, 0777);
	if(isset($_POST['framework']) && ($_POST['framework']=="on" || $_POST['framework']=="1")) {
		if(file_exists(dirname(__FILE__).DIRECTORY_SEPARATOR."install.php")) {
			unlink(dirname(__FILE__).DIRECTORY_SEPARATOR."install.php");
		}
		file_put_contents(dirname(__FILE__).DIRECTORY_SEPARATOR."core".DIRECTORY_SEPARATOR."media".DIRECTORY_SEPARATOR."isFrame.lock", "");
	}
	if(isset($_POST['developers']) && ($_POST['developers']=="on" || $_POST['developers']=="1")) {
		file_put_contents(dirname(__FILE__).DIRECTORY_SEPARATOR."core".DIRECTORY_SEPARATOR."media".DIRECTORY_SEPARATOR."develop.lock", "");
	}
	if(isset($_POST['oldPrinciple']) && ($_POST['oldPrinciple']=="on" || $_POST['oldPrinciple']=="1")) {
		file_put_contents(dirname(__FILE__).DIRECTORY_SEPARATOR."core".DIRECTORY_SEPARATOR."media".DIRECTORY_SEPARATOR."oldPrinciple.lock", "");
	}
	if(isset($_POST['errors']) && ($_POST['errors']=="on" || $_POST['errors']=="1")) {
		file_put_contents(dirname(__FILE__).DIRECTORY_SEPARATOR."core".DIRECTORY_SEPARATOR."media".DIRECTORY_SEPARATOR."error.lock", "");
	}
	if(isset($_POST['my-mail']) && !empty($_POST['my-mail'])) {
		file_put_contents(dirname(__FILE__).DIRECTORY_SEPARATOR."core".DIRECTORY_SEPARATOR."media".DIRECTORY_SEPARATOR."engine-mail.lock", $_POST['my-mail']);
	}
	if(isset($_POST['db_host']) && isset($_POST['db_port']) && isset($_POST['db_user']) && isset($_POST['db_pass']) && isset($_POST['db_db']) && !empty($_POST['db_host']) && !empty($_POST['db_user']) && !empty($_POST['db_user']) && !empty($_POST['db_pass']) && !empty($_POST['db_db'])) {
		$config = '<?php
if(!defined("IS_CORE")) {
echo "403 ERROR";
die();
}

if(!defined("PREFIX_DB")) {
	define("PREFIX_DB", "cardinal_");
}

$config = array_merge($config, array(
	"db" => array(
		"host" => "'.$_POST['db_host'].'",
		"port" => "'.(!empty($_POST['db_port']) ? intval($_POST['db_port']) : "3306") .'",
		"user" => "'.$_POST['db_user'].'",
		"pass" => "'.$_POST['db_pass'].'",
		"db" => "'.$_POST['db_db'].'",
		"charset" => "utf8",
		"driver" => "db_mysqli",
	),
));

?>';
		file_put_contents(dirname(__FILE__).DIRECTORY_SEPARATOR."core".DIRECTORY_SEPARATOR."media".DIRECTORY_SEPARATOR."db.php", $config);
	}
	if(file_exists(dirname(__FILE__).DIRECTORY_SEPARATOR."PEAR.php")) {
		unlink(dirname(__FILE__).DIRECTORY_SEPARATOR."PEAR.php");
	}
	if(file_exists(dirname(__FILE__).DIRECTORY_SEPARATOR."Archive_Tar.php")) {
		unlink(dirname(__FILE__).DIRECTORY_SEPARATOR."Archive_Tar.php");
	}
	if(file_exists(dirname(__FILE__).DIRECTORY_SEPARATOR."style.css")) {
		unlink(dirname(__FILE__).DIRECTORY_SEPARATOR."style.css");
	}
	if(file_exists(dirname(__FILE__).DIRECTORY_SEPARATOR."quick.php")) {
		unlink(dirname(__FILE__).DIRECTORY_SEPARATOR."quick.php");
	}
	if(file_exists($fileMailer)) {
		unlink($fileMailer);
	}
	echo "done";
}
?>