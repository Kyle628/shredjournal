$(function() {
  var names = ['Jon Jon', 'Nat', 'Gabriel'];
  var hasTyped = false;

  window.setInterval(function(){
    if (!hasTyped) {
      $('#current_name').html(names.pop());
    }
}, 2000);

  $('#username_form').change(function() {
    hasTyped = true;
    console.log($('#username_form').value);
    $('#current_name').html($('#username_form').value);
  });

  //creates a listener for when you press a key
window.onkeyup = keyup;

//creates a global Javascript variable
var inputTextValue;

function keyup(e) {
  //setting your input text to the global Javascript Variable for every key press
  inputTextValue = e.target.value;
  $('#current_name').text(inputTextValue);
}




});
