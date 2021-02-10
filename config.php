<?php

	class todolist{

		private $json;
		private $data;

		private $mektodo;

		private $dataURL;
		
		public function __construct(){
			

			$this->json = null;
			$this->data = null;
			$this->mektodo = array();
			$this->dataURL = "mekdata.json";

		}

		public function __destruct(){
			unset($this->json);
			unset($this->data);
			unset($this->mektodo);
			unset($this->dataURL);
		}

		public function getData(){

			if(file_exists($this->dataURL)){
				$this->json = file_get_contents($this->dataURL);
				$this->data = json_decode($this->json, true);
				if(is_array($this->data)) return $this->data;
			} else return false;

		}

		public function setData(){

			if(is_array($this->data)){

				foreach($this->data as $value){
					$this->mektodo[] = $value;
				};
				
				$this->json = json_encode($this->mektodo, JSON_PRETTY_PRINT);

				file_put_contents($this->dataURL, $this->json);

			} else return false;

		}

		//list	
		public function getlist(){

			$this->getData();

			return $this->data;

		}
		//add
		public function getadd($deger = null, $durum = bool){

			if(!empty($deger) && is_bool($durum)){

				$this->getData();
				
				$this->data[] = array(
					'deger'		=> $deger,
					'completed' => $durum
				);

				$this->setData();

			} else return false;
		}

		//update
		public function getupdate($key = null, $deger = null){

			if(!is_integer($key)){

				$this->getData();

				$this->data[$key] = array(
					'deger'		=> $deger,
					'completed' => $this->data[$key]['completed']
				);

				$this->setData();

			} else return false;

		}


		//check
		public function getcheck($key = null, $durum = null){

			if(!is_integer($key)){

				$this->getData();

				$this->data[$key] = array(
					'deger'		=> $this->data[$key]['deger'],
					'completed' => $durum
				);

				$this->setData();

			} else return false;

		}

		//delete
		public function getdelete($key = null){

			if(!is_integer($key)){

				$this->getData();

				unset($this->data[$key]);

				$this->setData();

			} else return false;

		}

		//up
		public function getup($key = null){


				$this->getData();

				$desk = $key--;
				if($desk > 0){

					$mektodo = $this->data[$desk];

					$this->data[$desk] = $this->data[$key];
					$this->data[$key]  = $mektodo;

					$this->setData();

				} else return false;
			
		}

		//down
		public function getdown($key = null){

		

				$this->getData();

				$desk = $key++;
				$adet = count($this->data) - 1;

				if($desk < $adet){

					$mektodo = $this->data[$desk];
					$this->data[$desk] = $this->data[$key];
					$this->data[$key]  = $mektodo;

					$this->setData();

				} else return false;
			

		}

	};

	$todolist = new todolist();

	if($_POST){

		if($_POST['add'])		$todolist->getadd($_POST['deger'], false);
		if($_POST['update'])	$todolist->getupdate($_POST['key'], $_POST['deger']);
		if($_POST['checket'])	$todolist->getcheck($_POST['key'], $_POST['check'.$_POST['key']]);
		if($_POST['delete'])	$todolist->getdelete($_POST['key']);
		if($_POST['down'])		$todolist->getdown($_POST['key']);
		if($_POST['up'])	    $todolist->getup($_POST['key']);

		header('Location:index.php');

	};

?>