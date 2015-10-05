/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50539
Source Host           : localhost:3306
Source Database       : hanan_db

Target Server Type    : MYSQL
Target Server Version : 50539
File Encoding         : 65001

Date: 2015-04-01 19:16:36
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `activity_log`
-- ----------------------------
DROP TABLE IF EXISTS `activity_log`;
CREATE TABLE `activity_log` (
  `id_log` int(11) NOT NULL AUTO_INCREMENT,
  `activity` text,
  `object` varchar(40) DEFAULT NULL,
  `object_id` int(11) DEFAULT NULL,
  `user` int(11) NOT NULL,
  `description` text,
  `action` int(11) DEFAULT NULL,
  `field_data` text,
  `date_create` datetime NOT NULL,
  PRIMARY KEY (`id_log`),
  KEY `fk_activity_log_application_action1_idx` (`action`),
  CONSTRAINT `fk_activity_log_application_action1` FOREIGN KEY (`action`) REFERENCES `application_action` (`id_application_action`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=307 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of activity_log
-- ----------------------------
INSERT INTO `activity_log` VALUES ('1', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"View Employee\",\"controller\":\"employee\",\"function_exec\":\"\",\"function_args\":\"\",\"view_type\":\"gridview\",\"view_file\":\"employee_list\",\"prefix\":\"\",\"action_type\":\"view\",\"action_button\":\"crud\",\"target_action\":\"\",\"use_log\":\"0\",\"is_edit\":\"true\",\"id_edit\":\"94\"}', '2014-12-28 23:25:14');
INSERT INTO `activity_log` VALUES ('2', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"Create Employee\",\"controller\":\"employee\",\"function_exec\":\"init_create_employee\",\"function_args\":\"\",\"view_type\":\"form\",\"view_file\":\"employee_ce\",\"prefix\":\"\",\"action_type\":\"view\",\"action_button\":\"save_discard\",\"target_action\":\"\",\"use_log\":\"0\",\"is_edit\":\"true\",\"id_edit\":\"95\"}', '2014-12-28 23:26:04');
INSERT INTO `activity_log` VALUES ('3', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"Edit Employee\",\"controller\":\"employee\",\"function_exec\":\"init_edit_employee\",\"function_args\":\"id\",\"view_type\":\"form\",\"view_file\":\"employee_ce\",\"prefix\":\"\",\"action_type\":\"update\",\"action_button\":\"save_discard\",\"target_action\":\"\",\"use_log\":\"0\",\"is_edit\":\"true\",\"id_edit\":\"96\"}', '2014-12-28 23:26:34');
INSERT INTO `activity_log` VALUES ('4', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"Delete Employee\",\"controller\":\"employee\",\"function_exec\":\"delete_employee\",\"function_args\":\"\",\"view_type\":\"no_view\",\"view_file\":\"\",\"prefix\":\"\",\"action_type\":\"delete\",\"action_button\":\"crud\",\"target_action\":\"94\",\"use_log\":\"1\",\"is_edit\":\"true\",\"id_edit\":\"97\"}', '2014-12-28 23:27:09');
INSERT INTO `activity_log` VALUES ('5', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"Save\\/Edit Employee\",\"controller\":\"employee\",\"function_exec\":\"save_employee\",\"function_args\":\"\",\"view_type\":\"no_view\",\"view_file\":\"\",\"prefix\":\"\",\"action_type\":\"create\",\"action_button\":\"crud\",\"target_action\":\"94\",\"use_log\":\"1\",\"is_edit\":\"true\",\"id_edit\":\"98\"}', '2014-12-28 23:27:38');
INSERT INTO `activity_log` VALUES ('6', 'Save/Edit Role', 'role', null, '2', 'Save/Edit Role', '20', '{\"name\":\"Appilcation Administrator\",\"action_detail\":[{\"id_application_action\":\"11\",\"action\":\"11\",\"name\":\"View Division\",\"uid\":\"0\"},{\"id_application_action\":\"12\",\"action\":\"12\",\"name\":\"Create Division\",\"uid\":\"1\"},{\"id_application_action\":\"13\",\"action\":\"13\",\"name\":\"Save\\/Edit Division\",\"uid\":\"2\"},{\"id_application_action\":\"14\",\"action\":\"14\",\"name\":\"Edit Division\",\"uid\":\"3\"},{\"id_application_action\":\"15\",\"action\":\"15\",\"name\":\"Delete Division\",\"uid\":\"4\"},{\"id_application_action\":\"16\",\"action\":\"16\",\"name\":\"View Role\",\"uid\":\"5\"},{\"id_application_action\":\"17\",\"action\":\"17\",\"name\":\"View Create Role\",\"uid\":\"6\"},{\"id_application_action\":\"18\",\"action\":\"18\",\"name\":\"View Edit Role\",\"uid\":\"7\"},{\"id_application_action\":\"19\",\"action\":\"19\",\"name\":\"Delete Role\",\"uid\":\"8\"},{\"id_application_action\":\"20\",\"action\":\"20\",\"name\":\"Save\\/Edit Role\",\"uid\":\"9\"},{\"id_application_action\":\"21\",\"action\":\"21\",\"name\":\"View Product\",\"uid\":\"10\"},{\"id_application_action\":\"22\",\"action\":\"22\",\"name\":\"Create Product\",\"uid\":\"11\"},{\"id_application_action\":\"23\",\"action\":\"23\",\"name\":\"Edit Product\",\"uid\":\"12\"},{\"id_application_action\":\"24\",\"action\":\"24\",\"name\":\"Delete Product\",\"uid\":\"13\"},{\"id_application_action\":\"25\",\"action\":\"25\",\"name\":\"Save\\/Edit Product\",\"uid\":\"14\"},{\"id_application_action\":\"26\",\"action\":\"26\",\"name\":\"View Supplier\",\"uid\":\"15\"},{\"id_application_action\":\"27\",\"action\":\"27\",\"name\":\"Create Supplier\",\"uid\":\"16\"},{\"id_application_action\":\"28\",\"action\":\"28\",\"name\":\"Edit Supplier\",\"uid\":\"17\"},{\"id_application_action\":\"29\",\"action\":\"29\",\"name\":\"Delete Supplier\",\"uid\":\"18\"},{\"id_application_action\":\"30\",\"action\":\"30\",\"name\":\"Save\\/Edit Supplier\",\"uid\":\"19\"},{\"id_application_action\":\"31\",\"action\":\"31\",\"name\":\"View Product Category\",\"uid\":\"20\"},{\"id_application_action\":\"32\",\"action\":\"32\",\"name\":\"Create Product Category\",\"uid\":\"21\"},{\"id_application_action\":\"33\",\"action\":\"33\",\"name\":\"Edit Product Category\",\"uid\":\"22\"},{\"id_application_action\":\"34\",\"action\":\"34\",\"name\":\"Delete Product Category\",\"uid\":\"23\"},{\"id_application_action\":\"35\",\"action\":\"35\",\"name\":\"Save\\/Edit Product Category\",\"uid\":\"24\"},{\"id_application_action\":\"36\",\"action\":\"36\",\"name\":\"View Merk\",\"uid\":\"25\"},{\"id_application_action\":\"37\",\"action\":\"37\",\"name\":\"Create Merk\",\"uid\":\"26\"},{\"id_application_action\":\"38\",\"action\":\"38\",\"name\":\"Edit Merk\",\"uid\":\"27\"},{\"id_application_action\":\"39\",\"action\":\"39\",\"name\":\"Delete Merk\",\"uid\":\"28\"},{\"id_application_action\":\"40\",\"action\":\"40\",\"name\":\"Save\\/Edit Merk\",\"uid\":\"29\"},{\"id_application_action\":\"41\",\"action\":\"41\",\"name\":\"View Customer\",\"uid\":\"30\"},{\"id_application_action\":\"43\",\"action\":\"43\",\"name\":\"Create Customer\",\"uid\":\"31\"},{\"id_application_action\":\"44\",\"action\":\"44\",\"name\":\"Edit Customer\",\"uid\":\"32\"},{\"id_application_action\":\"45\",\"action\":\"45\",\"name\":\"Delete Customer\",\"uid\":\"33\"},{\"id_application_action\":\"46\",\"action\":\"46\",\"name\":\"Save\\/Edit Customer\",\"uid\":\"34\"},{\"id_application_action\":\"47\",\"action\":\"47\",\"name\":\"View Warehouse\",\"uid\":\"35\"},{\"id_application_action\":\"48\",\"action\":\"48\",\"name\":\"Create Warehouse\",\"uid\":\"36\"},{\"id_application_action\":\"49\",\"action\":\"49\",\"name\":\"Edit Warehouse\",\"uid\":\"37\"},{\"id_application_action\":\"50\",\"action\":\"50\",\"name\":\"Delete Warehouse\",\"uid\":\"38\"},{\"id_application_action\":\"51\",\"action\":\"51\",\"name\":\"Save\\/Edit Warehouse\",\"uid\":\"39\"},{\"id_application_action\":\"57\",\"action\":\"57\",\"name\":\"View PO\",\"uid\":\"40\"},{\"id_application_action\":\"58\",\"action\":\"58\",\"name\":\"Create PO\",\"uid\":\"41\"},{\"id_application_action\":\"59\",\"action\":\"59\",\"name\":\"Edit PO\",\"uid\":\"42\"},{\"id_application_action\":\"60\",\"action\":\"60\",\"name\":\"Delete PO\",\"uid\":\"43\"},{\"id_application_action\":\"61\",\"action\":\"61\",\"name\":\"Save\\/Edit PO\",\"uid\":\"44\"},{\"id_application_action\":\"62\",\"action\":\"62\",\"name\":\"View User\",\"uid\":\"45\"},{\"id_application_action\":\"63\",\"action\":\"63\",\"name\":\"Create User\",\"uid\":\"46\"},{\"id_application_action\":\"64\",\"action\":\"64\",\"name\":\"Edit User\",\"uid\":\"47\"},{\"id_application_action\":\"65\",\"action\":\"65\",\"name\":\"Delete User\",\"uid\":\"48\"},{\"id_application_action\":\"66\",\"action\":\"66\",\"name\":\"Save\\/Edit User\",\"uid\":\"49\"},{\"id_application_action\":\"67\",\"action\":\"67\",\"name\":\"View Good Receive\",\"uid\":\"50\"},{\"id_application_action\":\"68\",\"action\":\"68\",\"name\":\"Create Good Receive\",\"uid\":\"51\"},{\"id_application_action\":\"69\",\"action\":\"69\",\"name\":\"Edit Good Receive\",\"uid\":\"52\"},{\"id_application_action\":\"70\",\"action\":\"70\",\"name\":\"Delete Good Receive\",\"uid\":\"53\"},{\"id_application_action\":\"71\",\"action\":\"71\",\"name\":\"Save\\/Edit Good Receive\",\"uid\":\"54\"},{\"id_application_action\":\"72\",\"action\":\"72\",\"name\":\"View Sales Order\",\"uid\":\"55\"},{\"id_application_action\":\"73\",\"action\":\"73\",\"name\":\"Create Sales Order\",\"uid\":\"56\"},{\"id_application_action\":\"74\",\"action\":\"74\",\"name\":\"Edit Sales Order\",\"uid\":\"57\"},{\"id_application_action\":\"75\",\"action\":\"75\",\"name\":\"Delete Sales Order\",\"uid\":\"58\"},{\"id_application_action\":\"76\",\"action\":\"76\",\"name\":\"Save Sales Order\",\"uid\":\"59\"},{\"id_application_action\":\"77\",\"action\":\"77\",\"name\":\"View Material Request\",\"uid\":\"60\"},{\"id_application_action\":\"78\",\"action\":\"78\",\"name\":\"Create Material Request\",\"uid\":\"61\"},{\"id_application_action\":\"79\",\"action\":\"79\",\"name\":\"Edit Material Request\",\"uid\":\"62\"},{\"id_application_action\":\"80\",\"action\":\"80\",\"name\":\"Delete Material Request\",\"uid\":\"63\"},{\"id_application_action\":\"81\",\"action\":\"81\",\"name\":\"Save Material Request\",\"uid\":\"64\"},{\"id_application_action\":\"82\",\"action\":\"82\",\"name\":\"Change User Password\",\"uid\":\"65\"},{\"id_application_action\":\"83\",\"action\":\"83\",\"name\":\"View Delivery Note\",\"uid\":\"66\"},{\"id_application_action\":\"84\",\"action\":\"84\",\"name\":\"Create Delivery Note\",\"uid\":\"67\"},{\"id_application_action\":\"85\",\"action\":\"85\",\"name\":\"Edit Delivery Note\",\"uid\":\"68\"},{\"id_application_action\":\"86\",\"action\":\"86\",\"name\":\"Delete Delivery Note\",\"uid\":\"69\"},{\"id_application_action\":\"87\",\"action\":\"87\",\"name\":\"Save\\/Edit Delivery Note\",\"uid\":\"70\"},{\"id_application_action\":\"88\",\"action\":\"88\",\"name\":\"View Unit Measure\",\"uid\":\"71\"},{\"id_application_action\":\"89\",\"action\":\"89\",\"name\":\"Create Unit Measure\",\"uid\":\"72\"},{\"id_application_action\":\"90\",\"action\":\"90\",\"name\":\"Edit Unit Measure\",\"uid\":\"73\"},{\"id_application_action\":\"91\",\"action\":\"91\",\"name\":\"Delete Unit Measure\",\"uid\":\"74\"},{\"id_application_action\":\"92\",\"action\":\"92\",\"name\":\"Save\\/Edit Unit Measure\",\"uid\":\"75\"},{\"id_application_action\":\"93\",\"action\":\"93\",\"name\":\"View Stock\",\"uid\":\"76\"},{\"id_application_action\":\"94\",\"action\":\"94\",\"name\":\"View Employee\",\"uid\":\"77\"},{\"id_application_action\":\"95\",\"action\":\"95\",\"name\":\"Create Employee\",\"uid\":\"78\"},{\"id_application_action\":\"96\",\"action\":\"96\",\"name\":\"Edit Employee\",\"uid\":\"79\"},{\"id_application_action\":\"97\",\"action\":\"97\",\"name\":\"Delete Employee\",\"uid\":\"80\"},{\"id_application_action\":\"98\",\"action\":\"98\",\"name\":\"Save\\/Edit Employee\",\"uid\":\"81\"},{\"id_application_action\":\"1\",\"name\":\"View Application Action\",\"uid\":\"82\",\"id\":\"82\"},{\"id_application_action\":\"2\",\"name\":\"Create Application Action\",\"uid\":\"83\",\"id\":\"83\"},{\"id_application_action\":\"3\",\"name\":\"Edit Application Action\",\"uid\":\"84\",\"id\":\"84\"},{\"id_application_action\":\"4\",\"name\":\"Delete Application Action\",\"uid\":\"85\",\"id\":\"85\"},{\"id_application_action\":\"5\",\"name\":\"View Side Menu\",\"uid\":\"86\",\"id\":\"86\"},{\"id_application_action\":\"6\",\"name\":\"Create Side Menu\",\"uid\":\"87\",\"id\":\"87\"},{\"id_application_action\":\"7\",\"name\":\"Edit Side Menu\",\"uid\":\"88\",\"id\":\"88\"},{\"id_application_action\":\"8\",\"name\":\"Delete Side Menu\",\"uid\":\"89\",\"id\":\"89\"},{\"id_application_action\":\"9\",\"name\":\"Save\\/Edit Side Menu\",\"uid\":\"90\",\"id\":\"90\"},{\"id_application_action\":\"10\",\"name\":\"Save\\/Edit Action\",\"uid\":\"91\",\"id\":\"91\"},{\"id_application_action\":\"99\",\"name\":\"Validate PO\",\"uid\":\"92\",\"id\":\"92\"}],\"is_edit\":\"true\",\"id_role\":\"11\"}', '2014-12-29 01:33:42');
INSERT INTO `activity_log` VALUES ('7', 'Save/Edit User', 'user', null, '2', 'Save/Edit User', '66', '{}', '2014-12-29 01:34:20');
INSERT INTO `activity_log` VALUES ('8', 'Save/Edit Side Menu', 'side_menu', null, '2', 'Save/Edit Side Menu', '9', '{}', '2014-12-31 14:57:47');
INSERT INTO `activity_log` VALUES ('9', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"View Chart of Account\",\"controller\":\"coa\",\"function_exec\":\"\",\"function_args\":\"\",\"view_type\":\"gridview\",\"view_file\":\"coa_list\",\"prefix\":\"\",\"action_type\":\"view\",\"action_button\":\"crud\",\"target_action\":\"\",\"use_log\":\"0\",\"is_edit\":\"true\",\"id_edit\":\"209\"}', '2015-01-01 22:53:25');
INSERT INTO `activity_log` VALUES ('10', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"Create Chart of Account\",\"controller\":\"coa\",\"function_exec\":\"init_create_coa\",\"function_args\":\"\",\"view_type\":\"form\",\"view_file\":\"coa_ce\",\"prefix\":\"\",\"action_type\":\"create\",\"action_button\":\"save_discard\",\"target_action\":\"\",\"use_log\":\"0\",\"is_edit\":\"true\",\"id_edit\":\"210\"}', '2015-01-01 22:53:52');
INSERT INTO `activity_log` VALUES ('11', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"Edit Chart of Account\",\"controller\":\"coa\",\"function_exec\":\"init_edit_coa\",\"function_args\":\"id\",\"view_type\":\"form\",\"view_file\":\"coa_ce\",\"prefix\":\"\",\"action_type\":\"view\",\"action_button\":\"save_discard\",\"target_action\":\"\",\"use_log\":\"0\",\"is_edit\":\"true\",\"id_edit\":\"211\"}', '2015-01-01 22:54:11');
INSERT INTO `activity_log` VALUES ('12', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"Delete Chart of Account\",\"controller\":\"coa\",\"function_exec\":\"delete_coa\",\"function_args\":\"\",\"view_type\":\"no_view\",\"view_file\":\"\",\"prefix\":\"\",\"action_type\":\"delete\",\"action_button\":\"crud\",\"target_action\":\"\",\"use_log\":\"1\",\"is_edit\":\"true\",\"id_edit\":\"212\"}', '2015-01-01 22:54:31');
INSERT INTO `activity_log` VALUES ('13', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"Save\\/Edit Chart of Account\",\"controller\":\"coa\",\"function_exec\":\"save_coa\",\"function_args\":\"\",\"view_type\":\"no_view\",\"view_file\":\"\",\"prefix\":\"\",\"action_type\":\"create\",\"action_button\":\"crud\",\"target_action\":\"\",\"use_log\":\"1\",\"is_edit\":\"true\",\"id_edit\":\"213\"}', '2015-01-01 22:54:56');
INSERT INTO `activity_log` VALUES ('14', 'Save/Edit Side Menu', 'side_menu', null, '2', 'Save/Edit Side Menu', '9', '{}', '2015-01-02 10:34:28');
INSERT INTO `activity_log` VALUES ('15', 'Save/Edit Side Menu', 'side_menu', null, '2', 'Save/Edit Side Menu', '9', '{}', '2015-01-02 10:39:03');
INSERT INTO `activity_log` VALUES ('16', 'Save/Edit Side Menu', 'side_menu', null, '2', 'Save/Edit Side Menu', '9', '{}', '2015-01-02 10:39:29');
INSERT INTO `activity_log` VALUES ('17', 'Save/Edit Side Menu', 'side_menu', null, '2', 'Save/Edit Side Menu', '9', '{}', '2015-01-02 10:39:41');
INSERT INTO `activity_log` VALUES ('18', 'Save/Edit Side Menu', 'side_menu', null, '2', 'Save/Edit Side Menu', '9', '{}', '2015-01-02 10:40:36');
INSERT INTO `activity_log` VALUES ('19', 'Save/Edit Side Menu', 'side_menu', null, '2', 'Save/Edit Side Menu', '9', '{}', '2015-01-02 10:40:58');
INSERT INTO `activity_log` VALUES ('20', 'Save/Edit Role', 'role', null, '2', 'Save/Edit Role', '20', '{\"name\":\"administrator\",\"action_detail\":[{\"id_application_action\":\"1\",\"action\":\"1\",\"name\":\"View Application Action\",\"uid\":\"0\"},{\"id_application_action\":\"2\",\"action\":\"2\",\"name\":\"Create Application Action\",\"uid\":\"1\"},{\"id_application_action\":\"3\",\"action\":\"3\",\"name\":\"Edit Application Action\",\"uid\":\"2\"},{\"id_application_action\":\"4\",\"action\":\"4\",\"name\":\"Delete Application Action\",\"uid\":\"3\"},{\"id_application_action\":\"5\",\"action\":\"5\",\"name\":\"View Side Menu\",\"uid\":\"4\"},{\"id_application_action\":\"6\",\"action\":\"6\",\"name\":\"Create Side Menu\",\"uid\":\"5\"},{\"id_application_action\":\"7\",\"action\":\"7\",\"name\":\"Edit Side Menu\",\"uid\":\"6\"},{\"id_application_action\":\"8\",\"action\":\"8\",\"name\":\"Delete Side Menu\",\"uid\":\"7\"},{\"id_application_action\":\"9\",\"action\":\"9\",\"name\":\"Save\\/Edit Side Menu\",\"uid\":\"8\"},{\"id_application_action\":\"10\",\"action\":\"10\",\"name\":\"Save\\/Edit Action\",\"uid\":\"9\"},{\"id_application_action\":\"11\",\"action\":\"11\",\"name\":\"View Division\",\"uid\":\"10\"},{\"id_application_action\":\"12\",\"action\":\"12\",\"name\":\"Create Division\",\"uid\":\"11\"},{\"id_application_action\":\"13\",\"action\":\"13\",\"name\":\"Save\\/Edit Division\",\"uid\":\"12\"},{\"id_application_action\":\"14\",\"action\":\"14\",\"name\":\"Edit Division\",\"uid\":\"13\"},{\"id_application_action\":\"15\",\"action\":\"15\",\"name\":\"Delete Division\",\"uid\":\"14\"},{\"id_application_action\":\"16\",\"action\":\"16\",\"name\":\"View Role\",\"uid\":\"15\"},{\"id_application_action\":\"17\",\"action\":\"17\",\"name\":\"View Create Role\",\"uid\":\"16\"},{\"id_application_action\":\"18\",\"action\":\"18\",\"name\":\"View Edit Role\",\"uid\":\"17\"},{\"id_application_action\":\"19\",\"action\":\"19\",\"name\":\"Delete Role\",\"uid\":\"18\"},{\"id_application_action\":\"20\",\"action\":\"20\",\"name\":\"Save\\/Edit Role\",\"uid\":\"19\"},{\"id_application_action\":\"21\",\"action\":\"21\",\"name\":\"View Product\",\"uid\":\"20\"},{\"id_application_action\":\"22\",\"action\":\"22\",\"name\":\"Create Product\",\"uid\":\"21\"},{\"id_application_action\":\"23\",\"action\":\"23\",\"name\":\"Edit Product\",\"uid\":\"22\"},{\"id_application_action\":\"24\",\"action\":\"24\",\"name\":\"Delete Product\",\"uid\":\"23\"},{\"id_application_action\":\"25\",\"action\":\"25\",\"name\":\"Save\\/Edit Product\",\"uid\":\"24\"},{\"id_application_action\":\"26\",\"action\":\"26\",\"name\":\"View Supplier\",\"uid\":\"25\"},{\"id_application_action\":\"27\",\"action\":\"27\",\"name\":\"Create Supplier\",\"uid\":\"26\"},{\"id_application_action\":\"28\",\"action\":\"28\",\"name\":\"Edit Supplier\",\"uid\":\"27\"},{\"id_application_action\":\"29\",\"action\":\"29\",\"name\":\"Delete Supplier\",\"uid\":\"28\"},{\"id_application_action\":\"30\",\"action\":\"30\",\"name\":\"Save\\/Edit Supplier\",\"uid\":\"29\"},{\"id_application_action\":\"31\",\"action\":\"31\",\"name\":\"View Product Category\",\"uid\":\"30\"},{\"id_application_action\":\"32\",\"action\":\"32\",\"name\":\"Create Product Category\",\"uid\":\"31\"},{\"id_application_action\":\"33\",\"action\":\"33\",\"name\":\"Edit Product Category\",\"uid\":\"32\"},{\"id_application_action\":\"34\",\"action\":\"34\",\"name\":\"Delete Product Category\",\"uid\":\"33\"},{\"id_application_action\":\"35\",\"action\":\"35\",\"name\":\"Save\\/Edit Product Category\",\"uid\":\"34\"},{\"id_application_action\":\"36\",\"action\":\"36\",\"name\":\"View Merk\",\"uid\":\"35\"},{\"id_application_action\":\"37\",\"action\":\"37\",\"name\":\"Create Merk\",\"uid\":\"36\"},{\"id_application_action\":\"38\",\"action\":\"38\",\"name\":\"Edit Merk\",\"uid\":\"37\"},{\"id_application_action\":\"39\",\"action\":\"39\",\"name\":\"Delete Merk\",\"uid\":\"38\"},{\"id_application_action\":\"40\",\"action\":\"40\",\"name\":\"Save\\/Edit Merk\",\"uid\":\"39\"},{\"id_application_action\":\"41\",\"action\":\"41\",\"name\":\"View Customer\",\"uid\":\"40\"},{\"id_application_action\":\"43\",\"action\":\"43\",\"name\":\"Create Customer\",\"uid\":\"41\"},{\"id_application_action\":\"44\",\"action\":\"44\",\"name\":\"Edit Customer\",\"uid\":\"42\"},{\"id_application_action\":\"45\",\"action\":\"45\",\"name\":\"Delete Customer\",\"uid\":\"43\"},{\"id_application_action\":\"46\",\"action\":\"46\",\"name\":\"Save\\/Edit Customer\",\"uid\":\"44\"},{\"id_application_action\":\"47\",\"action\":\"47\",\"name\":\"View Warehouse\",\"uid\":\"45\"},{\"id_application_action\":\"48\",\"action\":\"48\",\"name\":\"Create Warehouse\",\"uid\":\"46\"},{\"id_application_action\":\"49\",\"action\":\"49\",\"name\":\"Edit Warehouse\",\"uid\":\"47\"},{\"id_application_action\":\"50\",\"action\":\"50\",\"name\":\"Delete Warehouse\",\"uid\":\"48\"},{\"id_application_action\":\"51\",\"action\":\"51\",\"name\":\"Save\\/Edit Warehouse\",\"uid\":\"49\"},{\"id_application_action\":\"57\",\"action\":\"57\",\"name\":\"View PO\",\"uid\":\"50\"},{\"id_application_action\":\"58\",\"action\":\"58\",\"name\":\"Create PO\",\"uid\":\"51\"},{\"id_application_action\":\"59\",\"action\":\"59\",\"name\":\"Edit PO\",\"uid\":\"52\"},{\"id_application_action\":\"60\",\"action\":\"60\",\"name\":\"Delete PO\",\"uid\":\"53\"},{\"id_application_action\":\"61\",\"action\":\"61\",\"name\":\"Save\\/Edit PO\",\"uid\":\"54\"},{\"id_application_action\":\"62\",\"action\":\"62\",\"name\":\"View User\",\"uid\":\"55\"},{\"id_application_action\":\"63\",\"action\":\"63\",\"name\":\"Create User\",\"uid\":\"56\"},{\"id_application_action\":\"64\",\"action\":\"64\",\"name\":\"Edit User\",\"uid\":\"57\"},{\"id_application_action\":\"65\",\"action\":\"65\",\"name\":\"Delete User\",\"uid\":\"58\"},{\"id_application_action\":\"66\",\"action\":\"66\",\"name\":\"Save\\/Edit User\",\"uid\":\"59\"},{\"id_application_action\":\"82\",\"action\":\"82\",\"name\":\"Change User Password\",\"uid\":\"60\"},{\"id_application_action\":\"93\",\"action\":\"93\",\"name\":\"View Stock\",\"uid\":\"61\"},{\"id_application_action\":\"67\",\"action\":\"67\",\"name\":\"View Good Receive\",\"uid\":\"62\"},{\"id_application_action\":\"68\",\"action\":\"68\",\"name\":\"Create Good Receive\",\"uid\":\"63\"},{\"id_application_action\":\"69\",\"action\":\"69\",\"name\":\"Edit Good Receive\",\"uid\":\"64\"},{\"id_application_action\":\"70\",\"action\":\"70\",\"name\":\"Delete Good Receive\",\"uid\":\"65\"},{\"id_application_action\":\"71\",\"action\":\"71\",\"name\":\"Save\\/Edit Good Receive\",\"uid\":\"66\"},{\"id_application_action\":\"72\",\"action\":\"72\",\"name\":\"View Sales Order\",\"uid\":\"67\"},{\"id_application_action\":\"73\",\"action\":\"73\",\"name\":\"Create Sales Order\",\"uid\":\"68\"},{\"id_application_action\":\"74\",\"action\":\"74\",\"name\":\"Edit Sales Order\",\"uid\":\"69\"},{\"id_application_action\":\"75\",\"action\":\"75\",\"name\":\"Delete Sales Order\",\"uid\":\"70\"},{\"id_application_action\":\"76\",\"action\":\"76\",\"name\":\"Save Sales Order\",\"uid\":\"71\"},{\"id_application_action\":\"77\",\"action\":\"77\",\"name\":\"View Material Request\",\"uid\":\"72\"},{\"id_application_action\":\"78\",\"action\":\"78\",\"name\":\"Create Material Request\",\"uid\":\"73\"},{\"id_application_action\":\"79\",\"action\":\"79\",\"name\":\"Edit Material Request\",\"uid\":\"74\"},{\"id_application_action\":\"80\",\"action\":\"80\",\"name\":\"Delete Material Request\",\"uid\":\"75\"},{\"id_application_action\":\"81\",\"action\":\"81\",\"name\":\"Save Material Request\",\"uid\":\"76\"},{\"id_application_action\":\"83\",\"action\":\"83\",\"name\":\"View Delivery Note\",\"uid\":\"77\"},{\"id_application_action\":\"84\",\"action\":\"84\",\"name\":\"Create Delivery Note\",\"uid\":\"78\"},{\"id_application_action\":\"85\",\"action\":\"85\",\"name\":\"Edit Delivery Note\",\"uid\":\"79\"},{\"id_application_action\":\"86\",\"action\":\"86\",\"name\":\"Delete Delivery Note\",\"uid\":\"80\"},{\"id_application_action\":\"87\",\"action\":\"87\",\"name\":\"Save\\/Edit Delivery Note\",\"uid\":\"81\"},{\"id_application_action\":\"88\",\"action\":\"88\",\"name\":\"View Unit Measure\",\"uid\":\"82\"},{\"id_application_action\":\"89\",\"action\":\"89\",\"name\":\"Create Unit Measure\",\"uid\":\"83\"},{\"id_application_action\":\"90\",\"action\":\"90\",\"name\":\"Edit Unit Measure\",\"uid\":\"84\"},{\"id_application_action\":\"91\",\"action\":\"91\",\"name\":\"Delete Unit Measure\",\"uid\":\"85\"},{\"id_application_action\":\"92\",\"action\":\"92\",\"name\":\"Save\\/Edit Unit Measure\",\"uid\":\"86\"},{\"id_application_action\":\"94\",\"action\":\"94\",\"name\":\"View Employee\",\"uid\":\"87\"},{\"id_application_action\":\"95\",\"action\":\"95\",\"name\":\"Create Employee\",\"uid\":\"88\"},{\"id_application_action\":\"96\",\"action\":\"96\",\"name\":\"Edit Employee\",\"uid\":\"89\"},{\"id_application_action\":\"97\",\"action\":\"97\",\"name\":\"Delete Employee\",\"uid\":\"90\"},{\"id_application_action\":\"98\",\"action\":\"98\",\"name\":\"Save\\/Edit Employee\",\"uid\":\"91\"},{\"id_application_action\":\"99\",\"action\":\"99\",\"name\":\"Validate PO\",\"uid\":\"92\"},{\"id_application_action\":\"100\",\"action\":\"100\",\"name\":\"Create Database Interface\",\"uid\":\"93\"},{\"id_application_action\":\"101\",\"action\":\"101\",\"name\":\"Edit Database Interface\",\"uid\":\"94\"},{\"id_application_action\":\"102\",\"action\":\"102\",\"name\":\"Delete Database Interface\",\"uid\":\"95\"},{\"id_application_action\":\"103\",\"action\":\"103\",\"name\":\"Save \\/ Edit Database Interface\",\"uid\":\"96\"},{\"id_application_action\":\"104\",\"action\":\"104\",\"name\":\"View Database Field Interface\",\"uid\":\"97\"},{\"id_application_action\":\"105\",\"action\":\"105\",\"name\":\"Create Database Field Interface\",\"uid\":\"98\"},{\"id_application_action\":\"106\",\"action\":\"106\",\"name\":\"Edit Database Field Interface\",\"uid\":\"99\"},{\"id_application_action\":\"107\",\"action\":\"107\",\"name\":\"Delete Database Field Interface\",\"uid\":\"100\"},{\"id_application_action\":\"108\",\"action\":\"108\",\"name\":\"Save \\/ Edit Database Field Interface\",\"uid\":\"101\"},{\"id_application_action\":\"109\",\"name\":\"View Inquiry\",\"uid\":\"102\",\"id\":\"102\"},{\"id_application_action\":\"110\",\"name\":\"Create Inquiry\",\"uid\":\"103\",\"id\":\"103\"},{\"id_application_action\":\"111\",\"name\":\"Edit Inquiry\",\"uid\":\"104\",\"id\":\"104\"},{\"id_application_action\":\"112\",\"name\":\"Delete Inquiry\",\"uid\":\"105\",\"id\":\"105\"},{\"id_application_action\":\"113\",\"name\":\"Save\\/Edit Inquiry\",\"uid\":\"106\",\"id\":\"106\"},{\"id_application_action\":\"114\",\"name\":\"View Survey \\/ Assessment\",\"uid\":\"107\",\"id\":\"107\"},{\"id_application_action\":\"115\",\"name\":\"Create Survey \\/ Assessment\",\"uid\":\"108\",\"id\":\"108\"},{\"id_application_action\":\"116\",\"name\":\"Edit Survey \\/ Assessment\",\"uid\":\"109\",\"id\":\"109\"},{\"id_application_action\":\"117\",\"name\":\"Delete Survey \\/ Assessment\",\"uid\":\"110\",\"id\":\"110\"},{\"id_application_action\":\"118\",\"name\":\"Save\\/Edit Survey \\/ Assessment\",\"uid\":\"111\",\"id\":\"111\"},{\"id_application_action\":\"119\",\"name\":\"View Quotation\",\"uid\":\"112\",\"id\":\"112\"},{\"id_application_action\":\"120\",\"name\":\"Create Quotation\",\"uid\":\"113\",\"id\":\"113\"},{\"id_application_action\":\"121\",\"name\":\"Edit Quotation\",\"uid\":\"114\",\"id\":\"114\"},{\"id_application_action\":\"122\",\"name\":\"Delete Quotation\",\"uid\":\"115\",\"id\":\"115\"},{\"id_application_action\":\"123\",\"name\":\"Save\\/Edit Quotation\",\"uid\":\"116\",\"id\":\"116\"},{\"id_application_action\":\"124\",\"name\":\"View Project Contract\",\"uid\":\"117\",\"id\":\"117\"},{\"id_application_action\":\"125\",\"name\":\"Create Project Contract\",\"uid\":\"118\",\"id\":\"118\"},{\"id_application_action\":\"126\",\"name\":\"Edit Project Contract\",\"uid\":\"119\",\"id\":\"119\"},{\"id_application_action\":\"127\",\"name\":\"Delete Project Contract\",\"uid\":\"120\",\"id\":\"120\"},{\"id_application_action\":\"128\",\"name\":\"Save\\/Edit Project Contract\",\"uid\":\"121\",\"id\":\"121\"},{\"id_application_action\":\"129\",\"name\":\"View Work Order\",\"uid\":\"122\",\"id\":\"122\"},{\"id_application_action\":\"130\",\"name\":\"Create Work Order\",\"uid\":\"123\",\"id\":\"123\"},{\"id_application_action\":\"131\",\"name\":\"Edit Work Order\",\"uid\":\"124\",\"id\":\"124\"},{\"id_application_action\":\"132\",\"name\":\"Delete Work Order\",\"uid\":\"125\",\"id\":\"125\"},{\"id_application_action\":\"133\",\"name\":\"Save\\/Edit Work Order\",\"uid\":\"126\",\"id\":\"126\"},{\"id_application_action\":\"134\",\"name\":\"View Assessment Template\",\"uid\":\"127\",\"id\":\"127\"},{\"id_application_action\":\"135\",\"name\":\"Create Assessment Template\",\"uid\":\"128\",\"id\":\"128\"},{\"id_application_action\":\"136\",\"name\":\"Edit Assessment Template\",\"uid\":\"129\",\"id\":\"129\"},{\"id_application_action\":\"137\",\"name\":\"Delete Assessment Template\",\"uid\":\"130\",\"id\":\"130\"},{\"id_application_action\":\"138\",\"name\":\"Save\\/Edit Assessment Template\",\"uid\":\"131\",\"id\":\"131\"},{\"id_application_action\":\"139\",\"name\":\"View Contract Template\",\"uid\":\"132\",\"id\":\"132\"},{\"id_application_action\":\"140\",\"name\":\"Create Contract Template\",\"uid\":\"133\",\"id\":\"133\"},{\"id_application_action\":\"141\",\"name\":\"Edit Contract Template\",\"uid\":\"134\",\"id\":\"134\"},{\"id_application_action\":\"142\",\"name\":\"Delete Contract Template\",\"uid\":\"135\",\"id\":\"135\"},{\"id_application_action\":\"143\",\"name\":\"Save\\/Edit Contract Template\",\"uid\":\"136\",\"id\":\"136\"},{\"id_application_action\":\"144\",\"name\":\"View Work Schedule\",\"uid\":\"137\",\"id\":\"137\"},{\"id_application_action\":\"145\",\"name\":\"Create Work Schedule\",\"uid\":\"138\",\"id\":\"138\"},{\"id_application_action\":\"146\",\"name\":\"Edit Work Schedule\",\"uid\":\"139\",\"id\":\"139\"},{\"id_application_action\":\"147\",\"name\":\"Delete Work Schedule\",\"uid\":\"140\",\"id\":\"140\"},{\"id_application_action\":\"148\",\"name\":\"Save\\/Edit Work Schedule\",\"uid\":\"141\",\"id\":\"141\"},{\"id_application_action\":\"149\",\"name\":\"View SO Assignment\",\"uid\":\"142\",\"id\":\"142\"},{\"id_application_action\":\"150\",\"name\":\"Create SO Assignment\",\"uid\":\"143\",\"id\":\"143\"},{\"id_application_action\":\"151\",\"name\":\"Edit SO Assignment\",\"uid\":\"144\",\"id\":\"144\"},{\"id_application_action\":\"152\",\"name\":\"Delete SO Assignment\",\"uid\":\"145\",\"id\":\"145\"},{\"id_application_action\":\"153\",\"name\":\"Save\\/Edit SO Assignment\",\"uid\":\"146\",\"id\":\"146\"},{\"id_application_action\":\"154\",\"name\":\"View Shift Change\",\"uid\":\"147\",\"id\":\"147\"},{\"id_application_action\":\"155\",\"name\":\"Create Shift Change\",\"uid\":\"148\",\"id\":\"148\"},{\"id_application_action\":\"156\",\"name\":\"Edit Shift Change\",\"uid\":\"149\",\"id\":\"149\"},{\"id_application_action\":\"223\",\"name\":\"Save\\/Edit Salary Setting\",\"uid\":\"150\",\"id\":\"150\"},{\"id_application_action\":\"222\",\"name\":\"Delete Salary Setting\",\"uid\":\"151\",\"id\":\"151\"},{\"id_application_action\":\"221\",\"name\":\"Edit Salary Setting\",\"uid\":\"152\",\"id\":\"152\"},{\"id_application_action\":\"220\",\"name\":\"Create Salary Setting\",\"uid\":\"153\",\"id\":\"153\"},{\"id_application_action\":\"219\",\"name\":\"View Salary Setting\",\"uid\":\"154\",\"id\":\"154\"},{\"id_application_action\":\"157\",\"name\":\"Delete Shift Change\",\"uid\":\"155\",\"id\":\"155\"},{\"id_application_action\":\"158\",\"name\":\"Save\\/Edit Shift Change\",\"uid\":\"156\",\"id\":\"156\"},{\"id_application_action\":\"159\",\"name\":\"View Leave Application\",\"uid\":\"157\",\"id\":\"157\"},{\"id_application_action\":\"160\",\"name\":\"Create Leave Application\",\"uid\":\"158\",\"id\":\"158\"},{\"id_application_action\":\"161\",\"name\":\"Edit Leave Application\",\"uid\":\"159\",\"id\":\"159\"},{\"id_application_action\":\"162\",\"name\":\"Delete Leave Application\",\"uid\":\"160\",\"id\":\"160\"},{\"id_application_action\":\"163\",\"name\":\"Save\\/Edit Leave Application\",\"uid\":\"161\",\"id\":\"161\"},{\"id_application_action\":\"164\",\"name\":\"View Timesheet (Recap)\",\"uid\":\"162\",\"id\":\"162\"},{\"id_application_action\":\"165\",\"name\":\"Create Timesheet (Recap)\",\"uid\":\"163\",\"id\":\"163\"},{\"id_application_action\":\"166\",\"name\":\"Edit Timesheet (Recap)\",\"uid\":\"164\",\"id\":\"164\"},{\"id_application_action\":\"167\",\"name\":\"Delete Timesheet (Recap)\",\"uid\":\"165\",\"id\":\"165\"},{\"id_application_action\":\"168\",\"name\":\"Save\\/Edit Timesheet (Recap)\",\"uid\":\"166\",\"id\":\"166\"},{\"id_application_action\":\"169\",\"name\":\"View SO Timesheet\",\"uid\":\"167\",\"id\":\"167\"},{\"id_application_action\":\"170\",\"name\":\"Create SO Timesheet\",\"uid\":\"168\",\"id\":\"168\"},{\"id_application_action\":\"171\",\"name\":\"Edit SO Timesheet\",\"uid\":\"169\",\"id\":\"169\"},{\"id_application_action\":\"172\",\"name\":\"Delete SO Timesheet\",\"uid\":\"170\",\"id\":\"170\"},{\"id_application_action\":\"173\",\"name\":\"Save\\/Edit SO Timesheet\",\"uid\":\"171\",\"id\":\"171\"},{\"id_application_action\":\"174\",\"name\":\"View Incident Report\",\"uid\":\"172\",\"id\":\"172\"},{\"id_application_action\":\"175\",\"name\":\"Create Incident Report\",\"uid\":\"173\",\"id\":\"173\"},{\"id_application_action\":\"176\",\"name\":\"Edit Incident Report\",\"uid\":\"174\",\"id\":\"174\"},{\"id_application_action\":\"177\",\"name\":\"Delete Incident Report\",\"uid\":\"175\",\"id\":\"175\"},{\"id_application_action\":\"178\",\"name\":\"Save\\/Edit Incident Report\",\"uid\":\"176\",\"id\":\"176\"},{\"id_application_action\":\"179\",\"name\":\"View Payroll\",\"uid\":\"177\",\"id\":\"177\"},{\"id_application_action\":\"180\",\"name\":\"Create Payroll\",\"uid\":\"178\",\"id\":\"178\"},{\"id_application_action\":\"181\",\"name\":\"Edit Payroll\",\"uid\":\"179\",\"id\":\"179\"},{\"id_application_action\":\"182\",\"name\":\"Delete Payroll\",\"uid\":\"180\",\"id\":\"180\"},{\"id_application_action\":\"183\",\"name\":\"Save\\/Edit Payroll\",\"uid\":\"181\",\"id\":\"181\"},{\"id_application_action\":\"184\",\"name\":\"View Supplier Invoice\",\"uid\":\"182\",\"id\":\"182\"},{\"id_application_action\":\"185\",\"name\":\"Create Supplier Invoice\",\"uid\":\"183\",\"id\":\"183\"},{\"id_application_action\":\"186\",\"name\":\"Edit Supplier Invoice\",\"uid\":\"184\",\"id\":\"184\"},{\"id_application_action\":\"187\",\"name\":\"Delete Supplier Invoice\",\"uid\":\"185\",\"id\":\"185\"},{\"id_application_action\":\"188\",\"name\":\"Save\\/Edit Supplier Invoice\",\"uid\":\"186\",\"id\":\"186\"},{\"id_application_action\":\"189\",\"name\":\"View Customer Invoice\",\"uid\":\"187\",\"id\":\"187\"},{\"id_application_action\":\"190\",\"name\":\"Create Customer Invoice\",\"uid\":\"188\",\"id\":\"188\"},{\"id_application_action\":\"191\",\"name\":\"Edit Customer Invoice\",\"uid\":\"189\",\"id\":\"189\"},{\"id_application_action\":\"192\",\"name\":\"Delete Customer Invoice\",\"uid\":\"190\",\"id\":\"190\"},{\"id_application_action\":\"193\",\"name\":\"Save\\/Edit Customer Invoice\",\"uid\":\"191\",\"id\":\"191\"},{\"id_application_action\":\"194\",\"name\":\"View Bank Statement\",\"uid\":\"192\",\"id\":\"192\"},{\"id_application_action\":\"195\",\"name\":\"Create Bank Statement\",\"uid\":\"193\",\"id\":\"193\"},{\"id_application_action\":\"196\",\"name\":\"Edit Bank Statement\",\"uid\":\"194\",\"id\":\"194\"},{\"id_application_action\":\"197\",\"name\":\"Delete Bank Statement\",\"uid\":\"195\",\"id\":\"195\"},{\"id_application_action\":\"198\",\"name\":\"Save\\/Edit Bank Statement\",\"uid\":\"196\",\"id\":\"196\"},{\"id_application_action\":\"199\",\"name\":\"View Cash Register\",\"uid\":\"197\",\"id\":\"197\"},{\"id_application_action\":\"200\",\"name\":\"Create Cash Register\",\"uid\":\"198\",\"id\":\"198\"},{\"id_application_action\":\"201\",\"name\":\"Edit Cash Register\",\"uid\":\"199\",\"id\":\"199\"},{\"id_application_action\":\"202\",\"name\":\"Delete Cash Register\",\"uid\":\"200\",\"id\":\"200\"},{\"id_application_action\":\"203\",\"name\":\"Save\\/Edit Cash Register\",\"uid\":\"201\",\"id\":\"201\"},{\"id_application_action\":\"204\",\"name\":\"View Tax\",\"uid\":\"202\",\"id\":\"202\"},{\"id_application_action\":\"205\",\"name\":\"Create Tax\",\"uid\":\"203\",\"id\":\"203\"},{\"id_application_action\":\"206\",\"name\":\"Edit Tax\",\"uid\":\"204\",\"id\":\"204\"},{\"id_application_action\":\"207\",\"name\":\"Delete Tax\",\"uid\":\"205\",\"id\":\"205\"},{\"id_application_action\":\"208\",\"name\":\"Save\\/Edit Tax\",\"uid\":\"206\",\"id\":\"206\"},{\"id_application_action\":\"209\",\"name\":\"View Chart of Account\",\"uid\":\"207\",\"id\":\"207\"},{\"id_application_action\":\"210\",\"name\":\"Create Chart of Account\",\"uid\":\"208\",\"id\":\"208\"},{\"id_application_action\":\"211\",\"name\":\"Edit Chart of Account\",\"uid\":\"209\",\"id\":\"209\"},{\"id_application_action\":\"212\",\"name\":\"Delete Chart of Account\",\"uid\":\"210\",\"id\":\"210\"},{\"id_application_action\":\"213\",\"name\":\"Save\\/Edit Chart of Account\",\"uid\":\"211\",\"id\":\"211\"},{\"id_application_action\":\"214\",\"name\":\"View Employee Salary\",\"uid\":\"212\",\"id\":\"212\"},{\"id_application_action\":\"215\",\"name\":\"Create Employee Salary\",\"uid\":\"213\",\"id\":\"213\"},{\"id_application_action\":\"216\",\"name\":\"Edit Employee Salary\",\"uid\":\"214\",\"id\":\"214\"},{\"id_application_action\":\"217\",\"name\":\"Delete Employee Salary\",\"uid\":\"215\",\"id\":\"215\"},{\"id_application_action\":\"218\",\"name\":\"Save\\/Edit Employee Salary\",\"uid\":\"216\",\"id\":\"216\"}],\"is_edit\":\"true\",\"id_role\":\"1\"}', '2015-01-02 10:43:09');
INSERT INTO `activity_log` VALUES ('21', 'Validate PO', 'po', null, '2', 'Validate PO', '99', '{\"id_po\":null,\"status\":\"open\"}', '2015-01-02 09:48:01');
INSERT INTO `activity_log` VALUES ('22', 'Validate PO', 'po', null, '2', 'Validate PO', '99', '{\"id_po\":null,\"status\":\"open\"}', '2015-01-02 09:48:23');
INSERT INTO `activity_log` VALUES ('23', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"View Database Interface\",\"controller\":\"database_interface\",\"function_exec\":\"\",\"function_args\":\"\",\"view_type\":\"gridview\",\"view_file\":\"database_interface_list\",\"prefix\":\"\",\"action_type\":\"view\",\"action_button\":\"crud\",\"target_action\":\"\",\"use_log\":\"0\",\"is_edit\":\"false\",\"id_edit\":\"\"}', '2015-01-02 09:49:54');
INSERT INTO `activity_log` VALUES ('24', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"Delete Database Interface\",\"controller\":\"database_interface\",\"function_exec\":\"delete_database_interface\",\"function_args\":\"\",\"view_type\":\"no_view\",\"view_file\":\"\",\"prefix\":\"\",\"action_type\":\"delete\",\"action_button\":\"crud\",\"target_action\":\"224\",\"use_log\":\"0\",\"is_edit\":\"true\",\"id_edit\":\"102\"}', '2015-01-02 09:50:25');
INSERT INTO `activity_log` VALUES ('25', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"Save \\/ Edit Database Interface\",\"controller\":\"Database Interface\",\"function_exec\":\"save_database_interface\",\"function_args\":\"\",\"view_type\":\"no_view\",\"view_file\":\"\",\"prefix\":\"\",\"action_type\":\"create\",\"action_button\":\"crud\",\"target_action\":\"224\",\"use_log\":\"0\",\"is_edit\":\"true\",\"id_edit\":\"103\"}', '2015-01-02 09:50:50');
INSERT INTO `activity_log` VALUES ('26', 'Validate PO', 'po', null, '2', 'Validate PO', '99', '{\"id_po\":null,\"status\":\"open\"}', '2015-01-02 09:50:56');
INSERT INTO `activity_log` VALUES ('27', 'Save/Edit Side Menu', 'side_menu', null, '2', 'Save/Edit Side Menu', '9', '{}', '2015-01-02 09:51:40');
INSERT INTO `activity_log` VALUES ('28', 'Validate PO', 'po', null, '2', 'Validate PO', '99', '{\"id_po\":null,\"status\":\"open\"}', '2015-01-02 09:51:46');
INSERT INTO `activity_log` VALUES ('29', 'Save/Edit Role', 'role', null, '2', 'Save/Edit Role', '20', '{\"name\":\"administrator\",\"action_detail\":[{\"id_application_action\":\"1\",\"action\":\"1\",\"name\":\"View Application Action\",\"uid\":\"0\"},{\"id_application_action\":\"2\",\"action\":\"2\",\"name\":\"Create Application Action\",\"uid\":\"1\"},{\"id_application_action\":\"3\",\"action\":\"3\",\"name\":\"Edit Application Action\",\"uid\":\"2\"},{\"id_application_action\":\"4\",\"action\":\"4\",\"name\":\"Delete Application Action\",\"uid\":\"3\"},{\"id_application_action\":\"5\",\"action\":\"5\",\"name\":\"View Side Menu\",\"uid\":\"4\"},{\"id_application_action\":\"6\",\"action\":\"6\",\"name\":\"Create Side Menu\",\"uid\":\"5\"},{\"id_application_action\":\"7\",\"action\":\"7\",\"name\":\"Edit Side Menu\",\"uid\":\"6\"},{\"id_application_action\":\"8\",\"action\":\"8\",\"name\":\"Delete Side Menu\",\"uid\":\"7\"},{\"id_application_action\":\"9\",\"action\":\"9\",\"name\":\"Save\\/Edit Side Menu\",\"uid\":\"8\"},{\"id_application_action\":\"10\",\"action\":\"10\",\"name\":\"Save\\/Edit Action\",\"uid\":\"9\"},{\"id_application_action\":\"11\",\"action\":\"11\",\"name\":\"View Division\",\"uid\":\"10\"},{\"id_application_action\":\"12\",\"action\":\"12\",\"name\":\"Create Division\",\"uid\":\"11\"},{\"id_application_action\":\"13\",\"action\":\"13\",\"name\":\"Save\\/Edit Division\",\"uid\":\"12\"},{\"id_application_action\":\"14\",\"action\":\"14\",\"name\":\"Edit Division\",\"uid\":\"13\"},{\"id_application_action\":\"15\",\"action\":\"15\",\"name\":\"Delete Division\",\"uid\":\"14\"},{\"id_application_action\":\"16\",\"action\":\"16\",\"name\":\"View Role\",\"uid\":\"15\"},{\"id_application_action\":\"17\",\"action\":\"17\",\"name\":\"View Create Role\",\"uid\":\"16\"},{\"id_application_action\":\"18\",\"action\":\"18\",\"name\":\"View Edit Role\",\"uid\":\"17\"},{\"id_application_action\":\"19\",\"action\":\"19\",\"name\":\"Delete Role\",\"uid\":\"18\"},{\"id_application_action\":\"20\",\"action\":\"20\",\"name\":\"Save\\/Edit Role\",\"uid\":\"19\"},{\"id_application_action\":\"21\",\"action\":\"21\",\"name\":\"View Product\",\"uid\":\"20\"},{\"id_application_action\":\"22\",\"action\":\"22\",\"name\":\"Create Product\",\"uid\":\"21\"},{\"id_application_action\":\"23\",\"action\":\"23\",\"name\":\"Edit Product\",\"uid\":\"22\"},{\"id_application_action\":\"24\",\"action\":\"24\",\"name\":\"Delete Product\",\"uid\":\"23\"},{\"id_application_action\":\"25\",\"action\":\"25\",\"name\":\"Save\\/Edit Product\",\"uid\":\"24\"},{\"id_application_action\":\"26\",\"action\":\"26\",\"name\":\"View Supplier\",\"uid\":\"25\"},{\"id_application_action\":\"27\",\"action\":\"27\",\"name\":\"Create Supplier\",\"uid\":\"26\"},{\"id_application_action\":\"28\",\"action\":\"28\",\"name\":\"Edit Supplier\",\"uid\":\"27\"},{\"id_application_action\":\"29\",\"action\":\"29\",\"name\":\"Delete Supplier\",\"uid\":\"28\"},{\"id_application_action\":\"30\",\"action\":\"30\",\"name\":\"Save\\/Edit Supplier\",\"uid\":\"29\"},{\"id_application_action\":\"31\",\"action\":\"31\",\"name\":\"View Product Category\",\"uid\":\"30\"},{\"id_application_action\":\"32\",\"action\":\"32\",\"name\":\"Create Product Category\",\"uid\":\"31\"},{\"id_application_action\":\"33\",\"action\":\"33\",\"name\":\"Edit Product Category\",\"uid\":\"32\"},{\"id_application_action\":\"34\",\"action\":\"34\",\"name\":\"Delete Product Category\",\"uid\":\"33\"},{\"id_application_action\":\"35\",\"action\":\"35\",\"name\":\"Save\\/Edit Product Category\",\"uid\":\"34\"},{\"id_application_action\":\"36\",\"action\":\"36\",\"name\":\"View Merk\",\"uid\":\"35\"},{\"id_application_action\":\"37\",\"action\":\"37\",\"name\":\"Create Merk\",\"uid\":\"36\"},{\"id_application_action\":\"38\",\"action\":\"38\",\"name\":\"Edit Merk\",\"uid\":\"37\"},{\"id_application_action\":\"39\",\"action\":\"39\",\"name\":\"Delete Merk\",\"uid\":\"38\"},{\"id_application_action\":\"40\",\"action\":\"40\",\"name\":\"Save\\/Edit Merk\",\"uid\":\"39\"},{\"id_application_action\":\"41\",\"action\":\"41\",\"name\":\"View Customer\",\"uid\":\"40\"},{\"id_application_action\":\"43\",\"action\":\"43\",\"name\":\"Create Customer\",\"uid\":\"41\"},{\"id_application_action\":\"44\",\"action\":\"44\",\"name\":\"Edit Customer\",\"uid\":\"42\"},{\"id_application_action\":\"45\",\"action\":\"45\",\"name\":\"Delete Customer\",\"uid\":\"43\"},{\"id_application_action\":\"46\",\"action\":\"46\",\"name\":\"Save\\/Edit Customer\",\"uid\":\"44\"},{\"id_application_action\":\"47\",\"action\":\"47\",\"name\":\"View Warehouse\",\"uid\":\"45\"},{\"id_application_action\":\"48\",\"action\":\"48\",\"name\":\"Create Warehouse\",\"uid\":\"46\"},{\"id_application_action\":\"49\",\"action\":\"49\",\"name\":\"Edit Warehouse\",\"uid\":\"47\"},{\"id_application_action\":\"50\",\"action\":\"50\",\"name\":\"Delete Warehouse\",\"uid\":\"48\"},{\"id_application_action\":\"51\",\"action\":\"51\",\"name\":\"Save\\/Edit Warehouse\",\"uid\":\"49\"},{\"id_application_action\":\"57\",\"action\":\"57\",\"name\":\"View PO\",\"uid\":\"50\"},{\"id_application_action\":\"58\",\"action\":\"58\",\"name\":\"Create PO\",\"uid\":\"51\"},{\"id_application_action\":\"59\",\"action\":\"59\",\"name\":\"Edit PO\",\"uid\":\"52\"},{\"id_application_action\":\"60\",\"action\":\"60\",\"name\":\"Delete PO\",\"uid\":\"53\"},{\"id_application_action\":\"61\",\"action\":\"61\",\"name\":\"Save\\/Edit PO\",\"uid\":\"54\"},{\"id_application_action\":\"62\",\"action\":\"62\",\"name\":\"View User\",\"uid\":\"55\"},{\"id_application_action\":\"63\",\"action\":\"63\",\"name\":\"Create User\",\"uid\":\"56\"},{\"id_application_action\":\"64\",\"action\":\"64\",\"name\":\"Edit User\",\"uid\":\"57\"},{\"id_application_action\":\"65\",\"action\":\"65\",\"name\":\"Delete User\",\"uid\":\"58\"},{\"id_application_action\":\"66\",\"action\":\"66\",\"name\":\"Save\\/Edit User\",\"uid\":\"59\"},{\"id_application_action\":\"82\",\"action\":\"82\",\"name\":\"Change User Password\",\"uid\":\"60\"},{\"id_application_action\":\"93\",\"action\":\"93\",\"name\":\"View Stock\",\"uid\":\"61\"},{\"id_application_action\":\"67\",\"action\":\"67\",\"name\":\"View Good Receive\",\"uid\":\"62\"},{\"id_application_action\":\"68\",\"action\":\"68\",\"name\":\"Create Good Receive\",\"uid\":\"63\"},{\"id_application_action\":\"69\",\"action\":\"69\",\"name\":\"Edit Good Receive\",\"uid\":\"64\"},{\"id_application_action\":\"70\",\"action\":\"70\",\"name\":\"Delete Good Receive\",\"uid\":\"65\"},{\"id_application_action\":\"71\",\"action\":\"71\",\"name\":\"Save\\/Edit Good Receive\",\"uid\":\"66\"},{\"id_application_action\":\"72\",\"action\":\"72\",\"name\":\"View Sales Order\",\"uid\":\"67\"},{\"id_application_action\":\"73\",\"action\":\"73\",\"name\":\"Create Sales Order\",\"uid\":\"68\"},{\"id_application_action\":\"74\",\"action\":\"74\",\"name\":\"Edit Sales Order\",\"uid\":\"69\"},{\"id_application_action\":\"75\",\"action\":\"75\",\"name\":\"Delete Sales Order\",\"uid\":\"70\"},{\"id_application_action\":\"76\",\"action\":\"76\",\"name\":\"Save Sales Order\",\"uid\":\"71\"},{\"id_application_action\":\"77\",\"action\":\"77\",\"name\":\"View Material Request\",\"uid\":\"72\"},{\"id_application_action\":\"78\",\"action\":\"78\",\"name\":\"Create Material Request\",\"uid\":\"73\"},{\"id_application_action\":\"79\",\"action\":\"79\",\"name\":\"Edit Material Request\",\"uid\":\"74\"},{\"id_application_action\":\"80\",\"action\":\"80\",\"name\":\"Delete Material Request\",\"uid\":\"75\"},{\"id_application_action\":\"81\",\"action\":\"81\",\"name\":\"Save Material Request\",\"uid\":\"76\"},{\"id_application_action\":\"83\",\"action\":\"83\",\"name\":\"View Delivery Note\",\"uid\":\"77\"},{\"id_application_action\":\"84\",\"action\":\"84\",\"name\":\"Create Delivery Note\",\"uid\":\"78\"},{\"id_application_action\":\"85\",\"action\":\"85\",\"name\":\"Edit Delivery Note\",\"uid\":\"79\"},{\"id_application_action\":\"86\",\"action\":\"86\",\"name\":\"Delete Delivery Note\",\"uid\":\"80\"},{\"id_application_action\":\"87\",\"action\":\"87\",\"name\":\"Save\\/Edit Delivery Note\",\"uid\":\"81\"},{\"id_application_action\":\"88\",\"action\":\"88\",\"name\":\"View Unit Measure\",\"uid\":\"82\"},{\"id_application_action\":\"89\",\"action\":\"89\",\"name\":\"Create Unit Measure\",\"uid\":\"83\"},{\"id_application_action\":\"90\",\"action\":\"90\",\"name\":\"Edit Unit Measure\",\"uid\":\"84\"},{\"id_application_action\":\"91\",\"action\":\"91\",\"name\":\"Delete Unit Measure\",\"uid\":\"85\"},{\"id_application_action\":\"92\",\"action\":\"92\",\"name\":\"Save\\/Edit Unit Measure\",\"uid\":\"86\"},{\"id_application_action\":\"94\",\"action\":\"94\",\"name\":\"View Employee\",\"uid\":\"87\"},{\"id_application_action\":\"95\",\"action\":\"95\",\"name\":\"Create Employee\",\"uid\":\"88\"},{\"id_application_action\":\"96\",\"action\":\"96\",\"name\":\"Edit Employee\",\"uid\":\"89\"},{\"id_application_action\":\"97\",\"action\":\"97\",\"name\":\"Delete Employee\",\"uid\":\"90\"},{\"id_application_action\":\"98\",\"action\":\"98\",\"name\":\"Save\\/Edit Employee\",\"uid\":\"91\"},{\"id_application_action\":\"99\",\"action\":\"99\",\"name\":\"Validate PO\",\"uid\":\"92\"},{\"id_application_action\":\"100\",\"action\":\"100\",\"name\":\"Create Database Interface\",\"uid\":\"93\"},{\"id_application_action\":\"101\",\"action\":\"101\",\"name\":\"Edit Database Interface\",\"uid\":\"94\"},{\"id_application_action\":\"102\",\"action\":\"102\",\"name\":\"Delete Database Interface\",\"uid\":\"95\"},{\"id_application_action\":\"103\",\"action\":\"103\",\"name\":\"Save \\/ Edit Database Interface\",\"uid\":\"96\"},{\"id_application_action\":\"104\",\"action\":\"104\",\"name\":\"View Database Field Interface\",\"uid\":\"97\"},{\"id_application_action\":\"105\",\"action\":\"105\",\"name\":\"Create Database Field Interface\",\"uid\":\"98\"},{\"id_application_action\":\"106\",\"action\":\"106\",\"name\":\"Edit Database Field Interface\",\"uid\":\"99\"},{\"id_application_action\":\"107\",\"action\":\"107\",\"name\":\"Delete Database Field Interface\",\"uid\":\"100\"},{\"id_application_action\":\"108\",\"action\":\"108\",\"name\":\"Save \\/ Edit Database Field Interface\",\"uid\":\"101\"},{\"id_application_action\":\"109\",\"action\":\"109\",\"name\":\"View Inquiry\",\"uid\":\"102\"},{\"id_application_action\":\"110\",\"action\":\"110\",\"name\":\"Create Inquiry\",\"uid\":\"103\"},{\"id_application_action\":\"111\",\"action\":\"111\",\"name\":\"Edit Inquiry\",\"uid\":\"104\"},{\"id_application_action\":\"112\",\"action\":\"112\",\"name\":\"Delete Inquiry\",\"uid\":\"105\"},{\"id_application_action\":\"113\",\"action\":\"113\",\"name\":\"Save\\/Edit Inquiry\",\"uid\":\"106\"},{\"id_application_action\":\"114\",\"action\":\"114\",\"name\":\"View Survey \\/ Assessment\",\"uid\":\"107\"},{\"id_application_action\":\"115\",\"action\":\"115\",\"name\":\"Create Survey \\/ Assessment\",\"uid\":\"108\"},{\"id_application_action\":\"116\",\"action\":\"116\",\"name\":\"Edit Survey \\/ Assessment\",\"uid\":\"109\"},{\"id_application_action\":\"117\",\"action\":\"117\",\"name\":\"Delete Survey \\/ Assessment\",\"uid\":\"110\"},{\"id_application_action\":\"118\",\"action\":\"118\",\"name\":\"Save\\/Edit Survey \\/ Assessment\",\"uid\":\"111\"},{\"id_application_action\":\"119\",\"action\":\"119\",\"name\":\"View Quotation\",\"uid\":\"112\"},{\"id_application_action\":\"120\",\"action\":\"120\",\"name\":\"Create Quotation\",\"uid\":\"113\"},{\"id_application_action\":\"121\",\"action\":\"121\",\"name\":\"Edit Quotation\",\"uid\":\"114\"},{\"id_application_action\":\"122\",\"action\":\"122\",\"name\":\"Delete Quotation\",\"uid\":\"115\"},{\"id_application_action\":\"123\",\"action\":\"123\",\"name\":\"Save\\/Edit Quotation\",\"uid\":\"116\"},{\"id_application_action\":\"124\",\"action\":\"124\",\"name\":\"View Project Contract\",\"uid\":\"117\"},{\"id_application_action\":\"125\",\"action\":\"125\",\"name\":\"Create Project Contract\",\"uid\":\"118\"},{\"id_application_action\":\"126\",\"action\":\"126\",\"name\":\"Edit Project Contract\",\"uid\":\"119\"},{\"id_application_action\":\"127\",\"action\":\"127\",\"name\":\"Delete Project Contract\",\"uid\":\"120\"},{\"id_application_action\":\"128\",\"action\":\"128\",\"name\":\"Save\\/Edit Project Contract\",\"uid\":\"121\"},{\"id_application_action\":\"129\",\"action\":\"129\",\"name\":\"View Work Order\",\"uid\":\"122\"},{\"id_application_action\":\"130\",\"action\":\"130\",\"name\":\"Create Work Order\",\"uid\":\"123\"},{\"id_application_action\":\"131\",\"action\":\"131\",\"name\":\"Edit Work Order\",\"uid\":\"124\"},{\"id_application_action\":\"132\",\"action\":\"132\",\"name\":\"Delete Work Order\",\"uid\":\"125\"},{\"id_application_action\":\"133\",\"action\":\"133\",\"name\":\"Save\\/Edit Work Order\",\"uid\":\"126\"},{\"id_application_action\":\"134\",\"action\":\"134\",\"name\":\"View Assessment Template\",\"uid\":\"127\"},{\"id_application_action\":\"135\",\"action\":\"135\",\"name\":\"Create Assessment Template\",\"uid\":\"128\"},{\"id_application_action\":\"136\",\"action\":\"136\",\"name\":\"Edit Assessment Template\",\"uid\":\"129\"},{\"id_application_action\":\"137\",\"action\":\"137\",\"name\":\"Delete Assessment Template\",\"uid\":\"130\"},{\"id_application_action\":\"138\",\"action\":\"138\",\"name\":\"Save\\/Edit Assessment Template\",\"uid\":\"131\"},{\"id_application_action\":\"139\",\"action\":\"139\",\"name\":\"View Contract Template\",\"uid\":\"132\"},{\"id_application_action\":\"140\",\"action\":\"140\",\"name\":\"Create Contract Template\",\"uid\":\"133\"},{\"id_application_action\":\"141\",\"action\":\"141\",\"name\":\"Edit Contract Template\",\"uid\":\"134\"},{\"id_application_action\":\"142\",\"action\":\"142\",\"name\":\"Delete Contract Template\",\"uid\":\"135\"},{\"id_application_action\":\"143\",\"action\":\"143\",\"name\":\"Save\\/Edit Contract Template\",\"uid\":\"136\"},{\"id_application_action\":\"144\",\"action\":\"144\",\"name\":\"View Work Schedule\",\"uid\":\"137\"},{\"id_application_action\":\"145\",\"action\":\"145\",\"name\":\"Create Work Schedule\",\"uid\":\"138\"},{\"id_application_action\":\"146\",\"action\":\"146\",\"name\":\"Edit Work Schedule\",\"uid\":\"139\"},{\"id_application_action\":\"147\",\"action\":\"147\",\"name\":\"Delete Work Schedule\",\"uid\":\"140\"},{\"id_application_action\":\"148\",\"action\":\"148\",\"name\":\"Save\\/Edit Work Schedule\",\"uid\":\"141\"},{\"id_application_action\":\"149\",\"action\":\"149\",\"name\":\"View SO Assignment\",\"uid\":\"142\"},{\"id_application_action\":\"150\",\"action\":\"150\",\"name\":\"Create SO Assignment\",\"uid\":\"143\"},{\"id_application_action\":\"151\",\"action\":\"151\",\"name\":\"Edit SO Assignment\",\"uid\":\"144\"},{\"id_application_action\":\"152\",\"action\":\"152\",\"name\":\"Delete SO Assignment\",\"uid\":\"145\"},{\"id_application_action\":\"153\",\"action\":\"153\",\"name\":\"Save\\/Edit SO Assignment\",\"uid\":\"146\"},{\"id_application_action\":\"154\",\"action\":\"154\",\"name\":\"View Shift Change\",\"uid\":\"147\"},{\"id_application_action\":\"155\",\"action\":\"155\",\"name\":\"Create Shift Change\",\"uid\":\"148\"},{\"id_application_action\":\"156\",\"action\":\"156\",\"name\":\"Edit Shift Change\",\"uid\":\"149\"},{\"id_application_action\":\"223\",\"action\":\"223\",\"name\":\"Save\\/Edit Salary Setting\",\"uid\":\"150\"},{\"id_application_action\":\"222\",\"action\":\"222\",\"name\":\"Delete Salary Setting\",\"uid\":\"151\"},{\"id_application_action\":\"221\",\"action\":\"221\",\"name\":\"Edit Salary Setting\",\"uid\":\"152\"},{\"id_application_action\":\"220\",\"action\":\"220\",\"name\":\"Create Salary Setting\",\"uid\":\"153\"},{\"id_application_action\":\"219\",\"action\":\"219\",\"name\":\"View Salary Setting\",\"uid\":\"154\"},{\"id_application_action\":\"157\",\"action\":\"157\",\"name\":\"Delete Shift Change\",\"uid\":\"155\"},{\"id_application_action\":\"158\",\"action\":\"158\",\"name\":\"Save\\/Edit Shift Change\",\"uid\":\"156\"},{\"id_application_action\":\"159\",\"action\":\"159\",\"name\":\"View Leave Application\",\"uid\":\"157\"},{\"id_application_action\":\"160\",\"action\":\"160\",\"name\":\"Create Leave Application\",\"uid\":\"158\"},{\"id_application_action\":\"161\",\"action\":\"161\",\"name\":\"Edit Leave Application\",\"uid\":\"159\"},{\"id_application_action\":\"162\",\"action\":\"162\",\"name\":\"Delete Leave Application\",\"uid\":\"160\"},{\"id_application_action\":\"163\",\"action\":\"163\",\"name\":\"Save\\/Edit Leave Application\",\"uid\":\"161\"},{\"id_application_action\":\"164\",\"action\":\"164\",\"name\":\"View Timesheet (Recap)\",\"uid\":\"162\"},{\"id_application_action\":\"165\",\"action\":\"165\",\"name\":\"Create Timesheet (Recap)\",\"uid\":\"163\"},{\"id_application_action\":\"166\",\"action\":\"166\",\"name\":\"Edit Timesheet (Recap)\",\"uid\":\"164\"},{\"id_application_action\":\"167\",\"action\":\"167\",\"name\":\"Delete Timesheet (Recap)\",\"uid\":\"165\"},{\"id_application_action\":\"168\",\"action\":\"168\",\"name\":\"Save\\/Edit Timesheet (Recap)\",\"uid\":\"166\"},{\"id_application_action\":\"169\",\"action\":\"169\",\"name\":\"View SO Timesheet\",\"uid\":\"167\"},{\"id_application_action\":\"170\",\"action\":\"170\",\"name\":\"Create SO Timesheet\",\"uid\":\"168\"},{\"id_application_action\":\"171\",\"action\":\"171\",\"name\":\"Edit SO Timesheet\",\"uid\":\"169\"},{\"id_application_action\":\"172\",\"action\":\"172\",\"name\":\"Delete SO Timesheet\",\"uid\":\"170\"},{\"id_application_action\":\"173\",\"action\":\"173\",\"name\":\"Save\\/Edit SO Timesheet\",\"uid\":\"171\"},{\"id_application_action\":\"174\",\"action\":\"174\",\"name\":\"View Incident Report\",\"uid\":\"172\"},{\"id_application_action\":\"175\",\"action\":\"175\",\"name\":\"Create Incident Report\",\"uid\":\"173\"},{\"id_application_action\":\"176\",\"action\":\"176\",\"name\":\"Edit Incident Report\",\"uid\":\"174\"},{\"id_application_action\":\"177\",\"action\":\"177\",\"name\":\"Delete Incident Report\",\"uid\":\"175\"},{\"id_application_action\":\"178\",\"action\":\"178\",\"name\":\"Save\\/Edit Incident Report\",\"uid\":\"176\"},{\"id_application_action\":\"179\",\"action\":\"179\",\"name\":\"View Payroll\",\"uid\":\"177\"},{\"id_application_action\":\"180\",\"action\":\"180\",\"name\":\"Create Payroll\",\"uid\":\"178\"},{\"id_application_action\":\"181\",\"action\":\"181\",\"name\":\"Edit Payroll\",\"uid\":\"179\"},{\"id_application_action\":\"182\",\"action\":\"182\",\"name\":\"Delete Payroll\",\"uid\":\"180\"},{\"id_application_action\":\"183\",\"action\":\"183\",\"name\":\"Save\\/Edit Payroll\",\"uid\":\"181\"},{\"id_application_action\":\"184\",\"action\":\"184\",\"name\":\"View Supplier Invoice\",\"uid\":\"182\"},{\"id_application_action\":\"185\",\"action\":\"185\",\"name\":\"Create Supplier Invoice\",\"uid\":\"183\"},{\"id_application_action\":\"186\",\"action\":\"186\",\"name\":\"Edit Supplier Invoice\",\"uid\":\"184\"},{\"id_application_action\":\"187\",\"action\":\"187\",\"name\":\"Delete Supplier Invoice\",\"uid\":\"185\"},{\"id_application_action\":\"188\",\"action\":\"188\",\"name\":\"Save\\/Edit Supplier Invoice\",\"uid\":\"186\"},{\"id_application_action\":\"189\",\"action\":\"189\",\"name\":\"View Customer Invoice\",\"uid\":\"187\"},{\"id_application_action\":\"190\",\"action\":\"190\",\"name\":\"Create Customer Invoice\",\"uid\":\"188\"},{\"id_application_action\":\"191\",\"action\":\"191\",\"name\":\"Edit Customer Invoice\",\"uid\":\"189\"},{\"id_application_action\":\"192\",\"action\":\"192\",\"name\":\"Delete Customer Invoice\",\"uid\":\"190\"},{\"id_application_action\":\"193\",\"action\":\"193\",\"name\":\"Save\\/Edit Customer Invoice\",\"uid\":\"191\"},{\"id_application_action\":\"194\",\"action\":\"194\",\"name\":\"View Bank Statement\",\"uid\":\"192\"},{\"id_application_action\":\"195\",\"action\":\"195\",\"name\":\"Create Bank Statement\",\"uid\":\"193\"},{\"id_application_action\":\"196\",\"action\":\"196\",\"name\":\"Edit Bank Statement\",\"uid\":\"194\"},{\"id_application_action\":\"197\",\"action\":\"197\",\"name\":\"Delete Bank Statement\",\"uid\":\"195\"},{\"id_application_action\":\"198\",\"action\":\"198\",\"name\":\"Save\\/Edit Bank Statement\",\"uid\":\"196\"},{\"id_application_action\":\"199\",\"action\":\"199\",\"name\":\"View Cash Register\",\"uid\":\"197\"},{\"id_application_action\":\"200\",\"action\":\"200\",\"name\":\"Create Cash Register\",\"uid\":\"198\"},{\"id_application_action\":\"201\",\"action\":\"201\",\"name\":\"Edit Cash Register\",\"uid\":\"199\"},{\"id_application_action\":\"202\",\"action\":\"202\",\"name\":\"Delete Cash Register\",\"uid\":\"200\"},{\"id_application_action\":\"203\",\"action\":\"203\",\"name\":\"Save\\/Edit Cash Register\",\"uid\":\"201\"},{\"id_application_action\":\"204\",\"action\":\"204\",\"name\":\"View Tax\",\"uid\":\"202\"},{\"id_application_action\":\"205\",\"action\":\"205\",\"name\":\"Create Tax\",\"uid\":\"203\"},{\"id_application_action\":\"206\",\"action\":\"206\",\"name\":\"Edit Tax\",\"uid\":\"204\"},{\"id_application_action\":\"207\",\"action\":\"207\",\"name\":\"Delete Tax\",\"uid\":\"205\"},{\"id_application_action\":\"208\",\"action\":\"208\",\"name\":\"Save\\/Edit Tax\",\"uid\":\"206\"},{\"id_application_action\":\"209\",\"action\":\"209\",\"name\":\"View Chart of Account\",\"uid\":\"207\"},{\"id_application_action\":\"210\",\"action\":\"210\",\"name\":\"Create Chart of Account\",\"uid\":\"208\"},{\"id_application_action\":\"211\",\"action\":\"211\",\"name\":\"Edit Chart of Account\",\"uid\":\"209\"},{\"id_application_action\":\"212\",\"action\":\"212\",\"name\":\"Delete Chart of Account\",\"uid\":\"210\"},{\"id_application_action\":\"213\",\"action\":\"213\",\"name\":\"Save\\/Edit Chart of Account\",\"uid\":\"211\"},{\"id_application_action\":\"214\",\"action\":\"214\",\"name\":\"View Employee Salary\",\"uid\":\"212\"},{\"id_application_action\":\"215\",\"action\":\"215\",\"name\":\"Create Employee Salary\",\"uid\":\"213\"},{\"id_application_action\":\"216\",\"action\":\"216\",\"name\":\"Edit Employee Salary\",\"uid\":\"214\"},{\"id_application_action\":\"217\",\"action\":\"217\",\"name\":\"Delete Employee Salary\",\"uid\":\"215\"},{\"id_application_action\":\"218\",\"action\":\"218\",\"name\":\"Save\\/Edit Employee Salary\",\"uid\":\"216\"},{\"id_application_action\":\"224\",\"name\":\"View Database Interface\",\"uid\":\"217\",\"id\":\"217\"}],\"is_edit\":\"true\",\"id_role\":\"1\"}', '2015-01-02 09:52:35');
INSERT INTO `activity_log` VALUES ('30', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"Pick Assessment Template\",\"controller\":\"assessment_template\",\"function_exec\":\"init_pick_assessment_template\",\"function_args\":\"\",\"view_type\":\"form\",\"view_file\":\"assessment_template_dialog\",\"prefix\":\"\",\"action_type\":\"view\",\"action_button\":\"crud\",\"target_action\":\"115\",\"use_log\":\"0\",\"is_edit\":\"false\",\"id_edit\":\"\"}', '2015-01-03 11:00:14');
INSERT INTO `activity_log` VALUES ('31', 'Delete Side Menu', 'side_menu', null, '2', 'Delete Side Menu', '8', '{}', '2015-01-03 23:42:15');
INSERT INTO `activity_log` VALUES ('32', 'Save/Edit Side Menu', 'side_menu', null, '2', 'Save/Edit Side Menu', '9', '{}', '2015-01-03 23:42:37');
INSERT INTO `activity_log` VALUES ('33', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"Create Customer\",\"controller\":\"customer\",\"function_exec\":\"init_create_customer\",\"function_args\":\"\",\"view_type\":\"form\",\"view_file\":\"customer_ce\",\"prefix\":\"\",\"action_type\":\"view\",\"action_button\":\"save_discard\",\"target_action\":\"\",\"use_log\":\"0\",\"is_edit\":\"true\",\"id_edit\":\"43\"}', '2015-01-04 09:10:18');
INSERT INTO `activity_log` VALUES ('34', 'Save/Edit Customer', 'customer', null, '2', 'Save/Edit Customer', '46', '{}', '2015-01-04 10:03:30');
INSERT INTO `activity_log` VALUES ('35', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"View Organisation Structure\",\"controller\":\"organisation_structure\",\"function_exec\":\"\",\"function_args\":\"\",\"view_type\":\"gridview\",\"view_file\":\"organisation_structure_list\",\"prefix\":\"\",\"action_type\":\"view\",\"action_button\":\"crud\",\"target_action\":\"\",\"use_log\":\"0\",\"is_edit\":\"false\",\"id_edit\":\"\"}', '2015-01-05 14:13:37');
INSERT INTO `activity_log` VALUES ('36', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"Create Organisation Structure\",\"controller\":\"organisation_structure\",\"function_exec\":\"init_create_organisation_structure\",\"function_args\":\"\",\"view_type\":\"form\",\"view_file\":\"organisation_structure_ce\",\"prefix\":\"\",\"action_type\":\"view\",\"action_button\":\"save_discard\",\"target_action\":\"\",\"use_log\":\"0\",\"is_edit\":\"false\",\"id_edit\":\"\"}', '2015-01-05 14:16:38');
INSERT INTO `activity_log` VALUES ('37', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"Edit Organisation Structure\",\"controller\":\"organisation_structure\",\"function_exec\":\"init_edit_organisation_structure\",\"function_args\":\"id\",\"view_type\":\"form\",\"view_file\":\"organisation_structure_ce\",\"prefix\":\"\",\"action_type\":\"view\",\"action_button\":\"save_discard\",\"target_action\":\"\",\"use_log\":\"0\",\"is_edit\":\"false\",\"id_edit\":\"\"}', '2015-01-05 14:42:21');
INSERT INTO `activity_log` VALUES ('38', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"Delete Organisation Structure\",\"controller\":\"organisation_structure\",\"function_exec\":\"delete_organisation_structure\",\"function_args\":\"\",\"view_type\":\"no_view\",\"view_file\":\"\",\"prefix\":\"\",\"action_type\":\"delete\",\"action_button\":\"crud\",\"target_action\":\"226\",\"use_log\":\"1\",\"is_edit\":\"false\",\"id_edit\":\"\"}', '2015-01-05 14:48:55');
INSERT INTO `activity_log` VALUES ('39', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"Save\\/Edit Organisation Structure\",\"controller\":\"organisation_structure\",\"function_exec\":\"save_organisation_structure\",\"function_args\":\"\",\"view_type\":\"no_view\",\"view_file\":\"\",\"prefix\":\"\",\"action_type\":\"create\",\"action_button\":\"crud\",\"target_action\":\"226\",\"use_log\":\"1\",\"is_edit\":\"false\",\"id_edit\":\"\"}', '2015-01-05 15:29:41');
INSERT INTO `activity_log` VALUES ('40', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"View Position Level\",\"controller\":\"position_level\",\"function_exec\":\"\",\"function_args\":\"\",\"view_type\":\"gridview\",\"view_file\":\"position_level_list\",\"prefix\":\"\",\"action_type\":\"view\",\"action_button\":\"crud\",\"target_action\":\"\",\"use_log\":\"0\",\"is_edit\":\"false\",\"id_edit\":\"\"}', '2015-01-05 15:30:41');
INSERT INTO `activity_log` VALUES ('41', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"Create Position Level\",\"controller\":\"position_level\",\"function_exec\":\"init_create_position_level\",\"function_args\":\"\",\"view_type\":\"form\",\"view_file\":\"position_level_ce\",\"prefix\":\"\",\"action_type\":\"view\",\"action_button\":\"crud\",\"target_action\":\"\",\"use_log\":\"0\",\"is_edit\":\"false\",\"id_edit\":\"\"}', '2015-01-05 21:41:56');
INSERT INTO `activity_log` VALUES ('42', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"Edit Position Level\",\"controller\":\"position_level\",\"function_exec\":\"init_edit_position_level\",\"function_args\":\"id\",\"view_type\":\"form\",\"view_file\":\"position_level_ce\",\"prefix\":\"\",\"action_type\":\"view\",\"action_button\":\"save_discard\",\"target_action\":\"\",\"use_log\":\"0\",\"is_edit\":\"false\",\"id_edit\":\"\"}', '2015-01-05 21:42:32');
INSERT INTO `activity_log` VALUES ('43', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"Create Position Level\",\"controller\":\"position_level\",\"function_exec\":\"init_create_position_level\",\"function_args\":\"\",\"view_type\":\"form\",\"view_file\":\"position_level_ce\",\"prefix\":\"\",\"action_type\":\"view\",\"action_button\":\"save_discard\",\"target_action\":\"\",\"use_log\":\"0\",\"is_edit\":\"true\",\"id_edit\":\"232\"}', '2015-01-05 21:42:46');
INSERT INTO `activity_log` VALUES ('44', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"Delete Position Level\",\"controller\":\"position_level\",\"function_exec\":\"delete_position_level\",\"function_args\":\"\",\"view_type\":\"no_view\",\"view_file\":\"\",\"prefix\":\"\",\"action_type\":\"view\",\"action_button\":\"crud\",\"target_action\":\"231\",\"use_log\":\"1\",\"is_edit\":\"false\",\"id_edit\":\"\"}', '2015-01-05 22:11:28');
INSERT INTO `activity_log` VALUES ('45', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"Save\\/Edit Position Level\",\"controller\":\"position_level\",\"function_exec\":\"save_position_level\",\"function_args\":\"\",\"view_type\":\"no_view\",\"view_file\":\"\",\"prefix\":\"\",\"action_type\":\"create\",\"action_button\":\"crud\",\"target_action\":\"231\",\"use_log\":\"1\",\"is_edit\":\"false\",\"id_edit\":\"\"}', '2015-01-05 22:13:44');
INSERT INTO `activity_log` VALUES ('46', 'Save/Edit Role', 'role', null, '2', 'Save/Edit Role', '20', '{\"name\":\"administrator\",\"action_detail\":[{\"id_application_action\":\"1\",\"action\":\"1\",\"name\":\"View Application Action\",\"uid\":\"0\"},{\"id_application_action\":\"2\",\"action\":\"2\",\"name\":\"Create Application Action\",\"uid\":\"1\"},{\"id_application_action\":\"3\",\"action\":\"3\",\"name\":\"Edit Application Action\",\"uid\":\"2\"},{\"id_application_action\":\"4\",\"action\":\"4\",\"name\":\"Delete Application Action\",\"uid\":\"3\"},{\"id_application_action\":\"5\",\"action\":\"5\",\"name\":\"View Side Menu\",\"uid\":\"4\"},{\"id_application_action\":\"6\",\"action\":\"6\",\"name\":\"Create Side Menu\",\"uid\":\"5\"},{\"id_application_action\":\"7\",\"action\":\"7\",\"name\":\"Edit Side Menu\",\"uid\":\"6\"},{\"id_application_action\":\"8\",\"action\":\"8\",\"name\":\"Delete Side Menu\",\"uid\":\"7\"},{\"id_application_action\":\"9\",\"action\":\"9\",\"name\":\"Save\\/Edit Side Menu\",\"uid\":\"8\"},{\"id_application_action\":\"10\",\"action\":\"10\",\"name\":\"Save\\/Edit Action\",\"uid\":\"9\"},{\"id_application_action\":\"11\",\"action\":\"11\",\"name\":\"View Division\",\"uid\":\"10\"},{\"id_application_action\":\"12\",\"action\":\"12\",\"name\":\"Create Division\",\"uid\":\"11\"},{\"id_application_action\":\"13\",\"action\":\"13\",\"name\":\"Save\\/Edit Division\",\"uid\":\"12\"},{\"id_application_action\":\"14\",\"action\":\"14\",\"name\":\"Edit Division\",\"uid\":\"13\"},{\"id_application_action\":\"15\",\"action\":\"15\",\"name\":\"Delete Division\",\"uid\":\"14\"},{\"id_application_action\":\"16\",\"action\":\"16\",\"name\":\"View Role\",\"uid\":\"15\"},{\"id_application_action\":\"17\",\"action\":\"17\",\"name\":\"View Create Role\",\"uid\":\"16\"},{\"id_application_action\":\"18\",\"action\":\"18\",\"name\":\"View Edit Role\",\"uid\":\"17\"},{\"id_application_action\":\"19\",\"action\":\"19\",\"name\":\"Delete Role\",\"uid\":\"18\"},{\"id_application_action\":\"20\",\"action\":\"20\",\"name\":\"Save\\/Edit Role\",\"uid\":\"19\"},{\"id_application_action\":\"21\",\"action\":\"21\",\"name\":\"View Product\",\"uid\":\"20\"},{\"id_application_action\":\"22\",\"action\":\"22\",\"name\":\"Create Product\",\"uid\":\"21\"},{\"id_application_action\":\"23\",\"action\":\"23\",\"name\":\"Edit Product\",\"uid\":\"22\"},{\"id_application_action\":\"24\",\"action\":\"24\",\"name\":\"Delete Product\",\"uid\":\"23\"},{\"id_application_action\":\"25\",\"action\":\"25\",\"name\":\"Save\\/Edit Product\",\"uid\":\"24\"},{\"id_application_action\":\"26\",\"action\":\"26\",\"name\":\"View Supplier\",\"uid\":\"25\"},{\"id_application_action\":\"27\",\"action\":\"27\",\"name\":\"Create Supplier\",\"uid\":\"26\"},{\"id_application_action\":\"28\",\"action\":\"28\",\"name\":\"Edit Supplier\",\"uid\":\"27\"},{\"id_application_action\":\"29\",\"action\":\"29\",\"name\":\"Delete Supplier\",\"uid\":\"28\"},{\"id_application_action\":\"30\",\"action\":\"30\",\"name\":\"Save\\/Edit Supplier\",\"uid\":\"29\"},{\"id_application_action\":\"31\",\"action\":\"31\",\"name\":\"View Product Category\",\"uid\":\"30\"},{\"id_application_action\":\"32\",\"action\":\"32\",\"name\":\"Create Product Category\",\"uid\":\"31\"},{\"id_application_action\":\"33\",\"action\":\"33\",\"name\":\"Edit Product Category\",\"uid\":\"32\"},{\"id_application_action\":\"34\",\"action\":\"34\",\"name\":\"Delete Product Category\",\"uid\":\"33\"},{\"id_application_action\":\"35\",\"action\":\"35\",\"name\":\"Save\\/Edit Product Category\",\"uid\":\"34\"},{\"id_application_action\":\"36\",\"action\":\"36\",\"name\":\"View Merk\",\"uid\":\"35\"},{\"id_application_action\":\"37\",\"action\":\"37\",\"name\":\"Create Merk\",\"uid\":\"36\"},{\"id_application_action\":\"38\",\"action\":\"38\",\"name\":\"Edit Merk\",\"uid\":\"37\"},{\"id_application_action\":\"39\",\"action\":\"39\",\"name\":\"Delete Merk\",\"uid\":\"38\"},{\"id_application_action\":\"40\",\"action\":\"40\",\"name\":\"Save\\/Edit Merk\",\"uid\":\"39\"},{\"id_application_action\":\"41\",\"action\":\"41\",\"name\":\"View Customer\",\"uid\":\"40\"},{\"id_application_action\":\"43\",\"action\":\"43\",\"name\":\"Create Customer\",\"uid\":\"41\"},{\"id_application_action\":\"44\",\"action\":\"44\",\"name\":\"Edit Customer\",\"uid\":\"42\"},{\"id_application_action\":\"45\",\"action\":\"45\",\"name\":\"Delete Customer\",\"uid\":\"43\"},{\"id_application_action\":\"46\",\"action\":\"46\",\"name\":\"Save\\/Edit Customer\",\"uid\":\"44\"},{\"id_application_action\":\"47\",\"action\":\"47\",\"name\":\"View Warehouse\",\"uid\":\"45\"},{\"id_application_action\":\"48\",\"action\":\"48\",\"name\":\"Create Warehouse\",\"uid\":\"46\"},{\"id_application_action\":\"49\",\"action\":\"49\",\"name\":\"Edit Warehouse\",\"uid\":\"47\"},{\"id_application_action\":\"50\",\"action\":\"50\",\"name\":\"Delete Warehouse\",\"uid\":\"48\"},{\"id_application_action\":\"51\",\"action\":\"51\",\"name\":\"Save\\/Edit Warehouse\",\"uid\":\"49\"},{\"id_application_action\":\"57\",\"action\":\"57\",\"name\":\"View PO\",\"uid\":\"50\"},{\"id_application_action\":\"58\",\"action\":\"58\",\"name\":\"Create PO\",\"uid\":\"51\"},{\"id_application_action\":\"59\",\"action\":\"59\",\"name\":\"Edit PO\",\"uid\":\"52\"},{\"id_application_action\":\"60\",\"action\":\"60\",\"name\":\"Delete PO\",\"uid\":\"53\"},{\"id_application_action\":\"61\",\"action\":\"61\",\"name\":\"Save\\/Edit PO\",\"uid\":\"54\"},{\"id_application_action\":\"62\",\"action\":\"62\",\"name\":\"View User\",\"uid\":\"55\"},{\"id_application_action\":\"63\",\"action\":\"63\",\"name\":\"Create User\",\"uid\":\"56\"},{\"id_application_action\":\"64\",\"action\":\"64\",\"name\":\"Edit User\",\"uid\":\"57\"},{\"id_application_action\":\"65\",\"action\":\"65\",\"name\":\"Delete User\",\"uid\":\"58\"},{\"id_application_action\":\"66\",\"action\":\"66\",\"name\":\"Save\\/Edit User\",\"uid\":\"59\"},{\"id_application_action\":\"67\",\"action\":\"67\",\"name\":\"View Good Receive\",\"uid\":\"60\"},{\"id_application_action\":\"68\",\"action\":\"68\",\"name\":\"Create Good Receive\",\"uid\":\"61\"},{\"id_application_action\":\"69\",\"action\":\"69\",\"name\":\"Edit Good Receive\",\"uid\":\"62\"},{\"id_application_action\":\"70\",\"action\":\"70\",\"name\":\"Delete Good Receive\",\"uid\":\"63\"},{\"id_application_action\":\"71\",\"action\":\"71\",\"name\":\"Save\\/Edit Good Receive\",\"uid\":\"64\"},{\"id_application_action\":\"72\",\"action\":\"72\",\"name\":\"View Sales Order\",\"uid\":\"65\"},{\"id_application_action\":\"73\",\"action\":\"73\",\"name\":\"Create Sales Order\",\"uid\":\"66\"},{\"id_application_action\":\"74\",\"action\":\"74\",\"name\":\"Edit Sales Order\",\"uid\":\"67\"},{\"id_application_action\":\"75\",\"action\":\"75\",\"name\":\"Delete Sales Order\",\"uid\":\"68\"},{\"id_application_action\":\"76\",\"action\":\"76\",\"name\":\"Save Sales Order\",\"uid\":\"69\"},{\"id_application_action\":\"77\",\"action\":\"77\",\"name\":\"View Material Request\",\"uid\":\"70\"},{\"id_application_action\":\"78\",\"action\":\"78\",\"name\":\"Create Material Request\",\"uid\":\"71\"},{\"id_application_action\":\"79\",\"action\":\"79\",\"name\":\"Edit Material Request\",\"uid\":\"72\"},{\"id_application_action\":\"80\",\"action\":\"80\",\"name\":\"Delete Material Request\",\"uid\":\"73\"},{\"id_application_action\":\"81\",\"action\":\"81\",\"name\":\"Save Material Request\",\"uid\":\"74\"},{\"id_application_action\":\"82\",\"action\":\"82\",\"name\":\"Change User Password\",\"uid\":\"75\"},{\"id_application_action\":\"83\",\"action\":\"83\",\"name\":\"View Delivery Note\",\"uid\":\"76\"},{\"id_application_action\":\"84\",\"action\":\"84\",\"name\":\"Create Delivery Note\",\"uid\":\"77\"},{\"id_application_action\":\"85\",\"action\":\"85\",\"name\":\"Edit Delivery Note\",\"uid\":\"78\"},{\"id_application_action\":\"86\",\"action\":\"86\",\"name\":\"Delete Delivery Note\",\"uid\":\"79\"},{\"id_application_action\":\"87\",\"action\":\"87\",\"name\":\"Save\\/Edit Delivery Note\",\"uid\":\"80\"},{\"id_application_action\":\"88\",\"action\":\"88\",\"name\":\"View Unit Measure\",\"uid\":\"81\"},{\"id_application_action\":\"89\",\"action\":\"89\",\"name\":\"Create Unit Measure\",\"uid\":\"82\"},{\"id_application_action\":\"90\",\"action\":\"90\",\"name\":\"Edit Unit Measure\",\"uid\":\"83\"},{\"id_application_action\":\"91\",\"action\":\"91\",\"name\":\"Delete Unit Measure\",\"uid\":\"84\"},{\"id_application_action\":\"92\",\"action\":\"92\",\"name\":\"Save\\/Edit Unit Measure\",\"uid\":\"85\"},{\"id_application_action\":\"93\",\"action\":\"93\",\"name\":\"View Stock\",\"uid\":\"86\"},{\"id_application_action\":\"94\",\"action\":\"94\",\"name\":\"View Employee\",\"uid\":\"87\"},{\"id_application_action\":\"95\",\"action\":\"95\",\"name\":\"Create Employee\",\"uid\":\"88\"},{\"id_application_action\":\"96\",\"action\":\"96\",\"name\":\"Edit Employee\",\"uid\":\"89\"},{\"id_application_action\":\"97\",\"action\":\"97\",\"name\":\"Delete Employee\",\"uid\":\"90\"},{\"id_application_action\":\"98\",\"action\":\"98\",\"name\":\"Save\\/Edit Employee\",\"uid\":\"91\"},{\"id_application_action\":\"99\",\"action\":\"99\",\"name\":\"Validate PO\",\"uid\":\"92\"},{\"id_application_action\":\"100\",\"action\":\"100\",\"name\":\"Create Database Interface\",\"uid\":\"93\"},{\"id_application_action\":\"101\",\"action\":\"101\",\"name\":\"Edit Database Interface\",\"uid\":\"94\"},{\"id_application_action\":\"102\",\"action\":\"102\",\"name\":\"Delete Database Interface\",\"uid\":\"95\"},{\"id_application_action\":\"103\",\"action\":\"103\",\"name\":\"Save \\/ Edit Database Interface\",\"uid\":\"96\"},{\"id_application_action\":\"104\",\"action\":\"104\",\"name\":\"View Database Field Interface\",\"uid\":\"97\"},{\"id_application_action\":\"105\",\"action\":\"105\",\"name\":\"Create Database Field Interface\",\"uid\":\"98\"},{\"id_application_action\":\"106\",\"action\":\"106\",\"name\":\"Edit Database Field Interface\",\"uid\":\"99\"},{\"id_application_action\":\"107\",\"action\":\"107\",\"name\":\"Delete Database Field Interface\",\"uid\":\"100\"},{\"id_application_action\":\"108\",\"action\":\"108\",\"name\":\"Save \\/ Edit Database Field Interface\",\"uid\":\"101\"},{\"id_application_action\":\"109\",\"action\":\"109\",\"name\":\"View Inquiry\",\"uid\":\"102\"},{\"id_application_action\":\"110\",\"action\":\"110\",\"name\":\"Create Inquiry\",\"uid\":\"103\"},{\"id_application_action\":\"111\",\"action\":\"111\",\"name\":\"Edit Inquiry\",\"uid\":\"104\"},{\"id_application_action\":\"112\",\"action\":\"112\",\"name\":\"Delete Inquiry\",\"uid\":\"105\"},{\"id_application_action\":\"113\",\"action\":\"113\",\"name\":\"Save\\/Edit Inquiry\",\"uid\":\"106\"},{\"id_application_action\":\"114\",\"action\":\"114\",\"name\":\"View Survey \\/ Assessment\",\"uid\":\"107\"},{\"id_application_action\":\"115\",\"action\":\"115\",\"name\":\"Create Survey \\/ Assessment\",\"uid\":\"108\"},{\"id_application_action\":\"116\",\"action\":\"116\",\"name\":\"Edit Survey \\/ Assessment\",\"uid\":\"109\"},{\"id_application_action\":\"117\",\"action\":\"117\",\"name\":\"Delete Survey \\/ Assessment\",\"uid\":\"110\"},{\"id_application_action\":\"118\",\"action\":\"118\",\"name\":\"Save\\/Edit Survey \\/ Assessment\",\"uid\":\"111\"},{\"id_application_action\":\"119\",\"action\":\"119\",\"name\":\"View Quotation\",\"uid\":\"112\"},{\"id_application_action\":\"120\",\"action\":\"120\",\"name\":\"Create Quotation\",\"uid\":\"113\"},{\"id_application_action\":\"121\",\"action\":\"121\",\"name\":\"Edit Quotation\",\"uid\":\"114\"},{\"id_application_action\":\"122\",\"action\":\"122\",\"name\":\"Delete Quotation\",\"uid\":\"115\"},{\"id_application_action\":\"123\",\"action\":\"123\",\"name\":\"Save\\/Edit Quotation\",\"uid\":\"116\"},{\"id_application_action\":\"124\",\"action\":\"124\",\"name\":\"View Project Contract\",\"uid\":\"117\"},{\"id_application_action\":\"125\",\"action\":\"125\",\"name\":\"Create Project Contract\",\"uid\":\"118\"},{\"id_application_action\":\"126\",\"action\":\"126\",\"name\":\"Edit Project Contract\",\"uid\":\"119\"},{\"id_application_action\":\"127\",\"action\":\"127\",\"name\":\"Delete Project Contract\",\"uid\":\"120\"},{\"id_application_action\":\"128\",\"action\":\"128\",\"name\":\"Save\\/Edit Project Contract\",\"uid\":\"121\"},{\"id_application_action\":\"129\",\"action\":\"129\",\"name\":\"View Work Order\",\"uid\":\"122\"},{\"id_application_action\":\"130\",\"action\":\"130\",\"name\":\"Create Work Order\",\"uid\":\"123\"},{\"id_application_action\":\"131\",\"action\":\"131\",\"name\":\"Edit Work Order\",\"uid\":\"124\"},{\"id_application_action\":\"132\",\"action\":\"132\",\"name\":\"Delete Work Order\",\"uid\":\"125\"},{\"id_application_action\":\"133\",\"action\":\"133\",\"name\":\"Save\\/Edit Work Order\",\"uid\":\"126\"},{\"id_application_action\":\"134\",\"action\":\"134\",\"name\":\"View Assessment Template\",\"uid\":\"127\"},{\"id_application_action\":\"135\",\"action\":\"135\",\"name\":\"Create Assessment Template\",\"uid\":\"128\"},{\"id_application_action\":\"136\",\"action\":\"136\",\"name\":\"Edit Assessment Template\",\"uid\":\"129\"},{\"id_application_action\":\"137\",\"action\":\"137\",\"name\":\"Delete Assessment Template\",\"uid\":\"130\"},{\"id_application_action\":\"138\",\"action\":\"138\",\"name\":\"Save\\/Edit Assessment Template\",\"uid\":\"131\"},{\"id_application_action\":\"139\",\"action\":\"139\",\"name\":\"View Contract Template\",\"uid\":\"132\"},{\"id_application_action\":\"140\",\"action\":\"140\",\"name\":\"Create Contract Template\",\"uid\":\"133\"},{\"id_application_action\":\"141\",\"action\":\"141\",\"name\":\"Edit Contract Template\",\"uid\":\"134\"},{\"id_application_action\":\"142\",\"action\":\"142\",\"name\":\"Delete Contract Template\",\"uid\":\"135\"},{\"id_application_action\":\"143\",\"action\":\"143\",\"name\":\"Save\\/Edit Contract Template\",\"uid\":\"136\"},{\"id_application_action\":\"144\",\"action\":\"144\",\"name\":\"View Work Schedule\",\"uid\":\"137\"},{\"id_application_action\":\"145\",\"action\":\"145\",\"name\":\"Create Work Schedule\",\"uid\":\"138\"},{\"id_application_action\":\"146\",\"action\":\"146\",\"name\":\"Edit Work Schedule\",\"uid\":\"139\"},{\"id_application_action\":\"147\",\"action\":\"147\",\"name\":\"Delete Work Schedule\",\"uid\":\"140\"},{\"id_application_action\":\"148\",\"action\":\"148\",\"name\":\"Save\\/Edit Work Schedule\",\"uid\":\"141\"},{\"id_application_action\":\"149\",\"action\":\"149\",\"name\":\"View SO Assignment\",\"uid\":\"142\"},{\"id_application_action\":\"150\",\"action\":\"150\",\"name\":\"Create SO Assignment\",\"uid\":\"143\"},{\"id_application_action\":\"151\",\"action\":\"151\",\"name\":\"Edit SO Assignment\",\"uid\":\"144\"},{\"id_application_action\":\"152\",\"action\":\"152\",\"name\":\"Delete SO Assignment\",\"uid\":\"145\"},{\"id_application_action\":\"153\",\"action\":\"153\",\"name\":\"Save\\/Edit SO Assignment\",\"uid\":\"146\"},{\"id_application_action\":\"154\",\"action\":\"154\",\"name\":\"View Shift Change\",\"uid\":\"147\"},{\"id_application_action\":\"155\",\"action\":\"155\",\"name\":\"Create Shift Change\",\"uid\":\"148\"},{\"id_application_action\":\"156\",\"action\":\"156\",\"name\":\"Edit Shift Change\",\"uid\":\"149\"},{\"id_application_action\":\"157\",\"action\":\"157\",\"name\":\"Delete Shift Change\",\"uid\":\"150\"},{\"id_application_action\":\"158\",\"action\":\"158\",\"name\":\"Save\\/Edit Shift Change\",\"uid\":\"151\"},{\"id_application_action\":\"159\",\"action\":\"159\",\"name\":\"View Leave Application\",\"uid\":\"152\"},{\"id_application_action\":\"160\",\"action\":\"160\",\"name\":\"Create Leave Application\",\"uid\":\"153\"},{\"id_application_action\":\"161\",\"action\":\"161\",\"name\":\"Edit Leave Application\",\"uid\":\"154\"},{\"id_application_action\":\"162\",\"action\":\"162\",\"name\":\"Delete Leave Application\",\"uid\":\"155\"},{\"id_application_action\":\"163\",\"action\":\"163\",\"name\":\"Save\\/Edit Leave Application\",\"uid\":\"156\"},{\"id_application_action\":\"164\",\"action\":\"164\",\"name\":\"View Timesheet (Recap)\",\"uid\":\"157\"},{\"id_application_action\":\"165\",\"action\":\"165\",\"name\":\"Create Timesheet (Recap)\",\"uid\":\"158\"},{\"id_application_action\":\"166\",\"action\":\"166\",\"name\":\"Edit Timesheet (Recap)\",\"uid\":\"159\"},{\"id_application_action\":\"167\",\"action\":\"167\",\"name\":\"Delete Timesheet (Recap)\",\"uid\":\"160\"},{\"id_application_action\":\"168\",\"action\":\"168\",\"name\":\"Save\\/Edit Timesheet (Recap)\",\"uid\":\"161\"},{\"id_application_action\":\"169\",\"action\":\"169\",\"name\":\"View SO Timesheet\",\"uid\":\"162\"},{\"id_application_action\":\"170\",\"action\":\"170\",\"name\":\"Create SO Timesheet\",\"uid\":\"163\"},{\"id_application_action\":\"171\",\"action\":\"171\",\"name\":\"Edit SO Timesheet\",\"uid\":\"164\"},{\"id_application_action\":\"172\",\"action\":\"172\",\"name\":\"Delete SO Timesheet\",\"uid\":\"165\"},{\"id_application_action\":\"173\",\"action\":\"173\",\"name\":\"Save\\/Edit SO Timesheet\",\"uid\":\"166\"},{\"id_application_action\":\"174\",\"action\":\"174\",\"name\":\"View Incident Report\",\"uid\":\"167\"},{\"id_application_action\":\"175\",\"action\":\"175\",\"name\":\"Create Incident Report\",\"uid\":\"168\"},{\"id_application_action\":\"176\",\"action\":\"176\",\"name\":\"Edit Incident Report\",\"uid\":\"169\"},{\"id_application_action\":\"177\",\"action\":\"177\",\"name\":\"Delete Incident Report\",\"uid\":\"170\"},{\"id_application_action\":\"178\",\"action\":\"178\",\"name\":\"Save\\/Edit Incident Report\",\"uid\":\"171\"},{\"id_application_action\":\"179\",\"action\":\"179\",\"name\":\"View Payroll\",\"uid\":\"172\"},{\"id_application_action\":\"180\",\"action\":\"180\",\"name\":\"Create Payroll\",\"uid\":\"173\"},{\"id_application_action\":\"181\",\"action\":\"181\",\"name\":\"Edit Payroll\",\"uid\":\"174\"},{\"id_application_action\":\"182\",\"action\":\"182\",\"name\":\"Delete Payroll\",\"uid\":\"175\"},{\"id_application_action\":\"183\",\"action\":\"183\",\"name\":\"Save\\/Edit Payroll\",\"uid\":\"176\"},{\"id_application_action\":\"184\",\"action\":\"184\",\"name\":\"View Supplier Invoice\",\"uid\":\"177\"},{\"id_application_action\":\"185\",\"action\":\"185\",\"name\":\"Create Supplier Invoice\",\"uid\":\"178\"},{\"id_application_action\":\"186\",\"action\":\"186\",\"name\":\"Edit Supplier Invoice\",\"uid\":\"179\"},{\"id_application_action\":\"187\",\"action\":\"187\",\"name\":\"Delete Supplier Invoice\",\"uid\":\"180\"},{\"id_application_action\":\"188\",\"action\":\"188\",\"name\":\"Save\\/Edit Supplier Invoice\",\"uid\":\"181\"},{\"id_application_action\":\"189\",\"action\":\"189\",\"name\":\"View Customer Invoice\",\"uid\":\"182\"},{\"id_application_action\":\"190\",\"action\":\"190\",\"name\":\"Create Customer Invoice\",\"uid\":\"183\"},{\"id_application_action\":\"191\",\"action\":\"191\",\"name\":\"Edit Customer Invoice\",\"uid\":\"184\"},{\"id_application_action\":\"192\",\"action\":\"192\",\"name\":\"Delete Customer Invoice\",\"uid\":\"185\"},{\"id_application_action\":\"193\",\"action\":\"193\",\"name\":\"Save\\/Edit Customer Invoice\",\"uid\":\"186\"},{\"id_application_action\":\"194\",\"action\":\"194\",\"name\":\"View Bank Statement\",\"uid\":\"187\"},{\"id_application_action\":\"195\",\"action\":\"195\",\"name\":\"Create Bank Statement\",\"uid\":\"188\"},{\"id_application_action\":\"196\",\"action\":\"196\",\"name\":\"Edit Bank Statement\",\"uid\":\"189\"},{\"id_application_action\":\"197\",\"action\":\"197\",\"name\":\"Delete Bank Statement\",\"uid\":\"190\"},{\"id_application_action\":\"198\",\"action\":\"198\",\"name\":\"Save\\/Edit Bank Statement\",\"uid\":\"191\"},{\"id_application_action\":\"199\",\"action\":\"199\",\"name\":\"View Cash Register\",\"uid\":\"192\"},{\"id_application_action\":\"200\",\"action\":\"200\",\"name\":\"Create Cash Register\",\"uid\":\"193\"},{\"id_application_action\":\"201\",\"action\":\"201\",\"name\":\"Edit Cash Register\",\"uid\":\"194\"},{\"id_application_action\":\"202\",\"action\":\"202\",\"name\":\"Delete Cash Register\",\"uid\":\"195\"},{\"id_application_action\":\"203\",\"action\":\"203\",\"name\":\"Save\\/Edit Cash Register\",\"uid\":\"196\"},{\"id_application_action\":\"204\",\"action\":\"204\",\"name\":\"View Tax\",\"uid\":\"197\"},{\"id_application_action\":\"205\",\"action\":\"205\",\"name\":\"Create Tax\",\"uid\":\"198\"},{\"id_application_action\":\"206\",\"action\":\"206\",\"name\":\"Edit Tax\",\"uid\":\"199\"},{\"id_application_action\":\"207\",\"action\":\"207\",\"name\":\"Delete Tax\",\"uid\":\"200\"},{\"id_application_action\":\"208\",\"action\":\"208\",\"name\":\"Save\\/Edit Tax\",\"uid\":\"201\"},{\"id_application_action\":\"209\",\"action\":\"209\",\"name\":\"View Chart of Account\",\"uid\":\"202\"},{\"id_application_action\":\"210\",\"action\":\"210\",\"name\":\"Create Chart of Account\",\"uid\":\"203\"},{\"id_application_action\":\"211\",\"action\":\"211\",\"name\":\"Edit Chart of Account\",\"uid\":\"204\"},{\"id_application_action\":\"212\",\"action\":\"212\",\"name\":\"Delete Chart of Account\",\"uid\":\"205\"},{\"id_application_action\":\"213\",\"action\":\"213\",\"name\":\"Save\\/Edit Chart of Account\",\"uid\":\"206\"},{\"id_application_action\":\"214\",\"action\":\"214\",\"name\":\"View Employee Salary\",\"uid\":\"207\"},{\"id_application_action\":\"215\",\"action\":\"215\",\"name\":\"Create Employee Salary\",\"uid\":\"208\"},{\"id_application_action\":\"216\",\"action\":\"216\",\"name\":\"Edit Employee Salary\",\"uid\":\"209\"},{\"id_application_action\":\"217\",\"action\":\"217\",\"name\":\"Delete Employee Salary\",\"uid\":\"210\"},{\"id_application_action\":\"218\",\"action\":\"218\",\"name\":\"Save\\/Edit Employee Salary\",\"uid\":\"211\"},{\"id_application_action\":\"219\",\"action\":\"219\",\"name\":\"View Salary Setting\",\"uid\":\"212\"},{\"id_application_action\":\"220\",\"action\":\"220\",\"name\":\"Create Salary Setting\",\"uid\":\"213\"},{\"id_application_action\":\"221\",\"action\":\"221\",\"name\":\"Edit Salary Setting\",\"uid\":\"214\"},{\"id_application_action\":\"222\",\"action\":\"222\",\"name\":\"Delete Salary Setting\",\"uid\":\"215\"},{\"id_application_action\":\"223\",\"action\":\"223\",\"name\":\"Save\\/Edit Salary Setting\",\"uid\":\"216\"},{\"id_application_action\":\"224\",\"action\":\"224\",\"name\":\"View Database Interface\",\"uid\":\"217\"},{\"id_application_action\":\"226\",\"name\":\"View Organisation Structure\",\"uid\":\"218\",\"id\":\"218\"},{\"id_application_action\":\"227\",\"name\":\"Create Organisation Structure\",\"uid\":\"219\",\"id\":\"219\"},{\"id_application_action\":\"228\",\"name\":\"Edit Organisation Structure\",\"uid\":\"220\",\"id\":\"220\"},{\"id_application_action\":\"229\",\"name\":\"Delete Organisation Structure\",\"uid\":\"221\",\"id\":\"221\"},{\"id_application_action\":\"230\",\"name\":\"Save\\/Edit Organisation Structure\",\"uid\":\"222\",\"id\":\"222\"},{\"id_application_action\":\"231\",\"name\":\"View Position Level\",\"uid\":\"223\",\"id\":\"223\"},{\"id_application_action\":\"232\",\"name\":\"Create Position Level\",\"uid\":\"224\",\"id\":\"224\"},{\"id_application_action\":\"233\",\"name\":\"Edit Position Level\",\"uid\":\"225\",\"id\":\"225\"},{\"id_application_action\":\"234\",\"name\":\"Delete Position Level\",\"uid\":\"226\",\"id\":\"226\"},{\"id_application_action\":\"235\",\"name\":\"Save\\/Edit Position Level\",\"uid\":\"227\",\"id\":\"227\"}],\"is_edit\":\"true\",\"id_role\":\"1\"}', '2015-01-05 23:03:44');
INSERT INTO `activity_log` VALUES ('47', 'Save/Edit Side Menu', 'side_menu', null, '2', 'Save/Edit Side Menu', '9', '{}', '2015-01-05 23:04:38');
INSERT INTO `activity_log` VALUES ('48', 'Save/Edit Organisation Structure', 'organisation_structu', null, '2', 'Save/Edit Organisation Structure', '230', '{}', '2015-01-05 23:10:48');
INSERT INTO `activity_log` VALUES ('49', 'Save/Edit Organisation Structure', 'organisation_structu', null, '2', 'Save/Edit Organisation Structure', '230', '{}', '2015-01-05 23:13:17');
INSERT INTO `activity_log` VALUES ('50', 'Save/Edit Organisation Structure', 'organisation_structu', null, '2', 'Save/Edit Organisation Structure', '230', '{}', '2015-01-05 23:14:54');
INSERT INTO `activity_log` VALUES ('51', 'Save/Edit Organisation Structure', 'organisation_structu', null, '2', 'Save/Edit Organisation Structure', '230', '{}', '2015-01-05 23:15:11');
INSERT INTO `activity_log` VALUES ('52', 'Save/Edit Organisation Structure', 'organisation_structu', null, '2', 'Save/Edit Organisation Structure', '230', '{}', '2015-01-05 23:15:31');
INSERT INTO `activity_log` VALUES ('53', 'Save/Edit Organisation Structure', 'organisation_structu', null, '2', 'Save/Edit Organisation Structure', '230', '{}', '2015-01-05 23:15:46');
INSERT INTO `activity_log` VALUES ('54', 'Save/Edit Organisation Structure', 'organisation_structu', null, '2', 'Save/Edit Organisation Structure', '230', '{}', '2015-01-05 23:16:03');
INSERT INTO `activity_log` VALUES ('55', 'Save/Edit Side Menu', 'side_menu', null, '2', 'Save/Edit Side Menu', '9', '{}', '2015-01-06 09:07:51');
INSERT INTO `activity_log` VALUES ('56', 'Save/Edit Position Level', 'position_level', null, '2', 'Save/Edit Position Level', '235', '{}', '2015-01-06 09:08:30');
INSERT INTO `activity_log` VALUES ('57', 'Save/Edit Position Level', 'position_level', null, '2', 'Save/Edit Position Level', '235', '{}', '2015-01-06 09:09:00');
INSERT INTO `activity_log` VALUES ('58', 'Save/Edit Position Level', 'position_level', null, '2', 'Save/Edit Position Level', '235', '{}', '2015-01-06 09:09:18');
INSERT INTO `activity_log` VALUES ('59', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"View Contract Type\",\"controller\":\"contract_type\",\"function_exec\":\"init_create_contract_type\",\"function_args\":\"\",\"view_type\":\"gridview\",\"view_file\":\"contract_type_list\",\"prefix\":\"\",\"action_type\":\"view\",\"action_button\":\"crud\",\"target_action\":\"\",\"use_log\":\"0\",\"is_edit\":\"false\",\"id_edit\":\"\"}', '2015-01-06 10:22:17');
INSERT INTO `activity_log` VALUES ('60', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"Create Contract Type\",\"controller\":\"contract_type\",\"function_exec\":\"init_create_contract_type\",\"function_args\":\"\",\"view_type\":\"form\",\"view_file\":\"contract_type_ce\",\"prefix\":\"\",\"action_type\":\"view\",\"action_button\":\"save_discard\",\"target_action\":\"\",\"use_log\":\"0\",\"is_edit\":\"false\",\"id_edit\":\"\"}', '2015-01-06 10:23:04');
INSERT INTO `activity_log` VALUES ('61', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"View Employee Contract Type\",\"controller\":\"employee_contract_type\",\"function_exec\":\"\",\"function_args\":\"\",\"view_type\":\"gridview\",\"view_file\":\"employee_contract_type_list\",\"prefix\":\"\",\"action_type\":\"view\",\"action_button\":\"crud\",\"target_action\":\"\",\"use_log\":\"0\",\"is_edit\":\"true\",\"id_edit\":\"236\"}', '2015-01-06 10:23:57');
INSERT INTO `activity_log` VALUES ('62', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"Create Employee Contract Type\",\"controller\":\"employee_contract_type\",\"function_exec\":\"init_create_employee_contract_type\",\"function_args\":\"\",\"view_type\":\"form\",\"view_file\":\"employee_contract_type_ce\",\"prefix\":\"\",\"action_type\":\"view\",\"action_button\":\"save_discard\",\"target_action\":\"\",\"use_log\":\"0\",\"is_edit\":\"true\",\"id_edit\":\"237\"}', '2015-01-06 10:24:43');
INSERT INTO `activity_log` VALUES ('63', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"Edit Employee Contract Type\",\"controller\":\"employee_contract_type\",\"function_exec\":\"init_edit_employee_contract_type\",\"function_args\":\"id\",\"view_type\":\"no_view\",\"view_file\":\"employee_contract_type_ce\",\"prefix\":\"\",\"action_type\":\"view\",\"action_button\":\"save_discard\",\"target_action\":\"\",\"use_log\":\"0\",\"is_edit\":\"false\",\"id_edit\":\"\"}', '2015-01-06 10:25:25');
INSERT INTO `activity_log` VALUES ('64', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"Edit Employee Contract Type\",\"controller\":\"employee_contract_type\",\"function_exec\":\"init_edit_employee_contract_type\",\"function_args\":\"id\",\"view_type\":\"form\",\"view_file\":\"employee_contract_type_ce\",\"prefix\":\"\",\"action_type\":\"view\",\"action_button\":\"save_discard\",\"target_action\":\"\",\"use_log\":\"0\",\"is_edit\":\"true\",\"id_edit\":\"238\"}', '2015-01-06 10:25:45');
INSERT INTO `activity_log` VALUES ('65', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"Delete Employee Contract Type\",\"controller\":\"employee_contract_type\",\"function_exec\":\"delete_employee_contract_type\",\"function_args\":\"\",\"view_type\":\"no_view\",\"view_file\":\"\",\"prefix\":\"\",\"action_type\":\"delete\",\"action_button\":\"crud\",\"target_action\":\"236\",\"use_log\":\"1\",\"is_edit\":\"false\",\"id_edit\":\"\"}', '2015-01-06 10:27:21');
INSERT INTO `activity_log` VALUES ('66', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"Save\\/Edit Employee Contract\",\"controller\":\"employee_contract_type\",\"function_exec\":\"save_employee_contract_type\",\"function_args\":\"\",\"view_type\":\"no_view\",\"view_file\":\"\",\"prefix\":\"\",\"action_type\":\"create\",\"action_button\":\"crud\",\"target_action\":\"236\",\"use_log\":\"1\",\"is_edit\":\"false\",\"id_edit\":\"\"}', '2015-01-06 10:32:56');
INSERT INTO `activity_log` VALUES ('67', 'Save/Edit Role', 'role', null, '2', 'Save/Edit Role', '20', '{\"name\":\"administrator\",\"action_detail\":[{\"id_application_action\":\"1\",\"action\":\"1\",\"name\":\"View Application Action\",\"uid\":\"0\"},{\"id_application_action\":\"2\",\"action\":\"2\",\"name\":\"Create Application Action\",\"uid\":\"1\"},{\"id_application_action\":\"3\",\"action\":\"3\",\"name\":\"Edit Application Action\",\"uid\":\"2\"},{\"id_application_action\":\"4\",\"action\":\"4\",\"name\":\"Delete Application Action\",\"uid\":\"3\"},{\"id_application_action\":\"5\",\"action\":\"5\",\"name\":\"View Side Menu\",\"uid\":\"4\"},{\"id_application_action\":\"6\",\"action\":\"6\",\"name\":\"Create Side Menu\",\"uid\":\"5\"},{\"id_application_action\":\"7\",\"action\":\"7\",\"name\":\"Edit Side Menu\",\"uid\":\"6\"},{\"id_application_action\":\"8\",\"action\":\"8\",\"name\":\"Delete Side Menu\",\"uid\":\"7\"},{\"id_application_action\":\"9\",\"action\":\"9\",\"name\":\"Save\\/Edit Side Menu\",\"uid\":\"8\"},{\"id_application_action\":\"10\",\"action\":\"10\",\"name\":\"Save\\/Edit Action\",\"uid\":\"9\"},{\"id_application_action\":\"11\",\"action\":\"11\",\"name\":\"View Division\",\"uid\":\"10\"},{\"id_application_action\":\"12\",\"action\":\"12\",\"name\":\"Create Division\",\"uid\":\"11\"},{\"id_application_action\":\"13\",\"action\":\"13\",\"name\":\"Save\\/Edit Division\",\"uid\":\"12\"},{\"id_application_action\":\"14\",\"action\":\"14\",\"name\":\"Edit Division\",\"uid\":\"13\"},{\"id_application_action\":\"15\",\"action\":\"15\",\"name\":\"Delete Division\",\"uid\":\"14\"},{\"id_application_action\":\"16\",\"action\":\"16\",\"name\":\"View Role\",\"uid\":\"15\"},{\"id_application_action\":\"17\",\"action\":\"17\",\"name\":\"View Create Role\",\"uid\":\"16\"},{\"id_application_action\":\"18\",\"action\":\"18\",\"name\":\"View Edit Role\",\"uid\":\"17\"},{\"id_application_action\":\"19\",\"action\":\"19\",\"name\":\"Delete Role\",\"uid\":\"18\"},{\"id_application_action\":\"20\",\"action\":\"20\",\"name\":\"Save\\/Edit Role\",\"uid\":\"19\"},{\"id_application_action\":\"21\",\"action\":\"21\",\"name\":\"View Product\",\"uid\":\"20\"},{\"id_application_action\":\"22\",\"action\":\"22\",\"name\":\"Create Product\",\"uid\":\"21\"},{\"id_application_action\":\"23\",\"action\":\"23\",\"name\":\"Edit Product\",\"uid\":\"22\"},{\"id_application_action\":\"24\",\"action\":\"24\",\"name\":\"Delete Product\",\"uid\":\"23\"},{\"id_application_action\":\"25\",\"action\":\"25\",\"name\":\"Save\\/Edit Product\",\"uid\":\"24\"},{\"id_application_action\":\"26\",\"action\":\"26\",\"name\":\"View Supplier\",\"uid\":\"25\"},{\"id_application_action\":\"27\",\"action\":\"27\",\"name\":\"Create Supplier\",\"uid\":\"26\"},{\"id_application_action\":\"28\",\"action\":\"28\",\"name\":\"Edit Supplier\",\"uid\":\"27\"},{\"id_application_action\":\"29\",\"action\":\"29\",\"name\":\"Delete Supplier\",\"uid\":\"28\"},{\"id_application_action\":\"30\",\"action\":\"30\",\"name\":\"Save\\/Edit Supplier\",\"uid\":\"29\"},{\"id_application_action\":\"31\",\"action\":\"31\",\"name\":\"View Product Category\",\"uid\":\"30\"},{\"id_application_action\":\"32\",\"action\":\"32\",\"name\":\"Create Product Category\",\"uid\":\"31\"},{\"id_application_action\":\"33\",\"action\":\"33\",\"name\":\"Edit Product Category\",\"uid\":\"32\"},{\"id_application_action\":\"34\",\"action\":\"34\",\"name\":\"Delete Product Category\",\"uid\":\"33\"},{\"id_application_action\":\"35\",\"action\":\"35\",\"name\":\"Save\\/Edit Product Category\",\"uid\":\"34\"},{\"id_application_action\":\"36\",\"action\":\"36\",\"name\":\"View Merk\",\"uid\":\"35\"},{\"id_application_action\":\"37\",\"action\":\"37\",\"name\":\"Create Merk\",\"uid\":\"36\"},{\"id_application_action\":\"38\",\"action\":\"38\",\"name\":\"Edit Merk\",\"uid\":\"37\"},{\"id_application_action\":\"39\",\"action\":\"39\",\"name\":\"Delete Merk\",\"uid\":\"38\"},{\"id_application_action\":\"40\",\"action\":\"40\",\"name\":\"Save\\/Edit Merk\",\"uid\":\"39\"},{\"id_application_action\":\"41\",\"action\":\"41\",\"name\":\"View Customer\",\"uid\":\"40\"},{\"id_application_action\":\"43\",\"action\":\"43\",\"name\":\"Create Customer\",\"uid\":\"41\"},{\"id_application_action\":\"44\",\"action\":\"44\",\"name\":\"Edit Customer\",\"uid\":\"42\"},{\"id_application_action\":\"45\",\"action\":\"45\",\"name\":\"Delete Customer\",\"uid\":\"43\"},{\"id_application_action\":\"46\",\"action\":\"46\",\"name\":\"Save\\/Edit Customer\",\"uid\":\"44\"},{\"id_application_action\":\"47\",\"action\":\"47\",\"name\":\"View Warehouse\",\"uid\":\"45\"},{\"id_application_action\":\"48\",\"action\":\"48\",\"name\":\"Create Warehouse\",\"uid\":\"46\"},{\"id_application_action\":\"49\",\"action\":\"49\",\"name\":\"Edit Warehouse\",\"uid\":\"47\"},{\"id_application_action\":\"50\",\"action\":\"50\",\"name\":\"Delete Warehouse\",\"uid\":\"48\"},{\"id_application_action\":\"51\",\"action\":\"51\",\"name\":\"Save\\/Edit Warehouse\",\"uid\":\"49\"},{\"id_application_action\":\"57\",\"action\":\"57\",\"name\":\"View PO\",\"uid\":\"50\"},{\"id_application_action\":\"58\",\"action\":\"58\",\"name\":\"Create PO\",\"uid\":\"51\"},{\"id_application_action\":\"59\",\"action\":\"59\",\"name\":\"Edit PO\",\"uid\":\"52\"},{\"id_application_action\":\"60\",\"action\":\"60\",\"name\":\"Delete PO\",\"uid\":\"53\"},{\"id_application_action\":\"61\",\"action\":\"61\",\"name\":\"Save\\/Edit PO\",\"uid\":\"54\"},{\"id_application_action\":\"62\",\"action\":\"62\",\"name\":\"View User\",\"uid\":\"55\"},{\"id_application_action\":\"63\",\"action\":\"63\",\"name\":\"Create User\",\"uid\":\"56\"},{\"id_application_action\":\"64\",\"action\":\"64\",\"name\":\"Edit User\",\"uid\":\"57\"},{\"id_application_action\":\"65\",\"action\":\"65\",\"name\":\"Delete User\",\"uid\":\"58\"},{\"id_application_action\":\"66\",\"action\":\"66\",\"name\":\"Save\\/Edit User\",\"uid\":\"59\"},{\"id_application_action\":\"67\",\"action\":\"67\",\"name\":\"View Good Receive\",\"uid\":\"60\"},{\"id_application_action\":\"68\",\"action\":\"68\",\"name\":\"Create Good Receive\",\"uid\":\"61\"},{\"id_application_action\":\"69\",\"action\":\"69\",\"name\":\"Edit Good Receive\",\"uid\":\"62\"},{\"id_application_action\":\"70\",\"action\":\"70\",\"name\":\"Delete Good Receive\",\"uid\":\"63\"},{\"id_application_action\":\"71\",\"action\":\"71\",\"name\":\"Save\\/Edit Good Receive\",\"uid\":\"64\"},{\"id_application_action\":\"72\",\"action\":\"72\",\"name\":\"View Sales Order\",\"uid\":\"65\"},{\"id_application_action\":\"73\",\"action\":\"73\",\"name\":\"Create Sales Order\",\"uid\":\"66\"},{\"id_application_action\":\"74\",\"action\":\"74\",\"name\":\"Edit Sales Order\",\"uid\":\"67\"},{\"id_application_action\":\"75\",\"action\":\"75\",\"name\":\"Delete Sales Order\",\"uid\":\"68\"},{\"id_application_action\":\"76\",\"action\":\"76\",\"name\":\"Save Sales Order\",\"uid\":\"69\"},{\"id_application_action\":\"77\",\"action\":\"77\",\"name\":\"View Material Request\",\"uid\":\"70\"},{\"id_application_action\":\"78\",\"action\":\"78\",\"name\":\"Create Material Request\",\"uid\":\"71\"},{\"id_application_action\":\"79\",\"action\":\"79\",\"name\":\"Edit Material Request\",\"uid\":\"72\"},{\"id_application_action\":\"80\",\"action\":\"80\",\"name\":\"Delete Material Request\",\"uid\":\"73\"},{\"id_application_action\":\"81\",\"action\":\"81\",\"name\":\"Save Material Request\",\"uid\":\"74\"},{\"id_application_action\":\"82\",\"action\":\"82\",\"name\":\"Change User Password\",\"uid\":\"75\"},{\"id_application_action\":\"83\",\"action\":\"83\",\"name\":\"View Delivery Note\",\"uid\":\"76\"},{\"id_application_action\":\"84\",\"action\":\"84\",\"name\":\"Create Delivery Note\",\"uid\":\"77\"},{\"id_application_action\":\"85\",\"action\":\"85\",\"name\":\"Edit Delivery Note\",\"uid\":\"78\"},{\"id_application_action\":\"86\",\"action\":\"86\",\"name\":\"Delete Delivery Note\",\"uid\":\"79\"},{\"id_application_action\":\"87\",\"action\":\"87\",\"name\":\"Save\\/Edit Delivery Note\",\"uid\":\"80\"},{\"id_application_action\":\"88\",\"action\":\"88\",\"name\":\"View Unit Measure\",\"uid\":\"81\"},{\"id_application_action\":\"89\",\"action\":\"89\",\"name\":\"Create Unit Measure\",\"uid\":\"82\"},{\"id_application_action\":\"90\",\"action\":\"90\",\"name\":\"Edit Unit Measure\",\"uid\":\"83\"},{\"id_application_action\":\"91\",\"action\":\"91\",\"name\":\"Delete Unit Measure\",\"uid\":\"84\"},{\"id_application_action\":\"92\",\"action\":\"92\",\"name\":\"Save\\/Edit Unit Measure\",\"uid\":\"85\"},{\"id_application_action\":\"93\",\"action\":\"93\",\"name\":\"View Stock\",\"uid\":\"86\"},{\"id_application_action\":\"94\",\"action\":\"94\",\"name\":\"View Employee\",\"uid\":\"87\"},{\"id_application_action\":\"95\",\"action\":\"95\",\"name\":\"Create Employee\",\"uid\":\"88\"},{\"id_application_action\":\"96\",\"action\":\"96\",\"name\":\"Edit Employee\",\"uid\":\"89\"},{\"id_application_action\":\"97\",\"action\":\"97\",\"name\":\"Delete Employee\",\"uid\":\"90\"},{\"id_application_action\":\"98\",\"action\":\"98\",\"name\":\"Save\\/Edit Employee\",\"uid\":\"91\"},{\"id_application_action\":\"99\",\"action\":\"99\",\"name\":\"Validate PO\",\"uid\":\"92\"},{\"id_application_action\":\"100\",\"action\":\"100\",\"name\":\"Create Database Interface\",\"uid\":\"93\"},{\"id_application_action\":\"101\",\"action\":\"101\",\"name\":\"Edit Database Interface\",\"uid\":\"94\"},{\"id_application_action\":\"102\",\"action\":\"102\",\"name\":\"Delete Database Interface\",\"uid\":\"95\"},{\"id_application_action\":\"103\",\"action\":\"103\",\"name\":\"Save \\/ Edit Database Interface\",\"uid\":\"96\"},{\"id_application_action\":\"104\",\"action\":\"104\",\"name\":\"View Database Field Interface\",\"uid\":\"97\"},{\"id_application_action\":\"105\",\"action\":\"105\",\"name\":\"Create Database Field Interface\",\"uid\":\"98\"},{\"id_application_action\":\"106\",\"action\":\"106\",\"name\":\"Edit Database Field Interface\",\"uid\":\"99\"},{\"id_application_action\":\"107\",\"action\":\"107\",\"name\":\"Delete Database Field Interface\",\"uid\":\"100\"},{\"id_application_action\":\"108\",\"action\":\"108\",\"name\":\"Save \\/ Edit Database Field Interface\",\"uid\":\"101\"},{\"id_application_action\":\"109\",\"action\":\"109\",\"name\":\"View Inquiry\",\"uid\":\"102\"},{\"id_application_action\":\"110\",\"action\":\"110\",\"name\":\"Create Inquiry\",\"uid\":\"103\"},{\"id_application_action\":\"111\",\"action\":\"111\",\"name\":\"Edit Inquiry\",\"uid\":\"104\"},{\"id_application_action\":\"112\",\"action\":\"112\",\"name\":\"Delete Inquiry\",\"uid\":\"105\"},{\"id_application_action\":\"113\",\"action\":\"113\",\"name\":\"Save\\/Edit Inquiry\",\"uid\":\"106\"},{\"id_application_action\":\"114\",\"action\":\"114\",\"name\":\"View Survey \\/ Assessment\",\"uid\":\"107\"},{\"id_application_action\":\"115\",\"action\":\"115\",\"name\":\"Create Survey \\/ Assessment\",\"uid\":\"108\"},{\"id_application_action\":\"116\",\"action\":\"116\",\"name\":\"Edit Survey \\/ Assessment\",\"uid\":\"109\"},{\"id_application_action\":\"117\",\"action\":\"117\",\"name\":\"Delete Survey \\/ Assessment\",\"uid\":\"110\"},{\"id_application_action\":\"118\",\"action\":\"118\",\"name\":\"Save\\/Edit Survey \\/ Assessment\",\"uid\":\"111\"},{\"id_application_action\":\"119\",\"action\":\"119\",\"name\":\"View Quotation\",\"uid\":\"112\"},{\"id_application_action\":\"120\",\"action\":\"120\",\"name\":\"Create Quotation\",\"uid\":\"113\"},{\"id_application_action\":\"121\",\"action\":\"121\",\"name\":\"Edit Quotation\",\"uid\":\"114\"},{\"id_application_action\":\"122\",\"action\":\"122\",\"name\":\"Delete Quotation\",\"uid\":\"115\"},{\"id_application_action\":\"123\",\"action\":\"123\",\"name\":\"Save\\/Edit Quotation\",\"uid\":\"116\"},{\"id_application_action\":\"124\",\"action\":\"124\",\"name\":\"View Project Contract\",\"uid\":\"117\"},{\"id_application_action\":\"125\",\"action\":\"125\",\"name\":\"Create Project Contract\",\"uid\":\"118\"},{\"id_application_action\":\"126\",\"action\":\"126\",\"name\":\"Edit Project Contract\",\"uid\":\"119\"},{\"id_application_action\":\"127\",\"action\":\"127\",\"name\":\"Delete Project Contract\",\"uid\":\"120\"},{\"id_application_action\":\"128\",\"action\":\"128\",\"name\":\"Save\\/Edit Project Contract\",\"uid\":\"121\"},{\"id_application_action\":\"129\",\"action\":\"129\",\"name\":\"View Work Order\",\"uid\":\"122\"},{\"id_application_action\":\"130\",\"action\":\"130\",\"name\":\"Create Work Order\",\"uid\":\"123\"},{\"id_application_action\":\"131\",\"action\":\"131\",\"name\":\"Edit Work Order\",\"uid\":\"124\"},{\"id_application_action\":\"132\",\"action\":\"132\",\"name\":\"Delete Work Order\",\"uid\":\"125\"},{\"id_application_action\":\"133\",\"action\":\"133\",\"name\":\"Save\\/Edit Work Order\",\"uid\":\"126\"},{\"id_application_action\":\"134\",\"action\":\"134\",\"name\":\"View Assessment Template\",\"uid\":\"127\"},{\"id_application_action\":\"135\",\"action\":\"135\",\"name\":\"Create Assessment Template\",\"uid\":\"128\"},{\"id_application_action\":\"136\",\"action\":\"136\",\"name\":\"Edit Assessment Template\",\"uid\":\"129\"},{\"id_application_action\":\"137\",\"action\":\"137\",\"name\":\"Delete Assessment Template\",\"uid\":\"130\"},{\"id_application_action\":\"138\",\"action\":\"138\",\"name\":\"Save\\/Edit Assessment Template\",\"uid\":\"131\"},{\"id_application_action\":\"139\",\"action\":\"139\",\"name\":\"View Contract Template\",\"uid\":\"132\"},{\"id_application_action\":\"140\",\"action\":\"140\",\"name\":\"Create Contract Template\",\"uid\":\"133\"},{\"id_application_action\":\"141\",\"action\":\"141\",\"name\":\"Edit Contract Template\",\"uid\":\"134\"},{\"id_application_action\":\"142\",\"action\":\"142\",\"name\":\"Delete Contract Template\",\"uid\":\"135\"},{\"id_application_action\":\"143\",\"action\":\"143\",\"name\":\"Save\\/Edit Contract Template\",\"uid\":\"136\"},{\"id_application_action\":\"144\",\"action\":\"144\",\"name\":\"View Work Schedule\",\"uid\":\"137\"},{\"id_application_action\":\"145\",\"action\":\"145\",\"name\":\"Create Work Schedule\",\"uid\":\"138\"},{\"id_application_action\":\"146\",\"action\":\"146\",\"name\":\"Edit Work Schedule\",\"uid\":\"139\"},{\"id_application_action\":\"147\",\"action\":\"147\",\"name\":\"Delete Work Schedule\",\"uid\":\"140\"},{\"id_application_action\":\"148\",\"action\":\"148\",\"name\":\"Save\\/Edit Work Schedule\",\"uid\":\"141\"},{\"id_application_action\":\"149\",\"action\":\"149\",\"name\":\"View SO Assignment\",\"uid\":\"142\"},{\"id_application_action\":\"150\",\"action\":\"150\",\"name\":\"Create SO Assignment\",\"uid\":\"143\"},{\"id_application_action\":\"151\",\"action\":\"151\",\"name\":\"Edit SO Assignment\",\"uid\":\"144\"},{\"id_application_action\":\"152\",\"action\":\"152\",\"name\":\"Delete SO Assignment\",\"uid\":\"145\"},{\"id_application_action\":\"153\",\"action\":\"153\",\"name\":\"Save\\/Edit SO Assignment\",\"uid\":\"146\"},{\"id_application_action\":\"154\",\"action\":\"154\",\"name\":\"View Shift Change\",\"uid\":\"147\"},{\"id_application_action\":\"155\",\"action\":\"155\",\"name\":\"Create Shift Change\",\"uid\":\"148\"},{\"id_application_action\":\"156\",\"action\":\"156\",\"name\":\"Edit Shift Change\",\"uid\":\"149\"},{\"id_application_action\":\"157\",\"action\":\"157\",\"name\":\"Delete Shift Change\",\"uid\":\"150\"},{\"id_application_action\":\"158\",\"action\":\"158\",\"name\":\"Save\\/Edit Shift Change\",\"uid\":\"151\"},{\"id_application_action\":\"159\",\"action\":\"159\",\"name\":\"View Leave Application\",\"uid\":\"152\"},{\"id_application_action\":\"160\",\"action\":\"160\",\"name\":\"Create Leave Application\",\"uid\":\"153\"},{\"id_application_action\":\"161\",\"action\":\"161\",\"name\":\"Edit Leave Application\",\"uid\":\"154\"},{\"id_application_action\":\"162\",\"action\":\"162\",\"name\":\"Delete Leave Application\",\"uid\":\"155\"},{\"id_application_action\":\"163\",\"action\":\"163\",\"name\":\"Save\\/Edit Leave Application\",\"uid\":\"156\"},{\"id_application_action\":\"164\",\"action\":\"164\",\"name\":\"View Timesheet (Recap)\",\"uid\":\"157\"},{\"id_application_action\":\"165\",\"action\":\"165\",\"name\":\"Create Timesheet (Recap)\",\"uid\":\"158\"},{\"id_application_action\":\"166\",\"action\":\"166\",\"name\":\"Edit Timesheet (Recap)\",\"uid\":\"159\"},{\"id_application_action\":\"167\",\"action\":\"167\",\"name\":\"Delete Timesheet (Recap)\",\"uid\":\"160\"},{\"id_application_action\":\"168\",\"action\":\"168\",\"name\":\"Save\\/Edit Timesheet (Recap)\",\"uid\":\"161\"},{\"id_application_action\":\"169\",\"action\":\"169\",\"name\":\"View SO Timesheet\",\"uid\":\"162\"},{\"id_application_action\":\"170\",\"action\":\"170\",\"name\":\"Create SO Timesheet\",\"uid\":\"163\"},{\"id_application_action\":\"171\",\"action\":\"171\",\"name\":\"Edit SO Timesheet\",\"uid\":\"164\"},{\"id_application_action\":\"172\",\"action\":\"172\",\"name\":\"Delete SO Timesheet\",\"uid\":\"165\"},{\"id_application_action\":\"173\",\"action\":\"173\",\"name\":\"Save\\/Edit SO Timesheet\",\"uid\":\"166\"},{\"id_application_action\":\"174\",\"action\":\"174\",\"name\":\"View Incident Report\",\"uid\":\"167\"},{\"id_application_action\":\"175\",\"action\":\"175\",\"name\":\"Create Incident Report\",\"uid\":\"168\"},{\"id_application_action\":\"176\",\"action\":\"176\",\"name\":\"Edit Incident Report\",\"uid\":\"169\"},{\"id_application_action\":\"177\",\"action\":\"177\",\"name\":\"Delete Incident Report\",\"uid\":\"170\"},{\"id_application_action\":\"178\",\"action\":\"178\",\"name\":\"Save\\/Edit Incident Report\",\"uid\":\"171\"},{\"id_application_action\":\"179\",\"action\":\"179\",\"name\":\"View Payroll\",\"uid\":\"172\"},{\"id_application_action\":\"180\",\"action\":\"180\",\"name\":\"Create Payroll\",\"uid\":\"173\"},{\"id_application_action\":\"181\",\"action\":\"181\",\"name\":\"Edit Payroll\",\"uid\":\"174\"},{\"id_application_action\":\"182\",\"action\":\"182\",\"name\":\"Delete Payroll\",\"uid\":\"175\"},{\"id_application_action\":\"183\",\"action\":\"183\",\"name\":\"Save\\/Edit Payroll\",\"uid\":\"176\"},{\"id_application_action\":\"184\",\"action\":\"184\",\"name\":\"View Supplier Invoice\",\"uid\":\"177\"},{\"id_application_action\":\"185\",\"action\":\"185\",\"name\":\"Create Supplier Invoice\",\"uid\":\"178\"},{\"id_application_action\":\"186\",\"action\":\"186\",\"name\":\"Edit Supplier Invoice\",\"uid\":\"179\"},{\"id_application_action\":\"187\",\"action\":\"187\",\"name\":\"Delete Supplier Invoice\",\"uid\":\"180\"},{\"id_application_action\":\"188\",\"action\":\"188\",\"name\":\"Save\\/Edit Supplier Invoice\",\"uid\":\"181\"},{\"id_application_action\":\"189\",\"action\":\"189\",\"name\":\"View Customer Invoice\",\"uid\":\"182\"},{\"id_application_action\":\"190\",\"action\":\"190\",\"name\":\"Create Customer Invoice\",\"uid\":\"183\"},{\"id_application_action\":\"191\",\"action\":\"191\",\"name\":\"Edit Customer Invoice\",\"uid\":\"184\"},{\"id_application_action\":\"192\",\"action\":\"192\",\"name\":\"Delete Customer Invoice\",\"uid\":\"185\"},{\"id_application_action\":\"193\",\"action\":\"193\",\"name\":\"Save\\/Edit Customer Invoice\",\"uid\":\"186\"},{\"id_application_action\":\"194\",\"action\":\"194\",\"name\":\"View Bank Statement\",\"uid\":\"187\"},{\"id_application_action\":\"195\",\"action\":\"195\",\"name\":\"Create Bank Statement\",\"uid\":\"188\"},{\"id_application_action\":\"196\",\"action\":\"196\",\"name\":\"Edit Bank Statement\",\"uid\":\"189\"},{\"id_application_action\":\"197\",\"action\":\"197\",\"name\":\"Delete Bank Statement\",\"uid\":\"190\"},{\"id_application_action\":\"198\",\"action\":\"198\",\"name\":\"Save\\/Edit Bank Statement\",\"uid\":\"191\"},{\"id_application_action\":\"199\",\"action\":\"199\",\"name\":\"View Cash Register\",\"uid\":\"192\"},{\"id_application_action\":\"200\",\"action\":\"200\",\"name\":\"Create Cash Register\",\"uid\":\"193\"},{\"id_application_action\":\"201\",\"action\":\"201\",\"name\":\"Edit Cash Register\",\"uid\":\"194\"},{\"id_application_action\":\"202\",\"action\":\"202\",\"name\":\"Delete Cash Register\",\"uid\":\"195\"},{\"id_application_action\":\"203\",\"action\":\"203\",\"name\":\"Save\\/Edit Cash Register\",\"uid\":\"196\"},{\"id_application_action\":\"204\",\"action\":\"204\",\"name\":\"View Tax\",\"uid\":\"197\"},{\"id_application_action\":\"205\",\"action\":\"205\",\"name\":\"Create Tax\",\"uid\":\"198\"},{\"id_application_action\":\"206\",\"action\":\"206\",\"name\":\"Edit Tax\",\"uid\":\"199\"},{\"id_application_action\":\"207\",\"action\":\"207\",\"name\":\"Delete Tax\",\"uid\":\"200\"},{\"id_application_action\":\"208\",\"action\":\"208\",\"name\":\"Save\\/Edit Tax\",\"uid\":\"201\"},{\"id_application_action\":\"209\",\"action\":\"209\",\"name\":\"View Chart of Account\",\"uid\":\"202\"},{\"id_application_action\":\"210\",\"action\":\"210\",\"name\":\"Create Chart of Account\",\"uid\":\"203\"},{\"id_application_action\":\"211\",\"action\":\"211\",\"name\":\"Edit Chart of Account\",\"uid\":\"204\"},{\"id_application_action\":\"212\",\"action\":\"212\",\"name\":\"Delete Chart of Account\",\"uid\":\"205\"},{\"id_application_action\":\"213\",\"action\":\"213\",\"name\":\"Save\\/Edit Chart of Account\",\"uid\":\"206\"},{\"id_application_action\":\"214\",\"action\":\"214\",\"name\":\"View Employee Salary\",\"uid\":\"207\"},{\"id_application_action\":\"215\",\"action\":\"215\",\"name\":\"Create Employee Salary\",\"uid\":\"208\"},{\"id_application_action\":\"216\",\"action\":\"216\",\"name\":\"Edit Employee Salary\",\"uid\":\"209\"},{\"id_application_action\":\"217\",\"action\":\"217\",\"name\":\"Delete Employee Salary\",\"uid\":\"210\"},{\"id_application_action\":\"218\",\"action\":\"218\",\"name\":\"Save\\/Edit Employee Salary\",\"uid\":\"211\"},{\"id_application_action\":\"219\",\"action\":\"219\",\"name\":\"View Salary Setting\",\"uid\":\"212\"},{\"id_application_action\":\"220\",\"action\":\"220\",\"name\":\"Create Salary Setting\",\"uid\":\"213\"},{\"id_application_action\":\"221\",\"action\":\"221\",\"name\":\"Edit Salary Setting\",\"uid\":\"214\"},{\"id_application_action\":\"222\",\"action\":\"222\",\"name\":\"Delete Salary Setting\",\"uid\":\"215\"},{\"id_application_action\":\"223\",\"action\":\"223\",\"name\":\"Save\\/Edit Salary Setting\",\"uid\":\"216\"},{\"id_application_action\":\"224\",\"action\":\"224\",\"name\":\"View Database Interface\",\"uid\":\"217\"},{\"id_application_action\":\"226\",\"action\":\"226\",\"name\":\"View Organisation Structure\",\"uid\":\"218\"},{\"id_application_action\":\"227\",\"action\":\"227\",\"name\":\"Create Organisation Structure\",\"uid\":\"219\"},{\"id_application_action\":\"228\",\"action\":\"228\",\"name\":\"Edit Organisation Structure\",\"uid\":\"220\"},{\"id_application_action\":\"229\",\"action\":\"229\",\"name\":\"Delete Organisation Structure\",\"uid\":\"221\"},{\"id_application_action\":\"230\",\"action\":\"230\",\"name\":\"Save\\/Edit Organisation Structure\",\"uid\":\"222\"},{\"id_application_action\":\"231\",\"action\":\"231\",\"name\":\"View Position Level\",\"uid\":\"223\"},{\"id_application_action\":\"232\",\"action\":\"232\",\"name\":\"Create Position Level\",\"uid\":\"224\"},{\"id_application_action\":\"233\",\"action\":\"233\",\"name\":\"Edit Position Level\",\"uid\":\"225\"},{\"id_application_action\":\"234\",\"action\":\"234\",\"name\":\"Delete Position Level\",\"uid\":\"226\"},{\"id_application_action\":\"235\",\"action\":\"235\",\"name\":\"Save\\/Edit Position Level\",\"uid\":\"227\"},{\"id_application_action\":\"236\",\"name\":\"View Employee Contract Type\",\"uid\":\"228\",\"id\":\"228\"},{\"id_application_action\":\"237\",\"name\":\"Create Employee Contract Type\",\"uid\":\"229\",\"id\":\"229\"},{\"id_application_action\":\"238\",\"name\":\"Edit Employee Contract Type\",\"uid\":\"230\",\"id\":\"230\"},{\"id_application_action\":\"239\",\"name\":\"Delete Employee Contract Type\",\"uid\":\"231\",\"id\":\"231\"},{\"id_application_action\":\"240\",\"name\":\"Save\\/Edit Employee Contract\",\"uid\":\"232\",\"id\":\"232\"}],\"is_edit\":\"true\",\"id_role\":\"1\"}', '2015-01-06 10:47:12');
INSERT INTO `activity_log` VALUES ('68', 'Save/Edit Side Menu', 'side_menu', null, '2', 'Save/Edit Side Menu', '9', '{}', '2015-01-06 10:48:01');
INSERT INTO `activity_log` VALUES ('69', 'Save/Edit Employee Contract', 'employee_contract_ty', null, '2', 'Save/Edit Employee Contract', '240', '{}', '2015-01-06 10:49:33');
INSERT INTO `activity_log` VALUES ('70', 'Save/Edit Employee Contract', 'employee_contract_ty', null, '2', 'Save/Edit Employee Contract', '240', '{}', '2015-01-06 10:50:02');
INSERT INTO `activity_log` VALUES ('71', 'Save/Edit Employee Contract', 'employee_contract_ty', null, '2', 'Save/Edit Employee Contract', '240', '{}', '2015-01-06 10:50:25');
INSERT INTO `activity_log` VALUES ('72', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"View Working Schedule\",\"controller\":\"working_schedule\",\"function_exec\":\"\",\"function_args\":\"\",\"view_type\":\"gridview\",\"view_file\":\"working_schedule_list\",\"prefix\":\"\",\"action_type\":\"view\",\"action_button\":\"crud\",\"target_action\":\"\",\"use_log\":\"0\",\"is_edit\":\"false\",\"id_edit\":\"\"}', '2015-01-07 14:29:40');
INSERT INTO `activity_log` VALUES ('73', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"Create Working Schedule\",\"controller\":\"working_schedule\",\"function_exec\":\"init_create_working_schedule\",\"function_args\":\"\",\"view_type\":\"form\",\"view_file\":\"working_schedule_ce\",\"prefix\":\"\",\"action_type\":\"view\",\"action_button\":\"save_discard\",\"target_action\":\"\",\"use_log\":\"0\",\"is_edit\":\"false\",\"id_edit\":\"\"}', '2015-01-07 14:30:41');
INSERT INTO `activity_log` VALUES ('74', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"Edit Working Schedule\",\"controller\":\"working_schedule\",\"function_exec\":\"init_edit_working_schedule\",\"function_args\":\"id\",\"view_type\":\"form\",\"view_file\":\"working_schedule_ce\",\"prefix\":\"\",\"action_type\":\"view\",\"action_button\":\"save_discard\",\"target_action\":\"\",\"use_log\":\"0\",\"is_edit\":\"false\",\"id_edit\":\"\"}', '2015-01-07 14:31:32');
INSERT INTO `activity_log` VALUES ('75', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"Delete Working Schedule\",\"controller\":\"working_schedule\",\"function_exec\":\"delete_working_schedule\",\"function_args\":\"\",\"view_type\":\"no_view\",\"view_file\":\"\",\"prefix\":\"\",\"action_type\":\"delete\",\"action_button\":\"crud\",\"target_action\":\"241\",\"use_log\":\"1\",\"is_edit\":\"false\",\"id_edit\":\"\"}', '2015-01-07 14:32:29');
INSERT INTO `activity_log` VALUES ('76', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"Save\\/Edit Working Schedule\",\"controller\":\"working_schedule\",\"function_exec\":\"save_working_schedule\",\"function_args\":\"\",\"view_type\":\"no_view\",\"view_file\":\"\",\"prefix\":\"\",\"action_type\":\"create\",\"action_button\":\"crud\",\"target_action\":\"241\",\"use_log\":\"1\",\"is_edit\":\"false\",\"id_edit\":\"\"}', '2015-01-07 14:33:32');
INSERT INTO `activity_log` VALUES ('77', 'Save/Edit Side Menu', 'side_menu', null, '2', 'Save/Edit Side Menu', '9', '{}', '2015-01-07 14:34:44');
INSERT INTO `activity_log` VALUES ('78', 'Save/Edit Side Menu', 'side_menu', null, '2', 'Save/Edit Side Menu', '9', '{}', '2015-01-07 14:35:08');
INSERT INTO `activity_log` VALUES ('79', 'Save/Edit Side Menu', 'side_menu', null, '2', 'Save/Edit Side Menu', '9', '{}', '2015-01-07 14:35:29');
INSERT INTO `activity_log` VALUES ('80', 'Delete Side Menu', 'side_menu', null, '2', 'Delete Side Menu', '8', '{}', '2015-01-07 14:35:46');
INSERT INTO `activity_log` VALUES ('81', 'Save/Edit Side Menu', 'side_menu', null, '2', 'Save/Edit Side Menu', '9', '{}', '2015-01-07 14:36:08');
INSERT INTO `activity_log` VALUES ('82', 'Save/Edit Side Menu', 'side_menu', null, '2', 'Save/Edit Side Menu', '9', '{}', '2015-01-07 14:42:41');
INSERT INTO `activity_log` VALUES ('83', 'Delete Application Action', 'action', null, '2', 'Delete Application Action', '4', '{}', '2015-01-07 14:43:50');
INSERT INTO `activity_log` VALUES ('84', 'Delete Application Action', 'action', null, '2', 'Delete Application Action', '4', '{}', '2015-01-07 14:44:09');
INSERT INTO `activity_log` VALUES ('85', 'Delete Application Action', 'action', null, '2', 'Delete Application Action', '4', '{}', '2015-01-07 14:44:25');
INSERT INTO `activity_log` VALUES ('86', 'Delete Application Action', 'action', null, '2', 'Delete Application Action', '4', '{}', '2015-01-07 14:44:37');
INSERT INTO `activity_log` VALUES ('87', 'Delete Application Action', 'action', null, '2', 'Delete Application Action', '4', '{}', '2015-01-07 14:45:20');
INSERT INTO `activity_log` VALUES ('88', 'Save/Edit Side Menu', 'side_menu', null, '2', 'Save/Edit Side Menu', '9', '{}', '2015-01-14 13:51:02');
INSERT INTO `activity_log` VALUES ('89', 'Save/Edit Side Menu', 'side_menu', null, '2', 'Save/Edit Side Menu', '9', '{}', '2015-01-14 13:51:33');
INSERT INTO `activity_log` VALUES ('90', 'Save/Edit Side Menu', 'side_menu', null, '2', 'Save/Edit Side Menu', '9', '{}', '2015-01-15 23:27:23');
INSERT INTO `activity_log` VALUES ('91', 'Save/Edit Cash Register', 'cash_register', null, '2', 'Save/Edit Cash Register', '203', '{}', '2015-01-19 09:43:24');
INSERT INTO `activity_log` VALUES ('92', 'Save/Edit Side Menu', 'side_menu', null, '2', 'Save/Edit Side Menu', '9', '{}', '2015-01-20 14:01:28');
INSERT INTO `activity_log` VALUES ('93', 'Save/Edit Role', 'role', null, '2', 'Save/Edit Role', '20', '{\"name\":\"administrator\",\"action_detail\":[{\"id_application_action\":\"1\",\"action\":\"1\",\"name\":\"View Application Action\",\"uid\":\"0\"},{\"id_application_action\":\"2\",\"action\":\"2\",\"name\":\"Create Application Action\",\"uid\":\"1\"},{\"id_application_action\":\"3\",\"action\":\"3\",\"name\":\"Edit Application Action\",\"uid\":\"2\"},{\"id_application_action\":\"4\",\"action\":\"4\",\"name\":\"Delete Application Action\",\"uid\":\"3\"},{\"id_application_action\":\"5\",\"action\":\"5\",\"name\":\"View Side Menu\",\"uid\":\"4\"},{\"id_application_action\":\"6\",\"action\":\"6\",\"name\":\"Create Side Menu\",\"uid\":\"5\"},{\"id_application_action\":\"7\",\"action\":\"7\",\"name\":\"Edit Side Menu\",\"uid\":\"6\"},{\"id_application_action\":\"8\",\"action\":\"8\",\"name\":\"Delete Side Menu\",\"uid\":\"7\"},{\"id_application_action\":\"9\",\"action\":\"9\",\"name\":\"Save\\/Edit Side Menu\",\"uid\":\"8\"},{\"id_application_action\":\"10\",\"action\":\"10\",\"name\":\"Save\\/Edit Action\",\"uid\":\"9\"},{\"id_application_action\":\"11\",\"action\":\"11\",\"name\":\"View Division\",\"uid\":\"10\"},{\"id_application_action\":\"12\",\"action\":\"12\",\"name\":\"Create Division\",\"uid\":\"11\"},{\"id_application_action\":\"13\",\"action\":\"13\",\"name\":\"Save\\/Edit Division\",\"uid\":\"12\"},{\"id_application_action\":\"14\",\"action\":\"14\",\"name\":\"Edit Division\",\"uid\":\"13\"},{\"id_application_action\":\"15\",\"action\":\"15\",\"name\":\"Delete Division\",\"uid\":\"14\"},{\"id_application_action\":\"16\",\"action\":\"16\",\"name\":\"View Role\",\"uid\":\"15\"},{\"id_application_action\":\"17\",\"action\":\"17\",\"name\":\"View Create Role\",\"uid\":\"16\"},{\"id_application_action\":\"18\",\"action\":\"18\",\"name\":\"View Edit Role\",\"uid\":\"17\"},{\"id_application_action\":\"19\",\"action\":\"19\",\"name\":\"Delete Role\",\"uid\":\"18\"},{\"id_application_action\":\"20\",\"action\":\"20\",\"name\":\"Save\\/Edit Role\",\"uid\":\"19\"},{\"id_application_action\":\"21\",\"action\":\"21\",\"name\":\"View Product\",\"uid\":\"20\"},{\"id_application_action\":\"22\",\"action\":\"22\",\"name\":\"Create Product\",\"uid\":\"21\"},{\"id_application_action\":\"23\",\"action\":\"23\",\"name\":\"Edit Product\",\"uid\":\"22\"},{\"id_application_action\":\"24\",\"action\":\"24\",\"name\":\"Delete Product\",\"uid\":\"23\"},{\"id_application_action\":\"25\",\"action\":\"25\",\"name\":\"Save\\/Edit Product\",\"uid\":\"24\"},{\"id_application_action\":\"26\",\"action\":\"26\",\"name\":\"View Supplier\",\"uid\":\"25\"},{\"id_application_action\":\"27\",\"action\":\"27\",\"name\":\"Create Supplier\",\"uid\":\"26\"},{\"id_application_action\":\"28\",\"action\":\"28\",\"name\":\"Edit Supplier\",\"uid\":\"27\"},{\"id_application_action\":\"29\",\"action\":\"29\",\"name\":\"Delete Supplier\",\"uid\":\"28\"},{\"id_application_action\":\"30\",\"action\":\"30\",\"name\":\"Save\\/Edit Supplier\",\"uid\":\"29\"},{\"id_application_action\":\"31\",\"action\":\"31\",\"name\":\"View Product Category\",\"uid\":\"30\"},{\"id_application_action\":\"32\",\"action\":\"32\",\"name\":\"Create Product Category\",\"uid\":\"31\"},{\"id_application_action\":\"33\",\"action\":\"33\",\"name\":\"Edit Product Category\",\"uid\":\"32\"},{\"id_application_action\":\"34\",\"action\":\"34\",\"name\":\"Delete Product Category\",\"uid\":\"33\"},{\"id_application_action\":\"35\",\"action\":\"35\",\"name\":\"Save\\/Edit Product Category\",\"uid\":\"34\"},{\"id_application_action\":\"36\",\"action\":\"36\",\"name\":\"View Merk\",\"uid\":\"35\"},{\"id_application_action\":\"37\",\"action\":\"37\",\"name\":\"Create Merk\",\"uid\":\"36\"},{\"id_application_action\":\"38\",\"action\":\"38\",\"name\":\"Edit Merk\",\"uid\":\"37\"},{\"id_application_action\":\"39\",\"action\":\"39\",\"name\":\"Delete Merk\",\"uid\":\"38\"},{\"id_application_action\":\"40\",\"action\":\"40\",\"name\":\"Save\\/Edit Merk\",\"uid\":\"39\"},{\"id_application_action\":\"41\",\"action\":\"41\",\"name\":\"View Customer\",\"uid\":\"40\"},{\"id_application_action\":\"43\",\"action\":\"43\",\"name\":\"Create Customer\",\"uid\":\"41\"},{\"id_application_action\":\"44\",\"action\":\"44\",\"name\":\"Edit Customer\",\"uid\":\"42\"},{\"id_application_action\":\"45\",\"action\":\"45\",\"name\":\"Delete Customer\",\"uid\":\"43\"},{\"id_application_action\":\"46\",\"action\":\"46\",\"name\":\"Save\\/Edit Customer\",\"uid\":\"44\"},{\"id_application_action\":\"47\",\"action\":\"47\",\"name\":\"View Warehouse\",\"uid\":\"45\"},{\"id_application_action\":\"48\",\"action\":\"48\",\"name\":\"Create Warehouse\",\"uid\":\"46\"},{\"id_application_action\":\"49\",\"action\":\"49\",\"name\":\"Edit Warehouse\",\"uid\":\"47\"},{\"id_application_action\":\"50\",\"action\":\"50\",\"name\":\"Delete Warehouse\",\"uid\":\"48\"},{\"id_application_action\":\"51\",\"action\":\"51\",\"name\":\"Save\\/Edit Warehouse\",\"uid\":\"49\"},{\"id_application_action\":\"57\",\"action\":\"57\",\"name\":\"View PO\",\"uid\":\"50\"},{\"id_application_action\":\"58\",\"action\":\"58\",\"name\":\"Create PO\",\"uid\":\"51\"},{\"id_application_action\":\"59\",\"action\":\"59\",\"name\":\"Edit PO\",\"uid\":\"52\"},{\"id_application_action\":\"60\",\"action\":\"60\",\"name\":\"Delete PO\",\"uid\":\"53\"},{\"id_application_action\":\"61\",\"action\":\"61\",\"name\":\"Save\\/Edit PO\",\"uid\":\"54\"},{\"id_application_action\":\"62\",\"action\":\"62\",\"name\":\"View User\",\"uid\":\"55\"},{\"id_application_action\":\"63\",\"action\":\"63\",\"name\":\"Create User\",\"uid\":\"56\"},{\"id_application_action\":\"64\",\"action\":\"64\",\"name\":\"Edit User\",\"uid\":\"57\"},{\"id_application_action\":\"65\",\"action\":\"65\",\"name\":\"Delete User\",\"uid\":\"58\"},{\"id_application_action\":\"66\",\"action\":\"66\",\"name\":\"Save\\/Edit User\",\"uid\":\"59\"},{\"id_application_action\":\"67\",\"action\":\"67\",\"name\":\"View Good Receive\",\"uid\":\"60\"},{\"id_application_action\":\"68\",\"action\":\"68\",\"name\":\"Create Good Receive\",\"uid\":\"61\"},{\"id_application_action\":\"69\",\"action\":\"69\",\"name\":\"Edit Good Receive\",\"uid\":\"62\"},{\"id_application_action\":\"70\",\"action\":\"70\",\"name\":\"Delete Good Receive\",\"uid\":\"63\"},{\"id_application_action\":\"71\",\"action\":\"71\",\"name\":\"Save\\/Edit Good Receive\",\"uid\":\"64\"},{\"id_application_action\":\"72\",\"action\":\"72\",\"name\":\"View Sales Order\",\"uid\":\"65\"},{\"id_application_action\":\"73\",\"action\":\"73\",\"name\":\"Create Sales Order\",\"uid\":\"66\"},{\"id_application_action\":\"74\",\"action\":\"74\",\"name\":\"Edit Sales Order\",\"uid\":\"67\"},{\"id_application_action\":\"75\",\"action\":\"75\",\"name\":\"Delete Sales Order\",\"uid\":\"68\"},{\"id_application_action\":\"76\",\"action\":\"76\",\"name\":\"Save Sales Order\",\"uid\":\"69\"},{\"id_application_action\":\"77\",\"action\":\"77\",\"name\":\"View Material Request\",\"uid\":\"70\"},{\"id_application_action\":\"78\",\"action\":\"78\",\"name\":\"Create Material Request\",\"uid\":\"71\"},{\"id_application_action\":\"79\",\"action\":\"79\",\"name\":\"Edit Material Request\",\"uid\":\"72\"},{\"id_application_action\":\"80\",\"action\":\"80\",\"name\":\"Delete Material Request\",\"uid\":\"73\"},{\"id_application_action\":\"81\",\"action\":\"81\",\"name\":\"Save Material Request\",\"uid\":\"74\"},{\"id_application_action\":\"82\",\"action\":\"82\",\"name\":\"Change User Password\",\"uid\":\"75\"},{\"id_application_action\":\"83\",\"action\":\"83\",\"name\":\"View Delivery Note\",\"uid\":\"76\"},{\"id_application_action\":\"84\",\"action\":\"84\",\"name\":\"Create Delivery Note\",\"uid\":\"77\"},{\"id_application_action\":\"85\",\"action\":\"85\",\"name\":\"Edit Delivery Note\",\"uid\":\"78\"},{\"id_application_action\":\"86\",\"action\":\"86\",\"name\":\"Delete Delivery Note\",\"uid\":\"79\"},{\"id_application_action\":\"87\",\"action\":\"87\",\"name\":\"Save\\/Edit Delivery Note\",\"uid\":\"80\"},{\"id_application_action\":\"88\",\"action\":\"88\",\"name\":\"View Unit Measure\",\"uid\":\"81\"},{\"id_application_action\":\"89\",\"action\":\"89\",\"name\":\"Create Unit Measure\",\"uid\":\"82\"},{\"id_application_action\":\"90\",\"action\":\"90\",\"name\":\"Edit Unit Measure\",\"uid\":\"83\"},{\"id_application_action\":\"91\",\"action\":\"91\",\"name\":\"Delete Unit Measure\",\"uid\":\"84\"},{\"id_application_action\":\"92\",\"action\":\"92\",\"name\":\"Save\\/Edit Unit Measure\",\"uid\":\"85\"},{\"id_application_action\":\"93\",\"action\":\"93\",\"name\":\"View Stock\",\"uid\":\"86\"},{\"id_application_action\":\"94\",\"action\":\"94\",\"name\":\"View Employee\",\"uid\":\"87\"},{\"id_application_action\":\"95\",\"action\":\"95\",\"name\":\"Create Employee\",\"uid\":\"88\"},{\"id_application_action\":\"96\",\"action\":\"96\",\"name\":\"Edit Employee\",\"uid\":\"89\"},{\"id_application_action\":\"97\",\"action\":\"97\",\"name\":\"Delete Employee\",\"uid\":\"90\"},{\"id_application_action\":\"98\",\"action\":\"98\",\"name\":\"Save\\/Edit Employee\",\"uid\":\"91\"},{\"id_application_action\":\"99\",\"action\":\"99\",\"name\":\"Validate PO\",\"uid\":\"92\"},{\"id_application_action\":\"100\",\"action\":\"100\",\"name\":\"Create Database Interface\",\"uid\":\"93\"},{\"id_application_action\":\"101\",\"action\":\"101\",\"name\":\"Edit Database Interface\",\"uid\":\"94\"},{\"id_application_action\":\"102\",\"action\":\"102\",\"name\":\"Delete Database Interface\",\"uid\":\"95\"},{\"id_application_action\":\"103\",\"action\":\"103\",\"name\":\"Save \\/ Edit Database Interface\",\"uid\":\"96\"},{\"id_application_action\":\"104\",\"action\":\"104\",\"name\":\"View Database Field Interface\",\"uid\":\"97\"},{\"id_application_action\":\"105\",\"action\":\"105\",\"name\":\"Create Database Field Interface\",\"uid\":\"98\"},{\"id_application_action\":\"106\",\"action\":\"106\",\"name\":\"Edit Database Field Interface\",\"uid\":\"99\"},{\"id_application_action\":\"107\",\"action\":\"107\",\"name\":\"Delete Database Field Interface\",\"uid\":\"100\"},{\"id_application_action\":\"108\",\"action\":\"108\",\"name\":\"Save \\/ Edit Database Field Interface\",\"uid\":\"101\"},{\"id_application_action\":\"109\",\"action\":\"109\",\"name\":\"View Inquiry\",\"uid\":\"102\"},{\"id_application_action\":\"110\",\"action\":\"110\",\"name\":\"Create Inquiry\",\"uid\":\"103\"},{\"id_application_action\":\"111\",\"action\":\"111\",\"name\":\"Edit Inquiry\",\"uid\":\"104\"},{\"id_application_action\":\"112\",\"action\":\"112\",\"name\":\"Delete Inquiry\",\"uid\":\"105\"},{\"id_application_action\":\"113\",\"action\":\"113\",\"name\":\"Save\\/Edit Inquiry\",\"uid\":\"106\"},{\"id_application_action\":\"114\",\"action\":\"114\",\"name\":\"View Survey \\/ Assessment\",\"uid\":\"107\"},{\"id_application_action\":\"115\",\"action\":\"115\",\"name\":\"Create Survey \\/ Assessment\",\"uid\":\"108\"},{\"id_application_action\":\"116\",\"action\":\"116\",\"name\":\"Edit Survey \\/ Assessment\",\"uid\":\"109\"},{\"id_application_action\":\"117\",\"action\":\"117\",\"name\":\"Delete Survey \\/ Assessment\",\"uid\":\"110\"},{\"id_application_action\":\"118\",\"action\":\"118\",\"name\":\"Save\\/Edit Survey \\/ Assessment\",\"uid\":\"111\"},{\"id_application_action\":\"119\",\"action\":\"119\",\"name\":\"View Quotation\",\"uid\":\"112\"},{\"id_application_action\":\"120\",\"action\":\"120\",\"name\":\"Create Quotation\",\"uid\":\"113\"},{\"id_application_action\":\"121\",\"action\":\"121\",\"name\":\"Edit Quotation\",\"uid\":\"114\"},{\"id_application_action\":\"122\",\"action\":\"122\",\"name\":\"Delete Quotation\",\"uid\":\"115\"},{\"id_application_action\":\"123\",\"action\":\"123\",\"name\":\"Save\\/Edit Quotation\",\"uid\":\"116\"},{\"id_application_action\":\"124\",\"action\":\"124\",\"name\":\"View Project Contract\",\"uid\":\"117\"},{\"id_application_action\":\"125\",\"action\":\"125\",\"name\":\"Create Project Contract\",\"uid\":\"118\"},{\"id_application_action\":\"126\",\"action\":\"126\",\"name\":\"Edit Project Contract\",\"uid\":\"119\"},{\"id_application_action\":\"127\",\"action\":\"127\",\"name\":\"Delete Project Contract\",\"uid\":\"120\"},{\"id_application_action\":\"128\",\"action\":\"128\",\"name\":\"Save\\/Edit Project Contract\",\"uid\":\"121\"},{\"id_application_action\":\"129\",\"action\":\"129\",\"name\":\"View Work Order\",\"uid\":\"122\"},{\"id_application_action\":\"130\",\"action\":\"130\",\"name\":\"Create Work Order\",\"uid\":\"123\"},{\"id_application_action\":\"131\",\"action\":\"131\",\"name\":\"Edit Work Order\",\"uid\":\"124\"},{\"id_application_action\":\"132\",\"action\":\"132\",\"name\":\"Delete Work Order\",\"uid\":\"125\"},{\"id_application_action\":\"133\",\"action\":\"133\",\"name\":\"Save\\/Edit Work Order\",\"uid\":\"126\"},{\"id_application_action\":\"134\",\"action\":\"134\",\"name\":\"View Assessment Template\",\"uid\":\"127\"},{\"id_application_action\":\"135\",\"action\":\"135\",\"name\":\"Create Assessment Template\",\"uid\":\"128\"},{\"id_application_action\":\"136\",\"action\":\"136\",\"name\":\"Edit Assessment Template\",\"uid\":\"129\"},{\"id_application_action\":\"137\",\"action\":\"137\",\"name\":\"Delete Assessment Template\",\"uid\":\"130\"},{\"id_application_action\":\"138\",\"action\":\"138\",\"name\":\"Save\\/Edit Assessment Template\",\"uid\":\"131\"},{\"id_application_action\":\"139\",\"action\":\"139\",\"name\":\"View Contract Template\",\"uid\":\"132\"},{\"id_application_action\":\"140\",\"action\":\"140\",\"name\":\"Create Contract Template\",\"uid\":\"133\"},{\"id_application_action\":\"141\",\"action\":\"141\",\"name\":\"Edit Contract Template\",\"uid\":\"134\"},{\"id_application_action\":\"142\",\"action\":\"142\",\"name\":\"Delete Contract Template\",\"uid\":\"135\"},{\"id_application_action\":\"143\",\"action\":\"143\",\"name\":\"Save\\/Edit Contract Template\",\"uid\":\"136\"},{\"id_application_action\":\"144\",\"action\":\"144\",\"name\":\"View Work Schedule\",\"uid\":\"137\"},{\"id_application_action\":\"145\",\"action\":\"145\",\"name\":\"Create Work Schedule\",\"uid\":\"138\"},{\"id_application_action\":\"146\",\"action\":\"146\",\"name\":\"Edit Work Schedule\",\"uid\":\"139\"},{\"id_application_action\":\"147\",\"action\":\"147\",\"name\":\"Delete Work Schedule\",\"uid\":\"140\"},{\"id_application_action\":\"148\",\"action\":\"148\",\"name\":\"Save\\/Edit Work Schedule\",\"uid\":\"141\"},{\"id_application_action\":\"149\",\"action\":\"149\",\"name\":\"View SO Assignment\",\"uid\":\"142\"},{\"id_application_action\":\"150\",\"action\":\"150\",\"name\":\"Create SO Assignment\",\"uid\":\"143\"},{\"id_application_action\":\"151\",\"action\":\"151\",\"name\":\"Edit SO Assignment\",\"uid\":\"144\"},{\"id_application_action\":\"152\",\"action\":\"152\",\"name\":\"Delete SO Assignment\",\"uid\":\"145\"},{\"id_application_action\":\"153\",\"action\":\"153\",\"name\":\"Save\\/Edit SO Assignment\",\"uid\":\"146\"},{\"id_application_action\":\"154\",\"action\":\"154\",\"name\":\"View Shift Change\",\"uid\":\"147\"},{\"id_application_action\":\"155\",\"action\":\"155\",\"name\":\"Create Shift Change\",\"uid\":\"148\"},{\"id_application_action\":\"156\",\"action\":\"156\",\"name\":\"Edit Shift Change\",\"uid\":\"149\"},{\"id_application_action\":\"157\",\"action\":\"157\",\"name\":\"Delete Shift Change\",\"uid\":\"150\"},{\"id_application_action\":\"158\",\"action\":\"158\",\"name\":\"Save\\/Edit Shift Change\",\"uid\":\"151\"},{\"id_application_action\":\"159\",\"action\":\"159\",\"name\":\"View Leave Application\",\"uid\":\"152\"},{\"id_application_action\":\"160\",\"action\":\"160\",\"name\":\"Create Leave Application\",\"uid\":\"153\"},{\"id_application_action\":\"161\",\"action\":\"161\",\"name\":\"Edit Leave Application\",\"uid\":\"154\"},{\"id_application_action\":\"162\",\"action\":\"162\",\"name\":\"Delete Leave Application\",\"uid\":\"155\"},{\"id_application_action\":\"163\",\"action\":\"163\",\"name\":\"Save\\/Edit Leave Application\",\"uid\":\"156\"},{\"id_application_action\":\"164\",\"action\":\"164\",\"name\":\"View Timesheet (Recap)\",\"uid\":\"157\"},{\"id_application_action\":\"165\",\"action\":\"165\",\"name\":\"Create Timesheet (Recap)\",\"uid\":\"158\"},{\"id_application_action\":\"166\",\"action\":\"166\",\"name\":\"Edit Timesheet (Recap)\",\"uid\":\"159\"},{\"id_application_action\":\"167\",\"action\":\"167\",\"name\":\"Delete Timesheet (Recap)\",\"uid\":\"160\"},{\"id_application_action\":\"168\",\"action\":\"168\",\"name\":\"Save\\/Edit Timesheet (Recap)\",\"uid\":\"161\"},{\"id_application_action\":\"169\",\"action\":\"169\",\"name\":\"View SO Timesheet\",\"uid\":\"162\"},{\"id_application_action\":\"170\",\"action\":\"170\",\"name\":\"Create SO Timesheet\",\"uid\":\"163\"},{\"id_application_action\":\"171\",\"action\":\"171\",\"name\":\"Edit SO Timesheet\",\"uid\":\"164\"},{\"id_application_action\":\"172\",\"action\":\"172\",\"name\":\"Delete SO Timesheet\",\"uid\":\"165\"},{\"id_application_action\":\"173\",\"action\":\"173\",\"name\":\"Save\\/Edit SO Timesheet\",\"uid\":\"166\"},{\"id_application_action\":\"174\",\"action\":\"174\",\"name\":\"View Incident Report\",\"uid\":\"167\"},{\"id_application_action\":\"175\",\"action\":\"175\",\"name\":\"Create Incident Report\",\"uid\":\"168\"},{\"id_application_action\":\"176\",\"action\":\"176\",\"name\":\"Edit Incident Report\",\"uid\":\"169\"},{\"id_application_action\":\"177\",\"action\":\"177\",\"name\":\"Delete Incident Report\",\"uid\":\"170\"},{\"id_application_action\":\"178\",\"action\":\"178\",\"name\":\"Save\\/Edit Incident Report\",\"uid\":\"171\"},{\"id_application_action\":\"179\",\"action\":\"179\",\"name\":\"View Payroll\",\"uid\":\"172\"},{\"id_application_action\":\"180\",\"action\":\"180\",\"name\":\"Create Payroll\",\"uid\":\"173\"},{\"id_application_action\":\"181\",\"action\":\"181\",\"name\":\"Edit Payroll\",\"uid\":\"174\"},{\"id_application_action\":\"182\",\"action\":\"182\",\"name\":\"Delete Payroll\",\"uid\":\"175\"},{\"id_application_action\":\"183\",\"action\":\"183\",\"name\":\"Save\\/Edit Payroll\",\"uid\":\"176\"},{\"id_application_action\":\"184\",\"action\":\"184\",\"name\":\"View Supplier Invoice\",\"uid\":\"177\"},{\"id_application_action\":\"185\",\"action\":\"185\",\"name\":\"Create Supplier Invoice\",\"uid\":\"178\"},{\"id_application_action\":\"186\",\"action\":\"186\",\"name\":\"Edit Supplier Invoice\",\"uid\":\"179\"},{\"id_application_action\":\"187\",\"action\":\"187\",\"name\":\"Delete Supplier Invoice\",\"uid\":\"180\"},{\"id_application_action\":\"188\",\"action\":\"188\",\"name\":\"Save\\/Edit Supplier Invoice\",\"uid\":\"181\"},{\"id_application_action\":\"189\",\"action\":\"189\",\"name\":\"View Customer Invoice\",\"uid\":\"182\"},{\"id_application_action\":\"190\",\"action\":\"190\",\"name\":\"Create Customer Invoice\",\"uid\":\"183\"},{\"id_application_action\":\"191\",\"action\":\"191\",\"name\":\"Edit Customer Invoice\",\"uid\":\"184\"},{\"id_application_action\":\"192\",\"action\":\"192\",\"name\":\"Delete Customer Invoice\",\"uid\":\"185\"},{\"id_application_action\":\"193\",\"action\":\"193\",\"name\":\"Save\\/Edit Customer Invoice\",\"uid\":\"186\"},{\"id_application_action\":\"194\",\"action\":\"194\",\"name\":\"View Bank Statement\",\"uid\":\"187\"},{\"id_application_action\":\"195\",\"action\":\"195\",\"name\":\"Create Bank Statement\",\"uid\":\"188\"},{\"id_application_action\":\"196\",\"action\":\"196\",\"name\":\"Edit Bank Statement\",\"uid\":\"189\"},{\"id_application_action\":\"197\",\"action\":\"197\",\"name\":\"Delete Bank Statement\",\"uid\":\"190\"},{\"id_application_action\":\"198\",\"action\":\"198\",\"name\":\"Save\\/Edit Bank Statement\",\"uid\":\"191\"},{\"id_application_action\":\"199\",\"action\":\"199\",\"name\":\"View Cash Register\",\"uid\":\"192\"},{\"id_application_action\":\"200\",\"action\":\"200\",\"name\":\"Create Cash Register\",\"uid\":\"193\"},{\"id_application_action\":\"201\",\"action\":\"201\",\"name\":\"Edit Cash Register\",\"uid\":\"194\"},{\"id_application_action\":\"202\",\"action\":\"202\",\"name\":\"Delete Cash Register\",\"uid\":\"195\"},{\"id_application_action\":\"203\",\"action\":\"203\",\"name\":\"Save\\/Edit Cash Register\",\"uid\":\"196\"},{\"id_application_action\":\"204\",\"action\":\"204\",\"name\":\"View Tax\",\"uid\":\"197\"},{\"id_application_action\":\"205\",\"action\":\"205\",\"name\":\"Create Tax\",\"uid\":\"198\"},{\"id_application_action\":\"206\",\"action\":\"206\",\"name\":\"Edit Tax\",\"uid\":\"199\"},{\"id_application_action\":\"207\",\"action\":\"207\",\"name\":\"Delete Tax\",\"uid\":\"200\"},{\"id_application_action\":\"208\",\"action\":\"208\",\"name\":\"Save\\/Edit Tax\",\"uid\":\"201\"},{\"id_application_action\":\"209\",\"action\":\"209\",\"name\":\"View Chart of Account\",\"uid\":\"202\"},{\"id_application_action\":\"210\",\"action\":\"210\",\"name\":\"Create Chart of Account\",\"uid\":\"203\"},{\"id_application_action\":\"211\",\"action\":\"211\",\"name\":\"Edit Chart of Account\",\"uid\":\"204\"},{\"id_application_action\":\"212\",\"action\":\"212\",\"name\":\"Delete Chart of Account\",\"uid\":\"205\"},{\"id_application_action\":\"213\",\"action\":\"213\",\"name\":\"Save\\/Edit Chart of Account\",\"uid\":\"206\"},{\"id_application_action\":\"214\",\"action\":\"214\",\"name\":\"View Employee Salary\",\"uid\":\"207\"},{\"id_application_action\":\"215\",\"action\":\"215\",\"name\":\"Create Employee Salary\",\"uid\":\"208\"},{\"id_application_action\":\"216\",\"action\":\"216\",\"name\":\"Edit Employee Salary\",\"uid\":\"209\"},{\"id_application_action\":\"217\",\"action\":\"217\",\"name\":\"Delete Employee Salary\",\"uid\":\"210\"},{\"id_application_action\":\"218\",\"action\":\"218\",\"name\":\"Save\\/Edit Employee Salary\",\"uid\":\"211\"},{\"id_application_action\":\"219\",\"action\":\"219\",\"name\":\"View Salary Setting\",\"uid\":\"212\"},{\"id_application_action\":\"220\",\"action\":\"220\",\"name\":\"Create Salary Setting\",\"uid\":\"213\"},{\"id_application_action\":\"221\",\"action\":\"221\",\"name\":\"Edit Salary Setting\",\"uid\":\"214\"},{\"id_application_action\":\"222\",\"action\":\"222\",\"name\":\"Delete Salary Setting\",\"uid\":\"215\"},{\"id_application_action\":\"223\",\"action\":\"223\",\"name\":\"Save\\/Edit Salary Setting\",\"uid\":\"216\"},{\"id_application_action\":\"224\",\"action\":\"224\",\"name\":\"View Database Interface\",\"uid\":\"217\"},{\"id_application_action\":\"226\",\"action\":\"226\",\"name\":\"View Organisation Structure\",\"uid\":\"218\"},{\"id_application_action\":\"227\",\"action\":\"227\",\"name\":\"Create Organisation Structure\",\"uid\":\"219\"},{\"id_application_action\":\"228\",\"action\":\"228\",\"name\":\"Edit Organisation Structure\",\"uid\":\"220\"},{\"id_application_action\":\"229\",\"action\":\"229\",\"name\":\"Delete Organisation Structure\",\"uid\":\"221\"},{\"id_application_action\":\"230\",\"action\":\"230\",\"name\":\"Save\\/Edit Organisation Structure\",\"uid\":\"222\"},{\"id_application_action\":\"231\",\"action\":\"231\",\"name\":\"View Position Level\",\"uid\":\"223\"},{\"id_application_action\":\"232\",\"action\":\"232\",\"name\":\"Create Position Level\",\"uid\":\"224\"},{\"id_application_action\":\"233\",\"action\":\"233\",\"name\":\"Edit Position Level\",\"uid\":\"225\"},{\"id_application_action\":\"234\",\"action\":\"234\",\"name\":\"Delete Position Level\",\"uid\":\"226\"},{\"id_application_action\":\"235\",\"action\":\"235\",\"name\":\"Save\\/Edit Position Level\",\"uid\":\"227\"},{\"id_application_action\":\"236\",\"action\":\"236\",\"name\":\"View Employee Contract Type\",\"uid\":\"228\"},{\"id_application_action\":\"237\",\"action\":\"237\",\"name\":\"Create Employee Contract Type\",\"uid\":\"229\"},{\"id_application_action\":\"238\",\"action\":\"238\",\"name\":\"Edit Employee Contract Type\",\"uid\":\"230\"},{\"id_application_action\":\"239\",\"action\":\"239\",\"name\":\"Delete Employee Contract Type\",\"uid\":\"231\"},{\"id_application_action\":\"240\",\"action\":\"240\",\"name\":\"Save\\/Edit Employee Contract\",\"uid\":\"232\"},{\"id_application_action\":\"241\",\"name\":\"View Bank\",\"uid\":\"233\",\"id\":\"233\"},{\"id_application_action\":\"242\",\"name\":\"Create Bank\",\"uid\":\"234\",\"id\":\"234\"},{\"id_application_action\":\"243\",\"name\":\"Edit Bank\",\"uid\":\"235\",\"id\":\"235\"},{\"id_application_action\":\"244\",\"name\":\"Delete Bank\",\"uid\":\"236\",\"id\":\"236\"},{\"id_application_action\":\"245\",\"name\":\"Save\\/Edit Bank\",\"uid\":\"237\",\"id\":\"237\"},{\"id_application_action\":\"225\",\"name\":\"Pick Assessment Template\",\"uid\":\"238\",\"id\":\"238\"}],\"is_edit\":\"true\",\"id_role\":\"1\"}', '2015-01-22 15:16:00');
INSERT INTO `activity_log` VALUES ('94', 'Save/Edit Side Menu', 'side_menu', null, '2', 'Save/Edit Side Menu', '9', '{}', '2015-01-22 17:18:48');
INSERT INTO `activity_log` VALUES ('95', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"Save\\/Edit Good Receive\",\"controller\":\"gr\",\"function_exec\":\"save_gr\",\"function_args\":\"\",\"view_type\":\"no_view\",\"view_file\":\"\",\"prefix\":\"\",\"action_type\":\"create\",\"action_button\":\"save_discard\",\"target_action\":\"67\",\"action_condition\":[{\"identifier\":\"from_po\",\"target_action\":\"69\",\"target_action_name\":\"Edit Good Receive\",\"uid\":\"0\"}],\"use_log\":\"1\",\"is_edit\":\"true\",\"id_edit\":\"71\"}', '2015-01-24 23:12:03');
INSERT INTO `activity_log` VALUES ('96', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"Save\\/Edit Payment Receipt\",\"controller\":\"payment_receipt\",\"function_exec\":\"save_payment_receipt\",\"function_args\":\"\",\"view_type\":\"no_view\",\"view_file\":\"\",\"prefix\":\"\",\"action_type\":\"create\",\"action_button\":\"crud\",\"target_action\":\"246\",\"action_condition\":[{\"identifier\":\"make_payment\",\"target_action\":\"252\",\"target_action_name\":\"Make Payment Receipt\",\"uid\":\"0\"}],\"use_log\":\"1\",\"is_edit\":\"true\",\"id_edit\":\"249\"}', '2015-01-24 23:13:23');
INSERT INTO `activity_log` VALUES ('97', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"Edit Good Receive\",\"controller\":\"gr\",\"function_exec\":\"init_edit_gr\",\"function_args\":\"id\",\"view_type\":\"form\",\"view_file\":\"gr_ce\",\"prefix\":\"\",\"action_type\":\"update\",\"action_button\":\"save_discard\",\"target_action\":\"\",\"use_log\":\"0\",\"is_edit\":\"true\",\"id_edit\":\"69\"}', '2015-01-24 23:13:44');
INSERT INTO `activity_log` VALUES ('98', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"Create Good Receive\",\"controller\":\"gr\",\"function_exec\":\"init_create_gr\",\"function_args\":\"\",\"view_type\":\"form\",\"view_file\":\"gr_ce\",\"prefix\":\"\",\"action_type\":\"view\",\"action_button\":\"save_discard\",\"target_action\":\"\",\"use_log\":\"0\",\"is_edit\":\"true\",\"id_edit\":\"68\"}', '2015-01-24 23:13:56');
INSERT INTO `activity_log` VALUES ('99', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"Delete Payment Receipt\",\"controller\":\"payment_receipt\",\"function_exec\":\"delete_payment_receipt\",\"function_args\":\"\",\"view_type\":\"no_view\",\"view_file\":\"\",\"prefix\":\"\",\"action_type\":\"delete\",\"action_button\":\"crud\",\"target_action\":\"246\",\"use_log\":\"1\",\"is_edit\":\"true\",\"id_edit\":\"250\"}', '2015-01-24 23:14:15');
INSERT INTO `activity_log` VALUES ('100', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"Cancel Payment Receipt\",\"controller\":\"payment_receipt\",\"function_exec\":\"cancel_payment_receipt\",\"function_args\":\"\",\"view_type\":\"no_view\",\"view_file\":\"\",\"prefix\":\"\",\"action_type\":\"update\",\"action_button\":\"crud\",\"target_action\":\"246\",\"use_log\":\"1\",\"is_edit\":\"true\",\"id_edit\":\"253\"}', '2015-01-24 23:14:31');
INSERT INTO `activity_log` VALUES ('101', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"Receive Payment From PO\",\"controller\":\"payment_receipt\",\"function_exec\":\"receive_payment_from_po\",\"function_args\":\"id\",\"view_type\":\"no_view\",\"view_file\":\"\",\"prefix\":\"\",\"action_type\":\"create\",\"action_button\":\"crud\",\"target_action\":\"246\",\"use_log\":\"1\",\"is_edit\":\"true\",\"id_edit\":\"251\"}', '2015-01-24 23:14:45');
INSERT INTO `activity_log` VALUES ('102', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"Make Payment Receipt\",\"controller\":\"payment_receipt\",\"function_exec\":\"make_payment_receipt\",\"function_args\":\"id\",\"view_type\":\"no_view\",\"view_file\":\"\",\"prefix\":\"\",\"action_type\":\"create\",\"action_button\":\"crud\",\"target_action\":\"248\",\"use_log\":\"1\",\"is_edit\":\"true\",\"id_edit\":\"252\"}', '2015-01-24 23:15:40');
INSERT INTO `activity_log` VALUES ('103', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"Save\\/Edit Stock Transaction\",\"controller\":\"stock_transaction\",\"function_exec\":\"save_stock_transaction\",\"function_args\":\"\",\"view_type\":\"no_view\",\"view_file\":\"\",\"prefix\":\"\",\"action_type\":\"create\",\"action_button\":\"crud\",\"target_action\":\"254\",\"use_log\":\"1\",\"is_edit\":\"true\",\"id_edit\":\"258\"}', '2015-01-24 23:16:35');
INSERT INTO `activity_log` VALUES ('104', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"Post Stock Transaction\",\"controller\":\"stock_transaction\",\"function_exec\":\"post_stock_transaction\",\"function_args\":\"id\",\"view_type\":\"no_view\",\"view_file\":\"\",\"prefix\":\"\",\"action_type\":\"update\",\"action_button\":\"crud\",\"target_action\":\"254\",\"use_log\":\"1\",\"is_edit\":\"true\",\"id_edit\":\"259\"}', '2015-01-24 23:17:42');
INSERT INTO `activity_log` VALUES ('105', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"Unpost Stock Transaction\",\"controller\":\"stock_transaction\",\"function_exec\":\"unpost_stock_transaction\",\"function_args\":\"id\",\"view_type\":\"no_view\",\"view_file\":\"\",\"prefix\":\"\",\"action_type\":\"update\",\"action_button\":\"crud\",\"target_action\":\"254\",\"use_log\":\"1\",\"is_edit\":\"true\",\"id_edit\":\"260\"}', '2015-01-24 23:17:53');
INSERT INTO `activity_log` VALUES ('106', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"Post Stock Transaction\",\"controller\":\"stock_transaction\",\"function_exec\":\"post_stock_transaction\",\"function_args\":\"id\",\"view_type\":\"no_view\",\"view_file\":\"\",\"prefix\":\"\",\"action_type\":\"update\",\"action_button\":\"crud\",\"target_action\":\"256\",\"use_log\":\"1\",\"is_edit\":\"true\",\"id_edit\":\"259\"}', '2015-01-24 23:18:03');
INSERT INTO `activity_log` VALUES ('107', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"Unpost Stock Transaction\",\"controller\":\"stock_transaction\",\"function_exec\":\"unpost_stock_transaction\",\"function_args\":\"id\",\"view_type\":\"no_view\",\"view_file\":\"\",\"prefix\":\"\",\"action_type\":\"update\",\"action_button\":\"crud\",\"target_action\":\"256\",\"use_log\":\"1\",\"is_edit\":\"true\",\"id_edit\":\"260\"}', '2015-01-24 23:18:14');
INSERT INTO `activity_log` VALUES ('108', 'Save/Edit Side Menu', 'side_menu', null, '2', 'Save/Edit Side Menu', '9', '{}', '2015-01-24 23:18:38');
INSERT INTO `activity_log` VALUES ('109', 'Save/Edit Side Menu', 'side_menu', null, '2', 'Save/Edit Side Menu', '9', '{}', '2015-01-24 23:19:13');
INSERT INTO `activity_log` VALUES ('110', 'Save/Edit Role', 'role', null, '2', 'Save/Edit Role', '20', '{\"name\":\"administrator\",\"action_detail\":[{\"id_application_action\":\"1\",\"action\":\"1\",\"name\":\"View Application Action\",\"uid\":\"0\"},{\"id_application_action\":\"2\",\"action\":\"2\",\"name\":\"Create Application Action\",\"uid\":\"1\"},{\"id_application_action\":\"3\",\"action\":\"3\",\"name\":\"Edit Application Action\",\"uid\":\"2\"},{\"id_application_action\":\"4\",\"action\":\"4\",\"name\":\"Delete Application Action\",\"uid\":\"3\"},{\"id_application_action\":\"5\",\"action\":\"5\",\"name\":\"View Side Menu\",\"uid\":\"4\"},{\"id_application_action\":\"6\",\"action\":\"6\",\"name\":\"Create Side Menu\",\"uid\":\"5\"},{\"id_application_action\":\"7\",\"action\":\"7\",\"name\":\"Edit Side Menu\",\"uid\":\"6\"},{\"id_application_action\":\"8\",\"action\":\"8\",\"name\":\"Delete Side Menu\",\"uid\":\"7\"},{\"id_application_action\":\"9\",\"action\":\"9\",\"name\":\"Save\\/Edit Side Menu\",\"uid\":\"8\"},{\"id_application_action\":\"10\",\"action\":\"10\",\"name\":\"Save\\/Edit Action\",\"uid\":\"9\"},{\"id_application_action\":\"11\",\"action\":\"11\",\"name\":\"View Division\",\"uid\":\"10\"},{\"id_application_action\":\"12\",\"action\":\"12\",\"name\":\"Create Division\",\"uid\":\"11\"},{\"id_application_action\":\"13\",\"action\":\"13\",\"name\":\"Save\\/Edit Division\",\"uid\":\"12\"},{\"id_application_action\":\"14\",\"action\":\"14\",\"name\":\"Edit Division\",\"uid\":\"13\"},{\"id_application_action\":\"15\",\"action\":\"15\",\"name\":\"Delete Division\",\"uid\":\"14\"},{\"id_application_action\":\"16\",\"action\":\"16\",\"name\":\"View Role\",\"uid\":\"15\"},{\"id_application_action\":\"17\",\"action\":\"17\",\"name\":\"View Create Role\",\"uid\":\"16\"},{\"id_application_action\":\"18\",\"action\":\"18\",\"name\":\"View Edit Role\",\"uid\":\"17\"},{\"id_application_action\":\"19\",\"action\":\"19\",\"name\":\"Delete Role\",\"uid\":\"18\"},{\"id_application_action\":\"20\",\"action\":\"20\",\"name\":\"Save\\/Edit Role\",\"uid\":\"19\"},{\"id_application_action\":\"21\",\"action\":\"21\",\"name\":\"View Product\",\"uid\":\"20\"},{\"id_application_action\":\"22\",\"action\":\"22\",\"name\":\"Create Product\",\"uid\":\"21\"},{\"id_application_action\":\"23\",\"action\":\"23\",\"name\":\"Edit Product\",\"uid\":\"22\"},{\"id_application_action\":\"24\",\"action\":\"24\",\"name\":\"Delete Product\",\"uid\":\"23\"},{\"id_application_action\":\"25\",\"action\":\"25\",\"name\":\"Save\\/Edit Product\",\"uid\":\"24\"},{\"id_application_action\":\"26\",\"action\":\"26\",\"name\":\"View Supplier\",\"uid\":\"25\"},{\"id_application_action\":\"27\",\"action\":\"27\",\"name\":\"Create Supplier\",\"uid\":\"26\"},{\"id_application_action\":\"28\",\"action\":\"28\",\"name\":\"Edit Supplier\",\"uid\":\"27\"},{\"id_application_action\":\"29\",\"action\":\"29\",\"name\":\"Delete Supplier\",\"uid\":\"28\"},{\"id_application_action\":\"30\",\"action\":\"30\",\"name\":\"Save\\/Edit Supplier\",\"uid\":\"29\"},{\"id_application_action\":\"31\",\"action\":\"31\",\"name\":\"View Product Category\",\"uid\":\"30\"},{\"id_application_action\":\"32\",\"action\":\"32\",\"name\":\"Create Product Category\",\"uid\":\"31\"},{\"id_application_action\":\"33\",\"action\":\"33\",\"name\":\"Edit Product Category\",\"uid\":\"32\"},{\"id_application_action\":\"34\",\"action\":\"34\",\"name\":\"Delete Product Category\",\"uid\":\"33\"},{\"id_application_action\":\"35\",\"action\":\"35\",\"name\":\"Save\\/Edit Product Category\",\"uid\":\"34\"},{\"id_application_action\":\"36\",\"action\":\"36\",\"name\":\"View Merk\",\"uid\":\"35\"},{\"id_application_action\":\"37\",\"action\":\"37\",\"name\":\"Create Merk\",\"uid\":\"36\"},{\"id_application_action\":\"38\",\"action\":\"38\",\"name\":\"Edit Merk\",\"uid\":\"37\"},{\"id_application_action\":\"39\",\"action\":\"39\",\"name\":\"Delete Merk\",\"uid\":\"38\"},{\"id_application_action\":\"40\",\"action\":\"40\",\"name\":\"Save\\/Edit Merk\",\"uid\":\"39\"},{\"id_application_action\":\"41\",\"action\":\"41\",\"name\":\"View Customer\",\"uid\":\"40\"},{\"id_application_action\":\"43\",\"action\":\"43\",\"name\":\"Create Customer\",\"uid\":\"41\"},{\"id_application_action\":\"44\",\"action\":\"44\",\"name\":\"Edit Customer\",\"uid\":\"42\"},{\"id_application_action\":\"45\",\"action\":\"45\",\"name\":\"Delete Customer\",\"uid\":\"43\"},{\"id_application_action\":\"46\",\"action\":\"46\",\"name\":\"Save\\/Edit Customer\",\"uid\":\"44\"},{\"id_application_action\":\"47\",\"action\":\"47\",\"name\":\"View Warehouse\",\"uid\":\"45\"},{\"id_application_action\":\"48\",\"action\":\"48\",\"name\":\"Create Warehouse\",\"uid\":\"46\"},{\"id_application_action\":\"49\",\"action\":\"49\",\"name\":\"Edit Warehouse\",\"uid\":\"47\"},{\"id_application_action\":\"50\",\"action\":\"50\",\"name\":\"Delete Warehouse\",\"uid\":\"48\"},{\"id_application_action\":\"51\",\"action\":\"51\",\"name\":\"Save\\/Edit Warehouse\",\"uid\":\"49\"},{\"id_application_action\":\"57\",\"action\":\"57\",\"name\":\"View PO\",\"uid\":\"50\"},{\"id_application_action\":\"58\",\"action\":\"58\",\"name\":\"Create PO\",\"uid\":\"51\"},{\"id_application_action\":\"59\",\"action\":\"59\",\"name\":\"Edit PO\",\"uid\":\"52\"},{\"id_application_action\":\"60\",\"action\":\"60\",\"name\":\"Delete PO\",\"uid\":\"53\"},{\"id_application_action\":\"61\",\"action\":\"61\",\"name\":\"Save\\/Edit PO\",\"uid\":\"54\"},{\"id_application_action\":\"62\",\"action\":\"62\",\"name\":\"View User\",\"uid\":\"55\"},{\"id_application_action\":\"63\",\"action\":\"63\",\"name\":\"Create User\",\"uid\":\"56\"},{\"id_application_action\":\"64\",\"action\":\"64\",\"name\":\"Edit User\",\"uid\":\"57\"},{\"id_application_action\":\"65\",\"action\":\"65\",\"name\":\"Delete User\",\"uid\":\"58\"},{\"id_application_action\":\"66\",\"action\":\"66\",\"name\":\"Save\\/Edit User\",\"uid\":\"59\"},{\"id_application_action\":\"67\",\"action\":\"67\",\"name\":\"View Good Receive\",\"uid\":\"60\"},{\"id_application_action\":\"68\",\"action\":\"68\",\"name\":\"Create Good Receive\",\"uid\":\"61\"},{\"id_application_action\":\"69\",\"action\":\"69\",\"name\":\"Edit Good Receive\",\"uid\":\"62\"},{\"id_application_action\":\"70\",\"action\":\"70\",\"name\":\"Delete Good Receive\",\"uid\":\"63\"},{\"id_application_action\":\"71\",\"action\":\"71\",\"name\":\"Save\\/Edit Good Receive\",\"uid\":\"64\"},{\"id_application_action\":\"72\",\"action\":\"72\",\"name\":\"View Sales Order\",\"uid\":\"65\"},{\"id_application_action\":\"73\",\"action\":\"73\",\"name\":\"Create Sales Order\",\"uid\":\"66\"},{\"id_application_action\":\"74\",\"action\":\"74\",\"name\":\"Edit Sales Order\",\"uid\":\"67\"},{\"id_application_action\":\"75\",\"action\":\"75\",\"name\":\"Delete Sales Order\",\"uid\":\"68\"},{\"id_application_action\":\"76\",\"action\":\"76\",\"name\":\"Save Sales Order\",\"uid\":\"69\"},{\"id_application_action\":\"77\",\"action\":\"77\",\"name\":\"View Material Request\",\"uid\":\"70\"},{\"id_application_action\":\"78\",\"action\":\"78\",\"name\":\"Create Material Request\",\"uid\":\"71\"},{\"id_application_action\":\"79\",\"action\":\"79\",\"name\":\"Edit Material Request\",\"uid\":\"72\"},{\"id_application_action\":\"80\",\"action\":\"80\",\"name\":\"Delete Material Request\",\"uid\":\"73\"},{\"id_application_action\":\"81\",\"action\":\"81\",\"name\":\"Save Material Request\",\"uid\":\"74\"},{\"id_application_action\":\"82\",\"action\":\"82\",\"name\":\"Change User Password\",\"uid\":\"75\"},{\"id_application_action\":\"83\",\"action\":\"83\",\"name\":\"View Delivery Note\",\"uid\":\"76\"},{\"id_application_action\":\"84\",\"action\":\"84\",\"name\":\"Create Delivery Note\",\"uid\":\"77\"},{\"id_application_action\":\"85\",\"action\":\"85\",\"name\":\"Edit Delivery Note\",\"uid\":\"78\"},{\"id_application_action\":\"86\",\"action\":\"86\",\"name\":\"Delete Delivery Note\",\"uid\":\"79\"},{\"id_application_action\":\"87\",\"action\":\"87\",\"name\":\"Save\\/Edit Delivery Note\",\"uid\":\"80\"},{\"id_application_action\":\"88\",\"action\":\"88\",\"name\":\"View Unit Measure\",\"uid\":\"81\"},{\"id_application_action\":\"89\",\"action\":\"89\",\"name\":\"Create Unit Measure\",\"uid\":\"82\"},{\"id_application_action\":\"90\",\"action\":\"90\",\"name\":\"Edit Unit Measure\",\"uid\":\"83\"},{\"id_application_action\":\"91\",\"action\":\"91\",\"name\":\"Delete Unit Measure\",\"uid\":\"84\"},{\"id_application_action\":\"92\",\"action\":\"92\",\"name\":\"Save\\/Edit Unit Measure\",\"uid\":\"85\"},{\"id_application_action\":\"93\",\"action\":\"93\",\"name\":\"View Stock\",\"uid\":\"86\"},{\"id_application_action\":\"94\",\"action\":\"94\",\"name\":\"View Employee\",\"uid\":\"87\"},{\"id_application_action\":\"95\",\"action\":\"95\",\"name\":\"Create Employee\",\"uid\":\"88\"},{\"id_application_action\":\"96\",\"action\":\"96\",\"name\":\"Edit Employee\",\"uid\":\"89\"},{\"id_application_action\":\"97\",\"action\":\"97\",\"name\":\"Delete Employee\",\"uid\":\"90\"},{\"id_application_action\":\"98\",\"action\":\"98\",\"name\":\"Save\\/Edit Employee\",\"uid\":\"91\"},{\"id_application_action\":\"99\",\"action\":\"99\",\"name\":\"Validate PO\",\"uid\":\"92\"},{\"id_application_action\":\"100\",\"action\":\"100\",\"name\":\"Create Database Interface\",\"uid\":\"93\"},{\"id_application_action\":\"101\",\"action\":\"101\",\"name\":\"Edit Database Interface\",\"uid\":\"94\"},{\"id_application_action\":\"102\",\"action\":\"102\",\"name\":\"Delete Database Interface\",\"uid\":\"95\"},{\"id_application_action\":\"103\",\"action\":\"103\",\"name\":\"Save \\/ Edit Database Interface\",\"uid\":\"96\"},{\"id_application_action\":\"104\",\"action\":\"104\",\"name\":\"View Database Field Interface\",\"uid\":\"97\"},{\"id_application_action\":\"105\",\"action\":\"105\",\"name\":\"Create Database Field Interface\",\"uid\":\"98\"},{\"id_application_action\":\"106\",\"action\":\"106\",\"name\":\"Edit Database Field Interface\",\"uid\":\"99\"},{\"id_application_action\":\"107\",\"action\":\"107\",\"name\":\"Delete Database Field Interface\",\"uid\":\"100\"},{\"id_application_action\":\"108\",\"action\":\"108\",\"name\":\"Save \\/ Edit Database Field Interface\",\"uid\":\"101\"},{\"id_application_action\":\"109\",\"action\":\"109\",\"name\":\"View Inquiry\",\"uid\":\"102\"},{\"id_application_action\":\"110\",\"action\":\"110\",\"name\":\"Create Inquiry\",\"uid\":\"103\"},{\"id_application_action\":\"111\",\"action\":\"111\",\"name\":\"Edit Inquiry\",\"uid\":\"104\"},{\"id_application_action\":\"112\",\"action\":\"112\",\"name\":\"Delete Inquiry\",\"uid\":\"105\"},{\"id_application_action\":\"113\",\"action\":\"113\",\"name\":\"Save\\/Edit Inquiry\",\"uid\":\"106\"},{\"id_application_action\":\"114\",\"action\":\"114\",\"name\":\"View Survey \\/ Assessment\",\"uid\":\"107\"},{\"id_application_action\":\"115\",\"action\":\"115\",\"name\":\"Create Survey \\/ Assessment\",\"uid\":\"108\"},{\"id_application_action\":\"116\",\"action\":\"116\",\"name\":\"Edit Survey \\/ Assessment\",\"uid\":\"109\"},{\"id_application_action\":\"117\",\"action\":\"117\",\"name\":\"Delete Survey \\/ Assessment\",\"uid\":\"110\"},{\"id_application_action\":\"118\",\"action\":\"118\",\"name\":\"Save\\/Edit Survey \\/ Assessment\",\"uid\":\"111\"},{\"id_application_action\":\"119\",\"action\":\"119\",\"name\":\"View Quotation\",\"uid\":\"112\"},{\"id_application_action\":\"120\",\"action\":\"120\",\"name\":\"Create Quotation\",\"uid\":\"113\"},{\"id_application_action\":\"121\",\"action\":\"121\",\"name\":\"Edit Quotation\",\"uid\":\"114\"},{\"id_application_action\":\"122\",\"action\":\"122\",\"name\":\"Delete Quotation\",\"uid\":\"115\"},{\"id_application_action\":\"123\",\"action\":\"123\",\"name\":\"Save\\/Edit Quotation\",\"uid\":\"116\"},{\"id_application_action\":\"124\",\"action\":\"124\",\"name\":\"View Project Contract\",\"uid\":\"117\"},{\"id_application_action\":\"125\",\"action\":\"125\",\"name\":\"Create Project Contract\",\"uid\":\"118\"},{\"id_application_action\":\"126\",\"action\":\"126\",\"name\":\"Edit Project Contract\",\"uid\":\"119\"},{\"id_application_action\":\"127\",\"action\":\"127\",\"name\":\"Delete Project Contract\",\"uid\":\"120\"},{\"id_application_action\":\"128\",\"action\":\"128\",\"name\":\"Save\\/Edit Project Contract\",\"uid\":\"121\"},{\"id_application_action\":\"129\",\"action\":\"129\",\"name\":\"View Work Order\",\"uid\":\"122\"},{\"id_application_action\":\"130\",\"action\":\"130\",\"name\":\"Create Work Order\",\"uid\":\"123\"},{\"id_application_action\":\"131\",\"action\":\"131\",\"name\":\"Edit Work Order\",\"uid\":\"124\"},{\"id_application_action\":\"132\",\"action\":\"132\",\"name\":\"Delete Work Order\",\"uid\":\"125\"},{\"id_application_action\":\"133\",\"action\":\"133\",\"name\":\"Save\\/Edit Work Order\",\"uid\":\"126\"},{\"id_application_action\":\"134\",\"action\":\"134\",\"name\":\"View Assessment Template\",\"uid\":\"127\"},{\"id_application_action\":\"135\",\"action\":\"135\",\"name\":\"Create Assessment Template\",\"uid\":\"128\"},{\"id_application_action\":\"136\",\"action\":\"136\",\"name\":\"Edit Assessment Template\",\"uid\":\"129\"},{\"id_application_action\":\"137\",\"action\":\"137\",\"name\":\"Delete Assessment Template\",\"uid\":\"130\"},{\"id_application_action\":\"138\",\"action\":\"138\",\"name\":\"Save\\/Edit Assessment Template\",\"uid\":\"131\"},{\"id_application_action\":\"139\",\"action\":\"139\",\"name\":\"View Contract Template\",\"uid\":\"132\"},{\"id_application_action\":\"140\",\"action\":\"140\",\"name\":\"Create Contract Template\",\"uid\":\"133\"},{\"id_application_action\":\"141\",\"action\":\"141\",\"name\":\"Edit Contract Template\",\"uid\":\"134\"},{\"id_application_action\":\"142\",\"action\":\"142\",\"name\":\"Delete Contract Template\",\"uid\":\"135\"},{\"id_application_action\":\"143\",\"action\":\"143\",\"name\":\"Save\\/Edit Contract Template\",\"uid\":\"136\"},{\"id_application_action\":\"144\",\"action\":\"144\",\"name\":\"View Work Schedule\",\"uid\":\"137\"},{\"id_application_action\":\"145\",\"action\":\"145\",\"name\":\"Create Work Schedule\",\"uid\":\"138\"},{\"id_application_action\":\"146\",\"action\":\"146\",\"name\":\"Edit Work Schedule\",\"uid\":\"139\"},{\"id_application_action\":\"147\",\"action\":\"147\",\"name\":\"Delete Work Schedule\",\"uid\":\"140\"},{\"id_application_action\":\"148\",\"action\":\"148\",\"name\":\"Save\\/Edit Work Schedule\",\"uid\":\"141\"},{\"id_application_action\":\"149\",\"action\":\"149\",\"name\":\"View SO Assignment\",\"uid\":\"142\"},{\"id_application_action\":\"150\",\"action\":\"150\",\"name\":\"Create SO Assignment\",\"uid\":\"143\"},{\"id_application_action\":\"151\",\"action\":\"151\",\"name\":\"Edit SO Assignment\",\"uid\":\"144\"},{\"id_application_action\":\"152\",\"action\":\"152\",\"name\":\"Delete SO Assignment\",\"uid\":\"145\"},{\"id_application_action\":\"153\",\"action\":\"153\",\"name\":\"Save\\/Edit SO Assignment\",\"uid\":\"146\"},{\"id_application_action\":\"154\",\"action\":\"154\",\"name\":\"View Shift Change\",\"uid\":\"147\"},{\"id_application_action\":\"155\",\"action\":\"155\",\"name\":\"Create Shift Change\",\"uid\":\"148\"},{\"id_application_action\":\"156\",\"action\":\"156\",\"name\":\"Edit Shift Change\",\"uid\":\"149\"},{\"id_application_action\":\"157\",\"action\":\"157\",\"name\":\"Delete Shift Change\",\"uid\":\"150\"},{\"id_application_action\":\"158\",\"action\":\"158\",\"name\":\"Save\\/Edit Shift Change\",\"uid\":\"151\"},{\"id_application_action\":\"159\",\"action\":\"159\",\"name\":\"View Leave Application\",\"uid\":\"152\"},{\"id_application_action\":\"160\",\"action\":\"160\",\"name\":\"Create Leave Application\",\"uid\":\"153\"},{\"id_application_action\":\"161\",\"action\":\"161\",\"name\":\"Edit Leave Application\",\"uid\":\"154\"},{\"id_application_action\":\"162\",\"action\":\"162\",\"name\":\"Delete Leave Application\",\"uid\":\"155\"},{\"id_application_action\":\"163\",\"action\":\"163\",\"name\":\"Save\\/Edit Leave Application\",\"uid\":\"156\"},{\"id_application_action\":\"164\",\"action\":\"164\",\"name\":\"View Timesheet (Recap)\",\"uid\":\"157\"},{\"id_application_action\":\"165\",\"action\":\"165\",\"name\":\"Create Timesheet (Recap)\",\"uid\":\"158\"},{\"id_application_action\":\"166\",\"action\":\"166\",\"name\":\"Edit Timesheet (Recap)\",\"uid\":\"159\"},{\"id_application_action\":\"167\",\"action\":\"167\",\"name\":\"Delete Timesheet (Recap)\",\"uid\":\"160\"},{\"id_application_action\":\"168\",\"action\":\"168\",\"name\":\"Save\\/Edit Timesheet (Recap)\",\"uid\":\"161\"},{\"id_application_action\":\"169\",\"action\":\"169\",\"name\":\"View SO Timesheet\",\"uid\":\"162\"},{\"id_application_action\":\"170\",\"action\":\"170\",\"name\":\"Create SO Timesheet\",\"uid\":\"163\"},{\"id_application_action\":\"171\",\"action\":\"171\",\"name\":\"Edit SO Timesheet\",\"uid\":\"164\"},{\"id_application_action\":\"172\",\"action\":\"172\",\"name\":\"Delete SO Timesheet\",\"uid\":\"165\"},{\"id_application_action\":\"173\",\"action\":\"173\",\"name\":\"Save\\/Edit SO Timesheet\",\"uid\":\"166\"},{\"id_application_action\":\"174\",\"action\":\"174\",\"name\":\"View Incident Report\",\"uid\":\"167\"},{\"id_application_action\":\"175\",\"action\":\"175\",\"name\":\"Create Incident Report\",\"uid\":\"168\"},{\"id_application_action\":\"176\",\"action\":\"176\",\"name\":\"Edit Incident Report\",\"uid\":\"169\"},{\"id_application_action\":\"177\",\"action\":\"177\",\"name\":\"Delete Incident Report\",\"uid\":\"170\"},{\"id_application_action\":\"178\",\"action\":\"178\",\"name\":\"Save\\/Edit Incident Report\",\"uid\":\"171\"},{\"id_application_action\":\"179\",\"action\":\"179\",\"name\":\"View Payroll\",\"uid\":\"172\"},{\"id_application_action\":\"180\",\"action\":\"180\",\"name\":\"Create Payroll\",\"uid\":\"173\"},{\"id_application_action\":\"181\",\"action\":\"181\",\"name\":\"Edit Payroll\",\"uid\":\"174\"},{\"id_application_action\":\"182\",\"action\":\"182\",\"name\":\"Delete Payroll\",\"uid\":\"175\"},{\"id_application_action\":\"183\",\"action\":\"183\",\"name\":\"Save\\/Edit Payroll\",\"uid\":\"176\"},{\"id_application_action\":\"184\",\"action\":\"184\",\"name\":\"View Supplier Invoice\",\"uid\":\"177\"},{\"id_application_action\":\"185\",\"action\":\"185\",\"name\":\"Create Supplier Invoice\",\"uid\":\"178\"},{\"id_application_action\":\"186\",\"action\":\"186\",\"name\":\"Edit Supplier Invoice\",\"uid\":\"179\"},{\"id_application_action\":\"187\",\"action\":\"187\",\"name\":\"Delete Supplier Invoice\",\"uid\":\"180\"},{\"id_application_action\":\"188\",\"action\":\"188\",\"name\":\"Save\\/Edit Supplier Invoice\",\"uid\":\"181\"},{\"id_application_action\":\"189\",\"action\":\"189\",\"name\":\"View Customer Invoice\",\"uid\":\"182\"},{\"id_application_action\":\"190\",\"action\":\"190\",\"name\":\"Create Customer Invoice\",\"uid\":\"183\"},{\"id_application_action\":\"191\",\"action\":\"191\",\"name\":\"Edit Customer Invoice\",\"uid\":\"184\"},{\"id_application_action\":\"192\",\"action\":\"192\",\"name\":\"Delete Customer Invoice\",\"uid\":\"185\"},{\"id_application_action\":\"193\",\"action\":\"193\",\"name\":\"Save\\/Edit Customer Invoice\",\"uid\":\"186\"},{\"id_application_action\":\"194\",\"action\":\"194\",\"name\":\"View Bank Statement\",\"uid\":\"187\"},{\"id_application_action\":\"195\",\"action\":\"195\",\"name\":\"Create Bank Statement\",\"uid\":\"188\"},{\"id_application_action\":\"196\",\"action\":\"196\",\"name\":\"Edit Bank Statement\",\"uid\":\"189\"},{\"id_application_action\":\"197\",\"action\":\"197\",\"name\":\"Delete Bank Statement\",\"uid\":\"190\"},{\"id_application_action\":\"198\",\"action\":\"198\",\"name\":\"Save\\/Edit Bank Statement\",\"uid\":\"191\"},{\"id_application_action\":\"199\",\"action\":\"199\",\"name\":\"View Cash Register\",\"uid\":\"192\"},{\"id_application_action\":\"200\",\"action\":\"200\",\"name\":\"Create Cash Register\",\"uid\":\"193\"},{\"id_application_action\":\"201\",\"action\":\"201\",\"name\":\"Edit Cash Register\",\"uid\":\"194\"},{\"id_application_action\":\"202\",\"action\":\"202\",\"name\":\"Delete Cash Register\",\"uid\":\"195\"},{\"id_application_action\":\"203\",\"action\":\"203\",\"name\":\"Save\\/Edit Cash Register\",\"uid\":\"196\"},{\"id_application_action\":\"204\",\"action\":\"204\",\"name\":\"View Tax\",\"uid\":\"197\"},{\"id_application_action\":\"205\",\"action\":\"205\",\"name\":\"Create Tax\",\"uid\":\"198\"},{\"id_application_action\":\"206\",\"action\":\"206\",\"name\":\"Edit Tax\",\"uid\":\"199\"},{\"id_application_action\":\"207\",\"action\":\"207\",\"name\":\"Delete Tax\",\"uid\":\"200\"},{\"id_application_action\":\"208\",\"action\":\"208\",\"name\":\"Save\\/Edit Tax\",\"uid\":\"201\"},{\"id_application_action\":\"209\",\"action\":\"209\",\"name\":\"View Chart of Account\",\"uid\":\"202\"},{\"id_application_action\":\"210\",\"action\":\"210\",\"name\":\"Create Chart of Account\",\"uid\":\"203\"},{\"id_application_action\":\"211\",\"action\":\"211\",\"name\":\"Edit Chart of Account\",\"uid\":\"204\"},{\"id_application_action\":\"212\",\"action\":\"212\",\"name\":\"Delete Chart of Account\",\"uid\":\"205\"},{\"id_application_action\":\"213\",\"action\":\"213\",\"name\":\"Save\\/Edit Chart of Account\",\"uid\":\"206\"},{\"id_application_action\":\"214\",\"action\":\"214\",\"name\":\"View Employee Salary\",\"uid\":\"207\"},{\"id_application_action\":\"215\",\"action\":\"215\",\"name\":\"Create Employee Salary\",\"uid\":\"208\"},{\"id_application_action\":\"216\",\"action\":\"216\",\"name\":\"Edit Employee Salary\",\"uid\":\"209\"},{\"id_application_action\":\"217\",\"action\":\"217\",\"name\":\"Delete Employee Salary\",\"uid\":\"210\"},{\"id_application_action\":\"218\",\"action\":\"218\",\"name\":\"Save\\/Edit Employee Salary\",\"uid\":\"211\"},{\"id_application_action\":\"219\",\"action\":\"219\",\"name\":\"View Salary Setting\",\"uid\":\"212\"},{\"id_application_action\":\"220\",\"action\":\"220\",\"name\":\"Create Salary Setting\",\"uid\":\"213\"},{\"id_application_action\":\"221\",\"action\":\"221\",\"name\":\"Edit Salary Setting\",\"uid\":\"214\"},{\"id_application_action\":\"222\",\"action\":\"222\",\"name\":\"Delete Salary Setting\",\"uid\":\"215\"},{\"id_application_action\":\"223\",\"action\":\"223\",\"name\":\"Save\\/Edit Salary Setting\",\"uid\":\"216\"},{\"id_application_action\":\"224\",\"action\":\"224\",\"name\":\"View Database Interface\",\"uid\":\"217\"},{\"id_application_action\":\"225\",\"action\":\"225\",\"name\":\"Pick Assessment Template\",\"uid\":\"218\"},{\"id_application_action\":\"226\",\"action\":\"226\",\"name\":\"View Organisation Structure\",\"uid\":\"219\"},{\"id_application_action\":\"227\",\"action\":\"227\",\"name\":\"Create Organisation Structure\",\"uid\":\"220\"},{\"id_application_action\":\"228\",\"action\":\"228\",\"name\":\"Edit Organisation Structure\",\"uid\":\"221\"},{\"id_application_action\":\"229\",\"action\":\"229\",\"name\":\"Delete Organisation Structure\",\"uid\":\"222\"},{\"id_application_action\":\"230\",\"action\":\"230\",\"name\":\"Save\\/Edit Organisation Structure\",\"uid\":\"223\"},{\"id_application_action\":\"231\",\"action\":\"231\",\"name\":\"View Position Level\",\"uid\":\"224\"},{\"id_application_action\":\"232\",\"action\":\"232\",\"name\":\"Create Position Level\",\"uid\":\"225\"},{\"id_application_action\":\"233\",\"action\":\"233\",\"name\":\"Edit Position Level\",\"uid\":\"226\"},{\"id_application_action\":\"234\",\"action\":\"234\",\"name\":\"Delete Position Level\",\"uid\":\"227\"},{\"id_application_action\":\"235\",\"action\":\"235\",\"name\":\"Save\\/Edit Position Level\",\"uid\":\"228\"},{\"id_application_action\":\"236\",\"action\":\"236\",\"name\":\"View Employee Contract Type\",\"uid\":\"229\"},{\"id_application_action\":\"237\",\"action\":\"237\",\"name\":\"Create Employee Contract Type\",\"uid\":\"230\"},{\"id_application_action\":\"238\",\"action\":\"238\",\"name\":\"Edit Employee Contract Type\",\"uid\":\"231\"},{\"id_application_action\":\"239\",\"action\":\"239\",\"name\":\"Delete Employee Contract Type\",\"uid\":\"232\"},{\"id_application_action\":\"240\",\"action\":\"240\",\"name\":\"Save\\/Edit Employee Contract\",\"uid\":\"233\"},{\"id_application_action\":\"241\",\"action\":\"241\",\"name\":\"View Bank\",\"uid\":\"234\"},{\"id_application_action\":\"242\",\"action\":\"242\",\"name\":\"Create Bank\",\"uid\":\"235\"},{\"id_application_action\":\"243\",\"action\":\"243\",\"name\":\"Edit Bank\",\"uid\":\"236\"},{\"id_application_action\":\"244\",\"action\":\"244\",\"name\":\"Delete Bank\",\"uid\":\"237\"},{\"id_application_action\":\"245\",\"action\":\"245\",\"name\":\"Save\\/Edit Bank\",\"uid\":\"238\"},{\"id_application_action\":\"246\",\"name\":\"View Payment Receipt\",\"uid\":\"239\",\"id\":\"239\"},{\"id_application_action\":\"247\",\"name\":\"Create Payment Receipt\",\"uid\":\"240\",\"id\":\"240\"},{\"id_application_action\":\"248\",\"name\":\"Edit Payment Receipt\",\"uid\":\"241\",\"id\":\"241\"},{\"id_application_action\":\"249\",\"name\":\"Save\\/Edit Payment Receipt\",\"uid\":\"242\",\"id\":\"242\"},{\"id_application_action\":\"250\",\"name\":\"Delete Payment Receipt\",\"uid\":\"243\",\"id\":\"243\"},{\"id_application_action\":\"251\",\"name\":\"Receive Payment From PO\",\"uid\":\"244\",\"id\":\"244\"},{\"id_application_action\":\"252\",\"name\":\"Make Payment Receipt\",\"uid\":\"245\",\"id\":\"245\"},{\"id_application_action\":\"253\",\"name\":\"Cancel Payment Receipt\",\"uid\":\"246\",\"id\":\"246\"},{\"id_application_action\":\"254\",\"name\":\"View Stock Transaction\",\"uid\":\"247\",\"id\":\"247\"},{\"id_application_action\":\"255\",\"name\":\"Create Stock Transaction\",\"uid\":\"248\",\"id\":\"248\"},{\"id_application_action\":\"256\",\"name\":\"Edit Stock Transaction\",\"uid\":\"249\",\"id\":\"249\"},{\"id_application_action\":\"257\",\"name\":\"Delete Stock Transaction\",\"uid\":\"250\",\"id\":\"250\"},{\"id_application_action\":\"258\",\"name\":\"Save\\/Edit Stock Transaction\",\"uid\":\"251\",\"id\":\"251\"},{\"id_application_action\":\"259\",\"name\":\"Post Stock Transaction\",\"uid\":\"252\",\"id\":\"252\"},{\"id_application_action\":\"260\",\"name\":\"Unpost Stock Transaction\",\"uid\":\"253\",\"id\":\"253\"},{\"id_application_action\":\"261\",\"name\":\"Transfer Good Receive\",\"uid\":\"254\",\"id\":\"254\"}],\"is_edit\":\"true\",\"id_role\":\"1\"}', '2015-01-24 23:29:49');
INSERT INTO `activity_log` VALUES ('111', 'Save/Edit Warehouse', 'gudang', null, '2', 'Save/Edit Warehouse', '51', '{}', '2015-01-24 23:40:06');
INSERT INTO `activity_log` VALUES ('112', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"Save\\/Edit Warehouse\",\"controller\":\"gudang\",\"function_exec\":\"save_gudang\",\"function_args\":\"\",\"view_type\":\"no_view\",\"view_file\":\"\",\"prefix\":\"\",\"action_type\":\"create\",\"action_button\":\"crud\",\"target_action\":\"47\",\"use_log\":\"1\",\"is_edit\":\"true\",\"id_edit\":\"51\"}', '2015-01-24 23:40:37');
INSERT INTO `activity_log` VALUES ('113', 'Save/Edit Warehouse', 'gudang', null, '2', 'Save/Edit Warehouse', '51', '{}', '2015-01-24 23:40:53');
INSERT INTO `activity_log` VALUES ('114', 'Save/Edit Warehouse', 'gudang', null, '2', 'Save/Edit Warehouse', '51', '{}', '2015-01-24 23:41:04');
INSERT INTO `activity_log` VALUES ('115', 'Save/Edit PO', 'po', null, '2', 'Save/Edit PO', '61', '{\"date\":\"2015-01-24\",\"note\":\"\",\"delivery_date\":\"2015-01-29\",\"supplier\":\"1\",\"mr\":\"\",\"sub_total\":\"4225000\",\"total_price\":\"4647500\",\"tax\":\"422500\",\"product_detail\":[{\"id_product\":\"2\",\"product_category\":\"1\",\"merk\":\"2\",\"product_code\":\"XXX.XXX.XXX.001\",\"product_name\":\"Product Test\",\"name\":\"Merk1\",\"unit_name\":\"pcs\",\"unit\":\"2\",\"category_name\":\"Category 1\",\"uid\":\"2\",\"qty\":\"10\",\"unit_price\":\"250000\",\"total_price\":\"0\"},{\"id_product\":\"3\",\"product_category\":\"3\",\"merk\":\"2\",\"product_code\":\"XXX.XXX.XXX.002\",\"product_name\":\"Product Test 3\",\"name\":\"Merk1\",\"unit_name\":\"pcs\",\"unit\":\"2\",\"category_name\":\"Category 2\",\"uid\":\"3\",\"qty\":\"5\",\"unit_price\":\"345000\",\"total_price\":\"0\"}],\"is_edit\":\"false\",\"id_po\":\"\"}', '2015-01-24 23:50:23');
INSERT INTO `activity_log` VALUES ('116', 'Validate PO', 'po', null, '2', 'Validate PO', '99', '{\"id_po\":\"1\",\"status\":\"open\"}', '2015-01-24 23:50:28');
INSERT INTO `activity_log` VALUES ('117', 'Save/Edit Side Menu', 'side_menu', null, '2', 'Save/Edit Side Menu', '9', '{}', '2015-01-24 23:59:07');
INSERT INTO `activity_log` VALUES ('118', 'Delete Side Menu', 'side_menu', null, '2', 'Delete Side Menu', '8', '{}', '2015-01-24 23:59:12');
INSERT INTO `activity_log` VALUES ('119', 'Save/Edit PO', 'po', null, '2', 'Save/Edit PO', '61', '{\"date\":\"2015-01-25\",\"note\":\"\",\"delivery_date\":\"2015-01-29\",\"supplier\":\"1\",\"mr\":\"\",\"sub_total\":\"450000\",\"total_price\":\"495000\",\"tax\":\"45000\",\"product_detail\":[{\"id_product\":\"3\",\"product_category\":\"3\",\"merk\":\"2\",\"product_code\":\"XXX.XXX.XXX.002\",\"product_name\":\"Product Test 3\",\"name\":\"Merk1\",\"unit_name\":\"pcs\",\"unit\":\"2\",\"category_name\":\"Category 2\",\"uid\":\"3\",\"qty\":\"3\",\"unit_price\":\"150000\",\"total_price\":\"0\"}],\"is_edit\":\"false\",\"id_po\":\"\"}', '2015-01-25 00:01:19');
INSERT INTO `activity_log` VALUES ('120', 'Validate PO', 'po', null, '2', 'Validate PO', '99', '{\"id_po\":\"2\",\"status\":\"open\"}', '2015-01-25 00:01:24');
INSERT INTO `activity_log` VALUES ('121', 'Save/Edit Payment Receipt', 'payment_receipt', null, '2', 'Save/Edit Payment Receipt', '249', '{}', '2015-01-25 00:18:05');
INSERT INTO `activity_log` VALUES ('122', 'Make Payment Receipt', 'payment_receipt', null, '2', 'Make Payment Receipt', '252', '{}', '2015-01-25 00:18:05');
INSERT INTO `activity_log` VALUES ('123', 'Save/Edit Good Receive', 'gr', null, '2', 'Save/Edit Good Receive', '71', '{}', '2015-01-25 00:18:35');
INSERT INTO `activity_log` VALUES ('124', 'Transfer Good Receive', 'gr', null, '2', 'Transfer Good Receive', '261', '{}', '2015-01-25 00:18:47');
INSERT INTO `activity_log` VALUES ('125', 'Save/Edit Payment Receipt', 'payment_receipt', null, '2', 'Save/Edit Payment Receipt', '249', '{}', '2015-01-25 00:19:22');
INSERT INTO `activity_log` VALUES ('126', 'Make Payment Receipt', 'payment_receipt', null, '2', 'Make Payment Receipt', '252', '{}', '2015-01-25 00:19:23');
INSERT INTO `activity_log` VALUES ('127', 'Save/Edit Role', 'role', null, '2', 'Save/Edit Role', '20', '{\"name\":\"administrator\",\"action_detail\":[{\"id_application_action\":\"1\",\"action\":\"1\",\"name\":\"View Application Action\",\"uid\":\"0\"},{\"id_application_action\":\"2\",\"action\":\"2\",\"name\":\"Create Application Action\",\"uid\":\"1\"},{\"id_application_action\":\"3\",\"action\":\"3\",\"name\":\"Edit Application Action\",\"uid\":\"2\"},{\"id_application_action\":\"4\",\"action\":\"4\",\"name\":\"Delete Application Action\",\"uid\":\"3\"},{\"id_application_action\":\"5\",\"action\":\"5\",\"name\":\"View Side Menu\",\"uid\":\"4\"},{\"id_application_action\":\"6\",\"action\":\"6\",\"name\":\"Create Side Menu\",\"uid\":\"5\"},{\"id_application_action\":\"7\",\"action\":\"7\",\"name\":\"Edit Side Menu\",\"uid\":\"6\"},{\"id_application_action\":\"8\",\"action\":\"8\",\"name\":\"Delete Side Menu\",\"uid\":\"7\"},{\"id_application_action\":\"9\",\"action\":\"9\",\"name\":\"Save\\/Edit Side Menu\",\"uid\":\"8\"},{\"id_application_action\":\"10\",\"action\":\"10\",\"name\":\"Save\\/Edit Action\",\"uid\":\"9\"},{\"id_application_action\":\"11\",\"action\":\"11\",\"name\":\"View Division\",\"uid\":\"10\"},{\"id_application_action\":\"12\",\"action\":\"12\",\"name\":\"Create Division\",\"uid\":\"11\"},{\"id_application_action\":\"13\",\"action\":\"13\",\"name\":\"Save\\/Edit Division\",\"uid\":\"12\"},{\"id_application_action\":\"14\",\"action\":\"14\",\"name\":\"Edit Division\",\"uid\":\"13\"},{\"id_application_action\":\"15\",\"action\":\"15\",\"name\":\"Delete Division\",\"uid\":\"14\"},{\"id_application_action\":\"16\",\"action\":\"16\",\"name\":\"View Role\",\"uid\":\"15\"},{\"id_application_action\":\"17\",\"action\":\"17\",\"name\":\"View Create Role\",\"uid\":\"16\"},{\"id_application_action\":\"18\",\"action\":\"18\",\"name\":\"View Edit Role\",\"uid\":\"17\"},{\"id_application_action\":\"19\",\"action\":\"19\",\"name\":\"Delete Role\",\"uid\":\"18\"},{\"id_application_action\":\"20\",\"action\":\"20\",\"name\":\"Save\\/Edit Role\",\"uid\":\"19\"},{\"id_application_action\":\"21\",\"action\":\"21\",\"name\":\"View Product\",\"uid\":\"20\"},{\"id_application_action\":\"22\",\"action\":\"22\",\"name\":\"Create Product\",\"uid\":\"21\"},{\"id_application_action\":\"23\",\"action\":\"23\",\"name\":\"Edit Product\",\"uid\":\"22\"},{\"id_application_action\":\"24\",\"action\":\"24\",\"name\":\"Delete Product\",\"uid\":\"23\"},{\"id_application_action\":\"25\",\"action\":\"25\",\"name\":\"Save\\/Edit Product\",\"uid\":\"24\"},{\"id_application_action\":\"26\",\"action\":\"26\",\"name\":\"View Supplier\",\"uid\":\"25\"},{\"id_application_action\":\"27\",\"action\":\"27\",\"name\":\"Create Supplier\",\"uid\":\"26\"},{\"id_application_action\":\"28\",\"action\":\"28\",\"name\":\"Edit Supplier\",\"uid\":\"27\"},{\"id_application_action\":\"29\",\"action\":\"29\",\"name\":\"Delete Supplier\",\"uid\":\"28\"},{\"id_application_action\":\"30\",\"action\":\"30\",\"name\":\"Save\\/Edit Supplier\",\"uid\":\"29\"},{\"id_application_action\":\"31\",\"action\":\"31\",\"name\":\"View Product Category\",\"uid\":\"30\"},{\"id_application_action\":\"32\",\"action\":\"32\",\"name\":\"Create Product Category\",\"uid\":\"31\"},{\"id_application_action\":\"33\",\"action\":\"33\",\"name\":\"Edit Product Category\",\"uid\":\"32\"},{\"id_application_action\":\"34\",\"action\":\"34\",\"name\":\"Delete Product Category\",\"uid\":\"33\"},{\"id_application_action\":\"35\",\"action\":\"35\",\"name\":\"Save\\/Edit Product Category\",\"uid\":\"34\"},{\"id_application_action\":\"36\",\"action\":\"36\",\"name\":\"View Merk\",\"uid\":\"35\"},{\"id_application_action\":\"37\",\"action\":\"37\",\"name\":\"Create Merk\",\"uid\":\"36\"},{\"id_application_action\":\"38\",\"action\":\"38\",\"name\":\"Edit Merk\",\"uid\":\"37\"},{\"id_application_action\":\"39\",\"action\":\"39\",\"name\":\"Delete Merk\",\"uid\":\"38\"},{\"id_application_action\":\"40\",\"action\":\"40\",\"name\":\"Save\\/Edit Merk\",\"uid\":\"39\"},{\"id_application_action\":\"41\",\"action\":\"41\",\"name\":\"View Customer\",\"uid\":\"40\"},{\"id_application_action\":\"43\",\"action\":\"43\",\"name\":\"Create Customer\",\"uid\":\"41\"},{\"id_application_action\":\"44\",\"action\":\"44\",\"name\":\"Edit Customer\",\"uid\":\"42\"},{\"id_application_action\":\"45\",\"action\":\"45\",\"name\":\"Delete Customer\",\"uid\":\"43\"},{\"id_application_action\":\"46\",\"action\":\"46\",\"name\":\"Save\\/Edit Customer\",\"uid\":\"44\"},{\"id_application_action\":\"47\",\"action\":\"47\",\"name\":\"View Warehouse\",\"uid\":\"45\"},{\"id_application_action\":\"48\",\"action\":\"48\",\"name\":\"Create Warehouse\",\"uid\":\"46\"},{\"id_application_action\":\"49\",\"action\":\"49\",\"name\":\"Edit Warehouse\",\"uid\":\"47\"},{\"id_application_action\":\"50\",\"action\":\"50\",\"name\":\"Delete Warehouse\",\"uid\":\"48\"},{\"id_application_action\":\"51\",\"action\":\"51\",\"name\":\"Save\\/Edit Warehouse\",\"uid\":\"49\"},{\"id_application_action\":\"57\",\"action\":\"57\",\"name\":\"View PO\",\"uid\":\"50\"},{\"id_application_action\":\"58\",\"action\":\"58\",\"name\":\"Create PO\",\"uid\":\"51\"},{\"id_application_action\":\"59\",\"action\":\"59\",\"name\":\"Edit PO\",\"uid\":\"52\"},{\"id_application_action\":\"60\",\"action\":\"60\",\"name\":\"Delete PO\",\"uid\":\"53\"},{\"id_application_action\":\"61\",\"action\":\"61\",\"name\":\"Save\\/Edit PO\",\"uid\":\"54\"},{\"id_application_action\":\"62\",\"action\":\"62\",\"name\":\"View User\",\"uid\":\"55\"},{\"id_application_action\":\"63\",\"action\":\"63\",\"name\":\"Create User\",\"uid\":\"56\"},{\"id_application_action\":\"64\",\"action\":\"64\",\"name\":\"Edit User\",\"uid\":\"57\"},{\"id_application_action\":\"65\",\"action\":\"65\",\"name\":\"Delete User\",\"uid\":\"58\"},{\"id_application_action\":\"66\",\"action\":\"66\",\"name\":\"Save\\/Edit User\",\"uid\":\"59\"},{\"id_application_action\":\"67\",\"action\":\"67\",\"name\":\"View Good Receive\",\"uid\":\"60\"},{\"id_application_action\":\"68\",\"action\":\"68\",\"name\":\"Create Good Receive\",\"uid\":\"61\"},{\"id_application_action\":\"69\",\"action\":\"69\",\"name\":\"Edit Good Receive\",\"uid\":\"62\"},{\"id_application_action\":\"70\",\"action\":\"70\",\"name\":\"Delete Good Receive\",\"uid\":\"63\"},{\"id_application_action\":\"71\",\"action\":\"71\",\"name\":\"Save\\/Edit Good Receive\",\"uid\":\"64\"},{\"id_application_action\":\"72\",\"action\":\"72\",\"name\":\"View Sales Order\",\"uid\":\"65\"},{\"id_application_action\":\"73\",\"action\":\"73\",\"name\":\"Create Sales Order\",\"uid\":\"66\"},{\"id_application_action\":\"74\",\"action\":\"74\",\"name\":\"Edit Sales Order\",\"uid\":\"67\"},{\"id_application_action\":\"75\",\"action\":\"75\",\"name\":\"Delete Sales Order\",\"uid\":\"68\"},{\"id_application_action\":\"76\",\"action\":\"76\",\"name\":\"Save Sales Order\",\"uid\":\"69\"},{\"id_application_action\":\"77\",\"action\":\"77\",\"name\":\"View Material Request\",\"uid\":\"70\"},{\"id_application_action\":\"78\",\"action\":\"78\",\"name\":\"Create Material Request\",\"uid\":\"71\"},{\"id_application_action\":\"79\",\"action\":\"79\",\"name\":\"Edit Material Request\",\"uid\":\"72\"},{\"id_application_action\":\"80\",\"action\":\"80\",\"name\":\"Delete Material Request\",\"uid\":\"73\"},{\"id_application_action\":\"81\",\"action\":\"81\",\"name\":\"Save Material Request\",\"uid\":\"74\"},{\"id_application_action\":\"82\",\"action\":\"82\",\"name\":\"Change User Password\",\"uid\":\"75\"},{\"id_application_action\":\"83\",\"action\":\"83\",\"name\":\"View Delivery Note\",\"uid\":\"76\"},{\"id_application_action\":\"84\",\"action\":\"84\",\"name\":\"Create Delivery Note\",\"uid\":\"77\"},{\"id_application_action\":\"85\",\"action\":\"85\",\"name\":\"Edit Delivery Note\",\"uid\":\"78\"},{\"id_application_action\":\"86\",\"action\":\"86\",\"name\":\"Delete Delivery Note\",\"uid\":\"79\"},{\"id_application_action\":\"87\",\"action\":\"87\",\"name\":\"Save\\/Edit Delivery Note\",\"uid\":\"80\"},{\"id_application_action\":\"88\",\"action\":\"88\",\"name\":\"View Unit Measure\",\"uid\":\"81\"},{\"id_application_action\":\"89\",\"action\":\"89\",\"name\":\"Create Unit Measure\",\"uid\":\"82\"},{\"id_application_action\":\"90\",\"action\":\"90\",\"name\":\"Edit Unit Measure\",\"uid\":\"83\"},{\"id_application_action\":\"91\",\"action\":\"91\",\"name\":\"Delete Unit Measure\",\"uid\":\"84\"},{\"id_application_action\":\"92\",\"action\":\"92\",\"name\":\"Save\\/Edit Unit Measure\",\"uid\":\"85\"},{\"id_application_action\":\"93\",\"action\":\"93\",\"name\":\"View Stock\",\"uid\":\"86\"},{\"id_application_action\":\"94\",\"action\":\"94\",\"name\":\"View Employee\",\"uid\":\"87\"},{\"id_application_action\":\"95\",\"action\":\"95\",\"name\":\"Create Employee\",\"uid\":\"88\"},{\"id_application_action\":\"96\",\"action\":\"96\",\"name\":\"Edit Employee\",\"uid\":\"89\"},{\"id_application_action\":\"97\",\"action\":\"97\",\"name\":\"Delete Employee\",\"uid\":\"90\"},{\"id_application_action\":\"98\",\"action\":\"98\",\"name\":\"Save\\/Edit Employee\",\"uid\":\"91\"},{\"id_application_action\":\"99\",\"action\":\"99\",\"name\":\"Validate PO\",\"uid\":\"92\"},{\"id_application_action\":\"100\",\"action\":\"100\",\"name\":\"Create Database Interface\",\"uid\":\"93\"},{\"id_application_action\":\"101\",\"action\":\"101\",\"name\":\"Edit Database Interface\",\"uid\":\"94\"},{\"id_application_action\":\"102\",\"action\":\"102\",\"name\":\"Delete Database Interface\",\"uid\":\"95\"},{\"id_application_action\":\"103\",\"action\":\"103\",\"name\":\"Save \\/ Edit Database Interface\",\"uid\":\"96\"},{\"id_application_action\":\"104\",\"action\":\"104\",\"name\":\"View Database Field Interface\",\"uid\":\"97\"},{\"id_application_action\":\"105\",\"action\":\"105\",\"name\":\"Create Database Field Interface\",\"uid\":\"98\"},{\"id_application_action\":\"106\",\"action\":\"106\",\"name\":\"Edit Database Field Interface\",\"uid\":\"99\"},{\"id_application_action\":\"107\",\"action\":\"107\",\"name\":\"Delete Database Field Interface\",\"uid\":\"100\"},{\"id_application_action\":\"108\",\"action\":\"108\",\"name\":\"Save \\/ Edit Database Field Interface\",\"uid\":\"101\"},{\"id_application_action\":\"109\",\"action\":\"109\",\"name\":\"View Inquiry\",\"uid\":\"102\"},{\"id_application_action\":\"110\",\"action\":\"110\",\"name\":\"Create Inquiry\",\"uid\":\"103\"},{\"id_application_action\":\"111\",\"action\":\"111\",\"name\":\"Edit Inquiry\",\"uid\":\"104\"},{\"id_application_action\":\"112\",\"action\":\"112\",\"name\":\"Delete Inquiry\",\"uid\":\"105\"},{\"id_application_action\":\"113\",\"action\":\"113\",\"name\":\"Save\\/Edit Inquiry\",\"uid\":\"106\"},{\"id_application_action\":\"114\",\"action\":\"114\",\"name\":\"View Survey \\/ Assessment\",\"uid\":\"107\"},{\"id_application_action\":\"115\",\"action\":\"115\",\"name\":\"Create Survey \\/ Assessment\",\"uid\":\"108\"},{\"id_application_action\":\"116\",\"action\":\"116\",\"name\":\"Edit Survey \\/ Assessment\",\"uid\":\"109\"},{\"id_application_action\":\"117\",\"action\":\"117\",\"name\":\"Delete Survey \\/ Assessment\",\"uid\":\"110\"},{\"id_application_action\":\"118\",\"action\":\"118\",\"name\":\"Save\\/Edit Survey \\/ Assessment\",\"uid\":\"111\"},{\"id_application_action\":\"119\",\"action\":\"119\",\"name\":\"View Quotation\",\"uid\":\"112\"},{\"id_application_action\":\"120\",\"action\":\"120\",\"name\":\"Create Quotation\",\"uid\":\"113\"},{\"id_application_action\":\"121\",\"action\":\"121\",\"name\":\"Edit Quotation\",\"uid\":\"114\"},{\"id_application_action\":\"122\",\"action\":\"122\",\"name\":\"Delete Quotation\",\"uid\":\"115\"},{\"id_application_action\":\"123\",\"action\":\"123\",\"name\":\"Save\\/Edit Quotation\",\"uid\":\"116\"},{\"id_application_action\":\"124\",\"action\":\"124\",\"name\":\"View Project Contract\",\"uid\":\"117\"},{\"id_application_action\":\"125\",\"action\":\"125\",\"name\":\"Create Project Contract\",\"uid\":\"118\"},{\"id_application_action\":\"126\",\"action\":\"126\",\"name\":\"Edit Project Contract\",\"uid\":\"119\"},{\"id_application_action\":\"127\",\"action\":\"127\",\"name\":\"Delete Project Contract\",\"uid\":\"120\"},{\"id_application_action\":\"128\",\"action\":\"128\",\"name\":\"Save\\/Edit Project Contract\",\"uid\":\"121\"},{\"id_application_action\":\"129\",\"action\":\"129\",\"name\":\"View Work Order\",\"uid\":\"122\"},{\"id_application_action\":\"130\",\"action\":\"130\",\"name\":\"Create Work Order\",\"uid\":\"123\"},{\"id_application_action\":\"131\",\"action\":\"131\",\"name\":\"Edit Work Order\",\"uid\":\"124\"},{\"id_application_action\":\"132\",\"action\":\"132\",\"name\":\"Delete Work Order\",\"uid\":\"125\"},{\"id_application_action\":\"133\",\"action\":\"133\",\"name\":\"Save\\/Edit Work Order\",\"uid\":\"126\"},{\"id_application_action\":\"134\",\"action\":\"134\",\"name\":\"View Assessment Template\",\"uid\":\"127\"},{\"id_application_action\":\"135\",\"action\":\"135\",\"name\":\"Create Assessment Template\",\"uid\":\"128\"},{\"id_application_action\":\"136\",\"action\":\"136\",\"name\":\"Edit Assessment Template\",\"uid\":\"129\"},{\"id_application_action\":\"137\",\"action\":\"137\",\"name\":\"Delete Assessment Template\",\"uid\":\"130\"},{\"id_application_action\":\"138\",\"action\":\"138\",\"name\":\"Save\\/Edit Assessment Template\",\"uid\":\"131\"},{\"id_application_action\":\"139\",\"action\":\"139\",\"name\":\"View Contract Template\",\"uid\":\"132\"},{\"id_application_action\":\"140\",\"action\":\"140\",\"name\":\"Create Contract Template\",\"uid\":\"133\"},{\"id_application_action\":\"141\",\"action\":\"141\",\"name\":\"Edit Contract Template\",\"uid\":\"134\"},{\"id_application_action\":\"142\",\"action\":\"142\",\"name\":\"Delete Contract Template\",\"uid\":\"135\"},{\"id_application_action\":\"143\",\"action\":\"143\",\"name\":\"Save\\/Edit Contract Template\",\"uid\":\"136\"},{\"id_application_action\":\"144\",\"action\":\"144\",\"name\":\"View Work Schedule\",\"uid\":\"137\"},{\"id_application_action\":\"145\",\"action\":\"145\",\"name\":\"Create Work Schedule\",\"uid\":\"138\"},{\"id_application_action\":\"146\",\"action\":\"146\",\"name\":\"Edit Work Schedule\",\"uid\":\"139\"},{\"id_application_action\":\"147\",\"action\":\"147\",\"name\":\"Delete Work Schedule\",\"uid\":\"140\"},{\"id_application_action\":\"148\",\"action\":\"148\",\"name\":\"Save\\/Edit Work Schedule\",\"uid\":\"141\"},{\"id_application_action\":\"149\",\"action\":\"149\",\"name\":\"View SO Assignment\",\"uid\":\"142\"},{\"id_application_action\":\"150\",\"action\":\"150\",\"name\":\"Create SO Assignment\",\"uid\":\"143\"},{\"id_application_action\":\"151\",\"action\":\"151\",\"name\":\"Edit SO Assignment\",\"uid\":\"144\"},{\"id_application_action\":\"152\",\"action\":\"152\",\"name\":\"Delete SO Assignment\",\"uid\":\"145\"},{\"id_application_action\":\"153\",\"action\":\"153\",\"name\":\"Save\\/Edit SO Assignment\",\"uid\":\"146\"},{\"id_application_action\":\"154\",\"action\":\"154\",\"name\":\"View Shift Change\",\"uid\":\"147\"},{\"id_application_action\":\"155\",\"action\":\"155\",\"name\":\"Create Shift Change\",\"uid\":\"148\"},{\"id_application_action\":\"156\",\"action\":\"156\",\"name\":\"Edit Shift Change\",\"uid\":\"149\"},{\"id_application_action\":\"157\",\"action\":\"157\",\"name\":\"Delete Shift Change\",\"uid\":\"150\"},{\"id_application_action\":\"158\",\"action\":\"158\",\"name\":\"Save\\/Edit Shift Change\",\"uid\":\"151\"},{\"id_application_action\":\"159\",\"action\":\"159\",\"name\":\"View Leave Application\",\"uid\":\"152\"},{\"id_application_action\":\"160\",\"action\":\"160\",\"name\":\"Create Leave Application\",\"uid\":\"153\"},{\"id_application_action\":\"161\",\"action\":\"161\",\"name\":\"Edit Leave Application\",\"uid\":\"154\"},{\"id_application_action\":\"162\",\"action\":\"162\",\"name\":\"Delete Leave Application\",\"uid\":\"155\"},{\"id_application_action\":\"163\",\"action\":\"163\",\"name\":\"Save\\/Edit Leave Application\",\"uid\":\"156\"},{\"id_application_action\":\"164\",\"action\":\"164\",\"name\":\"View Timesheet (Recap)\",\"uid\":\"157\"},{\"id_application_action\":\"165\",\"action\":\"165\",\"name\":\"Create Timesheet (Recap)\",\"uid\":\"158\"},{\"id_application_action\":\"166\",\"action\":\"166\",\"name\":\"Edit Timesheet (Recap)\",\"uid\":\"159\"},{\"id_application_action\":\"167\",\"action\":\"167\",\"name\":\"Delete Timesheet (Recap)\",\"uid\":\"160\"},{\"id_application_action\":\"168\",\"action\":\"168\",\"name\":\"Save\\/Edit Timesheet (Recap)\",\"uid\":\"161\"},{\"id_application_action\":\"169\",\"action\":\"169\",\"name\":\"View SO Timesheet\",\"uid\":\"162\"},{\"id_application_action\":\"170\",\"action\":\"170\",\"name\":\"Create SO Timesheet\",\"uid\":\"163\"},{\"id_application_action\":\"171\",\"action\":\"171\",\"name\":\"Edit SO Timesheet\",\"uid\":\"164\"},{\"id_application_action\":\"172\",\"action\":\"172\",\"name\":\"Delete SO Timesheet\",\"uid\":\"165\"},{\"id_application_action\":\"173\",\"action\":\"173\",\"name\":\"Save\\/Edit SO Timesheet\",\"uid\":\"166\"},{\"id_application_action\":\"174\",\"action\":\"174\",\"name\":\"View Incident Report\",\"uid\":\"167\"},{\"id_application_action\":\"175\",\"action\":\"175\",\"name\":\"Create Incident Report\",\"uid\":\"168\"},{\"id_application_action\":\"176\",\"action\":\"176\",\"name\":\"Edit Incident Report\",\"uid\":\"169\"},{\"id_application_action\":\"177\",\"action\":\"177\",\"name\":\"Delete Incident Report\",\"uid\":\"170\"},{\"id_application_action\":\"178\",\"action\":\"178\",\"name\":\"Save\\/Edit Incident Report\",\"uid\":\"171\"},{\"id_application_action\":\"179\",\"action\":\"179\",\"name\":\"View Payroll\",\"uid\":\"172\"},{\"id_application_action\":\"180\",\"action\":\"180\",\"name\":\"Create Payroll\",\"uid\":\"173\"},{\"id_application_action\":\"181\",\"action\":\"181\",\"name\":\"Edit Payroll\",\"uid\":\"174\"},{\"id_application_action\":\"182\",\"action\":\"182\",\"name\":\"Delete Payroll\",\"uid\":\"175\"},{\"id_application_action\":\"183\",\"action\":\"183\",\"name\":\"Save\\/Edit Payroll\",\"uid\":\"176\"},{\"id_application_action\":\"184\",\"action\":\"184\",\"name\":\"View Supplier Invoice\",\"uid\":\"177\"},{\"id_application_action\":\"185\",\"action\":\"185\",\"name\":\"Create Supplier Invoice\",\"uid\":\"178\"},{\"id_application_action\":\"186\",\"action\":\"186\",\"name\":\"Edit Supplier Invoice\",\"uid\":\"179\"},{\"id_application_action\":\"187\",\"action\":\"187\",\"name\":\"Delete Supplier Invoice\",\"uid\":\"180\"},{\"id_application_action\":\"188\",\"action\":\"188\",\"name\":\"Save\\/Edit Supplier Invoice\",\"uid\":\"181\"},{\"id_application_action\":\"189\",\"action\":\"189\",\"name\":\"View Customer Invoice\",\"uid\":\"182\"},{\"id_application_action\":\"190\",\"action\":\"190\",\"name\":\"Create Customer Invoice\",\"uid\":\"183\"},{\"id_application_action\":\"191\",\"action\":\"191\",\"name\":\"Edit Customer Invoice\",\"uid\":\"184\"},{\"id_application_action\":\"192\",\"action\":\"192\",\"name\":\"Delete Customer Invoice\",\"uid\":\"185\"},{\"id_application_action\":\"193\",\"action\":\"193\",\"name\":\"Save\\/Edit Customer Invoice\",\"uid\":\"186\"},{\"id_application_action\":\"194\",\"action\":\"194\",\"name\":\"View Bank Statement\",\"uid\":\"187\"},{\"id_application_action\":\"195\",\"action\":\"195\",\"name\":\"Create Bank Statement\",\"uid\":\"188\"},{\"id_application_action\":\"196\",\"action\":\"196\",\"name\":\"Edit Bank Statement\",\"uid\":\"189\"},{\"id_application_action\":\"197\",\"action\":\"197\",\"name\":\"Delete Bank Statement\",\"uid\":\"190\"},{\"id_application_action\":\"198\",\"action\":\"198\",\"name\":\"Save\\/Edit Bank Statement\",\"uid\":\"191\"},{\"id_application_action\":\"199\",\"action\":\"199\",\"name\":\"View Cash Register\",\"uid\":\"192\"},{\"id_application_action\":\"200\",\"action\":\"200\",\"name\":\"Create Cash Register\",\"uid\":\"193\"},{\"id_application_action\":\"201\",\"action\":\"201\",\"name\":\"Edit Cash Register\",\"uid\":\"194\"},{\"id_application_action\":\"202\",\"action\":\"202\",\"name\":\"Delete Cash Register\",\"uid\":\"195\"},{\"id_application_action\":\"203\",\"action\":\"203\",\"name\":\"Save\\/Edit Cash Register\",\"uid\":\"196\"},{\"id_application_action\":\"204\",\"action\":\"204\",\"name\":\"View Tax\",\"uid\":\"197\"},{\"id_application_action\":\"205\",\"action\":\"205\",\"name\":\"Create Tax\",\"uid\":\"198\"},{\"id_application_action\":\"206\",\"action\":\"206\",\"name\":\"Edit Tax\",\"uid\":\"199\"},{\"id_application_action\":\"207\",\"action\":\"207\",\"name\":\"Delete Tax\",\"uid\":\"200\"},{\"id_application_action\":\"208\",\"action\":\"208\",\"name\":\"Save\\/Edit Tax\",\"uid\":\"201\"},{\"id_application_action\":\"209\",\"action\":\"209\",\"name\":\"View Chart of Account\",\"uid\":\"202\"},{\"id_application_action\":\"210\",\"action\":\"210\",\"name\":\"Create Chart of Account\",\"uid\":\"203\"},{\"id_application_action\":\"211\",\"action\":\"211\",\"name\":\"Edit Chart of Account\",\"uid\":\"204\"},{\"id_application_action\":\"212\",\"action\":\"212\",\"name\":\"Delete Chart of Account\",\"uid\":\"205\"},{\"id_application_action\":\"213\",\"action\":\"213\",\"name\":\"Save\\/Edit Chart of Account\",\"uid\":\"206\"},{\"id_application_action\":\"214\",\"action\":\"214\",\"name\":\"View Employee Salary\",\"uid\":\"207\"},{\"id_application_action\":\"215\",\"action\":\"215\",\"name\":\"Create Employee Salary\",\"uid\":\"208\"},{\"id_application_action\":\"216\",\"action\":\"216\",\"name\":\"Edit Employee Salary\",\"uid\":\"209\"},{\"id_application_action\":\"217\",\"action\":\"217\",\"name\":\"Delete Employee Salary\",\"uid\":\"210\"},{\"id_application_action\":\"218\",\"action\":\"218\",\"name\":\"Save\\/Edit Employee Salary\",\"uid\":\"211\"},{\"id_application_action\":\"219\",\"action\":\"219\",\"name\":\"View Salary Setting\",\"uid\":\"212\"},{\"id_application_action\":\"220\",\"action\":\"220\",\"name\":\"Create Salary Setting\",\"uid\":\"213\"},{\"id_application_action\":\"221\",\"action\":\"221\",\"name\":\"Edit Salary Setting\",\"uid\":\"214\"},{\"id_application_action\":\"222\",\"action\":\"222\",\"name\":\"Delete Salary Setting\",\"uid\":\"215\"},{\"id_application_action\":\"223\",\"action\":\"223\",\"name\":\"Save\\/Edit Salary Setting\",\"uid\":\"216\"},{\"id_application_action\":\"224\",\"action\":\"224\",\"name\":\"View Database Interface\",\"uid\":\"217\"},{\"id_application_action\":\"225\",\"action\":\"225\",\"name\":\"Pick Assessment Template\",\"uid\":\"218\"},{\"id_application_action\":\"226\",\"action\":\"226\",\"name\":\"View Organisation Structure\",\"uid\":\"219\"},{\"id_application_action\":\"227\",\"action\":\"227\",\"name\":\"Create Organisation Structure\",\"uid\":\"220\"},{\"id_application_action\":\"228\",\"action\":\"228\",\"name\":\"Edit Organisation Structure\",\"uid\":\"221\"},{\"id_application_action\":\"229\",\"action\":\"229\",\"name\":\"Delete Organisation Structure\",\"uid\":\"222\"},{\"id_application_action\":\"230\",\"action\":\"230\",\"name\":\"Save\\/Edit Organisation Structure\",\"uid\":\"223\"},{\"id_application_action\":\"231\",\"action\":\"231\",\"name\":\"View Position Level\",\"uid\":\"224\"},{\"id_application_action\":\"232\",\"action\":\"232\",\"name\":\"Create Position Level\",\"uid\":\"225\"},{\"id_application_action\":\"233\",\"action\":\"233\",\"name\":\"Edit Position Level\",\"uid\":\"226\"},{\"id_application_action\":\"234\",\"action\":\"234\",\"name\":\"Delete Position Level\",\"uid\":\"227\"},{\"id_application_action\":\"235\",\"action\":\"235\",\"name\":\"Save\\/Edit Position Level\",\"uid\":\"228\"},{\"id_application_action\":\"236\",\"action\":\"236\",\"name\":\"View Employee Contract Type\",\"uid\":\"229\"},{\"id_application_action\":\"237\",\"action\":\"237\",\"name\":\"Create Employee Contract Type\",\"uid\":\"230\"},{\"id_application_action\":\"238\",\"action\":\"238\",\"name\":\"Edit Employee Contract Type\",\"uid\":\"231\"},{\"id_application_action\":\"239\",\"action\":\"239\",\"name\":\"Delete Employee Contract Type\",\"uid\":\"232\"},{\"id_application_action\":\"240\",\"action\":\"240\",\"name\":\"Save\\/Edit Employee Contract\",\"uid\":\"233\"},{\"id_application_action\":\"241\",\"action\":\"241\",\"name\":\"View Bank\",\"uid\":\"234\"},{\"id_application_action\":\"242\",\"action\":\"242\",\"name\":\"Create Bank\",\"uid\":\"235\"},{\"id_application_action\":\"243\",\"action\":\"243\",\"name\":\"Edit Bank\",\"uid\":\"236\"},{\"id_application_action\":\"244\",\"action\":\"244\",\"name\":\"Delete Bank\",\"uid\":\"237\"},{\"id_application_action\":\"245\",\"action\":\"245\",\"name\":\"Save\\/Edit Bank\",\"uid\":\"238\"},{\"id_application_action\":\"246\",\"action\":\"246\",\"name\":\"View Payment Receipt\",\"uid\":\"239\"},{\"id_application_action\":\"247\",\"action\":\"247\",\"name\":\"Create Payment Receipt\",\"uid\":\"240\"},{\"id_application_action\":\"248\",\"action\":\"248\",\"name\":\"Edit Payment Receipt\",\"uid\":\"241\"},{\"id_application_action\":\"249\",\"action\":\"249\",\"name\":\"Save\\/Edit Payment Receipt\",\"uid\":\"242\"},{\"id_application_action\":\"250\",\"action\":\"250\",\"name\":\"Delete Payment Receipt\",\"uid\":\"243\"},{\"id_application_action\":\"251\",\"action\":\"251\",\"name\":\"Receive Payment From PO\",\"uid\":\"244\"},{\"id_application_action\":\"252\",\"action\":\"252\",\"name\":\"Make Payment Receipt\",\"uid\":\"245\"},{\"id_application_action\":\"253\",\"action\":\"253\",\"name\":\"Cancel Payment Receipt\",\"uid\":\"246\"},{\"id_application_action\":\"254\",\"action\":\"254\",\"name\":\"View Stock Transaction\",\"uid\":\"247\"},{\"id_application_action\":\"255\",\"action\":\"255\",\"name\":\"Create Stock Transaction\",\"uid\":\"248\"},{\"id_application_action\":\"256\",\"action\":\"256\",\"name\":\"Edit Stock Transaction\",\"uid\":\"249\"},{\"id_application_action\":\"257\",\"action\":\"257\",\"name\":\"Delete Stock Transaction\",\"uid\":\"250\"},{\"id_application_action\":\"258\",\"action\":\"258\",\"name\":\"Save\\/Edit Stock Transaction\",\"uid\":\"251\"},{\"id_application_action\":\"259\",\"action\":\"259\",\"name\":\"Post Stock Transaction\",\"uid\":\"252\"},{\"id_application_action\":\"260\",\"action\":\"260\",\"name\":\"Unpost Stock Transaction\",\"uid\":\"253\"},{\"id_application_action\":\"261\",\"action\":\"261\",\"name\":\"Transfer Good Receive\",\"uid\":\"254\"},{\"id_application_action\":\"262\",\"name\":\"View Activity\",\"uid\":\"255\",\"id\":\"255\"}],\"is_edit\":\"true\",\"id_role\":\"1\"}', '2015-01-25 22:13:11');
INSERT INTO `activity_log` VALUES ('128', 'Save/Edit Side Menu', 'side_menu', null, '2', 'Save/Edit Side Menu', '9', '{}', '2015-01-25 22:25:21');
INSERT INTO `activity_log` VALUES ('129', 'Save/Edit Side Menu', 'side_menu', null, '2', 'Save/Edit Side Menu', '9', '{}', '2015-01-25 22:25:44');
INSERT INTO `activity_log` VALUES ('130', 'Save/Edit Unit Measure', 'unit_measure', null, '2', 'Save/Edit Unit Measure', '92', '{}', '2015-01-25 22:32:29');
INSERT INTO `activity_log` VALUES ('131', 'Save/Edit Product', 'product', null, '2', 'Save/Edit Product', '25', '{}', '2015-01-26 09:13:42');
INSERT INTO `activity_log` VALUES ('132', 'Save/Edit Product', 'product', null, '2', 'Save/Edit Product', '25', '{}', '2015-01-26 09:14:01');
INSERT INTO `activity_log` VALUES ('133', 'Save/Edit Product', 'product', null, '2', 'Save/Edit Product', '25', '{}', '2015-01-26 09:14:15');
INSERT INTO `activity_log` VALUES ('134', 'Save/Edit Side Menu', 'side_menu', null, '2', 'Save/Edit Side Menu', '9', '{}', '2015-01-26 09:51:40');
INSERT INTO `activity_log` VALUES ('135', 'Save/Edit Side Menu', 'side_menu', null, '2', 'Save/Edit Side Menu', '9', '{}', '2015-01-26 09:52:10');
INSERT INTO `activity_log` VALUES ('136', 'Save/Edit Side Menu', 'side_menu', null, '2', 'Save/Edit Side Menu', '9', '{}', '2015-01-26 09:52:52');
INSERT INTO `activity_log` VALUES ('137', 'Save/Edit PO', 'po', null, '2', 'Save/Edit PO', '61', '{\"date\":\"2015-01-30\",\"note\":\"\",\"delivery_date\":\"2015-01-31\",\"supplier\":\"1\",\"mr\":\"\",\"sub_total\":\"1000000\",\"total_price\":\"1100000\",\"tax\":\"100000\",\"product_detail\":[{\"id_product\":\"2\",\"product_category\":\"1\",\"merk\":\"2\",\"product_code\":\"XXX.XXX.XXX.001\",\"product_name\":\"Product Test\",\"name\":\"Merk1\",\"unit_name\":\"pcs\",\"unit\":\"2\",\"category_name\":\"Category 1\",\"uid\":\"2\",\"qty\":\"10\",\"unit_price\":\"100000\",\"total_price\":\"0\"}],\"is_edit\":\"false\",\"id_po\":\"\"}', '2015-01-30 20:30:10');
INSERT INTO `activity_log` VALUES ('138', 'Validate PO', 'po', null, '2', 'Validate PO', '99', '{\"id_po\":\"3\",\"status\":\"open\"}', '2015-01-30 20:30:16');
INSERT INTO `activity_log` VALUES ('139', 'Save/Edit Good Receive', 'gr', null, '2', 'Save/Edit Good Receive', '71', '{}', '2015-01-30 20:31:35');
INSERT INTO `activity_log` VALUES ('140', 'Transfer Good Receive', 'gr', null, '2', 'Transfer Good Receive', '261', '{}', '2015-01-30 20:31:57');
INSERT INTO `activity_log` VALUES ('141', 'Save/Edit Payment Receipt', 'payment_receipt', null, '2', 'Save/Edit Payment Receipt', '249', '{}', '2015-01-30 20:32:43');
INSERT INTO `activity_log` VALUES ('142', 'Make Payment Receipt', 'payment_receipt', null, '2', 'Make Payment Receipt', '252', '{}', '2015-01-30 20:32:43');
INSERT INTO `activity_log` VALUES ('143', 'Save/Edit Payment Receipt', 'payment_receipt', null, '2', 'Save/Edit Payment Receipt', '249', '{}', '2015-01-30 20:33:28');
INSERT INTO `activity_log` VALUES ('144', 'Save/Edit Payment Receipt', 'payment_receipt', null, '2', 'Save/Edit Payment Receipt', '249', '{}', '2015-01-30 20:33:35');
INSERT INTO `activity_log` VALUES ('145', 'Make Payment Receipt', 'payment_receipt', null, '2', 'Make Payment Receipt', '252', '{}', '2015-01-30 20:33:35');
INSERT INTO `activity_log` VALUES ('146', 'Save/Edit Chart of Account', 'coa', null, '2', 'Save/Edit Chart of Account', '213', '{}', '2015-02-01 11:54:22');
INSERT INTO `activity_log` VALUES ('147', 'Save/Edit Chart of Account', 'coa', null, '2', 'Save/Edit Chart of Account', '213', '{}', '2015-02-01 11:54:53');
INSERT INTO `activity_log` VALUES ('148', 'Save/Edit Chart of Account', 'coa', null, '2', 'Save/Edit Chart of Account', '213', '{}', '2015-02-01 11:55:30');
INSERT INTO `activity_log` VALUES ('149', 'Delete Chart of Account', 'coa', null, '2', 'Delete Chart of Account', '212', '{}', '2015-02-01 11:55:50');
INSERT INTO `activity_log` VALUES ('150', 'Save/Edit Chart of Account', 'coa', null, '2', 'Save/Edit Chart of Account', '213', '{}', '2015-02-01 11:56:08');
INSERT INTO `activity_log` VALUES ('151', 'Save/Edit Bank', 'bank', null, '2', 'Save/Edit Bank', '245', '{}', '2015-02-07 17:35:36');
INSERT INTO `activity_log` VALUES ('152', 'Save/Edit Cash Register', 'cash_register', null, '2', 'Save/Edit Cash Register', '203', '{}', '2015-02-07 17:36:12');
INSERT INTO `activity_log` VALUES ('153', 'Save/Edit Inquiry', 'inquiry', null, '2', 'Save/Edit Inquiry', '113', '{}', '2015-02-11 11:05:12');
INSERT INTO `activity_log` VALUES ('154', 'Save/Edit Inquiry', 'inquiry', null, '2', 'Save/Edit Inquiry', '113', '{}', '2015-02-11 11:06:14');
INSERT INTO `activity_log` VALUES ('155', 'Delete Inquiry', 'inquiry', null, '2', 'Delete Inquiry', '112', '{}', '2015-02-11 11:06:23');
INSERT INTO `activity_log` VALUES ('156', 'Save/Edit Quotation', 'quotation', null, '2', 'Save/Edit Quotation', '123', '{}', '2015-02-12 06:37:29');
INSERT INTO `activity_log` VALUES ('157', 'Save/Edit Work Schedule', 'work_schedule', null, '2', 'Save/Edit Work Schedule', '148', '{}', '2015-02-13 08:41:57');
INSERT INTO `activity_log` VALUES ('158', 'Save/Edit Role', 'role', null, '2', 'Save/Edit Role', '20', '{\"name\":\"administrator\",\"action_detail\":[{\"id_application_action\":\"1\",\"action\":\"1\",\"name\":\"View Application Action\",\"uid\":\"0\"},{\"id_application_action\":\"2\",\"action\":\"2\",\"name\":\"Create Application Action\",\"uid\":\"1\"},{\"id_application_action\":\"3\",\"action\":\"3\",\"name\":\"Edit Application Action\",\"uid\":\"2\"},{\"id_application_action\":\"4\",\"action\":\"4\",\"name\":\"Delete Application Action\",\"uid\":\"3\"},{\"id_application_action\":\"5\",\"action\":\"5\",\"name\":\"View Side Menu\",\"uid\":\"4\"},{\"id_application_action\":\"6\",\"action\":\"6\",\"name\":\"Create Side Menu\",\"uid\":\"5\"},{\"id_application_action\":\"7\",\"action\":\"7\",\"name\":\"Edit Side Menu\",\"uid\":\"6\"},{\"id_application_action\":\"8\",\"action\":\"8\",\"name\":\"Delete Side Menu\",\"uid\":\"7\"},{\"id_application_action\":\"9\",\"action\":\"9\",\"name\":\"Save\\/Edit Side Menu\",\"uid\":\"8\"},{\"id_application_action\":\"10\",\"action\":\"10\",\"name\":\"Save\\/Edit Action\",\"uid\":\"9\"},{\"id_application_action\":\"11\",\"action\":\"11\",\"name\":\"View Division\",\"uid\":\"10\"},{\"id_application_action\":\"12\",\"action\":\"12\",\"name\":\"Create Division\",\"uid\":\"11\"},{\"id_application_action\":\"13\",\"action\":\"13\",\"name\":\"Save\\/Edit Division\",\"uid\":\"12\"},{\"id_application_action\":\"14\",\"action\":\"14\",\"name\":\"Edit Division\",\"uid\":\"13\"},{\"id_application_action\":\"15\",\"action\":\"15\",\"name\":\"Delete Division\",\"uid\":\"14\"},{\"id_application_action\":\"16\",\"action\":\"16\",\"name\":\"View Role\",\"uid\":\"15\"},{\"id_application_action\":\"17\",\"action\":\"17\",\"name\":\"View Create Role\",\"uid\":\"16\"},{\"id_application_action\":\"18\",\"action\":\"18\",\"name\":\"View Edit Role\",\"uid\":\"17\"},{\"id_application_action\":\"19\",\"action\":\"19\",\"name\":\"Delete Role\",\"uid\":\"18\"},{\"id_application_action\":\"20\",\"action\":\"20\",\"name\":\"Save\\/Edit Role\",\"uid\":\"19\"},{\"id_application_action\":\"21\",\"action\":\"21\",\"name\":\"View Product\",\"uid\":\"20\"},{\"id_application_action\":\"22\",\"action\":\"22\",\"name\":\"Create Product\",\"uid\":\"21\"},{\"id_application_action\":\"23\",\"action\":\"23\",\"name\":\"Edit Product\",\"uid\":\"22\"},{\"id_application_action\":\"24\",\"action\":\"24\",\"name\":\"Delete Product\",\"uid\":\"23\"},{\"id_application_action\":\"25\",\"action\":\"25\",\"name\":\"Save\\/Edit Product\",\"uid\":\"24\"},{\"id_application_action\":\"26\",\"action\":\"26\",\"name\":\"View Supplier\",\"uid\":\"25\"},{\"id_application_action\":\"27\",\"action\":\"27\",\"name\":\"Create Supplier\",\"uid\":\"26\"},{\"id_application_action\":\"28\",\"action\":\"28\",\"name\":\"Edit Supplier\",\"uid\":\"27\"},{\"id_application_action\":\"29\",\"action\":\"29\",\"name\":\"Delete Supplier\",\"uid\":\"28\"},{\"id_application_action\":\"30\",\"action\":\"30\",\"name\":\"Save\\/Edit Supplier\",\"uid\":\"29\"},{\"id_application_action\":\"31\",\"action\":\"31\",\"name\":\"View Product Category\",\"uid\":\"30\"},{\"id_application_action\":\"32\",\"action\":\"32\",\"name\":\"Create Product Category\",\"uid\":\"31\"},{\"id_application_action\":\"33\",\"action\":\"33\",\"name\":\"Edit Product Category\",\"uid\":\"32\"},{\"id_application_action\":\"34\",\"action\":\"34\",\"name\":\"Delete Product Category\",\"uid\":\"33\"},{\"id_application_action\":\"35\",\"action\":\"35\",\"name\":\"Save\\/Edit Product Category\",\"uid\":\"34\"},{\"id_application_action\":\"36\",\"action\":\"36\",\"name\":\"View Merk\",\"uid\":\"35\"},{\"id_application_action\":\"37\",\"action\":\"37\",\"name\":\"Create Merk\",\"uid\":\"36\"},{\"id_application_action\":\"38\",\"action\":\"38\",\"name\":\"Edit Merk\",\"uid\":\"37\"},{\"id_application_action\":\"39\",\"action\":\"39\",\"name\":\"Delete Merk\",\"uid\":\"38\"},{\"id_application_action\":\"40\",\"action\":\"40\",\"name\":\"Save\\/Edit Merk\",\"uid\":\"39\"},{\"id_application_action\":\"41\",\"action\":\"41\",\"name\":\"View Customer\",\"uid\":\"40\"},{\"id_application_action\":\"43\",\"action\":\"43\",\"name\":\"Create Customer\",\"uid\":\"41\"},{\"id_application_action\":\"44\",\"action\":\"44\",\"name\":\"Edit Customer\",\"uid\":\"42\"},{\"id_application_action\":\"45\",\"action\":\"45\",\"name\":\"Delete Customer\",\"uid\":\"43\"},{\"id_application_action\":\"46\",\"action\":\"46\",\"name\":\"Save\\/Edit Customer\",\"uid\":\"44\"},{\"id_application_action\":\"47\",\"action\":\"47\",\"name\":\"View Warehouse\",\"uid\":\"45\"},{\"id_application_action\":\"48\",\"action\":\"48\",\"name\":\"Create Warehouse\",\"uid\":\"46\"},{\"id_application_action\":\"49\",\"action\":\"49\",\"name\":\"Edit Warehouse\",\"uid\":\"47\"},{\"id_application_action\":\"50\",\"action\":\"50\",\"name\":\"Delete Warehouse\",\"uid\":\"48\"},{\"id_application_action\":\"51\",\"action\":\"51\",\"name\":\"Save\\/Edit Warehouse\",\"uid\":\"49\"},{\"id_application_action\":\"57\",\"action\":\"57\",\"name\":\"View PO\",\"uid\":\"50\"},{\"id_application_action\":\"58\",\"action\":\"58\",\"name\":\"Create PO\",\"uid\":\"51\"},{\"id_application_action\":\"59\",\"action\":\"59\",\"name\":\"Edit PO\",\"uid\":\"52\"},{\"id_application_action\":\"60\",\"action\":\"60\",\"name\":\"Delete PO\",\"uid\":\"53\"},{\"id_application_action\":\"61\",\"action\":\"61\",\"name\":\"Save\\/Edit PO\",\"uid\":\"54\"},{\"id_application_action\":\"62\",\"action\":\"62\",\"name\":\"View User\",\"uid\":\"55\"},{\"id_application_action\":\"63\",\"action\":\"63\",\"name\":\"Create User\",\"uid\":\"56\"},{\"id_application_action\":\"64\",\"action\":\"64\",\"name\":\"Edit User\",\"uid\":\"57\"},{\"id_application_action\":\"65\",\"action\":\"65\",\"name\":\"Delete User\",\"uid\":\"58\"},{\"id_application_action\":\"66\",\"action\":\"66\",\"name\":\"Save\\/Edit User\",\"uid\":\"59\"},{\"id_application_action\":\"67\",\"action\":\"67\",\"name\":\"View Good Receive\",\"uid\":\"60\"},{\"id_application_action\":\"68\",\"action\":\"68\",\"name\":\"Create Good Receive\",\"uid\":\"61\"},{\"id_application_action\":\"69\",\"action\":\"69\",\"name\":\"Edit Good Receive\",\"uid\":\"62\"},{\"id_application_action\":\"70\",\"action\":\"70\",\"name\":\"Delete Good Receive\",\"uid\":\"63\"},{\"id_application_action\":\"71\",\"action\":\"71\",\"name\":\"Save\\/Edit Good Receive\",\"uid\":\"64\"},{\"id_application_action\":\"72\",\"action\":\"72\",\"name\":\"View Sales Order\",\"uid\":\"65\"},{\"id_application_action\":\"73\",\"action\":\"73\",\"name\":\"Create Sales Order\",\"uid\":\"66\"},{\"id_application_action\":\"74\",\"action\":\"74\",\"name\":\"Edit Sales Order\",\"uid\":\"67\"},{\"id_application_action\":\"75\",\"action\":\"75\",\"name\":\"Delete Sales Order\",\"uid\":\"68\"},{\"id_application_action\":\"76\",\"action\":\"76\",\"name\":\"Save Sales Order\",\"uid\":\"69\"},{\"id_application_action\":\"77\",\"action\":\"77\",\"name\":\"View Material Request\",\"uid\":\"70\"},{\"id_application_action\":\"78\",\"action\":\"78\",\"name\":\"Create Material Request\",\"uid\":\"71\"},{\"id_application_action\":\"79\",\"action\":\"79\",\"name\":\"Edit Material Request\",\"uid\":\"72\"},{\"id_application_action\":\"80\",\"action\":\"80\",\"name\":\"Delete Material Request\",\"uid\":\"73\"},{\"id_application_action\":\"81\",\"action\":\"81\",\"name\":\"Save Material Request\",\"uid\":\"74\"},{\"id_application_action\":\"82\",\"action\":\"82\",\"name\":\"Change User Password\",\"uid\":\"75\"},{\"id_application_action\":\"83\",\"action\":\"83\",\"name\":\"View Delivery Note\",\"uid\":\"76\"},{\"id_application_action\":\"84\",\"action\":\"84\",\"name\":\"Create Delivery Note\",\"uid\":\"77\"},{\"id_application_action\":\"85\",\"action\":\"85\",\"name\":\"Edit Delivery Note\",\"uid\":\"78\"},{\"id_application_action\":\"86\",\"action\":\"86\",\"name\":\"Delete Delivery Note\",\"uid\":\"79\"},{\"id_application_action\":\"87\",\"action\":\"87\",\"name\":\"Save\\/Edit Delivery Note\",\"uid\":\"80\"},{\"id_application_action\":\"88\",\"action\":\"88\",\"name\":\"View Unit Measure\",\"uid\":\"81\"},{\"id_application_action\":\"89\",\"action\":\"89\",\"name\":\"Create Unit Measure\",\"uid\":\"82\"},{\"id_application_action\":\"90\",\"action\":\"90\",\"name\":\"Edit Unit Measure\",\"uid\":\"83\"},{\"id_application_action\":\"91\",\"action\":\"91\",\"name\":\"Delete Unit Measure\",\"uid\":\"84\"},{\"id_application_action\":\"92\",\"action\":\"92\",\"name\":\"Save\\/Edit Unit Measure\",\"uid\":\"85\"},{\"id_application_action\":\"93\",\"action\":\"93\",\"name\":\"View Stock\",\"uid\":\"86\"},{\"id_application_action\":\"94\",\"action\":\"94\",\"name\":\"View Employee\",\"uid\":\"87\"},{\"id_application_action\":\"95\",\"action\":\"95\",\"name\":\"Create Employee\",\"uid\":\"88\"},{\"id_application_action\":\"96\",\"action\":\"96\",\"name\":\"Edit Employee\",\"uid\":\"89\"},{\"id_application_action\":\"97\",\"action\":\"97\",\"name\":\"Delete Employee\",\"uid\":\"90\"},{\"id_application_action\":\"98\",\"action\":\"98\",\"name\":\"Save\\/Edit Employee\",\"uid\":\"91\"},{\"id_application_action\":\"99\",\"action\":\"99\",\"name\":\"Validate PO\",\"uid\":\"92\"},{\"id_application_action\":\"100\",\"action\":\"100\",\"name\":\"Create Database Interface\",\"uid\":\"93\"},{\"id_application_action\":\"101\",\"action\":\"101\",\"name\":\"Edit Database Interface\",\"uid\":\"94\"},{\"id_application_action\":\"102\",\"action\":\"102\",\"name\":\"Delete Database Interface\",\"uid\":\"95\"},{\"id_application_action\":\"103\",\"action\":\"103\",\"name\":\"Save \\/ Edit Database Interface\",\"uid\":\"96\"},{\"id_application_action\":\"104\",\"action\":\"104\",\"name\":\"View Database Field Interface\",\"uid\":\"97\"},{\"id_application_action\":\"105\",\"action\":\"105\",\"name\":\"Create Database Field Interface\",\"uid\":\"98\"},{\"id_application_action\":\"106\",\"action\":\"106\",\"name\":\"Edit Database Field Interface\",\"uid\":\"99\"},{\"id_application_action\":\"107\",\"action\":\"107\",\"name\":\"Delete Database Field Interface\",\"uid\":\"100\"},{\"id_application_action\":\"108\",\"action\":\"108\",\"name\":\"Save \\/ Edit Database Field Interface\",\"uid\":\"101\"},{\"id_application_action\":\"109\",\"action\":\"109\",\"name\":\"View Inquiry\",\"uid\":\"102\"},{\"id_application_action\":\"110\",\"action\":\"110\",\"name\":\"Create Inquiry\",\"uid\":\"103\"},{\"id_application_action\":\"111\",\"action\":\"111\",\"name\":\"Edit Inquiry\",\"uid\":\"104\"},{\"id_application_action\":\"112\",\"action\":\"112\",\"name\":\"Delete Inquiry\",\"uid\":\"105\"},{\"id_application_action\":\"113\",\"action\":\"113\",\"name\":\"Save\\/Edit Inquiry\",\"uid\":\"106\"},{\"id_application_action\":\"114\",\"action\":\"114\",\"name\":\"View Survey \\/ Assessment\",\"uid\":\"107\"},{\"id_application_action\":\"115\",\"action\":\"115\",\"name\":\"Create Survey \\/ Assessment\",\"uid\":\"108\"},{\"id_application_action\":\"116\",\"action\":\"116\",\"name\":\"Edit Survey \\/ Assessment\",\"uid\":\"109\"},{\"id_application_action\":\"117\",\"action\":\"117\",\"name\":\"Delete Survey \\/ Assessment\",\"uid\":\"110\"},{\"id_application_action\":\"118\",\"action\":\"118\",\"name\":\"Save\\/Edit Survey \\/ Assessment\",\"uid\":\"111\"},{\"id_application_action\":\"119\",\"action\":\"119\",\"name\":\"View Quotation\",\"uid\":\"112\"},{\"id_application_action\":\"120\",\"action\":\"120\",\"name\":\"Create Quotation\",\"uid\":\"113\"},{\"id_application_action\":\"121\",\"action\":\"121\",\"name\":\"Edit Quotation\",\"uid\":\"114\"},{\"id_application_action\":\"122\",\"action\":\"122\",\"name\":\"Delete Quotation\",\"uid\":\"115\"},{\"id_application_action\":\"123\",\"action\":\"123\",\"name\":\"Save\\/Edit Quotation\",\"uid\":\"116\"},{\"id_application_action\":\"124\",\"action\":\"124\",\"name\":\"View Project Contract\",\"uid\":\"117\"},{\"id_application_action\":\"125\",\"action\":\"125\",\"name\":\"Create Project Contract\",\"uid\":\"118\"},{\"id_application_action\":\"126\",\"action\":\"126\",\"name\":\"Edit Project Contract\",\"uid\":\"119\"},{\"id_application_action\":\"127\",\"action\":\"127\",\"name\":\"Delete Project Contract\",\"uid\":\"120\"},{\"id_application_action\":\"128\",\"action\":\"128\",\"name\":\"Save\\/Edit Project Contract\",\"uid\":\"121\"},{\"id_application_action\":\"129\",\"action\":\"129\",\"name\":\"View Work Order\",\"uid\":\"122\"},{\"id_application_action\":\"130\",\"action\":\"130\",\"name\":\"Create Work Order\",\"uid\":\"123\"},{\"id_application_action\":\"131\",\"action\":\"131\",\"name\":\"Edit Work Order\",\"uid\":\"124\"},{\"id_application_action\":\"132\",\"action\":\"132\",\"name\":\"Delete Work Order\",\"uid\":\"125\"},{\"id_application_action\":\"133\",\"action\":\"133\",\"name\":\"Save\\/Edit Work Order\",\"uid\":\"126\"},{\"id_application_action\":\"134\",\"action\":\"134\",\"name\":\"View Assessment Template\",\"uid\":\"127\"},{\"id_application_action\":\"135\",\"action\":\"135\",\"name\":\"Create Assessment Template\",\"uid\":\"128\"},{\"id_application_action\":\"136\",\"action\":\"136\",\"name\":\"Edit Assessment Template\",\"uid\":\"129\"},{\"id_application_action\":\"137\",\"action\":\"137\",\"name\":\"Delete Assessment Template\",\"uid\":\"130\"},{\"id_application_action\":\"138\",\"action\":\"138\",\"name\":\"Save\\/Edit Assessment Template\",\"uid\":\"131\"},{\"id_application_action\":\"139\",\"action\":\"139\",\"name\":\"View Contract Template\",\"uid\":\"132\"},{\"id_application_action\":\"140\",\"action\":\"140\",\"name\":\"Create Contract Template\",\"uid\":\"133\"},{\"id_application_action\":\"141\",\"action\":\"141\",\"name\":\"Edit Contract Template\",\"uid\":\"134\"},{\"id_application_action\":\"142\",\"action\":\"142\",\"name\":\"Delete Contract Template\",\"uid\":\"135\"},{\"id_application_action\":\"143\",\"action\":\"143\",\"name\":\"Save\\/Edit Contract Template\",\"uid\":\"136\"},{\"id_application_action\":\"144\",\"action\":\"144\",\"name\":\"View Work Schedule\",\"uid\":\"137\"},{\"id_application_action\":\"145\",\"action\":\"145\",\"name\":\"Create Work Schedule\",\"uid\":\"138\"},{\"id_application_action\":\"146\",\"action\":\"146\",\"name\":\"Edit Work Schedule\",\"uid\":\"139\"},{\"id_application_action\":\"147\",\"action\":\"147\",\"name\":\"Delete Work Schedule\",\"uid\":\"140\"},{\"id_application_action\":\"148\",\"action\":\"148\",\"name\":\"Save\\/Edit Work Schedule\",\"uid\":\"141\"},{\"id_application_action\":\"149\",\"action\":\"149\",\"name\":\"View SO Assignment\",\"uid\":\"142\"},{\"id_application_action\":\"150\",\"action\":\"150\",\"name\":\"Create SO Assignment\",\"uid\":\"143\"},{\"id_application_action\":\"151\",\"action\":\"151\",\"name\":\"Edit SO Assignment\",\"uid\":\"144\"},{\"id_application_action\":\"152\",\"action\":\"152\",\"name\":\"Delete SO Assignment\",\"uid\":\"145\"},{\"id_application_action\":\"153\",\"action\":\"153\",\"name\":\"Save\\/Edit SO Assignment\",\"uid\":\"146\"},{\"id_application_action\":\"154\",\"action\":\"154\",\"name\":\"View Shift Change\",\"uid\":\"147\"},{\"id_application_action\":\"155\",\"action\":\"155\",\"name\":\"Create Shift Change\",\"uid\":\"148\"},{\"id_application_action\":\"156\",\"action\":\"156\",\"name\":\"Edit Shift Change\",\"uid\":\"149\"},{\"id_application_action\":\"157\",\"action\":\"157\",\"name\":\"Delete Shift Change\",\"uid\":\"150\"},{\"id_application_action\":\"158\",\"action\":\"158\",\"name\":\"Save\\/Edit Shift Change\",\"uid\":\"151\"},{\"id_application_action\":\"159\",\"action\":\"159\",\"name\":\"View Leave Application\",\"uid\":\"152\"},{\"id_application_action\":\"160\",\"action\":\"160\",\"name\":\"Create Leave Application\",\"uid\":\"153\"},{\"id_application_action\":\"161\",\"action\":\"161\",\"name\":\"Edit Leave Application\",\"uid\":\"154\"},{\"id_application_action\":\"162\",\"action\":\"162\",\"name\":\"Delete Leave Application\",\"uid\":\"155\"},{\"id_application_action\":\"163\",\"action\":\"163\",\"name\":\"Save\\/Edit Leave Application\",\"uid\":\"156\"},{\"id_application_action\":\"164\",\"action\":\"164\",\"name\":\"View Timesheet (Recap)\",\"uid\":\"157\"},{\"id_application_action\":\"165\",\"action\":\"165\",\"name\":\"Create Timesheet (Recap)\",\"uid\":\"158\"},{\"id_application_action\":\"166\",\"action\":\"166\",\"name\":\"Edit Timesheet (Recap)\",\"uid\":\"159\"},{\"id_application_action\":\"167\",\"action\":\"167\",\"name\":\"Delete Timesheet (Recap)\",\"uid\":\"160\"},{\"id_application_action\":\"168\",\"action\":\"168\",\"name\":\"Save\\/Edit Timesheet (Recap)\",\"uid\":\"161\"},{\"id_application_action\":\"169\",\"action\":\"169\",\"name\":\"View SO Timesheet\",\"uid\":\"162\"},{\"id_application_action\":\"170\",\"action\":\"170\",\"name\":\"Create SO Timesheet\",\"uid\":\"163\"},{\"id_application_action\":\"171\",\"action\":\"171\",\"name\":\"Edit SO Timesheet\",\"uid\":\"164\"},{\"id_application_action\":\"172\",\"action\":\"172\",\"name\":\"Delete SO Timesheet\",\"uid\":\"165\"},{\"id_application_action\":\"173\",\"action\":\"173\",\"name\":\"Save\\/Edit SO Timesheet\",\"uid\":\"166\"},{\"id_application_action\":\"174\",\"action\":\"174\",\"name\":\"View Incident Report\",\"uid\":\"167\"},{\"id_application_action\":\"175\",\"action\":\"175\",\"name\":\"Create Incident Report\",\"uid\":\"168\"},{\"id_application_action\":\"176\",\"action\":\"176\",\"name\":\"Edit Incident Report\",\"uid\":\"169\"},{\"id_application_action\":\"177\",\"action\":\"177\",\"name\":\"Delete Incident Report\",\"uid\":\"170\"},{\"id_application_action\":\"178\",\"action\":\"178\",\"name\":\"Save\\/Edit Incident Report\",\"uid\":\"171\"},{\"id_application_action\":\"179\",\"action\":\"179\",\"name\":\"View Payroll\",\"uid\":\"172\"},{\"id_application_action\":\"180\",\"action\":\"180\",\"name\":\"Create Payroll\",\"uid\":\"173\"},{\"id_application_action\":\"181\",\"action\":\"181\",\"name\":\"Edit Payroll\",\"uid\":\"174\"},{\"id_application_action\":\"182\",\"action\":\"182\",\"name\":\"Delete Payroll\",\"uid\":\"175\"},{\"id_application_action\":\"183\",\"action\":\"183\",\"name\":\"Save\\/Edit Payroll\",\"uid\":\"176\"},{\"id_application_action\":\"184\",\"action\":\"184\",\"name\":\"View Supplier Invoice\",\"uid\":\"177\"},{\"id_application_action\":\"185\",\"action\":\"185\",\"name\":\"Create Supplier Invoice\",\"uid\":\"178\"},{\"id_application_action\":\"186\",\"action\":\"186\",\"name\":\"Edit Supplier Invoice\",\"uid\":\"179\"},{\"id_application_action\":\"187\",\"action\":\"187\",\"name\":\"Delete Supplier Invoice\",\"uid\":\"180\"},{\"id_application_action\":\"188\",\"action\":\"188\",\"name\":\"Save\\/Edit Supplier Invoice\",\"uid\":\"181\"},{\"id_application_action\":\"189\",\"action\":\"189\",\"name\":\"View Customer Invoice\",\"uid\":\"182\"},{\"id_application_action\":\"190\",\"action\":\"190\",\"name\":\"Create Customer Invoice\",\"uid\":\"183\"},{\"id_application_action\":\"191\",\"action\":\"191\",\"name\":\"Edit Customer Invoice\",\"uid\":\"184\"},{\"id_application_action\":\"192\",\"action\":\"192\",\"name\":\"Delete Customer Invoice\",\"uid\":\"185\"},{\"id_application_action\":\"193\",\"action\":\"193\",\"name\":\"Save\\/Edit Customer Invoice\",\"uid\":\"186\"},{\"id_application_action\":\"194\",\"action\":\"194\",\"name\":\"View Bank Statement\",\"uid\":\"187\"},{\"id_application_action\":\"195\",\"action\":\"195\",\"name\":\"Create Bank Statement\",\"uid\":\"188\"},{\"id_application_action\":\"196\",\"action\":\"196\",\"name\":\"Edit Bank Statement\",\"uid\":\"189\"},{\"id_application_action\":\"197\",\"action\":\"197\",\"name\":\"Delete Bank Statement\",\"uid\":\"190\"},{\"id_application_action\":\"198\",\"action\":\"198\",\"name\":\"Save\\/Edit Bank Statement\",\"uid\":\"191\"},{\"id_application_action\":\"199\",\"action\":\"199\",\"name\":\"View Cash Register\",\"uid\":\"192\"},{\"id_application_action\":\"200\",\"action\":\"200\",\"name\":\"Create Cash Register\",\"uid\":\"193\"},{\"id_application_action\":\"201\",\"action\":\"201\",\"name\":\"Edit Cash Register\",\"uid\":\"194\"},{\"id_application_action\":\"202\",\"action\":\"202\",\"name\":\"Delete Cash Register\",\"uid\":\"195\"},{\"id_application_action\":\"203\",\"action\":\"203\",\"name\":\"Save\\/Edit Cash Register\",\"uid\":\"196\"},{\"id_application_action\":\"204\",\"action\":\"204\",\"name\":\"View Tax\",\"uid\":\"197\"},{\"id_application_action\":\"205\",\"action\":\"205\",\"name\":\"Create Tax\",\"uid\":\"198\"},{\"id_application_action\":\"206\",\"action\":\"206\",\"name\":\"Edit Tax\",\"uid\":\"199\"},{\"id_application_action\":\"207\",\"action\":\"207\",\"name\":\"Delete Tax\",\"uid\":\"200\"},{\"id_application_action\":\"208\",\"action\":\"208\",\"name\":\"Save\\/Edit Tax\",\"uid\":\"201\"},{\"id_application_action\":\"209\",\"action\":\"209\",\"name\":\"View Chart of Account\",\"uid\":\"202\"},{\"id_application_action\":\"210\",\"action\":\"210\",\"name\":\"Create Chart of Account\",\"uid\":\"203\"},{\"id_application_action\":\"211\",\"action\":\"211\",\"name\":\"Edit Chart of Account\",\"uid\":\"204\"},{\"id_application_action\":\"212\",\"action\":\"212\",\"name\":\"Delete Chart of Account\",\"uid\":\"205\"},{\"id_application_action\":\"213\",\"action\":\"213\",\"name\":\"Save\\/Edit Chart of Account\",\"uid\":\"206\"},{\"id_application_action\":\"214\",\"action\":\"214\",\"name\":\"View Employee Salary\",\"uid\":\"207\"},{\"id_application_action\":\"215\",\"action\":\"215\",\"name\":\"Create Employee Salary\",\"uid\":\"208\"},{\"id_application_action\":\"216\",\"action\":\"216\",\"name\":\"Edit Employee Salary\",\"uid\":\"209\"},{\"id_application_action\":\"217\",\"action\":\"217\",\"name\":\"Delete Employee Salary\",\"uid\":\"210\"},{\"id_application_action\":\"218\",\"action\":\"218\",\"name\":\"Save\\/Edit Employee Salary\",\"uid\":\"211\"},{\"id_application_action\":\"219\",\"action\":\"219\",\"name\":\"View Salary Setting\",\"uid\":\"212\"},{\"id_application_action\":\"220\",\"action\":\"220\",\"name\":\"Create Salary Setting\",\"uid\":\"213\"},{\"id_application_action\":\"221\",\"action\":\"221\",\"name\":\"Edit Salary Setting\",\"uid\":\"214\"},{\"id_application_action\":\"222\",\"action\":\"222\",\"name\":\"Delete Salary Setting\",\"uid\":\"215\"},{\"id_application_action\":\"223\",\"action\":\"223\",\"name\":\"Save\\/Edit Salary Setting\",\"uid\":\"216\"},{\"id_application_action\":\"224\",\"action\":\"224\",\"name\":\"View Database Interface\",\"uid\":\"217\"},{\"id_application_action\":\"225\",\"action\":\"225\",\"name\":\"Pick Assessment Template\",\"uid\":\"218\"},{\"id_application_action\":\"226\",\"action\":\"226\",\"name\":\"View Organisation Structure\",\"uid\":\"219\"},{\"id_application_action\":\"227\",\"action\":\"227\",\"name\":\"Create Organisation Structure\",\"uid\":\"220\"},{\"id_application_action\":\"228\",\"action\":\"228\",\"name\":\"Edit Organisation Structure\",\"uid\":\"221\"},{\"id_application_action\":\"229\",\"action\":\"229\",\"name\":\"Delete Organisation Structure\",\"uid\":\"222\"},{\"id_application_action\":\"230\",\"action\":\"230\",\"name\":\"Save\\/Edit Organisation Structure\",\"uid\":\"223\"},{\"id_application_action\":\"231\",\"action\":\"231\",\"name\":\"View Position Level\",\"uid\":\"224\"},{\"id_application_action\":\"232\",\"action\":\"232\",\"name\":\"Create Position Level\",\"uid\":\"225\"},{\"id_application_action\":\"233\",\"action\":\"233\",\"name\":\"Edit Position Level\",\"uid\":\"226\"},{\"id_application_action\":\"234\",\"action\":\"234\",\"name\":\"Delete Position Level\",\"uid\":\"227\"},{\"id_application_action\":\"235\",\"action\":\"235\",\"name\":\"Save\\/Edit Position Level\",\"uid\":\"228\"},{\"id_application_action\":\"236\",\"action\":\"236\",\"name\":\"View Employee Contract Type\",\"uid\":\"229\"},{\"id_application_action\":\"237\",\"action\":\"237\",\"name\":\"Create Employee Contract Type\",\"uid\":\"230\"},{\"id_application_action\":\"238\",\"action\":\"238\",\"name\":\"Edit Employee Contract Type\",\"uid\":\"231\"},{\"id_application_action\":\"239\",\"action\":\"239\",\"name\":\"Delete Employee Contract Type\",\"uid\":\"232\"},{\"id_application_action\":\"240\",\"action\":\"240\",\"name\":\"Save\\/Edit Employee Contract\",\"uid\":\"233\"},{\"id_application_action\":\"241\",\"action\":\"241\",\"name\":\"View Bank\",\"uid\":\"234\"},{\"id_application_action\":\"242\",\"action\":\"242\",\"name\":\"Create Bank\",\"uid\":\"235\"},{\"id_application_action\":\"243\",\"action\":\"243\",\"name\":\"Edit Bank\",\"uid\":\"236\"},{\"id_application_action\":\"244\",\"action\":\"244\",\"name\":\"Delete Bank\",\"uid\":\"237\"},{\"id_application_action\":\"245\",\"action\":\"245\",\"name\":\"Save\\/Edit Bank\",\"uid\":\"238\"},{\"id_application_action\":\"246\",\"action\":\"246\",\"name\":\"View Payment Receipt\",\"uid\":\"239\"},{\"id_application_action\":\"247\",\"action\":\"247\",\"name\":\"Create Payment Receipt\",\"uid\":\"240\"},{\"id_application_action\":\"248\",\"action\":\"248\",\"name\":\"Edit Payment Receipt\",\"uid\":\"241\"},{\"id_application_action\":\"249\",\"action\":\"249\",\"name\":\"Save\\/Edit Payment Receipt\",\"uid\":\"242\"},{\"id_application_action\":\"250\",\"action\":\"250\",\"name\":\"Delete Payment Receipt\",\"uid\":\"243\"},{\"id_application_action\":\"251\",\"action\":\"251\",\"name\":\"Receive Payment From PO\",\"uid\":\"244\"},{\"id_application_action\":\"252\",\"action\":\"252\",\"name\":\"Make Payment Receipt\",\"uid\":\"245\"},{\"id_application_action\":\"253\",\"action\":\"253\",\"name\":\"Cancel Payment Receipt\",\"uid\":\"246\"},{\"id_application_action\":\"254\",\"action\":\"254\",\"name\":\"View Stock Transaction\",\"uid\":\"247\"},{\"id_application_action\":\"255\",\"action\":\"255\",\"name\":\"Create Stock Transaction\",\"uid\":\"248\"},{\"id_application_action\":\"256\",\"action\":\"256\",\"name\":\"Edit Stock Transaction\",\"uid\":\"249\"},{\"id_application_action\":\"257\",\"action\":\"257\",\"name\":\"Delete Stock Transaction\",\"uid\":\"250\"},{\"id_application_action\":\"258\",\"action\":\"258\",\"name\":\"Save\\/Edit Stock Transaction\",\"uid\":\"251\"},{\"id_application_action\":\"259\",\"action\":\"259\",\"name\":\"Post Stock Transaction\",\"uid\":\"252\"},{\"id_application_action\":\"260\",\"action\":\"260\",\"name\":\"Unpost Stock Transaction\",\"uid\":\"253\"},{\"id_application_action\":\"261\",\"action\":\"261\",\"name\":\"Transfer Good Receive\",\"uid\":\"254\"},{\"id_application_action\":\"262\",\"action\":\"262\",\"name\":\"View Activity\",\"uid\":\"255\"},{\"id_application_action\":\"263\",\"name\":\"Make Working Schedule\",\"uid\":\"256\",\"id\":\"256\"}],\"is_edit\":\"true\",\"id_role\":\"1\"}', '2015-02-16 12:15:09');
INSERT INTO `activity_log` VALUES ('159', 'Save/Edit Role', 'role', null, '2', 'Save/Edit Role', '20', '{\"name\":\"administrator\",\"action_detail\":[{\"id_application_action\":\"1\",\"action\":\"1\",\"name\":\"View Application Action\",\"uid\":\"0\"},{\"id_application_action\":\"2\",\"action\":\"2\",\"name\":\"Create Application Action\",\"uid\":\"1\"},{\"id_application_action\":\"3\",\"action\":\"3\",\"name\":\"Edit Application Action\",\"uid\":\"2\"},{\"id_application_action\":\"4\",\"action\":\"4\",\"name\":\"Delete Application Action\",\"uid\":\"3\"},{\"id_application_action\":\"5\",\"action\":\"5\",\"name\":\"View Side Menu\",\"uid\":\"4\"},{\"id_application_action\":\"6\",\"action\":\"6\",\"name\":\"Create Side Menu\",\"uid\":\"5\"},{\"id_application_action\":\"7\",\"action\":\"7\",\"name\":\"Edit Side Menu\",\"uid\":\"6\"},{\"id_application_action\":\"8\",\"action\":\"8\",\"name\":\"Delete Side Menu\",\"uid\":\"7\"},{\"id_application_action\":\"9\",\"action\":\"9\",\"name\":\"Save\\/Edit Side Menu\",\"uid\":\"8\"},{\"id_application_action\":\"10\",\"action\":\"10\",\"name\":\"Save\\/Edit Action\",\"uid\":\"9\"},{\"id_application_action\":\"11\",\"action\":\"11\",\"name\":\"View Division\",\"uid\":\"10\"},{\"id_application_action\":\"12\",\"action\":\"12\",\"name\":\"Create Division\",\"uid\":\"11\"},{\"id_application_action\":\"13\",\"action\":\"13\",\"name\":\"Save\\/Edit Division\",\"uid\":\"12\"},{\"id_application_action\":\"14\",\"action\":\"14\",\"name\":\"Edit Division\",\"uid\":\"13\"},{\"id_application_action\":\"15\",\"action\":\"15\",\"name\":\"Delete Division\",\"uid\":\"14\"},{\"id_application_action\":\"16\",\"action\":\"16\",\"name\":\"View Role\",\"uid\":\"15\"},{\"id_application_action\":\"17\",\"action\":\"17\",\"name\":\"View Create Role\",\"uid\":\"16\"},{\"id_application_action\":\"18\",\"action\":\"18\",\"name\":\"View Edit Role\",\"uid\":\"17\"},{\"id_application_action\":\"19\",\"action\":\"19\",\"name\":\"Delete Role\",\"uid\":\"18\"},{\"id_application_action\":\"20\",\"action\":\"20\",\"name\":\"Save\\/Edit Role\",\"uid\":\"19\"},{\"id_application_action\":\"21\",\"action\":\"21\",\"name\":\"View Product\",\"uid\":\"20\"},{\"id_application_action\":\"22\",\"action\":\"22\",\"name\":\"Create Product\",\"uid\":\"21\"},{\"id_application_action\":\"23\",\"action\":\"23\",\"name\":\"Edit Product\",\"uid\":\"22\"},{\"id_application_action\":\"24\",\"action\":\"24\",\"name\":\"Delete Product\",\"uid\":\"23\"},{\"id_application_action\":\"25\",\"action\":\"25\",\"name\":\"Save\\/Edit Product\",\"uid\":\"24\"},{\"id_application_action\":\"26\",\"action\":\"26\",\"name\":\"View Supplier\",\"uid\":\"25\"},{\"id_application_action\":\"27\",\"action\":\"27\",\"name\":\"Create Supplier\",\"uid\":\"26\"},{\"id_application_action\":\"28\",\"action\":\"28\",\"name\":\"Edit Supplier\",\"uid\":\"27\"},{\"id_application_action\":\"29\",\"action\":\"29\",\"name\":\"Delete Supplier\",\"uid\":\"28\"},{\"id_application_action\":\"30\",\"action\":\"30\",\"name\":\"Save\\/Edit Supplier\",\"uid\":\"29\"},{\"id_application_action\":\"31\",\"action\":\"31\",\"name\":\"View Product Category\",\"uid\":\"30\"},{\"id_application_action\":\"32\",\"action\":\"32\",\"name\":\"Create Product Category\",\"uid\":\"31\"},{\"id_application_action\":\"33\",\"action\":\"33\",\"name\":\"Edit Product Category\",\"uid\":\"32\"},{\"id_application_action\":\"34\",\"action\":\"34\",\"name\":\"Delete Product Category\",\"uid\":\"33\"},{\"id_application_action\":\"35\",\"action\":\"35\",\"name\":\"Save\\/Edit Product Category\",\"uid\":\"34\"},{\"id_application_action\":\"36\",\"action\":\"36\",\"name\":\"View Merk\",\"uid\":\"35\"},{\"id_application_action\":\"37\",\"action\":\"37\",\"name\":\"Create Merk\",\"uid\":\"36\"},{\"id_application_action\":\"38\",\"action\":\"38\",\"name\":\"Edit Merk\",\"uid\":\"37\"},{\"id_application_action\":\"39\",\"action\":\"39\",\"name\":\"Delete Merk\",\"uid\":\"38\"},{\"id_application_action\":\"40\",\"action\":\"40\",\"name\":\"Save\\/Edit Merk\",\"uid\":\"39\"},{\"id_application_action\":\"41\",\"action\":\"41\",\"name\":\"View Customer\",\"uid\":\"40\"},{\"id_application_action\":\"43\",\"action\":\"43\",\"name\":\"Create Customer\",\"uid\":\"41\"},{\"id_application_action\":\"44\",\"action\":\"44\",\"name\":\"Edit Customer\",\"uid\":\"42\"},{\"id_application_action\":\"45\",\"action\":\"45\",\"name\":\"Delete Customer\",\"uid\":\"43\"},{\"id_application_action\":\"46\",\"action\":\"46\",\"name\":\"Save\\/Edit Customer\",\"uid\":\"44\"},{\"id_application_action\":\"47\",\"action\":\"47\",\"name\":\"View Warehouse\",\"uid\":\"45\"},{\"id_application_action\":\"48\",\"action\":\"48\",\"name\":\"Create Warehouse\",\"uid\":\"46\"},{\"id_application_action\":\"49\",\"action\":\"49\",\"name\":\"Edit Warehouse\",\"uid\":\"47\"},{\"id_application_action\":\"50\",\"action\":\"50\",\"name\":\"Delete Warehouse\",\"uid\":\"48\"},{\"id_application_action\":\"51\",\"action\":\"51\",\"name\":\"Save\\/Edit Warehouse\",\"uid\":\"49\"},{\"id_application_action\":\"57\",\"action\":\"57\",\"name\":\"View PO\",\"uid\":\"50\"},{\"id_application_action\":\"58\",\"action\":\"58\",\"name\":\"Create PO\",\"uid\":\"51\"},{\"id_application_action\":\"59\",\"action\":\"59\",\"name\":\"Edit PO\",\"uid\":\"52\"},{\"id_application_action\":\"60\",\"action\":\"60\",\"name\":\"Delete PO\",\"uid\":\"53\"},{\"id_application_action\":\"61\",\"action\":\"61\",\"name\":\"Save\\/Edit PO\",\"uid\":\"54\"},{\"id_application_action\":\"62\",\"action\":\"62\",\"name\":\"View User\",\"uid\":\"55\"},{\"id_application_action\":\"63\",\"action\":\"63\",\"name\":\"Create User\",\"uid\":\"56\"},{\"id_application_action\":\"64\",\"action\":\"64\",\"name\":\"Edit User\",\"uid\":\"57\"},{\"id_application_action\":\"65\",\"action\":\"65\",\"name\":\"Delete User\",\"uid\":\"58\"},{\"id_application_action\":\"66\",\"action\":\"66\",\"name\":\"Save\\/Edit User\",\"uid\":\"59\"},{\"id_application_action\":\"67\",\"action\":\"67\",\"name\":\"View Good Receive\",\"uid\":\"60\"},{\"id_application_action\":\"68\",\"action\":\"68\",\"name\":\"Create Good Receive\",\"uid\":\"61\"},{\"id_application_action\":\"69\",\"action\":\"69\",\"name\":\"Edit Good Receive\",\"uid\":\"62\"},{\"id_application_action\":\"70\",\"action\":\"70\",\"name\":\"Delete Good Receive\",\"uid\":\"63\"},{\"id_application_action\":\"71\",\"action\":\"71\",\"name\":\"Save\\/Edit Good Receive\",\"uid\":\"64\"},{\"id_application_action\":\"72\",\"action\":\"72\",\"name\":\"View Sales Order\",\"uid\":\"65\"},{\"id_application_action\":\"73\",\"action\":\"73\",\"name\":\"Create Sales Order\",\"uid\":\"66\"},{\"id_application_action\":\"74\",\"action\":\"74\",\"name\":\"Edit Sales Order\",\"uid\":\"67\"},{\"id_application_action\":\"75\",\"action\":\"75\",\"name\":\"Delete Sales Order\",\"uid\":\"68\"},{\"id_application_action\":\"76\",\"action\":\"76\",\"name\":\"Save Sales Order\",\"uid\":\"69\"},{\"id_application_action\":\"77\",\"action\":\"77\",\"name\":\"View Material Request\",\"uid\":\"70\"},{\"id_application_action\":\"78\",\"action\":\"78\",\"name\":\"Create Material Request\",\"uid\":\"71\"},{\"id_application_action\":\"79\",\"action\":\"79\",\"name\":\"Edit Material Request\",\"uid\":\"72\"},{\"id_application_action\":\"80\",\"action\":\"80\",\"name\":\"Delete Material Request\",\"uid\":\"73\"},{\"id_application_action\":\"81\",\"action\":\"81\",\"name\":\"Save Material Request\",\"uid\":\"74\"},{\"id_application_action\":\"82\",\"action\":\"82\",\"name\":\"Change User Password\",\"uid\":\"75\"},{\"id_application_action\":\"83\",\"action\":\"83\",\"name\":\"View Delivery Note\",\"uid\":\"76\"},{\"id_application_action\":\"84\",\"action\":\"84\",\"name\":\"Create Delivery Note\",\"uid\":\"77\"},{\"id_application_action\":\"85\",\"action\":\"85\",\"name\":\"Edit Delivery Note\",\"uid\":\"78\"},{\"id_application_action\":\"86\",\"action\":\"86\",\"name\":\"Delete Delivery Note\",\"uid\":\"79\"},{\"id_application_action\":\"87\",\"action\":\"87\",\"name\":\"Save\\/Edit Delivery Note\",\"uid\":\"80\"},{\"id_application_action\":\"88\",\"action\":\"88\",\"name\":\"View Unit Measure\",\"uid\":\"81\"},{\"id_application_action\":\"89\",\"action\":\"89\",\"name\":\"Create Unit Measure\",\"uid\":\"82\"},{\"id_application_action\":\"90\",\"action\":\"90\",\"name\":\"Edit Unit Measure\",\"uid\":\"83\"},{\"id_application_action\":\"91\",\"action\":\"91\",\"name\":\"Delete Unit Measure\",\"uid\":\"84\"},{\"id_application_action\":\"92\",\"action\":\"92\",\"name\":\"Save\\/Edit Unit Measure\",\"uid\":\"85\"},{\"id_application_action\":\"93\",\"action\":\"93\",\"name\":\"View Stock\",\"uid\":\"86\"},{\"id_application_action\":\"94\",\"action\":\"94\",\"name\":\"View Employee\",\"uid\":\"87\"},{\"id_application_action\":\"95\",\"action\":\"95\",\"name\":\"Create Employee\",\"uid\":\"88\"},{\"id_application_action\":\"96\",\"action\":\"96\",\"name\":\"Edit Employee\",\"uid\":\"89\"},{\"id_application_action\":\"97\",\"action\":\"97\",\"name\":\"Delete Employee\",\"uid\":\"90\"},{\"id_application_action\":\"98\",\"action\":\"98\",\"name\":\"Save\\/Edit Employee\",\"uid\":\"91\"},{\"id_application_action\":\"99\",\"action\":\"99\",\"name\":\"Validate PO\",\"uid\":\"92\"},{\"id_application_action\":\"100\",\"action\":\"100\",\"name\":\"Create Database Interface\",\"uid\":\"93\"},{\"id_application_action\":\"101\",\"action\":\"101\",\"name\":\"Edit Database Interface\",\"uid\":\"94\"},{\"id_application_action\":\"102\",\"action\":\"102\",\"name\":\"Delete Database Interface\",\"uid\":\"95\"},{\"id_application_action\":\"103\",\"action\":\"103\",\"name\":\"Save \\/ Edit Database Interface\",\"uid\":\"96\"},{\"id_application_action\":\"104\",\"action\":\"104\",\"name\":\"View Database Field Interface\",\"uid\":\"97\"},{\"id_application_action\":\"105\",\"action\":\"105\",\"name\":\"Create Database Field Interface\",\"uid\":\"98\"},{\"id_application_action\":\"106\",\"action\":\"106\",\"name\":\"Edit Database Field Interface\",\"uid\":\"99\"},{\"id_application_action\":\"107\",\"action\":\"107\",\"name\":\"Delete Database Field Interface\",\"uid\":\"100\"},{\"id_application_action\":\"108\",\"action\":\"108\",\"name\":\"Save \\/ Edit Database Field Interface\",\"uid\":\"101\"},{\"id_application_action\":\"109\",\"action\":\"109\",\"name\":\"View Inquiry\",\"uid\":\"102\"},{\"id_application_action\":\"110\",\"action\":\"110\",\"name\":\"Create Inquiry\",\"uid\":\"103\"},{\"id_application_action\":\"111\",\"action\":\"111\",\"name\":\"Edit Inquiry\",\"uid\":\"104\"},{\"id_application_action\":\"112\",\"action\":\"112\",\"name\":\"Delete Inquiry\",\"uid\":\"105\"},{\"id_application_action\":\"113\",\"action\":\"113\",\"name\":\"Save\\/Edit Inquiry\",\"uid\":\"106\"},{\"id_application_action\":\"114\",\"action\":\"114\",\"name\":\"View Survey \\/ Assessment\",\"uid\":\"107\"},{\"id_application_action\":\"115\",\"action\":\"115\",\"name\":\"Create Survey \\/ Assessment\",\"uid\":\"108\"},{\"id_application_action\":\"116\",\"action\":\"116\",\"name\":\"Edit Survey \\/ Assessment\",\"uid\":\"109\"},{\"id_application_action\":\"117\",\"action\":\"117\",\"name\":\"Delete Survey \\/ Assessment\",\"uid\":\"110\"},{\"id_application_action\":\"118\",\"action\":\"118\",\"name\":\"Save\\/Edit Survey \\/ Assessment\",\"uid\":\"111\"},{\"id_application_action\":\"119\",\"action\":\"119\",\"name\":\"View Quotation\",\"uid\":\"112\"},{\"id_application_action\":\"120\",\"action\":\"120\",\"name\":\"Create Quotation\",\"uid\":\"113\"},{\"id_application_action\":\"121\",\"action\":\"121\",\"name\":\"Edit Quotation\",\"uid\":\"114\"},{\"id_application_action\":\"122\",\"action\":\"122\",\"name\":\"Delete Quotation\",\"uid\":\"115\"},{\"id_application_action\":\"123\",\"action\":\"123\",\"name\":\"Save\\/Edit Quotation\",\"uid\":\"116\"},{\"id_application_action\":\"124\",\"action\":\"124\",\"name\":\"View Project Contract\",\"uid\":\"117\"},{\"id_application_action\":\"125\",\"action\":\"125\",\"name\":\"Create Project Contract\",\"uid\":\"118\"},{\"id_application_action\":\"126\",\"action\":\"126\",\"name\":\"Edit Project Contract\",\"uid\":\"119\"},{\"id_application_action\":\"127\",\"action\":\"127\",\"name\":\"Delete Project Contract\",\"uid\":\"120\"},{\"id_application_action\":\"128\",\"action\":\"128\",\"name\":\"Save\\/Edit Project Contract\",\"uid\":\"121\"},{\"id_application_action\":\"129\",\"action\":\"129\",\"name\":\"View Work Order\",\"uid\":\"122\"},{\"id_application_action\":\"130\",\"action\":\"130\",\"name\":\"Create Work Order\",\"uid\":\"123\"},{\"id_application_action\":\"131\",\"action\":\"131\",\"name\":\"Edit Work Order\",\"uid\":\"124\"},{\"id_application_action\":\"132\",\"action\":\"132\",\"name\":\"Delete Work Order\",\"uid\":\"125\"},{\"id_application_action\":\"133\",\"action\":\"133\",\"name\":\"Save\\/Edit Work Order\",\"uid\":\"126\"},{\"id_application_action\":\"134\",\"action\":\"134\",\"name\":\"View Assessment Template\",\"uid\":\"127\"},{\"id_application_action\":\"135\",\"action\":\"135\",\"name\":\"Create Assessment Template\",\"uid\":\"128\"},{\"id_application_action\":\"136\",\"action\":\"136\",\"name\":\"Edit Assessment Template\",\"uid\":\"129\"},{\"id_application_action\":\"137\",\"action\":\"137\",\"name\":\"Delete Assessment Template\",\"uid\":\"130\"},{\"id_application_action\":\"138\",\"action\":\"138\",\"name\":\"Save\\/Edit Assessment Template\",\"uid\":\"131\"},{\"id_application_action\":\"139\",\"action\":\"139\",\"name\":\"View Contract Template\",\"uid\":\"132\"},{\"id_application_action\":\"140\",\"action\":\"140\",\"name\":\"Create Contract Template\",\"uid\":\"133\"},{\"id_application_action\":\"141\",\"action\":\"141\",\"name\":\"Edit Contract Template\",\"uid\":\"134\"},{\"id_application_action\":\"142\",\"action\":\"142\",\"name\":\"Delete Contract Template\",\"uid\":\"135\"},{\"id_application_action\":\"143\",\"action\":\"143\",\"name\":\"Save\\/Edit Contract Template\",\"uid\":\"136\"},{\"id_application_action\":\"144\",\"action\":\"144\",\"name\":\"View Work Schedule\",\"uid\":\"137\"},{\"id_application_action\":\"145\",\"action\":\"145\",\"name\":\"Create Work Schedule\",\"uid\":\"138\"},{\"id_application_action\":\"146\",\"action\":\"146\",\"name\":\"Edit Work Schedule\",\"uid\":\"139\"},{\"id_application_action\":\"147\",\"action\":\"147\",\"name\":\"Delete Work Schedule\",\"uid\":\"140\"},{\"id_application_action\":\"148\",\"action\":\"148\",\"name\":\"Save\\/Edit Work Schedule\",\"uid\":\"141\"},{\"id_application_action\":\"149\",\"action\":\"149\",\"name\":\"View SO Assignment\",\"uid\":\"142\"},{\"id_application_action\":\"150\",\"action\":\"150\",\"name\":\"Create SO Assignment\",\"uid\":\"143\"},{\"id_application_action\":\"151\",\"action\":\"151\",\"name\":\"Edit SO Assignment\",\"uid\":\"144\"},{\"id_application_action\":\"152\",\"action\":\"152\",\"name\":\"Delete SO Assignment\",\"uid\":\"145\"},{\"id_application_action\":\"153\",\"action\":\"153\",\"name\":\"Save\\/Edit SO Assignment\",\"uid\":\"146\"},{\"id_application_action\":\"154\",\"action\":\"154\",\"name\":\"View Shift Change\",\"uid\":\"147\"},{\"id_application_action\":\"155\",\"action\":\"155\",\"name\":\"Create Shift Change\",\"uid\":\"148\"},{\"id_application_action\":\"156\",\"action\":\"156\",\"name\":\"Edit Shift Change\",\"uid\":\"149\"},{\"id_application_action\":\"157\",\"action\":\"157\",\"name\":\"Delete Shift Change\",\"uid\":\"150\"},{\"id_application_action\":\"158\",\"action\":\"158\",\"name\":\"Save\\/Edit Shift Change\",\"uid\":\"151\"},{\"id_application_action\":\"159\",\"action\":\"159\",\"name\":\"View Leave Application\",\"uid\":\"152\"},{\"id_application_action\":\"160\",\"action\":\"160\",\"name\":\"Create Leave Application\",\"uid\":\"153\"},{\"id_application_action\":\"161\",\"action\":\"161\",\"name\":\"Edit Leave Application\",\"uid\":\"154\"},{\"id_application_action\":\"162\",\"action\":\"162\",\"name\":\"Delete Leave Application\",\"uid\":\"155\"},{\"id_application_action\":\"163\",\"action\":\"163\",\"name\":\"Save\\/Edit Leave Application\",\"uid\":\"156\"},{\"id_application_action\":\"164\",\"action\":\"164\",\"name\":\"View Timesheet (Recap)\",\"uid\":\"157\"},{\"id_application_action\":\"165\",\"action\":\"165\",\"name\":\"Create Timesheet (Recap)\",\"uid\":\"158\"},{\"id_application_action\":\"166\",\"action\":\"166\",\"name\":\"Edit Timesheet (Recap)\",\"uid\":\"159\"},{\"id_application_action\":\"167\",\"action\":\"167\",\"name\":\"Delete Timesheet (Recap)\",\"uid\":\"160\"},{\"id_application_action\":\"168\",\"action\":\"168\",\"name\":\"Save\\/Edit Timesheet (Recap)\",\"uid\":\"161\"},{\"id_application_action\":\"169\",\"action\":\"169\",\"name\":\"View SO Timesheet\",\"uid\":\"162\"},{\"id_application_action\":\"170\",\"action\":\"170\",\"name\":\"Create SO Timesheet\",\"uid\":\"163\"},{\"id_application_action\":\"171\",\"action\":\"171\",\"name\":\"Edit SO Timesheet\",\"uid\":\"164\"},{\"id_application_action\":\"172\",\"action\":\"172\",\"name\":\"Delete SO Timesheet\",\"uid\":\"165\"},{\"id_application_action\":\"173\",\"action\":\"173\",\"name\":\"Save\\/Edit SO Timesheet\",\"uid\":\"166\"},{\"id_application_action\":\"174\",\"action\":\"174\",\"name\":\"View Incident Report\",\"uid\":\"167\"},{\"id_application_action\":\"175\",\"action\":\"175\",\"name\":\"Create Incident Report\",\"uid\":\"168\"},{\"id_application_action\":\"176\",\"action\":\"176\",\"name\":\"Edit Incident Report\",\"uid\":\"169\"},{\"id_application_action\":\"177\",\"action\":\"177\",\"name\":\"Delete Incident Report\",\"uid\":\"170\"},{\"id_application_action\":\"178\",\"action\":\"178\",\"name\":\"Save\\/Edit Incident Report\",\"uid\":\"171\"},{\"id_application_action\":\"179\",\"action\":\"179\",\"name\":\"View Payroll\",\"uid\":\"172\"},{\"id_application_action\":\"180\",\"action\":\"180\",\"name\":\"Create Payroll\",\"uid\":\"173\"},{\"id_application_action\":\"181\",\"action\":\"181\",\"name\":\"Edit Payroll\",\"uid\":\"174\"},{\"id_application_action\":\"182\",\"action\":\"182\",\"name\":\"Delete Payroll\",\"uid\":\"175\"},{\"id_application_action\":\"183\",\"action\":\"183\",\"name\":\"Save\\/Edit Payroll\",\"uid\":\"176\"},{\"id_application_action\":\"184\",\"action\":\"184\",\"name\":\"View Supplier Invoice\",\"uid\":\"177\"},{\"id_application_action\":\"185\",\"action\":\"185\",\"name\":\"Create Supplier Invoice\",\"uid\":\"178\"},{\"id_application_action\":\"186\",\"action\":\"186\",\"name\":\"Edit Supplier Invoice\",\"uid\":\"179\"},{\"id_application_action\":\"187\",\"action\":\"187\",\"name\":\"Delete Supplier Invoice\",\"uid\":\"180\"},{\"id_application_action\":\"188\",\"action\":\"188\",\"name\":\"Save\\/Edit Supplier Invoice\",\"uid\":\"181\"},{\"id_application_action\":\"189\",\"action\":\"189\",\"name\":\"View Customer Invoice\",\"uid\":\"182\"},{\"id_application_action\":\"190\",\"action\":\"190\",\"name\":\"Create Customer Invoice\",\"uid\":\"183\"},{\"id_application_action\":\"191\",\"action\":\"191\",\"name\":\"Edit Customer Invoice\",\"uid\":\"184\"},{\"id_application_action\":\"192\",\"action\":\"192\",\"name\":\"Delete Customer Invoice\",\"uid\":\"185\"},{\"id_application_action\":\"193\",\"action\":\"193\",\"name\":\"Save\\/Edit Customer Invoice\",\"uid\":\"186\"},{\"id_application_action\":\"194\",\"action\":\"194\",\"name\":\"View Bank Statement\",\"uid\":\"187\"},{\"id_application_action\":\"195\",\"action\":\"195\",\"name\":\"Create Bank Statement\",\"uid\":\"188\"},{\"id_application_action\":\"196\",\"action\":\"196\",\"name\":\"Edit Bank Statement\",\"uid\":\"189\"},{\"id_application_action\":\"197\",\"action\":\"197\",\"name\":\"Delete Bank Statement\",\"uid\":\"190\"},{\"id_application_action\":\"198\",\"action\":\"198\",\"name\":\"Save\\/Edit Bank Statement\",\"uid\":\"191\"},{\"id_application_action\":\"199\",\"action\":\"199\",\"name\":\"View Cash Register\",\"uid\":\"192\"},{\"id_application_action\":\"200\",\"action\":\"200\",\"name\":\"Create Cash Register\",\"uid\":\"193\"},{\"id_application_action\":\"201\",\"action\":\"201\",\"name\":\"Edit Cash Register\",\"uid\":\"194\"},{\"id_application_action\":\"202\",\"action\":\"202\",\"name\":\"Delete Cash Register\",\"uid\":\"195\"},{\"id_application_action\":\"203\",\"action\":\"203\",\"name\":\"Save\\/Edit Cash Register\",\"uid\":\"196\"},{\"id_application_action\":\"204\",\"action\":\"204\",\"name\":\"View Tax\",\"uid\":\"197\"},{\"id_application_action\":\"205\",\"action\":\"205\",\"name\":\"Create Tax\",\"uid\":\"198\"},{\"id_application_action\":\"206\",\"action\":\"206\",\"name\":\"Edit Tax\",\"uid\":\"199\"},{\"id_application_action\":\"207\",\"action\":\"207\",\"name\":\"Delete Tax\",\"uid\":\"200\"},{\"id_application_action\":\"208\",\"action\":\"208\",\"name\":\"Save\\/Edit Tax\",\"uid\":\"201\"},{\"id_application_action\":\"209\",\"action\":\"209\",\"name\":\"View Chart of Account\",\"uid\":\"202\"},{\"id_application_action\":\"210\",\"action\":\"210\",\"name\":\"Create Chart of Account\",\"uid\":\"203\"},{\"id_application_action\":\"211\",\"action\":\"211\",\"name\":\"Edit Chart of Account\",\"uid\":\"204\"},{\"id_application_action\":\"212\",\"action\":\"212\",\"name\":\"Delete Chart of Account\",\"uid\":\"205\"},{\"id_application_action\":\"213\",\"action\":\"213\",\"name\":\"Save\\/Edit Chart of Account\",\"uid\":\"206\"},{\"id_application_action\":\"214\",\"action\":\"214\",\"name\":\"View Employee Salary\",\"uid\":\"207\"},{\"id_application_action\":\"215\",\"action\":\"215\",\"name\":\"Create Employee Salary\",\"uid\":\"208\"},{\"id_application_action\":\"216\",\"action\":\"216\",\"name\":\"Edit Employee Salary\",\"uid\":\"209\"},{\"id_application_action\":\"217\",\"action\":\"217\",\"name\":\"Delete Employee Salary\",\"uid\":\"210\"},{\"id_application_action\":\"218\",\"action\":\"218\",\"name\":\"Save\\/Edit Employee Salary\",\"uid\":\"211\"},{\"id_application_action\":\"219\",\"action\":\"219\",\"name\":\"View Salary Setting\",\"uid\":\"212\"},{\"id_application_action\":\"220\",\"action\":\"220\",\"name\":\"Create Salary Setting\",\"uid\":\"213\"},{\"id_application_action\":\"221\",\"action\":\"221\",\"name\":\"Edit Salary Setting\",\"uid\":\"214\"},{\"id_application_action\":\"222\",\"action\":\"222\",\"name\":\"Delete Salary Setting\",\"uid\":\"215\"},{\"id_application_action\":\"223\",\"action\":\"223\",\"name\":\"Save\\/Edit Salary Setting\",\"uid\":\"216\"},{\"id_application_action\":\"224\",\"action\":\"224\",\"name\":\"View Database Interface\",\"uid\":\"217\"},{\"id_application_action\":\"225\",\"action\":\"225\",\"name\":\"Pick Assessment Template\",\"uid\":\"218\"},{\"id_application_action\":\"226\",\"action\":\"226\",\"name\":\"View Organisation Structure\",\"uid\":\"219\"},{\"id_application_action\":\"227\",\"action\":\"227\",\"name\":\"Create Organisation Structure\",\"uid\":\"220\"},{\"id_application_action\":\"228\",\"action\":\"228\",\"name\":\"Edit Organisation Structure\",\"uid\":\"221\"},{\"id_application_action\":\"229\",\"action\":\"229\",\"name\":\"Delete Organisation Structure\",\"uid\":\"222\"},{\"id_application_action\":\"230\",\"action\":\"230\",\"name\":\"Save\\/Edit Organisation Structure\",\"uid\":\"223\"},{\"id_application_action\":\"231\",\"action\":\"231\",\"name\":\"View Position Level\",\"uid\":\"224\"},{\"id_application_action\":\"232\",\"action\":\"232\",\"name\":\"Create Position Level\",\"uid\":\"225\"},{\"id_application_action\":\"233\",\"action\":\"233\",\"name\":\"Edit Position Level\",\"uid\":\"226\"},{\"id_application_action\":\"234\",\"action\":\"234\",\"name\":\"Delete Position Level\",\"uid\":\"227\"},{\"id_application_action\":\"235\",\"action\":\"235\",\"name\":\"Save\\/Edit Position Level\",\"uid\":\"228\"},{\"id_application_action\":\"236\",\"action\":\"236\",\"name\":\"View Employee Contract Type\",\"uid\":\"229\"},{\"id_application_action\":\"237\",\"action\":\"237\",\"name\":\"Create Employee Contract Type\",\"uid\":\"230\"},{\"id_application_action\":\"238\",\"action\":\"238\",\"name\":\"Edit Employee Contract Type\",\"uid\":\"231\"},{\"id_application_action\":\"239\",\"action\":\"239\",\"name\":\"Delete Employee Contract Type\",\"uid\":\"232\"},{\"id_application_action\":\"240\",\"action\":\"240\",\"name\":\"Save\\/Edit Employee Contract\",\"uid\":\"233\"},{\"id_application_action\":\"241\",\"action\":\"241\",\"name\":\"View Bank\",\"uid\":\"234\"},{\"id_application_action\":\"242\",\"action\":\"242\",\"name\":\"Create Bank\",\"uid\":\"235\"},{\"id_application_action\":\"243\",\"action\":\"243\",\"name\":\"Edit Bank\",\"uid\":\"236\"},{\"id_application_action\":\"244\",\"action\":\"244\",\"name\":\"Delete Bank\",\"uid\":\"237\"},{\"id_application_action\":\"245\",\"action\":\"245\",\"name\":\"Save\\/Edit Bank\",\"uid\":\"238\"},{\"id_application_action\":\"246\",\"action\":\"246\",\"name\":\"View Payment Receipt\",\"uid\":\"239\"},{\"id_application_action\":\"247\",\"action\":\"247\",\"name\":\"Create Payment Receipt\",\"uid\":\"240\"},{\"id_application_action\":\"248\",\"action\":\"248\",\"name\":\"Edit Payment Receipt\",\"uid\":\"241\"},{\"id_application_action\":\"249\",\"action\":\"249\",\"name\":\"Save\\/Edit Payment Receipt\",\"uid\":\"242\"},{\"id_application_action\":\"250\",\"action\":\"250\",\"name\":\"Delete Payment Receipt\",\"uid\":\"243\"},{\"id_application_action\":\"251\",\"action\":\"251\",\"name\":\"Receive Payment From PO\",\"uid\":\"244\"},{\"id_application_action\":\"252\",\"action\":\"252\",\"name\":\"Make Payment Receipt\",\"uid\":\"245\"},{\"id_application_action\":\"253\",\"action\":\"253\",\"name\":\"Cancel Payment Receipt\",\"uid\":\"246\"},{\"id_application_action\":\"254\",\"action\":\"254\",\"name\":\"View Stock Transaction\",\"uid\":\"247\"},{\"id_application_action\":\"255\",\"action\":\"255\",\"name\":\"Create Stock Transaction\",\"uid\":\"248\"},{\"id_application_action\":\"256\",\"action\":\"256\",\"name\":\"Edit Stock Transaction\",\"uid\":\"249\"},{\"id_application_action\":\"257\",\"action\":\"257\",\"name\":\"Delete Stock Transaction\",\"uid\":\"250\"},{\"id_application_action\":\"258\",\"action\":\"258\",\"name\":\"Save\\/Edit Stock Transaction\",\"uid\":\"251\"},{\"id_application_action\":\"259\",\"action\":\"259\",\"name\":\"Post Stock Transaction\",\"uid\":\"252\"},{\"id_application_action\":\"260\",\"action\":\"260\",\"name\":\"Unpost Stock Transaction\",\"uid\":\"253\"},{\"id_application_action\":\"261\",\"action\":\"261\",\"name\":\"Transfer Good Receive\",\"uid\":\"254\"},{\"id_application_action\":\"262\",\"action\":\"262\",\"name\":\"View Activity\",\"uid\":\"255\"},{\"id_application_action\":\"263\",\"action\":\"263\",\"name\":\"Make Working Schedule\",\"uid\":\"256\"},{\"id_application_action\":\"264\",\"name\":\"Validate Inquiry\",\"uid\":\"257\",\"id\":\"257\"}],\"is_edit\":\"true\",\"id_role\":\"1\"}', '2015-02-17 19:16:03');
INSERT INTO `activity_log` VALUES ('160', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"Save\\/Edit Inquiry\",\"controller\":\"inquiry\",\"function_exec\":\"save_inquiry\",\"function_args\":\"\",\"view_type\":\"no_view\",\"view_file\":\"\",\"prefix\":\"\",\"action_type\":\"create\",\"action_button\":\"crud\",\"target_action\":\"109\",\"action_condition\":[{\"identifier\":\"validate\",\"target_action\":\"264\",\"target_action_name\":\"Validate Inquiry\",\"uid\":\"0\"}],\"use_log\":\"1\",\"is_edit\":\"true\",\"id_edit\":\"113\"}', '2015-02-17 19:16:28');
INSERT INTO `activity_log` VALUES ('161', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"Save\\/Edit Quotation\",\"controller\":\"quotation\",\"function_exec\":\"save_quotation\",\"function_args\":\"\",\"view_type\":\"no_view\",\"view_file\":\"\",\"prefix\":\"\",\"action_type\":\"create\",\"action_button\":\"crud\",\"target_action\":\"119\",\"action_condition\":[{\"identifier\":\"validate\",\"target_action\":\"265\",\"target_action_name\":\"Validate Quotation\",\"uid\":\"0\"}],\"use_log\":\"1\",\"is_edit\":\"true\",\"id_edit\":\"123\"}', '2015-02-19 18:10:12');
INSERT INTO `activity_log` VALUES ('162', 'Save/Edit Role', 'role', null, '2', 'Save/Edit Role', '20', '{\"name\":\"administrator\",\"action_detail\":[{\"id_application_action\":\"1\",\"action\":\"1\",\"name\":\"View Application Action\",\"uid\":\"0\"},{\"id_application_action\":\"2\",\"action\":\"2\",\"name\":\"Create Application Action\",\"uid\":\"1\"},{\"id_application_action\":\"3\",\"action\":\"3\",\"name\":\"Edit Application Action\",\"uid\":\"2\"},{\"id_application_action\":\"4\",\"action\":\"4\",\"name\":\"Delete Application Action\",\"uid\":\"3\"},{\"id_application_action\":\"5\",\"action\":\"5\",\"name\":\"View Side Menu\",\"uid\":\"4\"},{\"id_application_action\":\"6\",\"action\":\"6\",\"name\":\"Create Side Menu\",\"uid\":\"5\"},{\"id_application_action\":\"7\",\"action\":\"7\",\"name\":\"Edit Side Menu\",\"uid\":\"6\"},{\"id_application_action\":\"8\",\"action\":\"8\",\"name\":\"Delete Side Menu\",\"uid\":\"7\"},{\"id_application_action\":\"9\",\"action\":\"9\",\"name\":\"Save\\/Edit Side Menu\",\"uid\":\"8\"},{\"id_application_action\":\"10\",\"action\":\"10\",\"name\":\"Save\\/Edit Action\",\"uid\":\"9\"},{\"id_application_action\":\"11\",\"action\":\"11\",\"name\":\"View Division\",\"uid\":\"10\"},{\"id_application_action\":\"12\",\"action\":\"12\",\"name\":\"Create Division\",\"uid\":\"11\"},{\"id_application_action\":\"13\",\"action\":\"13\",\"name\":\"Save\\/Edit Division\",\"uid\":\"12\"},{\"id_application_action\":\"14\",\"action\":\"14\",\"name\":\"Edit Division\",\"uid\":\"13\"},{\"id_application_action\":\"15\",\"action\":\"15\",\"name\":\"Delete Division\",\"uid\":\"14\"},{\"id_application_action\":\"16\",\"action\":\"16\",\"name\":\"View Role\",\"uid\":\"15\"},{\"id_application_action\":\"17\",\"action\":\"17\",\"name\":\"View Create Role\",\"uid\":\"16\"},{\"id_application_action\":\"18\",\"action\":\"18\",\"name\":\"View Edit Role\",\"uid\":\"17\"},{\"id_application_action\":\"19\",\"action\":\"19\",\"name\":\"Delete Role\",\"uid\":\"18\"},{\"id_application_action\":\"20\",\"action\":\"20\",\"name\":\"Save\\/Edit Role\",\"uid\":\"19\"},{\"id_application_action\":\"21\",\"action\":\"21\",\"name\":\"View Product\",\"uid\":\"20\"},{\"id_application_action\":\"22\",\"action\":\"22\",\"name\":\"Create Product\",\"uid\":\"21\"},{\"id_application_action\":\"23\",\"action\":\"23\",\"name\":\"Edit Product\",\"uid\":\"22\"},{\"id_application_action\":\"24\",\"action\":\"24\",\"name\":\"Delete Product\",\"uid\":\"23\"},{\"id_application_action\":\"25\",\"action\":\"25\",\"name\":\"Save\\/Edit Product\",\"uid\":\"24\"},{\"id_application_action\":\"26\",\"action\":\"26\",\"name\":\"View Supplier\",\"uid\":\"25\"},{\"id_application_action\":\"27\",\"action\":\"27\",\"name\":\"Create Supplier\",\"uid\":\"26\"},{\"id_application_action\":\"28\",\"action\":\"28\",\"name\":\"Edit Supplier\",\"uid\":\"27\"},{\"id_application_action\":\"29\",\"action\":\"29\",\"name\":\"Delete Supplier\",\"uid\":\"28\"},{\"id_application_action\":\"30\",\"action\":\"30\",\"name\":\"Save\\/Edit Supplier\",\"uid\":\"29\"},{\"id_application_action\":\"31\",\"action\":\"31\",\"name\":\"View Product Category\",\"uid\":\"30\"},{\"id_application_action\":\"32\",\"action\":\"32\",\"name\":\"Create Product Category\",\"uid\":\"31\"},{\"id_application_action\":\"33\",\"action\":\"33\",\"name\":\"Edit Product Category\",\"uid\":\"32\"},{\"id_application_action\":\"34\",\"action\":\"34\",\"name\":\"Delete Product Category\",\"uid\":\"33\"},{\"id_application_action\":\"35\",\"action\":\"35\",\"name\":\"Save\\/Edit Product Category\",\"uid\":\"34\"},{\"id_application_action\":\"36\",\"action\":\"36\",\"name\":\"View Merk\",\"uid\":\"35\"},{\"id_application_action\":\"37\",\"action\":\"37\",\"name\":\"Create Merk\",\"uid\":\"36\"},{\"id_application_action\":\"38\",\"action\":\"38\",\"name\":\"Edit Merk\",\"uid\":\"37\"},{\"id_application_action\":\"39\",\"action\":\"39\",\"name\":\"Delete Merk\",\"uid\":\"38\"},{\"id_application_action\":\"40\",\"action\":\"40\",\"name\":\"Save\\/Edit Merk\",\"uid\":\"39\"},{\"id_application_action\":\"41\",\"action\":\"41\",\"name\":\"View Customer\",\"uid\":\"40\"},{\"id_application_action\":\"43\",\"action\":\"43\",\"name\":\"Create Customer\",\"uid\":\"41\"},{\"id_application_action\":\"44\",\"action\":\"44\",\"name\":\"Edit Customer\",\"uid\":\"42\"},{\"id_application_action\":\"45\",\"action\":\"45\",\"name\":\"Delete Customer\",\"uid\":\"43\"},{\"id_application_action\":\"46\",\"action\":\"46\",\"name\":\"Save\\/Edit Customer\",\"uid\":\"44\"},{\"id_application_action\":\"47\",\"action\":\"47\",\"name\":\"View Warehouse\",\"uid\":\"45\"},{\"id_application_action\":\"48\",\"action\":\"48\",\"name\":\"Create Warehouse\",\"uid\":\"46\"},{\"id_application_action\":\"49\",\"action\":\"49\",\"name\":\"Edit Warehouse\",\"uid\":\"47\"},{\"id_application_action\":\"50\",\"action\":\"50\",\"name\":\"Delete Warehouse\",\"uid\":\"48\"},{\"id_application_action\":\"51\",\"action\":\"51\",\"name\":\"Save\\/Edit Warehouse\",\"uid\":\"49\"},{\"id_application_action\":\"57\",\"action\":\"57\",\"name\":\"View PO\",\"uid\":\"50\"},{\"id_application_action\":\"58\",\"action\":\"58\",\"name\":\"Create PO\",\"uid\":\"51\"},{\"id_application_action\":\"59\",\"action\":\"59\",\"name\":\"Edit PO\",\"uid\":\"52\"},{\"id_application_action\":\"60\",\"action\":\"60\",\"name\":\"Delete PO\",\"uid\":\"53\"},{\"id_application_action\":\"61\",\"action\":\"61\",\"name\":\"Save\\/Edit PO\",\"uid\":\"54\"},{\"id_application_action\":\"62\",\"action\":\"62\",\"name\":\"View User\",\"uid\":\"55\"},{\"id_application_action\":\"63\",\"action\":\"63\",\"name\":\"Create User\",\"uid\":\"56\"},{\"id_application_action\":\"64\",\"action\":\"64\",\"name\":\"Edit User\",\"uid\":\"57\"},{\"id_application_action\":\"65\",\"action\":\"65\",\"name\":\"Delete User\",\"uid\":\"58\"},{\"id_application_action\":\"66\",\"action\":\"66\",\"name\":\"Save\\/Edit User\",\"uid\":\"59\"},{\"id_application_action\":\"67\",\"action\":\"67\",\"name\":\"View Good Receive\",\"uid\":\"60\"},{\"id_application_action\":\"68\",\"action\":\"68\",\"name\":\"Create Good Receive\",\"uid\":\"61\"},{\"id_application_action\":\"69\",\"action\":\"69\",\"name\":\"Edit Good Receive\",\"uid\":\"62\"},{\"id_application_action\":\"70\",\"action\":\"70\",\"name\":\"Delete Good Receive\",\"uid\":\"63\"},{\"id_application_action\":\"71\",\"action\":\"71\",\"name\":\"Save\\/Edit Good Receive\",\"uid\":\"64\"},{\"id_application_action\":\"72\",\"action\":\"72\",\"name\":\"View Sales Order\",\"uid\":\"65\"},{\"id_application_action\":\"73\",\"action\":\"73\",\"name\":\"Create Sales Order\",\"uid\":\"66\"},{\"id_application_action\":\"74\",\"action\":\"74\",\"name\":\"Edit Sales Order\",\"uid\":\"67\"},{\"id_application_action\":\"75\",\"action\":\"75\",\"name\":\"Delete Sales Order\",\"uid\":\"68\"},{\"id_application_action\":\"76\",\"action\":\"76\",\"name\":\"Save Sales Order\",\"uid\":\"69\"},{\"id_application_action\":\"77\",\"action\":\"77\",\"name\":\"View Material Request\",\"uid\":\"70\"},{\"id_application_action\":\"78\",\"action\":\"78\",\"name\":\"Create Material Request\",\"uid\":\"71\"},{\"id_application_action\":\"79\",\"action\":\"79\",\"name\":\"Edit Material Request\",\"uid\":\"72\"},{\"id_application_action\":\"80\",\"action\":\"80\",\"name\":\"Delete Material Request\",\"uid\":\"73\"},{\"id_application_action\":\"81\",\"action\":\"81\",\"name\":\"Save Material Request\",\"uid\":\"74\"},{\"id_application_action\":\"82\",\"action\":\"82\",\"name\":\"Change User Password\",\"uid\":\"75\"},{\"id_application_action\":\"83\",\"action\":\"83\",\"name\":\"View Delivery Note\",\"uid\":\"76\"},{\"id_application_action\":\"84\",\"action\":\"84\",\"name\":\"Create Delivery Note\",\"uid\":\"77\"},{\"id_application_action\":\"85\",\"action\":\"85\",\"name\":\"Edit Delivery Note\",\"uid\":\"78\"},{\"id_application_action\":\"86\",\"action\":\"86\",\"name\":\"Delete Delivery Note\",\"uid\":\"79\"},{\"id_application_action\":\"87\",\"action\":\"87\",\"name\":\"Save\\/Edit Delivery Note\",\"uid\":\"80\"},{\"id_application_action\":\"88\",\"action\":\"88\",\"name\":\"View Unit Measure\",\"uid\":\"81\"},{\"id_application_action\":\"89\",\"action\":\"89\",\"name\":\"Create Unit Measure\",\"uid\":\"82\"},{\"id_application_action\":\"90\",\"action\":\"90\",\"name\":\"Edit Unit Measure\",\"uid\":\"83\"},{\"id_application_action\":\"91\",\"action\":\"91\",\"name\":\"Delete Unit Measure\",\"uid\":\"84\"},{\"id_application_action\":\"92\",\"action\":\"92\",\"name\":\"Save\\/Edit Unit Measure\",\"uid\":\"85\"},{\"id_application_action\":\"93\",\"action\":\"93\",\"name\":\"View Stock\",\"uid\":\"86\"},{\"id_application_action\":\"94\",\"action\":\"94\",\"name\":\"View Employee\",\"uid\":\"87\"},{\"id_application_action\":\"95\",\"action\":\"95\",\"name\":\"Create Employee\",\"uid\":\"88\"},{\"id_application_action\":\"96\",\"action\":\"96\",\"name\":\"Edit Employee\",\"uid\":\"89\"},{\"id_application_action\":\"97\",\"action\":\"97\",\"name\":\"Delete Employee\",\"uid\":\"90\"},{\"id_application_action\":\"98\",\"action\":\"98\",\"name\":\"Save\\/Edit Employee\",\"uid\":\"91\"},{\"id_application_action\":\"99\",\"action\":\"99\",\"name\":\"Validate PO\",\"uid\":\"92\"},{\"id_application_action\":\"100\",\"action\":\"100\",\"name\":\"Create Database Interface\",\"uid\":\"93\"},{\"id_application_action\":\"101\",\"action\":\"101\",\"name\":\"Edit Database Interface\",\"uid\":\"94\"},{\"id_application_action\":\"102\",\"action\":\"102\",\"name\":\"Delete Database Interface\",\"uid\":\"95\"},{\"id_application_action\":\"103\",\"action\":\"103\",\"name\":\"Save \\/ Edit Database Interface\",\"uid\":\"96\"},{\"id_application_action\":\"104\",\"action\":\"104\",\"name\":\"View Database Field Interface\",\"uid\":\"97\"},{\"id_application_action\":\"105\",\"action\":\"105\",\"name\":\"Create Database Field Interface\",\"uid\":\"98\"},{\"id_application_action\":\"106\",\"action\":\"106\",\"name\":\"Edit Database Field Interface\",\"uid\":\"99\"},{\"id_application_action\":\"107\",\"action\":\"107\",\"name\":\"Delete Database Field Interface\",\"uid\":\"100\"},{\"id_application_action\":\"108\",\"action\":\"108\",\"name\":\"Save \\/ Edit Database Field Interface\",\"uid\":\"101\"},{\"id_application_action\":\"109\",\"action\":\"109\",\"name\":\"View Inquiry\",\"uid\":\"102\"},{\"id_application_action\":\"110\",\"action\":\"110\",\"name\":\"Create Inquiry\",\"uid\":\"103\"},{\"id_application_action\":\"111\",\"action\":\"111\",\"name\":\"Edit Inquiry\",\"uid\":\"104\"},{\"id_application_action\":\"112\",\"action\":\"112\",\"name\":\"Delete Inquiry\",\"uid\":\"105\"},{\"id_application_action\":\"113\",\"action\":\"113\",\"name\":\"Save\\/Edit Inquiry\",\"uid\":\"106\"},{\"id_application_action\":\"114\",\"action\":\"114\",\"name\":\"View Survey \\/ Assessment\",\"uid\":\"107\"},{\"id_application_action\":\"115\",\"action\":\"115\",\"name\":\"Create Survey \\/ Assessment\",\"uid\":\"108\"},{\"id_application_action\":\"116\",\"action\":\"116\",\"name\":\"Edit Survey \\/ Assessment\",\"uid\":\"109\"},{\"id_application_action\":\"117\",\"action\":\"117\",\"name\":\"Delete Survey \\/ Assessment\",\"uid\":\"110\"},{\"id_application_action\":\"118\",\"action\":\"118\",\"name\":\"Save\\/Edit Survey \\/ Assessment\",\"uid\":\"111\"},{\"id_application_action\":\"119\",\"action\":\"119\",\"name\":\"View Quotation\",\"uid\":\"112\"},{\"id_application_action\":\"120\",\"action\":\"120\",\"name\":\"Create Quotation\",\"uid\":\"113\"},{\"id_application_action\":\"121\",\"action\":\"121\",\"name\":\"Edit Quotation\",\"uid\":\"114\"},{\"id_application_action\":\"122\",\"action\":\"122\",\"name\":\"Delete Quotation\",\"uid\":\"115\"},{\"id_application_action\":\"123\",\"action\":\"123\",\"name\":\"Save\\/Edit Quotation\",\"uid\":\"116\"},{\"id_application_action\":\"124\",\"action\":\"124\",\"name\":\"View Project Contract\",\"uid\":\"117\"},{\"id_application_action\":\"125\",\"action\":\"125\",\"name\":\"Create Project Contract\",\"uid\":\"118\"},{\"id_application_action\":\"126\",\"action\":\"126\",\"name\":\"Edit Project Contract\",\"uid\":\"119\"},{\"id_application_action\":\"127\",\"action\":\"127\",\"name\":\"Delete Project Contract\",\"uid\":\"120\"},{\"id_application_action\":\"128\",\"action\":\"128\",\"name\":\"Save\\/Edit Project Contract\",\"uid\":\"121\"},{\"id_application_action\":\"129\",\"action\":\"129\",\"name\":\"View Work Order\",\"uid\":\"122\"},{\"id_application_action\":\"130\",\"action\":\"130\",\"name\":\"Create Work Order\",\"uid\":\"123\"},{\"id_application_action\":\"131\",\"action\":\"131\",\"name\":\"Edit Work Order\",\"uid\":\"124\"},{\"id_application_action\":\"132\",\"action\":\"132\",\"name\":\"Delete Work Order\",\"uid\":\"125\"},{\"id_application_action\":\"133\",\"action\":\"133\",\"name\":\"Save\\/Edit Work Order\",\"uid\":\"126\"},{\"id_application_action\":\"134\",\"action\":\"134\",\"name\":\"View Assessment Template\",\"uid\":\"127\"},{\"id_application_action\":\"135\",\"action\":\"135\",\"name\":\"Create Assessment Template\",\"uid\":\"128\"},{\"id_application_action\":\"136\",\"action\":\"136\",\"name\":\"Edit Assessment Template\",\"uid\":\"129\"},{\"id_application_action\":\"137\",\"action\":\"137\",\"name\":\"Delete Assessment Template\",\"uid\":\"130\"},{\"id_application_action\":\"138\",\"action\":\"138\",\"name\":\"Save\\/Edit Assessment Template\",\"uid\":\"131\"},{\"id_application_action\":\"139\",\"action\":\"139\",\"name\":\"View Contract Template\",\"uid\":\"132\"},{\"id_application_action\":\"140\",\"action\":\"140\",\"name\":\"Create Contract Template\",\"uid\":\"133\"},{\"id_application_action\":\"141\",\"action\":\"141\",\"name\":\"Edit Contract Template\",\"uid\":\"134\"},{\"id_application_action\":\"142\",\"action\":\"142\",\"name\":\"Delete Contract Template\",\"uid\":\"135\"},{\"id_application_action\":\"143\",\"action\":\"143\",\"name\":\"Save\\/Edit Contract Template\",\"uid\":\"136\"},{\"id_application_action\":\"144\",\"action\":\"144\",\"name\":\"View Work Schedule\",\"uid\":\"137\"},{\"id_application_action\":\"145\",\"action\":\"145\",\"name\":\"Create Work Schedule\",\"uid\":\"138\"},{\"id_application_action\":\"146\",\"action\":\"146\",\"name\":\"Edit Work Schedule\",\"uid\":\"139\"},{\"id_application_action\":\"147\",\"action\":\"147\",\"name\":\"Delete Work Schedule\",\"uid\":\"140\"},{\"id_application_action\":\"148\",\"action\":\"148\",\"name\":\"Save\\/Edit Work Schedule\",\"uid\":\"141\"},{\"id_application_action\":\"149\",\"action\":\"149\",\"name\":\"View SO Assignment\",\"uid\":\"142\"},{\"id_application_action\":\"150\",\"action\":\"150\",\"name\":\"Create SO Assignment\",\"uid\":\"143\"},{\"id_application_action\":\"151\",\"action\":\"151\",\"name\":\"Edit SO Assignment\",\"uid\":\"144\"},{\"id_application_action\":\"152\",\"action\":\"152\",\"name\":\"Delete SO Assignment\",\"uid\":\"145\"},{\"id_application_action\":\"153\",\"action\":\"153\",\"name\":\"Save\\/Edit SO Assignment\",\"uid\":\"146\"},{\"id_application_action\":\"154\",\"action\":\"154\",\"name\":\"View Shift Change\",\"uid\":\"147\"},{\"id_application_action\":\"155\",\"action\":\"155\",\"name\":\"Create Shift Change\",\"uid\":\"148\"},{\"id_application_action\":\"156\",\"action\":\"156\",\"name\":\"Edit Shift Change\",\"uid\":\"149\"},{\"id_application_action\":\"157\",\"action\":\"157\",\"name\":\"Delete Shift Change\",\"uid\":\"150\"},{\"id_application_action\":\"158\",\"action\":\"158\",\"name\":\"Save\\/Edit Shift Change\",\"uid\":\"151\"},{\"id_application_action\":\"159\",\"action\":\"159\",\"name\":\"View Leave Application\",\"uid\":\"152\"},{\"id_application_action\":\"160\",\"action\":\"160\",\"name\":\"Create Leave Application\",\"uid\":\"153\"},{\"id_application_action\":\"161\",\"action\":\"161\",\"name\":\"Edit Leave Application\",\"uid\":\"154\"},{\"id_application_action\":\"162\",\"action\":\"162\",\"name\":\"Delete Leave Application\",\"uid\":\"155\"},{\"id_application_action\":\"163\",\"action\":\"163\",\"name\":\"Save\\/Edit Leave Application\",\"uid\":\"156\"},{\"id_application_action\":\"164\",\"action\":\"164\",\"name\":\"View Timesheet (Recap)\",\"uid\":\"157\"},{\"id_application_action\":\"165\",\"action\":\"165\",\"name\":\"Create Timesheet (Recap)\",\"uid\":\"158\"},{\"id_application_action\":\"166\",\"action\":\"166\",\"name\":\"Edit Timesheet (Recap)\",\"uid\":\"159\"},{\"id_application_action\":\"167\",\"action\":\"167\",\"name\":\"Delete Timesheet (Recap)\",\"uid\":\"160\"},{\"id_application_action\":\"168\",\"action\":\"168\",\"name\":\"Save\\/Edit Timesheet (Recap)\",\"uid\":\"161\"},{\"id_application_action\":\"169\",\"action\":\"169\",\"name\":\"View SO Timesheet\",\"uid\":\"162\"},{\"id_application_action\":\"170\",\"action\":\"170\",\"name\":\"Create SO Timesheet\",\"uid\":\"163\"},{\"id_application_action\":\"171\",\"action\":\"171\",\"name\":\"Edit SO Timesheet\",\"uid\":\"164\"},{\"id_application_action\":\"172\",\"action\":\"172\",\"name\":\"Delete SO Timesheet\",\"uid\":\"165\"},{\"id_application_action\":\"173\",\"action\":\"173\",\"name\":\"Save\\/Edit SO Timesheet\",\"uid\":\"166\"},{\"id_application_action\":\"174\",\"action\":\"174\",\"name\":\"View Incident Report\",\"uid\":\"167\"},{\"id_application_action\":\"175\",\"action\":\"175\",\"name\":\"Create Incident Report\",\"uid\":\"168\"},{\"id_application_action\":\"176\",\"action\":\"176\",\"name\":\"Edit Incident Report\",\"uid\":\"169\"},{\"id_application_action\":\"177\",\"action\":\"177\",\"name\":\"Delete Incident Report\",\"uid\":\"170\"},{\"id_application_action\":\"178\",\"action\":\"178\",\"name\":\"Save\\/Edit Incident Report\",\"uid\":\"171\"},{\"id_application_action\":\"179\",\"action\":\"179\",\"name\":\"View Payroll\",\"uid\":\"172\"},{\"id_application_action\":\"180\",\"action\":\"180\",\"name\":\"Create Payroll\",\"uid\":\"173\"},{\"id_application_action\":\"181\",\"action\":\"181\",\"name\":\"Edit Payroll\",\"uid\":\"174\"},{\"id_application_action\":\"182\",\"action\":\"182\",\"name\":\"Delete Payroll\",\"uid\":\"175\"},{\"id_application_action\":\"183\",\"action\":\"183\",\"name\":\"Save\\/Edit Payroll\",\"uid\":\"176\"},{\"id_application_action\":\"184\",\"action\":\"184\",\"name\":\"View Supplier Invoice\",\"uid\":\"177\"},{\"id_application_action\":\"185\",\"action\":\"185\",\"name\":\"Create Supplier Invoice\",\"uid\":\"178\"},{\"id_application_action\":\"186\",\"action\":\"186\",\"name\":\"Edit Supplier Invoice\",\"uid\":\"179\"},{\"id_application_action\":\"187\",\"action\":\"187\",\"name\":\"Delete Supplier Invoice\",\"uid\":\"180\"},{\"id_application_action\":\"188\",\"action\":\"188\",\"name\":\"Save\\/Edit Supplier Invoice\",\"uid\":\"181\"},{\"id_application_action\":\"189\",\"action\":\"189\",\"name\":\"View Customer Invoice\",\"uid\":\"182\"},{\"id_application_action\":\"190\",\"action\":\"190\",\"name\":\"Create Customer Invoice\",\"uid\":\"183\"},{\"id_application_action\":\"191\",\"action\":\"191\",\"name\":\"Edit Customer Invoice\",\"uid\":\"184\"},{\"id_application_action\":\"192\",\"action\":\"192\",\"name\":\"Delete Customer Invoice\",\"uid\":\"185\"},{\"id_application_action\":\"193\",\"action\":\"193\",\"name\":\"Save\\/Edit Customer Invoice\",\"uid\":\"186\"},{\"id_application_action\":\"194\",\"action\":\"194\",\"name\":\"View Bank Statement\",\"uid\":\"187\"},{\"id_application_action\":\"195\",\"action\":\"195\",\"name\":\"Create Bank Statement\",\"uid\":\"188\"},{\"id_application_action\":\"196\",\"action\":\"196\",\"name\":\"Edit Bank Statement\",\"uid\":\"189\"},{\"id_application_action\":\"197\",\"action\":\"197\",\"name\":\"Delete Bank Statement\",\"uid\":\"190\"},{\"id_application_action\":\"198\",\"action\":\"198\",\"name\":\"Save\\/Edit Bank Statement\",\"uid\":\"191\"},{\"id_application_action\":\"199\",\"action\":\"199\",\"name\":\"View Cash Register\",\"uid\":\"192\"},{\"id_application_action\":\"200\",\"action\":\"200\",\"name\":\"Create Cash Register\",\"uid\":\"193\"},{\"id_application_action\":\"201\",\"action\":\"201\",\"name\":\"Edit Cash Register\",\"uid\":\"194\"},{\"id_application_action\":\"202\",\"action\":\"202\",\"name\":\"Delete Cash Register\",\"uid\":\"195\"},{\"id_application_action\":\"203\",\"action\":\"203\",\"name\":\"Save\\/Edit Cash Register\",\"uid\":\"196\"},{\"id_application_action\":\"204\",\"action\":\"204\",\"name\":\"View Tax\",\"uid\":\"197\"},{\"id_application_action\":\"205\",\"action\":\"205\",\"name\":\"Create Tax\",\"uid\":\"198\"},{\"id_application_action\":\"206\",\"action\":\"206\",\"name\":\"Edit Tax\",\"uid\":\"199\"},{\"id_application_action\":\"207\",\"action\":\"207\",\"name\":\"Delete Tax\",\"uid\":\"200\"},{\"id_application_action\":\"208\",\"action\":\"208\",\"name\":\"Save\\/Edit Tax\",\"uid\":\"201\"},{\"id_application_action\":\"209\",\"action\":\"209\",\"name\":\"View Chart of Account\",\"uid\":\"202\"},{\"id_application_action\":\"210\",\"action\":\"210\",\"name\":\"Create Chart of Account\",\"uid\":\"203\"},{\"id_application_action\":\"211\",\"action\":\"211\",\"name\":\"Edit Chart of Account\",\"uid\":\"204\"},{\"id_application_action\":\"212\",\"action\":\"212\",\"name\":\"Delete Chart of Account\",\"uid\":\"205\"},{\"id_application_action\":\"213\",\"action\":\"213\",\"name\":\"Save\\/Edit Chart of Account\",\"uid\":\"206\"},{\"id_application_action\":\"214\",\"action\":\"214\",\"name\":\"View Employee Salary\",\"uid\":\"207\"},{\"id_application_action\":\"215\",\"action\":\"215\",\"name\":\"Create Employee Salary\",\"uid\":\"208\"},{\"id_application_action\":\"216\",\"action\":\"216\",\"name\":\"Edit Employee Salary\",\"uid\":\"209\"},{\"id_application_action\":\"217\",\"action\":\"217\",\"name\":\"Delete Employee Salary\",\"uid\":\"210\"},{\"id_application_action\":\"218\",\"action\":\"218\",\"name\":\"Save\\/Edit Employee Salary\",\"uid\":\"211\"},{\"id_application_action\":\"219\",\"action\":\"219\",\"name\":\"View Salary Setting\",\"uid\":\"212\"},{\"id_application_action\":\"220\",\"action\":\"220\",\"name\":\"Create Salary Setting\",\"uid\":\"213\"},{\"id_application_action\":\"221\",\"action\":\"221\",\"name\":\"Edit Salary Setting\",\"uid\":\"214\"},{\"id_application_action\":\"222\",\"action\":\"222\",\"name\":\"Delete Salary Setting\",\"uid\":\"215\"},{\"id_application_action\":\"223\",\"action\":\"223\",\"name\":\"Save\\/Edit Salary Setting\",\"uid\":\"216\"},{\"id_application_action\":\"224\",\"action\":\"224\",\"name\":\"View Database Interface\",\"uid\":\"217\"},{\"id_application_action\":\"225\",\"action\":\"225\",\"name\":\"Pick Assessment Template\",\"uid\":\"218\"},{\"id_application_action\":\"226\",\"action\":\"226\",\"name\":\"View Organisation Structure\",\"uid\":\"219\"},{\"id_application_action\":\"227\",\"action\":\"227\",\"name\":\"Create Organisation Structure\",\"uid\":\"220\"},{\"id_application_action\":\"228\",\"action\":\"228\",\"name\":\"Edit Organisation Structure\",\"uid\":\"221\"},{\"id_application_action\":\"229\",\"action\":\"229\",\"name\":\"Delete Organisation Structure\",\"uid\":\"222\"},{\"id_application_action\":\"230\",\"action\":\"230\",\"name\":\"Save\\/Edit Organisation Structure\",\"uid\":\"223\"},{\"id_application_action\":\"231\",\"action\":\"231\",\"name\":\"View Position Level\",\"uid\":\"224\"},{\"id_application_action\":\"232\",\"action\":\"232\",\"name\":\"Create Position Level\",\"uid\":\"225\"},{\"id_application_action\":\"233\",\"action\":\"233\",\"name\":\"Edit Position Level\",\"uid\":\"226\"},{\"id_application_action\":\"234\",\"action\":\"234\",\"name\":\"Delete Position Level\",\"uid\":\"227\"},{\"id_application_action\":\"235\",\"action\":\"235\",\"name\":\"Save\\/Edit Position Level\",\"uid\":\"228\"},{\"id_application_action\":\"236\",\"action\":\"236\",\"name\":\"View Employee Contract Type\",\"uid\":\"229\"},{\"id_application_action\":\"237\",\"action\":\"237\",\"name\":\"Create Employee Contract Type\",\"uid\":\"230\"},{\"id_application_action\":\"238\",\"action\":\"238\",\"name\":\"Edit Employee Contract Type\",\"uid\":\"231\"},{\"id_application_action\":\"239\",\"action\":\"239\",\"name\":\"Delete Employee Contract Type\",\"uid\":\"232\"},{\"id_application_action\":\"240\",\"action\":\"240\",\"name\":\"Save\\/Edit Employee Contract\",\"uid\":\"233\"},{\"id_application_action\":\"241\",\"action\":\"241\",\"name\":\"View Bank\",\"uid\":\"234\"},{\"id_application_action\":\"242\",\"action\":\"242\",\"name\":\"Create Bank\",\"uid\":\"235\"},{\"id_application_action\":\"243\",\"action\":\"243\",\"name\":\"Edit Bank\",\"uid\":\"236\"},{\"id_application_action\":\"244\",\"action\":\"244\",\"name\":\"Delete Bank\",\"uid\":\"237\"},{\"id_application_action\":\"245\",\"action\":\"245\",\"name\":\"Save\\/Edit Bank\",\"uid\":\"238\"},{\"id_application_action\":\"246\",\"action\":\"246\",\"name\":\"View Payment Receipt\",\"uid\":\"239\"},{\"id_application_action\":\"247\",\"action\":\"247\",\"name\":\"Create Payment Receipt\",\"uid\":\"240\"},{\"id_application_action\":\"248\",\"action\":\"248\",\"name\":\"Edit Payment Receipt\",\"uid\":\"241\"},{\"id_application_action\":\"249\",\"action\":\"249\",\"name\":\"Save\\/Edit Payment Receipt\",\"uid\":\"242\"},{\"id_application_action\":\"250\",\"action\":\"250\",\"name\":\"Delete Payment Receipt\",\"uid\":\"243\"},{\"id_application_action\":\"251\",\"action\":\"251\",\"name\":\"Receive Payment From PO\",\"uid\":\"244\"},{\"id_application_action\":\"252\",\"action\":\"252\",\"name\":\"Make Payment Receipt\",\"uid\":\"245\"},{\"id_application_action\":\"253\",\"action\":\"253\",\"name\":\"Cancel Payment Receipt\",\"uid\":\"246\"},{\"id_application_action\":\"254\",\"action\":\"254\",\"name\":\"View Stock Transaction\",\"uid\":\"247\"},{\"id_application_action\":\"255\",\"action\":\"255\",\"name\":\"Create Stock Transaction\",\"uid\":\"248\"},{\"id_application_action\":\"256\",\"action\":\"256\",\"name\":\"Edit Stock Transaction\",\"uid\":\"249\"},{\"id_application_action\":\"257\",\"action\":\"257\",\"name\":\"Delete Stock Transaction\",\"uid\":\"250\"},{\"id_application_action\":\"258\",\"action\":\"258\",\"name\":\"Save\\/Edit Stock Transaction\",\"uid\":\"251\"},{\"id_application_action\":\"259\",\"action\":\"259\",\"name\":\"Post Stock Transaction\",\"uid\":\"252\"},{\"id_application_action\":\"260\",\"action\":\"260\",\"name\":\"Unpost Stock Transaction\",\"uid\":\"253\"},{\"id_application_action\":\"261\",\"action\":\"261\",\"name\":\"Transfer Good Receive\",\"uid\":\"254\"},{\"id_application_action\":\"262\",\"action\":\"262\",\"name\":\"View Activity\",\"uid\":\"255\"},{\"id_application_action\":\"263\",\"action\":\"263\",\"name\":\"Make Working Schedule\",\"uid\":\"256\"},{\"id_application_action\":\"264\",\"action\":\"264\",\"name\":\"Validate Inquiry\",\"uid\":\"257\"},{\"id_application_action\":\"265\",\"name\":\"Validate Quotation\",\"uid\":\"258\",\"id\":\"258\"}],\"is_edit\":\"true\",\"id_role\":\"1\"}', '2015-02-19 18:11:18');
INSERT INTO `activity_log` VALUES ('163', 'Validate Inquiry', 'inquiry', null, '2', 'Validate Inquiry', '264', '{\"id_inquiry\":\"1\",\"status\":\"open\"}', '2015-02-19 18:13:27');
INSERT INTO `activity_log` VALUES ('164', 'Validate Inquiry', 'inquiry', null, '2', 'Validate Inquiry', '264', '{\"id_inquiry\":\"1\",\"status\":\"open\"}', '2015-02-19 18:14:14');
INSERT INTO `activity_log` VALUES ('165', 'Validate Quotation', 'quotation', null, '2', 'Validate Quotation', '265', '{\"id_quotation\":\"1\",\"status\":\"open\"}', '2015-02-19 18:15:21');
INSERT INTO `activity_log` VALUES ('166', 'Save/Edit Inquiry', 'inquiry', null, '2', 'Save/Edit Inquiry', '113', '{}', '2015-03-06 21:25:34');
INSERT INTO `activity_log` VALUES ('167', 'Validate Inquiry', 'inquiry', null, '2', 'Validate Inquiry', '264', '{\"id_inquiry\":\"2\",\"status\":\"open\"}', '2015-03-06 21:25:48');
INSERT INTO `activity_log` VALUES ('168', 'Save/Edit Employee', 'employee', null, '2', 'Save/Edit Employee', '98', '{}', '2015-03-17 23:10:26');
INSERT INTO `activity_log` VALUES ('169', 'Save/Edit Employee', 'employee', null, '2', 'Save/Edit Employee', '98', '{}', '2015-03-17 23:14:02');
INSERT INTO `activity_log` VALUES ('170', 'Save/Edit Role', 'role', null, '2', 'Save/Edit Role', '20', '{\"name\":\"administrator\",\"action_detail\":[{\"id_application_action\":\"1\",\"action\":\"1\",\"name\":\"View Application Action\",\"uid\":\"0\"},{\"id_application_action\":\"2\",\"action\":\"2\",\"name\":\"Create Application Action\",\"uid\":\"1\"},{\"id_application_action\":\"3\",\"action\":\"3\",\"name\":\"Edit Application Action\",\"uid\":\"2\"},{\"id_application_action\":\"4\",\"action\":\"4\",\"name\":\"Delete Application Action\",\"uid\":\"3\"},{\"id_application_action\":\"5\",\"action\":\"5\",\"name\":\"View Side Menu\",\"uid\":\"4\"},{\"id_application_action\":\"6\",\"action\":\"6\",\"name\":\"Create Side Menu\",\"uid\":\"5\"},{\"id_application_action\":\"7\",\"action\":\"7\",\"name\":\"Edit Side Menu\",\"uid\":\"6\"},{\"id_application_action\":\"8\",\"action\":\"8\",\"name\":\"Delete Side Menu\",\"uid\":\"7\"},{\"id_application_action\":\"9\",\"action\":\"9\",\"name\":\"Save\\/Edit Side Menu\",\"uid\":\"8\"},{\"id_application_action\":\"10\",\"action\":\"10\",\"name\":\"Save\\/Edit Action\",\"uid\":\"9\"},{\"id_application_action\":\"11\",\"action\":\"11\",\"name\":\"View Division\",\"uid\":\"10\"},{\"id_application_action\":\"12\",\"action\":\"12\",\"name\":\"Create Division\",\"uid\":\"11\"},{\"id_application_action\":\"13\",\"action\":\"13\",\"name\":\"Save\\/Edit Division\",\"uid\":\"12\"},{\"id_application_action\":\"14\",\"action\":\"14\",\"name\":\"Edit Division\",\"uid\":\"13\"},{\"id_application_action\":\"15\",\"action\":\"15\",\"name\":\"Delete Division\",\"uid\":\"14\"},{\"id_application_action\":\"16\",\"action\":\"16\",\"name\":\"View Role\",\"uid\":\"15\"},{\"id_application_action\":\"17\",\"action\":\"17\",\"name\":\"View Create Role\",\"uid\":\"16\"},{\"id_application_action\":\"18\",\"action\":\"18\",\"name\":\"View Edit Role\",\"uid\":\"17\"},{\"id_application_action\":\"19\",\"action\":\"19\",\"name\":\"Delete Role\",\"uid\":\"18\"},{\"id_application_action\":\"20\",\"action\":\"20\",\"name\":\"Save\\/Edit Role\",\"uid\":\"19\"},{\"id_application_action\":\"21\",\"action\":\"21\",\"name\":\"View Product\",\"uid\":\"20\"},{\"id_application_action\":\"22\",\"action\":\"22\",\"name\":\"Create Product\",\"uid\":\"21\"},{\"id_application_action\":\"23\",\"action\":\"23\",\"name\":\"Edit Product\",\"uid\":\"22\"},{\"id_application_action\":\"24\",\"action\":\"24\",\"name\":\"Delete Product\",\"uid\":\"23\"},{\"id_application_action\":\"25\",\"action\":\"25\",\"name\":\"Save\\/Edit Product\",\"uid\":\"24\"},{\"id_application_action\":\"26\",\"action\":\"26\",\"name\":\"View Supplier\",\"uid\":\"25\"},{\"id_application_action\":\"27\",\"action\":\"27\",\"name\":\"Create Supplier\",\"uid\":\"26\"},{\"id_application_action\":\"28\",\"action\":\"28\",\"name\":\"Edit Supplier\",\"uid\":\"27\"},{\"id_application_action\":\"29\",\"action\":\"29\",\"name\":\"Delete Supplier\",\"uid\":\"28\"},{\"id_application_action\":\"30\",\"action\":\"30\",\"name\":\"Save\\/Edit Supplier\",\"uid\":\"29\"},{\"id_application_action\":\"31\",\"action\":\"31\",\"name\":\"View Product Category\",\"uid\":\"30\"},{\"id_application_action\":\"32\",\"action\":\"32\",\"name\":\"Create Product Category\",\"uid\":\"31\"},{\"id_application_action\":\"33\",\"action\":\"33\",\"name\":\"Edit Product Category\",\"uid\":\"32\"},{\"id_application_action\":\"34\",\"action\":\"34\",\"name\":\"Delete Product Category\",\"uid\":\"33\"},{\"id_application_action\":\"35\",\"action\":\"35\",\"name\":\"Save\\/Edit Product Category\",\"uid\":\"34\"},{\"id_application_action\":\"36\",\"action\":\"36\",\"name\":\"View Merk\",\"uid\":\"35\"},{\"id_application_action\":\"37\",\"action\":\"37\",\"name\":\"Create Merk\",\"uid\":\"36\"},{\"id_application_action\":\"38\",\"action\":\"38\",\"name\":\"Edit Merk\",\"uid\":\"37\"},{\"id_application_action\":\"39\",\"action\":\"39\",\"name\":\"Delete Merk\",\"uid\":\"38\"},{\"id_application_action\":\"40\",\"action\":\"40\",\"name\":\"Save\\/Edit Merk\",\"uid\":\"39\"},{\"id_application_action\":\"41\",\"action\":\"41\",\"name\":\"View Customer\",\"uid\":\"40\"},{\"id_application_action\":\"43\",\"action\":\"43\",\"name\":\"Create Customer\",\"uid\":\"41\"},{\"id_application_action\":\"44\",\"action\":\"44\",\"name\":\"Edit Customer\",\"uid\":\"42\"},{\"id_application_action\":\"45\",\"action\":\"45\",\"name\":\"Delete Customer\",\"uid\":\"43\"},{\"id_application_action\":\"46\",\"action\":\"46\",\"name\":\"Save\\/Edit Customer\",\"uid\":\"44\"},{\"id_application_action\":\"47\",\"action\":\"47\",\"name\":\"View Warehouse\",\"uid\":\"45\"},{\"id_application_action\":\"48\",\"action\":\"48\",\"name\":\"Create Warehouse\",\"uid\":\"46\"},{\"id_application_action\":\"49\",\"action\":\"49\",\"name\":\"Edit Warehouse\",\"uid\":\"47\"},{\"id_application_action\":\"50\",\"action\":\"50\",\"name\":\"Delete Warehouse\",\"uid\":\"48\"},{\"id_application_action\":\"51\",\"action\":\"51\",\"name\":\"Save\\/Edit Warehouse\",\"uid\":\"49\"},{\"id_application_action\":\"57\",\"action\":\"57\",\"name\":\"View PO\",\"uid\":\"50\"},{\"id_application_action\":\"58\",\"action\":\"58\",\"name\":\"Create PO\",\"uid\":\"51\"},{\"id_application_action\":\"59\",\"action\":\"59\",\"name\":\"Edit PO\",\"uid\":\"52\"},{\"id_application_action\":\"60\",\"action\":\"60\",\"name\":\"Delete PO\",\"uid\":\"53\"},{\"id_application_action\":\"61\",\"action\":\"61\",\"name\":\"Save\\/Edit PO\",\"uid\":\"54\"},{\"id_application_action\":\"62\",\"action\":\"62\",\"name\":\"View User\",\"uid\":\"55\"},{\"id_application_action\":\"63\",\"action\":\"63\",\"name\":\"Create User\",\"uid\":\"56\"},{\"id_application_action\":\"64\",\"action\":\"64\",\"name\":\"Edit User\",\"uid\":\"57\"},{\"id_application_action\":\"65\",\"action\":\"65\",\"name\":\"Delete User\",\"uid\":\"58\"},{\"id_application_action\":\"66\",\"action\":\"66\",\"name\":\"Save\\/Edit User\",\"uid\":\"59\"},{\"id_application_action\":\"67\",\"action\":\"67\",\"name\":\"View Good Receive\",\"uid\":\"60\"},{\"id_application_action\":\"68\",\"action\":\"68\",\"name\":\"Create Good Receive\",\"uid\":\"61\"},{\"id_application_action\":\"69\",\"action\":\"69\",\"name\":\"Edit Good Receive\",\"uid\":\"62\"},{\"id_application_action\":\"70\",\"action\":\"70\",\"name\":\"Delete Good Receive\",\"uid\":\"63\"},{\"id_application_action\":\"71\",\"action\":\"71\",\"name\":\"Save\\/Edit Good Receive\",\"uid\":\"64\"},{\"id_application_action\":\"72\",\"action\":\"72\",\"name\":\"View Sales Order\",\"uid\":\"65\"},{\"id_application_action\":\"73\",\"action\":\"73\",\"name\":\"Create Sales Order\",\"uid\":\"66\"},{\"id_application_action\":\"74\",\"action\":\"74\",\"name\":\"Edit Sales Order\",\"uid\":\"67\"},{\"id_application_action\":\"75\",\"action\":\"75\",\"name\":\"Delete Sales Order\",\"uid\":\"68\"},{\"id_application_action\":\"76\",\"action\":\"76\",\"name\":\"Save Sales Order\",\"uid\":\"69\"},{\"id_application_action\":\"77\",\"action\":\"77\",\"name\":\"View Material Request\",\"uid\":\"70\"},{\"id_application_action\":\"78\",\"action\":\"78\",\"name\":\"Create Material Request\",\"uid\":\"71\"},{\"id_application_action\":\"79\",\"action\":\"79\",\"name\":\"Edit Material Request\",\"uid\":\"72\"},{\"id_application_action\":\"80\",\"action\":\"80\",\"name\":\"Delete Material Request\",\"uid\":\"73\"},{\"id_application_action\":\"81\",\"action\":\"81\",\"name\":\"Save Material Request\",\"uid\":\"74\"},{\"id_application_action\":\"82\",\"action\":\"82\",\"name\":\"Change User Password\",\"uid\":\"75\"},{\"id_application_action\":\"83\",\"action\":\"83\",\"name\":\"View Delivery Note\",\"uid\":\"76\"},{\"id_application_action\":\"84\",\"action\":\"84\",\"name\":\"Create Delivery Note\",\"uid\":\"77\"},{\"id_application_action\":\"85\",\"action\":\"85\",\"name\":\"Edit Delivery Note\",\"uid\":\"78\"},{\"id_application_action\":\"86\",\"action\":\"86\",\"name\":\"Delete Delivery Note\",\"uid\":\"79\"},{\"id_application_action\":\"87\",\"action\":\"87\",\"name\":\"Save\\/Edit Delivery Note\",\"uid\":\"80\"},{\"id_application_action\":\"88\",\"action\":\"88\",\"name\":\"View Unit Measure\",\"uid\":\"81\"},{\"id_application_action\":\"89\",\"action\":\"89\",\"name\":\"Create Unit Measure\",\"uid\":\"82\"},{\"id_application_action\":\"90\",\"action\":\"90\",\"name\":\"Edit Unit Measure\",\"uid\":\"83\"},{\"id_application_action\":\"91\",\"action\":\"91\",\"name\":\"Delete Unit Measure\",\"uid\":\"84\"},{\"id_application_action\":\"92\",\"action\":\"92\",\"name\":\"Save\\/Edit Unit Measure\",\"uid\":\"85\"},{\"id_application_action\":\"93\",\"action\":\"93\",\"name\":\"View Stock\",\"uid\":\"86\"},{\"id_application_action\":\"94\",\"action\":\"94\",\"name\":\"View Employee\",\"uid\":\"87\"},{\"id_application_action\":\"95\",\"action\":\"95\",\"name\":\"Create Employee\",\"uid\":\"88\"},{\"id_application_action\":\"96\",\"action\":\"96\",\"name\":\"Edit Employee\",\"uid\":\"89\"},{\"id_application_action\":\"97\",\"action\":\"97\",\"name\":\"Delete Employee\",\"uid\":\"90\"},{\"id_application_action\":\"98\",\"action\":\"98\",\"name\":\"Save\\/Edit Employee\",\"uid\":\"91\"},{\"id_application_action\":\"99\",\"action\":\"99\",\"name\":\"Validate PO\",\"uid\":\"92\"},{\"id_application_action\":\"100\",\"action\":\"100\",\"name\":\"Create Database Interface\",\"uid\":\"93\"},{\"id_application_action\":\"101\",\"action\":\"101\",\"name\":\"Edit Database Interface\",\"uid\":\"94\"},{\"id_application_action\":\"102\",\"action\":\"102\",\"name\":\"Delete Database Interface\",\"uid\":\"95\"},{\"id_application_action\":\"103\",\"action\":\"103\",\"name\":\"Save \\/ Edit Database Interface\",\"uid\":\"96\"},{\"id_application_action\":\"104\",\"action\":\"104\",\"name\":\"View Database Field Interface\",\"uid\":\"97\"},{\"id_application_action\":\"105\",\"action\":\"105\",\"name\":\"Create Database Field Interface\",\"uid\":\"98\"},{\"id_application_action\":\"106\",\"action\":\"106\",\"name\":\"Edit Database Field Interface\",\"uid\":\"99\"},{\"id_application_action\":\"107\",\"action\":\"107\",\"name\":\"Delete Database Field Interface\",\"uid\":\"100\"},{\"id_application_action\":\"108\",\"action\":\"108\",\"name\":\"Save \\/ Edit Database Field Interface\",\"uid\":\"101\"},{\"id_application_action\":\"109\",\"action\":\"109\",\"name\":\"View Inquiry\",\"uid\":\"102\"},{\"id_application_action\":\"110\",\"action\":\"110\",\"name\":\"Create Inquiry\",\"uid\":\"103\"},{\"id_application_action\":\"111\",\"action\":\"111\",\"name\":\"Edit Inquiry\",\"uid\":\"104\"},{\"id_application_action\":\"112\",\"action\":\"112\",\"name\":\"Delete Inquiry\",\"uid\":\"105\"},{\"id_application_action\":\"113\",\"action\":\"113\",\"name\":\"Save\\/Edit Inquiry\",\"uid\":\"106\"},{\"id_application_action\":\"114\",\"action\":\"114\",\"name\":\"View Survey \\/ Assessment\",\"uid\":\"107\"},{\"id_application_action\":\"115\",\"action\":\"115\",\"name\":\"Create Survey \\/ Assessment\",\"uid\":\"108\"},{\"id_application_action\":\"116\",\"action\":\"116\",\"name\":\"Edit Survey \\/ Assessment\",\"uid\":\"109\"},{\"id_application_action\":\"117\",\"action\":\"117\",\"name\":\"Delete Survey \\/ Assessment\",\"uid\":\"110\"},{\"id_application_action\":\"118\",\"action\":\"118\",\"name\":\"Save\\/Edit Survey \\/ Assessment\",\"uid\":\"111\"},{\"id_application_action\":\"119\",\"action\":\"119\",\"name\":\"View Quotation\",\"uid\":\"112\"},{\"id_application_action\":\"120\",\"action\":\"120\",\"name\":\"Create Quotation\",\"uid\":\"113\"},{\"id_application_action\":\"121\",\"action\":\"121\",\"name\":\"Edit Quotation\",\"uid\":\"114\"},{\"id_application_action\":\"122\",\"action\":\"122\",\"name\":\"Delete Quotation\",\"uid\":\"115\"},{\"id_application_action\":\"123\",\"action\":\"123\",\"name\":\"Save\\/Edit Quotation\",\"uid\":\"116\"},{\"id_application_action\":\"124\",\"action\":\"124\",\"name\":\"View Project Contract\",\"uid\":\"117\"},{\"id_application_action\":\"125\",\"action\":\"125\",\"name\":\"Create Project Contract\",\"uid\":\"118\"},{\"id_application_action\":\"126\",\"action\":\"126\",\"name\":\"Edit Project Contract\",\"uid\":\"119\"},{\"id_application_action\":\"127\",\"action\":\"127\",\"name\":\"Delete Project Contract\",\"uid\":\"120\"},{\"id_application_action\":\"128\",\"action\":\"128\",\"name\":\"Save\\/Edit Project Contract\",\"uid\":\"121\"},{\"id_application_action\":\"129\",\"action\":\"129\",\"name\":\"View Work Order\",\"uid\":\"122\"},{\"id_application_action\":\"130\",\"action\":\"130\",\"name\":\"Create Work Order\",\"uid\":\"123\"},{\"id_application_action\":\"131\",\"action\":\"131\",\"name\":\"Edit Work Order\",\"uid\":\"124\"},{\"id_application_action\":\"132\",\"action\":\"132\",\"name\":\"Delete Work Order\",\"uid\":\"125\"},{\"id_application_action\":\"133\",\"action\":\"133\",\"name\":\"Save\\/Edit Work Order\",\"uid\":\"126\"},{\"id_application_action\":\"134\",\"action\":\"134\",\"name\":\"View Assessment Template\",\"uid\":\"127\"},{\"id_application_action\":\"135\",\"action\":\"135\",\"name\":\"Create Assessment Template\",\"uid\":\"128\"},{\"id_application_action\":\"136\",\"action\":\"136\",\"name\":\"Edit Assessment Template\",\"uid\":\"129\"},{\"id_application_action\":\"137\",\"action\":\"137\",\"name\":\"Delete Assessment Template\",\"uid\":\"130\"},{\"id_application_action\":\"138\",\"action\":\"138\",\"name\":\"Save\\/Edit Assessment Template\",\"uid\":\"131\"},{\"id_application_action\":\"139\",\"action\":\"139\",\"name\":\"View Contract Template\",\"uid\":\"132\"},{\"id_application_action\":\"140\",\"action\":\"140\",\"name\":\"Create Contract Template\",\"uid\":\"133\"},{\"id_application_action\":\"141\",\"action\":\"141\",\"name\":\"Edit Contract Template\",\"uid\":\"134\"},{\"id_application_action\":\"142\",\"action\":\"142\",\"name\":\"Delete Contract Template\",\"uid\":\"135\"},{\"id_application_action\":\"143\",\"action\":\"143\",\"name\":\"Save\\/Edit Contract Template\",\"uid\":\"136\"},{\"id_application_action\":\"144\",\"action\":\"144\",\"name\":\"View Work Schedule\",\"uid\":\"137\"},{\"id_application_action\":\"145\",\"action\":\"145\",\"name\":\"Create Work Schedule\",\"uid\":\"138\"},{\"id_application_action\":\"146\",\"action\":\"146\",\"name\":\"Edit Work Schedule\",\"uid\":\"139\"},{\"id_application_action\":\"147\",\"action\":\"147\",\"name\":\"Delete Work Schedule\",\"uid\":\"140\"},{\"id_application_action\":\"148\",\"action\":\"148\",\"name\":\"Save\\/Edit Work Schedule\",\"uid\":\"141\"},{\"id_application_action\":\"149\",\"action\":\"149\",\"name\":\"View SO Assignment\",\"uid\":\"142\"},{\"id_application_action\":\"150\",\"action\":\"150\",\"name\":\"Create SO Assignment\",\"uid\":\"143\"},{\"id_application_action\":\"151\",\"action\":\"151\",\"name\":\"Edit SO Assignment\",\"uid\":\"144\"},{\"id_application_action\":\"152\",\"action\":\"152\",\"name\":\"Delete SO Assignment\",\"uid\":\"145\"},{\"id_application_action\":\"153\",\"action\":\"153\",\"name\":\"Save\\/Edit SO Assignment\",\"uid\":\"146\"},{\"id_application_action\":\"154\",\"action\":\"154\",\"name\":\"View Shift Change\",\"uid\":\"147\"},{\"id_application_action\":\"155\",\"action\":\"155\",\"name\":\"Create Shift Change\",\"uid\":\"148\"},{\"id_application_action\":\"156\",\"action\":\"156\",\"name\":\"Edit Shift Change\",\"uid\":\"149\"},{\"id_application_action\":\"157\",\"action\":\"157\",\"name\":\"Delete Shift Change\",\"uid\":\"150\"},{\"id_application_action\":\"158\",\"action\":\"158\",\"name\":\"Save\\/Edit Shift Change\",\"uid\":\"151\"},{\"id_application_action\":\"159\",\"action\":\"159\",\"name\":\"View Leave Application\",\"uid\":\"152\"},{\"id_application_action\":\"160\",\"action\":\"160\",\"name\":\"Create Leave Application\",\"uid\":\"153\"},{\"id_application_action\":\"161\",\"action\":\"161\",\"name\":\"Edit Leave Application\",\"uid\":\"154\"},{\"id_application_action\":\"162\",\"action\":\"162\",\"name\":\"Delete Leave Application\",\"uid\":\"155\"},{\"id_application_action\":\"163\",\"action\":\"163\",\"name\":\"Save\\/Edit Leave Application\",\"uid\":\"156\"},{\"id_application_action\":\"164\",\"action\":\"164\",\"name\":\"View Timesheet (Recap)\",\"uid\":\"157\"},{\"id_application_action\":\"165\",\"action\":\"165\",\"name\":\"Create Timesheet (Recap)\",\"uid\":\"158\"},{\"id_application_action\":\"166\",\"action\":\"166\",\"name\":\"Edit Timesheet (Recap)\",\"uid\":\"159\"},{\"id_application_action\":\"167\",\"action\":\"167\",\"name\":\"Delete Timesheet (Recap)\",\"uid\":\"160\"},{\"id_application_action\":\"168\",\"action\":\"168\",\"name\":\"Save\\/Edit Timesheet (Recap)\",\"uid\":\"161\"},{\"id_application_action\":\"169\",\"action\":\"169\",\"name\":\"View SO Timesheet\",\"uid\":\"162\"},{\"id_application_action\":\"170\",\"action\":\"170\",\"name\":\"Create SO Timesheet\",\"uid\":\"163\"},{\"id_application_action\":\"171\",\"action\":\"171\",\"name\":\"Edit SO Timesheet\",\"uid\":\"164\"},{\"id_application_action\":\"172\",\"action\":\"172\",\"name\":\"Delete SO Timesheet\",\"uid\":\"165\"},{\"id_application_action\":\"173\",\"action\":\"173\",\"name\":\"Save\\/Edit SO Timesheet\",\"uid\":\"166\"},{\"id_application_action\":\"174\",\"action\":\"174\",\"name\":\"View Incident Report\",\"uid\":\"167\"},{\"id_application_action\":\"175\",\"action\":\"175\",\"name\":\"Create Incident Report\",\"uid\":\"168\"},{\"id_application_action\":\"176\",\"action\":\"176\",\"name\":\"Edit Incident Report\",\"uid\":\"169\"},{\"id_application_action\":\"177\",\"action\":\"177\",\"name\":\"Delete Incident Report\",\"uid\":\"170\"},{\"id_application_action\":\"178\",\"action\":\"178\",\"name\":\"Save\\/Edit Incident Report\",\"uid\":\"171\"},{\"id_application_action\":\"179\",\"action\":\"179\",\"name\":\"View Payroll\",\"uid\":\"172\"},{\"id_application_action\":\"180\",\"action\":\"180\",\"name\":\"Create Payroll\",\"uid\":\"173\"},{\"id_application_action\":\"181\",\"action\":\"181\",\"name\":\"Edit Payroll\",\"uid\":\"174\"},{\"id_application_action\":\"182\",\"action\":\"182\",\"name\":\"Delete Payroll\",\"uid\":\"175\"},{\"id_application_action\":\"183\",\"action\":\"183\",\"name\":\"Save\\/Edit Payroll\",\"uid\":\"176\"},{\"id_application_action\":\"184\",\"action\":\"184\",\"name\":\"View Supplier Invoice\",\"uid\":\"177\"},{\"id_application_action\":\"185\",\"action\":\"185\",\"name\":\"Create Supplier Invoice\",\"uid\":\"178\"},{\"id_application_action\":\"186\",\"action\":\"186\",\"name\":\"Edit Supplier Invoice\",\"uid\":\"179\"},{\"id_application_action\":\"187\",\"action\":\"187\",\"name\":\"Delete Supplier Invoice\",\"uid\":\"180\"},{\"id_application_action\":\"188\",\"action\":\"188\",\"name\":\"Save\\/Edit Supplier Invoice\",\"uid\":\"181\"},{\"id_application_action\":\"189\",\"action\":\"189\",\"name\":\"View Customer Invoice\",\"uid\":\"182\"},{\"id_application_action\":\"190\",\"action\":\"190\",\"name\":\"Create Customer Invoice\",\"uid\":\"183\"},{\"id_application_action\":\"191\",\"action\":\"191\",\"name\":\"Edit Customer Invoice\",\"uid\":\"184\"},{\"id_application_action\":\"192\",\"action\":\"192\",\"name\":\"Delete Customer Invoice\",\"uid\":\"185\"},{\"id_application_action\":\"193\",\"action\":\"193\",\"name\":\"Save\\/Edit Customer Invoice\",\"uid\":\"186\"},{\"id_application_action\":\"194\",\"action\":\"194\",\"name\":\"View Bank Statement\",\"uid\":\"187\"},{\"id_application_action\":\"195\",\"action\":\"195\",\"name\":\"Create Bank Statement\",\"uid\":\"188\"},{\"id_application_action\":\"196\",\"action\":\"196\",\"name\":\"Edit Bank Statement\",\"uid\":\"189\"},{\"id_application_action\":\"197\",\"action\":\"197\",\"name\":\"Delete Bank Statement\",\"uid\":\"190\"},{\"id_application_action\":\"198\",\"action\":\"198\",\"name\":\"Save\\/Edit Bank Statement\",\"uid\":\"191\"},{\"id_application_action\":\"199\",\"action\":\"199\",\"name\":\"View Cash Register\",\"uid\":\"192\"},{\"id_application_action\":\"200\",\"action\":\"200\",\"name\":\"Create Cash Register\",\"uid\":\"193\"},{\"id_application_action\":\"201\",\"action\":\"201\",\"name\":\"Edit Cash Register\",\"uid\":\"194\"},{\"id_application_action\":\"202\",\"action\":\"202\",\"name\":\"Delete Cash Register\",\"uid\":\"195\"},{\"id_application_action\":\"203\",\"action\":\"203\",\"name\":\"Save\\/Edit Cash Register\",\"uid\":\"196\"},{\"id_application_action\":\"204\",\"action\":\"204\",\"name\":\"View Tax\",\"uid\":\"197\"},{\"id_application_action\":\"205\",\"action\":\"205\",\"name\":\"Create Tax\",\"uid\":\"198\"},{\"id_application_action\":\"206\",\"action\":\"206\",\"name\":\"Edit Tax\",\"uid\":\"199\"},{\"id_application_action\":\"207\",\"action\":\"207\",\"name\":\"Delete Tax\",\"uid\":\"200\"},{\"id_application_action\":\"208\",\"action\":\"208\",\"name\":\"Save\\/Edit Tax\",\"uid\":\"201\"},{\"id_application_action\":\"209\",\"action\":\"209\",\"name\":\"View Chart of Account\",\"uid\":\"202\"},{\"id_application_action\":\"210\",\"action\":\"210\",\"name\":\"Create Chart of Account\",\"uid\":\"203\"},{\"id_application_action\":\"211\",\"action\":\"211\",\"name\":\"Edit Chart of Account\",\"uid\":\"204\"},{\"id_application_action\":\"212\",\"action\":\"212\",\"name\":\"Delete Chart of Account\",\"uid\":\"205\"},{\"id_application_action\":\"213\",\"action\":\"213\",\"name\":\"Save\\/Edit Chart of Account\",\"uid\":\"206\"},{\"id_application_action\":\"214\",\"action\":\"214\",\"name\":\"View Employee Salary\",\"uid\":\"207\"},{\"id_application_action\":\"215\",\"action\":\"215\",\"name\":\"Create Employee Salary\",\"uid\":\"208\"},{\"id_application_action\":\"216\",\"action\":\"216\",\"name\":\"Edit Employee Salary\",\"uid\":\"209\"},{\"id_application_action\":\"217\",\"action\":\"217\",\"name\":\"Delete Employee Salary\",\"uid\":\"210\"},{\"id_application_action\":\"218\",\"action\":\"218\",\"name\":\"Save\\/Edit Employee Salary\",\"uid\":\"211\"},{\"id_application_action\":\"219\",\"action\":\"219\",\"name\":\"View Salary Setting\",\"uid\":\"212\"},{\"id_application_action\":\"220\",\"action\":\"220\",\"name\":\"Create Salary Setting\",\"uid\":\"213\"},{\"id_application_action\":\"221\",\"action\":\"221\",\"name\":\"Edit Salary Setting\",\"uid\":\"214\"},{\"id_application_action\":\"222\",\"action\":\"222\",\"name\":\"Delete Salary Setting\",\"uid\":\"215\"},{\"id_application_action\":\"223\",\"action\":\"223\",\"name\":\"Save\\/Edit Salary Setting\",\"uid\":\"216\"},{\"id_application_action\":\"224\",\"action\":\"224\",\"name\":\"View Database Interface\",\"uid\":\"217\"},{\"id_application_action\":\"225\",\"action\":\"225\",\"name\":\"Pick Assessment Template\",\"uid\":\"218\"},{\"id_application_action\":\"226\",\"action\":\"226\",\"name\":\"View Organisation Structure\",\"uid\":\"219\"},{\"id_application_action\":\"227\",\"action\":\"227\",\"name\":\"Create Organisation Structure\",\"uid\":\"220\"},{\"id_application_action\":\"228\",\"action\":\"228\",\"name\":\"Edit Organisation Structure\",\"uid\":\"221\"},{\"id_application_action\":\"229\",\"action\":\"229\",\"name\":\"Delete Organisation Structure\",\"uid\":\"222\"},{\"id_application_action\":\"230\",\"action\":\"230\",\"name\":\"Save\\/Edit Organisation Structure\",\"uid\":\"223\"},{\"id_application_action\":\"231\",\"action\":\"231\",\"name\":\"View Position Level\",\"uid\":\"224\"},{\"id_application_action\":\"232\",\"action\":\"232\",\"name\":\"Create Position Level\",\"uid\":\"225\"},{\"id_application_action\":\"233\",\"action\":\"233\",\"name\":\"Edit Position Level\",\"uid\":\"226\"},{\"id_application_action\":\"234\",\"action\":\"234\",\"name\":\"Delete Position Level\",\"uid\":\"227\"},{\"id_application_action\":\"235\",\"action\":\"235\",\"name\":\"Save\\/Edit Position Level\",\"uid\":\"228\"},{\"id_application_action\":\"236\",\"action\":\"236\",\"name\":\"View Employee Contract Type\",\"uid\":\"229\"},{\"id_application_action\":\"237\",\"action\":\"237\",\"name\":\"Create Employee Contract Type\",\"uid\":\"230\"},{\"id_application_action\":\"238\",\"action\":\"238\",\"name\":\"Edit Employee Contract Type\",\"uid\":\"231\"},{\"id_application_action\":\"239\",\"action\":\"239\",\"name\":\"Delete Employee Contract Type\",\"uid\":\"232\"},{\"id_application_action\":\"240\",\"action\":\"240\",\"name\":\"Save\\/Edit Employee Contract\",\"uid\":\"233\"},{\"id_application_action\":\"241\",\"action\":\"241\",\"name\":\"View Bank\",\"uid\":\"234\"},{\"id_application_action\":\"242\",\"action\":\"242\",\"name\":\"Create Bank\",\"uid\":\"235\"},{\"id_application_action\":\"243\",\"action\":\"243\",\"name\":\"Edit Bank\",\"uid\":\"236\"},{\"id_application_action\":\"244\",\"action\":\"244\",\"name\":\"Delete Bank\",\"uid\":\"237\"},{\"id_application_action\":\"245\",\"action\":\"245\",\"name\":\"Save\\/Edit Bank\",\"uid\":\"238\"},{\"id_application_action\":\"246\",\"action\":\"246\",\"name\":\"View Payment Receipt\",\"uid\":\"239\"},{\"id_application_action\":\"247\",\"action\":\"247\",\"name\":\"Create Payment Receipt\",\"uid\":\"240\"},{\"id_application_action\":\"248\",\"action\":\"248\",\"name\":\"Edit Payment Receipt\",\"uid\":\"241\"},{\"id_application_action\":\"249\",\"action\":\"249\",\"name\":\"Save\\/Edit Payment Receipt\",\"uid\":\"242\"},{\"id_application_action\":\"250\",\"action\":\"250\",\"name\":\"Delete Payment Receipt\",\"uid\":\"243\"},{\"id_application_action\":\"251\",\"action\":\"251\",\"name\":\"Receive Payment From PO\",\"uid\":\"244\"},{\"id_application_action\":\"252\",\"action\":\"252\",\"name\":\"Make Payment Receipt\",\"uid\":\"245\"},{\"id_application_action\":\"253\",\"action\":\"253\",\"name\":\"Cancel Payment Receipt\",\"uid\":\"246\"},{\"id_application_action\":\"254\",\"action\":\"254\",\"name\":\"View Stock Transaction\",\"uid\":\"247\"},{\"id_application_action\":\"255\",\"action\":\"255\",\"name\":\"Create Stock Transaction\",\"uid\":\"248\"},{\"id_application_action\":\"256\",\"action\":\"256\",\"name\":\"Edit Stock Transaction\",\"uid\":\"249\"},{\"id_application_action\":\"257\",\"action\":\"257\",\"name\":\"Delete Stock Transaction\",\"uid\":\"250\"},{\"id_application_action\":\"258\",\"action\":\"258\",\"name\":\"Save\\/Edit Stock Transaction\",\"uid\":\"251\"},{\"id_application_action\":\"259\",\"action\":\"259\",\"name\":\"Post Stock Transaction\",\"uid\":\"252\"},{\"id_application_action\":\"260\",\"action\":\"260\",\"name\":\"Unpost Stock Transaction\",\"uid\":\"253\"},{\"id_application_action\":\"261\",\"action\":\"261\",\"name\":\"Transfer Good Receive\",\"uid\":\"254\"},{\"id_application_action\":\"262\",\"action\":\"262\",\"name\":\"View Activity\",\"uid\":\"255\"},{\"id_application_action\":\"263\",\"action\":\"263\",\"name\":\"Make Working Schedule\",\"uid\":\"256\"},{\"id_application_action\":\"264\",\"action\":\"264\",\"name\":\"Validate Inquiry\",\"uid\":\"257\"},{\"id_application_action\":\"265\",\"action\":\"265\",\"name\":\"Validate Quotation\",\"uid\":\"258\"},{\"id_application_action\":\"267\",\"action\":\"267\",\"name\":\"Confirm Sales Order\",\"uid\":\"259\"},{\"id_application_action\":\"266\",\"name\":\"Validate Sales Order\",\"uid\":\"260\",\"id\":\"260\"},{\"id_application_action\":\"268\",\"name\":\"View Fingerprint Device\",\"uid\":\"261\",\"id\":\"261\"},{\"id_application_action\":\"269\",\"name\":\"Create Fingerprint Device\",\"uid\":\"262\",\"id\":\"262\"},{\"id_application_action\":\"270\",\"name\":\"Edit Fingerprint Device\",\"uid\":\"263\",\"id\":\"263\"},{\"id_application_action\":\"271\",\"name\":\"Delete Fingerprint Device\",\"uid\":\"264\",\"id\":\"264\"},{\"id_application_action\":\"272\",\"name\":\"Save\\/Edit Fingerprint Device\",\"uid\":\"265\",\"id\":\"265\"},{\"id_application_action\":\"273\",\"name\":\"Activate Fingerprint\",\"uid\":\"266\",\"id\":\"266\"},{\"id_application_action\":\"274\",\"name\":\"Deactivate Fingerprint\",\"uid\":\"267\",\"id\":\"267\"},{\"id_application_action\":\"275\",\"name\":\"View Fingerprint Assign\",\"uid\":\"268\",\"id\":\"268\"},{\"id_application_action\":\"276\",\"name\":\"Create Fingerprint Assign\",\"uid\":\"269\",\"id\":\"269\"},{\"id_application_action\":\"277\",\"name\":\"Edit Fingerprint Assign\",\"uid\":\"270\",\"id\":\"270\"},{\"id_application_action\":\"278\",\"name\":\"Delete Fingerprint Assign\",\"uid\":\"271\",\"id\":\"271\"},{\"id_application_action\":\"279\",\"name\":\"Save\\/Edit Fingerprint Assign\",\"uid\":\"272\",\"id\":\"272\"},{\"id_application_action\":\"280\",\"name\":\"Make SO Assignment\",\"uid\":\"273\",\"id\":\"273\"}],\"is_edit\":\"true\",\"id_role\":\"1\"}', '2015-03-18 09:35:51');
INSERT INTO `activity_log` VALUES ('171', 'Save/Edit Inquiry', 'inquiry', null, '2', 'Save/Edit Inquiry', '113', '{}', '2015-03-18 09:36:26');
INSERT INTO `activity_log` VALUES ('172', 'Validate Inquiry', 'inquiry', null, '2', 'Validate Inquiry', '264', '{\"id_inquiry\":\"3\",\"status\":\"open\"}', '2015-03-18 09:36:33');
INSERT INTO `activity_log` VALUES ('173', 'Save/Edit Quotation', 'quotation', null, '2', 'Save/Edit Quotation', '123', '{}', '2015-03-18 09:37:22');
INSERT INTO `activity_log` VALUES ('174', 'Validate Quotation', 'quotation', null, '2', 'Validate Quotation', '265', '{\"id_quotation\":\"2\",\"status\":\"open\"}', '2015-03-18 09:37:30');
INSERT INTO `activity_log` VALUES ('175', 'Make Working Schedule', 'quotation', null, '2', 'Make Working Schedule', '263', '{}', '2015-03-18 09:38:58');
INSERT INTO `activity_log` VALUES ('176', 'Save/Edit Work Schedule', 'work_schedule', null, '2', 'Save/Edit Work Schedule', '148', '{}', '2015-03-18 09:39:32');
INSERT INTO `activity_log` VALUES ('177', 'Validate Quotation', 'quotation', null, '2', 'Validate Quotation', '265', '{\"id_quotation\":\"2\",\"status\":\"open\"}', '2015-03-18 09:39:50');
INSERT INTO `activity_log` VALUES ('178', 'Save Sales Order', 'so', null, '2', 'Save Sales Order', '76', '{}', '2015-03-18 09:41:43');
INSERT INTO `activity_log` VALUES ('179', 'Validate Sales Order', 'so', null, '2', 'Validate Sales Order', '266', '{\"id_so\":\"1\",\"status\":\"open\"}', '2015-03-18 09:41:55');
INSERT INTO `activity_log` VALUES ('180', 'Confirm Sales Order', 'so', null, '2', 'Confirm Sales Order', '267', '{\"id_so\":\"1\",\"id_work_order\":1,\"status\":\"close\"}', '2015-03-18 09:42:02');
INSERT INTO `activity_log` VALUES ('181', 'Make SO Assignment', 'work_order', null, '2', 'Make SO Assignment', '280', '{}', '2015-03-18 09:42:13');
INSERT INTO `activity_log` VALUES ('182', 'Make SO Assignment', 'work_order', null, '2', 'Make SO Assignment', '280', '{}', '2015-03-18 19:43:33');
INSERT INTO `activity_log` VALUES ('183', 'Make SO Assignment', 'work_order', null, '2', 'Make SO Assignment', '280', '{}', '2015-03-18 19:51:11');
INSERT INTO `activity_log` VALUES ('184', 'Make SO Assignment', 'work_order', null, '2', 'Make SO Assignment', '280', '{}', '2015-03-18 19:51:32');
INSERT INTO `activity_log` VALUES ('185', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"Save\\/Edit Fingerprint Assign\",\"uname\":\"save_edit_fingerprint_assign\",\"controller\":\"fingerprint_assign\",\"function_exec\":\"save_fingerprint_assign\",\"function_args\":\"\",\"view_type\":\"no_view\",\"view_file\":\"\",\"prefix\":\"\",\"action_type\":\"create\",\"action_button\":\"no_button\",\"target_action\":\"275\",\"action_condition\":[{\"identifier\":\"assign_fingerprint\",\"target_action\":\"281\",\"target_action_name\":\"Assign Fingerprint Device\",\"uid\":\"0\"}],\"use_log\":\"1\",\"is_edit\":\"true\",\"id_edit\":\"279\"}', '2015-03-20 12:28:58');
INSERT INTO `activity_log` VALUES ('186', 'Save/Edit Role', 'role', null, '2', 'Save/Edit Role', '20', '{\"name\":\"administrator\",\"action_detail\":[{\"id_application_action\":\"1\",\"action\":\"1\",\"name\":\"View Application Action\",\"uid\":\"0\"},{\"id_application_action\":\"2\",\"action\":\"2\",\"name\":\"Create Application Action\",\"uid\":\"1\"},{\"id_application_action\":\"3\",\"action\":\"3\",\"name\":\"Edit Application Action\",\"uid\":\"2\"},{\"id_application_action\":\"4\",\"action\":\"4\",\"name\":\"Delete Application Action\",\"uid\":\"3\"},{\"id_application_action\":\"5\",\"action\":\"5\",\"name\":\"View Side Menu\",\"uid\":\"4\"},{\"id_application_action\":\"6\",\"action\":\"6\",\"name\":\"Create Side Menu\",\"uid\":\"5\"},{\"id_application_action\":\"7\",\"action\":\"7\",\"name\":\"Edit Side Menu\",\"uid\":\"6\"},{\"id_application_action\":\"8\",\"action\":\"8\",\"name\":\"Delete Side Menu\",\"uid\":\"7\"},{\"id_application_action\":\"9\",\"action\":\"9\",\"name\":\"Save\\/Edit Side Menu\",\"uid\":\"8\"},{\"id_application_action\":\"10\",\"action\":\"10\",\"name\":\"Save\\/Edit Action\",\"uid\":\"9\"},{\"id_application_action\":\"11\",\"action\":\"11\",\"name\":\"View Division\",\"uid\":\"10\"},{\"id_application_action\":\"12\",\"action\":\"12\",\"name\":\"Create Division\",\"uid\":\"11\"},{\"id_application_action\":\"13\",\"action\":\"13\",\"name\":\"Save\\/Edit Division\",\"uid\":\"12\"},{\"id_application_action\":\"14\",\"action\":\"14\",\"name\":\"Edit Division\",\"uid\":\"13\"},{\"id_application_action\":\"15\",\"action\":\"15\",\"name\":\"Delete Division\",\"uid\":\"14\"},{\"id_application_action\":\"16\",\"action\":\"16\",\"name\":\"View Role\",\"uid\":\"15\"},{\"id_application_action\":\"17\",\"action\":\"17\",\"name\":\"View Create Role\",\"uid\":\"16\"},{\"id_application_action\":\"18\",\"action\":\"18\",\"name\":\"View Edit Role\",\"uid\":\"17\"},{\"id_application_action\":\"19\",\"action\":\"19\",\"name\":\"Delete Role\",\"uid\":\"18\"},{\"id_application_action\":\"20\",\"action\":\"20\",\"name\":\"Save\\/Edit Role\",\"uid\":\"19\"},{\"id_application_action\":\"21\",\"action\":\"21\",\"name\":\"View Product\",\"uid\":\"20\"},{\"id_application_action\":\"22\",\"action\":\"22\",\"name\":\"Create Product\",\"uid\":\"21\"},{\"id_application_action\":\"23\",\"action\":\"23\",\"name\":\"Edit Product\",\"uid\":\"22\"},{\"id_application_action\":\"24\",\"action\":\"24\",\"name\":\"Delete Product\",\"uid\":\"23\"},{\"id_application_action\":\"25\",\"action\":\"25\",\"name\":\"Save\\/Edit Product\",\"uid\":\"24\"},{\"id_application_action\":\"26\",\"action\":\"26\",\"name\":\"View Supplier\",\"uid\":\"25\"},{\"id_application_action\":\"27\",\"action\":\"27\",\"name\":\"Create Supplier\",\"uid\":\"26\"},{\"id_application_action\":\"28\",\"action\":\"28\",\"name\":\"Edit Supplier\",\"uid\":\"27\"},{\"id_application_action\":\"29\",\"action\":\"29\",\"name\":\"Delete Supplier\",\"uid\":\"28\"},{\"id_application_action\":\"30\",\"action\":\"30\",\"name\":\"Save\\/Edit Supplier\",\"uid\":\"29\"},{\"id_application_action\":\"31\",\"action\":\"31\",\"name\":\"View Product Category\",\"uid\":\"30\"},{\"id_application_action\":\"32\",\"action\":\"32\",\"name\":\"Create Product Category\",\"uid\":\"31\"},{\"id_application_action\":\"33\",\"action\":\"33\",\"name\":\"Edit Product Category\",\"uid\":\"32\"},{\"id_application_action\":\"34\",\"action\":\"34\",\"name\":\"Delete Product Category\",\"uid\":\"33\"},{\"id_application_action\":\"35\",\"action\":\"35\",\"name\":\"Save\\/Edit Product Category\",\"uid\":\"34\"},{\"id_application_action\":\"36\",\"action\":\"36\",\"name\":\"View Merk\",\"uid\":\"35\"},{\"id_application_action\":\"37\",\"action\":\"37\",\"name\":\"Create Merk\",\"uid\":\"36\"},{\"id_application_action\":\"38\",\"action\":\"38\",\"name\":\"Edit Merk\",\"uid\":\"37\"},{\"id_application_action\":\"39\",\"action\":\"39\",\"name\":\"Delete Merk\",\"uid\":\"38\"},{\"id_application_action\":\"40\",\"action\":\"40\",\"name\":\"Save\\/Edit Merk\",\"uid\":\"39\"},{\"id_application_action\":\"41\",\"action\":\"41\",\"name\":\"View Customer\",\"uid\":\"40\"},{\"id_application_action\":\"43\",\"action\":\"43\",\"name\":\"Create Customer\",\"uid\":\"41\"},{\"id_application_action\":\"44\",\"action\":\"44\",\"name\":\"Edit Customer\",\"uid\":\"42\"},{\"id_application_action\":\"45\",\"action\":\"45\",\"name\":\"Delete Customer\",\"uid\":\"43\"},{\"id_application_action\":\"46\",\"action\":\"46\",\"name\":\"Save\\/Edit Customer\",\"uid\":\"44\"},{\"id_application_action\":\"47\",\"action\":\"47\",\"name\":\"View Warehouse\",\"uid\":\"45\"},{\"id_application_action\":\"48\",\"action\":\"48\",\"name\":\"Create Warehouse\",\"uid\":\"46\"},{\"id_application_action\":\"49\",\"action\":\"49\",\"name\":\"Edit Warehouse\",\"uid\":\"47\"},{\"id_application_action\":\"50\",\"action\":\"50\",\"name\":\"Delete Warehouse\",\"uid\":\"48\"},{\"id_application_action\":\"51\",\"action\":\"51\",\"name\":\"Save\\/Edit Warehouse\",\"uid\":\"49\"},{\"id_application_action\":\"57\",\"action\":\"57\",\"name\":\"View PO\",\"uid\":\"50\"},{\"id_application_action\":\"58\",\"action\":\"58\",\"name\":\"Create PO\",\"uid\":\"51\"},{\"id_application_action\":\"59\",\"action\":\"59\",\"name\":\"Edit PO\",\"uid\":\"52\"},{\"id_application_action\":\"60\",\"action\":\"60\",\"name\":\"Delete PO\",\"uid\":\"53\"},{\"id_application_action\":\"61\",\"action\":\"61\",\"name\":\"Save\\/Edit PO\",\"uid\":\"54\"},{\"id_application_action\":\"62\",\"action\":\"62\",\"name\":\"View User\",\"uid\":\"55\"},{\"id_application_action\":\"63\",\"action\":\"63\",\"name\":\"Create User\",\"uid\":\"56\"},{\"id_application_action\":\"64\",\"action\":\"64\",\"name\":\"Edit User\",\"uid\":\"57\"},{\"id_application_action\":\"65\",\"action\":\"65\",\"name\":\"Delete User\",\"uid\":\"58\"},{\"id_application_action\":\"66\",\"action\":\"66\",\"name\":\"Save\\/Edit User\",\"uid\":\"59\"},{\"id_application_action\":\"67\",\"action\":\"67\",\"name\":\"View Good Receive\",\"uid\":\"60\"},{\"id_application_action\":\"68\",\"action\":\"68\",\"name\":\"Create Good Receive\",\"uid\":\"61\"},{\"id_application_action\":\"69\",\"action\":\"69\",\"name\":\"Edit Good Receive\",\"uid\":\"62\"},{\"id_application_action\":\"70\",\"action\":\"70\",\"name\":\"Delete Good Receive\",\"uid\":\"63\"},{\"id_application_action\":\"71\",\"action\":\"71\",\"name\":\"Save\\/Edit Good Receive\",\"uid\":\"64\"},{\"id_application_action\":\"72\",\"action\":\"72\",\"name\":\"View Sales Order\",\"uid\":\"65\"},{\"id_application_action\":\"73\",\"action\":\"73\",\"name\":\"Create Sales Order\",\"uid\":\"66\"},{\"id_application_action\":\"74\",\"action\":\"74\",\"name\":\"Edit Sales Order\",\"uid\":\"67\"},{\"id_application_action\":\"75\",\"action\":\"75\",\"name\":\"Delete Sales Order\",\"uid\":\"68\"},{\"id_application_action\":\"76\",\"action\":\"76\",\"name\":\"Save Sales Order\",\"uid\":\"69\"},{\"id_application_action\":\"77\",\"action\":\"77\",\"name\":\"View Material Request\",\"uid\":\"70\"},{\"id_application_action\":\"78\",\"action\":\"78\",\"name\":\"Create Material Request\",\"uid\":\"71\"},{\"id_application_action\":\"79\",\"action\":\"79\",\"name\":\"Edit Material Request\",\"uid\":\"72\"},{\"id_application_action\":\"80\",\"action\":\"80\",\"name\":\"Delete Material Request\",\"uid\":\"73\"},{\"id_application_action\":\"81\",\"action\":\"81\",\"name\":\"Save Material Request\",\"uid\":\"74\"},{\"id_application_action\":\"82\",\"action\":\"82\",\"name\":\"Change User Password\",\"uid\":\"75\"},{\"id_application_action\":\"83\",\"action\":\"83\",\"name\":\"View Delivery Note\",\"uid\":\"76\"},{\"id_application_action\":\"84\",\"action\":\"84\",\"name\":\"Create Delivery Note\",\"uid\":\"77\"},{\"id_application_action\":\"85\",\"action\":\"85\",\"name\":\"Edit Delivery Note\",\"uid\":\"78\"},{\"id_application_action\":\"86\",\"action\":\"86\",\"name\":\"Delete Delivery Note\",\"uid\":\"79\"},{\"id_application_action\":\"87\",\"action\":\"87\",\"name\":\"Save\\/Edit Delivery Note\",\"uid\":\"80\"},{\"id_application_action\":\"88\",\"action\":\"88\",\"name\":\"View Unit Measure\",\"uid\":\"81\"},{\"id_application_action\":\"89\",\"action\":\"89\",\"name\":\"Create Unit Measure\",\"uid\":\"82\"},{\"id_application_action\":\"90\",\"action\":\"90\",\"name\":\"Edit Unit Measure\",\"uid\":\"83\"},{\"id_application_action\":\"91\",\"action\":\"91\",\"name\":\"Delete Unit Measure\",\"uid\":\"84\"},{\"id_application_action\":\"92\",\"action\":\"92\",\"name\":\"Save\\/Edit Unit Measure\",\"uid\":\"85\"},{\"id_application_action\":\"93\",\"action\":\"93\",\"name\":\"View Stock\",\"uid\":\"86\"},{\"id_application_action\":\"94\",\"action\":\"94\",\"name\":\"View Employee\",\"uid\":\"87\"},{\"id_application_action\":\"95\",\"action\":\"95\",\"name\":\"Create Employee\",\"uid\":\"88\"},{\"id_application_action\":\"96\",\"action\":\"96\",\"name\":\"Edit Employee\",\"uid\":\"89\"},{\"id_application_action\":\"97\",\"action\":\"97\",\"name\":\"Delete Employee\",\"uid\":\"90\"},{\"id_application_action\":\"98\",\"action\":\"98\",\"name\":\"Save\\/Edit Employee\",\"uid\":\"91\"},{\"id_application_action\":\"99\",\"action\":\"99\",\"name\":\"Validate PO\",\"uid\":\"92\"},{\"id_application_action\":\"100\",\"action\":\"100\",\"name\":\"Create Database Interface\",\"uid\":\"93\"},{\"id_application_action\":\"101\",\"action\":\"101\",\"name\":\"Edit Database Interface\",\"uid\":\"94\"},{\"id_application_action\":\"102\",\"action\":\"102\",\"name\":\"Delete Database Interface\",\"uid\":\"95\"},{\"id_application_action\":\"103\",\"action\":\"103\",\"name\":\"Save \\/ Edit Database Interface\",\"uid\":\"96\"},{\"id_application_action\":\"104\",\"action\":\"104\",\"name\":\"View Database Field Interface\",\"uid\":\"97\"},{\"id_application_action\":\"105\",\"action\":\"105\",\"name\":\"Create Database Field Interface\",\"uid\":\"98\"},{\"id_application_action\":\"106\",\"action\":\"106\",\"name\":\"Edit Database Field Interface\",\"uid\":\"99\"},{\"id_application_action\":\"107\",\"action\":\"107\",\"name\":\"Delete Database Field Interface\",\"uid\":\"100\"},{\"id_application_action\":\"108\",\"action\":\"108\",\"name\":\"Save \\/ Edit Database Field Interface\",\"uid\":\"101\"},{\"id_application_action\":\"109\",\"action\":\"109\",\"name\":\"View Inquiry\",\"uid\":\"102\"},{\"id_application_action\":\"110\",\"action\":\"110\",\"name\":\"Create Inquiry\",\"uid\":\"103\"},{\"id_application_action\":\"111\",\"action\":\"111\",\"name\":\"Edit Inquiry\",\"uid\":\"104\"},{\"id_application_action\":\"112\",\"action\":\"112\",\"name\":\"Delete Inquiry\",\"uid\":\"105\"},{\"id_application_action\":\"113\",\"action\":\"113\",\"name\":\"Save\\/Edit Inquiry\",\"uid\":\"106\"},{\"id_application_action\":\"114\",\"action\":\"114\",\"name\":\"View Survey \\/ Assessment\",\"uid\":\"107\"},{\"id_application_action\":\"115\",\"action\":\"115\",\"name\":\"Create Survey \\/ Assessment\",\"uid\":\"108\"},{\"id_application_action\":\"116\",\"action\":\"116\",\"name\":\"Edit Survey \\/ Assessment\",\"uid\":\"109\"},{\"id_application_action\":\"117\",\"action\":\"117\",\"name\":\"Delete Survey \\/ Assessment\",\"uid\":\"110\"},{\"id_application_action\":\"118\",\"action\":\"118\",\"name\":\"Save\\/Edit Survey \\/ Assessment\",\"uid\":\"111\"},{\"id_application_action\":\"119\",\"action\":\"119\",\"name\":\"View Quotation\",\"uid\":\"112\"},{\"id_application_action\":\"120\",\"action\":\"120\",\"name\":\"Create Quotation\",\"uid\":\"113\"},{\"id_application_action\":\"121\",\"action\":\"121\",\"name\":\"Edit Quotation\",\"uid\":\"114\"},{\"id_application_action\":\"122\",\"action\":\"122\",\"name\":\"Delete Quotation\",\"uid\":\"115\"},{\"id_application_action\":\"123\",\"action\":\"123\",\"name\":\"Save\\/Edit Quotation\",\"uid\":\"116\"},{\"id_application_action\":\"124\",\"action\":\"124\",\"name\":\"View Project Contract\",\"uid\":\"117\"},{\"id_application_action\":\"125\",\"action\":\"125\",\"name\":\"Create Project Contract\",\"uid\":\"118\"},{\"id_application_action\":\"126\",\"action\":\"126\",\"name\":\"Edit Project Contract\",\"uid\":\"119\"},{\"id_application_action\":\"127\",\"action\":\"127\",\"name\":\"Delete Project Contract\",\"uid\":\"120\"},{\"id_application_action\":\"128\",\"action\":\"128\",\"name\":\"Save\\/Edit Project Contract\",\"uid\":\"121\"},{\"id_application_action\":\"129\",\"action\":\"129\",\"name\":\"View Work Order\",\"uid\":\"122\"},{\"id_application_action\":\"130\",\"action\":\"130\",\"name\":\"Create Work Order\",\"uid\":\"123\"},{\"id_application_action\":\"131\",\"action\":\"131\",\"name\":\"Edit Work Order\",\"uid\":\"124\"},{\"id_application_action\":\"132\",\"action\":\"132\",\"name\":\"Delete Work Order\",\"uid\":\"125\"},{\"id_application_action\":\"133\",\"action\":\"133\",\"name\":\"Save\\/Edit Work Order\",\"uid\":\"126\"},{\"id_application_action\":\"134\",\"action\":\"134\",\"name\":\"View Assessment Template\",\"uid\":\"127\"},{\"id_application_action\":\"135\",\"action\":\"135\",\"name\":\"Create Assessment Template\",\"uid\":\"128\"},{\"id_application_action\":\"136\",\"action\":\"136\",\"name\":\"Edit Assessment Template\",\"uid\":\"129\"},{\"id_application_action\":\"137\",\"action\":\"137\",\"name\":\"Delete Assessment Template\",\"uid\":\"130\"},{\"id_application_action\":\"138\",\"action\":\"138\",\"name\":\"Save\\/Edit Assessment Template\",\"uid\":\"131\"},{\"id_application_action\":\"139\",\"action\":\"139\",\"name\":\"View Contract Template\",\"uid\":\"132\"},{\"id_application_action\":\"140\",\"action\":\"140\",\"name\":\"Create Contract Template\",\"uid\":\"133\"},{\"id_application_action\":\"141\",\"action\":\"141\",\"name\":\"Edit Contract Template\",\"uid\":\"134\"},{\"id_application_action\":\"142\",\"action\":\"142\",\"name\":\"Delete Contract Template\",\"uid\":\"135\"},{\"id_application_action\":\"143\",\"action\":\"143\",\"name\":\"Save\\/Edit Contract Template\",\"uid\":\"136\"},{\"id_application_action\":\"144\",\"action\":\"144\",\"name\":\"View Work Schedule\",\"uid\":\"137\"},{\"id_application_action\":\"145\",\"action\":\"145\",\"name\":\"Create Work Schedule\",\"uid\":\"138\"},{\"id_application_action\":\"146\",\"action\":\"146\",\"name\":\"Edit Work Schedule\",\"uid\":\"139\"},{\"id_application_action\":\"147\",\"action\":\"147\",\"name\":\"Delete Work Schedule\",\"uid\":\"140\"},{\"id_application_action\":\"148\",\"action\":\"148\",\"name\":\"Save\\/Edit Work Schedule\",\"uid\":\"141\"},{\"id_application_action\":\"149\",\"action\":\"149\",\"name\":\"View SO Assignment\",\"uid\":\"142\"},{\"id_application_action\":\"150\",\"action\":\"150\",\"name\":\"Create SO Assignment\",\"uid\":\"143\"},{\"id_application_action\":\"151\",\"action\":\"151\",\"name\":\"Edit SO Assignment\",\"uid\":\"144\"},{\"id_application_action\":\"152\",\"action\":\"152\",\"name\":\"Delete SO Assignment\",\"uid\":\"145\"},{\"id_application_action\":\"153\",\"action\":\"153\",\"name\":\"Save\\/Edit SO Assignment\",\"uid\":\"146\"},{\"id_application_action\":\"154\",\"action\":\"154\",\"name\":\"View Shift Change\",\"uid\":\"147\"},{\"id_application_action\":\"155\",\"action\":\"155\",\"name\":\"Create Shift Change\",\"uid\":\"148\"},{\"id_application_action\":\"156\",\"action\":\"156\",\"name\":\"Edit Shift Change\",\"uid\":\"149\"},{\"id_application_action\":\"157\",\"action\":\"157\",\"name\":\"Delete Shift Change\",\"uid\":\"150\"},{\"id_application_action\":\"158\",\"action\":\"158\",\"name\":\"Save\\/Edit Shift Change\",\"uid\":\"151\"},{\"id_application_action\":\"159\",\"action\":\"159\",\"name\":\"View Leave Application\",\"uid\":\"152\"},{\"id_application_action\":\"160\",\"action\":\"160\",\"name\":\"Create Leave Application\",\"uid\":\"153\"},{\"id_application_action\":\"161\",\"action\":\"161\",\"name\":\"Edit Leave Application\",\"uid\":\"154\"},{\"id_application_action\":\"162\",\"action\":\"162\",\"name\":\"Delete Leave Application\",\"uid\":\"155\"},{\"id_application_action\":\"163\",\"action\":\"163\",\"name\":\"Save\\/Edit Leave Application\",\"uid\":\"156\"},{\"id_application_action\":\"164\",\"action\":\"164\",\"name\":\"View Timesheet (Recap)\",\"uid\":\"157\"},{\"id_application_action\":\"165\",\"action\":\"165\",\"name\":\"Create Timesheet (Recap)\",\"uid\":\"158\"},{\"id_application_action\":\"166\",\"action\":\"166\",\"name\":\"Edit Timesheet (Recap)\",\"uid\":\"159\"},{\"id_application_action\":\"167\",\"action\":\"167\",\"name\":\"Delete Timesheet (Recap)\",\"uid\":\"160\"},{\"id_application_action\":\"168\",\"action\":\"168\",\"name\":\"Save\\/Edit Timesheet (Recap)\",\"uid\":\"161\"},{\"id_application_action\":\"169\",\"action\":\"169\",\"name\":\"View SO Timesheet\",\"uid\":\"162\"},{\"id_application_action\":\"170\",\"action\":\"170\",\"name\":\"Create SO Timesheet\",\"uid\":\"163\"},{\"id_application_action\":\"171\",\"action\":\"171\",\"name\":\"Edit SO Timesheet\",\"uid\":\"164\"},{\"id_application_action\":\"172\",\"action\":\"172\",\"name\":\"Delete SO Timesheet\",\"uid\":\"165\"},{\"id_application_action\":\"173\",\"action\":\"173\",\"name\":\"Save\\/Edit SO Timesheet\",\"uid\":\"166\"},{\"id_application_action\":\"174\",\"action\":\"174\",\"name\":\"View Incident Report\",\"uid\":\"167\"},{\"id_application_action\":\"175\",\"action\":\"175\",\"name\":\"Create Incident Report\",\"uid\":\"168\"},{\"id_application_action\":\"176\",\"action\":\"176\",\"name\":\"Edit Incident Report\",\"uid\":\"169\"},{\"id_application_action\":\"177\",\"action\":\"177\",\"name\":\"Delete Incident Report\",\"uid\":\"170\"},{\"id_application_action\":\"178\",\"action\":\"178\",\"name\":\"Save\\/Edit Incident Report\",\"uid\":\"171\"},{\"id_application_action\":\"179\",\"action\":\"179\",\"name\":\"View Payroll\",\"uid\":\"172\"},{\"id_application_action\":\"180\",\"action\":\"180\",\"name\":\"Create Payroll\",\"uid\":\"173\"},{\"id_application_action\":\"181\",\"action\":\"181\",\"name\":\"Edit Payroll\",\"uid\":\"174\"},{\"id_application_action\":\"182\",\"action\":\"182\",\"name\":\"Delete Payroll\",\"uid\":\"175\"},{\"id_application_action\":\"183\",\"action\":\"183\",\"name\":\"Save\\/Edit Payroll\",\"uid\":\"176\"},{\"id_application_action\":\"184\",\"action\":\"184\",\"name\":\"View Supplier Invoice\",\"uid\":\"177\"},{\"id_application_action\":\"185\",\"action\":\"185\",\"name\":\"Create Supplier Invoice\",\"uid\":\"178\"},{\"id_application_action\":\"186\",\"action\":\"186\",\"name\":\"Edit Supplier Invoice\",\"uid\":\"179\"},{\"id_application_action\":\"187\",\"action\":\"187\",\"name\":\"Delete Supplier Invoice\",\"uid\":\"180\"},{\"id_application_action\":\"188\",\"action\":\"188\",\"name\":\"Save\\/Edit Supplier Invoice\",\"uid\":\"181\"},{\"id_application_action\":\"189\",\"action\":\"189\",\"name\":\"View Customer Invoice\",\"uid\":\"182\"},{\"id_application_action\":\"190\",\"action\":\"190\",\"name\":\"Create Customer Invoice\",\"uid\":\"183\"},{\"id_application_action\":\"191\",\"action\":\"191\",\"name\":\"Edit Customer Invoice\",\"uid\":\"184\"},{\"id_application_action\":\"192\",\"action\":\"192\",\"name\":\"Delete Customer Invoice\",\"uid\":\"185\"},{\"id_application_action\":\"193\",\"action\":\"193\",\"name\":\"Save\\/Edit Customer Invoice\",\"uid\":\"186\"},{\"id_application_action\":\"194\",\"action\":\"194\",\"name\":\"View Bank Statement\",\"uid\":\"187\"},{\"id_application_action\":\"195\",\"action\":\"195\",\"name\":\"Create Bank Statement\",\"uid\":\"188\"},{\"id_application_action\":\"196\",\"action\":\"196\",\"name\":\"Edit Bank Statement\",\"uid\":\"189\"},{\"id_application_action\":\"197\",\"action\":\"197\",\"name\":\"Delete Bank Statement\",\"uid\":\"190\"},{\"id_application_action\":\"198\",\"action\":\"198\",\"name\":\"Save\\/Edit Bank Statement\",\"uid\":\"191\"},{\"id_application_action\":\"199\",\"action\":\"199\",\"name\":\"View Cash Register\",\"uid\":\"192\"},{\"id_application_action\":\"200\",\"action\":\"200\",\"name\":\"Create Cash Register\",\"uid\":\"193\"},{\"id_application_action\":\"201\",\"action\":\"201\",\"name\":\"Edit Cash Register\",\"uid\":\"194\"},{\"id_application_action\":\"202\",\"action\":\"202\",\"name\":\"Delete Cash Register\",\"uid\":\"195\"},{\"id_application_action\":\"203\",\"action\":\"203\",\"name\":\"Save\\/Edit Cash Register\",\"uid\":\"196\"},{\"id_application_action\":\"204\",\"action\":\"204\",\"name\":\"View Tax\",\"uid\":\"197\"},{\"id_application_action\":\"205\",\"action\":\"205\",\"name\":\"Create Tax\",\"uid\":\"198\"},{\"id_application_action\":\"206\",\"action\":\"206\",\"name\":\"Edit Tax\",\"uid\":\"199\"},{\"id_application_action\":\"207\",\"action\":\"207\",\"name\":\"Delete Tax\",\"uid\":\"200\"},{\"id_application_action\":\"208\",\"action\":\"208\",\"name\":\"Save\\/Edit Tax\",\"uid\":\"201\"},{\"id_application_action\":\"209\",\"action\":\"209\",\"name\":\"View Chart of Account\",\"uid\":\"202\"},{\"id_application_action\":\"210\",\"action\":\"210\",\"name\":\"Create Chart of Account\",\"uid\":\"203\"},{\"id_application_action\":\"211\",\"action\":\"211\",\"name\":\"Edit Chart of Account\",\"uid\":\"204\"},{\"id_application_action\":\"212\",\"action\":\"212\",\"name\":\"Delete Chart of Account\",\"uid\":\"205\"},{\"id_application_action\":\"213\",\"action\":\"213\",\"name\":\"Save\\/Edit Chart of Account\",\"uid\":\"206\"},{\"id_application_action\":\"214\",\"action\":\"214\",\"name\":\"View Employee Salary\",\"uid\":\"207\"},{\"id_application_action\":\"215\",\"action\":\"215\",\"name\":\"Create Employee Salary\",\"uid\":\"208\"},{\"id_application_action\":\"216\",\"action\":\"216\",\"name\":\"Edit Employee Salary\",\"uid\":\"209\"},{\"id_application_action\":\"217\",\"action\":\"217\",\"name\":\"Delete Employee Salary\",\"uid\":\"210\"},{\"id_application_action\":\"218\",\"action\":\"218\",\"name\":\"Save\\/Edit Employee Salary\",\"uid\":\"211\"},{\"id_application_action\":\"219\",\"action\":\"219\",\"name\":\"View Salary Setting\",\"uid\":\"212\"},{\"id_application_action\":\"220\",\"action\":\"220\",\"name\":\"Create Salary Setting\",\"uid\":\"213\"},{\"id_application_action\":\"221\",\"action\":\"221\",\"name\":\"Edit Salary Setting\",\"uid\":\"214\"},{\"id_application_action\":\"222\",\"action\":\"222\",\"name\":\"Delete Salary Setting\",\"uid\":\"215\"},{\"id_application_action\":\"223\",\"action\":\"223\",\"name\":\"Save\\/Edit Salary Setting\",\"uid\":\"216\"},{\"id_application_action\":\"224\",\"action\":\"224\",\"name\":\"View Database Interface\",\"uid\":\"217\"},{\"id_application_action\":\"225\",\"action\":\"225\",\"name\":\"Pick Assessment Template\",\"uid\":\"218\"},{\"id_application_action\":\"226\",\"action\":\"226\",\"name\":\"View Organisation Structure\",\"uid\":\"219\"},{\"id_application_action\":\"227\",\"action\":\"227\",\"name\":\"Create Organisation Structure\",\"uid\":\"220\"},{\"id_application_action\":\"228\",\"action\":\"228\",\"name\":\"Edit Organisation Structure\",\"uid\":\"221\"},{\"id_application_action\":\"229\",\"action\":\"229\",\"name\":\"Delete Organisation Structure\",\"uid\":\"222\"},{\"id_application_action\":\"230\",\"action\":\"230\",\"name\":\"Save\\/Edit Organisation Structure\",\"uid\":\"223\"},{\"id_application_action\":\"231\",\"action\":\"231\",\"name\":\"View Position Level\",\"uid\":\"224\"},{\"id_application_action\":\"232\",\"action\":\"232\",\"name\":\"Create Position Level\",\"uid\":\"225\"},{\"id_application_action\":\"233\",\"action\":\"233\",\"name\":\"Edit Position Level\",\"uid\":\"226\"},{\"id_application_action\":\"234\",\"action\":\"234\",\"name\":\"Delete Position Level\",\"uid\":\"227\"},{\"id_application_action\":\"235\",\"action\":\"235\",\"name\":\"Save\\/Edit Position Level\",\"uid\":\"228\"},{\"id_application_action\":\"236\",\"action\":\"236\",\"name\":\"View Employee Contract Type\",\"uid\":\"229\"},{\"id_application_action\":\"237\",\"action\":\"237\",\"name\":\"Create Employee Contract Type\",\"uid\":\"230\"},{\"id_application_action\":\"238\",\"action\":\"238\",\"name\":\"Edit Employee Contract Type\",\"uid\":\"231\"},{\"id_application_action\":\"239\",\"action\":\"239\",\"name\":\"Delete Employee Contract Type\",\"uid\":\"232\"},{\"id_application_action\":\"240\",\"action\":\"240\",\"name\":\"Save\\/Edit Employee Contract\",\"uid\":\"233\"},{\"id_application_action\":\"241\",\"action\":\"241\",\"name\":\"View Bank\",\"uid\":\"234\"},{\"id_application_action\":\"242\",\"action\":\"242\",\"name\":\"Create Bank\",\"uid\":\"235\"},{\"id_application_action\":\"243\",\"action\":\"243\",\"name\":\"Edit Bank\",\"uid\":\"236\"},{\"id_application_action\":\"244\",\"action\":\"244\",\"name\":\"Delete Bank\",\"uid\":\"237\"},{\"id_application_action\":\"245\",\"action\":\"245\",\"name\":\"Save\\/Edit Bank\",\"uid\":\"238\"},{\"id_application_action\":\"246\",\"action\":\"246\",\"name\":\"View Payment Receipt\",\"uid\":\"239\"},{\"id_application_action\":\"247\",\"action\":\"247\",\"name\":\"Create Payment Receipt\",\"uid\":\"240\"},{\"id_application_action\":\"248\",\"action\":\"248\",\"name\":\"Edit Payment Receipt\",\"uid\":\"241\"},{\"id_application_action\":\"249\",\"action\":\"249\",\"name\":\"Save\\/Edit Payment Receipt\",\"uid\":\"242\"},{\"id_application_action\":\"250\",\"action\":\"250\",\"name\":\"Delete Payment Receipt\",\"uid\":\"243\"},{\"id_application_action\":\"251\",\"action\":\"251\",\"name\":\"Receive Payment From PO\",\"uid\":\"244\"},{\"id_application_action\":\"252\",\"action\":\"252\",\"name\":\"Make Payment Receipt\",\"uid\":\"245\"},{\"id_application_action\":\"253\",\"action\":\"253\",\"name\":\"Cancel Payment Receipt\",\"uid\":\"246\"},{\"id_application_action\":\"254\",\"action\":\"254\",\"name\":\"View Stock Transaction\",\"uid\":\"247\"},{\"id_application_action\":\"255\",\"action\":\"255\",\"name\":\"Create Stock Transaction\",\"uid\":\"248\"},{\"id_application_action\":\"256\",\"action\":\"256\",\"name\":\"Edit Stock Transaction\",\"uid\":\"249\"},{\"id_application_action\":\"257\",\"action\":\"257\",\"name\":\"Delete Stock Transaction\",\"uid\":\"250\"},{\"id_application_action\":\"258\",\"action\":\"258\",\"name\":\"Save\\/Edit Stock Transaction\",\"uid\":\"251\"},{\"id_application_action\":\"259\",\"action\":\"259\",\"name\":\"Post Stock Transaction\",\"uid\":\"252\"},{\"id_application_action\":\"260\",\"action\":\"260\",\"name\":\"Unpost Stock Transaction\",\"uid\":\"253\"},{\"id_application_action\":\"261\",\"action\":\"261\",\"name\":\"Transfer Good Receive\",\"uid\":\"254\"},{\"id_application_action\":\"262\",\"action\":\"262\",\"name\":\"View Activity\",\"uid\":\"255\"},{\"id_application_action\":\"263\",\"action\":\"263\",\"name\":\"Make Working Schedule\",\"uid\":\"256\"},{\"id_application_action\":\"264\",\"action\":\"264\",\"name\":\"Validate Inquiry\",\"uid\":\"257\"},{\"id_application_action\":\"265\",\"action\":\"265\",\"name\":\"Validate Quotation\",\"uid\":\"258\"},{\"id_application_action\":\"267\",\"action\":\"267\",\"name\":\"Confirm Sales Order\",\"uid\":\"259\"},{\"id_application_action\":\"266\",\"action\":\"266\",\"name\":\"Validate Sales Order\",\"uid\":\"260\"},{\"id_application_action\":\"268\",\"action\":\"268\",\"name\":\"View Fingerprint Device\",\"uid\":\"261\"},{\"id_application_action\":\"269\",\"action\":\"269\",\"name\":\"Create Fingerprint Device\",\"uid\":\"262\"},{\"id_application_action\":\"270\",\"action\":\"270\",\"name\":\"Edit Fingerprint Device\",\"uid\":\"263\"},{\"id_application_action\":\"271\",\"action\":\"271\",\"name\":\"Delete Fingerprint Device\",\"uid\":\"264\"},{\"id_application_action\":\"272\",\"action\":\"272\",\"name\":\"Save\\/Edit Fingerprint Device\",\"uid\":\"265\"},{\"id_application_action\":\"273\",\"action\":\"273\",\"name\":\"Activate Fingerprint\",\"uid\":\"266\"},{\"id_application_action\":\"274\",\"action\":\"274\",\"name\":\"Deactivate Fingerprint\",\"uid\":\"267\"},{\"id_application_action\":\"275\",\"action\":\"275\",\"name\":\"View Fingerprint Assign\",\"uid\":\"268\"},{\"id_application_action\":\"276\",\"action\":\"276\",\"name\":\"Create Fingerprint Assign\",\"uid\":\"269\"},{\"id_application_action\":\"277\",\"action\":\"277\",\"name\":\"Edit Fingerprint Assign\",\"uid\":\"270\"},{\"id_application_action\":\"278\",\"action\":\"278\",\"name\":\"Delete Fingerprint Assign\",\"uid\":\"271\"},{\"id_application_action\":\"279\",\"action\":\"279\",\"name\":\"Save\\/Edit Fingerprint Assign\",\"uid\":\"272\"},{\"id_application_action\":\"280\",\"action\":\"280\",\"name\":\"Make SO Assignment\",\"uid\":\"273\"},{\"id_application_action\":\"281\",\"name\":\"Assign Fingerprint Device\",\"uid\":\"274\",\"id\":\"274\"},{\"id_application_action\":\"282\",\"name\":\"Unassign Fingerprint\",\"uid\":\"275\",\"id\":\"275\"},{\"id_application_action\":\"283\",\"name\":\"Fingerprint Enroll\",\"uid\":\"276\",\"id\":\"276\"},{\"id_application_action\":\"284\",\"name\":\"Save Fingerprint Enroll\",\"uid\":\"277\",\"id\":\"277\"}],\"is_edit\":\"true\",\"id_role\":\"1\"}', '2015-03-20 12:30:55');
INSERT INTO `activity_log` VALUES ('187', 'Save/Edit Side Menu', 'side_menu', null, '2', 'Save/Edit Side Menu', '9', '{}', '2015-03-20 12:31:18');
INSERT INTO `activity_log` VALUES ('188', 'Save/Edit Role', 'role', null, '2', 'Save/Edit Role', '20', '{\"name\":\"administrator\",\"action_detail\":[{\"id_application_action\":\"1\",\"action\":\"1\",\"name\":\"View Application Action\",\"uid\":\"0\"},{\"id_application_action\":\"2\",\"action\":\"2\",\"name\":\"Create Application Action\",\"uid\":\"1\"},{\"id_application_action\":\"3\",\"action\":\"3\",\"name\":\"Edit Application Action\",\"uid\":\"2\"},{\"id_application_action\":\"4\",\"action\":\"4\",\"name\":\"Delete Application Action\",\"uid\":\"3\"},{\"id_application_action\":\"5\",\"action\":\"5\",\"name\":\"View Side Menu\",\"uid\":\"4\"},{\"id_application_action\":\"6\",\"action\":\"6\",\"name\":\"Create Side Menu\",\"uid\":\"5\"},{\"id_application_action\":\"7\",\"action\":\"7\",\"name\":\"Edit Side Menu\",\"uid\":\"6\"},{\"id_application_action\":\"8\",\"action\":\"8\",\"name\":\"Delete Side Menu\",\"uid\":\"7\"},{\"id_application_action\":\"9\",\"action\":\"9\",\"name\":\"Save\\/Edit Side Menu\",\"uid\":\"8\"},{\"id_application_action\":\"10\",\"action\":\"10\",\"name\":\"Save\\/Edit Action\",\"uid\":\"9\"},{\"id_application_action\":\"11\",\"action\":\"11\",\"name\":\"View Division\",\"uid\":\"10\"},{\"id_application_action\":\"12\",\"action\":\"12\",\"name\":\"Create Division\",\"uid\":\"11\"},{\"id_application_action\":\"13\",\"action\":\"13\",\"name\":\"Save\\/Edit Division\",\"uid\":\"12\"},{\"id_application_action\":\"14\",\"action\":\"14\",\"name\":\"Edit Division\",\"uid\":\"13\"},{\"id_application_action\":\"15\",\"action\":\"15\",\"name\":\"Delete Division\",\"uid\":\"14\"},{\"id_application_action\":\"16\",\"action\":\"16\",\"name\":\"View Role\",\"uid\":\"15\"},{\"id_application_action\":\"17\",\"action\":\"17\",\"name\":\"View Create Role\",\"uid\":\"16\"},{\"id_application_action\":\"18\",\"action\":\"18\",\"name\":\"View Edit Role\",\"uid\":\"17\"},{\"id_application_action\":\"19\",\"action\":\"19\",\"name\":\"Delete Role\",\"uid\":\"18\"},{\"id_application_action\":\"20\",\"action\":\"20\",\"name\":\"Save\\/Edit Role\",\"uid\":\"19\"},{\"id_application_action\":\"21\",\"action\":\"21\",\"name\":\"View Product\",\"uid\":\"20\"},{\"id_application_action\":\"22\",\"action\":\"22\",\"name\":\"Create Product\",\"uid\":\"21\"},{\"id_application_action\":\"23\",\"action\":\"23\",\"name\":\"Edit Product\",\"uid\":\"22\"},{\"id_application_action\":\"24\",\"action\":\"24\",\"name\":\"Delete Product\",\"uid\":\"23\"},{\"id_application_action\":\"25\",\"action\":\"25\",\"name\":\"Save\\/Edit Product\",\"uid\":\"24\"},{\"id_application_action\":\"26\",\"action\":\"26\",\"name\":\"View Supplier\",\"uid\":\"25\"},{\"id_application_action\":\"27\",\"action\":\"27\",\"name\":\"Create Supplier\",\"uid\":\"26\"},{\"id_application_action\":\"28\",\"action\":\"28\",\"name\":\"Edit Supplier\",\"uid\":\"27\"},{\"id_application_action\":\"29\",\"action\":\"29\",\"name\":\"Delete Supplier\",\"uid\":\"28\"},{\"id_application_action\":\"30\",\"action\":\"30\",\"name\":\"Save\\/Edit Supplier\",\"uid\":\"29\"},{\"id_application_action\":\"31\",\"action\":\"31\",\"name\":\"View Product Category\",\"uid\":\"30\"},{\"id_application_action\":\"32\",\"action\":\"32\",\"name\":\"Create Product Category\",\"uid\":\"31\"},{\"id_application_action\":\"33\",\"action\":\"33\",\"name\":\"Edit Product Category\",\"uid\":\"32\"},{\"id_application_action\":\"34\",\"action\":\"34\",\"name\":\"Delete Product Category\",\"uid\":\"33\"},{\"id_application_action\":\"35\",\"action\":\"35\",\"name\":\"Save\\/Edit Product Category\",\"uid\":\"34\"},{\"id_application_action\":\"36\",\"action\":\"36\",\"name\":\"View Merk\",\"uid\":\"35\"},{\"id_application_action\":\"37\",\"action\":\"37\",\"name\":\"Create Merk\",\"uid\":\"36\"},{\"id_application_action\":\"38\",\"action\":\"38\",\"name\":\"Edit Merk\",\"uid\":\"37\"},{\"id_application_action\":\"39\",\"action\":\"39\",\"name\":\"Delete Merk\",\"uid\":\"38\"},{\"id_application_action\":\"40\",\"action\":\"40\",\"name\":\"Save\\/Edit Merk\",\"uid\":\"39\"},{\"id_application_action\":\"41\",\"action\":\"41\",\"name\":\"View Customer\",\"uid\":\"40\"},{\"id_application_action\":\"43\",\"action\":\"43\",\"name\":\"Create Customer\",\"uid\":\"41\"},{\"id_application_action\":\"44\",\"action\":\"44\",\"name\":\"Edit Customer\",\"uid\":\"42\"},{\"id_application_action\":\"45\",\"action\":\"45\",\"name\":\"Delete Customer\",\"uid\":\"43\"},{\"id_application_action\":\"46\",\"action\":\"46\",\"name\":\"Save\\/Edit Customer\",\"uid\":\"44\"},{\"id_application_action\":\"47\",\"action\":\"47\",\"name\":\"View Warehouse\",\"uid\":\"45\"},{\"id_application_action\":\"48\",\"action\":\"48\",\"name\":\"Create Warehouse\",\"uid\":\"46\"},{\"id_application_action\":\"49\",\"action\":\"49\",\"name\":\"Edit Warehouse\",\"uid\":\"47\"},{\"id_application_action\":\"50\",\"action\":\"50\",\"name\":\"Delete Warehouse\",\"uid\":\"48\"},{\"id_application_action\":\"51\",\"action\":\"51\",\"name\":\"Save\\/Edit Warehouse\",\"uid\":\"49\"},{\"id_application_action\":\"57\",\"action\":\"57\",\"name\":\"View PO\",\"uid\":\"50\"},{\"id_application_action\":\"58\",\"action\":\"58\",\"name\":\"Create PO\",\"uid\":\"51\"},{\"id_application_action\":\"59\",\"action\":\"59\",\"name\":\"Edit PO\",\"uid\":\"52\"},{\"id_application_action\":\"60\",\"action\":\"60\",\"name\":\"Delete PO\",\"uid\":\"53\"},{\"id_application_action\":\"61\",\"action\":\"61\",\"name\":\"Save\\/Edit PO\",\"uid\":\"54\"},{\"id_application_action\":\"62\",\"action\":\"62\",\"name\":\"View User\",\"uid\":\"55\"},{\"id_application_action\":\"63\",\"action\":\"63\",\"name\":\"Create User\",\"uid\":\"56\"},{\"id_application_action\":\"64\",\"action\":\"64\",\"name\":\"Edit User\",\"uid\":\"57\"},{\"id_application_action\":\"65\",\"action\":\"65\",\"name\":\"Delete User\",\"uid\":\"58\"},{\"id_application_action\":\"66\",\"action\":\"66\",\"name\":\"Save\\/Edit User\",\"uid\":\"59\"},{\"id_application_action\":\"67\",\"action\":\"67\",\"name\":\"View Good Receive\",\"uid\":\"60\"},{\"id_application_action\":\"68\",\"action\":\"68\",\"name\":\"Create Good Receive\",\"uid\":\"61\"},{\"id_application_action\":\"69\",\"action\":\"69\",\"name\":\"Edit Good Receive\",\"uid\":\"62\"},{\"id_application_action\":\"70\",\"action\":\"70\",\"name\":\"Delete Good Receive\",\"uid\":\"63\"},{\"id_application_action\":\"71\",\"action\":\"71\",\"name\":\"Save\\/Edit Good Receive\",\"uid\":\"64\"},{\"id_application_action\":\"72\",\"action\":\"72\",\"name\":\"View Sales Order\",\"uid\":\"65\"},{\"id_application_action\":\"73\",\"action\":\"73\",\"name\":\"Create Sales Order\",\"uid\":\"66\"},{\"id_application_action\":\"74\",\"action\":\"74\",\"name\":\"Edit Sales Order\",\"uid\":\"67\"},{\"id_application_action\":\"75\",\"action\":\"75\",\"name\":\"Delete Sales Order\",\"uid\":\"68\"},{\"id_application_action\":\"76\",\"action\":\"76\",\"name\":\"Save Sales Order\",\"uid\":\"69\"},{\"id_application_action\":\"77\",\"action\":\"77\",\"name\":\"View Material Request\",\"uid\":\"70\"},{\"id_application_action\":\"78\",\"action\":\"78\",\"name\":\"Create Material Request\",\"uid\":\"71\"},{\"id_application_action\":\"79\",\"action\":\"79\",\"name\":\"Edit Material Request\",\"uid\":\"72\"},{\"id_application_action\":\"80\",\"action\":\"80\",\"name\":\"Delete Material Request\",\"uid\":\"73\"},{\"id_application_action\":\"81\",\"action\":\"81\",\"name\":\"Save Material Request\",\"uid\":\"74\"},{\"id_application_action\":\"82\",\"action\":\"82\",\"name\":\"Change User Password\",\"uid\":\"75\"},{\"id_application_action\":\"83\",\"action\":\"83\",\"name\":\"View Delivery Note\",\"uid\":\"76\"},{\"id_application_action\":\"84\",\"action\":\"84\",\"name\":\"Create Delivery Note\",\"uid\":\"77\"},{\"id_application_action\":\"85\",\"action\":\"85\",\"name\":\"Edit Delivery Note\",\"uid\":\"78\"},{\"id_application_action\":\"86\",\"action\":\"86\",\"name\":\"Delete Delivery Note\",\"uid\":\"79\"},{\"id_application_action\":\"87\",\"action\":\"87\",\"name\":\"Save\\/Edit Delivery Note\",\"uid\":\"80\"},{\"id_application_action\":\"88\",\"action\":\"88\",\"name\":\"View Unit Measure\",\"uid\":\"81\"},{\"id_application_action\":\"89\",\"action\":\"89\",\"name\":\"Create Unit Measure\",\"uid\":\"82\"},{\"id_application_action\":\"90\",\"action\":\"90\",\"name\":\"Edit Unit Measure\",\"uid\":\"83\"},{\"id_application_action\":\"91\",\"action\":\"91\",\"name\":\"Delete Unit Measure\",\"uid\":\"84\"},{\"id_application_action\":\"92\",\"action\":\"92\",\"name\":\"Save\\/Edit Unit Measure\",\"uid\":\"85\"},{\"id_application_action\":\"93\",\"action\":\"93\",\"name\":\"View Stock\",\"uid\":\"86\"},{\"id_application_action\":\"94\",\"action\":\"94\",\"name\":\"View Employee\",\"uid\":\"87\"},{\"id_application_action\":\"95\",\"action\":\"95\",\"name\":\"Create Employee\",\"uid\":\"88\"},{\"id_application_action\":\"96\",\"action\":\"96\",\"name\":\"Edit Employee\",\"uid\":\"89\"},{\"id_application_action\":\"97\",\"action\":\"97\",\"name\":\"Delete Employee\",\"uid\":\"90\"},{\"id_application_action\":\"98\",\"action\":\"98\",\"name\":\"Save\\/Edit Employee\",\"uid\":\"91\"},{\"id_application_action\":\"99\",\"action\":\"99\",\"name\":\"Validate PO\",\"uid\":\"92\"},{\"id_application_action\":\"100\",\"action\":\"100\",\"name\":\"Create Database Interface\",\"uid\":\"93\"},{\"id_application_action\":\"101\",\"action\":\"101\",\"name\":\"Edit Database Interface\",\"uid\":\"94\"},{\"id_application_action\":\"102\",\"action\":\"102\",\"name\":\"Delete Database Interface\",\"uid\":\"95\"},{\"id_application_action\":\"103\",\"action\":\"103\",\"name\":\"Save \\/ Edit Database Interface\",\"uid\":\"96\"},{\"id_application_action\":\"104\",\"action\":\"104\",\"name\":\"View Database Field Interface\",\"uid\":\"97\"},{\"id_application_action\":\"105\",\"action\":\"105\",\"name\":\"Create Database Field Interface\",\"uid\":\"98\"},{\"id_application_action\":\"106\",\"action\":\"106\",\"name\":\"Edit Database Field Interface\",\"uid\":\"99\"},{\"id_application_action\":\"107\",\"action\":\"107\",\"name\":\"Delete Database Field Interface\",\"uid\":\"100\"},{\"id_application_action\":\"108\",\"action\":\"108\",\"name\":\"Save \\/ Edit Database Field Interface\",\"uid\":\"101\"},{\"id_application_action\":\"109\",\"action\":\"109\",\"name\":\"View Inquiry\",\"uid\":\"102\"},{\"id_application_action\":\"110\",\"action\":\"110\",\"name\":\"Create Inquiry\",\"uid\":\"103\"},{\"id_application_action\":\"111\",\"action\":\"111\",\"name\":\"Edit Inquiry\",\"uid\":\"104\"},{\"id_application_action\":\"112\",\"action\":\"112\",\"name\":\"Delete Inquiry\",\"uid\":\"105\"},{\"id_application_action\":\"113\",\"action\":\"113\",\"name\":\"Save\\/Edit Inquiry\",\"uid\":\"106\"},{\"id_application_action\":\"114\",\"action\":\"114\",\"name\":\"View Survey \\/ Assessment\",\"uid\":\"107\"},{\"id_application_action\":\"115\",\"action\":\"115\",\"name\":\"Create Survey \\/ Assessment\",\"uid\":\"108\"},{\"id_application_action\":\"116\",\"action\":\"116\",\"name\":\"Edit Survey \\/ Assessment\",\"uid\":\"109\"},{\"id_application_action\":\"117\",\"action\":\"117\",\"name\":\"Delete Survey \\/ Assessment\",\"uid\":\"110\"},{\"id_application_action\":\"118\",\"action\":\"118\",\"name\":\"Save\\/Edit Survey \\/ Assessment\",\"uid\":\"111\"},{\"id_application_action\":\"119\",\"action\":\"119\",\"name\":\"View Quotation\",\"uid\":\"112\"},{\"id_application_action\":\"120\",\"action\":\"120\",\"name\":\"Create Quotation\",\"uid\":\"113\"},{\"id_application_action\":\"121\",\"action\":\"121\",\"name\":\"Edit Quotation\",\"uid\":\"114\"},{\"id_application_action\":\"122\",\"action\":\"122\",\"name\":\"Delete Quotation\",\"uid\":\"115\"},{\"id_application_action\":\"123\",\"action\":\"123\",\"name\":\"Save\\/Edit Quotation\",\"uid\":\"116\"},{\"id_application_action\":\"124\",\"action\":\"124\",\"name\":\"View Project Contract\",\"uid\":\"117\"},{\"id_application_action\":\"125\",\"action\":\"125\",\"name\":\"Create Project Contract\",\"uid\":\"118\"},{\"id_application_action\":\"126\",\"action\":\"126\",\"name\":\"Edit Project Contract\",\"uid\":\"119\"},{\"id_application_action\":\"127\",\"action\":\"127\",\"name\":\"Delete Project Contract\",\"uid\":\"120\"},{\"id_application_action\":\"128\",\"action\":\"128\",\"name\":\"Save\\/Edit Project Contract\",\"uid\":\"121\"},{\"id_application_action\":\"129\",\"action\":\"129\",\"name\":\"View Work Order\",\"uid\":\"122\"},{\"id_application_action\":\"130\",\"action\":\"130\",\"name\":\"Create Work Order\",\"uid\":\"123\"},{\"id_application_action\":\"131\",\"action\":\"131\",\"name\":\"Edit Work Order\",\"uid\":\"124\"},{\"id_application_action\":\"132\",\"action\":\"132\",\"name\":\"Delete Work Order\",\"uid\":\"125\"},{\"id_application_action\":\"133\",\"action\":\"133\",\"name\":\"Save\\/Edit Work Order\",\"uid\":\"126\"},{\"id_application_action\":\"134\",\"action\":\"134\",\"name\":\"View Assessment Template\",\"uid\":\"127\"},{\"id_application_action\":\"135\",\"action\":\"135\",\"name\":\"Create Assessment Template\",\"uid\":\"128\"},{\"id_application_action\":\"136\",\"action\":\"136\",\"name\":\"Edit Assessment Template\",\"uid\":\"129\"},{\"id_application_action\":\"137\",\"action\":\"137\",\"name\":\"Delete Assessment Template\",\"uid\":\"130\"},{\"id_application_action\":\"138\",\"action\":\"138\",\"name\":\"Save\\/Edit Assessment Template\",\"uid\":\"131\"},{\"id_application_action\":\"139\",\"action\":\"139\",\"name\":\"View Contract Template\",\"uid\":\"132\"},{\"id_application_action\":\"140\",\"action\":\"140\",\"name\":\"Create Contract Template\",\"uid\":\"133\"},{\"id_application_action\":\"141\",\"action\":\"141\",\"name\":\"Edit Contract Template\",\"uid\":\"134\"},{\"id_application_action\":\"142\",\"action\":\"142\",\"name\":\"Delete Contract Template\",\"uid\":\"135\"},{\"id_application_action\":\"143\",\"action\":\"143\",\"name\":\"Save\\/Edit Contract Template\",\"uid\":\"136\"},{\"id_application_action\":\"144\",\"action\":\"144\",\"name\":\"View Work Schedule\",\"uid\":\"137\"},{\"id_application_action\":\"145\",\"action\":\"145\",\"name\":\"Create Work Schedule\",\"uid\":\"138\"},{\"id_application_action\":\"146\",\"action\":\"146\",\"name\":\"Edit Work Schedule\",\"uid\":\"139\"},{\"id_application_action\":\"147\",\"action\":\"147\",\"name\":\"Delete Work Schedule\",\"uid\":\"140\"},{\"id_application_action\":\"148\",\"action\":\"148\",\"name\":\"Save\\/Edit Work Schedule\",\"uid\":\"141\"},{\"id_application_action\":\"149\",\"action\":\"149\",\"name\":\"View SO Assignment\",\"uid\":\"142\"},{\"id_application_action\":\"150\",\"action\":\"150\",\"name\":\"Create SO Assignment\",\"uid\":\"143\"},{\"id_application_action\":\"151\",\"action\":\"151\",\"name\":\"Edit SO Assignment\",\"uid\":\"144\"},{\"id_application_action\":\"152\",\"action\":\"152\",\"name\":\"Delete SO Assignment\",\"uid\":\"145\"},{\"id_application_action\":\"153\",\"action\":\"153\",\"name\":\"Save\\/Edit SO Assignment\",\"uid\":\"146\"},{\"id_application_action\":\"154\",\"action\":\"154\",\"name\":\"View Shift Change\",\"uid\":\"147\"},{\"id_application_action\":\"155\",\"action\":\"155\",\"name\":\"Create Shift Change\",\"uid\":\"148\"},{\"id_application_action\":\"156\",\"action\":\"156\",\"name\":\"Edit Shift Change\",\"uid\":\"149\"},{\"id_application_action\":\"157\",\"action\":\"157\",\"name\":\"Delete Shift Change\",\"uid\":\"150\"},{\"id_application_action\":\"158\",\"action\":\"158\",\"name\":\"Save\\/Edit Shift Change\",\"uid\":\"151\"},{\"id_application_action\":\"159\",\"action\":\"159\",\"name\":\"View Leave Application\",\"uid\":\"152\"},{\"id_application_action\":\"160\",\"action\":\"160\",\"name\":\"Create Leave Application\",\"uid\":\"153\"},{\"id_application_action\":\"161\",\"action\":\"161\",\"name\":\"Edit Leave Application\",\"uid\":\"154\"},{\"id_application_action\":\"162\",\"action\":\"162\",\"name\":\"Delete Leave Application\",\"uid\":\"155\"},{\"id_application_action\":\"163\",\"action\":\"163\",\"name\":\"Save\\/Edit Leave Application\",\"uid\":\"156\"},{\"id_application_action\":\"164\",\"action\":\"164\",\"name\":\"View Timesheet (Recap)\",\"uid\":\"157\"},{\"id_application_action\":\"165\",\"action\":\"165\",\"name\":\"Create Timesheet (Recap)\",\"uid\":\"158\"},{\"id_application_action\":\"166\",\"action\":\"166\",\"name\":\"Edit Timesheet (Recap)\",\"uid\":\"159\"},{\"id_application_action\":\"167\",\"action\":\"167\",\"name\":\"Delete Timesheet (Recap)\",\"uid\":\"160\"},{\"id_application_action\":\"168\",\"action\":\"168\",\"name\":\"Save\\/Edit Timesheet (Recap)\",\"uid\":\"161\"},{\"id_application_action\":\"169\",\"action\":\"169\",\"name\":\"View SO Timesheet\",\"uid\":\"162\"},{\"id_application_action\":\"170\",\"action\":\"170\",\"name\":\"Create SO Timesheet\",\"uid\":\"163\"},{\"id_application_action\":\"171\",\"action\":\"171\",\"name\":\"Edit SO Timesheet\",\"uid\":\"164\"},{\"id_application_action\":\"172\",\"action\":\"172\",\"name\":\"Delete SO Timesheet\",\"uid\":\"165\"},{\"id_application_action\":\"173\",\"action\":\"173\",\"name\":\"Save\\/Edit SO Timesheet\",\"uid\":\"166\"},{\"id_application_action\":\"174\",\"action\":\"174\",\"name\":\"View Incident Report\",\"uid\":\"167\"},{\"id_application_action\":\"175\",\"action\":\"175\",\"name\":\"Create Incident Report\",\"uid\":\"168\"},{\"id_application_action\":\"176\",\"action\":\"176\",\"name\":\"Edit Incident Report\",\"uid\":\"169\"},{\"id_application_action\":\"177\",\"action\":\"177\",\"name\":\"Delete Incident Report\",\"uid\":\"170\"},{\"id_application_action\":\"178\",\"action\":\"178\",\"name\":\"Save\\/Edit Incident Report\",\"uid\":\"171\"},{\"id_application_action\":\"179\",\"action\":\"179\",\"name\":\"View Payroll\",\"uid\":\"172\"},{\"id_application_action\":\"180\",\"action\":\"180\",\"name\":\"Create Payroll\",\"uid\":\"173\"},{\"id_application_action\":\"181\",\"action\":\"181\",\"name\":\"Edit Payroll\",\"uid\":\"174\"},{\"id_application_action\":\"182\",\"action\":\"182\",\"name\":\"Delete Payroll\",\"uid\":\"175\"},{\"id_application_action\":\"183\",\"action\":\"183\",\"name\":\"Save\\/Edit Payroll\",\"uid\":\"176\"},{\"id_application_action\":\"184\",\"action\":\"184\",\"name\":\"View Supplier Invoice\",\"uid\":\"177\"},{\"id_application_action\":\"185\",\"action\":\"185\",\"name\":\"Create Supplier Invoice\",\"uid\":\"178\"},{\"id_application_action\":\"186\",\"action\":\"186\",\"name\":\"Edit Supplier Invoice\",\"uid\":\"179\"},{\"id_application_action\":\"187\",\"action\":\"187\",\"name\":\"Delete Supplier Invoice\",\"uid\":\"180\"},{\"id_application_action\":\"188\",\"action\":\"188\",\"name\":\"Save\\/Edit Supplier Invoice\",\"uid\":\"181\"},{\"id_application_action\":\"189\",\"action\":\"189\",\"name\":\"View Customer Invoice\",\"uid\":\"182\"},{\"id_application_action\":\"190\",\"action\":\"190\",\"name\":\"Create Customer Invoice\",\"uid\":\"183\"},{\"id_application_action\":\"191\",\"action\":\"191\",\"name\":\"Edit Customer Invoice\",\"uid\":\"184\"},{\"id_application_action\":\"192\",\"action\":\"192\",\"name\":\"Delete Customer Invoice\",\"uid\":\"185\"},{\"id_application_action\":\"193\",\"action\":\"193\",\"name\":\"Save\\/Edit Customer Invoice\",\"uid\":\"186\"},{\"id_application_action\":\"194\",\"action\":\"194\",\"name\":\"View Bank Statement\",\"uid\":\"187\"},{\"id_application_action\":\"195\",\"action\":\"195\",\"name\":\"Create Bank Statement\",\"uid\":\"188\"},{\"id_application_action\":\"196\",\"action\":\"196\",\"name\":\"Edit Bank Statement\",\"uid\":\"189\"},{\"id_application_action\":\"197\",\"action\":\"197\",\"name\":\"Delete Bank Statement\",\"uid\":\"190\"},{\"id_application_action\":\"198\",\"action\":\"198\",\"name\":\"Save\\/Edit Bank Statement\",\"uid\":\"191\"},{\"id_application_action\":\"199\",\"action\":\"199\",\"name\":\"View Cash Register\",\"uid\":\"192\"},{\"id_application_action\":\"200\",\"action\":\"200\",\"name\":\"Create Cash Register\",\"uid\":\"193\"},{\"id_application_action\":\"201\",\"action\":\"201\",\"name\":\"Edit Cash Register\",\"uid\":\"194\"},{\"id_application_action\":\"202\",\"action\":\"202\",\"name\":\"Delete Cash Register\",\"uid\":\"195\"},{\"id_application_action\":\"203\",\"action\":\"203\",\"name\":\"Save\\/Edit Cash Register\",\"uid\":\"196\"},{\"id_application_action\":\"204\",\"action\":\"204\",\"name\":\"View Tax\",\"uid\":\"197\"},{\"id_application_action\":\"205\",\"action\":\"205\",\"name\":\"Create Tax\",\"uid\":\"198\"},{\"id_application_action\":\"206\",\"action\":\"206\",\"name\":\"Edit Tax\",\"uid\":\"199\"},{\"id_application_action\":\"207\",\"action\":\"207\",\"name\":\"Delete Tax\",\"uid\":\"200\"},{\"id_application_action\":\"208\",\"action\":\"208\",\"name\":\"Save\\/Edit Tax\",\"uid\":\"201\"},{\"id_application_action\":\"209\",\"action\":\"209\",\"name\":\"View Chart of Account\",\"uid\":\"202\"},{\"id_application_action\":\"210\",\"action\":\"210\",\"name\":\"Create Chart of Account\",\"uid\":\"203\"},{\"id_application_action\":\"211\",\"action\":\"211\",\"name\":\"Edit Chart of Account\",\"uid\":\"204\"},{\"id_application_action\":\"212\",\"action\":\"212\",\"name\":\"Delete Chart of Account\",\"uid\":\"205\"},{\"id_application_action\":\"213\",\"action\":\"213\",\"name\":\"Save\\/Edit Chart of Account\",\"uid\":\"206\"},{\"id_application_action\":\"214\",\"action\":\"214\",\"name\":\"View Employee Salary\",\"uid\":\"207\"},{\"id_application_action\":\"215\",\"action\":\"215\",\"name\":\"Create Employee Salary\",\"uid\":\"208\"},{\"id_application_action\":\"216\",\"action\":\"216\",\"name\":\"Edit Employee Salary\",\"uid\":\"209\"},{\"id_application_action\":\"217\",\"action\":\"217\",\"name\":\"Delete Employee Salary\",\"uid\":\"210\"},{\"id_application_action\":\"218\",\"action\":\"218\",\"name\":\"Save\\/Edit Employee Salary\",\"uid\":\"211\"},{\"id_application_action\":\"219\",\"action\":\"219\",\"name\":\"View Salary Setting\",\"uid\":\"212\"},{\"id_application_action\":\"220\",\"action\":\"220\",\"name\":\"Create Salary Setting\",\"uid\":\"213\"},{\"id_application_action\":\"221\",\"action\":\"221\",\"name\":\"Edit Salary Setting\",\"uid\":\"214\"},{\"id_application_action\":\"222\",\"action\":\"222\",\"name\":\"Delete Salary Setting\",\"uid\":\"215\"},{\"id_application_action\":\"223\",\"action\":\"223\",\"name\":\"Save\\/Edit Salary Setting\",\"uid\":\"216\"},{\"id_application_action\":\"224\",\"action\":\"224\",\"name\":\"View Database Interface\",\"uid\":\"217\"},{\"id_application_action\":\"225\",\"action\":\"225\",\"name\":\"Pick Assessment Template\",\"uid\":\"218\"},{\"id_application_action\":\"226\",\"action\":\"226\",\"name\":\"View Organisation Structure\",\"uid\":\"219\"},{\"id_application_action\":\"227\",\"action\":\"227\",\"name\":\"Create Organisation Structure\",\"uid\":\"220\"},{\"id_application_action\":\"228\",\"action\":\"228\",\"name\":\"Edit Organisation Structure\",\"uid\":\"221\"},{\"id_application_action\":\"229\",\"action\":\"229\",\"name\":\"Delete Organisation Structure\",\"uid\":\"222\"},{\"id_application_action\":\"230\",\"action\":\"230\",\"name\":\"Save\\/Edit Organisation Structure\",\"uid\":\"223\"},{\"id_application_action\":\"231\",\"action\":\"231\",\"name\":\"View Position Level\",\"uid\":\"224\"},{\"id_application_action\":\"232\",\"action\":\"232\",\"name\":\"Create Position Level\",\"uid\":\"225\"},{\"id_application_action\":\"233\",\"action\":\"233\",\"name\":\"Edit Position Level\",\"uid\":\"226\"},{\"id_application_action\":\"234\",\"action\":\"234\",\"name\":\"Delete Position Level\",\"uid\":\"227\"},{\"id_application_action\":\"235\",\"action\":\"235\",\"name\":\"Save\\/Edit Position Level\",\"uid\":\"228\"},{\"id_application_action\":\"236\",\"action\":\"236\",\"name\":\"View Employee Contract Type\",\"uid\":\"229\"},{\"id_application_action\":\"237\",\"action\":\"237\",\"name\":\"Create Employee Contract Type\",\"uid\":\"230\"},{\"id_application_action\":\"238\",\"action\":\"238\",\"name\":\"Edit Employee Contract Type\",\"uid\":\"231\"},{\"id_application_action\":\"239\",\"action\":\"239\",\"name\":\"Delete Employee Contract Type\",\"uid\":\"232\"},{\"id_application_action\":\"240\",\"action\":\"240\",\"name\":\"Save\\/Edit Employee Contract\",\"uid\":\"233\"},{\"id_application_action\":\"241\",\"action\":\"241\",\"name\":\"View Bank\",\"uid\":\"234\"},{\"id_application_action\":\"242\",\"action\":\"242\",\"name\":\"Create Bank\",\"uid\":\"235\"},{\"id_application_action\":\"243\",\"action\":\"243\",\"name\":\"Edit Bank\",\"uid\":\"236\"},{\"id_application_action\":\"244\",\"action\":\"244\",\"name\":\"Delete Bank\",\"uid\":\"237\"},{\"id_application_action\":\"245\",\"action\":\"245\",\"name\":\"Save\\/Edit Bank\",\"uid\":\"238\"},{\"id_application_action\":\"246\",\"action\":\"246\",\"name\":\"View Payment Receipt\",\"uid\":\"239\"},{\"id_application_action\":\"247\",\"action\":\"247\",\"name\":\"Create Payment Receipt\",\"uid\":\"240\"},{\"id_application_action\":\"248\",\"action\":\"248\",\"name\":\"Edit Payment Receipt\",\"uid\":\"241\"},{\"id_application_action\":\"249\",\"action\":\"249\",\"name\":\"Save\\/Edit Payment Receipt\",\"uid\":\"242\"},{\"id_application_action\":\"250\",\"action\":\"250\",\"name\":\"Delete Payment Receipt\",\"uid\":\"243\"},{\"id_application_action\":\"251\",\"action\":\"251\",\"name\":\"Receive Payment From PO\",\"uid\":\"244\"},{\"id_application_action\":\"252\",\"action\":\"252\",\"name\":\"Make Payment Receipt\",\"uid\":\"245\"},{\"id_application_action\":\"253\",\"action\":\"253\",\"name\":\"Cancel Payment Receipt\",\"uid\":\"246\"},{\"id_application_action\":\"254\",\"action\":\"254\",\"name\":\"View Stock Transaction\",\"uid\":\"247\"},{\"id_application_action\":\"255\",\"action\":\"255\",\"name\":\"Create Stock Transaction\",\"uid\":\"248\"},{\"id_application_action\":\"256\",\"action\":\"256\",\"name\":\"Edit Stock Transaction\",\"uid\":\"249\"},{\"id_application_action\":\"257\",\"action\":\"257\",\"name\":\"Delete Stock Transaction\",\"uid\":\"250\"},{\"id_application_action\":\"258\",\"action\":\"258\",\"name\":\"Save\\/Edit Stock Transaction\",\"uid\":\"251\"},{\"id_application_action\":\"259\",\"action\":\"259\",\"name\":\"Post Stock Transaction\",\"uid\":\"252\"},{\"id_application_action\":\"260\",\"action\":\"260\",\"name\":\"Unpost Stock Transaction\",\"uid\":\"253\"},{\"id_application_action\":\"261\",\"action\":\"261\",\"name\":\"Transfer Good Receive\",\"uid\":\"254\"},{\"id_application_action\":\"262\",\"action\":\"262\",\"name\":\"View Activity\",\"uid\":\"255\"},{\"id_application_action\":\"263\",\"action\":\"263\",\"name\":\"Make Working Schedule\",\"uid\":\"256\"},{\"id_application_action\":\"264\",\"action\":\"264\",\"name\":\"Validate Inquiry\",\"uid\":\"257\"},{\"id_application_action\":\"265\",\"action\":\"265\",\"name\":\"Validate Quotation\",\"uid\":\"258\"},{\"id_application_action\":\"267\",\"action\":\"267\",\"name\":\"Confirm Sales Order\",\"uid\":\"259\"},{\"id_application_action\":\"266\",\"action\":\"266\",\"name\":\"Validate Sales Order\",\"uid\":\"260\"},{\"id_application_action\":\"268\",\"action\":\"268\",\"name\":\"View Fingerprint Device\",\"uid\":\"261\"},{\"id_application_action\":\"269\",\"action\":\"269\",\"name\":\"Create Fingerprint Device\",\"uid\":\"262\"},{\"id_application_action\":\"270\",\"action\":\"270\",\"name\":\"Edit Fingerprint Device\",\"uid\":\"263\"},{\"id_application_action\":\"271\",\"action\":\"271\",\"name\":\"Delete Fingerprint Device\",\"uid\":\"264\"},{\"id_application_action\":\"272\",\"action\":\"272\",\"name\":\"Save\\/Edit Fingerprint Device\",\"uid\":\"265\"},{\"id_application_action\":\"273\",\"action\":\"273\",\"name\":\"Activate Fingerprint\",\"uid\":\"266\"},{\"id_application_action\":\"274\",\"action\":\"274\",\"name\":\"Deactivate Fingerprint\",\"uid\":\"267\"},{\"id_application_action\":\"275\",\"action\":\"275\",\"name\":\"View Fingerprint Assign\",\"uid\":\"268\"},{\"id_application_action\":\"276\",\"action\":\"276\",\"name\":\"Create Fingerprint Assign\",\"uid\":\"269\"},{\"id_application_action\":\"277\",\"action\":\"277\",\"name\":\"Edit Fingerprint Assign\",\"uid\":\"270\"},{\"id_application_action\":\"278\",\"action\":\"278\",\"name\":\"Delete Fingerprint Assign\",\"uid\":\"271\"},{\"id_application_action\":\"279\",\"action\":\"279\",\"name\":\"Save\\/Edit Fingerprint Assign\",\"uid\":\"272\"},{\"id_application_action\":\"280\",\"action\":\"280\",\"name\":\"Make SO Assignment\",\"uid\":\"273\"},{\"id_application_action\":\"281\",\"action\":\"281\",\"name\":\"Assign Fingerprint Device\",\"uid\":\"274\"},{\"id_application_action\":\"282\",\"action\":\"282\",\"name\":\"Unassign Fingerprint\",\"uid\":\"275\"},{\"id_application_action\":\"283\",\"action\":\"283\",\"name\":\"Fingerprint Enroll\",\"uid\":\"276\"},{\"id_application_action\":\"284\",\"action\":\"284\",\"name\":\"Save Fingerprint Enroll\",\"uid\":\"277\"},{\"id_application_action\":\"293\",\"name\":\"Create BOM\",\"uid\":\"278\",\"id\":\"278\"},{\"id_application_action\":\"294\",\"name\":\"Edit BOM\",\"uid\":\"279\",\"id\":\"279\"},{\"id_application_action\":\"295\",\"name\":\"Delete BOM\",\"uid\":\"280\",\"id\":\"280\"},{\"id_application_action\":\"296\",\"name\":\"Save\\/Edit BOM\",\"uid\":\"281\",\"id\":\"281\"},{\"id_application_action\":\"297\",\"name\":\"Validate BOM\",\"uid\":\"282\",\"id\":\"282\"},{\"id_application_action\":\"298\",\"name\":\"View Join item\",\"uid\":\"283\",\"id\":\"283\"},{\"id_application_action\":\"299\",\"name\":\"Create Join Item\",\"uid\":\"284\",\"id\":\"284\"},{\"id_application_action\":\"300\",\"name\":\"Edit Join Item\",\"uid\":\"285\",\"id\":\"285\"},{\"id_application_action\":\"301\",\"name\":\"Delete Join Item\",\"uid\":\"286\",\"id\":\"286\"},{\"id_application_action\":\"302\",\"name\":\"Save\\/Edit Joint Item\",\"uid\":\"287\",\"id\":\"287\"},{\"id_application_action\":\"303\",\"name\":\"Transfer Join Item\",\"uid\":\"288\",\"id\":\"288\"},{\"id_application_action\":\"304\",\"name\":\"View Group\",\"uid\":\"289\",\"id\":\"289\"},{\"id_application_action\":\"305\",\"name\":\"Create Group\",\"uid\":\"290\",\"id\":\"290\"},{\"id_application_action\":\"306\",\"name\":\"Edit Group\",\"uid\":\"291\",\"id\":\"291\"},{\"id_application_action\":\"307\",\"name\":\"Delete Group\",\"uid\":\"292\",\"id\":\"292\"},{\"id_application_action\":\"308\",\"name\":\"Save\\/Edit Group\",\"uid\":\"293\",\"id\":\"293\"},{\"id_application_action\":\"309\",\"name\":\"View Configuration Parameter\",\"uid\":\"294\",\"id\":\"294\"},{\"id_application_action\":\"310\",\"name\":\"Create Configuration Parameter\",\"uid\":\"295\",\"id\":\"295\"},{\"id_application_action\":\"311\",\"name\":\"Edit Configuration Parameter\",\"uid\":\"296\",\"id\":\"296\"},{\"id_application_action\":\"312\",\"name\":\"Delete Configuration Parameter\",\"uid\":\"297\",\"id\":\"297\"},{\"id_application_action\":\"313\",\"name\":\"Save\\/Edit Configuration Parameter\",\"uid\":\"298\",\"id\":\"298\"},{\"id_application_action\":\"314\",\"name\":\"VIew Notification Setting\",\"uid\":\"299\",\"id\":\"299\"},{\"id_application_action\":\"315\",\"name\":\"Create Notification Setting\",\"uid\":\"300\",\"id\":\"300\"},{\"id_application_action\":\"316\",\"name\":\"Edit Notification Setting\",\"uid\":\"301\",\"id\":\"301\"},{\"id_application_action\":\"317\",\"name\":\"Delete Notification Setting\",\"uid\":\"302\",\"id\":\"302\"},{\"id_application_action\":\"318\",\"name\":\"Save\\/Edit Notification Setting\",\"uid\":\"303\",\"id\":\"303\"},{\"id_application_action\":\"292\",\"name\":\"View BOM\",\"uid\":\"304\",\"id\":\"304\"}],\"is_edit\":\"true\",\"id_role\":\"1\"}', '2015-03-20 16:31:03');
INSERT INTO `activity_log` VALUES ('189', 'Save/Edit Side Menu', 'side_menu', null, '2', 'Save/Edit Side Menu', '9', '{}', '2015-03-20 16:31:35');
INSERT INTO `activity_log` VALUES ('190', 'Save/Edit Side Menu', 'side_menu', null, '2', 'Save/Edit Side Menu', '9', '{}', '2015-03-20 16:31:49');
INSERT INTO `activity_log` VALUES ('191', 'Save/Edit Side Menu', 'side_menu', null, '2', 'Save/Edit Side Menu', '9', '{}', '2015-03-20 16:32:07');
INSERT INTO `activity_log` VALUES ('192', 'Save/Edit Group', 'group', null, '2', 'Save/Edit Group', '308', '{\"name\":\"Group Test\",\"description\":\"Testing Group\",\"administrator\":\"2\",\"is_edit\":\"false\",\"id_group\":\"\",\"group_member\":[{\"id_user\":\"42\",\"user_name\":\"test\",\"full_name\":\"Test Account\",\"uid\":\"0\",\"0\":\"0\"},{\"id_user\":\"43\",\"user_name\":\"userdemo\",\"full_name\":\"Demo User\",\"uid\":\"1\",\"0\":\"1\"},{\"id_user\":\"46\",\"user_name\":\"devteam\",\"full_name\":\"Development Team\",\"uid\":\"2\",\"0\":\"2\"}]}', '2015-03-20 16:43:50');
INSERT INTO `activity_log` VALUES ('193', 'Save/Edit Side Menu', 'side_menu', null, '2', 'Save/Edit Side Menu', '9', '{}', '2015-03-20 21:47:09');
INSERT INTO `activity_log` VALUES ('194', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"View Product Definition\",\"uname\":\"view_product_definition\",\"controller\":\"product\",\"function_exec\":\"\",\"function_args\":\"\",\"view_type\":\"gridview\",\"view_file\":\"product_definition_list\",\"prefix\":\"\",\"action_type\":\"create\",\"action_button\":\"crud\",\"target_action\":\"\",\"use_log\":\"0\",\"is_edit\":\"false\",\"id_edit\":\"\"}', '2015-03-21 21:03:06');
INSERT INTO `activity_log` VALUES ('195', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"Create Product Definition\",\"uname\":\"create_product_definition\",\"controller\":\"product\",\"function_exec\":\"init_create_product_definition\",\"function_args\":\"\",\"view_type\":\"form\",\"view_file\":\"product_definition_ce\",\"prefix\":\"\",\"action_type\":\"view\",\"action_button\":\"save_discard\",\"target_action\":\"\",\"use_log\":\"0\",\"is_edit\":\"false\",\"id_edit\":\"\"}', '2015-03-21 21:46:42');
INSERT INTO `activity_log` VALUES ('196', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"Edit Product Definition\",\"uname\":\"edit_product_definition\",\"controller\":\"product\",\"function_exec\":\"init_edit_product_definition\",\"function_args\":\"id\",\"view_type\":\"form\",\"view_file\":\"product_definition_ce\",\"prefix\":\"\",\"action_type\":\"view\",\"action_button\":\"save_discard\",\"target_action\":\"\",\"use_log\":\"0\",\"is_edit\":\"false\",\"id_edit\":\"\"}', '2015-03-21 21:47:19');
INSERT INTO `activity_log` VALUES ('197', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"Delete Product Definition\",\"uname\":\"delete_product_definition\",\"controller\":\"product_definition\",\"function_exec\":\"\",\"function_args\":\"\",\"view_type\":\"no_view\",\"view_file\":\"\",\"prefix\":\"\",\"action_type\":\"delete\",\"action_button\":\"no_button\",\"target_action\":\"319\",\"use_log\":\"1\",\"is_edit\":\"false\",\"id_edit\":\"\"}', '2015-03-21 21:48:09');
INSERT INTO `activity_log` VALUES ('198', 'Save/Edit Action', 'action', null, '2', 'Save/Edit Action', '10', '{\"name\":\"Save\\/Edit Product Definition\",\"uname\":\"save_edit_product_definition\",\"controller\":\"product\",\"function_exec\":\"save_product_definition\",\"function_args\":\"\",\"view_type\":\"no_view\",\"view_file\":\"\",\"prefix\":\"\",\"action_type\":\"create\",\"action_button\":\"no_button\",\"target_action\":\"319\",\"use_log\":\"1\",\"is_edit\":\"false\",\"id_edit\":\"\"}', '2015-03-21 21:49:10');
INSERT INTO `activity_log` VALUES ('199', 'Save/Edit Role', 'role', null, '2', 'Save/Edit Role', '20', '{\"name\":\"administrator\",\"action_detail\":[{\"id_application_action\":\"1\",\"action\":\"1\",\"name\":\"View Application Action\",\"uid\":\"0\"},{\"id_application_action\":\"2\",\"action\":\"2\",\"name\":\"Create Application Action\",\"uid\":\"1\"},{\"id_application_action\":\"3\",\"action\":\"3\",\"name\":\"Edit Application Action\",\"uid\":\"2\"},{\"id_application_action\":\"4\",\"action\":\"4\",\"name\":\"Delete Application Action\",\"uid\":\"3\"},{\"id_application_action\":\"5\",\"action\":\"5\",\"name\":\"View Side Menu\",\"uid\":\"4\"},{\"id_application_action\":\"6\",\"action\":\"6\",\"name\":\"Create Side Menu\",\"uid\":\"5\"},{\"id_application_action\":\"7\",\"action\":\"7\",\"name\":\"Edit Side Menu\",\"uid\":\"6\"},{\"id_application_action\":\"8\",\"action\":\"8\",\"name\":\"Delete Side Menu\",\"uid\":\"7\"},{\"id_application_action\":\"9\",\"action\":\"9\",\"name\":\"Save\\/Edit Side Menu\",\"uid\":\"8\"},{\"id_application_action\":\"10\",\"action\":\"10\",\"name\":\"Save\\/Edit Action\",\"uid\":\"9\"},{\"id_application_action\":\"11\",\"action\":\"11\",\"name\":\"View Division\",\"uid\":\"10\"},{\"id_application_action\":\"12\",\"action\":\"12\",\"name\":\"Create Division\",\"uid\":\"11\"},{\"id_application_action\":\"13\",\"action\":\"13\",\"name\":\"Save\\/Edit Division\",\"uid\":\"12\"},{\"id_application_action\":\"14\",\"action\":\"14\",\"name\":\"Edit Division\",\"uid\":\"13\"},{\"id_application_action\":\"15\",\"action\":\"15\",\"name\":\"Delete Division\",\"uid\":\"14\"},{\"id_application_action\":\"16\",\"action\":\"16\",\"name\":\"View Role\",\"uid\":\"15\"},{\"id_application_action\":\"17\",\"action\":\"17\",\"name\":\"View Create Role\",\"uid\":\"16\"},{\"id_application_action\":\"18\",\"action\":\"18\",\"name\":\"View Edit Role\",\"uid\":\"17\"},{\"id_application_action\":\"19\",\"action\":\"19\",\"name\":\"Delete Role\",\"uid\":\"18\"},{\"id_application_action\":\"20\",\"action\":\"20\",\"name\":\"Save\\/Edit Role\",\"uid\":\"19\"},{\"id_application_action\":\"21\",\"action\":\"21\",\"name\":\"View Product\",\"uid\":\"20\"},{\"id_application_action\":\"22\",\"action\":\"22\",\"name\":\"Create Product\",\"uid\":\"21\"},{\"id_application_action\":\"23\",\"action\":\"23\",\"name\":\"Edit Product\",\"uid\":\"22\"},{\"id_application_action\":\"24\",\"action\":\"24\",\"name\":\"Delete Product\",\"uid\":\"23\"},{\"id_application_action\":\"25\",\"action\":\"25\",\"name\":\"Save\\/Edit Product\",\"uid\":\"24\"},{\"id_application_action\":\"26\",\"action\":\"26\",\"name\":\"View Supplier\",\"uid\":\"25\"},{\"id_application_action\":\"27\",\"action\":\"27\",\"name\":\"Create Supplier\",\"uid\":\"26\"},{\"id_application_action\":\"28\",\"action\":\"28\",\"name\":\"Edit Supplier\",\"uid\":\"27\"},{\"id_application_action\":\"29\",\"action\":\"29\",\"name\":\"Delete Supplier\",\"uid\":\"28\"},{\"id_application_action\":\"30\",\"action\":\"30\",\"name\":\"Save\\/Edit Supplier\",\"uid\":\"29\"},{\"id_application_action\":\"31\",\"action\":\"31\",\"name\":\"View Product Category\",\"uid\":\"30\"},{\"id_application_action\":\"32\",\"action\":\"32\",\"name\":\"Create Product Category\",\"uid\":\"31\"},{\"id_application_action\":\"33\",\"action\":\"33\",\"name\":\"Edit Product Category\",\"uid\":\"32\"},{\"id_application_action\":\"34\",\"action\":\"34\",\"name\":\"Delete Product Category\",\"uid\":\"33\"},{\"id_application_action\":\"35\",\"action\":\"35\",\"name\":\"Save\\/Edit Product Category\",\"uid\":\"34\"},{\"id_application_action\":\"36\",\"action\":\"36\",\"name\":\"View Merk\",\"uid\":\"35\"},{\"id_application_action\":\"37\",\"action\":\"37\",\"name\":\"Create Merk\",\"uid\":\"36\"},{\"id_application_action\":\"38\",\"action\":\"38\",\"name\":\"Edit Merk\",\"uid\":\"37\"},{\"id_application_action\":\"39\",\"action\":\"39\",\"name\":\"Delete Merk\",\"uid\":\"38\"},{\"id_application_action\":\"40\",\"action\":\"40\",\"name\":\"Save\\/Edit Merk\",\"uid\":\"39\"},{\"id_application_action\":\"41\",\"action\":\"41\",\"name\":\"View Customer\",\"uid\":\"40\"},{\"id_application_action\":\"43\",\"action\":\"43\",\"name\":\"Create Customer\",\"uid\":\"41\"},{\"id_application_action\":\"44\",\"action\":\"44\",\"name\":\"Edit Customer\",\"uid\":\"42\"},{\"id_application_action\":\"45\",\"action\":\"45\",\"name\":\"Delete Customer\",\"uid\":\"43\"},{\"id_application_action\":\"46\",\"action\":\"46\",\"name\":\"Save\\/Edit Customer\",\"uid\":\"44\"},{\"id_application_action\":\"47\",\"action\":\"47\",\"name\":\"View Warehouse\",\"uid\":\"45\"},{\"id_application_action\":\"48\",\"action\":\"48\",\"name\":\"Create Warehouse\",\"uid\":\"46\"},{\"id_application_action\":\"49\",\"action\":\"49\",\"name\":\"Edit Warehouse\",\"uid\":\"47\"},{\"id_application_action\":\"50\",\"action\":\"50\",\"name\":\"Delete Warehouse\",\"uid\":\"48\"},{\"id_application_action\":\"51\",\"action\":\"51\",\"name\":\"Save\\/Edit Warehouse\",\"uid\":\"49\"},{\"id_application_action\":\"57\",\"action\":\"57\",\"name\":\"View PO\",\"uid\":\"50\"},{\"id_application_action\":\"58\",\"action\":\"58\",\"name\":\"Create PO\",\"uid\":\"51\"},{\"id_application_action\":\"59\",\"action\":\"59\",\"name\":\"Edit PO\",\"uid\":\"52\"},{\"id_application_action\":\"60\",\"action\":\"60\",\"name\":\"Delete PO\",\"uid\":\"53\"},{\"id_application_action\":\"61\",\"action\":\"61\",\"name\":\"Save\\/Edit PO\",\"uid\":\"54\"},{\"id_application_action\":\"62\",\"action\":\"62\",\"name\":\"View User\",\"uid\":\"55\"},{\"id_application_action\":\"63\",\"action\":\"63\",\"name\":\"Create User\",\"uid\":\"56\"},{\"id_application_action\":\"64\",\"action\":\"64\",\"name\":\"Edit User\",\"uid\":\"57\"},{\"id_application_action\":\"65\",\"action\":\"65\",\"name\":\"Delete User\",\"uid\":\"58\"},{\"id_application_action\":\"66\",\"action\":\"66\",\"name\":\"Save\\/Edit User\",\"uid\":\"59\"},{\"id_application_action\":\"67\",\"action\":\"67\",\"name\":\"View Good Receive\",\"uid\":\"60\"},{\"id_application_action\":\"68\",\"action\":\"68\",\"name\":\"Create Good Receive\",\"uid\":\"61\"},{\"id_application_action\":\"69\",\"action\":\"69\",\"name\":\"Edit Good Receive\",\"uid\":\"62\"},{\"id_application_action\":\"70\",\"action\":\"70\",\"name\":\"Delete Good Receive\",\"uid\":\"63\"},{\"id_application_action\":\"71\",\"action\":\"71\",\"name\":\"Save\\/Edit Good Receive\",\"uid\":\"64\"},{\"id_application_action\":\"72\",\"action\":\"72\",\"name\":\"View Sales Order\",\"uid\":\"65\"},{\"id_application_action\":\"73\",\"action\":\"73\",\"name\":\"Create Sales Order\",\"uid\":\"66\"},{\"id_application_action\":\"74\",\"action\":\"74\",\"name\":\"Edit Sales Order\",\"uid\":\"67\"},{\"id_application_action\":\"75\",\"action\":\"75\",\"name\":\"Delete Sales Order\",\"uid\":\"68\"},{\"id_application_action\":\"76\",\"action\":\"76\",\"name\":\"Save Sales Order\",\"uid\":\"69\"},{\"id_application_action\":\"77\",\"action\":\"77\",\"name\":\"View Material Request\",\"uid\":\"70\"},{\"id_application_action\":\"78\",\"action\":\"78\",\"name\":\"Create Material Request\",\"uid\":\"71\"},{\"id_application_action\":\"79\",\"action\":\"79\",\"name\":\"Edit Material Request\",\"uid\":\"72\"},{\"id_application_action\":\"80\",\"action\":\"80\",\"name\":\"Delete Material Request\",\"uid\":\"73\"},{\"id_application_action\":\"81\",\"action\":\"81\",\"name\":\"Save Material Request\",\"uid\":\"74\"},{\"id_application_action\":\"82\",\"action\":\"82\",\"name\":\"Change User Password\",\"uid\":\"75\"},{\"id_application_action\":\"83\",\"action\":\"83\",\"name\":\"View Delivery Note\",\"uid\":\"76\"},{\"id_application_action\":\"84\",\"action\":\"84\",\"name\":\"Create Delivery Note\",\"uid\":\"77\"},{\"id_application_action\":\"85\",\"action\":\"85\",\"name\":\"Edit Delivery Note\",\"uid\":\"78\"},{\"id_application_action\":\"86\",\"action\":\"86\",\"name\":\"Delete Delivery Note\",\"uid\":\"79\"},{\"id_application_action\":\"87\",\"action\":\"87\",\"name\":\"Save\\/Edit Delivery Note\",\"uid\":\"80\"},{\"id_application_action\":\"88\",\"action\":\"88\",\"name\":\"View Unit Measure\",\"uid\":\"81\"},{\"id_application_action\":\"89\",\"action\":\"89\",\"name\":\"Create Unit Measure\",\"uid\":\"82\"},{\"id_application_action\":\"90\",\"action\":\"90\",\"name\":\"Edit Unit Measure\",\"uid\":\"83\"},{\"id_application_action\":\"91\",\"action\":\"91\",\"name\":\"Delete Unit Measure\",\"uid\":\"84\"},{\"id_application_action\":\"92\",\"action\":\"92\",\"name\":\"Save\\/Edit Unit Measure\",\"uid\":\"85\"},{\"id_application_action\":\"93\",\"action\":\"93\",\"name\":\"View Stock\",\"uid\":\"86\"},{\"id_application_action\":\"94\",\"action\":\"94\",\"name\":\"View Employee\",\"uid\":\"87\"},{\"id_application_action\":\"95\",\"action\":\"95\",\"name\":\"Create Employee\",\"uid\":\"88\"},{\"id_application_action\":\"96\",\"action\":\"96\",\"name\":\"Edit Employee\",\"uid\":\"89\"},{\"id_application_action\":\"97\",\"action\":\"97\",\"name\":\"Delete Employee\",\"uid\":\"90\"},{\"id_application_action\":\"98\",\"action\":\"98\",\"name\":\"Save\\/Edit Employee\",\"uid\":\"91\"},{\"id_application_action\":\"99\",\"action\":\"99\",\"name\":\"Validate PO\",\"uid\":\"92\"},{\"id_application_action\":\"100\",\"action\":\"100\",\"name\":\"Create Database Interface\",\"uid\":\"93\"},{\"id_application_action\":\"101\",\"action\":\"101\",\"name\":\"Edit Database Interface\",\"uid\":\"94\"},{\"id_application_action\":\"102\",\"action\":\"102\",\"name\":\"Delete Database Interface\",\"uid\":\"95\"},{\"id_application_action\":\"103\",\"action\":\"103\",\"name\":\"Save \\/ Edit Database Interface\",\"uid\":\"96\"},{\"id_application_action\":\"104\",\"action\":\"104\",\"name\":\"View Database Field Interface\",\"uid\":\"97\"},{\"id_application_action\":\"105\",\"action\":\"105\",\"name\":\"Create Database Field Interface\",\"uid\":\"98\"},{\"id_application_action\":\"106\",\"action\":\"106\",\"name\":\"Edit Database Field Interface\",\"uid\":\"99\"},{\"id_application_action\":\"107\",\"action\":\"107\",\"name\":\"Delete Database Field Interface\",\"uid\":\"100\"},{\"id_application_action\":\"108\",\"action\":\"108\",\"name\":\"Save \\/ Edit Database Field Interface\",\"uid\":\"101\"},{\"id_application_action\":\"109\",\"action\":\"109\",\"name\":\"View Inquiry\",\"uid\":\"102\"},{\"id_application_action\":\"110\",\"action\":\"110\",\"name\":\"Create Inquiry\",\"uid\":\"103\"},{\"id_application_action\":\"111\",\"action\":\"111\",\"name\":\"Edit Inquiry\",\"uid\":\"104\"},{\"id_application_action\":\"112\",\"action\":\"112\",\"name\":\"Delete Inquiry\",\"uid\":\"105\"},{\"id_application_action\":\"113\",\"action\":\"113\",\"name\":\"Save\\/Edit Inquiry\",\"uid\":\"106\"},{\"id_application_action\":\"114\",\"action\":\"114\",\"name\":\"View Survey \\/ Assessment\",\"uid\":\"107\"},{\"id_application_action\":\"115\",\"action\":\"115\",\"name\":\"Create Survey \\/ Assessment\",\"uid\":\"108\"},{\"id_application_action\":\"116\",\"action\":\"116\",\"name\":\"Edit Survey \\/ Assessment\",\"uid\":\"109\"},{\"id_application_action\":\"117\",\"action\":\"117\",\"name\":\"Delete Survey \\/ Assessment\",\"uid\":\"110\"},{\"id_application_action\":\"118\",\"action\":\"118\",\"name\":\"Save\\/Edit Survey \\/ Assessment\",\"uid\":\"111\"},{\"id_application_action\":\"119\",\"action\":\"119\",\"name\":\"View Quotation\",\"uid\":\"112\"},{\"id_application_action\":\"120\",\"action\":\"120\",\"name\":\"Create Quotation\",\"uid\":\"113\"},{\"id_application_action\":\"121\",\"action\":\"121\",\"name\":\"Edit Quotation\",\"uid\":\"114\"},{\"id_application_action\":\"122\",\"action\":\"122\",\"name\":\"Delete Quotation\",\"uid\":\"115\"},{\"id_application_action\":\"123\",\"action\":\"123\",\"name\":\"Save\\/Edit Quotation\",\"uid\":\"116\"},{\"id_application_action\":\"124\",\"action\":\"124\",\"name\":\"View Project Contract\",\"uid\":\"117\"},{\"id_application_action\":\"125\",\"action\":\"125\",\"name\":\"Create Project Contract\",\"uid\":\"118\"},{\"id_application_action\":\"126\",\"action\":\"126\",\"name\":\"Edit Project Contract\",\"uid\":\"119\"},{\"id_application_action\":\"127\",\"action\":\"127\",\"name\":\"Delete Project Contract\",\"uid\":\"120\"},{\"id_application_action\":\"128\",\"action\":\"128\",\"name\":\"Save\\/Edit Project Contract\",\"uid\":\"121\"},{\"id_application_action\":\"129\",\"action\":\"129\",\"name\":\"View Work Order\",\"uid\":\"122\"},{\"id_application_action\":\"130\",\"action\":\"130\",\"name\":\"Create Work Order\",\"uid\":\"123\"},{\"id_application_action\":\"131\",\"action\":\"131\",\"name\":\"Edit Work Order\",\"uid\":\"124\"},{\"id_application_action\":\"132\",\"action\":\"132\",\"name\":\"Delete Work Order\",\"uid\":\"125\"},{\"id_application_action\":\"133\",\"action\":\"133\",\"name\":\"Save\\/Edit Work Order\",\"uid\":\"126\"},{\"id_application_action\":\"134\",\"action\":\"134\",\"name\":\"View Assessment Template\",\"uid\":\"127\"},{\"id_application_action\":\"135\",\"action\":\"135\",\"name\":\"Create Assessment Template\",\"uid\":\"128\"},{\"id_application_action\":\"136\",\"action\":\"136\",\"name\":\"Edit Assessment Template\",\"uid\":\"129\"},{\"id_application_action\":\"137\",\"action\":\"137\",\"name\":\"Delete Assessment Template\",\"uid\":\"130\"},{\"id_application_action\":\"138\",\"action\":\"138\",\"name\":\"Save\\/Edit Assessment Template\",\"uid\":\"131\"},{\"id_application_action\":\"139\",\"action\":\"139\",\"name\":\"View Contract Template\",\"uid\":\"132\"},{\"id_application_action\":\"140\",\"action\":\"140\",\"name\":\"Create Contract Template\",\"uid\":\"133\"},{\"id_application_action\":\"141\",\"action\":\"141\",\"name\":\"Edit Contract Template\",\"uid\":\"134\"},{\"id_application_action\":\"142\",\"action\":\"142\",\"name\":\"Delete Contract Template\",\"uid\":\"135\"},{\"id_application_action\":\"143\",\"action\":\"143\",\"name\":\"Save\\/Edit Contract Template\",\"uid\":\"136\"},{\"id_application_action\":\"144\",\"action\":\"144\",\"name\":\"View Work Schedule\",\"uid\":\"137\"},{\"id_application_action\":\"145\",\"action\":\"145\",\"name\":\"Create Work Schedule\",\"uid\":\"138\"},{\"id_application_action\":\"146\",\"action\":\"146\",\"name\":\"Edit Work Schedule\",\"uid\":\"139\"},{\"id_application_action\":\"147\",\"action\":\"147\",\"name\":\"Delete Work Schedule\",\"uid\":\"140\"},{\"id_application_action\":\"148\",\"action\":\"148\",\"name\":\"Save\\/Edit Work Schedule\",\"uid\":\"141\"},{\"id_application_action\":\"149\",\"action\":\"149\",\"name\":\"View SO Assignment\",\"uid\":\"142\"},{\"id_application_action\":\"150\",\"action\":\"150\",\"name\":\"Create SO Assignment\",\"uid\":\"143\"},{\"id_application_action\":\"151\",\"action\":\"151\",\"name\":\"Edit SO Assignment\",\"uid\":\"144\"},{\"id_application_action\":\"152\",\"action\":\"152\",\"name\":\"Delete SO Assignment\",\"uid\":\"145\"},{\"id_application_action\":\"153\",\"action\":\"153\",\"name\":\"Save\\/Edit SO Assignment\",\"uid\":\"146\"},{\"id_application_action\":\"154\",\"action\":\"154\",\"name\":\"View Shift Change\",\"uid\":\"147\"},{\"id_application_action\":\"155\",\"action\":\"155\",\"name\":\"Create Shift Change\",\"uid\":\"148\"},{\"id_application_action\":\"156\",\"action\":\"156\",\"name\":\"Edit Shift Change\",\"uid\":\"149\"},{\"id_application_action\":\"157\",\"action\":\"157\",\"name\":\"Delete Shift Change\",\"uid\":\"150\"},{\"id_application_action\":\"158\",\"action\":\"158\",\"name\":\"Save\\/Edit Shift Change\",\"uid\":\"151\"},{\"id_application_action\":\"159\",\"action\":\"159\",\"name\":\"View Leave Application\",\"uid\":\"152\"},{\"id_application_action\":\"160\",\"action\":\"160\",\"name\":\"Create Leave Application\",\"uid\":\"153\"},{\"id_application_action\":\"161\",\"action\":\"161\",\"name\":\"Edit Leave Application\",\"uid\":\"154\"},{\"id_application_action\":\"162\",\"action\":\"162\",\"name\":\"Delete Leave Application\",\"uid\":\"155\"},{\"id_application_action\":\"163\",\"action\":\"163\",\"name\":\"Save\\/Edit Leave Application\",\"uid\":\"156\"},{\"id_application_action\":\"164\",\"action\":\"164\",\"name\":\"View Timesheet (Recap)\",\"uid\":\"157\"},{\"id_application_action\":\"165\",\"action\":\"165\",\"name\":\"Create Timesheet (Recap)\",\"uid\":\"158\"},{\"id_application_action\":\"166\",\"action\":\"166\",\"name\":\"Edit Timesheet (Recap)\",\"uid\":\"159\"},{\"id_application_action\":\"167\",\"action\":\"167\",\"name\":\"Delete Timesheet (Recap)\",\"uid\":\"160\"},{\"id_application_action\":\"168\",\"action\":\"168\",\"name\":\"Save\\/Edit Timesheet (Recap)\",\"uid\":\"161\"},{\"id_application_action\":\"169\",\"action\":\"169\",\"name\":\"View SO Timesheet\",\"uid\":\"162\"},{\"id_application_action\":\"170\",\"action\":\"170\",\"name\":\"Create SO Timesheet\",\"uid\":\"163\"},{\"id_application_action\":\"171\",\"action\":\"171\",\"name\":\"Edit SO Timesheet\",\"uid\":\"164\"},{\"id_application_action\":\"172\",\"action\":\"172\",\"name\":\"Delete SO Timesheet\",\"uid\":\"165\"},{\"id_application_action\":\"173\",\"action\":\"173\",\"name\":\"Save\\/Edit SO Timesheet\",\"uid\":\"166\"},{\"id_application_action\":\"174\",\"action\":\"174\",\"name\":\"View Incident Report\",\"uid\":\"167\"},{\"id_application_action\":\"175\",\"action\":\"175\",\"name\":\"Create Incident Report\",\"uid\":\"168\"},{\"id_application_action\":\"176\",\"action\":\"176\",\"name\":\"Edit Incident Report\",\"uid\":\"169\"},{\"id_application_action\":\"177\",\"action\":\"177\",\"name\":\"Delete Incident Report\",\"uid\":\"170\"},{\"id_application_action\":\"178\",\"action\":\"178\",\"name\":\"Save\\/Edit Incident Report\",\"uid\":\"171\"},{\"id_application_action\":\"179\",\"action\":\"179\",\"name\":\"View Payroll\",\"uid\":\"172\"},{\"id_application_action\":\"180\",\"action\":\"180\",\"name\":\"Create Payroll\",\"uid\":\"173\"},{\"id_application_action\":\"181\",\"action\":\"181\",\"name\":\"Edit Payroll\",\"uid\":\"174\"},{\"id_application_action\":\"182\",\"action\":\"182\",\"name\":\"Delete Payroll\",\"uid\":\"175\"},{\"id_application_action\":\"183\",\"action\":\"183\",\"name\":\"Save\\/Edit Payroll\",\"uid\":\"176\"},{\"id_application_action\":\"184\",\"action\":\"184\",\"name\":\"View Supplier Invoice\",\"uid\":\"177\"},{\"id_application_action\":\"185\",\"action\":\"185\",\"name\":\"Create Supplier Invoice\",\"uid\":\"178\"},{\"id_application_action\":\"186\",\"action\":\"186\",\"name\":\"Edit Supplier Invoice\",\"uid\":\"179\"},{\"id_application_action\":\"187\",\"action\":\"187\",\"name\":\"Delete Supplier Invoice\",\"uid\":\"180\"},{\"id_application_action\":\"188\",\"action\":\"188\",\"name\":\"Save\\/Edit Supplier Invoice\",\"uid\":\"181\"},{\"id_application_action\":\"189\",\"action\":\"189\",\"name\":\"View Customer Invoice\",\"uid\":\"182\"},{\"id_application_action\":\"190\",\"action\":\"190\",\"name\":\"Create Customer Invoice\",\"uid\":\"183\"},{\"id_application_action\":\"191\",\"action\":\"191\",\"name\":\"Edit Customer Invoice\",\"uid\":\"184\"},{\"id_application_action\":\"192\",\"action\":\"192\",\"name\":\"Delete Customer Invoice\",\"uid\":\"185\"},{\"id_application_action\":\"193\",\"action\":\"193\",\"name\":\"Save\\/Edit Customer Invoice\",\"uid\":\"186\"},{\"id_application_action\":\"194\",\"action\":\"194\",\"name\":\"View Bank Statement\",\"uid\":\"187\"},{\"id_application_action\":\"195\",\"action\":\"195\",\"name\":\"Create Bank Statement\",\"uid\":\"188\"},{\"id_application_action\":\"196\",\"action\":\"196\",\"name\":\"Edit Bank Statement\",\"uid\":\"189\"},{\"id_application_action\":\"197\",\"action\":\"197\",\"name\":\"Delete Bank Statement\",\"uid\":\"190\"},{\"id_application_action\":\"198\",\"action\":\"198\",\"name\":\"Save\\/Edit Bank Statement\",\"uid\":\"191\"},{\"id_application_action\":\"199\",\"action\":\"199\",\"name\":\"View Cash Register\",\"uid\":\"192\"},{\"id_application_action\":\"200\",\"action\":\"200\",\"name\":\"Create Cash Register\",\"uid\":\"193\"},{\"id_application_action\":\"201\",\"action\":\"201\",\"name\":\"Edit Cash Register\",\"uid\":\"194\"},{\"id_application_action\":\"202\",\"action\":\"202\",\"name\":\"Delete Cash Register\",\"uid\":\"195\"},{\"id_application_action\":\"203\",\"action\":\"203\",\"name\":\"Save\\/Edit Cash Register\",\"uid\":\"196\"},{\"id_application_action\":\"204\",\"action\":\"204\",\"name\":\"View Tax\",\"uid\":\"197\"},{\"id_application_action\":\"205\",\"action\":\"205\",\"name\":\"Create Tax\",\"uid\":\"198\"},{\"id_application_action\":\"206\",\"action\":\"206\",\"name\":\"Edit Tax\",\"uid\":\"199\"},{\"id_application_action\":\"207\",\"action\":\"207\",\"name\":\"Delete Tax\",\"uid\":\"200\"},{\"id_application_action\":\"208\",\"action\":\"208\",\"name\":\"Save\\/Edit Tax\",\"uid\":\"201\"},{\"id_application_action\":\"209\",\"action\":\"209\",\"name\":\"View Chart of Account\",\"uid\":\"202\"},{\"id_application_action\":\"210\",\"action\":\"210\",\"name\":\"Create Chart of Account\",\"uid\":\"203\"},{\"id_application_action\":\"211\",\"action\":\"211\",\"name\":\"Edit Chart of Account\",\"uid\":\"204\"},{\"id_application_action\":\"212\",\"action\":\"212\",\"name\":\"Delete Chart of Account\",\"uid\":\"205\"},{\"id_application_action\":\"213\",\"action\":\"213\",\"name\":\"Save\\/Edit Chart of Account\",\"uid\":\"206\"},{\"id_application_action\":\"214\",\"action\":\"214\",\"name\":\"View Employee Salary\",\"uid\":\"207\"},{\"id_application_action\":\"215\",\"action\":\"215\",\"name\":\"Create Employee Salary\",\"uid\":\"208\"},{\"id_application_action\":\"216\",\"action\":\"216\",\"name\":\"Edit Employee Salary\",\"uid\":\"209\"},{\"id_application_action\":\"217\",\"action\":\"217\",\"name\":\"Delete Employee Salary\",\"uid\":\"210\"},{\"id_application_action\":\"218\",\"action\":\"218\",\"name\":\"Save\\/Edit Employee Salary\",\"uid\":\"211\"},{\"id_application_action\":\"219\",\"action\":\"219\",\"name\":\"View Salary Setting\",\"uid\":\"212\"},{\"id_application_action\":\"220\",\"action\":\"220\",\"name\":\"Create Salary Setting\",\"uid\":\"213\"},{\"id_application_action\":\"221\",\"action\":\"221\",\"name\":\"Edit Salary Setting\",\"uid\":\"214\"},{\"id_application_action\":\"222\",\"action\":\"222\",\"name\":\"Delete Salary Setting\",\"uid\":\"215\"},{\"id_application_action\":\"223\",\"action\":\"223\",\"name\":\"Save\\/Edit Salary Setting\",\"uid\":\"216\"},{\"id_application_action\":\"224\",\"action\":\"224\",\"name\":\"View Database Interface\",\"uid\":\"217\"},{\"id_application_action\":\"225\",\"action\":\"225\",\"name\":\"Pick Assessment Template\",\"uid\":\"218\"},{\"id_application_action\":\"226\",\"action\":\"226\",\"name\":\"View Organisation Structure\",\"uid\":\"219\"},{\"id_application_action\":\"227\",\"action\":\"227\",\"name\":\"Create Organisation Structure\",\"uid\":\"220\"},{\"id_application_action\":\"228\",\"action\":\"228\",\"name\":\"Edit Organisation Structure\",\"uid\":\"221\"},{\"id_application_action\":\"229\",\"action\":\"229\",\"name\":\"Delete Organisation Structure\",\"uid\":\"222\"},{\"id_application_action\":\"230\",\"action\":\"230\",\"name\":\"Save\\/Edit Organisation Structure\",\"uid\":\"223\"},{\"id_application_action\":\"231\",\"action\":\"231\",\"name\":\"View Position Level\",\"uid\":\"224\"},{\"id_application_action\":\"232\",\"action\":\"232\",\"name\":\"Create Position Level\",\"uid\":\"225\"},{\"id_application_action\":\"233\",\"action\":\"233\",\"name\":\"Edit Position Level\",\"uid\":\"226\"},{\"id_application_action\":\"234\",\"action\":\"234\",\"name\":\"Delete Position Level\",\"uid\":\"227\"},{\"id_application_action\":\"235\",\"action\":\"235\",\"name\":\"Save\\/Edit Position Level\",\"uid\":\"228\"},{\"id_application_action\":\"236\",\"action\":\"236\",\"name\":\"View Employee Contract Type\",\"uid\":\"229\"},{\"id_application_action\":\"237\",\"action\":\"237\",\"name\":\"Create Employee Contract Type\",\"uid\":\"230\"},{\"id_application_action\":\"238\",\"action\":\"238\",\"name\":\"Edit Employee Contract Type\",\"uid\":\"231\"},{\"id_application_action\":\"239\",\"action\":\"239\",\"name\":\"Delete Employee Contract Type\",\"uid\":\"232\"},{\"id_application_action\":\"240\",\"action\":\"240\",\"name\":\"Save\\/Edit Employee Contract\",\"uid\":\"233\"},{\"id_application_action\":\"241\",\"action\":\"241\",\"name\":\"View Bank\",\"uid\":\"234\"},{\"id_application_action\":\"242\",\"action\":\"242\",\"name\":\"Create Bank\",\"uid\":\"235\"},{\"id_application_action\":\"243\",\"action\":\"243\",\"name\":\"Edit Bank\",\"uid\":\"236\"},{\"id_application_action\":\"244\",\"action\":\"244\",\"name\":\"Delete Bank\",\"uid\":\"237\"},{\"id_application_action\":\"245\",\"action\":\"245\",\"name\":\"Save\\/Edit Bank\",\"uid\":\"238\"},{\"id_application_action\":\"246\",\"action\":\"246\",\"name\":\"View Payment Receipt\",\"uid\":\"239\"},{\"id_application_action\":\"247\",\"action\":\"247\",\"name\":\"Create Payment Receipt\",\"uid\":\"240\"},{\"id_application_action\":\"248\",\"action\":\"248\",\"name\":\"Edit Payment Receipt\",\"uid\":\"241\"},{\"id_application_action\":\"249\",\"action\":\"249\",\"name\":\"Save\\/Edit Payment Receipt\",\"uid\":\"242\"},{\"id_application_action\":\"250\",\"action\":\"250\",\"name\":\"Delete Payment Receipt\",\"uid\":\"243\"},{\"id_application_action\":\"251\",\"action\":\"251\",\"name\":\"Receive Payment From PO\",\"uid\":\"244\"},{\"id_application_action\":\"252\",\"action\":\"252\",\"name\":\"Make Payment Receipt\",\"uid\":\"245\"},{\"id_application_action\":\"253\",\"action\":\"253\",\"name\":\"Cancel Payment Receipt\",\"uid\":\"246\"},{\"id_application_action\":\"254\",\"action\":\"254\",\"name\":\"View Stock Transaction\",\"uid\":\"247\"},{\"id_application_action\":\"255\",\"action\":\"255\",\"name\":\"Create Stock Transaction\",\"uid\":\"248\"},{\"id_application_action\":\"256\",\"action\":\"256\",\"name\":\"Edit Stock Transaction\",\"uid\":\"249\"},{\"id_application_action\":\"257\",\"action\":\"257\",\"name\":\"Delete Stock Transaction\",\"uid\":\"250\"},{\"id_application_action\":\"258\",\"action\":\"258\",\"name\":\"Save\\/Edit Stock Transaction\",\"uid\":\"251\"},{\"id_application_action\":\"259\",\"action\":\"259\",\"name\":\"Post Stock Transaction\",\"uid\":\"252\"},{\"id_application_action\":\"260\",\"action\":\"260\",\"name\":\"Unpost Stock Transaction\",\"uid\":\"253\"},{\"id_application_action\":\"261\",\"action\":\"261\",\"name\":\"Transfer Good Receive\",\"uid\":\"254\"},{\"id_application_action\":\"262\",\"action\":\"262\",\"name\":\"View Activity\",\"uid\":\"255\"},{\"id_application_action\":\"263\",\"action\":\"263\",\"name\":\"Make Working Schedule\",\"uid\":\"256\"},{\"id_application_action\":\"264\",\"action\":\"264\",\"name\":\"Validate Inquiry\",\"uid\":\"257\"},{\"id_application_action\":\"265\",\"action\":\"265\",\"name\":\"Validate Quotation\",\"uid\":\"258\"},{\"id_application_action\":\"267\",\"action\":\"267\",\"name\":\"Confirm Sales Order\",\"uid\":\"259\"},{\"id_application_action\":\"266\",\"action\":\"266\",\"name\":\"Validate Sales Order\",\"uid\":\"260\"},{\"id_application_action\":\"268\",\"action\":\"268\",\"name\":\"View Fingerprint Device\",\"uid\":\"261\"},{\"id_application_action\":\"269\",\"action\":\"269\",\"name\":\"Create Fingerprint Device\",\"uid\":\"262\"},{\"id_application_action\":\"270\",\"action\":\"270\",\"name\":\"Edit Fingerprint Device\",\"uid\":\"263\"},{\"id_application_action\":\"271\",\"action\":\"271\",\"name\":\"Delete Fingerprint Device\",\"uid\":\"264\"},{\"id_application_action\":\"272\",\"action\":\"272\",\"name\":\"Save\\/Edit Fingerprint Device\",\"uid\":\"265\"},{\"id_application_action\":\"273\",\"action\":\"273\",\"name\":\"Activate Fingerprint\",\"uid\":\"266\"},{\"id_application_action\":\"274\",\"action\":\"274\",\"name\":\"Deactivate Fingerprint\",\"uid\":\"267\"},{\"id_application_action\":\"275\",\"action\":\"275\",\"name\":\"View Fingerprint Assign\",\"uid\":\"268\"},{\"id_application_action\":\"276\",\"action\":\"276\",\"name\":\"Create Fingerprint Assign\",\"uid\":\"269\"},{\"id_application_action\":\"277\",\"action\":\"277\",\"name\":\"Edit Fingerprint Assign\",\"uid\":\"270\"},{\"id_application_action\":\"278\",\"action\":\"278\",\"name\":\"Delete Fingerprint Assign\",\"uid\":\"271\"},{\"id_application_action\":\"279\",\"action\":\"279\",\"name\":\"Save\\/Edit Fingerprint Assign\",\"uid\":\"272\"},{\"id_application_action\":\"280\",\"action\":\"280\",\"name\":\"Make SO Assignment\",\"uid\":\"273\"},{\"id_application_action\":\"281\",\"action\":\"281\",\"name\":\"Assign Fingerprint Device\",\"uid\":\"274\"},{\"id_application_action\":\"282\",\"action\":\"282\",\"name\":\"Unassign Fingerprint\",\"uid\":\"275\"},{\"id_application_action\":\"283\",\"action\":\"283\",\"name\":\"Fingerprint Enroll\",\"uid\":\"276\"},{\"id_application_action\":\"284\",\"action\":\"284\",\"name\":\"Save Fingerprint Enroll\",\"uid\":\"277\"},{\"id_application_action\":\"293\",\"action\":\"293\",\"name\":\"Create BOM\",\"uid\":\"278\"},{\"id_application_action\":\"294\",\"action\":\"294\",\"name\":\"Edit BOM\",\"uid\":\"279\"},{\"id_application_action\":\"295\",\"action\":\"295\",\"name\":\"Delete BOM\",\"uid\":\"280\"},{\"id_application_action\":\"296\",\"action\":\"296\",\"name\":\"Save\\/Edit BOM\",\"uid\":\"281\"},{\"id_application_action\":\"297\",\"action\":\"297\",\"name\":\"Validate BOM\",\"uid\":\"282\"},{\"id_application_action\":\"298\",\"action\":\"298\",\"name\":\"View Join item\",\"uid\":\"283\"},{\"id_application_action\":\"299\",\"action\":\"299\",\"name\":\"Create Join Item\",\"uid\":\"284\"},{\"id_application_action\":\"300\",\"action\":\"300\",\"name\":\"Edit Join Item\",\"uid\":\"285\"},{\"id_application_action\":\"301\",\"action\":\"301\",\"name\":\"Delete Join Item\",\"uid\":\"286\"},{\"id_application_action\":\"302\",\"action\":\"302\",\"name\":\"Save\\/Edit Joint Item\",\"uid\":\"287\"},{\"id_application_action\":\"303\",\"action\":\"303\",\"name\":\"Transfer Join Item\",\"uid\":\"288\"},{\"id_application_action\":\"304\",\"action\":\"304\",\"name\":\"View Group\",\"uid\":\"289\"},{\"id_application_action\":\"305\",\"action\":\"305\",\"name\":\"Create Group\",\"uid\":\"290\"},{\"id_application_action\":\"306\",\"action\":\"306\",\"name\":\"Edit Group\",\"uid\":\"291\"},{\"id_application_action\":\"307\",\"action\":\"307\",\"name\":\"Delete Group\",\"uid\":\"292\"},{\"id_application_action\":\"308\",\"action\":\"308\",\"name\":\"Save\\/Edit Group\",\"uid\":\"293\"},{\"id_application_action\":\"309\",\"action\":\"309\",\"name\":\"View Configuration Parameter\",\"uid\":\"294\"},{\"id_application_action\":\"310\",\"action\":\"310\",\"name\":\"Create Configuration Parameter\",\"uid\":\"295\"},{\"id_application_action\":\"311\",\"action\":\"311\",\"name\":\"Edit Configuration Parameter\",\"uid\":\"296\"},{\"id_application_action\":\"312\",\"action\":\"312\",\"name\":\"Delete Configuration Parameter\",\"uid\":\"297\"},{\"id_application_action\":\"313\",\"action\":\"313\",\"name\":\"Save\\/Edit Configuration Parameter\",\"uid\":\"298\"},{\"id_application_action\":\"314\",\"action\":\"314\",\"name\":\"VIew Notification Setting\",\"uid\":\"299\"},{\"id_application_action\":\"315\",\"action\":\"315\",\"name\":\"Create Notification Setting\",\"uid\":\"300\"},{\"id_application_action\":\"316\",\"action\":\"316\",\"name\":\"Edit Notification Setting\",\"uid\":\"301\"},{\"id_application_action\":\"317\",\"action\":\"317\",\"name\":\"Delete Notification Setting\",\"uid\":\"302\"},{\"id_application_action\":\"318\",\"action\":\"318\",\"name\":\"Save\\/Edit Notification Setting\",\"uid\":\"303\"},{\"id_application_action\":\"292\",\"action\":\"292\",\"name\":\"View BOM\",\"uid\":\"304\"},{\"id_application_action\":\"320\",\"name\":\"Create Product Definition\",\"uid\":\"305\",\"id\":\"305\"},{\"id_application_action\":\"321\",\"name\":\"Edit Product Definition\",\"uid\":\"306\",\"id\":\"306\"},{\"id_application_action\":\"322\",\"name\":\"Delete Product Definition\",\"uid\":\"307\",\"id\":\"307\"},{\"id_application_action\":\"323\",\"name\":\"Save\\/Edit Product Definition\",\"uid\":\"308\",\"id\":\"308\"},{\"id_application_action\":\"319\",\"name\":\"View Product Definition\",\"uid\":\"309\",\"id\":\"309\"}],\"is_edit\":\"true\",\"id_role\":\"1\"}', '2015-03-22 00:33:35');
INSERT INTO `activity_log` VALUES ('200', 'Save/Edit Organisation Structure', 'organisation_structure', null, '2', 'Save/Edit Organisation Structure', '230', '{}', '2015-03-22 08:32:12');
INSERT INTO `activity_log` VALUES ('201', 'Save/Edit Organisation Structure', 'organisation_structure', null, '2', 'Save/Edit Organisation Structure', '230', '{}', '2015-03-22 08:32:28');
INSERT INTO `activity_log` VALUES ('202', 'Save/Edit Organisation Structure', 'organisation_structure', null, '2', 'Save/Edit Organisation Structure', '230', '{}', '2015-03-22 08:32:48');
INSERT INTO `activity_log` VALUES ('203', 'Save/Edit Product Definition', 'product_definition', null, '2', 'Save/Edit Product Definition', '323', '{\"product\":\"4\",\"organisation_structure\":\"11\",\"position_level\":null}', '2015-03-23 23:52:49');
INSERT INTO `activity_log` VALUES ('204', 'Save/Edit Product Definition', 'product_definition', null, '2', 'Save/Edit Product Definition', '323', '{\"product\":\"4\",\"organisation_structure\":\"11\",\"position_level\":\"2\"}', '2015-03-23 23:52:54');
INSERT INTO `activity_log` VALUES ('205', 'Save/Edit Product Definition', 'product_definition', null, '2', 'Save/Edit Product Definition', '323', '{\"product\":\"4\",\"organisation_structure\":\"11\",\"position_level\":null}', '2015-03-23 23:52:59');
INSERT INTO `activity_log` VALUES ('206', 'Save/Edit Product Definition', 'product_definition', null, '2', 'Save/Edit Product Definition', '323', '{\"product\":\"4\",\"organisation_structure\":\"11\",\"position_level\":null}', '2015-03-24 00:11:28');
INSERT INTO `activity_log` VALUES ('207', 'Save/Edit Side Menu', 'side_menu', null, '2', 'Save/Edit Side Menu', '9', '{}', '2015-03-24 13:05:20');
INSERT INTO `activity_log` VALUES ('208', 'Save/Edit Side Menu', 'side_menu', null, '2', 'Save/Edit Side Menu', '9', '{}', '2015-03-24 13:05:35');
INSERT INTO `activity_log` VALUES ('209', 'Save/Edit Side Menu', 'side_menu', null, '2', 'Save/Edit Side Menu', '9', '{}', '2015-03-24 13:06:04');
INSERT INTO `activity_log` VALUES ('210', 'Unassign Fingerprint', 'fingerprint_assign', null, '2', 'Unassign Fingerprint', '282', '{}', '2015-03-24 14:12:12');
INSERT INTO `activity_log` VALUES ('211', 'Unassign Fingerprint', 'fingerprint_assign', null, '2', 'Unassign Fingerprint', '282', '{}', '2015-03-24 14:12:18');
INSERT INTO `activity_log` VALUES ('212', 'Unassign Fingerprint', 'fingerprint_assign', null, '2', 'Unassign Fingerprint', '282', '{}', '2015-03-24 14:12:39');
INSERT INTO `activity_log` VALUES ('213', 'Unassign Fingerprint', 'fingerprint_assign', null, '2', 'Unassign Fingerprint', '282', '{}', '2015-03-24 14:12:43');
INSERT INTO `activity_log` VALUES ('214', 'Unassign Fingerprint', 'fingerprint_assign', null, '2', 'Unassign Fingerprint', '282', '{}', '2015-03-24 14:13:17');
INSERT INTO `activity_log` VALUES ('215', 'Save/Edit Side Menu', 'side_menu', null, '2', 'Save/Edit Side Menu', '9', '{}', '2015-03-24 14:13:43');
INSERT INTO `activity_log` VALUES ('216', 'Save/Edit Fingerprint Assign', 'fingerprint_assign', null, '2', 'Save/Edit Fingerprint Assign', '279', '{\"work_order\":\"1\",\"work_order_number\":\"WO150001\",\"site\":\"1\",\"fingerprint_devices\":[{\"id_fingerprint_device\":\"1\",\"merk\":\"Fingerplus\",\"series\":\"ZT1800\",\"serial_number\":\"0266142700024\",\"uid\":\"0\",\"fingerprint_device\":\"1\",\"ip_local\":\"192.168.1.11\",\"port\":\"4370\",\"comm_password\":\"111111\",\"fdid\":\"1\",\"id_fingerprint_assign\":\"0\"}],\"is_edit\":\"false\",\"id_fingerprint_assign\":\"\"}', '2015-03-24 14:35:59');
INSERT INTO `activity_log` VALUES ('217', 'Save/Edit Fingerprint Assign', 'fingerprint_assign', null, '2', 'Save/Edit Fingerprint Assign', '279', '{\"work_order\":\"1\",\"work_order_number\":\"WO150001\",\"site\":\"1\",\"fingerprint_devices\":[{\"id_fingerprint_assign_detail\":\"8\",\"fingerprint_assign\":\"3\",\"fingerprint_device\":\"1\",\"ip_local\":\"192.168.1.11\",\"port\":\"4370\",\"comm_password\":\"111111\",\"fdid\":\"1\",\"serial_number\":\"0266142700024\",\"uid\":\"0\"}],\"is_edit\":\"true\",\"id_fingerprint_assign\":\"3\",\"action_condition_identifier\":\"assign_fingerprint\",\"param\":[{\"paramName\":\"id\",\"paramValue\":\"3\"}]}', '2015-03-24 14:36:04');
INSERT INTO `activity_log` VALUES ('218', 'Assign Fingerprint Device', 'fingerprint_assign', null, '2', 'Assign Fingerprint Device', '281', '{}', '2015-03-24 14:36:05');
INSERT INTO `activity_log` VALUES ('219', 'Save/Edit Fingerprint Assign', 'fingerprint_assign', null, '2', 'Save/Edit Fingerprint Assign', '279', '{\"work_order\":\"1\",\"work_order_number\":\"WO150001\",\"site\":\"1\",\"fingerprint_devices\":[{\"id_fingerprint_device\":\"1\",\"merk\":\"Fingerplus\",\"series\":\"ZT1800\",\"serial_number\":\"0266142700024\",\"uid\":\"0\",\"fingerprint_device\":\"1\",\"ip_local\":\"192.168.1.11\",\"port\":\"4370\",\"comm_password\":\"111111\",\"fdid\":\"1\",\"id_fingerprint_assign\":\"0\"}],\"is_edit\":\"false\",\"id_fingerprint_assign\":\"\"}', '2015-03-25 22:18:59');
INSERT INTO `activity_log` VALUES ('220', 'Save/Edit Fingerprint Assign', 'fingerprint_assign', null, '2', 'Save/Edit Fingerprint Assign', '279', '{\"work_order\":\"1\",\"work_order_number\":\"WO150001\",\"site\":\"1\",\"fingerprint_devices\":[{\"id_fingerprint_assign_detail\":\"10\",\"fingerprint_assign\":\"4\",\"fingerprint_device\":\"1\",\"ip_local\":\"192.168.1.11\",\"port\":\"4370\",\"comm_password\":\"111111\",\"fdid\":\"1\",\"serial_number\":\"0266142700024\",\"uid\":\"0\"}],\"is_edit\":\"true\",\"id_fingerprint_assign\":\"4\",\"action_condition_identifier\":\"assign_fingerprint\",\"param\":[{\"paramName\":\"id\",\"paramValue\":\"4\"}]}', '2015-03-25 22:19:02');
INSERT INTO `activity_log` VALUES ('221', 'Assign Fingerprint Device', 'fingerprint_assign', null, '2', 'Assign Fingerprint Device', '281', '{}', '2015-03-25 22:19:02');
INSERT INTO `activity_log` VALUES ('222', 'Save/Edit Employee', 'employee', null, '2', 'Save/Edit Employee', '98', '{}', '2015-03-26 00:38:16');
INSERT INTO `activity_log` VALUES ('223', 'Save/Edit Employee', 'employee', null, '2', 'Save/Edit Employee', '98', '{}', '2015-03-26 00:38:37');
INSERT INTO `activity_log` VALUES ('224', 'Save/Edit Employee', 'employee', null, '2', 'Save/Edit Employee', '98', '{}', '2015-03-26 00:40:54');
INSERT INTO `activity_log` VALUES ('225', 'Save/Edit Employee', 'employee', null, '2', 'Save/Edit Employee', '98', '{}', '2015-03-26 00:47:36');
INSERT INTO `activity_log` VALUES ('226', 'Save/Edit Employee', 'employee', null, '2', 'Save/Edit Employee', '98', '{}', '2015-03-26 00:49:44');
INSERT INTO `activity_log` VALUES ('227', 'Delete Application Action', 'action', null, '2', 'Delete Application Action', '4', '{}', '2015-03-27 00:09:26');
INSERT INTO `activity_log` VALUES ('228', 'Save/Edit Role', 'role', null, '2', 'Save/Edit Role', '20', '{\"name\":\"administrator\",\"action_detail\":[{\"id_application_action\":\"1\",\"action\":\"1\",\"name\":\"View Application Action\",\"uid\":\"0\"},{\"id_application_action\":\"2\",\"action\":\"2\",\"name\":\"Create Application Action\",\"uid\":\"1\"},{\"id_application_action\":\"3\",\"action\":\"3\",\"name\":\"Edit Application Action\",\"uid\":\"2\"},{\"id_application_action\":\"4\",\"action\":\"4\",\"name\":\"Delete Application Action\",\"uid\":\"3\"},{\"id_application_action\":\"5\",\"action\":\"5\",\"name\":\"View Side Menu\",\"uid\":\"4\"},{\"id_application_action\":\"6\",\"action\":\"6\",\"name\":\"Create Side Menu\",\"uid\":\"5\"},{\"id_application_action\":\"7\",\"action\":\"7\",\"name\":\"Edit Side Menu\",\"uid\":\"6\"},{\"id_application_action\":\"8\",\"action\":\"8\",\"name\":\"Delete Side Menu\",\"uid\":\"7\"},{\"id_application_action\":\"9\",\"action\":\"9\",\"name\":\"Save\\/Edit Side Menu\",\"uid\":\"8\"},{\"id_application_action\":\"10\",\"action\":\"10\",\"name\":\"Save\\/Edit Action\",\"uid\":\"9\"},{\"id_application_action\":\"11\",\"action\":\"11\",\"name\":\"View Division\",\"uid\":\"10\"},{\"id_application_action\":\"12\",\"action\":\"12\",\"name\":\"Create Division\",\"uid\":\"11\"},{\"id_application_action\":\"13\",\"action\":\"13\",\"name\":\"Save\\/Edit Division\",\"uid\":\"12\"},{\"id_application_action\":\"14\",\"action\":\"14\",\"name\":\"Edit Division\",\"uid\":\"13\"},{\"id_application_action\":\"15\",\"action\":\"15\",\"name\":\"Delete Division\",\"uid\":\"14\"},{\"id_application_action\":\"16\",\"action\":\"16\",\"name\":\"View Role\",\"uid\":\"15\"},{\"id_application_action\":\"17\",\"action\":\"17\",\"name\":\"View Create Role\",\"uid\":\"16\"},{\"id_application_action\":\"18\",\"action\":\"18\",\"name\":\"View Edit Role\",\"uid\":\"17\"},{\"id_application_action\":\"19\",\"action\":\"19\",\"name\":\"Delete Role\",\"uid\":\"18\"},{\"id_application_action\":\"20\",\"action\":\"20\",\"name\":\"Save\\/Edit Role\",\"uid\":\"19\"},{\"id_application_action\":\"21\",\"action\":\"21\",\"name\":\"View Product\",\"uid\":\"20\"},{\"id_application_action\":\"22\",\"action\":\"22\",\"name\":\"Create Product\",\"uid\":\"21\"},{\"id_application_action\":\"23\",\"action\":\"23\",\"name\":\"Edit Product\",\"uid\":\"22\"},{\"id_application_action\":\"24\",\"action\":\"24\",\"name\":\"Delete Product\",\"uid\":\"23\"},{\"id_application_action\":\"25\",\"action\":\"25\",\"name\":\"Save\\/Edit Product\",\"uid\":\"24\"},{\"id_application_action\":\"26\",\"action\":\"26\",\"name\":\"View Supplier\",\"uid\":\"25\"},{\"id_application_action\":\"27\",\"action\":\"27\",\"name\":\"Create Supplier\",\"uid\":\"26\"},{\"id_application_action\":\"28\",\"action\":\"28\",\"name\":\"Edit Supplier\",\"uid\":\"27\"},{\"id_application_action\":\"29\",\"action\":\"29\",\"name\":\"Delete Supplier\",\"uid\":\"28\"},{\"id_application_action\":\"30\",\"action\":\"30\",\"name\":\"Save\\/Edit Supplier\",\"uid\":\"29\"},{\"id_application_action\":\"31\",\"action\":\"31\",\"name\":\"View Product Category\",\"uid\":\"30\"},{\"id_application_action\":\"32\",\"action\":\"32\",\"name\":\"Create Product Category\",\"uid\":\"31\"},{\"id_application_action\":\"33\",\"action\":\"33\",\"name\":\"Edit Product Category\",\"uid\":\"32\"},{\"id_application_action\":\"34\",\"action\":\"34\",\"name\":\"Delete Product Category\",\"uid\":\"33\"},{\"id_application_action\":\"35\",\"action\":\"35\",\"name\":\"Save\\/Edit Product Category\",\"uid\":\"34\"},{\"id_application_action\":\"36\",\"action\":\"36\",\"name\":\"View Merk\",\"uid\":\"35\"},{\"id_application_action\":\"37\",\"action\":\"37\",\"name\":\"Create Merk\",\"uid\":\"36\"},{\"id_application_action\":\"38\",\"action\":\"38\",\"name\":\"Edit Merk\",\"uid\":\"37\"},{\"id_application_action\":\"39\",\"action\":\"39\",\"name\":\"Delete Merk\",\"uid\":\"38\"},{\"id_application_action\":\"40\",\"action\":\"40\",\"name\":\"Save\\/Edit Merk\",\"uid\":\"39\"},{\"id_application_action\":\"41\",\"action\":\"41\",\"name\":\"View Customer\",\"uid\":\"40\"},{\"id_application_action\":\"43\",\"action\":\"43\",\"name\":\"Create Customer\",\"uid\":\"41\"},{\"id_application_action\":\"44\",\"action\":\"44\",\"name\":\"Edit Customer\",\"uid\":\"42\"},{\"id_application_action\":\"45\",\"action\":\"45\",\"name\":\"Delete Customer\",\"uid\":\"43\"},{\"id_application_action\":\"46\",\"action\":\"46\",\"name\":\"Save\\/Edit Customer\",\"uid\":\"44\"},{\"id_application_action\":\"47\",\"action\":\"47\",\"name\":\"View Warehouse\",\"uid\":\"45\"},{\"id_application_action\":\"48\",\"action\":\"48\",\"name\":\"Create Warehouse\",\"uid\":\"46\"},{\"id_application_action\":\"49\",\"action\":\"49\",\"name\":\"Edit Warehouse\",\"uid\":\"47\"},{\"id_application_action\":\"50\",\"action\":\"50\",\"name\":\"Delete Warehouse\",\"uid\":\"48\"},{\"id_application_action\":\"51\",\"action\":\"51\",\"name\":\"Save\\/Edit Warehouse\",\"uid\":\"49\"},{\"id_application_action\":\"57\",\"action\":\"57\",\"name\":\"View PO\",\"uid\":\"50\"},{\"id_application_action\":\"58\",\"action\":\"58\",\"name\":\"Create PO\",\"uid\":\"51\"},{\"id_application_action\":\"59\",\"action\":\"59\",\"name\":\"Edit PO\",\"uid\":\"52\"},{\"id_application_action\":\"60\",\"action\":\"60\",\"name\":\"Delete PO\",\"uid\":\"53\"},{\"id_application_action\":\"61\",\"action\":\"61\",\"name\":\"Save\\/Edit PO\",\"uid\":\"54\"},{\"id_application_action\":\"62\",\"action\":\"62\",\"name\":\"View User\",\"uid\":\"55\"},{\"id_application_action\":\"63\",\"action\":\"63\",\"name\":\"Create User\",\"uid\":\"56\"},{\"id_application_action\":\"64\",\"action\":\"64\",\"name\":\"Edit User\",\"uid\":\"57\"},{\"id_application_action\":\"65\",\"action\":\"65\",\"name\":\"Delete User\",\"uid\":\"58\"},{\"id_application_action\":\"66\",\"action\":\"66\",\"name\":\"Save\\/Edit User\",\"uid\":\"59\"},{\"id_application_action\":\"67\",\"action\":\"67\",\"name\":\"View Good Receive\",\"uid\":\"60\"},{\"id_application_action\":\"68\",\"action\":\"68\",\"name\":\"Create Good Receive\",\"uid\":\"61\"},{\"id_application_action\":\"69\",\"action\":\"69\",\"name\":\"Edit Good Receive\",\"uid\":\"62\"},{\"id_application_action\":\"70\",\"action\":\"70\",\"name\":\"Delete Good Receive\",\"uid\":\"63\"},{\"id_application_action\":\"71\",\"action\":\"71\",\"name\":\"Save\\/Edit Good Receive\",\"uid\":\"64\"},{\"id_application_action\":\"72\",\"action\":\"72\",\"name\":\"View Sales Order\",\"uid\":\"65\"},{\"id_application_action\":\"73\",\"action\":\"73\",\"name\":\"Create Sales Order\",\"uid\":\"66\"},{\"id_application_action\":\"74\",\"action\":\"74\",\"name\":\"Edit Sales Order\",\"uid\":\"67\"},{\"id_application_action\":\"75\",\"action\":\"75\",\"name\":\"Delete Sales Order\",\"uid\":\"68\"},{\"id_application_action\":\"76\",\"action\":\"76\",\"name\":\"Save Sales Order\",\"uid\":\"69\"},{\"id_application_action\":\"77\",\"action\":\"77\",\"name\":\"View Material Request\",\"uid\":\"70\"},{\"id_application_action\":\"78\",\"action\":\"78\",\"name\":\"Create Material Request\",\"uid\":\"71\"},{\"id_application_action\":\"79\",\"action\":\"79\",\"name\":\"Edit Material Request\",\"uid\":\"72\"},{\"id_application_action\":\"80\",\"action\":\"80\",\"name\":\"Delete Material Request\",\"uid\":\"73\"},{\"id_application_action\":\"81\",\"action\":\"81\",\"name\":\"Save Material Request\",\"uid\":\"74\"},{\"id_application_action\":\"82\",\"action\":\"82\",\"name\":\"Change User Password\",\"uid\":\"75\"},{\"id_application_action\":\"83\",\"action\":\"83\",\"name\":\"View Delivery Note\",\"uid\":\"76\"},{\"id_application_action\":\"84\",\"action\":\"84\",\"name\":\"Create Delivery Note\",\"uid\":\"77\"},{\"id_application_action\":\"85\",\"action\":\"85\",\"name\":\"Edit Delivery Note\",\"uid\":\"78\"},{\"id_application_action\":\"86\",\"action\":\"86\",\"name\":\"Delete Delivery Note\",\"uid\":\"79\"},{\"id_application_action\":\"87\",\"action\":\"87\",\"name\":\"Save\\/Edit Delivery Note\",\"uid\":\"80\"},{\"id_application_action\":\"88\",\"action\":\"88\",\"name\":\"View Unit Measure\",\"uid\":\"81\"},{\"id_application_action\":\"89\",\"action\":\"89\",\"name\":\"Create Unit Measure\",\"uid\":\"82\"},{\"id_application_action\":\"90\",\"action\":\"90\",\"name\":\"Edit Unit Measure\",\"uid\":\"83\"},{\"id_application_action\":\"91\",\"action\":\"91\",\"name\":\"Delete Unit Measure\",\"uid\":\"84\"},{\"id_application_action\":\"92\",\"action\":\"92\",\"name\":\"Save\\/Edit Unit Measure\",\"uid\":\"85\"},{\"id_application_action\":\"93\",\"action\":\"93\",\"name\":\"View Stock\",\"uid\":\"86\"},{\"id_application_action\":\"94\",\"action\":\"94\",\"name\":\"View Employee\",\"uid\":\"87\"},{\"id_application_action\":\"95\",\"action\":\"95\",\"name\":\"Create Employee\",\"uid\":\"88\"},{\"id_application_action\":\"96\",\"action\":\"96\",\"name\":\"Edit Employee\",\"uid\":\"89\"},{\"id_application_action\":\"97\",\"action\":\"97\",\"name\":\"Delete Employee\",\"uid\":\"90\"},{\"id_application_action\":\"98\",\"action\":\"98\",\"name\":\"Save\\/Edit Employee\",\"uid\":\"91\"},{\"id_application_action\":\"99\",\"action\":\"99\",\"name\":\"Validate PO\",\"uid\":\"92\"},{\"id_application_action\":\"100\",\"action\":\"100\",\"name\":\"Create Database Interface\",\"uid\":\"93\"},{\"id_application_action\":\"101\",\"action\":\"101\",\"name\":\"Edit Database Interface\",\"uid\":\"94\"},{\"id_application_action\":\"102\",\"action\":\"102\",\"name\":\"Delete Database Interface\",\"uid\":\"95\"},{\"id_application_action\":\"103\",\"action\":\"103\",\"name\":\"Save \\/ Edit Database Interface\",\"uid\":\"96\"},{\"id_application_action\":\"104\",\"action\":\"104\",\"name\":\"View Database Field Interface\",\"uid\":\"97\"},{\"id_application_action\":\"105\",\"action\":\"105\",\"name\":\"Create Database Field Interface\",\"uid\":\"98\"},{\"id_application_action\":\"106\",\"action\":\"106\",\"name\":\"Edit Database Field Interface\",\"uid\":\"99\"},{\"id_application_action\":\"107\",\"action\":\"107\",\"name\":\"Delete Database Field Interface\",\"uid\":\"100\"},{\"id_application_action\":\"108\",\"action\":\"108\",\"name\":\"Save \\/ Edit Database Field Interface\",\"uid\":\"101\"},{\"id_application_action\":\"109\",\"action\":\"109\",\"name\":\"View Inquiry\",\"uid\":\"102\"},{\"id_application_action\":\"110\",\"action\":\"110\",\"name\":\"Create Inquiry\",\"uid\":\"103\"},{\"id_application_action\":\"111\",\"action\":\"111\",\"name\":\"Edit Inquiry\",\"uid\":\"104\"},{\"id_application_action\":\"112\",\"action\":\"112\",\"name\":\"Delete Inquiry\",\"uid\":\"105\"},{\"id_application_action\":\"113\",\"action\":\"113\",\"name\":\"Save\\/Edit Inquiry\",\"uid\":\"106\"},{\"id_application_action\":\"114\",\"action\":\"114\",\"name\":\"View Survey \\/ Assessment\",\"uid\":\"107\"},{\"id_application_action\":\"115\",\"action\":\"115\",\"name\":\"Create Survey \\/ Assessment\",\"uid\":\"108\"},{\"id_application_action\":\"116\",\"action\":\"116\",\"name\":\"Edit Survey \\/ Assessment\",\"uid\":\"109\"},{\"id_application_action\":\"117\",\"action\":\"117\",\"name\":\"Delete Survey \\/ Assessment\",\"uid\":\"110\"},{\"id_application_action\":\"118\",\"action\":\"118\",\"name\":\"Save\\/Edit Survey \\/ Assessment\",\"uid\":\"111\"},{\"id_application_action\":\"119\",\"action\":\"119\",\"name\":\"View Quotation\",\"uid\":\"112\"},{\"id_application_action\":\"120\",\"action\":\"120\",\"name\":\"Create Quotation\",\"uid\":\"113\"},{\"id_application_action\":\"121\",\"action\":\"121\",\"name\":\"Edit Quotation\",\"uid\":\"114\"},{\"id_application_action\":\"122\",\"action\":\"122\",\"name\":\"Delete Quotation\",\"uid\":\"115\"},{\"id_application_action\":\"123\",\"action\":\"123\",\"name\":\"Save\\/Edit Quotation\",\"uid\":\"116\"},{\"id_application_action\":\"124\",\"action\":\"124\",\"name\":\"View Project Contract\",\"uid\":\"117\"},{\"id_application_action\":\"125\",\"action\":\"125\",\"name\":\"Create Project Contract\",\"uid\":\"118\"},{\"id_application_action\":\"126\",\"action\":\"126\",\"name\":\"Edit Project Contract\",\"uid\":\"119\"},{\"id_application_action\":\"127\",\"action\":\"127\",\"name\":\"Delete Project Contract\",\"uid\":\"120\"},{\"id_application_action\":\"128\",\"action\":\"128\",\"name\":\"Save\\/Edit Project Contract\",\"uid\":\"121\"},{\"id_application_action\":\"129\",\"action\":\"129\",\"name\":\"View Work Order\",\"uid\":\"122\"},{\"id_application_action\":\"130\",\"action\":\"130\",\"name\":\"Create Work Order\",\"uid\":\"123\"},{\"id_application_action\":\"131\",\"action\":\"131\",\"name\":\"Edit Work Order\",\"uid\":\"124\"},{\"id_application_action\":\"132\",\"action\":\"132\",\"name\":\"Delete Work Order\",\"uid\":\"125\"},{\"id_application_action\":\"133\",\"action\":\"133\",\"name\":\"Save\\/Edit Work Order\",\"uid\":\"126\"},{\"id_application_action\":\"134\",\"action\":\"134\",\"name\":\"View Assessment Template\",\"uid\":\"127\"},{\"id_application_action\":\"135\",\"action\":\"135\",\"name\":\"Create Assessment Template\",\"uid\":\"128\"},{\"id_application_action\":\"136\",\"action\":\"136\",\"name\":\"Edit Assessment Template\",\"uid\":\"129\"},{\"id_application_action\":\"137\",\"action\":\"137\",\"name\":\"Delete Assessment Template\",\"uid\":\"130\"},{\"id_application_action\":\"138\",\"action\":\"138\",\"name\":\"Save\\/Edit Assessment Template\",\"uid\":\"131\"},{\"id_application_action\":\"139\",\"action\":\"139\",\"name\":\"View Contract Template\",\"uid\":\"132\"},{\"id_application_action\":\"140\",\"action\":\"140\",\"name\":\"Create Contract Template\",\"uid\":\"133\"},{\"id_application_action\":\"141\",\"action\":\"141\",\"name\":\"Edit Contract Template\",\"uid\":\"134\"},{\"id_application_action\":\"142\",\"action\":\"142\",\"name\":\"Delete Contract Template\",\"uid\":\"135\"},{\"id_application_action\":\"143\",\"action\":\"143\",\"name\":\"Save\\/Edit Contract Template\",\"uid\":\"136\"},{\"id_application_action\":\"144\",\"action\":\"144\",\"name\":\"View Work Schedule\",\"uid\":\"137\"},{\"id_application_action\":\"145\",\"action\":\"145\",\"name\":\"Create Work Schedule\",\"uid\":\"138\"},{\"id_application_action\":\"146\",\"action\":\"146\",\"name\":\"Edit Work Schedule\",\"uid\":\"139\"},{\"id_application_action\":\"147\",\"action\":\"147\",\"name\":\"Delete Work Schedule\",\"uid\":\"140\"},{\"id_application_action\":\"148\",\"action\":\"148\",\"name\":\"Save\\/Edit Work Schedule\",\"uid\":\"141\"},{\"id_application_action\":\"149\",\"action\":\"149\",\"name\":\"View SO Assignment\",\"uid\":\"142\"},{\"id_application_action\":\"150\",\"action\":\"150\",\"name\":\"Create SO Assignment\",\"uid\":\"143\"},{\"id_application_action\":\"151\",\"action\":\"151\",\"name\":\"Edit SO Assignment\",\"uid\":\"144\"},{\"id_application_action\":\"152\",\"action\":\"152\",\"name\":\"Delete SO Assignment\",\"uid\":\"145\"},{\"id_application_action\":\"153\",\"action\":\"153\",\"name\":\"Save\\/Edit SO Assignment\",\"uid\":\"146\"},{\"id_application_action\":\"154\",\"action\":\"154\",\"name\":\"View Shift Change\",\"uid\":\"147\"},{\"id_application_action\":\"155\",\"action\":\"155\",\"name\":\"Create Shift Change\",\"uid\":\"148\"},{\"id_application_action\":\"156\",\"action\":\"156\",\"name\":\"Edit Shift Change\",\"uid\":\"149\"},{\"id_application_action\":\"157\",\"action\":\"157\",\"name\":\"Delete Shift Change\",\"uid\":\"150\"},{\"id_application_action\":\"158\",\"action\":\"158\",\"name\":\"Save\\/Edit Shift Change\",\"uid\":\"151\"},{\"id_application_action\":\"159\",\"action\":\"159\",\"name\":\"View Leave Application\",\"uid\":\"152\"},{\"id_application_action\":\"160\",\"action\":\"160\",\"name\":\"Create Leave Application\",\"uid\":\"153\"},{\"id_application_action\":\"161\",\"action\":\"161\",\"name\":\"Edit Leave Application\",\"uid\":\"154\"},{\"id_application_action\":\"162\",\"action\":\"162\",\"name\":\"Delete Leave Application\",\"uid\":\"155\"},{\"id_application_action\":\"163\",\"action\":\"163\",\"name\":\"Save\\/Edit Leave Application\",\"uid\":\"156\"},{\"id_application_action\":\"164\",\"action\":\"164\",\"name\":\"View Timesheet (Recap)\",\"uid\":\"157\"},{\"id_application_action\":\"165\",\"action\":\"165\",\"name\":\"Create Timesheet (Recap)\",\"uid\":\"158\"},{\"id_application_action\":\"166\",\"action\":\"166\",\"name\":\"Edit Timesheet (Recap)\",\"uid\":\"159\"},{\"id_application_action\":\"167\",\"action\":\"167\",\"name\":\"Delete Timesheet (Recap)\",\"uid\":\"160\"},{\"id_application_action\":\"168\",\"action\":\"168\",\"name\":\"Save\\/Edit Timesheet (Recap)\",\"uid\":\"161\"},{\"id_application_action\":\"169\",\"action\":\"169\",\"name\":\"View SO Timesheet\",\"uid\":\"162\"},{\"id_application_action\":\"170\",\"action\":\"170\",\"name\":\"Create SO Timesheet\",\"uid\":\"163\"},{\"id_application_action\":\"171\",\"action\":\"171\",\"name\":\"Edit SO Timesheet\",\"uid\":\"164\"},{\"id_application_action\":\"172\",\"action\":\"172\",\"name\":\"Delete SO Timesheet\",\"uid\":\"165\"},{\"id_application_action\":\"173\",\"action\":\"173\",\"name\":\"Save\\/Edit SO Timesheet\",\"uid\":\"166\"},{\"id_application_action\":\"174\",\"action\":\"174\",\"name\":\"View Incident Report\",\"uid\":\"167\"},{\"id_application_action\":\"175\",\"action\":\"175\",\"name\":\"Create Incident Report\",\"uid\":\"168\"},{\"id_application_action\":\"176\",\"action\":\"176\",\"name\":\"Edit Incident Report\",\"uid\":\"169\"},{\"id_application_action\":\"177\",\"action\":\"177\",\"name\":\"Delete Incident Report\",\"uid\":\"170\"},{\"id_application_action\":\"178\",\"action\":\"178\",\"name\":\"Save\\/Edit Incident Report\",\"uid\":\"171\"},{\"id_application_action\":\"179\",\"action\":\"179\",\"name\":\"View Payroll\",\"uid\":\"172\"},{\"id_application_action\":\"180\",\"action\":\"180\",\"name\":\"Create Payroll\",\"uid\":\"173\"},{\"id_application_action\":\"181\",\"action\":\"181\",\"name\":\"Edit Payroll\",\"uid\":\"174\"},{\"id_application_action\":\"182\",\"action\":\"182\",\"name\":\"Delete Payroll\",\"uid\":\"175\"},{\"id_application_action\":\"183\",\"action\":\"183\",\"name\":\"Save\\/Edit Payroll\",\"uid\":\"176\"},{\"id_application_action\":\"184\",\"action\":\"184\",\"name\":\"View Supplier Invoice\",\"uid\":\"177\"},{\"id_application_action\":\"185\",\"action\":\"185\",\"name\":\"Create Supplier Invoice\",\"uid\":\"178\"},{\"id_application_action\":\"186\",\"action\":\"186\",\"name\":\"Edit Supplier Invoice\",\"uid\":\"179\"},{\"id_application_action\":\"187\",\"action\":\"187\",\"name\":\"Delete Supplier Invoice\",\"uid\":\"180\"},{\"id_application_action\":\"188\",\"action\":\"188\",\"name\":\"Save\\/Edit Supplier Invoice\",\"uid\":\"181\"},{\"id_application_action\":\"189\",\"action\":\"189\",\"name\":\"View Customer Invoice\",\"uid\":\"182\"},{\"id_application_action\":\"190\",\"action\":\"190\",\"name\":\"Create Customer Invoice\",\"uid\":\"183\"},{\"id_application_action\":\"191\",\"action\":\"191\",\"name\":\"Edit Customer Invoice\",\"uid\":\"184\"},{\"id_application_action\":\"192\",\"action\":\"192\",\"name\":\"Delete Customer Invoice\",\"uid\":\"185\"},{\"id_application_action\":\"193\",\"action\":\"193\",\"name\":\"Save\\/Edit Customer Invoice\",\"uid\":\"186\"},{\"id_application_action\":\"194\",\"action\":\"194\",\"name\":\"View Bank Statement\",\"uid\":\"187\"},{\"id_application_action\":\"195\",\"action\":\"195\",\"name\":\"Create Bank Statement\",\"uid\":\"188\"},{\"id_application_action\":\"196\",\"action\":\"196\",\"name\":\"Edit Bank Statement\",\"uid\":\"189\"},{\"id_application_action\":\"197\",\"action\":\"197\",\"name\":\"Delete Bank Statement\",\"uid\":\"190\"},{\"id_application_action\":\"198\",\"action\":\"198\",\"name\":\"Save\\/Edit Bank Statement\",\"uid\":\"191\"},{\"id_application_action\":\"199\",\"action\":\"199\",\"name\":\"View Cash Register\",\"uid\":\"192\"},{\"id_application_action\":\"200\",\"action\":\"200\",\"name\":\"Create Cash Register\",\"uid\":\"193\"},{\"id_application_action\":\"201\",\"action\":\"201\",\"name\":\"Edit Cash Register\",\"uid\":\"194\"},{\"id_application_action\":\"202\",\"action\":\"202\",\"name\":\"Delete Cash Register\",\"uid\":\"195\"},{\"id_application_action\":\"203\",\"action\":\"203\",\"name\":\"Save\\/Edit Cash Register\",\"uid\":\"196\"},{\"id_application_action\":\"204\",\"action\":\"204\",\"name\":\"View Tax\",\"uid\":\"197\"},{\"id_application_action\":\"205\",\"action\":\"205\",\"name\":\"Create Tax\",\"uid\":\"198\"},{\"id_application_action\":\"206\",\"action\":\"206\",\"name\":\"Edit Tax\",\"uid\":\"199\"},{\"id_application_action\":\"207\",\"action\":\"207\",\"name\":\"Delete Tax\",\"uid\":\"200\"},{\"id_application_action\":\"208\",\"action\":\"208\",\"name\":\"Save\\/Edit Tax\",\"uid\":\"201\"},{\"id_application_action\":\"209\",\"action\":\"209\",\"name\":\"View Chart of Account\",\"uid\":\"202\"},{\"id_application_action\":\"210\",\"action\":\"210\",\"name\":\"Create Chart of Account\",\"uid\":\"203\"},{\"id_application_action\":\"211\",\"action\":\"211\",\"name\":\"Edit Chart of Account\",\"uid\":\"204\"},{\"id_application_action\":\"212\",\"action\":\"212\",\"name\":\"Delete Chart of Account\",\"uid\":\"205\"},{\"id_application_action\":\"213\",\"action\":\"213\",\"name\":\"Save\\/Edit Chart of Account\",\"uid\":\"206\"},{\"id_application_action\":\"214\",\"action\":\"214\",\"name\":\"View Employee Salary\",\"uid\":\"207\"},{\"id_application_action\":\"215\",\"action\":\"215\",\"name\":\"Create Employee Salary\",\"uid\":\"208\"},{\"id_application_action\":\"216\",\"action\":\"216\",\"name\":\"Edit Employee Salary\",\"uid\":\"209\"},{\"id_application_action\":\"217\",\"action\":\"217\",\"name\":\"Delete Employee Salary\",\"uid\":\"210\"},{\"id_application_action\":\"218\",\"action\":\"218\",\"name\":\"Save\\/Edit Employee Salary\",\"uid\":\"211\"},{\"id_application_action\":\"219\",\"action\":\"219\",\"name\":\"View Salary Setting\",\"uid\":\"212\"},{\"id_application_action\":\"220\",\"action\":\"220\",\"name\":\"Create Salary Setting\",\"uid\":\"213\"},{\"id_application_action\":\"221\",\"action\":\"221\",\"name\":\"Edit Salary Setting\",\"uid\":\"214\"},{\"id_application_action\":\"222\",\"action\":\"222\",\"name\":\"Delete Salary Setting\",\"uid\":\"215\"},{\"id_application_action\":\"223\",\"action\":\"223\",\"name\":\"Save\\/Edit Salary Setting\",\"uid\":\"216\"},{\"id_application_action\":\"224\",\"action\":\"224\",\"name\":\"View Database Interface\",\"uid\":\"217\"},{\"id_application_action\":\"225\",\"action\":\"225\",\"name\":\"Pick Assessment Template\",\"uid\":\"218\"},{\"id_application_action\":\"226\",\"action\":\"226\",\"name\":\"View Organisation Structure\",\"uid\":\"219\"},{\"id_application_action\":\"227\",\"action\":\"227\",\"name\":\"Create Organisation Structure\",\"uid\":\"220\"},{\"id_application_action\":\"228\",\"action\":\"228\",\"name\":\"Edit Organisation Structure\",\"uid\":\"221\"},{\"id_application_action\":\"229\",\"action\":\"229\",\"name\":\"Delete Organisation Structure\",\"uid\":\"222\"},{\"id_application_action\":\"230\",\"action\":\"230\",\"name\":\"Save\\/Edit Organisation Structure\",\"uid\":\"223\"},{\"id_application_action\":\"231\",\"action\":\"231\",\"name\":\"View Position Level\",\"uid\":\"224\"},{\"id_application_action\":\"232\",\"action\":\"232\",\"name\":\"Create Position Level\",\"uid\":\"225\"},{\"id_application_action\":\"233\",\"action\":\"233\",\"name\":\"Edit Position Level\",\"uid\":\"226\"},{\"id_application_action\":\"234\",\"action\":\"234\",\"name\":\"Delete Position Level\",\"uid\":\"227\"},{\"id_application_action\":\"235\",\"action\":\"235\",\"name\":\"Save\\/Edit Position Level\",\"uid\":\"228\"},{\"id_application_action\":\"236\",\"action\":\"236\",\"name\":\"View Employee Contract Type\",\"uid\":\"229\"},{\"id_application_action\":\"237\",\"action\":\"237\",\"name\":\"Create Employee Contract Type\",\"uid\":\"230\"},{\"id_application_action\":\"238\",\"action\":\"238\",\"name\":\"Edit Employee Contract Type\",\"uid\":\"231\"},{\"id_application_action\":\"239\",\"action\":\"239\",\"name\":\"Delete Employee Contract Type\",\"uid\":\"232\"},{\"id_application_action\":\"240\",\"action\":\"240\",\"name\":\"Save\\/Edit Employee Contract\",\"uid\":\"233\"},{\"id_application_action\":\"241\",\"action\":\"241\",\"name\":\"View Bank\",\"uid\":\"234\"},{\"id_application_action\":\"242\",\"action\":\"242\",\"name\":\"Create Bank\",\"uid\":\"235\"},{\"id_application_action\":\"243\",\"action\":\"243\",\"name\":\"Edit Bank\",\"uid\":\"236\"},{\"id_application_action\":\"244\",\"action\":\"244\",\"name\":\"Delete Bank\",\"uid\":\"237\"},{\"id_application_action\":\"245\",\"action\":\"245\",\"name\":\"Save\\/Edit Bank\",\"uid\":\"238\"},{\"id_application_action\":\"246\",\"action\":\"246\",\"name\":\"View Payment Receipt\",\"uid\":\"239\"},{\"id_application_action\":\"247\",\"action\":\"247\",\"name\":\"Create Payment Receipt\",\"uid\":\"240\"},{\"id_application_action\":\"248\",\"action\":\"248\",\"name\":\"Edit Payment Receipt\",\"uid\":\"241\"},{\"id_application_action\":\"249\",\"action\":\"249\",\"name\":\"Save\\/Edit Payment Receipt\",\"uid\":\"242\"},{\"id_application_action\":\"250\",\"action\":\"250\",\"name\":\"Delete Payment Receipt\",\"uid\":\"243\"},{\"id_application_action\":\"251\",\"action\":\"251\",\"name\":\"Receive Payment From PO\",\"uid\":\"244\"},{\"id_application_action\":\"252\",\"action\":\"252\",\"name\":\"Make Payment Receipt\",\"uid\":\"245\"},{\"id_application_action\":\"253\",\"action\":\"253\",\"name\":\"Cancel Payment Receipt\",\"uid\":\"246\"},{\"id_application_action\":\"254\",\"action\":\"254\",\"name\":\"View Stock Transaction\",\"uid\":\"247\"},{\"id_application_action\":\"255\",\"action\":\"255\",\"name\":\"Create Stock Transaction\",\"uid\":\"248\"},{\"id_application_action\":\"256\",\"action\":\"256\",\"name\":\"Edit Stock Transaction\",\"uid\":\"249\"},{\"id_application_action\":\"257\",\"action\":\"257\",\"name\":\"Delete Stock Transaction\",\"uid\":\"250\"},{\"id_application_action\":\"258\",\"action\":\"258\",\"name\":\"Save\\/Edit Stock Transaction\",\"uid\":\"251\"},{\"id_application_action\":\"259\",\"action\":\"259\",\"name\":\"Post Stock Transaction\",\"uid\":\"252\"},{\"id_application_action\":\"260\",\"action\":\"260\",\"name\":\"Unpost Stock Transaction\",\"uid\":\"253\"},{\"id_application_action\":\"261\",\"action\":\"261\",\"name\":\"Transfer Good Receive\",\"uid\":\"254\"},{\"id_application_action\":\"262\",\"action\":\"262\",\"name\":\"View Activity\",\"uid\":\"255\"},{\"id_application_action\":\"263\",\"action\":\"263\",\"name\":\"Make Working Schedule\",\"uid\":\"256\"},{\"id_application_action\":\"264\",\"action\":\"264\",\"name\":\"Validate Inquiry\",\"uid\":\"257\"},{\"id_application_action\":\"265\",\"action\":\"265\",\"name\":\"Validate Quotation\",\"uid\":\"258\"},{\"id_application_action\":\"267\",\"action\":\"267\",\"name\":\"Confirm Sales Order\",\"uid\":\"259\"},{\"id_application_action\":\"266\",\"action\":\"266\",\"name\":\"Validate Sales Order\",\"uid\":\"260\"},{\"id_application_action\":\"268\",\"action\":\"268\",\"name\":\"View Fingerprint Device\",\"uid\":\"261\"},{\"id_application_action\":\"269\",\"action\":\"269\",\"name\":\"Create Fingerprint Device\",\"uid\":\"262\"},{\"id_application_action\":\"270\",\"action\":\"270\",\"name\":\"Edit Fingerprint Device\",\"uid\":\"263\"},{\"id_application_action\":\"271\",\"action\":\"271\",\"name\":\"Delete Fingerprint Device\",\"uid\":\"264\"},{\"id_application_action\":\"272\",\"action\":\"272\",\"name\":\"Save\\/Edit Fingerprint Device\",\"uid\":\"265\"},{\"id_application_action\":\"273\",\"action\":\"273\",\"name\":\"Activate Fingerprint\",\"uid\":\"266\"},{\"id_application_action\":\"274\",\"action\":\"274\",\"name\":\"Deactivate Fingerprint\",\"uid\":\"267\"},{\"id_application_action\":\"275\",\"action\":\"275\",\"name\":\"View Fingerprint Assign\",\"uid\":\"268\"},{\"id_application_action\":\"276\",\"action\":\"276\",\"name\":\"Create Fingerprint Assign\",\"uid\":\"269\"},{\"id_application_action\":\"277\",\"action\":\"277\",\"name\":\"Edit Fingerprint Assign\",\"uid\":\"270\"},{\"id_application_action\":\"278\",\"action\":\"278\",\"name\":\"Delete Fingerprint Assign\",\"uid\":\"271\"},{\"id_application_action\":\"279\",\"action\":\"279\",\"name\":\"Save\\/Edit Fingerprint Assign\",\"uid\":\"272\"},{\"id_application_action\":\"280\",\"action\":\"280\",\"name\":\"Make SO Assignment\",\"uid\":\"273\"},{\"id_application_action\":\"281\",\"action\":\"281\",\"name\":\"Assign Fingerprint Device\",\"uid\":\"274\"},{\"id_application_action\":\"282\",\"action\":\"282\",\"name\":\"Unassign Fingerprint\",\"uid\":\"275\"},{\"id_application_action\":\"283\",\"action\":\"283\",\"name\":\"Fingerprint Enroll\",\"uid\":\"276\"},{\"id_application_action\":\"284\",\"action\":\"284\",\"name\":\"Save Fingerprint Enroll\",\"uid\":\"277\"},{\"id_application_action\":\"293\",\"action\":\"293\",\"name\":\"Create BOM\",\"uid\":\"278\"},{\"id_application_action\":\"294\",\"action\":\"294\",\"name\":\"Edit BOM\",\"uid\":\"279\"},{\"id_application_action\":\"295\",\"action\":\"295\",\"name\":\"Delete BOM\",\"uid\":\"280\"},{\"id_application_action\":\"296\",\"action\":\"296\",\"name\":\"Save\\/Edit BOM\",\"uid\":\"281\"},{\"id_application_action\":\"297\",\"action\":\"297\",\"name\":\"Validate BOM\",\"uid\":\"282\"},{\"id_application_action\":\"298\",\"action\":\"298\",\"name\":\"View Join item\",\"uid\":\"283\"},{\"id_application_action\":\"299\",\"action\":\"299\",\"name\":\"Create Join Item\",\"uid\":\"284\"},{\"id_application_action\":\"300\",\"action\":\"300\",\"name\":\"Edit Join Item\",\"uid\":\"285\"},{\"id_application_action\":\"301\",\"action\":\"301\",\"name\":\"Delete Join Item\",\"uid\":\"286\"},{\"id_application_action\":\"302\",\"action\":\"302\",\"name\":\"Save\\/Edit Joint Item\",\"uid\":\"287\"},{\"id_application_action\":\"303\",\"action\":\"303\",\"name\":\"Transfer Join Item\",\"uid\":\"288\"},{\"id_application_action\":\"304\",\"action\":\"304\",\"name\":\"View Group\",\"uid\":\"289\"},{\"id_application_action\":\"305\",\"action\":\"305\",\"name\":\"Create Group\",\"uid\":\"290\"},{\"id_application_action\":\"306\",\"action\":\"306\",\"name\":\"Edit Group\",\"uid\":\"291\"},{\"id_application_action\":\"307\",\"action\":\"307\",\"name\":\"Delete Group\",\"uid\":\"292\"},{\"id_application_action\":\"308\",\"action\":\"308\",\"name\":\"Save\\/Edit Group\",\"uid\":\"293\"},{\"id_application_action\":\"309\",\"action\":\"309\",\"name\":\"View Configuration Parameter\",\"uid\":\"294\"},{\"id_application_action\":\"310\",\"action\":\"310\",\"name\":\"Create Configuration Parameter\",\"uid\":\"295\"},{\"id_application_action\":\"311\",\"action\":\"311\",\"name\":\"Edit Configuration Parameter\",\"uid\":\"296\"},{\"id_application_action\":\"312\",\"action\":\"312\",\"name\":\"Delete Configuration Parameter\",\"uid\":\"297\"},{\"id_application_action\":\"313\",\"action\":\"313\",\"name\":\"Save\\/Edit Configuration Parameter\",\"uid\":\"298\"},{\"id_application_action\":\"314\",\"action\":\"314\",\"name\":\"VIew Notification Setting\",\"uid\":\"299\"},{\"id_application_action\":\"315\",\"action\":\"315\",\"name\":\"Create Notification Setting\",\"uid\":\"300\"},{\"id_application_action\":\"316\",\"action\":\"316\",\"name\":\"Edit Notification Setting\",\"uid\":\"301\"},{\"id_application_action\":\"317\",\"action\":\"317\",\"name\":\"Delete Notification Setting\",\"uid\":\"302\"},{\"id_application_action\":\"318\",\"action\":\"318\",\"name\":\"Save\\/Edit Notification Setting\",\"uid\":\"303\"},{\"id_application_action\":\"292\",\"action\":\"292\",\"name\":\"View BOM\",\"uid\":\"304\"},{\"id_application_action\":\"320\",\"action\":\"320\",\"name\":\"Create Product Definition\",\"uid\":\"305\"},{\"id_application_action\":\"321\",\"action\":\"321\",\"name\":\"Edit Product Definition\",\"uid\":\"306\"},{\"id_application_action\":\"322\",\"action\":\"322\",\"name\":\"Delete Product Definition\",\"uid\":\"307\"},{\"id_application_action\":\"323\",\"action\":\"323\",\"name\":\"Save\\/Edit Product Definition\",\"uid\":\"308\"},{\"id_application_action\":\"319\",\"action\":\"319\",\"name\":\"View Product Definition\",\"uid\":\"309\"},{\"id_application_action\":\"342\",\"name\":\"View Log Error\",\"uid\":\"310\",\"id\":\"310\"},{\"id_application_action\":\"343\",\"name\":\"Create Log Error\",\"uid\":\"311\",\"id\":\"311\"},{\"id_application_action\":\"344\",\"name\":\"Save \\/ Edit Log Error\",\"uid\":\"312\",\"id\":\"312\"},{\"id_application_action\":\"345\",\"name\":\"Edit Log  Error\",\"uid\":\"313\",\"id\":\"313\"},{\"id_application_action\":\"346\",\"name\":\"Delete Log Error\",\"uid\":\"314\",\"id\":\"314\"},{\"id_application_action\":\"347\",\"name\":\"Copy Record\",\"uid\":\"315\",\"id\":\"315\"},{\"id_application_action\":\"348\",\"name\":\"View Salary Type\",\"uid\":\"316\",\"id\":\"316\"},{\"id_application_action\":\"349\",\"name\":\"Create Salary Type\",\"uid\":\"317\",\"id\":\"317\"},{\"id_application_action\":\"350\",\"name\":\"Save \\/ Edit Salary Type\",\"uid\":\"318\",\"id\":\"318\"},{\"id_application_action\":\"351\",\"name\":\"Edit Salary Type\",\"uid\":\"319\",\"id\":\"319\"},{\"id_application_action\":\"352\",\"name\":\"Create Timesheet\",\"uid\":\"320\",\"id\":\"320\"},{\"id_application_action\":\"353\",\"name\":\"View Salary Type\",\"uid\":\"321\",\"id\":\"321\"},{\"id_application_action\":\"354\",\"name\":\"View Salary Type\",\"uid\":\"322\",\"id\":\"322\"},{\"id_application_action\":\"355\",\"name\":\"Save \\/ Edit Timesheet \",\"uid\":\"323\",\"id\":\"323\"},{\"id_application_action\":\"356\",\"name\":\"View Payroll Periode\",\"uid\":\"324\",\"id\":\"324\"},{\"id_application_action\":\"357\",\"name\":\"Create Payroll Periode\",\"uid\":\"325\",\"id\":\"325\"},{\"id_application_action\":\"358\",\"name\":\"Save \\/ Edit Log Error\",\"uid\":\"326\",\"id\":\"326\"},{\"id_application_action\":\"359\",\"name\":\"Edit Payroll Periode\",\"uid\":\"327\",\"id\":\"327\"},{\"id_application_action\":\"360\",\"name\":\"Delete Payroll Periode\",\"uid\":\"328\",\"id\":\"328\"},{\"id_application_action\":\"361\",\"name\":\"View Request Overtime\",\"uid\":\"329\",\"id\":\"329\"},{\"id_application_action\":\"362\",\"name\":\"Create Request Overtime\",\"uid\":\"330\",\"id\":\"330\"},{\"id_application_action\":\"363\",\"name\":\"Save \\/ Edit Overtime\",\"uid\":\"331\",\"id\":\"331\"},{\"id_application_action\":\"364\",\"name\":\"Edit Overtime\",\"uid\":\"332\",\"id\":\"332\"},{\"id_application_action\":\"365\",\"name\":\"Delete Overtime\",\"uid\":\"333\",\"id\":\"333\"},{\"id_application_action\":\"366\",\"name\":\"Validate Overtime\",\"uid\":\"334\",\"id\":\"334\"},{\"id_application_action\":\"367\",\"name\":\"View Insentive\",\"uid\":\"335\",\"id\":\"335\"},{\"id_application_action\":\"368\",\"name\":\"View Monitoring Timesheet \",\"uid\":\"336\",\"id\":\"336\"},{\"id_application_action\":\"369\",\"name\":\"Create Insentive\",\"uid\":\"337\",\"id\":\"337\"},{\"id_application_action\":\"370\",\"name\":\"Save \\/ Edit Insentive\",\"uid\":\"338\",\"id\":\"338\"},{\"id_application_action\":\"371\",\"name\":\"Edit Overtime\",\"uid\":\"339\",\"id\":\"339\"},{\"id_application_action\":\"372\",\"name\":\"Delete Insentive\",\"uid\":\"340\",\"id\":\"340\"}],\"is_edit\":\"true\",\"id_role\":\"1\"}', '2015-03-27 00:18:46');
INSERT INTO `activity_log` VALUES ('229', 'Make SO Assignment', 'work_order', null, '2', 'Make SO Assignment', '280', '{}', '2015-03-27 19:53:00');
INSERT INTO `activity_log` VALUES ('230', 'Save/Edit Inquiry', 'inquiry', null, '2', 'Save/Edit Inquiry', '113', '{}', '2015-03-27 20:14:20');
INSERT INTO `activity_log` VALUES ('231', 'Validate Inquiry', 'inquiry', null, '2', 'Validate Inquiry', '264', '{\"id_inquiry\":\"4\",\"status\":\"open\"}', '2015-03-27 20:14:25');
INSERT INTO `activity_log` VALUES ('232', 'Save/Edit Quotation', 'quotation', null, '2', 'Save/Edit Quotation', '123', '{}', '2015-03-27 20:15:20');
INSERT INTO `activity_log` VALUES ('233', 'Make Working Schedule', 'quotation', null, '2', 'Make Working Schedule', '263', '{}', '2015-03-27 20:15:25');
INSERT INTO `activity_log` VALUES ('234', 'Save/Edit Work Schedule', 'work_schedule', null, '2', 'Save/Edit Work Schedule', '148', '{}', '2015-03-27 20:18:38');
INSERT INTO `activity_log` VALUES ('235', 'Validate Quotation', 'quotation', null, '2', 'Validate Quotation', '265', '{\"id_quotation\":\"3\",\"status\":\"open\"}', '2015-03-27 20:18:45');
INSERT INTO `activity_log` VALUES ('236', 'Save Sales Order', 'so', null, '2', 'Save Sales Order', '76', '{}', '2015-03-27 20:20:01');
INSERT INTO `activity_log` VALUES ('237', 'Validate Sales Order', 'so', null, '2', 'Validate Sales Order', '266', '{\"id_so\":\"2\",\"status\":\"open\"}', '2015-03-27 20:20:07');
INSERT INTO `activity_log` VALUES ('238', 'Confirm Sales Order', 'so', null, '2', 'Confirm Sales Order', '267', '{\"id_so\":\"2\",\"id_work_order\":5,\"status\":\"close\"}', '2015-03-27 20:20:34');
INSERT INTO `activity_log` VALUES ('239', 'Save/Edit BOM', 'bom', null, '2', 'Save/Edit BOM', '296', '{}', '2015-03-27 20:31:27');
INSERT INTO `activity_log` VALUES ('240', 'Save/Edit Inquiry', 'inquiry', null, '2', 'Save/Edit Inquiry', '113', '{}', '2015-03-29 06:26:41');
INSERT INTO `activity_log` VALUES ('241', 'Validate Inquiry', 'inquiry', null, '2', 'Validate Inquiry', '264', '{\"id_inquiry\":\"5\",\"status\":\"open\"}', '2015-03-29 06:26:49');
INSERT INTO `activity_log` VALUES ('242', 'Save/Edit Product Definition', 'product_definition', null, '2', 'Save/Edit Product Definition', '323', '{\"product\":\"5\",\"organisation_structure\":\"9\",\"position_level\":null}', '2015-03-29 06:27:32');
INSERT INTO `activity_log` VALUES ('243', 'Save/Edit Product Definition', 'product_definition', null, '2', 'Save/Edit Product Definition', '323', '{\"product\":\"6\",\"organisation_structure\":\"10\",\"position_level\":null}', '2015-03-29 06:28:08');
INSERT INTO `activity_log` VALUES ('244', 'Save/Edit Quotation', 'quotation', null, '2', 'Save/Edit Quotation', '123', '{}', '2015-03-29 06:35:23');
INSERT INTO `activity_log` VALUES ('245', 'Make Working Schedule', 'quotation', null, '2', 'Make Working Schedule', '263', '{}', '2015-03-29 06:35:28');
INSERT INTO `activity_log` VALUES ('246', 'Save/Edit Work Schedule', 'work_schedule', null, '2', 'Save/Edit Work Schedule', '148', '{}', '2015-03-29 06:59:08');
INSERT INTO `activity_log` VALUES ('247', 'Save/Edit Quotation', 'quotation', null, '2', 'Save/Edit Quotation', '123', '{}', '2015-03-29 07:01:51');
INSERT INTO `activity_log` VALUES ('248', 'Validate Quotation', 'quotation', null, '2', 'Validate Quotation', '265', '{\"id_quotation\":\"4\",\"status\":\"open\"}', '2015-03-29 07:03:00');
INSERT INTO `activity_log` VALUES ('249', 'Save Sales Order', 'so', null, '2', 'Save Sales Order', '76', '{}', '2015-03-29 07:05:51');
INSERT INTO `activity_log` VALUES ('250', 'Validate Sales Order', 'so', null, '2', 'Validate Sales Order', '266', '{\"id_so\":\"3\",\"status\":\"open\"}', '2015-03-29 07:06:28');
INSERT INTO `activity_log` VALUES ('251', 'Save/Edit BOM', 'bom', null, '2', 'Save/Edit BOM', '296', '{}', '2015-03-29 07:19:56');
INSERT INTO `activity_log` VALUES ('252', 'Save/Edit BOM', 'bom', null, '2', 'Save/Edit BOM', '296', '{}', '2015-03-29 07:23:09');
INSERT INTO `activity_log` VALUES ('253', 'Save/Edit BOM', 'bom', null, '2', 'Save/Edit BOM', '296', '{}', '2015-03-29 07:24:44');
INSERT INTO `activity_log` VALUES ('254', 'Confirm Sales Order', 'so', null, '2', 'Confirm Sales Order', '267', '{\"id_so\":\"3\",\"id_work_order\":6,\"status\":\"close\"}', '2015-03-29 07:25:36');
INSERT INTO `activity_log` VALUES ('255', 'Make SO Assignment', 'work_order', null, '2', 'Make SO Assignment', '280', '{}', '2015-03-29 08:16:01');
INSERT INTO `activity_log` VALUES ('256', 'Save/Edit Action', 'action', null, '42', 'Save/Edit Action', '10', '{\"name\":\"View Work Order\",\"uname\":\"view_work_order\",\"controller\":\"work_order\",\"function_exec\":\"\",\"function_args\":\"\",\"view_type\":\"gridview\",\"view_file\":\"work_order_list\",\"prefix\":\"\",\"action_type\":\"view\",\"action_button\":\"view_detail\",\"target_action\":\"\",\"use_log\":\"0\",\"is_edit\":\"true\",\"id_edit\":\"129\"}', '2015-03-31 17:47:13');
INSERT INTO `activity_log` VALUES ('257', 'Save/Edit Side Menu', 'side_menu', null, '42', 'Save/Edit Side Menu', '9', '{}', '2015-03-31 17:49:06');
INSERT INTO `activity_log` VALUES ('258', 'Save/Edit Action', 'action', null, '42', 'Save/Edit Action', '10', '{\"name\":\"Edit Work Order\",\"uname\":\"edit_work_order\",\"controller\":\"work_order\",\"function_exec\":\"init_edit_work_order\",\"function_args\":\"id\",\"view_type\":\"form\",\"view_file\":\"work_order_ce\",\"prefix\":\"\",\"action_type\":\"view\",\"action_button\":\"no_button\",\"target_action\":\"\",\"use_log\":\"0\",\"is_edit\":\"true\",\"id_edit\":\"131\"}', '2015-03-31 17:52:16');
INSERT INTO `activity_log` VALUES ('259', 'Save/Edit Inquiry', 'inquiry', null, '42', 'Save/Edit Inquiry', '113', '{}', '2015-03-31 19:02:34');
INSERT INTO `activity_log` VALUES ('260', 'Validate Inquiry', 'inquiry', null, '42', 'Validate Inquiry', '264', '{\"id_inquiry\":\"6\",\"status\":\"open\"}', '2015-03-31 19:15:24');
INSERT INTO `activity_log` VALUES ('261', 'Save/Edit Action', 'action', null, '42', 'Save/Edit Action', '10', '{\"name\":\"Validate Work Order\",\"uname\":\"validate_work_order\",\"controller\":\"work_order\",\"function_exec\":\"validate_work_order\",\"function_args\":\"id\",\"view_type\":\"no_view\",\"view_file\":\"\",\"prefix\":\"\",\"action_type\":\"update\",\"action_button\":\"no_button\",\"target_action\":\"129\",\"use_log\":\"0\",\"is_edit\":\"false\",\"id_edit\":\"\"}', '2015-03-31 19:49:27');
INSERT INTO `activity_log` VALUES ('262', 'Save/Edit Action', 'action', null, '42', 'Save/Edit Action', '10', '{\"name\":\"View Timesheet\",\"uname\":\"view_timesheet_(recap)\",\"controller\":\"timesheet\",\"function_exec\":\"\",\"function_args\":\"\",\"view_type\":\"gridview\",\"view_file\":\"timesheet_list\",\"prefix\":\"\",\"action_type\":\"view\",\"action_button\":\"crud\",\"target_action\":\"\",\"use_log\":\"0\",\"is_edit\":\"true\",\"id_edit\":\"164\"}', '2015-04-01 04:18:57');
INSERT INTO `activity_log` VALUES ('263', 'Save/Edit Action', 'action', null, '42', 'Save/Edit Action', '10', '{\"name\":\"Create Timesheet \",\"uname\":\"create_timesheet_(recap)\",\"controller\":\"timesheet\",\"function_exec\":\"init_create_timesheet\",\"function_args\":\"\",\"view_type\":\"form\",\"view_file\":\"timesheet_ce\",\"prefix\":\"\",\"action_type\":\"create\",\"action_button\":\"save_discard\",\"target_action\":\"\",\"use_log\":\"0\",\"is_edit\":\"true\",\"id_edit\":\"165\"}', '2015-04-01 04:19:14');
INSERT INTO `activity_log` VALUES ('264', 'Save/Edit Action', 'action', null, '42', 'Save/Edit Action', '10', '{\"name\":\"Create Timesheet\",\"uname\":\"create_timesheet\",\"controller\":\"timesheet\",\"function_exec\":\"init_create_timesheet\",\"function_args\":\"\",\"view_type\":\"form\",\"view_file\":\"timesheet_ce\",\"prefix\":\"\",\"action_type\":\"view\",\"action_button\":\"save_discard\",\"target_action\":\"\",\"use_log\":\"0\",\"is_edit\":\"true\",\"id_edit\":\"352\"}', '2015-04-01 04:36:07');
INSERT INTO `activity_log` VALUES ('265', 'Save/Edit Action', 'action', null, '42', 'Save/Edit Action', '10', '{\"name\":\"Edit Timesheet\",\"uname\":\"edit_timesheet\",\"controller\":\"timesheet\",\"function_exec\":\"init_edit_timesheet\",\"function_args\":\"id\",\"view_type\":\"form\",\"view_file\":\"timesheet_ce\",\"prefix\":\"\",\"action_type\":\"view\",\"action_button\":\"save_discard\",\"target_action\":\"\",\"use_log\":\"0\",\"is_edit\":\"true\",\"id_edit\":\"374\"}', '2015-04-01 06:01:05');
INSERT INTO `activity_log` VALUES ('266', 'Save/Edit Action', 'action', null, '42', 'Save/Edit Action', '10', '{\"name\":\"Edit Timesheet\",\"uname\":\"edit_timesheet\",\"controller\":\"timesheet\",\"function_exec\":\"init_edit_timesheet\",\"function_args\":\"id\",\"view_type\":\"form\",\"view_file\":\"timesheet_ce\",\"prefix\":\"\",\"action_type\":\"view\",\"action_button\":\"save_discard\",\"target_action\":\"\",\"use_log\":\"0\",\"is_edit\":\"true\",\"id_edit\":\"374\"}', '2015-04-01 06:30:43');
INSERT INTO `activity_log` VALUES ('267', 'Save/Edit Action', 'action', null, '42', 'Save/Edit Action', '10', '{\"name\":\"View Recruitment\",\"uname\":\"view_recruitment\",\"controller\":\"recruitment\",\"function_exec\":\"\",\"function_args\":\"\",\"view_type\":\"gridview\",\"view_file\":\"recruitment_list\",\"prefix\":\"\",\"action_type\":\"view\",\"action_button\":\"no_button\",\"target_action\":\"\",\"use_log\":\"0\",\"is_edit\":\"true\",\"id_edit\":\"375\"}', '2015-04-01 08:56:26');
INSERT INTO `activity_log` VALUES ('268', 'Save/Edit Side Menu', 'side_menu', null, '42', 'Save/Edit Side Menu', '9', '{}', '2015-04-01 08:56:42');
INSERT INTO `activity_log` VALUES ('269', 'Save/Edit Action', 'action', null, '42', 'Save/Edit Action', '10', '{\"name\":\"View Recruitment\",\"uname\":\"view_recruitment\",\"controller\":\"recruitment\",\"function_exec\":\"\",\"function_args\":\"\",\"view_type\":\"gridview\",\"view_file\":\"recruitment_list\",\"prefix\":\"\",\"action_type\":\"view\",\"action_button\":\"crud\",\"target_action\":\"\",\"use_log\":\"0\",\"is_edit\":\"true\",\"id_edit\":\"375\"}', '2015-04-01 08:57:59');
INSERT INTO `activity_log` VALUES ('270', 'Delete Notification Setting', 'notification_setting', null, '42', 'Delete Notification Setting', '317', '{\"id_notification_setting\":false}', '2015-04-01 08:58:03');
INSERT INTO `activity_log` VALUES ('271', 'Save/Edit Action', 'action', null, '42', 'Save/Edit Action', '10', '{\"name\":\"Create Recruitment\",\"uname\":\"create_recruitment\",\"controller\":\"recruitment\",\"function_exec\":\"init_create_recruitment\",\"function_args\":\"\",\"view_type\":\"form\",\"view_file\":\"recruitment_ce\",\"prefix\":\"\",\"action_type\":\"view\",\"action_button\":\"save_discard\",\"target_action\":\"\",\"use_log\":\"0\",\"is_edit\":\"false\",\"id_edit\":\"\"}', '2015-04-01 08:59:31');
INSERT INTO `activity_log` VALUES ('272', 'Save/Edit Side Menu', 'side_menu', null, '42', 'Save/Edit Side Menu', '9', '{}', '2015-04-01 09:03:47');
INSERT INTO `activity_log` VALUES ('273', 'Save/Edit Action', 'action', null, '42', 'Save/Edit Action', '10', '{\"name\":\"Save\\/Edit Recruitment\",\"uname\":\"save_edit_recruitment\",\"controller\":\"recruitment\",\"function_exec\":\"save_recruitment\",\"function_args\":\"\",\"view_type\":\"no_view\",\"view_file\":\"\",\"prefix\":\"\",\"action_type\":\"create\",\"action_button\":\"save_discard\",\"target_action\":\"375\",\"use_log\":\"0\",\"is_edit\":\"true\",\"id_edit\":\"377\"}', '2015-04-01 09:09:51');
INSERT INTO `activity_log` VALUES ('274', 'Save/Edit Action', 'action', null, '42', 'Save/Edit Action', '10', '{\"name\":\"Delete Recruitment\",\"uname\":\"delete_recruitment\",\"controller\":\"recruitment\",\"function_exec\":\"delete_recruitment\",\"function_args\":\"\",\"view_type\":\"no_view\",\"view_file\":\"\",\"prefix\":\"\",\"action_type\":\"view\",\"action_button\":\"crud\",\"target_action\":\"375\",\"use_log\":\"0\",\"is_edit\":\"true\",\"id_edit\":\"378\"}', '2015-04-01 09:13:03');
INSERT INTO `activity_log` VALUES ('275', 'Save/Edit Action', 'action', null, '42', 'Save/Edit Action', '10', '{\"name\":\"Edit Recruitment\",\"uname\":\"edit_recruitment\",\"controller\":\"recruitment\",\"function_exec\":\"init_edit_recruitment\",\"function_args\":\"id\",\"view_type\":\"form\",\"view_file\":\"recruitment_ce\",\"prefix\":\"\",\"action_type\":\"view\",\"action_button\":\"save_discard\",\"target_action\":\"\",\"use_log\":\"0\",\"is_edit\":\"true\",\"id_edit\":\"379\"}', '2015-04-01 09:17:44');
INSERT INTO `activity_log` VALUES ('276', 'Save/Edit Side Menu', 'side_menu', null, '42', 'Save/Edit Side Menu', '9', '{}', '2015-04-01 09:23:06');
INSERT INTO `activity_log` VALUES ('277', 'Save/Edit Action', 'action', null, '42', 'Save/Edit Action', '10', '{\"name\":\"View Request Overtime\",\"uname\":\"view_overtime\",\"controller\":\"overtime\",\"function_exec\":\"\",\"function_args\":\"\",\"view_type\":\"gridview\",\"view_file\":\"overtime_list\",\"prefix\":\"\",\"action_type\":\"view\",\"action_button\":\"crud\",\"target_action\":\"\",\"use_log\":\"0\",\"is_edit\":\"true\",\"id_edit\":\"380\"}', '2015-04-01 09:26:13');
INSERT INTO `activity_log` VALUES ('278', 'Save/Edit Side Menu', 'side_menu', null, '42', 'Save/Edit Side Menu', '9', '{}', '2015-04-01 09:26:51');
INSERT INTO `activity_log` VALUES ('279', 'Save/Edit Action', 'action', null, '42', 'Save/Edit Action', '10', '{\"name\":\"Create Request Overtime\",\"uname\":\"create_overtime\",\"controller\":\"overtime\",\"function_exec\":\"init_create_overtime\",\"function_args\":\"\",\"view_type\":\"form\",\"view_file\":\"overtime_ce\",\"prefix\":\"\",\"action_type\":\"view\",\"action_button\":\"save_discard\",\"target_action\":\"\",\"use_log\":\"0\",\"is_edit\":\"true\",\"id_edit\":\"381\"}', '2015-04-01 09:29:56');
INSERT INTO `activity_log` VALUES ('280', 'Save/Edit Action', 'action', null, '42', 'Save/Edit Action', '10', '{\"name\":\"Save\\/Edit Overtime\",\"uname\":\"save_edit_overtime\",\"controller\":\"overtime\",\"function_exec\":\"save_overtime\",\"function_args\":\"\",\"view_type\":\"no_view\",\"view_file\":\"\",\"prefix\":\"\",\"action_type\":\"create\",\"action_button\":\"save_discard\",\"target_action\":\"380\",\"use_log\":\"0\",\"is_edit\":\"true\",\"id_edit\":\"382\"}', '2015-04-01 09:36:38');
INSERT INTO `activity_log` VALUES ('281', 'Save/Edit Action', 'action', null, '42', 'Save/Edit Action', '10', '{\"name\":\"Delete Overtime\",\"uname\":\"delete_overtime\",\"controller\":\"overtime\",\"function_exec\":\"delete_overtime\",\"function_args\":\"\",\"view_type\":\"no_view\",\"view_file\":\"\",\"prefix\":\"\",\"action_type\":\"view\",\"action_button\":\"crud\",\"target_action\":\"380\",\"use_log\":\"0\",\"is_edit\":\"true\",\"id_edit\":\"383\"}', '2015-04-01 09:36:59');
INSERT INTO `activity_log` VALUES ('282', 'Save/Edit Action', 'action', null, '42', 'Save/Edit Action', '10', '{\"name\":\"Edit Overtime\",\"uname\":\"edit_overtime\",\"controller\":\"overtime\",\"function_exec\":\"init_edit_overtime\",\"function_args\":\"id\",\"view_type\":\"form\",\"view_file\":\"overtime_ce\",\"prefix\":\"\",\"action_type\":\"view\",\"action_button\":\"save_discard\",\"target_action\":\"\",\"use_log\":\"0\",\"is_edit\":\"true\",\"id_edit\":\"384\"}', '2015-04-01 09:37:19');
INSERT INTO `activity_log` VALUES ('283', 'Delete Group', 'group', null, '42', 'Delete Group', '307', '{}', '2015-04-01 09:38:37');
INSERT INTO `activity_log` VALUES ('284', 'Save/Edit Action', 'action', null, '42', 'Save/Edit Action', '10', '{\"name\":\"Validate Overtime\",\"uname\":\"validate_overtime\",\"controller\":\"overtime\",\"function_exec\":\"validate_overtime\",\"function_args\":\"id\",\"view_type\":\"no_view\",\"view_file\":\"\",\"prefix\":\"\",\"action_type\":\"update\",\"action_button\":\"no_button\",\"target_action\":\"380\",\"use_log\":\"0\",\"is_edit\":\"true\",\"id_edit\":\"385\"}', '2015-04-01 09:39:38');
INSERT INTO `activity_log` VALUES ('285', 'Save/Edit Action', 'action', null, '42', 'Save/Edit Action', '10', '{\"name\":\"View Insentive\",\"uname\":\"view_insentive\",\"controller\":\"insentive\",\"function_exec\":\"\",\"function_args\":\"\",\"view_type\":\"gridview\",\"view_file\":\"insentive_list\",\"prefix\":\"\",\"action_type\":\"view\",\"action_button\":\"crud\",\"target_action\":\"\",\"use_log\":\"0\",\"is_edit\":\"true\",\"id_edit\":\"386\"}', '2015-04-01 09:45:42');
INSERT INTO `activity_log` VALUES ('286', 'Save/Edit Action', 'action', null, '42', 'Save/Edit Action', '10', '{\"name\":\"Create Request Insentive\",\"uname\":\"create_insentive\",\"controller\":\"insentive\",\"function_exec\":\"init_create_insentive\",\"function_args\":\"\",\"view_type\":\"form\",\"view_file\":\"insentive_ce\",\"prefix\":\"\",\"action_type\":\"view\",\"action_button\":\"save_discard\",\"target_action\":\"\",\"use_log\":\"0\",\"is_edit\":\"true\",\"id_edit\":\"387\"}', '2015-04-01 09:46:03');
INSERT INTO `activity_log` VALUES ('287', 'Save/Edit Action', 'action', null, '42', 'Save/Edit Action', '10', '{\"name\":\"Save\\/Edit Insentive\",\"uname\":\"save_edit_insentive\",\"controller\":\"insentive\",\"function_exec\":\"save_insentive\",\"function_args\":\"\",\"view_type\":\"no_view\",\"view_file\":\"\",\"prefix\":\"\",\"action_type\":\"create\",\"action_button\":\"save_discard\",\"target_action\":\"386\",\"use_log\":\"0\",\"is_edit\":\"true\",\"id_edit\":\"388\"}', '2015-04-01 09:46:38');
INSERT INTO `activity_log` VALUES ('288', 'Save/Edit Action', 'action', null, '42', 'Save/Edit Action', '10', '{\"name\":\"Delete Insentive\",\"uname\":\"delete_insentive\",\"controller\":\"insentive\",\"function_exec\":\"delete_insentive\",\"function_args\":\"\",\"view_type\":\"no_view\",\"view_file\":\"\",\"prefix\":\"\",\"action_type\":\"view\",\"action_button\":\"crud\",\"target_action\":\"386\",\"use_log\":\"0\",\"is_edit\":\"true\",\"id_edit\":\"389\"}', '2015-04-01 09:47:05');
INSERT INTO `activity_log` VALUES ('289', 'Save/Edit Action', 'action', null, '42', 'Save/Edit Action', '10', '{\"name\":\"Edit Insentive\",\"uname\":\"edit_insentive\",\"controller\":\"insentive\",\"function_exec\":\"init_edit_insentive\",\"function_args\":\"id\",\"view_type\":\"form\",\"view_file\":\"insentive_ce\",\"prefix\":\"\",\"action_type\":\"view\",\"action_button\":\"save_discard\",\"target_action\":\"\",\"use_log\":\"0\",\"is_edit\":\"true\",\"id_edit\":\"390\"}', '2015-04-01 09:47:31');
INSERT INTO `activity_log` VALUES ('290', 'Save/Edit Side Menu', 'side_menu', null, '42', 'Save/Edit Side Menu', '9', '{}', '2015-04-01 09:49:12');
INSERT INTO `activity_log` VALUES ('291', 'Save/Edit Side Menu', 'side_menu', null, '42', 'Save/Edit Side Menu', '9', '{}', '2015-04-01 09:57:53');
INSERT INTO `activity_log` VALUES ('292', 'Save/Edit Action', 'action', null, '42', 'Save/Edit Action', '10', '{\"name\":\"Delete Salary Type\",\"uname\":\"delete_salary_type\",\"controller\":\"salary_type\",\"function_exec\":\"delete_salary_type\",\"function_args\":\"\",\"view_type\":\"no_view\",\"view_file\":\"\",\"prefix\":\"\",\"action_type\":\"delete\",\"action_button\":\"crud\",\"target_action\":\"354\",\"use_log\":\"1\",\"is_edit\":\"true\",\"id_edit\":\"391\"}', '2015-04-01 10:02:47');
INSERT INTO `activity_log` VALUES ('293', 'Save/Edit Side Menu', 'side_menu', null, '42', 'Save/Edit Side Menu', '9', '{}', '2015-04-01 10:11:58');
INSERT INTO `activity_log` VALUES ('294', 'Delete Salary Type', 'salary_type', null, '42', 'Delete Salary Type', '391', '{}', '2015-04-01 10:38:34');
INSERT INTO `activity_log` VALUES ('295', 'Save/Edit Action', 'action', null, '42', 'Save/Edit Action', '10', '{\"name\":\"Save\\/Edit Payroll Periode\",\"uname\":\"save_edit_payroll_periode\",\"controller\":\"payroll_periode\",\"function_exec\":\"save_payroll_periode\",\"function_args\":\"\",\"view_type\":\"no_view\",\"view_file\":\"\",\"prefix\":\"\",\"action_type\":\"create\",\"action_button\":\"save_discard\",\"target_action\":\"356\",\"use_log\":\"0\",\"is_edit\":\"true\",\"id_edit\":\"392\"}', '2015-04-01 10:45:51');
INSERT INTO `activity_log` VALUES ('296', 'Delete Salary Type', 'salary_type', null, '42', 'Delete Salary Type', '391', '{}', '2015-04-01 10:46:17');
INSERT INTO `activity_log` VALUES ('297', 'Save/Edit Action', 'action', null, '42', 'Save/Edit Action', '10', '{\"name\":\"Save \\/ Edit Salary Type\",\"uname\":\"save_edit_salary_type\",\"controller\":\"salary_type\",\"function_exec\":\"save_salary_type\",\"function_args\":\"\",\"view_type\":\"no_view\",\"view_file\":\"\",\"prefix\":\"\",\"action_type\":\"create\",\"action_button\":\"save_discard\",\"target_action\":\"354\",\"use_log\":\"0\",\"is_edit\":\"true\",\"id_edit\":\"350\"}', '2015-04-01 10:49:16');
INSERT INTO `activity_log` VALUES ('298', 'Delete Salary Type', 'salary_type', null, '42', 'Delete Salary Type', '391', '{}', '2015-04-01 10:54:48');
INSERT INTO `activity_log` VALUES ('299', 'Delete Salary Type', 'salary_type', null, '42', 'Delete Salary Type', '391', '{}', '2015-04-01 10:54:52');
INSERT INTO `activity_log` VALUES ('300', 'Save/Edit Quotation', 'quotation', null, '42', 'Save/Edit Quotation', '123', '{}', '2015-04-01 11:05:18');
INSERT INTO `activity_log` VALUES ('301', 'Save/Edit Action', 'action', null, '42', 'Save/Edit Action', '10', '{\"name\":\"View Detail Payroll\",\"uname\":\"view_detail_payroll\",\"controller\":\"payroll_periode\",\"function_exec\":\"init_view\",\"function_args\":\"\",\"view_type\":\"gridview\",\"view_file\":\"detail_payroll_periode_list\",\"prefix\":\"\",\"action_type\":\"view\",\"action_button\":\"no_button\",\"target_action\":\"\",\"use_log\":\"0\",\"is_edit\":\"true\",\"id_edit\":\"393\"}', '2015-04-01 11:17:19');
INSERT INTO `activity_log` VALUES ('302', 'Save/Edit Action', 'action', null, '42', 'Save/Edit Action', '10', '{\"name\":\"Edit Insentive\",\"uname\":\"edit_insentive\",\"controller\":\"insentive\",\"function_exec\":\"init_edit_insentive\",\"function_args\":\"id\",\"view_type\":\"form\",\"view_file\":\"insentive_ce\",\"prefix\":\"\",\"action_type\":\"view\",\"action_button\":\"save_discard\",\"target_action\":\"\",\"use_log\":\"0\",\"is_edit\":\"true\",\"id_edit\":\"390\"}', '2015-04-01 11:43:40');
INSERT INTO `activity_log` VALUES ('303', 'Save/Edit Action', 'action', null, '42', 'Save/Edit Action', '10', '{\"name\":\"Edit Insentive\",\"uname\":\"edit_insentive\",\"controller\":\"insentive\",\"function_exec\":\"init_edit_insentive\",\"function_args\":\"id\",\"view_type\":\"form\",\"view_file\":\"insentive_ce\",\"prefix\":\"\",\"action_type\":\"update\",\"action_button\":\"save_discard\",\"target_action\":\"\",\"use_log\":\"0\",\"is_edit\":\"true\",\"id_edit\":\"390\"}', '2015-04-01 12:06:59');
INSERT INTO `activity_log` VALUES ('304', 'Save/Edit Action', 'action', null, '42', 'Save/Edit Action', '10', '{\"name\":\"Edit Insentive\",\"uname\":\"edit_insentive\",\"controller\":\"insentive\",\"function_exec\":\"init_edit_insentive\",\"function_args\":\"id\",\"view_type\":\"form\",\"view_file\":\"insentive_ce\",\"prefix\":\"\",\"action_type\":\"view\",\"action_button\":\"save_discard\",\"target_action\":\"\",\"use_log\":\"0\",\"is_edit\":\"true\",\"id_edit\":\"390\"}', '2015-04-01 12:28:13');
INSERT INTO `activity_log` VALUES ('305', 'Save/Edit Action', 'action', null, '42', 'Save/Edit Action', '10', '{\"name\":\"View Payroll\",\"uname\":\"view_payroll\",\"controller\":\"payroll\",\"function_exec\":\"\",\"function_args\":\"\",\"view_type\":\"gridview\",\"view_file\":\"payroll_list\",\"prefix\":\"\",\"action_type\":\"view\",\"action_button\":\"no_button\",\"target_action\":\"\",\"use_log\":\"0\",\"is_edit\":\"true\",\"id_edit\":\"179\"}', '2015-04-01 14:12:41');
INSERT INTO `activity_log` VALUES ('306', 'Delete Product Definition', 'product_definition', null, '42', 'Delete Product Definition', '322', '{}', '2015-04-01 14:13:55');

-- ----------------------------
-- Table structure for `address_type`
-- ----------------------------
DROP TABLE IF EXISTS `address_type`;
CREATE TABLE `address_type` (
  `id_address_type` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL COMMENT 'permanent, temporary, mailing',
  PRIMARY KEY (`id_address_type`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of address_type
-- ----------------------------
INSERT INTO `address_type` VALUES ('1', 'Permanent');
INSERT INTO `address_type` VALUES ('2', 'Temporary');
INSERT INTO `address_type` VALUES ('3', 'Mailing');

-- ----------------------------
-- Table structure for `application_action`
-- ----------------------------
DROP TABLE IF EXISTS `application_action`;
CREATE TABLE `application_action` (
  `id_application_action` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `uname` varchar(45) NOT NULL,
  `controller` varchar(45) DEFAULT NULL,
  `function_exec` varchar(45) DEFAULT NULL,
  `function_args` text,
  `view_type` varchar(45) NOT NULL COMMENT 'view_type: list, form, no_view',
  `view_file` varchar(45) DEFAULT NULL,
  `prefix` varchar(45) DEFAULT NULL,
  `action_type` varchar(45) DEFAULT NULL COMMENT 'view,create,update,delete',
  `action_button` varchar(45) DEFAULT NULL,
  `target_action` int(11) DEFAULT NULL,
  `use_log` tinyint(1) NOT NULL DEFAULT '0',
  `need_claim` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_application_action`),
  KEY `fk_application_action_application_action1_idx` (`target_action`)
) ENGINE=InnoDB AUTO_INCREMENT=394 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of application_action
-- ----------------------------
INSERT INTO `application_action` VALUES ('1', 'View Application Action', 'view_application_action', 'action', null, null, 'girdview', 'action_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('2', 'Create Application Action', 'create_application_action', 'action', 'init_create_action', null, 'form', 'action_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('3', 'Edit Application Action', 'edit_application_action', 'action', 'get_action_data', 'id', 'form', 'action_ce', '', 'update', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('4', 'Delete Application Action', 'delete_application_action', 'action', 'delete_application_action', '', 'no_view', '', '', 'delete', 'crud', '1', '1', '0');
INSERT INTO `application_action` VALUES ('5', 'View Side Menu', 'view_side_menu', 'side_menu', '', '', 'no_view', 'side_menu_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('6', 'Create Side Menu', 'create_side_menu', 'side_menu', 'init_create_side_menu', '', 'form', 'side_menu_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('7', 'Edit Side Menu', 'edit_side_menu', 'side_menu', 'get_side_menu_data', 'id', 'no_view', 'side_menu_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('8', 'Delete Side Menu', 'delete_side_menu', 'side_menu', 'delete_side_menu', '', 'no_view', '', '', 'delete', 'crud', '5', '1', '0');
INSERT INTO `application_action` VALUES ('9', 'Save/Edit Side Menu', 'save_edit_side_menu', 'side_menu', 'save_side_menu', '', 'no_view', '', '', 'create', 'crud', '5', '1', '0');
INSERT INTO `application_action` VALUES ('10', 'Save/Edit Action', 'save_edit_action', 'action', 'insert_action', '', 'no_view', '', '', 'create', 'save_discard', '1', '1', '0');
INSERT INTO `application_action` VALUES ('11', 'View Division', 'view_division', 'division', '', '', 'gridview', 'division_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('12', 'Create Division', 'create_division', 'division', '', '', 'form', 'division_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('13', 'Save/Edit Division', 'save_edit_division', 'division', 'save_division', '', 'no_view', '', '', 'create', 'save_discard', '11', '1', '0');
INSERT INTO `application_action` VALUES ('14', 'Edit Division', 'edit_division', 'division', 'init_edit_division', 'id', 'form', 'division_ce', 'division', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('15', 'Delete Division', 'delete_division', 'division', 'delete_division', '', 'no_view', '', 'division', 'view', 'crud', '11', '1', '0');
INSERT INTO `application_action` VALUES ('16', 'View Role', 'view_role', 'role', '', '', 'gridview', 'role_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('17', 'View Create Role', 'view_create_role', 'role', 'init_create_role', '', 'form', 'role_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('18', 'View Edit Role', 'view_edit_role', 'role', 'init_edit_role', 'id', 'form', 'role_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('19', 'Delete Role', 'delete_role', 'role', 'delete_role', '', 'no_view', '', '', 'delete', 'save_discard', '16', '1', '0');
INSERT INTO `application_action` VALUES ('20', 'Save/Edit Role', 'save_edit_role', 'role', 'save_role', '', 'no_view', '', '', 'create', 'save_discard', '16', '1', '0');
INSERT INTO `application_action` VALUES ('21', 'View Product', 'view_product', 'product', '', '', 'form', 'product_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('22', 'Create Product', 'create_product', 'product', 'init_create_product', '', 'form', 'product_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('23', 'Edit Product', 'edit_product', 'product', 'init_edit_product', 'id', 'no_view', 'product_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('24', 'Delete Product', 'delete_product', 'product', 'delete_product', '', 'no_view', '', '', 'delete', 'crud', '21', '1', '0');
INSERT INTO `application_action` VALUES ('25', 'Save/Edit Product', 'save_edit_product', 'product', 'save_product', '', 'no_view', '', '', 'create', 'crud', '21', '1', '0');
INSERT INTO `application_action` VALUES ('26', 'View Supplier', 'view_supplier', 'supplier', '', '', 'form', 'supplier_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('27', 'Create Supplier', 'create_supplier', 'supplier', '', '', 'form', 'supplier_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('28', 'Edit Supplier', 'edit_supplier', 'supplier', 'init_edit_supplier', 'id', 'no_view', 'supplier_ce', '', 'update', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('29', 'Delete Supplier', 'delete_supplier', 'supplier', 'delete_supplier', '', 'no_view', '', '', 'delete', 'crud', '26', '1', '0');
INSERT INTO `application_action` VALUES ('30', 'Save/Edit Supplier', 'save_edit_supplier', 'supplier', 'save_supplier', '', 'no_view', '', '', 'create', 'crud', '26', '1', '0');
INSERT INTO `application_action` VALUES ('31', 'View Product Category', 'view_product_category', 'product_category', '', '', 'gridview', 'product_category_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('32', 'Create Product Category', 'create_product_category', 'product_category', '', '', 'gridview', 'product_category_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('33', 'Edit Product Category', 'edit_product_category', 'product_category', 'init_edit_product_category', 'id', 'form', 'product_category_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('34', 'Delete Product Category', 'delete_product_category', 'product_category', 'delete_product_category', '', 'no_view', '', '', 'delete', 'crud', '31', '1', '0');
INSERT INTO `application_action` VALUES ('35', 'Save/Edit Product Category', 'save_edit_product_category', 'product_category', 'save_product_category', '', 'no_view', '', '', 'create', 'crud', '31', '1', '0');
INSERT INTO `application_action` VALUES ('36', 'View Merk', 'view_merk', 'merk', '', '', 'gridview', 'merk_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('37', 'Create Merk', 'create_merk', 'merk', '', '', 'form', 'merk_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('38', 'Edit Merk', 'edit_merk', 'merk', 'init_edit_merk', 'id', 'form', 'merk_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('39', 'Delete Merk', 'delete_merk', 'merk', 'delete_merk', '', 'no_view', '', '', 'delete', 'crud', '36', '1', '0');
INSERT INTO `application_action` VALUES ('40', 'Save/Edit Merk', 'save_edit_merk', 'merk', 'save_merk', '', 'no_view', '', '', 'create', 'crud', '36', '1', '0');
INSERT INTO `application_action` VALUES ('41', 'View Customer', 'view_customer', 'customer', '', '', 'gridview', 'customer_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('43', 'Create Customer', 'create_customer', 'customer', 'init_create_customer', '', 'form', 'customer_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('44', 'Edit Customer', 'edit_customer', 'customer', 'init_edit_customer', 'id', 'form', 'customer_ce', '', 'update', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('45', 'Delete Customer', 'delete_customer', 'customer', 'delete_customer', '', 'no_view', '', '', 'delete', 'crud', '41', '1', '0');
INSERT INTO `application_action` VALUES ('46', 'Save/Edit Customer', 'save_edit_customer', 'customer', 'save_customer', '', 'no_view', '', '', 'create', 'crud', '41', '1', '0');
INSERT INTO `application_action` VALUES ('47', 'View Warehouse', 'view_warehouse', 'gudang', '', '', 'gridview', 'gudang_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('48', 'Create Warehouse', 'create_warehouse', 'gudang', '', '', 'form', 'gudang_ce', '', 'create', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('49', 'Edit Warehouse', 'edit_warehouse', 'gudang', 'init_edit_gudang', 'id', 'form', 'gudang_ce', '', 'update', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('50', 'Delete Warehouse', 'delete_warehouse', 'gudang', 'delete_gudang', '', 'no_view', '', '', 'delete', 'crud', null, '1', '0');
INSERT INTO `application_action` VALUES ('51', 'Save/Edit Warehouse', 'save_edit_warehouse', 'gudang', 'save_gudang', '', 'no_view', '', '', 'create', 'crud', '47', '1', '0');
INSERT INTO `application_action` VALUES ('57', 'View PO', 'view_po', 'po', '', '', 'gridview', 'po_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('58', 'Create PO', 'create_po', 'po', '', '', 'form', 'po_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('59', 'Edit PO', 'edit_po', 'po', 'init_edit_po', 'id', 'form', 'po_ce', '', 'update', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('60', 'Delete PO', 'delete_po', 'po', 'delete_po', '', 'no_view', '', '', 'delete', 'save_discard', '57', '1', '0');
INSERT INTO `application_action` VALUES ('61', 'Save/Edit PO', 'save_edit_po', 'po', 'save_po', '', 'no_view', '', '', 'create', 'save_discard', '57', '1', '0');
INSERT INTO `application_action` VALUES ('62', 'View User', 'view_user', 'user', '', '', 'gridview', 'user_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('63', 'Create User', 'create_user', 'user', 'init_create_user', '', 'form', 'user_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('64', 'Edit User', 'edit_user', 'user', 'init_edit_user', 'id', 'form', 'user_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('65', 'Delete User', 'delete_user', 'user', 'delete_user', '', 'no_view', '', '', 'delete', 'crud', '62', '1', '0');
INSERT INTO `application_action` VALUES ('66', 'Save/Edit User', 'save_edit_user', 'user', 'save_user', '', 'no_view', '', '', 'create', 'crud', '62', '1', '0');
INSERT INTO `application_action` VALUES ('67', 'View Good Receive', 'view_good_receive', 'gr', '', '', 'gridview', 'gr_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('68', 'Create Good Receive', 'create_good_receive', 'gr', 'init_create_gr', '', 'form', 'gr_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('69', 'Edit Good Receive', 'edit_good_receive', 'gr', 'init_edit_gr', 'id', 'form', 'gr_ce', '', 'update', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('70', 'Delete Good Receive', 'delete_good_receive', 'gr', 'delete_gr', '', 'no_view', '', '', 'delete', 'save_discard', '67', '1', '0');
INSERT INTO `application_action` VALUES ('71', 'Save/Edit Good Receive', 'save_edit_good_receive', 'gr', 'save_gr', '', 'no_view', '', '', 'create', 'save_discard', '67', '1', '0');
INSERT INTO `application_action` VALUES ('72', 'View Sales Order', 'view_sales_order', 'so', '', '', 'gridview', 'so_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('73', 'Create Sales Order', 'create_sales_order', 'so', '', '', 'form', 'so_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('74', 'Edit Sales Order', 'edit_sales_order', 'so', 'init_edit_so', 'id', 'form', 'so_ce', '', 'update', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('75', 'Delete Sales Order', 'delete_sales_order', 'so', 'delete_so', '', 'no_view', '', '', 'delete', 'save_discard', '72', '1', '0');
INSERT INTO `application_action` VALUES ('76', 'Save Sales Order', 'save_sales_order', 'so', 'save_so', '', 'no_view', '', '', 'create', 'curd', '72', '1', '0');
INSERT INTO `application_action` VALUES ('77', 'View Material Request', 'view_material_request', 'mr', '', '', 'gridview', 'mr_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('78', 'Create Material Request', 'create_material_request', 'mr', '', '', 'form', 'mr_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('79', 'Edit Material Request', 'edit_material_request', 'mr', 'init_edit_mr', 'id', 'form', 'mr_ce', '', 'update', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('80', 'Delete Material Request', 'delete_material_request', 'mr', 'delete_mr', '', 'no_view', '', '', 'delete', 'save_discard', '77', '1', '0');
INSERT INTO `application_action` VALUES ('81', 'Save Material Request', 'save_material_request', 'mr', 'save_mr', '', 'no_view', '', '', 'create', 'save_discard', '77', '1', '0');
INSERT INTO `application_action` VALUES ('82', 'Change User Password', 'change_user_password', 'user', 'change_user_password', '', 'no_view', '', '', 'update', 'crud', '62', '0', '0');
INSERT INTO `application_action` VALUES ('83', 'View Delivery Note', 'view_delivery_note', 'dn', '', '', 'gridview', 'dn_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('84', 'Create Delivery Note', 'create_delivery_note', 'dn', '', '', 'form', 'dn_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('85', 'Edit Delivery Note', 'edit_delivery_note', 'dn', 'init_edit_dn', 'id', 'form', 'dn_ce', '', 'update', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('86', 'Delete Delivery Note', 'delete_delivery_note', 'dn', 'delete_dn', '', 'no_view', '', '', 'delete', 'save_discard', '83', '1', '0');
INSERT INTO `application_action` VALUES ('87', 'Save/Edit Delivery Note', 'save_edit_delivery_note', 'dn', 'save_dn', '', 'no_view', '', '', 'create', 'save_discard', '83', '1', '0');
INSERT INTO `application_action` VALUES ('88', 'View Unit Measure', 'view_unit_measure', 'unit_measure', '', '', 'gridview', 'unit_measure_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('89', 'Create Unit Measure', 'create_unit_measure', 'unit_measure', 'init_create_unit_measure', '', 'form', 'unit_measure_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('90', 'Edit Unit Measure', 'edit_unit_measure', 'unit_measure', 'init_edit_unit_measure', 'id', 'form', 'unit_measure_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('91', 'Delete Unit Measure', 'delete_unit_measure', 'unit_measure', 'delete_unit_measure', '', 'no_view', '', '', 'delete', 'crud', '88', '1', '0');
INSERT INTO `application_action` VALUES ('92', 'Save/Edit Unit Measure', 'save_edit_unit_measure', 'unit_measure', 'save_unit_measure', '', 'no_view', '', '', 'create', 'crud', '88', '1', '0');
INSERT INTO `application_action` VALUES ('93', 'View Stock', 'view_stock', 'stock', '', '', 'gridview', 'stock_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('94', 'View Employee', 'view_employee', 'employee', '', '', 'gridview', 'employee_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('95', 'Create Employee', 'create_employee', 'employee', 'init_create_employee', '', 'form', 'employee_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('96', 'Edit Employee', 'edit_employee', 'employee', 'init_edit_employee', 'id', 'form', 'employee_ce', '', 'update', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('97', 'Delete Employee', 'delete_employee', 'employee', 'delete_employee', '', 'no_view', '', '', 'delete', 'crud', '94', '1', '0');
INSERT INTO `application_action` VALUES ('98', 'Save/Edit Employee', 'save_edit_employee', 'employee', 'save_employee', '', 'no_view', '', '', 'create', 'crud', '94', '1', '0');
INSERT INTO `application_action` VALUES ('99', 'Validate PO', 'validate_po', 'po', 'validate_po', 'id', 'no_view', '', '', 'update', 'crud', '59', '1', '0');
INSERT INTO `application_action` VALUES ('100', 'Create Database Interface', 'create_database_interface', 'database_interface', 'init_database_interface', '', 'form', 'database_interface_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('101', 'Edit Database Interface', 'edit_database_interface', 'database_interface', 'init_edit_database_interface', 'id', 'form', 'database_interface_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('102', 'Delete Database Interface', 'delete_database_interface', 'database_interface', 'delete_database_interface', '', 'no_view', '', '', 'delete', 'crud', '224', '0', '0');
INSERT INTO `application_action` VALUES ('103', 'Save / Edit Database Interface', 'save___edit_database_interface', 'Database Interface', 'save_database_interface', '', 'no_view', '', '', 'create', 'crud', '224', '0', '0');
INSERT INTO `application_action` VALUES ('104', 'View Database Field Interface', 'view_database_field_interface', 'database_interface', '', '', 'gridview', 'database_field_interface_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('105', 'Create Database Field Interface', 'create_database_field_interface', 'database_interface', 'init_create_database_field_interface', '', 'form', 'database_field_interface_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('106', 'Edit Database Field Interface', 'edit_database_field_interface', 'database_interface', 'init_edit_database_field_interface', 'id', 'form', 'database_field_interface_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('107', 'Delete Database Field Interface', 'delete_database_field_interface', 'database_interface', 'delete_database_field_interface', '', 'no_view', '', '', 'delete', 'crud', '104', '0', '0');
INSERT INTO `application_action` VALUES ('108', 'Save / Edit Database Field Interface', 'save___edit_database_field_interface', 'database_interface', 'save_database_field_interface', '', 'no_view', '', '', 'create', 'crud', '104', '0', '0');
INSERT INTO `application_action` VALUES ('109', 'View Inquiry', 'view_inquiry', 'inquiry', '', '', 'gridview', 'inquiry_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('110', 'Create Inquiry', 'create_inquiry', 'inquiry', 'init_create_inquiry', '', 'form', 'inquiry_ce', '', 'create', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('111', 'Edit Inquiry', 'edit_inquiry', 'inquiry', 'init_edit_inquiry', 'id', 'form', 'inquiry_ce', '', 'edit', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('112', 'Delete Inquiry', 'delete_inquiry', 'inquiry', 'delete_inquiry', '', 'no_view', '', '', 'delete', 'crud', '109', '1', '0');
INSERT INTO `application_action` VALUES ('113', 'Save/Edit Inquiry', 'save_edit_inquiry', 'inquiry', 'save_inquiry', '', 'no_view', '', '', 'create', 'crud', '109', '1', '0');
INSERT INTO `application_action` VALUES ('114', 'View Survey / Assessment', 'view_survey___assessment', 'survey_assessment', '', '', 'gridview', 'survey_assessment_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('115', 'Create Survey / Assessment', 'create_survey___assessment', 'survey_assessment', 'init_create_survey_assessment', '', 'form', 'survey_assessment_ce', '', 'create', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('116', 'Edit Survey / Assessment', 'edit_survey___assessment', 'survey_assessment', 'init_edit_survey_assessment', 'id', 'form', 'survey_assessment_ce', '', 'edit', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('117', 'Delete Survey / Assessment', 'delete_survey___assessment', 'survey_assessment', 'delete_survey_assessment', '', 'no_view', '', '', 'delete', 'crud', null, '1', '0');
INSERT INTO `application_action` VALUES ('118', 'Save/Edit Survey / Assessment', 'save_edit_survey___assessment', 'survey_assessment', 'save_survey_assessment', '', 'no_view', '', '', 'create', 'crud', null, '1', '0');
INSERT INTO `application_action` VALUES ('119', 'View Quotation', 'view_quotation', 'quotation', '', '', 'gridview', 'quotation_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('120', 'Create Quotation', 'create_quotation', 'quotation', 'init_create_quotation', '', 'form', 'quotation_ce', '', 'create', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('121', 'Edit Quotation', 'edit_quotation', 'quotation', 'init_edit_quotation', 'id', 'form', 'quotation_ce', '', 'edit', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('122', 'Delete Quotation', 'delete_quotation', 'quotation', 'delete_quotation', '', 'no_view', '', '', 'delete', 'crud', '119', '1', '0');
INSERT INTO `application_action` VALUES ('123', 'Save/Edit Quotation', 'save_edit_quotation', 'quotation', 'save_quotation', '', 'no_view', '', '', 'create', 'crud', '119', '1', '0');
INSERT INTO `application_action` VALUES ('124', 'View Project Contract', 'view_project_contract', 'project_contract', '', '', 'gridview', 'project_contract_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('125', 'Create Project Contract', 'create_project_contract', 'project_contract', 'init_create_project_contract', '', 'form', 'project_contract_ce', '', 'create', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('126', 'Edit Project Contract', 'edit_project_contract', 'project_contract', 'init_edit_project_contract', 'id', 'form', 'project_contract_ce', '', 'edit', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('127', 'Delete Project Contract', 'delete_project_contract', 'project_contract', 'delete_project_contract', '', 'no_view', '', '', 'delete', 'crud', null, '1', '0');
INSERT INTO `application_action` VALUES ('128', 'Save/Edit Project Contract', 'save_edit_project_contract', 'project_contract', 'save_project_contract', '', 'no_view', '', '', 'create', 'crud', null, '1', '0');
INSERT INTO `application_action` VALUES ('129', 'View Work Order', 'view_work_order', 'work_order', '', '', 'gridview', 'work_order_list', '', 'view', 'view_detail', null, '0', '0');
INSERT INTO `application_action` VALUES ('130', 'Create Work Order', 'create_work_order', 'work_order', 'init_create_work_order', '', 'form', 'work_order_ce', '', 'create', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('131', 'Edit Work Order', 'edit_work_order', 'work_order', 'init_edit_work_order', 'id', 'form', 'work_order_ce', '', 'view', 'no_button', null, '0', '0');
INSERT INTO `application_action` VALUES ('132', 'Delete Work Order', 'delete_work_order', 'work_order', 'delete_work_order', '', 'no_view', '', '', 'delete', 'crud', null, '1', '0');
INSERT INTO `application_action` VALUES ('133', 'Save/Edit Work Order', 'save_edit_work_order', 'work_order', 'save_work_order', '', 'no_view', '', '', 'create', 'crud', null, '1', '0');
INSERT INTO `application_action` VALUES ('134', 'View Assessment Template', 'view_assessment_template', 'assessment_template', '', '', 'gridview', 'assessment_template_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('135', 'Create Assessment Template', 'create_assessment_template', 'assessment_template', 'init_create_assessment_template', '', 'form', 'assessment_template_ce', '', 'create', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('136', 'Edit Assessment Template', 'edit_assessment_template', 'assessment_template', 'init_edit_assessment_template', 'id', 'form', 'assessment_template_ce', '', 'edit', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('137', 'Delete Assessment Template', 'delete_assessment_template', 'assessment_template', 'delete_assessment_template', '', 'no_view', '', '', 'delete', 'crud', null, '1', '0');
INSERT INTO `application_action` VALUES ('138', 'Save/Edit Assessment Template', 'save_edit_assessment_template', 'assessment_template', 'save_assessment_template', '', 'no_view', '', '', 'create', 'crud', null, '1', '0');
INSERT INTO `application_action` VALUES ('139', 'View Contract Template', 'view_contract_template', 'contract_template', '', '', 'gridview', 'contract_template_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('140', 'Create Contract Template', 'create_contract_template', 'contract_template', 'init_create_contract_template', '', 'form', 'contract_template_ce', '', 'create', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('141', 'Edit Contract Template', 'edit_contract_template', 'contract_template', 'init_edit_contract_template', 'id', 'form', 'contract_template_ce', '', 'edit', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('142', 'Delete Contract Template', 'delete_contract_template', 'contract_template', 'delete_contract_template', '', 'no_view', '', '', 'delete', 'crud', null, '1', '0');
INSERT INTO `application_action` VALUES ('143', 'Save/Edit Contract Template', 'save_edit_contract_template', 'contract_template', 'save_contract_template', '', 'no_view', '', '', 'create', 'crud', null, '1', '0');
INSERT INTO `application_action` VALUES ('144', 'View Work Schedule', 'view_work_schedule', 'work_schedule', '', '', 'gridview', 'work_schedule_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('145', 'Create Work Schedule', 'create_work_schedule', 'work_schedule', 'init_create_work_schedule', '', 'form', 'work_schedule_ce', '', 'create', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('146', 'Edit Work Schedule', 'edit_work_schedule', 'work_schedule', 'init_edit_work_schedule', 'id', 'form', 'work_schedule_ce', '', 'edit', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('147', 'Delete Work Schedule', 'delete_work_schedule', 'work_schedule', 'delete_work_schedule', '', 'no_view', '', '', 'delete', 'crud', '144', '1', '0');
INSERT INTO `application_action` VALUES ('148', 'Save/Edit Work Schedule', 'save_edit_work_schedule', 'work_schedule', 'save_work_schedule', '', 'no_view', '', '', 'create', 'crud', '144', '1', '0');
INSERT INTO `application_action` VALUES ('149', 'View SO Assignment', 'view_so_assignment', 'so_assignment', '', '', 'gridview', 'so_assignment_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('150', 'Create SO Assignment', 'create_so_assignment', 'so_assignment', 'init_create_so_assignment', '', 'form', 'so_assignment_ce', '', 'create', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('151', 'Edit SO Assignment', 'edit_so_assignment', 'so_assignment', 'init_edit_so_assignment', 'id', 'form', 'so_assignment_ce', '', 'edit', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('152', 'Delete SO Assignment', 'delete_so_assignment', 'so_assignment', 'delete_so_assignment', '', 'no_view', '', '', 'delete', 'crud', null, '1', '0');
INSERT INTO `application_action` VALUES ('153', 'Save/Edit SO Assignment', 'save_edit_so_assignment', 'so_assignment', 'save_so_assignment', '', 'no_view', '', '', 'create', 'crud', null, '1', '0');
INSERT INTO `application_action` VALUES ('154', 'View Shift Change', 'view_shift_change', 'shift_change', '', '', 'gridview', 'shift_change_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('155', 'Create Shift Change', 'create_shift_change', 'shift_change', 'init_create_shift_change', '', 'form', 'shift_change_ce', '', 'create', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('156', 'Edit Shift Change', 'edit_shift_change', 'shift_change', 'init_edit_shift_change', 'id', 'form', 'shift_change_ce', '', 'edit', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('157', 'Delete Shift Change', 'delete_shift_change', 'shift_change', 'delete_shift_change', '', 'no_view', '', '', 'delete', 'crud', null, '1', '0');
INSERT INTO `application_action` VALUES ('158', 'Save/Edit Shift Change', 'save_edit_shift_change', 'shift_change', 'save_shift_change', '', 'no_view', '', '', 'create', 'crud', null, '1', '0');
INSERT INTO `application_action` VALUES ('159', 'View Leave Application', 'view_leave_application', 'leave_application', '', '', 'gridview', 'leave_application_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('160', 'Create Leave Application', 'create_leave_application', 'leave_application', 'init_create_leave_application', '', 'form', 'leave_application_ce', '', 'create', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('161', 'Edit Leave Application', 'edit_leave_application', 'leave_application', 'init_edit_leave_application', 'id', 'form', 'leave_application_ce', '', 'edit', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('162', 'Delete Leave Application', 'delete_leave_application', 'leave_application', 'delete_leave_application', '', 'no_view', '', '', 'delete', 'crud', null, '1', '0');
INSERT INTO `application_action` VALUES ('163', 'Save/Edit Leave Application', 'save_edit_leave_application', 'leave_application', 'save_leave_application', '', 'no_view', '', '', 'create', 'crud', null, '1', '0');
INSERT INTO `application_action` VALUES ('164', 'View Timesheet', 'view_timesheet_(recap)', 'timesheet', '', '', 'gridview', 'timesheet_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('165', 'Create Timesheet ', 'create_timesheet_(recap)', 'timesheet', 'init_create_timesheet', '', 'form', 'timesheet_ce', '', 'create', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('166', 'Edit Timesheet (Recap)', 'edit_timesheet_(recap)', 'timesheet', 'init_edit_timesheet', 'id', 'form', 'timesheet_ce', '', 'edit', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('167', 'Delete Timesheet (Recap)', 'delete_timesheet_(recap)', 'timesheet', 'delete_timesheet', '', 'no_view', '', '', 'delete', 'crud', null, '1', '0');
INSERT INTO `application_action` VALUES ('168', 'Save/Edit Timesheet (Recap)', 'save_edit_timesheet_(recap)', 'timesheet', 'save_timesheet', '', 'no_view', '', '', 'create', 'crud', null, '1', '0');
INSERT INTO `application_action` VALUES ('169', 'View SO Timesheet', 'view_so_timesheet', 'timesheet', '', '', 'gridview', 'timesheet_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('170', 'Create SO Timesheet', 'create_so_timesheet', 'timesheet', 'init_create_timesheet', '', 'form', 'timesheet_ce', '', 'create', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('171', 'Edit SO Timesheet', 'edit_so_timesheet', 'timesheet', 'init_edit_timesheet', 'id', 'form', 'timesheet_ce', '', 'edit', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('172', 'Delete SO Timesheet', 'delete_so_timesheet', 'timesheet', 'delete_timesheet', '', 'no_view', '', '', 'delete', 'crud', null, '1', '0');
INSERT INTO `application_action` VALUES ('173', 'Save/Edit SO Timesheet', 'save_edit_so_timesheet', 'timesheet', 'save_timesheet', '', 'no_view', '', '', 'create', 'crud', null, '1', '0');
INSERT INTO `application_action` VALUES ('174', 'View Incident Report', 'view_incident_report', 'incident_report', '', '', 'gridview', 'incident_report_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('175', 'Create Incident Report', 'create_incident_report', 'incident_report', 'init_create_incident_report', '', 'form', 'incident_report_ce', '', 'create', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('176', 'Edit Incident Report', 'edit_incident_report', 'incident_report', 'init_edit_incident_report', 'id', 'form', 'incident_report_ce', '', 'edit', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('177', 'Delete Incident Report', 'delete_incident_report', 'incident_report', 'delete_incident_report', '', 'no_view', '', '', 'delete', 'crud', null, '1', '0');
INSERT INTO `application_action` VALUES ('178', 'Save/Edit Incident Report', 'save_edit_incident_report', 'incident_report', 'save_incident_report', '', 'no_view', '', '', 'create', 'crud', null, '1', '0');
INSERT INTO `application_action` VALUES ('179', 'View Payroll', 'view_payroll', 'payroll', '', '', 'gridview', 'payroll_list', '', 'view', 'no_button', null, '0', '0');
INSERT INTO `application_action` VALUES ('180', 'Create Payroll', 'create_payroll', 'payroll', 'init_create_payroll', '', 'form', 'payroll_ce', '', 'create', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('181', 'Edit Payroll', 'edit_payroll', 'payroll', 'init_edit_payroll', 'id', 'form', 'payroll_ce', '', 'edit', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('182', 'Delete Payroll', 'delete_payroll', 'payroll', 'delete_payroll', '', 'no_view', '', '', 'delete', 'crud', null, '1', '0');
INSERT INTO `application_action` VALUES ('183', 'Save/Edit Payroll', 'save_edit_payroll', 'payroll', 'save_payroll', '', 'no_view', '', '', 'create', 'crud', null, '1', '0');
INSERT INTO `application_action` VALUES ('184', 'View Supplier Invoice', 'view_supplier_invoice', 'supplier_invoice', '', '', 'gridview', 'supplier_invoice_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('185', 'Create Supplier Invoice', 'create_supplier_invoice', 'supplier_invoice', 'init_create_supplier_invoice', '', 'form', 'supplier_invoice_ce', '', 'create', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('186', 'Edit Supplier Invoice', 'edit_supplier_invoice', 'supplier_invoice', 'init_edit_supplier_invoice', 'id', 'form', 'supplier_invoice_ce', '', 'edit', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('187', 'Delete Supplier Invoice', 'delete_supplier_invoice', 'supplier_invoice', 'delete_supplier_invoice', '', 'no_view', '', '', 'delete', 'crud', null, '1', '0');
INSERT INTO `application_action` VALUES ('188', 'Save/Edit Supplier Invoice', 'save_edit_supplier_invoice', 'supplier_invoice', 'save_supplier_invoice', '', 'no_view', '', '', 'create', 'crud', null, '1', '0');
INSERT INTO `application_action` VALUES ('189', 'View Customer Invoice', 'view_customer_invoice', 'customer_invoice', '', '', 'gridview', 'customer_invoice_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('190', 'Create Customer Invoice', 'create_customer_invoice', 'customer_invoice', 'init_create_customer_invoice', '', 'form', 'customer_invoice_ce', '', 'create', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('191', 'Edit Customer Invoice', 'edit_customer_invoice', 'customer_invoice', 'init_edit_customer_invoice', 'id', 'form', 'customer_invoice_ce', '', 'edit', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('192', 'Delete Customer Invoice', 'delete_customer_invoice', 'customer_invoice', 'delete_customer_invoice', '', 'no_view', '', '', 'delete', 'crud', null, '1', '0');
INSERT INTO `application_action` VALUES ('193', 'Save/Edit Customer Invoice', 'save_edit_customer_invoice', 'customer_invoice', 'save_customer_invoice', '', 'no_view', '', '', 'create', 'crud', null, '1', '0');
INSERT INTO `application_action` VALUES ('194', 'View Bank Statement', 'view_bank_statement', 'bank_statement', '', '', 'gridview', 'bank_statement_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('195', 'Create Bank Statement', 'create_bank_statement', 'bank_statement', 'init_create_bank_statement', '', 'form', 'bank_statement_ce', '', 'create', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('196', 'Edit Bank Statement', 'edit_bank_statement', 'bank_statement', 'init_edit_bank_statement', 'id', 'form', 'bank_statement_ce', '', 'edit', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('197', 'Delete Bank Statement', 'delete_bank_statement', 'bank_statement', 'delete_bank_statement', '', 'no_view', '', '', 'delete', 'crud', '194', '1', '0');
INSERT INTO `application_action` VALUES ('198', 'Save/Edit Bank Statement', 'save_edit_bank_statement', 'bank_statement', 'save_bank_statement', '', 'no_view', '', '', 'create', 'crud', '194', '1', '0');
INSERT INTO `application_action` VALUES ('199', 'View Cash Register', 'view_cash_register', 'cash_register', '', '', 'gridview', 'cash_register_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('200', 'Create Cash Register', 'create_cash_register', 'cash_register', 'init_create_cash_register', '', 'form', 'cash_register_ce', '', 'create', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('201', 'Edit Cash Register', 'edit_cash_register', 'cash_register', 'init_edit_cash_register', 'id', 'form', 'cash_register_ce', '', 'edit', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('202', 'Delete Cash Register', 'delete_cash_register', 'cash_register', 'delete_cash_register', '', 'no_view', '', '', 'delete', 'crud', '199', '1', '0');
INSERT INTO `application_action` VALUES ('203', 'Save/Edit Cash Register', 'save_edit_cash_register', 'cash_register', 'save_cash_register', '', 'no_view', '', '', 'create', 'crud', '199', '1', '0');
INSERT INTO `application_action` VALUES ('204', 'View Tax', 'view_tax', 'tax', '', '', 'gridview', 'tax_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('205', 'Create Tax', 'create_tax', 'tax', 'init_create_tax', '', 'form', 'tax_ce', '', 'create', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('206', 'Edit Tax', 'edit_tax', 'tax', 'init_edit_tax', 'id', 'form', 'tax_ce', '', 'edit', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('207', 'Delete Tax', 'delete_tax', 'tax', 'delete_tax', '', 'no_view', '', '', 'delete', 'crud', null, '1', '0');
INSERT INTO `application_action` VALUES ('208', 'Save/Edit Tax', 'save_edit_tax', 'tax', 'save_tax', '', 'no_view', '', '', 'create', 'crud', null, '1', '0');
INSERT INTO `application_action` VALUES ('209', 'View Chart of Account', 'view_chart_of_account', 'coa', '', '', 'gridview', 'coa_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('210', 'Create Chart of Account', 'create_chart_of_account', 'coa', 'init_create_coa', '', 'form', 'coa_ce', '', 'create', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('211', 'Edit Chart of Account', 'edit_chart_of_account', 'coa', 'init_edit_coa', 'id', 'form', 'coa_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('212', 'Delete Chart of Account', 'delete_chart_of_account', 'coa', 'delete_coa', '', 'no_view', '', '', 'delete', 'crud', '209', '1', '0');
INSERT INTO `application_action` VALUES ('213', 'Save/Edit Chart of Account', 'save_edit_chart_of_account', 'coa', 'save_coa', '', 'no_view', '', '', 'create', 'crud', '209', '1', '0');
INSERT INTO `application_action` VALUES ('214', 'View Employee Salary', 'view_employee_salary', 'employee_salary', '', '', 'gridview', 'employee_salary_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('215', 'Create Employee Salary', 'create_employee_salary', 'employee_salary', 'init_create_employee_salary', '', 'form', 'employee_salary_ce', '', 'create', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('216', 'Edit Employee Salary', 'edit_employee_salary', 'employee_salary', 'init_edit_employee_salary', 'id', 'form', 'employee_salary_ce', '', 'edit', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('217', 'Delete Employee Salary', 'delete_employee_salary', 'employee_salary', 'delete_employee_salary', '', 'no_view', '', '', 'delete', 'crud', null, '1', '0');
INSERT INTO `application_action` VALUES ('218', 'Save/Edit Employee Salary', 'save_edit_employee_salary', 'employee_salary', 'save_employee_salary', '', 'no_view', '', '', 'create', 'crud', null, '1', '0');
INSERT INTO `application_action` VALUES ('219', 'View Salary Setting', 'view_salary_setting', 'salary_setting', '', '', 'gridview', 'salary_setting_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('220', 'Create Salary Setting', 'create_salary_setting', 'salary_setting', 'init_create_salary_setting', '', 'form', 'salary_setting_ce', '', 'create', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('221', 'Edit Salary Setting', 'edit_salary_setting', 'salary_setting', 'init_edit_salary_setting', 'id', 'form', 'salary_setting_ce', '', 'edit', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('222', 'Delete Salary Setting', 'delete_salary_setting', 'salary_setting', 'delete_salary_setting', '', 'no_view', '', '', 'delete', 'crud', null, '1', '0');
INSERT INTO `application_action` VALUES ('223', 'Save/Edit Salary Setting', 'save_edit_salary_setting', 'salary_setting', 'save_salary_setting', '', 'no_view', '', '', 'create', 'crud', null, '1', '0');
INSERT INTO `application_action` VALUES ('224', 'View Database Interface', 'view_database_interface', 'database_interface', '', '', 'gridview', 'database_interface_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('225', 'Pick Assessment Template', 'pick_assessment_template', 'assessment_template', 'init_pick_assessment_template', '', 'form', 'assessment_template_dialog', '', 'view', 'crud', '115', '0', '0');
INSERT INTO `application_action` VALUES ('226', 'View Organisation Structure', 'view_organisation_structure', 'organisation_structure', '', '', 'gridview', 'organisation_structure_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('227', 'Create Organisation Structure', 'create_organisation_structure', 'organisation_structure', 'init_create_organisation_structure', '', 'form', 'organisation_structure_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('228', 'Edit Organisation Structure', 'edit_organisation_structure', 'organisation_structure', 'init_edit_organisation_structure', 'id', 'form', 'organisation_structure_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('229', 'Delete Organisation Structure', 'delete_organisation_structure', 'organisation_structure', 'delete_organisation_structure', '', 'no_view', '', '', 'delete', 'crud', '226', '1', '0');
INSERT INTO `application_action` VALUES ('230', 'Save/Edit Organisation Structure', 'save_edit_organisation_structure', 'organisation_structure', 'save_organisation_structure', '', 'no_view', '', '', 'create', 'crud', '226', '1', '0');
INSERT INTO `application_action` VALUES ('231', 'View Position Level', 'view_position_level', 'position_level', '', '', 'gridview', 'position_level_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('232', 'Create Position Level', 'create_position_level', 'position_level', 'init_create_position_level', '', 'form', 'position_level_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('233', 'Edit Position Level', 'edit_position_level', 'position_level', 'init_edit_position_level', 'id', 'form', 'position_level_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('234', 'Delete Position Level', 'delete_position_level', 'position_level', 'delete_position_level', '', 'no_view', '', '', 'view', 'crud', '231', '1', '0');
INSERT INTO `application_action` VALUES ('235', 'Save/Edit Position Level', 'save_edit_position_level', 'position_level', 'save_position_level', '', 'no_view', '', '', 'create', 'crud', '231', '1', '0');
INSERT INTO `application_action` VALUES ('236', 'View Employee Contract Type', 'view_employee_contract_type', 'employee_contract_type', '', '', 'gridview', 'employee_contract_type_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('237', 'Create Employee Contract Type', 'create_employee_contract_type', 'employee_contract_type', 'init_create_employee_contract_type', '', 'form', 'employee_contract_type_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('238', 'Edit Employee Contract Type', 'edit_employee_contract_type', 'employee_contract_type', 'init_edit_employee_contract_type', 'id', 'form', 'employee_contract_type_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('239', 'Delete Employee Contract Type', 'delete_employee_contract_type', 'employee_contract_type', 'delete_employee_contract_type', '', 'no_view', '', '', 'delete', 'crud', '236', '1', '0');
INSERT INTO `application_action` VALUES ('240', 'Save/Edit Employee Contract', 'save_edit_employee_contract', 'employee_contract_type', 'save_employee_contract_type', '', 'no_view', '', '', 'create', 'crud', '236', '1', '0');
INSERT INTO `application_action` VALUES ('241', 'View Bank', 'view_bank', 'bank', '', '', 'gridview', 'bank_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('242', 'Create Bank', 'create_bank', 'bank', 'init_create_bank', '', 'form', 'bank_ce', '', 'create', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('243', 'Edit Bank', 'edit_bank', 'bank', 'init_edit_bank', 'id', 'form', 'bank_ce', '', 'edit', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('244', 'Delete Bank', 'delete_bank', 'bank', 'delete_bank', '', 'no_view', '', '', 'delete', 'crud', '241', '1', '0');
INSERT INTO `application_action` VALUES ('245', 'Save/Edit Bank', 'save_edit_bank', 'bank', 'save_bank', '', 'no_view', '', '', 'create', 'crud', '241', '1', '0');
INSERT INTO `application_action` VALUES ('246', 'View Payment Receipt', 'view_payment_receipt', 'payment_receipt', '', '', 'gridview', 'payment_receipt_list', null, 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('247', 'Create Payment Receipt', 'create_payment_receipt', 'payment_receipt', 'init_create_payment_receipt', '', 'form', 'payment_receipt_ce', null, 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('248', 'Edit Payment Receipt', 'edit_payment_receipt', 'payment_receipt', 'init_edit_payment_receipt', 'id', 'form', 'payment_receipt_ce', null, 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('249', 'Save/Edit Payment Receipt', 'save_edit_payment_receipt', 'payment_receipt', 'save_payment_receipt', '', 'no_view', '', '', 'create', 'crud', '246', '1', '0');
INSERT INTO `application_action` VALUES ('250', 'Delete Payment Receipt', 'delete_payment_receipt', 'payment_receipt', 'delete_payment_receipt', '', 'no_view', '', '', 'delete', 'crud', '246', '1', '0');
INSERT INTO `application_action` VALUES ('251', 'Receive Payment From PO', 'receive_payment_from_po', 'payment_receipt', 'receive_payment_from_po', 'id', 'no_view', '', null, 'create', 'crud', '102', '1', '0');
INSERT INTO `application_action` VALUES ('252', 'Make Payment Receipt', 'make_payment_receipt', 'payment_receipt', 'make_payment_receipt', 'id', 'no_view', '', '', 'create', 'crud', '248', '1', '0');
INSERT INTO `application_action` VALUES ('253', 'Cancel Payment Receipt', 'cancel_payment_receipt', 'payment_receipt', 'cancel_payment_receipt', '', 'no_view', '', '', 'update', 'crud', '246', '1', '0');
INSERT INTO `application_action` VALUES ('254', 'View Stock Transaction', 'view_stock_transaction', 'stock_transaction', '', '', 'gridview', 'stock_transaction_list', null, 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('255', 'Create Stock Transaction', 'create_stock_transaction', 'stock_transaction', 'init_create_stock_transaction', '', 'form', 'stock_transaction_ce', null, 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('256', 'Edit Stock Transaction', 'edit_stock_transaction', 'stock_transaction', 'init_edit_stock_transaction', 'id', 'form', 'stock_transaction_ce', null, 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('257', 'Delete Stock Transaction', 'delete_stock_transaction', 'stock_transaction', 'delete_stock_transaction', '', 'no_view', '', null, 'delete', 'crud', '119', '1', '0');
INSERT INTO `application_action` VALUES ('258', 'Save/Edit Stock Transaction', 'save_edit_stock_transaction', 'stock_transaction', 'save_stock_transaction', '', 'no_view', '', '', 'create', 'crud', '254', '1', '0');
INSERT INTO `application_action` VALUES ('259', 'Post Stock Transaction', 'post_stock_transaction', 'stock_transaction', 'post_stock_transaction', 'id', 'no_view', '', '', 'update', 'crud', '254', '1', '0');
INSERT INTO `application_action` VALUES ('260', 'Unpost Stock Transaction', 'unpost_stock_transaction', 'stock_transaction', 'unpost_stock_transaction', 'id', 'no_view', '', '', 'update', 'crud', '254', '1', '0');
INSERT INTO `application_action` VALUES ('261', 'Transfer Good Receive', 'transfer_good_receive', 'gr', 'transfer_gr', 'id', 'no_view', '', null, 'update', 'crud', '69', '1', '0');
INSERT INTO `application_action` VALUES ('262', 'View Activity', 'view_activity', 'announcement', 'init_view_announcement', '', 'no_view', 'announcement_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('263', 'Make Working Schedule', 'make_working_schedule', 'quotation', 'make_working_schedule', '', 'no_view', '', '', 'create', 'crud', '145', '1', '0');
INSERT INTO `application_action` VALUES ('264', 'Validate Inquiry', 'validate_inquiry', 'inquiry', 'validate_inquiry', 'id', 'no_view', '', '', 'update', 'crud', '111', '1', '0');
INSERT INTO `application_action` VALUES ('265', 'Validate Quotation', 'validate_quotation', 'quotation', 'validate_quotation', 'id', 'no_view', '', '', 'update', 'crud', '121', '1', '0');
INSERT INTO `application_action` VALUES ('266', 'Validate Sales Order', 'validate_sales_order', 'so', 'validate_so', 'id', 'no_view', '', '', 'update', 'crud', '74', '1', '0');
INSERT INTO `application_action` VALUES ('267', 'Confirm Sales Order', 'confirm_sales_order', 'so', 'confirm_so', 'id', 'no_view', '', '', 'update', 'crud', '131', '1', '0');
INSERT INTO `application_action` VALUES ('268', 'View Fingerprint Device', 'view_fingerprint_device', 'fingerprint', '', '', 'gridview', 'fingerprint_device_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('269', 'Create Fingerprint Device', 'create_fingerprint_device', 'fingerprint', 'init_create_fingerprint_device', '', 'form', 'fingerprint_device_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('270', 'Edit Fingerprint Device', 'edit_fingerprint_device', 'fingerprint', 'init_edit_fingerprint_device', 'id', 'form', 'fingerprint_device_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('271', 'Delete Fingerprint Device', 'delete_fingerprint_device', 'fingerprint', 'delete_fingerprint_device', '', 'no_view', '', '', 'delete', 'no_button', '268', '1', '0');
INSERT INTO `application_action` VALUES ('272', 'Save/Edit Fingerprint Device', 'save_edit_fingerprint_device', 'fingerprint', 'save_fingerprint_device', '', 'no_view', '', '', 'create', 'no_button', '268', '1', '0');
INSERT INTO `application_action` VALUES ('273', 'Activate Fingerprint', 'activate_fingerprint', 'fingerprint', 'activate_fingerprint', 'id', 'no_view', '', '', 'update', 'no_button', '270', '1', '0');
INSERT INTO `application_action` VALUES ('274', 'Deactivate Fingerprint', 'deactivate_fingerprint', 'fingerprint', 'deactivate_fingerprint', 'id', 'no_view', '', '', 'update', 'no_button', '270', '1', '0');
INSERT INTO `application_action` VALUES ('275', 'View Fingerprint Assign', 'view_fingerprint_assign', 'fingerprint_assign', '', '', 'gridview', 'fingerprint_assign_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('276', 'Create Fingerprint Assign', 'create_fingerprint_assign', 'fingerprint_assign', 'init_create_fingerprint_assign', '', 'form', 'fingerprint_assign_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('277', 'Edit Fingerprint Assign', 'edit_fingerprint_assign', 'fingerprint_assign', 'init_edit_fingerprint_assign', 'id', 'form', 'fingerprint_assign_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('278', 'Delete Fingerprint Assign', 'delete_fingerprint_assign', 'fingerprint_assign', 'delete_fingerprint_assign', '', 'no_view', '', '', 'delete', 'no_button', '275', '1', '0');
INSERT INTO `application_action` VALUES ('279', 'Save/Edit Fingerprint Assign', 'save_edit_fingerprint_assign', 'fingerprint_assign', 'save_fingerprint_assign', '', 'no_view', '', '', 'create', 'no_button', '275', '1', '0');
INSERT INTO `application_action` VALUES ('280', 'Make SO Assignment', '', 'work_order', 'make_so_assignment', '', 'no_view', '', '', 'create', 'crud', '150', '1', '0');
INSERT INTO `application_action` VALUES ('281', 'Assign Fingerprint Device', 'assign_fingerprint_device', 'fingerprint_assign', 'assign_fingerprint', 'id', 'no_view', '', '', 'view', 'no_button', '277', '1', '0');
INSERT INTO `application_action` VALUES ('282', 'Unassign Fingerprint', 'unassign_fingerprint', 'fingerprint_assign', 'unassign_fingerprint', 'id', 'no_view', '', '', 'view', 'no_button', '277', '1', '0');
INSERT INTO `application_action` VALUES ('283', 'Fingerprint Enroll', 'fingerprint_enroll', 'fingerprint', 'init_fingerprint_enroll', '', 'form', 'fingerprint_enroll_ce', '', 'create', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('284', 'Save Fingerprint Enroll', 'save_fingerprint_enroll', 'fingerprint', 'save_fingerprint_enroll', '', 'no_view', '', '', 'create', 'no_button', '282', '1', '0');
INSERT INTO `application_action` VALUES ('292', 'View BOM', 'view_bom', 'bom', '', null, 'gridview', 'bom_list', null, 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('293', 'Create BOM', 'create_bom', 'bom', 'init_create_bom', null, 'form', 'bom_ce', null, 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('294', 'Edit BOM', 'edit_bom', 'bom', 'init_edit_bom', 'id', 'form', 'bom_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('295', 'Delete BOM', 'delete_bom', 'bom', 'delete_bom', null, 'no_view', '', null, 'delete', 'no_button', '292', '1', '0');
INSERT INTO `application_action` VALUES ('296', 'Save/Edit BOM', 'save_edit_bom', 'bom', 'save_bom', '', 'no_view', '', '', 'create', 'no_button', '292', '1', '0');
INSERT INTO `application_action` VALUES ('297', 'Validate BOM', 'validate_bom', 'bom', 'validate_bom', 'id', 'no_view', '', '', 'update', 'no_button', '294', '1', '0');
INSERT INTO `application_action` VALUES ('298', 'View Join item', 'view_join_item', 'join_item', '', '', 'gridview', 'join_item_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('299', 'Create Join Item', 'create_join_item', 'join_item', 'init_create_join_item', '', 'form', 'join_item_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('300', 'Edit Join Item', 'edit_join_item', 'join_item', 'init_edit_join_item', 'id', 'form', 'join_item_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('301', 'Delete Join Item', 'delete_join_item', 'join_item', 'delete_join_item', '', 'no_view', '', '', 'delete', 'no_button', '298', '1', '0');
INSERT INTO `application_action` VALUES ('302', 'Save/Edit Joint Item', 'save_edit_joint_item', 'join_item', 'save_join_item', '', 'no_view', '', '', 'create', 'no_button', '298', '1', '0');
INSERT INTO `application_action` VALUES ('303', 'Transfer Join Item', 'transfer_join_item', 'join_item', 'transfer_join_item', 'id', 'no_view', '', '', 'update', 'no_button', '300', '1', '0');
INSERT INTO `application_action` VALUES ('304', 'View Group', 'view_group', 'group', '', '', 'gridview', 'group_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('305', 'Create Group', 'create_group', 'group', 'init_create_group', '', 'form', 'group_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('306', 'Edit Group', 'edit_group', 'group', 'init_edit_group', 'id', 'form', 'group_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('307', 'Delete Group', 'delete_group', 'group', 'delete_group', '', 'no_view', '', '', 'delete', 'no_button', '304', '1', '0');
INSERT INTO `application_action` VALUES ('308', 'Save/Edit Group', 'save_edit_group', 'group', 'save_group', '', 'no_view', '', '', 'create', 'no_button', '304', '1', '0');
INSERT INTO `application_action` VALUES ('309', 'View Configuration Parameter', 'view_configuration_parameter', 'app_config', '', '', 'gridview', 'app_config_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('310', 'Create Configuration Parameter', 'create_configuration_parameter', 'app_config', 'init_create_app_config', '', 'form', 'app_config_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('311', 'Edit Configuration Parameter', 'edit_configuration_parameter', 'app_config', 'init_edit_app_config', 'id', 'form', 'app_config_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('312', 'Delete Configuration Parameter', 'delete_configuration_parameter', 'app_config', 'delete_app_config', '', 'no_view', '', '', 'delete', 'no_button', '309', '1', '0');
INSERT INTO `application_action` VALUES ('313', 'Save/Edit Configuration Parameter', 'save_edit_configuration_parameter', 'app_config', 'save_app_config', '', 'no_view', '', '', 'create', 'no_button', '309', '0', '0');
INSERT INTO `application_action` VALUES ('314', 'VIew Notification Setting', 'view_notification_setting', 'notification_setting', '', '', 'gridview', 'notification_setting_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('315', 'Create Notification Setting', 'create_notification_setting', 'notification_setting', 'init_create_notification_setting', '', 'form', 'notification_setting_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('316', 'Edit Notification Setting', 'edit_notification_setting', 'notification_setting', 'init_edit_notification_setting', 'id', 'form', 'notification_setting_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('317', 'Delete Notification Setting', 'delete_notification_setting', 'notification_setting', 'delete_notification_setting', '', 'no_view', '', '', 'delete', 'no_button', '314', '1', '0');
INSERT INTO `application_action` VALUES ('318', 'Save/Edit Notification Setting', 'save_edit_notification_setting', 'notification_setting', 'save_notification_setting', '', 'no_view', '', '', 'create', 'no_button', '314', '1', '0');
INSERT INTO `application_action` VALUES ('319', 'View Product Definition', 'view_product_definition', 'product_definition', '', '', 'gridview', 'product_definition_list', '', 'create', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('320', 'Create Product Definition', 'create_product_definition', 'product_definition', 'init_create_product_definition', '', 'form', 'product_definition_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('321', 'Edit Product Definition', 'edit_product_definition', 'product_definition', 'init_edit_product_definition', 'id', 'form', 'product_definition_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('322', 'Delete Product Definition', 'delete_product_definition', 'product_definition', '', '', 'no_view', '', '', 'delete', 'no_button', '319', '1', '0');
INSERT INTO `application_action` VALUES ('323', 'Save/Edit Product Definition', 'save_edit_product_definition', 'product_definition', 'save_product_definition', '', 'no_view', '', '', 'create', 'no_button', '319', '1', '0');
INSERT INTO `application_action` VALUES ('342', 'View Log Error', 'view_log_error', 'log_error', '', '', 'gridview', 'log_error_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('343', 'Create Log Error', 'create_log_error', 'log_error', '', '', 'form', 'log_error_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('344', 'Save / Edit Log Error', 'save_edit_log_error', 'log_error', 'save_log_error', '', 'no_view', '', '', 'create', 'save_discard', '281', '0', '0');
INSERT INTO `application_action` VALUES ('345', 'Edit Log  Error', 'edit_log_error', 'log_error', 'init_edit_log_error', 'id', 'form', 'log_error_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('346', 'Delete Log Error', 'delete_log_error', 'log_error', 'delete_log_error', '', 'no_view', '', '', 'delete', 'no_button', '281', '0', '0');
INSERT INTO `application_action` VALUES ('347', 'Copy Record', 'copy_application_action', 'action', 'copy_application_action', '', 'no_view', '', '', 'create', 'no_button', '1', '0', '0');
INSERT INTO `application_action` VALUES ('348', 'View Salary Type', 'view_salary_type', 'salary_type', '', '', 'gridview', 'salary_type_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('349', 'Create Salary Type', 'create_salary_type', 'salary_type', '', '', 'form', 'salary_type_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('350', 'Save / Edit Salary Type', 'save_edit_salary_type', 'salary_type', 'save_salary_type', '', 'no_view', '', '', 'create', 'save_discard', '354', '0', '0');
INSERT INTO `application_action` VALUES ('351', 'Edit Salary Type', 'edit_salary_type', 'salary_type', 'init_edit_salary_type', 'id', 'form', 'salary_type_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('352', 'Create Timesheet', 'create_timesheet', 'timesheet', 'init_create_timesheet', '', 'form', 'timesheet_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('353', 'View Salary Type', 'view_salary_type', 'salary_type', '', '', 'gridview', 'salary_type_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('354', 'View Salary Type', 'view_salary_type', 'salary_type', '', '', 'gridview', 'salary_type_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('355', 'Save / Edit Timesheet ', 'save_edit_timesheet', 'timesheet', 'save_timesheet', '', 'no_view', '', '', 'create', 'save_discard', '164', '0', '0');
INSERT INTO `application_action` VALUES ('356', 'View Payroll Periode', 'view_payroll_periode', 'payroll_periode', '', '', 'gridview', 'payroll_periode_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('357', 'Create Payroll Periode', 'create_payroll_periode', 'payroll_periode', '', '', 'form', 'payroll_periode_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('358', 'Save / Edit Log Error', 'save_edit_payroll_periode', 'payroll_periode', 'save_payroll_periode', '', 'no_view', '', '', 'create', 'save_discard', '297', '0', '0');
INSERT INTO `application_action` VALUES ('359', 'Edit Payroll Periode', 'edit_payroll_periode', 'payroll_periode', 'init_edit_payroll_periode', 'id', 'form', 'payroll_periode_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('360', 'Delete Payroll Periode', 'delete_payroll_periode', 'payroll_periode', 'delete_payroll_periode', '', 'no_view', '', '', 'delete', 'no_button', '297', '0', '0');
INSERT INTO `application_action` VALUES ('361', 'View Request Overtime', 'view_overtime', 'overtime', '', '', 'gridview', 'overtime_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('362', 'Create Request Overtime', 'create_overtime', 'overtime', '', '', 'form', 'overtime_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('363', 'Save / Edit Overtime', 'save_edit_overtime', 'overtime', 'save_overtime', '', 'no_view', '', '', 'create', 'save_discard', '302', '0', '0');
INSERT INTO `application_action` VALUES ('364', 'Edit Overtime', 'edit_overtime', 'overtime', 'init_edit_overtime', 'id', 'form', 'overtime_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('365', 'Delete Overtime', 'delete_overtime', 'overtime', 'delete_overtime', '', 'no_view', '', '', 'delete', 'no_button', '302', '0', '0');
INSERT INTO `application_action` VALUES ('366', 'Validate Overtime', 'validate_overtime', 'overtime', 'validate_overtime', 'id', 'no_view', '', '', 'update', 'crud', '302', '1', '0');
INSERT INTO `application_action` VALUES ('367', 'View Insentive', 'insentive', 'insentive', '', '', 'gridview', 'insentive_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('368', 'View Monitoring Timesheet ', 'view_monitoring_timesheet', 'monitoring_timesheet', '', '', 'gridview', 'monitoring_timesheet_list', '', 'view', 'no_button', null, '0', '0');
INSERT INTO `application_action` VALUES ('369', 'Create Insentive', 'create_insentive', 'insentive', 'init_create_intensive', '', 'form', 'insentive_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('370', 'Save / Edit Insentive', 'save_edit_insentive', 'insentive', 'save_insentive', '', 'no_view', '', '', 'create', 'save_discard', '308', '0', '0');
INSERT INTO `application_action` VALUES ('371', 'Edit Overtime', 'edit_overtime', 'overtime', 'init_edit_overtime', 'id', 'form', 'overtime_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('372', 'Delete Insentive', 'delete_insentive', 'insentive', 'delete_insentive', '', 'no_view', '', '', 'delete', 'no_button', '308', '0', '0');
INSERT INTO `application_action` VALUES ('373', 'Validate Work Order', 'validate_work_order', 'work_order', 'validate_work_order', 'id', 'no_view', '', '', 'update', 'no_button', '129', '0', '0');
INSERT INTO `application_action` VALUES ('374', 'Edit Timesheet', 'edit_timesheet', 'timesheet', 'init_edit_timesheet', 'id', 'form', 'timesheet_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('375', 'View Recruitment', 'view_recruitment', 'recruitment', '', '', 'gridview', 'recruitment_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('376', 'Create Recruitment', 'create_recruitment', 'recruitment', 'init_create_recruitment', '', 'form', 'recruitment_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('377', 'Save/Edit Recruitment', 'save_edit_recruitment', 'recruitment', 'save_recruitment', '', 'no_view', '', '', 'create', 'save_discard', '375', '0', '0');
INSERT INTO `application_action` VALUES ('378', 'Delete Recruitment', 'delete_recruitment', 'recruitment', 'delete_recruitment', '', 'no_view', '', '', 'view', 'crud', '375', '0', '0');
INSERT INTO `application_action` VALUES ('379', 'Edit Recruitment', 'edit_recruitment', 'recruitment', 'init_edit_recruitment', 'id', 'form', 'recruitment_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('380', 'View Request Overtime', 'view_overtime', 'overtime', '', '', 'gridview', 'overtime_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('381', 'Create Request Overtime', 'create_overtime', 'overtime', 'init_create_overtime', '', 'form', 'overtime_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('382', 'Save/Edit Overtime', 'save_edit_overtime', 'overtime', 'save_overtime', '', 'no_view', '', '', 'create', 'save_discard', '380', '0', '0');
INSERT INTO `application_action` VALUES ('383', 'Delete Overtime', 'delete_overtime', 'overtime', 'delete_overtime', '', 'no_view', '', '', 'view', 'crud', '380', '0', '0');
INSERT INTO `application_action` VALUES ('384', 'Edit Overtime', 'edit_overtime', 'overtime', 'init_edit_overtime', 'id', 'form', 'overtime_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('385', 'Validate Overtime', 'validate_overtime', 'overtime', 'validate_overtime', 'id', 'no_view', '', '', 'update', 'no_button', '380', '0', '0');
INSERT INTO `application_action` VALUES ('386', 'View Insentive', 'view_insentive', 'insentive', '', '', 'gridview', 'insentive_list', '', 'view', 'crud', null, '0', '0');
INSERT INTO `application_action` VALUES ('387', 'Create Request Insentive', 'create_insentive', 'insentive', 'init_create_insentive', '', 'form', 'insentive_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('388', 'Save/Edit Insentive', 'save_edit_insentive', 'insentive', 'save_insentive', '', 'no_view', '', '', 'create', 'save_discard', '386', '0', '0');
INSERT INTO `application_action` VALUES ('389', 'Delete Insentive', 'delete_insentive', 'insentive', 'delete_insentive', '', 'no_view', '', '', 'view', 'crud', '386', '0', '0');
INSERT INTO `application_action` VALUES ('390', 'Edit Insentive', 'edit_insentive', 'insentive', 'init_edit_insentive', 'id', 'form', 'insentive_ce', '', 'view', 'save_discard', null, '0', '0');
INSERT INTO `application_action` VALUES ('391', 'Delete Salary Type', 'delete_salary_type', 'salary_type', 'delete_salary_type', '', 'no_view', '', '', 'delete', 'crud', '354', '1', '0');
INSERT INTO `application_action` VALUES ('392', 'Save/Edit Payroll Periode', 'save_edit_payroll_periode', 'payroll_periode', 'save_payroll_periode', '', 'no_view', '', '', 'create', 'save_discard', '356', '0', '0');
INSERT INTO `application_action` VALUES ('393', 'View Detail Payroll', 'view_detail_payroll', 'payroll_periode', 'init_view', '', 'gridview', 'detail_payroll_periode_list', '', 'view', 'no_button', null, '0', '0');

-- ----------------------------
-- Table structure for `application_action_conditioner`
-- ----------------------------
DROP TABLE IF EXISTS `application_action_conditioner`;
CREATE TABLE `application_action_conditioner` (
  `id_application_action_conditioner` int(11) NOT NULL AUTO_INCREMENT,
  `identifier` varchar(45) NOT NULL,
  `target_action` int(11) NOT NULL,
  `action` int(11) NOT NULL,
  PRIMARY KEY (`id_application_action_conditioner`),
  KEY `fk_application_action_conditioner_application_action1_idx` (`target_action`),
  KEY `fk_application_action_conditioner_application_action2_idx` (`action`),
  CONSTRAINT `fk_application_action_conditioner_application_action1` FOREIGN KEY (`target_action`) REFERENCES `application_action` (`id_application_action`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_application_action_conditioner_application_action2` FOREIGN KEY (`action`) REFERENCES `application_action` (`id_application_action`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of application_action_conditioner
-- ----------------------------
INSERT INTO `application_action_conditioner` VALUES ('1', 'validate', '99', '61');
INSERT INTO `application_action_conditioner` VALUES ('2', 'from_po', '69', '71');
INSERT INTO `application_action_conditioner` VALUES ('3', 'make_payment', '252', '249');
INSERT INTO `application_action_conditioner` VALUES ('4', 'validate', '264', '113');
INSERT INTO `application_action_conditioner` VALUES ('5', 'validate', '265', '123');
INSERT INTO `application_action_conditioner` VALUES ('6', 'validate', '266', '76');
INSERT INTO `application_action_conditioner` VALUES ('7', 'assign_fingerprint', '281', '279');

-- ----------------------------
-- Table structure for `application_config`
-- ----------------------------
DROP TABLE IF EXISTS `application_config`;
CREATE TABLE `application_config` (
  `id_config` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `data_type` varchar(10) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id_config`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of application_config
-- ----------------------------
INSERT INTO `application_config` VALUES ('1', 'incoming_mail_server', 'string', 'iix21.rumahweb.com');
INSERT INTO `application_config` VALUES ('2', 'outgoing_mail_server', 'string', 'iix21.rumahweb.com');
INSERT INTO `application_config` VALUES ('3', 'application_email', 'string', 'bazcorp@wahanausaha.co.id');
INSERT INTO `application_config` VALUES ('5', 'application_email_password', 'password', 'bazcorp12');
INSERT INTO `application_config` VALUES ('6', 'incoming_mail_server_port', 'string', '995');
INSERT INTO `application_config` VALUES ('7', 'outgoing_mail_server_port', 'string', '465');
INSERT INTO `application_config` VALUES ('8', 'incoming_mail_server_encrypt', 'string', 'ssl');
INSERT INTO `application_config` VALUES ('9', 'outgoing_mail_server_encrypt', 'string', 'ssl');
INSERT INTO `application_config` VALUES ('10', 'application_email_name', 'string', 'Bazsystem');
INSERT INTO `application_config` VALUES ('11', 'company_name', 'string', 'P.T Bazcorp Citra Indonesia');
INSERT INTO `application_config` VALUES ('12', 'company_address', 'string', 'Jl.Rawa Buntu Serpong No.1 BSD City, Tangerang 15322, Indonesia');
INSERT INTO `application_config` VALUES ('13', 'default_email_notification_header', 'string', 'This email send by system on behalf of ');
INSERT INTO `application_config` VALUES ('14', 'default_email_subject', 'string', 'Auto Notification - ');
INSERT INTO `application_config` VALUES ('15', 'report_temp_directory_path', 'string', '/var/www/bazcorp/images/upload/');
INSERT INTO `application_config` VALUES ('16', 'wkhtmltopdf_bin_path', 'string', '/usr/bin/wkhtmltopdf.sh');
INSERT INTO `application_config` VALUES ('17', 'temp_file_path', 'string', '../images/upload/');

-- ----------------------------
-- Table structure for `application_side_menu`
-- ----------------------------
DROP TABLE IF EXISTS `application_side_menu`;
CREATE TABLE `application_side_menu` (
  `id_application_menu` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `type` varchar(15) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `division` int(11) DEFAULT NULL,
  `index` int(11) NOT NULL,
  `controller` varchar(45) DEFAULT NULL,
  `action` int(11) DEFAULT NULL,
  `default_menu` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_application_menu`),
  KEY `fk_application_side_menu_application_side_menu1_idx` (`parent`),
  KEY `fk_application_side_menu_division1_idx` (`division`),
  KEY `fk_application_side_menu_application_action1_idx` (`action`),
  KEY `fk_application_side_menu_application_side_menu2_idx` (`default_menu`),
  CONSTRAINT `fk_application_side_menu_application_action1` FOREIGN KEY (`action`) REFERENCES `application_action` (`id_application_action`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_application_side_menu_application_side_menu1` FOREIGN KEY (`parent`) REFERENCES `application_side_menu` (`id_application_menu`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_application_side_menu_application_side_menu2` FOREIGN KEY (`default_menu`) REFERENCES `application_side_menu` (`id_application_menu`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_application_side_menu_division1` FOREIGN KEY (`division`) REFERENCES `division` (`id_division`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=168 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of application_side_menu
-- ----------------------------
INSERT INTO `application_side_menu` VALUES ('5', 'Technical Features', 'group', '76', null, '2', null, null, null);
INSERT INTO `application_side_menu` VALUES ('6', 'Side Menu', 'child', '5', null, '1', null, '5', null);
INSERT INTO `application_side_menu` VALUES ('52', 'Application Action', 'child', '5', '9', '2', null, '1', null);
INSERT INTO `application_side_menu` VALUES ('58', 'Division', 'child', '5', '9', '3', null, '11', null);
INSERT INTO `application_side_menu` VALUES ('59', 'Document', 'group', '78', null, '1', null, null, null);
INSERT INTO `application_side_menu` VALUES ('60', 'Purchase Order', 'child', '59', '5', '1', null, '57', null);
INSERT INTO `application_side_menu` VALUES ('63', 'Master Data', 'group', '78', null, '2', null, null, null);
INSERT INTO `application_side_menu` VALUES ('64', 'Product', 'child', '63', '5', '1', null, '21', null);
INSERT INTO `application_side_menu` VALUES ('65', 'Product Category', 'child', '63', null, '2', null, '31', null);
INSERT INTO `application_side_menu` VALUES ('66', 'Role', 'child', '5', '9', '4', null, '16', null);
INSERT INTO `application_side_menu` VALUES ('67', 'Configuration Parameter', 'child', '5', '9', '5', null, null, null);
INSERT INTO `application_side_menu` VALUES ('68', 'Supplier', 'child', '63', '5', '3', null, '26', null);
INSERT INTO `application_side_menu` VALUES ('76', 'Settings', 'top-menu', null, null, '8', 'administrator', null, null);
INSERT INTO `application_side_menu` VALUES ('77', 'Dashboard', 'top-menu', null, null, '1', 'dashboard', null, null);
INSERT INTO `application_side_menu` VALUES ('78', 'GA', 'top-menu', null, null, '6', 'ga', null, null);
INSERT INTO `application_side_menu` VALUES ('79', 'Warehouse', 'top-menu', null, null, '7', 'warehouse', null, null);
INSERT INTO `application_side_menu` VALUES ('80', 'HR', 'top-menu', null, null, '4', 'hr', null, null);
INSERT INTO `application_side_menu` VALUES ('81', 'Finance', 'top-menu', null, null, '5', 'finance', null, null);
INSERT INTO `application_side_menu` VALUES ('82', 'Bus Dev', 'top-menu', null, null, '2', 'sales', null, null);
INSERT INTO `application_side_menu` VALUES ('83', 'Document', 'group', '79', null, '1', null, null, null);
INSERT INTO `application_side_menu` VALUES ('84', 'Master', 'group', '79', null, '3', null, null, null);
INSERT INTO `application_side_menu` VALUES ('85', 'Good Receive', 'child', '83', null, '1', null, '67', null);
INSERT INTO `application_side_menu` VALUES ('86', 'Material Request', 'child', '83', null, '2', null, '77', null);
INSERT INTO `application_side_menu` VALUES ('87', 'Delivery Notes', 'child', '83', null, '3', null, '83', null);
INSERT INTO `application_side_menu` VALUES ('88', 'Process', 'group', '79', null, '2', null, null, null);
INSERT INTO `application_side_menu` VALUES ('89', 'Stock Adjusment', 'child', '88', null, '1', null, null, null);
INSERT INTO `application_side_menu` VALUES ('90', 'Stock Opname', 'child', '88', null, '2', null, null, null);
INSERT INTO `application_side_menu` VALUES ('91', 'Warehouse', 'child', '84', null, '1', null, '47', null);
INSERT INTO `application_side_menu` VALUES ('92', 'View Stock', 'child', '84', null, '2', null, '93', null);
INSERT INTO `application_side_menu` VALUES ('93', 'Document', 'group', '81', null, '1', null, null, null);
INSERT INTO `application_side_menu` VALUES ('94', 'Invoice', 'child', '93', null, '1', null, '189', null);
INSERT INTO `application_side_menu` VALUES ('95', 'Payment Receipt', 'child', '93', null, '2', null, null, null);
INSERT INTO `application_side_menu` VALUES ('96', 'Purchase Order ', 'child', '93', null, '3', null, '57', null);
INSERT INTO `application_side_menu` VALUES ('97', 'Sales Order', 'child', '93', null, '4', null, '72', null);
INSERT INTO `application_side_menu` VALUES ('102', 'Document', 'group', '82', null, '1', null, null, null);
INSERT INTO `application_side_menu` VALUES ('103', 'Master', 'group', '82', null, '2', null, null, null);
INSERT INTO `application_side_menu` VALUES ('104', 'Quotation', 'child', '102', null, '3', null, '119', null);
INSERT INTO `application_side_menu` VALUES ('106', 'Customer', 'child', '103', null, '1', null, '41', null);
INSERT INTO `application_side_menu` VALUES ('107', 'Merk', 'child', '63', null, '4', null, '36', null);
INSERT INTO `application_side_menu` VALUES ('108', 'General', 'group', '76', null, '1', null, null, null);
INSERT INTO `application_side_menu` VALUES ('109', 'Users', 'child', '108', null, '1', null, '62', null);
INSERT INTO `application_side_menu` VALUES ('110', 'Unit Measure', 'child', '108', null, '2', null, '88', null);
INSERT INTO `application_side_menu` VALUES ('112', 'OPS', 'top-menu', null, null, '3', 'ops', null, null);
INSERT INTO `application_side_menu` VALUES ('113', 'Sales Order', 'child', '102', null, '4', null, '72', null);
INSERT INTO `application_side_menu` VALUES ('114', 'Work Order', 'child', '102', null, '5', null, '129', null);
INSERT INTO `application_side_menu` VALUES ('115', 'Document', 'group', '80', null, '1', null, null, null);
INSERT INTO `application_side_menu` VALUES ('116', 'Master', 'group', '80', null, '3', null, null, null);
INSERT INTO `application_side_menu` VALUES ('117', 'Document', 'group', '112', null, '1', null, null, null);
INSERT INTO `application_side_menu` VALUES ('118', 'Work Order', 'child', '117', null, '1', null, '129', null);
INSERT INTO `application_side_menu` VALUES ('119', 'Assessment Template', 'child', '103', null, '2', null, '72', null);
INSERT INTO `application_side_menu` VALUES ('120', 'Project Schedule', 'child', '117', null, '2', null, '144', null);
INSERT INTO `application_side_menu` VALUES ('122', 'SO Assignment', 'child', '117', null, '3', null, '149', null);
INSERT INTO `application_side_menu` VALUES ('123', 'Shift Change', 'child', '117', null, '4', null, '154', null);
INSERT INTO `application_side_menu` VALUES ('124', 'Leave Application', 'child', '117', null, '5', null, '159', null);
INSERT INTO `application_side_menu` VALUES ('125', 'Master', 'group', '112', null, '2', null, null, null);
INSERT INTO `application_side_menu` VALUES ('126', 'SO Database', 'child', '125', null, '1', null, '72', null);
INSERT INTO `application_side_menu` VALUES ('127', 'Employee Database', 'child', '116', null, '1', null, '94', null);
INSERT INTO `application_side_menu` VALUES ('128', 'Database Interface', 'child', '5', null, '6', null, '224', null);
INSERT INTO `application_side_menu` VALUES ('129', 'Database Field Interface', 'child', '5', null, '7', null, '104', null);
INSERT INTO `application_side_menu` VALUES ('130', 'Timesheet', 'child', '133', null, '2', null, '164', null);
INSERT INTO `application_side_menu` VALUES ('131', 'Payroll', 'child', '115', null, '2', null, '179', null);
INSERT INTO `application_side_menu` VALUES ('132', 'Recruitment', 'child', '133', null, '1', null, '375', null);
INSERT INTO `application_side_menu` VALUES ('133', 'Process', 'group', '80', null, '2', null, null, null);
INSERT INTO `application_side_menu` VALUES ('134', 'Inquiry', 'child', '102', null, '1', null, '109', null);
INSERT INTO `application_side_menu` VALUES ('135', 'Organisation Structure', 'child', '116', null, '2', null, '226', null);
INSERT INTO `application_side_menu` VALUES ('136', 'Position Level', 'child', '116', null, '3', null, '231', null);
INSERT INTO `application_side_menu` VALUES ('137', 'Empoyee Contract Type', 'child', '116', null, '4', null, '236', null);
INSERT INTO `application_side_menu` VALUES ('139', 'Cash Register', 'child', '93', null, '5', null, '199', null);
INSERT INTO `application_side_menu` VALUES ('140', 'Bank Statement', 'child', '93', null, '6', null, '194', null);
INSERT INTO `application_side_menu` VALUES ('141', 'Master', 'group', '81', null, '2', null, null, null);
INSERT INTO `application_side_menu` VALUES ('142', 'Chart of Account', 'child', '141', null, '1', null, '209', null);
INSERT INTO `application_side_menu` VALUES ('148', 'Bank', 'child', '141', null, '2', null, '241', null);
INSERT INTO `application_side_menu` VALUES ('149', 'Purchase Payment', 'child', '93', null, '7', null, '246', null);
INSERT INTO `application_side_menu` VALUES ('150', 'Stock Transaction', 'child', '88', null, '3', null, '254', null);
INSERT INTO `application_side_menu` VALUES ('151', 'General', 'group', '77', null, '1', null, null, null);
INSERT INTO `application_side_menu` VALUES ('152', 'Activity', 'child', '151', null, '1', null, '262', null);
INSERT INTO `application_side_menu` VALUES ('153', 'Notification', 'child', '151', null, '2', null, '262', null);
INSERT INTO `application_side_menu` VALUES ('154', 'Work Order', 'child', '115', null, '0', null, '129', null);
INSERT INTO `application_side_menu` VALUES ('155', 'Work Order', 'child', '93', null, '0', null, '129', null);
INSERT INTO `application_side_menu` VALUES ('156', 'Work Order', 'child', '59', null, '1', null, '129', null);
INSERT INTO `application_side_menu` VALUES ('157', 'Fingerprint Device', 'child', '5', null, '7', null, '268', null);
INSERT INTO `application_side_menu` VALUES ('158', 'Assign Fingerprint Device', 'child', '117', null, '6', null, '275', null);
INSERT INTO `application_side_menu` VALUES ('159', 'Fingerprint Enroll', 'child', '125', null, '4', null, '283', null);
INSERT INTO `application_side_menu` VALUES ('160', 'View Group', 'child', '108', null, '3', null, '304', null);
INSERT INTO `application_side_menu` VALUES ('161', 'Configuration Parameter', 'child', '5', null, '8', null, '309', null);
INSERT INTO `application_side_menu` VALUES ('162', 'Notification Setting', 'child', '108', null, '4', null, '314', null);
INSERT INTO `application_side_menu` VALUES ('163', 'Product Definition', 'child', '103', null, '3', null, '319', null);
INSERT INTO `application_side_menu` VALUES ('164', 'Overtime', 'child', '133', '9', '3', 'overtime', '380', null);
INSERT INTO `application_side_menu` VALUES ('165', 'Insentive', 'child', '133', '9', '4', 'insentive', '386', null);
INSERT INTO `application_side_menu` VALUES ('166', 'Salary Type', 'child', '116', '9', '6', 'salary_type', '354', null);
INSERT INTO `application_side_menu` VALUES ('167', 'Payroll Periode', 'child', '133', '9', '5', 'payroll_periode', '356', null);

-- ----------------------------
-- Table structure for `bank`
-- ----------------------------
DROP TABLE IF EXISTS `bank`;
CREATE TABLE `bank` (
  `id_bank` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `branch` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `contact` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_bank`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of bank
-- ----------------------------
INSERT INTO `bank` VALUES ('1', 'BCA', 'Jakarta', 'Jakarta', 'Test');
INSERT INTO `bank` VALUES ('2', 'Mandiri', '', '', null);
INSERT INTO `bank` VALUES ('3', 'BNI', '', '', null);
INSERT INTO `bank` VALUES ('4', 'BRI', '', '', null);
INSERT INTO `bank` VALUES ('5', 'BTN', '', '', null);
INSERT INTO `bank` VALUES ('6', 'BII', '', '', null);
INSERT INTO `bank` VALUES ('7', 'Citibank', '', '', null);
INSERT INTO `bank` VALUES ('8', 'Permata', '', '', null);
INSERT INTO `bank` VALUES ('9', 'Danamon', '', '', null);
INSERT INTO `bank` VALUES ('10', 'CIMB Niaga', '', '', null);
INSERT INTO `bank` VALUES ('11', 'Mega', '', '', null);
INSERT INTO `bank` VALUES ('12', 'Muamalat', '', '', null);

-- ----------------------------
-- Table structure for `bank_statement`
-- ----------------------------
DROP TABLE IF EXISTS `bank_statement`;
CREATE TABLE `bank_statement` (
  `id_bank_statement` int(11) NOT NULL AUTO_INCREMENT,
  `account` int(11) NOT NULL,
  `amount` float NOT NULL,
  `description` text NOT NULL,
  `recipient` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id_bank_statement`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bank_statement
-- ----------------------------
INSERT INTO `bank_statement` VALUES ('1', '2', '1000000', 'test', 'BCA', 'out', '2015-01-15');

-- ----------------------------
-- Table structure for `bom`
-- ----------------------------
DROP TABLE IF EXISTS `bom`;
CREATE TABLE `bom` (
  `id_bom` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL,
  `product` bigint(20) NOT NULL,
  PRIMARY KEY (`id_bom`),
  UNIQUE KEY `product_UNIQUE` (`product`),
  KEY `fk_bom_product1_idx` (`product`),
  CONSTRAINT `fk_bom_product1` FOREIGN KEY (`product`) REFERENCES `product` (`id_product`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of bom
-- ----------------------------
INSERT INTO `bom` VALUES ('2', 'Test', 'draft', '2');
INSERT INTO `bom` VALUES ('3', 'Security Office', 'draft', '4');
INSERT INTO `bom` VALUES ('4', 'Shift Leader', 'draft', '6');
INSERT INTO `bom` VALUES ('5', 'Security Supervisor', 'draft', '5');

-- ----------------------------
-- Table structure for `cash_register`
-- ----------------------------
DROP TABLE IF EXISTS `cash_register`;
CREATE TABLE `cash_register` (
  `id_cash_register` int(11) NOT NULL AUTO_INCREMENT,
  `account` int(11) NOT NULL,
  `amount` float NOT NULL,
  `date` date NOT NULL,
  `description` text NOT NULL,
  `status` varchar(45) NOT NULL,
  PRIMARY KEY (`id_cash_register`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cash_register
-- ----------------------------
INSERT INTO `cash_register` VALUES ('1', '1', '1000', '2015-01-23', 'ok', 'debit');
INSERT INTO `cash_register` VALUES ('2', '1', '100000', '2015-02-07', 'ok 2', 'out');

-- ----------------------------
-- Table structure for `chart_of_account`
-- ----------------------------
DROP TABLE IF EXISTS `chart_of_account`;
CREATE TABLE `chart_of_account` (
  `id_chart_of_account` int(11) NOT NULL AUTO_INCREMENT,
  `account_number` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `index` int(11) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_chart_of_account`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of chart_of_account
-- ----------------------------
INSERT INTO `chart_of_account` VALUES ('1', '1001', 'Cash', '0', '1', 'debit');
INSERT INTO `chart_of_account` VALUES ('2', '1002', 'Bank', '0', '1', 'debit');
INSERT INTO `chart_of_account` VALUES ('3', '1003', 'Cash Bank', '1', '1', 'debit');

-- ----------------------------
-- Table structure for `city`
-- ----------------------------
DROP TABLE IF EXISTS `city`;
CREATE TABLE `city` (
  `id_city` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `state` int(11) NOT NULL,
  PRIMARY KEY (`id_city`),
  KEY `fk_city_state1_idx` (`state`),
  CONSTRAINT `fk_city_state1` FOREIGN KEY (`state`) REFERENCES `state` (`id_state`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=500 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of city
-- ----------------------------
INSERT INTO `city` VALUES ('1', 'Aceh Barat', '11');
INSERT INTO `city` VALUES ('2', 'Aceh Barat Daya', '11');
INSERT INTO `city` VALUES ('3', 'Aceh Besar', '11');
INSERT INTO `city` VALUES ('4', 'Aceh Jaya', '11');
INSERT INTO `city` VALUES ('5', 'Aceh Selatan', '11');
INSERT INTO `city` VALUES ('6', 'Aceh Singkil', '11');
INSERT INTO `city` VALUES ('7', 'Aceh Tamiang', '11');
INSERT INTO `city` VALUES ('8', 'Aceh Tengah', '11');
INSERT INTO `city` VALUES ('9', 'Aceh Tenggara', '11');
INSERT INTO `city` VALUES ('10', 'Aceh Timur', '11');
INSERT INTO `city` VALUES ('11', 'Aceh Utara', '11');
INSERT INTO `city` VALUES ('12', 'Agam', '13');
INSERT INTO `city` VALUES ('13', 'Alor', '53');
INSERT INTO `city` VALUES ('14', 'Ambon', '81');
INSERT INTO `city` VALUES ('15', 'Asahan', '12');
INSERT INTO `city` VALUES ('16', 'Asmat', '94');
INSERT INTO `city` VALUES ('17', 'Badung', '51');
INSERT INTO `city` VALUES ('18', 'Balangan', '63');
INSERT INTO `city` VALUES ('19', 'Balikpapan', '64');
INSERT INTO `city` VALUES ('20', 'Banda Aceh', '11');
INSERT INTO `city` VALUES ('21', 'Bandar Lampung', '18');
INSERT INTO `city` VALUES ('22', 'Bandung', '32');
INSERT INTO `city` VALUES ('23', 'Bandung', '32');
INSERT INTO `city` VALUES ('24', 'Bandung Barat', '32');
INSERT INTO `city` VALUES ('25', 'Banggai', '72');
INSERT INTO `city` VALUES ('26', 'Banggai Kepulauan', '72');
INSERT INTO `city` VALUES ('27', 'Bangka', '19');
INSERT INTO `city` VALUES ('28', 'Bangka Barat', '19');
INSERT INTO `city` VALUES ('29', 'Bangka Selatan', '19');
INSERT INTO `city` VALUES ('30', 'Bangka Tengah', '19');
INSERT INTO `city` VALUES ('31', 'Bangkalan', '35');
INSERT INTO `city` VALUES ('32', 'Bangli', '51');
INSERT INTO `city` VALUES ('33', 'Banjar', '63');
INSERT INTO `city` VALUES ('34', 'Banjar', '32');
INSERT INTO `city` VALUES ('35', 'Banjar Baru', '63');
INSERT INTO `city` VALUES ('36', 'Banjarmasin', '63');
INSERT INTO `city` VALUES ('37', 'Banjarnegara', '33');
INSERT INTO `city` VALUES ('38', 'Bantaeng', '73');
INSERT INTO `city` VALUES ('39', 'Bantul', '34');
INSERT INTO `city` VALUES ('40', 'Banyu Asin', '16');
INSERT INTO `city` VALUES ('41', 'Banyumas', '33');
INSERT INTO `city` VALUES ('42', 'Banyuwangi', '35');
INSERT INTO `city` VALUES ('43', 'Barito Kuala', '63');
INSERT INTO `city` VALUES ('44', 'Barito Selatan', '62');
INSERT INTO `city` VALUES ('45', 'Barito Timur', '62');
INSERT INTO `city` VALUES ('46', 'Barito Utara', '62');
INSERT INTO `city` VALUES ('47', 'Barru', '73');
INSERT INTO `city` VALUES ('48', 'Batam', '21');
INSERT INTO `city` VALUES ('49', 'Batang', '33');
INSERT INTO `city` VALUES ('50', 'Batang Hari', '15');
INSERT INTO `city` VALUES ('51', 'Batu', '35');
INSERT INTO `city` VALUES ('52', 'Batu Bara', '12');
INSERT INTO `city` VALUES ('53', 'Baubau', '74');
INSERT INTO `city` VALUES ('54', 'Bekasi', '32');
INSERT INTO `city` VALUES ('55', 'Bekasi', '32');
INSERT INTO `city` VALUES ('56', 'Belitung', '19');
INSERT INTO `city` VALUES ('57', 'Belitung Timur', '19');
INSERT INTO `city` VALUES ('58', 'Belu', '53');
INSERT INTO `city` VALUES ('59', 'Bener Meriah', '11');
INSERT INTO `city` VALUES ('60', 'Bengkalis', '14');
INSERT INTO `city` VALUES ('61', 'Bengkayang', '61');
INSERT INTO `city` VALUES ('62', 'Bengkulu', '17');
INSERT INTO `city` VALUES ('63', 'Bengkulu Selatan', '17');
INSERT INTO `city` VALUES ('64', 'Bengkulu Tengah', '17');
INSERT INTO `city` VALUES ('65', 'Bengkulu Utara', '17');
INSERT INTO `city` VALUES ('66', 'Berau', '64');
INSERT INTO `city` VALUES ('67', 'Biak Numfor', '94');
INSERT INTO `city` VALUES ('68', 'Bima', '52');
INSERT INTO `city` VALUES ('69', 'Bima', '52');
INSERT INTO `city` VALUES ('70', 'Binjai', '12');
INSERT INTO `city` VALUES ('71', 'Bintan', '21');
INSERT INTO `city` VALUES ('72', 'Bireuen', '11');
INSERT INTO `city` VALUES ('73', 'Bitung', '71');
INSERT INTO `city` VALUES ('74', 'Blitar', '35');
INSERT INTO `city` VALUES ('75', 'Blitar', '35');
INSERT INTO `city` VALUES ('76', 'Blora', '33');
INSERT INTO `city` VALUES ('77', 'Boalemo', '75');
INSERT INTO `city` VALUES ('78', 'Bogor', '32');
INSERT INTO `city` VALUES ('79', 'Bogor', '32');
INSERT INTO `city` VALUES ('80', 'Bojonegoro', '35');
INSERT INTO `city` VALUES ('81', 'Bolaang Mongondow', '71');
INSERT INTO `city` VALUES ('82', 'Bolaang Mongondow Selatan', '71');
INSERT INTO `city` VALUES ('83', 'Bolaang Mongondow Timur', '71');
INSERT INTO `city` VALUES ('84', 'Bolaang Mongondow Utara', '71');
INSERT INTO `city` VALUES ('85', 'Bombana', '74');
INSERT INTO `city` VALUES ('86', 'Bondowoso', '35');
INSERT INTO `city` VALUES ('87', 'Bone', '73');
INSERT INTO `city` VALUES ('88', 'Bone Bolango', '75');
INSERT INTO `city` VALUES ('89', 'Bontang', '64');
INSERT INTO `city` VALUES ('90', 'Boven Digoel', '94');
INSERT INTO `city` VALUES ('91', 'Boyolali', '33');
INSERT INTO `city` VALUES ('92', 'Brebes', '33');
INSERT INTO `city` VALUES ('93', 'Bukittinggi', '13');
INSERT INTO `city` VALUES ('94', 'Buleleng', '51');
INSERT INTO `city` VALUES ('95', 'Bulukumba', '73');
INSERT INTO `city` VALUES ('96', 'Bulungan', '65');
INSERT INTO `city` VALUES ('97', 'Bungo', '15');
INSERT INTO `city` VALUES ('98', 'Buol', '72');
INSERT INTO `city` VALUES ('99', 'Buru', '81');
INSERT INTO `city` VALUES ('100', 'Buru Selatan', '81');
INSERT INTO `city` VALUES ('101', 'Buton', '74');
INSERT INTO `city` VALUES ('102', 'Buton Utara', '74');
INSERT INTO `city` VALUES ('103', 'Ciamis', '32');
INSERT INTO `city` VALUES ('104', 'Cianjur', '32');
INSERT INTO `city` VALUES ('105', 'Cilacap', '33');
INSERT INTO `city` VALUES ('106', 'Cilegon', '36');
INSERT INTO `city` VALUES ('107', 'Cimahi', '32');
INSERT INTO `city` VALUES ('108', 'Cirebon', '32');
INSERT INTO `city` VALUES ('109', 'Cirebon', '32');
INSERT INTO `city` VALUES ('110', 'Dairi', '12');
INSERT INTO `city` VALUES ('111', 'Deiyai', '94');
INSERT INTO `city` VALUES ('112', 'Deli Serdang', '12');
INSERT INTO `city` VALUES ('113', 'Demak', '33');
INSERT INTO `city` VALUES ('114', 'Denpasar', '51');
INSERT INTO `city` VALUES ('115', 'Depok', '32');
INSERT INTO `city` VALUES ('116', 'Dharmasraya', '13');
INSERT INTO `city` VALUES ('117', 'Dogiyai', '94');
INSERT INTO `city` VALUES ('118', 'Dompu', '52');
INSERT INTO `city` VALUES ('119', 'Donggala', '72');
INSERT INTO `city` VALUES ('120', 'Dumai', '14');
INSERT INTO `city` VALUES ('121', 'Empat Lawang', '16');
INSERT INTO `city` VALUES ('122', 'Ende', '53');
INSERT INTO `city` VALUES ('123', 'Enrekang', '73');
INSERT INTO `city` VALUES ('124', 'Fakfak', '91');
INSERT INTO `city` VALUES ('125', 'Flores Timur', '53');
INSERT INTO `city` VALUES ('126', 'Garut', '32');
INSERT INTO `city` VALUES ('127', 'Gayo Lues', '11');
INSERT INTO `city` VALUES ('128', 'Gianyar', '51');
INSERT INTO `city` VALUES ('129', 'Gorontalo', '75');
INSERT INTO `city` VALUES ('130', 'Gorontalo', '75');
INSERT INTO `city` VALUES ('131', 'Gorontalo Utara', '75');
INSERT INTO `city` VALUES ('132', 'Gowa', '73');
INSERT INTO `city` VALUES ('133', 'Gresik', '35');
INSERT INTO `city` VALUES ('134', 'Grobogan', '33');
INSERT INTO `city` VALUES ('135', 'Gunung Kidul', '34');
INSERT INTO `city` VALUES ('136', 'Gunung Mas', '62');
INSERT INTO `city` VALUES ('137', 'Gunungsitoli', '12');
INSERT INTO `city` VALUES ('138', 'Halmahera Barat', '82');
INSERT INTO `city` VALUES ('139', 'Halmahera Selatan', '82');
INSERT INTO `city` VALUES ('140', 'Halmahera Tengah', '82');
INSERT INTO `city` VALUES ('141', 'Halmahera Timur', '82');
INSERT INTO `city` VALUES ('142', 'Halmahera Utara', '82');
INSERT INTO `city` VALUES ('143', 'Hulu Sungai Selatan', '63');
INSERT INTO `city` VALUES ('144', 'Hulu Sungai Tengah', '63');
INSERT INTO `city` VALUES ('145', 'Hulu Sungai Utara', '63');
INSERT INTO `city` VALUES ('146', 'Humbang Hasundutan', '12');
INSERT INTO `city` VALUES ('147', 'Indragiri Hilir', '14');
INSERT INTO `city` VALUES ('148', 'Indragiri Hulu', '14');
INSERT INTO `city` VALUES ('149', 'Indramayu', '32');
INSERT INTO `city` VALUES ('150', 'Intan Jaya', '94');
INSERT INTO `city` VALUES ('151', 'Jakarta Barat', '31');
INSERT INTO `city` VALUES ('152', 'Jakarta Pusat', '31');
INSERT INTO `city` VALUES ('153', 'Jakarta Selatan', '31');
INSERT INTO `city` VALUES ('154', 'Jakarta Timur', '31');
INSERT INTO `city` VALUES ('155', 'Jakarta Utara', '31');
INSERT INTO `city` VALUES ('156', 'Jambi', '15');
INSERT INTO `city` VALUES ('157', 'Jayapura', '94');
INSERT INTO `city` VALUES ('158', 'Jayapura', '94');
INSERT INTO `city` VALUES ('159', 'Jayawijaya', '94');
INSERT INTO `city` VALUES ('160', 'Jember', '35');
INSERT INTO `city` VALUES ('161', 'Jembrana', '51');
INSERT INTO `city` VALUES ('162', 'Jeneponto', '73');
INSERT INTO `city` VALUES ('163', 'Jepara', '33');
INSERT INTO `city` VALUES ('164', 'Jombang', '35');
INSERT INTO `city` VALUES ('165', 'Kaimana', '91');
INSERT INTO `city` VALUES ('166', 'Kampar', '14');
INSERT INTO `city` VALUES ('167', 'Kapuas', '62');
INSERT INTO `city` VALUES ('168', 'Kapuas Hulu', '61');
INSERT INTO `city` VALUES ('169', 'Karang Asem', '51');
INSERT INTO `city` VALUES ('170', 'Karanganyar', '33');
INSERT INTO `city` VALUES ('171', 'Karawang', '32');
INSERT INTO `city` VALUES ('172', 'Karimun', '21');
INSERT INTO `city` VALUES ('173', 'Karo', '12');
INSERT INTO `city` VALUES ('174', 'Katingan', '62');
INSERT INTO `city` VALUES ('175', 'Kaur', '17');
INSERT INTO `city` VALUES ('176', 'Kayong Utara', '61');
INSERT INTO `city` VALUES ('177', 'Kebumen', '33');
INSERT INTO `city` VALUES ('178', 'Kediri', '35');
INSERT INTO `city` VALUES ('179', 'Kediri', '35');
INSERT INTO `city` VALUES ('180', 'Keerom', '94');
INSERT INTO `city` VALUES ('181', 'Kendal', '33');
INSERT INTO `city` VALUES ('182', 'Kendari', '74');
INSERT INTO `city` VALUES ('183', 'Kepahiang', '17');
INSERT INTO `city` VALUES ('184', 'Kepulauan Anambas', '21');
INSERT INTO `city` VALUES ('185', 'Kepulauan Aru', '81');
INSERT INTO `city` VALUES ('186', 'Kepulauan Mentawai', '13');
INSERT INTO `city` VALUES ('187', 'Kepulauan Meranti', '14');
INSERT INTO `city` VALUES ('188', 'Kepulauan Sangihe', '71');
INSERT INTO `city` VALUES ('189', 'Kepulauan Selayar', '73');
INSERT INTO `city` VALUES ('190', 'Kepulauan Seribu', '31');
INSERT INTO `city` VALUES ('191', 'Kepulauan Sula', '82');
INSERT INTO `city` VALUES ('192', 'Kepulauan Talaud', '71');
INSERT INTO `city` VALUES ('193', 'Kepulauan Yapen', '94');
INSERT INTO `city` VALUES ('194', 'Kerinci', '15');
INSERT INTO `city` VALUES ('195', 'Ketapang', '61');
INSERT INTO `city` VALUES ('196', 'Klaten', '33');
INSERT INTO `city` VALUES ('197', 'Klungkung', '51');
INSERT INTO `city` VALUES ('198', 'Kolaka', '74');
INSERT INTO `city` VALUES ('199', 'Kolaka Utara', '74');
INSERT INTO `city` VALUES ('200', 'Konawe', '74');
INSERT INTO `city` VALUES ('201', 'Konawe Selatan', '74');
INSERT INTO `city` VALUES ('202', 'Konawe Utara', '74');
INSERT INTO `city` VALUES ('203', 'Kota Baru', '63');
INSERT INTO `city` VALUES ('204', 'Kotamobagu', '71');
INSERT INTO `city` VALUES ('205', 'Kotawaringin Barat', '62');
INSERT INTO `city` VALUES ('206', 'Kotawaringin Timur', '62');
INSERT INTO `city` VALUES ('207', 'Kuantan Singingi', '14');
INSERT INTO `city` VALUES ('208', 'Kubu Raya', '61');
INSERT INTO `city` VALUES ('209', 'Kudus', '33');
INSERT INTO `city` VALUES ('210', 'Kulon Progo', '34');
INSERT INTO `city` VALUES ('211', 'Kuningan', '32');
INSERT INTO `city` VALUES ('212', 'Kupang', '53');
INSERT INTO `city` VALUES ('213', 'Kupang', '53');
INSERT INTO `city` VALUES ('214', 'Kutai Barat', '64');
INSERT INTO `city` VALUES ('215', 'Kutai Kartanegara', '64');
INSERT INTO `city` VALUES ('216', 'Kutai Timur', '64');
INSERT INTO `city` VALUES ('217', 'Labuhan Batu', '12');
INSERT INTO `city` VALUES ('218', 'Labuhan Batu Selatan', '12');
INSERT INTO `city` VALUES ('219', 'Labuhan Batu Utara', '12');
INSERT INTO `city` VALUES ('220', 'Lahat', '16');
INSERT INTO `city` VALUES ('221', 'Lamandau', '62');
INSERT INTO `city` VALUES ('222', 'Lamongan', '35');
INSERT INTO `city` VALUES ('223', 'Lampung Barat', '18');
INSERT INTO `city` VALUES ('224', 'Lampung Selatan', '18');
INSERT INTO `city` VALUES ('225', 'Lampung Tengah', '18');
INSERT INTO `city` VALUES ('226', 'Lampung Timur', '18');
INSERT INTO `city` VALUES ('227', 'Lampung Utara', '18');
INSERT INTO `city` VALUES ('228', 'Landak', '61');
INSERT INTO `city` VALUES ('229', 'Langkat', '12');
INSERT INTO `city` VALUES ('230', 'Langsa', '11');
INSERT INTO `city` VALUES ('231', 'Lanny Jaya', '94');
INSERT INTO `city` VALUES ('232', 'Lebak', '36');
INSERT INTO `city` VALUES ('233', 'Lebong', '17');
INSERT INTO `city` VALUES ('234', 'Lembata', '53');
INSERT INTO `city` VALUES ('235', 'Lhokseumawe', '11');
INSERT INTO `city` VALUES ('236', 'Lima Puluh Kota', '13');
INSERT INTO `city` VALUES ('237', 'Lingga', '21');
INSERT INTO `city` VALUES ('238', 'Lombok Barat', '52');
INSERT INTO `city` VALUES ('239', 'Lombok Tengah', '52');
INSERT INTO `city` VALUES ('240', 'Lombok Timur', '52');
INSERT INTO `city` VALUES ('241', 'Lombok Utara', '52');
INSERT INTO `city` VALUES ('242', 'Lubuklinggau', '16');
INSERT INTO `city` VALUES ('243', 'Lumajang', '35');
INSERT INTO `city` VALUES ('244', 'Luwu', '73');
INSERT INTO `city` VALUES ('245', 'Luwu Timur', '73');
INSERT INTO `city` VALUES ('246', 'Luwu Utara', '73');
INSERT INTO `city` VALUES ('247', 'Madiun', '35');
INSERT INTO `city` VALUES ('248', 'Madiun', '35');
INSERT INTO `city` VALUES ('249', 'Magelang', '33');
INSERT INTO `city` VALUES ('250', 'Magelang', '33');
INSERT INTO `city` VALUES ('251', 'Magetan', '35');
INSERT INTO `city` VALUES ('252', 'Majalengka', '32');
INSERT INTO `city` VALUES ('253', 'Majene', '76');
INSERT INTO `city` VALUES ('254', 'Makassar', '73');
INSERT INTO `city` VALUES ('255', 'Malang', '35');
INSERT INTO `city` VALUES ('256', 'Malang', '35');
INSERT INTO `city` VALUES ('257', 'Malinau', '65');
INSERT INTO `city` VALUES ('258', 'Maluku Barat Daya', '81');
INSERT INTO `city` VALUES ('259', 'Maluku Tengah', '81');
INSERT INTO `city` VALUES ('260', 'Maluku Tenggara', '81');
INSERT INTO `city` VALUES ('261', 'Maluku Tenggara Barat', '81');
INSERT INTO `city` VALUES ('262', 'Mamasa', '76');
INSERT INTO `city` VALUES ('263', 'Mamberamo Raya', '94');
INSERT INTO `city` VALUES ('264', 'Mamberamo Tengah', '94');
INSERT INTO `city` VALUES ('265', 'Mamuju', '76');
INSERT INTO `city` VALUES ('266', 'Mamuju Utara', '76');
INSERT INTO `city` VALUES ('267', 'Manado', '71');
INSERT INTO `city` VALUES ('268', 'Mandailing Natal', '12');
INSERT INTO `city` VALUES ('269', 'Manggarai', '53');
INSERT INTO `city` VALUES ('270', 'Manggarai Barat', '53');
INSERT INTO `city` VALUES ('271', 'Manggarai Timur', '53');
INSERT INTO `city` VALUES ('272', 'Manokwari', '91');
INSERT INTO `city` VALUES ('273', 'Mappi', '94');
INSERT INTO `city` VALUES ('274', 'Maros', '73');
INSERT INTO `city` VALUES ('275', 'Mataram', '52');
INSERT INTO `city` VALUES ('276', 'Maybrat', '91');
INSERT INTO `city` VALUES ('277', 'Medan', '12');
INSERT INTO `city` VALUES ('278', 'Melawi', '61');
INSERT INTO `city` VALUES ('279', 'Merangin', '15');
INSERT INTO `city` VALUES ('280', 'Merauke', '94');
INSERT INTO `city` VALUES ('281', 'Mesuji', '18');
INSERT INTO `city` VALUES ('282', 'Metro', '18');
INSERT INTO `city` VALUES ('283', 'Mimika', '94');
INSERT INTO `city` VALUES ('284', 'Minahasa', '71');
INSERT INTO `city` VALUES ('285', 'Minahasa Selatan', '71');
INSERT INTO `city` VALUES ('286', 'Minahasa Tenggara', '71');
INSERT INTO `city` VALUES ('287', 'Minahasa Utara', '71');
INSERT INTO `city` VALUES ('288', 'Mojokerto', '35');
INSERT INTO `city` VALUES ('289', 'Mojokerto', '35');
INSERT INTO `city` VALUES ('290', 'Morowali', '72');
INSERT INTO `city` VALUES ('291', 'Muara Enim', '16');
INSERT INTO `city` VALUES ('292', 'Muaro Jambi', '15');
INSERT INTO `city` VALUES ('293', 'Mukomuko', '17');
INSERT INTO `city` VALUES ('294', 'Muna', '74');
INSERT INTO `city` VALUES ('295', 'Murung Raya', '62');
INSERT INTO `city` VALUES ('296', 'Musi Banyuasin', '16');
INSERT INTO `city` VALUES ('297', 'Musi Rawas', '16');
INSERT INTO `city` VALUES ('298', 'Nabire', '94');
INSERT INTO `city` VALUES ('299', 'Nagan Raya', '11');
INSERT INTO `city` VALUES ('300', 'Nagekeo', '53');
INSERT INTO `city` VALUES ('301', 'Natuna', '21');
INSERT INTO `city` VALUES ('302', 'Nduga', '94');
INSERT INTO `city` VALUES ('303', 'Ngada', '53');
INSERT INTO `city` VALUES ('304', 'Nganjuk', '35');
INSERT INTO `city` VALUES ('305', 'Ngawi', '35');
INSERT INTO `city` VALUES ('306', 'Nias', '12');
INSERT INTO `city` VALUES ('307', 'Nias Barat', '12');
INSERT INTO `city` VALUES ('308', 'Nias Selatan', '12');
INSERT INTO `city` VALUES ('309', 'Nias Utara', '12');
INSERT INTO `city` VALUES ('310', 'Nunukan', '65');
INSERT INTO `city` VALUES ('311', 'Ogan Ilir', '16');
INSERT INTO `city` VALUES ('312', 'Ogan Komering Ilir', '16');
INSERT INTO `city` VALUES ('313', 'Ogan Komering Ulu', '16');
INSERT INTO `city` VALUES ('314', 'Ogan Komering Ulu Selatan', '16');
INSERT INTO `city` VALUES ('315', 'Ogan Komering Ulu Timur', '16');
INSERT INTO `city` VALUES ('316', 'Pacitan', '35');
INSERT INTO `city` VALUES ('317', 'Padang', '13');
INSERT INTO `city` VALUES ('318', 'Padang Lawas', '12');
INSERT INTO `city` VALUES ('319', 'Padang Lawas Utara', '12');
INSERT INTO `city` VALUES ('320', 'Padang Panjang', '13');
INSERT INTO `city` VALUES ('321', 'Padang Pariaman', '13');
INSERT INTO `city` VALUES ('322', 'Padangsidimpuan', '12');
INSERT INTO `city` VALUES ('323', 'Pagar Alam', '16');
INSERT INTO `city` VALUES ('324', 'Pakpak Bharat', '12');
INSERT INTO `city` VALUES ('325', 'Palangka Raya', '62');
INSERT INTO `city` VALUES ('326', 'Palembang', '16');
INSERT INTO `city` VALUES ('327', 'Palopo', '73');
INSERT INTO `city` VALUES ('328', 'Palu', '72');
INSERT INTO `city` VALUES ('329', 'Pamekasan', '35');
INSERT INTO `city` VALUES ('330', 'Pandeglang', '36');
INSERT INTO `city` VALUES ('331', 'Pangandaran', '32');
INSERT INTO `city` VALUES ('332', 'Pangkajene Dan Kepulauan', '73');
INSERT INTO `city` VALUES ('333', 'Pangkal Pinang', '19');
INSERT INTO `city` VALUES ('334', 'Paniai', '94');
INSERT INTO `city` VALUES ('335', 'Parepare', '73');
INSERT INTO `city` VALUES ('336', 'Pariaman', '13');
INSERT INTO `city` VALUES ('337', 'Parigi Moutong', '72');
INSERT INTO `city` VALUES ('338', 'Pasaman', '13');
INSERT INTO `city` VALUES ('339', 'Pasaman Barat', '13');
INSERT INTO `city` VALUES ('340', 'Paser', '64');
INSERT INTO `city` VALUES ('341', 'Pasuruan', '35');
INSERT INTO `city` VALUES ('342', 'Pasuruan', '35');
INSERT INTO `city` VALUES ('343', 'Pati', '33');
INSERT INTO `city` VALUES ('344', 'Payakumbuh', '13');
INSERT INTO `city` VALUES ('345', 'Pegunungan Bintang', '94');
INSERT INTO `city` VALUES ('346', 'Pekalongan', '33');
INSERT INTO `city` VALUES ('347', 'Pekalongan', '33');
INSERT INTO `city` VALUES ('348', 'Pekanbaru', '14');
INSERT INTO `city` VALUES ('349', 'Pelalawan', '14');
INSERT INTO `city` VALUES ('350', 'Pemalang', '33');
INSERT INTO `city` VALUES ('351', 'Pematang Siantar', '12');
INSERT INTO `city` VALUES ('352', 'Penajam Paser Utara', '64');
INSERT INTO `city` VALUES ('353', 'Pesawaran', '18');
INSERT INTO `city` VALUES ('354', 'Pesisir Barat', '18');
INSERT INTO `city` VALUES ('355', 'Pesisir Selatan', '13');
INSERT INTO `city` VALUES ('356', 'Pidie', '11');
INSERT INTO `city` VALUES ('357', 'Pidie Jaya', '11');
INSERT INTO `city` VALUES ('358', 'Pinrang', '73');
INSERT INTO `city` VALUES ('359', 'Pohuwato', '75');
INSERT INTO `city` VALUES ('360', 'Polewali Mandar', '76');
INSERT INTO `city` VALUES ('361', 'Ponorogo', '35');
INSERT INTO `city` VALUES ('362', 'Pontianak', '61');
INSERT INTO `city` VALUES ('363', 'Pontianak', '61');
INSERT INTO `city` VALUES ('364', 'Poso', '72');
INSERT INTO `city` VALUES ('365', 'Prabumulih', '16');
INSERT INTO `city` VALUES ('366', 'Pringsewu', '18');
INSERT INTO `city` VALUES ('367', 'Probolinggo', '35');
INSERT INTO `city` VALUES ('368', 'Probolinggo', '35');
INSERT INTO `city` VALUES ('369', 'Pulang Pisau', '62');
INSERT INTO `city` VALUES ('370', 'Pulau Morotai', '82');
INSERT INTO `city` VALUES ('371', 'Puncak', '94');
INSERT INTO `city` VALUES ('372', 'Puncak Jaya', '94');
INSERT INTO `city` VALUES ('373', 'Purbalingga', '33');
INSERT INTO `city` VALUES ('374', 'Purwakarta', '32');
INSERT INTO `city` VALUES ('375', 'Purworejo', '33');
INSERT INTO `city` VALUES ('376', 'Raja Ampat', '91');
INSERT INTO `city` VALUES ('377', 'Rejang Lebong', '17');
INSERT INTO `city` VALUES ('378', 'Rembang', '33');
INSERT INTO `city` VALUES ('379', 'Rokan Hilir', '14');
INSERT INTO `city` VALUES ('380', 'Rokan Hulu', '14');
INSERT INTO `city` VALUES ('381', 'Rote Ndao', '53');
INSERT INTO `city` VALUES ('382', 'S I A K', '14');
INSERT INTO `city` VALUES ('383', 'Sabang', '11');
INSERT INTO `city` VALUES ('384', 'Sabu Raijua', '53');
INSERT INTO `city` VALUES ('385', 'Salatiga', '33');
INSERT INTO `city` VALUES ('386', 'Samarinda', '64');
INSERT INTO `city` VALUES ('387', 'Sambas', '61');
INSERT INTO `city` VALUES ('388', 'Samosir', '12');
INSERT INTO `city` VALUES ('389', 'Sampang', '35');
INSERT INTO `city` VALUES ('390', 'Sanggau', '61');
INSERT INTO `city` VALUES ('391', 'Sarmi', '94');
INSERT INTO `city` VALUES ('392', 'Sarolangun', '15');
INSERT INTO `city` VALUES ('393', 'Sawah Lunto', '13');
INSERT INTO `city` VALUES ('394', 'Sekadau', '61');
INSERT INTO `city` VALUES ('395', 'Seluma', '17');
INSERT INTO `city` VALUES ('396', 'Semarang', '33');
INSERT INTO `city` VALUES ('397', 'Semarang', '33');
INSERT INTO `city` VALUES ('398', 'Seram Bagian Barat', '81');
INSERT INTO `city` VALUES ('399', 'Seram Bagian Timur', '81');
INSERT INTO `city` VALUES ('400', 'Serang', '36');
INSERT INTO `city` VALUES ('401', 'Serang', '36');
INSERT INTO `city` VALUES ('402', 'Serdang Bedagai', '12');
INSERT INTO `city` VALUES ('403', 'Seruyan', '62');
INSERT INTO `city` VALUES ('404', 'Siau Tagulandang Biaro', '71');
INSERT INTO `city` VALUES ('405', 'Sibolga', '12');
INSERT INTO `city` VALUES ('406', 'Sidenreng Rappang', '73');
INSERT INTO `city` VALUES ('407', 'Sidoarjo', '35');
INSERT INTO `city` VALUES ('408', 'Sigi', '72');
INSERT INTO `city` VALUES ('409', 'Sijunjung', '13');
INSERT INTO `city` VALUES ('410', 'Sikka', '53');
INSERT INTO `city` VALUES ('411', 'Simalungun', '12');
INSERT INTO `city` VALUES ('412', 'Simeulue', '11');
INSERT INTO `city` VALUES ('413', 'Singkawang', '61');
INSERT INTO `city` VALUES ('414', 'Sinjai', '73');
INSERT INTO `city` VALUES ('415', 'Sintang', '61');
INSERT INTO `city` VALUES ('416', 'Situbondo', '35');
INSERT INTO `city` VALUES ('417', 'Sleman', '34');
INSERT INTO `city` VALUES ('418', 'Solok', '13');
INSERT INTO `city` VALUES ('419', 'Solok', '13');
INSERT INTO `city` VALUES ('420', 'Solok Selatan', '13');
INSERT INTO `city` VALUES ('421', 'Soppeng', '73');
INSERT INTO `city` VALUES ('422', 'Sorong', '91');
INSERT INTO `city` VALUES ('423', 'Sorong', '91');
INSERT INTO `city` VALUES ('424', 'Sorong Selatan', '91');
INSERT INTO `city` VALUES ('425', 'Sragen', '33');
INSERT INTO `city` VALUES ('426', 'Subang', '32');
INSERT INTO `city` VALUES ('427', 'Subulussalam', '11');
INSERT INTO `city` VALUES ('428', 'Sukabumi', '32');
INSERT INTO `city` VALUES ('429', 'Sukabumi', '32');
INSERT INTO `city` VALUES ('430', 'Sukamara', '62');
INSERT INTO `city` VALUES ('431', 'Sukoharjo', '33');
INSERT INTO `city` VALUES ('432', 'Sumba Barat', '53');
INSERT INTO `city` VALUES ('433', 'Sumba Barat Daya', '53');
INSERT INTO `city` VALUES ('434', 'Sumba Tengah', '53');
INSERT INTO `city` VALUES ('435', 'Sumba Timur', '53');
INSERT INTO `city` VALUES ('436', 'Sumbawa', '52');
INSERT INTO `city` VALUES ('437', 'Sumbawa Barat', '52');
INSERT INTO `city` VALUES ('438', 'Sumedang', '32');
INSERT INTO `city` VALUES ('439', 'Sumenep', '35');
INSERT INTO `city` VALUES ('440', 'Sungai Penuh', '15');
INSERT INTO `city` VALUES ('441', 'Supiori', '94');
INSERT INTO `city` VALUES ('442', 'Surabaya', '35');
INSERT INTO `city` VALUES ('443', 'Surakarta', '33');
INSERT INTO `city` VALUES ('444', 'Tabalong', '63');
INSERT INTO `city` VALUES ('445', 'Tabanan', '51');
INSERT INTO `city` VALUES ('446', 'Takalar', '73');
INSERT INTO `city` VALUES ('447', 'Tambrauw', '91');
INSERT INTO `city` VALUES ('448', 'Tana Tidung', '65');
INSERT INTO `city` VALUES ('449', 'Tana Toraja', '73');
INSERT INTO `city` VALUES ('450', 'Tanah Bumbu', '63');
INSERT INTO `city` VALUES ('451', 'Tanah Datar', '13');
INSERT INTO `city` VALUES ('452', 'Tanah Laut', '63');
INSERT INTO `city` VALUES ('453', 'Tangerang', '36');
INSERT INTO `city` VALUES ('454', 'Tangerang', '36');
INSERT INTO `city` VALUES ('455', 'Tangerang Selatan', '36');
INSERT INTO `city` VALUES ('456', 'Tanggamus', '18');
INSERT INTO `city` VALUES ('457', 'Tanjung Balai', '12');
INSERT INTO `city` VALUES ('458', 'Tanjung Jabung Barat', '15');
INSERT INTO `city` VALUES ('459', 'Tanjung Jabung Timur', '15');
INSERT INTO `city` VALUES ('460', 'Tanjung Pinang', '21');
INSERT INTO `city` VALUES ('461', 'Tapanuli Selatan', '12');
INSERT INTO `city` VALUES ('462', 'Tapanuli Tengah', '12');
INSERT INTO `city` VALUES ('463', 'Tapanuli Utara', '12');
INSERT INTO `city` VALUES ('464', 'Tapin', '63');
INSERT INTO `city` VALUES ('465', 'Tarakan', '65');
INSERT INTO `city` VALUES ('466', 'Tasikmalaya', '32');
INSERT INTO `city` VALUES ('467', 'Tasikmalaya', '32');
INSERT INTO `city` VALUES ('468', 'Tebing Tinggi', '12');
INSERT INTO `city` VALUES ('469', 'Tebo', '15');
INSERT INTO `city` VALUES ('470', 'Tegal', '33');
INSERT INTO `city` VALUES ('471', 'Tegal', '33');
INSERT INTO `city` VALUES ('472', 'Teluk Bintuni', '91');
INSERT INTO `city` VALUES ('473', 'Teluk Wondama', '91');
INSERT INTO `city` VALUES ('474', 'Temanggung', '33');
INSERT INTO `city` VALUES ('475', 'Ternate', '82');
INSERT INTO `city` VALUES ('476', 'Tidore Kepulauan', '82');
INSERT INTO `city` VALUES ('477', 'Timor Tengah Selatan', '53');
INSERT INTO `city` VALUES ('478', 'Timor Tengah Utara', '53');
INSERT INTO `city` VALUES ('479', 'Toba Samosir', '12');
INSERT INTO `city` VALUES ('480', 'Tojo Una-una', '72');
INSERT INTO `city` VALUES ('481', 'Tolikara', '94');
INSERT INTO `city` VALUES ('482', 'Toli-toli', '72');
INSERT INTO `city` VALUES ('483', 'Tomohon', '71');
INSERT INTO `city` VALUES ('484', 'Toraja Utara', '73');
INSERT INTO `city` VALUES ('485', 'Trenggalek', '35');
INSERT INTO `city` VALUES ('486', 'Tual', '81');
INSERT INTO `city` VALUES ('487', 'Tuban', '35');
INSERT INTO `city` VALUES ('488', 'Tulang Bawang Barat', '18');
INSERT INTO `city` VALUES ('489', 'Tulangbawang', '18');
INSERT INTO `city` VALUES ('490', 'Tulungagung', '35');
INSERT INTO `city` VALUES ('491', 'Wajo', '73');
INSERT INTO `city` VALUES ('492', 'Wakatobi', '74');
INSERT INTO `city` VALUES ('493', 'Waropen', '94');
INSERT INTO `city` VALUES ('494', 'Way Kanan', '18');
INSERT INTO `city` VALUES ('495', 'Wonogiri', '33');
INSERT INTO `city` VALUES ('496', 'Wonosobo', '33');
INSERT INTO `city` VALUES ('497', 'Yahukimo', '94');
INSERT INTO `city` VALUES ('498', 'Yalimo', '94');
INSERT INTO `city` VALUES ('499', 'Yogyakarta', '34');

-- ----------------------------
-- Table structure for `ci_sessions`
-- ----------------------------
DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ci_sessions
-- ----------------------------
INSERT INTO `ci_sessions` VALUES ('90316d2da33b3f8bb8bc4aeeabc73bac', '::1', 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '1418625171', 'a:10:{s:9:\"user_data\";s:0:\"\";s:10:\"app_userid\";s:1:\"2\";s:12:\"app_username\";s:6:\"system\";s:12:\"app_fullname\";s:12:\"System Admin\";s:8:\"app_role\";s:13:\"administrator\";s:11:\"app_role_id\";s:1:\"1\";s:10:\"app_div_id\";N;s:12:\"app_div_name\";s:5:\"admin\";s:13:\"is_dialog_set\";b:0;s:4:\"page\";s:15:\"dahsboard/index\";}');

-- ----------------------------
-- Table structure for `contract`
-- ----------------------------
DROP TABLE IF EXISTS `contract`;
CREATE TABLE `contract` (
  `id_contract` int(11) NOT NULL AUTO_INCREMENT,
  `filename` text NOT NULL,
  `filename_ori` text NOT NULL,
  `filename_type` varchar(255) NOT NULL,
  `startdate` date DEFAULT NULL,
  `expdate` date DEFAULT NULL,
  `invoice_term` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_contract`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of contract
-- ----------------------------
INSERT INTO `contract` VALUES ('1', 'test.docx', '', '', '2015-03-18', '2015-03-18', 'Every 6 Months', null);
INSERT INTO `contract` VALUES ('2', 'C150002', 'test2.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', '2015-03-28', '2015-03-31', 'Every 3 Months', null);
INSERT INTO `contract` VALUES ('3', 'C150002', 'test.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', null, null, null, null);
INSERT INTO `contract` VALUES ('4', 'C150003', 'test2.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', '2015-03-29', '2015-03-29', 'Every 3 Months', null);

-- ----------------------------
-- Table structure for `cost_element`
-- ----------------------------
DROP TABLE IF EXISTS `cost_element`;
CREATE TABLE `cost_element` (
  `id_cost_element` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `description` text,
  `type` int(11) NOT NULL COMMENT 'profit,direct_cost,overhead_cost',
  `value_type` varchar(45) NOT NULL COMMENT 'fix_price,percentage',
  `default_value` float DEFAULT NULL,
  PRIMARY KEY (`id_cost_element`),
  KEY `fk_cost_element_cost_element_type1_idx` (`type`),
  CONSTRAINT `fk_cost_element_cost_element_type1` FOREIGN KEY (`type`) REFERENCES `cost_element_type` (`id_cost_element_type`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cost_element
-- ----------------------------

-- ----------------------------
-- Table structure for `cost_element_type`
-- ----------------------------
DROP TABLE IF EXISTS `cost_element_type`;
CREATE TABLE `cost_element_type` (
  `id_cost_element_type` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `description` text,
  PRIMARY KEY (`id_cost_element_type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cost_element_type
-- ----------------------------

-- ----------------------------
-- Table structure for `country`
-- ----------------------------
DROP TABLE IF EXISTS `country`;
CREATE TABLE `country` (
  `id_country` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `abv` varchar(10) NOT NULL,
  PRIMARY KEY (`id_country`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of country
-- ----------------------------
INSERT INTO `country` VALUES ('1', 'Indonesia', 'INA');
INSERT INTO `country` VALUES ('2', 'Australia', 'AUS');

-- ----------------------------
-- Table structure for `currency`
-- ----------------------------
DROP TABLE IF EXISTS `currency`;
CREATE TABLE `currency` (
  `id_currency` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `symbol` varchar(45) NOT NULL,
  PRIMARY KEY (`id_currency`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of currency
-- ----------------------------

-- ----------------------------
-- Table structure for `customer_contract`
-- ----------------------------
DROP TABLE IF EXISTS `customer_contract`;
CREATE TABLE `customer_contract` (
  `id_customer_contract` int(11) NOT NULL AUTO_INCREMENT,
  `contract_number` varchar(45) NOT NULL,
  `period_start` date NOT NULL,
  `period_end` date NOT NULL,
  `invoice_period` varchar(45) NOT NULL,
  PRIMARY KEY (`id_customer_contract`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of customer_contract
-- ----------------------------

-- ----------------------------
-- Table structure for `customer_site`
-- ----------------------------
DROP TABLE IF EXISTS `customer_site`;
CREATE TABLE `customer_site` (
  `id_customer_site` int(11) NOT NULL AUTO_INCREMENT,
  `customer` int(11) NOT NULL,
  `site_name` varchar(45) DEFAULT NULL,
  `address` text NOT NULL,
  `city` int(11) NOT NULL,
  PRIMARY KEY (`id_customer_site`),
  KEY `fk_client_site_ext_company1_idx` (`customer`),
  KEY `fk_customer_site_city1_idx` (`city`),
  CONSTRAINT `fk_client_site_ext_company1` FOREIGN KEY (`customer`) REFERENCES `ext_company` (`id_ext_company`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_customer_site_city1` FOREIGN KEY (`city`) REFERENCES `city` (`id_city`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of customer_site
-- ----------------------------
INSERT INTO `customer_site` VALUES ('1', '4', 'Site 1', 'Jl. Raya Walisongo No. 395 A KM 9.6', '396');

-- ----------------------------
-- Table structure for `database_field_interface`
-- ----------------------------
DROP TABLE IF EXISTS `database_field_interface`;
CREATE TABLE `database_field_interface` (
  `id_database_field_interface` int(11) NOT NULL AUTO_INCREMENT,
  `field_name` varchar(45) NOT NULL,
  `model_field_name` varchar(45) NOT NULL,
  `database_interface_id` int(11) NOT NULL,
  `status_sync` tinyint(1) NOT NULL DEFAULT '0',
  `alias` varchar(45) NOT NULL,
  PRIMARY KEY (`id_database_field_interface`),
  UNIQUE KEY `field_name_UNIQUE` (`field_name`),
  UNIQUE KEY `model_field_name_UNIQUE` (`model_field_name`),
  KEY `fk_database_field_interface_database_interface1_idx` (`database_interface_id`),
  CONSTRAINT `fk_database_field_interface_database_interface1` FOREIGN KEY (`database_interface_id`) REFERENCES `database_interface` (`id_database_interface`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of database_field_interface
-- ----------------------------

-- ----------------------------
-- Table structure for `database_interface`
-- ----------------------------
DROP TABLE IF EXISTS `database_interface`;
CREATE TABLE `database_interface` (
  `id_database_interface` int(11) NOT NULL AUTO_INCREMENT,
  `table_name` varchar(45) NOT NULL,
  `model_name` varchar(45) NOT NULL,
  `status_sync` tinyint(1) NOT NULL DEFAULT '0',
  `alias` varchar(45) NOT NULL,
  PRIMARY KEY (`id_database_interface`),
  UNIQUE KEY `model_name_UNIQUE` (`model_name`),
  UNIQUE KEY `table_name_UNIQUE` (`table_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of database_interface
-- ----------------------------

-- ----------------------------
-- Table structure for `detail_bom`
-- ----------------------------
DROP TABLE IF EXISTS `detail_bom`;
CREATE TABLE `detail_bom` (
  `id_detail_bom` int(11) NOT NULL AUTO_INCREMENT,
  `bom` int(11) NOT NULL,
  `product` bigint(20) NOT NULL,
  `qty` float NOT NULL,
  `uom` int(11) NOT NULL,
  PRIMARY KEY (`id_detail_bom`),
  KEY `fk_detail_bom_bom1_idx` (`bom`),
  KEY `fk_detail_bom_product1_idx` (`product`),
  KEY `fk_detail_bom_unit_measure1_idx` (`uom`),
  CONSTRAINT `fk_detail_bom_bom1` FOREIGN KEY (`bom`) REFERENCES `bom` (`id_bom`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_detail_bom_product1` FOREIGN KEY (`product`) REFERENCES `product` (`id_product`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_detail_bom_unit_measure1` FOREIGN KEY (`uom`) REFERENCES `unit_measure` (`id_unit_measure`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of detail_bom
-- ----------------------------
INSERT INTO `detail_bom` VALUES ('1', '2', '2', '10', '2');
INSERT INTO `detail_bom` VALUES ('2', '2', '3', '5', '2');
INSERT INTO `detail_bom` VALUES ('3', '3', '7', '1', '2');
INSERT INTO `detail_bom` VALUES ('4', '3', '8', '1', '2');
INSERT INTO `detail_bom` VALUES ('5', '3', '9', '1', '2');
INSERT INTO `detail_bom` VALUES ('6', '4', '7', '1', '2');
INSERT INTO `detail_bom` VALUES ('7', '4', '8', '1', '2');
INSERT INTO `detail_bom` VALUES ('8', '4', '9', '1', '2');
INSERT INTO `detail_bom` VALUES ('9', '5', '7', '1', '2');
INSERT INTO `detail_bom` VALUES ('10', '5', '8', '1', '2');
INSERT INTO `detail_bom` VALUES ('11', '5', '9', '1', '2');
INSERT INTO `detail_bom` VALUES ('12', '5', '10', '1', '2');

-- ----------------------------
-- Table structure for `detail_product_cost_structure`
-- ----------------------------
DROP TABLE IF EXISTS `detail_product_cost_structure`;
CREATE TABLE `detail_product_cost_structure` (
  `id_detail_product_cost_structure` int(11) NOT NULL AUTO_INCREMENT,
  `product_cost_structure` int(11) NOT NULL,
  `cost_element` int(11) NOT NULL,
  `predecessor` int(11) DEFAULT NULL,
  `is_calc_based_predecessor` tinyint(1) NOT NULL DEFAULT '0',
  `single_value` float DEFAULT NULL,
  `accum_value` float DEFAULT NULL,
  PRIMARY KEY (`id_detail_product_cost_structure`),
  KEY `fk_detail_product_cost_structure_product_cost_structure1_idx` (`product_cost_structure`),
  KEY `fk_detail_product_cost_structure_cost_element1_idx` (`cost_element`),
  KEY `fk_detail_product_cost_structure_detail_product_cost_struct_idx` (`predecessor`),
  CONSTRAINT `fk_detail_product_cost_structure_cost_element1` FOREIGN KEY (`cost_element`) REFERENCES `cost_element` (`id_cost_element`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_detail_product_cost_structure_detail_product_cost_structure1` FOREIGN KEY (`predecessor`) REFERENCES `detail_product_cost_structure` (`id_detail_product_cost_structure`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_detail_product_cost_structure_product_cost_structure1` FOREIGN KEY (`product_cost_structure`) REFERENCES `product_cost_structure` (`id_product_cost_structure`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of detail_product_cost_structure
-- ----------------------------

-- ----------------------------
-- Table structure for `detail_role`
-- ----------------------------
DROP TABLE IF EXISTS `detail_role`;
CREATE TABLE `detail_role` (
  `id_detail_role` int(11) NOT NULL AUTO_INCREMENT,
  `role` int(11) NOT NULL,
  `action` int(11) NOT NULL,
  PRIMARY KEY (`id_detail_role`),
  KEY `fk_detail_role_role1_idx` (`role`),
  KEY `fk_detail_role_application_action1_idx` (`action`),
  CONSTRAINT `detail_role_ibfk_3` FOREIGN KEY (`role`) REFERENCES `role` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_detail_role_application_action1` FOREIGN KEY (`action`) REFERENCES `application_action` (`id_application_action`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4480 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of detail_role
-- ----------------------------
INSERT INTO `detail_role` VALUES ('9', '10', '1');
INSERT INTO `detail_role` VALUES ('10', '10', '2');
INSERT INTO `detail_role` VALUES ('11', '10', '3');
INSERT INTO `detail_role` VALUES ('12', '10', '4');
INSERT INTO `detail_role` VALUES ('323', '11', '1');
INSERT INTO `detail_role` VALUES ('349', '11', '1');
INSERT INTO `detail_role` VALUES ('350', '11', '1');
INSERT INTO `detail_role` VALUES ('351', '11', '1');
INSERT INTO `detail_role` VALUES ('437', '11', '11');
INSERT INTO `detail_role` VALUES ('438', '11', '12');
INSERT INTO `detail_role` VALUES ('439', '11', '13');
INSERT INTO `detail_role` VALUES ('440', '11', '14');
INSERT INTO `detail_role` VALUES ('441', '11', '15');
INSERT INTO `detail_role` VALUES ('442', '11', '16');
INSERT INTO `detail_role` VALUES ('443', '11', '17');
INSERT INTO `detail_role` VALUES ('444', '11', '18');
INSERT INTO `detail_role` VALUES ('445', '11', '19');
INSERT INTO `detail_role` VALUES ('446', '11', '20');
INSERT INTO `detail_role` VALUES ('447', '11', '21');
INSERT INTO `detail_role` VALUES ('448', '11', '22');
INSERT INTO `detail_role` VALUES ('449', '11', '23');
INSERT INTO `detail_role` VALUES ('450', '11', '24');
INSERT INTO `detail_role` VALUES ('451', '11', '25');
INSERT INTO `detail_role` VALUES ('452', '11', '26');
INSERT INTO `detail_role` VALUES ('453', '11', '27');
INSERT INTO `detail_role` VALUES ('454', '11', '28');
INSERT INTO `detail_role` VALUES ('455', '11', '29');
INSERT INTO `detail_role` VALUES ('456', '11', '30');
INSERT INTO `detail_role` VALUES ('457', '11', '31');
INSERT INTO `detail_role` VALUES ('458', '11', '32');
INSERT INTO `detail_role` VALUES ('459', '11', '33');
INSERT INTO `detail_role` VALUES ('460', '11', '34');
INSERT INTO `detail_role` VALUES ('461', '11', '35');
INSERT INTO `detail_role` VALUES ('462', '11', '36');
INSERT INTO `detail_role` VALUES ('463', '11', '37');
INSERT INTO `detail_role` VALUES ('464', '11', '38');
INSERT INTO `detail_role` VALUES ('465', '11', '39');
INSERT INTO `detail_role` VALUES ('466', '11', '40');
INSERT INTO `detail_role` VALUES ('467', '11', '41');
INSERT INTO `detail_role` VALUES ('468', '11', '43');
INSERT INTO `detail_role` VALUES ('469', '11', '44');
INSERT INTO `detail_role` VALUES ('470', '11', '45');
INSERT INTO `detail_role` VALUES ('471', '11', '46');
INSERT INTO `detail_role` VALUES ('472', '11', '47');
INSERT INTO `detail_role` VALUES ('473', '11', '48');
INSERT INTO `detail_role` VALUES ('474', '11', '49');
INSERT INTO `detail_role` VALUES ('475', '11', '50');
INSERT INTO `detail_role` VALUES ('476', '11', '51');
INSERT INTO `detail_role` VALUES ('477', '11', '57');
INSERT INTO `detail_role` VALUES ('478', '11', '58');
INSERT INTO `detail_role` VALUES ('479', '11', '59');
INSERT INTO `detail_role` VALUES ('480', '11', '60');
INSERT INTO `detail_role` VALUES ('481', '11', '61');
INSERT INTO `detail_role` VALUES ('482', '11', '62');
INSERT INTO `detail_role` VALUES ('483', '11', '63');
INSERT INTO `detail_role` VALUES ('484', '11', '64');
INSERT INTO `detail_role` VALUES ('485', '11', '65');
INSERT INTO `detail_role` VALUES ('486', '11', '66');
INSERT INTO `detail_role` VALUES ('487', '11', '67');
INSERT INTO `detail_role` VALUES ('488', '11', '68');
INSERT INTO `detail_role` VALUES ('489', '11', '69');
INSERT INTO `detail_role` VALUES ('490', '11', '70');
INSERT INTO `detail_role` VALUES ('491', '11', '71');
INSERT INTO `detail_role` VALUES ('492', '11', '72');
INSERT INTO `detail_role` VALUES ('493', '11', '73');
INSERT INTO `detail_role` VALUES ('494', '11', '74');
INSERT INTO `detail_role` VALUES ('495', '11', '75');
INSERT INTO `detail_role` VALUES ('496', '11', '76');
INSERT INTO `detail_role` VALUES ('497', '11', '77');
INSERT INTO `detail_role` VALUES ('498', '11', '78');
INSERT INTO `detail_role` VALUES ('499', '11', '79');
INSERT INTO `detail_role` VALUES ('500', '11', '80');
INSERT INTO `detail_role` VALUES ('501', '11', '81');
INSERT INTO `detail_role` VALUES ('502', '11', '82');
INSERT INTO `detail_role` VALUES ('503', '11', '83');
INSERT INTO `detail_role` VALUES ('504', '11', '84');
INSERT INTO `detail_role` VALUES ('505', '11', '85');
INSERT INTO `detail_role` VALUES ('506', '11', '86');
INSERT INTO `detail_role` VALUES ('507', '11', '87');
INSERT INTO `detail_role` VALUES ('508', '11', '88');
INSERT INTO `detail_role` VALUES ('509', '11', '89');
INSERT INTO `detail_role` VALUES ('510', '11', '90');
INSERT INTO `detail_role` VALUES ('511', '11', '91');
INSERT INTO `detail_role` VALUES ('512', '11', '92');
INSERT INTO `detail_role` VALUES ('513', '11', '93');
INSERT INTO `detail_role` VALUES ('514', '11', '94');
INSERT INTO `detail_role` VALUES ('515', '11', '95');
INSERT INTO `detail_role` VALUES ('516', '11', '96');
INSERT INTO `detail_role` VALUES ('517', '11', '97');
INSERT INTO `detail_role` VALUES ('518', '11', '98');
INSERT INTO `detail_role` VALUES ('519', '11', '1');
INSERT INTO `detail_role` VALUES ('520', '11', '2');
INSERT INTO `detail_role` VALUES ('521', '11', '3');
INSERT INTO `detail_role` VALUES ('522', '11', '4');
INSERT INTO `detail_role` VALUES ('523', '11', '5');
INSERT INTO `detail_role` VALUES ('524', '11', '6');
INSERT INTO `detail_role` VALUES ('525', '11', '7');
INSERT INTO `detail_role` VALUES ('526', '11', '8');
INSERT INTO `detail_role` VALUES ('527', '11', '9');
INSERT INTO `detail_role` VALUES ('528', '11', '10');
INSERT INTO `detail_role` VALUES ('529', '11', '99');
INSERT INTO `detail_role` VALUES ('4118', '1', '1');
INSERT INTO `detail_role` VALUES ('4119', '1', '2');
INSERT INTO `detail_role` VALUES ('4120', '1', '3');
INSERT INTO `detail_role` VALUES ('4121', '1', '4');
INSERT INTO `detail_role` VALUES ('4122', '1', '5');
INSERT INTO `detail_role` VALUES ('4123', '1', '6');
INSERT INTO `detail_role` VALUES ('4124', '1', '7');
INSERT INTO `detail_role` VALUES ('4125', '1', '8');
INSERT INTO `detail_role` VALUES ('4126', '1', '9');
INSERT INTO `detail_role` VALUES ('4127', '1', '10');
INSERT INTO `detail_role` VALUES ('4128', '1', '11');
INSERT INTO `detail_role` VALUES ('4129', '1', '12');
INSERT INTO `detail_role` VALUES ('4130', '1', '13');
INSERT INTO `detail_role` VALUES ('4131', '1', '14');
INSERT INTO `detail_role` VALUES ('4132', '1', '15');
INSERT INTO `detail_role` VALUES ('4133', '1', '16');
INSERT INTO `detail_role` VALUES ('4134', '1', '17');
INSERT INTO `detail_role` VALUES ('4135', '1', '18');
INSERT INTO `detail_role` VALUES ('4136', '1', '19');
INSERT INTO `detail_role` VALUES ('4137', '1', '20');
INSERT INTO `detail_role` VALUES ('4138', '1', '21');
INSERT INTO `detail_role` VALUES ('4139', '1', '22');
INSERT INTO `detail_role` VALUES ('4140', '1', '23');
INSERT INTO `detail_role` VALUES ('4141', '1', '24');
INSERT INTO `detail_role` VALUES ('4142', '1', '25');
INSERT INTO `detail_role` VALUES ('4143', '1', '26');
INSERT INTO `detail_role` VALUES ('4144', '1', '27');
INSERT INTO `detail_role` VALUES ('4145', '1', '28');
INSERT INTO `detail_role` VALUES ('4146', '1', '29');
INSERT INTO `detail_role` VALUES ('4147', '1', '30');
INSERT INTO `detail_role` VALUES ('4148', '1', '31');
INSERT INTO `detail_role` VALUES ('4149', '1', '32');
INSERT INTO `detail_role` VALUES ('4150', '1', '33');
INSERT INTO `detail_role` VALUES ('4151', '1', '34');
INSERT INTO `detail_role` VALUES ('4152', '1', '35');
INSERT INTO `detail_role` VALUES ('4153', '1', '36');
INSERT INTO `detail_role` VALUES ('4154', '1', '37');
INSERT INTO `detail_role` VALUES ('4155', '1', '38');
INSERT INTO `detail_role` VALUES ('4156', '1', '39');
INSERT INTO `detail_role` VALUES ('4157', '1', '40');
INSERT INTO `detail_role` VALUES ('4158', '1', '41');
INSERT INTO `detail_role` VALUES ('4159', '1', '43');
INSERT INTO `detail_role` VALUES ('4160', '1', '44');
INSERT INTO `detail_role` VALUES ('4161', '1', '45');
INSERT INTO `detail_role` VALUES ('4162', '1', '46');
INSERT INTO `detail_role` VALUES ('4163', '1', '47');
INSERT INTO `detail_role` VALUES ('4164', '1', '48');
INSERT INTO `detail_role` VALUES ('4165', '1', '49');
INSERT INTO `detail_role` VALUES ('4166', '1', '50');
INSERT INTO `detail_role` VALUES ('4167', '1', '51');
INSERT INTO `detail_role` VALUES ('4168', '1', '57');
INSERT INTO `detail_role` VALUES ('4169', '1', '58');
INSERT INTO `detail_role` VALUES ('4170', '1', '59');
INSERT INTO `detail_role` VALUES ('4171', '1', '60');
INSERT INTO `detail_role` VALUES ('4172', '1', '61');
INSERT INTO `detail_role` VALUES ('4173', '1', '62');
INSERT INTO `detail_role` VALUES ('4174', '1', '63');
INSERT INTO `detail_role` VALUES ('4175', '1', '64');
INSERT INTO `detail_role` VALUES ('4176', '1', '65');
INSERT INTO `detail_role` VALUES ('4177', '1', '66');
INSERT INTO `detail_role` VALUES ('4178', '1', '67');
INSERT INTO `detail_role` VALUES ('4179', '1', '68');
INSERT INTO `detail_role` VALUES ('4180', '1', '69');
INSERT INTO `detail_role` VALUES ('4181', '1', '70');
INSERT INTO `detail_role` VALUES ('4182', '1', '71');
INSERT INTO `detail_role` VALUES ('4183', '1', '72');
INSERT INTO `detail_role` VALUES ('4184', '1', '73');
INSERT INTO `detail_role` VALUES ('4185', '1', '74');
INSERT INTO `detail_role` VALUES ('4186', '1', '75');
INSERT INTO `detail_role` VALUES ('4187', '1', '76');
INSERT INTO `detail_role` VALUES ('4188', '1', '77');
INSERT INTO `detail_role` VALUES ('4189', '1', '78');
INSERT INTO `detail_role` VALUES ('4190', '1', '79');
INSERT INTO `detail_role` VALUES ('4191', '1', '80');
INSERT INTO `detail_role` VALUES ('4192', '1', '81');
INSERT INTO `detail_role` VALUES ('4193', '1', '82');
INSERT INTO `detail_role` VALUES ('4194', '1', '83');
INSERT INTO `detail_role` VALUES ('4195', '1', '84');
INSERT INTO `detail_role` VALUES ('4196', '1', '85');
INSERT INTO `detail_role` VALUES ('4197', '1', '86');
INSERT INTO `detail_role` VALUES ('4198', '1', '87');
INSERT INTO `detail_role` VALUES ('4199', '1', '88');
INSERT INTO `detail_role` VALUES ('4200', '1', '89');
INSERT INTO `detail_role` VALUES ('4201', '1', '90');
INSERT INTO `detail_role` VALUES ('4202', '1', '91');
INSERT INTO `detail_role` VALUES ('4203', '1', '92');
INSERT INTO `detail_role` VALUES ('4204', '1', '93');
INSERT INTO `detail_role` VALUES ('4205', '1', '94');
INSERT INTO `detail_role` VALUES ('4206', '1', '95');
INSERT INTO `detail_role` VALUES ('4207', '1', '96');
INSERT INTO `detail_role` VALUES ('4208', '1', '97');
INSERT INTO `detail_role` VALUES ('4209', '1', '98');
INSERT INTO `detail_role` VALUES ('4210', '1', '99');
INSERT INTO `detail_role` VALUES ('4211', '1', '100');
INSERT INTO `detail_role` VALUES ('4212', '1', '101');
INSERT INTO `detail_role` VALUES ('4213', '1', '102');
INSERT INTO `detail_role` VALUES ('4214', '1', '103');
INSERT INTO `detail_role` VALUES ('4215', '1', '104');
INSERT INTO `detail_role` VALUES ('4216', '1', '105');
INSERT INTO `detail_role` VALUES ('4217', '1', '106');
INSERT INTO `detail_role` VALUES ('4218', '1', '107');
INSERT INTO `detail_role` VALUES ('4219', '1', '108');
INSERT INTO `detail_role` VALUES ('4220', '1', '109');
INSERT INTO `detail_role` VALUES ('4221', '1', '110');
INSERT INTO `detail_role` VALUES ('4222', '1', '111');
INSERT INTO `detail_role` VALUES ('4223', '1', '112');
INSERT INTO `detail_role` VALUES ('4224', '1', '113');
INSERT INTO `detail_role` VALUES ('4225', '1', '114');
INSERT INTO `detail_role` VALUES ('4226', '1', '115');
INSERT INTO `detail_role` VALUES ('4227', '1', '116');
INSERT INTO `detail_role` VALUES ('4228', '1', '117');
INSERT INTO `detail_role` VALUES ('4229', '1', '118');
INSERT INTO `detail_role` VALUES ('4230', '1', '119');
INSERT INTO `detail_role` VALUES ('4231', '1', '120');
INSERT INTO `detail_role` VALUES ('4232', '1', '121');
INSERT INTO `detail_role` VALUES ('4233', '1', '122');
INSERT INTO `detail_role` VALUES ('4234', '1', '123');
INSERT INTO `detail_role` VALUES ('4235', '1', '124');
INSERT INTO `detail_role` VALUES ('4236', '1', '125');
INSERT INTO `detail_role` VALUES ('4237', '1', '126');
INSERT INTO `detail_role` VALUES ('4238', '1', '127');
INSERT INTO `detail_role` VALUES ('4239', '1', '128');
INSERT INTO `detail_role` VALUES ('4240', '1', '129');
INSERT INTO `detail_role` VALUES ('4241', '1', '130');
INSERT INTO `detail_role` VALUES ('4242', '1', '131');
INSERT INTO `detail_role` VALUES ('4243', '1', '132');
INSERT INTO `detail_role` VALUES ('4244', '1', '133');
INSERT INTO `detail_role` VALUES ('4245', '1', '134');
INSERT INTO `detail_role` VALUES ('4246', '1', '135');
INSERT INTO `detail_role` VALUES ('4247', '1', '136');
INSERT INTO `detail_role` VALUES ('4248', '1', '137');
INSERT INTO `detail_role` VALUES ('4249', '1', '138');
INSERT INTO `detail_role` VALUES ('4250', '1', '139');
INSERT INTO `detail_role` VALUES ('4251', '1', '140');
INSERT INTO `detail_role` VALUES ('4252', '1', '141');
INSERT INTO `detail_role` VALUES ('4253', '1', '142');
INSERT INTO `detail_role` VALUES ('4254', '1', '143');
INSERT INTO `detail_role` VALUES ('4255', '1', '144');
INSERT INTO `detail_role` VALUES ('4256', '1', '145');
INSERT INTO `detail_role` VALUES ('4257', '1', '146');
INSERT INTO `detail_role` VALUES ('4258', '1', '147');
INSERT INTO `detail_role` VALUES ('4259', '1', '148');
INSERT INTO `detail_role` VALUES ('4260', '1', '149');
INSERT INTO `detail_role` VALUES ('4261', '1', '150');
INSERT INTO `detail_role` VALUES ('4262', '1', '151');
INSERT INTO `detail_role` VALUES ('4263', '1', '152');
INSERT INTO `detail_role` VALUES ('4264', '1', '153');
INSERT INTO `detail_role` VALUES ('4265', '1', '154');
INSERT INTO `detail_role` VALUES ('4266', '1', '155');
INSERT INTO `detail_role` VALUES ('4267', '1', '156');
INSERT INTO `detail_role` VALUES ('4268', '1', '157');
INSERT INTO `detail_role` VALUES ('4269', '1', '158');
INSERT INTO `detail_role` VALUES ('4270', '1', '159');
INSERT INTO `detail_role` VALUES ('4271', '1', '160');
INSERT INTO `detail_role` VALUES ('4272', '1', '161');
INSERT INTO `detail_role` VALUES ('4273', '1', '162');
INSERT INTO `detail_role` VALUES ('4274', '1', '163');
INSERT INTO `detail_role` VALUES ('4275', '1', '164');
INSERT INTO `detail_role` VALUES ('4276', '1', '165');
INSERT INTO `detail_role` VALUES ('4277', '1', '166');
INSERT INTO `detail_role` VALUES ('4278', '1', '167');
INSERT INTO `detail_role` VALUES ('4279', '1', '168');
INSERT INTO `detail_role` VALUES ('4280', '1', '169');
INSERT INTO `detail_role` VALUES ('4281', '1', '170');
INSERT INTO `detail_role` VALUES ('4282', '1', '171');
INSERT INTO `detail_role` VALUES ('4283', '1', '172');
INSERT INTO `detail_role` VALUES ('4284', '1', '173');
INSERT INTO `detail_role` VALUES ('4285', '1', '174');
INSERT INTO `detail_role` VALUES ('4286', '1', '175');
INSERT INTO `detail_role` VALUES ('4287', '1', '176');
INSERT INTO `detail_role` VALUES ('4288', '1', '177');
INSERT INTO `detail_role` VALUES ('4289', '1', '178');
INSERT INTO `detail_role` VALUES ('4290', '1', '179');
INSERT INTO `detail_role` VALUES ('4291', '1', '180');
INSERT INTO `detail_role` VALUES ('4292', '1', '181');
INSERT INTO `detail_role` VALUES ('4293', '1', '182');
INSERT INTO `detail_role` VALUES ('4294', '1', '183');
INSERT INTO `detail_role` VALUES ('4295', '1', '184');
INSERT INTO `detail_role` VALUES ('4296', '1', '185');
INSERT INTO `detail_role` VALUES ('4297', '1', '186');
INSERT INTO `detail_role` VALUES ('4298', '1', '187');
INSERT INTO `detail_role` VALUES ('4299', '1', '188');
INSERT INTO `detail_role` VALUES ('4300', '1', '189');
INSERT INTO `detail_role` VALUES ('4301', '1', '190');
INSERT INTO `detail_role` VALUES ('4302', '1', '191');
INSERT INTO `detail_role` VALUES ('4303', '1', '192');
INSERT INTO `detail_role` VALUES ('4304', '1', '193');
INSERT INTO `detail_role` VALUES ('4305', '1', '194');
INSERT INTO `detail_role` VALUES ('4306', '1', '195');
INSERT INTO `detail_role` VALUES ('4307', '1', '196');
INSERT INTO `detail_role` VALUES ('4308', '1', '197');
INSERT INTO `detail_role` VALUES ('4309', '1', '198');
INSERT INTO `detail_role` VALUES ('4310', '1', '199');
INSERT INTO `detail_role` VALUES ('4311', '1', '200');
INSERT INTO `detail_role` VALUES ('4312', '1', '201');
INSERT INTO `detail_role` VALUES ('4313', '1', '202');
INSERT INTO `detail_role` VALUES ('4314', '1', '203');
INSERT INTO `detail_role` VALUES ('4315', '1', '204');
INSERT INTO `detail_role` VALUES ('4316', '1', '205');
INSERT INTO `detail_role` VALUES ('4317', '1', '206');
INSERT INTO `detail_role` VALUES ('4318', '1', '207');
INSERT INTO `detail_role` VALUES ('4319', '1', '208');
INSERT INTO `detail_role` VALUES ('4320', '1', '209');
INSERT INTO `detail_role` VALUES ('4321', '1', '210');
INSERT INTO `detail_role` VALUES ('4322', '1', '211');
INSERT INTO `detail_role` VALUES ('4323', '1', '212');
INSERT INTO `detail_role` VALUES ('4324', '1', '213');
INSERT INTO `detail_role` VALUES ('4325', '1', '214');
INSERT INTO `detail_role` VALUES ('4326', '1', '215');
INSERT INTO `detail_role` VALUES ('4327', '1', '216');
INSERT INTO `detail_role` VALUES ('4328', '1', '217');
INSERT INTO `detail_role` VALUES ('4329', '1', '218');
INSERT INTO `detail_role` VALUES ('4330', '1', '219');
INSERT INTO `detail_role` VALUES ('4331', '1', '220');
INSERT INTO `detail_role` VALUES ('4332', '1', '221');
INSERT INTO `detail_role` VALUES ('4333', '1', '222');
INSERT INTO `detail_role` VALUES ('4334', '1', '223');
INSERT INTO `detail_role` VALUES ('4335', '1', '224');
INSERT INTO `detail_role` VALUES ('4336', '1', '225');
INSERT INTO `detail_role` VALUES ('4337', '1', '226');
INSERT INTO `detail_role` VALUES ('4338', '1', '227');
INSERT INTO `detail_role` VALUES ('4339', '1', '228');
INSERT INTO `detail_role` VALUES ('4340', '1', '229');
INSERT INTO `detail_role` VALUES ('4341', '1', '230');
INSERT INTO `detail_role` VALUES ('4342', '1', '231');
INSERT INTO `detail_role` VALUES ('4343', '1', '232');
INSERT INTO `detail_role` VALUES ('4344', '1', '233');
INSERT INTO `detail_role` VALUES ('4345', '1', '234');
INSERT INTO `detail_role` VALUES ('4346', '1', '235');
INSERT INTO `detail_role` VALUES ('4347', '1', '236');
INSERT INTO `detail_role` VALUES ('4348', '1', '237');
INSERT INTO `detail_role` VALUES ('4349', '1', '238');
INSERT INTO `detail_role` VALUES ('4350', '1', '239');
INSERT INTO `detail_role` VALUES ('4351', '1', '240');
INSERT INTO `detail_role` VALUES ('4352', '1', '241');
INSERT INTO `detail_role` VALUES ('4353', '1', '242');
INSERT INTO `detail_role` VALUES ('4354', '1', '243');
INSERT INTO `detail_role` VALUES ('4355', '1', '244');
INSERT INTO `detail_role` VALUES ('4356', '1', '245');
INSERT INTO `detail_role` VALUES ('4357', '1', '246');
INSERT INTO `detail_role` VALUES ('4358', '1', '247');
INSERT INTO `detail_role` VALUES ('4359', '1', '248');
INSERT INTO `detail_role` VALUES ('4360', '1', '249');
INSERT INTO `detail_role` VALUES ('4361', '1', '250');
INSERT INTO `detail_role` VALUES ('4362', '1', '251');
INSERT INTO `detail_role` VALUES ('4363', '1', '252');
INSERT INTO `detail_role` VALUES ('4364', '1', '253');
INSERT INTO `detail_role` VALUES ('4365', '1', '254');
INSERT INTO `detail_role` VALUES ('4366', '1', '255');
INSERT INTO `detail_role` VALUES ('4367', '1', '256');
INSERT INTO `detail_role` VALUES ('4368', '1', '257');
INSERT INTO `detail_role` VALUES ('4369', '1', '258');
INSERT INTO `detail_role` VALUES ('4370', '1', '259');
INSERT INTO `detail_role` VALUES ('4371', '1', '260');
INSERT INTO `detail_role` VALUES ('4372', '1', '261');
INSERT INTO `detail_role` VALUES ('4373', '1', '262');
INSERT INTO `detail_role` VALUES ('4374', '1', '263');
INSERT INTO `detail_role` VALUES ('4375', '1', '264');
INSERT INTO `detail_role` VALUES ('4376', '1', '265');
INSERT INTO `detail_role` VALUES ('4377', '1', '267');
INSERT INTO `detail_role` VALUES ('4378', '1', '266');
INSERT INTO `detail_role` VALUES ('4379', '1', '268');
INSERT INTO `detail_role` VALUES ('4380', '1', '269');
INSERT INTO `detail_role` VALUES ('4381', '1', '270');
INSERT INTO `detail_role` VALUES ('4382', '1', '271');
INSERT INTO `detail_role` VALUES ('4383', '1', '272');
INSERT INTO `detail_role` VALUES ('4384', '1', '273');
INSERT INTO `detail_role` VALUES ('4385', '1', '274');
INSERT INTO `detail_role` VALUES ('4386', '1', '275');
INSERT INTO `detail_role` VALUES ('4387', '1', '276');
INSERT INTO `detail_role` VALUES ('4388', '1', '277');
INSERT INTO `detail_role` VALUES ('4389', '1', '278');
INSERT INTO `detail_role` VALUES ('4390', '1', '279');
INSERT INTO `detail_role` VALUES ('4391', '1', '280');
INSERT INTO `detail_role` VALUES ('4392', '1', '281');
INSERT INTO `detail_role` VALUES ('4393', '1', '282');
INSERT INTO `detail_role` VALUES ('4394', '1', '283');
INSERT INTO `detail_role` VALUES ('4395', '1', '284');
INSERT INTO `detail_role` VALUES ('4396', '1', '293');
INSERT INTO `detail_role` VALUES ('4397', '1', '294');
INSERT INTO `detail_role` VALUES ('4398', '1', '295');
INSERT INTO `detail_role` VALUES ('4399', '1', '296');
INSERT INTO `detail_role` VALUES ('4400', '1', '297');
INSERT INTO `detail_role` VALUES ('4401', '1', '298');
INSERT INTO `detail_role` VALUES ('4402', '1', '299');
INSERT INTO `detail_role` VALUES ('4403', '1', '300');
INSERT INTO `detail_role` VALUES ('4404', '1', '301');
INSERT INTO `detail_role` VALUES ('4405', '1', '302');
INSERT INTO `detail_role` VALUES ('4406', '1', '303');
INSERT INTO `detail_role` VALUES ('4407', '1', '304');
INSERT INTO `detail_role` VALUES ('4408', '1', '305');
INSERT INTO `detail_role` VALUES ('4409', '1', '306');
INSERT INTO `detail_role` VALUES ('4410', '1', '307');
INSERT INTO `detail_role` VALUES ('4411', '1', '308');
INSERT INTO `detail_role` VALUES ('4412', '1', '309');
INSERT INTO `detail_role` VALUES ('4413', '1', '310');
INSERT INTO `detail_role` VALUES ('4414', '1', '311');
INSERT INTO `detail_role` VALUES ('4415', '1', '312');
INSERT INTO `detail_role` VALUES ('4416', '1', '313');
INSERT INTO `detail_role` VALUES ('4417', '1', '314');
INSERT INTO `detail_role` VALUES ('4418', '1', '315');
INSERT INTO `detail_role` VALUES ('4419', '1', '316');
INSERT INTO `detail_role` VALUES ('4420', '1', '317');
INSERT INTO `detail_role` VALUES ('4421', '1', '318');
INSERT INTO `detail_role` VALUES ('4422', '1', '292');
INSERT INTO `detail_role` VALUES ('4423', '1', '320');
INSERT INTO `detail_role` VALUES ('4424', '1', '321');
INSERT INTO `detail_role` VALUES ('4425', '1', '322');
INSERT INTO `detail_role` VALUES ('4426', '1', '323');
INSERT INTO `detail_role` VALUES ('4427', '1', '319');
INSERT INTO `detail_role` VALUES ('4428', '1', '342');
INSERT INTO `detail_role` VALUES ('4429', '1', '343');
INSERT INTO `detail_role` VALUES ('4430', '1', '344');
INSERT INTO `detail_role` VALUES ('4431', '1', '345');
INSERT INTO `detail_role` VALUES ('4432', '1', '346');
INSERT INTO `detail_role` VALUES ('4433', '1', '347');
INSERT INTO `detail_role` VALUES ('4434', '1', '348');
INSERT INTO `detail_role` VALUES ('4435', '1', '349');
INSERT INTO `detail_role` VALUES ('4436', '1', '350');
INSERT INTO `detail_role` VALUES ('4437', '1', '351');
INSERT INTO `detail_role` VALUES ('4438', '1', '352');
INSERT INTO `detail_role` VALUES ('4439', '1', '353');
INSERT INTO `detail_role` VALUES ('4440', '1', '354');
INSERT INTO `detail_role` VALUES ('4441', '1', '355');
INSERT INTO `detail_role` VALUES ('4442', '1', '356');
INSERT INTO `detail_role` VALUES ('4443', '1', '357');
INSERT INTO `detail_role` VALUES ('4444', '1', '358');
INSERT INTO `detail_role` VALUES ('4445', '1', '359');
INSERT INTO `detail_role` VALUES ('4446', '1', '360');
INSERT INTO `detail_role` VALUES ('4447', '1', '361');
INSERT INTO `detail_role` VALUES ('4448', '1', '362');
INSERT INTO `detail_role` VALUES ('4449', '1', '363');
INSERT INTO `detail_role` VALUES ('4450', '1', '364');
INSERT INTO `detail_role` VALUES ('4451', '1', '365');
INSERT INTO `detail_role` VALUES ('4452', '1', '366');
INSERT INTO `detail_role` VALUES ('4453', '1', '367');
INSERT INTO `detail_role` VALUES ('4454', '1', '368');
INSERT INTO `detail_role` VALUES ('4455', '1', '369');
INSERT INTO `detail_role` VALUES ('4456', '1', '370');
INSERT INTO `detail_role` VALUES ('4457', '1', '371');
INSERT INTO `detail_role` VALUES ('4458', '1', '372');
INSERT INTO `detail_role` VALUES ('4459', '1', '347');
INSERT INTO `detail_role` VALUES ('4460', '1', '374');
INSERT INTO `detail_role` VALUES ('4461', '1', '375');
INSERT INTO `detail_role` VALUES ('4462', '1', '376');
INSERT INTO `detail_role` VALUES ('4463', '1', '377');
INSERT INTO `detail_role` VALUES ('4464', '1', '378');
INSERT INTO `detail_role` VALUES ('4465', '1', '379');
INSERT INTO `detail_role` VALUES ('4466', '1', '380');
INSERT INTO `detail_role` VALUES ('4467', '1', '381');
INSERT INTO `detail_role` VALUES ('4468', '1', '382');
INSERT INTO `detail_role` VALUES ('4469', '1', '383');
INSERT INTO `detail_role` VALUES ('4470', '1', '384');
INSERT INTO `detail_role` VALUES ('4471', '1', '385');
INSERT INTO `detail_role` VALUES ('4472', '1', '386');
INSERT INTO `detail_role` VALUES ('4473', '1', '387');
INSERT INTO `detail_role` VALUES ('4474', '1', '388');
INSERT INTO `detail_role` VALUES ('4475', '1', '389');
INSERT INTO `detail_role` VALUES ('4476', '1', '390');
INSERT INTO `detail_role` VALUES ('4477', '1', '391');
INSERT INTO `detail_role` VALUES ('4478', '1', '392');
INSERT INTO `detail_role` VALUES ('4479', '1', '393');

-- ----------------------------
-- Table structure for `detail_so_assignment`
-- ----------------------------
DROP TABLE IF EXISTS `detail_so_assignment`;
CREATE TABLE `detail_so_assignment` (
  `id_detail_so_assignment` int(11) NOT NULL AUTO_INCREMENT,
  `so_assignment` int(11) NOT NULL,
  `detail_work_schedule` int(11) NOT NULL,
  `employee` int(11) NOT NULL,
  PRIMARY KEY (`id_detail_so_assignment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of detail_so_assignment
-- ----------------------------

-- ----------------------------
-- Table structure for `detail_uda`
-- ----------------------------
DROP TABLE IF EXISTS `detail_uda`;
CREATE TABLE `detail_uda` (
  `id_detail_uda` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `data_type` varchar(20) NOT NULL,
  `value` varchar(50) NOT NULL,
  `uda` int(11) NOT NULL,
  PRIMARY KEY (`id_detail_uda`),
  KEY `fk_detail_uda_uda1_idx` (`uda`),
  CONSTRAINT `fk_detail_uda_uda1` FOREIGN KEY (`uda`) REFERENCES `uda` (`id_uda`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of detail_uda
-- ----------------------------

-- ----------------------------
-- Table structure for `detail_work_schedule`
-- ----------------------------
DROP TABLE IF EXISTS `detail_work_schedule`;
CREATE TABLE `detail_work_schedule` (
  `id_detail_work_schedule` int(11) NOT NULL AUTO_INCREMENT,
  `work_schedule` int(11) NOT NULL,
  `site` int(11) NOT NULL,
  `area` varchar(45) NOT NULL,
  `shift` varchar(2) NOT NULL,
  `working_hour` varchar(45) NOT NULL,
  `structure` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `remark` text,
  PRIMARY KEY (`id_detail_work_schedule`),
  KEY `fk_detail_work_schedule_work_schedule1_idx` (`work_schedule`),
  KEY `fk_detail_work_schedule_customer_site1_idx` (`site`),
  CONSTRAINT `fk_detail_work_schedule_customer_site1` FOREIGN KEY (`site`) REFERENCES `customer_site` (`id_customer_site`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_detail_work_schedule_work_schedule1` FOREIGN KEY (`work_schedule`) REFERENCES `work_schedule` (`id_work_schedule`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of detail_work_schedule
-- ----------------------------
INSERT INTO `detail_work_schedule` VALUES ('1', '1', '1', 'Jakarta', '1', '8', '2', '0', '');
INSERT INTO `detail_work_schedule` VALUES ('2', '2', '1', 'Gerbang Depan', '2', '8', '2', '12', '');
INSERT INTO `detail_work_schedule` VALUES ('3', '3', '1', 'Office', '1', '8', '9', '1', '');
INSERT INTO `detail_work_schedule` VALUES ('4', '3', '1', 'Depan', '1', '12', '11', '2', '');
INSERT INTO `detail_work_schedule` VALUES ('5', '3', '1', 'Office', '1', '8', '10', '1', '');
INSERT INTO `detail_work_schedule` VALUES ('6', '3', '1', 'Depan', '2', '12', '11', '2', '');
INSERT INTO `detail_work_schedule` VALUES ('7', '4', '1', 'Office', '1', '12', '10', '1', '');
INSERT INTO `detail_work_schedule` VALUES ('8', '4', '1', 'Depan', '1', '12', '11', '2', '');
INSERT INTO `detail_work_schedule` VALUES ('9', '4', '1', 'Office', '1', '12', '11', '1', '');
INSERT INTO `detail_work_schedule` VALUES ('10', '4', '1', 'Office', '1', '12', '9', '1', '');
INSERT INTO `detail_work_schedule` VALUES ('11', '4', '1', 'Depan', '2', '12', '11', '1', '');
INSERT INTO `detail_work_schedule` VALUES ('12', '4', '1', 'Office', '2', '12', '10', '1', '');
INSERT INTO `detail_work_schedule` VALUES ('13', '4', '1', 'Office', '2', '12', '11', '1', '');

-- ----------------------------
-- Table structure for `division`
-- ----------------------------
DROP TABLE IF EXISTS `division`;
CREATE TABLE `division` (
  `id_division` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `abbreviation` varchar(3) NOT NULL,
  PRIMARY KEY (`id_division`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of division
-- ----------------------------
INSERT INTO `division` VALUES ('2', 'Marketing', 'MK');
INSERT INTO `division` VALUES ('3', 'Engineering', 'ENG');
INSERT INTO `division` VALUES ('4', 'PPIC', 'PPC');
INSERT INTO `division` VALUES ('5', 'Purchasing', 'PUR');
INSERT INTO `division` VALUES ('6', 'Production', 'PRD');
INSERT INTO `division` VALUES ('7', 'Delivery', 'DEL');
INSERT INTO `division` VALUES ('8', 'Finance', 'FI');
INSERT INTO `division` VALUES ('9', 'Administrator', 'adm');

-- ----------------------------
-- Table structure for `dn`
-- ----------------------------
DROP TABLE IF EXISTS `dn`;
CREATE TABLE `dn` (
  `id_dn` int(11) NOT NULL AUTO_INCREMENT,
  `so` int(11) NOT NULL,
  `no_dn` varchar(20) NOT NULL,
  `note` text,
  `date` date NOT NULL,
  `status` varchar(45) NOT NULL,
  PRIMARY KEY (`id_dn`),
  KEY `fk_dn_so1_idx` (`so`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of dn
-- ----------------------------

-- ----------------------------
-- Table structure for `dn_product`
-- ----------------------------
DROP TABLE IF EXISTS `dn_product`;
CREATE TABLE `dn_product` (
  `id_dn_product` int(11) NOT NULL AUTO_INCREMENT,
  `dn` int(11) NOT NULL,
  `product` bigint(20) NOT NULL,
  `qty` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id_dn_product`),
  KEY `fk_dn_product_dn1_idx` (`dn`),
  KEY `fk_dn_product_product1_idx` (`product`),
  CONSTRAINT `fk_dn_product_dn1` FOREIGN KEY (`dn`) REFERENCES `dn` (`id_dn`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_dn_product_product1` FOREIGN KEY (`product`) REFERENCES `product` (`id_product`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of dn_product
-- ----------------------------

-- ----------------------------
-- Table structure for `education_level`
-- ----------------------------
DROP TABLE IF EXISTS `education_level`;
CREATE TABLE `education_level` (
  `id_education_level` int(11) NOT NULL AUTO_INCREMENT,
  `level_name` varchar(45) NOT NULL,
  PRIMARY KEY (`id_education_level`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of education_level
-- ----------------------------
INSERT INTO `education_level` VALUES ('1', 'SD');
INSERT INTO `education_level` VALUES ('2', 'SMP');
INSERT INTO `education_level` VALUES ('3', 'SMA');
INSERT INTO `education_level` VALUES ('4', 'D3');
INSERT INTO `education_level` VALUES ('5', 'S1');
INSERT INTO `education_level` VALUES ('6', 'S2');
INSERT INTO `education_level` VALUES ('7', 'S3');

-- ----------------------------
-- Table structure for `employee`
-- ----------------------------
DROP TABLE IF EXISTS `employee`;
CREATE TABLE `employee` (
  `id_employee` int(11) NOT NULL AUTO_INCREMENT,
  `employment_type` int(11) NOT NULL,
  `employee_number` bigint(20) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `employee_status` int(11) NOT NULL,
  `employee_contract_type` int(11) NOT NULL,
  `birth_city` int(11) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `religion` int(11) DEFAULT NULL,
  `gender` varchar(45) DEFAULT NULL,
  `blood_type` varchar(3) DEFAULT NULL,
  `height` float DEFAULT NULL,
  `weight` float DEFAULT NULL,
  `hobbies` text,
  `tax_status` int(11) DEFAULT NULL,
  `marital_status` varchar(10) DEFAULT NULL,
  `father_name` varchar(45) DEFAULT NULL,
  `mother_name` varchar(45) DEFAULT NULL,
  `marital_date` date DEFAULT NULL,
  `native` varchar(45) DEFAULT NULL,
  `npwp` varchar(45) DEFAULT NULL,
  `npwp_date` date DEFAULT NULL,
  `bpjs` varchar(45) DEFAULT NULL,
  `bpjs_date` date DEFAULT NULL,
  `jamsostek` varchar(45) DEFAULT NULL,
  `jamsostek_date` date DEFAULT NULL,
  `rekening` varchar(45) DEFAULT NULL,
  `bank` int(11) DEFAULT NULL,
  `photo_path` varchar(45) DEFAULT NULL,
  `position_level` int(11) DEFAULT NULL,
  `organisation_structure_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_employee`),
  KEY `fk_employee_employee_status1_idx` (`employee_status`),
  KEY `fk_employee_employment_type1_idx` (`employment_type`),
  KEY `fk_employee_employee_contract_type1_idx` (`employee_contract_type`),
  KEY `fk_employee_city2_idx` (`birth_city`),
  KEY `fk_employee_religion1_idx` (`religion`),
  KEY `fk_employee_bank1_idx` (`bank`),
  KEY `fk_position_level` (`position_level`),
  CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`bank`) REFERENCES `bank` (`id_bank`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `employee_ibfk_2` FOREIGN KEY (`birth_city`) REFERENCES `city` (`id_city`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `employee_ibfk_3` FOREIGN KEY (`employee_contract_type`) REFERENCES `employee_contract_type` (`id_employee_contract_type`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `employee_ibfk_4` FOREIGN KEY (`employee_status`) REFERENCES `employee_status` (`id_employee_status`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `employee_ibfk_5` FOREIGN KEY (`employment_type`) REFERENCES `employment_type` (`id_employment_type`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `employee_ibfk_6` FOREIGN KEY (`religion`) REFERENCES `religion` (`id_religion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `employee_ibfk_7` FOREIGN KEY (`position_level`) REFERENCES `position_level` (`id_position_level`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of employee
-- ----------------------------
INSERT INTO `employee` VALUES ('3', '2', '0', 'Security 1', '1', '1', '3', '2015-02-27', '1', null, 'ab', '3123', '2131', null, null, null, null, null, null, 'Sdsa', null, null, null, null, null, null, null, null, null, '3', '11');
INSERT INTO `employee` VALUES ('4', '1', '0', 'Security 2', '1', '1', '499', '2015-03-01', '1', 'male', 'o', '222', '333', null, null, null, null, null, null, 'Betawi', null, null, null, null, null, null, null, null, null, '2', '11');
INSERT INTO `employee` VALUES ('7', '1', '2', 'Security 3', '1', '1', '1', '2015-03-01', '1', 'male', 'o', '123', '321', null, null, null, null, null, null, 'Jawa', null, null, null, null, null, null, null, null, null, '3', '10');
INSERT INTO `employee` VALUES ('8', '2', '3', 'Security 4', '1', '1', '2', '2015-03-06', '1', 'male', 'o', '4234', '4234210', null, null, null, null, null, null, 'terter', null, null, null, null, null, null, null, null, null, '3', '11');
INSERT INTO `employee` VALUES ('9', '1', '4', 'Security 5', '1', '1', '1', '2015-03-01', '1', 'male', 'o', '5434', '534', null, null, null, null, null, null, 'rtertretret', null, null, null, null, null, null, null, null, null, '2', '11');
INSERT INTO `employee` VALUES ('10', '2', '5', 'Security 6', '1', '1', '3', '2015-03-01', '1', 'male', 'a', '423', '43234', null, null, null, null, null, null, '', null, null, null, null, null, null, null, null, null, '2', '11');
INSERT INTO `employee` VALUES ('13', '2', '6', 'Security 7', '1', '1', '2', null, '1', 'male', 'o', '123', '22', null, null, null, null, null, null, 'Jawa', null, null, null, null, null, null, null, null, null, '3', '11');
INSERT INTO `employee` VALUES ('14', '2', '7', 'Security 8', '1', '1', '1', null, '1', 'male', 'b', '0', '0', null, null, null, null, null, null, '', null, null, null, null, null, null, null, null, null, '3', '11');
INSERT INTO `employee` VALUES ('15', '1', '8', 'Security 9', '1', '1', '6', null, '1', 'male', 'b', '0', '0', null, null, null, null, null, null, '', null, null, null, null, null, null, null, null, null, '3', '11');
INSERT INTO `employee` VALUES ('18', '1', '9', 'Security 10', '1', '1', '6', null, '1', 'male', 'b', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '3', '11');

-- ----------------------------
-- Table structure for `employeex`
-- ----------------------------
DROP TABLE IF EXISTS `employeex`;
CREATE TABLE `employeex` (
  `id_employee` int(11) NOT NULL AUTO_INCREMENT,
  `employment_type` int(11) NOT NULL,
  `employee_number` bigint(20) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `employee_status` int(11) NOT NULL,
  `employee_contract_type` int(11) NOT NULL,
  `birth_city` int(11) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `religion` int(11) DEFAULT NULL,
  `gender` varchar(45) DEFAULT NULL,
  `blood_type` varchar(3) DEFAULT NULL,
  `height` float DEFAULT NULL,
  `weight` float DEFAULT NULL,
  `hobbies` text,
  `tax_status` int(11) DEFAULT NULL,
  `marital_status` varchar(10) DEFAULT NULL,
  `father_name` varchar(45) DEFAULT NULL,
  `mother_name` varchar(45) DEFAULT NULL,
  `marital_date` date DEFAULT NULL,
  `native` varchar(45) DEFAULT NULL,
  `npwp` varchar(45) DEFAULT NULL,
  `npwp_date` date DEFAULT NULL,
  `bpjs` varchar(45) DEFAULT NULL,
  `bpjs_date` date DEFAULT NULL,
  `jamsostek` varchar(45) DEFAULT NULL,
  `jamsostek_date` date DEFAULT NULL,
  `rekening` varchar(45) DEFAULT NULL,
  `bank` int(11) DEFAULT NULL,
  `photo_path` varchar(45) DEFAULT NULL,
  `organisation_structure_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_employee`),
  KEY `fk_employee_employee_status1_idx` (`employee_status`),
  KEY `fk_employee_employment_type1_idx` (`employment_type`),
  KEY `fk_employee_employee_contract_type1_idx` (`employee_contract_type`),
  KEY `fk_employee_city2_idx` (`birth_city`),
  KEY `fk_employee_religion1_idx` (`religion`),
  KEY `fk_employee_bank1_idx` (`bank`),
  CONSTRAINT `fk_employee_bank1` FOREIGN KEY (`bank`) REFERENCES `bank` (`id_bank`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_employee_city2` FOREIGN KEY (`birth_city`) REFERENCES `city` (`id_city`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_employee_employee_contract_type1` FOREIGN KEY (`employee_contract_type`) REFERENCES `employee_contract_type` (`id_employee_contract_type`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_employee_employee_status1` FOREIGN KEY (`employee_status`) REFERENCES `employee_status` (`id_employee_status`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_employee_employment_type1` FOREIGN KEY (`employment_type`) REFERENCES `employment_type` (`id_employment_type`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_employee_religion1` FOREIGN KEY (`religion`) REFERENCES `religion` (`id_religion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of employeex
-- ----------------------------
INSERT INTO `employeex` VALUES ('3', '2', '1', 'John Doe', '4', '1', '151', '2015-03-17', '1', 'male', 'o', '187', '87', '', null, 'married', null, null, '2015-03-17', 'Indonesia', null, null, null, null, null, null, null, null, null, null);
INSERT INTO `employeex` VALUES ('4', '2', '2', 'John Doel', '4', '1', '151', '2015-03-17', '1', 'male', 'o', '184', '83', '', null, 'married', null, null, '2015-03-17', 'Indonesia', null, null, null, null, null, null, null, null, null, null);
INSERT INTO `employeex` VALUES ('5', '2', '3', 'Adam Smith Edit', '4', '1', '151', '2015-03-16', '1', 'male', 'o', '187', '76', '', null, 'married', null, null, '2015-03-16', 'Indonesia', null, null, null, null, null, null, null, null, null, null);
INSERT INTO `employeex` VALUES ('6', '2', '4', 'John Smith', '4', '1', '151', '2015-03-16', '1', 'male', 'o', '186', '76', '', null, 'married', null, null, '2015-03-16', 'Indonesia', null, null, null, null, null, null, null, null, null, null);
INSERT INTO `employeex` VALUES ('7', '2', '5', 'Abraham Lunggana', '4', '2', '151', '2015-03-16', '1', 'male', 'o', '187', '76', '', null, 'married', null, null, '2015-03-16', 'Indonesia', null, null, null, null, null, null, null, null, null, null);

-- ----------------------------
-- Table structure for `employee_address`
-- ----------------------------
DROP TABLE IF EXISTS `employee_address`;
CREATE TABLE `employee_address` (
  `id_employee_address` int(11) NOT NULL AUTO_INCREMENT,
  `address` text NOT NULL,
  `city` int(11) NOT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `address_type` int(11) NOT NULL,
  `employee` int(11) NOT NULL,
  `housing_owner` varchar(20) NOT NULL,
  PRIMARY KEY (`id_employee_address`),
  KEY `fk_employee_address_city1_idx` (`city`),
  KEY `fk_employee_address_address_type1_idx` (`address_type`),
  KEY `fk_employee_address_employee1_idx` (`employee`),
  CONSTRAINT `fk_employee_address_address_type1` FOREIGN KEY (`address_type`) REFERENCES `address_type` (`id_address_type`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_employee_address_city1` FOREIGN KEY (`city`) REFERENCES `city` (`id_city`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_employee_address_employee1` FOREIGN KEY (`employee`) REFERENCES `employeex` (`id_employee`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of employee_address
-- ----------------------------

-- ----------------------------
-- Table structure for `employee_assignment`
-- ----------------------------
DROP TABLE IF EXISTS `employee_assignment`;
CREATE TABLE `employee_assignment` (
  `id_employee_assignment` int(11) NOT NULL AUTO_INCREMENT,
  `customer_site` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `effective_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `employmee_assignment_status` int(11) NOT NULL,
  PRIMARY KEY (`id_employee_assignment`),
  KEY `fk_employee_assignment_customer_site1_idx` (`customer_site`),
  KEY `fk_employee_assignment_employee1_idx` (`employee_id`),
  KEY `fk_employee_assignment_employmee_assignment_status1_idx` (`employmee_assignment_status`),
  CONSTRAINT `fk_employee_assignment_employee1` FOREIGN KEY (`employee_id`) REFERENCES `employeex` (`id_employee`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_employee_assignment_employmee_assignment_status1` FOREIGN KEY (`employmee_assignment_status`) REFERENCES `employee_assignment_status` (`id_employee_assignment_status`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of employee_assignment
-- ----------------------------

-- ----------------------------
-- Table structure for `employee_assignment_status`
-- ----------------------------
DROP TABLE IF EXISTS `employee_assignment_status`;
CREATE TABLE `employee_assignment_status` (
  `id_employee_assignment_status` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `abv` varchar(10) NOT NULL,
  PRIMARY KEY (`id_employee_assignment_status`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of employee_assignment_status
-- ----------------------------

-- ----------------------------
-- Table structure for `employee_contract`
-- ----------------------------
DROP TABLE IF EXISTS `employee_contract`;
CREATE TABLE `employee_contract` (
  `id_employee_contract` int(11) NOT NULL AUTO_INCREMENT,
  `contract_number` varchar(45) DEFAULT NULL,
  `employee` int(11) NOT NULL,
  `join_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `employee_contract_type` int(11) DEFAULT NULL,
  `contract_status` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `position_level` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_employee_contract`),
  KEY `fk_employee_contract_employee1_idx` (`employee`),
  KEY `fk_employee_contract_employee_contract_type1_idx` (`employee_contract_type`),
  KEY `fk_employee_contract_employee_contract_status1_idx` (`contract_status`),
  KEY `fk_employee_contract_organisation_structure1_idx` (`position`),
  KEY `fk_employee_contract_position_level1_idx` (`position_level`),
  CONSTRAINT `fk_employee_contract_employee1` FOREIGN KEY (`employee`) REFERENCES `employeex` (`id_employee`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_employee_contract_employee_contract_status1` FOREIGN KEY (`contract_status`) REFERENCES `employee_contract_status` (`id_employee_contract_status`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_employee_contract_employee_contract_type1` FOREIGN KEY (`employee_contract_type`) REFERENCES `employee_contract_type` (`id_employee_contract_type`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_employee_contract_organisation_structure1` FOREIGN KEY (`position`) REFERENCES `organisation_structure` (`id_organisation_structure`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_employee_contract_position_level1` FOREIGN KEY (`position_level`) REFERENCES `position_level` (`id_position_level`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of employee_contract
-- ----------------------------
INSERT INTO `employee_contract` VALUES ('3', '111111', '3', '2015-03-17', '2015-03-17', '1', '5', '6', '2');
INSERT INTO `employee_contract` VALUES ('4', '1111111', '4', '2015-03-17', '2015-03-17', '1', '5', '6', '2');
INSERT INTO `employee_contract` VALUES ('5', '111111', '5', '2015-03-16', '2015-03-16', '1', '5', '11', '2');
INSERT INTO `employee_contract` VALUES ('6', '111111', '6', '2015-03-16', '2015-03-16', '1', '5', '11', '2');
INSERT INTO `employee_contract` VALUES ('7', '111111', '7', '2015-03-14', '2015-03-16', '2', '5', '10', '2');

-- ----------------------------
-- Table structure for `employee_contract_phase_type`
-- ----------------------------
DROP TABLE IF EXISTS `employee_contract_phase_type`;
CREATE TABLE `employee_contract_phase_type` (
  `id_employee_contract_phase_type` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL COMMENT 'probation I, probation II, hired',
  `abv` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_employee_contract_phase_type`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of employee_contract_phase_type
-- ----------------------------
INSERT INTO `employee_contract_phase_type` VALUES ('1', 'Probation', 'prob');

-- ----------------------------
-- Table structure for `employee_contract_status`
-- ----------------------------
DROP TABLE IF EXISTS `employee_contract_status`;
CREATE TABLE `employee_contract_status` (
  `id_employee_contract_status` int(11) NOT NULL AUTO_INCREMENT,
  `status_name` varchar(45) NOT NULL COMMENT 'On going, teriminate by employee, terminate by company, close, draft',
  `abv` varchar(45) NOT NULL,
  PRIMARY KEY (`id_employee_contract_status`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of employee_contract_status
-- ----------------------------
INSERT INTO `employee_contract_status` VALUES ('1', 'On Going', 'on_going');
INSERT INTO `employee_contract_status` VALUES ('2', 'Terminate by Employee', 'term_emp');
INSERT INTO `employee_contract_status` VALUES ('3', 'Terminate by Company', 'term_comp');
INSERT INTO `employee_contract_status` VALUES ('4', 'Close', 'close');
INSERT INTO `employee_contract_status` VALUES ('5', 'Draft', 'draft');

-- ----------------------------
-- Table structure for `employee_contract_type`
-- ----------------------------
DROP TABLE IF EXISTS `employee_contract_type`;
CREATE TABLE `employee_contract_type` (
  `id_employee_contract_type` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL COMMENT 'Contract, Permanent, Expatriats',
  `abv` varchar(10) NOT NULL,
  PRIMARY KEY (`id_employee_contract_type`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of employee_contract_type
-- ----------------------------
INSERT INTO `employee_contract_type` VALUES ('1', 'Contract', 'CR');
INSERT INTO `employee_contract_type` VALUES ('2', 'Permanent', 'PR');
INSERT INTO `employee_contract_type` VALUES ('3', 'Expatriat', 'EXP');

-- ----------------------------
-- Table structure for `employee_course`
-- ----------------------------
DROP TABLE IF EXISTS `employee_course`;
CREATE TABLE `employee_course` (
  `id_employee_course` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `field` varchar(45) NOT NULL,
  `provider` varchar(45) NOT NULL,
  `employee_coursecol` varchar(45) DEFAULT NULL,
  `duration_uom` int(11) NOT NULL,
  `duration` float NOT NULL,
  `year` int(11) NOT NULL,
  `supported_by` varchar(10) NOT NULL,
  `remarks` varchar(45) DEFAULT NULL,
  `employee` int(11) NOT NULL,
  `city` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_employee_course`),
  KEY `fk_employee_course_unit_measure1_idx` (`duration_uom`),
  KEY `fk_employee_course_employee1_idx` (`employee`),
  KEY `fk_employee_course_city1_idx` (`city`),
  CONSTRAINT `fk_employee_course_city1` FOREIGN KEY (`city`) REFERENCES `city` (`id_city`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_employee_course_employee1` FOREIGN KEY (`employee`) REFERENCES `employeex` (`id_employee`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_employee_course_unit_measure1` FOREIGN KEY (`duration_uom`) REFERENCES `unit_measure` (`id_unit_measure`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of employee_course
-- ----------------------------

-- ----------------------------
-- Table structure for `employee_document_detail`
-- ----------------------------
DROP TABLE IF EXISTS `employee_document_detail`;
CREATE TABLE `employee_document_detail` (
  `id_employee_document_detail` int(11) NOT NULL AUTO_INCREMENT,
  `employee` int(11) NOT NULL,
  `employee_document_type` int(11) NOT NULL,
  `filepath` text,
  `imagepath` text,
  `attachment_type` varchar(10) NOT NULL COMMENT 'image, file',
  `date_issue` date DEFAULT NULL,
  `date_expire` date DEFAULT NULL,
  `number` varchar(45) NOT NULL,
  PRIMARY KEY (`id_employee_document_detail`),
  KEY `fk_employee_document_detail_employee1_idx` (`employee`),
  KEY `fk_employee_document_detail_employee_document_type1_idx` (`employee_document_type`),
  CONSTRAINT `fk_employee_document_detail_employee1` FOREIGN KEY (`employee`) REFERENCES `employeex` (`id_employee`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_employee_document_detail_employee_document_type1` FOREIGN KEY (`employee_document_type`) REFERENCES `employee_document_type` (`id_employee_document_type`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of employee_document_detail
-- ----------------------------

-- ----------------------------
-- Table structure for `employee_document_type`
-- ----------------------------
DROP TABLE IF EXISTS `employee_document_type`;
CREATE TABLE `employee_document_type` (
  `id_employee_document_type` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL COMMENT 'KTP, PASSPOR, SIM A, SIM B',
  `type` varchar(45) NOT NULL COMMENT 'Identity, Education',
  PRIMARY KEY (`id_employee_document_type`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of employee_document_type
-- ----------------------------
INSERT INTO `employee_document_type` VALUES ('1', 'KTP', 'identity');
INSERT INTO `employee_document_type` VALUES ('2', 'PASSPOR', 'identity');
INSERT INTO `employee_document_type` VALUES ('3', 'SIM A', 'driving_license');
INSERT INTO `employee_document_type` VALUES ('4', 'SIM C', 'driving_license');
INSERT INTO `employee_document_type` VALUES ('5', 'KITAS', 'indentity');
INSERT INTO `employee_document_type` VALUES ('6', 'Working Permit', 'business_doc');

-- ----------------------------
-- Table structure for `employee_emergency_contact`
-- ----------------------------
DROP TABLE IF EXISTS `employee_emergency_contact`;
CREATE TABLE `employee_emergency_contact` (
  `id_employee_emergency_contact` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `address` text,
  `city` int(11) NOT NULL,
  `phone` varchar(45) NOT NULL,
  `profession` varchar(45) DEFAULT NULL,
  `relationship` varchar(45) NOT NULL,
  `employee` int(11) NOT NULL,
  PRIMARY KEY (`id_employee_emergency_contact`),
  KEY `fk_employee_emergency_contact_city1_idx` (`city`),
  KEY `fk_employee_emergency_contact_employee1_idx` (`employee`),
  CONSTRAINT `fk_employee_emergency_contact_city1` FOREIGN KEY (`city`) REFERENCES `city` (`id_city`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_employee_emergency_contact_employee1` FOREIGN KEY (`employee`) REFERENCES `employeex` (`id_employee`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of employee_emergency_contact
-- ----------------------------

-- ----------------------------
-- Table structure for `employee_experience`
-- ----------------------------
DROP TABLE IF EXISTS `employee_experience`;
CREATE TABLE `employee_experience` (
  `id_employee_experience` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(45) NOT NULL,
  `company_address` text,
  `city` int(11) NOT NULL,
  `company_phone` varchar(45) DEFAULT NULL,
  `from_month` int(11) DEFAULT NULL,
  `to_month` int(11) DEFAULT NULL,
  `entry_position` varchar(45) NOT NULL,
  `last_position` varchar(45) NOT NULL,
  `total_employees` int(11) DEFAULT NULL,
  `director_name` varchar(45) DEFAULT NULL,
  `type_of_business` varchar(45) DEFAULT NULL,
  `supervisor` varchar(45) DEFAULT NULL,
  `responsibilities` text NOT NULL,
  `reason_for_leaving` text NOT NULL,
  `last_salary` float NOT NULL,
  `facilities` text,
  `supervisor_phone` varchar(45) DEFAULT NULL,
  `supervisor_can_be_contacted` tinyint(1) DEFAULT NULL,
  `employee` int(11) NOT NULL,
  `from_year` int(11) DEFAULT NULL,
  `to_year` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_employee_experience`),
  KEY `fk_employee_experience_city1_idx` (`city`),
  KEY `fk_employee_experience_employee1_idx` (`employee`),
  CONSTRAINT `fk_employee_experience_city1` FOREIGN KEY (`city`) REFERENCES `city` (`id_city`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_employee_experience_employee1` FOREIGN KEY (`employee`) REFERENCES `employeex` (`id_employee`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of employee_experience
-- ----------------------------

-- ----------------------------
-- Table structure for `employee_family_tree`
-- ----------------------------
DROP TABLE IF EXISTS `employee_family_tree`;
CREATE TABLE `employee_family_tree` (
  `id_employee_family_tree` int(11) NOT NULL AUTO_INCREMENT,
  `relation` varchar(10) NOT NULL,
  `name` varchar(45) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `birth_place` int(11) NOT NULL,
  `birth_date` date NOT NULL,
  `last_education` int(11) NOT NULL,
  `last_employment_position` varchar(45) DEFAULT NULL,
  `last_employment_company` varchar(45) DEFAULT NULL,
  `remarks` varchar(45) DEFAULT NULL,
  `employee` int(11) NOT NULL,
  PRIMARY KEY (`id_employee_family_tree`),
  KEY `fk_employee_family_tree_city1_idx` (`birth_place`),
  KEY `fk_employee_family_tree_education_level1_idx` (`last_education`),
  KEY `fk_employee_family_tree_employee1_idx` (`employee`),
  CONSTRAINT `fk_employee_family_tree_city1` FOREIGN KEY (`birth_place`) REFERENCES `city` (`id_city`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_employee_family_tree_education_level1` FOREIGN KEY (`last_education`) REFERENCES `education_level` (`id_education_level`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_employee_family_tree_employee1` FOREIGN KEY (`employee`) REFERENCES `employeex` (`id_employee`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of employee_family_tree
-- ----------------------------
INSERT INTO `employee_family_tree` VALUES ('5', 'father', 'Test', 'male', '1', '2015-12-17', '1', '', '', null, '3');
INSERT INTO `employee_family_tree` VALUES ('6', 'mother', 'Test', 'female', '1', '2015-12-17', '1', '', '', null, '3');
INSERT INTO `employee_family_tree` VALUES ('7', 'father', 'Test', 'male', '151', '2015-12-17', '1', '', '', null, '4');
INSERT INTO `employee_family_tree` VALUES ('8', 'mother', 'Test', 'female', '151', '2015-12-17', '1', '', '', null, '4');
INSERT INTO `employee_family_tree` VALUES ('9', 'father', 'test', 'male', '5', '2015-12-26', '5', '', '', null, '5');
INSERT INTO `employee_family_tree` VALUES ('10', 'mother', 'test', 'female', '5', '2015-12-26', '4', '', '', null, '5');
INSERT INTO `employee_family_tree` VALUES ('11', 'father', 'Test', 'male', '1', '2015-12-26', '5', '', '', null, '6');
INSERT INTO `employee_family_tree` VALUES ('12', 'mother', 'Test', 'female', '1', '2015-12-26', '5', '', '', null, '6');
INSERT INTO `employee_family_tree` VALUES ('13', 'father', 'Test', 'male', '151', '2015-12-26', '5', '', '', null, '7');
INSERT INTO `employee_family_tree` VALUES ('14', 'mother', 'Test', 'female', '151', '2015-12-26', '5', '', '', null, '7');

-- ----------------------------
-- Table structure for `employee_languages`
-- ----------------------------
DROP TABLE IF EXISTS `employee_languages`;
CREATE TABLE `employee_languages` (
  `id_employee_languages` int(11) NOT NULL AUTO_INCREMENT,
  `languages` int(11) NOT NULL,
  `remarks` varchar(45) DEFAULT NULL,
  `employee` int(11) NOT NULL,
  `reading` int(11) NOT NULL,
  `writing` int(11) NOT NULL,
  `speaking` int(11) NOT NULL,
  `hearing` int(11) NOT NULL,
  PRIMARY KEY (`id_employee_languages`),
  KEY `fk_employee_languages_languages1_idx` (`languages`),
  KEY `fk_employee_languages_employee1_idx` (`employee`),
  KEY `fk_employee_languages_language_fluency1_idx` (`reading`),
  KEY `fk_employee_languages_language_fluency2_idx` (`writing`),
  KEY `fk_employee_languages_language_fluency3_idx` (`speaking`),
  KEY `fk_employee_languages_language_fluency4_idx` (`hearing`),
  CONSTRAINT `fk_employee_languages_employee1` FOREIGN KEY (`employee`) REFERENCES `employeex` (`id_employee`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_employee_languages_languages1` FOREIGN KEY (`languages`) REFERENCES `languages` (`id_languages`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_employee_languages_language_fluency1` FOREIGN KEY (`reading`) REFERENCES `language_fluency` (`id_language_fluency`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_employee_languages_language_fluency2` FOREIGN KEY (`writing`) REFERENCES `language_fluency` (`id_language_fluency`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_employee_languages_language_fluency3` FOREIGN KEY (`speaking`) REFERENCES `language_fluency` (`id_language_fluency`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_employee_languages_language_fluency4` FOREIGN KEY (`hearing`) REFERENCES `language_fluency` (`id_language_fluency`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of employee_languages
-- ----------------------------

-- ----------------------------
-- Table structure for `employee_marital`
-- ----------------------------
DROP TABLE IF EXISTS `employee_marital`;
CREATE TABLE `employee_marital` (
  `id_employee_marital` int(11) NOT NULL AUTO_INCREMENT,
  `employee` int(11) NOT NULL,
  `relation` varchar(45) NOT NULL,
  `index` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `birth_date` date NOT NULL,
  `birth_place` int(11) NOT NULL,
  `blood_type` varchar(3) DEFAULT NULL,
  `last_employment_position` varchar(45) DEFAULT NULL,
  `last_employment_company` varchar(45) DEFAULT NULL,
  `last_education` int(11) NOT NULL,
  PRIMARY KEY (`id_employee_marital`),
  KEY `fk_employee_family_employee1_idx` (`employee`),
  KEY `fk_employee_marital_city1_idx` (`birth_place`),
  KEY `fk_employee_marital_education_level1_idx` (`last_education`),
  CONSTRAINT `fk_employee_family_employee1` FOREIGN KEY (`employee`) REFERENCES `employeex` (`id_employee`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_employee_marital_city1` FOREIGN KEY (`birth_place`) REFERENCES `city` (`id_city`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_employee_marital_education_level1` FOREIGN KEY (`last_education`) REFERENCES `education_level` (`id_education_level`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of employee_marital
-- ----------------------------

-- ----------------------------
-- Table structure for `employee_resign_history`
-- ----------------------------
DROP TABLE IF EXISTS `employee_resign_history`;
CREATE TABLE `employee_resign_history` (
  `id_employee_resign_history` int(11) NOT NULL AUTO_INCREMENT,
  `employee` int(11) NOT NULL,
  `employee_number` bigint(20) NOT NULL,
  `date_resign` date NOT NULL,
  `reason` text NOT NULL,
  PRIMARY KEY (`id_employee_resign_history`),
  KEY `fk_employee_resign_history_employee1_idx` (`employee`),
  CONSTRAINT `fk_employee_resign_history_employee1` FOREIGN KEY (`employee`) REFERENCES `employeex` (`id_employee`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of employee_resign_history
-- ----------------------------

-- ----------------------------
-- Table structure for `employee_social`
-- ----------------------------
DROP TABLE IF EXISTS `employee_social`;
CREATE TABLE `employee_social` (
  `id_employee_social` int(11) NOT NULL AUTO_INCREMENT,
  `organisation` varchar(45) NOT NULL,
  `activities` varchar(45) NOT NULL,
  `position` varchar(45) NOT NULL,
  `year` int(11) NOT NULL,
  `employee` int(11) NOT NULL,
  PRIMARY KEY (`id_employee_social`),
  KEY `fk_employee_social_employee1_idx` (`employee`),
  CONSTRAINT `fk_employee_social_employee1` FOREIGN KEY (`employee`) REFERENCES `employeex` (`id_employee`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of employee_social
-- ----------------------------

-- ----------------------------
-- Table structure for `employee_status`
-- ----------------------------
DROP TABLE IF EXISTS `employee_status`;
CREATE TABLE `employee_status` (
  `id_employee_status` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL COMMENT 'New, Resign,Renewal, Contract Close, Permanent',
  `abv` varchar(10) NOT NULL,
  PRIMARY KEY (`id_employee_status`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of employee_status
-- ----------------------------
INSERT INTO `employee_status` VALUES ('1', 'Hired', 'hired');
INSERT INTO `employee_status` VALUES ('2', 'Resign', 'resign');
INSERT INTO `employee_status` VALUES ('3', 'Contract Close', 'close');
INSERT INTO `employee_status` VALUES ('4', 'Listed', 'list');
INSERT INTO `employee_status` VALUES ('5', 'Recruitment', 'recr');

-- ----------------------------
-- Table structure for `employee_vehicle`
-- ----------------------------
DROP TABLE IF EXISTS `employee_vehicle`;
CREATE TABLE `employee_vehicle` (
  `id_employee_vehicle` int(11) NOT NULL AUTO_INCREMENT,
  `vehicle_type` varchar(10) NOT NULL,
  `merk` varchar(45) NOT NULL,
  `year` int(11) NOT NULL,
  `owner` varchar(20) NOT NULL,
  `employee` int(11) NOT NULL,
  PRIMARY KEY (`id_employee_vehicle`),
  KEY `fk_employee_vehicle_employee1_idx` (`employee`),
  CONSTRAINT `fk_employee_vehicle_employee1` FOREIGN KEY (`employee`) REFERENCES `employeex` (`id_employee`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of employee_vehicle
-- ----------------------------

-- ----------------------------
-- Table structure for `employent_contract_phase_detail`
-- ----------------------------
DROP TABLE IF EXISTS `employent_contract_phase_detail`;
CREATE TABLE `employent_contract_phase_detail` (
  `id_employent_contract_phase_detail` int(11) NOT NULL AUTO_INCREMENT,
  `employee_contract` int(11) NOT NULL,
  `contract_phase_type` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` varchar(15) NOT NULL,
  PRIMARY KEY (`id_employent_contract_phase_detail`),
  KEY `fk_employent_contract_phase_employee_contract1_idx` (`employee_contract`),
  KEY `fk_employent_contract_phase_detail_employee_contract_phase__idx` (`contract_phase_type`),
  CONSTRAINT `fk_employent_contract_phase_detail_employee_contract_phase_ty1` FOREIGN KEY (`contract_phase_type`) REFERENCES `employee_contract_phase_type` (`id_employee_contract_phase_type`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_employent_contract_phase_employee_contract1` FOREIGN KEY (`employee_contract`) REFERENCES `employee_contract` (`id_employee_contract`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of employent_contract_phase_detail
-- ----------------------------

-- ----------------------------
-- Table structure for `employe_education`
-- ----------------------------
DROP TABLE IF EXISTS `employe_education`;
CREATE TABLE `employe_education` (
  `id_employe_education` int(11) NOT NULL AUTO_INCREMENT,
  `employee` int(11) NOT NULL,
  `education_level` int(11) NOT NULL,
  `institution_name` varchar(45) NOT NULL,
  `from_year` int(11) NOT NULL,
  `to_year` int(11) NOT NULL,
  `doc_attach` int(11) DEFAULT NULL,
  `graduated` tinyint(1) NOT NULL,
  `city` int(11) NOT NULL,
  PRIMARY KEY (`id_employe_education`),
  KEY `fk_employe_education_employee1_idx` (`employee`),
  KEY `fk_employe_education_education_level1_idx` (`education_level`),
  KEY `fk_employe_education_employee_document_detail1_idx` (`doc_attach`),
  KEY `fk_employe_education_city1_idx` (`city`),
  CONSTRAINT `fk_employe_education_city1` FOREIGN KEY (`city`) REFERENCES `city` (`id_city`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_employe_education_education_level1` FOREIGN KEY (`education_level`) REFERENCES `education_level` (`id_education_level`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_employe_education_employee1` FOREIGN KEY (`employee`) REFERENCES `employeex` (`id_employee`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_employe_education_employee_document_detail1` FOREIGN KEY (`doc_attach`) REFERENCES `employee_document_detail` (`id_employee_document_detail`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of employe_education
-- ----------------------------

-- ----------------------------
-- Table structure for `employment_type`
-- ----------------------------
DROP TABLE IF EXISTS `employment_type`;
CREATE TABLE `employment_type` (
  `id_employment_type` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL COMMENT 'Management, Non Management',
  `abv` varchar(4) NOT NULL,
  PRIMARY KEY (`id_employment_type`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of employment_type
-- ----------------------------
INSERT INTO `employment_type` VALUES ('1', 'Management', 'mgmt');
INSERT INTO `employment_type` VALUES ('2', 'Non Management', 'non_');

-- ----------------------------
-- Table structure for `ext_company`
-- ----------------------------
DROP TABLE IF EXISTS `ext_company`;
CREATE TABLE `ext_company` (
  `id_ext_company` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `address` text NOT NULL,
  `npwp` varchar(45) DEFAULT NULL,
  `contact` varchar(45) NOT NULL,
  `tlp` varchar(45) NOT NULL,
  `fax` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `rekening` varchar(45) DEFAULT NULL,
  `company_code` varchar(10) NOT NULL,
  `is_supplier` tinyint(1) NOT NULL DEFAULT '0',
  `is_customer` tinyint(1) NOT NULL DEFAULT '0',
  `city` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_ext_company`),
  KEY `fk_ext_company_city1_idx` (`city`),
  CONSTRAINT `fk_ext_company_city1` FOREIGN KEY (`city`) REFERENCES `city` (`id_city`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ext_company
-- ----------------------------
INSERT INTO `ext_company` VALUES ('1', 'P.T Wahana Usaha Universal', 'Menara Kuningan', 'xxxxxx', 'Faris Rahman', '085720074869', '', 'faris.rahman@wahanausaha.co.id', 'xxxxxx', 'wuu', '1', '0', null);
INSERT INTO `ext_company` VALUES ('3', 'P.T Bina Dharmamigena', 'Fatmawati', 'xxxxxx', 'Adhi Nugroho', 'xxxxxx', 'xxxxxx', 'adhi.nugroho.murbini@bdmgroup.co.id', 'xxxxxx', 'bdm', '1', '0', null);
INSERT INTO `ext_company` VALUES ('4', 'P.T Cargill Indonesia', 'Jl. Raya Walisongo No. 395 A KM 9.6', 'xxxxxx', 'Bernadus Baiin', 'xxxxxx', '', '', '', 'cgi', '0', '1', '396');

-- ----------------------------
-- Table structure for `fdcommand_register`
-- ----------------------------
DROP TABLE IF EXISTS `fdcommand_register`;
CREATE TABLE `fdcommand_register` (
  `id_fdcommand_register` int(11) NOT NULL AUTO_INCREMENT,
  `command` text NOT NULL,
  PRIMARY KEY (`id_fdcommand_register`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of fdcommand_register
-- ----------------------------
INSERT INTO `fdcommand_register` VALUES ('1', 'enroll_fingerprint');
INSERT INTO `fdcommand_register` VALUES ('2', 'enroll_fingerprint');
INSERT INTO `fdcommand_register` VALUES ('3', 'enroll_fingerprint');
INSERT INTO `fdcommand_register` VALUES ('4', 'enroll_fingerprint');
INSERT INTO `fdcommand_register` VALUES ('5', 'enroll_fingerprint');
INSERT INTO `fdcommand_register` VALUES ('6', 'enroll_fingerprint');
INSERT INTO `fdcommand_register` VALUES ('7', 'enroll_fingerprint');
INSERT INTO `fdcommand_register` VALUES ('8', 'enroll_fingerprint');
INSERT INTO `fdcommand_register` VALUES ('9', 'enroll_fingerprint');
INSERT INTO `fdcommand_register` VALUES ('10', 'enroll_fingerprint');
INSERT INTO `fdcommand_register` VALUES ('11', 'enroll_fingerprint');
INSERT INTO `fdcommand_register` VALUES ('12', 'enroll_fingerprint');
INSERT INTO `fdcommand_register` VALUES ('13', 'enroll_fingerprint');
INSERT INTO `fdcommand_register` VALUES ('14', 'enroll_fingerprint');
INSERT INTO `fdcommand_register` VALUES ('15', 'enroll_fingerprint');
INSERT INTO `fdcommand_register` VALUES ('16', 'enroll_fingerprint');
INSERT INTO `fdcommand_register` VALUES ('17', 'enroll_fingerprint');
INSERT INTO `fdcommand_register` VALUES ('18', 'enroll_fingerprint');
INSERT INTO `fdcommand_register` VALUES ('19', 'enroll_fingerprint');
INSERT INTO `fdcommand_register` VALUES ('20', 'enroll_fingerprint');

-- ----------------------------
-- Table structure for `fingerprint_assign`
-- ----------------------------
DROP TABLE IF EXISTS `fingerprint_assign`;
CREATE TABLE `fingerprint_assign` (
  `id_fingerprint_assign` int(11) NOT NULL AUTO_INCREMENT,
  `work_order` int(11) NOT NULL,
  `app_id` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL,
  `site` int(11) NOT NULL,
  PRIMARY KEY (`id_fingerprint_assign`),
  KEY `fk_fingerprint_assign_work_order1_idx` (`work_order`),
  KEY `fk_fingerprint_assign_customer_site1_idx` (`site`),
  CONSTRAINT `fk_fingerprint_assign_customer_site1` FOREIGN KEY (`site`) REFERENCES `customer_site` (`id_customer_site`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_fingerprint_assign_work_order1` FOREIGN KEY (`work_order`) REFERENCES `work_order` (`id_work_order`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of fingerprint_assign
-- ----------------------------
INSERT INTO `fingerprint_assign` VALUES ('4', '1', 'APPID1500011', 'assigned', '1');

-- ----------------------------
-- Table structure for `fingerprint_assign_detail`
-- ----------------------------
DROP TABLE IF EXISTS `fingerprint_assign_detail`;
CREATE TABLE `fingerprint_assign_detail` (
  `id_fingerprint_assign_detail` int(11) NOT NULL AUTO_INCREMENT,
  `fingerprint_assign` int(11) NOT NULL,
  `fingerprint_device` int(11) NOT NULL,
  `ip_local` varchar(45) NOT NULL,
  `comm_password` int(11) NOT NULL,
  `fdid` int(11) NOT NULL,
  `port` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_fingerprint_assign_detail`),
  KEY `fk_fingerprint_assign_detail_fingerprint_assign1_idx` (`fingerprint_assign`),
  KEY `fk_fingerprint_assign_detail_fingerprint_device1_idx` (`fingerprint_device`),
  CONSTRAINT `fk_fingerprint_assign_detail_fingerprint_assign1` FOREIGN KEY (`fingerprint_assign`) REFERENCES `fingerprint_assign` (`id_fingerprint_assign`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_fingerprint_assign_detail_fingerprint_device1` FOREIGN KEY (`fingerprint_device`) REFERENCES `fingerprint_device` (`id_fingerprint_device`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of fingerprint_assign_detail
-- ----------------------------
INSERT INTO `fingerprint_assign_detail` VALUES ('11', '4', '1', '192.168.13.200', '111111', '1', '4370');

-- ----------------------------
-- Table structure for `fingerprint_device`
-- ----------------------------
DROP TABLE IF EXISTS `fingerprint_device`;
CREATE TABLE `fingerprint_device` (
  `id_fingerprint_device` int(11) NOT NULL AUTO_INCREMENT,
  `merk` varchar(45) NOT NULL,
  `series` varchar(45) NOT NULL,
  `serial_number` varchar(45) NOT NULL,
  `ip_local_setting` varchar(45) NOT NULL,
  `comm_password` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL,
  PRIMARY KEY (`id_fingerprint_device`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of fingerprint_device
-- ----------------------------
INSERT INTO `fingerprint_device` VALUES ('1', 'Fingerplus', 'ZT1800', '0266142700024', '192.168.1.11', '111111', 'active');

-- ----------------------------
-- Table structure for `fingerprint_event`
-- ----------------------------
DROP TABLE IF EXISTS `fingerprint_event`;
CREATE TABLE `fingerprint_event` (
  `id_fingerprint_event` int(11) NOT NULL AUTO_INCREMENT,
  `datetime` datetime NOT NULL,
  `employee` int(11) NOT NULL,
  PRIMARY KEY (`id_fingerprint_event`,`employee`),
  KEY `fk_fingerprint_event_employee1_idx` (`employee`),
  CONSTRAINT `fk_fingerprint_event_employee1` FOREIGN KEY (`employee`) REFERENCES `employeex` (`id_employee`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of fingerprint_event
-- ----------------------------

-- ----------------------------
-- Table structure for `fingerprint_template`
-- ----------------------------
DROP TABLE IF EXISTS `fingerprint_template`;
CREATE TABLE `fingerprint_template` (
  `id_fingerprint_template` int(11) NOT NULL AUTO_INCREMENT,
  `employee` int(11) NOT NULL,
  `fingerprint_tmp` text NOT NULL,
  `fid` int(11) NOT NULL,
  `flag` varchar(45) NOT NULL,
  `tmp_length` int(11) DEFAULT NULL,
  `password` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_fingerprint_template`),
  KEY `fk_fingerprint_template_employee1_idx` (`employee`),
  CONSTRAINT `fk_fingerprint_template_employee1` FOREIGN KEY (`employee`) REFERENCES `employeex` (`id_employee`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of fingerprint_template
-- ----------------------------
INSERT INTO `fingerprint_template` VALUES ('1', '7', 'ocoTgowmQEEW4a51QQwtHUIBCecPQAEF7B5ZgQh9s2KBFT86REETHTZswRBBvVEBOI61RUETIy85wRNAJTPBDlQXQsEKcI1PwQV3tVCBJKUfKAEKXJIwQQRtr01BOyyecAENGi5kyxKnZE4VDxThx3YBBAfAxW6ivbq6wMRqo7vbu7rAw2Wjq73duwzAw2KhnMx3oezLwMNeoZzNdQah3dvAw1pbX2NsdwYOFRsdwMJXgVldanYIExwgIsDCU6FommECDx0jJijAwU+idYd3J6E9uivAwUmldmVSBqpnwMJFolUzFTA5PDg0wMJAoVUyJiMxSEU+wMM3oTMCFwFXTEXAxC0oIBoFbFtTScDJY1hQS8DJXlVRTMDJXVhT4A==', '0', '0', '384', null);

-- ----------------------------
-- Table structure for `gr`
-- ----------------------------
DROP TABLE IF EXISTS `gr`;
CREATE TABLE `gr` (
  `id_gr` int(11) NOT NULL AUTO_INCREMENT,
  `po` int(11) NOT NULL,
  `date` date NOT NULL,
  `do` varchar(45) DEFAULT NULL,
  `gr_number` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL,
  PRIMARY KEY (`id_gr`),
  KEY `fk_gr_po1_idx` (`po`),
  CONSTRAINT `fk_gr_po1` FOREIGN KEY (`po`) REFERENCES `po` (`id_po`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of gr
-- ----------------------------
INSERT INTO `gr` VALUES ('1', '1', '2015-01-25', 'DN123332', 'GR150001', 'transfer');
INSERT INTO `gr` VALUES ('2', '3', '2015-01-30', '123123', 'GR150002', 'transfer');

-- ----------------------------
-- Table structure for `group`
-- ----------------------------
DROP TABLE IF EXISTS `group`;
CREATE TABLE `group` (
  `id_group` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `description` text,
  `created_by` int(11) NOT NULL,
  `administrator` int(11) NOT NULL,
  PRIMARY KEY (`id_group`),
  KEY `fk_group_user1_idx` (`created_by`),
  KEY `fk_group_user2_idx` (`administrator`),
  CONSTRAINT `fk_group_user1` FOREIGN KEY (`created_by`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_group_user2` FOREIGN KEY (`administrator`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of group
-- ----------------------------
INSERT INTO `group` VALUES ('1', 'Group Test', 'Testing Group', '2', '2');

-- ----------------------------
-- Table structure for `group_member`
-- ----------------------------
DROP TABLE IF EXISTS `group_member`;
CREATE TABLE `group_member` (
  `id_group_member` int(11) NOT NULL AUTO_INCREMENT,
  `group` int(11) NOT NULL,
  `user_member` int(11) NOT NULL,
  PRIMARY KEY (`id_group_member`),
  KEY `fk_group_member_group1_idx` (`group`),
  KEY `fk_group_member_user1_idx` (`user_member`),
  CONSTRAINT `fk_group_member_group1` FOREIGN KEY (`group`) REFERENCES `group` (`id_group`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_group_member_user1` FOREIGN KEY (`user_member`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of group_member
-- ----------------------------
INSERT INTO `group_member` VALUES ('1', '1', '42');
INSERT INTO `group_member` VALUES ('2', '1', '43');
INSERT INTO `group_member` VALUES ('3', '1', '46');

-- ----------------------------
-- Table structure for `gr_product`
-- ----------------------------
DROP TABLE IF EXISTS `gr_product`;
CREATE TABLE `gr_product` (
  `id_gr_product` int(11) NOT NULL AUTO_INCREMENT,
  `gr` int(11) NOT NULL,
  `product` bigint(20) NOT NULL,
  `qty` float NOT NULL DEFAULT '0',
  `uom` int(11) NOT NULL,
  PRIMARY KEY (`id_gr_product`),
  KEY `fk_gr_product_gr1_idx` (`gr`),
  KEY `fk_gr_product_product1_idx` (`product`),
  KEY `fk_gr_product_unit_measure1_idx` (`uom`),
  CONSTRAINT `fk_gr_product_gr1` FOREIGN KEY (`gr`) REFERENCES `gr` (`id_gr`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_gr_product_product1` FOREIGN KEY (`product`) REFERENCES `product` (`id_product`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_gr_product_unit_measure1` FOREIGN KEY (`uom`) REFERENCES `unit_measure` (`id_unit_measure`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of gr_product
-- ----------------------------
INSERT INTO `gr_product` VALUES ('1', '1', '2', '10', '2');
INSERT INTO `gr_product` VALUES ('2', '1', '3', '5', '2');
INSERT INTO `gr_product` VALUES ('3', '2', '2', '10', '2');

-- ----------------------------
-- Table structure for `gudang`
-- ----------------------------
DROP TABLE IF EXISTS `gudang`;
CREATE TABLE `gudang` (
  `id_warehouse` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `address` text NOT NULL,
  `note` text,
  `kode_lokasi` varchar(45) NOT NULL,
  `is_virtual` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_warehouse`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of gudang
-- ----------------------------
INSERT INTO `gudang` VALUES ('1', 'bb', 'bb', 'bb', 'bb', '0');
INSERT INTO `gudang` VALUES ('2', 'gg', 'gg', 'ggg', 'ggg', '0');
INSERT INTO `gudang` VALUES ('3', 'Finish Product', '', '', 'prod', '0');
INSERT INTO `gudang` VALUES ('4', 'Raw Material', '', '', 'raw', '0');
INSERT INTO `gudang` VALUES ('5', 'Virtual Location', '', '', 'vloc', '1');

-- ----------------------------
-- Table structure for `inquiry`
-- ----------------------------
DROP TABLE IF EXISTS `inquiry`;
CREATE TABLE `inquiry` (
  `id_inquiry` int(11) NOT NULL AUTO_INCREMENT,
  `inquiry_number` varchar(45) DEFAULT NULL,
  `inquiry_date` date NOT NULL,
  `customer` int(11) NOT NULL,
  `expected_delivery` date NOT NULL,
  `notes` text,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_inquiry`),
  KEY `fk_inquiry_ext_company1_idx` (`customer`),
  CONSTRAINT `fk_inquiry_ext_company1` FOREIGN KEY (`customer`) REFERENCES `ext_company` (`id_ext_company`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of inquiry
-- ----------------------------
INSERT INTO `inquiry` VALUES ('1', 'INQ150001', '2015-02-11', '4', '2015-02-11', 'ok', 'open');
INSERT INTO `inquiry` VALUES ('2', 'INQ150002', '2015-03-06', '4', '2015-03-10', '', 'open');
INSERT INTO `inquiry` VALUES ('3', 'INQ150003', '2015-03-18', '4', '2015-03-18', '', 'close');
INSERT INTO `inquiry` VALUES ('4', 'INQ150004', '2015-03-28', '4', '2015-03-28', 'ok', 'close');
INSERT INTO `inquiry` VALUES ('5', 'INQ150005', '2015-03-29', '4', '2015-03-29', 'ok 1', 'close');
INSERT INTO `inquiry` VALUES ('6', 'INQ150006', '2015-04-02', '4', '2015-04-06', '', 'open');

-- ----------------------------
-- Table structure for `inquiry_product`
-- ----------------------------
DROP TABLE IF EXISTS `inquiry_product`;
CREATE TABLE `inquiry_product` (
  `id_inquiry_product` int(11) NOT NULL AUTO_INCREMENT,
  `inquiry` int(11) NOT NULL,
  `product` bigint(20) NOT NULL,
  `uom` int(11) NOT NULL,
  `qty_request` float DEFAULT NULL,
  `qty_deliver` float DEFAULT NULL,
  `remark` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_inquiry_product`),
  KEY `fk_inquiry_product_inquiry1_idx` (`inquiry`),
  KEY `fk_inquiry_product_product1_idx` (`product`),
  KEY `fk_inquiry_product_unit_measure1_idx` (`uom`),
  CONSTRAINT `fk_inquiry_product_inquiry1` FOREIGN KEY (`inquiry`) REFERENCES `inquiry` (`id_inquiry`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_inquiry_product_product1` FOREIGN KEY (`product`) REFERENCES `product` (`id_product`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_inquiry_product_unit_measure1` FOREIGN KEY (`uom`) REFERENCES `unit_measure` (`id_unit_measure`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of inquiry_product
-- ----------------------------
INSERT INTO `inquiry_product` VALUES ('1', '1', '2', '2', '0', '0', '');
INSERT INTO `inquiry_product` VALUES ('2', '2', '4', '19', '10', '10', '');
INSERT INTO `inquiry_product` VALUES ('3', '3', '2', '2', '10', '10', 'ok');
INSERT INTO `inquiry_product` VALUES ('4', '4', '2', '2', '10', '10', 'ok1');
INSERT INTO `inquiry_product` VALUES ('5', '4', '3', '2', '5', '5', 'ok2');
INSERT INTO `inquiry_product` VALUES ('6', '5', '2', '2', '10', '10', 'OK');
INSERT INTO `inquiry_product` VALUES ('7', '5', '3', '2', '20', '20', 'OK 2');
INSERT INTO `inquiry_product` VALUES ('8', '6', '4', '19', '0', '0', '');

-- ----------------------------
-- Table structure for `insentive`
-- ----------------------------
DROP TABLE IF EXISTS `insentive`;
CREATE TABLE `insentive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `master_salary_type_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `payroll_periode_id` int(11) DEFAULT NULL,
  `nominal` double DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of insentive
-- ----------------------------
INSERT INTO `insentive` VALUES ('1', '0', '0', '0', '500000', '500000');
INSERT INTO `insentive` VALUES ('3', '5', '8', '2', '350000', 'Tambahan Pajak');
INSERT INTO `insentive` VALUES ('4', '7', '8', '2', '2300000', 'Bagi Hasil ');
INSERT INTO `insentive` VALUES ('5', '0', '0', '0', '2500000', '252525');
INSERT INTO `insentive` VALUES ('7', '0', '0', '0', '5000000', 'Lima Juta Rupiah');
INSERT INTO `insentive` VALUES ('8', '0', '0', '0', '5000000', '500000');
INSERT INTO `insentive` VALUES ('9', '0', '0', '0', '0', '');
INSERT INTO `insentive` VALUES ('10', '0', '0', '0', '400000', '0');
INSERT INTO `insentive` VALUES ('11', '0', '0', '0', '0', '0');
INSERT INTO `insentive` VALUES ('13', '0', '0', '0', '5000000', 'Lima Ratus Ribu Rupiah');
INSERT INTO `insentive` VALUES ('14', '0', '0', '0', '700000', 'Lembur Tambahan');
INSERT INTO `insentive` VALUES ('15', '0', '0', '0', '700000', 'Tujuh Ratus Ribu Rupiah');
INSERT INTO `insentive` VALUES ('16', '3', '0', '0', '70000', 'Uang Makan');
INSERT INTO `insentive` VALUES ('17', '2', '0', '0', '700000', 'Lembur');
INSERT INTO `insentive` VALUES ('18', '2', '0', '0', '500000', 'Gapok');

-- ----------------------------
-- Table structure for `internal_delivery`
-- ----------------------------
DROP TABLE IF EXISTS `internal_delivery`;
CREATE TABLE `internal_delivery` (
  `id_internal_delivery` int(11) NOT NULL AUTO_INCREMENT,
  `mr` int(11) DEFAULT NULL,
  `so` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `id_number` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL,
  PRIMARY KEY (`id_internal_delivery`),
  KEY `fk_internal_delivery_mr1_idx` (`mr`),
  KEY `fk_internal_delivery_so1_idx` (`so`),
  CONSTRAINT `fk_internal_delivery_mr1` FOREIGN KEY (`mr`) REFERENCES `mr` (`id_mr`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_internal_delivery_so1` FOREIGN KEY (`so`) REFERENCES `so` (`id_so`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of internal_delivery
-- ----------------------------

-- ----------------------------
-- Table structure for `internal_delivery_product`
-- ----------------------------
DROP TABLE IF EXISTS `internal_delivery_product`;
CREATE TABLE `internal_delivery_product` (
  `id_internal_delivery_product` int(11) NOT NULL AUTO_INCREMENT,
  `internal_delivery` int(11) NOT NULL,
  `product` bigint(20) NOT NULL,
  `qty` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id_internal_delivery_product`),
  KEY `fk_internal_delivery_product_internal_delivery1_idx` (`internal_delivery`),
  KEY `fk_internal_delivery_product_product1_idx` (`product`),
  CONSTRAINT `fk_internal_delivery_product_internal_delivery1` FOREIGN KEY (`internal_delivery`) REFERENCES `internal_delivery` (`id_internal_delivery`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_internal_delivery_product_product1` FOREIGN KEY (`product`) REFERENCES `product` (`id_product`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of internal_delivery_product
-- ----------------------------

-- ----------------------------
-- Table structure for `internal_delivery_return`
-- ----------------------------
DROP TABLE IF EXISTS `internal_delivery_return`;
CREATE TABLE `internal_delivery_return` (
  `id_internal_delivery_return` int(11) NOT NULL,
  `date` date NOT NULL,
  `idr_number` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL,
  `from` varchar(45) NOT NULL,
  `to` varchar(45) NOT NULL,
  `note` varchar(45) DEFAULT NULL,
  `so` int(11) NOT NULL,
  PRIMARY KEY (`id_internal_delivery_return`),
  KEY `fk_internal_delivery_return_so1_idx` (`so`),
  CONSTRAINT `fk_internal_delivery_return_so1` FOREIGN KEY (`so`) REFERENCES `so` (`id_so`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of internal_delivery_return
-- ----------------------------

-- ----------------------------
-- Table structure for `internal_delivery_return_product`
-- ----------------------------
DROP TABLE IF EXISTS `internal_delivery_return_product`;
CREATE TABLE `internal_delivery_return_product` (
  `id_internal_delivery_return_product` int(11) NOT NULL,
  `internal_delivery_return` int(11) NOT NULL,
  `qty` float NOT NULL,
  `uom` int(11) NOT NULL,
  `product` bigint(20) NOT NULL,
  `source_location` int(11) NOT NULL,
  PRIMARY KEY (`id_internal_delivery_return_product`),
  KEY `fk_internal_delivery_return_product_internal_delivery_retur_idx` (`internal_delivery_return`),
  KEY `fk_internal_delivery_return_product_unit_measure1_idx` (`uom`),
  KEY `fk_internal_delivery_return_product_product1_idx` (`product`),
  KEY `fk_internal_delivery_return_product_gudang1_idx` (`source_location`),
  CONSTRAINT `fk_internal_delivery_return_product_gudang1` FOREIGN KEY (`source_location`) REFERENCES `gudang` (`id_warehouse`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_internal_delivery_return_product_internal_delivery_return1` FOREIGN KEY (`internal_delivery_return`) REFERENCES `internal_delivery_return` (`id_internal_delivery_return`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_internal_delivery_return_product_product1` FOREIGN KEY (`product`) REFERENCES `product` (`id_product`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_internal_delivery_return_product_unit_measure1` FOREIGN KEY (`uom`) REFERENCES `unit_measure` (`id_unit_measure`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of internal_delivery_return_product
-- ----------------------------

-- ----------------------------
-- Table structure for `invoice`
-- ----------------------------
DROP TABLE IF EXISTS `invoice`;
CREATE TABLE `invoice` (
  `id_invoice` int(11) NOT NULL,
  `sub_total` float NOT NULL,
  `tax` float NOT NULL,
  `total_price` float NOT NULL,
  `total_payment` float NOT NULL,
  `status` varchar(45) NOT NULL,
  `invoice_receipt_number` varchar(45) NOT NULL,
  `invoice_date` date NOT NULL,
  `invoice_method` varchar(45) DEFAULT NULL,
  `so` int(11) NOT NULL,
  `rekening` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_invoice`),
  KEY `fk_invoice_so1_idx` (`so`),
  KEY `fk_invoice_bank1_idx` (`rekening`),
  CONSTRAINT `fk_invoice_bank1` FOREIGN KEY (`rekening`) REFERENCES `bank` (`id_bank`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_invoice_so1` FOREIGN KEY (`so`) REFERENCES `so` (`id_so`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of invoice
-- ----------------------------

-- ----------------------------
-- Table structure for `join_item`
-- ----------------------------
DROP TABLE IF EXISTS `join_item`;
CREATE TABLE `join_item` (
  `id_join_item` int(11) NOT NULL AUTO_INCREMENT,
  `join_item_number` varchar(45) NOT NULL,
  `date` date NOT NULL,
  `activity` varchar(45) NOT NULL,
  `qty` float DEFAULT NULL,
  `bom` int(11) NOT NULL,
  `gudang` int(11) DEFAULT NULL,
  `status` varchar(45) NOT NULL,
  PRIMARY KEY (`id_join_item`),
  KEY `fk_join_item_bom1_idx` (`bom`),
  KEY `fk_join_item_gudang1_idx` (`gudang`),
  CONSTRAINT `fk_join_item_bom1` FOREIGN KEY (`bom`) REFERENCES `bom` (`id_bom`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_join_item_gudang1` FOREIGN KEY (`gudang`) REFERENCES `gudang` (`id_warehouse`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of join_item
-- ----------------------------

-- ----------------------------
-- Table structure for `join_item_product`
-- ----------------------------
DROP TABLE IF EXISTS `join_item_product`;
CREATE TABLE `join_item_product` (
  `id_join_item_product` int(11) NOT NULL AUTO_INCREMENT,
  `product` bigint(20) NOT NULL,
  `qty_bom` float NOT NULL,
  `qty_transfer` float NOT NULL,
  `gudang` int(11) DEFAULT NULL,
  `join_item` int(11) NOT NULL,
  PRIMARY KEY (`id_join_item_product`),
  KEY `fk_join_item_product_product1_idx` (`product`),
  KEY `fk_join_item_product_gudang1_idx` (`gudang`),
  KEY `fk_join_item_product_join_item1_idx` (`join_item`),
  CONSTRAINT `fk_join_item_product_gudang1` FOREIGN KEY (`gudang`) REFERENCES `gudang` (`id_warehouse`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_join_item_product_join_item1` FOREIGN KEY (`join_item`) REFERENCES `join_item` (`id_join_item`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_join_item_product_product1` FOREIGN KEY (`product`) REFERENCES `product` (`id_product`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of join_item_product
-- ----------------------------

-- ----------------------------
-- Table structure for `languages`
-- ----------------------------
DROP TABLE IF EXISTS `languages`;
CREATE TABLE `languages` (
  `id_languages` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id_languages`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of languages
-- ----------------------------
INSERT INTO `languages` VALUES ('1', 'Indonesia');
INSERT INTO `languages` VALUES ('2', 'English');
INSERT INTO `languages` VALUES ('3', 'Japanese');
INSERT INTO `languages` VALUES ('4', 'Mandarin');
INSERT INTO `languages` VALUES ('5', 'Malay');
INSERT INTO `languages` VALUES ('6', 'Dutch');
INSERT INTO `languages` VALUES ('7', 'France');
INSERT INTO `languages` VALUES ('8', 'Korean');

-- ----------------------------
-- Table structure for `language_fluency`
-- ----------------------------
DROP TABLE IF EXISTS `language_fluency`;
CREATE TABLE `language_fluency` (
  `id_language_fluency` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `value` int(11) NOT NULL,
  PRIMARY KEY (`id_language_fluency`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of language_fluency
-- ----------------------------
INSERT INTO `language_fluency` VALUES ('1', 'basic', '1');
INSERT INTO `language_fluency` VALUES ('2', 'middle', '2');
INSERT INTO `language_fluency` VALUES ('3', 'advance', '3');

-- ----------------------------
-- Table structure for `master_salary_type`
-- ----------------------------
DROP TABLE IF EXISTS `master_salary_type`;
CREATE TABLE `master_salary_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `salary_code` varchar(15) DEFAULT NULL,
  `salary_type` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of master_salary_type
-- ----------------------------
INSERT INTO `master_salary_type` VALUES ('1', 'ST1', 'Gaji Pokok', '%bulan% X %base_salary%');
INSERT INTO `master_salary_type` VALUES ('2', 'ST2', 'Overtime', ' %jam% X %base_overtime%');
INSERT INTO `master_salary_type` VALUES ('3', 'ST3', 'Uang Makan', '%hari% X %base_uang_makan%');
INSERT INTO `master_salary_type` VALUES ('4', 'ST4', 'Uang Transport', null);
INSERT INTO `master_salary_type` VALUES ('5', 'ST5', 'Pajak Pendapatan', ' - %15/100% X %base_salary%');
INSERT INTO `master_salary_type` VALUES ('6', 'ST6', 'Komisi ', null);
INSERT INTO `master_salary_type` VALUES ('7', 'ST7', 'Bagi Hasil Tahunan', null);
INSERT INTO `master_salary_type` VALUES ('8', 'ST8', 'Uang Bagi Hasil juga', null);
INSERT INTO `master_salary_type` VALUES ('10', 'ST9', 'Coba aja', null);

-- ----------------------------
-- Table structure for `merk`
-- ----------------------------
DROP TABLE IF EXISTS `merk`;
CREATE TABLE `merk` (
  `id_merk` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `abbreviation` varchar(45) NOT NULL,
  PRIMARY KEY (`id_merk`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of merk
-- ----------------------------
INSERT INTO `merk` VALUES ('2', 'Merk1', 'm1');
INSERT INTO `merk` VALUES ('4', 'Wavin', 'WVN');
INSERT INTO `merk` VALUES ('5', 'RUCIKA', 'RCK');

-- ----------------------------
-- Table structure for `mr`
-- ----------------------------
DROP TABLE IF EXISTS `mr`;
CREATE TABLE `mr` (
  `id_mr` int(11) NOT NULL AUTO_INCREMENT,
  `project_list` int(11) NOT NULL,
  `date` date NOT NULL,
  `mr_number` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL,
  PRIMARY KEY (`id_mr`),
  KEY `fk_mr_project_list1_idx` (`project_list`),
  CONSTRAINT `fk_mr_project_list1` FOREIGN KEY (`project_list`) REFERENCES `project_list` (`id_project_list`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of mr
-- ----------------------------

-- ----------------------------
-- Table structure for `mr_product`
-- ----------------------------
DROP TABLE IF EXISTS `mr_product`;
CREATE TABLE `mr_product` (
  `id_mr_product` int(11) NOT NULL AUTO_INCREMENT,
  `mr` int(11) NOT NULL,
  `product` bigint(20) NOT NULL,
  `qty` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id_mr_product`),
  KEY `fk_mr_product_mr1_idx` (`mr`),
  KEY `fk_mr_product_product1_idx` (`product`),
  CONSTRAINT `fk_mr_product_mr1` FOREIGN KEY (`mr`) REFERENCES `mr` (`id_mr`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_mr_product_product1` FOREIGN KEY (`product`) REFERENCES `product` (`id_product`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of mr_product
-- ----------------------------

-- ----------------------------
-- Table structure for `notification_setting`
-- ----------------------------
DROP TABLE IF EXISTS `notification_setting`;
CREATE TABLE `notification_setting` (
  `id_notification_setting` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `description` text,
  `email_template_header` text,
  PRIMARY KEY (`id_notification_setting`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of notification_setting
-- ----------------------------

-- ----------------------------
-- Table structure for `notification_setting_action`
-- ----------------------------
DROP TABLE IF EXISTS `notification_setting_action`;
CREATE TABLE `notification_setting_action` (
  `id_notification_setting_action` int(11) NOT NULL AUTO_INCREMENT,
  `notification_setting` int(11) NOT NULL,
  `action` int(11) NOT NULL,
  PRIMARY KEY (`id_notification_setting_action`),
  KEY `fk_notification_setting_action_notification_setting1_idx` (`notification_setting`),
  KEY `fk_notification_setting_action_application_action1_idx` (`action`),
  CONSTRAINT `fk_notification_setting_action_application_action1` FOREIGN KEY (`action`) REFERENCES `application_action` (`id_application_action`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_notification_setting_action_notification_setting1` FOREIGN KEY (`notification_setting`) REFERENCES `notification_setting` (`id_notification_setting`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of notification_setting_action
-- ----------------------------

-- ----------------------------
-- Table structure for `notification_setting_group`
-- ----------------------------
DROP TABLE IF EXISTS `notification_setting_group`;
CREATE TABLE `notification_setting_group` (
  `id_notification_setting_group` int(11) NOT NULL AUTO_INCREMENT,
  `notification_setting` int(11) NOT NULL,
  `group` int(11) NOT NULL,
  PRIMARY KEY (`id_notification_setting_group`),
  KEY `fk_notification_setting_group_notification_setting1_idx` (`notification_setting`),
  KEY `fk_notification_setting_group_group1_idx` (`group`),
  CONSTRAINT `fk_notification_setting_group_group1` FOREIGN KEY (`group`) REFERENCES `group` (`id_group`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_notification_setting_group_notification_setting1` FOREIGN KEY (`notification_setting`) REFERENCES `notification_setting` (`id_notification_setting`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of notification_setting_group
-- ----------------------------

-- ----------------------------
-- Table structure for `object_identifier`
-- ----------------------------
DROP TABLE IF EXISTS `object_identifier`;
CREATE TABLE `object_identifier` (
  `id_object_identifier` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_object_identifier`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of object_identifier
-- ----------------------------

-- ----------------------------
-- Table structure for `object_owning`
-- ----------------------------
DROP TABLE IF EXISTS `object_owning`;
CREATE TABLE `object_owning` (
  `id_object_owning` int(11) NOT NULL AUTO_INCREMENT,
  `object` int(11) NOT NULL,
  `object_type` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL,
  `datetime` datetime NOT NULL,
  `user` int(11) NOT NULL,
  `object_id` text NOT NULL,
  PRIMARY KEY (`id_object_owning`),
  KEY `fk_object_owning_user1_idx` (`user`),
  CONSTRAINT `fk_object_owning_user1` FOREIGN KEY (`user`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of object_owning
-- ----------------------------

-- ----------------------------
-- Table structure for `organisation_structure`
-- ----------------------------
DROP TABLE IF EXISTS `organisation_structure`;
CREATE TABLE `organisation_structure` (
  `id_organisation_structure` int(11) NOT NULL AUTO_INCREMENT,
  `structure_name` varchar(45) NOT NULL,
  `parent_structure` int(11) DEFAULT NULL,
  `employment_type` int(11) NOT NULL,
  `position_type` varchar(45) NOT NULL,
  PRIMARY KEY (`id_organisation_structure`),
  KEY `fk_organisation_structure_organisation_structure1_idx` (`parent_structure`),
  KEY `fk_organisation_structure_employment_type1_idx` (`employment_type`),
  CONSTRAINT `fk_organisation_structure_employment_type1` FOREIGN KEY (`employment_type`) REFERENCES `employment_type` (`id_employment_type`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_organisation_structure_organisation_structure1` FOREIGN KEY (`parent_structure`) REFERENCES `organisation_structure` (`id_organisation_structure`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of organisation_structure
-- ----------------------------
INSERT INTO `organisation_structure` VALUES ('2', 'President Director', null, '0', 'non_service');
INSERT INTO `organisation_structure` VALUES ('3', 'Operational Director', '2', '0', 'non_service');
INSERT INTO `organisation_structure` VALUES ('4', 'Business Development Manager', '3', '0', 'non_service');
INSERT INTO `organisation_structure` VALUES ('5', 'OPS Manager', '3', '0', 'non_service');
INSERT INTO `organisation_structure` VALUES ('6', 'HR Manager', '3', '0', 'non_service');
INSERT INTO `organisation_structure` VALUES ('7', 'Finance Manager', '3', '0', 'non_service');
INSERT INTO `organisation_structure` VALUES ('8', 'GA Manager', '3', '0', 'non_service');
INSERT INTO `organisation_structure` VALUES ('9', 'Security Supervisor', null, '2', 'service');
INSERT INTO `organisation_structure` VALUES ('10', 'Shift Leader', '9', '2', 'service');
INSERT INTO `organisation_structure` VALUES ('11', 'Security Office', '10', '2', 'service');

-- ----------------------------
-- Table structure for `overtime`
-- ----------------------------
DROP TABLE IF EXISTS `overtime`;
CREATE TABLE `overtime` (
  `id_overtime` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_security` int(11) DEFAULT NULL,
  `date_overtime` date DEFAULT NULL,
  `from_overtime` time DEFAULT NULL,
  `to_overtime` time DEFAULT NULL,
  `hours_overtime` double DEFAULT NULL,
  `supervisor` int(11) DEFAULT NULL,
  `description` text,
  `status` enum('validated','created') DEFAULT 'created',
  PRIMARY KEY (`id_overtime`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of overtime
-- ----------------------------
INSERT INTO `overtime` VALUES ('1', '3', '1970-01-02', '12:08:25', '17:08:31', '3', '10', 'Kerja Tambahan                                                    ', 'validated');
INSERT INTO `overtime` VALUES ('9', '15', '2015-04-01', '16:00:00', '20:00:00', '4', '4', '                            Jaga Tambahan                                                                            ', 'validated');
INSERT INTO `overtime` VALUES ('10', '15', '2015-03-10', '06:00:00', '10:00:00', '4', '4', '                                                        OK Bro                                                                                                    ', 'validated');
INSERT INTO `overtime` VALUES ('12', '8', '2015-03-01', '03:00:00', '06:00:00', '6', '14', 'Kerja Tambahan                                            ', 'validated');
INSERT INTO `overtime` VALUES ('13', '9', '2015-04-07', '00:00:00', '00:00:00', '5', '14', '5555                                                    ', 'validated');
INSERT INTO `overtime` VALUES ('14', '8', '1970-01-01', '00:00:00', '00:00:00', '2', '14', '                                                    ', 'validated');
INSERT INTO `overtime` VALUES ('15', '3', '2015-03-03', '00:00:00', '00:00:00', '2', '14', 'ok                                                    ', 'validated');

-- ----------------------------
-- Table structure for `payment_receipt`
-- ----------------------------
DROP TABLE IF EXISTS `payment_receipt`;
CREATE TABLE `payment_receipt` (
  `id_payment_receipt` int(11) NOT NULL AUTO_INCREMENT,
  `po` int(11) NOT NULL,
  `sub_total` float NOT NULL,
  `tax` float NOT NULL,
  `total_price` float NOT NULL,
  `total_payment` float NOT NULL,
  `status` varchar(45) NOT NULL,
  `payment_receipt_number` varchar(45) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_method` varchar(45) DEFAULT NULL,
  `rekening` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_payment_receipt`),
  KEY `fk_payment_receipt_po1_idx` (`po`),
  CONSTRAINT `fk_payment_receipt_po1` FOREIGN KEY (`po`) REFERENCES `po` (`id_po`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of payment_receipt
-- ----------------------------
INSERT INTO `payment_receipt` VALUES ('1', '1', '4225000', '422500', '4647500', '3000000', 'close', 'PR150001', '2015-01-25', 'cash', '');
INSERT INTO `payment_receipt` VALUES ('2', '1', '4225000', '422500', '4647500', '1647500', 'close', 'PR150002', '2015-01-25', 'transfer', '123332');
INSERT INTO `payment_receipt` VALUES ('3', '3', '1000000', '100000', '1100000', '500000', 'close', 'PR150003', '2015-01-30', 'transfer', '');
INSERT INTO `payment_receipt` VALUES ('4', '3', '1000000', '100000', '1100000', '600000', 'close', 'PR150004', '2015-01-30', 'transfer', '');

-- ----------------------------
-- Table structure for `payroll`
-- ----------------------------
DROP TABLE IF EXISTS `payroll`;
CREATE TABLE `payroll` (
  `id_payroll` int(11) NOT NULL AUTO_INCREMENT,
  `process_date` date NOT NULL,
  `period_start` date NOT NULL,
  `period_end` date NOT NULL,
  `customer` int(11) NOT NULL,
  `overtime` int(11) NOT NULL,
  PRIMARY KEY (`id_payroll`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of payroll
-- ----------------------------

-- ----------------------------
-- Table structure for `payroll_periode`
-- ----------------------------
DROP TABLE IF EXISTS `payroll_periode`;
CREATE TABLE `payroll_periode` (
  `id_payroll_periode` int(11) NOT NULL AUTO_INCREMENT,
  `periode_name` varchar(25) DEFAULT NULL,
  `date_start` date DEFAULT NULL,
  `date_finish` date DEFAULT NULL,
  `status` enum('draft','generate_all','generate_partial') DEFAULT 'draft',
  PRIMARY KEY (`id_payroll_periode`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of payroll_periode
-- ----------------------------
INSERT INTO `payroll_periode` VALUES ('1', 'Januari 2015', '2015-03-01', '2015-04-01', 'draft');
INSERT INTO `payroll_periode` VALUES ('2', 'Februari 2015', '2015-04-01', '2015-05-01', 'draft');
INSERT INTO `payroll_periode` VALUES ('3', 'Maret 2015', '2015-03-01', '2015-03-31', 'draft');

-- ----------------------------
-- Table structure for `payroll_wo`
-- ----------------------------
DROP TABLE IF EXISTS `payroll_wo`;
CREATE TABLE `payroll_wo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `payroll_periode_id` int(11) DEFAULT NULL,
  `work_order_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of payroll_wo
-- ----------------------------
INSERT INTO `payroll_wo` VALUES ('11', '3', '6');

-- ----------------------------
-- Table structure for `payslip`
-- ----------------------------
DROP TABLE IF EXISTS `payslip`;
CREATE TABLE `payslip` (
  `id_payslip` int(11) NOT NULL AUTO_INCREMENT,
  `employee` int(11) NOT NULL,
  `position` varchar(45) DEFAULT NULL,
  `total_hours_reguler` int(11) DEFAULT NULL,
  `total_hours_ot` int(11) DEFAULT NULL,
  `salary` float DEFAULT NULL,
  `total_pay` float DEFAULT NULL,
  `tax` int(11) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_payslip`),
  KEY `fk_employee_idx` (`employee`),
  CONSTRAINT `fk_employee` FOREIGN KEY (`employee`) REFERENCES `employeex` (`id_employee`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of payslip
-- ----------------------------

-- ----------------------------
-- Table structure for `po`
-- ----------------------------
DROP TABLE IF EXISTS `po`;
CREATE TABLE `po` (
  `id_po` int(11) NOT NULL AUTO_INCREMENT,
  `supplier` int(11) NOT NULL,
  `po_number` varchar(45) NOT NULL,
  `note` varchar(45) DEFAULT NULL,
  `date` date NOT NULL,
  `status` varchar(45) NOT NULL,
  `delivery_date` date DEFAULT NULL,
  `mr` int(11) DEFAULT NULL,
  `user_create` int(11) NOT NULL,
  `date_create` datetime NOT NULL,
  `source` varchar(45) DEFAULT NULL COMMENT 'source:\nMR\nReorder Point\nMake Stock',
  `total_price` float NOT NULL,
  `tax` float NOT NULL,
  `sub_total` float NOT NULL,
  PRIMARY KEY (`id_po`),
  KEY `fk_po_supplier1_idx` (`supplier`),
  KEY `fk_po_mr1_idx` (`mr`),
  KEY `fk_po_user1_idx` (`user_create`),
  CONSTRAINT `fk_po_mr1` FOREIGN KEY (`mr`) REFERENCES `mr` (`id_mr`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_po_user1` FOREIGN KEY (`user_create`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of po
-- ----------------------------
INSERT INTO `po` VALUES ('1', '1', 'PO150001', '', '2015-01-24', 'close', '2015-01-29', null, '2', '2015-01-24 23:50:23', 'make_stock', '4647500', '422500', '4225000');
INSERT INTO `po` VALUES ('2', '1', 'PO150002', '', '2015-01-25', 'open', '2015-01-29', null, '2', '2015-01-25 00:01:19', 'make_stock', '495000', '45000', '450000');
INSERT INTO `po` VALUES ('3', '1', 'PO150003', '', '2015-01-30', 'close', '2015-01-31', null, '2', '2015-01-30 20:30:09', 'make_stock', '1100000', '100000', '1000000');

-- ----------------------------
-- Table structure for `position_level`
-- ----------------------------
DROP TABLE IF EXISTS `position_level`;
CREATE TABLE `position_level` (
  `id_position_level` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL COMMENT 'Associate, Mid, Senior, Advisor',
  `position_code` varchar(45) NOT NULL,
  `weight` float DEFAULT NULL,
  PRIMARY KEY (`id_position_level`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of position_level
-- ----------------------------
INSERT INTO `position_level` VALUES ('1', 'Associate', 'ASC', '1');
INSERT INTO `position_level` VALUES ('2', 'Middle', 'MID', '2');
INSERT INTO `position_level` VALUES ('3', 'Senior', 'SNR', '3');

-- ----------------------------
-- Table structure for `po_product`
-- ----------------------------
DROP TABLE IF EXISTS `po_product`;
CREATE TABLE `po_product` (
  `id_po_product` int(11) NOT NULL AUTO_INCREMENT,
  `po` int(11) NOT NULL,
  `product` bigint(20) NOT NULL,
  `qty` float NOT NULL,
  `unit_price` float NOT NULL,
  `total_price` float NOT NULL,
  `uom` int(11) NOT NULL,
  `qty_received` float NOT NULL DEFAULT '0',
  `product_barcode` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`id_po_product`),
  KEY `fk_po_product_po1_idx` (`po`),
  KEY `fk_po_product_product1_idx` (`product`),
  KEY `fk_po_product_unit_measure1_idx` (`uom`),
  CONSTRAINT `fk_po_product_po1` FOREIGN KEY (`po`) REFERENCES `po` (`id_po`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_po_product_product1` FOREIGN KEY (`product`) REFERENCES `product` (`id_product`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_po_product_unit_measure1` FOREIGN KEY (`uom`) REFERENCES `unit_measure` (`id_unit_measure`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of po_product
-- ----------------------------
INSERT INTO `po_product` VALUES ('1', '1', '2', '10', '250000', '2500000', '2', '10', null);
INSERT INTO `po_product` VALUES ('2', '1', '3', '5', '345000', '1725000', '2', '5', null);
INSERT INTO `po_product` VALUES ('3', '2', '3', '3', '150000', '450000', '2', '0', null);
INSERT INTO `po_product` VALUES ('4', '3', '2', '10', '100000', '1000000', '2', '10', null);

-- ----------------------------
-- Table structure for `product`
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id_product` bigint(20) NOT NULL AUTO_INCREMENT,
  `product_code` varchar(20) NOT NULL,
  `product_category` int(11) NOT NULL,
  `product_name` varchar(45) NOT NULL,
  `type` int(11) DEFAULT NULL,
  `merk` int(11) NOT NULL,
  `description` text,
  `is_service` tinyint(1) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `unit` int(11) NOT NULL,
  `image` text,
  `is_finish_product` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_product`),
  KEY `fk_product_product_category1_idx` (`product_category`),
  KEY `fk_product_type_material1_idx` (`type`),
  KEY `fk_product_merk1_idx` (`merk`),
  KEY `fk_product_unit_measure1_idx` (`unit`),
  CONSTRAINT `fk_product_merk1` FOREIGN KEY (`merk`) REFERENCES `merk` (`id_merk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_product_category1` FOREIGN KEY (`product_category`) REFERENCES `product_category` (`id_product_category`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_type_material1` FOREIGN KEY (`type`) REFERENCES `type_material` (`id_type_material`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_unit_measure1` FOREIGN KEY (`unit`) REFERENCES `unit_measure` (`id_unit_measure`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO `product` VALUES ('2', 'XXX.XXX.XXX.001', '1', 'Product Test', null, '2', 'Dummy Product', '1', '1', '2', null, '0');
INSERT INTO `product` VALUES ('3', 'XXX.XXX.XXX.002', '3', 'Product Test 3', null, '2', 'Test 3', '1', '1', '2', null, '0');
INSERT INTO `product` VALUES ('4', '___.___.___.___', '1', 'Security Office', null, '2', '', '1', '1', '19', null, '0');
INSERT INTO `product` VALUES ('5', '___.___.___.___', '1', 'Security Supervisor', null, '2', '', '1', '1', '19', null, '0');
INSERT INTO `product` VALUES ('6', '___.___.___.___', '1', 'Shift Leader', null, '2', '', '1', '1', '19', null, '0');
INSERT INTO `product` VALUES ('7', 'XXX.XXX.XXX.003', '1', 'Seragam', null, '2', 'Seragam', '1', '1', '2', null, '0');
INSERT INTO `product` VALUES ('8', 'XXX.XXX.XXX.004', '1', 'Topi', null, '2', 'Topi', '1', '1', '2', null, '0');
INSERT INTO `product` VALUES ('9', 'XXX.XXX.XXX.005', '1', 'Ikat Pinggang', null, '2', 'Ikat Pinggang', '1', '1', '2', null, '0');
INSERT INTO `product` VALUES ('10', 'XXX.XXX.XXX.006', '1', 'Seragam Khusus', null, '2', 'Seragam Khusus Supervisor', '1', '1', '2', null, '0');

-- ----------------------------
-- Table structure for `product_buy_price`
-- ----------------------------
DROP TABLE IF EXISTS `product_buy_price`;
CREATE TABLE `product_buy_price` (
  `id_product_buy_price` bigint(20) NOT NULL AUTO_INCREMENT,
  `product` bigint(20) NOT NULL,
  `supplier` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_product_buy_price`),
  KEY `fk_product_buy_price_product1_idx` (`product`),
  KEY `fk_product_buy_price_supplier1_idx` (`supplier`),
  CONSTRAINT `fk_product_buy_price_product1` FOREIGN KEY (`product`) REFERENCES `product` (`id_product`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of product_buy_price
-- ----------------------------

-- ----------------------------
-- Table structure for `product_category`
-- ----------------------------
DROP TABLE IF EXISTS `product_category`;
CREATE TABLE `product_category` (
  `id_product_category` int(11) NOT NULL AUTO_INCREMENT,
  `product_category` varchar(45) NOT NULL,
  `abbreviation` varchar(45) NOT NULL,
  PRIMARY KEY (`id_product_category`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of product_category
-- ----------------------------
INSERT INTO `product_category` VALUES ('1', 'Category 1', 'cat1');
INSERT INTO `product_category` VALUES ('3', 'Category 2', 'cat2');

-- ----------------------------
-- Table structure for `product_cost_structure`
-- ----------------------------
DROP TABLE IF EXISTS `product_cost_structure`;
CREATE TABLE `product_cost_structure` (
  `id_product_cost_structure` int(11) NOT NULL AUTO_INCREMENT,
  `product` bigint(20) NOT NULL,
  `template_name` varchar(45) NOT NULL,
  `description` text,
  `status` varchar(45) NOT NULL,
  `currency` int(11) NOT NULL,
  PRIMARY KEY (`id_product_cost_structure`),
  KEY `fk_product_cost_structure_product1_idx` (`product`),
  KEY `fk_product_cost_structure_currency1_idx` (`currency`),
  CONSTRAINT `fk_product_cost_structure_currency1` FOREIGN KEY (`currency`) REFERENCES `currency` (`id_currency`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_cost_structure_product1` FOREIGN KEY (`product`) REFERENCES `product` (`id_product`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of product_cost_structure
-- ----------------------------

-- ----------------------------
-- Table structure for `product_definition`
-- ----------------------------
DROP TABLE IF EXISTS `product_definition`;
CREATE TABLE `product_definition` (
  `id_product_definition` int(11) NOT NULL AUTO_INCREMENT,
  `product` bigint(20) NOT NULL,
  `organisation_structure` int(11) NOT NULL,
  `position_level` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_product_definition`),
  KEY `fk_product_definition_product1_idx` (`product`),
  KEY `fk_product_definition_organisation_structure1_idx` (`organisation_structure`),
  KEY `fk_product_definition_position_level1_idx` (`position_level`),
  CONSTRAINT `fk_product_definition_organisation_structure1` FOREIGN KEY (`organisation_structure`) REFERENCES `organisation_structure` (`id_organisation_structure`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_definition_position_level1` FOREIGN KEY (`position_level`) REFERENCES `position_level` (`id_position_level`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_definition_product1` FOREIGN KEY (`product`) REFERENCES `product` (`id_product`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of product_definition
-- ----------------------------
INSERT INTO `product_definition` VALUES ('1', '4', '11', null);
INSERT INTO `product_definition` VALUES ('2', '5', '9', null);
INSERT INTO `product_definition` VALUES ('3', '6', '10', null);
INSERT INTO `product_definition` VALUES ('6', '7', '2', null);

-- ----------------------------
-- Table structure for `product_po_barcode`
-- ----------------------------
DROP TABLE IF EXISTS `product_po_barcode`;
CREATE TABLE `product_po_barcode` (
  `id_product_po_barcode` int(11) NOT NULL AUTO_INCREMENT,
  `product` bigint(20) NOT NULL,
  `product_barcode` varchar(12) NOT NULL,
  `po` int(11) NOT NULL,
  `qty` float NOT NULL,
  PRIMARY KEY (`id_product_po_barcode`),
  KEY `fk_product_po_barcode_product1_idx` (`product`),
  KEY `fk_product_po_barcode_po1_idx` (`po`),
  CONSTRAINT `fk_product_po_barcode_po1` FOREIGN KEY (`po`) REFERENCES `po` (`id_po`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_po_barcode_product1` FOREIGN KEY (`product`) REFERENCES `product` (`id_product`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of product_po_barcode
-- ----------------------------

-- ----------------------------
-- Table structure for `product_sell_price`
-- ----------------------------
DROP TABLE IF EXISTS `product_sell_price`;
CREATE TABLE `product_sell_price` (
  `id_product_sell_price` bigint(20) NOT NULL,
  `product` bigint(20) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id_product_sell_price`),
  KEY `fk_product_sell_price_product1_idx` (`product`),
  CONSTRAINT `fk_product_sell_price_product1` FOREIGN KEY (`product`) REFERENCES `product` (`id_product`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of product_sell_price
-- ----------------------------

-- ----------------------------
-- Table structure for `product_unit`
-- ----------------------------
DROP TABLE IF EXISTS `product_unit`;
CREATE TABLE `product_unit` (
  `id_product_unit` bigint(20) NOT NULL,
  `product_id_product` bigint(20) NOT NULL,
  `name` varchar(45) NOT NULL,
  `abbreviation` varchar(45) NOT NULL,
  PRIMARY KEY (`id_product_unit`),
  KEY `fk_product_unit_product1_idx` (`product_id_product`),
  CONSTRAINT `fk_product_unit_product1` FOREIGN KEY (`product_id_product`) REFERENCES `product` (`id_product`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of product_unit
-- ----------------------------

-- ----------------------------
-- Table structure for `project_list`
-- ----------------------------
DROP TABLE IF EXISTS `project_list`;
CREATE TABLE `project_list` (
  `id_project_list` int(11) NOT NULL AUTO_INCREMENT,
  `so` int(11) NOT NULL,
  `project_list_number` varchar(45) NOT NULL,
  `date_create` date NOT NULL,
  `note` text,
  `status` varchar(45) NOT NULL,
  `user_create` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_project_list`),
  KEY `fk_project_list_so1_idx` (`so`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of project_list
-- ----------------------------

-- ----------------------------
-- Table structure for `project_list_product`
-- ----------------------------
DROP TABLE IF EXISTS `project_list_product`;
CREATE TABLE `project_list_product` (
  `id_project_list_product` int(11) NOT NULL AUTO_INCREMENT,
  `project_list` int(11) NOT NULL,
  `product` bigint(20) NOT NULL,
  `qty` float NOT NULL,
  `unit_price` float DEFAULT NULL,
  `total_price` float DEFAULT NULL,
  `uom` int(11) NOT NULL,
  PRIMARY KEY (`id_project_list_product`),
  KEY `fk_project_list_product_project_list1_idx` (`project_list`),
  KEY `fk_project_list_product_product1_idx` (`product`),
  KEY `fk_project_list_product_unit_measure1_idx` (`uom`),
  CONSTRAINT `fk_project_list_product_product1` FOREIGN KEY (`product`) REFERENCES `product` (`id_product`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_project_list_product_project_list1` FOREIGN KEY (`project_list`) REFERENCES `project_list` (`id_project_list`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_project_list_product_unit_measure1` FOREIGN KEY (`uom`) REFERENCES `unit_measure` (`id_unit_measure`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of project_list_product
-- ----------------------------

-- ----------------------------
-- Table structure for `project_report`
-- ----------------------------
DROP TABLE IF EXISTS `project_report`;
CREATE TABLE `project_report` (
  `id_project_report` int(11) NOT NULL AUTO_INCREMENT,
  `work_order` int(11) NOT NULL,
  `subject` varchar(45) DEFAULT NULL,
  `remark` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `user` int(11) NOT NULL,
  PRIMARY KEY (`id_project_report`),
  KEY `fk_project_report_work_order1_idx` (`work_order`),
  KEY `fk_project_report_user1_idx` (`user`),
  CONSTRAINT `fk_project_report_user1` FOREIGN KEY (`user`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_project_report_work_order1` FOREIGN KEY (`work_order`) REFERENCES `work_order` (`id_work_order`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of project_report
-- ----------------------------

-- ----------------------------
-- Table structure for `project_report_files`
-- ----------------------------
DROP TABLE IF EXISTS `project_report_files`;
CREATE TABLE `project_report_files` (
  `id_project_report_files` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(45) DEFAULT NULL,
  `filepath` text NOT NULL,
  `project_report_files` int(11) NOT NULL,
  PRIMARY KEY (`id_project_report_files`),
  KEY `fk_project_report_files_project_report1_idx` (`project_report_files`),
  CONSTRAINT `fk_project_report_files_project_report1` FOREIGN KEY (`project_report_files`) REFERENCES `project_report` (`id_project_report`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of project_report_files
-- ----------------------------

-- ----------------------------
-- Table structure for `quotation`
-- ----------------------------
DROP TABLE IF EXISTS `quotation`;
CREATE TABLE `quotation` (
  `id_quotation` int(11) NOT NULL AUTO_INCREMENT,
  `quote_number` varchar(45) DEFAULT NULL,
  `quote_date` date DEFAULT NULL,
  `quotationcol` varchar(45) DEFAULT NULL,
  `inquiry` int(11) NOT NULL,
  `notes` text,
  `invoice_period` varchar(45) NOT NULL,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_quotation`),
  KEY `fk_quotation_inquiry1_idx` (`inquiry`),
  CONSTRAINT `fk_quotation_inquiry1` FOREIGN KEY (`inquiry`) REFERENCES `inquiry` (`id_inquiry`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of quotation
-- ----------------------------
INSERT INTO `quotation` VALUES ('1', 'INQ150001', '2015-02-12', null, '1', '', 'Monthly', 'open');
INSERT INTO `quotation` VALUES ('2', 'Q150002', '2015-03-18', null, '3', '', 'Monthly', 'close');
INSERT INTO `quotation` VALUES ('3', 'Q150003', '2015-03-28', null, '4', '', 'Every 3 Month', 'close');
INSERT INTO `quotation` VALUES ('4', 'Q150004', '2015-03-29', null, '5', '', 'Every 3 Month', 'close');
INSERT INTO `quotation` VALUES ('5', 'Q150005', '2015-04-08', null, '2', '', 'Monthly', 'draft');

-- ----------------------------
-- Table structure for `quotation_product`
-- ----------------------------
DROP TABLE IF EXISTS `quotation_product`;
CREATE TABLE `quotation_product` (
  `id_quotation_product` int(11) NOT NULL AUTO_INCREMENT,
  `quotation` int(11) NOT NULL,
  `product` bigint(20) NOT NULL,
  `qty` float DEFAULT NULL,
  `price` float DEFAULT NULL,
  PRIMARY KEY (`id_quotation_product`,`product`),
  KEY `fk_quotation_product_quotation1_idx` (`quotation`),
  KEY `fk_quotation_product_product1_idx` (`product`),
  CONSTRAINT `fk_quotation_product_product1` FOREIGN KEY (`product`) REFERENCES `product` (`id_product`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_quotation_product_quotation1` FOREIGN KEY (`quotation`) REFERENCES `quotation` (`id_quotation`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of quotation_product
-- ----------------------------
INSERT INTO `quotation_product` VALUES ('1', '1', '2', '10', null);
INSERT INTO `quotation_product` VALUES ('2', '2', '2', '10', '250000');
INSERT INTO `quotation_product` VALUES ('3', '3', '2', '10', '100000');
INSERT INTO `quotation_product` VALUES ('4', '3', '3', '5', '500000');
INSERT INTO `quotation_product` VALUES ('5', '4', '2', '10', '1000000');
INSERT INTO `quotation_product` VALUES ('6', '4', '3', '20', '500000');
INSERT INTO `quotation_product` VALUES ('7', '4', '6', '2', null);
INSERT INTO `quotation_product` VALUES ('8', '4', '4', '5', null);
INSERT INTO `quotation_product` VALUES ('9', '4', '5', '1', null);
INSERT INTO `quotation_product` VALUES ('10', '5', '3', '10', '100');

-- ----------------------------
-- Table structure for `quotation_survey`
-- ----------------------------
DROP TABLE IF EXISTS `quotation_survey`;
CREATE TABLE `quotation_survey` (
  `id_quotation_survey` int(11) NOT NULL AUTO_INCREMENT,
  `quotation` int(11) NOT NULL,
  `survey_assessment` int(11) NOT NULL,
  PRIMARY KEY (`id_quotation_survey`),
  KEY `fk_quotation_survey_quotation1_idx` (`quotation`),
  KEY `fk_quotation_survey_survey_assessment1_idx` (`survey_assessment`),
  CONSTRAINT `fk_quotation_survey_quotation1` FOREIGN KEY (`quotation`) REFERENCES `quotation` (`id_quotation`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_quotation_survey_survey_assessment1` FOREIGN KEY (`survey_assessment`) REFERENCES `survey_assessment` (`id_survey_assessment`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of quotation_survey
-- ----------------------------
INSERT INTO `quotation_survey` VALUES ('1', '1', '1');
INSERT INTO `quotation_survey` VALUES ('2', '2', '2');
INSERT INTO `quotation_survey` VALUES ('3', '3', '3');
INSERT INTO `quotation_survey` VALUES ('4', '3', '4');
INSERT INTO `quotation_survey` VALUES ('5', '4', '5');
INSERT INTO `quotation_survey` VALUES ('6', '4', '6');

-- ----------------------------
-- Table structure for `recruitment`
-- ----------------------------
DROP TABLE IF EXISTS `recruitment`;
CREATE TABLE `recruitment` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `alamat` text,
  `telepon` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `birt_date` date DEFAULT NULL,
  `religion` varchar(15) DEFAULT NULL,
  `gender` enum('Male','Female') DEFAULT NULL,
  `blood_type` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of recruitment
-- ----------------------------
INSERT INTO `recruitment` VALUES ('1', 'Arief', 'Jakarta Timur	', '085718908416', 'kickerif@yahoo.com', '1990-01-21', 'Islam', 'Male', 'A');
INSERT INTO `recruitment` VALUES ('2', 'Hidayat', 'Jakarta Barat', '02137834888', 'hidayat@gmail.com', '1990-02-01', 'Islam', 'Male', 'AB');
INSERT INTO `recruitment` VALUES ('3', 'Inoy Juga', 'jakarta x', '8903903940 8', 'supri170845@rocketmail.comx', '1990-04-21', 'Islam', 'Male', 'A');

-- ----------------------------
-- Table structure for `religion`
-- ----------------------------
DROP TABLE IF EXISTS `religion`;
CREATE TABLE `religion` (
  `id_religion` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id_religion`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of religion
-- ----------------------------
INSERT INTO `religion` VALUES ('1', 'Islam');
INSERT INTO `religion` VALUES ('2', 'Protestan');
INSERT INTO `religion` VALUES ('3', 'Katolik');
INSERT INTO `religion` VALUES ('4', 'Hindu');
INSERT INTO `religion` VALUES ('5', 'Budha');
INSERT INTO `religion` VALUES ('6', 'Konghucu');

-- ----------------------------
-- Table structure for `role`
-- ----------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `id_role` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of role
-- ----------------------------
INSERT INTO `role` VALUES ('1', 'administrator');
INSERT INTO `role` VALUES ('2', 'divadministrator');
INSERT INTO `role` VALUES ('3', 'standard');
INSERT INTO `role` VALUES ('10', 'Purchasing Manager');
INSERT INTO `role` VALUES ('11', 'Appilcation Administrator');

-- ----------------------------
-- Table structure for `sales_instance`
-- ----------------------------
DROP TABLE IF EXISTS `sales_instance`;
CREATE TABLE `sales_instance` (
  `id_sales_instance` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_sales_instance`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sales_instance
-- ----------------------------

-- ----------------------------
-- Table structure for `send_email_temp`
-- ----------------------------
DROP TABLE IF EXISTS `send_email_temp`;
CREATE TABLE `send_email_temp` (
  `id_send_email_temp` int(11) NOT NULL AUTO_INCREMENT,
  `to` text NOT NULL,
  `cc` text,
  `bcc` text,
  `subject` text,
  `content` text,
  `sending_status` varchar(45) NOT NULL,
  PRIMARY KEY (`id_send_email_temp`,`sending_status`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of send_email_temp
-- ----------------------------

-- ----------------------------
-- Table structure for `shift_rotation`
-- ----------------------------
DROP TABLE IF EXISTS `shift_rotation`;
CREATE TABLE `shift_rotation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `work_order_id` int(11) DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL,
  `bulan` varchar(2) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `01` varchar(2) DEFAULT NULL,
  `02` varchar(2) DEFAULT NULL,
  `03` varchar(2) DEFAULT NULL,
  `04` varchar(2) DEFAULT NULL,
  `05` varchar(2) DEFAULT NULL,
  `06` varchar(2) DEFAULT NULL,
  `07` varchar(2) DEFAULT NULL,
  `08` varchar(2) DEFAULT NULL,
  `09` varchar(2) DEFAULT NULL,
  `d10` varchar(2) DEFAULT NULL,
  `d11` varchar(2) DEFAULT NULL,
  `d12` varchar(2) DEFAULT NULL,
  `d13` varchar(2) DEFAULT NULL,
  `d14` varchar(2) DEFAULT NULL,
  `d15` varchar(2) DEFAULT NULL,
  `d16` varchar(2) DEFAULT NULL,
  `d17` varchar(2) DEFAULT NULL,
  `d18` varchar(2) DEFAULT NULL,
  `d19` varchar(2) DEFAULT NULL,
  `d20` varchar(2) DEFAULT NULL,
  `d21` varchar(2) DEFAULT NULL,
  `d22` varchar(2) DEFAULT NULL,
  `d23` varchar(2) DEFAULT NULL,
  `d24` varchar(2) DEFAULT NULL,
  `d25` varchar(2) DEFAULT NULL,
  `d26` varchar(2) DEFAULT NULL,
  `d27` varchar(2) DEFAULT NULL,
  `d28` varchar(2) DEFAULT NULL,
  `d29` varchar(2) DEFAULT NULL,
  `d30` varchar(2) DEFAULT NULL,
  `d31` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of shift_rotation
-- ----------------------------
INSERT INTO `shift_rotation` VALUES ('94', '1', '2015', '01', '4', '10', '10', '10', '10', '10', '10', '6', '5', '5', '5', '5', '5', '5', '6', '4', '4', '4', '4', '4', '4', '6', '5', '5', '5', '5', '5', '5', '6', '4', '4', '4');
INSERT INTO `shift_rotation` VALUES ('95', '1', '2015', '01', '3', '11', '11', '11', '11', '11', '11', '6', '4', '4', '4', '4', '4', '4', '6', '5', '5', '5', '5', '5', '5', '6', '4', '4', '4', '4', '4', '4', '6', '5', '5', '5');
INSERT INTO `shift_rotation` VALUES ('98', '3', '2015', '01', '7', '18', '18', '18', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `shift_rotation` VALUES ('99', '3', '2015', '01', '8', '19', '19', '19', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `shift_rotation` VALUES ('100', '4', '2015', '01', '9', '21', '21', '21', '21', '21', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `shift_rotation` VALUES ('104', '6', '2015', '11', '3', '8', '9', '8', '9', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `shift_rotation` VALUES ('105', '6', '2015', '11', '3', '8', '9', '8', '9', '8', '9', '9', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- ----------------------------
-- Table structure for `shift_rotationx`
-- ----------------------------
DROP TABLE IF EXISTS `shift_rotationx`;
CREATE TABLE `shift_rotationx` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `work_order_id` int(11) DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL,
  `bulan` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `01` varchar(2) DEFAULT NULL,
  `02` varchar(2) DEFAULT NULL,
  `03` varchar(2) DEFAULT NULL,
  `04` varchar(2) DEFAULT NULL,
  `05` varchar(2) DEFAULT NULL,
  `06` varchar(2) DEFAULT NULL,
  `07` varchar(2) DEFAULT NULL,
  `08` varchar(2) DEFAULT NULL,
  `09` varchar(2) DEFAULT NULL,
  `10` varchar(2) DEFAULT NULL,
  `11` varchar(2) DEFAULT NULL,
  `12` varchar(2) DEFAULT NULL,
  `13` varchar(2) DEFAULT NULL,
  `14` varchar(2) DEFAULT NULL,
  `15` varchar(2) DEFAULT NULL,
  `16` varchar(2) DEFAULT NULL,
  `17` varchar(2) DEFAULT NULL,
  `18` varchar(2) DEFAULT NULL,
  `19` varchar(2) DEFAULT NULL,
  `20` varchar(2) DEFAULT NULL,
  `21` varchar(2) DEFAULT NULL,
  `22` varchar(2) DEFAULT NULL,
  `23` varchar(2) DEFAULT NULL,
  `24` varchar(2) DEFAULT NULL,
  `25` varchar(2) DEFAULT NULL,
  `26` varchar(2) DEFAULT NULL,
  `27` varchar(2) DEFAULT NULL,
  `28` varchar(2) DEFAULT NULL,
  `29` varchar(2) DEFAULT NULL,
  `30` varchar(2) DEFAULT NULL,
  `31` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of shift_rotationx
-- ----------------------------
INSERT INTO `shift_rotationx` VALUES ('1', '1', '2015', '1', '3', '4', '4', '4', '4', '4', '4', '6', '5', '5', '5', '5', '5', '5', '6', '4', '4', '4', '4', '4', '4', '6', '5', '5', '5', '5', '5', '5', '6', '4', '4', '4');
INSERT INTO `shift_rotationx` VALUES ('2', '1', '2015', '1', '4', '5', '5', '5', '5', '5', '5', '6', '4', '4', '4', '4', '4', '4', '6', '5', '5', '5', '5', '5', '5', '6', '4', '4', '4', '4', '4', '4', '6', '5', '5', '5');

-- ----------------------------
-- Table structure for `so`
-- ----------------------------
DROP TABLE IF EXISTS `so`;
CREATE TABLE `so` (
  `id_so` int(11) NOT NULL AUTO_INCREMENT,
  `so_number` varchar(45) NOT NULL,
  `date` date NOT NULL,
  `date_delivery` date NOT NULL,
  `customer` int(11) NOT NULL,
  `quotation` int(11) NOT NULL,
  `contract_number` varchar(100) DEFAULT NULL,
  `contract_startdate` date DEFAULT NULL,
  `contract_expdate` date DEFAULT NULL,
  `invoice_period` varchar(45) DEFAULT NULL,
  `notes` text,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_so`),
  KEY `fk_so_ext_company1_idx` (`customer`),
  KEY `fk_so_quotation1_idx` (`quotation`),
  CONSTRAINT `fk_so_ext_company1` FOREIGN KEY (`customer`) REFERENCES `ext_company` (`id_ext_company`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_so_quotation1` FOREIGN KEY (`quotation`) REFERENCES `quotation` (`id_quotation`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of so
-- ----------------------------
INSERT INTO `so` VALUES ('1', 'SO150001', '2015-03-18', '2015-03-18', '4', '2', null, null, null, null, null, 'close');
INSERT INTO `so` VALUES ('2', 'SO150002', '2015-03-27', '2015-03-28', '4', '3', null, null, null, null, null, 'close');
INSERT INTO `so` VALUES ('3', 'SO150003', '2015-03-29', '2015-03-29', '4', '4', null, null, null, null, null, 'close');

-- ----------------------------
-- Table structure for `so_assignment`
-- ----------------------------
DROP TABLE IF EXISTS `so_assignment`;
CREATE TABLE `so_assignment` (
  `id_so_assignment` int(11) NOT NULL AUTO_INCREMENT,
  `so_assignment_number` varchar(45) NOT NULL,
  `work_schedule` int(11) NOT NULL,
  `status` varchar(45) DEFAULT NULL,
  `work_order_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_so_assignment`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of so_assignment
-- ----------------------------
INSERT INTO `so_assignment` VALUES ('1', '3', '0', null, '6');
INSERT INTO `so_assignment` VALUES ('2', '4', '0', null, '6');

-- ----------------------------
-- Table structure for `so_contract`
-- ----------------------------
DROP TABLE IF EXISTS `so_contract`;
CREATE TABLE `so_contract` (
  `id_so_contract` int(11) NOT NULL AUTO_INCREMENT,
  `contract` int(11) DEFAULT NULL,
  `so` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_so_contract`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of so_contract
-- ----------------------------
INSERT INTO `so_contract` VALUES ('1', '1', '1');
INSERT INTO `so_contract` VALUES ('2', '2', '2');
INSERT INTO `so_contract` VALUES ('3', '2', '2');
INSERT INTO `so_contract` VALUES ('4', '4', '3');

-- ----------------------------
-- Table structure for `so_finish_product`
-- ----------------------------
DROP TABLE IF EXISTS `so_finish_product`;
CREATE TABLE `so_finish_product` (
  `id_so_finish_product` int(11) NOT NULL AUTO_INCREMENT,
  `so` int(11) NOT NULL,
  `product` bigint(20) NOT NULL,
  `qty` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id_so_finish_product`),
  KEY `fk_so_finish_product_so1_idx` (`so`),
  KEY `fk_so_finish_product_product1_idx` (`product`),
  CONSTRAINT `fk_so_finish_product_product1` FOREIGN KEY (`product`) REFERENCES `product` (`id_product`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_so_finish_product_so1` FOREIGN KEY (`so`) REFERENCES `so` (`id_so`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of so_finish_product
-- ----------------------------

-- ----------------------------
-- Table structure for `so_product`
-- ----------------------------
DROP TABLE IF EXISTS `so_product`;
CREATE TABLE `so_product` (
  `id_so_product` int(11) NOT NULL AUTO_INCREMENT,
  `so` int(11) NOT NULL,
  `product` bigint(20) NOT NULL,
  `qty` float DEFAULT NULL,
  `price` float DEFAULT NULL,
  PRIMARY KEY (`id_so_product`,`product`),
  KEY `fk_so_product_so1_idx` (`so`),
  KEY `fk_so_product_product1_idx` (`product`),
  CONSTRAINT `fk_so_product_product1` FOREIGN KEY (`product`) REFERENCES `product` (`id_product`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_so_product_so1` FOREIGN KEY (`so`) REFERENCES `so` (`id_so`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of so_product
-- ----------------------------
INSERT INTO `so_product` VALUES ('1', '1', '2', '10', '250000');
INSERT INTO `so_product` VALUES ('2', '2', '2', '10', '100000');
INSERT INTO `so_product` VALUES ('3', '2', '3', '5', '500000');
INSERT INTO `so_product` VALUES ('4', '3', '2', '10', '1000000');
INSERT INTO `so_product` VALUES ('5', '3', '3', '20', '500000');
INSERT INTO `so_product` VALUES ('6', '3', '4', '5', null);
INSERT INTO `so_product` VALUES ('7', '3', '5', '1', null);
INSERT INTO `so_product` VALUES ('8', '3', '6', '2', null);

-- ----------------------------
-- Table structure for `so_schedule`
-- ----------------------------
DROP TABLE IF EXISTS `so_schedule`;
CREATE TABLE `so_schedule` (
  `id_so_schedule` int(11) NOT NULL AUTO_INCREMENT,
  `work_schedule` int(11) DEFAULT NULL,
  `so` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_so_schedule`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of so_schedule
-- ----------------------------
INSERT INTO `so_schedule` VALUES ('1', '2', '1');
INSERT INTO `so_schedule` VALUES ('2', '3', '2');
INSERT INTO `so_schedule` VALUES ('3', '4', '3');

-- ----------------------------
-- Table structure for `so_survey`
-- ----------------------------
DROP TABLE IF EXISTS `so_survey`;
CREATE TABLE `so_survey` (
  `id_so_survey` int(11) NOT NULL AUTO_INCREMENT,
  `so` int(11) NOT NULL,
  `survey_assessment` int(11) NOT NULL,
  PRIMARY KEY (`id_so_survey`),
  KEY `fk_so_survey_so1_idx` (`so`),
  KEY `fk_so_survey_survey_assessment1_idx` (`survey_assessment`),
  CONSTRAINT `fk_so_survey_so1` FOREIGN KEY (`so`) REFERENCES `so` (`id_so`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_so_survey_survey_assessment1` FOREIGN KEY (`survey_assessment`) REFERENCES `survey_assessment` (`id_survey_assessment`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of so_survey
-- ----------------------------
INSERT INTO `so_survey` VALUES ('1', '1', '2');
INSERT INTO `so_survey` VALUES ('2', '2', '3');
INSERT INTO `so_survey` VALUES ('3', '2', '4');
INSERT INTO `so_survey` VALUES ('4', '3', '5');
INSERT INTO `so_survey` VALUES ('5', '3', '6');

-- ----------------------------
-- Table structure for `state`
-- ----------------------------
DROP TABLE IF EXISTS `state`;
CREATE TABLE `state` (
  `id_state` int(11) NOT NULL AUTO_INCREMENT,
  `country` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id_state`),
  KEY `fk_state_country1_idx` (`country`),
  CONSTRAINT `fk_state_country1` FOREIGN KEY (`country`) REFERENCES `country` (`id_country`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of state
-- ----------------------------
INSERT INTO `state` VALUES ('11', '1', 'Aceh');
INSERT INTO `state` VALUES ('12', '1', 'Sumatera Utara');
INSERT INTO `state` VALUES ('13', '1', 'Sumatera Barat');
INSERT INTO `state` VALUES ('14', '1', 'Riau');
INSERT INTO `state` VALUES ('15', '1', 'Jambi');
INSERT INTO `state` VALUES ('16', '1', 'Sumatera Selatan');
INSERT INTO `state` VALUES ('17', '1', 'Bengkulu');
INSERT INTO `state` VALUES ('18', '1', 'Lampung');
INSERT INTO `state` VALUES ('19', '1', 'Kepulauan Bangka Belitung');
INSERT INTO `state` VALUES ('21', '1', 'Kepulauan Riau');
INSERT INTO `state` VALUES ('31', '1', 'Dki Jakarta');
INSERT INTO `state` VALUES ('32', '1', 'Jawa Barat');
INSERT INTO `state` VALUES ('33', '1', 'Jawa Tengah');
INSERT INTO `state` VALUES ('34', '1', 'Di Yogyakarta');
INSERT INTO `state` VALUES ('35', '1', 'Jawa Timur');
INSERT INTO `state` VALUES ('36', '1', 'Banten');
INSERT INTO `state` VALUES ('51', '1', 'Bali');
INSERT INTO `state` VALUES ('52', '1', 'Nusa Tenggara Barat');
INSERT INTO `state` VALUES ('53', '1', 'Nusa Tenggara Timur');
INSERT INTO `state` VALUES ('61', '1', 'Kalimantan Barat');
INSERT INTO `state` VALUES ('62', '1', 'Kalimantan Tengah');
INSERT INTO `state` VALUES ('63', '1', 'Kalimantan Selatan');
INSERT INTO `state` VALUES ('64', '1', 'Kalimantan Timur');
INSERT INTO `state` VALUES ('65', '1', 'Kalimantan Utara');
INSERT INTO `state` VALUES ('71', '1', 'Sulawesi Utara');
INSERT INTO `state` VALUES ('72', '1', 'Sulawesi Tengah');
INSERT INTO `state` VALUES ('73', '1', 'Sulawesi Selatan');
INSERT INTO `state` VALUES ('74', '1', 'Sulawesi Tenggara');
INSERT INTO `state` VALUES ('75', '1', 'Gorontalo');
INSERT INTO `state` VALUES ('76', '1', 'Sulawesi Barat');
INSERT INTO `state` VALUES ('81', '1', 'Maluku');
INSERT INTO `state` VALUES ('82', '1', 'Maluku Utara');
INSERT INTO `state` VALUES ('91', '1', 'Papua Barat');
INSERT INTO `state` VALUES ('94', '1', 'Papua');

-- ----------------------------
-- Table structure for `stock_adjustment`
-- ----------------------------
DROP TABLE IF EXISTS `stock_adjustment`;
CREATE TABLE `stock_adjustment` (
  `id_stock_adjustment` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `description` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL,
  PRIMARY KEY (`id_stock_adjustment`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of stock_adjustment
-- ----------------------------

-- ----------------------------
-- Table structure for `stock_adjustment_product`
-- ----------------------------
DROP TABLE IF EXISTS `stock_adjustment_product`;
CREATE TABLE `stock_adjustment_product` (
  `id_stock_adjustment_product` int(11) NOT NULL AUTO_INCREMENT,
  `stock_adjustment` int(11) NOT NULL,
  `product` bigint(20) NOT NULL,
  `gudang` int(11) NOT NULL,
  `remark` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_stock_adjustment_product`),
  KEY `fk_stock_adjustment_product_stock_adjustment1_idx` (`stock_adjustment`),
  KEY `fk_stock_adjustment_product_product1_idx` (`product`),
  KEY `fk_stock_adjustment_product_gudang1_idx` (`gudang`),
  CONSTRAINT `fk_stock_adjustment_product_gudang1` FOREIGN KEY (`gudang`) REFERENCES `gudang` (`id_warehouse`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_stock_adjustment_product_product1` FOREIGN KEY (`product`) REFERENCES `product` (`id_product`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_stock_adjustment_product_stock_adjustment1` FOREIGN KEY (`stock_adjustment`) REFERENCES `stock_adjustment` (`id_stock_adjustment`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of stock_adjustment_product
-- ----------------------------

-- ----------------------------
-- Table structure for `stock_opname`
-- ----------------------------
DROP TABLE IF EXISTS `stock_opname`;
CREATE TABLE `stock_opname` (
  `id_stock_opname` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  PRIMARY KEY (`id_stock_opname`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of stock_opname
-- ----------------------------

-- ----------------------------
-- Table structure for `stock_opname_detail`
-- ----------------------------
DROP TABLE IF EXISTS `stock_opname_detail`;
CREATE TABLE `stock_opname_detail` (
  `id_stock_opname_detail` int(11) NOT NULL AUTO_INCREMENT,
  `stock_opname` int(11) NOT NULL,
  `product` bigint(20) NOT NULL,
  `warehouse` int(11) NOT NULL,
  PRIMARY KEY (`id_stock_opname_detail`),
  KEY `fk_stock_opname_product_stock_opname1_idx` (`stock_opname`),
  KEY `fk_stock_opname_product_product1_idx` (`product`),
  KEY `fk_stock_opname_detail_warehouse1_idx` (`warehouse`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of stock_opname_detail
-- ----------------------------

-- ----------------------------
-- Table structure for `stock_product`
-- ----------------------------
DROP TABLE IF EXISTS `stock_product`;
CREATE TABLE `stock_product` (
  `id_stock_product` int(11) NOT NULL AUTO_INCREMENT,
  `product` bigint(20) NOT NULL,
  `warehouse` int(11) NOT NULL,
  PRIMARY KEY (`id_stock_product`),
  KEY `fk_stock_product_product1_idx` (`product`),
  KEY `fk_stock_product_warehouse1_idx` (`warehouse`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of stock_product
-- ----------------------------

-- ----------------------------
-- Table structure for `stock_transaction`
-- ----------------------------
DROP TABLE IF EXISTS `stock_transaction`;
CREATE TABLE `stock_transaction` (
  `id_stock_transaction` int(11) NOT NULL AUTO_INCREMENT,
  `product` bigint(20) NOT NULL,
  `qty` float NOT NULL,
  `uom` int(11) NOT NULL,
  `picking_type` varchar(45) NOT NULL COMMENT 'good_receipt,internal_delivery',
  `source_location` int(11) NOT NULL,
  `transaction_date` datetime NOT NULL,
  `status` varchar(45) NOT NULL,
  `destination_location` int(11) NOT NULL,
  `description` varchar(45) NOT NULL,
  PRIMARY KEY (`id_stock_transaction`),
  KEY `fk_stock_transaction_product1_idx` (`product`),
  KEY `fk_stock_transaction_unit_measure1_idx` (`uom`),
  KEY `fk_stock_transaction_gudang1_idx` (`source_location`),
  KEY `fk_stock_transaction_gudang2_idx` (`destination_location`),
  CONSTRAINT `fk_stock_transaction_gudang1` FOREIGN KEY (`source_location`) REFERENCES `gudang` (`id_warehouse`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_stock_transaction_gudang2` FOREIGN KEY (`destination_location`) REFERENCES `gudang` (`id_warehouse`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_stock_transaction_product1` FOREIGN KEY (`product`) REFERENCES `product` (`id_product`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_stock_transaction_unit_measure1` FOREIGN KEY (`uom`) REFERENCES `unit_measure` (`id_unit_measure`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of stock_transaction
-- ----------------------------
INSERT INTO `stock_transaction` VALUES ('1', '2', '10', '2', 'good_receive', '5', '2015-01-25 00:18:47', 'post', '3', 'GR150001');
INSERT INTO `stock_transaction` VALUES ('2', '3', '5', '2', 'good_receive', '5', '2015-01-25 00:18:47', 'post', '3', 'GR150001');
INSERT INTO `stock_transaction` VALUES ('3', '2', '10', '2', 'good_receive', '5', '2015-01-30 20:31:57', 'post', '4', 'GR150002');

-- ----------------------------
-- Table structure for `survey_answer`
-- ----------------------------
DROP TABLE IF EXISTS `survey_answer`;
CREATE TABLE `survey_answer` (
  `id_object_survey_relationship` int(11) NOT NULL AUTO_INCREMENT,
  `survey_question_relation` int(11) NOT NULL,
  `answer` text NOT NULL,
  `remark` text,
  PRIMARY KEY (`id_object_survey_relationship`),
  KEY `fk_survey_answer_survey_question_relation1_idx` (`survey_question_relation`),
  CONSTRAINT `fk_survey_answer_survey_question_relation1` FOREIGN KEY (`survey_question_relation`) REFERENCES `survey_question_relation` (`id_survey_question_relation`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of survey_answer
-- ----------------------------

-- ----------------------------
-- Table structure for `survey_assessment`
-- ----------------------------
DROP TABLE IF EXISTS `survey_assessment`;
CREATE TABLE `survey_assessment` (
  `id_survey_assessment` int(11) NOT NULL AUTO_INCREMENT,
  `filename` text NOT NULL,
  `filename_ori` text NOT NULL,
  `filename_type` varchar(255) NOT NULL,
  `site` int(11) DEFAULT NULL,
  `remark` text,
  PRIMARY KEY (`id_survey_assessment`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of survey_assessment
-- ----------------------------
INSERT INTO `survey_assessment` VALUES ('1', '', '', '', '0', null);
INSERT INTO `survey_assessment` VALUES ('2', 'test2.docx', '', '', '1', 'ok');
INSERT INTO `survey_assessment` VALUES ('3', 'S150003', 'test2.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', '1', 'ok 1');
INSERT INTO `survey_assessment` VALUES ('4', 'S150004', 'test2.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', '1', 'ok 2');
INSERT INTO `survey_assessment` VALUES ('5', 'S150005', 'test.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', '1', 'OK');
INSERT INTO `survey_assessment` VALUES ('6', 'S150006', 'test2.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', '1', 'OK 2');
INSERT INTO `survey_assessment` VALUES ('7', 'S150007', 'codeigniter_logo.png', 'image/png', null, null);
INSERT INTO `survey_assessment` VALUES ('8', 'S150008', 'Survey.PNG', 'image/png', null, null);
INSERT INTO `survey_assessment` VALUES ('9', 'S150009', 'skema.PNG', 'image/png', null, null);

-- ----------------------------
-- Table structure for `survey_question_list`
-- ----------------------------
DROP TABLE IF EXISTS `survey_question_list`;
CREATE TABLE `survey_question_list` (
  `id_survey_question_list` int(11) NOT NULL AUTO_INCREMENT,
  `question` text NOT NULL,
  `question_type` varchar(10) NOT NULL,
  `weight` float DEFAULT NULL,
  `survey_template` int(11) NOT NULL,
  PRIMARY KEY (`id_survey_question_list`),
  KEY `fk_survey_question_list_survey_template1_idx` (`survey_template`),
  CONSTRAINT `fk_survey_question_list_survey_template1` FOREIGN KEY (`survey_template`) REFERENCES `survey_template` (`id_survey_template`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of survey_question_list
-- ----------------------------
INSERT INTO `survey_question_list` VALUES ('1', 'Apakah Anda pernah bekerja di Group atau perusahaan ini?', 'yes_no', '1', '0');
INSERT INTO `survey_question_list` VALUES ('2', 'Kapan, bilamana dan sebagai apa?', 'fill_in', '1', '0');
INSERT INTO `survey_question_list` VALUES ('3', 'Apakah anda terikat kontrak dengan pihak lain saat ini?', 'yes_no', '1', '0');
INSERT INTO `survey_question_list` VALUES ('4', 'Apakah Anda pernah menderita penyakit keras, kecelakaan, operasi? Bilamana dan macam apa?', 'yes_no_fil', '1', '0');

-- ----------------------------
-- Table structure for `survey_question_relation`
-- ----------------------------
DROP TABLE IF EXISTS `survey_question_relation`;
CREATE TABLE `survey_question_relation` (
  `id_survey_question_relation` int(11) NOT NULL AUTO_INCREMENT,
  `survey_question` int(11) NOT NULL,
  `object_relation` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_survey_question_relation`),
  KEY `fk_survey_question_relation_survey_question_list1_idx` (`survey_question`),
  CONSTRAINT `fk_survey_question_relation_survey_question_list1` FOREIGN KEY (`survey_question`) REFERENCES `survey_question_list` (`id_survey_question_list`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of survey_question_relation
-- ----------------------------

-- ----------------------------
-- Table structure for `survey_template`
-- ----------------------------
DROP TABLE IF EXISTS `survey_template`;
CREATE TABLE `survey_template` (
  `id_survey_template` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_survey_template`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of survey_template
-- ----------------------------

-- ----------------------------
-- Table structure for `tax_status`
-- ----------------------------
DROP TABLE IF EXISTS `tax_status`;
CREATE TABLE `tax_status` (
  `id_tax_status` int(11) NOT NULL AUTO_INCREMENT,
  `status_name` varchar(5) NOT NULL,
  PRIMARY KEY (`id_tax_status`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tax_status
-- ----------------------------
INSERT INTO `tax_status` VALUES ('1', 'K1');
INSERT INTO `tax_status` VALUES ('2', 'K2');
INSERT INTO `tax_status` VALUES ('3', 'K3');
INSERT INTO `tax_status` VALUES ('4', 'TK');

-- ----------------------------
-- Table structure for `timesheet`
-- ----------------------------
DROP TABLE IF EXISTS `timesheet`;
CREATE TABLE `timesheet` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `employee_number` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `in` time DEFAULT NULL,
  `out` time DEFAULT NULL,
  `time_input` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `input_by` enum('manual','ff') DEFAULT 'ff',
  `supervisor_id` int(11) DEFAULT NULL,
  `status_absen` varchar(255) DEFAULT NULL,
  `overtime` enum('Y','N') DEFAULT 'N',
  `timesheet_group_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of timesheet
-- ----------------------------
INSERT INTO `timesheet` VALUES ('1', '3', null, null, null, '2015-03-19 13:36:50', 'ff', null, null, 'N', '1');
INSERT INTO `timesheet` VALUES ('2', '4', null, null, null, '2015-03-19 13:36:50', 'ff', null, null, 'N', '1');
INSERT INTO `timesheet` VALUES ('3', '3', null, '02:00:00', '14:00:00', '2015-03-19 13:44:48', 'ff', null, null, 'N', '2');
INSERT INTO `timesheet` VALUES ('4', '10', null, '14:00:00', '18:00:00', '2015-03-19 13:44:48', 'ff', null, null, 'N', '2');
INSERT INTO `timesheet` VALUES ('5', '13', null, '09:00:00', '16:00:00', '2015-03-19 13:44:48', 'ff', null, null, 'N', '2');
INSERT INTO `timesheet` VALUES ('6', '10', null, '00:08:00', '00:16:00', '2015-03-25 15:35:25', 'ff', null, null, 'N', '3');
INSERT INTO `timesheet` VALUES ('7', '13', null, null, null, '2015-03-25 15:35:25', 'ff', null, null, 'N', '3');
INSERT INTO `timesheet` VALUES ('8', '3', null, '08:00:00', '16:00:00', '2015-03-25 15:45:08', 'ff', null, null, 'N', '4');
INSERT INTO `timesheet` VALUES ('9', '4', null, '08:00:00', '16:00:00', '2015-03-25 15:45:08', 'ff', null, null, 'N', '4');
INSERT INTO `timesheet` VALUES ('10', '3', null, '08:00:00', '16:00:00', '2015-03-25 15:47:35', 'ff', null, null, 'N', '5');
INSERT INTO `timesheet` VALUES ('11', '4', null, '08:00:00', '16:00:00', '2015-03-25 15:47:35', 'ff', null, null, 'N', '5');
INSERT INTO `timesheet` VALUES ('12', '14', null, null, null, '2015-03-25 16:57:45', 'ff', null, null, 'N', '6');
INSERT INTO `timesheet` VALUES ('13', '15', null, null, null, '2015-03-25 16:57:45', 'ff', null, null, 'N', '6');
INSERT INTO `timesheet` VALUES ('14', '4', null, null, null, '2015-03-25 16:59:43', 'ff', null, null, 'N', '7');
INSERT INTO `timesheet` VALUES ('15', '10', null, null, null, '2015-03-25 16:59:43', 'ff', null, null, 'N', '7');
INSERT INTO `timesheet` VALUES ('16', '8', null, null, null, '2015-03-25 16:59:43', 'ff', null, null, 'N', '7');
INSERT INTO `timesheet` VALUES ('17', '3', null, '09:00:00', '13:00:00', '2015-03-25 17:02:01', 'ff', null, null, 'N', '8');
INSERT INTO `timesheet` VALUES ('18', '4', null, '23:00:00', '24:00:00', '2015-03-25 17:02:01', 'ff', null, null, 'N', '8');
INSERT INTO `timesheet` VALUES ('19', '3', null, '08:00:00', '12:00:00', '2015-03-26 19:55:53', 'ff', null, null, 'N', '9');
INSERT INTO `timesheet` VALUES ('20', '3', null, '00:00:00', null, '2015-04-01 10:22:33', 'ff', null, null, 'N', '10');
INSERT INTO `timesheet` VALUES ('21', '4', null, null, null, '2015-04-01 10:22:33', 'ff', null, null, 'N', '10');
INSERT INTO `timesheet` VALUES ('22', '3', null, '12:00:00', '18:00:00', '2015-04-01 10:49:48', 'ff', null, null, 'N', '11');
INSERT INTO `timesheet` VALUES ('23', '4', null, '14:00:00', '16:00:00', '2015-04-01 10:49:48', 'ff', null, null, 'N', '11');

-- ----------------------------
-- Table structure for `timesheet_group`
-- ----------------------------
DROP TABLE IF EXISTS `timesheet_group`;
CREATE TABLE `timesheet_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `work_order_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `input_method` enum('machine','manual','excel') DEFAULT 'machine',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of timesheet_group
-- ----------------------------
INSERT INTO `timesheet_group` VALUES ('1', '1', '2015-03-01', '2015-03-19 13:36:50', 'manual');
INSERT INTO `timesheet_group` VALUES ('2', '3', '2015-03-01', '2015-03-19 13:44:48', 'manual');
INSERT INTO `timesheet_group` VALUES ('3', '3', '2015-03-02', '2015-03-25 15:35:25', 'manual');
INSERT INTO `timesheet_group` VALUES ('4', '1', '2015-04-01', '2015-03-25 15:45:08', 'manual');
INSERT INTO `timesheet_group` VALUES ('5', '1', '2015-04-02', '2015-03-25 15:47:35', 'manual');
INSERT INTO `timesheet_group` VALUES ('6', '4', '2015-03-25', '2015-03-25 16:57:45', 'manual');
INSERT INTO `timesheet_group` VALUES ('7', '4', '2015-03-26', '2015-03-25 16:59:43', 'manual');
INSERT INTO `timesheet_group` VALUES ('8', '4', '2015-03-27', '2015-03-25 17:02:01', 'manual');
INSERT INTO `timesheet_group` VALUES ('9', '4', '2015-03-31', '2015-03-26 19:55:53', 'manual');
INSERT INTO `timesheet_group` VALUES ('10', '6', '2015-04-01', '2015-04-01 10:22:33', 'manual');
INSERT INTO `timesheet_group` VALUES ('11', '6', '2015-04-02', '2015-04-01 10:49:48', 'manual');

-- ----------------------------
-- Table structure for `timesheet_raw`
-- ----------------------------
DROP TABLE IF EXISTS `timesheet_raw`;
CREATE TABLE `timesheet_raw` (
  `id_timesheet_raw` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `in_out_mode` tinyint(4) DEFAULT NULL,
  `source` varchar(45) DEFAULT NULL,
  `employee` int(11) NOT NULL,
  `app_id` varchar(45) NOT NULL,
  `serial_number` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_timesheet_raw`),
  KEY `fk_timesheet_raw_employee1_idx` (`employee`),
  CONSTRAINT `fk_timesheet_raw_employee1` FOREIGN KEY (`employee`) REFERENCES `employeex` (`id_employee`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of timesheet_raw
-- ----------------------------
INSERT INTO `timesheet_raw` VALUES ('1', '2015-03-27', '16:59:38', '0', 'fingerprint_att_rte', '7', 'APPID1500011', null);
INSERT INTO `timesheet_raw` VALUES ('2', '2015-03-27', '17:03:58', '0', 'fingerprint_att_rte', '7', 'APPID1500011', null);
INSERT INTO `timesheet_raw` VALUES ('3', '2015-03-27', '17:04:27', '0', 'fingerprint_att_rte', '5', 'APPID1500011', null);
INSERT INTO `timesheet_raw` VALUES ('4', '2015-03-27', '17:06:04', '0', 'fingerprint_att_rte', '6', 'APPID1500011', null);

-- ----------------------------
-- Table structure for `timsheet`
-- ----------------------------
DROP TABLE IF EXISTS `timsheet`;
CREATE TABLE `timsheet` (
  `id_timsheet` int(11) NOT NULL AUTO_INCREMENT,
  `employee` int(11) NOT NULL,
  `date` date NOT NULL,
  `in_time` time DEFAULT NULL,
  `out_time` time DEFAULT NULL,
  `source` varchar(45) NOT NULL,
  `type` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL,
  `total_working_hour` time NOT NULL,
  PRIMARY KEY (`id_timsheet`),
  KEY `fk_timsheet_employee1_idx` (`employee`),
  CONSTRAINT `fk_timsheet_employee1` FOREIGN KEY (`employee`) REFERENCES `employeex` (`id_employee`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of timsheet
-- ----------------------------
INSERT INTO `timsheet` VALUES ('86', '3', '2015-02-02', '22:44:47', '22:45:47', 'fingerprint_sch', 'regular', 'unverified', '00:01:00');
INSERT INTO `timsheet` VALUES ('87', '4', '2015-02-02', '23:12:38', null, 'fingerprint_sch', 'regular', 'unverified', '00:00:00');
INSERT INTO `timsheet` VALUES ('88', '3', '2015-03-04', '23:43:57', null, 'fingerprint_sch', 'regular', 'unverified', '00:00:00');
INSERT INTO `timsheet` VALUES ('89', '3', '2015-03-05', '22:59:58', null, 'fingerprint_sch', 'regular', 'unverified', '00:00:00');
INSERT INTO `timsheet` VALUES ('90', '3', '2015-03-08', '01:00:54', null, 'fingerprint_sch', 'regular', 'unverified', '00:00:00');
INSERT INTO `timsheet` VALUES ('91', '3', '2015-03-16', '22:55:26', '22:57:52', 'fingerprint_sch', 'regular', 'unverified', '00:02:26');
INSERT INTO `timsheet` VALUES ('92', '3', '2015-03-17', '00:48:19', null, 'fingerprint_sch', 'regular', 'unverified', '00:00:00');
INSERT INTO `timsheet` VALUES ('93', '4', '2015-03-18', '13:55:08', null, 'fingerprint_sch', 'regular', 'unverified', '00:00:00');
INSERT INTO `timsheet` VALUES ('94', '3', '2015-03-18', '14:10:42', '14:41:36', 'fingerprint_sch', 'regular', 'unverified', '00:30:54');
INSERT INTO `timsheet` VALUES ('95', '7', '2015-03-18', '14:34:17', '14:41:43', 'fingerprint_sch', 'regular', 'unverified', '00:07:26');
INSERT INTO `timsheet` VALUES ('96', '6', '2015-03-18', '17:49:17', null, 'fingerprint_sch', 'regular', 'unverified', '00:00:00');
INSERT INTO `timsheet` VALUES ('97', '5', '2015-03-18', '17:49:26', null, 'fingerprint_sch', 'regular', 'unverified', '00:00:00');
INSERT INTO `timsheet` VALUES ('98', '7', '2015-03-19', '00:34:17', null, 'fingerprint_sch', 'regular', 'unverified', '00:00:00');
INSERT INTO `timsheet` VALUES ('99', '4', '2015-03-19', '00:34:51', null, 'fingerprint_sch', 'regular', 'unverified', '00:00:00');
INSERT INTO `timsheet` VALUES ('100', '7', '2015-03-24', '23:00:11', null, 'fingerprint_sch', 'regular', 'unverified', '00:00:00');
INSERT INTO `timsheet` VALUES ('101', '7', '2015-03-25', '00:05:11', null, 'fingerprint_sch', 'regular', 'unverified', '00:00:00');
INSERT INTO `timsheet` VALUES ('102', '7', '2015-03-26', '01:08:53', null, 'fingerprint_sch', 'regular', 'unverified', '00:00:00');
INSERT INTO `timsheet` VALUES ('103', '5', '2015-03-26', '01:21:57', null, 'fingerprint_sch', 'regular', 'unverified', '00:00:00');
INSERT INTO `timsheet` VALUES ('104', '7', '2015-03-27', '15:51:13', null, 'fingerprint_sch', 'regular', 'unverified', '00:00:00');

-- ----------------------------
-- Table structure for `type_material`
-- ----------------------------
DROP TABLE IF EXISTS `type_material`;
CREATE TABLE `type_material` (
  `id_type_material` int(11) NOT NULL AUTO_INCREMENT,
  `type_material` varchar(45) NOT NULL,
  `abbreviation` varchar(45) NOT NULL,
  PRIMARY KEY (`id_type_material`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of type_material
-- ----------------------------

-- ----------------------------
-- Table structure for `uda`
-- ----------------------------
DROP TABLE IF EXISTS `uda`;
CREATE TABLE `uda` (
  `id_uda` int(11) NOT NULL AUTO_INCREMENT,
  `database_interface_model` int(11) NOT NULL,
  PRIMARY KEY (`id_uda`),
  KEY `fk_uda_database_interface1_idx` (`database_interface_model`),
  CONSTRAINT `fk_uda_database_interface1` FOREIGN KEY (`database_interface_model`) REFERENCES `database_interface` (`id_database_interface`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of uda
-- ----------------------------

-- ----------------------------
-- Table structure for `unit_convertion`
-- ----------------------------
DROP TABLE IF EXISTS `unit_convertion`;
CREATE TABLE `unit_convertion` (
  `id_unit_convertion` int(11) NOT NULL AUTO_INCREMENT,
  `multiplier` float NOT NULL,
  `unit_measure_from` int(11) NOT NULL,
  `unit_measure_to` int(11) NOT NULL,
  `multiplier_reverse` float DEFAULT NULL,
  PRIMARY KEY (`id_unit_convertion`),
  KEY `fk_unit_convertion_unit_measure1_idx` (`unit_measure_from`),
  KEY `fk_unit_convertion_unit_measure2_idx` (`unit_measure_to`),
  CONSTRAINT `fk_unit_convertion_unit_measure1` FOREIGN KEY (`unit_measure_from`) REFERENCES `unit_measure` (`id_unit_measure`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_unit_convertion_unit_measure2` FOREIGN KEY (`unit_measure_to`) REFERENCES `unit_measure` (`id_unit_measure`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of unit_convertion
-- ----------------------------
INSERT INTO `unit_convertion` VALUES ('8', '100', '11', '12', '0.01');
INSERT INTO `unit_convertion` VALUES ('9', '6', '15', '2', '0.166667');
INSERT INTO `unit_convertion` VALUES ('10', '50', '14', '2', '0.02');
INSERT INTO `unit_convertion` VALUES ('12', '25', '13', '2', '0.04');
INSERT INTO `unit_convertion` VALUES ('13', '12', '18', '2', '0.0833333');

-- ----------------------------
-- Table structure for `unit_measure`
-- ----------------------------
DROP TABLE IF EXISTS `unit_measure`;
CREATE TABLE `unit_measure` (
  `id_unit_measure` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `unit_of_measure_category` int(11) NOT NULL,
  PRIMARY KEY (`id_unit_measure`),
  KEY `fk_unit_measure_unit_of_measure_category1_idx` (`unit_of_measure_category`),
  CONSTRAINT `fk_unit_measure_unit_of_measure_category1` FOREIGN KEY (`unit_of_measure_category`) REFERENCES `unit_of_measure_category` (`id_unit_of_measure_category`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of unit_measure
-- ----------------------------
INSERT INTO `unit_measure` VALUES ('2', 'pcs', '4');
INSERT INTO `unit_measure` VALUES ('10', 'kg', '1');
INSERT INTO `unit_measure` VALUES ('11', 'm', '2');
INSERT INTO `unit_measure` VALUES ('12', 'cm', '2');
INSERT INTO `unit_measure` VALUES ('13', 'box 25', '4');
INSERT INTO `unit_measure` VALUES ('14', 'box 50', '4');
INSERT INTO `unit_measure` VALUES ('15', 'box 06', '4');
INSERT INTO `unit_measure` VALUES ('18', 'dozen', '4');
INSERT INTO `unit_measure` VALUES ('19', 'person', '4');

-- ----------------------------
-- Table structure for `unit_of_measure_category`
-- ----------------------------
DROP TABLE IF EXISTS `unit_of_measure_category`;
CREATE TABLE `unit_of_measure_category` (
  `id_unit_of_measure_category` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id_unit_of_measure_category`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of unit_of_measure_category
-- ----------------------------
INSERT INTO `unit_of_measure_category` VALUES ('1', 'weight');
INSERT INTO `unit_of_measure_category` VALUES ('2', 'length');
INSERT INTO `unit_of_measure_category` VALUES ('3', 'date');
INSERT INTO `unit_of_measure_category` VALUES ('4', 'unit');

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(45) DEFAULT NULL,
  `full_name` text,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `role` int(11) NOT NULL,
  `division` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  KEY `fk_user_role1` (`role`),
  KEY `fk_user_division1` (`division`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('2', 'system', 'System Admin', null, 'f6fdffe48c908deb0f4c3bd36c032e72', '1', null);
INSERT INTO `user` VALUES ('42', 'test', 'Test Account', 'test@test.com', '098f6bcd4621d373cade4e832627b4f6', '1', null);
INSERT INTO `user` VALUES ('43', 'userdemo', 'Demo User', 'demo@desalite.com', 'fe01ce2a7fbac8fafaed7c982a04e229', '11', null);
INSERT INTO `user` VALUES ('46', 'devteam', 'Development Team', '', 'bd54279ad951854ded2d8e3a94368ea7', '11', null);

-- ----------------------------
-- Table structure for `work_order`
-- ----------------------------
DROP TABLE IF EXISTS `work_order`;
CREATE TABLE `work_order` (
  `id_work_order` int(11) NOT NULL AUTO_INCREMENT,
  `work_order_number` varchar(45) NOT NULL,
  `date` date NOT NULL,
  `date_delivery` date NOT NULL,
  `customer` int(11) NOT NULL,
  `so` int(11) NOT NULL,
  `contract_number` varchar(100) DEFAULT NULL,
  `contract_startdate` date DEFAULT NULL,
  `contract_expdate` date DEFAULT NULL,
  `invoice_period` varchar(45) DEFAULT NULL,
  `notes` text,
  `status` varchar(45) DEFAULT NULL,
  `project_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_work_order`),
  KEY `fk_work_order_ext_company1_idx` (`customer`),
  KEY `fk_work_order_so1_idx` (`so`),
  CONSTRAINT `fk_work_order_ext_company1` FOREIGN KEY (`customer`) REFERENCES `ext_company` (`id_ext_company`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_work_order_so1` FOREIGN KEY (`so`) REFERENCES `so` (`id_so`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of work_order
-- ----------------------------
INSERT INTO `work_order` VALUES ('1', 'WO150001', '2015-03-17', '2015-03-21', '4', '2', null, '2015-01-01', '2016-01-01', null, null, 'running', 'Bank ABC Bandung');
INSERT INTO `work_order` VALUES ('3', 'WO150002', '0000-00-00', '0000-00-00', '4', '2', null, '2015-01-01', '2016-01-01', null, null, 'running', 'Bank ABC Jakarta');
INSERT INTO `work_order` VALUES ('4', 'WO150003', '0000-00-00', '0000-00-00', '4', '2', null, '2014-01-01', '2015-01-01', null, null, 'running', 'Gedung Sate Bandung');
INSERT INTO `work_order` VALUES ('5', 'WO150002', '2015-03-27', '2015-03-28', '4', '2', null, null, null, null, null, 'draft', null);
INSERT INTO `work_order` VALUES ('6', 'WO150006', '2015-03-29', '2015-03-29', '4', '3', null, '2015-01-01', '2015-12-31', null, null, 'running', 'Kantor BNSP');

-- ----------------------------
-- Table structure for `work_order_contract`
-- ----------------------------
DROP TABLE IF EXISTS `work_order_contract`;
CREATE TABLE `work_order_contract` (
  `id_work_order_contract` int(11) NOT NULL AUTO_INCREMENT,
  `contract` int(11) DEFAULT NULL,
  `work_order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_work_order_contract`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of work_order_contract
-- ----------------------------
INSERT INTO `work_order_contract` VALUES ('1', '1', '1');
INSERT INTO `work_order_contract` VALUES ('2', '2', '5');
INSERT INTO `work_order_contract` VALUES ('3', '2', '5');
INSERT INTO `work_order_contract` VALUES ('4', '4', '6');

-- ----------------------------
-- Table structure for `work_order_product`
-- ----------------------------
DROP TABLE IF EXISTS `work_order_product`;
CREATE TABLE `work_order_product` (
  `id_work_order_product` int(11) NOT NULL AUTO_INCREMENT,
  `work_order` int(11) NOT NULL,
  `product` bigint(20) NOT NULL,
  `qty` float DEFAULT NULL,
  `price` float DEFAULT NULL,
  PRIMARY KEY (`id_work_order_product`,`product`),
  KEY `fk_work_order_product_work_order1_idx` (`work_order`),
  KEY `fk_work_order_product_product1_idx` (`product`),
  CONSTRAINT `fk_work_order_product_product1` FOREIGN KEY (`product`) REFERENCES `product` (`id_product`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_work_order_product_work_order1` FOREIGN KEY (`work_order`) REFERENCES `work_order` (`id_work_order`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of work_order_product
-- ----------------------------
INSERT INTO `work_order_product` VALUES ('1', '1', '2', '10', '250000');
INSERT INTO `work_order_product` VALUES ('2', '5', '2', '10', '100000');
INSERT INTO `work_order_product` VALUES ('3', '5', '3', '5', '500000');
INSERT INTO `work_order_product` VALUES ('4', '6', '2', '10', '1000000');
INSERT INTO `work_order_product` VALUES ('5', '6', '3', '20', '500000');
INSERT INTO `work_order_product` VALUES ('6', '6', '4', '5', null);
INSERT INTO `work_order_product` VALUES ('7', '6', '5', '1', null);
INSERT INTO `work_order_product` VALUES ('8', '6', '6', '2', null);

-- ----------------------------
-- Table structure for `work_order_schedule`
-- ----------------------------
DROP TABLE IF EXISTS `work_order_schedule`;
CREATE TABLE `work_order_schedule` (
  `id_work_order_schedule` int(11) NOT NULL AUTO_INCREMENT,
  `work_schedule` int(11) DEFAULT NULL,
  `work_order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_work_order_schedule`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of work_order_schedule
-- ----------------------------
INSERT INTO `work_order_schedule` VALUES ('1', '2', '1');
INSERT INTO `work_order_schedule` VALUES ('2', '3', '5');
INSERT INTO `work_order_schedule` VALUES ('3', '3', '5');
INSERT INTO `work_order_schedule` VALUES ('4', '3', '5');
INSERT INTO `work_order_schedule` VALUES ('5', '3', '5');
INSERT INTO `work_order_schedule` VALUES ('6', '4', '6');
INSERT INTO `work_order_schedule` VALUES ('7', '4', '6');
INSERT INTO `work_order_schedule` VALUES ('8', '4', '6');
INSERT INTO `work_order_schedule` VALUES ('9', '4', '6');
INSERT INTO `work_order_schedule` VALUES ('10', '4', '6');
INSERT INTO `work_order_schedule` VALUES ('11', '4', '6');
INSERT INTO `work_order_schedule` VALUES ('12', '4', '6');

-- ----------------------------
-- Table structure for `work_order_survey`
-- ----------------------------
DROP TABLE IF EXISTS `work_order_survey`;
CREATE TABLE `work_order_survey` (
  `id_work_order_survey` int(11) NOT NULL AUTO_INCREMENT,
  `work_order` int(11) NOT NULL,
  `survey_assessment` int(11) NOT NULL,
  PRIMARY KEY (`id_work_order_survey`),
  KEY `fk_work_order_survey_work_order1_idx` (`work_order`),
  KEY `fk_work_order_survey_survey_assessment1_idx` (`survey_assessment`),
  CONSTRAINT `fk_work_order_survey_survey_assessment1` FOREIGN KEY (`survey_assessment`) REFERENCES `survey_assessment` (`id_survey_assessment`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_work_order_survey_work_order1` FOREIGN KEY (`work_order`) REFERENCES `work_order` (`id_work_order`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of work_order_survey
-- ----------------------------
INSERT INTO `work_order_survey` VALUES ('1', '1', '2');
INSERT INTO `work_order_survey` VALUES ('2', '5', '3');
INSERT INTO `work_order_survey` VALUES ('3', '5', '4');
INSERT INTO `work_order_survey` VALUES ('4', '6', '5');
INSERT INTO `work_order_survey` VALUES ('5', '6', '6');

-- ----------------------------
-- Table structure for `work_schedule`
-- ----------------------------
DROP TABLE IF EXISTS `work_schedule`;
CREATE TABLE `work_schedule` (
  `id_work_schedule` int(11) NOT NULL AUTO_INCREMENT,
  `quotation` int(11) NOT NULL,
  `work_schedule_number` varchar(20) NOT NULL,
  `period_start` date NOT NULL,
  `period_end` date DEFAULT NULL,
  `notes` text,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_work_schedule`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of work_schedule
-- ----------------------------
INSERT INTO `work_schedule` VALUES ('1', '1', 'WS150001', '2015-02-13', '2015-02-13', 'Ok', 'draft');
INSERT INTO `work_schedule` VALUES ('2', '2', 'WS150002', '2015-03-18', '2015-03-18', '', 'open');
INSERT INTO `work_schedule` VALUES ('3', '3', 'WS150003', '2015-03-28', '2015-03-28', '', 'open');
INSERT INTO `work_schedule` VALUES ('4', '4', 'WS150004', '2015-03-29', '2015-03-29', 'OK', 'open');

-- ----------------------------
-- Table structure for `wo_salary_setting`
-- ----------------------------
DROP TABLE IF EXISTS `wo_salary_setting`;
CREATE TABLE `wo_salary_setting` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `structure_org_id` int(11) DEFAULT NULL,
  `salary_type_id` int(11) DEFAULT NULL,
  `level_employee_id` int(11) DEFAULT NULL,
  `base_value` double DEFAULT '0',
  `occurence` varchar(255) DEFAULT NULL,
  `work_order_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of wo_salary_setting
-- ----------------------------
INSERT INTO `wo_salary_setting` VALUES ('1', '10', '1', '3', '5000000', 'Per Bulan', '1');
INSERT INTO `wo_salary_setting` VALUES ('2', '10', '3', '3', '12000', 'Perjam', '1');
INSERT INTO `wo_salary_setting` VALUES ('3', '10', '2', '3', '200000', 'Per Hari', '1');
INSERT INTO `wo_salary_setting` VALUES ('4', '11', '1', '3', '4000000', 'Per Bulan', '1');
INSERT INTO `wo_salary_setting` VALUES ('38', '11', '1', '3', '5000000', 'Per Bulan', '6');
INSERT INTO `wo_salary_setting` VALUES ('39', '11', '2', '3', '25000', 'Per Jam', '6');
INSERT INTO `wo_salary_setting` VALUES ('40', '9', '2', '3', '20000', 'Per Jam', '6');
INSERT INTO `wo_salary_setting` VALUES ('41', '9', '2', '3', '20000', 'Per Jam', '6');
INSERT INTO `wo_salary_setting` VALUES ('42', '11', '1', '2', '2000000', 'Per Bulan', '6');

-- ----------------------------
-- Table structure for `wo_time_schedule`
-- ----------------------------
DROP TABLE IF EXISTS `wo_time_schedule`;
CREATE TABLE `wo_time_schedule` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kode_schedule` varchar(255) DEFAULT NULL,
  `nama_schedule` varchar(255) DEFAULT NULL,
  `from_time` time DEFAULT NULL,
  `to_time` time DEFAULT NULL,
  `status_delete` enum('N','Y') DEFAULT 'N',
  `work_order_id` int(11) DEFAULT NULL,
  `begin_cin` time DEFAULT NULL,
  `end_cin` time DEFAULT NULL,
  `begin_cout` time DEFAULT NULL,
  `end_cout` time DEFAULT NULL,
  `late_in_tolerance` float DEFAULT NULL,
  `early_out_tolerance` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of wo_time_schedule
-- ----------------------------
INSERT INTO `wo_time_schedule` VALUES ('4', 'S1', 'Shif 1 Pagi', '08:00:00', '16:00:00', 'N', '1', '07:00:00', '12:00:00', '12:00:01', '18:00:00', '30', '30');
INSERT INTO `wo_time_schedule` VALUES ('5', 'S2', 'Shift 2 Siang', '16:00:00', '24:00:00', 'N', '1', '15:00:00', '20:00:00', '20:00:01', '02:00:00', '30', '20');
INSERT INTO `wo_time_schedule` VALUES ('6', 'L', 'Libur', '00:00:00', '00:00:00', 'N', '1', null, null, null, null, null, null);
INSERT INTO `wo_time_schedule` VALUES ('8', 'S1', 'Shift 1', '08:00:00', '14:00:00', 'N', '6', null, null, null, null, '5', '5');
INSERT INTO `wo_time_schedule` VALUES ('9', 'S2', 'Shift 2', '14:00:00', '24:00:00', 'N', '6', null, null, null, null, '10', '2');
