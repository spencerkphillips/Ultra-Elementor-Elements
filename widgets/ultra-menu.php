<?php
namespace UltraElements\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class UltraMenu extends Widget_Base {

  /**
   * Retrieve the widget name.
   *
   * @since 1.1.0
   *
   * @access public
   *
   * @return string Widget name.
   */
  public function get_name() {
    return 'vertical-menu';
  }

  /**
   * Retrieve the widget title.
   *
   * @since 1.1.0
   *
   * @access public
   *
   * @return string Widget title.
   */
  public function get_title() {
    return __( 'Vertical Menu', 'ultra-elements' );
  }

  /**
   * Retrieve the widget icon.
   *
   * @since 1.1.0
   *
   * @access public
   *
   * @return string Widget icon.
   */
  public function get_icon() {
    return 'eicon-nav-menu';
  }

  /**
   * Retrieve the list of categories the widget belongs to.
   *
   * Used to determine where to display the widget in the editor.
   *
   * Note that currently Elementor supports only one category.
   * When multiple categories passed, Elementor uses the first one.
   *
   * @since 1.1.0
   *
   * @access public
   *
   * @return array Widget categories.
   */
  public function get_categories() {
    return [ 'general' ];
  }

  public function get_keywords(){
    return ['menu', 'nav', 'button' ];
  }

  public function get_script_depends(){
    return [ 'smartmenus' ];
  }

	public function on_export( $element ) {
		unset( $element['settings']['menu'] );

		return $element;
	}

	protected function get_nav_menu_index() {
		return $this->nav_menu_index++;
	}

	private function get_available_menus() {
		$menus = wp_get_nav_menus();

		$options = [];

		foreach ( $menus as $menu ) {
			$options[ $menu->slug ] = $menu->name;
		}

		return $options;
	}

  /**
   * Register the widget controls.
   *
   * Adds different input fields to allow the user to change and customize the widget settings.
   *
   * @since 1.1.0
   *
   * @access protected
   */
   protected function _register_controls() {

     $this->start_controls_section(
       'section_layout',
       [
         'label' => __( 'Layout', 'ultra-elements' ),
       ]
     );

     $menus = $this->get_available_menus();

     if ( ! empty( $menus ) ) {
       $this->add_control(
         'menu',
         [
           'label' => __( 'Menu', 'ultra-elements' ),
           'type' => Controls_Manager::SELECT,
           'options' => $menus,
           'default' => array_keys( $menus )[0],
           'save_default' => true,
           'separator' => 'after',
           'description' => sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'ultra-elements' ), admin_url( 'nav-menus.php' ) ),
         ]
       );
     } else {
       $this->add_control(
         'menu',
         [
           'type' => Controls_Manager::RAW_HTML,
           'raw' => sprintf( __( '<strong>There are no menus in your site.</strong><br>Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'ultra-elements' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
           'separator' => 'after',
           'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
         ]
       );
     }

     $this->add_control(
       'layout',
       [
         'label' => __( 'Layout', 'ultra-elements' ),
         'type' => Controls_Manager::SELECT,
         'default' => 'vertical',
         'options' => [
           'vertical' => __( 'Vertical', 'ultra-elements' )
         ],
         'frontend_available' => true,
       ]
     );

     $this->add_control(
       'align_items',
       [
         'label' => __( 'Align', 'ultra-elements' ),
         'type' => Controls_Manager::CHOOSE,
         'label_block' => false,
         'options' => [
           'left' => [
             'title' => __( 'Left', 'ultra-elements' ),
             'icon' => 'eicon-h-align-left',
           ],
           'center' => [
             'title' => __( 'Center', 'ultra-elements' ),
             'icon' => 'eicon-h-align-center',
           ],
           'right' => [
             'title' => __( 'Right', 'ultra-elements' ),
             'icon' => 'eicon-h-align-right',
           ]
         ],
         'prefix_class' => 'elementor-nav-menu__align-',
         'condition' => [
           'layout!' => 'dropdown',
         ],
       ]
     );

     $this->add_control(
       'pointer',
       [
         'label' => __( 'Pointer', 'ultra-elements' ),
         'type' => Controls_Manager::SELECT,
         'default' => 'underline',
         'options' => [
           'none' => __( 'None', 'ultra-elements' ),
           'underline' => __( 'Underline', 'ultra-elements' ),
           'overline' => __( 'Overline', 'ultra-elements' ),
           'double-line' => __( 'Double Line', 'ultra-elements' ),
           'framed' => __( 'Framed', 'ultra-elements' ),
           'background' => __( 'Background', 'ultra-elements' ),
           'text' => __( 'Text', 'ultra-elements' ),
         ],
         'condition' => [
           'layout!' => 'dropdown',
         ],
       ]
     );

     $this->add_control(
       'animation_line',
       [
         'label' => __( 'Animation', 'ultra-elements' ),
         'type' => Controls_Manager::SELECT,
         'default' => 'fade',
         'options' => [
           'fade' => 'Fade',
           'slide' => 'Slide',
           'grow' => 'Grow',
           'drop-in' => 'Drop In',
           'drop-out' => 'Drop Out',
           'none' => 'None',
         ],
         'condition' => [
           'layout!' => 'dropdown',
           'pointer' => [ 'underline', 'overline', 'double-line' ],
         ],
       ]
     );

     $this->add_control(
       'animation_framed',
       [
         'label' => __( 'Animation', 'ultra-elements' ),
         'type' => Controls_Manager::SELECT,
         'default' => 'fade',
         'options' => [
           'fade' => 'Fade',
           'grow' => 'Grow',
           'shrink' => 'Shrink',
           'draw' => 'Draw',
           'corners' => 'Corners',
           'none' => 'None',
         ],
         'condition' => [
           'layout!' => 'dropdown',
           'pointer' => 'framed',
         ],
       ]
     );

     $this->add_control(
       'animation_background',
       [
         'label' => __( 'Animation', 'ultra-elements' ),
         'type' => Controls_Manager::SELECT,
         'default' => 'fade',
         'options' => [
           'fade' => 'Fade',
           'grow' => 'Grow',
           'shrink' => 'Shrink',
           'sweep-left' => 'Sweep Left',
           'sweep-right' => 'Sweep Right',
           'sweep-up' => 'Sweep Up',
           'sweep-down' => 'Sweep Down',
           'shutter-in-vertical' => 'Shutter In Vertical',
           'shutter-out-vertical' => 'Shutter Out Vertical',
           'shutter-in-horizontal' => 'Shutter In Horizontal',
           'shutter-out-horizontal' => 'Shutter Out Horizontal',
           'none' => 'None',
         ],
         'condition' => [
           'layout!' => 'dropdown',
           'pointer' => 'background',
         ],
       ]
     );

     $this->add_control(
       'animation_text',
       [
         'label' => __( 'Animation', 'ultra-elements' ),
         'type' => Controls_Manager::SELECT,
         'default' => 'grow',
         'options' => [
           'grow' => 'Grow',
           'shrink' => 'Shrink',
           'sink' => 'Sink',
           'float' => 'Float',
           'skew' => 'Skew',
           'rotate' => 'Rotate',
           'none' => 'None',
         ],
         'condition' => [
           'layout!' => 'dropdown',
           'pointer' => 'text',
         ],
       ]
     );

     $this->add_control(
       'indicator',
       [
         'label' => __( 'Submenu Indicator', 'ultra-elements' ),
         'type' => Controls_Manager::SELECT,
         'default' => 'classic',
         'options' => [
           'none' => __( 'None', 'ultra-elements' ),
           'classic' => __( 'Classic', 'ultra-elements' ),
           'chevron' => __( 'Chevron', 'ultra-elements' ),
           'angle' => __( 'Angle', 'ultra-elements' ),
           'plus' => __( 'Plus', 'ultra-elements' ),
         ],
         'prefix_class' => 'elementor-nav-menu--indicator-',
       ]
     );

     $this->add_control(
       'heading_mobile_dropdown',
       [
         'label' => __( 'Mobile Dropdown', 'ultra-elements' ),
         'type' => Controls_Manager::HEADING,
         'separator' => 'before',
         'condition' => [
           'layout!' => 'dropdown',
         ],
       ]
     );

     $breakpoints = Responsive::get_breakpoints();

     $this->add_control(
       'dropdown',
       [
         'label' => __( 'Breakpoint', 'ultra-elements' ),
         'type' => Controls_Manager::SELECT,
         'default' => 'tablet',
         'options' => [
           /* translators: %d: Breakpoint number. */
           'mobile' => sprintf( __( 'Mobile (< %dpx)', 'ultra-elements' ), $breakpoints['md'] ),
           /* translators: %d: Breakpoint number. */
           'tablet' => sprintf( __( 'Tablet (< %dpx)', 'ultra-elements' ), $breakpoints['lg'] ),
         ],
         'prefix_class' => 'elementor-nav-menu--dropdown-',
         'condition' => [
           'layout!' => 'dropdown',
         ],
       ]
     );

     $this->add_control(
       'full_width',
       [
         'label' => __( 'Full Width', 'ultra-elements' ),
         'type' => Controls_Manager::SWITCHER,
         'description' => __( 'Stretch the dropdown of the menu to full width.', 'ultra-elements' ),
         'prefix_class' => 'elementor-nav-menu--',
         'return_value' => 'stretch',
         'frontend_available' => true,
       ]
     );

     $this->add_control(
       'text_align',
       [
         'label' => __( 'Align', 'ultra-elements' ),
         'type' => Controls_Manager::SELECT,
         'default' => 'aside',
         'options' => [
           'aside' => __( 'Aside', 'ultra-elements' ),
           'center' => __( 'Center', 'ultra-elements' ),
         ],
         'prefix_class' => 'elementor-nav-menu__text-align-',
       ]
     );

     $this->add_control(
       'toggle',
       [
         'label' => __( 'Toggle Button', 'ultra-elements' ),
         'type' => Controls_Manager::SELECT,
         'default' => 'burger',
         'options' => [
           '' => __( 'None', 'ultra-elements' ),
           'burger' => __( 'Hamburger', 'ultra-elements' ),
         ],
         'prefix_class' => 'elementor-nav-menu--toggle elementor-nav-menu--',
         'render_type' => 'template',
         'frontend_available' => true,
       ]
     );

     $this->add_control(
       'toggle_align',
       [
         'label' => __( 'Toggle Align', 'ultra-elements' ),
         'type' => Controls_Manager::CHOOSE,
         'default' => 'center',
         'options' => [
           'left' => [
             'title' => __( 'Left', 'ultra-elements' ),
             'icon' => 'eicon-h-align-left',
           ],
           'center' => [
             'title' => __( 'Center', 'ultra-elements' ),
             'icon' => 'eicon-h-align-center',
           ],
           'right' => [
             'title' => __( 'Right', 'ultra-elements' ),
             'icon' => 'eicon-h-align-right',
           ],
         ],
         'selectors_dictionary' => [
           'left' => 'margin-right: auto',
           'center' => 'margin: 0 auto',
           'right' => 'margin-left: auto',
         ],
         'selectors' => [
           '{{WRAPPER}} .elementor-menu-toggle' => '{{VALUE}}',
         ],
         'condition' => [
           'toggle!' => '',
         ],
         'label_block' => false,
       ]
     );

     $this->end_controls_section();

 		$this->start_controls_section(
 			'section_style_main-menu',
 			[
 				'label' => __( 'Main Menu', 'elementor-pro' ),
 				'tab' => Controls_Manager::TAB_STYLE,
 				'condition' => [
 					'layout!' => 'dropdown',
 				],

 			]
 		);

 		$this->add_group_control(
 			Group_Control_Typography::get_type(),
 			[
 				'name' => 'menu_typography',
 				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
 				'selector' => '{{WRAPPER}} .elementor-nav-menu--main',
 			]
 		);

 		$this->start_controls_tabs( 'tabs_menu_item_style' );

 		$this->start_controls_tab(
 			'tab_menu_item_normal',
 			[
 				'label' => __( 'Normal', 'elementor-pro' ),
 			]
 		);

 		$this->add_control(
 			'color_menu_item',
 			[
 				'label' => __( 'Text Color', 'elementor-pro' ),
 				'type' => Controls_Manager::COLOR,
 				'scheme' => [
 					'type' => Scheme_Color::get_type(),
 					'value' => Scheme_Color::COLOR_3,
 				],
 				'default' => '',
 				'selectors' => [
 					'{{WRAPPER}} .elementor-nav-menu--main .elementor-item' => 'color: {{VALUE}}',
 				],
 			]
 		);

 		$this->end_controls_tab();

 		$this->start_controls_tab(
 			'tab_menu_item_hover',
 			[
 				'label' => __( 'Hover', 'elementor-pro' ),
 			]
 		);

 		$this->add_control(
 			'color_menu_item_hover',
 			[
 				'label' => __( 'Text Color', 'elementor-pro' ),
 				'type' => Controls_Manager::COLOR,
 				'scheme' => [
 					'type' => Scheme_Color::get_type(),
 					'value' => Scheme_Color::COLOR_4,
 				],
 				'selectors' => [
 					'{{WRAPPER}} .elementor-nav-menu--main .elementor-item:hover,
 					{{WRAPPER}} .elementor-nav-menu--main .elementor-item.elementor-item-active,
 					{{WRAPPER}} .elementor-nav-menu--main .elementor-item.highlighted,
 					{{WRAPPER}} .elementor-nav-menu--main .elementor-item:focus' => 'color: {{VALUE}}',
 				],
 				'condition' => [
 					'pointer!' => 'background',
 				],
 			]
 		);

 		$this->add_control(
 			'color_menu_item_hover_pointer_bg',
 			[
 				'label' => __( 'Text Color', 'elementor-pro' ),
 				'type' => Controls_Manager::COLOR,
 				'default' => '#fff',
 				'selectors' => [
 					'{{WRAPPER}} .elementor-nav-menu--main .elementor-item:hover,
 					{{WRAPPER}} .elementor-nav-menu--main .elementor-item.elementor-item-active,
 					{{WRAPPER}} .elementor-nav-menu--main .elementor-item.highlighted,
 					{{WRAPPER}} .elementor-nav-menu--main .elementor-item:focus' => 'color: {{VALUE}}',
 				],
 				'condition' => [
 					'pointer' => 'background',
 				],
 			]
 		);

 		$this->add_control(
 			'pointer_color_menu_item_hover',
 			[
 				'label' => __( 'Pointer Color', 'elementor-pro' ),
 				'type' => Controls_Manager::COLOR,
 				'scheme' => [
 					'type' => Scheme_Color::get_type(),
 					'value' => Scheme_Color::COLOR_4,
 				],
 				'default' => '',
 				'selectors' => [
 					'{{WRAPPER}} .elementor-nav-menu--main:not(.e--pointer-framed) .elementor-item:before,
 					{{WRAPPER}} .elementor-nav-menu--main:not(.e--pointer-framed) .elementor-item:after' => 'background-color: {{VALUE}}',
 					'{{WRAPPER}} .e--pointer-framed .elementor-item:before,
 					{{WRAPPER}} .e--pointer-framed .elementor-item:after' => 'border-color: {{VALUE}}',
 				],
 				'condition' => [
 					'pointer!' => [ 'none', 'text' ],
 				],
 			]
 		);

 		$this->end_controls_tab();

 		$this->start_controls_tab(
 			'tab_menu_item_active',
 			[
 				'label' => __( 'Active', 'elementor-pro' ),
 			]
 		);

 		$this->add_control(
 			'color_menu_item_active',
 			[
 				'label' => __( 'Text Color', 'elementor-pro' ),
 				'type' => Controls_Manager::COLOR,
 				'default' => '',
 				'selectors' => [
 					'{{WRAPPER}} .elementor-nav-menu--main .elementor-item.elementor-item-active' => 'color: {{VALUE}}',
 				],
 			]
 		);

 		$this->add_control(
 			'pointer_color_menu_item_active',
 			[
 				'label' => __( 'Pointer Color', 'elementor-pro' ),
 				'type' => Controls_Manager::COLOR,
 				'default' => '',
 				'selectors' => [
 					'{{WRAPPER}} .elementor-nav-menu--main:not(.e--pointer-framed) .elementor-item.elementor-item-active:before,
 					{{WRAPPER}} .elementor-nav-menu--main:not(.e--pointer-framed) .elementor-item.elementor-item-active:after' => 'background-color: {{VALUE}}',
 					'{{WRAPPER}} .e--pointer-framed .elementor-item.elementor-item-active:before,
 					{{WRAPPER}} .e--pointer-framed .elementor-item.elementor-item-active:after' => 'border-color: {{VALUE}}',
 				],
 				'condition' => [
 					'pointer!' => [ 'none', 'text' ],
 				],
 			]
 		);

 		$this->end_controls_tab();

 		$this->end_controls_tabs();

 		/* This control is required to handle with complicated conditions */
 		$this->add_control(
 			'hr',
 			[
 				'type' => Controls_Manager::DIVIDER,
 				'style' => 'thick',
 			]
 		);

 		$this->add_control(
 			'pointer_width',
 			[
 				'label' => __( 'Pointer Width', 'elementor-pro' ),
 				'type' => Controls_Manager::SLIDER,
 				'devices' => [ self::RESPONSIVE_DESKTOP, self::RESPONSIVE_TABLET ],
 				'range' => [
 					'px' => [
 						'max' => 30,
 					],
 				],
 				'selectors' => [
 					'{{WRAPPER}} .e--pointer-framed .elementor-item:before' => 'border-width: {{SIZE}}{{UNIT}}',
 					'{{WRAPPER}} .e--pointer-framed.e--animation-draw .elementor-item:before' => 'border-width: 0 0 {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}}',
 					'{{WRAPPER}} .e--pointer-framed.e--animation-draw .elementor-item:after' => 'border-width: {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}} 0 0',
 					'{{WRAPPER}} .e--pointer-framed.e--animation-corners .elementor-item:before' => 'border-width: {{SIZE}}{{UNIT}} 0 0 {{SIZE}}{{UNIT}}',
 					'{{WRAPPER}} .e--pointer-framed.e--animation-corners .elementor-item:after' => 'border-width: 0 {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}} 0',
 					'{{WRAPPER}} .e--pointer-underline .elementor-item:after,
 					 {{WRAPPER}} .e--pointer-overline .elementor-item:before,
 					 {{WRAPPER}} .e--pointer-double-line .elementor-item:before,
 					 {{WRAPPER}} .e--pointer-double-line .elementor-item:after' => 'height: {{SIZE}}{{UNIT}}',
 				],
 				'condition' => [
 					'pointer' => [ 'underline', 'overline', 'double-line', 'framed' ],
 				],
 			]
 		);

 		$this->add_responsive_control(
 			'padding_horizontal_menu_item',
 			[
 				'label' => __( 'Horizontal Padding', 'elementor-pro' ),
 				'type' => Controls_Manager::SLIDER,
 				'range' => [
 					'px' => [
 						'max' => 50,
 					],
 				],
 				'devices' => [ 'desktop', 'tablet' ],
 				'selectors' => [
 					'{{WRAPPER}} .elementor-nav-menu--main .elementor-item' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}}',
 				],
 			]
 		);

 		$this->add_responsive_control(
 			'padding_vertical_menu_item',
 			[
 				'label' => __( 'Vertical Padding', 'elementor-pro' ),
 				'type' => Controls_Manager::SLIDER,
 				'range' => [
 					'px' => [
 						'max' => 50,
 					],
 				],
 				'devices' => [ 'desktop', 'tablet' ],
 				'selectors' => [
 					'{{WRAPPER}} .elementor-nav-menu--main .elementor-item' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}}',
 				],
 			]
 		);

 		$this->add_responsive_control(
 			'menu_space_between',
 			[
 				'label' => __( 'Space Between', 'elementor-pro' ),
 				'type' => Controls_Manager::SLIDER,
 				'range' => [
 					'px' => [
 						'max' => 100,
 					],
 				],
 				'devices' => [ 'desktop', 'tablet' ],
 				'selectors' => [
 					'body:not(.rtl) {{WRAPPER}} .elementor-nav-menu--layout-horizontal .elementor-nav-menu > li:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}}',
 					'body.rtl {{WRAPPER}} .elementor-nav-menu--layout-horizontal .elementor-nav-menu > li:not(:last-child)' => 'margin-left: {{SIZE}}{{UNIT}}',
 					'{{WRAPPER}} .elementor-nav-menu--main:not(.elementor-nav-menu--layout-horizontal) .elementor-nav-menu > li:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}}',
 				],
 			]
 		);

 		$this->add_responsive_control(
 			'border_radius_menu_item',
 			[
 				'label' => __( 'Border Radius', 'elementor-pro' ),
 				'type' => Controls_Manager::SLIDER,
 				'size_units' => [ 'px', 'em', '%' ],
 				'devices' => [ 'desktop', 'tablet' ],
 				'selectors' => [
 					'{{WRAPPER}} .elementor-item:before' => 'border-radius: {{SIZE}}{{UNIT}}',
 					'{{WRAPPER}} .e--animation-shutter-in-horizontal .elementor-item:before' => 'border-radius: {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}} 0 0',
 					'{{WRAPPER}} .e--animation-shutter-in-horizontal .elementor-item:after' => 'border-radius: 0 0 {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}}',
 					'{{WRAPPER}} .e--animation-shutter-in-vertical .elementor-item:before' => 'border-radius: 0 {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}} 0',
 					'{{WRAPPER}} .e--animation-shutter-in-vertical .elementor-item:after' => 'border-radius: {{SIZE}}{{UNIT}} 0 0 {{SIZE}}{{UNIT}}',
 				],
 				'condition' => [
 					'pointer' => 'background',
 				],
 			]
 		);

 		$this->end_controls_section();

 		$this->start_controls_section(
 			'section_style_dropdown',
 			[
 				'label' => __( 'Dropdown', 'elementor-pro' ),
 				'tab' => Controls_Manager::TAB_STYLE,
 			]
 		);

 		$this->add_control(
 			'dropdown_description',
 			[
 				'raw' => __( 'On desktop, this will affect the submenu. On mobile, this will affect the entire menu.', 'elementor-pro' ),
 				'type' => Controls_Manager::RAW_HTML,
 				'content_classes' => 'elementor-descriptor',
 			]
 		);

 		$this->start_controls_tabs( 'tabs_dropdown_item_style' );

 		$this->start_controls_tab(
 			'tab_dropdown_item_normal',
 			[
 				'label' => __( 'Normal', 'elementor-pro' ),
 			]
 		);

 		$this->add_control(
 			'color_dropdown_item',
 			[
 				'label' => __( 'Text Color', 'elementor-pro' ),
 				'type' => Controls_Manager::COLOR,
 				'default' => '',
 				'selectors' => [
 					'{{WRAPPER}} .elementor-nav-menu--dropdown a, {{WRAPPER}} .elementor-menu-toggle' => 'color: {{VALUE}}',
 				],
 			]
 		);

 		$this->add_control(
 			'background_color_dropdown_item',
 			[
 				'label' => __( 'Background Color', 'elementor-pro' ),
 				'type' => Controls_Manager::COLOR,
 				'default' => '',
 				'selectors' => [
 					'{{WRAPPER}} .elementor-nav-menu--dropdown' => 'background-color: {{VALUE}}',
 				],
 				'separator' => 'none',
 			]
 		);

 		$this->end_controls_tab();

 		$this->start_controls_tab(
 			'tab_dropdown_item_hover',
 			[
 				'label' => __( 'Hover', 'elementor-pro' ),
 			]
 		);

 		$this->add_control(
 			'color_dropdown_item_hover',
 			[
 				'label' => __( 'Text Color', 'elementor-pro' ),
 				'type' => Controls_Manager::COLOR,
 				'default' => '',
 				'selectors' => [
 					'{{WRAPPER}} .elementor-nav-menu--dropdown a:hover,
 					{{WRAPPER}} .elementor-nav-menu--dropdown a.elementor-item-active,
 					{{WRAPPER}} .elementor-nav-menu--dropdown a.highlighted,
 					{{WRAPPER}} .elementor-menu-toggle:hover' => 'color: {{VALUE}}',
 				],
 			]
 		);

 		$this->add_control(
 			'background_color_dropdown_item_hover',
 			[
 				'label' => __( 'Background Color', 'elementor-pro' ),
 				'type' => Controls_Manager::COLOR,
 				'default' => '',
 				'selectors' => [
 					'{{WRAPPER}} .elementor-nav-menu--dropdown a:hover,
 					{{WRAPPER}} .elementor-nav-menu--dropdown a.elementor-item-active,
 					{{WRAPPER}} .elementor-nav-menu--dropdown a.highlighted' => 'background-color: {{VALUE}}',
 				],
 				'separator' => 'none',
 			]
 		);

 		$this->end_controls_tab();

 		$this->start_controls_tab(
 			'tab_dropdown_item_active',
 			[
 				'label' => __( 'Active', 'elementor-pro' ),
 			]
 		);

 		$this->add_control(
 			'color_dropdown_item_active',
 			[
 				'label' => __( 'Text Color', 'elementor-pro' ),
 				'type' => Controls_Manager::COLOR,
 				'default' => '',
 				'selectors' => [
 					'{{WRAPPER}} .elementor-nav-menu--dropdown a.elementor-item-active' => 'color: {{VALUE}}',
 				],
 			]
 		);

 		$this->add_control(
 			'background_color_dropdown_item_active',
 			[
 				'label' => __( 'Background Color', 'elementor-pro' ),
 				'type' => Controls_Manager::COLOR,
 				'default' => '',
 				'selectors' => [
 					'{{WRAPPER}} .elementor-nav-menu--dropdown a.elementor-item-active' => 'background-color: {{VALUE}}',
 				],
 				'separator' => 'none',
 			]
 		);

 		$this->end_controls_tab();

 		$this->end_controls_tabs();

 		$this->add_group_control(
 			Group_Control_Typography::get_type(),
 			[
 				'name' => 'dropdown_typography',
 				'scheme' => Scheme_Typography::TYPOGRAPHY_4,
 				'exclude' => [ 'line_height' ],
 				'selector' => '{{WRAPPER}} .elementor-nav-menu--dropdown',
 				'separator' => 'before',
 			]
 		);

 		$this->add_group_control(
 			Group_Control_Border::get_type(),
 			[
 				'name' => 'dropdown_border',
 				'selector' => '{{WRAPPER}} .elementor-nav-menu--dropdown',
 				'separator' => 'before',
 			]
 		);

 		$this->add_responsive_control(
 			'dropdown_border_radius',
 			[
 				'label' => __( 'Border Radius', 'elementor-pro' ),
 				'type' => Controls_Manager::DIMENSIONS,
 				'size_units' => [ 'px', '%' ],
 				'selectors' => [
 					'{{WRAPPER}} .elementor-nav-menu--dropdown' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
 					'{{WRAPPER}} .elementor-nav-menu--dropdown li:first-child a' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}};',
 					'{{WRAPPER}} .elementor-nav-menu--dropdown li:last-child a' => 'border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};',
 				],
 			]
 		);

 		$this->add_group_control(
 			Group_Control_Box_Shadow::get_type(),
 			[
 				'name' => 'dropdown_box_shadow',
 				'exclude' => [
 					'box_shadow_position',
 				],
 				'selector' => '{{WRAPPER}} .elementor-nav-menu--main .elementor-nav-menu--dropdown, {{WRAPPER}} .elementor-nav-menu__container.elementor-nav-menu--dropdown',
 			]
 		);

 		$this->add_responsive_control(
 			'padding_horizontal_dropdown_item',
 			[
 				'label' => __( 'Horizontal Padding', 'elementor-pro' ),
 				'type' => Controls_Manager::SLIDER,
 				'selectors' => [
 					'{{WRAPPER}} .elementor-nav-menu--dropdown a' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}}',
 				],
 				'separator' => 'before',

 			]
 		);

 		$this->add_responsive_control(
 			'padding_vertical_dropdown_item',
 			[
 				'label' => __( 'Vertical Padding', 'elementor-pro' ),
 				'type' => Controls_Manager::SLIDER,
 				'range' => [
 					'px' => [
 						'max' => 50,
 					],
 				],
 				'selectors' => [
 					'{{WRAPPER}} .elementor-nav-menu--dropdown a' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}}',
 				],
 			]
 		);

 		$this->add_control(
 			'heading_dropdown_divider',
 			[
 				'label' => __( 'Divider', 'elementor-pro' ),
 				'type' => Controls_Manager::HEADING,
 				'separator' => 'before',
 			]
 		);

 		$this->add_group_control(
 			Group_Control_Border::get_type(),
 			[
 				'name' => 'dropdown_divider',
 				'selector' => '{{WRAPPER}} .elementor-nav-menu--dropdown li:not(:last-child)',
 				'exclude' => [ 'width' ],
 			]
 		);

 		$this->add_control(
 			'dropdown_divider_width',
 			[
 				'label' => __( 'Border Width', 'elementor-pro' ),
 				'type' => Controls_Manager::SLIDER,
 				'range' => [
 					'px' => [
 						'max' => 50,
 					],
 				],
 				'selectors' => [
 					'{{WRAPPER}} .elementor-nav-menu--dropdown li:not(:last-child)' => 'border-bottom-width: {{SIZE}}{{UNIT}}',
 				],
 				'condition' => [
 					'dropdown_divider_border!' => '',
 				],
 			]
 		);

 		$this->add_responsive_control(
 			'dropdown_top_distance',
 			[
 				'label' => __( 'Distance', 'elementor-pro' ),
 				'type' => Controls_Manager::SLIDER,
 				'range' => [
 					'px' => [
 						'min' => -100,
 						'max' => 100,
 					],
 				],
 				'selectors' => [
 					'{{WRAPPER}} .elementor-nav-menu--main > .elementor-nav-menu > li > .elementor-nav-menu--dropdown, {{WRAPPER}} .elementor-nav-menu__container.elementor-nav-menu--dropdown' => 'margin-top: {{SIZE}}{{UNIT}} !important',
 				],
 				'separator' => 'before',
 			]
 		);

 		$this->end_controls_section();

 		$this->start_controls_section( 'style_toggle',
 			[
 				'label' => __( 'Toggle Button', 'elementor-pro' ),
 				'tab' => Controls_Manager::TAB_STYLE,
 				'condition' => [
 					'toggle!' => '',
 				],
 			]
 		);

 		$this->start_controls_tabs( 'tabs_toggle_style' );

 		$this->start_controls_tab(
 			'tab_toggle_style_normal',
 			[
 				'label' => __( 'Normal', 'elementor-pro' ),
 			]
 		);

 		$this->add_control(
 			'toggle_color',
 			[
 				'label' => __( 'Color', 'elementor-pro' ),
 				'type' => Controls_Manager::COLOR,
 				'selectors' => [
 					'{{WRAPPER}} div.elementor-menu-toggle' => 'color: {{VALUE}}', // Harder selector to override text color control
 				],
 			]
 		);

 		$this->add_control(
 			'toggle_background_color',
 			[
 				'label' => __( 'Background Color', 'elementor-pro' ),
 				'type' => Controls_Manager::COLOR,
 				'selectors' => [
 					'{{WRAPPER}} .elementor-menu-toggle' => 'background-color: {{VALUE}}',
 				],
 			]
 		);

 		$this->end_controls_tab();

 		$this->start_controls_tab(
 			'tab_toggle_style_hover',
 			[
 				'label' => __( 'Hover', 'elementor-pro' ),
 			]
 		);

 		$this->add_control(
 			'toggle_color_hover',
 			[
 				'label' => __( 'Color', 'elementor-pro' ),
 				'type' => Controls_Manager::COLOR,
 				'selectors' => [
 					'{{WRAPPER}} div.elementor-menu-toggle:hover' => 'color: {{VALUE}}', // Harder selector to override text color control
 				],
 			]
 		);

 		$this->add_control(
 			'toggle_background_color_hover',
 			[
 				'label' => __( 'Background Color', 'elementor-pro' ),
 				'type' => Controls_Manager::COLOR,
 				'selectors' => [
 					'{{WRAPPER}} .elementor-menu-toggle:hover' => 'background-color: {{VALUE}}',
 				],
 			]
 		);

 		$this->end_controls_tab();

 		$this->end_controls_tabs();

 		$this->add_control(
 			'toggle_size',
 			[
 				'label' => __( 'Size', 'elementor-pro' ),
 				'type' => Controls_Manager::SLIDER,
 				'range' => [
 					'px' => [
 						'min' => 15,
 					],
 				],
 				'selectors' => [
 					'{{WRAPPER}} .elementor-menu-toggle' => 'font-size: {{SIZE}}{{UNIT}}',
 				],
 				'separator' => 'before',
 			]
 		);

 		$this->add_control(
 			'toggle_border_width',
 			[
 				'label' => __( 'Border Width', 'elementor-pro' ),
 				'type' => Controls_Manager::SLIDER,
 				'range' => [
 					'px' => [
 						'max' => 10,
 					],
 				],
 				'selectors' => [
 					'{{WRAPPER}} .elementor-menu-toggle' => 'border-width: {{SIZE}}{{UNIT}}',
 				],
 			]
 		);

 		$this->add_control(
 			'toggle_border_radius',
 			[
 				'label' => __( 'Border Radius', 'elementor-pro' ),
 				'type' => Controls_Manager::SLIDER,
 				'size_units' => [ 'px', '%' ],
 				'selectors' => [
 					'{{WRAPPER}} .elementor-menu-toggle' => 'border-radius: {{SIZE}}{{UNIT}}',
 				],
 			]
 		);

 		$this->end_controls_section();


   }

  /**
   * Render the widget output on the frontend.
   *
   * Written in PHP and used to generate the final HTML.
   *
   * @since 1.1.0
   *
   * @access protected
   */
   protected function render() {
     $available_menus = $this->get_available_menus();

     if ( ! $available_menus ) {
       return;
     }

     $settings = $this->get_active_settings();

     $args = [
       'echo' => false,
       'menu' => $settings['menu'],
       'menu_class' => 'sidebar-container',
       'menu_id' => 'sidebar_menu',
       'fallback_cb' => '__return_empty_string',
       'container' => 'div',
       'container_class' => 'bg-light',
       'container_id' => 'sidebar-wrapper',
       'items_wrap' => '',
     ];

     if ( 'vertical' === $settings['layout'] ) {
       $args['menu_class'] .= ' sm-vertical';
     }

     // Add custom filter to handle Nav Menu HTML output.
     add_filter( 'nav_menu_link_attributes', [ $this, 'handle_link_classes' ], 10, 4 );
     add_filter( 'nav_menu_submenu_css_class', [ $this, 'handle_sub_menu_classes' ] );
     add_filter( 'nav_menu_item_id', '__return_empty_string' );

     $menu_html = wp_nav_menu( $args );

     // Dropdown Menu.
     $args['menu_id'] = 'menu-' . $this->get_nav_menu_index() . '-' . $this->get_id();
     $dropdown_menu_html = wp_nav_menu( $args );

     // Remove all our custom filters.
     remove_filter( 'nav_menu_link_attributes', [ $this, 'handle_link_classes' ] );
     remove_filter( 'nav_menu_submenu_css_class', [ $this, 'handle_sub_menu_classes' ] );
     remove_filter( 'nav_menu_item_id', '__return_empty_string' );

     if ( empty( $menu_html ) ) {
       return;
     }

     $this->add_render_attribute( 'menu-toggle', 'class', [
       'elementor-menu-toggle',
     ] );

     if ( Plugin::elementor()->editor->is_edit_mode() ) {
       $this->add_render_attribute( 'menu-toggle', [
         'class' => 'elementor-clickable',
       ] );
     }

     if ( 'dropdown' !== $settings['layout'] ) :
       $this->add_render_attribute( 'main-menu', 'class', [
         'elementor-nav-menu--main',
         'elementor-nav-menu__container',
         'elementor-nav-menu--layout-' . $settings['layout'],
       ] );

       if ( $settings['pointer'] ) :
         $this->add_render_attribute( 'main-menu', 'class', 'e--pointer-' . $settings['pointer'] );

         foreach ( $settings as $key => $value ) :
           if ( 0 === strpos( $key, 'animation' ) && $value ) :
             $this->add_render_attribute( 'main-menu', 'class', 'e--animation-' . $value );

             break;
           endif;
         endforeach;
       endif; ?>
       <nav <?php echo $this->get_render_attribute_string( 'main-menu' ); ?>><?php echo $menu_html; ?></nav>
       <?php
     endif;
     ?>
     <div <?php echo $this->get_render_attribute_string( 'menu-toggle' ); ?>>
       <i class="eicon" aria-hidden="true"></i>
     </div>
     <nav class="elementor-nav-menu--dropdown elementor-nav-menu__container"><?php echo $dropdown_menu_html; ?></nav>
     <?php
   }
   public function handle_link_classes( $atts, $item, $args, $depth ) {
 		$classes = $depth ? 'elementor-sub-item' : 'elementor-item';
 		$is_anchor = false !== strpos( $atts['href'], '#' );

 		if ( ! $is_anchor && in_array( 'current-menu-item', $item->classes ) ) {
 			$classes .= ' active';
 		}

 		if ( $is_anchor ) {
 			$classes .= ' item-anchor';
 		}

 		if ( empty( $atts['class'] ) ) {
 			$atts['class'] = $classes;
 		} else {
 			$atts['class'] .= ' ' . $classes;
 		}

 		return $atts;
 	}

 	public function handle_sub_menu_classes( $classes ) {
 		$classes[] = ' collapse list-unstyled';

 		return $classes;
 	}

 	public function render_plain_content() {}
}
