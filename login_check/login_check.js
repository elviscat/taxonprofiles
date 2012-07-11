//  Developed by Roshan Bhattarai 
//  Visit http://roshanbh.com.np for this script and more.
//  This notice MUST stay intact for legal use

$(document).ready(function()
{

	$("#username").focus(function()
	{
		//alert("Hello Elvis");
		//$("#username").value('');
		$("#username").val("");
	});
	
	$("#password").focus(function()
	{
		$("#password").val("");
	});


	$("#login_form").submit(function()
	{
		//alert($('#username').val());
		//alert($('#password').val());
		
		
		//remove all the class add the messagebox classes and start fading
		$("#msgbox").removeClass().addClass('messagebox').text('Validating....').fadeIn(1000);
		//check the username exists or not from ajax
		$.post("login_check/ajax_login.php",{ user_name:$('#username').val(),password:$('#password').val(),rand:Math.random() } ,function(data)
        {
		  //alert(data);
		  if(data=='admin login success') //if it is correct login detail
		  {
		  	$("#msgbox").fadeTo(200,0.1,function()  //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('Logging in as an admin ......').addClass('messageboxok').fadeTo(1200,1,
              function()
			  { 
			    //redirect to secure page
				//document.location='login_check/admin_secure.php';
				var pathname = window.location.pathname;
				//alert(pathname);
				//document.location='../taxonprofiles/admin/admin.php';
				document.location='../taxonprofiles/admin_dashboard.php';
				//var current_url=window.location.toString();
				//var current_url_array = url.split("/");
				//var application_dir = current_url_array[(current_url_array.length -1)];
				//alert(application_dir);
				//document.location='../'+application_dir+'/admin/admin.php';
			  });
			  
			});
		  }
		  else if(data=='user login success') //if correct login detail
		  {
		  	$("#msgbox").fadeTo(200,0.1,function()  //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  //var pathname = window.location.pathname;
			  //$(this).html('Logging in as a user .....' + pathname).addClass('messageboxok').fadeTo(1200,1,
			  $(this).html('Logging in as a user ......').addClass('messageboxok').fadeTo(1200,1,
              function()
			  { 
			  	//redirect to secure page
				//document.location='login_check/user_secure.php';
				//var pathname = window.location.pathname;
				//alert(pathname);
				document.location='../taxonprofiles/admin.php';
				//var current_url=window.location.toString();
				//var current_url_array = url.split("/");
				//var application_dir = current_url_array[(current_url_array.length -1)];
				//alert(application_dir);
				//document.location='../'+application_dir+'/admin.php';
			  });
			  
			});
		  }
		  else
		  {
		  	$("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('Your login detail is not correct ......').addClass('messageboxerror').fadeTo(1200,1);
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

