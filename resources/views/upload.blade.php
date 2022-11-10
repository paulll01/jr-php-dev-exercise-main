@extends('layouts.app')

@section('content')

@if ($errors->any())
    <div class="w-2/3 mx-auto p-3 bg-red-100 border border-red-400 text-red-700 rounded relative" role="alert">

        @foreach ($errors->all() as $error)
            <div>{{$error}}</div>
        @endforeach

    </div>
@endif

<div class="bg-white p-4 w-2/3 mx-auto">
    <h2 class="text-center text-2xl py-3">Upload your dog!</h2>
        <div class="container max-w-screen-lg mx-auto">
        <form action="{{route('pictures.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="bg-white rounded p-4 px-4 md:p-8 mb-6">
              <div class=" text-sm grid-cols-1 lg:grid-cols-3">
                <div class="gap-4 gap-y-2 text-sm grid-cols-2 items-center">
                    <div class="col-span-full">
                      <input type="text" name="name" id="name" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" placeholder="Dog Name" required/>
                    </div>
      
                    <div class="col-span-full my-2">
                        <div class="hidden flex items-center justify-center my-3 py-3" id="picture-container">
                            <img src="" alt="" class="h-32 w-32 rounded-full  border border-dashed p-2 object-contain" id="picture_img">
                        </div>
                        <label for="image" class="w-full flex items-center justify-center h-10 border mt-1 rounded px-4 w-full bg-gray-50 cursor-pointer">
                            <svg class="w-7 h-7 mx-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                            </svg>
                            <span>Upload dog picture</span>
                        </label>    
                        
                        <input type='file' class="hidden" name="image" id="image" onchange="createImage(event, this)"/>
                                           
                    </div>
            
                    <div class="text-right col-span-full mt-2">
                      <div class="inline-flex items-end">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
                      </div>
                    </div>
      
                  </div>
              </div>
            </div>
        </form>

      </div>
</div>
<script>

    function createImage(event ,file){

        const fileinput = file.files[0];
        var picture_img = document.getElementById('picture_img');
        var container = document.getElementById('picture-container');

        if(fileinput){
            picture_img.setAttribute('src',  URL.createObjectURL(fileinput));
        }
        container.classList.remove('hidden');

    }
</script>
@endsection