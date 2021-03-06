<?php

namespace Gskema\TypeSniff\Inspection\Subject;

use Gskema\TypeSniff\Core\DocBlock\DocBlock;
use Gskema\TypeSniff\Core\DocBlock\Tag\ReturnTag;
use Gskema\TypeSniff\Core\Func\FunctionSignature;
use Gskema\TypeSniff\Core\Type\Common\UndefinedType;
use Gskema\TypeSniff\Core\Type\TypeInterface;

class ReturnTypeSubject extends AbstractTypeSubject
{
    public function __construct(
        ?TypeInterface $docType,
        TypeInterface $fnType,
        ?int $docTypeLine,
        int $fnTypeLine,
        string $name,
        DocBlock $docBlock
    ) {
        parent::__construct(
            $docType,
            $fnType,
            new UndefinedType(), // return does not have an assignment
            $docTypeLine,
            $fnTypeLine,
            $name,
            $docBlock
        );
    }

    /**
     * @param FunctionSignature $fnSig
     * @param ReturnTag|null    $returnTag
     * @param DocBlock          $docBlock
     *
     * @return static
     */
    public static function fromSignature(FunctionSignature $fnSig, ?ReturnTag $returnTag, DocBlock $docBlock)
    {
        return new static(
            $returnTag ? $returnTag->getType() : null,
            $fnSig->getReturnType(),
            $returnTag ? $returnTag->getLine() : $fnSig->getReturnLine(),
            $fnSig->getReturnLine(),
            'return value',
            $docBlock
        );
    }
}
