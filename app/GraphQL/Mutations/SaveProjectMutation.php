<?php

namespace App\GraphQL\Mutations;
use Auth;

use App\Models\User;
use App\Models\Project;
use App\Models\Task;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;

class SaveProjectMutation extends Mutation {
    protected $attributes = [
        'name' => 'SaveProjectMutation',
    ];

    public function args(): array {
        return [
            'project' => [ 'type' => GraphQL::type('ProjectInput')],
        ];
    }

    public function type(): Type {
        return Type::string();
    }

    public function resolve($root, $args) {
        $proj =  $args['project'];
        $project = Project::create([
            'title' => $proj['title'],
            'description' => $proj['title'],
            'manager_id' => Auth::user()->id,
        ]);
        $users = User::whereIn('id',$proj['users'])->get();

        foreach($proj['tasks'] as $task){
            Task::create([
                'title' => $task['title'],
                'description' => $task['title'],
                'user_id' => $task['userid'],
                'project_id' => $project->id,
                'status_code' => $task['statusCode'],
            ]);
        }
        $project-> user()->saveMany($users);
        return '';
    }
    

}