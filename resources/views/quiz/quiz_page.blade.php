@extends('layouts.admin')
@section('content')
@if (Auth::user()->role == 'admin')
    
@if ($today == 0)
<div class="row">
    <div class="col-lg-6 m-auto">
        <div class="card">
            <div class="card-header">
                <h3>Create Quiz</h3>
            </div>
            <form action="{{route('quiz.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    @if (session('success'))
                        <strong class="text-success">{{session('success')}}</strong>
                    @endif
                    <div class="row">
                        <div class="col-lg-6 text-center">
                            <img id="blah" width="250px" height="250px"  style="margin-bottom: 10px; background: rgb(171, 168, 168)"/>
                            <input class="img" name="image1" type="file" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                            @error('image1')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="col-lg-6 text-center">
                            <img id="blah1" width="250px" height="250px"  style="margin-bottom: 10px; background: rgb(171, 168, 168)"/>
                            <input class="img" name="image2" type="file" onchange="document.getElementById('blah1').src = window.URL.createObjectURL(this.files[0])">
                            @error('image2')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 my-3" style="margin-left: 150px">
                        <button type="submit" class="btn btn-dark w-100">Upload Images</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@else
    <h3 class="text-secondary text-center">You have already created a quiz today</h3>
@endif

{{-- role access else section --}}
@else

<h3 class="text-secondary text-center">You are not allowed to view this page. </h3>
@endif

@endsection