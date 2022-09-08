<?php

namespace App\GraphQL\Mutations;
use Auth;

use App\Models\User;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Str;
use Rebing\GraphQL\Support\Mutation;


class RegisterMutation extends Mutation {
    protected $attributes = [
        'name' => 'RegisterUser',
    ];

    public function args(): array {
        return [
            'displayName' => [ 'type' => Type::string()],
            'email' => [ 'type' => Type::string()],
            'password' => [ 'type' => Type::string()],

        ];
    }

    public function type(): Type {
        return Type::string();
    }

    public function resolve($root, $args) {
        $credentials = [
            'email' => $args['email'],
            'password' => $args['password'],
        ];
        $user = User::create([
            'name' => $args['displayName'],
            'email' => $args['email'],
            'password' => bcrypt($args['password']),
            'api_token' => Str::random(60),
        ]);

        return $user->api_token;
    }


}
