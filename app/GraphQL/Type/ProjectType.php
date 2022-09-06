<?php

namespace App\GraphQL\Type;

use App\Models\Project;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class ProjectType extends GraphQLType {
    protected $attributes = [
        'name' => 'Project',
        'description' => 'A project',
        'model' => Project::class,
    ];

    public function fields(): array {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The project\'s ID',
            ],
            'title' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The project',
            ],
            'description' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The projectj',
            ],
            'manager' => [
                'type' => Type::nonNull(GraphQL::type('User'))
            ],
            'tasks' => [
                'type' => Type::listOf(GraphQL::type('Task'))
            ],
            'users' => [
                'type' => Type::listOf(GraphQL::type('User'))
            ],
        ];
    }


}