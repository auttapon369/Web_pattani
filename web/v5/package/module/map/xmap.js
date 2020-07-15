var _layers = new Array();
var layers_state = new Array();
var layers_name = new Array();
var map;
var infoWindow = new google.maps.InfoWindow;
var click_polygon = new google.maps.Polygon;
var click_line = new google.maps.Polyline;
var new_marker = new google.maps.Marker;
var calculated_acres;
var calculated_length;
var points_array = new Array();
var marker_array = new Array();
var Tool_mode = '';



function googleMap() 
{  	
	var icon = $('#path-img').val() + 'ic_dot.png';
	var kmz = $('#path-img').val() + "map/";
	var zone = $('#path-zone').val().split(" ");
	var url = $('#path').val();

	var area = kmz + 'Basin.kmz';
	var area1 = kmz + 'SubBasin.kmz';
	var tumbon = kmz + 'Tambon.kmz';
	var aumphoe = kmz + 'Amphoe.kmz';
	var province = kmz + 'Province.kmz';
	var mooban = kmz + 'Mooban.kmz';
	var f55 = kmz +'flood_2012_geo_link.kml';
	var f56 = kmz +'flood_2013_geo_link.kml';
	var marks = url + 'marks.php';
	var html;
	var alert;
	var event;

	map = new google.maps.Map
	(
		document.getElementById("map"),
		{
			//center: new google.maps.LatLng(6.35, 101.2),
			center: new google.maps.LatLng(zone[0], zone[1]),
			zoom: parseInt(zone[2]),
			mapTypeId: 'terrain'
		}
	);

	loadLayer('VILLAGE', 'หมู่บ้าน', mooban, true, false);
	loadLayer('TAMBON', 'ขอบเขตตำบล', tumbon, false, false);
	loadLayer('AMPHOE', 'ขอบเขตอำเภอ', aumphoe, false, false);
	loadLayer('PROVINCE', 'ขอบเขตจังหวัด', province, false, false);		 
	loadLayer('PROJECT_AREA', 'พื้นที่โครงการ', area, false, false);			 
	loadLayer('Flood53_GISTDA', 'พื้นที่น้ำท่วม ปี พ.ศ. 2555', f55, false, false);			
	loadLayer('Flood54_GISTDA', 'พื้นที่น้ำท่วม ปี พ.ศ. 2556', f56, false, false);		 
	loadLayer('SUBBASIN_TRANGPALEAN', 'ลุ่มน้ำย่อย', area1, false, false);
	loadLayer('Floodmap', 'แผนที่น้ำท่วมสูงสุด', 'http://203.185.128.79/trang/floodmap.php', false, false);
	loadLayer
	(
		'Floodmap1hr',
		'แผนที่น้ำท่วม',
		url + 'floodmap1hr.php?q=step&dummy=' + (new Date()).getTime(),
		false,
		false,
		{
			item: '<select id="timestep"><option> load data..</option></select><br><input type="button" value="play" id="play" /><input type="button" value="stop" id="stop" disabled/>',
			callback: function(obj)
			{
				var clockTimeoutID;
				//$('#stop').attr('disabled', true);
				$('#timestep').load(url+'floodmap1hr.php?q=data&dummy='+(new Date()).getTime());
				$('#timestep').change
				(
					function()
					{
						//reloadLayer(obj, url+'floodmap1hr.php?q=step&n='+$("#timestep option:selected").val()+'&dummy='+(new Date()).getTime());
						reloadLayer(obj, mooban);
					}
				);

				function PlayGraph()
				{
					var dtm = $("#timestep");
					SelectedIndex = $("#timestep option:selected").index() + 1;

					if (SelectedIndex >= $("#timestep option").length)
					{
						SelectedIndex = 0;
						$("#timestep option")[0].selected = 'selected';
					}
					else 
					{
						$("#timestep option")[SelectedIndex].selected = 'selected';
					}

					//reloadLayer(obj, url+'floodmap1hr.php?q=step&n='+$("#timestep option:selected").val()+'&dummy='+(new Date()).getTime());
					reloadLayer(obj, mooban);
					clockTimeoutID=setTimeout(PlayGraph, 5000);
				}
			
				$('#play').click
				(
					function()
					{
						$('#stop').attr('disabled', false);
						$('#play').attr('disabled', true);
						PlayGraph();
					}
				);
				$('#stop').click
				(
					function()
					{
						$('#stop').attr('disabled', true);
						$('#play').attr('disabled', false);
						clearTimeout(clockTimeoutID);
					}
				);
			}
		}
	);

	var buttonHomeOptions =
	{
        gmap: map,
        name: 'Home',
        position: google.maps.ControlPosition.TOP_RIGHT,
        action: function()
		{
			map.panTo(new google.maps.LatLng(zone[0], zone[1]));
			map.setZoom(parseInt(zone[2]));
        }
	}

	var buttonHome = new buttonControl(buttonHomeOptions);

	var Options1 =
	{
        gmap: map,
        name: 'วัดระยะทาง',
        title: "หาระยะทาง (กม.)",
        id: "mapDistance",
        action: function()
		{
			Tool_mode = 'line';
			mode_was_changed();
        }
	}

	var optionDistance = new optionDiv(Options1);
        
	var Options2 =
	{
        gmap: map,
        name: 'วัดพื้นที่',
        title: "หาขนาดพื้นที่ (ตร.กม.)",
        id: "ampArea",
        action: function()
		{
			Tool_mode = 'polygon';
			mode_was_changed();
        }
	}
        
	var optionArea = new optionDiv(Options2);

	var Options3 =
	{
        		gmap: map,
        		name: 'Clear',
        		title: "Clear map",
        		id: "mapClear",
        		action: function(){
					Tool_mode = '';
					clear_map();
        		}
        }
        var optionClear = new optionDiv(Options3);

        //create the check box items
        var checkOptions = {
        		gmap: map,
        		title: "This allows for multiple selection/toggling on/off",
        		id: "terrainCheck",
        		label: "On/Off",
        		action: function(){
        			alert('you clicked check 1');
        		}        		        		
        }
        var check1 = new checkBox(checkOptions);
                
        var sep = new separator();
        
        //put them all together to create the drop down       
        var ddDivOptions = {
        	items: [optionDistance, optionArea, sep, optionClear],
        	id: "myddOptsDiv"        		
        }
        var dropDownDiv = new dropDownOptionsDiv(ddDivOptions);               
                
        var dropDownOptions = {
        		gmap: map,
        		name: 'เครื่องมือ',
        		id: 'ddControl',
        		title: 'เครื่องมือต่างๆ',
        		position: google.maps.ControlPosition.TOP_RIGHT,
        		dropDown: dropDownDiv 
        }
        
        var dropDown1 = new dropDownControl(dropDownOptions);
		/*
		var divDisplayLatLng = {
        		gmap: map,
        		name: '</label><label id="mouse_location"></label>',
        		position: google.maps.ControlPosition.TOP_RIGHT,
        }
        var divdivDisplayLatLng = new divControl(divDisplayLatLng);
		*/
		var divDisplay = {
        		gmap: map,
        		name: '<label id="area">-</label>',
        		position: google.maps.ControlPosition.TOP_RIGHT,
        }
        var divTool = new divControl(divDisplay);


//		var divDisplayLatLng = {
//        		gmap: map,
//        		name: '<table align="center" width="250" border=0><tr><td colspan="3" align="center"><font size="2"><b>สัญลักษณ์</b></font></td></tr><tr><td align="center"><font size="2"><b>ระดับน้ำ</b></font></td><td align="center"><font size="2"><b>สถานกาณ์</b></font></td><td align="center"><font size="2"><b>ปริมาณฝน</b></font></td></tr><tr><td width="16" align="center"><img src="images/icons/bullet_green.png"/></td><td align="center">ปกติ</td><td width="20" align="center"><img src="images/icons/sq_green.png" width="16"/></td></tr><tr><td align="center"><img src="images/icons/bullet_yellow.png"/></td><td align="center">เฝ้าระวัง</td><td width="20" align="center"><img src="images/icons/sq_yellow.png" width="16"/></td></tr><tr><td align="center"><img src="images/icons/bullet_red.png"/></td><td align="center">เตือนภัย</td><td width="20" align="center"><img src="images/icons/sq_red.png" width="16"/></td></tr><tr><td align="center"><img src="images/icons/bullet_black_rs.png"/></td><td align="center">ขัดข้องไม่เกิน 1 ชม.</td><td width="20" align="center"><img src="images/icons/sq_black.png" width="16"/></td></tr><tr><td align="center"><img src="images/icons/bullet_gray_rs.png"/></td><td align="center">ขัดข้องไม่เกิน 3 วัน</td><td width="20" align="center"><img src="images/icons/sq_gray.png" width="16"/></td></tr><tr><td align="center"><img src="images/icons/bullet_white_rs.png"/></td><td align="center">ขัดข้องเกิน 3 วัน</td><td width="20" align="center"><img src="images/icons/sq_white.png" width="16"/></td></tr></table>',
//        		position: google.maps.ControlPosition.LEFT_BOTTOM,
//        }
//        var divdivDisplayLatLng = new divControl(divDisplayLatLng);

		google.maps.event.addListener(map, 'click', function(mouse_was_clicked) {on_click_function(mouse_was_clicked.latLng);} );
		//google.maps.event.addListener(map, 'mousemove', function(mouse_location) {mouse_was_moved(mouse_location.latLng);} );

		function on_click_function(location_passed){
			if(Tool_mode != ''){
				click_polygon.setMap(null);								//	clears click_polygon from map
				click_line.setMap(null);								//	clears click_line from map
				points_array.push(location_passed);						//	push clicked lat lng into points array
				if (Tool_mode == 'polygon'){	//	create (or recreate) the click_polygon object
					create_polygon();
					click_polygon.setMap(map);
				}
				if (Tool_mode == 'line'){		//	create or recreate the click_line
					create_line();
					click_line.setMap(map);
				}
				clear_markers();
				rewrite_markers();
				calculate_dimensions_and_display();
			}
		}// end on_click_function

		function create_polygon(){
			click_polygon = new google.maps.Polygon({
				paths: points_array,
				strokeColor: "#FF0000",
				strokeOpacity: 0.6,
				strokeWeight: 4,
				fillColor: "#FF0000",
				fillOpacity: 0.35
			});
		}

		function create_line(){
			click_line = new google.maps.Polyline({
			path: points_array,
			strokeColor: "#0000ff",
			strokeOpacity: 0.6,
			strokeWeight: 4
		  });
		}

		function rewrite_markers(){
			var dpoint = Array();
			for(var m= 0; m < points_array.length; m++) {							//loop through point array, making markers
				new_marker = new MarkerWithLabel({
					position: points_array[(m)],
					draggable:true,
					map: map,
					labelContent: "0กม.",
					labelAnchor: new google.maps.Point(0, 0),
					labelClass: "labels",
					labelStyle: {opacity: 1},

					// can add arbitrary properties to marker here
					index_number: m,
					title: "จุดที่ " + (m+1)
				});
				dpoint.push(points_array[(m)]);
				if(m>0){
					//dpoint.push(points_array[(m-1)]);
					var calculated_km = (google.maps.geometry.spherical.computeLength(dpoint))/1000;
					new_marker.set('labelContent', calculated_km.toFixed(2) + 'กม.');
				}
				marker_array.push(new_marker);
				google.maps.event.addListener(new_marker, 'click', function (){ marker_was_clicked (this) } ); // here is a convoluted one to increase scope!!!
				google.maps.event.addListener(new_marker, 'drag', function (){ marker_was_dragged (this) } );
			}//end for
		}// end rewrite_markers

		function clear_markers(){
			for(var m= 0; m < marker_array.length; m++) {					
				marker_array[m].setMap(null);
			}
			marker_array = [];
		}

		function marker_was_clicked (marker_object) {
			points_array.splice(marker_object.index_number,1);
			if (Tool_mode == 'polygon'){
				click_polygon.setMap(null);	//clears polygon
				click_polygon.setMap(map);	//writes polygon
			}
			if (Tool_mode == 'line'){
				click_line.setMap(null);
				click_line.setMap(map);
			}
			clear_markers();
			rewrite_markers();
			calculate_dimensions_and_display();
		}// end marker_was_clicked

		function marker_was_dragged(marker_object){
			points_array.splice(marker_object.index_number,1);// removes point
			points_array.splice(marker_object.index_number,0,marker_object.getPosition());// adds updated point
			if (Tool_mode == 'polygon'){
				click_polygon.setMap(null);	//clears polygon
				click_polygon.setMap(map);	//writes polygon
			}
			if (Tool_mode == 'line'){
				click_line.setMap(null);
				click_line.setMap(map);
			}
			var dpoint = Array();
			for(var m= 0; m < points_array.length; m++){
				dpoint.push(points_array[(m)]);
				if(m>0){
					//dpoint.push(points_array[(m-1)]);
					var calculated_km = (google.maps.geometry.spherical.computeLength(dpoint))/1000;
					marker_array[m].set('labelContent', calculated_km.toFixed(2) + 'กม.');
				}
			}
			//clear_markers();
			//rewrite_markers();
			calculate_dimensions_and_display();
		}

		function calculate_dimensions_and_display(){
			if (Tool_mode == 'polygon'){
				//calculated_acres = (google.maps.geometry.spherical.computeArea(points_array)/(1000*1000)*247.105381);
				calculated_acres = (google.maps.geometry.spherical.computeArea(points_array)/(1000*1000));
				calculated_acres = calculated_acres.toFixed(2);
				$("#area").html("พื้นที่ "+calculated_acres+" ตร.กม.");
			}
			if (Tool_mode == 'line'){
				//calculated_length = (google.maps.geometry.spherical.computeLength(points_array))/1000*.621371192;
				calculated_length = (google.maps.geometry.spherical.computeLength(points_array))/1000;
				calculated_length = calculated_length.toFixed(2);
				$("#area").html("ระยะทาง "+calculated_length+" กม.");
			}
		}

		$('#polygon_mode').click(mode_was_changed);
		$('#line_mode').click(mode_was_changed);

		function mode_was_changed(){
			click_polygon.setMap(null);								//	clears click_polygon from map
			click_line.setMap(null);								//	clears click_line from map
			if (Tool_mode == 'polygon'){	//	create (or recreate) the click_polygon object
				create_polygon();
				click_polygon.setMap(map);
			}
			
			if (Tool_mode == 'line'){		//	create or recreate the click_line
				create_line();
				click_line.setMap(map);
			}
			calculate_dimensions_and_display();
		}

		function clear_map(){//removes markers, removes polygon, removes line, sets points array to null
			clear_markers();
			click_polygon.setMap(null);
			click_line.setMap(null);
			points_array = [];
			calculate_dimensions_and_display();
			$("#area").html('-');
		}

		function mouse_was_moved(mouse_move_location){
			
			var mouse_latitude = mouse_move_location.lat();
			mouse_latitude = mouse_latitude.toFixed(3);
			var mouse_longitude = mouse_move_location.lng();
			mouse_longitude = mouse_longitude.toFixed(3);
			
			$("#mouse_location").html( mouse_latitude+" "+mouse_longitude);

		}

////


	downloadUrl(marks, function(data) 
	{   
		var xml = data.responseXML;    
		var markers = xml.documentElement.getElementsByTagName("marker");  

		for (var i = 0; i < markers.length; i++) 
		{         
			var id = markers[i].getAttribute("id");
			var code = markers[i].getAttribute("code");
			var stn = markers[i].getAttribute("name");
			var address = markers[i].getAttribute("address");
			var rf = markers[i].getAttribute("rf");
			var wl = markers[i].getAttribute("wl");
			var date = markers[i].getAttribute("date");
			var ac = Number(markers[i].getAttribute("ac"));
			var li = Number(markers[i].getAttribute("li"));
			var dr = Number(markers[i].getAttribute("dr"));
			var conn = markers[i].getAttribute("conn");
			var alarm = markers[i].getAttribute("alarm");
			var rf_1 = markers[i].getAttribute("rf_1");
			var rf_24 = markers[i].getAttribute("rf_24");
			var wl_val = markers[i].getAttribute("wl_val");
			var wl_left = markers[i].getAttribute("wl_left");
			var wl_right = markers[i].getAttribute("wl_right");
			var wl_lv1 = markers[i].getAttribute("wl_lv1");
			var wl_lv2 = markers[i].getAttribute("wl_lv2");
			var flow = markers[i].getAttribute("flow");
	
			var point = new google.maps.LatLng
			(    
				parseFloat(markers[i].getAttribute("lat")),       
				parseFloat(markers[i].getAttribute("lng"))
			);


			// event
			var div_ac = ( ac == 1 ) ? '<DIV CLASS="icon ac f_right"></DIV>' : '';
			var div_li = ( li == 1 ) ? '<DIV CLASS="icon li f_right"></DIV>' : '';
			var div_dr = ( dr == 1 ) ? '<DIV CLASS="icon dr f_right"></DIV>' : '';

			if ( (ac+li+dr) > 0 )
			{
				event = 	'<HR CLASS="dc_fade"><SPAN CLASS="f_left">เหตุการณ์</SPAN>' + div_ac + div_li + div_dr;
				alert = '<DIV CLASS="alert">'+(ac+li+dr)+'</DIV>';
			}
			else
			{
				event = '';
				alert = '';
			}


			// popup
			var p_rf1 = ( rf == 1 ) ? '<TR><TD CLASS="left">น้ำฝนชั่วโมงนี้</TD><TD CLASS="right">'+rf_1+'</TD><TD CLASS="left">มม.</TD></TR>' : '';
			var p_rf24 = ( rf == 1 ) ? '<TR><TD CLASS="left" WIDTH="80%">ฝนวันนี้</TD><TD CLASS="right">'+rf_24+'</TD><TD CLASS="left">มม.</TD></TR>' : '';
			var p_wl = ( wl == 1 ) ? '<TR><TD CLASS="left" WIDTH="80%">ระดับน้ำ</TD><TD CLASS="right">'+wl_val+'</TD><TD CLASS="left">ม.รทก.</TD></TR>' : '';
			var p_left = ( wl == 1 ) ? '<TR><TD CLASS="left">ระดับตลิ่งซ้าย</TD><TD CLASS="right">'+wl_left+'</TD><TD CLASS="left">ม.รทก.</TD></TR>' : '';
			var p_right = ( wl == 1 ) ? '<TR><TD CLASS="left">ระดับตลิ่งขวา</TD><TD CLASS="right">'+wl_right+'</TD><TD CLASS="left">ม.รทก.</TD></TR>' : '';
			var p_lv1 = ( wl == 1 ) ? '<TR><TD CLASS="left">ระดับเฝ้าระวัง</TD><TD CLASS="right">'+wl_lv1+'</TD><TD CLASS="left">ม.รทก.</TD></TR>' : '';
			var p_lv2 = ( wl == 1 ) ? '<TR><TD CLASS="left">ระดับเตือนภัย</TD><TD CLASS="right">'+wl_lv2+'</TD><TD CLASS="left">ม.รทก.</TD></TR>' : '';
			var p_fl = ( wl == 1 ) ? '<TR><TD CLASS="left">อัตราการไหล</TD><TD CLASS="right">'+flow+'</TD><TD CLASS="left">ลบ.ม./วินาที</TD></TR>' : '';
		
			html = '<DIV CLASS="popup">'
						+'<A HREF="./?page=station&id='+id+'"><H5>'+code+' '+stn+'</H5></A>'
						+'<Q CLASS="fs_small">'+address+'</Q>'
						+'<HR CLASS="dc_fade">'
						+ date + '<BR><BR>'
						+'<TABLE>'
						+ p_rf1 + p_rf24 + p_wl + p_left + p_right + p_lv1 + p_lv2 + p_fl
						+'</TABLE>'
						+ event
					+'</DIV>';


			// icon
			var div_id = '<DIV CLASS="id '+conn+'">'+code+'</DIV>';
			var div_color ='<DIV CLASS="icon '+alarm+'"></DIV>';

			var marker = new MarkerWithLabel
			(
				{
					map: map,
					position: point,
					icon: icon,
					labelContent: div_id + div_color + alert,
					labelAnchor: new google.maps.Point(12, 18),
					labelClass: 'labels fs_small'
				}
			);

			bindInfoWindow(marker, map, infoWindow, html);
		}
	});
}  


function bindInfoWindow(marker, map, infoWindow, html) 
{    
	google.maps.event.addListener
	(
		marker,
		'click',
		function()
		{
			infoWindow.setContent(html);
			infoWindow.open(map, marker);
		}
	);
}


function downloadUrl(url, callback)
{    
	var request = window.ActiveXObject ?     
	new ActiveXObject('Microsoft.XMLHTTP') : 
	new XMLHttpRequest;    
	
	request.onreadystatechange = function()
	{     
		if (request.readyState == 4)
		{       
			request.onreadystatechange = doNothing;       
			callback(request, request.status);     
		}     
	};     
	
	request.open('GET', url, true);      
	request.send(null);
}




function loadLayer(name, label, url, click, show, option) {
		var	 index = _layers.length;
		if(jQuery.inArray(name, layers_name)==-1){
			layers_name[index] = name;
			var checkbox = '<li><input type="checkbox" id="'+name+'"/> '+label+'<span id="item'+name+'"></span></li>';
			$('#layers').append($(checkbox));
			$('input[id='+name+']').attr('checked', show);
			$('input[id='+name+']').bind('click', function(){
				if($(this).prop('checked') && option){
					$(this).next().html('<br/>' + option.item);
					option.callback(this);
				}else{
					$(this).next().html('');
				}
				setLayer(this);
			});
			if (click){
				_layers[index] = new google.maps.KmlLayer(url, {preserveViewport: true, suppressInfoWindows: true, clickable: true});
				//alert(index)//Flood53_GISTDA2
				if (show){
					_layers[index].setMap(map);
					layers_state[index] = true;
				}else{
					layers_state[index] = false;
				}
				google.maps.event.addListener(_layers[index], 'click', function (kmlEvent) {
					var text = kmlEvent.featureData.description;
					var name = kmlEvent.featureData.name;
					var pos = kmlEvent.latLng;
					var offset = kmlEvent.pixelOffset;
					//showInDiv(name);
					showInfoWindow(name, text, pos, offset);
					//open_telestation(name);
				});
			}else
				{
				_layers[index] = new google.maps.KmlLayer(url, {preserveViewport: true, suppressInfoWindows: false, clickable: false});
				if (show)
					{
					_layers[index].setMap(map);
					layers_state[index] = true;
					}
				else
					{
					layers_state[index] = false;
					}
				}
		}
	}

		function showInfoWindow(name, text, position, offset) {
		infoWindow.setOptions({
		content: '<b>'+name+'</b><br>'+text,
		position: position,
		pixelOffset: offset });
		infoWindow.open(map);
	}

		function reloadLayer(layername, url){
		var layerIndex = jQuery.inArray($(layername).attr('id'), layers_name);
		if(layerIndex>=0){
			_layers[layerIndex].setMap(null);
			_layers[layerIndex] = new google.maps.KmlLayer(url, {preserveViewport: true, suppressInfoWindows: false, clickable: false});
			_layers[layerIndex].setMap(map);
			layers_state[layerIndex] = true;
		}
	}

	function setLayer(layername){
		var layerIndex = jQuery.inArray($(layername).attr('id'), layers_name);
		if(layerIndex>=0){
			if(layers_state[layerIndex]){
				if($(layername).attr('id')=='STN'){
					//hideSTN();
				}else{
					_layers[layerIndex].setMap(null);
				}
				layers_state[layerIndex] = false;
			}else{
				if($(layername).attr('id')=='STN'){
					//showSTN();
				}else{
					_layers[layerIndex].setMap(map);
				}
				layers_state[layerIndex] = true;
			}
		}
	}

// ------------------------------------------------------------------------------------------ OTHER
function doNothing(){}




// ------------------------------------------ controlbutton Classes to set up the drop-down control
function optionDiv(options)
{
   	  var control = document.createElement('DIV');
   	  control.className = "dropDownItemDiv";
   	  control.title = options.title;
   	  control.id = options.id;
   	  control.innerHTML = options.name;
   	  google.maps.event.addDomListener(control,'click',options.action);
   	 
	  return control;
}
function checkBox(options)
{
     	//first make the outer container
     	var container = document.createElement('DIV');
   	  	container.className = "checkboxContainer";
   	  	container.title = options.title;
   	  	
     	var span = document.createElement('SPAN');
     	span.role = "checkbox";
     	span.className = "checkboxSpan";
     	        	        	
     	var bDiv = document.createElement('DIV');
   	  	bDiv.className = "blankDiv";      	  	
   	  	bDiv.id = options.id;
   	  	
   	  	var image = document.createElement('IMG');
   	  	image.className = "blankImg";
   	  	image.src = "http://maps.gstatic.com/mapfiles/mv/imgs8.png";
   	  	
   	  	var label = document.createElement('LABEL');
   	  	label.className = "checkboxLabel";
   	  	label.innerHTML = options.label;
   	  	
   	  	bDiv.appendChild(image);
   	  	span.appendChild(bDiv);
   	  	container.appendChild(span);
   	  	container.appendChild(label);
   	  	
   	  	google.maps.event.addDomListener(container,'click',function(){
   	  		(document.getElementById(bDiv.id).style.display == 'block') ? document.getElementById(bDiv.id).style.display = 'none' : document.getElementById(bDiv.id).style.display = 'block';
   	  		options.action(); 
   	  	})

		return container;
}
function separator()
{
	var sep = document.createElement('DIV');
	sep.className = "separatorDiv";
     		
	return sep;      		
}
function dropDownOptionsDiv(options)
{
    	//alert(options.items[1]);
      	var container = document.createElement('DIV');
      	container.className = "dropDownOptionsDiv";
      	container.id = options.id;
      	
      	
      	for(i=0; i<options.items.length; i++){
      		//alert(options.items[i]);
      		container.appendChild(options.items[i]);
      	}
      	
      	//for(item in options.items){
      		//container.appendChild(item);
      		//alert(item);
      	//}        
	
	return container;        	
}
function dropDownControl(options)
{
    	  var container = document.createElement('DIV');
    	  container.className = 'container';
		  container.index = 2;
    	  
    	  var control = document.createElement('DIV');
    	  control.className = 'dropDownControl';
    	  control.innerHTML = options.name;
    	  control.id = options.name;
    	  var arrow = document.createElement('IMG');
    	  arrow.src = "http://maps.gstatic.com/mapfiles/arrow-down.png";
    	  arrow.className = 'dropDownArrow';
    	  control.appendChild(arrow);	      		
    	  container.appendChild(control);    
    	  container.appendChild(options.dropDown);
    	  
    	  options.gmap.controls[options.position].push(container);
		  var eventsID;
    	  google.maps.event.addDomListener(container,'click',function(){
    		(document.getElementById('myddOptsDiv').style.display == 'block') ? document.getElementById('myddOptsDiv').style.display = 'none' : document.getElementById('myddOptsDiv').style.display = 'block';
    		eventsID = setTimeout( function(){
    			document.getElementById('myddOptsDiv').style.display = 'none';
    		}, 1500);
    	  });
    	  google.maps.event.addDomListener(container,'mousemove',function(){
			  clearTimeout(eventsID);
		  });
    	  google.maps.event.addDomListener(container,'mouseout',function(){
			  eventsID = setTimeout( function(){
    			document.getElementById('myddOptsDiv').style.display = 'none';
    		}, 1500);
		  });
}
function buttonControl(options)
{
         var control = document.createElement('DIV');
         control.innerHTML = options.name;
         control.className = 'button';
         control.index = 1;

         // Add the control to the map
         options.gmap.controls[options.position].push(control);

         // When the button is clicked pan to sydney
		 if(options.action){
         google.maps.event.addDomListener(control, 'click', options.action);
		 }
         
		 return control;
}
function divControl(options)
{
         var control = document.createElement('DIV');
         control.innerHTML = options.name;
         control.className = 'divControl';
         control.index = 3;

         // Add the control to the map
         options.gmap.controls[options.position].push(control);

         // When the button is clicked pan to sydney
         
		 return control;
}