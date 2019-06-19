<?php


function uploadFile($file_data,$tempName)
{
	try
	{
		@list($type, $file_data) = explode(';', $file_data);
	    @list(, $file_data) 	 = explode(',', $file_data); 
	    @list(, $type) 			 = explode('/', $type); 
	    
	    $file_name = $tempName.'.pdf'; //generating unique file name;

	    \Storage::disk('public')->put($file_name,base64_decode($file_data));

	    $baseUrl = "http://localhost/PROJ_MAY/Rareiio/storage/app/public/";
	    return $baseUrl.$file_name;
	}
	catch (\Exception $e) 
    {
    	return "Some Error";
    }
}