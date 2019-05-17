<?php
namespace UltraElements\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class UltraHoverBox extends Widget_Base {

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
    return 'hover-box';
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
    return __( 'Hover Box', 'ultra-elements' );
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
    return 'fa fa-pencil';
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
 			'title_editor',
 			[
 				'label' => __( 'Header Editor', 'ultra-elements' ),
 			]
 		);

    $this->add_control(
			'title_element',
			[
				'label' => __( 'Title', 'ultra-elements' ),
				'type' => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your title', 'ultra-elements' ),
				'default' => __( 'Add Your Heading Text Here', 'ultra-elements' ),
			]
		);

		$this->add_control(
			'title_link',
			[
				'label' => __( 'Link', 'ultra-elements' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => '',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'title_size',
			[
				'label' => __( 'Size', 'ultra-elements' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => __( 'Default', 'ultra-elements' ),
					'small' => __( 'Small', 'ultra-elements' ),
					'medium' => __( 'Medium', 'ultra-elements' ),
					'large' => __( 'Large', 'ultra-elements' ),
					'xl' => __( 'XL', 'ultra-elements' ),
					'xxl' => __( 'XXL', 'ultra-elements' ),
				],
			]
		);

		$this->add_control(
			'title_header_size',
			[
				'label' => __( 'HTML Tag', 'ultra-elements' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				],
				'default' => 'h2',
			]
		);

		$this->add_responsive_control(
			'header_align',
			[
				'label' => __( 'Alignment', 'ultra-elements' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'ultra-elements' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'ultra-elements' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'ultra-elements' ),
						'icon' => 'fa fa-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'ultra-elements' ),
						'icon' => 'fa fa-align-justify',
					],
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_view',
			[
				'label' => __( 'View', 'ultra-elements' ),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'traditional',
			]
		);

    $this->end_controls_section();

    $this->start_controls_section(
      'description_editor',
      [
        'label' => __( 'Description Editor', 'ultra-elements' ),
      ]
    );

 		$this->add_control(
 			'description_editor_element',
 			[
 				'label' => 'Description',
 				'type' => Controls_Manager::WYSIWYG,
 				'dynamic' => [
 					'active' => true,
 				],
 				'default' => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'ultra-elements' ),
 			]
 		);

    $this->add_control(
			'description_size',
			[
				'label' => __( 'Size', 'ultra-elements' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => __( 'Default', 'ultra-elements' ),
					'small' => __( 'Small', 'ultra-elements' ),
					'medium' => __( 'Medium', 'ultra-elements' ),
					'large' => __( 'Large', 'ultra-elements' ),
					'xl' => __( 'XL', 'ultra-elements' ),
					'xxl' => __( 'XXL', 'ultra-elements' ),
				],
			]
		);

		$this->add_control(
			'description_header_size',
			[
				'label' => __( 'HTML Tag', 'ultra-elements' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				],
				'default' => 'h2',
			]
		);

    $this->end_controls_section();

    $this->start_controls_section(
      'sub_description_editor',
      [
        'label' => __( 'Sub Description Editor', 'ultra-elements' ),
      ]
    );

    $this->add_control(
 			'sub_description_editor_element',
 			[
 				'label' => 'Sub Description',
 				'type' => Controls_Manager::WYSIWYG,
 				'dynamic' => [
 					'active' => true,
 				],
 				'default' => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'ultra-elements' ),
 			]
 		);

    $this->add_control(
			'sub_description_size',
			[
				'label' => __( 'Size', 'ultra-elements' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => __( 'Default', 'ultra-elements' ),
					'small' => __( 'Small', 'ultra-elements' ),
					'medium' => __( 'Medium', 'ultra-elements' ),
					'large' => __( 'Large', 'ultra-elements' ),
					'xl' => __( 'XL', 'ultra-elements' ),
					'xxl' => __( 'XXL', 'ultra-elements' ),
				],
			]
		);

		$this->add_control(
			'sub_description_header_size',
			[
				'label' => __( 'HTML Tag', 'ultra-elements' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				],
				'default' => 'h2',
			]
		);

 		$this->end_controls_section();


 		$this->start_controls_section(
 			'title_section_style',
 			[
 				'label' => __( 'Header Editor', 'ultra-elements' ),
 				'tab' => Controls_Manager::TAB_STYLE,
 			]
 		);

    $this->add_control(
			'title_color',
			[
				'label' => __( 'Text Color', 'ultra-elements' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					// Stronger selector to avoid section style from overwriting
					'{{WRAPPER}}.elementor-widget-heading .elementor-heading-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .elementor-heading-title',
			]
		);

 		$this->add_responsive_control(
 			'header_text_align',
 			[
 				'label' => __( 'Alignment', 'ultra-elements' ),
 				'type' => Controls_Manager::CHOOSE,
 				'options' => [
 					'left' => [
 						'title' => __( 'Left', 'ultra-elements' ),
 						'icon' => 'fa fa-align-left',
 					],
 					'center' => [
 						'title' => __( 'Center', 'ultra-elements' ),
 						'icon' => 'fa fa-align-center',
 					],
 					'right' => [
 						'title' => __( 'Right', 'ultra-elements' ),
 						'icon' => 'fa fa-align-right',
 					],
 					'justify' => [
 						'title' => __( 'Justified', 'ultra-elements' ),
 						'icon' => 'fa fa-align-justify',
 					],
 				],
 				'selectors' => [
 					'{{WRAPPER}} .elementor-text-editor' => 'text-align: {{VALUE}};',
 				],
 			]
 		);

 		$this->end_controls_section();


 		$this->start_controls_section(
 			'description_section_style',
 			[
 				'label' => __( 'Description Editor', 'ultra-elements' ),
 				'tab' => Controls_Manager::TAB_STYLE,
 			]
 		);

    $this->add_control(
			'description_color',
			[
				'label' => __( 'Text Color', 'ultra-elements' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					// Stronger selector to avoid section style from overwriting
					'{{WRAPPER}}.elementor-widget-heading .elementor-heading-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .elementor-heading-title',
			]
		);

 		$this->add_responsive_control(
 			'description_align',
 			[
 				'label' => __( 'Alignment', 'ultra-elements' ),
 				'type' => Controls_Manager::CHOOSE,
 				'options' => [
 					'left' => [
 						'title' => __( 'Left', 'ultra-elements' ),
 						'icon' => 'fa fa-align-left',
 					],
 					'center' => [
 						'title' => __( 'Center', 'ultra-elements' ),
 						'icon' => 'fa fa-align-center',
 					],
 					'right' => [
 						'title' => __( 'Right', 'ultra-elements' ),
 						'icon' => 'fa fa-align-right',
 					],
 					'justify' => [
 						'title' => __( 'Justified', 'ultra-elements' ),
 						'icon' => 'fa fa-align-justify',
 					],
 				],
 				'selectors' => [
 					'{{WRAPPER}} .elementor-text-editor' => 'text-align: {{VALUE}};',
 				],
 			]
 		);

 		$this->end_controls_section();


 		$this->start_controls_section(
 			'sub_description_section_style',
 			[
 				'label' => __( 'Sub Description Editor', 'ultra-elements' ),
 				'tab' => Controls_Manager::TAB_STYLE,
 			]
 		);

    $this->add_control(
			'sub_description_color',
			[
				'label' => __( 'Text Color', 'ultra-elements' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					// Stronger selector to avoid section style from overwriting
					'{{WRAPPER}}.elementor-widget-heading .elementor-heading-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'sub_description_typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .elementor-heading-title',
			]
		);

 		$this->add_responsive_control(
 			'sub_description_align',
 			[
 				'label' => __( 'Alignment', 'ultra-elements' ),
 				'type' => Controls_Manager::CHOOSE,
 				'options' => [
 					'left' => [
 						'title' => __( 'Left', 'ultra-elements' ),
 						'icon' => 'fa fa-align-left',
 					],
 					'center' => [
 						'title' => __( 'Center', 'ultra-elements' ),
 						'icon' => 'fa fa-align-center',
 					],
 					'right' => [
 						'title' => __( 'Right', 'ultra-elements' ),
 						'icon' => 'fa fa-align-right',
 					],
 					'justify' => [
 						'title' => __( 'Justified', 'ultra-elements' ),
 						'icon' => 'fa fa-align-justify',
 					],
 				],
 				'selectors' => [
 					'{{WRAPPER}} .elementor-text-editor' => 'text-align: {{VALUE}};',
 				],
 			]
 		);
 	}

 	/**
 	 * Render text editor widget output on the frontend.
 	 *
 	 * Written in PHP and used to generate the final HTML.
 	 *
 	 * @since 1.0.0
 	 * @access protected
 	 */
 	protected function render() {
    $settings = $this->get_settings_for_display();

		if ( empty( $settings['title_element'] ) ) {
			return;
		}

		$this->add_render_attribute( 'title_element', 'class', 'elementor-heading-title' );

		if ( ! empty( $settings['title_size'] ) ) {
			$this->add_render_attribute( 'title_element', 'class', 'elementor-size-' . $settings['title_size'] );
		}

		$this->add_inline_editing_attributes( 'title_element' );

		$title = $settings['title_element'];

		if ( ! empty( $settings['title_link']['url'] ) ) {
			$this->add_render_attribute( 'url', 'href', $settings['link']['url'] );

			if ( $settings['link']['is_external'] ) {
				$this->add_render_attribute( 'url', 'target', '_blank' );
			}

			if ( ! empty( $settings['title_link']['nofollow'] ) ) {
				$this->add_render_attribute( 'url', 'rel', 'nofollow' );
			}

			$title = sprintf( '<a %1$s>%2$s</a>', $this->get_render_attribute_string( 'url' ), $title );
		}

		$title_html = sprintf( '<%1$s %2$s>%3$s</%1$s>', $settings['title_header_size'], $this->get_render_attribute_string( 'title_element' ), $title );

		echo $title_html;


    $settings = $this->get_settings_for_display();

    if ( empty( $settings['description_editor_element'] ) ) {
      return;
    }

    $this->add_render_attribute( 'description_editor_element', 'class', 'elementor-description' );

    if ( ! empty( $settings['description_size'] ) ) {
      $this->add_render_attribute( 'description_editor_element', 'class', 'elementor-size-' . $settings['description_size'] );
    }

    $this->add_inline_editing_attributes( 'description_editor_element' );

    $description = $settings['description_editor_element'];


    $description_html = sprintf( '<%1$s %2$s>%3$s</%1$s>', $settings['description_header_size'], $this->get_render_attribute_string( 'description_editor_element' ), $title );

    echo $description_html;


    $settings = $this->get_settings_for_display();

    if ( empty( $settings['sub_description_editor_element'] ) ) {
      return;
    }

    $this->add_render_attribute( 'sub_description_editor_element', 'class', 'elementor-sub-description' );

    if ( ! empty( $settings['sub_description_size'] ) ) {
      $this->add_render_attribute( 'sub_description_editor_element', 'class', 'elementor-size-' . $settings['sub_description_size'] );
    }

    $this->add_inline_editing_attributes( 'sub_description_editor_element' );

    $description = $settings['sub_description_editor_element'];


    $description_html = sprintf( '<%1$s %2$s>%3$s</%1$s>', $settings['sub_description_header_size'], $this->get_render_attribute_string( 'sub_description_editor_element' ), $title );

    echo $description_html;

 	}

 	/**
 	 * Render text editor widget as plain content.
 	 *
 	 * Override the default behavior by printing the content without rendering it.
 	 *
 	 * @since 1.0.0
 	 * @access public
 	 */
 	public function render_plain_content() {
 		// In plain mode, render without shortcode
 		echo $this->get_settings( 'editor' );
 	}

 	/**
 	 * Render text editor widget output in the editor.
 	 *
 	 * Written as a Backbone JavaScript template and used to generate the live preview.
 	 *
 	 * @since 1.0.0
 	 * @access protected
 	 */
 	protected function _content_template() {
 		?>
    <#
		var title = settings.title_element;

		if ( '' !== settings.title_link.url ) {
			title = '<a href="' + settings.title_link.url + '">' + title + '</a>';
		}

		view.addRenderAttribute( 'title_element', 'class', [ 'elementor-heading-title', 'elementor-size-' + settings.size ] );

		view.addInlineEditingAttributes( 'title_element' );

		var title_html = '<' + settings.header_size  + ' ' + view.getRenderAttributeString( 'title_element' ) + '>' + title + '</' + settings.title_header_size + '>';

		print( title_html );
		#>

 		<div {{{ view.getRenderAttributeString( 'title_element' ) }}}>{{{ settings.title_element }}}</div>

    <#
		var description = settings.description_editor_element;

		view.addRenderAttribute( 'description_editor_element', 'class', [ 'elementor-description', 'elementor-clearfix', 'elementor-size-' + settings.size ] );

		view.addInlineEditingAttributes( 'description_editor_element' );

		var discription_html = '<' + settings.description_size  + ' ' + view.getRenderAttributeString( 'description_editor_element' ) + '>' + description + '</' + settings.description_size + '>';

		print( description_html );
		#>

 		<div {{{ view.getRenderAttributeString( 'description_editor_element' ) }}}>{{{ settings.description_editor_element }}}</div>

    <#
		var sub_description = settings.sub_description_editor_element;

		view.addRenderAttribute( 'sub_description_editor_element', 'class', [ 'elementor-sub-description', 'elementor-clearfix', 'elementor-size-' + settings.size ] );

		view.addInlineEditingAttributes( 'sub_description_editor_element' );

		var sub_discription_html = '<' + settings.sub_description_size  + ' ' + view.getRenderAttributeString( 'sub_description_editor_element' ) + '>' + sub_description + '</' + settings.sub_description_editor_element + '>';

		print( sub_description_html );
		#>

 		<div {{{ view.getRenderAttributeString( 'sub_description_editor_element' ) }}}>{{{ settings.sub_description_editor_element }}}</div>
    <?php
 	}
 }
 ?>
