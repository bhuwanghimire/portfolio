<?php

use Livewire\Component;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Experience;

new class extends Component {
    public Collection $experiences;

    public function mount(): void
    {
        $this->experiences = Experience::all();

        $this->colors = [
            '#06B6D4', // cyan
            '#F59E0B', // amber
            '#8B5CF6', // violet
            '#10B981', // green
            '#EF4444', // red
        ];
    }
};
?>


<!-- ── LEFT: EXPERIENCE ── -->
<div>
    <div class="flex items-center gap-3 mb-8">
        <div class="w-9 h-9 bg-primary rounded-xl flex items-center justify-center text-white text-lg">
            💼</div>
        <h3 class="text-xl font-bold text-dark">Experience</h3>
    </div>
    <div class="relative">
        <div class="absolute left-[6px] top-2 bottom-2 w-0.5 bg-gradient-to-b from-primary via-accent to-indigo-200">
        </div>
        <div class="space-y-7">
            @foreach ($experiences as $index => $experience)
                @php
                    $color = $this->colors[$index % count($this->colors)];
                @endphp

                <div class="flex gap-5 items-start">

                    <div class="timeline-dot shrink-0 mt-1"
                        style="background:{{ $color }}; box-shadow:0 0 0 3px {{ $color }}">
                    </div>

                    <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 flex-1 card-hover">

                        <div class="flex items-start justify-between gap-2 mb-1">
                            <h4 class="font-bold text-dark text-sm">
                                {{ $experience->position }}
                            </h4>

                            @if (is_null($experience->end_year))
                                <span class="text-xs text-white px-2 py-0.5 rounded-full shrink-0"
                                    style="background:{{ $color }}">
                                    Current
                                </span>
                            @endif
                        </div>

                        <p class="text-sm font-medium mb-1" style="color:{{ $color }}">
                            {{ $experience->company }}
                        </p>

                        <p class="text-xs text-gray-400 mb-2">
                            📅 {{ $experience->start_year }} - {{ $experience->end_year ?? 'Present' }} · Kathmandu
                        </p>

                        <p class="text-xs text-gray-500 leading-relaxed">
                            {{ $experience->description }}
                        </p>

                    </div>
                </div>
            @endforeach


        </div>
    </div>
</div>
