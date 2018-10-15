<?php


	class NUDepartmentStaff{

		var $dept
				,$res;

		// initialize
		public function __construct($a=''){
			$this->dept = $a;
			$this->getData();
			unset($a);
		}

		public function getData(){

			$args = array(
				"post_type" => "staff"
				,"posts_per_page" => -1
				,'meta_query' => array(
					'relation' => 'AND'
					,array("key"=>"department","value"=>$this->dept,"compare"=>"=")
					,array("key"=>"department_head","value"=>"1","compare"=>"!=")
					,array("key"=>"status","value"=>"1","compare"=>"=")
				)
			);

			$this->res = query_posts($args);
			unset($args,$this->dept);
		}

		public function buildReturn():string{

			// this will loop through all of the records found and build out the staff for the selected department

			//for($i=0;$i<6;$i++){	// this loop is only for testing to get more items on screen, remove for real use

				foreach($this->res as $r){
					$return .= $this->buildRecord($r->post_name,get_fields($r->ID));
				}

		//}

			unset($this->res,$r);

			return $return;

		}

		public function buildRecord($a='',$b=''):string{

			$guide = '<li><a href="%s" title="Click to view profile" class="js__bio"><div style="background: url(%s);"></div><h3>%s</h3><h4>%s</h4><span>View profile</span></a></li>';

			$return = sprintf(
				$guide
				,$a
				,$b['headshot']['url']
				,$b['first_name'].' '.$b['last_name']
				,$b['title']
			);

			unset($guide,$a);

			return $return;
		}

	}

	$NUDepartmentStaff = new NUDepartmentStaff($department); // initialize a new local content object

	echo $NUDepartmentStaff->buildReturn();


?>
