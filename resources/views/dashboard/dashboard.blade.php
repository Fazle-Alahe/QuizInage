@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-8 m-auto">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Date</th>
                            <th>Total Answers</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($quizes as $quiz)
                        <tr>
                            <td>{{$quiz->created_at->toFormattedDateString()}}</td>
                            <td>{{$quiz->answer->count()}}</td>
                            <td><a href="{{route('quiz.answers', $quiz->id)}}" class="btn btn-info text-white">View Answers</a></td>
                        </tr>
                        @endforeach
                    </table>
                    {{$quizes->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection