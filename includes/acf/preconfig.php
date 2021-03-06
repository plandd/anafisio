<?php
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_banner-para-slider',
		'title' => 'Banner para slider',
		'fields' => array (
			array (
				'key' => 'field_55a8fd90168d1',
				'label' => 'Descrição do banner',
				'name' => 'banner_desc',
				'type' => 'textarea',
				'instructions' => 'Texto breve.',
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'formatting' => 'br',
			),
			array (
				'key' => 'field_55a9017538edd',
				'label' => 'Link do banner',
				'name' => 'banner_uri',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_55a8fdb2168d2',
				'label' => 'Imagem de fundo do banner',
				'name' => 'banner_bg',
				'type' => 'image',
				'save_format' => 'url',
				'preview_size' => 'full',
				'library' => 'all',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'banners',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'permalink',
				1 => 'the_content',
				2 => 'excerpt',
				3 => 'custom_fields',
				4 => 'discussion',
				5 => 'comments',
				6 => 'revisions',
				7 => 'slug',
				8 => 'author',
				9 => 'format',
				10 => 'featured_image',
				11 => 'categories',
				12 => 'tags',
				13 => 'send-trackbacks',
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_categoria-de-tratamento',
		'title' => 'Categoria de tratamento',
		'fields' => array (
			array (
				'key' => 'field_55a908adabc19',
				'label' => 'Ícone',
				'name' => 'cat_icon',
				'type' => 'select',
				'instructions' => 'Iconize a categoria',
				'choices' => array (
					'icon-icon_baby' => 'Bebê',
					'icon-icon_hearth' => 'Coração',
					'icon-icon_coracao' => 'Coração 2',
					'icon-icon_gear' => 'Motor',
					'icon-icon_horse' => 'Infantil',
					'icon-icon_acupuntura' => 'Acupuntura',
					'icon-icon_ajuda' => 'Ajuda',
					'icon-icon_bracoquebrado' => 'Braço quebrado',
					'icon-icon_brain' => 'Cérebro',
					'icon-icon_cadeiraderoda' => 'Cadeirante',
					'icon-icon_coluna' => 'Coluna',
					'icon-icon_massagem' => 'Massagem',
					'icon-icon_massagem2' => 'Massagem 2',
					'icon-icon_muleta' => 'Muleta',
					'icon-icon_muletas' => 'Muletas',
					'icon-icon_osso' => 'Osso',
					'icon-icon_osso2' => 'Osso 2',
					'icon-icon_osso3' => 'Osso 3',
					'icon-icon_pe' => 'Pé',
					'icon-icon_pernaquebrada' => 'Perna quebrada',
					'icon-icon_pilates' => 'Pilates',
					'icon-icon_raiox' => 'Raio-X',
					'icon-icon_yinyang' => 'YinYang',
					'icon-icon_yoga' => 'Yoga',
				),
				'default_value' => 'icon-icon_baby : Bebê',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_55a909ad76ab8',
				'label' => 'Imagem representativa',
				'name' => 'cat_img',
				'type' => 'image',
				'save_format' => 'url',
				'preview_size' => 'full',
				'library' => 'all',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'ef_taxonomy',
					'operator' => '==',
					'value' => 'category',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_galeria-do-tratamento',
		'title' => 'Galeria do tratamento',
		'fields' => array (
			array (
				'key' => 'field_55af9b5557b76',
				'label' => 'Subtítulo',
				'name' => 'tratamento_subtitulo',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_55af99dcfd3a9',
				'label' => 'Fotos ilustrativas do tratamento',
				'name' => 'gallery_tratamento',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_55af9a05fd3aa',
						'label' => 'Imagem',
						'name' => 'tratamento_img',
						'type' => 'image',
						'column_width' => '',
						'save_format' => 'url',
						'preview_size' => 'tratamento',
						'library' => 'all',
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Adicionar imagem',
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
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'featured_image',
				1 => 'tags',
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_icones',
		'title' => 'Ícones',
		'fields' => array (
			array (
				'key' => 'field_55af2ef1293e2',
				'label' => 'Ícone para o tratamento',
				'name' => 'icon_tratamento',
				'type' => 'select',
				'instructions' => 'Escolha um ícone para representar este tratamento',
				'choices' => array (
					'icon-icon_baby' => 'Bebê',
					'icon-icon_hearth' => 'Coração',
					'icon-icon_coracao' => 'Coração 2',
					'icon-icon_gear' => 'Motor',
					'icon-icon_horse' => 'Infantil',
					'icon-icon_acupuntura' => 'Acupuntura',
					'icon-icon_ajuda' => 'Ajuda',
					'icon-icon_bracoquebrado' => 'Braço quebrado',
					'icon-icon_brain' => 'Cérebro',
					'icon-icon_cadeiraderoda' => 'Cadeirante',
					'icon-icon_coluna' => 'Coluna',
					'icon-icon_massagem' => 'Massagem',
					'icon-icon_massagem2' => 'Massagem 2',
					'icon-icon_muleta' => 'Muleta',
					'icon-icon_muletas' => 'Muletas',
					'icon-icon_osso' => 'Osso',
					'icon-icon_osso2' => 'Osso 2',
					'icon-icon_osso3' => 'Osso 3',
					'icon-icon_pe' => 'Pé',
					'icon-icon_pernaquebrada' => 'Perna quebrada',
					'icon-icon_pilates' => 'Pilates',
					'icon-icon_raiox' => 'Raio-X',
					'icon-icon_yinyang' => 'YinYang',
					'icon-icon_yoga' => 'Yoga',
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
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
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_midia-para-background',
		'title' => 'Mídia para background',
		'fields' => array (
			array (
				'key' => 'field_55afb1fe5f4c8',
				'label' => 'Imagem',
				'name' => '',
				'type' => 'tab',
			),
			array (
				'key' => 'field_55afb2235f4c9',
				'label' => 'Imagem de fundo para cabeçalho',
				'name' => 'template_imgbg',
				'type' => 'image',
				'save_format' => 'url',
				'preview_size' => 'full',
				'library' => 'all',
			),
			array (
				'key' => 'field_55afb2ea726b9',
				'label' => 'Vídeo',
				'name' => '',
				'type' => 'tab',
			),
			array (
				'key' => 'field_55afb28d5f4ca',
				'label' => 'Vídeo de fundo para cabeçalho',
				'name' => 'template_video',
				'type' => 'file',
				'save_format' => 'url',
				'library' => 'all',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page_templates/sobre-nos.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'default',
					'order_no' => 0,
					'group_no' => 1,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page_templates/trabalhe-conosco.php',
					'order_no' => 0,
					'group_no' => 2,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page_templates/contato.php',
					'order_no' => 0,
					'group_no' => 3,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_subtitulo-da-pagina',
		'title' => 'Subtítulo da página',
		'fields' => array (
			array (
				'key' => 'field_55afc5dbc68a0',
				'label' => 'Texto breve sobre a página',
				'name' => 'template_excerpt',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_55afcc7575acf',
				'label' => 'Blockquote',
				'name' => 'template_block',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_55afcc9975ad0',
				'label' => 'Resumo blockquote',
				'name' => 'template_bckexc',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page_templates/sobre-nos.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page_templates/trabalhe-conosco.php',
					'order_no' => 0,
					'group_no' => 1,
				),
			),
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'featured_image',
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_midia-destacada-2',
		'title' => 'Mídia destacada',
		'fields' => array (
			array (
				'key' => 'field_55c9638455c02',
				'label' => 'Vídeo',
				'name' => 'slider_video',
				'type' => 'file',
				'save_format' => 'url',
				'library' => 'all',
			),
			array (
				'key' => 'field_55c966a3adb95',
				'label' => 'Imagem',
				'name' => 'slider_imagem',
				'type' => 'image',
				'save_format' => 'url',
				'preview_size' => 'full',
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
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'banners',
					'order_no' => 0,
					'group_no' => 1,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}

?>