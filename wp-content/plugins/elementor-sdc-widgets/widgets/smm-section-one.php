<?php
namespace ElementorSdcWidgets\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Smm Section One
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Smm_Section_One extends Widget_Base {

    /**
     * Retrieve the widget name.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'smm-section-one';
    }

    /**
     * Retrieve the widget title.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'SMM Секция один', 'elementor-smm-section-one' );
    }

    /**
     * Retrieve the widget icon.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'fa-puzzle-piece';
    }

    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * Note that currently Elementor supports only one category.
     * When multiple categories passed, Elementor uses the first one.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return [ 'general' ];
    }

    /**
     * Retrieve the list of scripts the widget depended on.
     *
     * Used to set scripts dependencies required to run the widget.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget scripts dependencies.
     */
    public function get_script_depends() {
        return [ 'elementor-sdc-widgets' ];
    }

    /**
     * Register the widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function _register_controls() {
        $this->start_controls_section(
            'section_content',
            [
                'label' => __( 'Content', 'elementor-smm-section-one' ),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __( 'Title', 'elementor-smm-section-one' ),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style',
            [
                'label' => __( 'Style', 'elementor-smm-section-one' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'text_transform',
            [
                'label' => __( 'Text Transform', 'elementor-smm-section-one' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => __( 'None', 'elementor-smm-section-one' ),
                    'uppercase' => __( 'UPPERCASE', 'elementor-smm-section-one' ),
                    'lowercase' => __( 'lowercase', 'elementor-smm-section-one' ),
                    'capitalize' => __( 'Capitalize', 'elementor-smm-section-one' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
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
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        ?>
        <section class="section section1 red">
            <div class="container">
                <h2><?=$settings['title']?></h2>
                <div class="lng__block">
                    <form class="col">
                        <h5><?=pll__('Закажите индивидуальный просчет вашего проекта')?></h5>
                        <input type="text" placeholder="<?=pll__('Имя')?>" required="required">
                        <input type="email" placeholder="<?=pll__('Электронная почта')?>" required="required">
                        <input type="text" name="tel" placeholder="<?=pll__('Контактный номер телефона')?>" required="required">
                        <input type="submit" class="btn" value="<?=pll__('Отправить')?>" data-toggle="modal" data-target="#modal--form">
                    </form>
                    <div class="col">
                        <div class="phones__slider wow fadeInUp" data-wow-offset="0">
                            <div><img src="/img/img-61.jpg" alt=""></div>
                            <div><img src="/img/img-61.jpg" alt=""></div>
                            <div><img src="/img/img-61.jpg" alt=""></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg" data-offset="55"><img src="/img/bg-1.png" alt=""></div>
            <div class="bg" data-offset="10"><img src="/img/bg-2.png" alt=""></div>
            <div class="bg" data-offset="25"><img src="/img/bg-3.png" alt=""></div>
        </section>
        <?
    }

    /**
     * Render the widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function _content_template() {
        ?>

        <?php
    }
}
