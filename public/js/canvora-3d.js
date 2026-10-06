/**
 * CANVORA GROUP - 3D INTERACTIVE ENGINE & MOTION
 * Handles 3D tilt physics, drag-to-rotate stages, dynamic specular glare,
 * interactive 3D particle mesh, and 3D cylindrical orbit carousel.
 */

(function () {
    'use strict';

    // =========================================================================
    // 1. NAVBAR SCROLL EFFECT
    // =========================================================================
    const header = document.querySelector('.site-header');
    if (header) {
        const handleScroll = () => {
            if (window.scrollY > 40) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        };
        window.addEventListener('scroll', handleScroll, { passive: true });
        handleScroll();
    }

    // =========================================================================
    // 2. INTERACTIVE 3D PARTICLE MESH CANVAS (Hero Background)
    // =========================================================================
    const canvas = document.getElementById('hero-3d-canvas');
    if (canvas) {
        const ctx = canvas.getContext('2d');
        let width = (canvas.width = canvas.parentElement.offsetWidth);
        let height = (canvas.height = canvas.parentElement.offsetHeight);

        const particles = [];
        const particleCount = Math.min(Math.floor((width * height) / 14000), 55);
        let mouse = { x: -1000, y: -1000, radius: 140 };

        class Particle {
            constructor() {
                this.x = Math.random() * width;
                this.y = Math.random() * height;
                this.vx = (Math.random() - 0.5) * 0.8;
                this.vy = (Math.random() - 0.5) * 0.8;
                this.radius = Math.random() * 2 + 1;
                this.baseAlpha = Math.random() * 0.5 + 0.25;
            }

            update() {
                this.x += this.vx;
                this.y += this.vy;

                if (this.x < 0) this.x = width;
                if (this.x > width) this.x = 0;
                if (this.y < 0) this.y = height;
                if (this.y > height) this.y = 0;

                // Mouse interaction repulsion/attraction
                const dx = mouse.x - this.x;
                const dy = mouse.y - this.y;
                const dist = Math.sqrt(dx * dx + dy * dy);

                if (dist < mouse.radius) {
                    const force = (mouse.radius - dist) / mouse.radius;
                    this.x -= (dx / dist) * force * 3;
                    this.y -= (dy / dist) * force * 3;
                }
            }

            draw() {
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
                ctx.fillStyle = `rgba(0, 210, 255, ${this.baseAlpha})`;
                ctx.fill();
            }
        }

        for (let i = 0; i < particleCount; i++) {
            particles.push(new Particle());
        }

        function connectParticles() {
            for (let a = 0; a < particles.length; a++) {
                for (let b = a + 1; b < particles.length; b++) {
                    const dx = particles[a].x - particles[b].x;
                    const dy = particles[a].y - particles[b].y;
                    const dist = Math.sqrt(dx * dx + dy * dy);

                    if (dist < 125) {
                        const alpha = (1 - dist / 125) * 0.22;
                        ctx.strokeStyle = `rgba(7, 85, 255, ${alpha})`;
                        ctx.lineWidth = 1;
                        ctx.beginPath();
                        ctx.moveTo(particles[a].x, particles[a].y);
                        ctx.lineTo(particles[b].x, particles[b].y);
                        ctx.stroke();
                    }
                }
            }
        }

        let animationFrameId;
        let isHeroVisible = true;

        function animateCanvas() {
            if (!isHeroVisible) return;
            ctx.clearRect(0, 0, width, height);

            particles.forEach((p) => {
                p.update();
                p.draw();
            });

            connectParticles();
            animationFrameId = requestAnimationFrame(animateCanvas);
        }

        animateCanvas();

        const heroElement = canvas.parentElement;
        heroElement.addEventListener('mousemove', (e) => {
            const rect = canvas.getBoundingClientRect();
            mouse.x = e.clientX - rect.left;
            mouse.y = e.clientY - rect.top;
        });

        heroElement.addEventListener('mouseleave', () => {
            mouse.x = -1000;
            mouse.y = -1000;
        });

        window.addEventListener('resize', () => {
            if (!canvas.parentElement) return;
            width = canvas.width = canvas.parentElement.offsetWidth;
            height = canvas.height = canvas.parentElement.offsetHeight;
        });

        // Pause canvas when out of view
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                isHeroVisible = entry.isIntersecting;
                if (isHeroVisible) {
                    cancelAnimationFrame(animationFrameId);
                    animateCanvas();
                }
            });
        });
        observer.observe(canvas.parentElement);
    }

    // =========================================================================
    // 3. HERO 3D INTERACTIVE STAGE (TILT, DRAG ROTATION & 2S AUTO-ROTATION)
    // =========================================================================
    const heroStageWrapper = document.querySelector('.hero-3d-wrapper');
    const heroStage = document.getElementById('hero-3d-stage');
    const heroImage = document.getElementById('hero-3d-image');
    const heroBadgeTitle = document.getElementById('hero-3d-badge-title');
    const heroBadgeSub = document.getElementById('hero-3d-badge-sub');
    const heroBadgeTag = document.getElementById('hero-3d-badge-tag');
    const heroActionBtn = document.getElementById('hero-3d-action');
    const timerBar = document.getElementById('hero-3d-timer-bar');

    // Retrieve dynamically generated asset URLs from Blade
    const areaList = (window.canvora3DAreas && window.canvora3DAreas.length > 0)
        ? window.canvora3DAreas
        : [
            {
                key: 'general',
                title: 'Canvora Group',
                subtitle: 'Soluciones Integradas',
                tag: 'Ecosistema 360°',
                image: '/images/portada.png',
                url: '#contacto',
            },
            {
                key: 'tecnologia',
                title: 'Canvora Tech',
                subtitle: 'Software & Automatización',
                tag: 'Desarrollo Web & Cloud',
                image: '/images/tecnologia.png',
                url: '/tecnologia',
            },
            {
                key: 'store',
                title: 'Canvora Store',
                subtitle: 'Equipos & Accesorios',
                tag: 'Hardware Corporativo',
                image: '/images/equipos.png',
                url: '/store',
            },
            {
                key: 'inflables',
                title: 'Inflables Publicitarios',
                subtitle: 'Gran Formato & BTL',
                tag: 'Alto Impacto Visual',
                image: '/images/inflables.png',
                url: '/inflables',
            },
            {
                key: 'marketing',
                title: 'Marketing & Publicidad',
                subtitle: 'Branding & Campañas',
                tag: 'Estrategia Digital',
                image: '/images/marketing.png',
                url: '/marketing',
            },
            {
                key: 'contabilidad',
                title: 'Servicios Contables',
                subtitle: 'Asesoría Tributaria',
                tag: 'Gestión Financiera',
                image: '/images/contabilidad.png',
                url: '/contabilidad',
            },
        ];

    // Preload all images in browser memory to eliminate loading delay
    const imageCache = {};
    areaList.forEach((item) => {
        if (item.image) {
            const img = new Image();
            img.src = item.image;
            imageCache[item.key] = img;
        }
    });

    if (heroStage && heroStageWrapper) {
        let currentRx = 0;
        let currentRy = 0;
        let targetRx = 0;
        let targetRy = 0;

        let isDragging = false;
        let isUserHovering = false;
        let dragStartX = 0;
        let dragStartY = 0;
        let baseDragRx = 0;
        let baseDragRy = 0;

        const maxTilt = 22; // max degrees tilt
        const lerpFactor = 0.085; // smooth physics dampening

        let currentAreaIndex = 0;
        let autoCycleTimer = null;
        let timerProgress = 0;
        let progressInterval = null;
        const CYCLE_DURATION_MS = 2000; // EXACTLY 2 SECONDS

        // Switch to a specific area with 3D flip effect
        function switchToArea(index, userTriggered = false) {
            currentAreaIndex = (index + areaList.length) % areaList.length;
            const data = areaList[currentAreaIndex];
            if (!data) return;

            // Update tab pills
            const tabButtons = document.querySelectorAll('.tab-3d-btn');
            tabButtons.forEach((btn) => {
                btn.classList.toggle('active', btn.getAttribute('data-area') === data.key);
            });

            // Smooth 3D micro-twist transition
            targetRy = 18;
            if (heroImage) {
                heroImage.style.transform = 'translateZ(10px) scale(0.96) rotateY(15deg)';
                heroImage.style.opacity = '0.4';
            }

            setTimeout(() => {
                if (heroImage) {
                    heroImage.src = data.image;
                    heroImage.alt = data.title;
                    heroImage.style.transform = 'translateZ(10px) scale(1.02) rotateY(0deg)';
                    heroImage.style.opacity = '1';
                }
                if (heroBadgeTitle) heroBadgeTitle.textContent = data.title;
                if (heroBadgeSub) heroBadgeSub.textContent = data.subtitle;
                if (heroBadgeTag) heroBadgeTag.textContent = data.tag;

                if (heroActionBtn && data.url) {
                    heroActionBtn.href = data.url;
                    heroActionBtn.querySelector('span').textContent = `Ver ${data.title}`;
                }

                setTimeout(() => {
                    targetRy = 0;
                }, 220);
            }, 160);

            if (userTriggered) {
                resetAutoCycleTimer();
            }
        }

        // 2-Second Timer Progress Bar
        function startProgressAnimation() {
            clearInterval(progressInterval);
            timerProgress = 0;
            if (timerBar) timerBar.style.width = '0%';

            const intervalStep = 50;
            progressInterval = setInterval(() => {
                if (!isUserHovering && !isDragging) {
                    timerProgress += (intervalStep / CYCLE_DURATION_MS) * 100;
                    if (timerProgress > 100) timerProgress = 100;
                    if (timerBar) timerBar.style.width = `${timerProgress}%`;
                }
            }, intervalStep);
        }

        function startAutoCycle() {
            stopAutoCycle();
            startProgressAnimation();

            autoCycleTimer = setInterval(() => {
                if (!isUserHovering && !isDragging) {
                    switchToArea(currentAreaIndex + 1);
                    timerProgress = 0;
                    if (timerBar) timerBar.style.width = '0%';
                }
            }, CYCLE_DURATION_MS);
        }

        function stopAutoCycle() {
            if (autoCycleTimer) {
                clearInterval(autoCycleTimer);
                autoCycleTimer = null;
            }
            if (progressInterval) {
                clearInterval(progressInterval);
                progressInterval = null;
            }
        }

        function resetAutoCycleTimer() {
            stopAutoCycle();
            startAutoCycle();
        }

        // Start 2-second cycle immediately
        startAutoCycle();

        // Mouse hover tilt tracking
        heroStageWrapper.addEventListener('mouseenter', () => {
            isUserHovering = true;
        });

        heroStageWrapper.addEventListener('mousemove', (e) => {
            if (isDragging) return;
            const rect = heroStage.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            // percentage from center (-1 to 1)
            const px = (x / rect.width - 0.5) * 2;
            const py = (y / rect.height - 0.5) * 2;

            targetRy = px * maxTilt;
            targetRx = -py * maxTilt;

            // Update glare reflection position
            const glareX = (x / rect.width) * 100;
            const glareY = (y / rect.height) * 100;
            heroStage.style.setProperty('--mouse-x', `${glareX}%`);
            heroStage.style.setProperty('--mouse-y', `${glareY}%`);
        });

        heroStageWrapper.addEventListener('mouseleave', () => {
            isUserHovering = false;
            if (!isDragging) {
                targetRx = 0;
                targetRy = 0;
            }
        });

        // Click-and-drag to freely rotate the 3D model
        const onDragStart = (clientX, clientY) => {
            isDragging = true;
            dragStartX = clientX;
            dragStartY = clientY;
            baseDragRx = currentRx;
            baseDragRy = currentRy;
        };

        const onDragMove = (clientX, clientY) => {
            if (!isDragging) return;
            const deltaX = clientX - dragStartX;
            const deltaY = clientY - dragStartY;

            targetRy = baseDragRy + deltaX * 0.45;
            targetRx = baseDragRx - deltaY * 0.45;

            // Clamp vertical rotation
            targetRx = Math.max(-55, Math.min(55, targetRx));
        };

        const onDragEnd = () => {
            if (!isDragging) return;
            isDragging = false;
            targetRx = 0;
            targetRy = 0;
        };

        // Pointer / Touch events
        heroStage.addEventListener('mousedown', (e) => onDragStart(e.clientX, e.clientY));
        window.addEventListener('mousemove', (e) => onDragMove(e.clientX, e.clientY));
        window.addEventListener('mouseup', onDragEnd);

        heroStage.addEventListener('touchstart', (e) => {
            if (e.touches.length === 1) {
                onDragStart(e.touches[0].clientX, e.touches[0].clientY);
            }
        }, { passive: true });

        window.addEventListener('touchmove', (e) => {
            if (e.touches.length === 1 && isDragging) {
                onDragMove(e.touches[0].clientX, e.touches[0].clientY);
            }
        }, { passive: true });

        window.addEventListener('touchend', onDragEnd);

        // Gyroscope tilt on mobile devices
        if (window.DeviceOrientationEvent && 'ontouchstart' in window) {
            window.addEventListener('deviceorientation', (e) => {
                if (isDragging || !e.gamma || !e.beta) return;
                const gammaClamped = Math.max(-30, Math.min(30, e.gamma));
                const betaClamped = Math.max(-30, Math.min(30, e.beta - 40));
                targetRy = gammaClamped * 0.6;
                targetRx = betaClamped * -0.6;
            }, { passive: true });
        }

        // Animation Loop with LERP
        function render3DHero() {
            currentRx += (targetRx - currentRx) * lerpFactor;
            currentRy += (targetRy - currentRy) * lerpFactor;

            heroStage.style.transform = `rotateX(${currentRx.toFixed(2)}deg) rotateY(${currentRy.toFixed(2)}deg)`;

            requestAnimationFrame(render3DHero);
        }
        render3DHero();

        // Area Switcher Tabs Click Handler
        const tabButtons = document.querySelectorAll('.tab-3d-btn');
        tabButtons.forEach((btn) => {
            btn.addEventListener('click', () => {
                const areaKey = btn.getAttribute('data-area');
                const foundIndex = areaList.findIndex((item) => item.key === areaKey);
                if (foundIndex !== -1) {
                    switchToArea(foundIndex, true);
                }
            });
        });
    }

    // =========================================================================
    // 4. INTERACTIVE 3D SPATIAL TILT CARDS (Solutions Section)
    // =========================================================================
    const tiltCards = document.querySelectorAll('[data-3d-tilt]');
    tiltCards.forEach((card) => {
        let cardRx = 0;
        let cardRy = 0;
        let targetCardRx = 0;
        let targetCardRy = 0;
        let isCardHovered = false;

        card.addEventListener('mousemove', (e) => {
            isCardHovered = true;
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            const px = (x / rect.width - 0.5) * 2;
            const py = (y / rect.height - 0.5) * 2;

            targetCardRy = px * 14;
            targetCardRx = -py * 14;

            card.style.setProperty('--mouse-x', `${(x / rect.width) * 100}%`);
            card.style.setProperty('--mouse-y', `${(y / rect.height) * 100}%`);
        });

        card.addEventListener('mouseleave', () => {
            isCardHovered = false;
            targetCardRx = 0;
            targetCardRy = 0;
        });

        function animateCard() {
            cardRx += (targetCardRx - cardRx) * 0.12;
            cardRy += (targetCardRy - cardRy) * 0.12;

            if (isCardHovered || Math.abs(cardRx) > 0.05 || Math.abs(cardRy) > 0.05) {
                card.style.transform = `perspective(1000px) rotateX(${cardRx.toFixed(2)}deg) rotateY(${cardRy.toFixed(2)}deg) translateZ(10px)`;
            } else {
                card.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) translateZ(0px)';
            }

            requestAnimationFrame(animateCard);
        }
        animateCard();
    });

    // =========================================================================
    // 5. INTERACTIVE 3D ORBIT CAROUSEL
    // =========================================================================
    const orbitCarousel = document.getElementById('orbit-3d-carousel');
    const prevBtn = document.getElementById('orbit-prev');
    const nextBtn = document.getElementById('orbit-next');
    const dotsContainer = document.getElementById('orbit-dots');

    if (orbitCarousel) {
        const items = orbitCarousel.querySelectorAll('.orbit-3d-item');
        const itemCount = items.length;
        function getRadius() {
            if (window.innerWidth < 650) return 180;
            if (window.innerWidth < 1024) return 230;
            return 280;
        }

        const angleStep = 360 / itemCount;
        let currentRotation = 0;
        let targetRotation = 0;
        let autoRotateTimer;
        let isOrbitDragging = false;
        let orbitStartX = 0;
        let orbitBaseRotation = 0;

        // Create indicator dots
        if (dotsContainer) {
            dotsContainer.innerHTML = '';
            for (let i = 0; i < itemCount; i++) {
                const dot = document.createElement('div');
                dot.className = `orbit-dot ${i === 0 ? 'active' : ''}`;
                dot.addEventListener('click', () => {
                    goToSlide(i);
                    resetAutoRotate();
                });
                dotsContainer.appendChild(dot);
            }
        }

        function updateItemTransforms() {
            const radius = getRadius();
            items.forEach((item, index) => {
                const itemAngle = index * angleStep;
                const totalAngle = itemAngle + targetRotation;
                const rad = (totalAngle * Math.PI) / 180;

                // 3D positioning on circle
                const x = Math.sin(rad) * radius;
                const z = Math.cos(rad) * radius;

                // Distance to front (z > 0 is front)
                const normalizedZ = (z + radius) / (radius * 2); // 0 to 1
                const opacity = 0.38 + normalizedZ * 0.62;
                const scale = 0.72 + normalizedZ * 0.28;

                item.style.transform = `translate3d(${x.toFixed(1)}px, 0px, ${z.toFixed(1)}px) scale(${scale.toFixed(3)})`;
                item.style.opacity = opacity.toFixed(2);
                item.style.zIndex = Math.round(normalizedZ * 50);

                if (Math.abs(((totalAngle % 360) + 360) % 360) < angleStep / 2) {
                    item.classList.add('active');
                } else {
                    item.classList.remove('active');
                }
            });

            // Update dots
            if (dotsContainer) {
                const activeIndex = ((-Math.round(targetRotation / angleStep) % itemCount) + itemCount) % itemCount;
                const dots = dotsContainer.querySelectorAll('.orbit-dot');
                dots.forEach((d, idx) => {
                    d.classList.toggle('active', idx === activeIndex);
                });
            }
        }

        function goToSlide(index) {
            currentIndex = index;
            targetRotation = -index * angleStep;
            updateItemTransforms();
        }

        function nextSlide() {
            currentIndex = (currentIndex + 1) % itemCount;
            targetRotation -= angleStep;
            updateItemTransforms();
        }

        function prevSlide() {
            currentIndex = (currentIndex - 1 + itemCount) % itemCount;
            targetRotation += angleStep;
            updateItemTransforms();
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', () => {
                nextSlide();
                resetAutoRotate();
            });
        }

        if (prevBtn) {
            prevBtn.addEventListener('click', () => {
                prevSlide();
                resetAutoRotate();
            });
        }

        // Drag to rotate 3D orbit
        let hasDragged = false;

        const startOrbitDrag = (clientX) => {
            isOrbitDragging = true;
            hasDragged = false;
            orbitStartX = clientX;
            orbitBaseRotation = targetRotation;
            clearInterval(autoRotateTimer);
            items.forEach(item => item.style.transition = 'none');
        };

        const moveOrbitDrag = (clientX) => {
            if (!isOrbitDragging) return;
            const deltaX = clientX - orbitStartX;
            if (Math.abs(deltaX) > 6) {
                hasDragged = true;
            }
            targetRotation = orbitBaseRotation + deltaX * 0.35;
            updateItemTransforms();
        };

        const endOrbitDrag = () => {
            if (!isOrbitDragging) return;
            isOrbitDragging = false;
            items.forEach(item => item.style.transition = '');
            // Snap to nearest card
            targetRotation = Math.round(targetRotation / angleStep) * angleStep;
            updateItemTransforms();
            resetAutoRotate();
            setTimeout(() => {
                hasDragged = false;
            }, 80);
        };

        // Click any 3D card to focus & bring to front
        items.forEach((item, index) => {
            item.addEventListener('click', (e) => {
                if (hasDragged) {
                    e.preventDefault();
                    e.stopPropagation();
                    return;
                }
                // Allow action link on the active front card
                if (item.classList.contains('active') && e.target.closest('.item-link')) {
                    return;
                }
                // If clicking a side card or outside the link, bring card to front
                if (!item.classList.contains('active')) {
                    e.preventDefault();
                    goToSlide(index);
                    resetAutoRotate();
                }
            });
        });

        orbitCarousel.addEventListener('mousedown', (e) => startOrbitDrag(e.clientX));
        window.addEventListener('mousemove', (e) => moveOrbitDrag(e.clientX));
        window.addEventListener('mouseup', endOrbitDrag);

        orbitCarousel.addEventListener('touchstart', (e) => {
            if (e.touches.length === 1) startOrbitDrag(e.touches[0].clientX);
        }, { passive: true });

        window.addEventListener('touchmove', (e) => {
            if (e.touches.length === 1 && isOrbitDragging) moveOrbitDrag(e.touches[0].clientX);
        }, { passive: true });

        window.addEventListener('touchend', endOrbitDrag);

        // Horizontal swipe with trackpad / wheel
        orbitCarousel.addEventListener('wheel', (e) => {
            if (Math.abs(e.deltaX) > Math.abs(e.deltaY) && Math.abs(e.deltaX) > 25) {
                e.preventDefault();
                if (e.deltaX > 0) nextSlide();
                else prevSlide();
                resetAutoRotate();
            }
        }, { passive: false });

        function startAutoRotate() {
            autoRotateTimer = setInterval(() => {
                if (!isOrbitDragging) {
                    nextSlide();
                }
            }, 5000);
        }

        function resetAutoRotate() {
            clearInterval(autoRotateTimer);
            startAutoRotate();
        }

        updateItemTransforms();
        startAutoRotate();

        // Pause on mouse hover
        orbitCarousel.addEventListener('mouseenter', () => clearInterval(autoRotateTimer));
        orbitCarousel.addEventListener('mouseleave', () => resetAutoRotate());

        // Update on resize
        window.addEventListener('resize', updateItemTransforms);
    }

})();
