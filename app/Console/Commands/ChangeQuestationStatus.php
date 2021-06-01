<?php

namespace App\Console\Commands;
use Database\Factories\QuestionFactory;
use Illuminate\Console\Command;
use App\Models\Question;
use Carbon\Carbon;

class ChangeQuestationStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'question:update-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the code status';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = Carbon::now();
        $questions = Question::where('status', 'In Progress')->get();

        foreach($questions as $question) {
            $answer = $question->answers->last();
            if($answer->created_at->diffInDays($today)) {
                $question->status = 'Answered';
                $question->save();
            }
        }

        return 0;
    }
}
