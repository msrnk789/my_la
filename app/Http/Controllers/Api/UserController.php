<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\BidDocumentName;
use App\User;
use App\models\BidDepositeAmount;
use App\models\BidDocumentType;
use App\models\BidUserDocument;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    
    public function user_document_store(Request $request)
    {
        $data['user_id'] = Auth::user()->id;
        $data['slug'] = Auth::user()->name;
        $data['gst_number'] = $request->get('gst_number');
        $data['aadhaar'] = 0;
        $data['pan'] = 0;
        $data['business_licence'] = 0;
        $data['status'] = 1;
        $user = BidUserDocument::create($data);

        return response()->json([
            'message' => 'Successfully updated user Document!'
        ], 201);
    }

    public function document_type_strore(Request $request)
    {
        $data['user_id'] = Auth::user()->id;
        $data['name'] = $request->get('name');
        $data['number'] = $request->get('number');
        
        
        $filename =$request->file('images');
        $filename->getClientOriginalExtension();
        $filename = $filename->store('public/file');
        $filename = str_replace('public/file/', '', $filename);
        $data['images']= $filename;
        $data['status'] = 1;

        //return $filename;
        $data = BidDocumentType::create($data);

        //$user =BidUserDocument::find(Auth::user()->id);
        $val = $request->get('name');
        if(1 == $val){
            $user['pan'] = 1;
        }elseif (2 == $val) {
            $user['aadhaar'] = 1;
        }elseif (3 == $val) {
            $user['business_licence'] = 1;
        }
        //$user->save();
        $data = BidUserDocument::where('user_id','=',Auth::user()->id)->update($user);
        
        return response()->json([
            'message' => 'Successfully updated user Document!'
        ], 201);
    }

    public function document_name(Request $request)
    {
        $document_name = BidDocumentName::all();
        if($document_name){
            return response()->json(['success'=>$document_name],200);
        }else{
            return response()->json(['error'=>'something is wrong'],201);
        }
        
    }
    
  
}
