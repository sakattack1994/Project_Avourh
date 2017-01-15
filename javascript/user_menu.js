function user_menu(){
    var user_menu;
    $.post('request_handler.php',{'userID':'member'},function(data){
      $('#side_bar').append(data) ;
    });
}
