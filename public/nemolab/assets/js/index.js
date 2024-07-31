  document.addEventListener("DOMContentLoaded", function() {
    const container = document.querySelector(".marquee-container");
    const scrollContent = document.querySelector(".scroll");
    
    container.addEventListener("scroll", function() {
      if (container.scrollTop + container.clientHeight >= scrollContent.clientHeight) {
        container.scrollTop = 0; // Scroll back to top
      }
    });
  });
