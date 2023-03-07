const overlayContainer = document.querySelector('.overlay-container');
const overlay = document.querySelector('.overlay');

overlayContainer.addEventListener('click', () => {
  overlay.classList.toggle('show');
});