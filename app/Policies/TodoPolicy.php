<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Task;

class TodoPolicy
{
    use HandlesAuthorization;

    /**
     * Simple check to see if a user can perform any operation on a task
     *
     * @return void
     */
    public function manage_task( User $user, Task $task )
    {
        return $task->user->id === auth()->id();
    }
}
