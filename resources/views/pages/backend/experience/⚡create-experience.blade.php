<?php

use App\Traits\WithToastr;
use Livewire\Attributes\On;
use Livewire\Component;


new class extends Component {
    use WithToastr;

    public $experiences = [];

    public $newExperience = [
        'position' => '',
        'company' => '',
        'start_year' => '',
        'end_year' => '',
        'description' => ''
    ];

    public function mount()
    {
        $this->loadExperience();
    }

    function loadExperience()
    {
        $this->experiences = \App\Models\Experience::get()->toArray();
    }

    public function addExperience()
    {
        \App\Models\Experience::create($this->newExperience);

        $this->newExperience = [
            'position' => '',
            'company' => '',
            'start_year' => '',
            'end_year' => '',
            'description' => ''
        ];

        $this->loadExperience();
        $this->toastSuccess('Experience added successfully!');
    }

    public function confirmDeleteExperience($id)
    {
        $this->dispatch('swal:experience', [
            'id' => $id,
            'title' => 'Are you sure?',
            'text' => "This experience record will be permanently deleted!",
            'icon' => 'warning',
            'confirmButtonText' => 'Yes, delete it!',
            'cancelButtonText' => 'Cancel'
        ]);
    }

    #[On('removeExperience')]
    public function removeExperience($id)
    {
        \App\Models\Experience::findOrFail($id)->delete();

        $this->loadExperience();

        $this->dispatch('toast', [
            'type' => 'success',
            'message' => 'Experience deleted successfully!'
        ]);
    }
};
?>

<div>
    <div class="bg-white p-6 rounded-xl shadow-lg mb-6 border border-gray-100">
        <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center gap-2">
            💼 Experience
        </h2>

        @if(count($experiences))
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                    <thead class="bg-green-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Position</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Company</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Start Year</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">End Year</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Description</th>
                        <th class="px-4 py-2 text-center text-sm font-semibold text-gray-700">Action</th>
                    </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                    @foreach($experiences as $exp)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-4 py-2">{{ $exp['position'] }}</td>
                            <td class="px-4 py-2">{{ $exp['company'] }}</td>
                            <td class="px-4 py-2">{{ $exp['start_year'] }}</td>
                            <td class="px-4 py-2">{{ $exp['end_year'] ?? 'Present' }}</td>
                            <td class="px-4 py-2">{{ $exp['description'] }}</td>

                            <td class="px-4 py-2 text-center">
                                <button
                                    wire:click="confirmDeleteExperience({{ $exp['id'] }})"
                                    class="text-red-500 hover:text-red-700 font-semibold">
                                    🗑 Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-500 text-sm italic">
                No experience details added yet.
            </p>
        @endif



        <!-- ADD NEW EXPERIENCE FORM -->
        <div class="mt-8 bg-gray-50 p-5 rounded-lg border">
            <h3 class="text-lg font-semibold text-gray-700 mb-3">
                Add New Experience
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Position</label>
                    <input wire:model="newExperience.position"
                           class="w-full border rounded-lg p-2">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Company</label>
                    <input wire:model="newExperience.company"
                           class="w-full border rounded-lg p-2">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Start Year</label>
                    <input wire:model="newExperience.start_year"
                           class="w-full border rounded-lg p-2">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">End Year</label>
                    <input wire:model="newExperience.end_year"
                           class="w-full border rounded-lg p-2">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium mb-1">Description</label>
                    <textarea wire:model="newExperience.description"
                              class="w-full border rounded-lg p-2">
                    </textarea>
                </div>
            </div>

            <div class="mt-4 text-right">
                <button wire:click="addExperience"
                        class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg shadow">
                    ➕ Add Experience
                </button>
            </div>
        </div>

    </div>
</div>
<script></script>

