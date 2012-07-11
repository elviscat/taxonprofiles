/******************************
**	treetable.js
**	elviscat@gmail.com
**  Elvis Wu
**  09/11/2008
**  version2:
**  09/12/2008
*******************************/

function selectAllOrNoneAuthor(e){
	//alert("Click This");
	var family_counter = $("input[@name='family_counter']").val();
	var getFamily = $("input[@name='getFamily']").val();
	for(i=1;i<=family_counter;i++){
		var temp = $("input[@name='author_family_"+i+"']").val();
		if(temp == getFamily){
			//alert(temp);
			if($("input[@name='author_family_"+i+"']:checked").val()){
				//alert("Yes, checked");
				selectAllGenusAuthor();
			}else{
				//alert("No, not checked");
				selectNoneGenusAuthor();
			}
			break;
		}
	}
}

function selectAllGenusAuthor(e){
	//alert("Show All");
	var genus_counter = $("input[@name='genus_counter']").val();
	for(i=1;i<=genus_counter;i++){
			$("input[@name='author_genus_"+i+"']").attr("checked", true);
	}
}

function selectNoneGenusAuthor(e){
	//alert("Show None");
	var genus_counter = $("input[@name='genus_counter']").val();
	for(i=1;i<=genus_counter;i++){
		$("input[@name='author_genus_"+i+"']").attr("checked", false);
	}	
}

function selectAllOrNoneReviewer(e){
	//alert("Click This");
	var family_counter = $("input[@name='family_counter']").val();
	var getFamily = $("input[@name='getFamily']").val();
	for(i=1;i<=family_counter;i++){
		var temp = $("input[@name='reviewer_family_"+i+"']").val();
		if(temp == getFamily){
			//alert(temp);
			if($("input[@name='reviewer_family_"+i+"']:checked").val()){
				//alert("Yes, checked");
				selectAllGenusReviewer();
			}else{
				//alert("No, not checked");
				selectNoneGenusReviewer();
			}
			break;
		}
	}
}

function selectAllGenusReviewer(e){
	//alert("Show All");
	var genus_counter = $("input[@name='genus_counter']").val();
	for(i=1;i<=genus_counter;i++){
			$("input[@name='reviewer_genus_"+i+"']").attr("checked", true);
	}
}

function selectNoneGenusReviewer(e){
	//alert("Show None");
	var genus_counter = $("input[@name='genus_counter']").val();
	for(i=1;i<=genus_counter;i++){
		$("input[@name='reviewer_genus_"+i+"']").attr("checked", false);
	}	
}

function selectAllOrNoneAuthorGenus(e){
	//alert("Click This");
	var genus_counter = $("input[@name='genus_counter']").val();
	var getGenus = $("input[@name='getGenus']").val();
	for(i=1;i<=genus_counter;i++){
		var temp = $("input[@name='author_genus_"+i+"']").val();
		if(temp == getGenus){
			//alert(temp);
			if($("input[@name='author_genus_"+i+"']:checked").val()){
				//alert("Yes, checked");
				selectAllSpeciesAuthor();
			}else{
				//alert("No, not checked");
				selectNoneSpeciesAuthor();
			}
			break;
		}
	}
	
}

function selectAllSpeciesAuthor(e){
	//alert("Show All");
	var species_counter = $("input[@name='species_counter']").val();
	for(i=1;i<=species_counter;i++){
			$("input[@name='author_species_"+i+"']").attr("checked", true);
	}
}

function selectNoneSpeciesAuthor(e){
	//alert("Show None");
	var species_counter = $("input[@name='species_counter']").val();
	for(i=1;i<=species_counter;i++){
		$("input[@name='author_species_"+i+"']").attr("checked", false);
	}	
}

function selectAllOrNoneReviewerGenus(e){
	//alert("Click This");
	var genus_counter = $("input[@name='genus_counter']").val();
	var getGenus = $("input[@name='getGenus']").val();
	for(i=1;i<=genus_counter;i++){
		var temp = $("input[@name='reviewer_genus_"+i+"']").val();
		if(temp == getGenus){
			//alert(temp);
			if($("input[@name='reviewer_genus_"+i+"']:checked").val()){
				//alert("Yes, checked");
				selectAllSpeciesReviewer();
			}else{
				//alert("No, not checked");
				selectNoneSpeciesReviewer();
			}
			break;
		}
	}
	
}

function selectAllSpeciesReviewer(e){
	//alert("Show All");
	var species_counter = $("input[@name='species_counter']").val();
	for(i=1;i<=species_counter;i++){
			$("input[@name='reviewer_species_"+i+"']").attr("checked", true);
	}
}

function selectNoneSpeciesReviewer(e){
	//alert("Show None");
	var species_counter = $("input[@name='species_counter']").val();
	for(i=1;i<=species_counter;i++){
		$("input[@name='reviewer_species_"+i+"']").attr("checked", false);
	}	
}



function showMsg(e){
	//alert("Hello Elvis!");
	var username = $("input[@name='username']").val();
	var family_counter = $("input[@name='family_counter']").val();
	var genus_counter = $("input[@name='genus_counter']").val();
	var species_counter = $("input[@name='species_counter']").val();

	//alert(family_counter);
	//alert(genus_counter);
	//alert(species_counter);
	var author_family = "";
	for(i=1;i<=family_counter;i++){
		var temp = $("input[@name='author_family_"+i+"']:checked").val();
		if(temp){
			//alert(i+" : "+temp);
			author_family += username+"_family_"+temp+"_author";
			author_family += ";";
		}
	}
	//alert("Author Family is ::" + author_family);
	var author_genus = "";
	for(i=1;i<=genus_counter;i++){
		var temp = $("input[@name='author_genus_"+i+"']:checked").val();
		if(temp){
			//alert(i+" : "+temp);
			author_genus += username+"_genus_"+temp+"_author";
			author_genus += ";";
		}
	}
	//alert("Author Genus is ::" + author_genus);	
	var author_species = "";
	for(i=1;i<=species_counter;i++){
		var temp = $("input[@name='author_species_"+i+"']:checked").val();
		if(temp){
			//alert(i+" : "+temp);
			author_species += username+"_species_"+temp+"_author";
			author_species += ";";
		}
	}
	//alert("Author Species is ::" + author_species);
	
	
	var reviewer_family = "";
	for(i=1;i<=family_counter;i++){
		var temp = $("input[@name='reviewer_family_"+i+"']:checked").val();
		if(temp){
			//alert(i+" : "+temp);
			reviewer_family += username+"_family_"+temp+"_reviewer";
			reviewer_family += ";";
		}
	}
	//alert("Reviewer Family is ::" + reviewer_family);
	var reviewer_genus = "";
	for(i=1;i<=genus_counter;i++){
		var temp = $("input[@name='reviewer_genus_"+i+"']:checked").val();
		if(temp){
			//alert(i+" : "+temp);
			reviewer_genus += username+"_genus_"+temp+"_reviewer";
			reviewer_genus += ";";
		}
	}
	//alert("Reviewer Genus is ::" + reviewer_genus);	
	var reviewer_species = "";
	for(i=1;i<=species_counter;i++){
		var temp = $("input[@name='reviewer_species_"+i+"']:checked").val();
		if(temp){
			//alert(i+" : "+temp);
			reviewer_species += username+"_species_"+temp+"_reviewer";
			reviewer_species += ";";
		}
	}
	//alert("Reviewer Species is ::" + reviewer_species);
	
	
	
	$.post("treetable/treetable.php",
		{author_family:author_family,author_genus:author_genus,author_species:author_species,reviewer_family:reviewer_family,reviewer_genus:reviewer_genus,reviewer_species:reviewer_species},
		function(data){//do something
			//alert("The result is ::" + data);
			
			if(data == 'Invalid query'){
				document.location='error.php';
			}else{
				document.location='useradmin.php';
			}
			
		});

}
$(document).ready(function(e){
	var family_counter = $("input[@name='family_counter']").val();
	var genus_counter = $("input[@name='genus_counter']").val();
	var species_counter = $("input[@name='species_counter']").val();
	var getFamily = $("input[@name='getFamily']").val();
	var getGenus = $("input[@name='getGenus']").val();
	
	for(i=1;i<=family_counter;i++){
		var temp = $("input[@name='author_family_"+i+"']").val();
		var temp2 = $("input[@name='author_family_"+i+"']").val();
		//alert("Temp is "+ temp + ". ");
		if((temp == getFamily)){	
			$("input[@name='author_family_"+i+"']").click(selectAllOrNoneAuthor);
		}
		if((temp2 == getFamily)){	
			$("input[@name='reviewer_family_"+i+"']").click(selectAllOrNoneReviewer);
		}		
	}
	

	for(i=1;i<=genus_counter;i++){
		var temp = $("input[@name='author_genus_"+i+"']").val();
		var temp2 = $("input[@name='reviewer_genus_"+i+"']").val();
		//alert("Temp is "+ temp + ". ");
		
		if((temp == getGenus)){	
			$("input[@name='author_genus_"+i+"']").click(selectAllOrNoneAuthorGenus);
		}
		if((temp2 == getGenus)){	
			$("input[@name='reviewer_genus_"+i+"']").click(selectAllOrNoneReviewerGenus);
		}
				
	}	
	
	
	
	$('#submit').click(showMsg);
	
});