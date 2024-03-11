<?php

class VwpPluginActivate
{
  public static function activate() {
    chatbot_create_database_table();
    chatbot_create_conversations_table();
    chatbot_create_send_Lead_Alert_table();
    flush_rewrite_rules();
  }
}

