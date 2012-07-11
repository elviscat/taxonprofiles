/******************************
**	contriform.js
**	elviscat@gmail.com
**  Elvis Wu
**  08/08/2008
*******************************/
function showMsg(e){
	var exchange = $("input[@name='exchange']:checked").val();
	var sig1 = $("input[@name='sig1']:checked").val();
	var sig2 = $("input[@name='sig2']:checked").val();
	var sig3 = $("input[@name='sig3']:checked").val();
	var sig4 = $("input[@name='sig4']:checked").val();
	var sig5 = $("input[@name='sig5']:checked").val();
	var sig6 = $("input[@name='sig6']:checked").val();
	var sig7 = $("input[@name='sig7']:checked").val();
	var sig8 = $("input[@name='sig8']:checked").val();
	var sig9 = $("input[@name='sig9']:checked").val();
	var wtb = $("input[@name='willingtobook']:checked").val();
	var wtt = $("input[@name='willingtotaxon']:checked").val();
	//alert(wtt);
	$.post("contriform/contriform.php",
		{exchange:exchange,wtb:wtb,wtt:wtt,sig1:sig1,sig2:sig2,sig3:sig3,sig4:sig4,sig5:sig5,sig6:sig6,sig7:sig7,sig8:sig8,sig9:sig9},
		function(data){//do something
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