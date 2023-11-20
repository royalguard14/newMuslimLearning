<?php

namespace App\Http\Controllers;

use App\Models\Design;
use Illuminate\Http\Request;
use DB;
use Storage;
use Artisan;

class DesignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Design  $design
     * @return \Illuminate\Http\Response
     */
    public function show(Design $design)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Design  $design
     * @return \Illuminate\Http\Response
     */
    public function edit(Design $design)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Design  $design
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        //mode
        if ($request->LetterNeed == 'on') {
        DB::table('designs')->where('id',1)->update([
        'class'=> 'dark-mode',
        ]);

        }
        else{
        DB::table('designs')->where('id',1)->update([
        'class'=> 'light-mode',
        ]);
        }


        //webmode
        if ($request->websiteswitch == 'on') {
        DB::table('designs')->where('id',26)->update([
        'class'=> 'on',
        
        ]);
        str_replace(file_get_contents(Storage_path('installed')),"Laravel Installer","front-on Laravel Installer");
        }
        else{
        DB::table('designs')->where('id',26)->update([
        'class'=> 'off',
        ]);
        str_replace(file_get_contents(Storage_path('installed')),"Laravel Installer","front-off Laravel Installer");
        }


        //maintenance
        if ($request->menteswitch == 'on') {
        DB::table('designs')->where('id',2)->update([
        'class'=> 'on',
        ]);

        }
        else{
        DB::table('designs')->where('id',2)->update([
        'class'=> 'off',
        ]);
        }







        //Brand Logo Variants
                if ($request->logocol !== null) {
     DB::table('designs')->where('id',25)->update(['class'=> $request->logocol]);

        }
  

        //Navbar Variants
                if ($request->navbar_variants !== null) {
     DB::table('designs')->where('id',22)->update(['class'=> $request->navbar_variants]);

        }

        //Accent Color Variants
                if ($request->accentcol !== null) {
     DB::table('designs')->where('id',23)->update(['class'=> $request->accentcol]);

        }


        //Sidebar Variants
                if ($request->sbcol !== null) {
     DB::table('designs')->where('id',24)->update(['class'=> $request->sbcol]);

        }

         return redirect('access_control_group')->with('is_success', 'Module was successfully saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Design  $design
     * @return \Illuminate\Http\Response
     */
    public function destroy(Design $design)
    {
        //
    }


    public function installer_database(){






    $installedLogFile = storage_path('installed');

    if (! file_exists($installedLogFile)) {
            $env = base_path('.env');
            $d_env = base_path('.env.example');
            copy($d_env, $env);
            
        return view('vendor.installer.welcome');
    }
    else{   
   
        if (DB::table('designs')->where('id',26)->first()->class == 'on') { 
            
            return view('welcome');
        }
        else{
            return redirect('/login');
        }
    }
    }
}
