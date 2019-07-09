<?php

namespace App\Observers;

use App\Task;
use App\Activity;

/**
 * 
 * Observers and events do not do the same thing at all.
 * 
 * Simple Difference
 * 
 * Observers are basically predefined events that happen only on Eloquent Models (creating a record, updating a record, deleting, etc).\
 * Events are generic, aren't predefined, and can be used anywhere, not just in models.
 * 
 * Observers:
 * 
 * An observer watches for specific things that happen within eloquent such as saving, saved, deleting, deleted (there are more but you should get the point).
 * Observers are specifically bound to a model.
 * 
 * Events:
 * 
 * Events are actions that are driven by whatever the programmer wants. If you want to fire an event when somebody loads a page, you can do that.
 * Unlike observers events can also be queue, and ran via laravel's cron heartbeat. Events are programmer defined effectively.
 * They give you the ability to handle actions that you would not want a user to wait for ( example being the purchase of a pod cast )
 */

class TaskObserver
{

    protected function recordActivity( $entity, $description )
    {

        $entity->activity()->create([

            'user_id'     => $entity->user_id,
            // 'task_id'     => $entity->id,
            'description' => $description
        ]);
    }

    /**
     * Handle the task "created" event.
     *
     * @param  \App\Task  $task
     * @return void
     */
    public function created( Task $task )
    {

        $this->recordActivity( $task, 'created' );
    }

    /**
     * Handle the task "updated" event.
     *
     * @param  \App\Task  $task
     * @return void
     */
    public function updated( Task $task )
    {

        // this will not record activity if the only thing changing is the task being 'soft deleted'
        if( ! $task->isDirty( $task->getDeletedAtColumn() ) ) $this->recordActivity( $task, 'updated' );
    }

    /**
     * Handle the task "deleted" event.
     *
     * @param  \App\Task  $task
     * @return void
     */
    public function deleted(Task $task)
    {

        $this->recordActivity( $task, 'deleted' );
    }

    /**
     * Handle the task "restored" event.
     *
     * @param  \App\Task  $task
     * @return void
     */
    public function restored(Task $task)
    {

        $this->recordActivity( $task, 'restored' );
    }

    /**
     * Handle the task "force deleted" event.
     *
     * @param  \App\Task  $task
     * @return void
     */
    public function forceDeleted(Task $task)
    {
        //
    }
}
