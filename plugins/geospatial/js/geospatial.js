function geoSpatial(opts){

	var	self 		= this;	
	self.config		= $.parseJSON(window.localStorage.getItem('config'));
	self.options	= $.extend({
						sitefolder		: self.config.sitefolder,
						serverurl		: self.config.server.url,
						data			: self.config.server.url + 'getmappoints.xqy',
						plugincontainter: '#geospatial-map',
						geocontainter	: '#geospatial-container',
						snapcontainer	: '#snap-geospatial',
						directory		: self.config.sitefolder + '/plugins/geospatial/'
						}, opts || {} );
			
			
	self.pbOptions 	= {
						height:       '1.8em',
						width:        '150px',
						top:          '30px',
						right:        '5px',
						colorBar:     '#618FB0',
						background:   'none repeat scroll 0 0 rgba(0, 0, 0, 0.15)',
						fontFamily:   'Arial, sans-serif',
						fontSize:     '12px'						
					}	
	
	self.clusters 	= [{
						label:	'Low',
						marker: self.options.directory + 'img/markers/m1.png'
					 },
					 {
						label:	'Medium',
						marker: self.options.directory + 'img/markers/m2.png'
					 },
					 {
						label:	'High',
						marker: self.options.directory + 'img/markers/m3.png'
					 }]
	self.markers 	= [{
						name:	'airport',
						label:	'Airport',
						marker: self.options.directory + 'img/markers/airport.png'
					 },
					 {
						name:	'policestation',
						label:	'Police Station',
						marker: self.options.directory + 'img/markers/police.png'
					 },
					 {
						name:	'firestation',
						label:	'Fire Station',
						marker: self.options.directory + 'img/markers/firemen.png'
					 },
					 {
						name:	'hospital',
						label:	'Hospital',
						marker: self.options.directory + 'img/markers/hospital-building.png'
					 },
					 {
						name:	'news',
						label:	'News',
						marker: self.options.directory + 'img/markers/radio-station-2.png'
					 }];
	
	self.geoModelInst = null;
	function geospatialModel(opt){
	
		var gm = this;
		gm.availableThemes 	= ko.observableArray(opt.themes);
		gm.chosenTheme		= ko.observable(opt.themes[0]);			
		gm.optionsAfterRender=function(option, item) {
								ko.applyBindingsToNode(option, {attr: { lang : 'en' }}, item);
							}
		gm.searchUrl		= function(rd, tp, lg, gmt, geo, sbc, stl) {	   
							   this.radius			= rd || '200';
							   this.type			= tp || 'json';
							   this.legend			= lg || 'crisis';
							   this.geometric 		= gmt || 'polygon';
							   this.geo 			= geo || '';
							   this.subcategory 	= sbc || '';
							   this.stylesheet 		= stl || self.options.directory + 'resource.xsl';
							 };	
		gm.currentSearch	= ko.observable();
		gm.modalContent		= ko.observable();
		gm.map				= ko.observable();
		gm.dropEffect		= opt.dropEffect || true;
		gm.dropTimeout		= null;
		gm.iterator			= ko.observable(0);
		gm.pb 				= new progressBar(opt.pbOptions);
		gm.markerList		= ko.observable();
		gm.markerListToDrop	= ko.observableArray();
		gm.markerClusterer	= ko.observable();
		gm.newMarkerList	= ko.observable();
		gm.markerSelected	= ko.observableArray();
		gm.markerLegend		= ko.observableArray(opt.markers);
		gm.clusterView		= ko.observable(false);
		gm.markerCluster	= ko.observableArray(opt.clusters);
		
		gm.currentShape		= ko.observable();
		gm.polygon			= ko.observable();
		gm.previousShape	= ko.observable();
		gm.colors 			= ['#1E90FF', '#FF1493', '#32CD32', '#FF8C00', '#4B0082'];
		gm.selectedColor	= ko.observable();
		gm.colorButtons 	= {};
		gm.buildColorPalette= function() {	 
								 var 	div = document.createElement('div');
										div.setAttribute('class','p-5');										
								 var 	delButton = document.createElement('div');
										delButton.setAttribute('class','block-title');
										delButton.setAttribute('id','geospatial-delete-button');
										delButton.innerHTML = 'Delete';
										
								 var 	colorPalette = document.createElement('div');
										colorPalette.setAttribute('class','block-title');
										colorPalette.setAttribute('id','geospatial-color-palette');
										
								 for (var i = 0; i < gm.colors.length; ++i) {
								   var currColor = gm.colors[i];
								   var colorButton = gm.makeColorButton(currColor);
								   colorPalette.appendChild(colorButton);
								   gm.colorButtons[currColor] = colorButton;
								 }
								 
								 div.appendChild(delButton);
								 div.appendChild(colorPalette);
								 
								 gm.map().controls[google.maps.ControlPosition.TOP_CENTER].push(div);	 
								 google.maps.event.addDomListener(delButton, 'click', gm.deleteCurrentShape);
								 gm.selectColor(gm.colors[0]);
							   };
		gm.makeColorButton	= function(color) {
									var button = document.createElement('span');
									button.className = 'color-button';
									button.style.backgroundColor = color;
									google.maps.event.addDomListener(button, 'click', function() {
									  gm.selectColor(color);
									  gm.setCurrentShapeColor(color);
									});
									return button;
								  };
		gm.setCurrentShapeColor = function(color) {
									if (gm.currentShape()) {
									  if (gm.currentShape().type == google.maps.drawing.OverlayType.POLYLINE) {
										gm.currentShape().set('strokeColor', color);
									  } else {
										gm.currentShape().set('fillColor', color);
									  }
									}
								  };
							   
		gm.clearSelection 	= function() {
								if (gm.currentShape()) {
								  gm.currentShape().setEditable(false);
								  gm.currentShape(null);
								}
							  };
							  
		gm.setSelection 	= function(shape) {
								gm.clearSelection();
								gm.currentShape(shape) ;
								//shape.setEditable(true);
								gm.selectColor(shape.get('fillColor') || shape.get('strokeColor'));
							 };

		gm.deleteCurrentShape= function() {
								if (gm.currentShape()) {
								  gm.currentShape().setMap(null);
								  gm.currentSearch(new gm.searchUrl());
								  
								}
							  };
		
		gm.selectColor		= function(color) {
								gm.selectedColor = color;
								for (var i = 0; i < gm.colors.length; ++i) {
								  var currColor = gm.colors[i];
								  gm.colorButtons[currColor].style.border = currColor == color ? '2px solid #789' : '2px solid #fff';
								}
								var rectangleOptions = gm.drawingManager().get('rectangleOptions');
								rectangleOptions.fillColor = color;
								gm.drawingManager().set('rectangleOptions', rectangleOptions);

								var circleOptions = gm.drawingManager().get('circleOptions');
								circleOptions.fillColor = color;
								gm.drawingManager().set('circleOptions', circleOptions);

								var polygonOptions = gm.drawingManager().get('polygonOptions');
								polygonOptions.fillColor = color;
								gm.drawingManager().set('polygonOptions', polygonOptions);
							  };
		gm.createTooltip 	= function( marker, content) {
								  var tooltipOptions = {
									  marker: marker,
									  content: content,
									  cssClass: 'geotip' // name of a css class to apply to tooltip
								  };
								  new Tooltip(tooltipOptions);
							  };
							  
		gm.polyOptions 		= {
								strokeWeight: 0,
								fillOpacity: 0.45,
								editable: false,
								draggable: false
							  };
				
		gm.drawingOptions	= {
							// Creates a drawing manager attached to the map that allows the user to draw
							// markers, lines, and shapes.
							//drawingMode: google.maps.drawing.OverlayType.POLYGON,
							  drawingControlOptions: {
								position: google.maps.ControlPosition.TOP_CENTER,
								drawingModes: [
								  google.maps.drawing.OverlayType.CIRCLE,
								  google.maps.drawing.OverlayType.POLYGON,
								  google.maps.drawing.OverlayType.RECTANGLE
								]
							  },
							  rectangleOptions	: gm.polyOptions,
							  circleOptions		: gm.polyOptions,
							  polygonOptions	: gm.polyOptions
							}
		gm.drawingManager	= ko.observable();
		
		gm.clearMap			= function() {
								if (gm.infoWindow()) {
									gm.infoWindow().close();
								}
								if(gm.markerListToDrop().length > 0)
								for (var i = 0, m; m = gm.markerListToDrop()[i]; i++) {
								  m.marker.setMap(null);
								}
							  };
		
		gm.showInfoWindow	= function(est){	
								var infoHtml = '<div class="info">'+
									'<div class="info-body" style="width: 350px">' +	      
									  est.infowindow +	     	  
									'</div></div>';									
								  gm.infoWindowEvent(est);
								  gm.infoWindow().setContent(infoHtml);
								  gm.infoWindow().setPosition(est.latlng);
								  gm.infoWindow().open(gm.map());
							}
		gm.markerClick		= function(est){
								return function(e) {
								  e.cancelBubble = true;
								  e.returnValue = false;
								  if (e.stopPropagation) {
									e.stopPropagation();
									e.preventDefault();
								  }   
								  var infoHtml = '<div class="info">'+
									'<div class="info-body" style="width: 350px">' +	      
									  est.infowindow +	     	  
									'</div></div>';		
								
								  gm.infoWindowEvent(est);
								  gm.infoWindow().setContent(infoHtml);
								  gm.infoWindow().setPosition(est.latlng);
								  gm.infoWindow().open(gm.map());
								}
							};
		gm.infoWindowEvent	= ko.observable();
		gm.infoWindow		= ko.observable(new google.maps.InfoWindow());			
		gm.updateMarkers	= function(){
								var markers = {},
									newMarkers = {};								  
									$.map(gm.markerLegend(), function(mk){ markers[mk.name] = mk })
									
									
								 
								  $.each(gm.markerList().map, function(k, v){	
										
									newMarkers[k] = 
										$.map(v, function(m){
											var pic 		= (m.picture)? '../picture' + m.picture : 'img/no-image.jpg',
												markerimage = new google.maps.MarkerImage(
																	markers[k].marker,
																	new google.maps.Size(32, 37), null,
																	new google.maps.Point(16, 30)
																),
												latlng		= new google.maps.LatLng(m.lat, m.long);
											
											m['tooltip'] 	= 	'<h5 class="no-margin">' + m.name + '</h5>' +
																'<p class="no-margin">' + k + '</p>' +
																'<small>Click to see more</small>';
											m['infowindow'] = 	'<div class="clearfix"></div>' +
																'<div class="listview narrow"> ' + 
																'<div class="media">' +
																	'<div class="pull-left">' +
																		'<img style="width: 140px;" src="' + pic + '"/>' +
																	'</div>' +
																	'<div class="media-body">' +
																		'<h5><a class="news-title">' + m.name + '</a></h5>' +
																		'<div class="clearfix"></div>' +
																		'<small class="text-muted">' + m.state + '</small>' +
																		'<small class="text-muted">' + (m.address || m.location._value) + '</small>' +
																		'<br/><a class="pull-right geospatialSeeMore"><small>See more...</small></a><br/> ' +
																	'</div>' +
																'</div>' +
																'</div>';
											
											
											m['latlng']		= 	latlng;
											m['markerimage']= 	markerimage;
																
											return m
										})
								  
								  })
									
								gm.newMarkerList(newMarkers);
								  
							};	
		gm.showMarkers		= function(){ 
								var markers = {}, newMarkers = [];									
								$.map(gm.markerSelected(), function(mk){ markers[mk.name] = mk })								
								
								$.each(markers, function(mk){
									
									if(gm.newMarkerList()[mk]) {
										newMarkers = $.merge(newMarkers, gm.newMarkerList()[mk] )
									}					
								})
								
								gm.markerListToDrop(newMarkers);	
								
							};
		
		
							
		gm.drop				= function(){	
								
								gm.pb.start(gm.markerListToDrop().length);
								if(gm.markerListToDrop().length > 0)
								for (var i = 0; i < gm.markerListToDrop().length; i++) {
								
									if(gm.dropEffect === true){
										gm.dropTimeout = setTimeout(gm.dropMarker, i * 20);
									}else
										gm.dropMarker();
								}
								  	
							};
							
		gm.dropMarker		= function() {
								 gm.pb.updateBar(1);		 
								  var mrkr = new google.maps.Marker({
												position: eval(gm.markerListToDrop()[gm.iterator()].latlng),
												map: eval(gm.map()),
												draggable: false,						
												icon: eval(gm.markerListToDrop()[gm.iterator()].markerimage),
												animation: (gm.dropEffect === true)? google.maps.Animation.DROP : null
											  });	
											  
									
								  gm.markerListToDrop()[gm.iterator()].marker = mrkr;
								  var fn = gm.markerClick(gm.markerListToDrop()[gm.iterator()]);
								  
								  google.maps.event.addListener(mrkr, 'click', fn); 
								  gm.createTooltip(mrkr, gm.markerListToDrop()[gm.iterator()].tooltip);	
								  
								  gm.iterator(gm.iterator()+1);
							 
							};
		
		gm.getData			= function(){
								if(gm.currentSearch().type == 'json') {
									if(!$.isArray( opt.data )) {
										var request = 
										$.ajax({
											type	: "GET",
											url		: opt.data,
											data	: gm.currentSearch(),
											dataType: "json"
										})								
										request.success(
										function(dta){
											if(typeof(dta.map) !== 'undefined' && dta.map !== ''){
												gm.markerList(dta);	
											 }else{
												//self.speedTest.clear();													 
											 }
										});
									}else
										gm.markerList(opt.data)
								}else{
									var request = 
										$.ajax({
											type	: "GET",
											url		: opt.data,
											data	: gm.currentSearch(),
											dataType: "html"
										})								
										request.success(
										function(dta){		
											gm.modalContent.valueHasMutated();
											gm.modalContent(dta);
										});
								}
							};
		
		gm.toggleSelected	= function(){
								var checkedValue = this.checkedValue; 								
								var found = gm.markerSelected().filter(function(i){ return i === checkedValue });
								if(found.length > 0){
									gm.markerSelected.remove(this.checkedValue);
								}else{
									gm.markerSelected.push(this.checkedValue);
								}	
							};	
							
		gm.snapInst			= ko.observable();
		gm.snapHandle		= function(e, f){
								if( gm.snapInst().state().state=="left" ){
									gm.snapInst().close();
								} else {
									gm.snapInst().open('left');
								}
							};
							
		init				:{
		
							  gm.clusterView.subscribe(function () {
									gm.clearMap();
									if (gm.clusterView()) {
									  gm.markerClusterer(new MarkerClusterer(gm.map(), $.map(gm.markerListToDrop(), function(v){ return v.marker }) ));
									} else{
										gm.markerListToDrop(gm.markerListToDrop())
									}            
							  });								  
							  
							  gm.markerSelected.subscribe(function () {
									gm.clearMap();
									gm.showMarkers();
							  });							  
							 
							  gm.newMarkerList.subscribe(function () {
									gm.showMarkers();
							  });							  
							   
							  gm.markerList.subscribe(function () {										
									gm.clearMap();
									gm.updateMarkers();
							  });
							  
							  gm.markerListToDrop.subscribe( function(){
								if (gm.markerClusterer()) {
								  gm.markerClusterer().clearMarkers();
								}
								clearTimeout(gm.dropTimeout);
								gm.iterator(0);
								window.setTimeout(gm.drop(), 0) 
							  });
							  
							  gm.iterator.subscribe( function(){
								if( gm.iterator() === gm.markerListToDrop().length){
									gm.pb.hide();
									gm.dropEffect = false
								}								
							  });	
							  
							  gm.drawingManager.subscribe( function(){
							  
								google.maps.event.addListener(gm.drawingManager(), 'overlaycomplete', function(e) {
									if(gm.previousShape())
									gm.previousShape().setMap(null);
																		
									if (e.type != google.maps.drawing.OverlayType.MARKER) {
										// Switch back to non-drawing mode after drawing a shape.
										gm.drawingManager().setDrawingMode(null);        
									   
										// Add an event listener that selects the newly-drawn shape when the user
										// mouses down on it.
										var newShape = e.overlay;
										newShape.type = e.type;
										google.maps.event.addListener(newShape, 'click', function() {
											gm.setSelection(newShape);
										});
											gm.setSelection(newShape);
											gm.previousShape(newShape); 
											
										gm.polygon(e);
									}
								})
							  
							  })
							  
							  gm.polygon.subscribe( function(e){
								var radius, center, polygon,
								NE,SW,NW,SE, bounds, rec= [];
								switch(e.type){
									
									case 'polygon'		: polygon = e.overlay.getPath().getArray();	        							
														 polygon = $.map( polygon, function( val, i ) {
																		return val.toString().replace(/^\(|\)$/g, '');
																  });	        							
														 rec = polygon.join("::");																
														 gm.currentSearch(new gm.searchUrl('0', null, null, null, rec, null, null));	
														 break;
									case 'circle'		: center = e.overlay.getCenter();
														 radius = e.overlay.getRadius();																	
														 gm.currentSearch(new gm.searchUrl(radius, null, null, 'circle', center.toString().replace(/^\(|\)$/g, '', null, null)));																
														 break;
									case 'rectangle'	:bounds = e.overlay.getBounds();
														 NE = bounds.getNorthEast();
														 SW = bounds.getSouthWest();
														 NW = new google.maps.LatLng(NE.lat(),SW.lng());
														 SE = new google.maps.LatLng(SW.lat(),NE.lng());																
														 rec.push(NE.toString().replace(/^\(|\)$/g, ''));
														 rec.push(SE.toString().replace(/^\(|\)$/g, ''));
														 rec.push(SW.toString().replace(/^\(|\)$/g, ''));
														 rec.push(NW.toString().replace(/^\(|\)$/g, ''));
														 gm.currentSearch(new gm.searchUrl('0', null, null, null, rec.join("::"), null, null));
														break;
									default 			: 
														break;
								
								}
							});
							  
							 gm.map.subscribe( function(){
								gm.drawingOptions['map'] = gm.map()
								gm.drawingManager(new google.maps.drawing.DrawingManager(gm.drawingOptions));
								gm.map().controls[google.maps.ControlPosition.CENTER].push(gm.pb.getDiv());	
								gm.buildColorPalette();
								gm.currentSearch(new gm.searchUrl());
							  });
							  
							  
							  gm.currentSearch.subscribe(function(){
								gm.getData();
							  });
							  
							  
							  $(opt.container).on('click', '.geospatialSeeMore', function(){								
								gm.currentSearch(new gm.searchUrl('0', 'parsed', 'crisis' , 'circle', gm.infoWindowEvent().lat + ',' + gm.infoWindowEvent().long, null, null));								
							  })
							  
							  $(document).on('click', '.resource-accordion-officer-ajax', function(){
									var target = $(this).attr('href');
									$(target).load($(this).attr('data-url'), function(){										
									})
								});						  
							 
							  gm.modalContent.subscribe(function(e){									
								$('#modal-geospatial').modal('show');
							  });
							  
							  gm.chosenTheme.subscribe(function(item){	
								gm.map().setOptions({styles: opt.styles[gm.chosenTheme()]} );
							  });
							  
							  gm.map (
									new google.maps.Map($(opt.container).get(0), 
										{
										  zoom			: opt.map.zoom || 6,
										  scrollwheel	: opt.map.scrollwheel || false,
										  center		: opt.map.center || new google.maps.LatLng(3.76667, 108.03333),
										  mapTypeId		: opt.map.mapTypeId || google.maps.MapTypeId.ROADMAP, 
										  mapTypeControl: opt.map.mapTypeControl || false,
										  zoomControl	: opt.map.zoomControl || true,
										  styles		: opt.styles[gm.chosenTheme()]
										})
									)							
								
							  gm.snapInst(
									new Snap({
										element: $(opt.snapcontainer).get(0),
										disable: 'right'
									})
								);
							}	
	}
	
	
	
	
	ko.cleanNode($(self.options.geocontainter)[0]);	
	var modelOptions = {
						serverurl	: self.options.serverurl,
						data		: self.options.data,
						container	: self.options.plugincontainter,
						snapcontainer: self.options.snapcontainer,
						themes 		: $.map(self.config.mapstyles, function(v, k){return k;}),
						styles 		: self.config.mapstyles,
						pbOptions	: self.pbOptions,
						markers		: self.markers,
						clusters 	: self.clusters,
						map			: {
										zoom		: 6,
										scrollwheel	: false,
										center		: new google.maps.LatLng(3.76667, 108.03333),
										mapTypeId	: google.maps.MapTypeId.ROADMAP, 
										mapTypeControl: false,
										zoomControl	: true,
									}
						}						
	self.geoModelInst 	= new geospatialModel(modelOptions);
	ko.applyBindings(	self.geoModelInst, 
						$(self.options.geocontainter)[0]
					);				
	
	
	
	
	
	
	
}