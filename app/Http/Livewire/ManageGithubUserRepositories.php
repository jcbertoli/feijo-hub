<?php

namespace App\Http\Livewire;

use App\Models\Project;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class ManageGithubUserRepositories extends Component
{
    public $data, $repository_id = [], $owner = [];

    public $listeners = ['userSearched'];

    const createRepositoryRules = [
        'repository_id' => ['required', 'int', 'unique:projects,repository_id'],
        'owner' => ['required', 'string']
    ];

    const createRepositoryCustomMessages = [
        'repository_id' => 'Esse repositório já está adicionado.'
    ];

    const deleteRepositoryRules = [
        'repository_id' => ['required', 'int', 'exists:projects,repository_id'],
    ];

    const deleteRepositoryCustomMessages = [
        'repository_id' => 'Esse repositório não foi encontrado.'
    ];

    public function render()
    {
        return view('livewire.manage-github-user-repositories');
    }

    public function createRepository($id, $owner)
    {
        $validator = Validator::make(
            [
                'repository_id' => $id,
                'owner' => $owner
            ],
            self::createRepositoryRules,
            self::createRepositoryCustomMessages
        );

        if ($validator->fails())
            return $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'error',  'message' => $validator->errors()->first()]
            );

        Project::create([
            'repository_id' => $id,
            'owner' => $owner,
            'user_id' => Auth()->user()->id
        ]);

        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'success',  'message' => 'Repositório adicionado com sucesso!']
        );
    }

    public function deleteRepository($id)
    {
        $validator = Validator::make(
            [
                'repository_id' => $id,
            ],
            self::deleteRepositoryRules,
            self::deleteRepositoryCustomMessages
        );

        if ($validator->fails())
            return $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'error',  'message' => $validator->errors()->first()]
            );

        Project::where('repository_id', $id)->delete();

        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'info',  'message' => 'Repositório removido com sucesso!']
        );
    }

    public function userSearched($fields)
    {
        $this->data = $fields;
    }
}
