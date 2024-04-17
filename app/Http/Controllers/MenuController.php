<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\ParentMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }


    public function index()
    {
        $parent = ParentMenu::all();
        $data = array(
            'parent' => $parent
        );
        return view('menu.menu', $data);
    }

    public function createMenu(Request $request)
    {
        $input = $request->all();
        $params = array(
            'parent_id' => $input['parent'],
            'label' => $input['menu'], 
            'url' => $input['url'], 
        );
        $create = Menu::create($params);
        return response()->json(['success' => true, 'message' => 'Menu berhasil dibuat', 'user' => $create]);
    }

    public function getMenu(Request $request)
    {
        $menu = DB::table('menu')
                    ->leftJoin('parent_menu', 'menu.parent_id', '=', 'parent_menu.id')
                    ->select('menu.*','parent_menu.label as parent_name')
                    ->get();

        $data = array(
            'menu' => $menu
        );

        $response = array(
            'success' => true,
            'content' => view('menu.table', $data)->render()
        );

        return response()->json($response);
    }
}
