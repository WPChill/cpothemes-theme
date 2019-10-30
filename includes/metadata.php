<?php


add_filter('cpotheme_customizer_sections', 'cpotheme_customizer_sections');
function cpotheme_customizer_sections($data)
{
    $data['cpotheme_cpothemes'] = array(
        'title'      => __('CPOThemes', 'cpocore'),
        'capability' => 'edit_theme_options',
        'priority'   => 425
    );

    return $data;
}

add_filter('cpotheme_customizer_controls', 'cpotheme_customizer_controls');
function cpotheme_customizer_controls($data)
{
    $data['url_themes'] = array(
        'label'        => 'Themes Page URL',
        'section'      => 'cpotheme_cpothemes',
        'type'         => 'text',
        'multilingual' => true,
        'default'      => ''
    );

    $data['url_dashboard'] = array(
        'label'        => 'Dashboard Page URL',
        'section'      => 'cpotheme_cpothemes',
        'type'         => 'text',
        'multilingual' => true,
        'default'      => ''
    );

    $data['url_login'] = array(
        'label'        => 'Login Page URL',
        'section'      => 'cpotheme_cpothemes',
        'type'         => 'text',
        'multilingual' => true,
        'default'      => ''
    );

    $data['url_register'] = array(
        'label'        => 'Register Page URL',
        'section'      => 'cpotheme_cpothemes',
        'type'         => 'text',
        'multilingual' => true,
        'default'      => ''
    );

    $data['url_docs'] = array(
        'label'        => 'Docs Page URL',
        'section'      => 'cpotheme_cpothemes',
        'type'         => 'text',
        'multilingual' => true,
        'default'      => ''
    );

    $data['url_subscribe'] = array(
        'label'        => 'Buy Subscription URL',
        'section'      => 'cpotheme_cpothemes',
        'type'         => 'text',
        'multilingual' => true,
        'default'      => ''
    );

    return $data;
}


//Create theme meta fields
function cpotheme_metadata_theme()
{
    $cpotheme_data = array();

    $cpotheme_data[] = array(
        'name'  => 'download_title',
        'std'   => '',
        'label' => 'Título del Producto',
        'type'  => 'text',
        'desc'  => 'Indica la etiqueta de título (H1) del tema.'
    );

    $cpotheme_data[] = array(
        'name'  => 'download_cta_title',
        'std'   => '',
        'label' => 'Call to action title',
        'type'  => 'text',
        'desc'  => 'Call to action title, right below the header'
    );

    $cpotheme_data[] = array(
        'name'  => 'download_cta_text',
        'std'   => '',
        'label' => 'Call to action text',
        'type'  => 'text',
        'desc'  => 'Call to action text, right below the header'
    );

    $cpotheme_data[] = array(
        'name'  => 'download_demo_url',
        'std'   => '',
        'label' => 'URL de la Demo',
        'type'  => 'text',
        'desc'  => 'Especifica la URL de la demo del tema.'
    );

    $cpotheme_data[] = array(
        'name'  => 'download_url',
        'std'   => '',
        'label' => 'External URL',
        'type'  => 'text',
        'desc'  => 'Especifica la URL del tema si es un archivo externo.'
    );

    $cpotheme_data[] = array(
        'name'   => 'download_product',
        'std'    => '',
        'label'  => 'ID de Producto',
        'type'   => 'select',
        'option' => cpotheme_metadata_productlist_optional(),
        'desc'   => 'Indica la ID del producto para enlazarlo.'
    );

    $cpotheme_data[] = array(
        'name'   => 'download_features',
        'label'  => 'Funcionalidades',
        'type'   => 'collection',
        'option' => cpotheme_metadata_theme_features(),
        'desc'   => ''
    );

    $cpotheme_data[] = array(
        'name'  => 'download_smartphone',
        'label' => 'Imagen Movil (250x425)',
        'type'  => 'upload',
        'desc'  => ''
    );

    return $cpotheme_data;
}

function cpotheme_metadata_theme_features()
{
    $cpotheme_data = array(
        'title'   => array( 'label' => 'Titulo' ),
        'content' => array( 'label' => 'Contenido', 'args' => array( 'width' => '500px' ) ),
    );

    return $cpotheme_data;
}

//Create theme meta fields
function cpotheme_metadata_plugin()
{
    $cpotheme_data = array();

    $cpotheme_data[] = array(
        'name'  => 'plugin_title',
        'std'   => '',
        'label' => 'Título del Producto',
        'type'  => 'text',
        'desc'  => 'Indica la etiqueta de título (H1) del tema.'
    );

    $cpotheme_data[] = array(
        'name'  => 'plugin_demo_url',
        'std'   => '',
        'label' => 'URL de la Demo',
        'type'  => 'text',
        'desc'  => 'Especifica la URL de la demo del tema.'
    );

    $cpotheme_data[] = array(
        'name'  => 'plugin_url',
        'std'   => '',
        'label' => 'External URL',
        'type'  => 'text',
        'desc'  => 'Especifica la URL del tema si es un archivo externo.'
    );

    $cpotheme_data[] = array(
        'name'   => 'plugin_product',
        'std'    => '',
        'label'  => 'ID de Producto',
        'type'   => 'select',
        'option' => cpotheme_metadata_productlist_optional(),
        'desc'   => 'Indica la ID del producto para enlazarlo.'
    );

    $cpotheme_data[] = array(
        'name'  => 'plugin_changelog',
        'std'   => '',
        'label' => 'Changelog',
        'type'  => 'textarea',
        'desc'  => 'Muestra el registro de cambios de la descarga.'
    );

    return $cpotheme_data;
}


function cpotheme_metadata_download()
{
    $cpotheme_data = array();

    $cpotheme_data[] = array(
        'name'  => 'download_title',
        'std'   => '',
        'label' => 'Título del Producto',
        'type'  => 'text',
        'desc'  => 'Indica la etiqueta de título (H1) del tema.'
    );

    $cpotheme_data[] = array(
        'name'  => 'download_demo_url',
        'std'   => '',
        'label' => 'URL de la Demo',
        'type'  => 'text',
        'desc'  => 'Especifica la URL de la demo del tema.'
    );

    $cpotheme_data[] = array(
        'name'  => 'download_docs',
        'std'   => '',
        'label' => 'Slug de la Documentación',
        'type'  => 'text',
        'desc'  => 'Indica el slug que se corresponde con la categoría en la documentación del tema. Se utiliza para enlazar este tema con la documentación y mostrar enlaces e imágenes.'
    );

    $cpotheme_data[] = array(
        'name'  => 'download_external',
        'std'   => '',
        'label' => 'External URL',
        'type'  => 'text',
        'desc'  => 'Especifica la URL del tema si es un archivo externo.'
    );

    $cpotheme_data[] = array(
        'name'  => 'download_changelog',
        'std'   => '',
        'label' => 'Changelog',
        'type'  => 'textarea',
        'desc'  => 'Muestra el registro de cambios de la descarga.'
    );

    return $cpotheme_data;
}


//Create portfolio meta fields
function cpotheme_metadata_features()
{
    $cpotheme_data = array();

    $cpotheme_data[] = array(
        'name'   => 'feature_icon',
        'std'    => '',
        'label'  => 'Feature Icon',
        'desc'   => 'Sets an icon to be used as the featured image. If an icon is specified, it will replace the normal thumbnail.',
        'type'   => 'select',
        'option' => cpotheme_metadata_icons(),
        'class'  => 'fontawesome'
    );

    return $cpotheme_data;
}


//Create portfolio meta fields
function cpotheme_metadata_pages()
{
    $cpotheme_data = array();

    $cpotheme_data[] = array(
        'name'  => 'page_subtitle',
        'std'   => '',
        'label' => 'Subtitle',
        'desc'  => 'Adds a subtitle beneath the page header.',
        'type'  => 'text'
    );

    return $cpotheme_data;
}


//Create portfolio meta fields
function cpotheme_metadata_support()
{
    $cpotheme_data = array();

    $cpotheme_data[] = array(
        'name'   => 'support_icon',
        'std'    => '',
        'label'  => 'Feature Icon',
        'desc'   => 'Sets an icon to be used as the featured image. If an icon is specified, it will replace the normal thumbnail.',
        'type'   => 'select',
        'option' => cpotheme_metadata_icons(),
        'class'  => 'fontawesome'
    );

    return $cpotheme_data;
}


//Create portfolio meta fields
function cpotheme_metadata_themefeature_options()
{
    $cpotheme_data = array();

    $cpotheme_data[] = array(
        'name'  => 'feature_image',
        'std'   => '',
        'label' => 'Feature Image',
        'desc'  => '',
        'type'  => 'upload'
    );

    $cpotheme_data[] = array(
        'name'  => 'feature_premium',
        'std'   => '',
        'label' => 'Premium Feature',
        'desc'  => '',
        'type'  => 'checkbox'
    );

    return $cpotheme_data;
}


//Create theme meta fields
function cpotheme_metadata_showcase()
{
    $cpotheme_data = array();

    $cpotheme_data[] = array(
        'name'  => 'showcase_url',
        'std'   => '',
        'label' => 'URL',
        'type'  => 'text',
        'desc'  => 'Indica la URL de destino.'
    );

    $cpotheme_data[] = array(
        'name'   => 'showcase_theme',
        'std'    => '',
        'label'  => 'Theme',
        'type'   => 'select',
        'option' => cpotheme_metadata_themelist_optional(),
        'desc'   => 'Indica el tema utilizado.'
    );

    return $cpotheme_data;
}


//Returns a list of all pages by name
function cpotheme_metadata_themelist_optional($key = null)
{
    $cpotheme_data        = array();
    $page_list            = get_posts('post_type=cpo_theme&posts_per_page=-1&orderby=title&order=asc');
    $cpotheme_data['all'] = "(Sin Tema)";
    foreach ($page_list as $current_page) {
        $cpotheme_data[ $current_page->ID ] = $current_page->post_title;
    }

    return ($key == null) ? $cpotheme_data : $cpotheme_data[ $key ];
}


//Returns a list of all pages by name
function cpotheme_metadata_productlist_optional($key = null)
{
    $cpotheme_data        = array();
    $page_list            = get_posts('post_type=download&posts_per_page=-1&orderby=title&order=asc');
    $cpotheme_data['all'] = "(Sin Producto)";
    foreach ($page_list as $current_page) {
        $cpotheme_data[ $current_page->ID ] = $current_page->post_title;
    }

    return ($key == null) ? $cpotheme_data : $cpotheme_data[ $key ];
}
