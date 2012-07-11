jQuery(document).ready(function(){ 
  jQuery("#htmlTable").jqGrid({
    url:'jqspeciestableediting.php',
	editurl:'jqspeciestableediting.php',
    datatype: 'json',
    mtype: 'POST',
    colNames:['ID','Family', 'Genus','Species','Author','Type Local','C_Code','Paese'],
    colModel :[{
		name:'bid'
		,index:'bid'
		,align:'left'
		,width:25
		//,editable:true
	},{
		name:'mfamily'
		,index:'mfamily'
		,width:120
		,editable:true
		//,edittype:'select'
		//,editoptions:{value:"species:species;genus:genus;family:family"} /* Name:Value;Name:Value */
	},{
		name:'mgenus'
		,index:'mgenus'
		,width:120
		,align:'left'
		,editable:true
		//,edittype:'select'
		//,editoptions:{value:"author:author;reviewer:reviewer"} /* Name:Value;Name:Value */
		//,edittype:'select'
		//,editoptions:{value:"GET:GET;POST:POST"} /* Name:Value;Name:Value */
	},{
		name:'mspecies'
		,index:'mspecies'
		,width:120
		,align:'left'
		,editable:true
	},{
		name:'mauthor'
		,index:'mauthor'
		,width:120
		,align:'left'
		//,align:'right'
		,editable:true
	},{
		name:'mtypelocal'
		,index:'mtypelocal'
		,align:'left'
		,width:120
		,sortable:false
		,editable:true
	},{
		name:'mccode'
		,index:'mccode'
		,align:'left'
		,width:120
		,sortable:false
		,editable:true
	},{
		name:'mpaese'
		,index:'mpaese'
		,align:'left'
		,width:120
		,sortable:false
		,editable:true
		//,edittype:'select'
		//,editoptions:{value:"text:text;text,img:text,img"} /* Name:Value;Name:Value */
	}],
    pager: jQuery('#htmlPager'),
    rowNum:10,
    rowList:[10,20,30,40,50,100,200,1000,2000,3000,5000],
    sortname: 'bid',//modify here!!
    sortorder: "asc",
    viewrecords: true,
    imgpath: 'themes/basic/images',
    //caption: 'Example jqGrid, With standard Navigation and editing',
    caption: 'Species Table/Grid Editor',
	/* These are custom vars sent on each READ, or SELECT request */
	postData: {
		customVar1:'customVal1'
		,customVar2:'customVal2'
	}
  }).navGrid('#htmlPager'); 
  //
  //
  //
  //
  //
  //We won't use the second part of this javascript
  /* setup the forms as modal */
  jQuery('#modalForm').jqm();
  jQuery("#htmlTable_2").jqGrid({
    url:'jqGridCrud.php',
	editurl:'jqGridCrud.php',
    datatype: 'json',
    mtype: 'POST',
    colNames:['id','protocol', 'method','url','site','media_type'],
    colModel :[{
		name:'id'
		,index:'id'
		,width:55
	},{
		name:'protocol'
		,index:'protocol'
		,width:90
		,editable:true
	},{
		name:'method'
		,index:'method'
		,width:80
		,align:'right'
		,editable:true
		,edittype:'select'
		,editoptions:{value:"GET:GET;POST:POST"} /* Name:Value;Name:Value */
	},{
		name:'url'
		,index:'url'
		,width:80
		,align:'right'
		,editable:true
	},{
		name:'site'
		,index:'site'
		,width:80
		,align:'right'
		,editable:true
	},{
		name:'media_type'
		,index:'media_type'
		,width:150
		,sortable:false
		,editable:true
	}],
    pager: jQuery('#htmlPager_2'),
    rowNum:10,
    rowList:[10,20,30],
    sortname: 'id',
    sortorder: "asc",
    viewrecords: true,
    imgpath: 'themes/basic/images',
    caption: 'Example jqGrid, With Custom Form',
	/* These are custom vars sent on each READ, or SELECT request */
	postData: {
		customVar1:'customVal1'
		,customVar2:'customVal2'
	}/* If you need to use a custom form, then disable the standard buttons, and add your own */
  }).navGrid('#htmlPager_2',{edit:false,add:false,del:true,search:true,refresh:true}).navButtonAdd('#htmlPager_2',{
    caption: 'Edit Row',
    buttonimg: 'themes/basic/images/row_edit.gif',
    onClickButton:function(){
		/* What to do in the new button */
		/* Find the selected ID */
		var intId = jQuery('#htmlTable_2').getGridParam("selrow");
		console.log(intId);
		/* put the ID data in the form */
		jQuery("#htmlTable_2").GridToForm(intId,'#customForm');
	}
}); 
  /* THIS is what we do when someone clicks the form submit button */
  jQuery('#btnSubmit').click(function(){
	jQuery.post('jqGridCrud.php',{
		/* you can put whatever you need to send to the server here, there are easier ways to just serialize the form and send it, but this way is more versatile */
		oper:'edit'
		,id:jQuery('#customForm #id').val()
		,media_type:jQuery('#customForm #media_type').val()
		,method:jQuery('#customForm #method').val()
		,protocol:jQuery('#customForm #protocol').val()
		,site:jQuery('#customForm #site').val()
		,url:jQuery('#customForm #url').val()
	},function(){
		/* This is the callback for when the post is complete */
		jQuery("#htmlTable_2").trigger('reloadGrid');
	},'json');
  });
});/* end of on ready event */ 
