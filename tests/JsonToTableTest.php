<?php

namespace ACWPD\Tools;
use PHPUnit\Framework\TestCase;
	final class JsonToTableTest extends TestCase {
		private $JsonToTable;

		public function testBuild() {
			$data = [
				'Header1' => [
					'column1 row1',
					'column1 row2',
					'column1 row3',
					'column1 row4'
				],
				'Header2' => [
					'column2 row1',
					'column2 row2',
					'column2 row3',
					'column2 row4'
				],
				'Header3' => [
					'column3 row1',
					'column3 row2',
					'column3 row3',
					'column3 row4'
				]
			];
			$JSON = json_encode($data);
			$this->JsonToTable = new \ACWPD\Tools\JsonToTable($JSON);
			$output = $this->JsonToTable->build();
			$this->assertStringEqualsFile(
				__DIR__ . '/comparisons/TestJsonToTable.testBuild.html',
				$output);
		}

		public function testBuildNested() {
			$data = [
				'Header1' => [
					'column1 row1',
					'subTab' => [
						'sHead1' => [
							'sCell1.1',
							'sCell1.2'
						],
						'sHead2' => [
							'sCell2.1'
						]
					],
					'column1 row3',
					'column1 row4'
				],
				'Header2' => [
					'column2 row1',
					'column2 row2',
					'column2 row3',
					'column2 row4'
				],
				'Header3' => [
					'column3 row1',
					'column3 row2',
					'column3 row3',
					'column3 row4'
				]
			];
			$JSON = json_encode($data);
			$this->JsonToTable = new \ACWPD\Tools\JsonToTable($JSON);
			$output = $this->JsonToTable->build();
			$this->assertStringEqualsFile(
				__DIR__ . '/comparisons/TestJsonToTable.testBuildNested.html',
				$output);
		}
	}
