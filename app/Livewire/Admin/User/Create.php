<?php

namespace App\Livewire\Admin\User;

use App\Enums\UserTypeEnum;
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

    // #[Validate(['required', 'type' => Rule::enum(UserTypeEnum::class)])]
    #[Validate(['required'])]
    public string $type;

    public function save()
    {
        $data = $this->validate();

        $data['avatar'] = '/empty-user.jpg';
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);
        $this->success('Usuário criado com sucesso!', redirectTo:route('users.index'));
        try {

        } catch (\Throwable $th) {
            $this->error('Ocorreu um erro, tente novamente!');
            return;
        }


    }


     #[Computed()]
     public function types(): Collection
     {
         return collect([
                ['key' => UserTypeEnum::CLIENT->name, 'value' => "Cliente"],
                ['key' => UserTypeEnum::EMPLOYEE->name, 'value' => "Funcionario"],
                ['key' => UserTypeEnum::MANAGER->name, 'value' => "Gerente"],
                ['key' => UserTypeEnum::ADMIN->name, 'value' => "Admin"],
         ]);
     }


    public function render()
    {
        // dd([$this->types]);
        return view('livewire.admin.user.create');
    }
}
