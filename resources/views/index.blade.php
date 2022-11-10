@extends('layouts.app')

@section('content')

@include('layouts.message')

<div class="flex flex-wrap">



    @foreach ($pictures as $picture)
        <div class="w-4/12 lg:w-3/12 p-2">
            <div class="rounded overflow-hidden bg-white border border-gray-200 p-4">
                <img class="w-full h-full" width="400px" src="{{ asset('storage/' . $picture->file_path) }}">
                <p class="mt-2 text-gray-500">{{ $picture->name }}</p>
                <p class="mt-2 text-gray-500">{{ $picture->votes }} votes</p>
                <form action="{{ route('pictures.upvote', $picture->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="picture_id" value="{{ $picture->id }}">
                    <div class="text-right col-span-full mt-2">
                        <div class="inline-flex items-end">
                          <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded">Vote</button>
                        </div>
                      </div>
                </form>
            </div>
        </div>
    @endforeach

</div>

@endsection