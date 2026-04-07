<?php

use Illuminate\Support\Collection;
use Livewire\Component;

new class extends Component {
    public array $services;

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

@php
    $themes = [
        [
            'bg' => 'bg-indigo-50',
            'border' => 'border-indigo-100',
        ],
        [
            'bg' => 'bg-cyan-50',
            'border' => 'border-cyan-100',
        ],
        [
            'bg' => 'bg-violet-50',
            'border' => 'border-violet-100',
        ],
        [
            'bg' => 'bg-amber-50',
            'border' => 'border-amber-100',
        ],
    ];
@endphp

<!-- ========= SERVICES ========= -->
<section class="bg-white py-24">
    <div class="max-w-6xl mx-auto px-6">
        <div class="text-center mb-14">
            <span class="section-tag">What I Offer</span>
            <h2 class="text-4xl font-bold text-dark mt-2 mb-3">Services</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-5">

            @foreach ($services as $index => $service)
                @php
                    $theme = $themes[$index % count($themes)];
                @endphp
                <div
                    class="p-6 rounded-2xl {{ $theme['bg'] }} border {{ $theme['border'] }} card-hover text-center cursor-pointer">
                    <div class="text-4xl mb-4"><i class="{{ $service['icon'] }}"></i></div>
                    <h3 class="font-bold text-dark mb-2">{{ $service['title'] }}</h3>
                    <p class="text-sm text-gray-500">{{ $service['description'] }}</p>
                    </p>
                </div>
            @endforeach


        </div>
    </div>
</section>
