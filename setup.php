<?php
		if (!defined('DP_BASE_DIR')) {
				die('You should not access this file directly.');
		}
		/*
		*  Name: ???
		*  Directory: ???
		*  Version 0.1
		*  Type: user
		*  UI Name: ???
		*  UI Icon: ???
		*/
		$config['mod_name'] = "";
		$config['mod_version'] = "0.1";
		$config['mod_directory'] = "";
		$config['mod_setup_class'] = "CSetup";
		$config['mod_type'] = "user";
		$config['mod_ui_name'] = "";
		$config['mod_ui_icon'] = "";
		$config['mod_description'] = "";
		$config['mod_config'] = true;

		// TODO: To be completed later as needed.
		class CSetup{

				function configure() { return true; }

				function remove() { 
						$q = new DBQuery();
						$q->dropTable('???');
						$q->exec();
				}
  
				function upgrade($old_version) {
						return true;
				}

				function install() {
						$q = new DBQuery();
						$q->createTable('???');
						$q->createDefinition("???");
						$q->exec($sql);
						return NULL;
				}
		}
?>