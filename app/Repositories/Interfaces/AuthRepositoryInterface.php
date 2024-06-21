<?php
namespace App\Repositories\Interfaces;

Interface AuthRepositoryInterface{

    public function first($email);
    public function store($data);
}