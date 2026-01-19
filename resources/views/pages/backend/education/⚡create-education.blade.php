<?php

use App\Traits\WithToastr;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {
    use WithToastr;

    public function mount()
    {
        $this->educations = \App\Models\Education::get()->toArray();

    }

    public $educations = [];
    public $newEducation = [
        'degree' => '',
        'institution' => '',
        'start_year' => '',
        'end_year' => '',
        'description' => ''
    ];


    function loadProfile()
    {
        $this->educations = \App\Models\Education::get()->toArray();

    }

    public function addEducation()
    {

        \App\Models\Education::create($this->newEducation);

        $this->newEducation = [
            'degree' => '',
            'institution' => '',
            'start_year' => '',
            'end_year' => '',
            'description' => ''
        ];

        $this->loadProfile();
        $this->toastSuccess('Profile updated successfully!');

    }


    public function confirmDeleteEducation($educationId)
    {

        $this->dispatch('swal:education', [
            'id' => $educationId,
            'title' => 'Are you sure?',
            'text' => "This education record will be permanently deleted!",
            'icon' => 'warning',
            'confirmButtonText' => 'Yes, delete it!',
            'cancelButtonText' => 'Cancel'
        ]);
    }

    #[On('removeEducation')]
    public function removeEducation($id)
    {
        \App\Models\Education::findOrFail($id)->delete();
        $this->loadProfile();

        $this->dispatch('toast', [
            'type' => 'success',
            'message' => 'Education deleted successfully!'
        ]);
    }


};
?>

<div>
    <div class="bg-white p-6 rounded-xl shadow-lg mb-6 border border-gray-100">
        <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center gap-2">
            🎓 Education
        </h2>

        @if(count($educations))
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                    <thead class="bg-indigo-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Degree</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Institution</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Start Year</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">End Year</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Description</th>
                        <th class="px-4 py-2 text-center text-sm font-semibold text-gray-700">Action</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                    @foreach($educations as $edu)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-4 py-2 text-gray-800">{{ $edu['degree'] }}</td>
                            <td class="px-4 py-2 text-gray-700">{{ $edu['institution'] }}</td>
                            <td class="px-4 py-2 text-gray-600">{{ $edu['start_year'] }}</td>
                            <td class="px-4 py-2 text-gray-600">{{ $edu['end_year'] ?? 'Present' }}</td>
                            <td class="px-4 py-2 text-gray-600">{{ $edu['description'] }}</td>
                            <td class="px-4 py-2 text-center">
                                <button
                                    wire:click="confirmDeleteEducation({{ $edu['id'] }})"
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
                No education details added yet.
            </p>
        @endif



        <!-- ADD NEW EDUCATION FORM -->
        <div class="mt-8 bg-gray-50 p-5 rounded-lg border">
            <h3 class="text-lg font-semibold text-gray-700 mb-3">
                Add New Education
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Degree</label>
                    <input wire:model="newEducation.degree"
                           placeholder="e.g. Bachelor in Computer Science"
                           class="w-full border rounded-lg p-2 focus:ring focus:ring-indigo-200">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Institution</label>
                    <input wire:model="newEducation.institution"
                           placeholder="University or College Name"
                           class="w-full border rounded-lg p-2 focus:ring focus:ring-indigo-200">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Start Year</label>
                    <input wire:model="newEducation.start_year"
                           placeholder="2018"
                           class="w-full border rounded-lg p-2 focus:ring focus:ring-indigo-200">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">End Year</label>
                    <input wire:model="newEducation.end_year"
                           placeholder="2022 or leave blank"
                           class="w-full border rounded-lg p-2 focus:ring focus:ring-indigo-200">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium mb-1">Description</label>
                    <textarea wire:model="newEducation.description"
                              placeholder="Short details about your studies"
                              class="w-full border rounded-lg p-2 focus:ring focus:ring-indigo-200">
                    </textarea>
                </div>
            </div>

            <div class="mt-4 text-right">
                <button wire:click="addEducation"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg shadow">
                    ➕ Add Education
                </button>
            </div>
        </div>

    </div>
</div>


<script>

</script>
