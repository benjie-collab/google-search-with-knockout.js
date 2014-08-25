function searchModel(opts){	
	var self = this;
	
		self.config		= $.parseJSON(window.localStorage.getItem('config'));
		self.settings	= ko.observable(self.config);
		self.options	= $.extend(self.settings.search, (opts || {}) );	
		self.query		= ko.observable(self.options.query)
		self.suggestions= ko.observable();
		self.searchPlugins= ko.observableArray();
		self.searchSuggest
						= _.debounce(function(e, f, g){
							if($(f.delegateTarget).val().length > 2)
							self.query($(f.delegateTarget).val())
						}, 450)
						
		self.keywordSearch
						= function(e){							  
							return false;						
						};
						
		self.getHashValue 
						= function(e){	
						var hash = window.location.hash.replace('#', '');
							if(hash.length > 0) {
								var nsearch = JSON.parse('{"' + decodeURI( hash.replace(/&/g, "\",\"").replace(/=/g,"\":\"")) + '"}');
								self.options = $.extend({}, self.options, nsearch);									
															
								self.query(self.options.query);								
							}							
						return false;		
						}
		self.querySuggest 
						= new Bloodhound({
								datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
								queryTokenizer: Bloodhound.tokenizers.whitespace,
								prefetch: self.config.sitefolder + '/plugins/search/data/suggest.json',
								remote: self.config.sitefolder + '/plugins/search/data/remote.json'
							});	
		
				init	: {								
							
							self.searchPlugins.subscribe(
							function(){			
								
								new plugIns(self.searchPlugins());
							})
							 
							self.query.subscribe(
							function(){
								self.options.query = self.query();
								self.settings().search = self.options;	
								self.config = self.settings();								
								window.localStorage.setItem("config", JSON.stringify(self.config));	
								
								//var plg = self.settings().plugins[0].subplugins;
								var plg = $.parseJSON(window.localStorage.getItem(self.settings().currentpage)).plugins[0].subplugins;
								//plg.push(self.settings().plugins[self.settings().plugins.length - 1]);								
								self.searchPlugins(plg);
								
								
								window.location.hash = $.param(self.options, true);	
								return false;
							})
							
							
							
							self.getHashValue();
							
							
							self.querySuggest.initialize();	
							self.suggestions(
								$('#search-input').typeahead(
										{
											hint: true,
											highlight: true,
											minLength: 3 }, 											
										{
											name: 'search-input',
											displayKey: 'value',
											source: self.querySuggest.ttAdapter(),
											templates: {
											empty: [
											'<div class="empty-message">',
											'Unable to find suggestions, try another...',
											'</div>'
											].join('\n'),
											suggestion: Handlebars.compile('<p><span>{{value}}</span> – {{year}}</p>')
										}
									})
									.on ('typeahead:opened', function(e) {
										//console.log(e);
									})
									.on ('typeahead:closed', function(e, el, fl) {
										//self.keywordSearch(e);
									})
									.on('typeahead:selected', function(e, data) {										
										console.log(data);											
									})
									.on('typeahead:autocompleted', function(e, data) {										
										//console.log(data);											
									})
							)	
							
							
							
								
						}

}