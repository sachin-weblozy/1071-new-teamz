<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TeamController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->hasRole('superadmin')){
            $teams = Team::get();

        }elseif(Auth::user()->hasRole('user')){
            $teams = Team::whereHas('assigned')->get();
        }
        
        return view('admin.teams.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::get();
        $departments = Department::get();
        return view('admin.teams.create', compact('users', 'departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'department' => 'required',
            'members' => 'sometimes',
        ]);
        
        $team = Team::create([
            'name' => $data['name'],
            'department_id' => $data['department'],
        ]);

        if($team){
            if (isset($data['members'])) {
                $team->users()->sync($data['members']);
                $lead = null;
                foreach($data['members'] as $member){
                    $lead = $member;
                    break;
                }
                $team->update(['lead_id' => $lead]);
            }else{
                $team->users()->sync([]);
                $team->update(['lead_id' => null]);
            }
            Session::flash('success', 'Team Created');
        }
        return to_route('admin.teams.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($teamid)
    {
        $team = Team::where('id', decrypt($teamid))->first();
        $team->load(['users']);
        $members = $team->users;
        $activeUsers = $team->users;
        return view('admin.teams.show', compact('team','members'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($encteamid)
    {
        $team = Team::where('id',decrypt($encteamid))->first();
        $team->load(['users']);
        $departments=Department::get();
        $users = User::get();
        return view('admin.teams.edit', compact('team','departments','users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $teamid)
    {
        $team = Team::where('id', $teamid)->first();
        $data = $request->validate([
            'name' => 'required',
            'department' => 'required',
            'members' => 'sometimes',
            'lead' => 'sometimes',
        ]);

        $lead = $team->lead_id;
        if($request->lead){
            $lead = $request->lead;
        }

        $result = $team->update(
            [
                'name' => $data['name'],
                'department_id' => $data['department'],
                'lead_id' => $lead,
            ]
        );

        if($result){
            if (isset($data['members'])) {
                $team->users()->sync($data['members']);
            }else{
                $team->users()->sync([]);
            }
            Session::flash('success', 'Team Updated');
        }
        return to_route('admin.teams.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        $team->users()->sync([]);
        $result = $team->delete();
        if($result){
            Session::flash('success', 'Team Deleted');
            return to_route('admin.teams.index');
        }else{
            Session::flash('error', 'An error occured');
            return to_route('admin.teams.index');
        }
    }


    public function myTeam()
    {
        $user = Auth::user();
        $isLeadOrHead = false;

        if ($user->hasRole('superadmin')) {
            // If the user is a super admin, fetch all teams
            $teams = Team::all();
        } elseif ($user->hasRole('user')) {
            // Check if the user is a department head
            $headedDepartmentIds = $user->headedDepartments()->pluck('id');
            $isLeadOrHead = $headedDepartmentIds->isNotEmpty();

            // Get teams in those departments
            $departmentTeams = Team::whereIn('department_id', $headedDepartmentIds)->get();

            // Get teams where the user is a team lead
            $ledTeams = Team::where('lead_id', $user->id)->get();
            $isLeadOrHead = $isLeadOrHead || $ledTeams->isNotEmpty();

            // Get teams where the user is a member through the pivot table
            $assignedTeams = $user->teams()->get();

            // Merge the three collections while ensuring no duplicates
            $teams = $departmentTeams->merge($ledTeams)->merge($assignedTeams)->unique('id');
        } else {
            // If the user has no roles, return an empty collection
            $teams = collect();
        }

        return view('admin.teams.myteam', compact('teams', 'isLeadOrHead'));
    }



    public function myTeamShow($teamid)
    {
        $user = Auth::user();
        $team = Team::where('id', decrypt($teamid))->with('department')->first();

        // Check if the user is the lead of the team or the head of the department
        $isLeadOrHead = $team->lead_id == $user->id || ($team->department && $team->department->head_id == $user->id);

        $team->load(['users']);
        $members = $team->users;
        $activeUsers = $team->users;

        return view('admin.teams.myteam_show', compact('team', 'members', 'isLeadOrHead'));
    }

}
