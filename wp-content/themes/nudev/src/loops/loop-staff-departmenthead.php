<?php

  class NUDepartmentHead{

    var $dept
        ,$fields;

    // initialize
    public function __construct($a=''){
      $this->dept = $a;
      $this->getData();
    }

    public function getData(){
      $args = array(
        "post_type" => "staff"
        ,"posts_per_page" => 1
        ,'meta_query' => array(
          'relation' => 'AND'
          ,array("key"=>"department","value"=>$this->dept,"compare"=>"=")
          ,array("key"=>"department_head","value"=>"1","compare"=>"=")
        )
      );

      $res = query_posts($args)[0];
      $this->fields = get_fields($res->ID);
      $this->fields['post_name'] = $res->post_name;
      unset($args,$res,$this->dept);
    }

    public function buildReturn():string{

      $guide = '<div><h3>%s%s</h3><h4>%s</h4><p>%s</p><div class="kri__more-link"><a href="/faculty-and-staff/%s" title="Click here to read more" class="js__bio">Read More</a></div></div><div style="background: url(%s);"></div>';

      $return = sprintf(
        $guide
        ,$this->fields['first_name'].' '.$this->fields['last_name']
        ,(isset($this->fields['credentials']) && $this->fields['credentials'] != ''?', '.$this->fields['credentials']:'')
        ,$this->fields['title']
        ,$this->fields['short_bio']
        ,$this->fields['post_name']
        ,$this->fields['headshot']['url']
      );

      unset($this->fields,$guide);

      return $return;

    }

  }

 $NUDepartmentHead = new NUDepartmentHead($department); // initialize a new local content object

 echo $NUDepartmentHead->buildReturn();

?>
