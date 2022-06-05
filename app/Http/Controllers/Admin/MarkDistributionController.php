<?php

namespace App\Http\Controllers\Admin;

use App\Models\Chapter;
use App\Models\Subject;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\MarkDistribution;
use App\Http\Controllers\Controller;

class MarkDistributionController extends Controller
{
    public function index()
    {
        if ($error = $this->sendPermissionError('index')) {
            return $error;
        }
        $questions = Question::all();
        $subjects = Subject::all();
        $subjects = Subject::all();
        return view('admin.mark_distribution.index', compact('questions','subjects'));
    }



    public function show($subjectId)
    {
        $subject = Subject::find($subjectId);
        $chapters = Chapter::whereSubject_id($subjectId)->get();
        return view('admin.mark_distribution.show', compact('subject','chapters'));
    }

    public function create()
    {
        if ($error = $this->sendPermissionError('create')) {
            return $error;
        }
        $questions = Question::all();
        $subjects = Subject::all();
        return view('admin.mark_distribution.create', compact('questions','subjects'));
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'subject_id' => 'required|integer',
        //     'chapter_id' => 'required|integer',
        //     // 'type' => 'required',
        //     // 'mark' => 'required',
        //     'multiple' => 'nullable',
        //     'sort' => 'nullable',
        //     'long' => 'nullable',
        // ]);
        foreach($request->chapter_id as $k => $v) {
            $data=[
                'user_id' => auth()->user()->id,
                'subject_id' => $request->subject_id,
                'chapter_id' => $request->chapter_id[$k],
                'multiple' => $request->multiple[$k],
                'sort' => $request->sort[$k],
                'long' => $request->long[$k],
            ];
            MarkDistribution::create($data);
        }

        try {

            toast('Success!', 'success');
            return redirect()->route('admin.markDistribution.index');
        } catch (\Exception $ex) {
            return $ex->getMessage();
            toast('Error', 'error');
            // return back();
        }
    }

    public function getMarkInfo(Request $request)
    {
        if ($request->ajax()) {
            $markDistribution = MarkDistribution::whereChapter_id($request->id)->whereSubject_id($request->subjectId)->get();
            return response()->json(['markDistribution'=>$markDistribution,'status'=>200]);
        }
    }
}
