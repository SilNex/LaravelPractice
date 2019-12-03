<?php

namespace App\Observers;

use App\Board;
use Spatie\Permission\Models\Permission;

class BoardObserver
{
    /**
     * Handle the board "created" event.
     *
     * @param  \App\Board  $board
     * @return void
     */
    public function created(Board $board)
    {
        Permission::create([
            'name' => "{$board->name} use",
        ]);
    }

    /**
     * Handle the board "updated" event.
     *
     * @param  \App\Board  $board
     * @return void
     */
    public function updated(Board $board)
    {
        //
    }

    /**
     * Handle the board "deleted" event.
     *
     * @param  \App\Board  $board
     * @return void
     */
    public function deleted(Board $board)
    {
        Permission::whereName("{$board->name} use")->delete();
    }

    /**
     * Handle the board "restored" event.
     *
     * @param  \App\Board  $board
     * @return void
     */
    public function restored(Board $board)
    {
        //
    }

    /**
     * Handle the board "force deleted" event.
     *
     * @param  \App\Board  $board
     * @return void
     */
    public function forceDeleted(Board $board)
    {
        //
    }
}
