<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PDF;

class FileController extends Controller
{
    public function s3_bucket_single(Request $request)
    {
    	$data = new BidVehicleImage;
        $data['vehicle_detail_id'] = $id;
        $data['status'] = 1;

        $photo = $request->file('image');
        $imageName = time().'.'.$request->file('image')->getClientOriginalExtension();
        $image =$photo;
        $t = Storage::disk('s3')->put('Gallery/'.$imageName, file_get_contents($image), 'Gallery');
        $url='Gallery/'.$imageName;
        $imageName = Storage::disk('s3')->url($url);
        $data['image'] = $imageName;

        $data->save();
        //$result= BidVehicleImage::create($data);
        if($data)
       {
          return redirect('admin/bid_vehicle_detail')->with('msg', 'Successfully Uploaded Images!');
       }
    }

    public function s3_bucket_multi_file(Request $request,$id)
    {
        foreach($request->file('image') as $filename){
            $data = new BidVehicleImage;
            $imageName = time().'.'.$filename->getClientOriginalExtension();
            $image =$filename;
            $t = Storage::disk('s3')->put('Gallery/'.$imageName, file_get_contents($image), 'Gallery');
            $url='Gallery/'.$imageName;
            $imageName = Storage::disk('s3')->url($url);
            $data['image']= $imageName;
            
            $data['vehicle_detail_id'] = $id;
            $data['status'] = 1;
            $data->save();
        
        }
        return redirect('admin/bid_vehicle_detail')->with('msg', 'Successfully Uploaded Images!');
        
    }

    public function s3_bucket()
    {
    	$award['name']=$request->get('name');
       $award['description']=$request->get('description');
       if($request->hasFile('award_image')) {
           $award_image = $request->file('award_image');
           $unique_ID =  uniqid();

           $image_ext = $award_image->getClientOriginalExtension();
           $image_name = $unique_ID.'.'.$image_ext;

           $image = (string) Image::make($award_image->getRealPath())->resize(64, 64,
               function ($constraint) {
                   $constraint->aspectRatio();
           })
           ->encode($image_ext, 100);

           // removing spaces
           $award_name= str_replace(' ', '-', $request->name);

           $s3 = Storage::disk('s3');
           $imagePath = 'award_image/'.$award_name.'/'.$image_name;
           $s3->put($imagePath, $image);

           $award['award_image'] = $imagePath;
       }
       $result= Award::create($award);
       if($result)
       {
          Session::flash('message', 'Successfully Created!'); 
          return redirect('admin/awards');
       }
    }

    //to store image in array
    public function model_images_store1(Request $request,$id)
    {
        // $this->validate($request, [

        //         'image' => 'required',
        //         'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        // ]);
        if($request->hasfile('image'))
         {

            foreach($request->file('image') as $image)
            {
                $name=$image->getClientOriginalName();
                $image->move(public_path().'/car/images', $name);  
                $data[] = $name; 

            }
         }
        $form= new BidVehicleImage();
        $form->image=json_encode($data);
        $form->vehicle_detail_id = $id;
        $form->status = 1;
        //return $id;
        $form->save();
        return redirect('admin/bid_vehicle_detail')->with('msg', 'Successfully Uploaded Images!');
    }

    //multi imgages store
    public function model_images_store(Request $request,$id)
    {
        
        foreach($request->file('image') as $filename){
             $data = new BidVehicleImage;
            //$filename =$request->file('image');
            $filename->getClientOriginalExtension();
            $filename = $filename->store('public/car/images');
            $filename = str_replace('public/car/images', '', $filename);
            $data['image']= $filename;
            
            $data['vehicle_detail_id'] = $id;
            $data['status'] = 1;
            $data->save();
        
        }
        return redirect('admin/bid_vehicle_detail')->with('msg', 'Successfully Uploaded Images!'); 

    }

    //csv file download
    public function download_users(Request $request)
    {
       $data = User::where('user_type','=',1)->get();
       $filename= "reports.xlsx";
       $handle = fopen($filename, 'w+');
       fputcsv($handle, ['Student Name','Region','Mobile Number','Email','User Type','College']);
       foreach($data as $value){
          $region = Region::where('id','=',$value->region)->first();
          $full_name = $value->first_name. $value->last_name;
          if($value->college == "Others")
          {
             $college = $value->other_college;
          }
          else{
              $name = College::where('id','=',$value->college)->first();
              $college=$name->college_name;
          }
          fputcsv($handle, array($full_name,$region->region_name,$value->mobile_no,$value->email,$value->are_you,$college));
       }

       fclose($handle);
        $headers = array(
            'Content-Type' => 'text/csv',
        );
        return response()->download($filename, 'student_details.csv', $headers);
    }

    public function downloadExcel($type)
    {
        $data = User::get()->toArray();
            
        return Excel::create('patw_example', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download($type);
    }

    //pdf file download

    public function download_pdf(Request $request,$id)
   	{
       $user_id = $id;
       $result['type'] =$request->get('type');
       $result['value'] = JudgeResult::with('users')->with('rounds')->with('judges_name')->with('detail')->where('user_id','=',$user_id)->get();
       //return $result;
       $user=User::where('id','=',$user_id)->first();
       $name = $user->first_name.$user->last_name.'.pdf';
      // return $name;
       $pdf = PDF::loadView('admin.pdf.result1', $result);
      // return $pdf; 
       return $pdf->download($name);
    
   	}

   	//send mail pdf
   	public function send_mail_pdf($id)
   	{
        $user_id = $id;
       // $result['type'] =$request->get('type');
        $result['value'] = JudgeResult::with('users')->with('rounds')->with('judges_name')->with('detail')->where('user_id','=',$user_id)->get();
        //return $result;
        $user=User::where('id','=',$user_id)->first();
        $name = $user->first_name.$user->last_name.'.pdf';
    // return $name;
        $pdf = PDF::loadView('admin.pdf.result1', $result);
        $user = User::where('id','=',$id)->first();
        $mail = Mail::send('email.result', ['data' => $user], function($message) use ($user, $pdf)
                {
                    $message->to($user['email']);
                    $message->subject('PATW-2018');
                    $message->attachData($pdf->output(), "result.pdf");
                });
        // if($mail)
        
            Session::flash('message', 'Email Sent Successfully!'); 
            return redirect()->back();
        // }       
   	}

   	public function download_ppt($id)
   {
       $user = User::where('id','=',$id)->first();
       $file = public_path('storage/ppt/'.$user->ppt);
       //return $file;
        $headers = ['Content-Type: application/pptx'];
        $fileName = $user->first_name.'.pptx';
        
        return Response::download($file,$fileName,$headers);
   }

}
