<?php

/**
 * @package     Waitlisted
 * @subpackage  Waitlisted_Admin
 * @author      Justin McNally <justin@waitlisted.co>
 * @license     GPL-2.0+
 * @link        http://waitlisted.co
 * @copyright   2015 Justin McNally
 * @author      Justin McNally <justin@waitlisted.co>
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
  die;
}

class Waitlisted_Option {
    /**
     * Instance of this class.
     *
     * @since    1.0.0
     *
     * @var      object
     */
    protected static $instance = null;

    /**
     * Initialize the plugin by registrating settings
     *
     * @since     1.0.0
     */
    private function __construct() {


        $this->plugin_name = "waitlisted";

        // Register Settings
        $this->register_settings();
    }

    /**
     * Return an instance of this class.
     *
     * @since     1.0.0
     *
     * @return    object    A single instance of this class.
     */
    public static function get_instance() {

        // If the single instance hasn't been set, set it now.
        if ( null == self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Register the CloudFlare account section, CloudFlare email field
     * and CloudFlare api key field
     *
     * @since     1.0.0
     */
    private function register_settings() {
        /**
         * First, we register a section. This is necessary since all future settings must belong to one.
         */

        add_settings_section(
            // ID used to identify this section and with which to register options
            'waitlisted_account_section',
            // Title to be displayed on the administration page
            'Waitlisted Account',
            // Callback used to render the description of the section
            array( $this, 'waitlisted_account' ),
            // Page on which to add this section of options
            $this->plugin_name
            );

        /**
         * Next, we will introduce the fields for CloudFlare Account info.
         */
        add_settings_field(
            // ID used to identify the field throughout the theme
            'waitlisted_domain',
            // The label to the left of the option interface element
            'Waitlisted Domain',
            // The name of the function responsible for rendering the option interface
            array( $this, 'waitlisted_render_domain_input_html' ),
            // The page on which this option will be displayed
            $this->plugin_name,
            // The name of the section to which this field belongs
            'waitlisted_account_section'
            );

        
        // Finally, we register the fields with WordPress
        register_setting(
            // The settings group name. Must exist prior to the register_setting call.
            'waitlisted_account_section',
            // The name of an option to sanitize and save.
            'waitlisted_domain',
            // The callback function for sanitization and validation
            array( $this, 'waitlisted_validate_domain' )
            );


        
    } // end of register_settings


    /**
     * This function provides a simple description for the Waitlisted Options page.
     * This function is being passed as a parameter in the add_settings_section function.
     *
     * @since 1.0.0
     */
    public function waitlisted_account() {
        echo '<p><a href="https://www.waitlisted.co/" target="_blank">Waitlisted</a> handles future user sign ups so that you don\'t have to.</p><p>Sign up for an account at <a href="https://www.waitlisted.co/users/sign_up" target="_blank">waitlisted.co</a>';
    } // end

    public function waitlisted_render_domain_input_html() {
        // First, we read the option from db
        $waitlisted_domain = get_option( 'waitlisted_domain', '' );

        // Next, we need to make sure the element is defined in the options. If not, we'll set an empty string.
        // Render the output
        echo '<input type="text" id="waitlisted_input_domain" name="waitlisted_domain" size="40" value="' . $waitlisted_domain . '" />';

    }

    


    
    /**
     * Sanitization callback for the domain option.
     * Use is_email for Sanitization
     *
     * @param  $input  The domain user inputed
     *
     * @return         The sanitized domain.
     *
     * @since 1.0.0
     */
    public function waitlisted_validate_domain ( $input ) {
      // Get old value from DB
      $waitlisted_domain = get_option( 'waitlisted_domain' );

      // Don't trust users

      if ( !empty( $input ) ) {
          $output = $input;
      }
      else {
        $output = $waitlisted_domain;
        add_settings_error( 'waitlisted_account_section', 'invalid-domain', __( 'You have entered an invalid domain.', $this->plugin_name ) );
      }

      return $output;

    }


} //end of Waitlisted_Option Class
