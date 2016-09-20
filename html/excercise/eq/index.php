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


var map;
var markers = [];
var circles = [];
var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
var labelIndex = 0;


// api로부터 데이터를 가져온 뒤, 성공시 마커를 만든다.
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
	result += str.substr(6, 2) + ". ";	// date
	result += str.substr(8, 2) + ":";	// hour
	result += str.substr(10, 2) + ":";	// minute
	result += str.substr(12, 2);		// second
	return result;
}

function initListboxItem(){
	var listbox = document.getElementById("eqkListbox");
	var index;
	var latlng;
	var mt;
	var tmEqk;
	for(var i=0; i < 11; i++){
		index = "[" + labels.substr(i % labels.length, 1) + "]";
		latlng = "[" + eqkMapList[i]['lat'] + ", " + eqkMapList[i]['lon'] + "]";
		mt = "[M" + eqkMapList[i]['mt'] + "]";
		tmEqk = "[" + convertTimeFormat(eqkMapList[i]['tmEqk']) + "]";
		$("#eqkListbox option:eq(" + i + ")").after("<option value='" + i + "'>" + index + " " +  mt + " " + latlng + " " + tmEqk + "</option>");	
	}	
}

////////////////////////////////////////////// Google Map API
function initMap() {
	
	var myLatlng = new google.maps.LatLng(eqkMapList[0]['lat'], eqkMapList[0]['lon']);
	map = new google.maps.Map(document.getElementById('map'), {
		center: myLatlng,
		zoom: 10
	});
	
	makeMarkers();
	makeCircles();
	
//	alert(circles.length);
//	setMapOnMarker(0);
}

// 지진 기록(좌표)에 대한 마커 목록 생성
function makeMarkers(){
	for(var i=0; i < eqkMapList.length; i++){
		addMarker(i);
	}
}

// 하나의 마커를 생성
function addMarker(index){
	
	index = parseInt(index);
	
	var myLatlng = new google.maps.LatLng(eqkMapList[index]['lat'], eqkMapList[index]['lon']);
	var tmEqk = convertTimeFormat(eqkMapList[index]['tmEqk']);
	var mt = eqkMapList[index]['mt'].toString();
	
	var myTitle = "- 지진 발생 일시 -\n" + tmEqk + "\n[M" + mt + "]"; 
	var myLabel = labels.substr(index,1);
	
	var marker = new google.maps.Marker({
		position: myLatlng,
		label: myLabel,
		title: myTitle
	});
	markers.push(marker);
}

function makeCircles(){
	for(var i=0; i < eqkMapList.length; i++){
		addCircle(i);
	}
} 

function addCircle(index){
	
	var myLatlng = new google.maps.LatLng(eqkMapList[index]['lat'], eqkMapList[index]['lon']);
	
//	alert(myLatlng.coord.lat);
	var magnitudeCircle = new google.maps.Circle({		
		strokeColor: '#FF0000',
		strokeOpacity: 0.8,
		strokeWeight: 2,
		fillColor: '#FF0000',
		fillOpacity: 0.35,
		center: myLatlng,
		radius: Math.pow(eqkMapList[index]['mt'], 2) * 1000
    });
	circles.push(magnitudeCircle);
}
	
	

// Sets the map on all markers in the array.
function setMapOnAll(map) {
	for (var i = 0; i < markers.length; i++) {
		markers[i].setMap(map);
	}
}

// Removes the markers from the map, but keeps them in the array.
function clearMarkers() {
	setMapOnAll(null);
}

// Shows any markers currently in the array.
function showMarkers() {
	setMapOnAll(map);
}

/*
// Deletes all markers in the array by removing references to them.
function deleteMarkers() {
	clearMarkers();
	markers = [];
}*/

function setMapOnMarker(index){
	clearMarkers();
	markers[index].setMap(map);
}


//////// Circles
// Sets the map on all circles in the array.
function setMapOnAllCircles(map){
	for(var i=0; i < circles.length; i++){
		circles[i].setMap(map);
	}
}

function clearCircles(){
	setMapOnAllCircles(null);
}

function showCircles(){
	setMapOnAllCircles(map);
}

/*
function deleteCircles(){
	clearCircles();
	circles = [];
}*/

function setMapOnCircle(index){
	clearCircles();
	circles[index].setMap(map);
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
	
	$("#showAllMarkers").click(function(){
		showMarkers();
		showCircles();
	});
	
	$("#hideAllMarkers").click(function(){
		clearMarkers();
		clearCircles();
	});
	
	$("#eqkListbox").change(function(){
		//alert($(this).val());
		
		var index = parseInt($(this).val());		
		setMapOnMarker(index);
		setMapOnCircle(index);
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
				<input type="button" id="showAllMarkers" value="모두보기">
				<input type="button" id="hideAllMarkers" value="감추기"><br>
			</div>
		</div>
	</div>
	<br>
	<div id="youtube_wrap">
		
		<div class="youtube_content">
			<fieldset>
				<legend>한국 지진 실시간 중계</legend>
				<iframe width="100%" height="360px" class="wiki-youtube" src="//www.youtube.com/embed/LqpjAhmhXcQ" frameborder="0" allowfullscreen=""></iframe>
			</fieldset>
		</div>
		
		<div class="youtube_content">
			<fieldset>
				<legend>일본 지진 실시간 중계</legend>
				<iframe width="100%" height="360px" class="wiki-youtube" src="//www.youtube.com/embed/qmu8zrllUUI" frameborder="0" allowfullscreen=""></iframe>
			</fieldset>
		<div>
	</div>
		
	</body>
</html>