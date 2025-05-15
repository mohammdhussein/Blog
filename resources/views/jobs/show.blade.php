<x-layout>
    <x-slot:heading>
        Job
    </x-slot:heading>
    <h2 class="font-bold text-lg ">{{$job->title}}</h2>
    <p class="pb-5">this job pays {{$job->salary}} per year.</p>
    @can('edit',$job)
        <x-button href="/blog/public/jobs/{{$job->id}}/edit">Edit Job</x-button>
    @endcan
</x-layout>
