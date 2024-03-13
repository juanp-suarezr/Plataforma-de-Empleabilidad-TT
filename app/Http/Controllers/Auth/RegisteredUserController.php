<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {

        $headers = [
            'Accept: application/json',
            'Content-type: application/json',
            "X-App-Token: " . '9hopib2llig08er5xayl72nen'


        ];
        $response = Http::withHeaders($headers)->get('https://www.datos.gov.co/resource/xdk5-pm3f.json');
        $data = $response->json();

        $datosRegionales=[]; 

        foreach ($data as $key => $value) {
            $datosRegionales[] = [
                'departamento' => $value['departamento'],
                'municipio' => $value['municipio']
            ];
        }

        

        return Inertia::render('Auth/Register', [
            'resultados' => $datosRegionales
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:' . User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
