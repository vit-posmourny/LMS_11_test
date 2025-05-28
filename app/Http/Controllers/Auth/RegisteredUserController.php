<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use App\Traits\FileUpload;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class RegisteredUserController extends Controller
{
    use FileUpload;
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if ($request->type === 'student')
        {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'student',
                'approve_status' => 'approved',
            ]);

        }elseif ($request->type === 'instructor')
        {
            $request->validate(['document' => ['required', 'mimes:pdf, docx, jpg, jpeg, png', 'max:2000']]);
            $filePath = $this->fileUpload($request->file('document'));

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'instructor',
                'approve_status' => 'pending',
                'document' => $filePath,
            ]);

        }else {
            abort('404');
        }
        

        event(new Registered($user));

        Auth::login($user);


        if ($request->user()->role == 'student')
        {
            return redirect()->intended(route('student.dashboard', absolute: false));
        }
        elseif ($request->user()->role == 'instructor')
        {
            return redirect()->intended(route('instructor.dashboard', absolute: false));
        }
    }
}
