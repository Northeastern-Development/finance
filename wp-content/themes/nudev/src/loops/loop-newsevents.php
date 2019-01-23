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
        $this->pageMax = 6;
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
            
            $format_event = '
                <div class="neu__news_event_time">
                    <p>
                        Event begins <span>%s</span> at <span>%s</span>
                    </p>
                    <p>
                        Event ends <span>%s</span> at <span>%s</span>
                    </p>
                </div>
            ';

            $content_event = '';
            $content_event .= sprintf(
                $format_event
                ,$b['start_date']
                ,$b['start_time']
                ,$b['end_date']
                ,$b['end_time']
            );
        }

        $guide = '
            <li>
                <a href="%s" target="%s" title="View News / Event Item">
                    <div class="neu__bgimg"><div style="background-image: url(%s)"></div></div>
                    <div>
                        <h3>%s</h3>
                        <h6>%s</h6>
                        <p>%s</p>
                        %s
                        <p class="neu__iconlink">Learn More</p>
                    </div>
                </a>
            </li>
        ';


        $return = sprintf(
            $guide
            ,$the_permalink
            ,$target
            ,$b['image']
            ,$a->post_title
            ,$b['category']->post_title
            ,strip_tags($b['details'])
            ,( $b['type'] == 'event' ) ? $content_event : null
        );

        unset($guide,$a,$b);

        return (string) $return;
    }

}

$NUNews = new NUNewsArchive(); // initialize a new local content object

echo $NUNews->buildReturn();

?>
