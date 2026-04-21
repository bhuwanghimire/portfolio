<?php

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Traits\WithToastr;

new #[Layout('welcome')] class extends Component {
    use WithToastr;

    public $profile;
    public $projects;
    public $testimonials;

    // Contact form fields
    public $contact = [
        'first_name' => '',
        'last_name' => '',
        'email' => '',
        'subject' => '',
        'message' => '',
    ];
    public $messageSent = false;

    public function mount()
    {
        $this->loadProfile();
        $this->projects = \App\Models\Project::where('is_featured', true)->get();
        $this->testimonials = \App\Models\Testimonial::all();
    }

    public function loadProfile()
    {
        $this->profile = \App\Models\Profile::first();
    }

    public function sendMessage()
    {
        $this->validate(
            [
                'contact.first_name' => 'required|string|max:100',
                'contact.email' => 'required|email',
                'contact.message' => 'required|string|min:10',
            ],
            [
                'contact.first_name.required' => 'First name is required.',
                'contact.email.required' => 'A valid email is required.',
                'contact.message.required' => 'Please write a message.',
                'contact.message.min' => 'Message must be at least 10 characters.',
            ],
        );

        \App\Models\ContactMessage::create($this->contact);

        $this->contact = [
            'first_name' => '',
            'last_name' => '',
            'email' => '',
            'subject' => '',
            'message' => '',
        ];
        $this->messageSent = true;
        $this->toastSuccess('Message sent successfully! I will get back to you soon.');
    }
};
?>

<div>
    <!-- ========= HERO ========= -->
    <section class="relative overflow-hidden bg-white min-h-screen flex items-center">
        <div class="hero-blob w-96 h-96 bg-indigo-400 top-10 -left-20"></div>
        <div class="hero-blob w-80 h-80 bg-cyan-400 bottom-10 right-0"></div>
        <div class="max-w-6xl mx-auto px-6 py-24 grid grid-cols-1 md:grid-cols-2 gap-16 items-center relative z-10">
            <div>
                <span class="section-tag mb-4 inline-block">👋 Hello, I'm</span>
                <h1 class="text-5xl md:text-6xl font-extrabold text-dark leading-tight mb-4">
                    {{ explode(' ', $profile->name)[0] }}
                    <span class="gradient-text">{{ explode(' ', $profile->name)[1] }}</span>
                </h1>
                <p class="text-lg text-gray-500 leading-relaxed mb-8 max-w-lg">
                    {{ $profile->bio }}
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="#projects"
                        class="bg-primary text-white font-semibold px-7 py-3 rounded-full hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-200">
                        View My Work
                    </a>
                    <a href="#contact"
                        class="border-2 border-primary text-primary font-semibold px-7 py-3 rounded-full hover:bg-indigo-50 transition-all">
                        Get In Touch
                    </a>
                </div>
                <div class="mt-10 flex items-center gap-6">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-dark">{{ $profile->years_experience }}+</div>
                        <div class="text-xs text-gray-400 mt-0.5">Years Exp.</div>
                    </div>
                    <div class="w-px h-10 bg-gray-200"></div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-dark">{{ $profile->completed_projects }}+</div>
                        <div class="text-xs text-gray-400 mt-0.5">Projects</div>
                    </div>
                    <div class="w-px h-10 bg-gray-200"></div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-dark">{{ $profile->happy_clients }}+</div>
                        <div class="text-xs text-gray-400 mt-0.5">Clients</div>
                    </div>
                </div>
            </div>
            <!-- Avatar / Illustration -->
            <div class="flex justify-center">
                <div class="float-anim relative">
                    <div {{-- {{ asset($profile->avatar) }} --}}
                        class="w-72 h-72 rounded-full bg-gradient-to-br from-indigo-100 to-cyan-100 flex items-center justify-center shadow-2xl shadow-indigo-100">
                        <div class="w-64 h-64 rounded-full overflow-hidden border-4 border-white shadow-xl">
                            <img src="{{ asset($profile->avatar) }}?seed=bhuwan&backgroundColor=b6e3f4" alt="Bhuwan"
                                class="w-full h-full object-cover bg-indigo-50" />
                            {{-- <img src="https://api.dicebear.com/9.x/adventurer/svg?seed=bhuwan&backgroundColor=b6e3f4"
                                alt="Bhuwan" class="w-full h-full object-cover bg-indigo-50" /> --}}
                        </div>
                    </div>
                    <!-- floating badges -->
                    <div
                        class="absolute -top-4 -right-4 bg-white rounded-xl shadow-lg px-3 py-2 flex items-center gap-2 text-sm font-medium">
                        <span class="text-green-500">●</span> Available for hire
                    </div>
                    <div
                        class="absolute -bottom-4 -left-4 bg-white rounded-xl shadow-lg px-3 py-2 flex items-center gap-2 text-sm font-medium">
                        <span>💻</span> Full Stack Dev
                    </div>
                </div>
            </div>
        </div>
        <!-- Scroll indicator -->
        <div
            class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-1 text-gray-400 text-xs animate-bounce">
            <span>Scroll</span>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </div>
    </section>

    <!-- About Section -->
    <livewire:pages::frontend.section.about />



    <!-- ========= SKILLS ========= -->

    <livewire:pages::frontend.section.technical-skill />



    <!-- ========= PROJECTS ========= -->
    <section class="bg-gray-50 py-24" id="projects">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-14">
                <span class="section-tag">My Work</span>
                <h2 class="text-4xl font-bold text-dark mt-2 mb-3">Featured Projects</h2>
                <p class="text-gray-500 max-w-md mx-auto">A selection of projects I've built with passion and attention
                    to detail.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($projects as $index => $project)
                    <div class="{{ $index === 0 ? 'md:col-span-2' : '' }} bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 card-hover group cursor-pointer"
                        onclick="location.href='{{ $project->link ?? 'project-detail.html?project=' . urlencode($project->slug) }}'">
                        <div class="{{ $index === 0 ? 'h-52' : 'h-40' }} overflow-hidden relative">
                            <img src="{{ $project->image ? asset($project->image) : 'https://picsum.photos/seed/proj' . ($index + 1) . '/700/300' }}"
                                alt="{{ $project->title }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                            @if ($index === 0)
                                <div
                                    class="absolute top-3 left-3 bg-primary text-white text-xs font-semibold px-3 py-1 rounded-full">
                                    Featured</div>
                            @endif
                        </div>
                        <div class="p-5 {{ $index === 0 ? 'md:p-6' : '' }}">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="text-xs text-gray-400">{{ $project->technologies }}</span>
                            </div>
                            <h3 class="text-{{ $index === 0 ? 'lg' : 'base' }} font-bold text-dark mb-2">
                                {{ $project->title }}</h3>
                            <p class="text-sm text-gray-500 leading-relaxed mb-{{ $index === 0 ? '4' : '3' }}">
                                {{ $project->description }}</p>
                            <div class="flex gap-3">
                                <a href="{{ $project->link ?? 'project-detail.html?project=' . urlencode($project->slug) }}"
                                    class="text-primary text-sm font-semibold hover:underline flex items-center gap-1">View
                                    Details ↗</a>
                                @if ($project->github_link)
                                    <a href="{{ $project->github_link }}" target="_blank"
                                        class="text-gray-400 text-sm font-semibold hover:underline flex items-center gap-1">GitHub
                                        ↗</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-10 text-gray-500">
                        No featured projects found. Add some from the dashboard!
                    </div>
                @endforelse
            </div>
            <div class="text-center mt-10">
                <a href="projects.html"
                    class="inline-flex items-center gap-2 border-2 border-primary text-primary font-semibold px-7 py-3 rounded-full hover:bg-indigo-50 transition-all">
                    View All Projects
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
        </div>
    </section>


    <!-- ========= JOURNEY / TIMELINE ========= -->
    <section class="py-24" style="background: linear-gradient(135deg,#f8f4ff 0%,#f0f9ff 100%);" id="timeline">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-14">
                <span class="section-tag">My Journey</span>
                <h2 class="text-4xl font-bold text-dark mt-2 mb-3">Experience & Education</h2>
                <p class="text-gray-500 max-w-md mx-auto">The path that brought me to where I am today.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">





                <livewire:pages::frontend.section.education lazy />

                <!-- Experience -->
                <livewire:pages::frontend.section.experience lazy />


            </div><!-- end grid -->
        </div>
    </section>

    <!-- Services Section -->
    <livewire:pages::frontend.section.service />











    <!-- ========= TESTIMONIALS ========= -->
    <section class="bg-gradient-to-br from-primary to-indigo-800 py-24 text-white">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-14">
                <span class="text-xs font-semibold tracking-widest uppercase text-indigo-300">Testimonials</span>
                <h2 class="text-4xl font-bold mt-2 mb-3">What clients say</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($testimonials as $testimonial)
                    <div class="bg-white/10 backdrop-blur rounded-2xl p-6 border border-white/20">
                        <div class="flex gap-1 mb-3 text-yellow-400">
                            {{ str_repeat('★', $testimonial->rating) }}<span
                                class="text-white/30">{{ str_repeat('★', 5 - $testimonial->rating) }}</span>
                        </div>
                        <p class="text-indigo-100 text-sm leading-relaxed mb-4">"{{ $testimonial->review }}"</p>
                        <div class="flex items-center gap-3">
                            <img src="{{ $testimonial->avatar ? asset($testimonial->avatar) : 'https://api.dicebear.com/9.x/adventurer/svg?seed=' . urlencode(strtolower($testimonial->client_name)) . '&backgroundColor=ffd5dc' }}"
                                alt="{{ $testimonial->client_name }}"
                                class="w-10 h-10 rounded-full border-2 border-indigo-300 object-cover bg-white" />
                            <div>
                                <div class="font-semibold text-sm">{{ $testimonial->client_name }}</div>
                                <div class="text-xs text-indigo-300">{{ $testimonial->client_designation }}</div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-10 text-indigo-300">
                        No testimonials available at the moment.
                    </div>
                @endforelse
            </div>
        </div>
    </section>




    <!-- ========= CONTACT ========= -->
    <section class="bg-white py-24" id="contact">
        <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-16 items-start">
            <div>
                <span class="section-tag">Get In Touch</span>
                <h2 class="text-4xl font-bold text-dark mt-2 mb-5">Let's work together!</h2>
                <p class="text-gray-500 leading-relaxed mb-8">Have a project in mind or just want to say hi? My inbox
                    is always open. Drop a message and I'll get back to you within 24 hours.</p>
                <div class="space-y-4">
                    <a href="mailto:bhuwan@example.com"
                        class="flex items-center gap-4 p-4 rounded-xl border border-gray-100 hover:border-indigo-100 hover:bg-indigo-50 transition-all group">
                        <div
                            class="w-10 h-10 bg-indigo-100 rounded-xl flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-all">
                            ✉️</div>
                        <div>
                            <div class="text-xs text-gray-400">Email</div>
                            <div class="font-medium text-gray-700">bhuwan@example.com</div>
                        </div>
                    </a>
                    <a href="#"
                        class="flex items-center gap-4 p-4 rounded-xl border border-gray-100 hover:border-indigo-100 hover:bg-indigo-50 transition-all group">
                        <div
                            class="w-10 h-10 bg-indigo-100 rounded-xl flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-all">
                            💼</div>
                        <div>
                            <div class="text-xs text-gray-400">LinkedIn</div>
                            <div class="font-medium text-gray-700">linkedin.com/in/bhuwan</div>
                        </div>
                    </a>
                    <a href="#"
                        class="flex items-center gap-4 p-4 rounded-xl border border-gray-100 hover:border-indigo-100 hover:bg-indigo-50 transition-all group">
                        <div
                            class="w-10 h-10 bg-indigo-100 rounded-xl flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-all">
                            🐙</div>
                        <div>
                            <div class="text-xs text-gray-400">GitHub</div>
                            <div class="font-medium text-gray-700">github.com/bhuwan</div>
                        </div>
                    </a>
                </div>
            </div>
            <!-- Contact Form -->
            <div class="bg-gray-50 rounded-2xl p-8 border border-gray-100">
                <h3 class="font-bold text-dark text-xl mb-6">Send a Message</h3>

                @if ($messageSent)
                    <div class="flex flex-col items-center justify-center py-10 text-center">
                        <div class="text-5xl mb-4">✅</div>
                        <h4 class="text-lg font-bold text-dark mb-2">Message Sent!</h4>
                        <p class="text-gray-500 text-sm mb-6">Thanks for reaching out. I'll get back to you within 24
                            hours.</p>
                        <button wire:click="$set('messageSent', false)"
                            class="text-primary text-sm font-semibold hover:underline">
                            Send another message
                        </button>
                    </div>
                @else
                    <div class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="text-sm font-medium text-gray-600 mb-1 block">First Name <span
                                        class="text-red-400">*</span></label>
                                <input wire:model="contact.first_name" type="text" placeholder="John"
                                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" />
                                @error('contact.first_name')
                                    <span class="text-xs text-red-500 mt-0.5 block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-600 mb-1 block">Last Name</label>
                                <input wire:model="contact.last_name" type="text" placeholder="Doe"
                                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" />
                            </div>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600 mb-1 block">Email <span
                                    class="text-red-400">*</span></label>
                            <input wire:model="contact.email" type="email" placeholder="john@example.com"
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" />
                            @error('contact.email')
                                <span class="text-xs text-red-500 mt-0.5 block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600 mb-1 block">Subject</label>
                            <input wire:model="contact.subject" type="text" placeholder="Project Inquiry"
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" />
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600 mb-1 block">Message <span
                                    class="text-red-400">*</span></label>
                            <textarea wire:model="contact.message" rows="4" placeholder="Tell me about your project..."
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all resize-none"></textarea>
                            @error('contact.message')
                                <span class="text-xs text-red-500 mt-0.5 block">{{ $message }}</span>
                            @enderror
                        </div>
                        <button wire:click="sendMessage" wire:loading.attr="disabled" wire:target="sendMessage"
                            class="w-full bg-primary text-white font-semibold py-3.5 rounded-xl hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-200 flex items-center justify-center gap-2 disabled:opacity-60">
                            <span wire:loading.remove wire:target="sendMessage">Send Message</span>
                            <span wire:loading wire:target="sendMessage">Sending...</span>
                            <svg wire:loading.remove wire:target="sendMessage" class="w-4 h-4" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </section>

</div>
