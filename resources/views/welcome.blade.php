<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alex Dev | Personal Portfolio</title>
    <!-- Tailwind CSS via CDN -->
    @vite(['resources/js/frontend/main.js','resources/js/frontend/main.css'])

    <script src="https://kit.fontawesome.com"></script>


</head>

<body class="bg-gray-50 text-gray-600 antialiased">

    <!-- Navigation -->
    <nav class="fixed w-full z-50 bg-white/90 backdrop-blur-md shadow-sm transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="#" class="text-2xl font-bold text-gray-900">
                        Alex<span class="text-primary">.</span>
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex space-x-8">
                    <a href="#about" class="text-gray-900 hover:text-primary font-medium transition">About</a>
                    <a href="#services" class="text-gray-900 hover:text-primary font-medium transition">Services</a>
                    <a href="#portfolio" class="text-gray-900 hover:text-primary font-medium transition">Portfolio</a>
                    <a href="#blog" class="text-gray-900 hover:text-primary font-medium transition">Blog</a>
                    <a href="#contact"
                        class="px-5 py-2 bg-primary text-white rounded-full font-medium hover:bg-primaryDark transition shadow-md hover:shadow-lg">Contact
                        Me</a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-btn" class="text-gray-900 hover:text-primary focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-100">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="#about"
                    class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-primary hover:bg-gray-50 rounded-md">About</a>
                <a href="#services"
                    class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-primary hover:bg-gray-50 rounded-md">Services</a>
                <a href="#portfolio"
                    class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-primary hover:bg-gray-50 rounded-md">Portfolio</a>
                <a href="#blog"
                    class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-primary hover:bg-gray-50 rounded-md">Blog</a>
                <a href="#contact" class="block px-3 py-2 text-base font-medium text-primary font-bold">Contact Me</a>
            </div>
        </div>
    </nav>

    {{ $slot }}


    <!-- Footer -->
    <footer class="bg-white border-t border-gray-100 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-gray-500">
                &copy; 2024 <span class="text-primary font-bold">Alex.</span> All rights reserved.
            </p>
        </div>
    </footer>

    <!-- Scripts (Vanilla JS) -->
    <script>
        // --- Mobile Menu Logic ---
        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');

        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });

        // --- Testimonial Slider Logic (Updated for 2 Slides Per View) ---
        const track = document.getElementById('testimonial-track');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');

        let currentIndex = 0;

        function getSlidesPerView() {
            // Tailwind MD breakpoint is 768px.
            // If screen >= 768px, we show 2 slides. Else 1.
            return window.innerWidth >= 768 ? 2 : 1;
        }

        function updateSlider() {
            const slidesPerView = getSlidesPerView();
            const slideWidth = 100 / slidesPerView;
            track.style.transform = `translateX(-${currentIndex * slideWidth}%)`;

            // Manage Button states
            const totalSlides = track.children.length;

            // Disable Previous if at start
            if (currentIndex === 0) {
                prevBtn.classList.add('opacity-50', 'cursor-not-allowed');
            } else {
                prevBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            }

            // Disable Next if at end
            // The logic: If we have 4 slides and show 2.
            // Index 0: Shows 1,2.
            // Index 1: Shows 2,3.
            // Index 2: Shows 3,4. (End)
            // So max index is totalSlides - slidesPerView
            if (currentIndex >= totalSlides - slidesPerView) {
                nextBtn.classList.add('opacity-50', 'cursor-not-allowed');
            } else {
                nextBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            }
        }

        nextBtn.addEventListener('click', () => {
            const slidesPerView = getSlidesPerView();
            const totalSlides = track.children.length;

            if (currentIndex < totalSlides - slidesPerView) {
                currentIndex++;
                updateSlider();
            }
        });

        prevBtn.addEventListener('click', () => {
            if (currentIndex > 0) {
                currentIndex--;
                updateSlider();
            }
        });

        // Update on resize to handle switching between 1 and 2 column view
        window.addEventListener('resize', () => {
            // Reset to 0 to avoid layout glitches during resize
            currentIndex = 0;
            updateSlider();
        });

        // Initialize
        updateSlider();
    </script>
</body>

</html>
