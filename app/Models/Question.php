<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jedrzej\Pimpable\PimpableTrait;
class Question extends Model
{
    use HasFactory;
    use SoftDeletes;
    use PimpableTrait;

    protected $sortParameterName = 'sort';

    public $sortable = ['question', 'created_at','status'];

    protected $searchable = ['search_txt','questation'];

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

    /**
     * Get the comments for the blog post.
     */
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public static function addUpdate($table, $request){

        if(isset($request->question)) {
            $table->question = $request->question;
        }

        $table->save();
        return $table;
    }
}
