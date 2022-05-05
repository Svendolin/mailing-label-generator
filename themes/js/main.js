
/* Funktion der Swiper Gallery */
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


/* SweetAlert2 Funktion */
$('#btn-update').on('click', function(){
  Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire(
        'Deleted!',
        'Your file has been deleted.',
        'success'
      )
      location.href = self.Attr('href');
    }
  })
})

$('#saveaddress').on('click', function(e){
  e.preventdefault();
  const href = $(this).attr('href')
  Swal.fire(
    'Good job!',
    'You clicked the button!',
    'success'
  )
})

$('#logout').on('click', function(){
  
})


$("#btn").click(function(){
  // JQUERY CODE contains three parameters: (1)               (2)                   (3)
  $("#test").load("data.txt", {   // .load(FILE, {DATA to pass data if you want}, CALLBACK ) = Ajax
    Name: "Daniel", 
    Lastname: "Düsentrieb"
  }, function() {
      alert("Hi there!")
  }); 
});