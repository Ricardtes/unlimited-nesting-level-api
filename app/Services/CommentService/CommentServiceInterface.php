<?php

namespace App\Services\CommentService;

interface CommentServiceInterface
{

     function create($data);

     function find(int $id);

}
