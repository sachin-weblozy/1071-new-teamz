<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments=Department::get();
        $users=User::get();
        return view('admin.departments.index', compact('departments','users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'code' => 'required|unique:departments,code',
            'head' => 'required',
        ]);

        $result = Department::create([
            'name' => $data['name'],
            'code' => $data['code'],
            'head_id' => $data['head'],
        ]);

        if ($result) {
            Session::flash('success', 'Department Created');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = $request->validate([
            'deptid' => 'required',
            'name' => 'required',
            'code' => 'required',
            'head' => 'required',
        ]);

        $department=Department::where('id', $request->deptid)->first();
        
        $department->update(
            [
                'name' => $data['name'],
                'code' => $data['code'],
                'head_id' => $data['head'],
            ]
        );

        Session::flash('success', 'Department Updated');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
