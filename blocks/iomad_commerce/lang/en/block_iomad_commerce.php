<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * @package   block_iomad_commerce
 * @copyright 2021 Derick Turner
 * @author    Derick Turner
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// Load payment provider strings.
require_once(dirname(__FILE__) . '/../../lib.php');
foreach (get_payment_providers() as $p) {
    $path = dirname(__FILE__) . "/../../checkout/$p/lang/en/$p.php";
    if (file_exists($path)) {
        require_once($path);
    }
}

$string['add_course_to_shop'] = 'Add course to shop';
$string['add_more_license_blocks'] = 'Add another license block';
$string['addnewcourse'] = 'Add course to shop';
$string['allow_license_blocks' ] = 'Allow license blocks';
$string['allow_license_blocks_help'] = 'When enabled a client administrator can purchase blocks of courses';
$string['allow_single_purchase'] = 'Allow single purchase';
$string['allow_single_purchase_help'] = 'When single purchase is enabled individual users can purchase their own access to the course';
$string['amount'] = 'Amount';
$string['blocktitle'] = 'E-Commerce';
$string['basket'] = 'Basket';
$string['basket_1item'] = 'There is {$a} item in your basket.';
$string['basket_nitems'] = 'There are {$a} items in your basket.';
$string['buycourses'] = 'Buy courses';
$string['buynow'] = 'Buy now';
$string['categorization'] = 'Categorisation';
$string['checkout'] = 'Checkout';
$string['checkoutpreamble'] = '<p></p>';
$string['commerce_admin_email'] = 'Commerce Admin email address';
$string['commerce_admin_email_help'] = 'Email address of the person looking after the shop.';
$string['commerce_enabled'] = '{$a} enabled';
$string['commerce_admin_firstname'] = 'Commerce Admin displayed firstname';
$string['commerce_admin_firstname_help'] = 'First name of the person looking after the shop.  Used in emails';
$string['commerce_admin_lastname'] = 'Commerce Admin displayed lastname';
$string['commerce_admin_lastname_help'] = 'Last name of the person looking after the shop.  Used in emails';
$string['commerce_default_license_access_length'] = 'Default license access days';
$string['commerce_default_license_access_length_help'] = 'This is the length of time in days users have access to the courses when purchased from the external shop.';
$string['commerce_admin_default_license_shelf_life'] = 'Default license shelf life days';
$string['commerce_admin_default_license_shelf_life_help'] = 'This is the length of time in days that the license can remain unused before it is no longer valid.';
$string['commerce_externalshop_link_timeout'] = 'Number of seconds for external shop token expires'; 
$string['commerce_externalshop_link_timeout_help'] = 'This is the number of seconds that the link to the external shop will remain valid for.  Having this a a large number will mean that the links could be stolen for another user to log into the shop.';
$string['commerce_externalshop_url'] = 'Default URL for external ecommerce site';
$string['commerce_externalshop_url_company'] = 'URL for company specific external ecommerce site';
$string['confirm'] = 'Confirm';
$string['confirmation'] = 'Your order is complete';
$string['Course'] = 'Course';
$string['courses'] = 'Courses';
$string['course_list_title'] = 'Manage eCommerce Courses';
$string['course_long_description'] = 'Long description';
$string['course_shop_enabled'] = 'Visible in shop';
$string['course_shop_enabled_help'] = 'Set to <b>Yes</b> for this course to be displayed on the shop screen';
$string['course_shop_title'] = 'Shop';
$string['course_short_summary'] = 'Short description';
$string['coursedeletecheckfull'] = 'Are you absolutely sure you want to delete {$a} and its settings from the shop?';
$string['courseunavailable'] = 'This course is not available.';
$string['currency'] = 'Currency';
$string['decimalnumberonly'] = 'Decimal number only, please.';
$string['deletecourse'] = 'Delete Course from Shop';
$string['edit_course_shopsettings'] = 'Edit course shop settings';
$string['edit_invoice'] = 'Edit order';
$string['iomad_commerce:add_course'] = 'Add a course to the shop';
$string['iomad_commerce:addinstance'] = 'Add a new Ecommerce block';
$string['iomad_commerce:admin_view'] = 'View the Ecommerce admin pages';
$string['iomad_commerce:buyitnow'] = 'Access to the buy it now button in the shop';
$string['iomad_commerce:delete_course'] = 'Remove a course from the shop';
$string['iomad_commerce:edit_course'] = 'Edit a course in the shop';
$string['iomad_commerce:hide_course'] = 'Hide a course in the shop';
$string['iomad_commerce:myaddinstance'] = 'Add a new Ecommerce block to the users dashboard';
$string['emptybasket'] = 'Your basket is empty';
$string['error_duplicateblockstarts'] = 'Duplicate # of licenses.';
$string['error_invalidblockstarts'] = 'One or more # of licenses is invalid.';
$string['error_invalidblockprices'] = 'One or more prices are invalid.';
$string['error_invalidblockvalidlengths'] = 'One or more valid lengths are invalid.';
$string['error_invalidblockshelflives'] = 'One or more shelf lives are invalid.';
$string['error_singlepurchaseprice'] = 'Single purchase price should be more than 0.';
$string['error_singlepurchasevalidlength'] = 'Valid length should be more than 0.';
$string['filter_by_tag'] = 'Choose courses by category: ';
$string['filtered_by_tag'] = 'Courses within the category - {$a}.';
$string['filtered_by_search'] = 'You searched for {$a}.';
$string['gotoshop'] = 'Go to shop';
$string['hide'] = 'Hide from shop';
$string['licenseblock_start'] = 'From # of licenses';
$string['licenseblock_price'] = 'Price per license';
$string['licenseblock_shelflife'] = 'Shelf life (days)';
$string['licenseblock_validlength'] = 'Valid (days)';
$string['licenseblock_n'] = '{$a} or more licenses';
$string['licenseblocks'] = 'License blocks';
$string['licenseformempty'] = 'Please enter the number of licenses you need.';
$string['licenseoptionsavailableforregisteredcompanies'] = 'License options available for registered companies, please login';
$string['loginforlicenseoptions'] = 'Please log in to see license options';
$string['missingshortsummary'] = 'Short description is missing.';
$string['moreinfo'] = 'more info';
$string['name'] = 'Name';
$string['nocoursesnotontheshop'] = 'There are no courses available to be added to the shop.';
$string['nocoursesontheshop'] = 'There are no courses on the shop matching your criteria.';
$string['noinvoices'] = 'There are no invoices matching your criteria.';
$string['noproviders'] = 'No payment providers have been enabled. Please contact the site administrator';
$string['notconfigured'] = 'The eCommerce block has not been configured. Check the settings page for the block';
$string['opentoallcompanies'] = 'Shop is available to every company';
$string['opentoallcompanies_help'] = 'If this is disabled, then access to the shop can be turned on on a per company basis through the control panel. If you enable it for the first time, you will then need to turn on the shop for the companies who require it.';
$string['or'] = 'or';
$string['order'] = 'Order';
$string['orders'] = 'Orders';
$string['payment_options'] = 'Payment options';
$string['paymentprocessing'] = 'Payment processing';
$string['paymentprovider'] = 'Payment provider';
$string['payment_provider_disabled'] = '{$a} is disabled';
$string['paymentprovider_enabled'] = 'Enable {$a}';
$string['paymentprovider_enabled_help'] = 'Select this if you want {$a} to be enabled as a payment provider.';
$string['pluginname'] = 'E-Commerce';
$string['postcode'] = 'Postcode';
$string['pp_ack'] = 'Webservice responde';
$string['pp_amount'] = 'Amount';
$string['pp_currencycode'] = 'Currency';
$string['pp_exchangerrate'] = 'Exchange rate';
$string['pp_feeamt'] = 'Fee';
$string['pp_invoice_name'] = 'Invoice';
$string['pp_ordertime'] = 'Order time';
$string['pp_payerid'] = 'Payer ID';
$string['pp_payerstatus'] = 'Payer Status';
$string['pp_paymentstatus'] = 'Payment Status';
$string['pp_paymenttype'] = 'Payment Type';
$string['pp_paypal_api_password'] = 'Paypal API password';
$string['pp_paypal_api_signature'] = 'Payal API signature';
$string['pp_paypal_api_username'] = 'Paypal API username';
$string['pp_paypal_name'] = 'Paypal';
$string['pp_paypal_usesandbox'] = 'Use Paypal sandbox';
$string['pp_paypal_usesandbox_help'] = 'Click this to use a Paypal sandbox account instead of a real account for testing';
$string['pp_pendingreason'] = 'Reason pending';
$string['pp_reason'] = 'Reason';
$string['pp_settleamt'] = 'Amount after exchange rate';
$string['pp_taxamt'] = 'Tax';
$string['pp_transactionid'] = 'Transaction ID';
$string['pp_transactiontype'] = 'Transaction Type';
$string['pricefrom'] = 'From {$a}';
$string['priceoptions'] = 'Price options';
$string['privacy:metadata'] = 'The E-Commerce block only shows data stored in other locations.';
$string['privacy:metadata:invoice:id'] = 'ID from the {invoice} table';
$string['privacy:metadata:invoice:reference'] = 'Invoice reference';
$string['privacy:metadata:invoice:userid'] = 'Invoice userid';
$string['privacy:metadata:invoice:status'] = 'Invoice status';
$string['privacy:metadata:invoice:checkout_method'] = 'Invoice checkout method';
$string['privacy:metadata:invoice:email'] = 'Invoice email address';
$string['privacy:metadata:invoice:phone1'] = 'Invoice main phone number';
$string['privacy:metadata:invoice:pp_payerid'] = 'Invoice payment processor payerid';
$string['privacy:metadata:invoice:pp_payerstatus'] = 'Invoice payment processor payer status';
$string['privacy:metadata:invoice:company'] = 'Invoice company';
$string['privacy:metadata:invoice:address'] = 'Invoice address';
$string['privacy:metadata:invoice:city'] = 'Invoice city';
$string['privacy:metadata:invoice:state'] = 'Invoice state';
$string['privacy:metadata:invoice:country'] = 'Invoice country';
$string['privacy:metadata:invoice:postcode'] = 'Invoice postcode';
$string['privacy:metadata:invoice:firstname'] = 'Invoice firstname';
$string['privacy:metadata:invoice:lastname'] = 'Invoice lastname';
$string['privacy:metadata:invoice:pp_exchangerate'] = 'Invoice payment processor exchange rate';
$string['privacy:metadata:invoice:pp_ack'] = 'Invoice payment processor acknowledged';
$string['privacy:metadata:invoice:pp_transactionid'] = 'Invoice payment processor transaction id';
$string['privacy:metadata:invoice:pp_transactiontype'] = 'Invoice payment processor tracnsaction type';
$string['privacy:metadata:invoice:pp_paymenttype'] = 'Invoice payment proccessor payment type';
$string['privacy:metadata:invoice:pp_ordertime'] = 'Invoice payment processor order time';
$string['privacy:metadata:invoice:pp_currencycode'] = 'Invoice payment processor currency code';
$string['privacy:metadata:invoice:pp_amount'] = 'Invoice payment processor amount';
$string['privacy:metadata:invoice:pp_feeamt'] = 'Invoice payment processor fee amount';
$string['privacy:metadata:invoice:pp_settleamt'] = 'Invoice payment processor settle amount';
$string['privacy:metadata:invoice:pp_taxamt'] = 'Invoice payment processor tax amount';
$string['privacy:metadata:invoice:pp_paymentstatus'] = 'Invoice payment processor payment status';
$string['privacy:metadata:invoice:pp_pendingreason'] = 'Invoice payment processor pending reason';
$string['privacy:metadata:invoice:pp_reason'] = 'Invoice payment processor reason';
$string['privacy:metadata:invoice:date'] = 'Invoice payment date';
$string['privacy:metadata:invoice'] = 'Invoice metadata';
$string['process'] = 'Process';
$string['processed'] = 'Processed';
$string['process_help'] = 'Items with checked boxes in the "Process" column will be processed as "order complete" when saving changes.';
$string['purchaser_details'] = 'Purchaser';
$string['reference'] = 'Reference';
$string['remove_filter'] = 'Show all courses';
$string['returntoshop'] = 'Continue shopping';
$string['review'] = 'Review your order';
$string['search'] = 'Search';
$string['selectcoursetoadd'] = 'Select course to add to shop';
$string['select_tag'] = 'Select category';
$string['shop'] = 'Shop';
$string['shop_title'] = 'Shop';
$string['show'] = 'Show in shop';
$string['single_purchase'] = 'Single purchase';
$string['single_purchase_price'] = 'Single purchase price';
$string['single_purchase_price_help'] = 'Price for an individual license';
$string['single_purchase_validlength'] = 'Valid length (days)';
$string['single_purchase_validlength_help'] = 'The user will be enrolled in the course for this number of days after first enrolling. After this they will automatically removed (completely) from the course';
$string['single_purchase_shelflife'] = 'Shelf life (days)';
$string['single_purchase_shelflife_help'] = 'The user must enrol in the course within this number of days or the license will expire.';
$string['state'] = 'County';
$string['status'] = 'Status';
$string['status_b'] = 'Basket';
$string['status_u'] = 'Unpaid';
$string['status_p'] = 'Paid';
$string['tags'] = 'Categories';
$string['tags_help'] = 'Categorise this course by adding categories separated by commas. You can select existing categories or add new ones to be created.';
$string['total'] = 'Total';
$string['type_quantity_1_singlepurchase'] = 'Single purchase';
$string['type_quantity_n_singlepurchase'] = 'Single purchase';
$string['type_quantity_1_licenseblock'] = '{$a} license';
$string['type_quantity_n_licenseblock'] = '{$a} licenses';
$string['unitprice'] = 'Price per license';
$string['unprocessed'] = 'Unprocessed';
$string['unprocesseditems'] = 'Unprocessed items';
$string['useexternalshop'] = 'Use an external eCommerce solution for purchases';
$string['useexternalshop_help'] = 'Enable this if you have an external eCommerce solution which has the correct Webservices to work.';
