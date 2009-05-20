#
# Table structure for table 'tx_realurl_pathcache'
#
CREATE TABLE tx_crawler_queue (
  qid int(11) DEFAULT '0' NOT NULL auto_increment,
  page_id int(11) DEFAULT '0' NOT NULL,
  parameters text NOT NULL,
  scheduled int(11) DEFAULT '0' NOT NULL,
  exec_time int(11) DEFAULT '0' NOT NULL,
  set_id int(11) DEFAULT '0' NOT NULL,
  result_data text NOT NULL,
  process_scheduled int(11) DEFAULT '0' NOT NULL,
  process_id varchar(50) DEFAULT '' NOT NULL,

  PRIMARY KEY (qid),
  KEY page_id (page_id),
  KEY set_id (set_id,exec_time)
  KEY process_id (process_id)
) ENGINE=InnoDB;


CREATE TABLE tx_crawler_process (
    process_id varchar(50) DEFAULT '' NOT NULL,
    active smallint(6) DEFAULT '0',
    ttl int(11) DEFAULT '0' NOT NULL,
    deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
    
    KEY process_id (process_id)
) ENGINE=InnoDB;
