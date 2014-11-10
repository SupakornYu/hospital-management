<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="keywords" content="jquery,ui,easy,easyui,web">
	<meta name="description" content="easyui help you build your web page easily!">
	<title>LOOK AFTER TABLE</title>
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
				RECU_ID: $('#RECU_ID').val(),
				ID_NO: $('#ID_NO').val(),
				START_REST: $('#START_REST').datebox('getValue'),
				END_REST: $('#END_REST').val()
			});
		}
	</script>
	<script type="text/javascript">
		function destroyUser(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$.messager.confirm('Confirm','Are you sure you want to destroy this user?',function(r){
					if (r){
						$.post('destroy_user.php',{RECU_ID:row.RECU_ID,ID_NO:row.ID_NO},function(result){
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
	<h2>LOOK AFTER TABLE</h2>
	<div class="demo-info" style="margin-bottom:10px">
		<div class="demo-tip icon-tip">&nbsp;</div>
		<div>Double click the row to begin editing.</div>
	</div>
	
	<table id="dg" class="easyui-datagrid" title="LOOK_AFTER" style="width:1000px;height:700px"
			toolbar="#toolbar" pagination="true" idField="RECU_ID"
			url="get_data.php"
			rownumbers="true" fitColumns="true" singleSelect="true">
		<thead>
			<tr>
				<th field="RECU_ID" width="50" sortable="true" editor="{type:'validatebox',options:{required:true}}"> RECUPERATION ID</th>
				<th field="ID_NO" width="50" sortable="true" editor="{type:'validatebox',options:{required:true}}">HOSPITAL STAFF ID</th>
				<th field="START_REST" width="50" sortable="true" editor="{type:'datebox',options:{required:true}}">START DATE</th>
				<th field="END_REST" width="50" sortable="true" editor="{type:'datebox',options:{required:true}}">END DATE</th>
			</tr>
		</thead>
	</table>
	<div id="toolbar">
		<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:$('#dg').edatagrid('addRow')">New</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">Destroy</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:$('#dg').edatagrid('saveRow');reloadGrid();">Save</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:$('#dg').edatagrid('cancelRow')">Cancel</a>
		<br>
		<span>RECUPERATION ID :</span>
		<input id="RECU_ID" style="line-height:26px;border:1px solid #ccc">
		<span>HOSPITAL STAFF ID :</span>
		<input id="ID_NO" style="line-height:26px;border:1px solid #ccc">
		<span>START DATE :</span>
		<input id="START_REST"  class="easyui-datebox" style="line-height:26px;border:1px solid #ccc">
		<span>END DATE :</span>
		<input id="END_REST" style="line-height:26px;border:1px solid #ccc">
		<a href="#" class="easyui-linkbutton" iconCls="icon-search" plain="false" onclick="doSearch()">Search</a>
		
	</div>
	
</body>
</html>