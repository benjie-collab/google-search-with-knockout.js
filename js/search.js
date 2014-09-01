jQuery(document).ready(function(){	

	//console.log(bxtsrch_options)	
	//jQuery('#bxtsrch_result').html( bxtsrch_options.url + jQuery.param( bxtsrch_options.params, true ))

	
	
	
	ko.bindingHandlers.gridGallery = {
		cbpgg : ko.observable() ,
		init: function(element, valueAccessor){	
			this.cbpgg=new CBPGridGallery( jQuery( '#' + jQuery(element).closest('.grid-gallery').attr('id') )[0] )	
			//new gGallery(element, valueAccessor);
		},
		update: function(element, valueAccessor) {
			ko.utils.unwrapObservable(valueAccessor()); //grab a dependency to the obs array
			this.cbpgg._init();
		}
	}
	
	
	
	
	
	
	
	var viewModel = {
	
		webSearch		: new google.search.WebSearch(),
		imageSearch		: new google.search.ImageSearch(),
		newsSearch		: new google.search.NewsSearch(),
		videoSearch		: new google.search.VideoSearch(),
		blogSearch		: new google.search.BlogSearch(),		
		bookSearch		: new google.search.BookSearch(),		
		patentSearch	: new google.search.PatentSearch(),
		
		searchControl 	: new google.search.SearchControl(),
		searchOptions 	: new google.search.SearcherOptions(),
		
		numResultPerPage: ko.observable(10),
		resultPages		: ko.observable(0),		
		
		webResult		: ko.observableArray(),
		webResultPg		: ko.observable(),
		webResultCurrPg	: ko.observable(),
		webResultNxtPg	: function(data, event){	
							viewModel.webResultCurrPg(jQuery(event.currentTarget).data().pg);
							viewModel.webSearch.gotoPage(jQuery(event.currentTarget).data().pg);							
						},
		webSearchComplete
						: function(res){														
							viewModel.resultPages(res.cursor.pages);
							viewModel.webResultPg(res.cursor.estimatedResultCount);
							viewModel.webResult(res.results);
							
						},
						
						
						
						
		imageResult		: ko.observableArray(),
		imageResultPg	: ko.observable(),
		imageResultCurrPg: ko.observable(),
		imageResultNxtPg: function(data, event){				
							viewModel.imageResultCurrPg(jQuery(event.currentTarget).data().pg);
							viewModel.imageSearch.gotoPage(jQuery(event.currentTarget).data().pg);							
						},
		imageSearchComplete	
						: function(res){							
							viewModel.resultPages(res.cursor.pages);
							viewModel.imageResultPg(res.getResultSetSize());
							viewModel.imageResult(res.results);
						},
						
						
						
						
						
						
		newsResult		: ko.observableArray(),
		newsResultPg	: ko.observable(),
		newsResultCurrPg: ko.observable(),
		newsResultNxtPg	: function(data, event){				
							viewModel.newsResultCurrPg(jQuery(event.currentTarget).data().pg);
							viewModel.newsSearch.gotoPage(jQuery(event.currentTarget).data().pg);							
						},
		newsSearchComplete
						: function(res){
							viewModel.resultPages(res.cursor.pages);
							viewModel.newsResultPg(res.getResultSetSize());
							viewModel.newsResult(res.results);
						},		



						
		videoResult		: ko.observableArray(),
		videoResultPg	: ko.observable(),
		videoResultCurrPg: ko.observable(),
		videoResultNxtPg	: function(data, event){				
							viewModel.videoResultCurrPg(jQuery(event.currentTarget).data().pg);
							viewModel.videoSearch.gotoPage(jQuery(event.currentTarget).data().pg);							
						},
		videoSearchComplete
						: function(res){
							viewModel.resultPages(res.cursor.pages);
							viewModel.videoResultPg(res.getResultSetSize());
							viewModel.videoResult(res.results);
						},		
						

						

		blogResult		: ko.observableArray(),
		blogResultPg	: ko.observable(),
		blogResultCurrPg: ko.observable(),
		blogResultNxtPg	: function(data, event){				
							viewModel.blogResultCurrPg(jQuery(event.currentTarget).data().pg);
							viewModel.blogSearch.gotoPage(jQuery(event.currentTarget).data().pg);							
						},
		blogSearchComplete
						: function(res){
							viewModel.resultPages(res.cursor.pages);
							viewModel.blogResultPg(res.getResultSetSize());
							viewModel.blogResult(res.results);
						},		
						
						
				
						
		bookResult		: ko.observableArray(),
		bookResultPg	: ko.observable(),
		bookResultCurrPg: ko.observable(),
		bookResultNxtPg	: function(data, event){				
							viewModel.bookResultCurrPg(jQuery(event.currentTarget).data().pg);
							viewModel.bookSearch.gotoPage(jQuery(event.currentTarget).data().pg);							
						},
		bookSearchComplete
						: function(res){
							viewModel.resultPages(res.cursor.pages);
							viewModel.bookResultPg(res.getResultSetSize());
							viewModel.bookResult(res.results);
						},					
						
						
						
		patentResult	: ko.observableArray(),
		patentResultPg	: ko.observable(),
		patentResultCurrPg: ko.observable(),
		patentResultNxtPg	: function(data, event){				
							viewModel.patentResultCurrPg(jQuery(event.currentTarget).data().pg);
							viewModel.patentSearch.gotoPage(jQuery(event.currentTarget).data().pg);							
						},
		patentSearchComplete
						: function(res){
							console.log(JSON.stringify(res))
							viewModel.resultPages(res.cursor.pages);
							viewModel.patentResultPg(res.getResultSetSize());
							viewModel.patentResult(res.results);
						},
						
						
		
						
								
        detailsEnabled	: ko.observable(false),
		
		s				: ko.observable(),
		
        enableDetails	: function(obj, element) {
							if(element.target.value.length > 3){
								this.s(element.target.value)
								this.detailsEnabled(true);
							}else{
								this.detailsEnabled(false);
							}            
						},
		
        disableDetails	: function() {
							this.detailsEnabled(false);
						},
						
		imgrdHandler: function (elements, data) {
			//console.log(jQuery( '#grid-gallery' ).html())
			//jQuery( '#grid-gallery' ).detach();			
		}
    };
	
	
	
	
	viewModel.imageResult.subscribe(function(newValue) {
		//console.log(jQuery( '#grid-gallery' ).html())
		//new CBPGridGallery( jQuery( '#grid-gallery' )[0] );
	})
	
	
	
	viewModel.s.subscribe(function(newValue) {	
			
		viewModel.searchOptions.setExpandMode(google.search.SearchControl.EXPAND_MODE_OPEN);
		
		viewModel.searchControl.addSearcher(viewModel.webSearch,viewModel.searchOptions);	
		viewModel.searchControl.addSearcher(viewModel.videoSearch,viewModel.searchOptions);
		viewModel.searchControl.addSearcher(viewModel.imageSearch,viewModel.searchOptions);
		viewModel.searchControl.addSearcher(viewModel.newsSearch,viewModel.searchOptions);
		viewModel.searchControl.addSearcher(viewModel.blogSearch,viewModel.searchOptions);
		viewModel.searchControl.addSearcher(viewModel.bookSearch,viewModel.searchOptions);
		viewModel.searchControl.addSearcher(viewModel.patentSearch,viewModel.searchOptions);
		
		viewModel.searchControl.setResultSetSize(google.search.Search.LARGE_RESULTSET);
		
		
		
		
		
		viewModel.webSearch.setSearchCompleteCallback(this, viewModel.webSearchComplete, [viewModel.webSearch]);	
		viewModel.webSearch.setNoHtmlGeneration();
		viewModel.webSearch.execute(viewModel.s().toLowerCase() );		
		
		
		viewModel.imageSearch.setSearchCompleteCallback(this, viewModel.imageSearchComplete, [viewModel.imageSearch]);	
		viewModel.imageSearch.setNoHtmlGeneration();
		viewModel.imageSearch.execute(viewModel.s().toLowerCase());	
		
		
		viewModel.newsSearch.setSearchCompleteCallback(this, viewModel.newsSearchComplete, [viewModel.newsSearch]);		
		viewModel.newsSearch.setNoHtmlGeneration();
		viewModel.newsSearch.execute(viewModel.s().toLowerCase());		
		
		viewModel.videoSearch.setSearchCompleteCallback(this, viewModel.videoSearchComplete, [viewModel.videoSearch]);	
		viewModel.videoSearch.setNoHtmlGeneration();
		viewModel.videoSearch.execute(viewModel.s().toLowerCase());		
		
		viewModel.blogSearch.setSearchCompleteCallback(this, viewModel.blogSearchComplete, [viewModel.blogSearch]);	
		viewModel.blogSearch.setNoHtmlGeneration();
		viewModel.blogSearch.execute(viewModel.s().toLowerCase());	
		
		
		
		viewModel.bookSearch.setSearchCompleteCallback(this, viewModel.bookSearchComplete, [viewModel.bookSearch]);		
		viewModel.bookSearch.setNoHtmlGeneration();		
		viewModel.bookSearch.execute(viewModel.s().toLowerCase());	
		
		
		viewModel.patentSearch.setSearchCompleteCallback(this, viewModel.patentSearchComplete, [viewModel.patentSearch]);	
		viewModel.patentSearch.setNoHtmlGeneration();				
		viewModel.patentSearch.execute(viewModel.s().toLowerCase());
		
		
				
	});
	
	
	ko.applyBindings(viewModel);	
	viewModel.s(bxtsrch_options.search.s);
	
	
});