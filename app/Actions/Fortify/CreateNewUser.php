<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Cadastrado;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\DB;
use App\Rules\Cpf;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        // 1. LIMPEZA DO CPF: Removemos tudo que não for número do campo 'cpf'.
        $input['cpf'] = preg_replace('/[^0-9]/', '', $input['cpf']);

        // 2. VALIDAÇÃO: Agora, o Validator recebe o CPF já limpo.
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
            'cpf' => ['required', 'string', 'size:11', 'unique:cadastrados,cpf', new Cpf],

        ])->validate();

        // 3. CRIAÇÃO NO BANCO: O resto do código funciona como antes.
        return DB::transaction(function () use ($input) {
            $user = User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
                'nivel_permissao' => 'cadastrado',
            ]);

            Cadastrado::create([
                'user_id' => $user->id,
                'cpf' => $input['cpf'],
                'pontuacao_total' => 0,
            ]);

            return $user;
        });
    }
}
