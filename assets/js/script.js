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
    // Carousel Logic
    const track = document.querySelector('.carousel-track');

    if (track) {
        const nextBtn = document.querySelector('.next-btn');
        const prevBtn = document.querySelector('.prev-btn');
        let rawCards = Array.from(track.children); // Original cards

        let currentIndex = 0;
        let isTransitioning = false;
        let autoplayInterval;
        let cloneCount = 0;
        let activeCards = []; // Cards including clones

        // Function to determine visible cards based on CSS Breakpoints
        const getVisibleCount = () => {
            const width = window.innerWidth;
            if (width <= 700) return 1;
            if (width <= 1100) return 2;
            return 3;
        };

        const setupCarousel = () => {
            // Stop Autoplay/Events while resetting
            stopAutoplay();

            // 1. Clear Track (remove clones, keep originals)
            // We use rawCards which are the original DOM pointers.
            track.innerHTML = '';
            rawCards.forEach(card => {
                card.classList.remove('clone');
                track.appendChild(card);
            });

            const visibleSlides = getVisibleCount();
            const totalOriginal = rawCards.length;

            // 2. Decide if we need Carousel Logic
            // We need carousel if Loop is needed. Standard logic: if items > visible
            // But user specific: if items <= visible on Desktop, SHOW STATIC (No loop/clones).
            // On Mobile, if items > 1, show Carousel.

            const needsCarousel = totalOriginal > visibleSlides;

            if (needsCarousel) {
                // Enable Buttons
                if (nextBtn) nextBtn.style.display = 'flex';
                if (prevBtn) prevBtn.style.display = 'flex';
                track.style.justifyContent = 'flex-start'; // Normal

                // 3. Clone Logic
                cloneCount = visibleSlides; // Clone enough for buffer

                // Prepend Clones
                for (let i = 0; i < cloneCount; i++) {
                    let index = (totalOriginal - 1 - i);
                    index = ((index % totalOriginal) + totalOriginal) % totalOriginal;
                    const clone = rawCards[index].cloneNode(true);
                    clone.classList.add('clone');
                    track.insertBefore(clone, track.firstChild);
                }

                // Append Clones
                for (let i = 0; i < cloneCount; i++) {
                    let index = i % totalOriginal;
                    const clone = rawCards[index].cloneNode(true);
                    clone.classList.add('clone');
                    track.appendChild(clone);
                }

                // Set Start Index
                currentIndex = cloneCount;
                activeCards = Array.from(track.children);

                // Initial Position
                updateTrackPosition(false);

                // Restart Autoplay
                startAutoplay();

            } else {
                // Disable Buttons
                if (nextBtn) nextBtn.style.display = 'none';
                if (prevBtn) prevBtn.style.display = 'none';

                // Center cards if they don't fill the space
                track.style.justifyContent = 'center';
                track.style.transform = 'none';
                activeCards = rawCards;
                currentIndex = 0;
            }
        };

        const updateTrackPosition = (transition = true) => {
            const cardWidth = activeCards[0].getBoundingClientRect().width;
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

        const nextSlide = () => {
            if (isTransitioning) return;
            const visibleSlides = getVisibleCount();
            // Safety: if no carousel needed, do nothing.
            if (rawCards.length <= visibleSlides) return;

            currentIndex++;
            isTransitioning = true;
            updateTrackPosition(true);
        };

        const prevSlide = () => {
            if (isTransitioning) return;
            const visibleSlides = getVisibleCount();
            if (rawCards.length <= visibleSlides) return;

            currentIndex--;
            isTransitioning = true;
            updateTrackPosition(true);
        };

        track.addEventListener('transitionend', () => {
            if (!isTransitioning) return; // Ignore if not transitioning
            isTransitioning = false;

            const visibleSlides = getVisibleCount();
            if (rawCards.length <= visibleSlides) return;

            // Normalize Index
            const totalReal = rawCards.length;

            // Forward Wrap
            if (currentIndex >= cloneCount + totalReal) {
                currentIndex = currentIndex - totalReal;
                updateTrackPosition(false);
            }
            // Backward Wrap
            if (currentIndex < cloneCount) {
                currentIndex = currentIndex + totalReal;
                updateTrackPosition(false);
            }
        });

        const startAutoplay = () => {
            // Only if needed
            const visibleSlides = getVisibleCount();
            if (rawCards.length <= visibleSlides) return;

            clearInterval(autoplayInterval);
            autoplayInterval = setInterval(nextSlide, 2000);
        };

        const stopAutoplay = () => {
            clearInterval(autoplayInterval);
        };

        const resetAutoplay = () => {
            stopAutoplay();
            startAutoplay();
        };

        // Inputs
        if (nextBtn) nextBtn.addEventListener('click', () => { nextSlide(); resetAutoplay(); });
        if (prevBtn) prevBtn.addEventListener('click', () => { prevSlide(); resetAutoplay(); });

        track.addEventListener('mouseenter', stopAutoplay);
        track.addEventListener('mouseleave', startAutoplay);

        // Resize Event - Debounced (Simple timeout)
        let resizeTimer;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(() => {
                setupCarousel();
            }, 200);
        });

        // Initialize
        // Wait for styles (gap etc) to be computed, though requestAnimationFrame is better, setTimeout is safe
        setTimeout(setupCarousel, 100);
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
