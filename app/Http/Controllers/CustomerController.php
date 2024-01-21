<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    function create() {
        // $posts = customer::orderBy('created_at','desc')->paginate(2);
        $posts = customer::when(request('searchKey'),function($p) {
            $p->orWhere('title','like','%'.request('searchKey').'%')->orWhere('description','like','%'.request('searchKey').'%');
        })->orderBy('created_at','desc')->paginate(3);

        return view('contact',compact('posts'));
        // $posts = customer::where('id','<','10')->where('address','mandalay')->get();
        // $posts = customer::get()->last();
        // $posts = customer::first();
        // $posts = customer::all();
        // $posts = customer::pluck('title','price');
        // $posts = customer::select('title','address')->get();
        // $posts = customer::where('id','<','10')->pluck('title');
        // $posts = customer::all()->random();
        // $posts = customer::all()->where('id','<',10)->random();
        // $posts = customer::where('id','<',40)->where('address','kume')->get();
        // $posts = customer::orWhere('id','<',40)->orWhere('address','kume')->get();
        // $posts = customer::orderBy('id','desc')->get();
        // $posts = customer::orderBy('id','asc')->get();
        // $posts = customer::select('id','price','title','address')
        // ->where('address','pyay')
        // ->whereBetween('price',[3000,6000])
        // ->orderBy('price','asc')
        // ->dd();

        // $posts = DB::table('customers')->select('id','price','title','address')
        // ->where('address','pyay')
        // ->whereBetween('price',[3000,6000])
        // ->orderBy('price','asc')
        // ->dd();

        // $posts = customer::where('address','kume')->orderBy('price','asc')->value('title');
        // $posts = customer::find(3);
        // $posts = customer::where('id',3)->get();
        // $posts = customer::min('price');
        // $posts = customer::avg('price');
        // $posts = customer::where('address','kume')->exists();
        // $posts = customer::where('address','kume')->doesntExist();
        // $posts = customer::select('id','title as post_title')->get()->toArray();
        // $posts = customer::select('address',DB::raw('count(address) as user_address'))->groupBy('address')->get()->toArray();
        // $posts = customer::select('address',DB::raw('count(address) as user_address'),DB::raw('MAX(price) as user_price'))->groupBy('address')->get()->toArray();
        // $posts = customer::select('address',DB::raw('count(address) as user_address'),DB::raw('SUM(price) as user_price'))->groupBy('address')->get()->toArray();
        // dd($posts);

        // map each through

        // $posts = customer::paginate(5)->map(function($p) {
        //     $p->title = strtoupper($p->title);
        //     $p->description = strtoupper($p->description);
        //     $p->price = $p->price * 2;
        //     return  $p;
        // });
        // $posts = customer::paginate(5)->through(function($p) {
        //         $p->title = strtoupper($p->title);
        //         $p->description = strtoupper($p->description);
        //         $p->price = $p->price * 2;
        //         return  $p;
        //     });
        // dd($posts->toArray());
        // $searchKey = $_REQUEST['key'];
        // $posts = customer::where('title','like','%'.$searchKey.'%')->get()->toArray();
        // $posts = customer::when($_REQUEST['key'],function($p) {
        //     // $searchKey = $_REQUEST['key'];
        //     $p->where('title','like','%'.$_REQUEST['key'].'%');
        // })->get();
        // dd($posts->toArray());

    }


    function createPost(Request $request) {

        // first way
        // Validator::make($request->all(),[
        //     'postTitle' => 'required',
        //     'postDescirption' => 'required'
        // ])->validate();

        // second way

        // dd($request->hasFile('postImage') ? 'yes' : 'no');
        // dd($request->file('postImage')->path());
        // dd($request->file('postImage')->extension());
        // dd($request->file('postImage')->getClientOriginalName());
        // dd($request->file('postImage'));

        $getData = $this->getdata($request);
        $this->errorData($request);


        if ($request->hasFile('postImage')) {
            $filename =uniqid() . $request->file('postImage')->getClientOriginalName();
            $request->file('postImage')->storeAs('public',$filename);
            $getData['image'] = $filename;
        }

        customer::create($getData);

        // return view('contact');
        // dd($data);
        return back()->with(['patten'=>'Post ဖန်တီးခြင်းအောင်မြင်ပါသည်']);
        // return redirect('testing');
        // return redirect()->route('test');
    }

    public function createDelete($id) {
        // first way
        // customer::where('id',$id)->delete();
        // second way
        customer::find($id)->delete();
        return back();
    }


    // DELETE DATA
    public function createUpdate($id) {
        $ppe= customer::where('id',$id)->get();
        return view('read',compact('ppe'));
    }

    public function createEdit($id) {
        $ppe= customer::where('id',$id)->get()->toArray();
        return view('edit',compact('ppe'));
    }



    // get data
    public function createData(Request $request) {
        $this->errorData($request);
        $redata = $this->getdata($request);
        $id =$request->postid;

        if ($request->hasFile('Image')) {

            // delete image
            $oldname = customer::select('image')->where('id',$request->postid)->get();
            $oldname = $oldname[0]['image'];

            if($oldname != null){
                Storage::delete('public/'.$oldname);
            }

            $filename =uniqid() . $request->file('Image')->getClientOriginalName();
            $request->file('Image')->storeAs('public',$filename);
            $redata['image'] = $filename;
        }

        $update = customer::where('id',$id)->update($redata);
        return redirect()->route('customer#page')->with(['data'=>'Data ပြင်ဆင်မှုအောင်မြင်ပါသည်']);
    }





    private function getdata($req){
        $data = [
            'title'=> $req->postTitle,
            'description'=> $req->postDescirption,
        ];

        $data['price'] = $req->postPrice == null ? 2000 : $req->postPrice;
        $data['address'] = $req->postAddress == null ? 'Kume' : $req->postAddress;
        $data['range'] = $req->postRange == null ? 6 : $req->postRange;

        return($data);

    }
    // second way
    // $data = [

    //     'title'=> $req->postTitle,
    //     'description'=> $req->postDescription
    // ];
    // return $data;

    private function errorData($request) {
        $data=[
            'postTitle' => 'required|min:5|max:20|unique:customers,title,'.$request->postid,
            'postDescirption' => 'required',
            // 'postPrice' => 'required',
            // 'postAddress' => 'required',
            // 'postRange' =>'required',
            'postImage' => 'mimes:jpg,bmp,png|file'

        ];
        $dataMessage = [
            'postTitle.required' => 'Data တည့်ရန်လိုအပ်ပါသည်',
            'postTitle.max' => 'ဂဏန်း ၂၀ လုံးထက်မပိုရ',
            'postTitle.min' => 'ဂဏန်း ၅ လုံးအောက်မရိုက်ရ',
            'postTitle.unique' => 'တခြား name ပေးပါ',
            'postDescirption' => 'Data တည့်ရန်လိုအပ်ပါသည်',
            'postPrice' => 'Price ထည့်ရန်လိုအပ်ပါသည်',
            'postAddress' => 'Address ထည့်ရန်လိုအပ်ပါသည်',
            'postRange' => 'Range ထည့်ရန်လိုအပ်ပါသည်',
            'postImage.mimes' => 'jpg bmp png file type ထည့်ရန်'
        ];
        Validator::make($request->all(),$data,$dataMessage)->validate();

    }
}
