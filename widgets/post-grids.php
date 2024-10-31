<?php
 
namespace Nemesis\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.

class Nemesis_Posts_Grids extends Widget_Base {

	public function get_name() {
		return 'nemesis-all-in-one';
	}

	public function get_title() {
		return __( 'Nemesis Post Grids', 'nemesis' );
	}

	public function get_icon() {
		return 'eicon-text';
	}

	public function get_categories() {
		return [ 'nemesis-all-in-one-widgets' ];
	}

	protected function register_controls() {
		
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Query and Layout', 'nemesis' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		// Post categories.
        $this->add_control(
            'post_categories',
            [
                'type'        => \Elementor\Controls_Manager::SELECT,
                'label'       => __( 'Select Category', 'nemesis' ),
				'label_block' => true,
                'options'     => $this->get_post_categories(),
            ]
        );
		
		// Number columns
        $this->add_control(
            'column_number',
            [
                'type'        => \Elementor\Controls_Manager::SELECT,
                'label'       => __( 'Number of Columns', 'nemesis' ),
				'label_block' => true,
				'separator'   => 'before',
                'default'     => '4',
                'options'     => [
					'1'   => __( '1 Column', 'nemesis' ),
                    '2'   => __( '2 Columns', 'nemesis' ),
                    '3'   => __( '3 Columns', 'nemesis' ),
                    '4'   => __( '4 Columns', 'nemesis' ),
					'6'   => __( '6 Columns', 'nemesis' ),
                ],
            ]
        );
		
		// Number of posts
        $this->add_control(
            'posts_number',
            [	
                'type'        => \Elementor\Controls_Manager::NUMBER,
				'separator'   => 'before',
                'label'       => __( 'Number of Posts', 'nemesis' ),
				'default'     => 4,
            ]
        );
		
		// Order by
        $this->add_control(
            'post_order_by',
            [
                'type'        => \Elementor\Controls_Manager::SELECT,
                'label'       => __( 'Order by', 'nemesis' ),
				'label_block' => true,
				'separator'   => 'before',
                'default'     => 'date',
                'options'     => [
                    'date'           => __( 'Date', 'nemesis' ),
                    'title'          => __( 'Title', 'nemesis' ),
                    'modified'       => __( 'Modified date', 'nemesis' ),
                    'comment_count'  => __( 'Comment count', 'nemesis' ),
                    'rand'           => __( 'Random', 'nemesis' ),
                ],
            ]
        );
		
		// Post offset
		$this->add_control(
            'post_offset',
            [
                'label'         => __( 'Post Offset', 'nemesis' ),
                'type'          => \Elementor\Controls_Manager::NUMBER,
                'default'       => 0,
			    'separator'     => 'before',
            ]
        );
		
		// Post format
		$this->add_control(
			'format',
			[
				'label'   => __( 'Post Format', 'nemesis' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'0'       => __( 'All', 'nemesis' ),
					'gallery' => __( 'Gallery', 'nemesis' ),
					'image'   => __( 'Image', 'nemesis' ),
					'video'   => __( 'Video', 'nemesis' ),
					'audio'   => __( 'Audio', 'nemesis' ),
					'quote'   => __( 'Quote', 'nemesis' ),
					'link'    => __( 'Link', 'nemesis' ),
				],
				'default'     => '0',
			]
		);
		
		// Hide Categories
        $this->add_control(
            'category_hide',
            [
                'label'     => __( 'Hide categories', 'nemesis' ),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'default'   => '',
				'separator' => 'before',
				'label_on'  => __('Show', 'nemesis' ),
				'label_off' => __('Hide', 'nemesis' ),
            ]
        );
		
		// Hide Author
        $this->add_control(
            'author_hide',
            [
                'label'     => __( 'Hide author', 'nemesis' ),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'default'   => '',
				'label_on'  => __('Show', 'nemesis' ),
				'label_off' => __('Hide', 'nemesis' ),
            ]
        );
		
		// Hide Date
        $this->add_control(
            'date_hide',
            [
                'label'     => __( 'Hide date', 'nemesis' ),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'default'   => '',
				'label_on'  => __('Show', 'nemesis' ),
				'label_off' => __('Hide', 'nemesis' ),
            ]
        );

		// Hide Post Format Icon
		$this->add_control(
            'post_type_icon',
            [
                'label'   => __( 'Hide post format icon', 'nemesis' ),
                'type'    => \Elementor\Controls_Manager::SWITCHER,
                'default' => '',
				'label_on' => __('Show', 'nemesis' ),
				'label_off' => __('Hide', 'nemesis' ),
				'condition' => [
					'post_image' => 'yes',
				],
            ]
        );
		
		// Post Image
		$this->add_control(
            'post_image',
            [
                'label'     => __( 'Post Image', 'nemesis' ),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'default'   => '',
				'label_on'  => __('Hide', 'nemesis' ),
				'label_off' => __('Show', 'nemesis' ),
            ]
        );
		
		// Content position
		$this->add_control(
            'content_position',
            [
                'type'         => \Elementor\Controls_Manager::SELECT,
                'label'        => __( 'Content Position', 'nemesis' ),
				'label_block'  => true,
                'default'      => 'top',
                'options'      => [
					'top'      => __( 'Top', 'nemesis' ),
                    'bottom'   => __( 'Bottom', 'nemesis' ),
					'caption'  => __( 'Caption', 'nemesis' ),
					'none'     => __( 'No Caption', 'nemesis' ),
                ],
            ]
        );
		
		// Custom Image Height
		$this->add_control(
            'post_image_height',
            [
                'label'     => __( 'Custom Image Height', 'nemesis' ),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'default'   => '',
				'label_on'  => __('No', 'nemesis' ),
				'label_off' => __('Yes', 'nemesis' ),
				'condition' => [
					'post_image' => 'yes',
				],
            ]
        );

		// Image position
		$this->add_control(
            'image_position',
            [
                'type'         => \Elementor\Controls_Manager::SELECT,
                'label'        => __( 'Image Position', 'nemesis' ),
				'label_block'  => true,
                'default'      => 'center',
                'options'      => [
					'center'   => __( 'Center', 'nemesis' ),
                    'left'     => __( 'Left', 'nemesis' ),
					'right'    => __( 'Right', 'nemesis' ),
                ],
				'condition'    => [
					'post_image' => 'yes',
					'content_position!' => [ 'caption', 'none' ]
				],
            ]
        );
		
		$this->add_responsive_control(
			'caption_img_height',
			[
				'label' => __( 'Image Height', 'nemesis' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['%', 'px'],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 300,
					],
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'unit' => '%',
					'size' => 100,
				],
				'tablet_default' => [
					'unit' => '%',
					'size' => 100,
				],
				'mobile_default' => [
					'unit' => '%',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .fbt-post-thumbnail' => 'padding-top: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'post_image_height' => 'yes',
					'post_image' => 'yes',
				],
			]
		);
		
		// Content center
		$this->add_control(
            'content_center',
            [
                'label'     => __( 'Content Center', 'nemesis' ),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'default'   => '',
				'label_off' => __('No', 'nemesis' ),
				'label_on'  => __('Yes', 'nemesis' ),
            ]
        );
		
		// Cut Title
		$this->add_control(
            'title_trim',
            [
                'label'     => __( 'Cut Title', 'nemesis' ),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'default'   => '',
				'label_off' => __('Off', 'nemesis' ),
				'label_on'  => __('On', 'nemesis' ),
            ]
        );
		
		// Title length
		$this->add_control(
            'title_length', [
				'label'     => __( 'Title Length', 'nemesis' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'default'   => 6,
				'condition' => [
					'title_trim' => 'yes',
				],
            ]
        );
		
		// Excerpt
        $this->add_control(
            'excerpt_hide',
            [
                'label'   => __( 'Hide Excerpt', 'nemesis' ),
                'type'    => \Elementor\Controls_Manager::SWITCHER,
                'default' => '',
				'label_on'  => __('Show', 'nemesis' ),
				'label_off' => __('Hide', 'nemesis' ),
				'condition' => [
					'content_position!' => 'caption',
				],
            ]
        );
		
		$this->add_control(
            'excerpt_length', [
				'label'     => __( 'Excerpt Length', 'nemesis' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'separator' => 'before',
				'default'   => 18,
				'condition' => [
					'excerpt_hide!' => 'yes',
					'content_position!' => 'caption',
				],
            ]
        );
        
		$this->end_controls_section();
		
		// Layout
		$this->start_controls_section(
			'layout_section',
			[
				'label' => __( 'Layout', 'nemesis' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		// Title size
		$this->add_control(
            'title_size',
            [
                'label'   => __( 'Title Heading Tag', 'nemesis' ),
                'type' 	  => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'h1'  => __( 'H1', 'nemesis' ),
                    'h2'  => __( 'H2', 'nemesis' ),
                    'h3'  => __( 'H3', 'nemesis' ),
                    'h4'  => __( 'H4', 'nemesis' ),
                    'h5'  => __( 'H5', 'nemesis' ),
                    'h6'  => __( 'H6', 'nemesis' ),
                ],
                'default' => 'h4',
            ]
        );
		
		// Title typography
		$this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
				'label'    => __( 'Title Typography', 'nemesis' ),
                'selector' => '{{WRAPPER}} .fbt-post-caption .post-title',
				'global'   => [
					'default' => Global_Typography::TYPOGRAPHY_ACCENT,
				],
            ]
        );
		
		// Text
		$this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'text_typography',
				'label'    => __( 'Text Typography', 'nemesis' ),
                'selector' => '{{WRAPPER}} .fbt-block-items .fbt-post-caption .post-excerpt',
				'global'   => [
					'default' => Global_Typography::TYPOGRAPHY_ACCENT,
				],
            ]
        );
		
		// Title color
		$this->add_control(
            'fs_title_color',
            [
                'label'     => __( 'Title Color', 'nemesis' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
                'selectors' => [
					'{{WRAPPER}} .fbt-post-caption .post-title a' => 'color: {{VALUE}};',
                ],
            ]
        );
		
		// Title hover color
		$this->add_control(
            'fs_title_hover_color',
            [
                'label'     => __( 'Title Hover Color', 'nemesis' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
					'{{WRAPPER}} .fbt-post-caption .post-title a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
		
		// Excerpt color
		$this->add_control(
            'excerpt_color',
            [
                'label'     => __( 'Excerpt Color', 'nemesis' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .post-excerpt' => 'color: {{VALUE}};',
                ],
            ]
        );
		
		// Border color
		$this->add_control(
            'fs_line_color',
            [
                'label'     => __( 'Border Color', 'nemesis' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .fbt-block-items .item-grid' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .fbt-block-items .has-border .post-item' => 'border-color: {{VALUE}};',
                ],
            ]
        );
		
		// Meta color
		$this->add_control(
            'fs_meta_color',
            [
                'label'     => __( 'Meta Color', 'nemesis' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .fbt-block-items .post-meta a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .fbt-block-items .post-meta' => 'color: {{VALUE}};',
					'{{WRAPPER}} .fbt-block-items .post-meta .post-author' => 'color: {{VALUE}};',
                ],
            ]
        );
		
		// Category color
		$this->add_control(
            'category_color',
            [
                'label'     => __( 'Category Color', 'nemesis' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
					'{{WRAPPER}} .fbt-cat-content .cat-link' => 'color: {{VALUE}};',
                ],
            ]
        );
		
		// Overlay
		$this->add_control(
            'overlay_color',
            [
                'label'     => __( 'Image Overlay', 'nemesis' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
					'{{WRAPPER}} .fbt-block-items .fbt-post-thumbnail::after' => 'background: {{VALUE}};',
                ],
				'condition' => [
					'column_number' => '1',
					'post_image' => 'yes',
				],
            ]
        );

		$this->end_controls_section();		

		$this->start_controls_section(
			'grid_control',
			[
				'label' => __( 'Grid Control', 'nemesis' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		// Grids padding
		$this->add_control(
            'grid_padding', [
				'label'    => __( 'Grids Padding X', 'nemesis' ),
				'type'     => \Elementor\Controls_Manager::SLIDER,
				'default'  => [
					'size' => 30,
				],
				'range'    => [
					'px' => [
						'min' => 0,
						'max' => 30,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .fbt-block-items .item-grid' => 'padding-left: {{SIZE}}{{UNIT}};padding-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .fbt-block-items .grid-posts.row' => 'margin-left: -{{SIZE}}{{UNIT}};margin-right: -{{SIZE}}{{UNIT}};',
				],
            ]
        );

		// Image border radius
		$this->add_control(
            'grid_border_radius', [
				'label'     => __( 'Border Radius', 'nemesis' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'separator' => 'before',
				'default'   => [
					'size'  => 0,
				],
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .radius-10' => 'border-radius: {{SIZE}}{{UNIT}}!important;',
				],
				'condition' => [
					'post_image' => 'yes',
				],
            ]
        );

		// image hover effects
		$this->add_control(
            'image_hover_effects',
            [
                'label'     => __( 'Image Hover Effects', 'nemesis' ),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
				'separator' => 'before',
                'default'   => '',
				'label_on'  => __('On', 'nemesis' ),
				'label_off' => __('Off', 'nemesis' ),
				'condition' => [
					'post_image' => 'yes',
				],
            ]
        );
		
		$this->add_control(
            'grid_margin', [
				'label'     => __( 'Grids Margin', 'nemesis' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'separator' => 'before',
				'default'   => [
					'size'  => 15,
				],
				'range' 	=> [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .fbt-block-items .item-grid' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'column_number' => '1',
				],
            ]
        );

		// List padding bottom
		$this->add_control(
            'grid_padding_bottom', [
				'label'     => __( 'List Padding Bottom', 'nemesis' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'separator' => 'before',
				'default'   => [
					'size'  => 15,
				],
				'range'  => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .fbt-block-items .has-border .post-item' => 'padding-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'column_number' => '1',
					'grids_border_bottom' => 'yes',
				],
            ]
        );

		// List caption distance
		$this->add_responsive_control(
            'grid_gap', [
				'label'     => __( 'Caption Distance', 'nemesis' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'separator' => 'before',
				'default'   => [
					'size'  => 30,
				],
				'range'  => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .fbt-block-items .fbt-post-caption.img-left' => 'grid-gap: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .fbt-block-items .fbt-post-caption.img-right' => 'grid-gap: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'column_number' => '1',
					'post_image' => 'yes',
					'content_position!' => [ 'caption', 'none' ]
				],
            ]
        );
		
		// Border control
		$this->add_control(
            'grids_border',
            [
                'label'     => __( 'Grids Border', 'nemesis' ),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'default'   => '',
				'label_on'  => __('Show', 'nemesis' ),
				'label_off' => __('Hide', 'nemesis' ),
				'condition' => [
					'column_number!' => '1',
				],
            ]
        );

		$this->add_control(
            'grids_border_bottom',
            [
                'label'     => __( 'Grids Border Bottom', 'nemesis' ),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'default'   => '',
				'label_on'  => __('Show', 'nemesis' ),
				'label_off' => __('Hide', 'nemesis' ),
				'condition' => [
					'column_number' => '1',
				],
            ]
        );
		
		$this->end_controls_section();
		
	}

	protected function render() {

		$settings = $this->get_settings_for_display();
		
		$column;
		if ( ! empty( $settings['column_number'] ) ) {
			if ($settings['column_number'] == "1") {
				$column = "col-lg-12";
			} else if ($settings['column_number'] == "2") {
				$column = "col-lg-6 col-md-6";
			} else if ($settings['column_number'] == "3") {
				$column = "col-lg-4";
			} else if ($settings['column_number'] == "4") {
				$column = "col-lg-3 col-md-6";
			} else if ($settings['column_number'] == "6") {
				$column = "col-xl-2 col-lg-4 col-md-6";
			}
		} else {
			$column = '';
		}
		
		$this->add_render_attribute( 'grid-column-control', 'class', 'item-grid' );
		$this->add_render_attribute( 'grid-column-control', 'class', $column  );

		echo '<div class="fbt-block-items">'; ?>
		<div class="grid-posts-container<?php if (! empty( $settings['grids_border_bottom'] === 'yes' ) ) { echo esc_attr(' has-border'); } ?>">
		<div class="grid-posts row<?php if (! empty( $settings['grids_border'] === 'yes' ) ) { echo esc_attr(' has-not-border'); } ?>">
		
		<?php
		$args = [
            'post_type' => 'post',
            'post_status' => 'publish',
            'ignore_sticky_posts' => 1,
        ];
		
		if ( ! empty( $settings['format'] ) && $settings['format'] ) {
            if ( 'default' != $settings['format'] ) {
                $args['tax_query'][] = array(
                    'taxonomy' => 'post_format',
                    'field'    => 'slug',
                    'terms'    => array( 'post-format-' . trim( $settings['format'] ) ),
                );
            } else {
                $args['tax_query'][] = array(
                    'taxonomy' => 'post_format',
                    'field'    => 'slug',
                    'terms'    => array( 'post-format-gallery', 'post-format-video', 'post-format-audio' ),
                    'operator' => 'NOT IN',
                );
            }
        }
		
		if ( get_query_var('paged') ) {
			$paged = get_query_var('paged');
		} else if ( get_query_var('page') ) {
			$paged = get_query_var('page');
		} else {
			$paged = 1;
		}
		
		if ( ! empty( $paged ) ) {
            $args['paged'] = intval( $paged );
        }
		
		$offset = $settings['post_offset'];

        if ( ! empty( $offset ) ) {
            if ( $paged > 1 ) {
                $args['offset'] = intval( $offset ) + intval( ( $paged - 1 ) * intval( $settings['posts_number'] ) );
            } else {
                $args['offset'] = intval( $offset );
            }
            unset( $args['paged'] );
        }
		
		// Posts number
        if ( ! empty( $settings['posts_number'] ) ) {
            $args['posts_per_page'] = $settings['posts_number'];
        }
		
		// Category
        if ( ! empty( $settings['post_categories'] ) ) {
            $args['category_name'] = $settings['post_categories'];
        }
		
		// Order by
        if ( ! empty( $settings['post_order_by'] ) ) {
            $args['orderby'] = $settings['post_order_by'];
        }

		// Query
        $query = new \WP_Query( $args );
        if ( $query->have_posts() ) :

            while ( $query->have_posts() ) :
                $query->the_post();
				$this->renderGridPosts( get_the_ID() );
            endwhile;

        endif;
        wp_reset_postdata(); ?>
		
		</div>
		</div>
		<?php
		echo '</div>';

	}
	
	protected function renderGridPosts( $post_id = '' ) { 
	
		$settings = $this->get_settings_for_display(); 
		$format = get_post_format(); ?>
		
		<div <?php echo $this->get_render_attribute_string( 'grid-column-control' ); ?>>
			<article <?php post_class( 'post-item' ); ?>>
				<div class="fbt-item-grid h-100">
					<div class="fbt-post-caption<?php if ( $settings['image_position'] === 'center' ) { echo esc_attr(' img-centered'); } elseif ( $settings['image_position'] === 'left' ) { echo esc_attr(' img-left'); } elseif ( $settings['image_position'] === 'right' ) { echo esc_attr(' img-right'); } ?><?php if ( $settings['content_position'] === 'bottom' ) { echo esc_attr(' dg-caption-bottom'); } ?>">
						<?php if ( $settings['content_position'] === 'top' ) { ?>
							<div class="caption-div<?php if ( $settings['content_center'] === 'yes' ) { echo esc_attr(' text-center'); } ?>">
								<?php $category = get_the_category(); if ( $settings['category_hide'] !== 'yes' ) { ?><div class="fbt-cat-content"><span class="cat-link cat-ID-<?php echo esc_html( $category[0]->cat_ID ); ?>"><?php echo esc_html( $category[0]->cat_name ); ?></span></div><?php } ?>
								<<?php esc_attr_e( $settings['title_size'] ); ?> class="post-title mb-0">
									<?php $title_length = $settings['title_length']; ?>
									<a href="<?php the_permalink(); ?>"><?php if( $settings['title_trim'] === 'yes' ) { echo wp_trim_words( get_the_title(), $title_length, '' ); } else { the_title(); } ?></a>
								</<?php esc_attr_e( $settings['title_size'] ); ?>>
								<?php if ( $settings['author_hide'] !== 'yes' || $settings['date_hide'] !== 'yes' ) { ?>
								<div class="post-meta">
									<?php if ( $settings['author_hide'] !== 'yes' ) { ?><span class="post-author"><?php the_author_posts_link(); ?></span><?php } ?>
									<?php if ( $settings['date_hide'] !== 'yes' ) { ?><span class="post-date published"><?php echo get_the_date();?></span><?php } ?>
								</div>
								<?php } ?>
								<?php if ( $settings['excerpt_hide'] !== 'yes' ) { ?>
									<?php $excerpt_length = $settings['excerpt_length']; ?>
									<p class="post-excerpt mb-0"><?php echo wp_trim_words( get_the_excerpt(), $excerpt_length, '' ); ?></p>
								<?php } ?>
							</div><!-- .caption-div -->
						<?php } ?>
						<?php if ( $settings['post_image'] === 'yes' ) { ?>
							<?php if ( has_post_thumbnail() ) { ?>
								<div class="fbt-post-thumbnail<?php if( $settings['image_hover_effects'] === 'yes' ) { echo esc_attr( ' transform-scale' ); } ?><?php if ( $settings['content_position'] === 'bottom' ) { echo esc_attr(' mt-0 caption-bottom'); } elseif ( $settings['content_position'] === 'caption' || $settings['content_position'] === 'none' ) { echo esc_attr(' mt-0'); } ?><?php if ( $settings['post_image_height'] === 'yes' ) {echo esc_attr(' fbt-custom-height');} ?>">
									<div class="thumb-container radius-10">
										<a href="<?php the_permalink(); ?>">
											<?php if ( $settings['column_number'] == '1' ) { the_post_thumbnail('nemesis-large-thumb', array( 'alt' => get_the_title(), 'class' => 'post-thumbnail' )); } else { the_post_thumbnail( 'nemesis-grid-posts', array( 'alt' => get_the_title(), 'class' => 'post-thumbnail' ) ); } ?>
										</a>
										<?php if ( $settings['content_position'] === 'caption' ) { ?>
										<div class="fbt-item-caption<?php if ( $settings['content_center'] === 'yes' ) { echo esc_attr(' text-center'); } ?>">
											<div class="caption-div<?php if ( $settings['content_center'] === 'yes' ) { echo esc_attr(' text-center'); } ?>">
												<?php $category = get_the_category(); if ( $settings['category_hide'] !== 'yes' ) { ?><div class="fbt-cat-content style-2"><span class="fbt-category"><span class="cat-link cat-ID-<?php echo esc_html( $category[0]->cat_ID ); ?>"><?php echo esc_html( $category[0]->cat_name ); ?></span></span></div><?php } ?>
												<<?php esc_attr_e( $settings['title_size'] ); ?> class="post-title mb-0">
													<?php $title_length = $settings['title_length']; ?>
													<a href="<?php the_permalink(); ?>"><?php if( $settings['title_trim'] === 'yes' ) { echo wp_trim_words( get_the_title(), $title_length, '' ); } else { the_title(); } ?></a>
												</<?php esc_attr_e( $settings['title_size'] ); ?>>
												<?php if ( $settings['author_hide'] !== 'yes' || $settings['date_hide'] !== 'yes' ) { ?>
												<div class="post-meta">
													<?php if ( $settings['author_hide'] !== 'yes' ) { ?><span class="post-author"><?php the_author_posts_link(); ?></span><?php } ?>
													<?php if ( $settings['date_hide'] !== 'yes' ) { ?><span class="post-date published"><?php echo get_the_date();?></span><?php } ?>
												</div>
												<?php } ?>
											</div>
										</div>
										<?php } else if ( $settings['content_position'] === 'none' ) {} ?>
										<?php if ( $settings['post_type_icon'] !== 'yes' ) { ?>
											<?php if( $format == 'gallery' ) { ?>
												<span class="post-format-icon"><span class="dashicons dashicons-format-gallery"></span></span>
											<?php } elseif( $format == 'image' ) { ?>
												<span class="post-format-icon"><span class="dashicons dashicons-format-image"></span></span>
											<?php } elseif( $format == 'audio' ) { ?>
												<span class="post-format-icon"><span class="dashicons dashicons-format-audio"></span></span>
											<?php } elseif( $format == 'video' ) { ?>
												<span class="post-format-icon"><span class="dashicons dashicons-editor-video"></span></span>
											<?php } elseif( $format == 'link' ) { ?>
												<span class="post-format-icon"><span class="dashicons dashicons-admin-links"></span></span>
											<?php } elseif( $format == 'quote' ) { ?>
												<span class="post-format-icon"><span class="dashicons dashicons-editor-quote"></span></span>
											<?php } ?>
										<?php } ?>
									</div>
								</div><!-- .fbt-post-thumbnail -->
							<?php } ?>
						<?php } ?>
						<?php if ( $settings['content_position'] === 'bottom' ) { ?>
							<div class="caption-div<?php if ( $settings['content_center'] === 'yes' ) { echo esc_attr(' text-center'); } ?>">
								<?php $category = get_the_category(); if ( $settings['category_hide'] !== 'yes' ) { ?><div class="fbt-cat-content"><span class="cat-link cat-ID-<?php echo esc_html( $category[0]->cat_ID ); ?>"><?php echo esc_html( $category[0]->cat_name ); ?></span></div><?php } ?>
								<<?php esc_attr_e( $settings['title_size'] ); ?> class="post-title mb-0">
									<?php $title_length = $settings['title_length']; ?>
									<a href="<?php the_permalink(); ?>"><?php if( $settings['title_trim'] === 'yes' ) { echo wp_trim_words( get_the_title(), $title_length, '' ); } else { the_title(); } ?></a>
								</<?php esc_attr_e( $settings['title_size'] ); ?>>
								<?php if ( $settings['author_hide'] !== 'yes' || $settings['date_hide'] !== 'yes' ) { ?>
								<div class="post-meta">
									<?php if ( $settings['author_hide'] !== 'yes' ) { ?><span class="post-author"><?php the_author_posts_link(); ?></span><?php } ?>
									<?php if ( $settings['date_hide'] !== 'yes' ) { ?><span class="post-date published"><?php echo get_the_date();?></span><?php } ?>
								</div>
								<?php } ?>
								<?php if ( $settings['excerpt_hide'] !== 'yes' ) { ?>
									<?php $excerpt_length = $settings['excerpt_length']; ?>
									<p class="post-excerpt mb-0"><?php echo wp_trim_words( get_the_excerpt(), $excerpt_length, '' ); ?></p>
								<?php } ?>
							</div><!-- .caption-div -->
						<?php } ?>
					</div><!-- .fbt-post-caption -->
				</div><!-- .fbt-item-grid -->
			</article>
		</div>

        <?php
    }
	
	private function get_post_categories() {
        $options = array();
        if ( ! empty( 'category' ) ) {
            // Get categories for post type.
            $terms = get_terms(
                array(
                    'taxonomy'   => 'category',
                    'hide_empty' => true,
                )
            );
            $options = array( '0' => esc_html__( 'All', 'nemesis' ) );
            if ( ! empty( $terms ) ) {
                foreach ( $terms as $term ) {
                    if ( isset( $term ) ) {
                        if ( isset( $term->slug ) && isset( $term->name ) ) {
                            $options[ $term->slug ] = $term->name;
                        }
                    }
                }
            }
        }
        return $options;
    }
}