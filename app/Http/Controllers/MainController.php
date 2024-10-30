<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

/**
 * Controls every main routing
 *
 * @package App\Http\Controllers
 */
class MainController extends Controller
{
    /**
     * Renders index view
     *
     * @return void
     */
    public function index(): void
    {
        echo 'I\'m inside the app';
    }

    /**
     * Renders new note view
     *
     * @return void
     */
    public function newNote(): void
    {
        echo 'I\'m creating a new note';
    }
}
