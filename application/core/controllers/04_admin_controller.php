<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

class Admin_controller extends Oa_controller {

  public function __construct () {
    parent::__construct ();

    if (!(User::current () && in_array (User::current ()->role, Cfg::setting ('role', 'admins')))) {
      Session::setData ('_flash_message', '', true);
      return redirect_message (array ('login'), array (
          '_flash_message' => '請先登入，或者您沒有後台權限！'
        ));
    }

    $this->set_componemt_path ('component', 'admin')
         ->set_frame_path ('frame', 'admin')
         ->set_content_path ('content', 'admin')
         ->set_public_path ('public')

         ->set_title ("OA's CI")

         ->_add_meta ()
         ->_add_css ()
         ->_add_js ()
         ;
  }

  private function _add_meta () {
    return $this;
  }

  private function _add_css () {
    return $this->append_css (base_url ('application', 'cell', 'views', 'frame_cell', 'navbar', 'content.css'))
                ->add_css (base_url ('application', 'cell', 'views', 'frame_cell', 'wrapper_left', 'content.css'))
                ->append_css (base_url ('application', 'cell', 'views', 'frame_cell', 'tabs', 'content.css'))
                ->append_css (base_url ('application', 'cell', 'views', 'frame_cell', 'footer', 'content.css'))
                ;
  }

  private function _add_js () {
    return $this->add_js (base_url ('resource', 'javascript', 'jquery_v1.10.2', 'jquery-1.10.2.min.js'))
                ->add_js (base_url ('resource', 'javascript', 'jquery-rails_d2015_03_09', 'jquery_ujs.js'))
                ->add_js (base_url ('resource', 'javascript', 'imgLiquid_v0.9.944', 'imgLiquid-min.js'))
                ->add_js (base_url ('resource', 'javascript', 'jquery-timeago_v1.3.1', 'jquery.timeago.js'))
                ->add_js (base_url ('resource', 'javascript', 'jquery-timeago_v1.3.1', 'locales', 'jquery.timeago.zh-TW.js'))
                ->append_js (base_url ('application', 'cell', 'views', 'frame_cell', 'navbar', 'content.js'))
                ->add_js (base_url ('application', 'cell', 'views', 'frame_cell', 'wrapper_left', 'content.js'))
                ->append_js (base_url ('application', 'cell', 'views', 'frame_cell', 'tabs', 'content.js'))
                ;
  }
}