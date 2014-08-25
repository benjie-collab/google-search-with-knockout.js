function conceptmapView(opts){	
	var self = this;
	
		self.config		= $.parseJSON(window.localStorage.getItem('config'));
		self.settings	= ko.observable(self.config);
		self.options	= $.extend(self.settings().mindmap, (opts || {}) );		
		
}