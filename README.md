# pe-iklh" 
## perbaikan terakhir dari 

## Tambahan session mysql
```
CREATE TABLE IF NOT EXISTS `ci_sessions` (
        `id` varchar(128) NOT NULL,
        `ip_address` varchar(45) NOT NULL,
        `timestamp` int(10) unsigned DEFAULT 0 NOT NULL,
        `data` blob NOT NULL,
        KEY `ci_sessions_timestamp` (`timestamp`)
);
```
## Tambahan fasilitas upload file by erlin
```
ALTER TABLE `tbl_sungai` ADD `file` VARCHAR(200) NOT NULL AFTER `kategori`;

update tbl_sungai SET file='kosong' where file=''

```