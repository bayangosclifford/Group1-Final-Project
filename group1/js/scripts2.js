// This function will be triggered when the value of the select box changes
        const inquirySelect = document.getElementById('inquiryType');
        const inquireLabel = document.getElementById('inquire');

        inquirySelect.addEventListener('change', function () {
            // Clear the label text when an option is selected
            inquireLabel.innerText = '';
        });
        const navbar = document.getElementById('mainNav');

        // Add event listener for scrolling
        window.addEventListener('scroll', function () {
            if (window.scrollY > 50) {  // When the page is scrolled more than 50px
                navbar.classList.add('scrolled');  // Add 'scrolled' class
            } else {
                navbar.classList.remove('scrolled');  // Remove 'scrolled' class
            }
        });
        let slideIndex = 0;
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.dot');

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.style.display = i === index ? 'flex' : 'none';
        });

        dots.forEach((dot, i) => {
            dot.classList.toggle('active', i === index);
        });
    }

    function nextSlide() {
        slideIndex = (slideIndex + 1) % slides.length;
        showSlide(slideIndex);
    }

    showSlide(slideIndex); // Initialize
    setInterval(nextSlide, 5000);

    dots.forEach((dot, i) => {
        dot.addEventListener('click', () => {
            slideIndex = i;
            showSlide(slideIndex);
        });
    });