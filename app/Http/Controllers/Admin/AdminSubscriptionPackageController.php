<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\SubscriptionPackage;
use App\Http\Controllers\Controller;

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
        if (!empty($name)) {
            $subscription_packages->where('name', 'like', '%' . trim($name) . '%');
        }
        if (!empty($status)) {
            $subscription_packages->where('status', 'like', '%' . trim($status) . '%');
        }
        $subscription_packages = $subscription_packages->paginate(12);

        return view('subscription/grid',compact('subscription_packages'));  
    }

    /**
     * Data table for subscription package
     */
    public function subscriptionDataTable(Request $request)
    {
        return $request;
        $subscription_packages = SubscriptionPackage::select('*');
        return datatables()->of($subscription_packages)
            ->addColumn('action', function ($subscription_package) {
                $action = '<a href="' . route('admin.subscription.edit', $subscription_package->id) . '" class="btn  "><i class="fas fa-edit"></i></a>';
                $action .= '<a href="' . route('admin.subscription.destroy', $subscription_package->id) . '" class="btn  delete_data" data-id="'.$subscription_package->id.'"><i class="fas fa-trash text-danger"></i></a>';
                return $action;
            })
            ->addColumn('status', function ($subscription_package) {
                $status = $subscription_package->status == 'active' ? 'Active' : 'Inactive';
                $status_class = $subscription_package->status == 'active' ? 'success' : 'danger';
                return '<span class="badge badge-' . $status_class . ' bg-' .$status_class. '">' . $status . '</span>';
            })
            ->addColumn('features', function ($subscription_package) {
                $features = json_decode($subscription_package->features);
                $feature_list = '<ul>';
                foreach ($features as $feature) {
                    $feature_list .= '<li>' . $feature . '</li>';
                }
                $feature_list .= '</ul>';
                return $feature_list;
            })
            ->rawColumns(['action', 'status', 'features'])
            ->make(true);
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
            'price' => 'required',
            'type' => 'required',
            'status' => 'required',
            // 'feature_list' => 'required',
        ]);
        // return $request;
        // create subscription package and store feature_list as json array
        $subscription_package = SubscriptionPackage::create([
            'name' => $request->name,
            'amount' => $request->price,
            'type' => $request->type,
            'status' => $request->status,
            'features' => json_encode($request->feature_list),
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
                'price' => 'required',
                'type' => 'required',
                'status' => 'required',
                // 'feature_list' => 'required',
            ]);

            // update subscription package and store feature_list as json array
            $subscription_package = SubscriptionPackage::findOrFail($id);
            $subscription_package->name = $request->name;
            $subscription_package->amount = $request->price;
            $subscription_package->type = $request->type;
            $subscription_package->status = $request->status;
            $subscription_package->features = json_encode($request->feature_list);
            $subscription_package->save();

            // return back with success message
            return redirect()->back()->with('success', 'Subscription Package updated successfully');
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
