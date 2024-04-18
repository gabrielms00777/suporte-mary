<?php

namespace App\Livewire\Admin\User;

use App\Enums\UserTypeEnum;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Mary\Traits\Toast;
use stdClass;

class Create extends Component
{
    use Toast;

    #[Validate('required')]
    public string $name = '';

    #[Validate('required|email|unique:users')]
    public string $email = '';

    #[Validate('required|confirmed')]
    public string $password = '';

    #[Validate('required')]
    public string $password_confirmation = '';

    #[Validate(['required', 'exists:roles,id'])]
    public string $role;

    public function save()
    {
        $data = $this->validate();

        try {
            $data['avatar'] = '/empty-user.jpg';
            $data['password'] = Hash::make($data['password']);

            $user = User::create($data);

            $user->roles()->attach($data['role']);

            $this->success('Usuário criado com sucesso!', redirectTo:route('users.index'));

        } catch (\Throwable $th) {
            $this->error('Ocorreu um erro, tente novamente!');
            return;
        }


    }


     #[Computed()]
     public function roles(): Collection
     {
         return Role::query()->get(['id', 'name']);
     }


    public function render()
    {
        // dd($this->roles);
        return view('livewire.admin.user.create');
    }
}
