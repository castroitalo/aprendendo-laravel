<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDOException;

/**
 * Controls authentication routes
 *
 * @package App\Http\Controllers
 */
class AuthController extends Controller
{
    /**
     * Displays login screen
     *
     * @return View
     * @throws BindingResolutionException
     */
    public function login(): View
    {
        return view('login');
    }

    /**
     * Submit login form
     *
     * @param Request $request Login form request data
     * @return void
     */
    public function loginSubmit(Request $request): void
    {
        // Validate form
        $request->validate(
            // Validation rules
            [
                'text_username' => [
                    'required',
                    'email',
                    'string'
                ],
                'text_password' => [
                    'required',
                    'min:8',
                    'max:16',
                    'string'
                ]
            ],
            // Error messages
            [
                'test_username.required' => 'Username eh obrigatorio',
                'text_username.email'    => 'Username deve ser um email valido',
                'text_password.required' => 'Uma senha eh obrigatoria',
                'text_password.min'      => 'Uma senha deve ter no minimo :min caracteres',
                'text_password.max'      => 'Uma senha deve ter no maximo :max caracteres'
            ]
        );

        // Get user input
        $username = $request->input('text_username');
        $password = $request->input('text_password');

        // Get all users from database
        $userModel = new User();
        $users     = $userModel->all()
            ->toArray();

        dd($users);
    }

    public function logout(): void
    {
        echo 'Logout';
    }
}
