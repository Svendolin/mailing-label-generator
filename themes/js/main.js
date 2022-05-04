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

// $('#print').click(function(){
//   $('#ettikatorbox').printThis();
// })

var swiper = new Swiper(".mySwiper", {
  slidesPerView: 1,
  spaceBetween: 30,
  loop: true,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});