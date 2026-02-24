<?php

namespace App\Http\Controllers\Material;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Lead;
use App\Material;
use App\MaterialAttachment;
use App\MaterialListing;
use App\Notification;
use App\Product;
use App\ProductCategory;
use App\ProductTemplate;
use Illuminate\Http\Request;

class MaterialController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        $model = str_slug('material','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $material = Material::where('lead_id', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $material = Material::paginate($perPage);
            }

            return view('material.material.index', compact('material'));
        }
        return response(view('403'), 403);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request){
        extract($request->all());
        $model = str_slug('material','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $leads = Lead::get();
            if(!empty($lead_id)){
                $leadExist=lead::findorfail($lead_id);
                return view('material.material.create',compact('leads','leadExist'));
            }

            return view('material.material.create', compact('leads'));
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
        $model = str_slug('material','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            extract($request->all());
            $material = Material::create([
//                'lead_id'=>$request->lead_id,
                'name'=>$request->name ?? null,
//                'quantity'=>$request->quantity ?? 0,
                'price'=>$request->price ?? 0,
                'status'=>$request->status ?? 0,
            ]);
//            if ($request->material_attachment!='') {
//                foreach(explode(',',$request->material_attachment) as $key => $value) {
//                    MaterialAttachment::create([
//                        'material_id' => $material->id,
//                        'name' => $value,
//                    ]);
//                }//end foreach.
//            }
//            if (isset($material) && !empty($material)) {
//                Notification::create([
//                    'lead_id' => $material->lead_id,
//                    'model'   => 'Material Created',
//                    'title'   => 'Material <b>' . $material->name . '</b> has been created for lead <b>' . $material->getLead->title . '</b> by',
//                    'icon'    => 'fas fa-industry',
//                    'time'    => $material->created_at,
//                    'user_id' => auth()->user()->id,
//                ]);
//            }//ends if.
            if ($request->view_lead != '') {
                return back()->with('flash_message', 'Material added!');
            }else{
            return redirect('material/material')->with('flash_message', 'Material added!');
        }
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
        $model = str_slug('material','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $material = Material::findOrFail($id);
            return view('material.material.show', compact('material'));
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
        $model = str_slug('material','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $material = Material::findOrFail($id);
            $leads = Lead::get();
            return view('material.material.edit', compact('material', 'leads'));
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
        $model = str_slug('material','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $material = Material::findOrFail($id);
            Material::where('id', $id)->update([
//                'lead_id'=>$request->lead_id,
                'name'=>$request->name ?? null,
//                'quantity'=>$request->quantity ?? 0,
                'price'=>$request->price ?? 0,
                'status'=>$request->status ?? 0,
            ]);
//            if ($request->material_attachment!='') {
//                foreach(explode(',',$request->material_attachment) as $key => $value) {
//                    MaterialAttachment::where('material_id', $id)->where('name', $value)->updateOrCreate([
//                        'material_id' => $material->id,
//                        'name' => $value,
//                    ]);
//                }//end foreach.
//            }
//            if (isset($material) && !empty($material)) {
//                Notification::create([
//                    'lead_id' => $material->lead_id,
//                    'model'   => 'Material Updated',
//                    'title'   => 'Material <b>' . $material->name . '</b> has been updated for lead <b>' . $material->getLead->title . '</b> by',
//                    'icon'    => 'fas fa-industry',
//                    'time'    => $material->created_at,
//                    'user_id' => auth()->user()->id,
//                ]);
//            }//ends if.
            if ($request->view_lead != '') {
                return back()->with('flash_message', 'Material updated!');
            }else {
                return redirect('material/material')->with('flash_message', 'Material updated!');
            }
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
        $model = str_slug('material','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            Material::destroy($id);

            return redirect('material/material')->with('flash_message', 'Material deleted!');
        }
        return response(view('403'), 403);
    }

    public function editMaterialModal(Request  $request, $id = null){
        extract($request->all());
        $material = Material::findOrFail($id);
        return view('material.material.edit_material_modal', compact('material'));
    }

    public function updateLeadTemplate(Request $request){
        if($request->action == 'yes'){
            MaterialListing::where('lead_id', $request->lead_id)->delete();
            Lead::where('id', $request->lead_id)->update(['product_template' => $request->template_id]);
        }
        elseif($request->action == 'keep'){
            Lead::where('id', $request->lead_id)->update(['product_template' => $request->template_id]);
        }
        else{
            Lead::where('id', $request->lead_id)->update(['product_template' => $request->template_id]);
        }
        
        return redirect("material_listing/{$request->lead_id}");
    }

    public function materialListing($id){
        $leads = Lead::get();
        $leadExist = Lead::findorfail($id);
        $templateCategories = ProductTemplate::where('categories', 'like', '%"'.$leadExist->category_id.'"%')
            ->orWhere('categories', 'like', '%'.$leadExist->category_id.'%')
            ->get();
        if ($leadExist->product_template === null && (!$leadExist->getMaterialListing || $leadExist->getMaterialListing->isEmpty())) {
            $templates = ProductTemplate::whereRaw(
                'JSON_CONTAINS(categories, ?)',
                ['"' . $leadExist->category_id . '"']
            )->get();
            $leadId = Lead::where('id', $id)->first();
            return view('material.material.select_template', compact('templates', 'leadId'));
        }
        $leadProduct = optional($leadExist->productPricingEstimateCalculator)->id;
        $productCategories = ProductCategory::whereStatus('1')->get();

        $products = Product::get();
//        $defaultProducts = Product::get()->filter(function($product) use ($leadExist) {
//            $categories = json_decode($product->default_category, true);
//            return is_array($categories) && in_array($leadExist->category_id, $categories);
//        });
        if(!$leadExist->getMaterialListing || $leadExist->getMaterialListing->isEmpty()) {
            $template = ProductTemplate::find($leadExist->product_template);
            $defaultProducts = $template ? Product::whereIn('id', $template->templateProducts()->orderBy('sort_index')->pluck('product_id'))->get() : collect();
        }
        else{
//            $defaultProducts = Product::get()->filter(function($product) use ($leadExist) {
//            $categories = json_decode($product->default_category, true);
//            return is_array($categories) && in_array($leadExist->category_id, $categories);
//            });
            $templateProductIds = [];
            $templateProducts = collect();

            if ($leadExist->product_template) {
                $template = ProductTemplate::find($leadExist->product_template);
                if ($template) {
                    $templateProductIds = $template->templateProducts()->orderBy('sort_index')->pluck('product_id')->toArray();
                    $templateProducts = Product::whereIn('id', $templateProductIds)->orderByRaw("FIELD(id, " . implode(',', $templateProductIds) . ")")->get();
                }
            }

            // Get category products not in template
            $categoryProducts = Product::get()->filter(function($product) use ($leadExist, $templateProductIds) {
                $categories = json_decode($product->default_category, true);
                return is_array($categories) &&
                    in_array($leadExist->category_id, $categories) &&
                    !in_array($product->id, $templateProductIds);
            });

            // Merge both collections
            $defaultProducts = $templateProducts->merge($categoryProducts);
        }

        $listings = MaterialListing::where('lead_id', $id)->get();
        $listedMaterialIds = $listings->where('lead_id', $leadExist->id)->pluck('material_id')->toArray();
//        $listings = Product::where('lead_id', $id)->get();
        $groupedMaterials = $listings->groupBy('material_id')->map(function ($group) {
            $latestRecord = $group->sortByDesc('delivery_date')->first();
            return [
                'lead' => $group->first()->lead_id,
                'delivery_date' => $latestRecord->delivery_date,
                'material' => $group->first()->getMaterial,
                'delivered' => $group->where('status', 'delivered')->sum('quantity'),
                'added' => $group->where('status', 'added')->sum('quantity'),
                'leftover' => $group->where('status', 'leftover')->sum('quantity'),
                'used' => ($delivered = $group->where('status', 'delivered')->sum('quantity')) +
                    ($added = $group->where('status', 'added')->sum('quantity')) -
                    ($leftover = $group->where('status', 'leftover')->sum('quantity')),
                'unit_price' => $group->first()->getMaterial->price ?? 0,
                'price' => (($delivered + $added - $leftover) * ($group->first()->getMaterial->price ?? 0))
            ];
        });
        return view('material.material.material_listing', compact('groupedMaterials', 'defaultProducts', 'leadExist', 'products', 'productCategories', 'leads', 'listedMaterialIds', 'leadProduct', 'templateCategories'));
    }


}
