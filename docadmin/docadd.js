/******************************
**	authoraccountadd.js
**	elviscat@gmail.com
**  Elvis Wu
**  09/16/2008
**  version2:
**  05/27/2009 Wednesday
**  version3:
**  09/??/2008
*******************************/
function backPrevious(e){
  //document.location = 'docadmin.php';
  history.go(-1);	
}

function showMsg(e){
	//alert("Hello Elvis!");
	//
	//
	var docid = $("input[@name='docid']").val();
	var totalcounter = $("input[@name='totalcounter']").val();
	var doc_title = $("textarea[@name='doc_title']").val();
	var doc_content = $("textarea[@name='doc_content']").val();
	var doc_add_sql = $("input[@name='doc_add_sql']").val();
	//alert('doc_add_sql is '+ doc_add_sql );
	//alert('doc_title is' + doc_title);
	//alert('doc_content is' + doc_content);
	//alert(docid);
	//alert(totalcounter);
	//alert($("input[@name='insert1']").val());
	//var postparameter = "totalcounter:\""+$("input[@name='totalcounter']").val()+"\"";
	var content = "";
	var contentid = "";
	for(i=1;i<=totalcounter;i++){
		//alert($("input[@name='insert"+i+"']").val());
		//alert("Hello, This is " + i);
		if(i == totalcounter){
			content += $("textarea[@name='insert"+i+"']").val();
			contentid += $("input[@name='insertmeta"+i+"']").val();
		}else{
			content += $("textarea[@name='insert"+i+"']").val() + "@#";
			contentid += $("input[@name='insertmeta"+i+"']").val() + "@#";
		}
		var temp = $("input[@name='insert"+i+"']").val();
		var temp2 = $("input[@name='insertmeta"+i+"']").val();
		
		//alert("The " + i + " is " + temp + " and" + temp2);
		
	}
	
	//postparameter += "}";
	//alert(postparameter);
	
	//$.post("test.php", { 'choices[]': ["Jon", "Susan"] });
	//var teststr = "\"Jon\", \"Susan\"";
	//{postparameter},
	//{ 'result[]': ["Jon", "Susan"] },
	//,content:content,contentid:contentid
	$.post("docadmin/docadd2.php",
		{totalcounter:totalcounter,docid:docid,content:content,contentid:contentid,doc_title:doc_title,doc_content:doc_content,doc_add_sql:doc_add_sql},
		function(data){//do something
			//alert("The result is ::" + data);
			if(data == 'Invalid query' || data == 'Invalid insert query'){
				document.location='error.php';
			}else{
				//document.location='useradmin.php';
				document.location='docadmin.php?doc_type=author';
			}
			
		});
	
}
$(document).ready(function(e){
  $('#submit').click(showMsg);
	$('#back').click(backPrevious);
});