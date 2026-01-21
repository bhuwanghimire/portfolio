<?php

use Livewire\Component;
use Illuminate\Database\Eloquent\Collection;

new class extends Component {
    public Collection $educations;

    public function mount(): void
    {
        $this->educations = \App\Models\Education::all();
    }
};
?>

<div>
    <h3 class="text-2xl font-bold text-gray-900 mb-8 flex items-center">
        <svg class="w-6 h-6 text-primary mr-2" fill="none" stroke="currentColor"
             viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 14l9-5-9-5-9 5 9 5z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z">
            </path>
        </svg>
        Education
    </h3>
    <div class="border-l-2 border-primary/20 ml-3 space-y-12">
      @forelse($educations as $education)
            <div class="relative pl-8">
                            <span
                                class="absolute -left-[9px] top-0 w-4 h-4 rounded-full bg-primary ring-4 ring-primaryLight"></span>
                <span class="text-sm text-primary font-bold bg-primaryLight/50 px-3 py-1 rounded-full">{{$education->start_year}}
                                - {{$education->end_year}}</span>
                <h4 class="text-xl font-bold text-gray-900 mt-2">{{$education->degree}}</h4>
                <span class="text-gray-500 text-sm">{{$education->institution}}</span>
                <p class="text-gray-600 mt-2">{{$education->description}}</p>
            </div>

        @empty
        @endforelse
    </div>
</div>
