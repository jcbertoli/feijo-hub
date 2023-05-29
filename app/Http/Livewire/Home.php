<?php

namespace App\Http\Livewire;

use App\Models\Project;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        $projects = DB::table('projects')
            ->select('owner', 'repository_id')
            ->get()
            ->mapToGroups(function ($item) {
                return [$item->owner => $item->repository_id];
            })
            ->toArray();

        return view('livewire.home', compact('projects'));
    }
}
