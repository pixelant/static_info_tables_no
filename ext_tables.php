<?php
if (!defined ('TYPO3_MODE'))     die ('Access denied.');

$tempTablesDef = array (
	'static_countries' => array (
		'cn_short_en' => 'cn_short_no',
	),
	'static_country_zones' => array (
		'zn_name_en' => 'zn_name_no',
	),
	'static_currencies' => array (
		'cu_name_en' => 'cu_name_no',
		'cu_sub_name_en' => 'cu_sub_name_no',
	),
	'static_languages' => array (
		'lg_name_en' => 'lg_name_no',
	),
	'static_territories' => array (
		'tr_name_en' => 'tr_name_no',
	),
	'static_taxes' => array (
		'tx_name_en' => 'tx_name_no',
	),
);

foreach ($tempTablesDef as $tempTable => $tempFieldDef) {
    t3lib_div::loadTCA($tempTable);
    foreach ($tempFieldDef as $tempSourceField => $tempDestField) {
        $tempColumns = array();
        $tempColumns[$tempDestField] = $TCA[$tempTable]['columns'][$tempSourceField];
        $tempColumns[$tempDestField]['label'] = 'LLL:EXT:'.$_EXTKEY.'/locallang_db.xml:'.$tempTable.'_item.'.$tempDestField;
        t3lib_extMgm::addTCAcolumns($tempTable, $tempColumns, 1);
        t3lib_extMgm::addToAllTCAtypes($tempTable, $tempDestField, '', 'after:'.$tempSourceField);
    }
}

?>
