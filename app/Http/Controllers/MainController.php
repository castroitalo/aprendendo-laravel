<?php

namespace App\Http\Controllers;

use App\Models\User;
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
    public function index(): View
    {
        // Load user's notes
        $userId = session('user.id');
        $userData = User::find($userId)->toArray();
        $userNotes = User::find($userId)->notes()
            ->get()
            ->toArray();

        // Show home view
        return view('home', [
            'user_notes' => $userNotes
        ]);
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
