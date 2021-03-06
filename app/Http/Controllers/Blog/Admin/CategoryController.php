<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\BlogCategoryCreateRequest;
use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Models\BlogCategory;
use App\Repositories\BlogCategoryRepository;


class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $paginator = BlogCategory::paginate(5);

        return view('blog.admin.categories.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        {
            $item = new BlogCategory();
            $categoryList = BlogCategory::all();

            return view('blog.admin.categories.edit', compact('item', 'categoryList'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogCategoryCreateRequest $request)
    {
        $data = $request->input();
        if (empty($data['slug'])) {
            $data['slug'] = str_slug($data['title']);
        }
 //       dd($data);

        // Создаст обьект но не добавит в БД
/*                $item = new BlogCategory($data);
                dd($item);
                $item->seve();*/

        // Создаст обьект и добавит в БД
        $item = (new BlogCategory())->create($data);
   //     dd($item);

        if ($item) {
            return redirect()->route('blog.admin.categories.edit', [$item->id])
                ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, BlogCategoryRepository $categoryRepository)
    {
//        $item = BlogCategory::findOrFail($id);
//        $categoryList = BlogCategory::all();
        $item = $categoryRepository->getEdit($id);
        $categoryList = $categoryRepository->getForComboBox();

        return view('blog.admin.categories.edit', compact('item', 'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogCategoryUpdateRequest $request, $id)
    {
//        dd(__METHOD__, $id, $request->all(), $id);
        /*        $rules = [
                    'title' => 'required|min:5|max:200',
                    'slug' => 'max:200',
                    'description' => 'string|max:500|min:3',
                    'parent_id' => 'required|integer|exists:blog_categories,id',
                ];*/
//        $validatedData = $this->validate($request, $rules);
//        $validatedData = $request->validate($rules);

//        dd($validatedData);

        $item = BlogCategory::find($id);


        if (empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись id[{$id}] не найдена"])
                ->withInput();
        }
$data = $request->all();
        if (empty($data['slug'])) {
            $data['slug'] = str_slug($data['title']);
        }

        $result = $item->update($data);

        if ($result) {
            return redirect()
                ->route('blog.admin.categories.edit', $item->id)
                ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранение'])
                ->withInput();
        }
    }
}
