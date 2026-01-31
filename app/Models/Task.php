<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

use function Symfony\Component\Clock\now;

class Task extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'priority',
        'status',
        'due_date',
        'due_time',
        'is_important',
        'is_completed',
        'completed_at',
        'notes',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    protected $appends = [
        'due_date_label',
        'is_overdue',
    ];

    public function getIsOverdueAttribute(){
        return $this->due_date
            && Carbon::parse($this->due_date)->isPast()
            && $this->status !== 'completed';
    }

    public function getDueDateLabelAttribute(){
        if(!$this->due_date){
            return null;
        }

        $due = Carbon::parse($this->due_date)->startOfDay();
        $today = Carbon::now()->startOfDay();
        if($due->isToday()){
            return 'Today';
        }
        if($due->isTomorrow()){
            return 'Tomorrow';
        }
        if($due->isYesterday()){
            return 'Yesterday';
        }
        return $due->format('M d, Y');
    }

    public function getStatusBadgeAttribute(){
        return match($this->status){
            'pending' => '<span class="badge bg-warning-subtle text-warning fw-semibold">
                        <i class="bi bi-hourglass-split me-1"></i> Pending
                      </span>',

            'in_progress' => '<span class="badge bg-info-subtle text-info fw-semibold">
                                <i class="bi bi-arrow-repeat me-1"></i> In Progress
                            </span>',

            'completed' => '<span class="badge bg-success-subtle text-success fw-semibold">
                                <i class="bi bi-check-circle me-1"></i> Completed
                            </span>',

            default => '<span class="badge bg-secondary">Unknown</span>',
        };
    }
}
