<?php 
// more post ajax
function more_post_ajax(){
    global $wp_query;
    $offset = $_POST["offset"];
    $ppp = $_POST["ppp"];
    $page = $_POST["page"];
    header("Content-Type: text/html");

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => $ppp,
        //'cat' => 1,
        //'offset' => $offset,
        'paged'    => $page,
    );

    $loop = new WP_Query($args);
    while ($loop->have_posts()) {
        $loop->the_post();
    ?>
    <article class="post-<?php the_id(); ?> post type-post status-publish format-standard has-post-thumbnail hentry category-whats-on">
        <?php do_action( 'shoptimizer_loop_post' ); ?>
    </article>
    <?php }
    exit; 
}

add_action('wp_ajax_nopriv_more_post_ajax', 'more_post_ajax'); 
add_action('wp_ajax_more_post_ajax', 'more_post_ajax'); ?>

<script>
    jQuery(document).ready( function($) {
        var ajaxUrl = "<?php echo admin_url('admin-ajax.php')?>";
        
        // What page we are on.
        var page = 2; 
        // Post per page
        var ppp = 3;

        $(".page-numbers").on("click", function() {
            // When btn is pressed.
            //$(".page-numbers").attr("disabled",true);
            $('.pagination .page-numbers').addClass('loading')
            // Disable the button, temp.
            $.post(ajaxUrl, {
                action: "more_post_ajax",
                offset: (page * ppp) + 1,
                page: page,
                ppp: ppp
            })
            .success(function(posts) {
                page++;
                if (posts) {
                    //console.log(posts);
                    $("#main .navigation.pagination").before(posts);
                    // CHANGE THIS!
                    $(".page-numbers").attr("disabled", false);
                    $('.pagination .page-numbers').removeClass('loading')
                }else{
                    $('.pagination .page-numbers').hide();
                    $('.navigation.pagination').before('<div>Last Page</div>')
                }
            });
        });
    });
</script>