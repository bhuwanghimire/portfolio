<?php

use Livewire\Component;
use Livewire\Attributes\Layout;

new #[Layout('welcome')] class extends Component {
    public $profile;
    public function mount()
    {
        $this->loadProfile();
    }

    public function loadProfile()
    {
        $this->profile = \App\Models\Profile::first();
        // dd($this->profile);
    }
};
?>

<div>
    <!-- Hero Section -->
    @island
        <section id="home" class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div class="order-2 lg:order-1">
                        <div
                            class="inline-block px-4 py-1.5 mb-6 bg-primaryLight text-primary font-semibold rounded-full text-sm">
                            👋 {{ $profile->headline }}
                        </div>
                        <h1 class="text-5xl lg:text-7xl font-bold text-gray-900 mb-6 leading-tight">
                            I'm <span class="text-primary lg:text-5xl">{{ $profile->name }}</span><br>
                            <span class="text-3xl lg:text-5xl text-gray-500 font-semibold">{{ $profile->title }}</span>
                        </h1>
                        <p class="text-lg text-gray-600 mb-8 max-w-lg leading-relaxed">
                            {{ $profile->bio }}
                        </p>

                        <div class="flex flex-wrap gap-4">
                            <a href="#contact"
                                class="px-8 py-4 bg-primary text-white rounded-full font-semibold shadow-lg shadow-violet-200 hover:bg-primaryDark hover:-translate-y-1 transition duration-300">
                                Hire Me
                            </a>
                            <a href="#"
                                class="px-8 py-4 bg-white text-gray-900 border border-gray-200 rounded-full font-semibold hover:border-primary hover:text-primary transition duration-300 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                                Download CV
                            </a>
                        </div>

                        <div class="mt-12 grid grid-cols-3 gap-6 border-t border-gray-100 pt-8">
                            <div>
                                <h3 class="text-3xl font-bold text-gray-900">{{ $profile->years_experience }}+</h3>
                                <p class="text-sm text-gray-500 mt-1">Years Experience</p>
                            </div>
                            <div>
                                <h3 class="text-3xl font-bold text-gray-900">{{ $profile->completed_projects }}+</h3>
                                <p class="text-sm text-gray-500 mt-1">Completed Projects</p>
                            </div>
                            <div>
                                <h3 class="text-3xl font-bold text-gray-900">{{ $profile->happy_clients }}+</h3>
                                <p class="text-sm text-gray-500 mt-1">Happy Clients</p>
                            </div>
                        </div>
                    </div>

                    <div class="order-1 lg:order-2 flex justify-center relative">
                        <div
                            class="absolute inset-0 bg-gradient-to-tr from-violet-100 to-transparent rounded-full blur-3xl opacity-70 transform translate-x-10 translate-y-10">
                        </div>
                        <img src="{{ asset($profile->avatar) }}?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                            alt="Profile"
                            class="relative w-full max-w-md rounded-3xl shadow-2xl z-10 object-cover h-[500px]">
                    </div>
                </div>
            </div>
        </section>
    @endisland

    <!-- About Section -->
    <livewire:pages::frontend.section.about />


    <!-- Services Section -->
    <section id="services" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-primary font-semibold tracking-wide uppercase">What I Do</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2">My Services</h2>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Service 1 -->
                <div
                    class="p-8 rounded-2xl bg-gray-50 border border-gray-100 hover:border-primary/30 hover:shadow-xl hover:shadow-violet-100 transition duration-300 group">
                    <div
                        class="w-14 h-14 bg-white rounded-xl shadow-sm flex items-center justify-center text-primary mb-6 group-hover:bg-primary group-hover:text-white transition">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Web Design</h3>
                    <p class="text-gray-500">Creating stunning, user-friendly web interfaces that represent your brand
                        effectively.</p>
                </div>

                <!-- Service 2 -->
                <div
                    class="p-8 rounded-2xl bg-gray-50 border border-gray-100 hover:border-primary/30 hover:shadow-xl hover:shadow-violet-100 transition duration-300 group">
                    <div
                        class="w-14 h-14 bg-white rounded-xl shadow-sm flex items-center justify-center text-primary mb-6 group-hover:bg-primary group-hover:text-white transition">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Development</h3>
                    <p class="text-gray-500">Building robust and scalable websites using modern technologies and best
                        practices.</p>
                </div>

                <!-- Service 3 -->
                <div
                    class="p-8 rounded-2xl bg-gray-50 border border-gray-100 hover:border-primary/30 hover:shadow-xl hover:shadow-violet-100 transition duration-300 group">
                    <div
                        class="w-14 h-14 bg-white rounded-xl shadow-sm flex items-center justify-center text-primary mb-6 group-hover:bg-primary group-hover:text-white transition">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">App Design</h3>
                    <p class="text-gray-500">Designing intuitive mobile applications for both iOS and Android
                        platforms.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12">
                <!-- Technical Skills Column -->
                <livewire:pages::frontend.section.technical-skill lazy />

                <!-- Interests/Soft Skills Circles -->
                <livewire:pages::frontend.section.personal-interest lazy />
            </div>
        </div>
    </section>

    <!-- Resume Section -->
    <section id="resume" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-primary font-semibold tracking-wide uppercase">My Journey</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2">Resume & Experience</h2>
            </div>

            <div class="grid lg:grid-cols-2 gap-12">
                <!-- Education -->
                <livewire:pages::frontend.section.education lazy />

                <!-- Experience -->
                <livewire:pages::frontend.section.experience lazy />


            </div>
        </div>
    </section>

    <!-- Portfolio Section -->
    <section id="portfolio" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-primary font-semibold tracking-wide uppercase">My Work</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2">Portfolio</h2>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Project 1 -->
                <div class="group relative overflow-hidden rounded-2xl shadow-md cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                        alt="Project 1"
                        class="w-full h-64 object-cover transform group-hover:scale-110 transition duration-500">
                    <div
                        class="absolute inset-0 bg-primary/80 opacity-0 group-hover:opacity-100 transition duration-300 flex flex-col justify-center items-center text-white">
                        <h4 class="text-xl font-bold">Finance Dashboard</h4>
                        <span class="text-sm mt-2">Web Design</span>
                    </div>
                </div>

                <!-- Project 2 -->
                <div class="group relative overflow-hidden rounded-2xl shadow-md cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1555421689-491a97ff2040?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                        alt="Project 2"
                        class="w-full h-64 object-cover transform group-hover:scale-110 transition duration-500">
                    <div
                        class="absolute inset-0 bg-primary/80 opacity-0 group-hover:opacity-100 transition duration-300 flex flex-col justify-center items-center text-white">
                        <h4 class="text-xl font-bold">E-Commerce App</h4>
                        <span class="text-sm mt-2">Development</span>
                    </div>
                </div>

                <!-- Project 3 -->
                <div class="group relative overflow-hidden rounded-2xl shadow-md cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1547658719-da2b51169166?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                        alt="Project 3"
                        class="w-full h-64 object-cover transform group-hover:scale-110 transition duration-500">
                    <div
                        class="absolute inset-0 bg-primary/80 opacity-0 group-hover:opacity-100 transition duration-300 flex flex-col justify-center items-center text-white">
                        <h4 class="text-xl font-bold">Travel Agency</h4>
                        <span class="text-sm mt-2">Branding</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section (UPDATED: 2 Slides per view) -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-primary font-semibold tracking-wide uppercase">Feedback</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2">Testimonials</h2>
            </div>

            <div class="relative w-full mx-auto">
                <!-- Slider Wrapper -->
                <div class="overflow-hidden rounded-3xl p-2">
                    <!-- Slider Track -->
                    <div id="testimonial-track" class="flex transition-transform duration-500 ease-in-out">

                        <!-- Slide 1 -->
                        <div class="w-full md:w-1/2 flex-shrink-0 p-4">
                            <div class="bg-gray-50 p-8 rounded-3xl border border-gray-100 h-full flex flex-col">
                                <div class="flex items-center gap-4 mb-6">
                                    <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80"
                                        alt="Client"
                                        class="w-14 h-14 rounded-full object-cover ring-2 ring-primaryLight">
                                    <div>
                                        <h4 class="text-lg font-bold text-gray-900">Sarah Johnson</h4>
                                        <span class="text-sm text-primary">CEO, TechStart</span>
                                    </div>
                                </div>
                                <p class="text-gray-600 italic leading-relaxed flex-grow">
                                    "Alex is a fantastic designer. He understood our requirements perfectly and
                                    delivered a design that exceeded our expectations. The attention to detail was
                                    impressive."
                                </p>
                            </div>
                        </div>

                        <!-- Slide 2 -->
                        <div class="w-full md:w-1/2 flex-shrink-0 p-4">
                            <div class="bg-gray-50 p-8 rounded-3xl border border-gray-100 h-full flex flex-col">
                                <div class="flex items-center gap-4 mb-6">
                                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80"
                                        alt="Client"
                                        class="w-14 h-14 rounded-full object-cover ring-2 ring-primaryLight">
                                    <div>
                                        <h4 class="text-lg font-bold text-gray-900">Michael Chen</h4>
                                        <span class="text-sm text-primary">Founder, Innovate</span>
                                    </div>
                                </div>
                                <p class="text-gray-600 italic leading-relaxed flex-grow">
                                    "Working with Alex was a breeze. His technical skills and eye for design made our
                                    project a huge success. I will definitely work with him again."
                                </p>
                            </div>
                        </div>

                        <!-- Slide 3 -->
                        <div class="w-full md:w-1/2 flex-shrink-0 p-4">
                            <div class="bg-gray-50 p-8 rounded-3xl border border-gray-100 h-full flex flex-col">
                                <div class="flex items-center gap-4 mb-6">
                                    <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80"
                                        alt="Client"
                                        class="w-14 h-14 rounded-full object-cover ring-2 ring-primaryLight">
                                    <div>
                                        <h4 class="text-lg font-bold text-gray-900">Emily Davis</h4>
                                        <span class="text-sm text-primary">PM, SoftCorp</span>
                                    </div>
                                </div>
                                <p class="text-gray-600 italic leading-relaxed flex-grow">
                                    "I was impressed by the code quality and the speed of delivery. Alex is a true
                                    professional who cares about the final product."
                                </p>
                            </div>
                        </div>

                        <!-- Slide 4 -->
                        <div class="w-full md:w-1/2 flex-shrink-0 p-4">
                            <div class="bg-gray-50 p-8 rounded-3xl border border-gray-100 h-full flex flex-col">
                                <div class="flex items-center gap-4 mb-6">
                                    <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80"
                                        alt="Client"
                                        class="w-14 h-14 rounded-full object-cover ring-2 ring-primaryLight">
                                    <div>
                                        <h4 class="text-lg font-bold text-gray-900">David Wilson</h4>
                                        <span class="text-sm text-primary">CTO, WebFlows</span>
                                    </div>
                                </div>
                                <p class="text-gray-600 italic leading-relaxed flex-grow">
                                    "Highly recommended! The communication was excellent and the final result was
                                    exactly what we needed for our launch."
                                </p>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Navigation Controls -->
                <div class="flex justify-center mt-8 gap-4">
                    <button id="prevBtn"
                        class="bg-white border border-gray-200 text-gray-800 p-3 rounded-full shadow-sm hover:bg-primary hover:text-white hover:border-primary transition focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>
                    <button id="nextBtn"
                        class="bg-white border border-gray-200 text-gray-800 p-3 rounded-full shadow-sm hover:bg-primary hover:text-white hover:border-primary transition focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Section (NEW) -->
    <section id="blog" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-primary font-semibold tracking-wide uppercase">Latest News</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2">My Blog</h2>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Blog Post 1 -->
                <article
                    class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:shadow-violet-100 transition duration-300 border border-gray-100 flex flex-col">
                    <div class="relative overflow-hidden h-56">
                        <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                            alt="Blog 1"
                            class="w-full h-full object-cover transform hover:scale-110 transition duration-500">
                        <div
                            class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-primary uppercase tracking-wide">
                            Development</div>
                    </div>
                    <div class="p-6 flex-grow flex flex-col">
                        <div class="flex items-center text-sm text-gray-400 mb-3 gap-4">
                            <span>May 15, 2024</span>
                            <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                            <span>5 min read</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3 hover:text-primary transition cursor-pointer">
                            The Future of Web Development</h3>
                        <p class="text-gray-600 mb-4 line-clamp-3">Exploring the latest trends in frontend frameworks
                            and how they shape the digital landscape.</p>
                        <a href="#"
                            class="mt-auto inline-flex items-center text-primary font-medium hover:text-primaryDark transition group">
                            Read More
                            <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>
                </article>

                <!-- Blog Post 2 -->
                <article
                    class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:shadow-violet-100 transition duration-300 border border-gray-100 flex flex-col">
                    <div class="relative overflow-hidden h-56">
                        <img src="https://images.unsplash.com/photo-1561070791-2526d30994b5?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                            alt="Blog 2"
                            class="w-full h-full object-cover transform hover:scale-110 transition duration-500">
                        <div
                            class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-primary uppercase tracking-wide">
                            Design</div>
                    </div>
                    <div class="p-6 flex-grow flex flex-col">
                        <div class="flex items-center text-sm text-gray-400 mb-3 gap-4">
                            <span>Apr 22, 2024</span>
                            <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                            <span>4 min read</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3 hover:text-primary transition cursor-pointer">
                            Mastering UI/UX Principles</h3>
                        <p class="text-gray-600 mb-4 line-clamp-3">A comprehensive guide to creating user-centric
                            designs that drive engagement and conversion.</p>
                        <a href="#"
                            class="mt-auto inline-flex items-center text-primary font-medium hover:text-primaryDark transition group">
                            Read More
                            <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>
                </article>

                <!-- Blog Post 3 -->
                <article
                    class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:shadow-violet-100 transition duration-300 border border-gray-100 flex flex-col">
                    <div class="relative overflow-hidden h-56">
                        <img src="https://images.unsplash.com/photo-1555066931-4365d14bab8c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                            alt="Blog 3"
                            class="w-full h-full object-cover transform hover:scale-110 transition duration-500">
                        <div
                            class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-primary uppercase tracking-wide">
                            Coding</div>
                    </div>
                    <div class="p-6 flex-grow flex flex-col">
                        <div class="flex items-center text-sm text-gray-400 mb-3 gap-4">
                            <span>Mar 10, 2024</span>
                            <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                            <span>6 min read</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3 hover:text-primary transition cursor-pointer">
                            Clean Code Architecture</h3>
                        <p class="text-gray-600 mb-4 line-clamp-3">Why keeping your codebase clean and modular is
                            essential for long-term project success.</p>
                        <a href="#"
                            class="mt-auto inline-flex items-center text-primary font-medium hover:text-primaryDark transition group">
                            Read More
                            <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- Clients Section -->
    <section class="py-12 border-y border-gray-100 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div
                class="flex flex-wrap justify-center items-center gap-12 opacity-50 grayscale hover:grayscale-0 transition duration-500">
                <h3 class="text-2xl font-bold text-gray-400 hover:text-primary transition">Google</h3>
                <h3 class="text-2xl font-bold text-gray-400 hover:text-primary transition">Amazon</h3>
                <h3 class="text-2xl font-bold text-gray-400 hover:text-primary transition">Spotify</h3>
                <h3 class="text-2xl font-bold text-gray-400 hover:text-primary transition">Adobe</h3>
                <h3 class="text-2xl font-bold text-gray-400 hover:text-primary transition">Slack</h3>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-primary font-semibold tracking-wide uppercase">Get in Touch</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2">Contact Me</h2>
            </div>

            <div class="grid lg:grid-cols-3 gap-12">
                <!-- Contact Info -->
                <div class="lg:col-span-1 space-y-8">
                    <div class="flex items-start gap-4">
                        <div
                            class="w-12 h-12 bg-white rounded-lg shadow-sm flex items-center justify-center text-primary flex-shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-gray-900">Phone</h4>
                            <p class="text-gray-500">+1 234 567 890</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div
                            class="w-12 h-12 bg-white rounded-lg shadow-sm flex items-center justify-center text-primary flex-shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-gray-900">Email</h4>
                            <p class="text-gray-500">alex@example.com</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div
                            class="w-12 h-12 bg-white rounded-lg shadow-sm flex items-center justify-center text-primary flex-shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-gray-900">Location</h4>
                            <p class="text-gray-500">123 Street Name, New York, NY 10012</p>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="lg:col-span-2 bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
                    <form class="space-y-6">
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                                <input type="text"
                                    class="w-full px-4 py-3 rounded-lg bg-gray-50 border-transparent focus:bg-white focus:ring-2 focus:ring-primary focus:border-transparent transition"
                                    placeholder="John Doe">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="email"
                                    class="w-full px-4 py-3 rounded-lg bg-gray-50 border-transparent focus:bg-white focus:ring-2 focus:ring-primary focus:border-transparent transition"
                                    placeholder="john@example.com">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
                            <input type="text"
                                class="w-full px-4 py-3 rounded-lg bg-gray-50 border-transparent focus:bg-white focus:ring-2 focus:ring-primary focus:border-transparent transition"
                                placeholder="Project Discussion">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                            <textarea rows="4"
                                class="w-full px-4 py-3 rounded-lg bg-gray-50 border-transparent focus:bg-white focus:ring-2 focus:ring-primary focus:border-transparent transition"
                                placeholder="Tell me about your project..."></textarea>
                        </div>
                        <button type="button"
                            class="px-8 py-3 bg-primary text-white font-semibold rounded-lg hover:bg-primaryDark transition shadow-lg shadow-violet-200 w-full md:w-auto">
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
