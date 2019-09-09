<?php 
/**
 *  Reusable Loop: General Staff Members
 * 
 *  This returns a grid of staff members
 * 
 *  This expects a variable!
 *  
*/

    // expecting an array of team member post objects
    $team = [];


    
    // set guide string
    $guide['team_members'] = '
        <li>
            <div class="neu__bgimg"><div style="background-image: url(%s)" aria-label="%s\'s profile picture"></div></div>
            <div>
                <p>
                    <span>%s</span><br>
                    <span>%s</span><br>
                </p>
                <p>%s</p>
                <p>%s</p>
                <p>%s</p>
            </div>
        </li>
    ';
    
    // open return string
    $return['team_members'] = '';
    // loop over the team members array
    foreach( $team as $member ){

        
        // get fields from this team member post object
        $member_fields = get_fields($member->ID);
        

        $return['team_members'] = sprintf(
            $guide['team_members']
            ,$member_fields['headshot']['url']
        );


        

    }
    // close return string
    $return['team_members'] = '';

    

 ?>