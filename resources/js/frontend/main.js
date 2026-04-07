  // Smooth scroll
  document.querySelectorAll('a[href^="#"]').forEach(a => {
      a.addEventListener('click', e => {
          e.preventDefault();
          const t = document.querySelector(a.getAttribute('href'));
          if (t) t.scrollIntoView({
              behavior: 'smooth',
              block: 'start'
          });
      });
  });
  // Fade-in on scroll
  const io = new IntersectionObserver(entries => {
      entries.forEach(el => {
          if (el.isIntersecting) {
              el.target.style.opacity = 1;
              el.target.style.transform = 'translateY(0)';
          }
      });
  }, {
      threshold: 0.1
  });
  document.querySelectorAll('section').forEach(s => {
      s.style.opacity = 0;
      s.style.transform = 'translateY(20px)';
      s.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
      io.observe(s);
  });
