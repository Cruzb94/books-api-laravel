<?php

namespace App\Observers;

use App\Models\Book;
use App\Models\Author;

class BookObserver
{
    /**
     * Handle the Book "created" event.
     */
    public function created(Book $book): void
    {
        $author = Author::findOrFail($book->author_id);
		$author->quantity = $author->quantity + 1;
        $author->save();

    }

    /**
     * Handle the Book "updated" event.
     */
    public function updated(Book $book): void
    {
        //
    }

    /**
     * Handle the Book "deleted" event.
     */
    public function deleted(Book $book): void
    {
        $author = Author::findOrFail($book->author_id);
		$author->quantity = $book->quantity - 1;
        $author->save();
    }

    /**
     * Handle the Book "restored" event.
     */
    public function restored(Book $book): void
    {
        //
    }

    /**
     * Handle the Book "force deleted" event.
     */
    public function forceDeleted(Book $book): void
    {
        //
    }
}
