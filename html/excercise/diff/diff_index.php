<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>

<head>
	<title>Hello, World!</title>
  
</head>

<body>  
	 
	<div class="wrap">
		<h2>Diff Checker</h2>
		<hr>
		
		<form action="./diff_process.php" method="post">
			
			<table>
				<tr>
					<th>TEXT1</th><th></th><th>TEXT2</th>
				</tr>
				<tr>
					<td><textarea rows="30" cols="80"></textarea></td>
					<td width='40'></td>
					<td><textarea rows="30" cols="80"></textarea></td>
				</tr>
				<tr>
					<td colspan='3' align="center"><input type="submit" value="Check!"></td><td></td><td></td>
				</tr>
			</table>
		</form>
		
		<hr>
		<a href="/index.php"><button>처음으로</button></a> <br>
	</div>
</body>

  
</html>
