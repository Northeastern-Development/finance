<?php 
/**
 * Template Name: Forms
 */
    get_header();

 ?>
<main class="main" id="forms">
    
    <section class="hero">
        <h1>Forms</h1>
        <div>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eveniet doloribus omnis ullam beatae quisquam id vel architecto tenetur? Sapiente aut, maiores quam earum quos molestias facilis vitae nesciunt aperiam explicabo? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio exercitationem at fugiat repellat nemo? Modi quas tenetur quisquam consectetur beatae, corrupti obcaecati delectus corporis odit quam ex laudantium quidem reprehenderit?</p>
        </div>
    </section>
    
    <section>
        <?php 
            include(locate_template('loops/loop-forms.php'));
        ?>
    </section>
    
    
    <section>
        <?php 
            $fields = get_fields($post->ID);
            include(locate_template('includes/prefooter.php'));
         ?>
    </section>
    
    
</main>

<?php 

get_footer();

?>