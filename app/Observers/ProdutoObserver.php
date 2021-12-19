<?php

namespace App\Observers;

use App\Models\Produto;

class ProdutoObserver
{
    /**
     * Handle the Produto "created" event.
     *
     * @param  \App\Models\Produto  $produto
     * @return void
     */
    public function created(Produto $produto)
    {
        //
    }

    /**
     * Handle the Produto "updated" event.
     *
     * @param  \App\Models\Produto  $produto
     * @return void
     */
    public function updated(Produto $produto)
    {
        //
    }

    /**
     * Handle the Produto "deleted" event.
     *
     * @param  \App\Models\Produto  $produto
     * @return void
     */
    public function deleted(Produto $produto)
    {
        //
    }

    /**
     * Handle the Produto "restored" event.
     *
     * @param  \App\Models\Produto  $produto
     * @return void
     */
    public function restored(Produto $produto)
    {
        //
    }

    /**
     * Handle the Produto "force deleted" event.
     *
     * @param  \App\Models\Produto  $produto
     * @return void
     */
    public function forceDeleted(Produto $produto)
    {
        //
    }
}
