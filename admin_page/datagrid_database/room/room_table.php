<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="keywords" content="jquery,ui,easy,easyui,web">
	<meta name="description" content="easyui help you build your web page easily!">
	<title>ROOM TABLE</title>
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
				ROOM_ID: $('#ROOM_ID').val(),
				ROOM_TYPE: $('#ROOM_TYPE').val(),
				AVAILABLE_STATUS: $('#AVAILABLE_STATUS').val(),
				RECU_ID: $('#RECU_ID').val()
			});
		};
		function reloadGrid(){
			$('#dg').datagrid('reload');
		};
	</script>
	<script type="text/javascript">
		function destroyUser(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$.messager.confirm('Confirm','Are you sure you want to destroy this user?',function(r){
					if (r){
						$.post('destroy_user.php',{ROOM_ID:row.ROOM_ID},function(result){
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
</head>
<body>
	<h2>ROOM TABLE</h2>
	<div class="demo-info" style="margin-bottom:10px">
		<div class="demo-tip icon-tip">&nbsp;</div>
		<div>Double click the row to begin editing.</div>
	</div>
	
	<table id="dg" class="easyui-datagrid" title="ROOM" style="width:1000px;height:700px"
			toolbar="#toolbar" pagination="true" idField="ROOM_ID"
			url="get_data.php"
			rownumbers="true" fitColumns="true" singleSelect="true">
		<thead>
			<tr>
				<th field="ROOM_ID" width="50" sortable="true"> <!--editor="{type:'validatebox',options:{required:true}}"-->ROOM ID</th>
				<th field="ROOM_TYPE" width="50" sortable="true" editor="{type:'validatebox',options:{required:true}}">ROOM TYPE</th>
				<th field="AVAILABLE_STATUS" width="50" sortable="true" editor="{type:'combobox',options:{required:true,valueField:'type',textField:'text'
				,data:[{'type':'1','text':'available'},
					   {'type':'0','text':'busy'},
						]}}"
				
				
				>AVAILABLE STATUS</th>
				<th field="RECU_ID" width="50" sortable="true" editor="{type:'validatebox',options:{required:false}}">RECUPERATION ID</th>
			</tr>
		</thead>
	</table>
	<div id="toolbar">
		<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:$('#dg').edatagrid('addRow')">New</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">Destroy</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:$('#dg').edatagrid('saveRow'); reloadGrid();">Save</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:$('#dg').edatagrid('cancelRow')">Cancel</a>
		<br>
		<span>ROOM ID :</span>
		<input id="ROOM_ID" style="line-height:26px;border:1px solid #ccc">
		<span>ROOM TYPE :</span>
		<input id="ROOM_TYPE" style="line-height:26px;border:1px solid #ccc">
		<span>AVAILABLE STATUS :</span>
		<input id="AVAILABLE_STATUS" style="line-height:26px;border:1px solid #ccc">
		<span>RECUPERATION ID :</span>
		<input id="RECU_ID" style="line-height:26px;border:1px solid #ccc">
		<a href="#" class="easyui-linkbutton" iconCls="icon-search" plain="false" onclick="doSearch()">Search</a>
	</div>
	
</body>
</html>