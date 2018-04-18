import 'bootstrap'
import '../sass/styles.scss';
import jQuery from 'jquery';
window.jQuery = jQuery;

const container = document.querySelector('.slider');
const slides = container.children;
let currentSlide = 0;

if (slides.length) {
  setInterval(() => {
    slides[currentSlide].style.opacity = 0;
    currentSlide = (currentSlide + 1) % slides.length;
    slides[currentSlide].style.opacity = 1;
  }, 4000);
}