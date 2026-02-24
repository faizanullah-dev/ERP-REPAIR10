<?php

namespace App\Http\Controllers\ProgressBoardCategory;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\ProgressBoardCategory;
use Illuminate\Http\Request;

class ProgressBoardCategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */

    public function index(Request $request)
    {
        $model = str_slug('progressboardcategory','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $progressboardcategory = ProgressBoardCategory::where('progress_board_id', 'LIKE', "%$keyword%")
                ->orWhere('category_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $progressboardcategory = ProgressBoardCategory::paginate($perPage);
            }

            return view('progressBoardCategory.progress-board-category.index', compact('progressboardcategory'));
        }
        return response(view('403'), 403);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $model = str_slug('progressboardcategory','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('progressBoardCategory.progress-board-category.create');
        }
        return response(view('403'), 403);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $model = str_slug('progressboardcategory','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            ProgressBoardCategory::create($requestData);
            return redirect('progressBoardCategory/progress-board-category')->with('flash_message', 'ProgressBoardCategory added!');
        }
        return response(view('403'), 403);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $model = str_slug('progressboardcategory','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $progressboardcategory = ProgressBoardCategory::findOrFail($id);
            return view('progressBoardCategory.progress-board-category.show', compact('progressboardcategory'));
        }
        return response(view('403'), 403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $model = str_slug('progressboardcategory','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $progressboardcategory = ProgressBoardCategory::findOrFail($id);
            return view('progressBoardCategory.progress-board-category.edit', compact('progressboardcategory'));
        }
        return response(view('403'), 403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $model = str_slug('progressboardcategory','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $progressboardcategory = ProgressBoardCategory::findOrFail($id);
             $progressboardcategory->update($requestData);

             return redirect('progressBoardCategory/progress-board-category')->with('flash_message', 'ProgressBoardCategory updated!');
        }
        return response(view('403'), 403);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $model = str_slug('progressboardcategory','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            ProgressBoardCategory::destroy($id);

            return redirect('progressBoardCategory/progress-board-category')->with('flash_message', 'ProgressBoardCategory deleted!');
        }
        return response(view('403'), 403);

    }
}
