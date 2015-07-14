<div class="wrap">
  <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

    <form action="options.php" method="POST">
      <?php settings_fields( 'waitlisted_account_section' ); ?>
      <?php do_settings_sections( "waitlisted" ); ?>
      <?php submit_button( __('Save', "waitlisted" ) ); ?>
    </form>
</div>
