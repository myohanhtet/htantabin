<?php

namespace App\Http\Controllers\Back;

use App\DataTables\PermissionDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Models\Permission;
use App\Traits\Authorizable;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class PermissionController extends Controller
{
    use Authorizable;
    /**
     * Display a listing of the resource.
     *
     * @param PermissionDatatable $datatable
     * @return Response
     */
    public function index(PermissionDatatable $datatable)
    {
        return $datatable->render('permissions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePermissionRequest $request
     * @return RedirectResponse
     */
    public function store(StorePermissionRequest $request)
    {
        $permission = Permission::create($request->validated());

        $permission->syncRoles($request->role);

        flash("Your permissions is successfully created &#128522;")->success();

        return redirect()->route('permissions.index');

    }

    /**
     * Display the specified resource.
     *
     * @param Permission $permission
     * @return RedirectResponse
     */
    public function show(Permission $permission)
    {
        flash("&#128540; &#128541; &#128539; &#128538; &#128537; &#128536;");
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Permission $permission
     * @return Application|Factory|View|Response
     */
    public function edit(Permission $permission)
    {
        return view('permissions.edit',['permission' => $permission]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePermissionRequest $request
     * @param Permission $permission
     * @return RedirectResponse
     */
    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        Log::info("Permission name ". $permission->name ." updated by ". auth()->user()->name );
        $permission->update($request->validated());
        $permission->syncRoles($request->role);
        flash("Your permission is successfully updated.")->success();
        return redirect()->route("permissions.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Permission $permission
     * @return RedirectResponse
     */
    public function destroy(Permission $permission)
    {
        Log::info("Permission name ". $permission->name ." deleted by ". auth()->user()->name );
        $permission->delete();
        flash("Your permission is successfully deleted")->success();
        return redirect()->route('permissions.index');
    }
}
