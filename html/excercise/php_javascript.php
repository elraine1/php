<?php
    $arr = array();
    
    for($i = 0; $i < 20; $i++){
//        $arr[] = ($i+1);
        array_push($arr, $i+1);
    }
    
	print "PHP<br>";
	print "- original array<br>";
	
    print_r($arr);
    
    $arr_even = array();
    for($i = 0; $i < count($arr); $i++){
        if($arr[$i] % 2 == 0){
//            $arr_even[] = $arr[$i];
            array_push($arr_even, $arr[$i]);
        }
    }
    
    print "<br><br>";
	print "- even numbers<br>";
    print_r($arr_even);
	
	
    print "<br><br>";
	print "- even numbers(array_filter)<br>";

    function testEven($num){
        return ($num % 2 == 0);
    }
    
    
    $arr2 = array_filter($arr, "testEven");
    print_r($arr2);


?>

<script>
    var arr = [];
    var arr2 = [];

    for(var i=0; i < 20; i++){
        arr.push(i);
    }
	
	for(var i=0; i < arr.length; i++){
		if(arr[i] % 2 == 0){
			arr2.push(i);
		}
	}
	
	document.write("<br><br>javascript<br>");
	document.write(arr2);
//	alert(arr2);

	var arr3 = new Array();
	arr3 = arr.filter(function(value, index, array){
						return (value % 2 === 0);
					});
	

	document.write("<br><br>javascript(arr.filter)<br>");
	document.write(arr3);


	var arr4 = new Array();
	arr4 = arr3.map(function(value, index, array){
		return value*2;/
	});
	
	document.write("<br><br>javascript(arr.map)<br>");
	document.write(arr4);

	
</script>






