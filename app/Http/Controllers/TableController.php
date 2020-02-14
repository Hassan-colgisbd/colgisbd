<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Redirect;
//use DB;
use Route;
use Session;
//use Illuminate\Pagination\Paginator;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd($allData);
        $allData=DB::table('haisou')->simplePaginate(5);
        $total=DB::table('haisou')->count();
        $thisPage=count($allData);
        
        return view('haisou.tableHome',['allData'=>$allData,'total'=>$total]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function insertData(Request $request)
    {
        $bango=$request->bango;


        if($bango!=null){

            
            $this->validate($request,[
            'name'=>'required|max:10',
            'address'=>'required|max:100',
            'tel'=>'required|max:10',
             ]);

         $name=$request->name; 
         $address=$request->address;
         $tel=$request->tel;

        // return redirect('/')->with('msg','Bango field input in restricted');

         return Redirect::to('/')->with('message','Bango field input is restricted.');

        }

        else{

            $this->validate($request,[
            'name'=>'required|max:10',
            'address'=>'required|max:100',
            'tel'=>'required|max:10',
             ]);


         $name=$request->name; 
         $address=$request->address;
         $tel=$request->tel;

         $insert=DB::table('haisou')->insert([
            'name'=>$name,
            'address'=>$address,
            'tel'=>$tel,
         ]);

         return redirect('/'); 
     }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function selectData(Request $request)
    {
        //dd($request->all());
        //$hideId=$request->input('hideId');

        $this->validate($request,[
            'selectId'=>'required',
        ]);

        $total=DB::table('haisou')->count();

        $selectId=$request->selectId;

        $dataById=DB::table('haisou')->where('bango',$selectId)->get();
        
        // return $dataById[0]->bango;
        return view('haisou.editData',['dataById'=>$dataById,'total'=>$total]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateData(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|max:10',
            'address'=>'required|max:100',
            'tel'=>'required|max:10',
        ]);


        $dataId=$request->dataId;
        $name=$request->name;
        $address=$request->address;
        $tel=$request->tel;

        $update=DB::table('haisou')->where('bango',$dataId)
                                   ->update([
                                    'name'=>$name,
                                    'address'=>$address,
                                    'tel'=>$tel,
                                   ]);


        return redirect('/');

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteData($id)
    {
    
        DB::table('haisou')->where('bango', $id)->delete();

        return redirect('/');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function searchData(Request $request)
    {
        $bango=$request->bango;
        $name=$request->name;
        $address=$request->address;
        $tel=$request->tel;

        $allData=DB::table('haisou')
                    ->where('bango',$bango)
                    ->orWhere('name',$name)
                    ->orWhere('address',$address)
                    ->orWhere('tel',$tel)
                    ->get();
                    //->paginate(5);
                    

        $total=DB::table('haisou')->count();

        if(count($allData)>0){

         return view('haisou.searchResult',['allData'=>$allData,'total'=>$total]);

        }
        else{
            //return redirect('/');
            return view('haisou.searchResult',['allData'=>$allData,'total'=>$total]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // public function sortBangoData()
    // {
    //     $sortOrder =session()->get('sortOrder', 'desc');
    //     $allData=DB::table('haisou')->orderBy('bango',$sortOrder)->simplePaginate(5);

    //     $sortOrder = $sortOrder == 'desc' ? 'asc': 'desc';
    //     session()->put('sortOrder', $sortOrder);
        
    //     $total=DB::table('haisou')->count();
    //     $thisPage=count($allData);


    //     return view('haisou.tableHome',['allData'=>$allData,'total'=>$total]);

    // }


    public function ascBangoData()
    {
    
       // session()->forget('bangoOrder');
        session()->put('bangoOrder', 'desc');
        $allData=DB::table('haisou')->orderBy('bango','asc')->simplePaginate(5);
        $total=DB::table('haisou')->count();
        $thisPage=count($allData);


        return view('haisou.tableHome',['allData'=>$allData,'total'=>$total]);
    }

    public function descBangoData()
    {
    
        session()->put('bangoOrder', 'asc');
        $allData=DB::table('haisou')->orderBy('bango','desc')->simplePaginate(5);
        $total=DB::table('haisou')->count();
        $thisPage=count($allData);


        return view('haisou.tableHome',['allData'=>$allData,'total'=>$total]);
    }


    // public function sortNameData()
    // {
    //     $sortOrder ='asc';

    //     //$sortOrder =session()->get('sortOrder', 'asc');

    //     $allData=DB::table('haisou')->orderBy('name',$sortOrder)->simplePaginate(5);

    //     // dd(count($allData));

    //     // $sortOrder = $sortOrder == 'asc' ? 'desc': 'asc';
    //     // session()->put('sortOrder', $sortOrder);
    //      if($sortOrder ==='asc'){
    //         $sortOrder=='desc';
    //      }
    //      else{
    //         $sortOrder=='asc';
    //      }

    //     $total=DB::table('haisou')->count();
    //     $thisPage=count($allData);
        
    //     // return count($allData);
    //     return view('haisou.tableHome',['allData'=>$allData,'total'=>$total]);

    // }

    public function ascNameData()
    {   
        session()->put('nameOrder', 'desc');
        $allData=DB::table('haisou')->orderBy('name','asc')->simplePaginate(5);
        $total=DB::table('haisou')->count();
        $thisPage=count($allData);
        
        return view('haisou.tableHome',['allData'=>$allData,'total'=>$total]);
    }

    public function descNameData()
    {   
        session()->put('nameOrder', 'asc');
        $allData=DB::table('haisou')->orderBy('name','desc')->simplePaginate(5);
        $total=DB::table('haisou')->count();
        $thisPage=count($allData);
        
        return view('haisou.tableHome',['allData'=>$allData,'total'=>$total]);
    }

    
    // public function sortAddressData()
    // {
    //     $sortOrder =session()->get('sortOrder', 'asc');
    //     $allData=DB::table('haisou')->orderBy('address',$sortOrder)->simplePaginate(5);

    //     $sortOrder = $sortOrder == 'asc' ? 'desc': 'asc';
    //     session()->put('sortOrder', $sortOrder);

    //     $total=DB::table('haisou')->count();
    //     $thisPage=count($allData);
        
    //     return view('haisou.tableHome',['allData'=>$allData,'total'=>$total]);
    // }

    public function ascAddressData()
    {
        session()->put('addressOrder', 'desc');
        $allData=DB::table('haisou')->orderBy('address','asc')->simplePaginate(5);
        $total=DB::table('haisou')->count();
        $thisPage=count($allData);
        
        return view('haisou.tableHome',['allData'=>$allData,'total'=>$total]);
    }

    public function descAddressData()
    {
        session()->put('addressOrder', 'asc');
        $allData=DB::table('haisou')->orderBy('address','desc')->simplePaginate(5);
        $total=DB::table('haisou')->count();
        $thisPage=count($allData);
        
        return view('haisou.tableHome',['allData'=>$allData,'total'=>$total]);
    }

    

    // public function sortTelData()
    // {
    //     $sortOrder =session()->get('sortOrder', 'asc');
    //     $allData=DB::table('haisou')->orderBy('tel',$sortOrder)->simplePaginate(5);

    //     $sortOrder = $sortOrder == 'asc' ? 'desc': 'asc';
    //     session()->put('sortOrder', $sortOrder);

    //     $total=DB::table('haisou')->count();
    //     $thisPage=count($allData);
        
    //     return view('haisou.tableHome',['allData'=>$allData,'total'=>$total]);
    // }


    public function ascTelData()
    {
        session()->put('telOrder', 'desc');
        $allData=DB::table('haisou')->orderBy('tel','asc')->simplePaginate(5);
        $total=DB::table('haisou')->count();
        $thisPage=count($allData);
        
        return view('haisou.tableHome',['allData'=>$allData,'total'=>$total]);
    }

     public function descTelData()
    {
        session()->put('telOrder', 'asc');
        $allData=DB::table('haisou')->orderBy('tel','desc')->simplePaginate(5);
        $total=DB::table('haisou')->count();
        $thisPage=count($allData);
        
        return view('haisou.tableHome',['allData'=>$allData,'total'=>$total]);
    }


}
