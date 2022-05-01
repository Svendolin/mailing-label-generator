/* Adressbetätigung aus menu.php:
  - Durch KLICK wird eine neue Adresse hinzugefügt
  - Die Seite wird neu geladen, dadurch wird die Adresse nach dem Klick direkt angezeigt
*/



// jQuery('.adressbutton').click(function()
// {
// location.reload();
// });



// const printJS = require("print-js");

// function printForm() {
//   printJS({
//     printable: 'ettikatorbox',
//     type: 'html',
//     targetStyles: ['*']
//   })
// }

// printForm()

$('#print').click(function(){
  $('#ettikatorbox').printThis();
})