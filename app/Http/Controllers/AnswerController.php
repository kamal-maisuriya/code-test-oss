<?php

namespace App\Http\Controllers;

use Database\Factories\QuestionFactory;
use Illuminate\Http\Request;
use App\Models\Answer;
use App\Http\Resources\AnswerResource;

class AnswerController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $answers = Answer::paginate();

        AnswerResource::collection($answers);

        return $this->sendResponse(compact('answers'));
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
        $answer = Answer::addUpdate(new Answer, $request);

        $answer = new AnswerResource($answer);

        return $this->sendResponse(compact('answer'), 'Answer Added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Answer $answer)
    {
        $answer = new AnswerResource($answer);

        return $this->sendResponse(compact('answer'));
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
    public function update(Answer $answer, Request $request)
    {
        $answer = Answer::addUpdate($answer, $request);
        $answer = new AnswerResource($answer);

        return $this->sendResponse(compact('answer'), 'Answer updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Answer  $answer)
    {
        $answer->delete();

        return $this->sendResponse(compact('answer'), 'Answer deleted.');
    }
}
