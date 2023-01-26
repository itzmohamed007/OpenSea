// nav menu
let header = document.querySelector("header");
let burgerMenu = document.querySelector(".burger-menu");
let navigationMenu = document.querySelector(".navigation-menu");

burgerMenu.addEventListener("click", () => {
  burgerMenu.classList.toggle("active");
  navigationMenu.classList.toggle("menu-active");
});

window.addEventListener("scroll", () => {
  if (document.documentElement.scrollTop > 50) {
    header.classList.add("header-active");
  } else {
    header.classList.remove("header-active");
  }
});

// question scrumble
let questions = document.querySelectorAll(".question");
questions.forEach((question) => {
  question.addEventListener("click", questionActive);
});
function questionActive() {
  questions.forEach((question) => {
    question.style.height = "60px";
    this.style.height = "300px";
  });
}
