<div class="pt-4">
    <form wire:submit="update" class="bg-white dark:bg-slate-900 shadow-md rounded px-4 md:px-8 pt-6 pb-8 mb-4"
        method="post">
        <h3 class="mb-2 font-bold text-3xl dark:text-white text-blue-500">Course Edit</h3>
        <hr class="mb-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-3">
            <div class="mb-1">
                <label for="Name" class="my-label">Course Name</label>
                <input type="text" wire:model="name" placeholder="Course Name" id="name"
                    class="my-input focus:outline-none focus:shadow-outline">
                @if ($errors->has('name'))
                    <div class="text-red-500">{{ $errors->first('name') }}</div>
                @endif
            </div>
            <div class="mb-1">
                <label for="lecture" class="my-label">Lecture</label>
                <input type="number" wire:model="lecture" placeholder="Lecture" id="lecture" class="my-input focus:outline-none focus:shadow-outline appearance-none">
                @if ($errors->has('lecture'))
                    <div class="text-red-500">{{ $errors->first('lecture') }}</div>
                @endif
            </div>
            <div class="mb-1">
                <label for="project" class="my-label">Project</label>
                <input type="number" wire:model="project" placeholder="Project"
                    class="my-input focus:outline-none focus:shadow-outline appearance-none">
                @if ($errors->has('project'))
                    <div class="text-red-500">{{ $errors->first('project') }}</div>
                @endif
            </div>
            <div class="mb-1">
                <label for="exam" class="my-label">Exam</label>
                <input type="number" wire:model="exam" placeholder="Exam"
                    class="my-input focus:outline-none focus:shadow-outline appearance-none">
                @if ($errors->has('exam'))
                    <div class="text-red-500">{{ $errors->first('exam') }}</div>
                @endif
            </div>
            <div class="mb-1 col-span-2">
                <label for="description" class="my-label">Description</label>
                <textarea wire:model="description" placeholder="Description" class="my-input focus:outline-none focus:shadow-outline appearance-none" name="description" id="description" rows="3">
                </textarea>
                @if ($errors->has('description'))
                    <div class="text-red-500">{{ $errors->first('description') }}</div>
                @endif
            </div>
            <div class="mb-1 col-span-2">
                <label class="my-label pt-0" for="image">Thumbnail</label>
                <input wire:model="image" class="my-input focus:outline-none focus:shadow-outline appearance-none bg-white" id="image" type="file">
                <div wire:loading="" wire:target="image" class="text-green-500">
                    Uploading Image...
                </div>
                @if ($image)
                    <div>
                        <img width="80" class="mt-1" src="{{ $image->temporaryUrl() }}"
                            alt="">
                    </div>
                @else
                    <div>
                        <img width="80" class="mt-1" src="{{ asset('storage/' . $oldimage) }}"
                            alt="">
                    </div>
                @endif
                @if ($errors->has('image'))
                    <div class="text-red-500">{{ $errors->first('image') }}</div>
                @endif
            </div>
        </div>
        <div class="flex justify-end items-center mt-4">
            <a href="{{ route('course') }}"  class="btn-back btn ml-4">
                <span class="">Back</span>
            </a>
            <button type="submit" @if (!empty($update_id)) wire:target="update" @else wire:target="insert" @endif class="btn-submit btn ml-4" wire:loading.remove>Save</button>
            <button type="button" @if (!empty($update_id)) wire:target="update" @else wire:target="insert" @endif disabled class="btn-submit btn ml-4" wire:loading>Loading</button>
        </div>
    </form>
</div>
