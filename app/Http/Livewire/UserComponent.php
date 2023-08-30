<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserComponent extends Component
{

    public $users;
    public $headers =['Id','Nombre','Email'];
    public $data=[];
    public $user_logueado=false;
    public function mount(){

        $userId =  Auth::user();
        $this->user_logueado =  $userId->id ==1;
        $this->users = User::allUser();
        $this->listUsers($this->users);
    }

    
    public function listUsers($users){
        $this->data = $users->map(function ($user) {
            return [
                $user->id,
                $user->name,
                $user->email,
            ];
        })->toArray();

    }

    public function render()
    {
        return view('livewire.user-component');
    }
}
