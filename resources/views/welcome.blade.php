<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bhuwan | Full Stack Developer</title>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" />

    @vite(['resources/js/frontend/main.js', 'resources/js/frontend/main.css'])


</head>

<body class="bg-white text-gray-800 antialiased">

    <!-- ========= NAVBAR ========= -->
    <header class="sticky top-0 z-50 bg-white/80 backdrop-blur border-b border-gray-100 shadow-sm">
        <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
            <a href="#" class="text-xl font-bold gradient-text tracking-tight">bhuwan.dev</a>
            <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-gray-600">
                <a href="#about" class="nav-link hover:text-primary transition-colors">About</a>
                <a href="#skills" class="nav-link hover:text-primary transition-colors">Skills</a>
                <a href="#projects" class="nav-link hover:text-primary transition-colors">Projects</a>
                <a href="#timeline" class="nav-link hover:text-primary transition-colors">Journey</a>
                <a href="#contact" class="nav-link hover:text-primary transition-colors">Contact</a>
            </nav>
            <a href="#contact"
                class="bg-primary text-white text-sm font-medium px-5 py-2 rounded-full hover:bg-indigo-700 transition-colors shadow-md shadow-indigo-200">
                Hire Me
            </a>
        </div>
    </header>

    {{ $slot }}

    <!-- ========= FOOTER ========= -->
    <footer class="bg-dark text-gray-400 py-12">
        <div class="max-w-6xl mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6 mb-8">
                <span class="text-2xl font-bold gradient-text">bhuwan.dev</span>
                <nav class="flex flex-wrap items-center gap-6 text-sm">
                    <a href="#about" class="hover:text-white transition-colors">About</a>
                    <a href="#skills" class="hover:text-white transition-colors">Skills</a>
                    <a href="#projects" class="hover:text-white transition-colors">Projects</a>
                    <a href="#timeline" class="hover:text-white transition-colors">Journey</a>
                    <a href="#contact" class="hover:text-white transition-colors">Contact</a>
                </nav>
                <div class="flex gap-3">
                    <a href="#"
                        class="w-9 h-9 rounded-full bg-white/10 hover:bg-primary flex items-center justify-center transition-all text-sm">in</a>
                    <a href="#"
                        class="w-9 h-9 rounded-full bg-white/10 hover:bg-primary flex items-center justify-center transition-all text-sm">gh</a>
                    <a href="#"
                        class="w-9 h-9 rounded-full bg-white/10 hover:bg-primary flex items-center justify-center transition-all text-sm">tw</a>
                </div>
            </div>
            <div
                class="border-t border-white/10 pt-6 flex flex-col md:flex-row items-center justify-between text-xs gap-2">
                <span>© 2024 Bhuwan ghimire. All rights reserved.</span>
                <span>Crafted with ❤️ using HTML & Tailwind CSS</span>
            </div>
        </div>
    </footer>

    <script>
        // // Smooth scroll
        // document.querySelectorAll('a[href^="#"]').forEach(a => {
        //     a.addEventListener('click', e => {
        //         e.preventDefault();
        //         const t = document.querySelector(a.getAttribute('href'));
        //         if (t) t.scrollIntoView({
        //             behavior: 'smooth',
        //             block: 'start'
        //         });
        //     });
        // });
        // // Fade-in on scroll
        // const io = new IntersectionObserver(entries => {
        //     entries.forEach(el => {
        //         if (el.isIntersecting) {
        //             el.target.style.opacity = 1;
        //             el.target.style.transform = 'translateY(0)';
        //         }
        //     });
        // }, {
        //     threshold: 0.1
        // });
        // document.querySelectorAll('section').forEach(s => {
        //     s.style.opacity = 0;
        //     s.style.transform = 'translateY(20px)';
        //     s.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        //     io.observe(s);
        // });
    </script>
</body>

</html>
