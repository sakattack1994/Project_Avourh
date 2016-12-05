$(document).ready(function(){
$('#welcome').click(function(){
  var xmlhttp;
  var theUrl='http://localhost:3000/Scrabble/welcome';
  if (window.XMLHttpRequest) {
    xmlhttp = new XMLHttpRequest();
  } else {
    // code for older browsers
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      $('#content').append(this.responseText);
    }
  };
  xmlhttp.open("GET",theUrl , true);
  xmlhttp.send();
  alert('ok');
});
});
