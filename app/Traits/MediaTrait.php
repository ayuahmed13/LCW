<?php

namespace App\Traits;
use Str;

use Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Crypt;

trait MediaTrait {

    // Rules For Using Following Methods
    // Make Sure Your Input Fields For File, Name Attribute As Same As The Database Column Name
    // Make Sure Your Database Column Name For File Path Must End With '_path' and Column Name File Name Must End With '_name'

    public function verifyAndUpload(Request $request, $fieldname, $directory,$file_name='') {
        
        if( $request->hasFile( $fieldname ) ) {
            if (!$request->file($fieldname)->isValid()) {
                flash('Invalid File!')->error()->important();
                return redirect()->back()->with('error', 'Invalid File.');
            }
            if(!empty($file_name)){
                $filename = $file_name.'_'.time().Str::random(5).'.'.$request->file($fieldname)->getClientOriginalExtension();
            }else{
                $filename = time().Str::random(5).'.'.$request->file($fieldname)->getClientOriginalExtension();
            }
            $filepath = $request->file($fieldname)->storeAs('public/'.$directory,$filename);
            
            // Set permissions to 0644 (rw-r--r--)
            // $fullPath = storage_path('app/' . $filepath);
            // chmod($fullPath, 0644);


            return $filepath;
        }
        
        return null;
    }
    
    public function uploadFiles($files, $directory){
        foreach($files as $key => $file){
            $file_name = $file->getClientOriginalName();
            $file_path = $file->storeAs('public/'.$directory , $file_name);
            $all_file_path[$key] = $file_path;
            $all_file_path[$this->getDbColumnName($key)] = $file_name;
        }
        $path = storage_path('app/public/' . $directory);
        chmod($path, 0777);
        return $all_file_path;
    }

    public function uploadFilesWithRename($files, $directory,$rename='gallery'){
        $all_file_path = [];
    
        foreach($files as $key => $file){
            $extension = $file->getClientOriginalExtension();
            $newFileName = $rename.'-'.time() . '_' . uniqid() . '.' . $extension;
            $file_path = $file->storeAs('public/'.$directory , $newFileName);
            $all_file_path[$key] = $file_path;
            $all_file_path[$this->getDbColumnName($key)] = $newFileName;
        }
    
        $path = storage_path('app/public/' . $directory);
        chmod($path, 0777);
        return $all_file_path;
    }
    

    public function getDbColumnName($key){
        $explodedArray = explode('_', $key);
        $lastElement = end($explodedArray);
        array_pop($explodedArray);
        array_push($explodedArray, "name");
        $name_key = implode('_', $explodedArray);
        return $name_key;
    }

}