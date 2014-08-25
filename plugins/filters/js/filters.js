function filtersModel(opts){	
	var self = this;
	
		self.config		= $.parseJSON(window.localStorage.getItem('config'));
		self.filters	= ko.observable(self.config.filters);	
		self.fields		= ko.observable(self.filters().fields);	
		self.categories	= ko.observableArray(self.filters().categories);	
		self.params		= ko.observable();
		
		/**
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
	
			**/
						init	: {
						
						
						}
}

















/**
var imageSearch;
var webSearch;
var newsSearch;
var blogSearch;
var lastSearch = 0;
$(function () {
    imageSearch = new google.search.ImageSearch();
    imageSearch.setSearchCompleteCallback(this, imgSearchComplete, null);
    webSearch = new google.search.WebSearch();
    webSearch.setSearchCompleteCallback(this, webSearchComplete, [webSearch, lastSearch]);
    newsSearch = new google.search.NewsSearch();
    newsSearch.setSearchCompleteCallback(this, newsSearchComplete, [newsSearch, lastSearch]);
    var hash = window.location.hash;
    if (hash != "" && hash.length > 0) {
        if (hash.substr(0, 3) == '#q=') {
            var query = hash.substr(3, hash.length - 3);
            $('#searchbox').removeClass('text-label').val(query);
            search(query);
        }
    }
    $('#searchbox').focus();
});

function imgSearchComplete() {
    if (imageSearch.results && imageSearch.results.length > 0) {
        var contentDiv = document.getElementById('image-content');
        contentDiv.innerHTML = '';
        var results = imageSearch.results;
        for (var i = 0; i < results.length; i++) {
            var result = results[i];
            var imgContainer = document.createElement('div');
            imgContainer.setAttribute("align", "left");
            var newLink = document.createElement('a');
            newLink.href = result.unescapedUrl
            newLink.target = "_new";
            newLink.title = result.titleNoFormatting;
            var newImg = document.createElement('img');
            newImg.src = result.tbUrl;
            newImg.setAttribute("align", "left");
            newLink.appendChild(newImg);
            imgContainer.appendChild(newLink);
            contentDiv.appendChild(imgContainer);
        }
    }
}

function webSearchComplete(searcher, searchNum) {
    var contentDiv = document.getElementById('web-content');
    contentDiv.innerHTML = '';
    var results = searcher.results;
    var newResultsDiv = document.createElement('div');
    newResultsDiv.id = 'web-content';
    for (var i = 0; i < results.length; i++) {
        var result = results[i];
        var resultHTML = '<div style="height:70px; margin-top:5px;">';
        resultHTML += '<a href="' + result.unescapedUrl + '" target="_blank"><b>' + result.titleNoFormatting + '</b></a><br/>' + result.content + '<div/>';
        newResultsDiv.innerHTML += resultHTML;
    }
    contentDiv.appendChild(newResultsDiv);
}

function newsSearchComplete(searcher, searchNum) {
    var contentDiv = document.getElementById('news-content');
    contentDiv.innerHTML = '';
    var results = searcher.results;
    var newResultsDiv = document.createElement('div');
    newResultsDiv.id = 'news-content';
    for (var i = 0; i < results.length; i++) {
        var result = results[i];
        var resultHTML = '<div style="height:70px; margin-top:5px;">';
        if (result.image != undefined) {
            resultHTML = '<img align="right" src="' + result.image.tbUrl + '"/>';
        }
        resultHTML += '<a href="' + result.unescapedUrl + '" target="_blank"><b>' + result.titleNoFormatting + '</b></a><br/>';
        resultHTML += result.content + '<br/></div>';
        newResultsDiv.innerHTML += resultHTML;
    }
    contentDiv.appendChild(newResultsDiv);
}
$('#searchbox').keyup(function () {
    var query = $(this).val();
    search(query);
});

function search(query) {
    if (query.length > 0) {
        $("#search-content").show();
        document.title = query + " | Real Time Search - viralpatel.net";
        window.location.hash = "q=" + query;
    } else {
        document.title = "Real Time Search - viralpatel.net";
        $("#search-content").hide();
    }
    imageSearch.execute(query);
    webSearch.execute(query);
    newsSearch.execute(query);
}
$('#searchbox').each(function () {
    $(this).addClass('text-label');
    $(this).keyup(function () {
        if (this.value.length == 1) {
            $(this).removeClass('text-label');
        }
        if (this.value == '') {
            $(this).addClass('text-label');
        }
    });
});**/