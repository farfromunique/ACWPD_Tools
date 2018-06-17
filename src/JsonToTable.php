<?php

namespace ACWPD\Tools;

	/**
	 * JSON to HTML Table 
	 *  Builds an HTML table from a JSON object 
	 *  This should be used as a general template only! The specific implementation MUST be customized to each JSON object, becuase they can all be different. 
	 */
	class JsonToTable {
		private $table;

		public function __construct(string $json) {
			$this->table = json_decode($json,true);
			return true;
		}

		private function transpose(array $data): array {
			$width = count($data);
			$maxHeight = 0;
			foreach ($data as $column => $cells) {
				$height = count($cells);
				if ($height > $maxHeight) {
					$maxHeight = $height;
				}
			}
			$table = array_fill(0,$maxHeight,array_fill(0,$width,''));
			$columnID = 0;
			foreach ($data as $column => $cells) {
				$cellID = 0;
				foreach ($cells as $cell) {
					$table[$cellID][$columnID] = $cell;
					$cellID++;
				}
				$columnID++;
			}
			return $table;
		}
		
		private function buildHTMLTable(array $arr, string $prependToSubTables = ''): string {
			$tableOut = $prependToSubTables . '<table>' . "\n";
			$tableOut .= $this->buildHTMLTableHeaders($arr, $prependToSubTables);
			$tableOut .= $prependToSubTables . "\t" . '<tbody>' . "\n";
			
			$table = $this->transpose($arr);
			foreach ($table as $column) {
				$tableOut .= $prependToSubTables . "\t\t" . '<tr>' . "\n";
				foreach ($column as $cells => $cell) {
					if ( is_array($cell) ) {
						$tableOut .= $prependToSubTables . "\t\t\t" . '<td>' . "\n";
						$tableOut .= $this->buildHTMLTable($cell, $prependToSubTables . "\t\t\t\t") . "\n";
						$tableOut .= $prependToSubTables . "\t\t\t" . '</td>' . "\n";
					} else {
						$tableOut .= $prependToSubTables . "\t\t\t" . '<td>' . $cell . '</td>' . "\n";
					}
				}
				$tableOut .= $prependToSubTables . "\t\t" . '</tr>' . "\n";
			}
			
			$tableOut .= $prependToSubTables . "\t" . '</tbody>' . "\n";
			$tableOut .= $prependToSubTables . '</table>';
			return $tableOut;
		}

		private function buildHTMLTableHeaders($arr, string $prependToSubTables = ''): string {
			$headerOut  = $prependToSubTables . "\t" . '<thead>' . "\n";
			$headerOut .= $prependToSubTables . "\t\t" . '<tr>' . "\n";
			foreach ($arr as $header => $value) {
				$headerOut .= $prependToSubTables . "\t\t\t" . '<th>' . $header . '</th>' . "\n";
			}
			$headerOut .= $prependToSubTables . "\t\t" . '</tr>' . "\n";
			$headerOut .= $prependToSubTables . "\t" . '</thead>' . "\n";
			return $headerOut;
		}

		public function __toString() {
			return $this->build($this->table);
		}

		public function build() {
			return $this->buildHTMLTable($this->table);
		}
	}
	