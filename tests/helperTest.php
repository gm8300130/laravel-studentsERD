<?php
//使用要測試的class
use App\Test\helper;

/**
*簡單字串測試
*/
class ClassName extends TestCase
{
	//每次要開始載入
    protected function setUp()
    {
        $this->help = new helper;
    }

	public function testArrayUntil()
	{
		/** Arrange 初始化目標物件、相依物件、方法參數、預期結果，或是預期與相依物件的互動方式。*/
	    $names = ['Taylor', 'Dayle', 'Matthew', 'Shawn', 'Neil'];

	    /** Assume 預期結果、或預期的互動*/
	    $expected = ['Taylor', 'Dayle'];

	    /** Act 呼叫目標物件的方法*/
	    $result =  $this->help->array_until($names, 'Matthew');

	    /** Assert 驗證是否符合預期*/
	    $this->assertEquals($expected, $result);
	}
}

?>