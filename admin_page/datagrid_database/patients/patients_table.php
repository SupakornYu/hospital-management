<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="keywords" content="jquery,ui,easy,easyui,web">
	<meta name="description" content="easyui help you build your web page easily!">
	<title>PATIENTS TABLE</title>
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
				ACCOUNT_ID: $('#ACCOUNT_ID').val(),
				USERNAME: $('#USERNAME').val(),
				PASSWORD: $('#PASSWORD').val(),
				SSN: $('#SSN').val(),
				NAME: $('#NAME').val(),
				SURNAME: $('#SURNAME').val(),
				BLOOD_GROUP: $('#BLOOD_GROUP').val(),
				GENDER: $('#GENDER').val(),
				BIRTHDAY: $('#BIRTHDAY').val(),
				HOSPITALSTAFFS_ID: $('#HOSPITALSTAFFS_ID').val()
			});
		}
	</script>
	<script type="text/javascript">
		function destroyUser(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$.messager.confirm('Confirm','Are you sure you want to destroy this user?',function(r){
					if (r){
						$.post('destroy_user.php',{USERNAME:row.USERNAME},function(result){
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
	<h2>PATIENT TABLE</h2>
	<div class="demo-info" style="margin-bottom:10px">
		<div class="demo-tip icon-tip">&nbsp;</div>
		<div>Double click the row to begin editing.</div>
	</div>
	
	<table id="dg" class="easyui-datagrid" title="PATIENTS" style="width:1000px;height:700px"
			toolbar="#toolbar" pagination="true" idField="ACCOUNT_ID"
			url="get_data.php"
			rownumbers="true" fitColumns="true" singleSelect="true">
		<thead>
			<tr>
				<th field="ACCOUNT_ID" width="50" sortable="true"> <!--editor="{type:'validatebox',options:{required:true}}"-->ACCOUNT ID</th>
				<th field="USERNAME" width="50" sortable="true" editor="{type:'validatebox',options:{required:true}}">USERNAME</th>
				<th field="PASSWORD" width="50" sortable="true" editor="{type:'validatebox',options:{required:true}}">PASSWORD</th>
				<th field="SSN" width="50" sortable="true" editor="{type:'numberbox',options:{required:true}}">SSN</th>
				<th field="NAME" width="50" sortable="true" editor="{type:'validatebox',options:{required:true}}">NAME</th>
				<th field="SURNAME" width="50" sortable="true" editor="{type:'validatebox',options:{required:true}}">SURNAME</th>
				<th field="BLOOD_GROUP" width="50" sortable="true" editor="{type:'combobox',options:{required:true,valueField:'type',textField:'text'
				,data:[{'type':'O-','text':'O-'},
					   {'type':'O+','text':'O+'},
					   {'type':'A-','text':'A-'},
					   {'type':'A+','text':'A+'},
					   {'type':'B-','text':'B-'},
					   {'type':'B+','text':'B+'},		
					   {'type':'AB-','text':'AB-'},	
					   {'type':'AB+','text':'AB+'},	
					   ]}}"
				>BLOOD_GROUP</th>
				<th field="GENDER" width="50" sortable="true" editor="{type:'combobox',options:{required:true,valueField:'type',textField:'text'
				,data:[{'type':'male','text':'male'},
					   {'type':'female','text':'female'},
					   ]}}"
				>GENDER</th>
				<th field="BIRTHDAY" width="50" sortable="true" editor="{type:'datebox',options:{required:true}}">BIRTHDAY</th>
				<th field="HOSPITALSTAFFS_ID" width="50" sortable="true" editor="{type:'validatebox',options:{required:true}}">HOSPITALSTAFFS ID</th>
			</tr>
		</thead>
	</table>
	<div id="toolbar">
		<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:$('#dg').edatagrid('addRow')">New</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">Destroy</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:$('#dg').edatagrid('saveRow');reloadGrid();">Save</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:$('#dg').edatagrid('cancelRow')">Cancel</a>
		<br>
		<span>ACCOUNT ID :</span>
		<input id="ACCOUNT_ID" style="line-height:26px;border:1px solid #ccc">
		<span>USERNAME :</span>
		<input id="USERNAME" style="line-height:26px;border:1px solid #ccc">
		<span>PASSWORD :</span>
		<input id="PASSWORD" style="line-height:26px;border:1px solid #ccc">
		<span>SSN :</span>
		<input id="SSN" style="line-height:26px;border:1px solid #ccc">
		<span>NAME :</span>
		<input id="NAME" style="line-height:26px;border:1px solid #ccc">
		<span>SURNAME :</span>
		<input id="SURNAME" style="line-height:26px;border:1px solid #ccc">
		<span>BLOOD_GROUP :</span>
		<input id="BLOOD_GROUP" style="line-height:26px;border:1px solid #ccc">
		<span>GENDER :</span>
		<input id="GENDER" style="line-height:26px;border:1px solid #ccc">
		<span>BIRTHDAY :</span>
		<input id="BIRTHDAY" style="line-height:26px;border:1px solid #ccc">
		<span>HOSPITALSTAFFS ID :</span>
		<input id="HOSPITALSTAFFS_ID" style="line-height:26px;border:1px solid #ccc">
		<a href="#" class="easyui-linkbutton" iconCls="icon-search" plain="false" onclick="doSearch()">Search</a>
	</div>
	
</body>
</html>