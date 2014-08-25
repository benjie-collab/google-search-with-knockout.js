function annotatorModel(ops){

	var self = this;
	
		self.config		= $.parseJSON(window.localStorage.getItem('config'));
		self.settings	= ko.observable(self.config);
		self.options	= $.extend(self.settings().annotator, (opts || {}) );
	
		self.annotator 	= ko.observable();
	
	init: {	
		
		self.annotator.subscribe(function(){	
			
		
			//self.annotator().annotator('setupPlugins');
			self.annotator().annotator("addPlugin", "Offline", {
			  online: function (plugin) {
				console.log('Online');
			  },
			  offline: function (plugin) {
				console.log('Offline')
			  }
			});	
			
			var optionsRichText = {
				tinymce:{
					selector: "li.annotator-item textarea",
					plugins: "media image insertdatetime link code",
					menubar: false,
					toolbar_items_size: 'small',
					extended_valid_elements : "iframe[src|frameborder|style|scrolling|class|width|height|name|align|id]",
					toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media rubric | code ",
				}
			};
		
			self.annotator().annotator('addPlugin','RichText',optionsRichText);
			self.annotator().data('omnimalaysia-annotation');
		});		
		
		self.annotator($('body').annotator() )
	
	}
	
}