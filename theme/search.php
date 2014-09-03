<?php
/**
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

<div class="main-content" id="main-content">
	<section id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<?php $primary =  isset($bxttoptions['active'][array_keys($bxttoptions['active'])[0]]) ? $bxttoptions['active'][array_keys($bxttoptions['active'])[0]] : null; ?>
			<?php if($primary == 'WebSearch') { ?>
			<div class="w-result group-blog" data-bind="foreach: webResult">
				<article class="post-30 page type-page status-publish hentry" id="post-30">
					<header class="entry-header">
						<div class="entry-meta">
							<span class="cat-links"><a rel="category tag" href="#">Web</a></span>
						</div>
						<h1 class="entry-title">
							<a data-bind="attr:{ href: url, title: titleNoFormatting}, html: title" target="_blank"></a>
						</h1>
					</header><!-- .entry-header -->
					<div class="entry-content" data-bind="html: content">
					</div>
				</article>
			</div>		
			<nav class="navigation paging-navigation" role="navigation">
				<ul data-bind="foreach: resultPages" class='page-numbers'>
					<li><a tabindex="0" class="page-numbers" data-bind="click: $parent.webResultNxtPg, css: { current: $parent.webResultCurrPg() == $data.label - 1 } , text: $data.label, attr: {'data-pg': $data.label - 1, href: '#content&pg=' + $data.label }"></a></li>
				</ul> 
			</nav><!-- .navigation -->
			
			
			
			
			<?php } 
			elseif($primary == 'VideoSearch' ) { ?>
			<div class="v-result group-blog" data-bind="foreach: videoResult">
				<article class="post-203 post type-post status-publish format-video hentry category-videos" >	
					<header class="entry-header">
						<div class="entry-meta">
							<span class="cat-links"><a rel="category tag" href="#">Videos</a></span>
						</div><!-- .entry-meta -->
						<h1 class="entry-title">
							<!-- ko if: typeof(playUrl) != "undefined" -->
							<a rel="bookmark" data-bind="html: title, attr: { href: playUrl }"></a>
							<!-- /ko --> 
							<!-- ko if: typeof(playUrl) == "undefined" -->
							<a rel="bookmark" data-bind="html: title, attr: { href: url }"></a>
							<!-- /ko --> 
						</h1>
						<div class="entry-meta">
							<span class="post-format">
								<a href="#" class="entry-format">Video</a>
							</span>

							<span class="entry-date"><a rel="bookmark" href="#"><time data-bind="text: published" class="entry-date"></time></a></span> 
							<span class="byline"><span class="author vcard"><a rel="author" href="#" class="url fn n" data-bind="text: publisher"></a></span></span>
							<span class="byline"><span class="author vcard"><a rel="author" href="#" class="url fn n" data-bind="text: duration"></a></span></span>
							
						</div><!-- .entry-meta -->						
						
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p>
							<span style="text-align:center; display: block;">
								<!-- ko if: typeof(playUrl) != "undefined" -->
								<iframe data-bind="attr: { src:  url.replace('http://www.youtube.com/watch?v=', 'http://www.youtube.com/embed/')  , type: videoType }" type="text/html" webkitAllowFullScreen allowFullScreen allowTransparency="true" mozallowfullscreen width="100%" height="280" frameborder="0" class="vzaar-video-player"></iframe>
								<!-- /ko --> 
								<!-- ko if: typeof(playUrl) == "undefined" -->
								<a rel="bookmark" data-bind="attr: { href: url }">
								<img data-bind="attr: {src: tbUrl}" class="aligncenter"/>
								</a>
								<!-- /ko -->
							</span>
						</p>
					</div><!-- .entry-content -->

				</article>
			</div>
			<nav class="navigation paging-navigation" role="navigation">
				<ul data-bind="foreach: resultPages" class='page-numbers'>
					<li><a tabindex="0" class="page-numbers" data-bind="click: $parent.videoResultNxtPg, css: { current: $parent.videoResultCurrPg() == $data.label - 1 } , text: $data.label, attr: {'data-pg': $data.label - 1, href: '#content&pg=' + $data.label }"></a></li>
				</ul> 
			</nav><!-- .navigation -->
			
			
			<?php } 
			elseif($primary == 'ImageSearch' ) { ?>
			<div class="i-result group-blog" data-bind="foreach: imageResult">
				<article class="post-203 post type-post status-publish format-image hentry category-images" >	
					<header class="entry-header">
						<div class="entry-meta">
							<span class="cat-links"><a rel="category tag" href="#">Image</a></span>
						</div><!-- .entry-meta -->
						<h1 class="entry-title">
							<a data-bind="attr: {href: unescapedUrl}, html: title"></a>
						</h1>
						<div class="entry-meta">
							<span class="post-format">
								<a href="#" class="entry-format">Image</a>
							</span>
							<span class="byline">
								<span class="author vcard">
								<a rel="author" href="#" class="url fn n">
									<span data-bind="text: width"></span> x <span data-bind="text: height"></span>
								</a>
								</span>
							</span>
							
						</div><!-- .entry-meta -->						
						
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p>
							<span style="text-align:center; display: block;">
								<img data-bind="attr: { src: url, title:  titleNoFormatting}"/>
							</span>
						</p>
					</div><!-- .entry-content -->

				</article>
			</div>
			<nav class="navigation paging-navigation" role="navigation">
				<ul data-bind="foreach: resultPages" class='page-numbers'>
					<li><a tabindex="0" class="page-numbers" data-bind="click: $parent.imageResultNxtPg, css: { current: $parent.imageResultCurrPg() == $data.label - 1 } , text: $data.label, attr: {'data-pg': $data.label - 1, href: '#content&pg=' + $data.label }"></a></li>
				</ul> 
			</nav><!-- .navigation -->			
			
			<?php } 
			elseif($primary == 'NewsSearch') { ?>
			<div class="i-result group-blog" data-bind="foreach: newsResult">
				<article class="post-203 post type-post status-publish format-standard hentry category-aside" >	
					<header class="entry-header">
						<div class="entry-meta">
							<span class="cat-links"><a rel="category tag" href="#">News</a></span>
						</div><!-- .entry-meta -->
						<h1 class="entry-title">
							<a data-bind="attr: {href: unescapedUrl}, html: title"></a>
						</h1>
						<div class="entry-meta">
							<span class="entry-date"><a rel="bookmark" href="#"><time data-bind="text: publishedDate" class="entry-date"></time></a></span> 														
							<span class="byline">
								<span class="author vcard">
								<a rel="author" href="#" class="url fn n" data-bind="text: publisher"></a>
								</span>
							</span>
							
						</div><!-- .entry-meta -->						
						
					</header><!-- .entry-header -->

					<div class="entry-content" data-bind="html: content">
					</div><!-- .entry-content -->

				</article>
			</div>
			<nav class="navigation paging-navigation" role="navigation">
				<ul data-bind="foreach: resultPages" class='page-numbers'>
					<li><a tabindex="0" class="page-numbers" data-bind="click: $parent.newsResultNxtPg, css: { current: $parent.newsResultCurrPg() == $data.label - 1 } , text: $data.label, attr: {'data-pg': $data.label - 1, href: '#content&pg=' + $data.label }"></a></li>
				</ul> 
			</nav><!-- .navigation -->
			
			
			
			
			
			<?php } 
			elseif($primary == 'BlogSearch' ) { ?>
			<div class="i-result group-blog" data-bind="foreach: blogResult">
				<article class="post-203 post type-post status-publish format-standard hentry category-aside" >	
					<header class="entry-header">
						<div class="entry-meta">
							<span class="cat-links"><a rel="category tag" href="#">Blog</a></span>
						</div><!-- .entry-meta -->
						<h1 class="entry-title">
							<a data-bind="attr: {href: postUrl}, html: title"></a>
						</h1>
						<div class="entry-meta">
							<span class="entry-date"><a rel="bookmark" href="#"><time data-bind="text: publishedDate" class="entry-date"></time></a></span> 														
							<span class="byline">
								<span class="author vcard">
								<a rel="author" href="#" class="url fn n" data-bind="text: author"></a>
								</span>
							</span>
							
						</div><!-- .entry-meta -->						
						
					</header><!-- .entry-header -->

					<div class="entry-content" data-bind="html: content">
					</div><!-- .entry-content -->

				</article>
			</div>
			<nav class="navigation paging-navigation" role="navigation">
				<ul data-bind="foreach: resultPages" class='page-numbers'>
					<li><a tabindex="0" class="page-numbers" data-bind="click: $parent.blogResultNxtPg, css: { current: $parent.blogResultCurrPg() == $data.label - 1 } , text: $data.label, attr: {'data-pg': $data.label - 1, href: '#content&pg=' + $data.label }"></a></li>
				</ul> 
			</nav><!-- .navigation -->
			
			
			
			
			
			<?php } 
			elseif($primary == 'BookSearch' ) { ?>
			<div class="i-result group-blog" data-bind="foreach: bookResult">
				<article class="post-203 post type-post status-publish format-standard hentry category-aside" >	
					<header class="entry-header">
						<div class="entry-meta">
							<span class="cat-links"><a rel="category tag" href="#">Book</a></span>
						</div><!-- .entry-meta -->					
					</header><!-- .entry-header -->

					<div class="entry-content" >
						
						<h3 class="entry-title">
							<img data-bind="attr: {src: tbUrl}" class="alignleft"/>
							<a data-bind="attr: {href: unescapedUrl}, html: title"></a>
						</h3>						
					</div><!-- .entry-content -->
					<div class="entry-meta">
						<span class="entry-date"><a rel="bookmark" href="#"><time data-bind="text: publishedYear" class="entry-date"></time></a></span> 														
						<span class="byline">
							<span class="author vcard">
							<a rel="author" href="#" class="url fn n" data-bind="text: authors"></a>
							</span>
						</span>
						<span>
						<span data-bind="text: pageCount"></span> pg
						</span>		
					</div><!-- .entry-meta -->
				</article>
			</div>
			<nav class="navigation paging-navigation" role="navigation">
				<ul data-bind="foreach: resultPages" class='page-numbers'>
					<li><a tabindex="0" class="page-numbers" data-bind="click: $parent.bookResultNxtPg, css: { current: $parent.bookResultCurrPg() == $data.label - 1 } , text: $data.label, attr: {'data-pg': $data.label - 1, href: '#content&pg=' + $data.label }"></a></li>
				</ul> 
			</nav><!-- .navigation -->
			
			
			
			
			<?php } 
			elseif($primary == 'PatentSearch' ) { ?>
			<div class="i-result group-blog" data-bind="foreach: patentResult">
				<article class="post-203 post type-post status-publish format-standard hentry category-aside" >	
					<header class="entry-header">
						<div class="entry-meta">
							<span class="cat-links"><a rel="category tag" href="#">Patent</a></span>
						</div><!-- .entry-meta -->
						<h1 class="entry-title">
							<a data-bind="attr: {href: unescapedUrl}, html: title"></a>
						</h1>
						<div class="entry-meta">
							<span class="entry-date"><a rel="bookmark" href="#"><time data-bind="text: patentStatus" class="entry-date"></time></a></span> 														
							<span class="byline">
								<span class="author vcard">
								<a rel="author" href="#" class="url fn n" data-bind="text: assignee"></a>
								</span>
							</span>
							
						</div><!-- .entry-meta -->						
						
					</header><!-- .entry-header -->

					<div class="entry-content" data-bind="html: content">
					</div><!-- .entry-content -->

				</article>
			</div>
			<nav class="navigation paging-navigation" role="navigation">
				<ul data-bind="foreach: resultPages" class='page-numbers'>
					<li><a tabindex="0" class="page-numbers" data-bind="click: $parent.patentResultNxtPg, css: { current: $parent.patentResultCurrPg() == $data.label - 1 } , text: $data.label, attr: {'data-pg': $data.label - 1, href: '#content&pg=' + $data.label }"></a></li>
				</ul> 
			</nav><!-- .navigation -->
			
			
			<?php }  else { ?>
				<div class="page-content">	
				<p>Sorry, but you haven't set a primary search result. Or your primary search result is not activated.</p>
				</div>
			<?php } ?>
			
			
		</div><!-- #content -->
	</section><!-- #primary -->
</div>
<?php
get_sidebar( 'content' );
get_sidebar();
get_footer();
