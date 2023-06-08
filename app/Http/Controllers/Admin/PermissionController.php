<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $permissions = Permission::all();
    return response()->view('pages.spatie.permissions.index', compact('permissions'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return response()->view('pages.spatie.permissions.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    try {
        $input = $request->all();
        $request->validate([
            'name'       => 'bail|required|string',
            // 'guard_name' => 'bail|required|string',
        ]);
        $permission = Permission::create($input);
        return redirect()->route('permissions.create')->with('success', __('trans_notification.saved'));
    } catch (\Exception $e) {
        return redirect()->back()->with('error', $e->getMessage());
    }

  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    dd('Show Permissions');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $permission = Permission::findOrFail($id);
    return response()->view('pages.spatie.permissions.edit', compact('permission'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    try {
        $permission = Permission::findOrFail($id);
        $input = $request->all();
        $request->validate([
            'name'       => 'bail|required|string',
            // 'guard_name' => 'bail|required|string',
        ]);

      $updatePermission = $permission->update($input);
      return redirect()->route('permissions.index')->with('success', __('trans_notification.saved'));

    } catch (\Exception $e) {
        return redirect()->back()->with('error', $e->getMessage());
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $permission = Permission::destroy($id);
    // session()->flash('delete');
    return redirect()->route('permissions.index')->with('warning', __('trans_notification.deleted'));
  }
}
