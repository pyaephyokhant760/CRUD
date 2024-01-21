@extends('main')

@section('contact')
    <div class="container">
        <h1>Edit Page</h1>
        <div class="col-6 offset-3 my-5">
            <div>
                <a href="{{ route('customer#page', $ppe[0]['id']) }}">
                    <i class="fa-solid fa-backward my-3 text-black"></i>
                </a>
                {{-- <h3 class="shadow-sm p-1">{{ $ppe[0]['title'] }}</h3>
                <p class="text muted shadow-sm">{{ $ppe[0]['description'] }}</p> --}}

                <form action="{{ route('create#update#data') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="postid" id="" value="{{ $ppe[0]['id'] }}">

                    <input type="text" name="postTitle" class="form-control my-2 @error('postTitle') is-invalid @enderror shadow" value="{{ old('postTitle', $ppe[0]['title']) }}">
                    @error('postTitle')
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="">
                        @if ($ppe[0]['image'] == null)
                            <img src="{{ asset('images.png') }}" class="img-thumbnail mt-4 shadow-sm">
                        @else
                            <img src="{{ asset('storage/' . $ppe[0]['image']) }}" alt="" class="img-thumbnail my-4 shadow-sm">
                        @endif
                        <input type="file" name="Image" id="" placeholder="Image . . . . ." class="form-control shadow @error('postImage') is-invalid @enderror" value="{{ old('postImage') }}">
                            @error('postImage')
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                    </div>
                    <textarea name="postDescirption" id="" cols="30" rows="10" class="form-control mt-4 shadow @error('postDescirption') is-invalid @enderror"> {{ old('postDescirption', $ppe[0]['description']) }}</textarea>
                        @error('postDescirption')
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    <div class="py-3">
                        <label>Price</label>
                        <input type="text" name="postPrice" class="form-control my-2 shadow" value="{{ old('postPrice', $ppe[0]['price']) }}">
                    </div>
                    <div class="py-3">
                        <label>Address</label>
                        <input type="text" name="postAddress" class="form-control my-2 shadow" value="{{ old('postAddress', $ppe[0]['address']) }}">
                    </div>
                    <div class="py-3">
                        <label>Range</label>
                        <input type="number" name="postRange" class="form-control my-2 shadow" value="{{ old('postRange', $ppe[0]['range']) }}">
                    </div>
                    <div class="my-2">
                        <button class="btn bg-black fload-end text-white fload-end">Update</button>
                    </div>
                </form>
            </div>

        </div>

    </div>
@endsection
