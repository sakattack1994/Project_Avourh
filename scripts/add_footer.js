function add_footer(){
    var footer;
    footer="<table class=\"footer\" cellpadding=\"0\"  cellspacing=\"4\">\
    <tr>\
        <td class=\"left_column\" rowspan=\"2\">\
          <img alt=\"\" src=\"Images/ValidXHTML10.png\" />\
        </td>\
    <td class=\"center_column footer_first_line\" >\
      <a href=\"ContactMe.html\">\
        Contact Me\
      </a>\
      &nbsp;|&nbsp;\
      <a href=\"PrivacyPolicy.html\">\
        Privacy Policy\
      </a>\
    </td>\
\
    <td class=\"right_column\">\
    \
    </td>\
\
    <tr> \
      <td class=\"center_column footer_second_line\" > \
        © 2010 G. G. Gustafson, All Rights Reserved \
        </td> \
\
      <td class=\"right_column\">\
\
      </td>\
    </tr>\
       \
    </table> \
    ";

    $('#footer').append(footer) ;
};
