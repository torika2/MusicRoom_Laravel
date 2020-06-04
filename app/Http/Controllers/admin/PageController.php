<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\File;
use App\admin\Instrument;
use App\admin\InstrumentCategory;
use App\admin\InstrumentModel;
use App\admin\Post;
use App\User;
use App\admin\UserInfo;

class PageController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    	$this->middleware('admin');
    }

    public function adminHome()
    {
    	return view('admin.home');
    }

    public function adminProfile()
    {
    	$user = User::all();
    	$userInfo = UserInfo::all();

    	return view('admin.profile',compact('user','userInfo'));
    }

    public function adminInstrument()
    {
         $instruments = Instrument::selectRaw("`model_title`,`category_title`,`instr_name`,left(`instr_desc`,40) as 'min_text',`instr_desc`,`instr_id`, `instr_name`, `instr_model`, `instr_desc`, `instr_exist`, `instr_price`,`image_url`")->join('instrument_categories','instr_category_id','category_id')->join('instrument_models','instr_model_id','instruments.instr_model')->orderby('instr_id','DESC')->get();

    	return view('admin.instruments',compact('instruments'));
    }

    public function add_instrument_category(Request $request)
    {
    	$this->validate($request,[
    		'category_name' => 'required|string|max:255'
    	]);

    	$isCategoryExist = InstrumentCategory::where('category_title',$request->category_name)->count();

    	if ($isCategoryExist) {
    		return 0;
    	}else{
	    	InstrumentCategory::insert([
	    		'category_title' => $request->category_name
	    	]);
	    	return 1;
    	}
    }

    public function get_instrument_category()
    {
    	$instrument_category = InstrumentCategory::all();
    	
    	return view('admin.ajax.getInstrumentCategory',compact('instrument_category')); 
    }

    public function add_instrument_model(Request $request)
    {
    	$this->validate($request,[
    		'category_id' => 'required|numeric',
    		'instrument_model' => 'required|string|max:255'
    	]);

    	if ($request->category_id == 0) {
    		return 2;
    	}

    	$isModelExist = InstrumentModel::where('model_title',$request->instrument_model)->count();

    	if ($isModelExist) {
    		return 0;
    	}else{
    		InstrumentModel::insert([
    			'category_id' => $request->category_id,
    			'model_title' => $request->instrument_model
    		]);
    		return 1;
    	}
    }

    public function get_instrument_model(Request $request)
    {
    	$this->validate($request,[
    		'category_id' => 'required|numeric',
    	]);

    	$myInfo = InstrumentModel::where('category_id',$request->category_id)->get();

    	return view('admin.ajax.getInstrumentModel',compact('myInfo'));
    }

    public function add_instrument(Request $request)
    {
    	$this->validate($request,[
    		'instrument_category' => 'required|numeric',
    		'instrument_model_category' => 'required|string|max:255',
    		'instrument_name' => 'required|string|max:255',
    		'instrument_price' => 'required|numeric',
            'instrument_image' => 'required|image|mimes:png,jpeg,jpg',
    		'instrument_desc' => 'required|string|max:500'
    	]);

        if($request->hasFile('instrument_image')) {
            $image = time().'.'.$request->file('instrument_image')->getClientOriginalExtension();
        	$isInstrumentExist = Instrument::where('instr_name',$request->instrument_name)->count();

        	if (!$isInstrumentExist) {
        		Instrument::insert([
                    'instr_name' => $request->instrument_name,
                    'instr_model' => $request->instrument_model_category,
                    'instr_desc' => $request->instrument_desc,
                    'instr_price' => $request->instrument_price,
                    'image_url' => $image,
                    'category_id' => $request->instrument_category
                ]);

            $request->instrument_image->move(public_path('images/instrumentImages'),$image);
                return 1;
        	}
        }
        return 0;
    }

    public function delete_instrument(Request $request)
    {
        $this->validate($request,[
            'instr_id' => 'required|numeric',
        ]);

        $isInstrumentExist = Instrument::join('instrument_models','instr_model','instr_model_id')->count();

        if ($isInstrumentExist){
            foreach (Instrument::where('instr_id',$request->instr_id)->get() as $instr) {
                $path = public_path('images\/instrumentImages\/'.$instr->image_url);
                \File::delete($path);
                Instrument::join('instrument_models','instr_model','instr_model_id')->where('instr_id',$request->instr_id)->delete();
            }
                return 1;
        }
        return 0;
    }

    public function get_all_insturment()
    {
        $instruments = Instrument::selectRaw("`model_title`,`category_title`,`instr_name`,left(`instr_desc`,40) as 'min_text',`instr_desc`,`instr_id`, `instr_name`, `instr_model`, `instr_desc`, `instr_exist`, `instr_price`,`image_url`")->join('instrument_categories','instr_category_id','category_id')->join('instrument_models','instr_model_id','instruments.instr_model')->orderby('instr_id','DESC')->get();
        $category = InstrumentCategory::all();

        return view('admin.ajax.getInstrument',compact('instruments','category'));
    }
}
