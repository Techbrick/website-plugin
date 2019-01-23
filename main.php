<?php
/*
Plugin Name: Test Plugin
Description: This is a test plugin for testing purposes
Author: Ian Morrill
*/

// Gets called when plugin updated
function plugin_init() {

  // This implements the pagelister shortcode
  function exec_pagelist_shortcode($attrs, $content = "") {
    $pages = get_pages(array(
      "parent" => $attrs["id"]
    ));

    // This gets called for each post and returns the HTML to display it.
    function postMapper($p) {
      $p_url = get_the_post_thumbnail_url($p);

      $precedingImg = $p_url != false ? "" : "<img src=\"" . $p_url . "\">";

      return $precedingImg . "<div style=\"padding:7pt;margin-bottom:15pt;background:#eee;\">
      <h1><a href=\"" . get_permalink($p->ID) . "\">" . $p->post_title . "</a></h1>
      <p>" . $p->post_content . "</p></div>";
    }
    return implode("", array_map("postMapper", $pages));
  }

  add_shortcode("pagelist", "exec_pagelist_shortcode");
}
add_action("init", "plugin_init");