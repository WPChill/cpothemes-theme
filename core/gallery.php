<?php

add_action('wp_ajax_refresh_metabox', 'cpotheme_gallery_refresh_metabox');
add_action('wp_ajax_gallery_remove', 'cpotheme_gallery_remove');


function cpotheme_metabox_gallery($post)
{
    $post_id = $post->ID;
    
    $output	= '';
    $output .= '<p class="cpotheme-gallery" id="cpotheme-gallery">';
    
    //Get Image list and display gallery images
    $images = cpotheme_gallery_images($post_id);
    if (empty($images)) {
        $output .= '<p>No images.</p>';
    } else {
        $output .= cpotheme_gallery_display($images);
    }
    
    //Gallery content
    $output .= '<p class="cpotheme-gallery-content">';
    $output .= sprintf(__('This is a list of all the images currently attached to this post. Learn more about how %s work in WordPress.', 'cpotheme'), sprintf('<a href="//www.cpothemes.com/docs/file-attachments" target="_blank">%s</a>', __('image attachments', 'cpotheme')));
    $output .= '</p>';
    $output .= '<a href="#" id="cpotheme-gallery-open" class="cpotheme-gallery-open button button-secondary"><span class="wp-media-buttons-icon"></span> '.__('Add Media', 'cpotheme').'</a>';
    $output .= '<a href="#" id="cpotheme-gallery-update" class="cpotheme-gallery-update button button-secondary"><span class="icon-refresh"></span> '.__('Refresh', 'cpotheme').'</a>';

    $output .= '</p>';

    echo $output;
}


function cpotheme_gallery_images($post_id)
{
    $args = array(
    'post_type' => 'attachment',
    'post_status' => 'inherit',
    'post_parent' => $post_id,
    'exclude' => get_post_thumbnail_id($post_id),
    'post_mime_type' => 'image',
    'posts_per_page' => -1,
    'order' => 'ASC',
    'orderby' => 'menu_order');
    $images = get_posts($args);
    return $images;
}


function cpotheme_gallery_display($imagelist)
{
    $gallery = '<div id="cpotheme-gallery-imagelist" class="cpotheme-gallery-imagelist">';
    $count = 0;
    foreach ($imagelist as $image):
        $count++;
    $last = '';
    if ($count % 3 == 0) {
        $last = ' cpotheme-gallery-image-last';
    }
    $gallery .= '<div class="cpotheme-gallery-image'.$last.'">';
    $image_url = wp_get_attachment_image_src($image->ID, 'thumbnail');
    $gallery .= '<a href="'.admin_url('/post.php?post='.$image->ID.'&action=edit&image-editor').'" title="'.__('Edit This Image', 'cpotheme').'" target="_blank">';
    $gallery .= '<img src="'.$image_url[0].'" alt="'.$image->post_title.'" rel="'.$image->ID.'" title="'.$image->post_content.'"> ';
    $gallery .= '</a>';
    //$gallery .= '<span class="cpotheme-gallery-image-remove" rel="'.$image->ID.'"></span>';
    $gallery .= '</div>';
    endforeach;
    $gallery .= '</div>';
    return $gallery;
}

//Refresh the metabox
function cpotheme_gallery_refresh_metabox()
{
    $parent	= $_POST['parent'];
    $loop = cpotheme_gallery_images($parent);
    $images	= cpotheme_gallery_display($loop);

    $ret = array();

    if (!empty($parent)) {
        $ret['success'] = true;
        $ret['gallery'] = $images;
    } else {
        $ret['success'] = false;
    }

    echo json_encode($ret);
    die();
}


//Remove single image
function cpotheme_gallery_remove()
{

    // content from AJAX post
    $image_id = $_POST['image_id'];
    $parent	= $_POST['parent'];

    // no image ID came through, so bail
    if (empty($image_id)) {
        $ret['success'] = false;
        echo json_encode($ret);
        die();
    }

    //Remove attachment - Does not actually delete the file
    $image_data = array();
    $image_data['ID'] = $image_id;
    $image_data['post_parent'] = 0;
    $update = wp_update_post($image_data);

    // AJAX return array
    $ret = array();

    if ($update !== 0) {
        // loop to refresh the gallery
        $loop = cpotheme_gallery_images($parent);
        $images	= cpotheme_gallery_display($loop);
        // return values
        $ret['success'] = true;
        $ret['gallery'] = $images;
    } else {
        // failure return. can probably make more verbose
        $ret['success'] = false;
    }

    echo json_encode($ret);
    die();
}
