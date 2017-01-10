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
							<li><a href=\"structure.php\">Structure</a></li>\
              <li><a href=\"secretariat.php\">Secretariat</a></li>\
              <li><a href=\"departmentCommittees.php\">Department Committees</a></li>\
              <li><a href=\"healthAndSafety.php\">Health and Safety</a></li>\
						</ul>\
					</li>\
					<li>\
						Education + &nbsp;&nbsp;\
						<ul class=\"sub-menu\">\
							<li><a href=\"study_guide.php\">Study Guide</a></li>\
							<li><a href=\"currentAcademicYear.php\">Current Academic Year</li>\
              <li>\
								Undergraduate Subjects\
								<ul class=\"sub-menu\">\
									<li><a href=\"regulation.php\">Regulation</a></li>\
                  <li><a href=\"courses.php\">Courses</a></li>\
                  <li><a href=\"divisions.php\">Divisions</a></li>\
                  <li><a href=\"study_schedule.php\">Study Schedule</a></li>\
                  <li><a href=\"lesson_declaration_rules.php\">Lesson Declaration Rules</a></li>\
                  <li><a href=\"graduation_rules.php\">Graduation Rules</a></li>\
                  <li><a href=\"usefull_documents.php\">Usefull Documents</a></li>\
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
    						Personnel + &nbsp;&nbsp;\
    					<ul class=\"sub-menu\">\
    							<li><a href=\"faculty_show.php\">Faculty</a></li>\
    							<li>Εmeriti Professors</li>\
    							<li>Honoris Causa Professors</li>\
                  <li>Research Collaborators</li>\
                  <li>Laboratory Staff</li>\
                  <li>Technical Staff</li>\
                  <li>Administrative Staff</li>\
              </ul>\
          </li>\
          <li><a href=\"announcements.php\">Announcements</a> &nbsp;&nbsp;</li>\
          <li>\
                Information + &nbsp;&nbsp;\
              <ul class=\"sub-menu\">\
                  <li><a href=\"location.php\">Location</a></li>\
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
