//settings
//window.localStorage.clear() //try that


$(function(){
	'use strict';
	
	var cfg 			= this,
		tmpltInst		= null;
		cfg.settings 	= {};

	/* --------------------------------------------------------
	Template Model
	-----------------------------------------------------------*/
	var TemplateModel = function(skins) {	
		var self = this;
		self.settings			= ko.observable(cfg.settings);
		self.sitename 			= self.settings().sitename;
		self.sitedescription 	= self.settings().sitedescription;
		self.skins 				= ko.observableArray(skins);	
		self.skin				= ko.observable( self.settings().skin || self.skins()[0] );	
		self.currentPage		= ko.observable();	
		self.skinId				= ko.computed(function() {			
									return self.skin().name;
									});
		self.bodyClick			= function(e){
									/** close chats **/
									var container = $('.chat, .chat .chat-list');
									if (container.has(e.target).length === 0) {
										container.removeClass('toggled');
									}		
								}
		self.changeTheme 		= function(e){
									self.skin(e);			
									$('#changeSkin').modal('hide');			
									self.settings().skin = e;
									
									return false;		
									}			
		
		self.toggleMenu 		= function(e){			
									$('html').toggleClass('menu-active');
									$('#sidebar').toggleClass('toggled');			
									return false;
									}		
		
		self.displayChat 		= function(e){	
									$("body").append($("<div id='chat-container'>").load("plugins/chat/index.html?uid=" + new Date().getTime()));		
									return false;
									}						
		
		self.getCurrentPage		= function(){									
									var href = window.location.pathname;								
									var lastPart = href.match(/.*\/(.*)$/)[1],
										pg = lastPart.split('.')? lastPart.split('.')[0]: lastPart;
									self.currentPage(pg.length !== 0? pg : 'index');									
									}
									
		
		self.loadPlugins		= function(){	  
									$.getJSON(self.currentPage() + ".json", {}) 
									.done(function(plg){
										var st = plg || {};		
										localStorage.setItem(self.currentPage(), JSON.stringify(st));
										new plugIns(st.plugins);
										
									})	
									.fail(function( jqxhr, textStatus, error ) {
										alert('Page Plugins Config Error');
									})
									}
									
		self.loadAssets		= function(){	  
									$.getJSON("assets/assets.json", {}) 
									.done(function(asst){
										var st = asst || {};		
										//localStorage.setItem(self.currentPage(), JSON.stringify(st));
										new Assets(st.assets);
										
									})	
									.fail(function( jqxhr, textStatus, error ) {
										alert('Assets Config Error');
									})
									}
		
		
						init	: {		
									if(self.settings().sidebar === false)
									self.toggleMenu();
									
									if(self.settings().chat === true)
									self.displayChat();									
									
									self.currentPage.subscribe(function(){										
										var st = self.settings()
											st.currentpage = self.currentPage()
											self.settings(st);
											self.loadPlugins();
											self.loadAssets();
									})
									self.settings.subscribe(function(){
										window.localStorage.setItem("config", JSON.stringify(self.settings()));	
									})
									
									
										$.ajax({ 
										   type: "GET",
										   dataType: "jsonp",
										    contentType: "application/json; charset=utf-8",
										   url: "http://192.168.0.160:8003/v1/qbe?format=json",
										   success: function(data){        
											 alert(data);
										   }
										});
										
											
										
									
									}
		
		};
		

	/* --------------------------------------------------------
	Read Configuration file
	-----------------------------------------------------------*/
	if(!window.localStorage.getItem('config'))
		$.getJSON("config.json", {}) 
		.done(function(conf){
			cfg.settings = conf || {};		
			localStorage.setItem("config", JSON.stringify(cfg.settings));
			tmpltInst = new TemplateModel(cfg.settings.skins || [])
			ko.applyBindings(tmpltInst);
			//tmpltInst.loadPlugins();
			tmpltInst.getCurrentPage()
		})
		.fail(function( jqxhr, textStatus, error ) {
			alert('Configuration Error');
		})
	else{
		cfg.settings = $.parseJSON(window.localStorage.getItem('config'));
		tmpltInst = new TemplateModel(cfg.settings.skins || [])
		ko.applyBindings(tmpltInst);
		//tmpltInst.loadPlugins();
		tmpltInst.getCurrentPage()
	}		
})






