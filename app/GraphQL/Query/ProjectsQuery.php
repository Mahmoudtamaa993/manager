<?php

namespace App\GraphQL\Query;


use App\Models\Project;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;

class ProjectsQuery extends Query {
    protected $attributes = [
        'name' => 'Project',
        'description' => 'Retrieves projects',
    ];

    public function args(): array {
        return [
            'projectId' => [ 'type' => Type::int()]
        ];
    }

    public function type(): Type {
        return Type::nonNull(Type::listOf(Type::nonNull(GraphQL::type('Project'))));
    }
    // public function type(): Type
    // {
    //     return Type::nonNull(Type::listOf(Type::nonNull(GraphQL::type('project'))));
    // }

    public function resolve($root, $args) {
        if (isset($args['projectId'])) {
            return Project::where('id', $args['projectId'])->get(); 
        }

        return Project::all();
    }


}