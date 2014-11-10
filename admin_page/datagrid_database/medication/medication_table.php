<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="keywords" content="jquery,ui,easy,easyui,web">
	<meta name="description" content="easyui help you build your web page easily!">
	<title>MEDICATION TABLE</title>
	<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/demo/demo.css">
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="http://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>
	<script type="text/javascript" src="http://www.jeasyui.com/easyui/jquery.edatagrid.js"></script>
	<script type="text/javascript">
		$(function(){
			$('#dg').edatagrid({
				//url: 'get_users.php',
				saveUrl: 'save_user.php',
				updateUrl: 'update_user.php',
				//destroyUrl: 'destroy_user.php'
			});
		});
	</script>
	<script type="text/javascript">
		function doSearch(){
			$('#dg').datagrid('load',{
				MED_ID: $('#MED_ID').val(),
				PA_ID: $('#PA_ID').val(),
				DETAIL: $('#DETAIL').val(),
				PER_ID: $('#PER_ID').val(),
				STATUS: $('#STATUS').val(),
				TIMESTAMP: $('#TIMESTAMP').val()
			});
		}
	</script>
	<script type="text/javascript">
		function destroyUser(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$.messager.confirm('Confirm','Are you sure you want to destroy this user?',function(r){
					if (r){
						$.post('destroy_user.php',{MED_ID:row.MED_ID},function(result){
							if (result.success){
								$('#dg').datagrid('reload'); // reload the user data
							} else {
								$.messager.show({ // show error message
								title: 'Error',
								msg: result.errorMsg
								});
							}
						},'json');
					}
				});
			}
		};
	
	</script>
	<script type="text/javascript">
		function reloadGrid(){
		$('#dg').datagrid('reload');
		//editIndex = undefined;
		}
	</script>
</head>
<body>
	<h2>MEDICATION TABLE</h2>
	<div class="demo-info" style="margin-bottom:10px">
		<div class="demo-tip icon-tip">&nbsp;</div>
		<div>Double click the row to begin editing.</div>
	</div>
	
	<table id="dg" class="easyui-datagrid" title="MEDICATION" style="width:1000px;height:700px"
			toolbar="#toolbar" pagination="true" idField="MED_ID"
			url="get_data.php"
			rownumbers="true" fitColumns="true" singleSelect="true">
		<thead>
			<tr>
				<th field="MED_ID" width="50" sortable="true"> <!--editor="{type:'validatebox',options:{required:true}}"--> MEDICATION ID</th>
				<th field="PA_ID" width="50" sortable="true" editor="{type:'validatebox',options:{required:true}}">PATIENT ID</th>
				<th field="DETAIL" width="50" sortable="true" editor="{type:'validatebox',options:{required:true}}">DETAIL</th>
				<th field="PER_ID" width="50" sortable="true" editor="{type:'validatebox',options:{required:false}}">PERSCRIPTION</th>
				<th field="STATUS" width="50" sortable="true" editor="{type:'combobox',options:{required:true,valueField:'type',textField:'text'
				,data:[{'type':'1','text':'finish'},
					   {'type':'0','text':'notfinish'},
						]}}"
				
				
				>STATUS</th>
				<th field="TIMESTAMP" width="50" sortable="true" >TIMESTAMP</th>
			</tr>
		</thead>
	</table>
	<div id="toolbar">
		<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:$('#dg').edatagrid('addRow')">New</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">Destroy</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:$('#dg').edatagrid('saveRow');reloadGrid();">Save</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:$('#dg').edatagrid('cancelRow')">Cancel</a>
		<br>
		<span>MEDICATION ID :</span>
		<input id="MED_ID" style="line-height:26px;border:1px solid #ccc">
		<span>PATIENT ID :</span>
		<input id="PA_ID" style="line-height:26px;border:1px solid #ccc">
		<span>DETAIL :</span>
		<input id="DETAIL" style="line-height:26px;border:1px solid #ccc">
		<span>PERSCRIPTION :</span>
		<input id="PER_ID" style="line-height:26px;border:1px solid #ccc">
		<span>STATUS :</span>
		<input id="STATUS" style="line-height:26px;border:1px solid #ccc">
		<span>TIMPSTAMP :</span>
		<input id="TIMESTAMP" style="line-height:26px;border:1px solid #ccc">
		<a href="#" class="easyui-linkbutton" iconCls="icon-search" plain="false" onclick="doSearch()">Search</a>
		
	</div>
	
</body>
</html>