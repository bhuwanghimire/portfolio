<?php

use App\Traits\WithToastr;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

new class extends Component {
    use WithToastr;
    use WithFileUploads;

    public $projects = [];
    public $editingProjectId = null;
    
    public $newProject = [
        'title' => '',
        'slug' => '',
        'description' => '',
        'technologies' => '',
        'link' => '',
        'github_link' => '',
        'is_featured' => true
    ];
    public $image; // Temporary file upload property

    public function mount()
    {
        $this->loadProjects();
    }

    function loadProjects()
    {
        $this->projects = \App\Models\Project::get()->toArray();
    }

    public function editProject($id)
    {
        $project = \App\Models\Project::findOrFail($id);
        $this->editingProjectId = $id;
        $this->newProject = [
            'title' => $project->title,
            'slug' => $project->slug,
            'description' => $project->description,
            'technologies' => $project->technologies,
            'link' => $project->link,
            'github_link' => $project->github_link,
            'is_featured' => $project->is_featured,
        ];
        $this->image = null; // Clear any previously set temporary upload
    }

    public function resetForm()
    {
        $this->editingProjectId = null;
        $this->newProject = [
            'title' => '',
            'slug' => '',
            'description' => '',
            'technologies' => '',
            'link' => '',
            'github_link' => '',
            'is_featured' => true
        ];
        $this->image = null;
    }

    public function saveProject()
    {
        $this->validate([
            'newProject.title' => 'required|string',
            'image' => 'nullable|image|max:2048'
        ]);

        $projectData = $this->newProject;

        if ($this->image) {
            $path = $this->image->store('projects', 'public');
            $projectData['image'] = '/storage/' . $path;
        }

        if ($this->editingProjectId) {
            \App\Models\Project::findOrFail($this->editingProjectId)->update($projectData);
            $this->toastSuccess('Project updated successfully!');
        } else {
            \App\Models\Project::create($projectData);
            $this->toastSuccess('Project added successfully!');
        }

        $this->resetForm();
        $this->loadProjects();
    }

    public function confirmDeleteProject($projectId)
    {
        $this->dispatch('swal:project', [
            'id' => $projectId,
            'title' => 'Are you sure?',
            'text' => "This project record will be permanently deleted!",
            'icon' => 'warning',
            'confirmButtonText' => 'Yes, delete it!',
            'cancelButtonText' => 'Cancel'
        ]);
    }

    #[On('removeProject')]
    public function removeProject($id)
    {
        \App\Models\Project::findOrFail($id)->delete();
        $this->loadProjects();

        $this->dispatch('toast', [
            'type' => 'success',
            'message' => 'Project deleted successfully!'
        ]);
    }
};
?>

<div>
    <div class="bg-white p-6 rounded-xl shadow-lg mb-6 border border-gray-100">
        <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center gap-2">
            💼 Projects
        </h2>

        @if(count($projects))
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                    <thead class="bg-indigo-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Image</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Project Title</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Technologies</th>
                        <th class="px-4 py-2 text-center text-sm font-semibold text-gray-700">Featured?</th>
                        <th class="px-4 py-2 text-center text-sm font-semibold text-gray-700">Action</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                    @foreach($projects as $proj)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-4 py-2">
                                @if($proj['image'])
                                    <img src="{{ asset($proj['image']) }}" class="h-12 w-16 object-cover rounded shadow-sm">
                                @else
                                    <span class="text-xs text-gray-400">No image</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 text-gray-800">
                                <div class="font-bold">{{ $proj['title'] }}</div>
                                <div class="text-xs text-gray-500">{{ $proj['slug'] ?? '' }}</div>
                            </td>
                            <td class="px-4 py-2 text-gray-600">{{ $proj['technologies'] }}</td>
                            <td class="px-4 py-2 text-center">
                                @if($proj['is_featured'])
                                    <span class="px-2 py-1 bg-green-100 text-green-700 text-xs rounded-full">Yes</span>
                                @else
                                    <span class="px-2 py-1 bg-gray-100 text-gray-600 text-xs rounded-full">No</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 text-center">
                                <div class="flex items-center justify-center gap-3">
                                    <button
                                        wire:click="editProject({{ $proj['id'] }})"
                                        class="text-blue-500 hover:text-blue-700 font-semibold">
                                        ✏️ Edit
                                    </button>
                                    <button
                                        wire:click="confirmDeleteProject({{ $proj['id'] }})"
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
                No projects added yet.
            </p>
        @endif

        <!-- ADD NEW PROJECT FORM -->
        <div class="mt-8 bg-gray-50 p-5 rounded-lg border">
            <h3 class="text-lg font-semibold text-gray-700 mb-3 block">
                {{ $editingProjectId ? 'Update Project' : 'Add New Project' }}
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium mb-1">Project Thumbnail</label>
                    @if ($image)
                        <img src="{{ $image->temporaryUrl() }}" class="h-32 object-cover rounded mb-2 shadow-sm">
                    @endif
                    <input type="file" wire:model="image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    <div wire:loading wire:target="image" class="text-xs text-indigo-500 mt-1">Uploading...</div>
                    @error('image') <span class="error text-xs text-red-500">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Title</label>
                    <input wire:model="newProject.title"
                           placeholder="e.g. E-Commerce Platform"
                           class="w-full border rounded-lg p-2 focus:ring focus:ring-indigo-200">
                    @error('newProject.title') <span class="error text-xs text-red-500">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Slug</label>
                    <input wire:model="newProject.slug"
                           placeholder="e.g. e-commerce-platform"
                           class="w-full border rounded-lg p-2 focus:ring focus:ring-indigo-200">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium mb-1">Technologies/Tags</label>
                    <input wire:model="newProject.technologies"
                           placeholder="e.g. React · Node.js · MongoDB"
                           class="w-full border rounded-lg p-2 focus:ring focus:ring-indigo-200">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Link / URL</label>
                    <input wire:model="newProject.link"
                           placeholder="e.g. https://myproject.com"
                           class="w-full border rounded-lg p-2 focus:ring focus:ring-indigo-200">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">GitHub Link</label>
                    <input wire:model="newProject.github_link"
                           placeholder="e.g. https://github.com/username/repo"
                           class="w-full border rounded-lg p-2 focus:ring focus:ring-indigo-200">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium mb-1">Description</label>
                    <textarea wire:model="newProject.description" rows="3"
                              placeholder="Describe your project"
                              class="w-full border rounded-lg p-2 focus:ring focus:ring-indigo-200"></textarea>
                </div>

                <div class="md:col-span-2 flex items-center gap-2">
                    <input type="checkbox" wire:model="newProject.is_featured" id="is_featured" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <label for="is_featured" class="text-sm font-medium text-gray-700">Display this in Featured Projects section</label>
                </div>
            </div>

            <div class="mt-4 text-right flex justify-end gap-2">
                @if($editingProjectId)
                    <button wire:click="resetForm"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-5 py-2 rounded-lg shadow">
                        Cancel
                    </button>
                @endif
                <button wire:click="saveProject"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg shadow disabled:opacity-50" wire:loading.attr="disabled" wire:target="saveProject, image">
                    {{ $editingProjectId ? '💾 Update Project' : '➕ Add Project' }}
                </button>
            </div>
        </div>

    </div>
</div>

{{-- 
Add JS to handle the SweetAlert delete confirmation. 
As per the app structure, "swal:project" triggers an event that we listen to. 
Typically this is handled globally in layout, but let's assume it's like all other components. 
--}}
<script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('swal:project', (event) => {
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
                    Livewire.dispatch('removeProject', { id: data.id });
                }
            })
        });
    });
</script>
