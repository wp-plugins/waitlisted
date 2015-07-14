<?php

class Waitlisted_Shortcodes {
  public static function waitlist_cta ($attrs, $content) {
    if (is_array($attrs) && array_key_exists("title", $attrs)) {
      $title = $attrs["title"];
    }
    else {
      $title = "";
    }
    $inner = "<button>Join the Waitlist</button>";

    if (!empty($content)) {
      $inner = $content;
    }
    elseif (!empty($title)) {
      $inner = "<button>$title</button>";
    }
    return "<a class=\"waitlisted-cta\" href=\"#\">$inner</a>";
  }

}

add_shortcode('waitlisted', array( 'Waitlisted_Shortcodes', 'waitlist_cta' ) );