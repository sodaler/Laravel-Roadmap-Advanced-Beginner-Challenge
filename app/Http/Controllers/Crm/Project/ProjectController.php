<?php

namespace App\Http\Controllers\Crm\Project;

use App\Actions\Crm\Project\ProjectAction;
use App\Actions\Media\StoreMediaAction;
use App\Enums\Project\ProjectStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Filters\ProjectFilter;
use App\Http\Requests\Crm\Project\StoreRequest;
use App\Http\Requests\Crm\Project\UpdateRequest;
use App\Http\Requests\Filter\Project\FilterRequest;
use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FilterRequest $request)
    {
        $data = $request->validated();
        $filter = app()->make(ProjectFilter::class, ['queryParams' => array_filter($data)]);
        $projects = Project::filter($filter)
            ->with('client')
            ->orderDeadline()
            ->paginate(10);


        return view('crm.project.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(ProjectAction $projectAction)
    {
        $statuses = $projectAction->getStatusValues();
        $clients = Client::all();
        $users = User::managers()->get();

        return view('crm.project.create', compact('statuses', 'clients', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request, StoreMediaAction $action)
    {
        $data = $request->validated();
        $projects = Project::query()->create($data);
        $action->storeMedia($projects, $request);

        return redirect()->route('crm.project.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('crm.project.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $statuses = ProjectStatusEnum::cases();
        $clients = Client::all();
        $users = User::all();

        return view('crm.project.edit', compact('project', 'statuses', 'clients', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Project $project)
    {
        $data = $request->validated();
        $project->update($data);

        return view('crm.project.show', compact('project'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        try {
            $project->delete();
        } catch (\Exception $exception) {
            Log::error($exception);
            return redirect()->back()->with('status', 'Cannot delete project');
        }

        return redirect()->route('crm.project.index');
    }
}
