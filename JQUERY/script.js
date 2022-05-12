let links = document.querySelectorAll('.nav-link');
for(let i=0; i<links.length; i++){
  links[i].addEventListener('click', function() {
    for(let j=0; j<links.length; j++)
      links[j].classList.remove('active');
    this.classList.add('active');
  });
}

// $(".nav-link").click(
//     function () {
//         var listItems = $(".nav-link");
//         for (let i = 0; i < listItems.length; i++) {
//             listItems[i].classList.remove("active");
//         }
//         this.classList.add("active");
//     }
// );