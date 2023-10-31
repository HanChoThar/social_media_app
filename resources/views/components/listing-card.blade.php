@props(['listing'])

<div class="bg-white rounded-lg shadow-md p-6">
    <h2 class="text-xl font-semibold">{{$listing->title}}</h2>
    <p class="text-gray-600">Company: {{$listing->company->name }}</p>
    <p class="text-gray-600">Location: {{$listing->company->company_address }}</p>
    @foreach ($listing->tags as $tag)
        <span class="inline-block bg-blue-500 text-white rounded-full px-3 py-1 text-xs font-semibold mr-2 mb-2 mt-2">
            {{ $tag->name }}
        </span>
    @endforeach
    <a href="{{ route('job.show', ['id' => $listing->id]) }}" class="block text-blue-500 hover:underline">Learn More</a>
</div>
