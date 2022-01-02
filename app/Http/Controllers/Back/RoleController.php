<?php

namespace App\Http\Controllers\Back;

use App\DataTables\RoleDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Role;
use App\Traits\Authorizable;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{
    use Authorizable;
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(RoleDatatable $dataTable)
    {
        return $dataTable->render('roles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRoleRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRoleRequest $request)
    {

        $role = Role::create($request->validated());

        $role->syncPermissions($request->permission);
        session(['success' =>"Your role is successfully created &#128522;"]);
        // flash("Your role is successfully created &#128522;")->success();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param Role $role
     * @return string
     */
    public function show(Role $role)
    {
        session(['success' =>"👍"]);
        //flash("&#128540; &#128541; &#128539; &#128538; &#128537; &#128536;");
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Role $role
     * @return Application|Factory|View|Response
     */
    public function edit(Role $role)
    {
        return view('roles.edit',['role'=>$role]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRoleRequest $request
     * @param Role $role
     * @return RedirectResponse
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        Log::info("Role name ". $role->name ." updated by ". auth()->user()->name );
        $role->update($request->validated());
        $role->syncPermissions($request->permission);
        session(['success' =>"Your role is successfully updated. 👍"]);

        //  flash("Your role is successfully created. 👍")->success();
        return redirect()->route("roles.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Role $role
     * @return RedirectResponse
     */
    public function destroy(Role $role)
    {
        Log::info("Role name ". $role->name ." updated by ". auth()->user()->name );
        $role->delete();
        session(['success' =>"Your role is successfully deleted"]);
        // flash("Your role is successfully deleted")->success();
        return redirect()->route('roles.index');
    }
}
