<?php

namespace App\Http\Controllers\Back;

use App\DataTables\SettingDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSettingRequest;
use App\Http\Requests\UpdateSettingRequest;
use App\Models\Setting;
use App\Traits\Authorizable;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SettingsController extends Controller
{
    use Authorizable;
    /**
     * Display a listing of the resource.
     *
     * @param SettingDatatable $dataTable
     * @return void
     */
    public function index(SettingDatatable $dataTable)
    {
        return $dataTable->render('settings.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        return view('settings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(StoreSettingRequest $request)
    {
        Setting::create($request->validated());
        session(['success' =>'Your setting is successfully created']);
        return redirect()->route('setting.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Setting $settings
     * @return Response
     */
    public function show(Setting $settings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Setting $settings
     * @return Application|Factory|View|Response
     */
    public function edit($id)
    {
        $settings = Setting::find($id);
        return view('settings.edit',["settings" => $settings]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Setting $settings
     * @return RedirectResponse
     */
    public function update(UpdateSettingRequest $request, $id)
    {
        $settings = Setting::find($id);
        $settings->update($request->validated());
        session(['info' =>"Your setting is successfully updated"]);

        return redirect()->route('setting.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Setting $settings
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        Setting::find($id)->delete();
        session(['info' =>"Your setting is successfully deleted"]);
        return redirect()->route('setting.index');
    }
}
