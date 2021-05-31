<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Answer extends Model
{
    use HasFactory;
    use SoftDeletes;

    public static function boot()
    {
        parent::boot();

        self::creating(function($question){
            $question->created_by = Auth::user()->id;
            //$user->order = self::count() + 1;
        });

        self::created(function($question){
            // ... code here
        });

        self::updating(function($question){
            $question->updated_by = Auth::user()->id;
        });

        self::updated(function($question){
            // ... code here
        });

        self::deleting(function($question){
            $question->deleted_by = Auth::user()->id;
            $question->save();
        });

        self::deleted(function($question){

        });
    }

    public static function addUpdate($table, $request){
        if(isset($request->question_id)) {
            $table->question_id = $request->question_id;
        }

        if(isset($request->answer)) {
            $table->answer = $request->answer;
        }

        $table->save();
        return $table;
    }
}
