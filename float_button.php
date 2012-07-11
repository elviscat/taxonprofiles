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
  yMenuTo     = windows.pageYOffset + 200;   // &#22256;&#29575; &#22256;&#25721;
 } else if (isDOM) {
  yMenuFrom   = parseInt (divMenu.style.top, 10);
  yMenuTo     = (isNS ? window.pageYOffset : document.body.scrollTop) + 200; // &#22256;&#29575; &#22256;&#25721;
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
</SCRIPT>


