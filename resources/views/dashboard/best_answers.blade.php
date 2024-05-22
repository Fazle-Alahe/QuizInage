@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-6 m-auto">
            <a href="{{route('quiz.answers', $quiz->id)}}" class="btn btn-secondary mb-2">All Answers</a>
            <a href="" class="btn btn-secondary mb-2">Best Answers</a>
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
                            <th>Answer</th>
                            <th>Total Count</th>
                        </tr>
                        @foreach ($answers as $answer)
                        @php
                            $count = App\Models\Answer::where('quiz_id', $quiz->id)->where('answer', $answer->answer)->count();
                        @endphp
                            <tr>
                                <td>{{$answer->answer}}</td>
                                <td>{{$count}}</td>
                            </tr>                            
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection