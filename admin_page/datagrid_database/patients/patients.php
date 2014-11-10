<?php
	session_start();

	if(!(isset($_SESSION['ses_id']) and ($_SESSION['ses_id'] != "") and ($_SESSION["ses_job_name"]=='admin'))){
		echo "Please Login!";
		echo "<br><a href='../../../login.html'>Back to Log In Page</a><br>";
		exit();	
	}
	
	require '../../../connect_oracle.php';
	$Username = $_SESSION["ses_username"];
	$table_login = $_SESSION["ses_table_login"];
	$s = oci_parse($c, "select * from $table_login where username = '$Username' ");
	$r = oci_execute($s);
	$row = oci_fetch_array($s, OCI_ASSOC+OCI_RETURN_NULLS)
?>



<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>
	
	


    <!-- Bootstrap Core CSS -->
    <link href="../../../css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../../../css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="../../../css/plugins/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../../css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../../../css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../../font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	
	<!-- jQuery Version 1.11.0 -->
    <script src="../../../js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../../js/bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../../js/sb-admin-2.js"></script>
	
	<!-- Metis Menu Plugin JavaScript -->
    <script src="../../../js/plugins/metisMenu/metisMenu.min.js"></script>
	

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	
	
	<!-- jeasyui head start here -->
	
	
		
	<link href="http://www.jeasyui.com/easyui/themes/default/easyui.css" rel="stylesheet"> 
	

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
	
	
	
	
	
	<!-- jeasyui head stop here -->
	
	
	

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Hospital Admin</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>Read All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-tasks fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-tasks">
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 1</strong>
                                        <span class="pull-right text-muted">40% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 2</strong>
                                        <span class="pull-right text-muted">20% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                            <span class="sr-only">20% Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 3</strong>
                                        <span class="pull-right text-muted">60% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            <span class="sr-only">60% Complete (warning)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 4</strong>
                                        <span class="pull-right text-muted">80% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                            <span class="sr-only">80% Complete (danger)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Tasks</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-tasks -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i> New Comment
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> Message Sent
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-tasks fa-fw"></i> New Task
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="../../../logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                
								  <img class="img-responsive img-circle" src="../../../img/test_img/test.png" alt="..." style="max-width: 200px; height: auto;" >
								
                            </div>
                            <!-- /input-group -->
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Tables<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">								
								<li>
                                    <a href="../bill/bill.php">Bill</a>
                                </li>
								<li>
                                    <a href="../Hospital_Staffs/Hospital_Staffs.php">Hospital Staffs</a>
                                </li>
								<li>
                                    <a href="../job_type/job_type.php">Job Type</a>
                                </li>
								<li>
                                    <a href="../look_after/look_after.php">Look after</a>
                                </li>
								<li>
                                    <a href="../medication/medication.php">Medication</a>
                                </li>
								<li>
                                    <a href="../operate_by/operate_by.php">Operate By</a>
                                </li>
								<li>
                                    <a href="../operation/operation.php">Operation</a>
                                </li>								
                                <li>
                                    <a href="patients.php">Patients</a>
                                </li>
								<li>
                                    <a href="../perscription/perscription.php">Prescription</a>
                                </li>
                                <li>
                                    <a href="../recuperation/recuperation.php">Recuperation</a>
                                </li>
								<li>
                                    <a href="../room/room.php">Room</a>
                                </li>
								
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">26</div>
                                    <div>New Comments!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">12</div>
                                    <div>New Tasks!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">124</div>
                                    <div>New Orders!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-support fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">13</div>
                                    <div>Support Tickets!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
			<div class="row">
			
				<div class="col-lg-12">
                    <div class="panel panel-info">
					  <div class="panel-heading">
						<h3 class="panel-title">Panel title</h3>
					  </div>
					  <div class="panel-body">
						
						
						<!-- datagrid start here -->
						
						<div>
						
							<style scoped>
								@import "http://www.jeasyui.com/easyui/themes/default/easyui.css";
								@import "http://www.jeasyui.com/easyui/themes/icon.css";
								@import "http://www.jeasyui.com/easyui/demo/demo.css"; 
								
							</style>
						
						
						
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
						
						
						
						</div>
						
						<!-- datagrid end here -->
						
					  </div>
					</div>
                </div>
			
			
			</div>
			<!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->



</body>

</html>
