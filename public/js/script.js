const navbar = document.getElementsByTagName('nav')[0];
window.addEventListener('scroll', function(){
    console.log(window.scrollY);
    if(window.scrollY > 1){
        navbar.classList.replace('bg-transparent', 'nav-color');
    }else if(this.window.scrollY <= 0){
        navbar.classList.replace('nav-color', 'bg-transparent');
    }
});

document.addEventListener("DOMContentLoaded", function () {
    var dropdownMenu = document.querySelector(".dropdown-menu");

    function updateDropdownBackground() {
      if (window.scrollY > 0) {
        dropdownMenu.classList.add("scrolled");
      } else {
        dropdownMenu.classList.remove("scrolled");
      }
    }
    window.addEventListener("scroll", updateDropdownBackground);
});

