<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function settings(){
        $setting= Setting::first();
        return view('backend.settings.settings',compact('setting'));
    }

    public function settingsUpdate(Request $request){
        $setting = Setting::first();
        $status  = $setting->update([
            'title'             => $request->title,
            'meta_description'  => $request->meta_description,
            'meta_keywords'     => $request->meta_keywords,
            'logo'              => $request->logo,
            // 'favicon'           => $request->favicon,
            'address'           => $request->address,
            'email'             => $request->email,
            'phone'             => $request->phone,
            'fax'               => $request->fax,
            'footer'            => $request->footer,
            // 'facebook_url'      => $request->facebook_url,
            // 'twitter_url'       => $request->twitter_url,
            // 'linkedin_url'      => $request->linkedin_url,
            // 'painterest_url'    => $request->painterest_url,
        ]);
        return back()->with('success','Successfully Updated');
    }

    public function smtp(){
        return view('backend.settings.smtp');
    }

    public function smtpUpdate(Request $request){
        foreach($request->types as $key=>$type){
            $this->overWriteEnvFile($type,$request[$type]);
        }
        return back()->with('success','SMTP configuration successfully updated');
    }

    public function overWriteEnvFile($type,$val){
        $path=base_path('.env');
        if(file_exists($path)){
            $val='"'.trim($val).'"';
            if(is_numeric(strpos(file_get_contents($path),$type)) && strpos(file_get_contents($path),$type)>=0){
                file_put_contents($path,str_replace(
                    $type.'="'.env($type).'"',$type.'='.$val,file_get_contents($path)
                ));
            }
            else{
                file_put_contents($path,file_get_contents($path)."\r\n".$type.'='.$val);
            }
        }
    }
}
