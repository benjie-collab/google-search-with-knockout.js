function wikipediaModel(opts){	
	var self = this;
	
		self.config		= ko.observable($.parseJSON(window.localStorage.getItem('config')));
		self.options	= ko.observable();	
		self.params		= ko.observable();
		self.search		= ko.observable();
		self.result		= ko.observableArray();
		self.wikipediaResult	= function(res){
									if(typeof(res.query.pages)!== 'undefined')
									self.result($.map(res.query.pages, function(i){ if(!i.thumbnail) i['thumbnail'] = null;  return i;}));
									
									}
						init	: {	
											
									
									
									self.result.subscribe(function(){
									});
									
									self.search.subscribe(function(){
										try {
											$.getJSON(self.options().url + self.search() + '&callback=?' , self.wikipediaResult)
										}
										catch(err) {
											console.log('Wikipedia no result')
										}										
									});
									
									self.params.subscribe(function(){
										//console.log(self.options());
										if(self.options().enabled === true)
											self.search($.param( self.options().params, true ));
									});
									
									self.options($.extend(self.config().wikipedia, (opts || {})))									
									self.params($.extend(self.config().wikipedia.params, 
										{
											titles: self.config().search.query.toLowerCase() + ',' + self.config().search.query.toUpperCase(),
											gsrsearch: self.config().search.query.toLowerCase() + ',' + self.config().search.query.toUpperCase(),
										}
									))
									
									
									}
	

}