@extends('layout')

@section('content')

    @include('partials/_hero')
    @include('partials/_search')

    <section class="py-8">
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @unless (count($jobLists) == 0) 

            @foreach ($jobLists as $listing) 
                <x-listing-card :listing="$listing" />
            @endforeach

            @else
            <p class="text-xl text-gray-400">No Job Found..</p>
            @endunless
        </div>
    </section>
    
@endsection