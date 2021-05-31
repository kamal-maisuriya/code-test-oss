<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
class Question extends Model
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

        if(isset($request->question)) {
            $table->question = $request->question;
        }

        $table->save();
        return $table;
    }
}
