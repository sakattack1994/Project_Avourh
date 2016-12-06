function add_header(){
  var header;
  header="\
  <div style=\"background:#0099cc; font-size:22px; text-align:center; color:#FFF; font-weight:bold; height:100px; padding-top:50px;\">\
  </div>\
<div id=\"wrap\">\
	<header>\
		<div class=\"inner relative\">\
			<a href=\"https://www.upatras.gr/el\" target=\"_blank\"><img src=\"images/papa.jpg\" class=\"logo\">\
			<a id=\"menu-toggle\" class=\"button dark\" href=\"#\"><i class=\"icon-reorder\"></i></a>\
			<nav id=\"navigation\">\
				<ul id=\"main-menu\">\
					<li class=\"current-menu-item\" >Home</li>\
					<li class=\"parent\">\
						Features\
						<ul class=\"sub-menu\">\
							<li>Elements</li>\
							<li>Pricing Tables</li>\
							<li>Icons</li>\
							<li>\
								Pages\
								<ul class=\"sub-menu\">\
									<li>Full Width</li>\
									<li>Left Sidebar</li>\
									<li>Right Sidebar</li>\
									<li>Double Sidebar</li>\
								</ul>\
							</li>\
						</ul>\
					</li>\
					<li>Portfolio</li>\
					<li class=\"parent\">\
						Blog\
						<ul class=\"sub-menu\">\
							<li>Large Image</li>\
							<li>Medium Image</li>\
							<li>Masonry</li>\
							<li>Double Sidebar</li>\
							<li>Single Post</li>\
						</ul>\
					</li>\
					<li>Contact</li>\
				</ul>\
			</nav>\
			<div class=\"clear\"></div>\
		</div>\
	</header> 	\
</div>    \
  ";
  $('#header').append(header) ;
}
