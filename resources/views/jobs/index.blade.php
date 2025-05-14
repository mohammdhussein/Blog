<x-layout>
    <x-slot:heading>
        Jobs Listing
    </x-slot:heading>
    @foreach($jobs as $job)
        <ul class="">
            <a href="jobs/{{$job['id']}}" class="block border px-4 py-6 border-b-gray-100 rounded-lg">
                <div class="font-bold text-blue-500 text-sm">
                    {{$job->employer->name}}
                </div>

                <div><strong><?php echo $job['title'] ?></strong>:pays <?php echo $job['salary'] ?> per year.</div>
            </a>
        </ul>
    @endforeach
    <div>
        {{$jobs->links()}}
    </div>
</x-layout>
