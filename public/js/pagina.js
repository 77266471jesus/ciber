window.addEventListener("scroll", function(){
    var header = document.querySelector("header");
    header.classList.toggle("menu_scroll",window.scrollY>0);
})