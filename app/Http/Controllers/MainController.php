<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Redis\Connectors\PredisConnector;

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
     * @return View
     */
    public function newNote(): View
    {
        return View('new_note');
    }

    /**
     * Submit new note to database
     *
     * @param Request $request Request data
     * @return RedirectResponse
     */
    public function newNoteSubmit(Request $request): RedirectResponse
    {
        // Validate request data
        $request->validate(
            // Rules
            [
                'text_title' => [
                    'required',
                    'string',
                    'min:3',
                    'max:200'
                ],
                'text_note'  => [
                    'required',
                    'string',
                    'min:3',
                    'max:2000'
                ]
            ],
            // Error messages
            [
                'text_title.required' => 'Uma nota deve conter um titulo',
                'text_title.min'      => 'Um titulo deve conter no minimo :min caracteres',
                'text_title.max'      => 'Um titulo deve conter no maximo :max caracteres',
                'text_note.required'  => 'Uma note deve conter um conteudo',
                'text_note.min'       => 'Uma nota deve conter no minimo :min caracteres',
                'text_note.max'       => 'Uma nota deve conter no maximo :max caracteres'
            ]
        );

        // Get user ID
        $userId = session('user.id');

        // Create new note
        $note = new Note();

        $note->user_id = $userId;
        $note->title = $request->input('text_title');
        $note->text = $request->input('text_note');

        $note->save();

        // Redirect to home
        return redirect()->route('home');
    }
}
