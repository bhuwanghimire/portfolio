<?php

use Livewire\Component;
use Illuminate\Database\Eloquent\Collection;

new class extends Component {
    public Collection $educations;

    public function mount(): void
    {
        $this->educations = \App\Models\Education::all();
        $this->colors = [
            '#8B5CF6', // violet
            '#A78BFA', // light violet
            '#EC4899', // pink
            '#10B981', // green
            '#F59E0B', // yellow
        ];
    }
};
?>

<!-- ── RIGHT: EDUCATION ── -->
<div>
    <div class="flex items-center gap-3 mb-8">
        <div class="w-9 h-9 bg-violet-600 rounded-xl flex items-center justify-center text-white text-lg">
            🎓</div>
        <h3 class="text-xl font-bold text-dark">Education</h3>
    </div>
    <div class="relative">
        <div
            class="absolute left-[6px] top-2 bottom-2 w-0.5 bg-gradient-to-b from-violet-500 via-purple-400 to-violet-200">
        </div>
        <div class="space-y-7">

            @forelse($educations as $index => $education)
                @php
                    $color = $this->colors[$index % count($this->colors)];
                @endphp

                <div class="flex gap-5 items-start">
                    <div class="timeline-dot shrink-0 mt-1"
                        style="background:{{ $color }}; box-shadow:0 0 0 3px {{ $color }}">
                    </div>

                    <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 flex-1 card-hover">
                        <h4 class="font-bold text-dark text-sm mb-1">{{ $education->degree }}</h4>
                        <p class="text-sm font-medium mb-1" style="color:{{ $color }}">
                            {{ $education->institution }}
                        </p>
                        <p class="text-xs text-gray-400 mb-2">
                            📅 {{ $education->start_year }} - {{ $education->end_year }} · Kathmandu
                        </p>
                        <p class="text-xs text-gray-500 leading-relaxed">
                            {{ $education->description }}
                        </p>
                    </div>
                </div>

            @empty
                <p>No education found</p>
            @endforelse
        </div>
    </div>
</div>
