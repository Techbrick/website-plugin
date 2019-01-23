<?php
/*
Plugin Name: Test Plugin
Description: This is a test plugin for testing purposes
Author: Ian Morrill
*/

function plugin_init() {
  function exec_pagelist_shortcode($attrs, $content = "") {
    $pages = get_pages(array(
      "parent" => $attrs["id"]
    ));

    function postMapper($p) {
      return "<div style=\"padding:7pt;margin-bottom:15pt;background:#eee;\">
      <h1><a href=\"" . get_permalink($p->ID) . "\">" . $p->post_title . "</a></h1>
      <p>" . $p->post_content . "</p></div>";
    }
    return implode("", array_map("postMapper", $pages));
  }

  add_shortcode("pagelist", "exec_pagelist_shortcode");
}
add_action("init", "plugin_init");