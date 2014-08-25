function languageModel(inst){

	var self = this;	
	
	self.config				= $.parseJSON(window.localStorage.getItem('config'));	
							
	self.language 			= inst;
	self.allLanguages 		= ko.observableArray( $.map(self.config.languages.languages, function(v, k){return k;}) );
	self.selectedLanguage 	= ko.observable();	
	init					: {										
								
								self.selectedLanguage.subscribe(function(item){ 
									//$(f.currentTarget).closest('.modal').modal('hide')
									var lang = self.config.languages.languages[item]
									self.config.language = item;
									self.language.change(lang.code);
									self.config.languages.instance = self.language;
									window.localStorage.setItem("config", JSON.stringify(self.config));	
								});
								
								self.selectedLanguage(self.config.language)
								

							}
	
}