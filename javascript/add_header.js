function add_header(){
  var header;
  header="\
  <div style=\"background:#CCCCCC; font-size:12px; color:#FFF; font-weight:bold; height:100px;\">\
  <h3><a href=\"https://www.upatras.gr/el\" target=\"_blank\"><img src=\"images/papa.jpg\" class=\"logo\"></a> &nbsp;ΤΜΗΜΑ ΗΛΕΚΤΡΟΛΟΓΩΝ ΜΗΧΑΝΙΚΩΝ ΚΑΙ ΤΕΧΝΟΛΟΓΙΑΣ ΥΠΟΛΟΓΙΣΤΩΝ</h3>\
  </div>\
<div id=\"wrap\">\
	<header>\
		<div class=\"inner relative\">\
			<a id=\"menu-toggle\" class=\"button dark\" href=\"#\"><i class=\"icon-reorder\"></i></a>\
			<nav id=\"navigation\">\
				<ul id=\"main-menu\">\
					<li class=\"current-menu-item\" ><a href=\"index.php\">Home</a></li>\
					<li class=\"parent\">\
						The Department\
						<ul class=\"sub-menu\">\
							<li><a href=\"welcome.php\">Welcome</a></li>\
							<li>History</li>\
							<li>Structure</li>\
              <li>Secretariat</li>\
              <li>Department Committees</li>\
              <li>Health and Safety</li>\
							<li>\
								Department Scientific Events\
								<ul class=\"sub-menu\">\
									<li>'Green Electric Power and Smart Grids' Workshop</li>\
								</ul>\
							</li>\
              <li>\
								Department Events\
								<ul class=\"sub-menu\">\
									<li></li>\
								</ul>\
							</li>\
              <li>Alumni</li>\
						</ul>\
					</li>\
					<li class=\"parent\">\
						Education\
						<ul class=\"sub-menu\">\
							<li><a href=\"study_guide.php\">Study Guide</a></li>\
							<li>Current Academic Year</li>\
              <li>\
								Undergraduate Subjects\
								<ul class=\"sub-menu\">\
									<li>Statute</li>\
                  <li>Courses</li>\
                  <li>Study Guide 2015-2016</li>\
                  <li>Study Guide 2016-2017</li>\
                  <li>Lesson Declaration Rules</li>\
                  <li>Graduation Rules</li>\
                  <li>Usefull Documents</li>\
                  <li>Practise</li>\
                  <li>Diploma Theses</li>\
                  <li>Timetable</li>\
								</ul>\
							</li>\
              <li>Graduate Program</li>\
              <li>\
								Postgraduate Subjects\
								<ul class=\"sub-menu\">\
									<li>Statute</li>\
                  <li>Phd Thesis</li>\
                  <li>Courses</li>\
                  <li>Postgraduate Students</li>\
                  <li>Courses and Exams</li>\
                  <li>Schedule</li>\
								</ul>\
							</li>\
            </ul>\
          </li>\
          <li class=\"parent\">\
    						Research\
    					<ul class=\"sub-menu\">\
    							<li>Divisions</li>\
    							<li>Laboratories</li>\
    							<li>Publications</li>\
                  <li>Awards</li>\
              </ul>\
          </li>\
          <li class=\"parent\">\
    						Personnel\
    					<ul class=\"sub-menu\">\
    							<li>Faculty</li>\
    							<li>Εmeriti Professors</li>\
    							<li>Honoris Causa Professors</li>\
                  <li>Research Collaborators</li>\
                  <li>Laboratory Staff</li>\
                  <li>Technical Staff</li>\
                  <li>Administrative Staff</li>\
              </ul>\
          </li>\
          <li class=\"parent\">\
    						Evaluation Reports\
    					<ul class=\"sub-menu\">\
    							<li>Internal</li>\
    							<li>External</li>\
              </ul>\
          </li>\
          <li class=\"parent\">\
    						Announcements\
    					<ul class=\"sub-menu\">\
    							<li>Graduate Studies</li>\
    							<li>Postgraduate</li>\
    							<li>Phd Studies</li>\
                  <li>Scholarships</li>\
              </ul>\
          </li>\
          <li class=\"parent\">\
                Information &nbsp;&nbsp;\
              <ul class=\"sub-menu\">\
                  <li>Location</li>\
                  <li>Maps</li>\
                  <li>\
    								Links\
    								<ul class=\"sub-menu\">\
    									<li>Universities</li>\
                      <li>Research Institutions</li>\
                      <li>Research Societies</li>\
                      <li>Government Institutions</li>\
                      <li>Websites</li>\
    								</ul>\
    							</li>\
                  <li>\
    								Student Care\
    								<ul class=\"sub-menu\">\
    									<li>Residence</li>\
                      <li>Meals</li>\
                      <li>Library</li>\
                      <li>Athletics University Gymnasium</li>\
                      <li>Health Care</li>\
                      <li>Foreign Student Admission</li>\
    								</ul>\
    							</li>\
                  <li>\
    								General\
    								<ul class=\"sub-menu\">\
    									<li>Transportation</li>\
                      <li>Cultural Events</li>\
                      <li>Secretariat of the Department</li>\
    								</ul>\
    							</li>\
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
