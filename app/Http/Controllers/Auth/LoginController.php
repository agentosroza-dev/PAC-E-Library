<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Show the login form
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        // Validate form data
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'សូមបញ្ចូលអ៊ីមែល',
            'email.email' => 'សូមបញ្ចូលអ៊ីមែលឲ្យបានត្រឹមត្រូវ',
            'password.required' => 'សូមបញ្ចូលពាក្យសម្ងាត់',
            'password.min' => 'ពាក្យសម្ងាត់ត្រូវមានយ៉ាងតិច ៦ តួអក្សរ',
        ]);

        // Attempt to login
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            // Redirect to intended page or home
            return redirect()->intended(route('home'))
                ->with('success', 'ចូលប្រើប្រាស់ប្រព័ន្ធដោយជោគជ័យ!');
        }

        // Login failed
        return back()->withErrors([
            'email' => 'ព័ត៌មានចូលប្រើប្រាស់មិនត្រឹមត្រូវ',
        ])->onlyInput('email');
    }

    /**
     * Handle logout request
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')
            ->with('success', 'អ្នកបានចាកចេញពីប្រព័ន្ធដោយជោគជ័យ!');
    }
}
