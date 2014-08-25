function mindmapModel(opts){	
	var self = this;
	
		self.config		= $.parseJSON(window.localStorage.getItem('config'));
		self.settings	= ko.observable(self.config);
		self.options	= $.extend(self.settings().mindmap, (opts || {}) );
						
	
	self.getMindMapNodeReport = 
	function(e){		
		var data = {}, hrf = $(this).attr('href');
		  [].forEach.call(this.attributes, function(attr) {
			  if (/^data-/.test(attr.name)) {
				  var camelCaseName = attr.name.substr(5).replace(/-(.)/g, function ($0, $1) {
					  return $1.toUpperCase();
				  });
				  data[camelCaseName] = attr.value;
			  }
		  }) 	  
		  $(hrf)
		  //.html(self.loading)
		  .load('../xquery/relation_final.xqy?type=parsed&stylesheet=' + self.settings().directory +'node-info-report.xsl&id=' + data.id, function(){
			$(this)
			.collapse('show');			
			$(".scrollable").each(function(){
				if(parseInt(parseInt($(this).attr('data-height')) || 350) < $(this).height())					
				$(this).slimscroll({
					height: parseInt($(this).attr('data-height')) || 350,
					size: '5px',
					alwaysVisible: false,
					railVisible: true
				});	
			});
			
		   })
		  
		 
	};
	
	
	init: {	
			
		if(self.options.type === 'static'){
			$(self.options.container).html([
				'<div class="js-mindmap-static p-t-20 p-b-20"><br/>',
				'<div class="overlay m-t-20 m-b-20 p-l-10 p-r-10 p-b-20 p-t-20">',
				'<h3 lang="en">Not enough? Tired of seeing texts.</h3>',
				'<p lang="en">See your results in visualization</p>',
				'<a href="#" lang="en">Great way to display your search results.</a>',
				'</div>',
				'<br/></div>'].join(''))
		}else
		$(self.options.container)
		.load(self.settings().sitefolder + '/plugins/mindmap/data/data.html',
		function(){	
			$(self.options.container).mindmap({
				mapArea: {x: (self.options.x || -1), y: (self.options.y || 250)},
				attract: 2, //6
				repulse: .5, //2
				damping: 0.3, //.55
				timeperiod: 10, //10
				wallrepulse: 0.0001, //.2
				canvasError: 'alert',
				minSpeed: 0.05,
				maxForce: 0.1,
				showSublines: false,
				updateIterationCount: 20,
				showProgressive: true
			});			
			$(self.options.container ).find('[data-toggle="popover"]').popover();		
			//$('#js-mindmap-panel-info-accordion').on('shown.bs.collapse', function (e) { });		
			$(self.options.container ).find('.node-info a[data-rel = "node-info-report"]').on('click',self.getMindMapNodeReport)		
			
		})
	}
	

}