function plugIns(plugins) {
	
	var self = this;		
	
	self.config				= $.parseJSON(window.localStorage.getItem('config'));	
	self.deferreds			= ko.observableArray();
	self.pluginList			= ko.observableArray();
	self.counter			= ko.observable(0);	
	
	self.getPlugins			= function(e){	
								console.log(document.location.pathname.replace(/[^\\\/]*$/, ''))	
							};
	
	init: {		
			
			self.pluginList.subscribe(function(){
				
				
				$.map(self.pluginList(), function(pl) {
					if(pl.enabled === true);
					self.deferreds().push(new $.Deferred());
				});					
				
				$.map(self.pluginList(), function(pl) {
					//self.deferreds().push(new $.Deferred());	
					if(pl.enabled === true)
					$(pl.container).load(
					pl.url + '?_=' + new Date().getTime(),
					function() {
					
						self.deferreds()[self.counter()].resolve();						
						self.counter(self.counter()+1);
					});
					
				});				
				
				
				// When all deferreds are done (all images loaded) do some stuff
				$.when.apply(null, self.deferreds()).done(function() { 	
					//if(self.config.languages.enabled === true)
					//self.displayLanguage();						
				});
				
				
				
			})
			self.pluginList(plugins);		
		}   
}