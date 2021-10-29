<?php

namespace Src\Controller;

use Src\Models\Song as Model;

class Song extends Controller
{
    protected ?Model $song;

    public function __construct()
    {
        $this->song = new Model;
    }

    public function all()
    {
        if($_SERVER['REQUEST_METHOD'] !== 'GET') $this->response(405);

        $songs = $this->song->all();

        $this->response(200, $songs);
    }

    public function get($params)
    {
        if($_SERVER['REQUEST_METHOD'] !== 'GET') $this->response(405);

        $song = $this->song->get($params['id']);

        $this->response(200, $song);
    }

    public function store()
    {
        if($_SERVER['REQUEST_METHOD'] !== 'POST') $this->response(405);

        $song = $this->song->create($_POST);

        $this->response(200, $song);
    }

    public function delete($params)
    {
        if($_SERVER['REQUEST_METHOD'] !== 'DELETE') $this->response(405);

        $this->song->delete($params['id']);

        $this->response(200);
    }

    public function update($params)
    {
        if($_SERVER['REQUEST_METHOD'] !== 'PUT') $this->response(405);
        $this->song->update($params['id'], json_decode(file_get_contents("php://input"), true));

        $this->response(200);
    }

}
