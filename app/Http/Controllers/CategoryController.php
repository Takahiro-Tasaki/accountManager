<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function callAction($method, $parameters) {
        return parent::callAction($method, array_values($parameters));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumb = [
            [
                'name' => config('consts.category.CATEGORY_NAME'),
                'href' => ''
            ]
        ];
        $leftNav = [
            ['name' => 'カテゴリー', 'href' => 'category'],
            ['name' => 'サンプル', 'href' => 'sample'],
            ['name' => 'テスト', 'href' => '']
        ];
        $items = DB::table('category')->get();
        return view('category.index', [
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
                'name' => config('consts.category.CATEGORY_NAME'),
                'href' => config('consts.category.CATEGORY_PATH')
            ],
            [
                'name' => '新規登録',
                'href' => ''
            ]
        ];
        $leftNav = [
            ['name' => 'カテゴリー', 'href' => config('consts.common.ROOT_PATH') . '/category'],
            ['name' => 'サンプル', 'href' => config('consts.common.ROOT_PATH'). '/sample'],
            ['name' => 'テスト', 'href' => '']
        ];
        $items = DB::table('category')->get();
        return view('category.create', [
            'breadcrumb' => $breadcrumb,
            'leftNav'    => $leftNav,
            'items'      => $items
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
            'name' => 'required | max:20'
        ];
        $this->validate($request, $validate_rule);
        $param = [
            'name' => $request->name,
            'parent_id' => $request->parent_id
        ];
        DB::table('category')->insert($param);
        return redirect('/category');
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
                'name' => config('consts.kind.KIND_NAME'),
                'href' => config('consts.kind.KIND_PATH')
            ],
            [
                'name' => '削除',
                'href' => ''
            ]
        ];
        $leftNav = [
            ['name' => '種類', 'href' => config('consts.common.ROOT_PATH') . '/kind'],
            ['name' => 'サンプル', 'href' => config('consts.common.ROOT_PATH'). '/sample'],
            ['name' => 'テスト', 'href' => '']
        ];
        $data = DB::table('kind')->where('kind_id', $id)->first();
        return view('kind.show', [
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
                'name' => config('consts.kind.KIND_NAME'),
                'href' => config('consts.kind.KIND_PATH')
            ],
            [
                'name' => '編集',
                'href' => ''
            ]
        ];
        $leftNav = [
            ['name' => '種類', 'href' => config('consts.common.ROOT_PATH') . '/kind'],
            ['name' => 'サンプル', 'href' => config('consts.common.ROOT_PATH'). '/sample'],
            ['name' => 'テスト', 'href' => '']
        ];
        $data = DB::table('kind')->where('kind_id', $id)->first();
        return view('kind.edit', [
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
            'name' => 'required | max:20',
            'kana' => 'required | max:50'
        ];
        $this->validate($request, $validate_rule);
        $param = [
            'name'        => $request->name,
            'kana'        => $request->kana,
            'update_date' => date( 'Y-m-d H:i:s' )
        ];
        DB::table('kind')
            ->where('kind_id', $id)
            ->update($param);
        return redirect('/kind');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('kind')
            ->where('kind_id', $id)
            ->delete();
        return redirect('/kind');
    }
}
