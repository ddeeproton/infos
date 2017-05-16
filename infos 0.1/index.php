<?php
function html_header(){
	global $listDir, $files;
	?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>
		infos 
		[<?php
			$basename = isset($listDir[$_GET['base']]) ? files::filename($listDir[$_GET['base']]) : "";
			$filename = isset($files[$_GET['page']]) ? files::filename($files[$_GET['page']]): "";
			echo $basename." - ".$filename;
		?>]
		</title>
		<style>
			body {background-color:black;color:white;margin:0;padding:0;}
			.clr {clear:both;}
			textarea{overflow: auto;}
			h1 {margin:0;padding:0;}
			.btnExpand_leftMenu {position:relative;bottom:5px;margin-right:15px;}
			textarea {width:94%;height:500px;padding:10px;background-color:#000;color:#fff;}
			.left {height:614px;overflow-y:scroll;white-space:nowrap;}
			.leftmenu ul {margin:0;padding:0;outline:0;}
			ul.submenu {display:none;padding-top:5px;padding-left:60px;}
			.leftmenu li {padding:5px 0;list-style:none;}
			.leftmenu li a {font-size:18px;color:#fff;text-decoration:none;font-family:arial;}
			.leftmenu a.selected {padding:5px;font-weight:bold;background-image:linear-gradient(0deg,#777, #333); border-radius:5px;border:1px solid #fff;}
			.leftmenu li.selected a {margin:2px;padding:10px;display:block;font-weight:bold;background-image:linear-gradient(0deg,#777, #333);border-radius:5px;border:1px solid #fff;}
			.leftmenu li .btnexpand {margin-right:26px;}
			ul.buttonsList {outline:0;padding:0;margin:0;}
			ul.buttonsList li {float:left;margin:10px;padding:10px;list-style:none;}
			ul.buttonsList li h2 {padding:0;margin:0;}
		</style>
		<script type="text/javascript" src="includes/js/jquery.js"></script>
		<script language="Javascript" type="text/javascript" src="modules/editarea_0_8_2/edit_area/edit_area_full.js"></script>
		<script language="Javascript" type="text/javascript">
			<?php 
			$syntax = array(
				"anglais" => "",
				"Bat" => "perl",
				"C" => "c",
				"C#" => "cpp",
				"CPP" => "cpp",
				"CSS" => "css",
				"Delphi" => "pas",
				"Java" => "java",
				"Javascript" => "js",
				"Linux" => "robotstxt",
				"MySQL" => "sql",
				"PHP" => "php",
				"NSIS" => "nsis",
				"Python" => "python",
				"Réseau" => "",
				"Visual Basic Application" => "vb",
				"Visual Basic Script" => "vb",
				"Windows" => "robotstxt"
			);
			?>
			// initialisation
			editAreaLoader.init({
				id: "editor_readonly"	// id of the textarea to transform		
				,is_editable: false
				,start_highlight: true	// if start with highlight
				,allow_resize: "both"
				,allow_toggle: false
				,word_wrap: true
				,language: "en"
				,syntax: "<?php echo $syntax[$basename]; ?>"	
				,toolbar: ""
			});
			
			// initialisation
			editAreaLoader.init({
				id: "editor"	// id of the textarea to transform		
				,is_editable: true
				,start_highlight: true	// if start with highlight
				,allow_resize: "both"
				,allow_toggle: false
				,word_wrap: true
				,language: "en"
				,syntax: "<?php echo $syntax[$basename]; ?>"	
				,toolbar: ""
			});
			
			/*
			
			editAreaLoader.init({
				id: "example_1"	// id of the textarea to transform		
				,start_highlight: true	// if start with highlight
				,allow_resize: "both"
				,allow_toggle: true
				,word_wrap: true
				,language: "en"
				,syntax: "php"	
			});
			
			
			editAreaLoader.init({
				id: "example_2"	// id of the textarea to transform	
				,start_highlight: true
				,allow_toggle: false
				,language: "en"
				,syntax: "html"	
				,toolbar: "search, go_to_line, |, undo, redo, |, select_font, |, syntax_selection, |, change_smooth_selection, highlight, reset_highlight, |, help"
				,syntax_selection_allow: "css,html,js,php,python,vb,xml,c,cpp,sql,basic,pas,brainfuck"
				,is_multi_files: true
				,EA_load_callback: "editAreaLoaded"
				,show_line_colors: true
			});
			
			
			editAreaLoader.init({
				id: "example_4"	// id of the textarea to transform		
				//,start_highlight: true	// if start with highlight
				//,font_size: "10"	
				,allow_resize: "no"
				,allow_toggle: true
				,language: "de"
				,syntax: "python"
				,load_callback: "my_load"
				,save_callback: "my_save"
				,display: "later"
				,replace_tab_by_spaces: 4
				,min_height: 350
			});
			*/
			editAreaLoader.init({
				id: "example_3"	// id of the textarea to transform	
				,start_highlight: true	
				,font_size: "8"
				,font_family: "verdana, monospace"
				,allow_resize: "y"
				,allow_toggle: false
				,language: "fr"
				,syntax: "css"	
				,toolbar: "new_document, save, load, |, charmap, |, search, go_to_line, |, undo, redo, |, select_font, |, change_smooth_selection, highlight, reset_highlight, |, help"
				,load_callback: "my_load"
				,save_callback: "my_save"
				,plugins: "charmap"
				,charmap_default: "arrows"
					
			});
			
			
			// callback functions
			function my_save(id, content){
				alert("Here is the content of the EditArea '"+ id +"' as received by the save callback function:\n"+content);
			}
			
			function my_load(id){
				editAreaLoader.setValue(id, "The content is loaded from the load_callback function into EditArea");
			}
			
			function test_setSelectionRange(id){
				editAreaLoader.setSelectionRange(id, 10, 15);
			}
			
			function test_getSelectionRange(id){
				var sel =editAreaLoader.getSelectionRange(id);
				alert("start: "+sel["start"]+"\nend: "+sel["end"]); 
			}
			
			function test_setSelectedText(id){
				text= "[REPLACED SELECTION]"; 
				editAreaLoader.setSelectedText(id, text);
			}
			
			function test_getSelectedText(id){
				alert(editAreaLoader.getSelectedText(id)); 
			}
			
			function editAreaLoaded(id){
				if(id=="example_3")
				{
					open_file1();
					open_file2();
				}
			}
			
			function open_file1()
			{
				var new_file= {id: "to\\ é # € to", text: "$authors= array();\n$news= array();", syntax: 'php', title: 'beautiful title'};
				editAreaLoader.openFile('example_3', new_file);
			}
			
			function open_file2()
			{
				var new_file= {id: "Filename", text: "<a href=\"toto\">\n\tbouh\n</a>\n<!-- it's a comment -->", syntax: 'html'};
				editAreaLoader.openFile('example_3', new_file);
			}
			
			function close_file1()
			{
				editAreaLoader.closeFile('example_3', "to\\ é # € to");
			}
			
			function toogle_editable(id)
			{
				editAreaLoader.execCommand(id, 'set_editable', !editAreaLoader.execCommand(id, 'is_editable'));
			}
		
		</script>
	</head>
	<body>
	<?php
}

require_once("includes/files.php");

if(!isset($_GET['page'])) $_GET['page'] = 0;
if(!isset($_GET['base'])) $_GET['base'] = 0; 
$dbDir = "Bases";
$isLogged = isLogged();

refresh_files();
events_click();

html_header();
echo '<table width=100%><tr><td valign=top style="width:10%;white-space:nowrap;">';
echo '<div class="left">';
leftmenu();
echo '</div>';
echo '</td><td valign=top>';
breadcrumb();
if($isLogged) {
	editPage();
	showbuttons();
} else {
	showPage();
	show_login();	
}
echo '</td></tr></table>';

function ignorecasesort(&$array) {

  /*Make each element it's lowercase self plus itself*/
  /*(e.g. "MyWebSite" would become "mywebsiteMyWebSite"*/
  for ($i = 0; $i < sizeof($array); $array[$i] = strtolower($array[$i]).$array[$i], $i++);

  /*Sort it -- only the lowercase versions will be used*/
  sort($array);

  /*Take each array element, cut it in half, and add the latter half to a new array*/
  /*(e.g. "mywebsiteMyWebSite" would become "MyWebSite")*/
  for ($i = 0; $i < sizeof($array); $i++) {
    $tab = $array[$i];
    $array[$i] = substr($tab, (strlen($tab)/2), strlen($tab));
  }
}


function refresh_files() {
	global $listDir, $files, $dbDir;
	if(!is_dir($dbDir)) files::createDir($dbDir);
	$listDir = files::listFilesInDir($dbDir, GLOB_ONLYDIR);
	$tabFiles = files::listFilesInDir($listDir[$_GET['base']]);
	ignorecasesort($tabFiles);
	$files = isset($listDir[$_GET['base']]) ? $tabFiles : array();
} 

function breadcrumb() {
	global $listDir, $files;
	echo '<h1>';
	echo '<input type="button" class="btnExpand_leftMenu" value="<" />';
	echo isset($listDir[$_GET['base']]) ? files::filename($listDir[$_GET['base']])." - ": "";
	echo isset($files[$_GET['page']]) ? files::filename($files[$_GET['page']]): "";
	echo '</h1>';
}

function leftmenu(){
	global $listDir;
	 echo '<ul class="leftmenu">';
	for($i=0;$i<count($listDir);$i++){
		$dir = $listDir[$i];
		echo "<li class=lvl1>";  
		echo '<input type=button class=btnexpand value="+" />';
		$tabFiles = files::listFilesInDir($listDir[$i]);
		ignorecasesort($tabFiles);
		$files = $tabFiles;
		
		echo '<a href="?base='.$i.'">'.files::filename($dir)." (".count($files).")</a>";
		
		echo '<ul class="submenu">';
		for($i2=0;$i2<count($files);$i2++){   
			echo "<li>";  
			echo '<a href="?base='.$i.'&page='.$i2.'">'.files::filename($files[$i2])."</a>";
			echo "</li>";  
		}
		echo "</ul>";
		echo "</li>";
	}
	echo "</ul>";
	?>
	<script type="text/javascript">
		function setCookie(key, value) {
			var expires = new Date();
			expires.setTime(expires.getTime() + (1 * 24 * 60 * 60 * 1000));
			document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
		}

		function getCookie(key) {
			var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
			return keyValue ? keyValue[2] : null;
		}

		$(document).ready(function() {
			$("ul.leftmenu li.lvl1:eq(<?php echo $_GET['base']; ?>) a:eq(0)").addClass("selected");
			$("ul.leftmenu li.lvl1:eq(<?php echo $_GET['base']; ?>) .submenu").show();		
			$("ul.leftmenu li.lvl1:eq(<?php echo $_GET['base']; ?>) .submenu li:eq(<?php echo $_GET['page']; ?>)").addClass("selected");
		
			$("ul.leftmenu li.lvl1").each(function(i) {
				$("ul.leftmenu li.lvl1:eq("+i+") .btnexpand").click(function() {
					$("ul.leftmenu li.lvl1:eq("+i+") .submenu").fadeToggle();
				});
			});
			
			$(".left").scrollTop(getCookie("scrollTop"));
			$(window).on( "beforeunload", function() {
				setCookie("scrollTop", $(".left").scrollTop());
			});
		});
	</script>
	<script type="text/javascript">
		function resized() {
			$(".left").height($(window).height()-25);
			$("textarea.txt_content").height($(window).height()-$(".buttonsForm").height()-$(".loginForm").height()-65);
		}
		$(document).ready(function() {
			resized();
			$(window).resize(function() {
				resized()
			});
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function() {
			$("form").submit(function(event) {
				if(!confirm("Do you really want to submit the form?")) 
					event.preventDefault();
			});
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function() {
			$(".btnExpand_leftMenu").click(function() {
				$(".left").fadeToggle(function(){
					if($(this).is(":visible")) {
						$(".btnExpand_leftMenu").val("<");
					}else{
						$(".btnExpand_leftMenu").val(">");	
					}
				});
			});
		});
	</script>
	<?php
}

function showPage(){
	global $files;
	?>
		<textarea id="editor_readonly" class="txt_content" wrap="off" readonly="readonly"><?php if(isset($files[$_GET['page']])) readfile($files[$_GET['page']]); ?></textarea>
	<?php
}
function editPage(){
	global $files;
	?>
	<form method="post">
		<textarea id="editor" class="txt_content" name="pageContent" wrap="off"><?php if(isset($files[$_GET['page']])) readfile($files[$_GET['page']]); ?></textarea>
		<div class="buttonsForm">
			<ul class="buttonsList">
				<li>
						<input type="hidden" name="action" value="createPage" />
						<input type="hidden" name="base" value="<?php  echo $_GET['base']; ?>" />
						<h2>Page name</h2>
						<input type="text" name="pageName" value="<?php if(isset($_GET['page']) && isset($files[$_GET['page']])) echo files::filename($files[$_GET['page']]); ?>"/>
						<input type="submit" value="Enregistrer" />
					</form>
				</li>
				<?php
}


function showbuttons(){
	?>
			<li>
				<h2>Create Dir</h2>
				<form>
					<input type="text" name="dir" />
					<input type="hidden" name="action" value="createDir" />
					<input type="submit" value="Create" />
				</form>
			</li>
			<li>
				<h2>Delete dir</h2>
				<form>
					<input type="hidden" name="action" value="deleteDir" />
					<input type="hidden" name="base" value="<?php  echo $_GET['base']; ?>" />
					<input type="submit" value="Delete" />
				</form>
			</li>
			<li>
				<h2>Delete Page</h2>
				<form>
					<input type="hidden" name="action" value="deletePage" />
					<input type="hidden" name="base" value="<?php  echo $_GET['base']; ?>" />
					<input type="hidden" name="page" value="<?php  echo $_GET['page']; ?>" />
					<input type="submit" value="Delete" />
				</form>
			</li>
			<li>
				<h2>Log out</h2>
				<form method="post">
					<input type="hidden" name="action" value="logout" >
					<input type="submit" value="Log out" >
				</form>
			</li>
		</ul>
		<div class="clr"></div>
	</div>
	<?php	
}


// == BUTTONS ==

function events_click(){
	global $isLogged;
	if(isset($_POST['action'])) $_GET['action'] = $_POST['action'];
	if(isset($_GET['action'])){
		switch($_GET['action']){
			case 'createDir':
				if($isLogged) button_createDir();
			break;
			case 'createPage':
				if($isLogged) button_createPage();
			break;
			case 'deleteDir':
				if($isLogged) button_deleteDir();
			break;
			case 'deletePage':
				if($isLogged) button_deletePage();
			break;
			case 'login':
				button_login();
			break;
			case 'logout':
				if($isLogged) button_logout(); 
			break;
		}
	}
}

function button_createDir(){
	global $dbDir, $listDir;
	$checkName = str_replace(" ","",$_GET['dir']);
	if(!empty($checkName)) {
		files::createDir($dbDir."/".$_GET['dir']);
		refresh_files();
		$base = 0;
		for($i=0;$i<count($listDir);$i++){
			if($listDir[$i] == $dbDir."/".$_GET['dir']) {
				$base = $i;
				break;
			}
		}
		
		header('Location: '.$_SERVER['SCRIPT_NAME'].'?base='.$base.'&page=0');
		
	}
}
function button_createPage(){
	global $dbDir, $listDir, $files;
	$fileToCreate = $listDir[$_POST['base']]."/".$_POST['pageName'];
	//unlink($fileToCreate);
	files::writeFast(stripslashes($fileToCreate), stripslashes($_POST['pageContent']));
	refresh_files();
	$page = 0;
	for($i=0;$i<count($files);$i++){
		if($files[$i] == stripslashes($fileToCreate)) {
			$page = $i;
			break;
		}
	}
	header('Location: '.$_SERVER['SCRIPT_NAME'].'?base='.$_POST['base'].'&page='.$page);
}
function button_deleteDir(){
	global $listDir;
	if(rmdir($listDir[$_GET['base']]) ) {
		header('Location: '.$_SERVER['SCRIPT_NAME'].'?base='.$_GET['base'].'&page='.$_GET['page']);
	}
}
function button_deletePage(){
	global $files;
	if(unlink($files[$_GET['page']])) { 
		header('Location: '.$_SERVER['SCRIPT_NAME'].'?base='.$_GET['base'].'&page='.$_GET['page']);
	}
}

// ===== COOKIES ======
function set_cookie($name, $value) {
	setcookie($name, $value, time()+3600);
}
function get_cookie($name) {
	return isset($_COOKIE[$name]) ? $_COOKIE[$name] : '';
}

// ===== LOGIN ======
function isLogged() {
		$user = get_cookie('u');
		$session_md5 = get_cookie('s');
		$session_dir = "session";
		$cache_md5 = files::readFastToString($session_dir."/".$user);
		return ($session_md5 == $cache_md5 && $session_md5 != '');
}

function button_login() {
	if($_POST['u'] == "admin" && $_POST['p'] == "admin") {
		$session_md5 = md5($_POST['u'].date("HisdmY"));
		set_cookie('u', $_POST['u']);
		set_cookie('s', $session_md5);
		$session_dir = "session";
		if(!is_dir($session_dir)) files::createDir($session_dir);
		files::writeFast($session_dir."/".$_POST['u'], $session_md5);
		header('Location: '.$_SERVER['SCRIPT_NAME'].'?base='.$_GET['base'].'&page='.$_GET['page']);
	}
}
function button_logout() {
	set_cookie('u', '');
	set_cookie('s', '');
	header('Location: '.$_SERVER['SCRIPT_NAME'].'?base='.$_GET['base'].'&page='.$_GET['page']);	
}
function show_login() {
	?>
	<div class="loginForm">
		<form method="post">
			<label>
				Username:
				<input name="u" >
			</label>
			<label>
				Password:
				<input name="p" >
			</label>
			<input type="hidden" name="action" value="login" >
			<input type="submit" value="Log in" >
		</form>
	</div>
	<?php
}

echo isset($debug) ? $debug : '';
?>
</body>
</html>