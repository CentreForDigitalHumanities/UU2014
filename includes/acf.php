<?php 

// agenda 
if(function_exists("register_field_group"))

{
	register_field_group(array (
		'id' => 'acf_agenda',
		'title' => 'Agenda',
		'fields' => array (
			array (
				'key' => 'field_54afc57a46488',
				'label' => 'Start Datum',
				'name' => 'uu_agenda_start_date',
				'type' => 'date_picker',
				'required' => 1,
				'date_format' => 'yymmdd',
				'display_format' => 'dd/mm/yy',
				'first_day' => 1,
			),
			array (
				'key' => 'field_54afc5c646489',
				'label' => 'Eind datum',
				'name' => 'uu_agenda_end_date',
				'type' => 'date_picker',
				'date_format' => 'yymmdd',
				'display_format' => 'dd/mm/yy',
				'first_day' => 1,
			),
			array (
				'key' => 'field_54afc6714648c',
				'label' => 'Geen tijd',
				'name' => 'uu_agenda_all_day',
				'type' => 'true_false',
				'message' => '',
				'default_value' => 1,
			),
			array (
				'key' => 'field_54afc5d94648a',
				'label' => 'Start tijd',
				'name' => 'uu_agenda_start_time',
				'type' => 'date_time_picker',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_54afc6714648c',
							'operator' => '!=',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'show_date' => 'false',
				'date_format' => 'm/d/y',
				'time_format' => 'h:mm tt',
				'show_week_number' => 'false',
				'picker' => 'select',
				'save_as_timestamp' => 'true',
				'get_as_timestamp' => 'false',
			),
			array (
				'key' => 'field_54afc6414648b',
				'label' => 'Eind tijd',
				'name' => 'uu_agenda_end_time',
				'type' => 'date_time_picker',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_54afc6714648c',
							'operator' => '!=',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'show_date' => 'false',
				'date_format' => 'm/d/y',
				'time_format' => 'h:mm tt',
				'show_week_number' => 'false',
				'picker' => 'select',
				'save_as_timestamp' => 'true',
				'get_as_timestamp' => 'false',
			),
			array (
				'key' => 'field_54afc6bb4648d',
				'label' => 'Locatie',
				'name' => 'uu_agenda_location',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_54afc6d94648e',
				'label' => 'Url',
				'name' => 'uu_agenda_url',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_54afc6fc4648f',
				'label' => 'Afbeelding',
				'name' => 'uu_agenda_image',
				'type' => 'image',
				'save_format' => 'object',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
				array (
					'param' => 'post_category',
					'operator' => '==',
					'value' => '4',
					'order_no' => 1,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}

//people
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_people',
		'title' => 'People',
		'fields' => array (
			array (
				'key' => 'field_54b8d06b37d2a',
				'label' => 'Persoon',
				'name' => 'persoon',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_54b8dbc2b1f34',
						'label' => 'Type veld',
						'name' => 'uu_people_type',
						'type' => 'radio',
						'column_width' => '',
						'choices' => array (
							'Kop' => 'Kop',
							'Persoon' => 'Persoon',
						),
						'other_choice' => 0,
						'save_other_choice' => 0,
						'default_value' => 'Persoon',
						'layout' => 'horizontal',
					),
					array (
						'key' => 'field_54b8d08437d2b',
						'label' => 'Naam',
						'name' => 'uu_people_name',
						'type' => 'text',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_54b8dbc2b1f34',
									'operator' => '==',
									'value' => 'Persoon',
								),
							),
							'allorany' => 'all',
						),
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_54b8d08937d2c',
						'label' => 'Titel',
						'name' => 'uu_people_title',
						'type' => 'text',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_54b8dbc2b1f34',
									'operator' => '==',
									'value' => 'Persoon',
								),
							),
							'allorany' => 'all',
						),
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_54b8d09737d2d',
						'label' => 'Omschrijving',
						'name' => 'uu_people_desc',
						'type' => 'textarea',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_54b8dbc2b1f34',
									'operator' => '==',
									'value' => 'Persoon',
								),
							),
							'allorany' => 'all',
						),
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'maxlength' => '',
						'rows' => '',
						'formatting' => 'br',
					),
					array (
						'key' => 'field_54b8d0a037d2e',
						'label' => 'Website',
						'name' => 'uu_people_website',
						'type' => 'text',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_54b8dbc2b1f34',
									'operator' => '==',
									'value' => 'Persoon',
								),
							),
							'allorany' => 'all',
						),
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_54b8d0a737d2f',
						'label' => 'Email',
						'name' => 'uu_people_email',
						'type' => 'text',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_54b8dbc2b1f34',
									'operator' => '==',
									'value' => 'Persoon',
								),
							),
							'allorany' => 'all',
						),
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_54b8d0ab37d30',
						'label' => 'Foto',
						'name' => 'uu_people_image',
						'type' => 'image',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_54b8dbc2b1f34',
									'operator' => '==',
									'value' => 'Persoon',
								),
							),
							'allorany' => 'all',
						),
						'column_width' => '',
						'save_format' => 'object',
						'preview_size' => 'thumbnail',
						'library' => 'all',
					),
					array (
						'key' => 'field_54b8ea1b77e82',
						'label' => 'Titel kop',
						'name' => 'uu_people_title_heading',
						'type' => 'text',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_54b8dbc2b1f34',
									'operator' => '==',
									'value' => 'Kop',
								),
							),
							'allorany' => 'all',
						),
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'row',
				'button_label' => 'Voeg persoon toe',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page',
					'operator' => '==',
					'value' => '163',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}

