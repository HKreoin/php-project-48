<?php

namespace Gendiff\PHPUnit\Tests;

use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;
use function Differ\Parsers\parse;

class AppTest extends TestCase
{
    public function testGendiffJson(): void
    {
        $filePath1 = __DIR__ . "/fixtures/file1.json";
        $filePath2 = __DIR__ . "/fixtures/file2.json";
        $expectedPath = __DIR__ . "/fixtures/result.txt";

        $expected = parse($expectedPath);
        $actual = genDiff($filePath1, $filePath2);
        $this->assertEquals($expected, $actual);
    }

    public function testGendiffYaml(): void
    {
        $filePath1 = __DIR__ . "/fixtures/file1.yaml";
        $filePath2 = __DIR__ . "/fixtures/file2.yml";
        $expectedPath = __DIR__ . "/fixtures/result.txt";

        $expected = parse($expectedPath);
        $actual = genDiff($filePath1, $filePath2);
        $this->assertEquals($expected, $actual);
    }

    public function testGendiffJson2(): void
    {
        $filePath1 = __DIR__ . "/fixtures/file3.json";
        $filePath2 = __DIR__ . "/fixtures/file4.json";
        $expectedPath = __DIR__ . "/fixtures/result2.txt";

        $expected = parse($expectedPath);
        $actual = genDiff($filePath1, $filePath2);
        $this->assertEquals($expected, $actual);
    }

    public function testGendiffJsonPlain(): void
    {
        $filePath1 = __DIR__ . "/fixtures/file3.json";
        $filePath2 = __DIR__ . "/fixtures/file4.json";
        $expectedPath = __DIR__ . "/fixtures/resultPlain.txt";

        $expected = parse($expectedPath);
        $actual = genDiff($filePath1, $filePath2, 'plain');
        $this->assertEquals($expected, $actual);
    }

    public function testGendiffJsonStylish(): void
    {
        $filePath1 = __DIR__ . "/fixtures/file3.json";
        $filePath2 = __DIR__ . "/fixtures/file4.json";
        $expectedPath = __DIR__ . "/fixtures/jsonTestDiff.txt";

        $expected = parse($expectedPath);
        $actual = genDiff($filePath1, $filePath2, 'json');
        $this->assertEquals($expected, $actual);
    }
}
