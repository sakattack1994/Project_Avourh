$(document).ready(function(){
  $('.announcement').click(function(){
      $('#content').empty();
      $.post('request_handler.php',{'announcement_id':this.id},function(data){
        $('#content').append(data);
        $('#content').append('<a href=\"announcements.php\"><button id=back_announcements class=\"add_new_button\">&#8592;Back to announcements</button></a>');
        $('#back_announcements').click(function(){
            $.get( "request_handler.php",{'back_to_announcements':1}, function( data ) {
            });
        });
      });
  });

  $('.announcement').hover(function() {
        $(this).css('cursor','pointer');
    });
});
var i=1;
var j=1;
var k=1;
var l=1;
var q=1;
function check(id) {
  if($('#lchoose'+id).is(":checked")) {
      $(".profs"+id).css('visibility','visible');
      $(".profs"+id).css('display','block');
  } else {
      $(".profs"+id).css('visibility','hidden');
      $(".profs"+id).css('display','none');
  }
};
function new_prof() {
  $('#update_table').append("<tr><td>New Professor "+i+":</td><td style=\"padding:0;\"><input type=\"text\" name=\"l_prof_new"+i+"\" style=\"height:100%; width:100%;\"></td></tr>");
  i=i+1;
};
function new_rel() {
  $('#update_table').append("<tr><td>New Relative lesson "+j+":</td><td style=\"padding:0;\"><input type=\"text\" name=\"l_relative_new"+j+"\" style=\"height:100%; width:100%;\"></td></tr>");
  j=j+1;
};
function new_book() {
  $('#update_table').append("<tr><td>New Book(ISBN) "+k+":</td><td style=\"padding:0;\"><input type=\"text\" name=\"l_book_new"+k+"\" style=\"height:100%; width:100%;\"></td></tr>");
  k=k+1;
};
function new_att() {
  $('#new_attachment').append("<input type=\"file\" name=\"ann_attachment"+q+"\">");
  q=q+1;
};
function new_scientific_publication() {
  $('#update_table').append("<tr><td>New Publication Title: "+l+":</td><td style=\"padding:0;\"><input type=\"text\" name=\"pub_title_new"+l+"\" style=\"height:100%; width:100%;\"></td></tr>");
  $('#update_table').append("<tr><td>Year of Publish: "+l+":</td><td style=\"padding:0;\"><input type=\"text\" name=\"pub_year_new"+l+"\" style=\"height:100%; width:100%;\"></td></tr>");
  l=l+1;
};
