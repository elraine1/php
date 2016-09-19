<!DOCTYPE html>
<html>
<head>
<style type="text/css">
html, body { height: 100%; margin: 0; padding: 0; }

#content_wrap{
	width: 100%;
	height: 600px;
	margin: 0 auto;
}

#map { 
	float:left; 
	width: 65%;
	height: 100%;
	margin: 0 auto;
	margin-left: 1%;
	border: 1px solid gray;
	display: inline-block;
}

#sidebar{
	float: left;
	width: 32%;
	height: 100%;
}

#menu{
	width: 90%;
	height: 20px;
	margin: 0 auto;
	
}

#eqkList{
	width: 90%;
	height: 570px;
	margin: 0 auto;
	margin-bottom: 5px;
	border: 1px dashed red;
}

#eqkListbox{
	width:100%;
}



#youtube_wrap{
	width: 100%;
	height: 450px;
	margin-left: 1%;
	clear: both;	
}

.youtube_content{
	width: 47%;
	height: 100%;
	margin-right: 5px;
	float: left;	
}

</style>
		
		
<script src="//code.jquery.com/jquery.min.js"></script>	
<script type="text/javascript">

var eqkMapList = [
	{
		"tmSeq": 0,
		"cnt": 0,
		"tmEqk": "20160919210051",
		"lat": 35.75,
		"lon": 129.17,
		"mt": 2.1,
		"inT": "",
		"rem": "",
		"cor": "",
	},
	{
		"tmSeq": 1,
		"cnt": 1,
		"tmEqk": "20160919203358",
		"lat": 35.74,
		"lon": 129.18,
		"mt": 4.5,
		"inT": "",
		"rem": "",
		"cor": "",
	},
	{
		"tmSeq": 2,
		"cnt": 2,
		"tmEqk": "20160919091759",
		"lat": 35.76,
		"lon": 129.17,
		"mt": 2.1,
		"inT": "",
		"rem": "",
		"cor": "",
	},
	{
		"tmSeq": 3,
		"cnt": 3,
		"tmEqk": "20160918223807",
		"lat": 35.75,
		"lon": 129.18,
		"mt": 2.8,
		"inT": "",
		"rem": "",
		"cor": "",
	},
	{
		"tmSeq": 4,
		"cnt": 4,
		"tmEqk": "20160918162754",
		"lat": 35.76,
		"lon": 129.17,
		"mt": 2.4,
		"inT": "",
		"rem": "",
		"cor": "",
	},
	{
		"tmSeq": 5,
		"cnt": 5,
		"tmEqk": "20160917162158",
		"lat": 35.76,
		"lon": 129.18,
		"mt": 2.1,
		"inT": "",
		"rem": "",
		"cor": "",
	},
	{
		"tmSeq": 6,
		"cnt": 6,
		"tmEqk": "20160917071256",
		"lat": 35.76,
		"lon": 129.18,
		"mt": 2.1,
		"inT": "",
		"rem": "",
		"cor": "",
	},
	{
		"tmSeq": 7,
		"cnt": 7,
		"tmEqk": "20160916211424",
		"lat": 35.76,
		"lon": 129.18,
		"mt": 2.2,
		"inT": "",
		"rem": "",
		"cor": "",
	},
	{
		"tmSeq": 8,
		"cnt": 8,
		"tmEqk": "20160916195446",
		"lat": 35.74,
		"lon": 129.17,
		"mt": 2.1,
		"inT": "",
		"rem": "",
		"cor": "",
	},
	{
		"tmSeq": 9,
		"cnt": 9,
		"tmEqk": "20160916053109",
		"lat": 35.78,
		"lon": 129.19,
		"mt": 2.2,
		"inT": "",
		"rem": "",
		"cor": "",
	},
	{
		"tmSeq": 10,
		"cnt": 10,
		"tmEqk": "20160915204825",
		"lat": 35.76,
		"lon": 129.19,
		"mt": 2.6,
		"inT": "",
		"rem": "",
		"cor": "",
	}						
];

function convertTimeFormat(str){
	var result = "";
	result += str.substr(0, 4) + ".";	// year
	result += str.substr(4, 2) + ".";	// month
	result += str.substr(6, 2) + ".";	// date
	result += str.substr(8, 2) + ":";	// hour
	result += str.substr(10, 2) + ":";	// minute
	result += str.substr(12, 2);		// second
	return result;
}



function leftPadding(num){
	num = num.toString();
	if(num.length == 1){
		return " " + num;
	}else {
		return num;
	}
}

function initListboxItem(){
	var listbox = document.getElementById("eqkListbox");
	var index;
	var latlng;
	var mt;
	var tmEqk;
	for(var i=0; i < 11; i++){
		index = "[" + leftPadding(i+1) + "]";
		latlng = "[" + eqkMapList[i]['lat'] + ", " + eqkMapList[i]['lon'] + "]";
		mt = "[M" + eqkMapList[i]['mt'] + "]";
		tmEqk = "[" + convertTimeFormat(eqkMapList[i]['tmEqk']) + "]";
		$("#eqkListbox option:eq(" + i + ")").after("<option value='" + i + "'>" + index + " " +  mt + " " + latlng + " " + tmEqk + "</option>");	
	}	
}

</script>


<script type="text/javascript">
////////////////////////////////////////////// Google Map API
var map;
var marker;

function initMap() {
	var myLatlng = new google.maps.LatLng(eqkMapList[0]['lat'], eqkMapList[0]['lon']);
	var mt = eqkMapList[0]['mt'];
	var tmEqk = convertTimeFormat(eqkMapList[0]['tmEqk']);
	
	
	map = new google.maps.Map(document.getElementById('map'), {
		center: myLatlng,
		zoom: 10
	});
	marker = new google.maps.Marker({
		position: myLatlng,
		label: mt,
		map: map,
		title: "- 지진 발생 일시 -\n" + tmEqk
	});
//	marker.setMap(map); // or Marker({map: map});
}

function drawMarker(){
	
	
	
}

function drawAllMarker(){
	
	
}

function drawAllMarkerAnimated(){
	
	
	
}
</script>

<script type="text/javascript">
////////////////////////////////////// JQUERY
$(document).ready(function(){
	
	initListboxItem();	
	
	$("#start_btn").click(function(){

		/*
		var url = "eqProxy.php";
		var form_data = {
			"fromTmFc": "20160912",
			"toTmFc": "20160919",	
			"numOfRows": 999,
			"pageNo": 1
		};
		
		$.ajax({
			
			// 한 번에 10개씩 밖에 안나옴! 
			// api request 옵션 손볼 것. display, start, .. default option 임.
			
			dataType: "xml",
			type: "POST",
			async: false,
			url: action,
			data: form_data,
			success: function(result){
//				alert(result);
				var xml = $(result);
				var items = xml.find("item");
				var html = "";
				
				
			},
			error: function(xhr){
				alert(xhr.responseText);
//				alert('Error');
			},
			timeout : 3000
		});
		*/
		
	});
		
});
		
</script>
		
	</head>
	
	<body>
	<h2>&nbsp; 대한민국 지진 지도</h2>
	
	<div id="content_wrap">
		
		<div id="map">
			<script async defer
				src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDa8mrOz4m1HWHARilVDc9EKcRYlL5oCf4&callback=initMap">
			</script>
		</div>
		
		<div id="sidebar">
		
			<div id="eqkList">
				<fieldset>
					<legend>최근 지진 목록</legend>
					<select id="eqkListbox" size="30">
						<option disabled>[No][mgtd] [ co-ordinate ] [yyyy.mm.dd. hh:mm:ss]</option>
					</select>
				</fieldset>
			</div>
			
			<div id="menu">
				<input type="button" id="prevBtn" value="이전">
				<input type="button" id="nextBtn" value="다음">
				<input type="button" id="allBtn" value="모두보기"><br>
			</div>
		</div>
	</div>
	<br>
	<div id="youtube_wrap">
		
		<div class="youtube_content">
			<fieldset>
				<legend>한국 지진 실시간 중계</legend>
				<iframe width="560" height="360" class="wiki-youtube" src="//www.youtube.com/embed/LqpjAhmhXcQ" frameborder="0" allowfullscreen=""></iframe>
			</fieldset>
		</div>
		
		<div class="youtube_content">
			<fieldset>
				<legend>일본 지진 실시간 중계</legend>
				<iframe width="560" height="360" class="wiki-youtube" src="//www.youtube.com/embed/qmu8zrllUUI" frameborder="0" allowfullscreen=""></iframe>
			</fieldset>
		<div>
	</div>
		
	</body>
</html>