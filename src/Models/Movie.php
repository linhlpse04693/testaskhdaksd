<?php

namespace Src\Models;

class Movie extends BaseModel
{
    protected string $table = 'movie';
    protected array $fillable = ['title', 'description', 'year', 'name_of_director', 'release_date'];
}
