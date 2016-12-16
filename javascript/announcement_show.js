$(document).ready(function(){
  $('.announcement').click(function(){
      $('#content').empty();
      $.post('request_handler.php',{'announcement_id':this.id},function(data){
        $('#content').append(data);
        $('#content').append('<a href=\"announcements.php\"><button id=back_announcements>&#8592;Back to announcements</button></a>');
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
