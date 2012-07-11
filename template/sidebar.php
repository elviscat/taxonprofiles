<?php

//echo HomePWDURL($hierarchy_level);
//session_start();


//Connect to database
$link = mysql_connect($host , $dbuser ,$dbpasswd); 
if (!$link) {
	die('Could not connect: ' . mysql_error());
}
//select database
mysql_select_db($dbname);

mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER_SET_CLIENT=utf8");
mysql_query("SET CHARACTER_SET_RESULTS=utf8");



function sidebar_docs_list($state){
	$sql_doc_list = "SELECT * FROM cc_doc WHERE state='".$state."'";
	//echo "sql_doc_list is :: ".$sql_doc_list.<BR />\n;
	$result_doc_list = mysql_query ($sql_doc_list) or die ("Invalid query :: doc_list");
	if(mysql_num_rows($result_doc_list) > 0){
		//echo "<h3>".$caption."</h3>";
		//echo "<table>\n";
		//echo "<tr>\n";
		//echo "<th align=\"left\">Taxon</td>\n";
		//echo "<th align=\"left\">Level</td>\n";
		//echo "<th align=\"left\">Title</td>\n";
		//echo "<th align=\"center\">State</td>\n";
		//echo "<th align=\"center\">Decision</td>\n";
		//echo "</tr>\n";				
		while ( $nb_doc_list = mysql_fetch_array($result_doc_list) ) {
			//echo "333:: ".HomePWDURL($hierarchy_level);
			
			echo "<li><a href=\"viewdoc.php?docid=".$nb_doc_list['docid']."\">".$nb_doc_list['taxon_name']." (".$nb_doc_list['lv'].")</a></li>\n";
			
			//echo "<li><a href=\"".HomePWDURL($hierarchy_level+1)."viewdoc.php?docid=".$nb_doc_list['docid']."\">".$nb_doc_list['taxon_name']." ".$nb_doc_list['lv']."</a></li>\n";
			
			//echo "<tr bgcolor=\"#FDDC99\">";
			//echo "<td align=\"left\"><a href=\"viewdoc.php?docid=".$nb_doc_list['docid']."\"><i>".$nb_doc_list['taxon_name']."</i></a></td>";
			
			
			//echo "<td align=\"left\"><a href=\"".HomePWDURL($hierarchy_level+1)."viewdoc.php?docid=".$nb_doc_list['docid']."\"><i>".$nb_doc_list['taxon_name']."</i></a></td>";
			//echo "<td align=\"left\">".$nb_doc_list['lv']."</td>";
			//echo "<td align=\"left\">".$nb_doc_list['title']."</td>";
			//echo "<td align=\"left\">".doc_state($nb_doc_list['state'])."</td>";
			//echo "<td align=\"left\">".doc_decision($nb_doc_list['decision'])."</td>";
		}
		//echo "</table>";
  	}else{
		echo "<p>Now there is no any documents here.</p>\n"; //Invalid Login
	}
}



?>
		<div id="sidebar">
			<h2>Navigation</h2>
			<ul class="sidemenu">				
	
				<li><a href="<?php //echo HomePWDURL($hierarchy_level); ?>index.php">Home</a></li>
				<li><a href="<?php //echo HomePWDURL($hierarchy_level); ?>admin.php">Workbench</a></li>
				<!--<li><a href="<?php //echo HomePWDURL($hierarchy_level); ?>admin.php">Admin</a></li>-->
				<!--
        <li><a href="index.php">Temp3</a></li>
				<li><a href="index.php">Temp4</a></li>	
				<li><a href="index.php">Temp5</a></li>
        -->	
			</ul>	
				
			<h2>Recent Promotive Changes</h2>
			<ul class="sidemenu">
				<?php
					sidebar_docs_list(0);
				?>
        <!--
				<li><a href="recentchangeslist.php">List1</a></li>
				<li><a href="recentchangeslist2.php">List2</a></li>
        -->
			</ul>

			<h2>Recent Approved Changes</h2>
			<ul class="sidemenu">
				<?php
					sidebar_docs_list(1);
				?>
        <!--
				<li><a href="recentchangeslist.php">List1</a></li>
				<li><a href="recentchangeslist2.php">List2</a></li>
        -->
			</ul>

<?php
?>
<!--
<SCRIPT language=javascript>
var isDOM = (document.getElementById ? true : false);
var isIE4 = ((document.all && !isDOM) ? true : false);
var isNS4 = (document.layers ? true : false);
var isNS = navigator.appName == "Netscape";

function getRef(id) {
 if (isDOM) return document.getElementById(id);
 if (isIE4) return document.all[id];
 if (isNS4) return document.layers[id];
}

function getSty(id) {
 x = getRef(id);
 return (isNS4 ? getRef(id) : getRef(id).style);
}

var scrollerHeight = 88;
var puaseBetweenImages = 3000;
var imageIdx = 0;

function moveRightEdge() {
 var yMenuFrom, yMenuTo, yOffset, timeoutNextCheck;

 if (isNS4) {
  yMenuFrom   = divMenu.top;
  yMenuTo     = windows.pageYOffset + 200;   // 困率 困摹
 } else if (isDOM) {
  yMenuFrom   = parseInt (divMenu.style.top, 10);
  yMenuTo     = (isNS ? window.pageYOffset : document.body.scrollTop) + 200; // 困率 困摹
 }
 timeoutNextCheck = 500;

 if (yMenuFrom != yMenuTo) {
  yOffset = Math.ceil(Math.abs(yMenuTo - yMenuFrom) / 20);
  if (yMenuTo < yMenuFrom)
   yOffset = -yOffset;
  if (isNS4)
   divMenu.top += yOffset;
  else if (isDOM)
   divMenu.style.top = parseInt (divMenu.style.top, 10) + yOffset;
   timeoutNextCheck = 10;
 }
 setTimeout ("moveRightEdge()", timeoutNextCheck);
}
</SCRIPT>

<DIV id=divMenu
style="right: 50px; VISIBILITY: visible; WIDTH: 45px; POSITION: absolute; TOP: 265px"><a href="#top"><img src="images/expand.png" name=Image60 width="34" height="17"
border=0></a>
</DIV>
<SCRIPT language=javascript>
<!--
if (isNS4) {
 var divMenu = document["divMenu"];
 divMenu.top = top.pageYOffset + 50;
 divMenu.visibility = "visible";
 moveRightEdge();
} else if (isDOM) {

 var divMenu = getRef('divMenu');
 divMenu.style.top = (isNS ? window.pageYOffset : document.body.scrollTop) + 50;
 divMenu.style.visibility = "visible";
 moveRightEdge();
}
//-->
<!--</SCRIPT>-->


<!--
<style type="text/css">
#qqonline{
background-color:red;
border: 1px solid #fcc;
position:absolute;
top:100px;
left:16px;
width:100px;
height:120px;
}
#qqonline1{
background-color:red;
border: 1px solid #fcc;
position:absolute;
top:100px;
right:16px;
width:100px;
height:120px;
}
</style>

<script type="text/javascript">
$(this).scroll(function() { // 页面发生scroll事件时触发
var bodyTop = 0;
if (typeof window.pageYOffset != 'undefined') {
bodyTop = window.pageYOffset;
}
else if (typeof document.compatMode != 'undefined' && document.compatMode != 'BackCompat')
{
bodyTop = document.documentElement.scrollTop;
}
else if (typeof document.body != 'undefined') {
bodyTop = document.body.scrollTop;
}
$("#qqonline").css("top", 100 + bodyTop) // 设置层的CSS样式中的top属性, 注意要是小写，要符合“标准”
$("#qqonline").text(bodyTop); // 设置层的内容，这里只是显示当前的scrollTop
$("#qqonline1").css("top", 100 + bodyTop)
$("#qqonline1").text(bodyTop);
});
</script>

<div id="qqonline">
QQ在线服务
</div>
<div id="qqonline1">
QQfsdf在线服务
</div>
-->




<!-- http://www.jb51.net/article/16932.htm -->
<!-- jQuery 浮动广告实现代码_jquery_脚本之家 -->






