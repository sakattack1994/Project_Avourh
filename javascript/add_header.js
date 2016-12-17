function add_header(){
  var header;
  header="\
  <div style=\"background:#333; font-size:12px; color:#FFF; font-weight:bold; height:100px;\">\
  <h3><a href=\"https://www.upatras.gr/el\" target=\"_blank\"><img src=\"images/papa.jpg\" class=\"logo\"></a> &nbsp;ΤΜΗΜΑ ΗΛΕΚΤΡΟΛΟΓΩΝ ΜΗΧΑΝΙΚΩΝ ΚΑΙ ΤΕΧΝΟΛΟΓΙΑΣ ΥΠΟΛΟΓΙΣΤΩΝ</h3>\
  </div>\
<div id=\"wrap\" style=\"padding-top:10px;\">\
	<header>\
		<div class=\"inner relative\">\
			<a id=\"menu-toggle\" class=\"button dark\" href=\"#\"><i class=\"icon-reorder\"></i></a>\
			<nav id=\"navigation\">\
				<ul id=\"main-menu\">\
					<li><a href=\"index.php\">Home</a> &nbsp;&nbsp;</li>\
					<li >\
						The Department + &nbsp;&nbsp;\
						<ul class=\"sub-menu\">\
							<li class=\"bgnone\"><a href=\"welcome.php\">Welcome</a></li>\
							<li><a href=\"history.php\">History</a></li>\
							<li>Structure</li>\
              <li><a href=\"secretariat.php\">Secretariat</a></li>\
              <li><a href=\"departmentCommittees.php\">Department Committees</a></li>\
              <li><a href=\"healthAndSafety.php\">Health and Safety</a></li>\
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
					<li>\
						Education + &nbsp;&nbsp;\
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
          <li>\
    						Research + &nbsp;&nbsp;\
    					<ul class=\"sub-menu\">\
    							<li>Divisions</li>\
    							<li>Laboratories</li>\
    							<li>Publications</li>\
                  <li>Awards</li>\
              </ul>\
          </li>\
          <li>\
    						Personnel + &nbsp;&nbsp;\
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
          <li>\
    						Evaluation Reports + &nbsp;&nbsp;\
    					<ul class=\"sub-menu\">\
    							<li>Internal</li>\
    							<li>External</li>\
              </ul>\
          </li>\
          <li><a href=\"announcements.php\">Announcements</a> &nbsp;&nbsp;</li>\
          <li>\
                Information + &nbsp;&nbsp;\
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
				</ul>\
			</nav>\
			<div class=\"clear\"></div>\
		</div>\
	</header> 	\
</div>    \
  ";
  $('#header').append(header) ;
}
