<?php

namespace Abd\Mvc\Contracts;

interface Request
{
    public function user();
    public function params();
    public function route();
    public function path();
    public function method();
    public function body();
}
