/******************************
**	contriform.js
**	elviscat@gmail.com
**  Elvis Wu
**  08/08/2008
*******************************/
function showMsg(e){
	var family_name = $("#family_name").val();
	var family_desc = $("#family_desc").val();
	alert(family_name);
	alert(family_desc);
	$.post("userfamilyadd/userfamilyadd.php",
		{family_name:family_name,family_desc:family_desc},
		function(data){//do something
			//alert(data);
			if(data == 'Invalid query'){
				document.location='error.php';
			}else{
				document.location='useradmin.php';
			}
		});	
}
$(document).ready(function(e){	
	$('#submit').click(showMsg);
});