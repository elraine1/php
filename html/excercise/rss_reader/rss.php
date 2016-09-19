<!DOCTYPE html>
<html>
<head>
<script src="//code.jquery.com/jquery.min.js"></script>
<script type="text/javascript">
	

$(document).ready(function(){
	$("#news_ref").change(function(){
		var str = this.value;
		if (str.length==0) { 
			document.getElementById("rssOutput").innerHTML="";
			return;
		}
		if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		} else {  // code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function() {
			if (this.readyState==4 && this.status==200) {
				document.getElementById("rssOutput").innerHTML=this.responseText;
			}
		}
		xmlhttp.open("GET","getrss.php?q="+str,true);
		xmlhttp.send();
	});		
});
</script>
</head>
	
<body>
	<form>
		<select id="news_ref">
			<option value="">Select an RSS-feed:</option>
			<option value="Google">Google News</option>
			<option value="NBC">NBC News</option>
		</select>
	</form>
	<br>
	<div id="rssOutput">RSS-feed will be listed here...</div>
</body>

</html> 