<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\BidDocumentType;
use App\Models\BidUserDocument;
use App\Models\BidUserStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserDocumentController extends Controller
{
    public function document_type()
    {
    	$document_type = BidDocumentType::all();
    	return response()->json(['success' =>$document_type]);
    }

    public function document_status()
    {
    	$document_status = BidUserStatus::all();
    	return response()->json(['success' => $document_status]);
    }

    public function user_document_name1()
    {
        $pan = BidDocumentName::where('document_type_id','=',1)->first();
        $gst = BidDocumentName::where('document_type_id','=',4)->first();
        $profile_picture = BidDocumentName::where('document_type_id','=',5)->first();
        $address = BidDocumentName::where('document_type_id','=',2)->get();
        $business = BidDocumentName::where('document_type_id','=',3)->get();
        return response()->json(['data'=>$pan,$gst,$address,$business,$profile_picture], 200);

    }
    
    public function user_document_store1(Request $request)
    {
    	$user_document = new BidUserDocument;
    	$user_document['user_id'] = Auth::user()->id;
    	$user_document['document_type_id'] = $request->get('document_type_id');

    	$photo = $request->file('file_name');
        $imageName = time().'.'.$request->file('file_name')->getClientOriginalExtension();
        $image =$photo;
        $t = Storage::disk('s3')->put('Gallery/'.$imageName, file_get_contents($image), 'Gallery');
        $url='Gallery/'.$imageName;
        $imageName = Storage::disk('s3')->url($url);
        $user_document['file_name'] = $imageName;

    	$user_document['status_id'] = 3;
    	$user_document->save();

    	$user_check = BidUserDocument::with('users')->with('document_type')->where('user_id','=',Auth::user()->id)->where('document_type_id','=', $request->get('document_type_id'))->first();

    	if($user_document){
    		return response()->json(['success' => $user_check], 200);
    	}else{
    		return response()->json(['error' => 'something went wrong'], 201);
    	}

    }

    public function user_document_check(Request $request)
    {
    	$user_check = BidUserDocument::where('user_id','=',Auth::user()->id)->where('document_type_id','=', $request->get('document_type_id'))->where('status_id','=',1)->get();
    	if($user_check){
    		return response()->json(['success' => $user_check], 200);
    	}else{
    		return response()->json(['error' => 'something went wrong'], 201);
    	}
    	
    }

    public function user_document_store(Request $request)
    {
        $user_document_check = BidUserDocument::where('user_id','=',Auth::user()->id)->where('document_type_id','=',$request->get('document_type_id'))->first();

        if($user_document_check){
            $data = BidUserDocument::where('user_id','=',Auth::user()->id)->where('document_type_id','=',$request->get('document_type_id'));
            $user_document['document_type_id'] = $request->get('document_type_id');

            $photo = $request->file('file_name');
            $imageName = time().'.'.$request->file('file_name')->getClientOriginalExtension();
            $image =$photo;
            $t = Storage::disk('s3')->put('Gallery/'.$imageName, file_get_contents($image), 'Gallery');
            $url='Gallery/'.$imageName;
            $imageName = Storage::disk('s3')->url($url);
            $user_document['file_name'] = $imageName;

            $user_document['status_id'] = 3;
            $data->update($user_document);
            $user_check = BidUserDocument::with('users')->with('document_type')->where('user_id','=',Auth::user()->id)->where('document_type_id','=', $request->get('document_type_id'))->first();

            if($data){
                return response()->json(['success' => $user_check], 200);
            }else{
                return response()->json(['error' => 'something went wrong'], 201);
            }
            

        }else{
            $user_document = new BidUserDocument;
            $user_document['user_id'] = Auth::user()->id;
            $user_document['document_type_id'] = $request->get('document_type_id');

            $photo = $request->file('file_name');
            $imageName = time().'.'.$request->file('file_name')->getClientOriginalExtension();
            $image =$photo;
            $t = Storage::disk('s3')->put('Gallery/'.$imageName, file_get_contents($image), 'Gallery');
            $url='Gallery/'.$imageName;
            $imageName = Storage::disk('s3')->url($url);
            $user_document['file_name'] = $imageName;

            $user_document['status_id'] = 3;
            $user_document->save();

            $user_check = BidUserDocument::with('users')->with('document_type')->where('user_id','=',Auth::user()->id)->where('document_type_id','=', $request->get('document_type_id'))->first();

            if($user_document){
                return response()->json(['success' => $user_check], 200);
            }else{
                return response()->json(['error' => 'something went wrong'], 201);
            }
        }
    }

        public function user_profile1(Request $request)
    {
        $users = BidUserDocument::with(['document_name' =>function($query){
            $query->select('id','name');
        }])->with(['document_type' => function($query){
            $query->select('id','name');
        }])->with(['status' => function($query){
            $query->select('id','name');
        }])->where('user_id','=',Auth::user()->id)->get();
            
        return response()->json(['data'=>$users], 200);

    }


    public function user_profile3(Request $request)
    {
        $user = BidUserDocument::with('document_name')->where('user_id','=',Auth::user()->id)->get();
        foreach ($user as $value) {
            foreach ($value->document_name as $key) {
                foreach ($key->document_type as $value) {
                    # code...
                }
            }
            foreach ($value->status as $key => $value) {
                # code...
            }
        }
        return response()->json(['data'=>$user], 200);
    }

    public function user_profile2(Request $request)
    {
        $user =User::with('user_document')->where('id','=',Auth::user()->id)->get();
        foreach ($user as $value) {
            foreach ($value->user_document as $key) {
                foreach ($key->document_name as $value) {
                    # code...
                }
                foreach ($key->status as $key => $value) {
                    # code...
                }
            }
        }
        return response()->json(['data'=>$user], 200);
    }

    public function user_document_store11(Request $request)
    {
        $user_document_check = BidUserDocument::where('user_id','=',Auth::user()->id)->where('document_type_id','=',$request->get('document_type_id'))->where('document_name_id','=',$request->get('document_name_id'))->first();

        if($user_document_check){
            if($request->get('document_type_id') == 4){
                $user_document['document_type_id'] = $request->get('document_type_id');
                $user_document['document_name_id'] = $request->get('document_name_id');
                $user_document['number'] = $request->get('number');
                $user_document['status_id'] = 1;
                $data= BidUserDocument::where('id','=',$user_document_check->id)->update($user_document);

                if($data){
                    return response()->json(['data' => 'successfully!'], 200);
                }else{
                    return response()->json(['data' => 'something went wrong'], 201);
                }
            }else{
                $user_document['document_type_id'] = $request->get('document_type_id');
                $user_document['document_name_id'] = $request->get('document_name_id');
                $user_document['number'] = $request->get('number');
                $photo = $request->file('file');
                $imageName = time().'.'.$request->file('file')->getClientOriginalExtension();
                $image =$photo;
                $t = Storage::disk('s3')->put('Gallery/'.$imageName, file_get_contents($image), 'Gallery');
                $url='Gallery/'.$imageName;
                $imageName = Storage::disk('s3')->url($url);
                $user_document['file'] = $imageName;

                $user_document['status_id'] = 1;
                $data= BidUserDocument::where('id','=',$user_document_check->id)->update($user_document);

                if($data){
                    return response()->json(['data' => 'successfully!'], 200);
                }else{
                    return response()->json(['data' => 'something went wrong'], 201);
                }
            }

        }else{
            if($request->get('document_type_id') == 4){
                $user_document = new BidUserDocument;
                $user_document['user_id'] = Auth::user()->id;
                $user_document['document_type_id'] = $request->get('document_type_id');
                $user_document['document_name_id'] = $request->get('document_name_id');
                $user_document['number'] = $request->get('number');
                $user_document['status_id'] = 1;
                $user_document->save();
                
                if($user_document){
                    return response()->json(['data' => 'successfully!'], 200);
                }else{
                    return response()->json(['data' => 'something went wrong'], 201);
                }
            }else{
                $user_document = new BidUserDocument;
                $user_document['user_id'] = Auth::user()->id;
                $user_document['document_type_id'] = $request->get('document_type_id');
                $user_document['document_name_id'] = $request->get('document_name_id');
                $user_document['number'] = $request->get('number');

                $photo = $request->file('file');
                $imageName = time().'.'.$request->file('file')->getClientOriginalExtension();
                $image =$photo;
                $t = Storage::disk('s3')->put('Gallery/'.$imageName, file_get_contents($image), 'Gallery');
                $url='Gallery/'.$imageName;
                $imageName = Storage::disk('s3')->url($url);
                $user_document['file'] = $imageName;
                $user_document['status_id'] = 1;
                $user_document->save();

                
                if($user_document){
                    return response()->json(['data' => 'successfully!'], 200);
                }else{
                    return response()->json(['data' => 'something went wrong'], 201);
                }
            }
            
        }
    }


}
