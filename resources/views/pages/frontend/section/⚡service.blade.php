<?php

use Illuminate\Support\Collection;
use Livewire\Component;

new class extends Component {
    public Array $services;

    public function mount(): void
    {
        $this->loadServices();
    }

    public function loadServices(): void
    {
        $this->services = \App\Models\Service::orderBy('order')->status()->get()->toArray();
    }
};
?>

<section id="services" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-primary font-semibold tracking-wide uppercase">What I Do</span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2">My Services</h2>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Service 1 -->
            @foreach ($services as $service)
            <div
                class="p-8 rounded-2xl bg-gray-50 border border-gray-100 hover:border-primary/30 hover:shadow-xl hover:shadow-violet-100 transition duration-300 group">
                <div
                    class="w-14 h-14 bg-white rounded-xl shadow-sm flex items-center justify-center text-primary mb-6 group-hover:bg-primary group-hover:text-white transition">
                    <i class="{{$service['icon']}} text-2xl text-orange-500 mb-2 group-hover:scale-110 transition"></i>
{{--                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">--}}
{{--                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"--}}
{{--                              d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">--}}
{{--                        </path>--}}
{{--                    </svg>--}}
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">{{$service['title']}}</h3>
                <p class="text-gray-500">{{$service['description']}}</p>
            </div>
            @endforeach


        </div>
    </div>
</section>
