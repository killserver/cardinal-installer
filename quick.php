<?php set_time_limit(0); ini_set('max_execution_time', '0'); ?>
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
				<form class="mdl-card mdl-cell mdl-cell--6-col mdl-shadow--2dp menu" method="post">
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
					<div class="mdl-card__supporting-text">
						<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect mdl-cell--6-col" for="switch-1">
							<input type="checkbox" id="switch-1" class="mdl-switch__input" name="framework">
							<span class="mdl-switch__label">Как фреймворк</span>
						</label>
						<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect mdl-cell--6-col" for="switch-2">
							<input type="checkbox" id="switch-2" class="mdl-switch__input" name="developers">
							<span class="mdl-switch__label">Режим "разработчика"</span>
						</label>
						<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="switch-3">
							<input type="checkbox" id="switch-3" class="mdl-switch__input" name="errors">
							<span class="mdl-switch__label">Вывод ошибок</span>
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
					</div>
				</form>
			</div>
		</article>
		<footer>
			
		</footer>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script>
			$("input#checkbox-2").change(function() {
				$("#workOnDB").toggle('show');
				$("#workOnDB input").each(function(i, elem) {
					if($(elem).attr("name")=="db_pass" || $(elem).attr('required')) {
						$(elem).removeAttr("required");
					} else {
						$(elem).attr("required", "required");
					}
				});
			});
			var stoped = false;
			var progg = 0;
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
			$("form").submit(function() {
				var ser = $(this).serialize();
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
		file_put_contents(dirname(__FILE__).DIRECTORY_SEPARATOR."core".DIRECTORY_SEPARATOR."media".DIRECTORY_SEPARATOR."isFrame.lock", "");
	}
	if(isset($_POST['developers']) && ($_POST['developers']=="on" || $_POST['developers']=="1")) {
		file_put_contents(dirname(__FILE__).DIRECTORY_SEPARATOR."core".DIRECTORY_SEPARATOR."media".DIRECTORY_SEPARATOR."develop.lock", "");
	}
	if(isset($_POST['errors']) && ($_POST['errors']=="on" || $_POST['errors']=="1")) {
		file_put_contents(dirname(__FILE__).DIRECTORY_SEPARATOR."core".DIRECTORY_SEPARATOR."media".DIRECTORY_SEPARATOR."error.lock", "");
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
	unlink(__FILE__);
	echo "done";
}
?>