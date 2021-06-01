<?php

namespace App\Http\Controllers;

use Database\Factories\QuestionFactory;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Http\Resources\QuestionResource;

class QuestionController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::pimp()->paginate();

        QuestionResource::collection($questions);

        return $this->sendResponse(compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $question = Question::addUpdate(new Question, $request);

        $question = new QuestionResource($question);

        return $this->sendResponse(compact('question'), 'Questation Added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        $question = new QuestionResource($question);

        return $this->sendResponse(compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Question $question, Request $request)
    {
        $question = Question::addUpdate($question, $request);
        $question = new QuestionResource($question);

        return $this->sendResponse(compact('question'), 'Questation updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question  $question)
    {
        $question->delete();

        return $this->sendResponse(compact('question'), 'Question deleted.');
    }
}
