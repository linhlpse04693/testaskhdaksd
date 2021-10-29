<?php

namespace Src\Controller;

use Src\Models\Movie as Model;

class Movie extends Controller
{
    protected ?Model $movie;

    public function __construct()
    {
        $this->movie = new Model;
    }

    public function all()
    {
        if($_SERVER['REQUEST_METHOD'] !== 'GET') $this->response(405);

        $movies = $this->movie->all();

        $this->response(200, $movies);
    }

    public function get($params)
    {
        if($_SERVER['REQUEST_METHOD'] !== 'GET') $this->response(405);

        $movie = $this->movie->get($params['id']);

        $this->response(200, $movie);
    }

    public function store()
    {
        if($_SERVER['REQUEST_METHOD'] !== 'POST') $this->response(405);

        $movie = $this->movie->create($_POST);

        $this->response(200, $movie);
    }

    public function delete($params)
    {
        if($_SERVER['REQUEST_METHOD'] !== 'DELETE') $this->response(405);

        $this->movie->delete($params['id']);

        $this->response(200);
    }

    public function update($params)
    {
        if($_SERVER['REQUEST_METHOD'] !== 'PUT') $this->response(405);
        $this->movie->update($params['id'], json_decode(file_get_contents("php://input"), true));

        $this->response(200);
    }

}
