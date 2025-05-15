<x-layout>
    <x-slot:heading>
        Create Job
    </x-slot:heading>
    <form method="POST" action="/blog/public/jobs">
        @csrf
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                    <h2 class="text-base/7 font-semibold text-gray-900">Create New Job</h2>
                    <p class="mt-1 text-sm/6 text-gray-600">This information will be displayed publicly so be careful
                        what
                        you share.</p>

                    <x-form-feild>
                        <x-form-label for="title">Title</x-form-label>
                        <div class="mt-2">
                            <x-form-input name="title" id="title" placeholder="CEO" required></x-form-input>

                            <x-form-error name='title'/>
                        </div>
                    </x-form-feild>

                    <x-form-feild>
                        <x-form-label for="salary">Salary</x-form-label>
                        <div class="mt-2">
                            <x-form-input name="salary" id="salary" placeholder="$50,000" required></x-form-input>

                            <x-form-error name='salary'/>
                        </div>
                    </x-form-feild>
                </div>
            </div>
        </div>
        <div class="mt-6 flex items-center justify-end gap-x-6">
            <button type="button" class="text-sm/6 font-semibold text-gray-900">Cancel</button>
            <x-form-button>Save</x-form-button>
        </div>
    </form>

</x-layout>
