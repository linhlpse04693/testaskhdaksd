<?php

namespace Src\Models;

class Song extends BaseModel
{
    protected string $table = 'song';
    protected array $fillable = ['title', 'name_of_album', 'year', 'name_of_artist', 'release_date'];
}
