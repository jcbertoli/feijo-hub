<?php

namespace App\Http\Livewire;

use App\Helpers\GithubDataHelper;
use App\Services\GithubApiService;
use Livewire\Component;

class SearchGithubUser extends Component
{
    public $user, $createApiTokenForm;

    public function render()
    {
        return view('livewire.search-github-user');
    }

    public function searchGithub()
    {
        $data = GithubApiService::getReposFromUser($this->user);

        $fields = GithubDataHelper::getFieldsFromUsersRepos(
            ['id', 'owner', 'name', 'description', 'created_at', 'updated_at', 'stargazers_count'],
            $data
        );

        $this->emit('userSearched', $fields);
    }

}
