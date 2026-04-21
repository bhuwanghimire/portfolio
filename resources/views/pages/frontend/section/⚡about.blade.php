<?php

use App\Models\Profile;
use Livewire\Component;

new class extends Component {
    public ?Profile $about = null;

    public function mount(): void
    {
        $this->about = Profile::select('about_me', 'name', 'email', 'phone', 'location', 'availability_status', 'about_me_sub_heading')->first();
    }
};
?>
@placeholder
    <div></div>
@endplaceholder

<!-- ========= ABOUT ========= -->
<section class="bg-gray-50 py-24" id="about">
    <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
        <div class="relative flex justify-center">
            <!-- Decorative ring -->
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="w-80 h-80 rounded-3xl bg-gradient-to-br from-indigo-100 to-cyan-100 rotate-3"></div>
            </div>
            <!-- Main image -->
            <div class="relative z-10">
                <img src="https://picsum.photos/seed/coding1/480/520" alt="Bhuwan working"
                    class="w-72 h-80 object-cover rounded-3xl shadow-2xl shadow-indigo-200 -rotate-1" />
            </div>
            <!-- Floating experience badge -->
            <div class="absolute bottom-4 -right-2 z-20 bg-primary text-white rounded-2xl px-5 py-4 shadow-xl">
                <div class="text-3xl font-bold leading-none">3+</div>
                <div class="text-xs text-indigo-200 mt-1">Years Experience</div>
            </div>
            <!-- Floating availability badge -->
            <div class="absolute -top-4 -left-2 z-20 bg-white rounded-xl px-4 py-2.5 shadow-lg flex items-center gap-2">
                <span class="text-green-500 text-sm">●</span>
                <span class="text-xs font-semibold text-gray-700">{{ @$about->availability_status }}</span>
            </div>
        </div>
        <div>
            <span class="section-tag">About Me</span>
            <h2 class="text-4xl font-bold text-dark mt-2 mb-5 leading-tight">
                {{ @$about->about_me_sub_heading }}
            </h2>
            <p class="text-gray-500 leading-relaxed mb-4">
                {{ @$about->about_me }}
            </p>

            <div class="grid grid-cols-2 gap-4 mb-8">
                <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
                    <div class="text-primary mb-1">📍</div>
                    <div class="text-xs text-gray-400">Location</div>
                    <div class="font-semibold text-gray-700 text-sm">{{ @$about->location }}</div>
                </div>
                <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
                    <div class="text-primary mb-1">🎓</div>
                    <div class="text-xs text-gray-400">Education</div>
                    <div class="font-semibold text-gray-700 text-sm">BSc. Computer Science</div>
                </div>
                <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
                    <div class="text-primary mb-1">💼</div>
                    <div class="text-xs text-gray-400">Employment</div>
                    <div class="font-semibold text-gray-700 text-sm">Open to Opportunities</div>
                </div>
                <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
                    <div class="text-primary mb-1">🌐</div>
                    <div class="text-xs text-gray-400">Languages</div>
                    <div class="font-semibold text-gray-700 text-sm">Nepali, English, Hindi</div>
                </div>
            </div>
            <a href="#"
                class="inline-flex items-center gap-2 bg-primary text-white font-semibold px-6 py-3 rounded-full hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-200">
                Download Resume
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                </svg>
            </a>
        </div>
    </div>
</section>
{{-- <section id="about" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">About Me</h2>
            <div class="w-16 h-1 bg-primary mx-auto rounded"></div>
        </div>

        <div class="bg-white p-8 md:p-12 rounded-3xl shadow-sm border border-gray-100">
            <p class="text-lg text-gray-600 leading-8 mb-8 text-center max-w-3xl mx-auto">
                {{@$about->about_me}}
            </p>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 text-center">
                <div class="p-4">
                    <span class="block text-sm text-gray-400 uppercase tracking-wider mb-2">Name</span>
                    <span class="font-semibold text-gray-900 text-lg">{{@$about->name}}</span>
                </div>
                <div class="p-4">
                    <span class="block text-sm text-gray-400 uppercase tracking-wider mb-2">Email</span>
                    <span class="font-semibold text-gray-900 text-lg">{{@$about->email}}</span>
                </div>
                <div class="p-4">
                    <span class="block text-sm text-gray-400 uppercase tracking-wider mb-2">Location</span>
                    <span class="font-semibold text-gray-900 text-lg">{{@$about->location}}</span>
                </div>
                <div class="p-4">
                    <span
                        class="block text-sm text-gray-400 uppercase tracking-wider mb-2">{{@$about->availability_status}}</span>
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            Open to work
                        </span>
                </div>
            </div>
        </div>
    </div>
</section> --}}
