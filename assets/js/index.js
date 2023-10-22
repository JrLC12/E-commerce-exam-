function myFunction() {
  var x = document.getElementById("myTopnav");
  const logo = document.getElementById("logos");
  if (x.className === "topnav") {
    x.className += " responsive";
    logo.style.display = "none";
  } else {
    x.className = "topnav";
    logo.style.display = "block";
  }
}

window.addEventListener("scroll", function(){
  var screenY = window.scrollY;
  var home = document.getElementById("home_nav");
  var product = document.getElementById("product_nav");
  var myTopnav = document.getElementById("myTopnav");
  if(screenY >=1){
  }
  if(screenY <= 550 ){
    home.classList.add("active");
    product.classList.remove("active");
  }if(screenY >=551){
    home.classList.remove("active");
    product.classList.add("active");
  }
});
