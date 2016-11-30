function add_header(){
  var header;
  header="\
  <table class=\"header\" cellpadding=\"0\" cellspacing=\"0\" >\
  <tr>\
    <td class=\"left_column left_header\">\
      <a href=\"google.com\" >\
        <img alt=\"Site Logo\" \
             src=\"Images/SiteLogo.png\" \
             style=\"height:100px;width:89px;\"/>\
      </a>\
    </td>\
    \
    <td class=\"center_column center_header\">\
      <table>\
        <tr class=\"header_title_subtitle\">\
          <td>\
            <span id=\"header_title\">{{PageHeader}}</span>\
          </td>\
        </tr>\
        <tr class=\"header_title_subtitle\">\
          <td>\
            <span id=\"header_subtitle\">{{PageSubHeader}}</span>\
          </td>\
        </tr>\
      </table>\
    </td>\
    \
    <td class=\"right_column right_header\">\
\
    </td>\
  </tr>\
  <tr>\
    <td colspan=\"3\">\
      <hr class=\"colored_spacer\" />\
    </td>\
  </tr>\
</table>\
  ";
  $('#header').append(header) ;
}
