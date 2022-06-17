
document.addEventListener('DOMContentLoaded', function () {
  const menu = document.getElementById("menu");
  menu.addEventListener('click', () => {
  menu.classList.toggle('open');
  const nav = document.getElementById("nav");
  nav.classList.toggle('in');
});
});