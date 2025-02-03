document.addEventListener('DOMContentLoaded', function () {
    // Smooth Scrolling
    const navLinks = document.querySelectorAll('.nav-links a');
    navLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            if (this.hash !== '') {
                e.preventDefault();
                const hash = this.hash;
                const target = document.querySelector(hash);

                if (target) {
                    window.scrollTo({
                        top: target.offsetTop,
                        behavior: 'smooth',
                    });
                }
            }
        });
    });

    // Dynamic Active Link
    window.addEventListener('scroll', function () {
        const scrollPos = window.scrollY;
        navLinks.forEach(link => {
            const section = document.querySelector(link.hash);
            if (
                section.offsetTop - 100 <= scrollPos &&
                section.offsetTop + section.offsetHeight - 100 > scrollPos
            ) {
                link.classList.add('active');
                navLinks.forEach(sibling => {
                    if (sibling !== link) {
                        sibling.classList.remove('active');
                    }
                });
            }
        });
    });

    // Mobile menu toggle
    const menuIcon = document.getElementById('menu-icon');
    const navWrapper = document.getElementById('nav-wrapper');
    menuIcon.addEventListener('click', function () {
        navWrapper.classList.toggle('active');
    });
});
