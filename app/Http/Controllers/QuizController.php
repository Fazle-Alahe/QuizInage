<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Quiz;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class QuizController extends Controller
{
    function quiz_page(){
        $today = Quiz::where('created_at','>=', Carbon::today())->count();
        // echo ($today);
        return view('quiz.quiz_page', [
            'today' => $today,
        ]); 
    }

    function quiz_store(Request $request){
        $request->validate([
            'image1' => 'required',
            'image2' => 'required',
        ]);

        
        $image1 = $request->image1;
        $extension = $image1->extension();
        $photo_name1 = Str::lower(str_replace(' ','-', 'image1'.random_int(100000, 999999).'.'.$extension));
        Image::read($image1)->resize(500,500)->save(public_path('uploads/quiz/'.$photo_name1));


        $image2 = $request->image2;
        $extension = $image2->extension();
        $photo_name2 = Str::lower(str_replace(' ','-', 'image2'.random_int(100000, 999999).'.'.$extension));
        Image::read($image2)->resize(500,500)->save(public_path('uploads/quiz/'.$photo_name2));

        Quiz::insert([
            'image1' => $photo_name1,
            'image2' => $photo_name2,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('success', 'Quiz added successfully');
    }

    function quiz_participate(){
        $today = Quiz::where('created_at','>=', Carbon::today())->get();
        $ansr = Answer::where('user_id', Auth::user()->id)->where('created_at','>=', Carbon::today())->count();
        return view('quiz.quiz_participate', [
            'today' => $today,
            'ansr' => $ansr,
        ]);
    }

    function quiz_answer(Request $request, $id){
        
        foreach($request->answer as $answer){
            $ans = Str::of($answer)->wordCount();
            if($ans >1){
                return back()->with('word', 'Please input a single word ralated to avobe images.');
            }
            else{
                Answer::insert([
                    'quiz_id' => $id,
                    'user_id' => Auth::user()->id,
                    'name' => $request->name,
                    'answer' => $answer,
                    'created_at' => Carbon::now(),
                ]);
            }
        }
        return back()->with('success', "You've submitted quiz answer.");
    }

    function quiz_answers($id){
        $quiz = Quiz::find($id);
        $answers = Answer::where('quiz_id', $id)->paginate(10);
    
        return view('dashboard.all_answers',[
            'quiz' => $quiz,
            'answers' => $answers,
        ]);

        // foreach($answer as $ans){
        //     $count = Answer::where('quiz_id', $id)->where('answer', $ans->answer)->count();
        //     echo $count;
        // }
        // echo $answer;
    }

    function best_answers($id){
        $quiz = Quiz::find($id);
        $answers = Answer::where('quiz_id', $id)->select('answer')
        ->groupBy('answer')
        ->orderByRaw('COUNT(*) DESC')
        ->take(5)
        ->get();

        return view('dashboard.best_answers',[
            'quiz' => $quiz,
            'answers' => $answers,
        ]);
    }
}
