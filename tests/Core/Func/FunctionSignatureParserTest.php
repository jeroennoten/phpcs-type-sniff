<?php

namespace Gskema\TypeSniff\Core\Func;

use Gskema\TypeSniff\Core\Type\DocBlock\NullType;
use PHP_CodeSniffer\Config;
use PHP_CodeSniffer\Exceptions\RuntimeException;
use PHP_CodeSniffer\Files\LocalFile;
use PHP_CodeSniffer\Ruleset;
use PHPUnit\Framework\TestCase;
use Gskema\TypeSniff\Core\Type\Common\ArrayType;
use Gskema\TypeSniff\Core\Type\Common\BoolType;
use Gskema\TypeSniff\Core\Type\Common\FqcnType;
use Gskema\TypeSniff\Core\Type\Common\IntType;
use Gskema\TypeSniff\Core\Type\Common\SelfType;
use Gskema\TypeSniff\Core\Type\Common\StringType;
use Gskema\TypeSniff\Core\Type\Common\UndefinedType;
use Gskema\TypeSniff\Core\Type\Declaration\NullableType;

class FunctionSignatureParserTest extends TestCase
{
    /**
     * @return mixed[][]
     */
    public function dataFromTokens(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            __DIR__.'/fixtures/test_func0.php',
            2,
            new FunctionSignature(
                3,
                'func1',
                [],
                new UndefinedType(),
                3
            ),
            null
        ];

        // #1
        $dataSets[] = [
            __DIR__.'/fixtures/test_func0.php',
            13,
            new FunctionSignature(
                5,
                'func2',
                [
                    new FunctionParam(5, 'a', new UndefinedType(), new UndefinedType()),
                    new FunctionParam(5, 'b', new IntType(), new UndefinedType()),
                    new FunctionParam(5, 'c', new NullableType(new StringType()), new UndefinedType()),
                    new FunctionParam(5, 'd', new SelfType(), new UndefinedType()),
                ],
                new ArrayType(),
                5
            ),
            null
        ];

        // #2
        $dataSets[] = [
            __DIR__.'/fixtures/test_func0.php',
            48,
            new FunctionSignature(
                9,
                'func3',
                [
                    new FunctionParam(10, 'arg1', new NullableType(new FqcnType('\Space\Class1')), new UndefinedType()),
                    new FunctionParam(11, 'arg2', new BoolType(), new UndefinedType()),
                    new FunctionParam(12, 'arg3', new UndefinedType(), new BoolType()),
                    new FunctionParam(13, 'arg4', new IntType(), new NullType()),
                    new FunctionParam(14, 'arg5', new IntType(), null),
                ],
                new FqcnType('\Space1\Class2'),
                15
            ),
            null
        ];

        // #3
        $dataSets[] = [
            __DIR__.'/fixtures/test_func0.php',
            118,
            null,
            \RuntimeException::class
        ];

        // #4
        $dataSets[] = [
            __DIR__.'/fixtures/test_func1.php',
            2,
            new FunctionSignature(
                3,
                'func1',
                [
                    new FunctionParam(4, 'arg1', new IntType(), null),
                    new FunctionParam(5, 'arg2', new StringType(), null)
                ],
                new UndefinedType(),
                6
            ),
            null
        ];

        return $dataSets;
    }

    /**
     * @dataProvider dataFromTokens
     *
     * @param string                 $givenPath
     * @param int                    $givenFnPtr
     * @param FunctionSignature|null $expectedFun
     * @param string|null            $expectedException
     *
     * @throws RuntimeException
     */
    public function testFromTokens(
        string $givenPath,
        int $givenFnPtr,
        ?FunctionSignature $expectedFun,
        ?string $expectedException
    ): void {
        $givenFile = new LocalFile($givenPath, new Ruleset(new Config()), new Config());
        $givenFile->parse();

        if (null !== $expectedException) {
            self::expectException($expectedException);
        }

        $actualFunc = FunctionSignatureParser::fromTokens(
            $givenFile,
            $givenFnPtr
        );

        self::assertEquals($expectedFun, $actualFunc);
    }
}
