<?php

namespace App\Livewire;

use App\Models\Project;
use App\Models\ProjectEvents;
use Livewire\Component;

class ProjectActivity extends Component
{
    public $project_id;
    public $project;
    public $events;
    public $content;

    public function mount($project_id,$content)
    {
        $this->project_id = $project_id;
        $this->content = $content;
        $this->project = Project::where('id',$project_id)->first();
        $this->events = null;
        $this->events = ProjectEvents::where('project_id',$project_id)->latest()->get();
    }

    public function render()
    {
        return view('livewire.project-activity');
    }
}
