{x2;include:header}
<body>
{x2;include:nav}
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span10">
			<ul class="breadcrumb">
				<li><a href="index.php?{x2;$_app}-app">视频播放</a> <span class="divider">/</span></li>
				<li class="active">列表</li>
			</ul>
			<table class="table table-hover">
				<thead>
					<tr>
						<th>ID</th>
						<th>名称</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody>
					{x2;tree:$videos['data'],video,uid}
					<tr>
						<td>{x2;v:video['videoid']}</td>
						<td>{x2;v:video['videoname']}</td>
						<td>
							<div class="btn-group">
								<a class="btn" href="index.php?user-master-user-modify&userid={x2;v:user['userid']}&page={x2;$page}{x2;$u}"><em class="icon-edit"></em></a>
								{x2;if:v:user['userid'] != $_user['userid']}
								<a class="btn ajax" href="index.php?user-master-user-del&userid={x2;v:user['userid']}&page={x2;$page}{x2;$u}" target="datacontent"><em class="icon-remove"></em></a>
								{x2;endif}
							</div>
						</td>
					</tr>
					{x2;endtree}
				</tbody>
			</table>
			<div class="pagination pagination-right">
				<ul>{x2;$videos['pages']}</ul>
			</div>
	</div>
</div>
</body>
</html>