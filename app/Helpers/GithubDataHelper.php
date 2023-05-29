<?php

namespace App\Helpers;

class GithubDataHelper {

    public static function getFieldsFromUsersRepos(array $fields, array $repos)
    {
        $reposWithFields = [];

        if(isset($repos['message']))
            return [];

        foreach($repos as $repo) {            
            $filtered = array_filter($repo, function ($key) use ($fields) {
                    return in_array($key, $fields);
                },
                ARRAY_FILTER_USE_KEY
            );

            $reposWithFields[] = $filtered;
        }

        return $reposWithFields;
    }

}