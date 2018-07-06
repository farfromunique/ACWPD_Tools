# ACWPD Tools
Useful Tools (php and JS) for ACWPD projects (or your own!)

# Usage
    composer require acwpd/tools

...and then refence the tool you want to use:  
* JsonToTable  
  -     $table = new ACWPD\Tools\JsonTotable($JSON);
        // then
        $html = $table->build();
		// or ...
		echo $table;

* DbErrorChecker
  -     $data = ACWPD\Tools\DbErrorChecker::CheckPrepared($db, $PreparedStatement);
