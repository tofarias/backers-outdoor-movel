<?php

declare(strict_types=1);
namespace Backers\Auth;


use Backers\Models\UserInterface;

interface AuthInterface
{
    public function login(Array $credentials) : bool;

    public function check() : bool;

    public function logout() : void;

    public function hashPassword(string $password) : string;

    public function user() : ?UserInterface;
}