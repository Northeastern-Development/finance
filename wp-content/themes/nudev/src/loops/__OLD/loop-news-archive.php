<?php


	class NUNewsArchive{

		var $res
				,$pageMax
				,$paged
				,$pagination;

		// initialize
		function __construct(){
			$this->pageMax = 2;
			$this->paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$this->getData();
			$this->pagination = $this->paginate();
		}

		function getData(){

			$args = array(
				"post_type" => "newsandevents"
				,"posts_per_page" => $this->pageMax
				,"orderby" => "date"
				,"order" => "DESC"
				,"paged" => $this->paged
				,'meta_query' => array(
					'relation' => 'AND'
					,array("key"=>"type","value"=>"news","compare"=>"=")
					,array("key"=>"status","value"=>"1","compare"=>"=")
				)
			);

			$this->res = query_posts($args);

			unset($this->pageMax,$args,$this->paged);
		}

		public function buildReturn():string{

			foreach($this->res as $r){
				$return .= $this->buildRecord($r,get_fields($r->ID));
			}

			unset($this->res,$r);

			return $this->pagination.$return.$this->pagination;

		}

		function paginate():string{

			// let's get the total number of active news posts
			$args = array(
				"post_type" => "newsandevents"
				,"posts_per_page" => -1
				,"return" => "ids"
				,'meta_query' => array(
					'relation' => 'AND'
					,array("key"=>"type","value"=>"news","compare"=>"=")
					,array("key"=>"status","value"=>"1","compare"=>"=")
				)
			);

			$return = '<div class="pagination">'.paginate_links($args).'</div>';

			unset($args);

			return $return;

		}

		function buildRecord($a='',$b=''):string{

			$guide = '<li><div style="background: url(%s);"></div><div><h3>%s</h3><h4>Posted: %s</h4><p>%s</p><div class="kri__more-link"><a href="/news/article/%s" title="Click here to read more"> Read More </a></div></div></li>';

			$return = sprintf(
				$guide
				,$b['hero_image']['url']
				,$a->post_title
				,date_format(date_create($a->post_date),"m/d/Y")
				,$b['excerpt']
				,$a->post_name
			);

			unset($guide,$a,$b);

			return $return;
		}

	}

	$NUNews = new NUNewsArchive(); // initialize a new local content object

	echo $NUNews->buildReturn();

?>
