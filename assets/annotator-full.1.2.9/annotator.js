function annotatorView(){

	
		var stylesheet;	
		if ($('#annotator-stylehsheet').length === 0) {
				stylesheet = document.createElement( 'link' );
				stylesheet.id = 'annotator-stylehsheet';
				stylesheet.rel = 'stylesheet';
				stylesheet.type = 'text/css';
				stylesheet.href = 'assets/annotator-full.1.2.9/css/annotator.min.css';
				$("head").append( stylesheet );
		}	
		
		if ($('#annotator-richText-stylehsheet').length === 0) {
				stylesheet = document.createElement( 'link' );
				stylesheet.id = 'annotator-richText-stylehsheet';
				stylesheet.rel = 'stylesheet';
				stylesheet.type = 'text/css';
				stylesheet.href = 'assets/annotator-full.1.2.9/css/richText-annotator.css';
				$("head").append( stylesheet );
		}	
		
		var script;
		if ($('#annotator-script').length === 0) {
				script = document.createElement( 'script' );
				script.id = 'annotator-script';
				script.type = 'text/javascript';
				script.src = 'assets/annotator-full.1.2.9/js/annotator-full.min.js';
				$("body").append( script );
		}
		
		if ($('#annotator-model-script').length === 0) {
				script = document.createElement( 'script' );
				script.id = 'annotator-model-script';
				script.type = 'text/javascript';
				script.src = 'assets/annotator-full.1.2.9/js/model.js';
				$("body").append( script );
		}
		
		if ($('#annotator-richText-script').length === 0) {
				script = document.createElement( 'script' );
				script.id = 'annotator-richText-script';
				script.type = 'text/javascript';
				script.src = 'assets/annotator-full.1.2.9/plugins/richText-annotator.js';
				$("body").append( script );
		}
		
		if ($('#annotator-offline-script').length === 0) {
				script = document.createElement( 'script' );
				script.id = 'annotator-offline-script';
				script.type = 'text/javascript';
				script.src = 'assets/annotator-full.1.2.9/plugins/annotator.offline.min.js';
				$("body").append( script );
		}
		
		
		
		var annotator = new annotatorModel({})
		
}

var annotator = new annotatorView();