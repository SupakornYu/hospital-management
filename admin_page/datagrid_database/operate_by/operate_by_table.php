<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="keywords" content="jquery,ui,easy,easyui,web">
	<meta name="description" content="easyui help you build your web page easily!">
	<title>OPERATE BY TABLE</title>
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
				OPER_ID: $('#OPER_ID').val(),
				HOSPITALSTAFF_ID: $('#HOSPITALSTAFF_ID').val(),
				HOURS: $('#HOURS').val()
			});
		}
	</script>
	<script type="text/javascript">
		function destroyUser(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$.messager.confirm('Confirm','Are you sure you want to destroy this user?',function(r){
					if (r){
						$.post('destroy_user.php',{OPER_ID:row.OPER_ID,HOSPITALSTAFF_ID:row.HOSPITALSTAFF_ID},function(result){
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
	<h2>OPERATE_BY TABLE</h2>
	<div class="demo-info" style="margin-bottom:10px">
		<div class="demo-tip icon-tip">&nbsp;</div>
		<div>Double click the row to begin editing.</div>
	</div>
	
	<table id="dg" class="easyui-datagrid" title="OPERATE_BY" style="width:1000px;height:700px"
			toolbar="#toolbar" pagination="true" idField="OPER_ID"
			url="get_data.php"
			rownumbers="true" fitColumns="true" singleSelect="true">
		<thead>
			<tr>
				<th field="OPER_ID" width="50" sortable="true" editor="{type:'validatebox',options:{required:true}}">OPERATION ID</th>
				<th field="HOSPITALSTAFF_ID" width="50" sortable="true" editor="{type:'validatebox',options:{required:true}}">HOSPITALSTAFF ID</th>
				<th field="HOURS" width="50" sortable="true" editor="{type:'numberbox',options:{required:false}}">HOURS</th>
			</tr>
		</thead>
	</table>
	<div id="toolbar">
		<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:$('#dg').edatagrid('addRow')">New</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">Destroy</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:$('#dg').edatagrid('saveRow');reloadGrid();">Save</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:$('#dg').edatagrid('cancelRow')">Cancel</a>
		<br>
		<span>OPERATION ID :</span>
		<input id="OPER_ID" style="line-height:26px;border:1px solid #ccc">
		<span>HOSPITALSTAFF ID :</span>
		<input id="HOSPITALSTAFF_ID" style="line-height:26px;border:1px solid #ccc">
		<span>HOURS :</span>
		<input id="HOURS" style="line-height:26px;border:1px solid #ccc">
		<a href="#" class="easyui-linkbutton" iconCls="icon-search" plain="false" onclick="doSearch()">Search</a>
		
	</div>
	
</body>
</html>