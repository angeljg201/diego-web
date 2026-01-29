document.addEventListener('DOMContentLoaded', () => {
    // Mobile Navigation Toggle
    const mobileToggle = document.querySelector('.mobile-toggle');
    const mainNav = document.querySelector('.main-nav');

    if (mobileToggle && mainNav) {
        mobileToggle.addEventListener('click', () => {
            mainNav.classList.toggle('active');
            mobileToggle.classList.toggle('active'); // Toggle class on button too
            const icon = mobileToggle.querySelector('i');
            if (mainNav.classList.contains('active')) {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-times');
            } else {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        });

        // Close mobile menu when clicking a link
        document.querySelectorAll('.main-nav a').forEach(link => {
            link.addEventListener('click', () => {
                if (mainNav.classList.contains('active')) {
                    mainNav.classList.remove('active');
                    mobileToggle.classList.remove('active');
                    const icon = mobileToggle.querySelector('i');
                    icon.classList.remove('fa-times');
                    icon.classList.add('fa-bars');
                }
            });
        });

        // Close menu when clicking outside
        document.addEventListener('click', (e) => {
            if (mainNav.classList.contains('active') && !mainNav.contains(e.target) && !mobileToggle.contains(e.target)) {
                mainNav.classList.remove('active');
                mobileToggle.classList.remove('active');
                const icon = mobileToggle.querySelector('i');
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        });
    }

    // Scroll Reveal Animation (Intersection Observer)
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('show');
                observer.unobserve(entry.target); // Animates only once
            }
        });
    }, observerOptions);

    document.querySelectorAll('.hidden-fade').forEach(el => {
        observer.observe(el);
    });

    // Sticky Header Effect
    const header = document.querySelector('.main-header');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });

    // Carousel Logic
    // Carousel Logic
    const track = document.querySelector('.carousel-track');
    if (track) {
        const nextBtn = document.querySelector('.next-btn');
        const prevBtn = document.querySelector('.prev-btn');

        // Initial set of cards (before cloning)
        let cards = Array.from(track.children);
        if (cards.length === 0) return;

        // Constants
        const cloneCount = 3; // Max visible cards (desktop)

        // Ensure we have enough copies if real cards < cloneCount
        // To be safe, we want at least (cloneCount * 2) + 1 items usually, 
        // but simple cloning of existing items works if we loop carefully.

        // Clone for infinite loop
        // If we have very fewer cards (e.g. 1 or 2), we might need to clone the whole set multiple times.
        // Simplified approach: reliable cloning.

        // Prepend copies for backward loop
        for (let i = 0; i < cloneCount; i++) {
            // Index from end: cards.length - 1 - i
            let index = (cards.length - 1 - i);
            // Wrap index protection
            index = ((index % cards.length) + cards.length) % cards.length;

            const clone = cards[index].cloneNode(true);
            clone.classList.add('clone');
            track.insertBefore(clone, track.firstChild);
        }

        // Append copies for forward loop
        for (let i = 0; i < cloneCount; i++) {
            let index = i;
            // Wrap index protection
            index = index % cards.length;

            const clone = cards[index].cloneNode(true);
            clone.classList.add('clone');
            track.appendChild(clone);
        }

        // Re-query cards to include clones
        let allCards = Array.from(track.children);

        let currentIndex = cloneCount; // Start at the first real card
        let isTransitioning = false;

        const updateCarousel = (transition = true) => {
            const cardWidth = allCards[0].getBoundingClientRect().width;
            const trackStyle = window.getComputedStyle(track);
            const gap = parseFloat(trackStyle.gap) || 0;

            const moveAmount = (cardWidth + gap) * currentIndex;

            if (transition) {
                track.style.transition = 'transform 0.5s cubic-bezier(0.25, 1, 0.5, 1)';
            } else {
                track.style.transition = 'none';
            }

            track.style.transform = `translateX(-${moveAmount}px)`;
        };

        // Initial setup
        setTimeout(() => {
            updateCarousel(false);
        }, 100);

        const nextSlide = () => {
            if (isTransitioning) return;
            currentIndex++;
            isTransitioning = true;
            updateCarousel(true);
        };

        const prevSlide = () => {
            if (isTransitioning) return;
            currentIndex--;
            isTransitioning = true;
            updateCarousel(true);
        };

        // Handle Transition End for Loop
        track.addEventListener('transitionend', () => {
            isTransitioning = false;

            const totalRealCards = cards.length;

            // Forward Loop Check
            if (currentIndex >= cloneCount + totalRealCards) {
                currentIndex = currentIndex - totalRealCards;
                updateCarousel(false);
            }

            // Backward Loop Check
            if (currentIndex < cloneCount) {
                // If we are at index 2 (clone) and real start is 3. We want to go to valid real equivalent.
                // If cloneCount is 3. 0,1,2 are clones. 3 is real start.
                // If we are at 2, we want (2 + totalRealCards).
                currentIndex = currentIndex + totalRealCards;
                updateCarousel(false);
            }
        });

        if (nextBtn) {
            nextBtn.addEventListener('click', () => {
                nextSlide();
                resetAutoplay();
            });
        }

        if (prevBtn) {
            prevBtn.addEventListener('click', () => {
                prevSlide();
                resetAutoplay();
            });
        }

        // Autoplay Logic
        let autoplayInterval;

        const startAutoplay = () => {
            autoplayInterval = setInterval(() => {
                nextSlide();
            }, 2000); // 2 seconds
        };

        const stopAutoplay = () => {
            clearInterval(autoplayInterval);
        };

        const resetAutoplay = () => {
            stopAutoplay();
            startAutoplay();
        };

        // Pause on hover
        track.addEventListener('mouseenter', stopAutoplay);
        track.addEventListener('mouseleave', startAutoplay);

        // Start initially
        startAutoplay();

        window.addEventListener('resize', () => {
            updateCarousel(false);
            resetAutoplay();
        });
    }

    // Accordions (Course Detail)
    const accordions = document.querySelectorAll('.accordion-header');
    accordions.forEach(acc => {
        acc.addEventListener('click', function () {
            // Toggle current
            this.classList.toggle('active');
            const panel = this.nextElementSibling;

            if (this.classList.contains('active')) {
                panel.style.maxHeight = panel.scrollHeight + "px";
            } else {
                panel.style.maxHeight = null;
            }

            // Optional: Close others (Accordian behavior)
            // Uncomment if you want only one open at a time
            /*
            accordions.forEach(other => {
                if (other !== this && other.classList.contains('active')) {
                    other.classList.remove('active');
                    other.nextElementSibling.style.maxHeight = null;
                }
            });
            */
        });
    });
});
