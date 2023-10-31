@extends('layout')

@section('content')

<div class="bg-white p-6 rounded-lg shadow-lg text-center">
    <h1 class="text-3xl font-semibold mb-4">{{ $job->title }}</h1>
    <p class="text-gray-600 mb-2">Company: {{ $job->company->name }}</p>
    <p class="text-gray-600 mb-2">Location: {{ $job->company->company_address }}</p>
    <p class="text-gray-600 mb-6">Posted on: {{ $job->created_at->format('F j, Y') }}</p>
    
    <h2 class="text-xl font-semibold mb-4">Job Description</h2>
    <p>{{ $job->description }}</p>
    
    <h2 class="text-xl font-semibold mt-8 mb-4">Tags</h2>
    <div class="flex flex-wrap justify-center">
        @foreach ($job->tags as $tag)
        <span class="inline-block bg-blue-500 text-white rounded-full px-3 py-1 text-xs font-semibold mr-2 mb-2">
                {{ $tag->name }}
            </span>
        @endforeach
    </div>
</div>

@endsection