// Sticky
const primaryHeader = document.querySelector('.header');

const scrollWatcher = document.createElement('div');
scrollWatcher.setAttribute('data-scroll-watcher', '');
primaryHeader.before(scrollWatcher);

const navObserver = new IntersectionObserver(
  (entries) => {
    primaryHeader.classList.toggle('sticking', !entries[0].isIntersecting);
  },
  { rootMargin: '50px 0px 0px 0px' }
);

navObserver.observe(scrollWatcher);

// // Active Nav Link on Page Scroll
// const sections = document.querySelectorAll('section[id]');

// window.addEventListener('scroll', navHighlighter);
// function navHighlighter() {
//   let scrollY = window.scrollY;
//   sections.forEach((current) => {
//     const sectionHeight = current.offsetHeight;
//     const sectionTop = current.offsetTop - 50;
//     const sectionId = current.getAttribute('id');

//     if (scrollY > sectionTop && scrollY <= sectionTop + sectionHeight) {
//       document
//         .querySelector('.nav__list a[href*=' + sectionId + ']')
//         .classList.add('active');
//     } else {
//       document
//         .querySelector('.nav__list a[href*=' + sectionId + ']')
//         .classList.remove('active');
//     }
//   });
// }

/* Toggle mobile menu */

const primaryNav = document.querySelector('.nav__list');
const navToggle = document.querySelector('.mobile-nav-toggle');

navToggle.addEventListener('click', () => {
  console.log('nice');
  const currentState = navToggle.getAttribute('data-state');

  if (!currentState || currentState === 'closed') {
    navToggle.setAttribute('data-state', 'opened');
    navToggle.setAttribute('aria-expanded', 'true');
    primaryNav.setAttribute('data-visible', 'true');
  } else {
    navToggle.setAttribute('data-state', 'closed');
    navToggle.setAttribute('aria-expanded', 'false');
    primaryNav.setAttribute('data-visible', 'false');
  }
});
