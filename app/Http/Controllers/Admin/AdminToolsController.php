<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use App\Models\Tools;



class AdminToolsController extends Controller
{
    public function index() {
        $tools = Tools::all();
        dd($tools);
    }

    public function create() {
        
    }

    public function store(Request $requests) {
        $requests->validate([
            'name_tools' => 'required',
            'logo_tools' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        $images = $requests->logo_tools;
        $imagesGetNewName = Str::random(10).$images->getClientOriginalName();
        $images->storeAs('public/images/logoTools/'.$imagesGetNewName);
                    
        Tools::create([
            'name_tools' => $requests->name_tools,
            'logo_tools' => $imagesGetNewName, 
        ]);
        
        return response()->json([
            'message' => 'Data berhasil dibuat'
        ], 200);
    }

    public function edit() {
        
    }

    public function update(Request $requests, $id) {
        $requests->validate([
            'name_tools' => 'required',
        ]);

        $tools = Tools::findOrFail($id);
        
        $images = $requests->logo_tools;
        
        if($images) {
            $imagesGetNewName = Str::random(10).$images->getClientOriginalName();
            $images->storeAs('public/images/logoTools/'.$imagesGetNewName);
            $data['logo_tools'] = $imagesGetNewName;
        }
        else {
            $data['logo_tools'] = $tools->logo_tools;
        }
        
        $tools->update([
            'name_tools' => $requests->name_tools,
            'logo_tools' => $data['logo_tools'],
        ]);     

        return response()->json([
            'message' => 'Data berhasil diedit'
        ], 200);
    }

    public function delete($id) {
        $tools = Tools::findOrFail($id); 
        Storage::disk('public')->delete('images/logoTools/'.$tools->logo_tools);
        $tools->delete();
        
        return response()->json([
            'message' => 'Data berhasil dihapus'
        ], 200);
    }
}