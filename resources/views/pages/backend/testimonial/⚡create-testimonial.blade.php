<?php

use App\Traits\WithToastr;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

new class extends Component {
    use WithToastr;
    use WithFileUploads;

    public $testimonials = [];
    public $editingTestimonialId = null;
    
    public $newTestimonial = [
        'client_name' => '',
        'client_designation' => '',
        'review' => '',
        'rating' => 5
    ];
    public $avatar; // Temporary file upload property

    public function mount()
    {
        $this->loadTestimonials();
    }

    function loadTestimonials()
    {
        $this->testimonials = \App\Models\Testimonial::get()->toArray();
    }

    public function editTestimonial($id)
    {
        $testimonial = \App\Models\Testimonial::findOrFail($id);
        $this->editingTestimonialId = $id;
        $this->newTestimonial = [
            'client_name' => $testimonial->client_name,
            'client_designation' => $testimonial->client_designation,
            'review' => $testimonial->review,
            'rating' => $testimonial->rating,
        ];
        $this->avatar = null; 
    }

    public function resetForm()
    {
        $this->editingTestimonialId = null;
        $this->newTestimonial = [
            'client_name' => '',
            'client_designation' => '',
            'review' => '',
            'rating' => 5
        ];
        $this->avatar = null;
    }

    public function saveTestimonial()
    {
        $this->validate([
            'newTestimonial.client_name' => 'required|string',
            'newTestimonial.review' => 'required|string',
            'newTestimonial.rating' => 'required|integer|min:1|max:5',
            'avatar' => 'nullable|image|max:2048'
        ]);

        $testimonialData = $this->newTestimonial;

        if ($this->avatar) {
            $path = $this->avatar->store('testimonials', 'public');
            $testimonialData['avatar'] = '/storage/' . $path;
        }

        if ($this->editingTestimonialId) {
            \App\Models\Testimonial::findOrFail($this->editingTestimonialId)->update($testimonialData);
            $this->toastSuccess('Testimonial updated successfully!');
        } else {
            \App\Models\Testimonial::create($testimonialData);
            $this->toastSuccess('Testimonial added successfully!');
        }

        $this->resetForm();
        $this->loadTestimonials();
    }

    public function confirmDeleteTestimonial($testimonialId)
    {
        $this->dispatch('swal:testimonial', [
            'id' => $testimonialId,
            'title' => 'Are you sure?',
            'text' => "This testimonial record will be permanently deleted!",
            'icon' => 'warning',
            'confirmButtonText' => 'Yes, delete it!',
            'cancelButtonText' => 'Cancel'
        ]);
    }

    #[On('removeTestimonial')]
    public function removeTestimonial($id)
    {
        \App\Models\Testimonial::findOrFail($id)->delete();
        $this->loadTestimonials();

        $this->dispatch('toast', [
            'type' => 'success',
            'message' => 'Testimonial deleted successfully!'
        ]);
    }
};
?>

<div>
    <div class="bg-white p-6 rounded-xl shadow-lg mb-6 border border-gray-100">
        <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center gap-2">
            💬 Testimonials
        </h2>

        @if(count($testimonials))
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                    <thead class="bg-indigo-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Avatar</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Client Name</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Designation</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Rating</th>
                        <th class="px-4 py-2 text-center text-sm font-semibold text-gray-700">Action</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                    @foreach($testimonials as $testi)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-4 py-2">
                                @if($testi['avatar'])
                                    <img src="{{ asset($testi['avatar']) }}" class="h-12 w-12 object-cover rounded-full shadow-sm">
                                @else
                                    <span class="text-xs text-gray-400">None</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 text-gray-800 font-bold">{{ $testi['client_name'] }}</td>
                            <td class="px-4 py-2 text-gray-600">{{ $testi['client_designation'] }}</td>
                            <td class="px-4 py-2 text-yellow-500">
                                {{ str_repeat('★', $testi['rating']) }}{{ str_repeat('☆', 5 - $testi['rating']) }}
                            </td>
                            <td class="px-4 py-2 text-center">
                                <div class="flex items-center justify-center gap-3">
                                    <button
                                        wire:click="editTestimonial({{ $testi['id'] }})"
                                        class="text-blue-500 hover:text-blue-700 font-semibold">
                                        ✏️ Edit
                                    </button>
                                    <button
                                        wire:click="confirmDeleteTestimonial({{ $testi['id'] }})"
                                        class="text-red-500 hover:text-red-700 font-semibold">
                                        🗑 Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-500 text-sm italic">
                No testimonials added yet.
            </p>
        @endif

        <!-- ADD/EDIT TESTIMONIAL FORM -->
        <div class="mt-8 bg-gray-50 p-5 rounded-lg border">
            <h3 class="text-lg font-semibold text-gray-700 mb-3 block">
                {{ $editingTestimonialId ? 'Update Testimonial' : 'Add New Testimonial' }}
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium mb-1">Client Avatar</label>
                    @if ($avatar)
                        <img src="{{ $avatar->temporaryUrl() }}" class="h-24 w-24 object-cover rounded-full mb-2 shadow-sm border-2 border-indigo-200">
                    @endif
                    <input type="file" wire:model="avatar" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    <div wire:loading wire:target="avatar" class="text-xs text-indigo-500 mt-1">Uploading...</div>
                    @error('avatar') <span class="error text-xs text-red-500">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Client Name <span class="text-red-500">*</span></label>
                    <input wire:model="newTestimonial.client_name"
                           placeholder="e.g. Sarah Johnson"
                           class="w-full border rounded-lg p-2 focus:ring focus:ring-indigo-200">
                    @error('newTestimonial.client_name') <span class="error text-xs text-red-500">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Client Designation</label>
                    <input wire:model="newTestimonial.client_designation"
                           placeholder="e.g. CEO, TechStart Inc."
                           class="w-full border rounded-lg p-2 focus:ring focus:ring-indigo-200">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium mb-1">Review (Testimonial Text) <span class="text-red-500">*</span></label>
                    <textarea wire:model="newTestimonial.review" rows="3"
                              placeholder="Write the exact quote from the client..."
                              class="w-full border rounded-lg p-2 focus:ring focus:ring-indigo-200"></textarea>
                    @error('newTestimonial.review') <span class="error text-xs text-red-500">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Rating (1-5) <span class="text-red-500">*</span></label>
                    <input type="number" min="1" max="5" wire:model="newTestimonial.rating"
                           class="border rounded-lg p-2 focus:ring focus:ring-indigo-200 w-32">
                    @error('newTestimonial.rating') <span class="error text-xs text-red-500">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mt-4 text-right flex justify-end gap-2">
                @if($editingTestimonialId)
                    <button wire:click="resetForm"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-5 py-2 rounded-lg shadow">
                        Cancel
                    </button>
                @endif
                <button wire:click="saveTestimonial"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg shadow disabled:opacity-50" wire:loading.attr="disabled" wire:target="saveTestimonial, avatar">
                    {{ $editingTestimonialId ? '💾 Update Testimonial' : '➕ Add Testimonial' }}
                </button>
            </div>
        </div>

    </div>
</div>

<script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('swal:testimonial', (event) => {
            let data = event[0]; 
            Swal.fire({
                title: data.title,
                text: data.text,
                icon: data.icon,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: data.confirmButtonText,
                cancelButtonText: data.cancelButtonText
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('removeTestimonial', { id: data.id });
                }
            })
        });
    });
</script>
