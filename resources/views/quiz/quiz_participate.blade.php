@extends('layouts.admin')
@section('content')
@if ($ansr == 0)
<div class="row">
    <div class="col-lg-6 m-auto">
        <h3 class="text-secondary mb-5">Quiz time will end at 11:59pm</h3>
        <div class="card">
            <div class="card-header">
                <h3>Attend To Quiz</h3>
            </div>
            @forelse ($today as $todays)
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 text-center">
                        <img src="{{asset('uploads/quiz')}}/{{$todays->image1}}" height="250px" width="250px" style="margin-bottom: 10px; background: rgb(171, 168, 168)"/>
                    </div>
                    <div class="col-lg-6 text-center">
                        <img src="{{asset('uploads/quiz')}}/{{$todays->image2}}" height="250px" width="250px" style="margin-bottom: 10px; background: rgb(171, 168, 168)"/>
                    </div>
                </div>
                <div class="ms-5">
                    <strong>Submit your answers(Max 5 attempts)</strong>
                </div>
                @if (session('success'))
                <div class="text-center">
                    <strong class="text-success">{{session('success')}}</strong>
                </div>
                @endif
            </div>
            <form action="{{route('quiz.answer', $todays->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="field_wrapper">
                    <div class="text-center my-3">
                        <input class="inp" type="text" name="name" placeholder="A Fun User Name" required/>
                    </div>
                    <div class="text-center my-1">
                        <span class="text-center">Press the plus icon to add more words.</span>
                    </div>
                    <div class="text-center">
                        <input class="inp" type="text" name="answer[]" placeholder="Enter a single word" required/>
                        <a href="javascript:void(0);" class="add_button" title="Add field"><i class="fa fa-plus position-absolute picon"></i></a>
                    </div>

                    @if (session('word'))
                    <div class="my-2 text-center">
                        <strong class="text-danger">{{session('word')}}</strong>
                    </div>
                    @endif
                </div>
                <div class="my-2 text-center">
                    <button type="submit" class="btn btn-dark w-25">Submit</button>
                </div>
            </form>
            @empty
                <h3 class="text-secondary">Quiz hasn't started yet.</h3>
            @endforelse
        </div>
    </div>
</div>
@else
    <h3 class="text-secondary text-center">You have already submitted today's quiz answer.</h3>
@endif
@endsection
@section('footer_script')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script>

    $(document).ready(function(){
        var maxField = 5; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML = '<div class="text-center my-3"><input class="inp" type="text" name="answer[]" placeholder="Enter a single word" required/><a href="javascript:void(0);" class="remove_button"><i class="fa fa-trash position-absolute dicon"></i></a></div>'; //New input field html 
        var x = 1; //Initial field counter is 1
        
        // Once add button is clicked
        $(addButton).click(function(){
            //Check maximum number of input fields
            if(x < maxField){ 
                x++; //Increase field counter
                $(wrapper).append(fieldHTML); //Add field html
            }else{
                alert('A maximum of '+maxField+' fields are allowed to be added. ');
            }
        });
        
        // Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function(e){
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrease field counter
        });
    });
</script>
@endsection