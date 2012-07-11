jQuery(document).ready(function(){ 
  jQuery("#htmlTable").jqGrid({
    url:'jqmetadatatableediting.php',
	  editurl:'jqmetadatatableediting.php',
    datatype: 'json',
    mtype: 'POST',
    //ccmeta_id, doc_level,	doc_type, doc_order, doc_col_caption, doc_col_desc,	doc_col_tooltip, doc_col_type, is_multiple
	colNames:['ID','Level', 'Role','Order','Caption','Description','Tool Tip','Type','Multiple'],
    colModel :[{
		name:'id'
		,index:'id'
		,align:'left'
		,width:25
		//,editable:true
	},{
		name:'doc_level'
		,index:'doc_level'
		,width:60
		,editable:true
		,edittype:'select'
		,editoptions:{value:"species:species;genus:genus;family:family"} /* Name:Value;Name:Value */
	},{
		name:'doc_type'
		,index:'doc_type'
		,width:60
		,align:'left'
		,editable:true
		,edittype:'select'
		,editoptions:{value:"author:author;reviewer:reviewer"} /* Name:Value;Name:Value */
		//,edittype:'select'
		//,editoptions:{value:"GET:GET;POST:POST"} /* Name:Value;Name:Value */
	},{
		name:'doc_order'
		,index:'doc_order'
		,width:20
		,align:'left'
		,editable:true
	},{
		name:'doc_col_caption'
		,index:'doc_col_caption'
		,width:300
		,align:'left'
		//,align:'right'
		,editable:true
	},{
		name:'doc_col_desc'
		,index:'doc_col_desc'
		,align:'left'
		,width:300
		,sortable:false
		,editable:true
	},{
		name:'doc_col_tooltip'
		,index:'doc_col_tooltip'
		,align:'left'
		,width:300
		,sortable:false
		,editable:true
	},{
		name:'doc_col_type'
		,index:'doc_col_type'
		,align:'left'
		,width:70
		,sortable:false
		,editable:true
		,edittype:'select'
		,editoptions:{value:"text:text;text,img:text,img"} /* Name:Value;Name:Value */
	},{
		name:'is_multiple'
		,index:'is_multiple'
		,align:'left'
		,width:100
		,sortable:false
		,editable:true
		,edittype:'select'
		,editoptions:{value:"Yes:Yes;No:No"} /* Name:Value;Name:Value */
	}],
    pager: jQuery('#htmlPager'),
    rowNum:10,
    rowList:[10,20,30,40,50,100,200,1000,2000,3000,5000],
    sortname: 'ccmeta_id',//modify here!!
    sortorder: "asc",
    viewrecords: true,
    imgpath: 'themes/basic/images',
    //caption: 'Example jqGrid, With standard Navigation and editing',
    caption: 'Document Metadata Editor',
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
