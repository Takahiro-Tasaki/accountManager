<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    private $current_id;
  
    public function callAction($method, $parameters) {
        return parent::callAction($method, array_values($parameters));
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $breadcrumb = [
            [
                'name' => config('consts.user.USER_NAME'),
                'href' => ''
            ]
        ];
        $leftNav = [
            ['name' => 'ユーザー', 'href' => 'user'],
            ['name' => 'サンプル', 'href' => 'sample'],
            ['name' => 'テスト', 'href' => '']
        ];
        $items = DB::table('users')
                  ->leftjoin('users_ex', 'users.id', '=', 'users_ex.user_id')
                  ->paginate(3);
        return view('user.index', [
            'breadcrumb' => $breadcrumb,
            'leftNav'    => $leftNav,
            'items'      => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumb = [
            [
                'name' => config('consts.user.USER_NAME'),
                'href' => config('consts.user.USER_PATH')
            ],
            [
                'name' => '新規',
                'href' => ''
            ]
        ];
        $leftNav = [
            ['name' => 'ユーザー', 'href' => config('consts.common.ROOT_PATH') . '/user'],
            ['name' => 'サンプル', 'href' => config('consts.common.ROOT_PATH'). '/sample'],
            ['name' => 'テスト', 'href' => '']
        ];
        $this->current_id = $_GET['id'];
        $data = DB::table('users')
                    ->leftjoin('users_ex', 'users.id', '=', 'users_ex.user_id')
                    ->where('users.id', $this->current_id)
                    ->first();
        
        return view('user.create', [
            'breadcrumb' => $breadcrumb,
            'leftNav'    => $leftNav,
            'data'       => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validate_rule = [
          'auth' => 'required | min:1 | max:99'
      ];
      $this->validate($request, $validate_rule);

      if( is_null( $request->file('image') ) ) {
        $image_path = null;
      } else {
        $path = $request->file('image')->store('public/users');
        $image_path = basename($path);
      }

      $param = [
          'user_id'     => $request->user_id,
          'image'       => $image_path,
          'auth'        => $request->auth
      ];
      DB::table('users_ex')->insert($param);
      return redirect('/user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $breadcrumb = [
            [
                'name' => config('consts.user.USER_NAME'),
                'href' => config('consts.user.USER_PATH')
            ],
            [
                'name' => 'show',
                'href' => ''
            ]
        ];
        $leftNav = [
            ['name' => 'ユーザー', 'href' => config('consts.common.ROOT_PATH') . '/user'],
            ['name' => 'サンプル', 'href' => config('consts.common.ROOT_PATH'). '/sample'],
            ['name' => 'テスト', 'href' => '']
        ];
        $this->current_id = $id;
        $data = DB::table('users')
                    ->leftjoin('users_ex', 'users.id', '=', 'users_ex.user_id')
                    ->where('users.id', $id)
                    ->first();
        
        return view('user.show', [
            'breadcrumb' => $breadcrumb,
            'leftNav'    => $leftNav,
            'data'       => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $breadcrumb = [
            [
                'name' => config('consts.user.USER_NAME'),
                'href' => config('consts.user.USER_PATH')
            ],
            [
                'name' => '編集',
                'href' => ''
            ]
        ];
        $leftNav = [
            ['name' => 'ユーザー', 'href' => config('consts.common.ROOT_PATH') . '/user'],
            ['name' => 'サンプル', 'href' => config('consts.common.ROOT_PATH'). '/sample'],
            ['name' => 'テスト', 'href' => '']
        ];
        $this->current_id = $id;
        $data = DB::table('users')
                    ->leftjoin('users_ex', 'users.id', '=', 'users_ex.user_id')
                    ->where('users.id', $id)
                    ->first();
        
        return view('user.edit', [
            'breadcrumb' => $breadcrumb,
            'leftNav'    => $leftNav,
            'data'       => $data
        ]);
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
        $validate_rule = [
            'auth' => 'required | min:1 | max:99'
        ];
        $this->validate($request, $validate_rule);
        $data = DB::table('users_ex')->where('user_id', $id)->first();
        
        if( is_null( $request->file('image') ) ) {
            $image_path = $data->image;
        } else {
            Storage::delete('public/users/' . $data->image);
            $path       = $request->file('image')->store('public/users');
            $image_path = basename($path);
        }
        $param = [
            'image'       => $image_path,
            'auth'        => $request->auth,
            'update_date' => date( 'Y-m-d H:i:s' )
        ];
        DB::table('users_ex')
            ->where('user_id', $id)
            ->update($param);
        return redirect('/user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            // ユーザー情報を削除
            $data = DB::table('users_ex')->where('user_id', $id)->first();
            if( !is_null( $data->image ) ) {
                Storage::delete('public/users/' . $data->image);
            }
            DB::table('users_ex')
                ->where('user_id', $id)
                ->delete();
            // ユーザーを削除
            DB::table('users')
                ->where('id', $id)
                ->delete();
        }, 3);
        return redirect('/user');
    }
}
