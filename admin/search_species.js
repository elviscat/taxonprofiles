/******************************
**	search_species.js
**	elviscat@gmail.com
**  Author: Elvis Hsin-Hui Wu
*******************************/
function showMsg(e){
	
	$.post("search_species.php",
		{keyword:$("#keyword").val(), Genus_name:$("#Genus_name").val(), Species_name:$("#Species_name").val()},
		function(data){//do something
			//alert(data);
			//$('#msg').html('<h1>'+data+'</h1>');
			$('#msg').html(data);
			//$('#msg').fadeIn();
		});
	//$('#msg').html('<h1>This is a test!!</h1>');
}
function showMsg2(e){
	alert("Hello");
  /*
  $.post("speciesEditor2.php",
		{keyword:$("#Id").val()},
		function(data){//do something
			alert(data);
			//$('#msg2').html('<h1>'+data+'</h1>');
			//$('#msg2').html(data);
			//$('#msg2').fadeIn();
		});
	*/	
	//$('#msg').html('<h1>This is a test!!</h1>');
}
$(document).ready(function(e){
	//$('#search_form').submit(showMsg);
	$('#submit').click(showMsg);
	$('#Edit').click(showMsg2);
});



