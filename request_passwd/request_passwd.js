//  Developed by Roshan Bhattarai 
//  Visit http://roshanbh.com.np for this script and more.
//  This notice MUST stay intact for legal use

$(document).ready(function()
{
	$("#username").focus(function()
	{
		$("#username").val("");
	});
	$("#eml").focus(function()
	{
		$("#eml").val("");
	});
	
	$("#request_passwd_form").submit(function()
	{
		//alert($('#username').val());
		//alert($('#eml').val());
		
		
		//remove all the class add the messagebox classes and start fading
		$("#msgbox").removeClass().addClass('messagebox').text('Validating....').fadeIn(1000);
		//check the username exists or not from ajax
		$.post("request_passwd/request_passwd.php",{ user_name:$('#username').val(),eml:$('#eml').val(),rand:Math.random() } ,function(data)
        {
		  //alert(data);
		  if(data=='request password success') //if user_name and eml are correct 
		  {
		  	$("#msgbox").fadeTo(200,0.1,function()  //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('Send password to your email.....').addClass('messageboxok').fadeTo(900,1,
              function()
			  { 
			  	 //redirect to requestpasswdok.php
				 //document.location='login_check/admin_secure.php';
				 document.location='requestpasswdok.php';
			  });
			  
			});
		  }
		  else 
		  {
		  	$("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('Your information is not correct...').addClass('messageboxerror').fadeTo(900,1);
			});		
          }
				
        });
 		return false; //not to post the  form physically
	});
});

