<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\SubscriptionPackage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class AdminSubscriptionPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $name = isset($_GET['name']) ? $_GET['name'] : '';
        $status = isset($_GET['status']) ? $_GET['status'] : '';


        $subscription_packages = SubscriptionPackage::orderby('id', 'desc');
        if ($name) {
            $subscription_packages->where('name', 'like', '%' . trim($name) . '%');
        }
        if ($status) {
            $subscription_packages->where('status', '=', $status);
        }
        $subscription_packages = $subscription_packages->paginate(12);

        return view('subscription/grid',compact('subscription_packages'));  
    } 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("subscription.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        // validate request
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'status' => 'required',
            // 'feature_list' => 'required',
        ]);
        // return $request;
        // create subscription package and store feature_list as json array
        $subscription_package = SubscriptionPackage::create([
            'name' => $request->name,
            'slug' => Str::slug($request->input('name')),
            'regular_price' => $request->regular_price,
            'sales_price' => $request->sales_price,
            'type' => $request->type,
            'status' => $request->status,
            'features' => implode(',',$request->feature_list),
        ]);

        // return back with success message
        return redirect()->route('admin.subscription')->with('success', 'Subscription Package created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $package = SubscriptionPackage::findorfail($id);
        return view("subscription.edit", compact('package'));
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
        //
            // validate request
            $request->validate([
                'name' => 'required|unique:subscription_packages,name,'.$id.',id', 
                'type' => 'required',
                'status' => 'required',
                // 'feature_list' => 'required',
            ]);

            // update subscription package and store feature_list as json array
            $subscription_package = SubscriptionPackage::findOrFail($id);
            $subscription_package->name = $request->name;
            $subscription_package->slug = Str::slug( $request->name);
            $subscription_package->regular_price = $request->regular_price;
            $subscription_package->sales_price = $request->sales_price;
            $subscription_package->type = $request->type;
            $subscription_package->status = $request->status;
            $subscription_package->features = implode(',',$request->feature_list);
            $subscription_package->save();

            // return back with success message
            return redirect()->route('admin.subscription')->with('success', 'Subscription Package Updated Successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
            // find subscription package
            $subscription_package = SubscriptionPackage::findorfail($id);
            if( $subscription_package ){
                // Delete subscription package from subscription table
                $subscription_package->subscriptions()->delete();
                // delete subscription package
                $subscription_package->delete();
                // return back with success message
                return redirect()->back()->with('success', 'Subscription Package deleted successfully');
            }
    }
}
