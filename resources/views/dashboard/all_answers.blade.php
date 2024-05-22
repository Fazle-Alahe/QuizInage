@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-6 m-auto">
            <a href="" class="btn btn-secondary mb-2">All Answers</a>
            <a href="{{route('best.answers', $quiz->id)}}" class="btn btn-secondary mb-2">Best Answers</a>
            <div class="my-3">
                <strong>Game Date({{$quiz->created_at->toFormattedDateString()}})</strong>
            </div>
            <div class="card">
                <div class="card-header text-center">
                    <h3>All Answers</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>User Name</th>
                            <th>Answer</th>
                        </tr>
                        @foreach ($answers as $answer)
                            <tr>
                                <td>{{$answer->name}}</td>
                                <td>{{$answer->answer}}</td>
                            </tr>
                        @endforeach
                    </table>
                    {{$answers->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection