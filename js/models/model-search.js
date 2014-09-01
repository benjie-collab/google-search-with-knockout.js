function resultsModel(opts){	
	var self = this;
	
		self.config		= ko.observable($.parseJSON(window.localStorage.getItem('config')));
		self.options	= ko.observable();	
		self.params		= ko.observable();
		self.webSearch	= new google.search.WebSearch();
		self.imageSearch= new google.search.ImageSearch();
		self.newsSearch	= new google.search.NewsSearch();
		self.search		= ko.observable();
		
		self.webResult		= ko.observableArray();
		self.webSearchComplete	
						= function(res){
							self.webResult(res.results)
						}
		self.imageResult		= ko.observableArray();
		self.imageSearchComplete	
						= function(res){		
							self.imageResult(res.results)
						}
		self.newsResult		= ko.observableArray();
		self.newsSearchComplete	
						= function(res){		
							self.newsResult($.map(res.results, function(rs){ if(typeof(rs.image) === 'undefined') rs['image'] = null; return rs}))
						}
						init	: {	
									
									self.search.subscribe(function(){
										self.webSearch.setSearchCompleteCallback(this, self.webSearchComplete, [self.webSearch]);											
										self.imageSearch.setSearchCompleteCallback(this, self.imageSearchComplete, [self.imageSearch]);											
										self.newsSearch.setSearchCompleteCallback(this, self.newsSearchComplete, [self.newsSearch]);											
										
										self.webSearch.execute(self.config().search.query);			
										self.imageSearch.execute(self.config().search.query);	
										self.newsSearch.execute(self.config().search.query);	
									});
									
									self.params.subscribe(function(){
										//console.log(self.options());
										if(self.options().enabled === true)
											self.search($.param( self.options().params, true ));
									});
									
									self.options($.extend(self.config().wikipedia, (opts || {})))									
									self.params($.extend(self.config().wikipedia.params, 
										{
											titles: self.config().search.query.toLowerCase(),
											gsrsearch: self.config().search.query.toLowerCase(),
										}
									))
									
									
									}
	

}














