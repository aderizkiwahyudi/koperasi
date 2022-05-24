<?php 

class FileServices {

    public function upload($file, $location = 'img'){
        $file->move($location, $filename = $this->renameFile($file));
        return $filename;
    }

    protected function renameFile($file){
        return rand(99,99999) . time() . '.' . $file->getClientOriginalExtension();
    }
}