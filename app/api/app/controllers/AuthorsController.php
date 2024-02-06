<?php

class AuthorsController extends MainController
{
    public function do(): void
    {
        $recipes = DB::query("SELECT author, COUNT(id) recipes FROM recipe GROUP BY author ORDER BY author")
            ->fetchAll();
        $this->res
            ->set('stat', 'ok')
            ->set('data', $recipes);
    }

}
