<?php

//Inserts custom metabox as per the theme's features
add_action('add_meta_boxes', 'cpotheme_metabox');
function cpotheme_metabox()
{
    add_meta_box('cpotheme_pages', 'Page Details', 'cpotheme_metabox_pages', 'page', 'normal', 'high');
    add_meta_box('cpotheme_themes', 'Theme Details', 'cpotheme_metabox_theme', 'cpo_theme', 'normal', 'high');
    add_meta_box('cpotheme_plugins', 'Plugin Details', 'cpotheme_metabox_plugin', 'cpo_plugin', 'normal', 'high');
    add_meta_box('cpotheme_support', 'Support Options', 'cpotheme_metabox_support', 'cpo_support', 'normal', 'high');
    add_meta_box('cpotheme_showcase', 'Showcase Options', 'cpotheme_metabox_showcase', 'cpo_showcase', 'normal', 'high');
}

function cpotheme_metabox_pages($post)
{
    cpotheme_meta_fields($post, cpotheme_metadata_pages());
}
add_action('edit_post', 'cpotheme_metabox_pages_save');
function cpotheme_metabox_pages_save($post)
{
    cpotheme_meta_save(cpotheme_metadata_pages());
}


function cpotheme_metabox_support($post)
{
    cpotheme_meta_fields($post, cpotheme_metadata_support());
}
add_action('edit_post', 'cpotheme_metabox_support_save');
function cpotheme_metabox_support_save($post)
{
    cpotheme_meta_save(cpotheme_metadata_support());
}


function cpotheme_metabox_download($post)
{
    cpotheme_meta_fields($post, cpotheme_metadata_download());
}
add_action('edit_post', 'cpotheme_metabox_download_save');
function cpotheme_metabox_download_save($post)
{
    cpotheme_meta_save(cpotheme_metadata_download());
}


function cpotheme_metabox_theme($post)
{
    cpotheme_meta_fields($post, cpotheme_metadata_theme());
}
add_action('edit_post', 'cpotheme_metabox_theme_save');
function cpotheme_metabox_theme_save($post)
{
    cpotheme_meta_save(cpotheme_metadata_theme());
}


function cpotheme_metabox_plugin($post)
{
    cpotheme_meta_fields($post, cpotheme_metadata_plugin());
}
add_action('edit_post', 'cpotheme_metabox_plugin_save');
function cpotheme_metabox_plugin_save($post)
{
    cpotheme_meta_save(cpotheme_metadata_plugin());
}


function cpotheme_metabox_showcase($post)
{
    cpotheme_meta_fields($post, cpotheme_metadata_showcase());
}
add_action('edit_post', 'cpotheme_metabox_showcase_save');
function cpotheme_metabox_showcase_save($post)
{
    cpotheme_meta_save(cpotheme_metadata_showcase());
}


//Add default metaboxes to taxonomies
add_action('admin_init', 'cpotheme_theme_taxonomy_metaboxes');
function cpotheme_theme_taxonomy_metaboxes()
{
    add_action('cpo_theme_feature_edit_form', 'cpotheme_theme_taxonomy_metabox_layout');
    add_action('edit_cpo_theme_feature', 'cpotheme_theme_taxonomy_layout_save');
    add_action('delete_cpo_theme_feature', 'cpotheme_theme_taxonomy_layout_delete');
}

//Display forms for all public taxonomies
function cpotheme_theme_taxonomy_metabox_layout($post)
{
    cpotheme_taxonomy_meta_form('Theme Feature Options', $post, cpotheme_metadata_themefeature_options());
}

//Save the data
function cpotheme_theme_taxonomy_layout_save($post)
{
    cpotheme_taxonomy_meta_save(cpotheme_metadata_themefeature_options());
}

//Delete the data
function cpotheme_theme_taxonomy_layout_delete()
{
    cpotheme_taxonomy_meta_delete(cpotheme_metadata_themefeature_options());
}
