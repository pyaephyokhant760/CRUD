@extends('main')

@section('contact')
    <div class="container">
        <div class="col-6 offset-3 my-5">
            <div>
                <a href="{{ route('customer#page') }}">
                    <i class="fa-solid fa-backward my-3 text-black"></i>
                </a>
                <div class="row">
                    <h3 class="shadow-sm p-1">{{ $ppe[0]['title'] }}</h3>
                    <h5 class="shadow-sm py-1">{{ $ppe[0]['created_at']->format('j/m/Y') }}</h5>
                </div>
                <div class="d-flex">
                    <div class="btn btn-sm bg-dark text-white me-2 my-3">{{ $ppe[0]['address'] }}</div>
                    <div class="btn btn-sm bg-dark text-white me-2 my-3">{{ $ppe[0]['price'] }}</div>
                    <div class="btn btn-sm bg-dark text-white me-2 my-3">{{ $ppe[0]['range'] }}</div>
                </div>

                <div classR="">
                    @if ($ppe[0]['image'] == null)
                        <img src="{{ asset('images.png') }}" class="img-thumbnail my-4 shadow-sm">
                    @else
                        <img src="{{ asset('storage/' . $ppe[0]['image']) }}" alt="" class="img-thumbnail my-4 shadow-sm">
                    @endif
                </div>

                <div>
                    <p class="text muted shadow py-1 p-2">{{ $ppe[0]['description'] }}</p>
                </div>
            </div>
            <a href="{{ route('create#edit', $ppe[0]['id']) }}">
                <div class="my-2">
                    <button class="btn bg-black fload-end text-white">edit</button>
                </div>
            </a>
        </div>
    </div>
@endsection
