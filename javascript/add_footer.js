function add_footer(){
    var footer;
    footer="<footer class=\"footer\">\
          <div class=\"container\">\
            <div class=\"row\">\
              <div class=\"col-md-7\">Secretariat, 1st Floor, Department of Electrical & Computer Engineering <br>\
                Polytechnic Faculty, University of Patras, Rio Campus <br>\
                Patras 26504, Greece\
              </div>\
              <div class=\"col-md-5\">\
                <ul class=\"footer-nav\">\
                  <li><a href=\"HTML pages/ContactMe.html\" target=\"_blank\">Contact Us</a></li>\
                  <li><a href=\"index.php\">Home</a></li>\
                  </ul>\
              </div>\
            </div>\
          </div>\
        </footer>";

    $('#footer').append(footer) ;
};
