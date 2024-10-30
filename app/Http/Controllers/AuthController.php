<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
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
     * Submit login attempt
     *
     * @param Request $request User login request data
     * @return null|RedirectResponse
     * @throws BindingResolutionException
     */
    public function loginSubmit(Request $request): ?RedirectResponse
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

        // Check if user exists
        $user = User::where('username', $username)
            ->where('deleted_at', NULL)
            ->first();

        if (!$user) {
            return redirect()->back()
                ->withInput()
                ->with('loginError', 'Nao existe nenhum registro com esse e-mail.');
        }

        // Validate password
        if (!password_verify($password, $user->password)) {
            return redirect()->back()
                ->withInput()
                ->with('loginError', 'Senha ou email incorretos.');
        }

        // Update user's last login
        $user->last_login = date('Y-m-d H:i:s');

        $user->save();

        // Update session with user data
        session([
            'user' => [
                'id'       => $user->id,
                'username' => $user->username
            ]
        ]);

        echo 'Login efetuado com sucesso';

        return null;
    }

    public function logout(): void
    {
        echo 'Logout';
    }
}
