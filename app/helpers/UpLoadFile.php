<?php






class UpLoadFile{

	private $_targetFile,
	        $_targetDir,
	        $_maxFileSize,
	        $_fileTypes=array(),
	        $_fileExists,
	        $_result,
	        $_error=array(),
	        $_file;

    public function __construct($file){

   
    	$this->_error=array();
		$this->_file=$file;
		$this->_targetDir=Config::get('uploadfile/notification_dir');
		$this->_maxFileSize=Config::get('uploadfile/max_filesize');
		$this->_fileTypes=Config::get('uploadfile/file_types');
		$this->_targetFile=$this->_targetDir.basename($file["name"]);
		$this->checkExt();
		$this->fileExists();
		$this->checkFileSize();
        if(sizeof($this->_error)===0){
        	if($this->uplFile()){

        		$this->_result='The file '. basename( $this->_file["name"]). ' has been uploaded.';
        	}
        	else {
        		array_push($this->_error, 'there was an error uploading your file.<br>Please try again.');
        	$this->_result=$this->_error;}
        }
    	else{
    		$this->_result=$this->_error;
    	}
    }
		
    

    public function checkExt()
	{
		$file_ext=explode('.', $this->_file["name"]);
		$file_ext=strtolower(end($file_ext));
		if(!in_array($file_ext, $this->_fileTypes)){
		$file_types_str=implode(",", $this->_fileTypes);
           array_push($this->_error, 'only '.$file_types_str.' files are allowed.');
		}
	}
	public function fileExists()
	{
		if (file_exists($this->_targetFile))
			array_push($this->_error,'file already exists.');
		
	}
    
    public function checkFileSize()
	{
      if($this->_file["size"] > $this->_maxFileSize){
			array_push($this->_error,'your file is too large. it should be less than '.($this->_maxFileSize/1048576).' Mb.');
      }

	}
	public function uplFile()
	 {
      	if(move_uploaded_file($this->_file["tmp_name"], $this->_targetFile))
			return true;
		else
			return 	false;
		
	}
	public function getFilePath(){
        
		return $this->_targetFile;
	}

	public function getResult(){
        
		return $this->_result;
	}
	public function getFileSize(){
        
		return $this->_file["size"];
	}
	public function getFileName(){
        
		return $this->_file["name"];
	}
    public function errorString(){
        $errorString='';
        foreach ($this->_error as $error) {
        	$delimiter='<br>';
        	$errorString.=$error.$delimiter;
        }
		return  $errorString;
	}
}


