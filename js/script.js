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
    const track = document.querySelector('.carousel-track');
    if (track) {
        const nextBtn = document.querySelector('.next-btn');
        const prevBtn = document.querySelector('.prev-btn');

        // Initial set of cards (before cloning)
        let cards = Array.from(track.children);
        if (cards.length === 0) return;

        // Constants
        const cloneCount = 3; // Max visible cards (desktop)

        // Clone first and last cards
        // Prepend last 'cloneCount' cards
        for (let i = cards.length - cloneCount; i < cards.length; i++) {
            // Handle case where we have fewer cards than cloneCount (e.g. 2 cards)
            // But user has 4, so it's fine. If fewer, loop logic needs safety, assuming >=3 for now or wrap logic.
            // Given 4 cards, safe to take last 3.
            const clone = cards[i % cards.length].cloneNode(true);
            clone.classList.add('clone');
            track.insertBefore(clone, track.firstChild);
        }

        // Append first 'cloneCount' cards
        for (let i = 0; i < cloneCount; i++) {
            const clone = cards[i % cards.length].cloneNode(true);
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
        // Use setTimeout to ensure layout is computed
        setTimeout(() => {
            updateCarousel(false);
        }, 100);

        const nextSlide = () => {
            if (isTransitioning) return;
            if (currentIndex >= allCards.length - cloneCount) return; // Prevention

            currentIndex++;
            isTransitioning = true;
            updateCarousel(true);
        };

        const prevSlide = () => {
            if (isTransitioning) return;
            if (currentIndex <= 0) return; // Prevention

            currentIndex--;
            isTransitioning = true;
            updateCarousel(true);
        };

        // Handle Transition End for Loop
        track.addEventListener('transitionend', () => {
            isTransitioning = false;

            const totalRealCards = cards.length;

            // If we reached a clone at the end (Post-Clones)
            // Index map: [Clones: 0..2] [Real: 3..6] [Clones: 7..9]
            // If index is 7 (First Post-Clone, whic IS Card A), jump to 3 (Real Card A)
            if (currentIndex >= cloneCount + totalRealCards) {
                currentIndex = currentIndex - totalRealCards;
                updateCarousel(false); // Jump without transition
            }

            // If we reached a clone at the start (Pre-Clones)
            // If index is 2 (Last Pre-Clone, which IS Card D), jump to 6 (Real Card D)
            if (currentIndex < cloneCount) {
                currentIndex = currentIndex + totalRealCards;
                updateCarousel(false); // Jump without transition
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
            }, 3000);
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
            // Recalculate position perfectly (width changes)
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
