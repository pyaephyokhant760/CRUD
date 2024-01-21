@extends('main');

@section('contact')
    <div class="container">
        <div class="row">
            <div class="col-5">
                <div class="p-3">
                    @if (session('patten'))
                        <div>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>{{ session('patten') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    @if (session('data'))
                        <div>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('data') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    {{-- @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif --}}
                    <form action="{{ route('create#post') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="text-group mb-3">
                            <label for="">Post Title</label>
                            <input type="text" name="postTitle" id=""
                                class="form-control @error('postTitle') is-invalid @enderror" value="{{ old('postTitle') }}"
                                placeholder="Enter Post Title ...">
                            @error('postTitle')
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="text-group mb-3">
                            <label for="">Post Descirption</label>
                            <textarea name="postDescirption" id="" cols="30" rows="10"
                                class="form-control @error('postDescirption') is-invalid @enderror" placeholder="Enter Descirption . . . ">{{ old('postDescirption') }}</textarea>
                            @error('postDescirption')
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div>
                            <div class="mb-3">
                                <label>Image</label>
                                <input type="file" name="postImage" id="" placeholder="Image . . . . ." class="form-control @error('postImage') is-invalid @enderror" value="{{ old('postImage') }}">
                                    @error('postImage')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <label>Price</label>
                            <input type="number" name="postPrice" id="" placeholder="Price . . . . " class="form-control @error('postPrice') is-invalid @enderror" value="{{ old('postPrice') }}">
                                @error('postPrice')
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label>Address</label>
                            <input type="text" name="postAddress" id="" placeholder="Address . . . . ." class="form-control @error('postAddress') is-invalid @enderror"  value="{{ old('postAddress') }}">
                                @error('postAddress')
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label>Range</label>
                            <input type="text" name="postRange" id="" placeholder="Range . . . . " class="form-control @error('postRange') is-invalid @enderror" value="{{ old('postRange') }}">
                                @error('postRange')
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class=" mb-3">
                            <input type="submit" value="Create" class="btn btn-danger">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-7">
                <h3 class="mb-3">
                    <div class="row">
                        <div class="col-5">
                            Total - {{ $posts->total() }}
                        </div>
                        <div class="col-6 d-flex">
                            <form action="{{ route('customer#page') }}" method="GET">
                                <div class="row">
                                    <div class="col-8">
                                        <input type="text" name="searchKey" class="form-control"
                                            placeholder="Enter Search Key . . . " value="{{ request('searchKey') }}">
                                    </div>
                                    <div class="col-4">
                                        <button class=" btn btn-outline-danger  " type="submit">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </h3>
                <div class="data-container">
                    @if (count($posts) != 0)
                        @foreach ($posts as $item)
                            <div class="post p-3 shadow-sm mb-3">
                                <div class="row">
                                    <h3 class="col-7">{{ $item->title }}</h3>
                                    <h3 class="col-4 offset-1">{{ $item->created_at->format('j/m/Y') }}</h3>
                                </div>
                                {{-- <p class="text-muted">{{ substr($item['description'],0,10) }}</p> --}}
                                <p class="text-muted">{{ Str::words($item->description, 20, '...') }}</p>

                                <div class="text-end">
                                    {{-- <a href="{{ url('create/delete/' . $item['id']) }}">
                                    <button class="btn btn-sm btn-danger"><i
                                            class="fa-solid fa-trash-can"></i>ဖျက်ရန်</button>
                                    </a> --}}
                                    <div>
                                        <i class="fa-solid fa-location-arrow"></i>{{ $item->address }} |
                                        {{ $item->range }} |
                                        {{ $item->price }} Kyat

                                    </div>
                                    <form action="{{ route('create#delete', $item->id) }}" method="POST">
                                        @csrf
                                        @method('delete');
                                        <button class="btn btn-sm btn-danger"><i class="fa-solid fa-trash-can"></i>ဖျက်ရန်</button>
                                    </form>
                                    <a href="{{ route('create#update', $item->id) }}">
                                        <button class="btn btn-sm btn-success"><i class="fa-solid fa-file-invoice"></i>အသေးစိတ်ကြည့်ရန်</button>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                        @else
                        <h3 class="text-danger">This is no Data . . . . </h3>
                    @endif
                </div>
                {{ $posts->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
    {{-- @for ($i = 0; $i < count($posts); $i++)
                <div class="post p-3 shadow-sm mb-3">
                    <h3>{{$posts[$i]['title']}}</h3>
                    <p class="text-muted">{{$posts[$i]['description']}}</p>
                    <div class="text-end">
                        <button class="btn btn-sm btn-danger"><i class="fa-solid fa-trash-can"></i>ဖျက်ရန်</button>
                        <button class="btn btn-sm btn-success"><i class="fa-solid fa-file-invoice"></i>အသေးစိတ်ကြည့်ရန်</button>
                    </div>
                </div>
                @endfor --}}
@endsection
