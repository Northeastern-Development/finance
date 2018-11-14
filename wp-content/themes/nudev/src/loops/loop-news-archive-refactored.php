<?php
/**
 * Create the News and Events Index Page
 */
class NUNewsArchive{

    var $res
        ,$pageMax
        ,$paged
        ,$pagination
    ;

    // initialize
    function __construct(){
        $this->pageMax = 10;
        $this->paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $this->getData();
        $this->pagination = $this->paginate();
    }

    function getData(){
        
        $args = array(
            "post_type" => "newsevents-items"
            ,"posts_per_page" => $this->pageMax
            ,"orderby" => "date"
            ,"order" => "DESC"
            ,"paged" => $this->paged
            ,'meta_query' => array(
                array("key"=>"status","value"=>"1","compare"=>"=")
            )
        );

        $this->res = query_posts($args);

        unset($this->pageMax,$args,$this->paged);
    }

    public function buildReturn(){

        foreach($this->res as $r){
            $return .= $this->buildRecord($r,get_fields($r->ID));
        }

        unset($this->res,$r);

        return (string) $this->pagination.$return.$this->pagination;

    }

    function paginate(){

        // let's get the total number of active news posts
        $args = array(
            "post_type" => "newsevents-items"
            ,"posts_per_page" => -1
            ,"return" => "ids"
            ,'meta_query' => array(
                array("key"=>"status","value"=>"1","compare"=>"=")
            )
        );

        $return = '<div class="pagination">'.paginate_links($args).'</div>';

        unset($args);

        return (string) $return;

    }

    function buildRecord($a='',$b=''){

        
        if( !empty($b['external_url'])){
            $the_permalink = $b['external_url'];
            $target = '_blank';
        } else {
            $the_permalink = site_url('news-events/') . $a->post_name;
            $target = '';
        }

        if( $b['type'] == 'event' ){
            $format_event = '<p>%s</p><p>%s</p><p>%s</p><p>%s</p>';
            $content_event = '';
            $content_event .= sprintf(
                $format_event
                ,'Start Date: ' . $b['start_date']
                ,'End Date: ' . $b['end_date']
                ,'Start Time: ' . $b['start_time']
                ,'End Time: ' . $b['end_time']
            );
        }

        $guide = '
            <a href="%s" target="%s" title="View News / Event Item">
                <li>
                    <div>
                        <h3>%s</h3>
                        <h6>Posted on: %s</h6>
                        <h6>In Category: %s</h6>
                        <p>Details: %s</p>
                        %s    
                    </div>
                </li>
            </a>
        ';


        $return = sprintf(
            $guide
            ,$the_permalink
            ,$target
            ,$a->post_title
            ,date_format(date_create($a->post_date),"m/d/Y")
            ,$b['category']->post_title
            ,str_replace( ['<p>', '</p>'], ['<span>', '</span>'], $b['details'])
            ,( $b['type'] == 'event' ) ? $content_event : null
        );

        unset($guide,$a,$b);

        return (string) $return;
    }

}

$NUNews = new NUNewsArchive(); // initialize a new local content object

echo $NUNews->buildReturn();

?>
