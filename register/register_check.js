//  Developed by Roshan Bhattarai 
//  Visit http://roshanbh.com.np for this script and more.
//  This notice MUST stay intact for legal use

$(document).ready(function()
{	
	$("#username").focus(function()
	{
		$("#username").val("");
	});
	$("#password").focus(function()
	{
		$("#password").val("");
	});	
	$("#passwordagain").focus(function()
	{
		$("#passwordagain").val("");
	});
	$("#eml").focus(function()
	{
		$("#eml").val("");
	});
	$("#emlagain").focus(function()
	{
		$("#emlagain").val("");
	});

	$("#register_form").submit(function()
	{
		
		//alert($('#username').val());
		//alert($('#password').val());		
		//remove all the class add the messagebox classes and start fading
		$("#msgbox").removeClass().addClass('messagebox').text('Registering ...').fadeIn(1000);
		//check the duplicate username and match the password and passwordagain, and match eml and emlagain
		$.post("register/register_check.php",{ username:$('#username').val(),password:$('#password').val(),passwordagain:$('#passwordagain').val(),eml:$('#eml').val(),emlagain:$('#emlagain').val()} ,function(data)
		{
		  //alert(data);
		  if(data=='your username or password does not follow the rule!') //if the password and passwordagain are not match
		  {
		  	$("#msgbox").fadeTo(200,0.1,function()  //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('Your Username or Password may less than 6 or more than 20 characters...').addClass('messageboxok').fadeTo(1000,1,
              function()
			  { 
			  	 //redirect to secure page
				 //document.location='login_check/admin_secure.php';
				 //document.location='register.php';
			  });
			  
			});
		  }
		  else if(data=='password does not match') //if the password and passwordagain are not match
		  {
		  	$("#msgbox").fadeTo(200,0.1,function()  //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('Your password and verify password are not match...').addClass('messageboxok').fadeTo(1000,1,
              function()
			  { 
			  	 //redirect to secure page
				 //document.location='login_check/admin_secure.php';
				 //document.location='register.php';
			  });
			  
			});
		  }
		  else if(data=='email does not match') //if the password and passwordagain are not match
		  {
		  	$("#msgbox").fadeTo(200,0.1,function()  //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('Your email address and verify email address are not match...').addClass('messageboxok').fadeTo(1000,1,
              function()
			  { 
			  	 //redirect to secure page
				 //document.location='login_check/admin_secure.php';
				 //document.location='register.php';
			  });
			  
			});
		  }
		  else if(data=='Duplicate user, you need register with another login name!') //if correct login detail
		  {
		  	$("#msgbox").fadeTo(200,0.1,function()  //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('Duplicate user, you need register with another login name!').addClass('messageboxok').fadeTo(1000,1,
              function()
			  { 
			  	 //no redirect!!
				 //redirect to secure page
				 //document.location='login_check/user_secure.php';
				 //document.location='register.php';
			  });
			  
			});
		  }
		  else if(data=='This email address is not valid') //if the password and passwordagain are not match
		  {
		  	$("#msgbox").fadeTo(200,0.1,function()  //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('This email address is not valid...').addClass('messageboxok').fadeTo(1000,1,
              function()
			  { 
			  	 //redirect to secure page
				 //document.location='login_check/admin_secure.php';
				 //document.location='register.php';
			  });
			  
			});
		  }
		  else if(data=='register success') //if the password and passwordagain are not match
		  {
		  	$("#msgbox").fadeTo(200,0.1,function()  //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('Register Success...').addClass('messageboxok').fadeTo(1000,1,
              function()
			  { 
			  	 //redirect to secure page
				 //document.location='login_check/admin_secure.php';
				 document.location='registerok.php';
			  });
			  
			});
		  }
		  
		  else 
		  {
		  	$("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('Your registration information is not correct, please modify it...').addClass('messageboxerror').fadeTo(1000,1);
			});		
          }
				
        });
 		return false; //not to post the  form physically
	});
	//now call the ajax also focus move from 
	/*
	$("#password").blur(function()
	{
		$("#login_form").trigger('submit');
	});
	*/
});

