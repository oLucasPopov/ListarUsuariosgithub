<?php

namespace Tests\Unit;

use App\Helpers\ArrayHelper;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\TestCase;

class FakeObject extends Model
{
    protected $fillable = [
        'id',
        'email'
    ];
}

class ArrayHelperTest extends TestCase
{
    private function mock_unordered_array(): array
    {
        return array(
            new FakeObject(['id' => 3, 'email' => "joao@example.com"]),
            new FakeObject(['id' => 1, 'email' => "maria@example.com"]),
            new FakeObject(['id' => 5, 'email' => "pedro@example.com"]),
            new FakeObject(['id' => 2, 'email' => "ana@example.com"]),
            new FakeObject(['id' => 4, 'email' => "carlos@example.com"])
        );
    }

    public function test_sort_array_should_order_array_when_asc_is_passed(): void
    {
        $fake_objects = $this->mock_unordered_array();

        ArrayHelper::sort_array($fake_objects, 'id', 'asc');

        $lastObjID = -1;
        foreach ($fake_objects as $fake_object) {
            $CurrentObjID = $fake_object['id'];
            if ($CurrentObjID < $lastObjID) {
                $this->fail("O Objeto atual é menor que o objeto anterior!  $CurrentObjID < $lastObjID ");
            }
            $lastObjID = $CurrentObjID;
        }

        $this->assertTrue(true);
    }

    public function test_sort_array_should_sort_asc_correctly_when_equal_values_are_provided(): void
    {
        $fake_objects = array(
            new FakeObject(['id' => 1, 'email' => "joao@example.com"]),
            new FakeObject(['id' => 1, 'email' => "maria@example.com"]),
            new FakeObject(['id' => 2, 'email' => "pedro@example.com"]),
            new FakeObject(['id' => 2, 'email' => "ana@example.com"]),
            new FakeObject(['id' => 4, 'email' => "carlos@example.com"])
        );

        ArrayHelper::sort_array($fake_objects, 'id', 'asc');

        $lastObjID = -1;
        foreach ($fake_objects as $fake_object) {
            $CurrentObjID = $fake_object['id'];
            if ($CurrentObjID < $lastObjID) {
                $this->fail("O Objeto atual é menor que o objeto anterior!  $CurrentObjID < $lastObjID ");
            }
            $lastObjID = $CurrentObjID;
        }

        $this->assertTrue(true);
    }

    public function test_sort_array_should_order_array_when_desc_in_lowercase_is_passed(): void
    {
        $fake_objects = $this->mock_unordered_array();

        ArrayHelper::sort_array($fake_objects, 'id', 'desc');

        $lastObjID = null;
        foreach ($fake_objects as $fake_object) {
            $CurrentObjID = $fake_object['id'];
            if (($lastObjID !== null) && ($CurrentObjID > $lastObjID)) {
                $this->fail("O Objeto atual é maior que o objeto anterior!  $CurrentObjID > $lastObjID ");
            }
            $lastObjID = $CurrentObjID;
        }

        $this->assertTrue(true);
    }

    public function test_sort_array_should_order_array_when_desc_in_uppercase_is_passed(): void
    {
        $fake_objects = $this->mock_unordered_array();

        ArrayHelper::sort_array($fake_objects, 'id', 'DESC');

        $lastObjID = null;
        foreach ($fake_objects as $fake_object) {
            $CurrentObjID = $fake_object['id'];
            if (($lastObjID !== null) && ($CurrentObjID > $lastObjID)) {
                $this->fail("O Objeto atual é maior que o objeto anterior!  $CurrentObjID > $lastObjID ");
            }
            $lastObjID = $CurrentObjID;
        }

        $this->assertTrue(true);
    }

    public function test_sort_array_should_throw_if_incorrect_sort_order_is_passed(): void
    {
        $fake_objects = $this->mock_unordered_array();

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('O Valor passado para o tipo de ordenação está incorreto!');
        ArrayHelper::sort_array($fake_objects, 'id', 'INCORRECT_ORDER');
    }

    public function test_sort_array_should_not_throw_if_empty_array_is_provided(): void
    {
        $fake_objects = [];
        ArrayHelper::sort_array($fake_objects, 'id', 'ASC');
        $this->assertTrue(true);
    }

    public function test_sort_array_should_throw_if_wrong_key_is_provided(): void
    {
        $fake_objects = $this->mock_unordered_array();
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('O Valor passado para a chave a ser ordenada está incorreto!');

        ArrayHelper::sort_array($fake_objects, 'WRONG_KEY', 'ASC');
    }
}
