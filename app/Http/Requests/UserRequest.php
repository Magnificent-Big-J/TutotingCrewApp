<?php

namespace App\Http\Requests;

use App\Mail\WelcomeAdminMail;
use App\Mail\WelcomeMail;
use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Mail;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'password' => 'required'
        ];
    }
    public function createUser()
    {
        $user = User::create($this->all());
        $user->assignUserRole($user, $this->get('type'));

        if ($this->get('type') > 1) {
            Mail::to($user)->send(new WelcomeMail($user));
        } else {
            Mail::to($user)->send(new WelcomeAdminMail($user));
        }
    }
}
