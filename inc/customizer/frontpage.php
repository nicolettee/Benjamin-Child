<?php


function benjamin_frontpage_settings($wp_customize) {

    // $section = 'rontpage_settings_section'; // old section
    $section = 'static_front_page';

    $label_args = array(
        'section' => $section,
        'setting_id' => 'frontpage_header_content_label',
        'label' => 'Header Content Settings',
        'control_id' => 'frontpage_header_label_control'
    );
    benjamin_customizer_label($wp_customize, $label_args);




    // select the what to display in the header
    $wp_customize->add_setting( 'frontpage_hero_content_setting', array(
        'default'  => 'callout',
        'sanitize_callback' => 'benjamin_frontpage_hero_content_sanitize',
    ) );

    $wp_customize->add_control( 'frontpage_hero_content_control', array(
            'description' => __('Select what to display in the header.','benjamin'),
            'label'   => __('Content', 'benjamin'),
            'section' => $section,
            'settings'=> 'frontpage_hero_content_setting',
            'priority' => 1,
            'type' => 'select',
            'choices' => array(
                'callout' => 'Callout',
                'page' => 'Select a Page',
                'nothing' => 'Nothing',
            )
        )
    );


    // Select the page link to use in the callout
     $wp_customize->add_setting( 'frontpage_hero_callout_setting', array(
         'default' => '',
         'sanitize_callback' => 'absint',
     ) );
     $wp_customize->add_control( 'frontpage_hero_callout_control',
         array(
             'description' => __('Display a button link in the callout to a selected page','benjamin'),
             'label'   => __('Callout Button Link', 'benjamin'),
             'section' => $section,
             'settings'=> 'frontpage_hero_callout_setting',
             'type'    => 'dropdown-pages',
             'priority' => 1,
         )
     );



    $wp_customize->add_setting( 'frontpage_hero_page_setting', array(
        'default'        => '',
        'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control( 'frontpage_hero_page_control', array(
            'label'   => __('Select a Page', 'benjamin'),
            'section' => $section,
            'settings'=> 'frontpage_hero_page_setting',
            'type'    => 'dropdown-pages',
            'priority' => 1,
         )
    );



     /**
      * Sortables
      * @var string
      */
     $wp_customize->add_setting( 'frontpage_sortables_setting', array(
         'default'        => '[{"name":"page-content","label":"Page Content"}]',
         'sanitize_callback' => 'benjamin_frontpage_sortable_sanitize',
     ) );

     $description = 'The page content is sortable, and optional.  Simply drag the
     available components from the "available" box over to active.  This setting
     does not depend on the "Settings Active" setting above.';

     $wp_customize->add_control( new Benjamin_Sortable_Control( $wp_customize,
        'frontpage_sortables_control', array(
            'description' => $description,
            'label'   => __('Sortable Page Content', 'benjamin'),
            'section' => $section,
            'settings'=> 'frontpage_sortables_setting',
            'priority' => 1,
            'optional' => true,
            'choices' => array(
                    'widget-area-1' => 'Widget Area 1',
                    'widget-area-2' => 'Widget Area 2',
                    'widget-area-3' => 'Widget Area 3',
                    'page-content' => 'Page Content'
                ),
            )
        )
    );

}
add_action('customize_register', 'benjamin_frontpage_settings');
