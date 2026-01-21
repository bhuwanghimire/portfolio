<?php

use App\Models\Experience;
use Livewire\Component;
use Illuminate\Database\Eloquent\Collection;

new class extends Component {
    public Collection $experiences;

    public function mount(): void
    {
        $this->experiences = Experience::all();
    }
};
?>

<div>
    <h3 class="text-2xl font-bold text-gray-900 mb-8 flex items-center">
        <svg class="w-6 h-6 text-primary mr-2" fill="none" stroke="currentColor"
             viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
            </path>
        </svg>
        Experience
    </h3>
    <div class="border-l-2 border-primary/20 ml-3 space-y-12">
        @foreach($experiences as $experience)
            <div class="relative pl-8">
                <span
                    class="absolute -left-[9px] top-0 w-4 h-4 rounded-full bg-primary ring-4 ring-primaryLight"></span>
                <span class="text-sm text-primary font-bold bg-primaryLight/50 px-3 py-1 rounded-full">{{$experience->start_year}}- {{$experience->end_year}}</span>
                <h4 class="text-xl font-bold text-gray-900 mt-2">{{$experience->position}}</h4>
                <span class="text-gray-500 text-sm">{{$experience->company}}</span>
                <p class="text-gray-600 mt-2">{{$experience->description}}</p>
            </div>
        @endforeach


    </div>
</div>
