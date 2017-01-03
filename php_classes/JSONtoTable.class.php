<?php
	/**
	 * JSON to HTML Table 
	 *  Builds an HTML table from a JSON object 
	 *  This should be used as a general template only! The specific implementation MUST be customized to each JSON object, becuase they can all be different. 
	 */
	class JSONtoTable {
		
		public function __construct($json,$headersAsAssoc = true) {
			if ($headersAsAssoc) {
				$arr = json_decode($json,true);
			}
		}

		private function buildHTMLTable($arr) {
			$tableOut  = '<table>' . "\n";
			$tableOut .= "\t" . '<tr>' . "\n";
			$tableOut .= buildHTMLTableHeaders($arr);
			$tableOut .= "\t" . '</tr>' . "\n";
			$tableOut .= "\t" . '<tr>' . "\n";
			foreach ($arr as $header => $value) {
				if ( ! is_array($value)) {
					$tableOut .= "\t\t" . '<td>' . $value . '</td>' . "\n";
				} else {
					$tableOut .= buildHTMLTable($value);
				}
			}
			$tableOut .= "\t" . '</tr>' . "\n";
			$tableOut .= '</table>' . "\n";
			
			return $tableOut;
		}

		private function buildHTMLTableHeaders($arr) {
			foreach ($arr as $header => $value) {
				$tableOut .= "\t\t" . '<th>' . $header . '</th>' . "\n";
			}
		}
	}
	