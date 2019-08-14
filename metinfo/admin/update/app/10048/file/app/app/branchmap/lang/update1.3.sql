ALTER TABLE  `{$_M['config']['tablepre']}branchmap_detailed` ADD  `fixedtel` varchar(11) AFTER  `tel`, ADD `type` varchar(11) AFTER  `fixedtel` #;#;
INSERT INTO {$_M['config']['tablepre']}cloud_config SET name='typeon',m_name='branchmap',value='0',lang='cn' ON DUPLICATE KEY UPDATE value='0' #;#;
INSERT INTO {$_M['config']['tablepre']}cloud_config SET name='typeon',m_name='branchmap',value='0',lang='en' ON DUPLICATE KEY UPDATE value='0' #;#;
INSERT INTO {$_M['config']['tablepre']}cloud_config SET name='typeon',m_name='branchmap',value='0',lang='tc' ON DUPLICATE KEY UPDATE value='0' #;#;

