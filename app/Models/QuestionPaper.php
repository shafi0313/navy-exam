<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionPaper extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // public function quesInfo()
    // {
    //     return $this->belongsTo(QuesInfo::class);
    // }

    // public function subject()
    // {
    //     return $this->belongsTo(Subject::class, 'subject_id');
    // }

    // public function question()
    // {
    //     return $this->belongsTo(Question::class, 'question_id');
    // }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }

    public function options()
    {
        return $this->hasMany(QuesOption::class, 'question_id', 'question_id');
    }
}
